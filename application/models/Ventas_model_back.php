<?php if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class Ventas_model extends CI_Model {

	public function getVentas() {
		$this->db->select("v.*,e.nombre as vendedor");
		$this->db->from('ventas v');
		$this->db->join('empleados e', 'v.empleado_id = e.id_empleado');

		$resultados = $this->db->get();

		if ($resultados->num_rows() > 0) {
			return $resultados->result();
		} else {
			return false;
		}

	}
	public function getVentasByDate($fechainicio, $fechafin) {
		$this->db->select("v.*,e.nombre as vendedor");
		$this->db->from('ventas v');
		$this->db->join('empleados e', 'v.empleado_id = e.id_empleado');
		$this->db->where('v.fecha_venta >=', $fechainicio);
		$this->db->where('v.fecha_venta <=', $fechafin);
		$resultados = $this->db->get();

		if ($resultados->num_rows() > 0) {
			return $resultados->result();
		} else {
			return false;
		}

	}
	public function getVentasByDateVendedor($fechainicio, $fechafin, $vendedor) {
		$this->db->select("v.*,e.nombre as vendedor,e.id_empleado");
		$this->db->from('ventas v');
		$this->db->join('empleados e', 'v.empleado_id = e.id_empleado');
		$this->db->where('v.fecha_venta >=', $fechainicio);
		$this->db->where('v.fecha_venta <=', $fechafin);
		$this->db->where('e.id_empleado <=', $vendedor);
		$resultados = $this->db->get();

		if ($resultados->num_rows() > 0) {
			return $resultados->result();
		} else {
			return false;
		}

	}
	public function getVenta($id) {
		$this->db->where('id_venta', $id);
		$resultado = $this->db->get('ventas');
		return $resultado->row();
	}

	public function lastID() {
		$maxid = 0;
		$row = $this->db->query('SELECT MAX(id_venta) AS `maxid` FROM `ventas`')->row();
		if ($row) {
			$maxid = $row->maxid;
		}

		return (int) $maxid;

	}

	public function save($data) {
		return $this->db->insert('ventas', $data);
	}

	public function save_detalles($data) {
		$this->db->insert('detalle_venta', $data);
	}

	public function getVentemplesucu($id) {
		$this->db->select("v.*,e.nombre as nombrevendedor,e.apellido as apellidovendedor,e.correo,e.telefono, e.correo,e.cedula,s.nombre as sucursal,s.ubicacion");
		$this->db->from('ventas v');
		$this->db->join('empleados e', 'v.empleado_id = e.id_empleado');
		$this->db->join('sucursales s', 's.id = e.id_empleado');
		$this->db->where('v.id_venta', $id);
		$resultado = $this->db->get();
		return $resultado->row();

	}
	public function getDetalle($id) {
		$this->db->select("dv.*,p.Codigo as Codigo,p.nombre");
		$this->db->from('detalle_venta dv');
		$this->db->join('productos p', 'dv.producto_id = p.id_producto');
		$this->db->where('dv.venta_id', $id);
		$resultado = $this->db->get();
		return $resultado->result();
	}

	public function years() {
		$this->db->select('YEAR(fecha_venta) as year');
		$this->db->from('ventas');
		$this->db->group_by('year');
		$this->db->order_by('year', 'desc');
		$resultados = $this->db->get();
		return $resultados->result();
	}
	public function montos($year) {
		$this->db->select('MONTH(fecha_venta) as mes, SUM(total) as monto');
		$this->db->from('ventas');
		$this->db->where('fecha_venta >=', $year . "-01-01");
		$this->db->where('fecha_venta <=', $year . "-12-31");
		$this->db->group_by('mes');
		$this->db->order_by('mes');
		$resultados = $this->db->get();
		return $resultados->result();
	}

}
