<?php

class Salidas extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('general_model');
		$this->load->model('articulos_model');
		$this->load->model('actas_salidas_model');
		$this->load->model('usuario_model');
		//	$this->load->model('evento_model');
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->library('session');
		if ($this->session->userdata('logged') != TRUE) {
			redirect(base_url() . 'login');
		}
	}

	/* -------------------------------------------Control y manejos de Actas Entregas------------------------------------------------- */

	public function index() {
		$data['sedes'] = $this->general_model->get('sedes');
		$data['gerencias'] = $this->general_model->get('gerencias');
		$data['actas_salidas'] = $this->actas_salidas_model->buscar();
		$this->load->view('template/header');
		$this->load->view('template/menu');
		$this->load->view('administrar/actas_salidas', $data);
		$this->load->view('template/footer');
	}

	public function nuevo() {
		$data['sedes'] = $this->general_model->get('sedes');
		$data['usuarios'] = $this->usuario_model->get();
		$this->load->view('template/header');
		$this->load->view('template/menu');
		$this->load->view('administrar/actas_salidas_nuevo', $data);
		$this->load->view('template/footer');
		//Hola como estas
	}

	public function edicion($id) {
		$data['sedes'] = $this->general_model->get('sedes');
		$data['usuarios'] = $this->usuario_model->get();
		$data['actas_salidas_detalles'] = $this->actas_salidas_model->get($id);
//		$data['lista_articulo'] = $this->actas_salidas_model->ver_articulos ($id);

		$this->load->view('template/header');
		$this->load->view('template/menu');
		$this->load->view('administrar/actas_salidas_edicion', $data);
		$this->load->view('template/footer');
	}

	public function get($id = FALSE) {
		echo json_encode($this->actas_salidas_model->buscar($id));
	}

	public function eliminar($id) {
		echo $this->actas_salidas_model->eliminar($id);
	}

	public function ultimo() {
		echo $this->actas_salidas_model->ultimo();
	}

	public function agregar() {
		$this->form_validation->set_rules('fecha_entrega', 'Fecha Entrega', 'required');
		$this->form_validation->set_rules('entregado_a', 'Entrgado a', 'required');
//		$this->form_validation->set_rules('detalle_entrega', 'Nota de Entrega', 'required');
		$this->form_validation->set_rules('nombre_compannia', 'Nombre Compañia', 'required');
		$this->form_validation->set_rules('sede', 'Sede', 'required');
		$this->form_validation->set_rules('cedula', 'Cedula', 'trim|required');
		if ($this->form_validation->run()) {
			//echo 'bandera 1';
			$fecha_entrega = $this->input->post('fecha_entrega');
			$entregado_a = $this->input->post('entregado_a');
			$nota = $this->input->post('detalle_entrega');
			$nombre_compannia = $this->input->post('nombre_compannia');
			$id_sede = $this->input->post('sede');
			$cedula_usuario = $this->input->post('cedula');
			echo $this->actas_salidas_model->agregar($fecha_entrega, $entregado_a, $nota, $nombre_compannia, $id_sede, $cedula_usuario);
		} else
			echo '-10';
	}

	public function buscar() {
		$id_gerencia = $this->input->post('_gerencia');
		$id_sede = $this->input->post('_sede');
		$fecha_inicio = $this->input->post('_fecha_inicio');
		$fecha_final = $this->input->post('_fecha_final');

		echo json_encode($this->actas_salidas_model->buscar(FALSE, $id_sede, $id_gerencia, $fecha_inicio, $fecha_final));
	}

	public function editar() {
		$this->form_validation->set_rules('fecha_entrega', 'Fecha Entrega', 'required');
		$this->form_validation->set_rules('entregado_a', 'Entrgado a', 'required');
//		$this->form_validation->set_rules('detalle_entrega', 'Nota de Entrega', 'required');
		$this->form_validation->set_rules('nombre_compannia', 'Nombre Compañia', 'required');
		$this->form_validation->set_rules('sede', 'Sede', 'required');
		$this->form_validation->set_rules('cedula', 'Cedula', 'trim|required');
		if ($this->form_validation->run()) {
//			echo 'bandera 1';
			$id = $this->input->post('id');
			$fecha_entrega = $this->input->post('fecha_entrega');
			$entregado_a = $this->input->post('entregado_a');
			$nota = $this->input->post('detalle_entrega');
			$nombre_compannia = $this->input->post('nombre_compannia');
			$id_sede = $this->input->post('sede');
			$cedula_usuario = $this->input->post('cedula');
			echo $this->actas_salidas_model->editar($id, $fecha_entrega, $entregado_a, $nota, $nombre_compannia, $id_sede, $cedula_usuario);
		} else
			echo '-10';
	}

	/* ------------------------------------------------------------Manejo PDF--------------------------------------------------------------------------------- */

	public function pdf_acta_entrega($id) {
		$data['actas_salidas_detalles'] = $this->actas_salidas_model->get($id);
		$data['lista_articulo'] = $this->actas_salidas_model->ver_articulos($id);

		$this->load->library('mpdf');

		$header = $this->load->view('pdf/pdf_header', null, TRUE);
		$html = $this->load->view('pdf/salidas', $data, TRUE);
		$pie = $this->load->view('pdf/pdf_pie', null, TRUE);

		$mpdf = new mPDF('utf-8', 'LETTER'); //, 0, '', 15, 15, 15, 15, 8, 8);
		$mpdf->SetTopMargin(40);

		//SALTO DE PAGINA AUTOMATICO, INCLUYE DETECCION DE CABECERA DE TABLAS
		$mpdf->SetAutoPageBreak(true, 50);

		$mpdf->SetHTMLHeader($header);
		$mpdf->setHTMLFooter($pie);
		$mpdf->WriteHTML($html);
		$nombre = 'Acta_entrega' . $id . '.pdf';
		$mpdf->Output($nombre, 'I');
	}

	/* ------------------------------------------------------------Pruebas Modelo--------------------------------------------------------------------------------- */

	public function lista_articulos() {
		$id = $this->input->post('id');
		echo json_encode($this->actas_salidas_model->ver_articulos($id));
//		echo $this->actas_salidas_model->agregar_articulo (3, 32, 1);
//		echo $this->actas_salidas_model->agregar_articulo (3, 33, 1);
	}

}
