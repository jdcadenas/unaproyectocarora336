<?php

defined('BASEPATH') or exit('No direct script access allowed');

/**
 * This is Example Controller
 */
class Principal extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Backend_model');
        if (!$this->session->userdata("login")) {
            redirect(base_url());
        }

        $this->load->model('Ventas_model');
    }

    public function index()
    {
        $data = array(
            'cantVentas'     => $this->Backend_model->cuentaFilas("ventas"),
            'cantSucursales' => $this->Backend_model->cuentaFilas("sucursales"),
            'cantEmpleados'  => $this->Backend_model->cuentaFilas("empleados"),
            'cantProductos'  => $this->Backend_model->cuentaFilas("productos"),
            'years'          => $this->Ventas_model->years(),
        );

        $this->template->write_view('sidenavs', 'template/default_sidenavs', true);
        $this->template->write_view('navs', 'template/default_topnavs.php', true);
        $this->template->write('title', 'Dashboard', true);
        $this->template->write('header', 'Dashboard');
        $this->template->write_view('content', 'admin/principal', $data, true);

        $this->template->render();
    }

    public function getData()
    {
        $year       = $this->input->post("year");
        $resultados = $this->Ventas_model->montos($year);
        echo json_encode($resultados);

    }

}
