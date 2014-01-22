<?php

/**
 * Description of administracion1
 *
 * @author desarrollo
 */
class Lugar extends CI_Controller{
	function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('general_model');
		$this->load->model('lugar_model');
		$this->load->library('session');
	}

	public function index()
	{
		$data["sede"] = $this->general_model->get('sedes');
		$data["lista"] = $this->lugar_model->get2();
		$this->load->view('template/header');
		$this->load->view('template/menu');
		$this->load->view('administrar/lugar',$data);
		$this->load->view('template/footer');
	}
		
	public function get($id=FALSE)
	{
		echo json_encode($this->lugar_model->get($id));
	}
	
	public function get2($id=FALSE)
	{
		echo json_encode($this->lugar_model->get2($id));
	}
	
	public function eliminar($id)
	{
		echo $this->lugar_model->eliminar($id);
	}
	
	public function agregar()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('nombre', 'Nombre', 'trim|required|max_length[100]');
		$this->form_validation->set_rules('sede', 'Sede', 'trim|required|integer');
		if($this->form_validation->run())
		{
			
			 $nombre = $this->input->post('nombre');
			 $sede = $this->input->post('sede');
			echo $this->lugar_model->agregar($nombre,$sede);
		}
		else
			echo '-1';
	}
	
	public function editar()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('id', 'Id', 'trim|required|integer');
		$this->form_validation->set_rules('nombre', 'Nombre', 'trim|required|max_length[100]');
		$this->form_validation->set_rules('sede', 'Sede', 'trim|required|integer');
		if($this->form_validation->run())
		{
			$id = $this->input->post('id');
			$nombre = $this->input->post('nombre');
			$sede = $this->input->post('sede');
			echo $this->lugar_model->editar($id,$nombre,$sede);
		}
		else
			echo '-1';
	}
}

?>
