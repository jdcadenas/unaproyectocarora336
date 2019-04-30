<?php

class Ventas_model extends CI_Model
{

    public function getVentas()
    {
        $this->db->select("v.*,e.nombre as vendedor");
        $this->db->from('ventas v');
        $this->db->join('empleados e', 'v.empleado_id = e.id_empleado');
        $this->db->where('v.estado', "1");

        $resultados = $this->db->get();

        if ($resultados->num_rows() > 0) {
            return $resultados->result();
        } else {
            return false;
        }

    }

    public function getproductos($valor)
    {
        $this->db->select('id_producto,codigo,nombre as label,precio,cantidad');
        $this->db->from('productos');
        $this->db->like('nombre', $valor);
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
        $this->db->select("v.*,e.nombre as nombrevendedor,e.apellido as apellidovendedor,e.correo,e.telefono, e.correo,e.cedula,s.nombre as sucursal,s.ubicacion");
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

}
