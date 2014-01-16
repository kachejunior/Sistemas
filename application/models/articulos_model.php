<?php

/**
 * Description of administracion_general1
 *
 * @author desarrollo
 * 
 
 */
class Articulos_model extends CI_Model{
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

/*--------------------------------------------------------Validaciones-----------------------------------------------------------------------*/
	private function _validar($tabla, $id)
	{
		$sql = 'select count(*) as total from '.$tabla.' where id ='.(int)$id;
		$consulta = $this->db->query($sql);
		if($consulta->row()->total > 0) 
			return true;
		else
		{
			//echo 'bandera validacion '.$tabla.' +'.$id;
			return false;
		}
	}
	
	private function _validar_cantidad($cantidad_disponible)
	{
		if(($cantidad_disponible < 0) ) 
		{
			return false;
		}
			
		else
			return true;			
	}
	

/*--------------------------------------------------------Funciones matriz--------------------------------------------------------*/

	public function agregar($id_sede, $nombre, $cantidad_disponible, $color, $id_tipo_articulo)
	{
		if((!$this->_validar('sedes', $id_sede)) 
				OR (!$this->_validar('tipos_articulos', $id_tipo_articulo)) 
						OR (!$this->_validar_cantidad($cantidad_disponible)))
			return -1;
		
		$nombre = $this->db->escape($nombre);
		$color = $this->db->escape($color);
		
		//insertamos el elemento en la tabla y retornamos el id con el que se agrego
		$sql = 'insert into articulos (id_sede,nombre,cantidad_disponible,color,id_tipo_articulo) values ('.$id_sede.','.$nombre.','.$cantidad_disponible.','.$color.','.$id_tipo_articulo.')';
		$this->db->query($sql);
		return $this->db->affected_rows();	
	}

	
	public function editar($id, $id_sede, $nombre, $cantidad_disponible, $color, $id_tipo_articulo)
	{
		if((!$this->_validar('sedes', $id_sede)) 
				OR (!$this->_validar('tipos_articulos', $id_tipo_articulo)) 
						OR (!_validar_cantidad($cantidad_disponible)))
			return -1;
		
		$nombre = $this->db->escape($nombre);
		$color = $this->db->escape($color);
		
		
		//Editamos el elemento en la tabla
		$sql = 'update articulos set '. 
						'id_sede = '.$id_sede.', '.
						'nombre = '.$nombre.', '.
						'cantidad_disponible = '.$cantidad_disponible.', '.
						'color = '.$color.', '.
						'id_tipo_articulo = '.$id_tipo_articulo.
						' where id = '.$id;
		$this->db->query($sql);
		return $this->db->affected_rows();
	}

	public function eliminar($id)
	{
		//Eliminamos el elemento de la tabla
		$sql = 'delete from articulos where id = '.$id;
		$this->db->query($sql);
		return $this->db->affected_rows();
	}
	
	public function get($id)
	{
		//En dado caso que no exista id se devolvera la tabla completa, caso contrario se devolvera el registro especificado
		$sql = 'select *  from data_articulos where id='.$id;
		$consulta = $this->db->query($sql);
		return $consulta->row();
	}
	
	
	
/*---------------------------------------------------------------------Busqueda filtrada-------------------------------------------------------------------*/
	public function buscar($id=FALSE, $nombre=FALSE,  $id_sede=FALSE, $id_tipo_articulo=FALSE, $estatus=FALSE)
	{
		
		//En dado caso que no exista id se devolvera la tabla completa, caso contrario se devolvera el registro especificado
		$sql = 'select *  from data_articulos where id > 0 ';
		if($id==FALSE && $nombre==FALSE &&  $id_sede==FALSE && $id_tipo_articulo==FALSE && $estatus==FALSE)
		{
			
			$sql = $sql.' order by id_sede, id_tipo_articulo';
			$consulta = $this->db->query($sql);
			return $consulta->result(); 
		}
			if ($id!=NULL)
			{
				$sql = $sql.' and  id = '.$id;
			}
			
			if ($nombre!=NULL)
			{
				$nombre = strtolower($nombre);
				$sql = $sql." and  lower(nombre) like '%".$nombre."%'";
			}
			
			if ($id_sede!=NULL)
			{
				$sql = $sql.' and  id_sede = '.$id_sede;
			}
			
			if ($id_tipo_articulo!=NULL)
			{
				//echo 'bander';
				$sql = $sql.' and  id_tipo_articulo = '.$id_tipo_articulo;
			}
			
			if ($estatus=='A')
			{
				$sql = $sql.' and  cantidad_disponible = 0 ';
			}
			
			//echo $sql.'<br/>';
			$consulta = $this->db->query($sql);
			return $consulta->result(); 
		
	}
	
	
/*----------------------------------------------Funciones especificas para el  manejo de tabla articulos---------------------------------------------------------------*/
	
	//Modifica el valor en base a la salida de articulo
	public function salida_de_articulo ($id, $cantidad_salida)
	{
		$sql ='select cantidad_disponible from articulos where id ='.$id;
		$consulta = $this->db->query($sql);
		$cantidad_disponible = $consulta->row()->cantidad_disponible;
		 
		if($cantidad_salida > $cantidad_disponible)
		{
			return -1;
		}
		
		else
		{
			$sql ='Update articulos set '. 
			' cantidad_disponible = cantidad_disponible-'.$cantidad_salida.
			' where id = '.$id;
			$consulta = $this->db->query($sql);
			return $this->db->affected_rows();
		}
	}
	
	public function entrada_de_articulo ($id, $cantidad_entrada)
	{
		$sql ='Update articulos set '. 
		' cantidad_disponible = cantidad_disponible+'.$cantidad_entrada.
		' where id = '.$id;
		$consulta = $this->db->query($sql);
		return $this->db->affected_rows();
	}
	
/*---------------------------------Funciones acta de entrega--------------------------------*/
	public function agregar_articulo ($id_acta_entrega, $id_articulo, $cantidad)
	{
		if((!$this->_validar('actas_entregas', $id_acta_entrega)) 
				OR (!$this->_validar('articulos', $id_articulo)) )
			return -1;
		
		$sql = 'insert into detalles_actas_entregas '.
				  ' values ('.$id_acta_entrega.','.$id_articulo.','.$cantidad.')';
		$this->db->query($sql);
		return $this->db->affected_rows();	
	}
				
	public function eliminar_articulo ($id_acta_entrega, $id_articulo)
	{
		if((!$this->_validar('actas_entregas', $id_acta_entrega)) 
				OR (!$this->_validar('articulos', $id_articulo)) )
			return -1;
		
		$sql = 'delete from detalles_actas_entregas '.
				  ' where id_acta_entrega = '.$id_acta_entrega.' and id_articulo = '.$id_articulo;
		$this->db->query($sql);
		return $this->db->affected_rows();	
	}
	
	public function ver_articulos ($id_acta_entrega)
	{
		$sql = 'select *  from data_detalles_actas_entregas where id_acta_entrega='.$id_acta_entrega;
		$consulta = $this->db->query($sql);
		return $consulta->result(); 
	}
}
?>
