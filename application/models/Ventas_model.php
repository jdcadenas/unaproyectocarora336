<?php

class Ventas_model extends CI_Model
{

    public function getVentas()
    {
        $this->db->select("
            v.*,e.nombre as vendedor,
            e.apellido as apellidovendedor,
            e.correo,e.telefono,
            e.correo,e.cedula,
            s.nombre as sucursal,
            s.ubicacion
            ");
        $this->db->from('ventas v');
        $this->db->join('empleados e', 'v.empleado_id = e.id_empleado');
        $this->db->join('sucursales s', 's.id = e.id_empleado');
        $this->db->order_by('s.id', 'asc');
        $this->db->order_by('e.id_empleado', 'asc');
        $resultados = $this->db->get();

        if ($resultados->num_rows() > 0) {
            return $resultados->result();
        } else {
            return false;
        }
    }
    public function getVentasByDate($fechainicio, $fechafin)
    {
        $this->db->select("
            v.*,e.nombre as vendedor,
            e.apellido as apellidovendedor,
            e.correo,e.telefono,
            e.correo,e.cedula,
            s.nombre as sucursal,
            s.ubicacion
            ");
        $this->db->from('ventas v');
        $this->db->join('empleados e', 'v.empleado_id = e.id_empleado');
        $this->db->join('sucursales s', 's.id = e.id_empleado');
        $this->db->where('v.fecha_venta >=', $fechainicio);
        $this->db->where('v.fecha_venta <=', $fechafin);
        $this->db->order_by('s.id', 'asc');
        $this->db->order_by('e.id_empleado', 'asc');

        $resultados = $this->db->get();

        if ($resultados->num_rows() > 0) {
            return $resultados->result();
        } else {
            return false;
        }

    }

    public function getproductos($valor, $sucursal)
    {
        /*select p.id_producto, p.codigo, p.nombre as label,
        p.precio, p.cantidad, l.nombre_linea as lnombre, s.id as idsucursal,
        s.nombre as sucursal
        from productos as p
        join lineas l on p.linea = l.id_linea
        join almacen a on p.id_producto = a.producto_id
        join sucursales s on s.id = a.sucursal_id
        where p.estado = "1" and a.sucursal_id='1'
        and p.nombre like 'pin%' */

        $this->db->select("p.id_producto,p.codigo,p.nombre as label,p.precio,p.cantidad,l.nombre_linea as lnombre, s.id as idsucursal, s.nombre as sucursal");
        $this->db->from('productos p');
        $this->db->join('lineas l', 'p.linea = l.id_linea');
        $this->db->join('almacen a', 'p.id_producto = a.producto_id');
        $this->db->join('sucursales s', 's.id = a.sucursal_id');
        $this->db->where('p.estado', "1");
        $this->db->where('a.sucursal_id', $sucursal);
        $this->db->like('p.nombre', $valor);
        $resultados = $this->db->get();

        return $resultados->result_array();
    }

    public function getVenta($id)
    {
        $this->db->where('id_venta', $id);
        $resultado = $this->db->get('ventas');
        return $resultado->row();
    }

    public function lastID()
    {
        $maxid = 0;
        $row   = $this->db->query('SELECT MAX(id_venta) AS `maxid` FROM `ventas`')->row();
        if ($row) {
            $maxid = $row->maxid;
        }

        return (int) $maxid;
    }

    public function save($data)
    {
        return $this->db->insert('ventas', $data);
    }

    public function save_detalles($data)
    {
        $this->db->insert('detalle_venta', $data);
    }

    public function update($id, $data)
    {
        $this->db->where('id_producto', $id);
        return $this->db->update('productos', $data);
    }

    public function getVentemplesucu($id)
    {
        $this->db->select("
            v.*,e.nombre as vendedor,
            e.apellido as apellidovendedor,
            e.correo,e.telefono,
            e.correo,e.cedula,
            s.nombre as sucursal,
            s.ubicacion
            ");
        $this->db->from('ventas v');
        $this->db->join('empleados e', 'v.empleado_id = e.id_empleado');
        $this->db->join('sucursales s', 's.id = e.id_empleado');
        $this->db->where('v.id_venta', $id);
        $resultado = $this->db->get();
        return $resultado->row();
    }

    public function getDetalle($id)
    {
        $this->db->select("dv.*,p.Codigo as Codigo,p.nombre");
        $this->db->from('detalle_venta dv');
        $this->db->join('productos p', 'dv.producto_id = p.id_producto');
        $this->db->where('dv.venta_id', $id);
        $resultado = $this->db->get();
        return $resultado->result();
    }
    public function years()
    {
        $this->db->select('YEAR(fecha_venta) as year');
        $this->db->from('ventas');
        $this->db->group_by('year');
        $this->db->order_by('year', 'desc');
        $resultados = $this->db->get();
        return $resultados->result();
    }
    public function montos($year)
    {
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
