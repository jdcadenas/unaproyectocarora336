<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Empleados extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Empleados_model');
    }

    public function index()
    {

        $data = array('empleados' => $this->Empleados_model->getEmpleados());

        $this->template->write_view('sidenavs', 'template/default_sidenavs', true);
        $this->template->write_view('navs', 'template/default_topnavs.php', true);
        $this->template->write('title', 'Listado de Empleados', true);
        $this->template->write('header', 'Listado de Empleados');
        $this->template->write_view('content', 'admin/empleados/list', $data, true);
        $this->template->render();
    }

    public function add()
    {

        $this->template->write_view('sidenavs', 'template/default_sidenavs', true);
        $this->template->write_view('navs', 'template/default_topnavs.php', true);
        $this->template->write('title', 'Agregar Empleados', true);
        $this->template->write('header', 'Agregar Empleados');
        $this->template->write_view('content', 'admin/empleados/add');
        $this->template->render();
    }

    public function view($id)
    {
        $data = array('empleado' => $this->Empleados_model->getEmpleado($id));

        $this->load->view('admin/empleados/view', $data);
    }

    public function delete($id)
    {
        $data = array('estado' => '0');
        $this->Empleados_model->update($id, $data);
        echo "empleados";
    }

    public function update()
    {
        $id_empleado = $this->input->post('id_empleado');
        $cedula      = $this->input->post('cedula');
        $nombre      = $this->input->post('nombre');
        $apellido    = $this->input->post('apellido');
        $telefono    = $this->input->post('telefono');
        $correo      = $this->input->post('correo');
        $usuario     = $this->input->post('usuario');
        $clave       = $this->input->post('clave');
        $data        = array('cedula' => $cedula,
            'nombre'                      => $nombre,
            'apellido'                    => $apellido,
            'telefono'                    => $telefono,
            'correo'                      => $correo,
            'usuario'                     => $usuario,
            'clave'                       => $clave,
            'estado'                      => '1',
            'rol_id'                      => '4',
        );

        $resp = $this->Empleados_model->update($id_empleado, $data);
        if (!$resp) {
            log_message($this->Empleados_model->update($id_empleado, $data));
            $this->session->set_flashdata('error', 'No se pudo guardar la información');
            redirect(base_url() . 'empleados/edit/' . $id_empleado);

        } else {
            redirect(base_url() . 'empleados', 'refresh');
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

            redirect(base_url() . 'empleados', 'refresh');
        } else {

            $this->session->set_flashdata('error', 'No se pudo guardar la información');
            redirect(base_url() . 'empleados/add', 'refresh');
        }
    }

    public function edit($id)
    {
        $data = array('empleado' => $this->Empleados_model->getEmpleado($id));

        $this->template->write_view('sidenavs', 'template/default_sidenavs', true);
        $this->template->write_view('navs', 'template/default_topnavs.php', true);
        $this->template->write('title', 'Empleados  <small>Edición</small>', true);
        $this->template->write('header', 'Empleados  <small>Edición</small>');
        $this->template->write_view('content', 'admin/empleados/edit', $data, true);
        $this->template->render();
    }

}
