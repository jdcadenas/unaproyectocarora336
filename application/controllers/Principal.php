<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * This is Example Controller
 */
class Principal extends CI_Controller {

  public function __construct() {
    parent::__construct();
    if (!$this->session->userdata("login")) {
      redirect(base_url());
    }
  }

  public function index() {
    $this->template->write_view('sidenavs', 'template/default_sidenavs', true);
    $this->template->write_view('navs', 'template/default_topnavs.php', true);
    $this->template->write('title', 'Dashboard', TRUE);
    $this->template->write('header', 'Dashboard');
    $this->template->write_view('content', 'admin/principal', '', true);

    $this->template->render();
  }

}
