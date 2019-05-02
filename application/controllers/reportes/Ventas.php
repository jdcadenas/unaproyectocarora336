<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Ventas extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Ventas_model');
    }

    public function index()
    {
        $fechainicio = $this->input->post('fechainicio');
        $fechafin    = $this->input->post('fechafin');
        if ($this->input->post('buscar')) {
            $ventas = $this->Ventas_model->getVentasByDate($fechainicio, $fechafin);
        } else {
            $ventas = $this->Ventas_model->getventas();
        }

        $data = array(
            'ventas'      => $ventas,
            'fechainicio' => $fechainicio,
            'fechafin'    => $fechafin,

        );
        $this->template->write_view('sidenavs', 'template/default_sidenavs', true);
        $this->template->write_view('navs', 'template/default_topnavs.php', true);
        $this->template->write('title', 'Reporte Ventas', true);
        $this->template->write('header', 'Reporte Ventas');
        $this->template->write_view('content', 'admin/reportes/ventas', $data);
        $this->template->render();
    }

}

/* End of file Ventas.php */
/* Location: ./application/controllers/Ventas.php */
