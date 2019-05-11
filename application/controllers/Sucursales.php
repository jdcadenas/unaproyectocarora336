<?php if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}
class Sucursales extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('Sucursales_model');
	}
	public function index() {
		$data = array('sucursales' => $this->Sucursales_model->getSucursales());
		$this->template->write_view('sidenavs', 'template/default_sidenavs', true);
		$this->template->write_view('navs', 'template/default_topnavs.php', true);
		$this->template->write('title', 'Sucursales <small>listado</small>', true);
		$this->template->write('header', 'Sucursales <small>listado</small>');
		$this->template->write_view('content', 'admin/sucursales/list', $data, true);
		$this->template->render();
	}
	public function view($id) {
		$data = array('sucursal' => $this->sucursales_model->getLinea($id));
		$this->load->view('admin/sucursales/view', $data);
	}
	public function delete($id) {
		$data = array('estado' => '0');
		$this->Sucursales_model->update($id, $data);
		echo "sucursales";
	}
	public function add() {
		$this->template->write_view('sidenavs', 'template/default_sidenavs', true);
		$this->template->write_view('navs', 'template/default_topnavs.php', true);
		$this->template->write('title', 'Sucursales Nuevo', true);
		$this->template->write('header', 'Sucursales');
		$this->template->write_view('content', 'admin/sucursales/add');
		$this->template->render();
	}
	public function store() {
		$nombre = $this->input->post('nombre');
		$ubicacion = $this->input->post('ubicacion');

		$data = array(
			'nombre' => $nombre,
			'ubicacion' => $ubicacion,
		);

		if ($this->Sucursales_model->save($data)) {

			redirect(base_url() . 'sucursales', 'refresh');

		} else {
			$this->session->set_flashdata('error', 'No se pudo guardar la información');

			redirect(base_url() . 'sucursales/add', 'refresh');
		}

	}

	public function update() {
		$id = $this->input->post('id');
		$nombre = $this->input->post('nombre');
		$ubicacion = $this->input->post('ubicacion');
		$this->form_validation->set_rules('nombre', 'Nombre', 'trim|required');
		$data = array(
			'nombre' => $nombre,
			'ubicacion' => $ubicacion,
		);
		$this->form_validation->set_rules('ubicacion', 'Ubicacion', 'trim|required');
		if ($this->form_validation->run() == true) {
			$resp = $this->Sucursales_model->update($id, $data);
			if (!$resp) {
				$this->session->set_flashdata('error', 'No se pudo guardar la información');
				redirect(base_url() . 'sucursales/edit/' . $id);
			} else {
				redirect(base_url() . 'sucursales', 'refresh');
			}
		} else {
			$this->edit($id);
		}
	}
	public function edit($id) {
		$data = array('sucursal' => $this->Sucursales_model->getSucursal($id));
		$this->template->write_view('sidenavs', 'template/default_sidenavs', true);
		$this->template->write_view('navs', 'template/default_topnavs.php', true);
		$this->template->write('title', 'Sucursales  <small>Edición</small>', true);
		$this->template->write('header', 'Sucursales  <small>Edición</small>');
		$this->template->write_view('content', 'admin/sucursales/edit', $data, true);
		$this->template->render();
	}
}
