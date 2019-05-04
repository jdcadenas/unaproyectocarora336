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
        $this->load->model('Sucursales_model');
        $this->load->model('Almacenes_model');
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
        $data = array(
            'empleados'   => $this->Empleados_model->getEmpleados(),
            'sucursales'  => $this->Sucursales_model->getSucursales(),
            'ultimaVenta' => $this->Ventas_model->lastID(),

        );

        $this->template->write_view('sidenavs', 'template/default_sidenavs', true);
        $this->template->write_view('navs', 'template/default_topnavs.php', true);
        $this->template->write('title', 'Ventas', true);
        $this->template->write('header', 'Ventas <small> Agregar</small>');
        $this->template->write_view('content', 'admin/ventas/add', $data);
        $this->template->render();
    }

    public function getproductos($sucursal)
    {
        $valor = $this->input->post("valor");

        $empleados = $this->Ventas_model->getproductos($valor, $sucursal);

        echo json_encode($empleados);
    }

    public function store()
    {
//recupero los valores del formulario

        $fecha_venta = $this->input->post('fecha_venta');
        $total       = $this->input->post('total');
        $id_empleado = $this->input->post('id_empleado');

        $idproductos = $this->input->post('idproductos');
        $precios     = $this->input->post('precios');
        $cantidades  = $this->input->post('cantidades');
        $id_sucursal = $this->input->post('id_sucursal');

        $data = array(
            'fecha_venta' => $fecha_venta,
            'total'       => $total,
            'empleado_id' => $id_empleado,
            'sucursal_id' => $id_sucursal,

        );
// verifico que se ingrese la venta

        if ($this->Ventas_model->save($data)) {

//busca la ultima venta agregada para los detalles
            $idventa = $this->Ventas_model->lastID();
//registro el datalle de la venta
            $this->save_detalle($id_sucursal, $idproductos, $idventa, $precios, $cantidades);

            redirect(base_url() . 'movimientos/ventas');
        } else {
            redirect(base_url() . 'movimiento/ventas/add');
        }

    }

    public function save_detalle($id_sucursal, $productos, $idventa, $precios, $cantidades)
    {
        for ($i = 0; $i < count($productos); $i++) {
            $data = array(
                'producto_id'  => $productos[$i],
                'cantidad'     => $cantidades[$i],
                'precio_venta' => $precios[$i],
                'venta_id'     => $idventa,
            );
//registro el datalle
            $this->Ventas_model->save_detalles($data);

            $this->updateProductoAlmacen($id_sucursal, $productos[$i], $cantidades[$i]);
        }
    }

    public function updateProductoAlmacen($id_sucursal, $idproducto, $cant)
    {
//ubicar el producto en el almacen
        $productoAlmacenActual = $this->Almacenes_model->getProductoAlmacen($id_sucursal, $idproducto);

        $data = array('cantidad' => $productoAlmacenActual->cantidad - $cant);

        $this->Almacenes_model->update($id_sucursal, $idproducto, $data);
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
