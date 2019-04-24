<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Empleados extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Empleados_model');
	}

	public function index()
	{

		$data = array('empleados' => $this->Empleados_model->getEmpleados() );
		
	 $this->template->write_view('sidenavs', 'template/default_sidenavs', true);
    $this->template->write_view('navs', 'template/default_topnavs.php', true);
     $this->template->write('title', 'Listado de Empleados', TRUE);
    $this->template->write('header', 'Listado de Empleados');
    $this->template->write_view('content', 'admin/empleados/list', $data, true);

    $this->template->render();
		
	}

	public function view($id){
		$data = array('empleado' => $this->Empleados_model->getEmpleado($id) );

		$this->load->view('admin/empleados/view', $data);
	}
	public function delete($id)
	{
		$data = array('estado' => '0' );
		$this->Empleados_model->update($id,$data);
		echo "empleados";
	}

}

