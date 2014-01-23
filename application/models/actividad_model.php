<?php

/**
 * Description of administracion_general1
 *
 * @author desarrollo
 * 
 */
class Actividad_model extends CI_Model{
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	
	private function _validar($tabla, $id=0)
	{
		$sql = 'select count(*) as total from '.$tabla.' where id = '.(int)$id;
		$consulta = $this->db->query($sql);
		if($consulta->row()->total > 0) 
			return true;
		else
			return false;			
	}
	
	private function _validar_usuario($cedula)
	{
		$cedula = $this->db->escape($cedula);
		
		$sql = 'select count(*) as total from usuarios where cedula = '.$cedula;
		$consulta = $this->db->query($sql);
		if($consulta->row()->total > 0) 
			return true;
		else
			return false;			
	}
	
	public function agregar($nombre, $fecha_inicio, $fecha_final, $hora_inicio, $hora_final, $cedula, 
		$lugar, $status_actividad)
	{
		if((!$this->_validar('lugares', $lugar)) 
				OR (!$this->_validar('status_actividades', $status_actividad)) 
				OR (!$this->_validar_usuario($cedula)))
			return -1;
		
		$cedula = $this->db->escape($cedula);
		$nombre = $this->db->escape($nombre);
		$fecha_inicio = $this->db->escape($fecha_inicio);
		$fecha_final = $this->db->escape($fecha_final);
		$hora_inicio = $this->db->escape($hora_inicio);
		$hora_final = $this->db->escape($hora_final);
		
		//validamos que no exista otro elemento con el mismo nombre antes de agregarla
//		$sql = 'select count(*) as total from actividades where lower(nombre) = lower('.$nombre.')';
//		$query = $this->db->query($sql);
//		if ($query->row()->total >0)
//			return -2;
		
		//insertamos el elemento en la tabla y retornamos el id con el que se agrego
		$sql = 'insert into actividades (nombre, fecha_inicio, fecha_final, hora_inicio,'.
						' hora_final, cedula_usuario, id_lugar, id_status_actividad)'. 
						' values('.$nombre.','.$fecha_inicio.','.$fecha_final.','.$hora_inicio.','.$hora_final.','.$cedula.','
						.(int)$lugar.','.(int)$status_actividad.')';
		$this->db->query($sql);
		if ($this->db->affected_rows() > 0)
		{
			$sql = 'SELECT LASTVAL() as id';
			$query = $this->db->query($sql);
			return $query->row()->id;
		}
		return 0;
	}

	public function editar($id, $nombre, $fecha_inicio, $fecha_final, $hora_inicio, $hora_final, $cedula, 
		$lugar, $status_actividad)
	{
		if((!$this->_validar('lugares', $lugar)) 
				OR (!$this->_validar('status_actividades', $status_actividad)) 
				OR (!$this->_validar_usuario($cedula)))
			return -1;
		
		$cedula = $this->db->escape($cedula);
		$nombre = $this->db->escape($nombre);
		$fecha_inicio = $this->db->escape($fecha_inicio);
		$fecha_final = $this->db->escape($fecha_final);
		$hora_inicio = $this->db->escape($hora_inicio);
		$hora_final = $this->db->escape($hora_final);
		
		//Editamos el elemento en la tabla
		$sql = 'update actividades set '. 
						'nombre = '.$nombre.', '.
						'fecha_inicio = '.$fecha_inicio.', '.
						'fecha_final = '.$fecha_final.', '.
						'hora_inicio = '.$hora_inicio.', '.
						'hora_final = '.$hora_final.', '.
						'cedula_usuario = '.$cedula.', '.
						'id_lugar = '.(int)$lugar.', '.
						'id_status_actividad = '.(int)$status_actividad.
						' where id = '.$id;
		$this->db->query($sql);
		return $this->db->affected_rows();
	}

	public function eliminar($id)
	{
		//Eliminamos el elemento de la tabla
		$sql = 'delete from actividades where id = '.(int)$id;
		$this->db->query($sql);
		return $this->db->affected_rows();
	}
	
	public function get($id=FALSE)
	{
		//En dado caso que no exista id se devolvera la tabla completa, caso contrario se devolvera el registro especificado
		$sql = 'select * from actividades';
		if($id==FALSE)
		{
			$sql = $sql.' order by id';
			$consulta = $this->db->query($sql);
			return $consulta->result(); 
		}
		else
		{
			$sql = $sql.' where id = '.$id;
			$consulta = $this->db->query($sql);
			return $consulta->row();
		}
	}
	
	public function get2($id=FALSE)
	{	
		//En dado caso que no exista id se devolvera la tabla completa, caso contrario se devolvera el registro especificado
		$sql = 'select a.*, b.nombre as lugar, c.nombre as responsable, d.nombre as sede'.
				' from actividades a, lugares b, usuarios c, sedes d'.
				' where a.id_lugar=b.id and a.cedula_usuario=c.cedula and b.id_sedes = d.id';
		if($id==FALSE)
		{
			$sql = $sql.' order by a.id_status_actividad, a.fecha_inicio';
			$consulta = $this->db->query($sql);
			return $consulta->result(); 
		}
		else
		{
			$sql = $sql.' and a.id='.(int)$id;
			$consulta = $this->db->query($sql);
			return $consulta->row();
		}
	}
	
	
	public function buscar($id=FALSE, $id_sede=FALSE, $id_lugar=FALSE,  $fecha_inicio=FALSE, $fecha_final=FALSE, $id_status_actividad=FALSE)
	{
		//En dado caso que no exista id se devolvera la tabla completa, caso contrario se devolvera el registro especificado
		$sql = 'select *  from data_actividades where id > 0 ';
		if($id==FALSE && $id_sede==FALSE &&  $id_lugar==FALSE && $fecha_inicio==FALSE && $fecha_final==FALSE && $id_status_actividad==FALSE)
		{
			$sql = $sql.' order by id desc';
			$consulta = $this->db->query($sql);
			return $consulta->result(); 
		}
			if ($id!=NULL)
			{
				$sql = $sql.' and  id = '.$id;
			}
			
			if ($id_sede!=NULL)
			{
				$sql = $sql.' and  id_sede = '.$id_sede;
			}
			
			if ($id_lugar!=NULL)
			{
				$sql = $sql.' and  id_lugar = '.$id_lugar;
			}
			
			if ($fecha_inicio!=FALSE)
			{
				$fecha_inicio = $this->db->escape($fecha_inicio);
				$sql = $sql.' and  fecha_inicio >= '.$fecha_inicio;
			}
			
			if ($fecha_final!=FALSE)
			{
				$fecha_final = $this->db->escape($fecha_final);
				$sql = $sql.' and  fecha_inicio <= '.$fecha_final;
			}
			
			if ($id_status_actividad!=NULL)
			{
				$sql = $sql.' and  id_status_actividad = '.$id_status_actividad;
			}
			
			$sql.'<br/>';
			$sql = $sql.' order by id desc';
			$consulta = $this->db->query($sql);
			return $consulta->result(); 
		
	}
}
?>
