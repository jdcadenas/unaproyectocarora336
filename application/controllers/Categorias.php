<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Categorias extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Categorias_model');
	}

	public function index()
	{

		$data = array('lineas' => $this->Categorias_model->getCategorias() );
		
	 $this->template->write_view('sidenavs', 'template/default_sidenavs', true);
    $this->template->write_view('navs', 'template/default_topnavs.php', true);
     $this->template->write('title', 'Listado de Categorias', TRUE);
    $this->template->write('header', 'Listado de Categorias');
    $this->template->write_view('content', 'admin/categorias/list', $data, true);

    $this->template->render();
		
	}

	public function view($id){
		$data = array('linea' => $this->Categorias_model->getCategoria($id) );

		$this->load->view('admin/categorias/view', $data);
	}
	public function delete($id)
	{
		$data = array('estado' => '0' );
		$this->Categorias_model->update($id,$data);
		echo "categorias";
	}

}

