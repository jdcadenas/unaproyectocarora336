<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * This is Example Controller
 */
class Auth extends CI_Controller {

  public function __construct() {
    parent::__construct();
    $this->load->model("Empleados_model");
  }

  public function index() {

    if ($this->session->userdata("login")) {
      redirect(base_url() . "principal");
    } else {
      $this->load->view('admin/login');
    }
  }

  public function login() {
    $usuario = $this->input->post('usuario');
    $clave = $this->input->post('clave');
    $res = $this->Empleados_model->login($usuario, sha1($clave));

    if (!$res) {
      redirect(base_url());
    } else {
      $data = array(
          'id' => $res->id_empleado,
          'nombre' => $res->nombre,
          'apellido' => $res->apellido,
          'id_rol' => $res->rol_id,
          'login' => TRUE
      );
      $this->session->set_userdata($data);
      redirect(base_url() . "principal");
    }
  }

  public function logout() {
    $this->session->sess_destroy();
    redirect(base_url());
  }

}
