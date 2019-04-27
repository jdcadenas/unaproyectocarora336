<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Productos extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Productos_model');
        $this->load->model('Lineas_model');
    }

    public function index()
    {

        $data = array('productos' => $this->Productos_model->getProductos());

        $this->template->write_view('sidenavs', 'template/default_sidenavs', true);
        $this->template->write_view('navs', 'template/default_topnavs.php', true);
        $this->template->write('title', 'Productos', true);
        $this->template->write('header', 'Productos');
        $this->template->write_view('content', 'admin/productos/list', $data, true);
        $this->template->render();
    }

    public function add()
    {
        $data = array('lineas' => $this->Lineas_model->getLineas());
        $this->template->write_view('sidenavs', 'template/default_sidenavs', true);
        $this->template->write_view('navs', 'template/default_topnavs.php', true);
        $this->template->write('title', 'Productos', true);
        $this->template->write('header', 'Productos <small> Agregar</small>');
        $this->template->write_view('content', 'admin/productos/add', $data);
        $this->template->render();
    }

    public function view($id)
    {
        $data = array('producto' => $this->Productos_model->getProducto($id));

        $this->load->view('admin/productos/view', $data);
    }

    public function delete($id)
    {
        $data = array('estado' => '0');
        $this->Productos_model->update($id, $data);
        echo "productos";
    }

    public function update()
    {
        $id_producto = $this->input->post('id_producto');
        $codigo      = $this->input->post('codigo');
        $nombre      = $this->input->post('nombre');
        $precio      = $this->input->post('precio');
        $cantidad    = $this->input->post('cantidad');
        $linea       = $this->input->post('linea');

        $data = array('codigo' => $codigo,
            'nombre'               => $nombre,
            'precio'               => $precio,
            'cantidad'             => $cantidad,
            'linea'                => $linea,

            'estado'               => '1',

        );

        $resp = $this->Productos_model->update($id_producto, $data);
        if (!$resp) {

            $this->session->set_flashdata('error', 'No se pudo guardar la información');
            redirect(base_url() . 'productos/edit/' . $id_producto);

        } else {
            redirect(base_url() . 'productos', 'refresh');
        }
    }

    public function store()
    {
        $codigo   = $this->input->post('codigo');
        $nombre   = $this->input->post('nombre');
        $cantidad = $this->input->post('cantidad');
        $precio   = $this->input->post('precio');
        $linea    = $this->input->post('linea');

        $data = array('codigo' => $codigo,
            'nombre'               => $nombre,
            'cantidad'             => $cantidad,
            'precio'               => $precio,
            'linea'                => $linea,
        );

        if ($this->Productos_model->save($data)) {

            redirect(base_url() . 'productos', 'refresh');
        } else {

            $this->session->set_flashdata('error', 'No se pudo guardar la información');
            redirect(base_url() . 'productos/add', 'refresh');
        }
    }

    public function edit($id)
    {
        $data = array(
            'producto' => $this->Productos_model->getProducto($id),
            'lineas'   => $this->Categorias_model->getCategorias(),
        );

        $this->template->write_view('sidenavs', 'template/default_sidenavs', true);
        $this->template->write_view('navs', 'template/default_topnavs.php', true);
        $this->template->write('title', 'Productos  <small>Editar</small>', true);
        $this->template->write('header', 'Productos  <small>Editar</small>');
        $this->template->write_view('content', 'admin/productos/edit', $data, true);
        $this->template->render();
    }

}
