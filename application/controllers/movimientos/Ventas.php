<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Ventas extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Empleados_model');
        $this->load->model('Ventas_model');

    }

    public function index()
    {

        // $data = array('ventas' => $this->Ventas_model->getVentas());

        $this->template->write_view('sidenavs', 'template/default_sidenavs', true);
        $this->template->write_view('navs', 'template/default_topnavs.php', true);
        $this->template->write('title', 'Ventas', true);
        $this->template->write('header', 'Ventas');
        $this->template->write_view('content', 'admin/ventas/list');
        $this->template->render();
    }

    public function add()
    {
        $data = array('empleados' => $this->Empleados_model->getEmpleados());

        $this->template->write_view('sidenavs', 'template/default_sidenavs', true);
        $this->template->write_view('navs', 'template/default_topnavs.php', true);
        $this->template->write('title', 'Ventas', true);
        $this->template->write('header', 'Ventas <small> Agregar</small>');
        $this->template->write_view('content', 'admin/ventas/add', $data);
        $this->template->render();
    }

    public function getproductos()
    {
        $valor     = $this->input->post("valor");
        $empleados = $this->Ventas_model->getproductos($valor);

        echo json_encode($empleados);
    }

    public function prueba()
    {
        $data = array('empleados' => $this->Ventas_model->getproductos("pint"));

        $this->template->write_view('content', 'prueba', $data);
        $this->template->render();

    }

}
