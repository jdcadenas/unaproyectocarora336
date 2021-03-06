<?php if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class Ventas extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('Ventas_model');
		$this->load->model('Empleados_model');
		$this->load->model('Productos_model');
		$this->load->model('Sucursales_model');

	}

	public function index() {
		$fechainicio = $this->input->post('fechainicio');
		$fechafin = $this->input->post('fechafin');
		if ($this->input->post('buscar')) {
			$ventas = $this->Ventas_model->getVentasByDate($fechainicio, $fechafin);
		} else {
			$ventas = $this->Ventas_model->getventas();
		}

		$data = array(
			'ventas' => $ventas,
			'fechainicio' => $fechainicio,
			'fechafin' => $fechafin,

		);
		$this->template->write_view('sidenavs', 'template/default_sidenavs', true);
		$this->template->write_view('navs', 'template/default_topnavs.php', true);
		$this->template->write('title', 'Reporte Ventas', true);
		$this->template->write('header', 'Reporte Ventas');
		$this->template->write_view('content', 'admin/reportes/ventas', $data);
		$this->template->render();
	}
	public function vendedor($ide = 0) {

		$vendedor = $this->input->post('repovendedorselect');
		$fechainicio = $this->input->post('fechainicio');
		$fechafin = $this->input->post('fechafin');
		if ($this->input->post('buscar')) {
			$ventas = $this->Ventas_model->getVentasByDateVendedor($fechainicio, $fechafin, $vendedor);

		} else {
			$ventas = $this->Ventas_model->getventas();
		}
		$ide = $vendedor;
		$data = array(
			'ide' => $ide,
			'ventas' => $ventas,
			'fechainicio' => $fechainicio,
			'fechafin' => $fechafin,

			'vendedores' => $this->Empleados_model->getEmpleadosVendedores(),

		);

		$this->template->write_view('sidenavs', 'template/default_sidenavs', true);
		$this->template->write_view('navs', 'template/default_topnavs.php', true);
		$this->template->write('title', 'Reporte Ventas', true);
		$this->template->write('header', 'Reporte Ventas');
		$this->template->write_view('content', 'admin/reportes/vendedor', $data);
		$this->template->render();
	}

	public function sucursal() {
		$fechainicio = $this->input->post('fechainicio');
		$fechafin = $this->input->post('fechafin');
		if ($this->input->post('buscar')) {
			$ventas = $this->Ventas_model->getVentasByDate($fechainicio, $fechafin);
		} else {
			$ventas = $this->Ventas_model->getventas();
		}

		$data = array(
			'ventas' => $ventas,
			'fechainicio' => $fechainicio,
			'fechafin' => $fechafin,

		);
		$this->template->write_view('sidenavs', 'template/default_sidenavs', true);
		$this->template->write_view('navs', 'template/default_topnavs.php', true);
		$this->template->write('title', 'Reporte Ventas', true);
		$this->template->write('header', 'Reporte Ventas');
		$this->template->write_view('content', 'admin/reportes/sucursal', $data);
		$this->template->render();
	}
	public function productos() {
//reporte historico de productos
		$fechainicio = $this->input->post('fechainicio');
		$fechafin = $this->input->post('fechafin');
		$sucursal = $this->input->post('sucursalproductos');
		$producto = $this->input->post('productoselect');
		$vendedor = $this->input->post('repovendedorselect');

		if ($this->input->post('buscar')) {

			$ventas = $this->Ventas_model->getProductosHistorico($fechainicio, $fechafin, $sucursal, $producto, $vendedor);
		} else {
			$ventas = $this->Ventas_model->getventas();
		}

		$data = array(
			'ids' => $sucursal,
			'idp' => $producto,
			'ide' => $vendedor,

			'ventas' => $ventas,
			'fechainicio' => $fechainicio,
			'fechafin' => $fechafin,
			'vendedores' => $this->Empleados_model->getEmpleadosVendedores(),
			'sucursales' => $this->Sucursales_model->getSucursales(),
			'productos' => $this->Productos_model->getProductos(),

		);
		$this->template->write_view('sidenavs', 'template/default_sidenavs', true);
		$this->template->write_view('navs', 'template/default_topnavs.php', true);
		$this->template->write('title', 'Reporte Ventas', true);
		$this->template->write('header', 'Reporte Ventas');
		$this->template->write_view('content', 'admin/reportes/productos', $data);
		$this->template->render();
	}

}

/* End of file Ventas.php */
/* Location: ./application/controllers/Ventas.php */
