<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Lineas extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Lineas_model');
    }

    public function index()
    {

        $data = array('lineas' => $this->Lineas_model->getLineas());

        $this->template->write_view('sidenavs', 'template/default_sidenavs', true);
        $this->template->write_view('navs', 'template/default_topnavs.php', true);
        $this->template->write('title', 'Lineas de Productos', true);
        $this->template->write('header', 'Lineas de Productos');
        $this->template->write_view('content', 'admin/lineas/list', $data, true);

        $this->template->render();

    }

    public function view($id)
    {
        $data = array('linea' => $this->lineas_model->getLinea($id));

        $this->load->view('admin/lineas/view', $data);
    }
    public function delete($id)
    {
        $data = array('estado' => '0');
        $this->Lineas_model->update($id, $data);
        echo "lineas";
    }

    public function add()
    {
        $this->template->write_view('sidenavs', 'template/default_sidenavs', true);
        $this->template->write_view('navs', 'template/default_topnavs.php', true);
        $this->template->write('title', 'Linea Agregar', true);
        $this->template->write('header', 'Lineas <small>Agregar</small>');
        $this->template->write_view('content', 'admin/lineas/add');

        $this->template->render();

    }

    public function store()
    {
        $nombre_linea = $this->input->post('nombre_linea');
        $data         = array('nombre_linea' => $nombre_linea);

        if ($this->form_validation->run() == true) {
            if ($this->Lineas_model->save($data)) {

                redirect(base_url() . 'lineas', 'refresh');
            } else {

                $this->session->set_flashdata('error', 'No se pudo guardar la información');
                redirect(base_url() . 'lineas/add', 'refresh');
            }
        } else {
            $this->add();
        }

    }
    public function update()
    {
        $id_linea     = $this->input->post('id_linea');
        $nombre_linea = $this->input->post('nombre_linea');
        $this->form_validation->set_rules('nombre_linea', 'Linea', 'trim|required|is_unique[Lineas.nombre_linea]');
        $data = array(
            'nombre_linea' => $nombre_linea,

        );

        $this->form_validation->set_rules('nombre_linea', 'Linea', 'trim|required|is_unique[Lineas.nombre_linea]');

        if ($this->form_validation->run() == true) {
            $resp = $this->Lineas_model->update($id_linea, $data);

            if (!$resp) {

                $this->session->set_flashdata('error', 'No se pudo guardar la información');
                redirect(base_url() . 'lineas/edit/' . $id_linea);

            } else {
                redirect(base_url() . 'lineas', 'refresh');
            }
        } else {
            $this->edit($id_linea);
        }

    }
    public function edit($id)
    {
        $data = array('linea' => $this->Lineas_model->getLinea($id));

        $this->template->write_view('sidenavs', 'template/default_sidenavs', true);
        $this->template->write_view('navs', 'template/default_topnavs.php', true);
        $this->template->write('title', 'Lineas  <small>Edición</small>', true);
        $this->template->write('header', 'Lineas  <small>Edición</small>');
        $this->template->write_view('content', 'admin/lineas/edit', $data, true);
        $this->template->render();
    }

}
