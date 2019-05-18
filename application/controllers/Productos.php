<?php

if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class Productos extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('Productos_model');
		$this->load->model('Lineas_model');
		$this->load->model('Sucursales_model');
		$this->load->model('Almacenes_model');
	}

	public function index($ids = 0) {

		$data = array(
			'ids' => $ids,
			'productos' => $this->Productos_model->getProductos($ids),
			'sucursales' => $this->Sucursales_model->getSucursales(),
		);

		$this->template->write_view('sidenavs', 'template/default_sidenavs', true);
		$this->template->write_view('navs', 'template/default_topnavs.php', true);
		$this->template->write('title', 'Productos', true);
		$this->template->write('header', 'Productos Por Sucursales');
		$this->template->write_view('content', 'admin/productos/list', $data, true);
		$this->template->render();
	}

	public function catalogo($ids = 0) {

		$data = array(
			'ids' => $ids,
			'productos' => $this->Productos_model->getProductos($ids),
			'sucursales' => $this->Sucursales_model->getSucursales(),
		);

		$this->template->write_view('sidenavs', 'template/default_sidenavs', true);
		$this->template->write_view('navs', 'template/default_topnavs.php', true);
		$this->template->write('title', 'Productos', true);

		$this->template->write_view('content', 'admin/productos/catalogo', $data, true);
		$this->template->render();
	}

	public function add($ids) {
		$data = array(
			'ids' => $ids,
			'lineas' => $this->Lineas_model->getLineas(),
			'sucursales' => $this->Sucursales_model->getSucursales(),
		);

		$this->template->write_view('sidenavs', 'template/default_sidenavs', true);
		$this->template->write_view('navs', 'template/default_topnavs.php', true);
		$this->template->write('title', 'Productos', true);
		$this->template->write('header', 'Productos <small> Agregar</small>');
		$this->template->write_view('content', 'admin/productos/add', $data);
		$this->template->render();
	}

	public function view($id) {
		$data = array('producto' => $this->Productos_model->getProducto($id));

		$this->load->view('admin/productos/view', $data);
	}

	public function delete($id) {
		$producto = $this->Productos_model->getProducto($id);
		if (!empty($producto->imagen_producto)) {

			unlink($producto->imagen_producto);
		}
		$data = array('estado' => '0');
		$this->Productos_model->update($id, $data);

		redirect('productos', 'refresh');
	}

	public function update() {
		//recibo datos del formulario
		$id_producto = $this->input->post('id_producto');
		$codigo = $this->input->post('codigo');
		$nombre = $this->input->post('nombre');
		$precio = $this->input->post('precio');
		$cantidad = $this->input->post('cantidad');
		$linea = $this->input->post('linea');
		$sucursal = $this->input->post('sucursal');

//preparo para actualizar tabla productos
		$data = array(
			'codigo' => $codigo,
			'nombre' => $nombre,
			'precio' => $precio,
			'linea' => $linea,
			'estado' => '1',

		);
//actualizo la tabla productos segun id
		$resp = $this->Productos_model->update($id_producto, $data);

		if (!$resp) {

			$this->session->set_flashdata('error', 'No se pudo guardar la información');
			redirect(base_url() . 'productos/edit/' . $id_producto . '/' . $sucursal);

		} else {
			//modifico la cantidad en almacen
			$data1 = array(
				'cantidad' => $cantidad,
			);

			$this->Almacenes_model->update($sucursal, $id_producto, $data1);
//modificar imagen

			redirect(base_url() . 'productos', 'refresh');
		}
	}

	public function store() {
		//recibo datos del formulario de productos de almacen
		$codigo = $this->input->post('codigo');
		$nombre = $this->input->post('nombre');
		$cantidad = $this->input->post('cantidad');
		$precio = $this->input->post('precio');
		$linea = $this->input->post('linea');
		$sucursal = $this->input->post('sucursal');
		$imagen_producto = $this->input->post('imagen_producto');

		//datos para ingresar en tabla productos
		$data = array(
			'codigo' => $codigo,
			'nombre' => $nombre,
			'cantidad' => $cantidad,
			'precio' => $precio,
			'linea' => $linea,
			'imagen_producto' => $imagen_producto,
		);
//registro en tabla productos
		if ($this->Productos_model->save($data)) {
//tomo el id del producto recien insertado
			$idproducto = $this->Productos_model->lastID();
//preparo datos para la tabla almacen
			$data1 = array(
				'sucursal_id' => $sucursal,
				'producto_id' => $idproducto,
				'cantidad' => $cantidad,
			);

			//inserto en tabla almacen este producto

			$this->Almacenes_model->save($data1);

			redirect(base_url() . 'productos', 'refresh');
		} else {

			$this->session->set_flashdata('error', 'No se pudo guardar la información');
			redirect(base_url() . 'productos/add', 'refresh');
		}
	}

	public function edit($id, $id_sucursal) {
		$data = array(
			'producto' => $this->Productos_model->getProducto($id),
			'almacen' => $this->Almacenes_model->getProductoAlmacen($id, $id_sucursal),
			'lineas' => $this->Lineas_model->getLineas(),
			'sucursales' => $this->Sucursales_model->getSucursales(),
		);

		$this->template->write_view('sidenavs', 'template/default_sidenavs', true);
		$this->template->write_view('navs', 'template/default_topnavs.php', true);
		$this->template->write('title', 'Productos  <small>Editar</small>', true);
		$this->template->write('header', 'Productos  <small>Editar</small>');
		$this->template->write_view('content', 'admin/productos/edit', $data);
		$this->template->render();
	}

}
