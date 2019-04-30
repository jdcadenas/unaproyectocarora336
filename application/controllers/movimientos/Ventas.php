<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Ventas extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Empleados_model');
        $this->load->model('Ventas_model');
        $this->load->model('Productos_model');
    }

    public function index()
    {

        $data = array('ventas' => $this->Ventas_model->getVentas());

        $this->template->write_view('sidenavs', 'template/default_sidenavs', true);
        $this->template->write_view('navs', 'template/default_topnavs.php', true);
        $this->template->write('title', 'Ventas', true);
        $this->template->write('header', 'Ventas');
        $this->template->write_view('content', 'admin/ventas/list', $data);

        $this->template->render();
    }

    public function add()
    {
        $data = array('empleados' => $this->Empleados_model->getEmpleados(),
            'ultimaVenta'             => $this->Ventas_model->lastID());

        $this->template->write_view('sidenavs', 'template/default_sidenavs', true);
        $this->template->write_view('navs', 'template/default_topnavs.php', true);
        $this->template->write('title', 'Ventas', true);
        $this->template->write('header', 'Ventas <small> Agregar</small>');
        $this->template->write_view('content', 'admin/ventas/add', $data);
        $this->template->render();
    }

    public function getproductos()
    {
        $valor     = $this->input->post("valor");
        $empleados = $this->Ventas_model->getproductos($valor);

        echo json_encode($empleados);
    }

    public function store()
    {

        $fecha_venta = $this->input->post('fecha_venta');
        $total       = $this->input->post('total');
        $id_empleado = $this->input->post('id_empleado');

        $idproductos = $this->input->post('idproductos');
        $precios     = $this->input->post('precios');
        $cantidades  = $this->input->post('cantidades');

        $data = array(
            'fecha_venta' => $fecha_venta,
            'total'       => $total,
            'empleado_id' => $id_empleado,

        );

        if ($this->Ventas_model->save($data)) {

            $idventa = $this->Ventas_model->lastID();

            $this->save_detalle($idproductos, $idventa, $precios, $cantidades);
            redirect(base_url() . 'movimientos/ventas');
        } else {
            redirect(base_url() . 'movimiento/ventas/add');
        }

    }

    public function save_detalle($productos, $idventa, $precios, $cantidades)
    {
        for ($i = 0; $i < count($productos); $i++) {
            $data = array(
                'producto_id'  => $productos[$i],
                'venta_id'     => $idventa,
                'precio_venta' => $precios[$i],
                'cantidad'     => $cantidades[$i],

            );

            $this->Ventas_model->save_detalles($data);
            $this->updateProducto($productos[$i], $cantidades[$i]);
        }
    }

    public function updateProducto($idproducto, $cant)
    {
        $productoActual = $this->Productos_model->getProducto($idproducto);
        $data           = array('cantidad' => $productoActual->cantidad - $cant);
        $this->Productos_model->update($idproducto, $data);
    }
    public function view()
    {
        $idventa = $this->input->post('id');
        $data    = array(
            'venta'    => $this->Ventas_model->getVentemplesucu($idventa),
            'detalles' => $this->Ventas_model->getDetalle($idventa),
        );
        $this->load->view('admin/ventas/view', $data);
    }

}
