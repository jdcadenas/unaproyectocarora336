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

        $this->template->write_view('sidenavs', 'template/default_sidenavs', true);
        $this->template->write_view('navs', 'template/default_topnavs.php', true);
        $this->template->write('title', 'Productos', true);
        $this->template->write('header', 'Productos <small> Agregar</small>');
        $this->template->write_view('content', 'admin/productos/add');
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
        $cedula   = $this->input->post('cedula');
        $nombre   = $this->input->post('nombre');
        $apellido = $this->input->post('apellido');
        $telefono = $this->input->post('telefono');
        $correo   = $this->input->post('correo');
        $usuario  = $this->input->post('usuario');
        $clave    = $this->input->post('clave');

        $data = array('cedula' => $cedula,
            'nombre'               => $nombre,
            'apellido'             => $apellido,
            'telefono'             => $telefono,
            'correo'               => $correo,
            'usuario'              => $usuario,
            'clave'                => $clave,
            'estado'               => '1',
            'rol_id'               => '4',
        );

        if ($this->Empleados_model->save($data)) {

            redirect(base_url() . 'productos', 'refresh');
        } else {

            $this->session->set_flashdata('error', 'No se pudo guardar la información');
            redirect(base_url() . 'productos/add', 'refresh');
        }
    }

    public function edit($id)
    {
        $data = array('producto' => $this->Productos_model->getProducto($id));

        $this->template->write_view('sidenavs', 'template/default_sidenavs', true);
        $this->template->write_view('navs', 'template/default_topnavs.php', true);
        $this->template->write('title', 'Productos  <small>Edición</small>', true);
        $this->template->write('header', 'Productos  <small>Edición</small>');
        $this->template->write_view('content', 'admin/productos/edit', $data, true);
        $this->template->render();
    }

}
