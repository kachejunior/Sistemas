<?php

/**
 * Description of administracion_general1
 *
 * @author desarrollo
 * 
 */
class Usuario_model extends CI_Model{
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	
	private function _validar($tabla, $id)
	{
		$sql = 'select count(*) as total from '.$tabla.' where id ='.(int)$id;
		$consulta = $this->db->query($sql);
		if($consulta->row()->total > 0) 
			return true;
		else
			return false;			
	}
	
	public function agregar($cedula, $nombre, $apellido, $telefono, $correo, $clave, 
		$gerencia, $cargo, $nivel_academico, $status_usuario, $grupo_usuario)
	{
		if((!$this->_validar('gerencias', $gerencia)) 
				OR (!$this->_validar('cargos', $cargo)) 
				OR (!$this->_validar('niveles_academicos', $nivel_academico))
				OR (!$this->_validar('status_usuarios', $status_usuario)) 
				OR (!$this->_validar('grupos_usuarios', $grupo_usuario)))
			return -1;
		
		$cedula = $this->db->escape($cedula);
		$nombre = $this->db->escape($nombre);
		$apellido = $this->db->escape($apellido);
		$telefono = $this->db->escape($telefono);
		$correo = $this->db->escape($correo);
		$clave = $this->db->escape(sha1(md5($clave)));
		
		//validamos que no exista otro elemento con el mismo nombre antes de agregarla
		$sql = 'select count(*) as total from usuarios where lower(cedula) = lower('.$cedula.')';
		$query = $this->db->query($sql);
		if ($query->row()->total >0)
			return -2;
		
		//insertamos el elemento en la tabla y retornamos el id con el que se agrego
		$sql = 'insert into usuarios values('.$cedula.','.$nombre.','.$apellido.','.
						$telefono.','.$correo.','.$clave.','.$gerencia.','.$cargo.','.$nivel_academico.
						','.$status_usuario.','.$grupo_usuario.')';
		$this->db->query($sql);
		return $this->db->affected_rows();	
	}

	public function editar($cedula, $nombre, $apellido, $telefono, $correo, $gerencia, $cargo, 
		$nivel_academico, $status_usuario, $grupo_usuario)
	{
		if((!$this->_validar('gerencias', $gerencia)) 
				OR (!$this->_validar('cargos', $cargo)) 
				OR (!$this->_validar('niveles_academicos', $nivel_academico))
				OR (!$this->_validar('status_usuarios', $status_usuario)) 
				OR (!$this->_validar('grupos_usuarios', $grupo_usuario)))
			return -1;
		
		$cedula = $this->db->escape($cedula);
		$nombre = $this->db->escape($nombre);
		$apellido = $this->db->escape($apellido);
		$telefono = $this->db->escape($telefono);
		$correo = $this->db->escape($correo);
		
		//Editamos el elemento en la tabla
		$sql = 'update usuarios set '. 
						'nombre = '.$nombre.', '.
						'apellido = '.$apellido.', '.
						'telefono = '.$telefono.', '.
						'correo = '.$correo.', '.
						'id_gerencia = '.(int)$gerencia.', '.
						'id_cargo = '.(int)$cargo.', '.
						'id_nivel_academico = '.(int)$nivel_academico.', '.
						'id_status_usuario = '.(int)$status_usuario.', '.
						'id_grupo_usuario = '.(int)$grupo_usuario.
						' where cedula = '.$cedula;
		$this->db->query($sql);
		return $this->db->affected_rows();
	}

	public function eliminar($cedula)
	{
		$cedula = $this->db->escape($cedula);
		//Eliminamos el elemento de la tabla
		$sql = 'delete from usuarios where cedula = '.$cedula;
		$this->db->query($sql);
		return $this->db->affected_rows();
	}
	
	public function get($cedula=FALSE)
	{
		//En dado caso que no exista id se devolvera la tabla completa, caso contrario se devolvera el registro especificado
		$sql = 'select cedula,nombre,apellido,telefono,correo,id_gerencia,id_cargo,'.
						'id_nivel_academico,id_status_usuario,id_grupo_usuario from usuarios';
		if($cedula==FALSE)
		{
			$sql = $sql.' order by cedula';
			$consulta = $this->db->query($sql);
			return $consulta->result(); 
		}
		else
		{
			$cedula = $this->db->escape($cedula);
			$sql = $sql.' where cedula = '.$cedula;
			$consulta = $this->db->query($sql);
			return $consulta->row();
		}
	}
	
	public function verificar_clave($cedula,$clave)
	{
		$cedula = $this->db->escape($cedula);
		$clave = $this->db->escape(sha1(md5($clave)));
		
		$sql = 'select cedula,nombre,apellido,telefono,correo,id_gerencia,id_cargo,'.
						'id_nivel_academico,id_status_usuario,id_grupo_usuario from usuarios '.
						'where cedula = '.$cedula.' and clave = '.$clave.' and id_status_usuario = 1';
		$consulta = $this->db->query($sql);
		return $consulta->row();
	}
	
	public function editar_clave($cedula, $clave, $new_clave)
	{
		$cedula = $this->db->escape($cedula);
		$clave = $this->db->escape(sha1(md5($clave)));
		$new_clave = $this->db->escape(sha1(md5($new_clave)));
		
		//Editamos el elemento en la tabla
		$sql = 'update usuarios set '. 
						'clave = '.$new_clave.
						' where cedula = '.$cedula.' and clave = '.$clave;
		$this->db->query($sql);
		return $this->db->affected_rows();
	}

	public function restaurar_clave($cedula)
	{
		$cedula = $this->db->escape($cedula);
		$clave = $this->db->escape(sha1(md5('12345678')));
		
		//Editamos el elemento en la tabla
		$sql = 'update usuarios set '. 
						'clave = '.$clave.
						' where cedula = '.$cedula;
		$this->db->query($sql);
		return $this->db->affected_rows();
	}

}
?>
