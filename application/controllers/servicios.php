<?php class Servicios extends CI_Controller{

	function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('general_model');
		$this->load->model('actas_servicios_model');
		$this->load->model('usuario_model');
	//	$this->load->model('evento_model');
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->library('session');
		if($this->session->userdata('logged') != TRUE){
			redirect(base_url().'login');
		}
	}
	
	
	
	/*-------------------------------------------Control y manejos de articulos-------------------------------------------------*/

	public function index()
	{
		$data['sedes'] = $this->general_model->get('sedes');
		$data['gerencias'] = $this->general_model->get('gerencias');
		$data['actas_servicios'] = $this->actas_servicios_model->buscar();
		$this->load->view('template/header');
		$this->load->view('template/menu');
		$this->load->view('administrar/actas_servicios', $data);
		$this->load->view('template/footer');
	}
	
	public function nuevo()
	{
		$data['sedes'] = $this->general_model->get('sedes');
		$data['gerencias'] = $this->general_model->get('gerencias');
		$data['usuarios'] = $this->usuario_model->get();
		$this->load->view('template/header');
		$this->load->view('template/menu');
		$this->load->view('administrar/actas_servicios_nuevo',$data);
		$this->load->view('template/footer');
	}
	
	
	public function edicion($id)
	{
		$data['sedes'] = $this->general_model->get('sedes');
		$data['gerencias'] = $this->general_model->get('gerencias');
		$data['usuarios'] = $this->usuario_model->get();
		$data['actas_servicio_detalles'] = $this->actas_servicios_model->get($id);
		$this->load->view('template/header');
		$this->load->view('template/menu');
		$this->load->view('administrar/actas_servicios_edicion',$data);
		$this->load->view('template/footer');
	}
	
	
	public function get($id=FALSE)
	{
		echo json_encode($this->actas_servicios_model->buscar($id));
	}
	
	public function eliminar($id)
	{
		echo $this->actas_servicios_model->eliminar($id);
	}
	
	public function ultimo()
	{
		echo  $this->actas_servicios_model->ultimo();
	}
	
		
	public function buscar()
	{
		$id_gerencia = $this->input->post('_gerencia');
		$id_sede = $this->input->post('_sede');
		$fecha_inicio = $this->input->post('_fecha_inicio');
		$fecha_final = $this->input->post('_fecha_final');
	
		echo json_encode($this->actas_servicios_model->buscar(FALSE, $id_sede, $id_gerencia,  $fecha_inicio, $fecha_final));
	}
	
	public function agregar()
	{
		$this->form_validation->set_rules('fecha_servicio', 'Fecha Servicio', 'required');
		$this->form_validation->set_rules('realizado_a', 'Realizado a', 'required|max_length[255]');
		$this->form_validation->set_rules('detalle_servicio', 'Detalle Servicio', 'required');
		$this->form_validation->set_rules('gerencia', 'Gerencia', 'required');
		$this->form_validation->set_rules('sede', 'Sede', 'required');
		$this->form_validation->set_rules('cedula', 'Cedula', 'trim|required');
		if($this->form_validation->run())
		{
			//echo 'bandera 1';
			 $fecha_servicio = $this->input->post('fecha_servicio');
			 $realizado_a = $this->input->post('realizado_a');  
			 $detalle_servicio = $this->input->post('detalle_servicio');
			 $id_gerencia = $this->input->post('gerencia');
			 $id_sede = $this->input->post('sede');
			 $cedula_usuario = $this->input->post('cedula');
			echo $this->actas_servicios_model->agregar($fecha_servicio, $realizado_a, $detalle_servicio, $id_gerencia, $id_sede, $cedula_usuario);
		}
		else
			echo '-10';
	}

	public function editar()
	{
		
		$this->form_validation->set_rules('fecha_servicio', 'Fecha Servicio', 'required');
		$this->form_validation->set_rules('realizado_a', 'Realizado a', 'required|max_length[255]');
		$this->form_validation->set_rules('detalle_servicio', 'Detalle Servicio', 'required');
		$this->form_validation->set_rules('gerencia', 'Gerencia', 'required');
		$this->form_validation->set_rules('sede', 'Sede', 'required');
		$this->form_validation->set_rules('cedula', 'Cedula', 'trim|required');
		if($this->form_validation->run())
		{
			//echo 'bandera 1';
			 $id = $this->input->post('id');
			 $fecha_servicio = $this->input->post('fecha_servicio');
			 $realizado_a = $this->input->post('realizado_a');  
			 $detalle_servicio = $this->input->post('detalle_servicio');
			 $id_gerencia = $this->input->post('gerencia');
			 $id_sede = $this->input->post('sede');
			 $cedula_usuario = $this->input->post('cedula');
			echo $this->actas_servicios_model->editar($id,	$fecha_servicio, $realizado_a, $detalle_servicio, $id_gerencia, $id_sede, $cedula_usuario);
		}
		else
			echo '-10';
	}

	
/*------------------------------------------------------------Manejo PDF---------------------------------------------------------------------------------*/
	public function pdf_acta_servicio($id)
{
		$data['actas_servicio_detalles'] = $this->actas_servicios_model->get($id);

		$this->load->library('mpdf');

		$header = $this->load->view('pdf/pdf_header',null,TRUE);
		$html = $this->load->view('pdf/acta_servicio',$data,TRUE);
		$pie = $this->load->view('pdf/pdf_pie',null,TRUE);
		
		$mpdf = new mPDF('utf-8', 'LETTER');//, 0, '', 15, 15, 15, 15, 8, 8);
		$mpdf->SetTopMargin(50);
		$mpdf->SetHTMLHeader($header);
		$mpdf->setHTMLFooter($pie);
		$mpdf->WriteHTML($html);
		$nombre = 'inscripcion10k5k_'.$id.'.pdf';
		$mpdf->Output($nombre,'I');
	}



/*------------------------------------------------------------Pruebas Modelo---------------------------------------------------------------------------------*/
	public function prueba_ultimo()
	{
		
	}
	
}