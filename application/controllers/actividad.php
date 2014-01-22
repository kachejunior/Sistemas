<?php

/**
 * Description of administracion1
 *
 * @author desarrollo
 */
class Actividad extends CI_Controller{
	function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('general_model');
		$this->load->model('usuario_model');
		$this->load->model('lugar_model');
		$this->load->model('actividad_model');
		$this->load->library('session');
	}

	public function index()
	{
		$data["usuario"] = $this->usuario_model->get();
		$data["lista"] = $this->actividad_model->get2();
		$data["lugar"] = $this->lugar_model->get2();
		$data["status_actividad"] = $this->general_model->get('status_actividades');
		$this->load->view('template/header');
		$this->load->view('template/menu');
		$this->load->view('administrar/actividad',$data);
		$this->load->view('template/footer');
	}
		
	public function get($id=FALSE)
	{
		echo json_encode($this->actividad_model->get($id));
	}
	
	public function get2($id=FALSE)
	{
		echo json_encode($this->actividad_model->get2($id));
	}
	
	public function eliminar($id)
	{
		echo $this->actividad_model->eliminar($id);
	}
	
	public function agregar()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('nombre', 'Nombre', 'trim|required|max_length[100]');
		$this->form_validation->set_rules('fecha_inicio', 'Fecha Inicio', 'trim|required');
		$this->form_validation->set_rules('fecha_final', 'Fecha Final', 'trim|required');
		$this->form_validation->set_rules('hora_inicio', 'Hora Final', 'trim|required');
		$this->form_validation->set_rules('hora_final', 'Hora Final', 'trim|required');
		$this->form_validation->set_rules('cedula_usuario', 'Cedula Responsable', 'trim|required|max_length[15]');
		$this->form_validation->set_rules('id_lugar', 'Lugar', 'trim|required|integer');
		$this->form_validation->set_rules('id_status_actividad', 'Estatus', 'trim|required|integer');
		if($this->form_validation->run())
		{
			
			 $nombre = $this->input->post('nombre');
			 $fecha_inicio = $this->input->post('fecha_inicio');
			 $fecha_final = $this->input->post('fecha_final');
			 $hora_inicio = $this->input->post('hora_inicio');
			 $hora_final = $this->input->post('hora_final');
			 $cedula_usuario = $this->input->post('cedula_usuario');
			 $id_lugar = $this->input->post('id_lugar');
			 $id_status_actividad = $this->input->post('id_status_actividad');
			echo $this->actividad_model->agregar($nombre, $fecha_inicio, $fecha_final, $hora_inicio, $hora_final, $cedula_usuario, 
		$id_lugar, $id_status_actividad);
		}
		else
			echo '-1';
	}
	
	public function editar()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('nombre', 'Nombre', 'trim|required|max_length[100]');
		$this->form_validation->set_rules('fecha_inicio', 'Fecha Inicio', 'trim|required');
		$this->form_validation->set_rules('fecha_final', 'Fecha Final', 'trim|required');
		$this->form_validation->set_rules('hora_inicio', 'Hora Final', 'trim|required');
		$this->form_validation->set_rules('hora_final', 'Hora Final', 'trim|required');
		$this->form_validation->set_rules('cedula_usuario', 'Cedula Responsable', 'trim|required|max_length[15]');
		$this->form_validation->set_rules('id_lugar', 'Lugar', 'trim|required|integer');
		$this->form_validation->set_rules('id_status_actividad', 'Estatus', 'trim|required|integer');
		if($this->form_validation->run())
		{
			
			 $id = $this->input->post('id');
			 $nombre = $this->input->post('nombre');
			 $fecha_inicio = $this->input->post('fecha_inicio');
			 $fecha_final = $this->input->post('fecha_final');
			 $hora_inicio = $this->input->post('hora_inicio');
			 $hora_final = $this->input->post('hora_final');
			 $cedula_usuario = $this->input->post('cedula_usuario');
			 $id_lugar = $this->input->post('id_lugar');
			 $id_status_actividad = $this->input->post('id_status_actividad');
			echo $this->actividad_model->editar($id, $nombre, $fecha_inicio, $fecha_final, $hora_inicio, $hora_final, $cedula_usuario, 
		$id_lugar, $id_status_actividad);
		}
		else
			echo '-1';
	}
}

?>
