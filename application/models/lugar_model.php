<?php

/**
 * Description of administracion_general1
 *
 * @author desarrollo
 */
class Lugar_model extends CI_Model{
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	
	private function _validar($sede)
	{
		$sql = 'select count(*) as total from sedes where id ='.(int)$sede;
		$consulta = $this->db->query($sql);
		if($consulta->row()->total > 0) 
			return true;
		else
			return false;			
	}
	
	
	public function agregar($nombre, $sede)
	{
		if(!$this->_validar($sede))
			return -1;
		
		$nombre = $this->db->escape($nombre);
		
		//validamos que no exista otro elemento con el mismo nombre antes de agregarla
		$sql = 'select count(*) as total from lugares where lower(nombre) = lower('.$nombre.
						') and id_sedes = '.$sede;
		$query = $this->db->query($sql);
		if ($query->row()->total >0)
			return -2;
		
		//insertamos el elemento en la tabla y retornamos el id con el que se agrego
		$sql = 'insert into lugares (nombre, id_sedes) values('.$nombre.','.$sede.')';
		$this->db->query($sql);
		if ($this->db->affected_rows() >0)
		{
			$sql = 'SELECT LASTVAL() as id';
			$query = $this->db->query($sql);
			return $query->row()->id;
		}
		return 0;
	}

	public function editar($id,$nombre,$sede)
	{
		if(!$this->_validar($sede))
			return -1;
		
		$nombre = $this->db->escape($nombre);

		//validamos que no exista otra elemento con el mismo  nombre antes de editar
		$sql = 'select count(*) as total from lugares where (lower(nombre) = lower('.$nombre.
					 ') and id_sedes = '.$sede.' ) and id <>'.(int)$id;
		$query = $this->db->query($sql);
		if ($query->row()->total >0)
			return -2;
		
		//Editamos el elemento en la tabla
		$sql = 'update lugares set nombre = '.$nombre.
					 ' , id_sedes = '.$sede.' where id = '.(int)$id;
		$this->db->query($sql);
		return $this->db->affected_rows();
	}

	public function eliminar($id)
	{
		
		//Eliminamos el elemento de la tabla
		$sql = 'delete from lugares where id = '.(int)$id;
		$this->db->query($sql);
		return $this->db->affected_rows();
	}
	
	public function get($id=FALSE)
	{	
		//En dado caso que no exista id se devolvera la tabla completa, caso contrario se devolvera el registro especificado
		$sql = 'select * from lugares';
		if($id==FALSE)
		{
			$sql = $sql.' order by id';
			$consulta = $this->db->query($sql);
			return $consulta->result(); 
		}
		else
		{
			$sql = $sql.' where id='.(int)$id;
			$consulta = $this->db->query($sql);
			return $consulta->row();
		}
	}

	//Igual a get() a diferencia que devuelve el nombre de la sede en lugar de su id
	public function get2($id=FALSE)
	{	
		//En dado caso que no exista id se devolvera la tabla completa, caso contrario se devolvera el registro especificado
		$sql = 'select a.id, a.nombre, b.nombre as sede from lugares a join sedes b on a.id_sedes = b.id';
		if($id==FALSE)
		{
			$sql = $sql.' order by id';
			$consulta = $this->db->query($sql);
			return $consulta->result(); 
		}
		else
		{
			$sql = $sql.' where id='.(int)$id;
			$consulta = $this->db->query($sql);
			return $consulta->row();
		}
	}

}
?>
