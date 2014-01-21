<?php class Inventario extends CI_Controller{

	function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('general_model');
		$this->load->model('articulos_model');
		$this->load->model('usuario_model');
	//	$this->load->model('evento_model');
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->library('session');
	}
	
	/*-------------------------------------------Control y manejos de articulos-------------------------------------------------*/
	
	public function index()
	{
		$data['sedes'] = $this->general_model->get('sedes');
		$data['tipos_articulos'] = $this->general_model->get('tipos_articulos');
		$data['articulos'] = $this->articulos_model->buscar();
		$this->load->view('template/header');
		$this->load->view('template/menu');
		$this->load->view('administrar/articulos', $data);
		$this->load->view('template/footer');
	}
	
	public function get($id=FALSE)
	{
		echo json_encode($this->articulos_model->buscar($id));
	}
	
	public function eliminar($id)
	{
		echo $this->articulos_model->eliminar($id);
	}
	
	public function agregar()
	{
		$this->form_validation->set_rules('nombre', 'Nombre', 'trim|required|max_length[100]');
		$this->form_validation->set_rules('sede', 'Sede', 'trim|required');
		$this->form_validation->set_rules('tipo_articulo', 'Tipo de Articulo', 'trim|required');
		$this->form_validation->set_rules('color', 'Color', 'trim|max_length[50]');
		$this->form_validation->set_rules('catidad_disponible', 'Cantidad Disponible', 'trim');
		if($this->form_validation->run())
		{
			//echo 'bandera 1';
			 $nombre = $this->input->post('nombre');
			 $sede = $this->input->post('sede');
			 $tipo_articulo = $this->input->post('tipo_articulo');
			 $color = $this->input->post('color');
			 $cantidad_disponible = $this->input->post('cantidad_disponible');
			 if($cantidad_disponible==NULL)
				 $cantidad_disponible = 0;
			echo $this->articulos_model->agregar($sede, $nombre, $cantidad_disponible, $color, $tipo_articulo);
		}
		else
			echo '-10';
	}
	
	public function buscar()
	{
		$nombre = $this->input->post('_nombre');
		$sede = $this->input->post('_sede');
		$tipo_articulo = $this->input->post('_tipo_articulo');
		$status = $this->input->post('_status');
	
		echo json_encode($this->articulos_model->buscar(NULL, $nombre,  $sede, $tipo_articulo, $status));
	}

/*-------------------------------------------------------------Control de Actas de Entrega------------------------------------------------------------*/
	public function getArticulos()
	{
		$tipo_articulo = $this->input->post('_tipo_articulo');
		echo json_encode($this->articulos_model->buscar(NULL,NULL ,NULL  , $tipo_articulo, NULL ));
	}
	
	public function agregar_acta()
	{
		$id_articulo = $this->input->post('_id_articulo');
		$id_acta_entrega = $this->input->post('id');
		$cantidad = $this->input->post('_cantidad');
		if($this->articulos_model->salida_de_articulo ($id_articulo, $cantidad) > 0)
			echo $this->articulos_model->agregar_articulo($id_acta_entrega, $id_articulo, $cantidad);
		else
			echo -10;
	}
	
	public function actas_entregas ()
	{
		$this->load->view('template/header');
		$this->load->view('template/menu');
		$this->load->view('administrar/actas_entregas');
		$this->load->view('template/footer');
	}
	
	public function actas_entregas_nuevo ()
	{
		$data['sedes'] = $this->general_model->get('sedes');
		$data['gerencias'] = $this->general_model->get('gerencias');
		$data['usuarios'] = $this->usuario_model->get();
		$this->load->view('template/header');
		$this->load->view('template/menu');
		$this->load->view('administrar/actas_entregas_nuevo',$data);
		$this->load->view('template/footer');
	}
	
}