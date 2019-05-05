<?php

/**
 * Description of Empleados_model
 *
 * @author Usuario
 */
class Productos_model extends CI_Model
{

    public function getProductos($ids)
    {
        $this->db->select("p.*,l.nombre_linea as lnombre, a.cantidad as cantidadAlmacen,
         s.nombre as sucursal,s.ubicacion as ubicacion,s.id as id_sucursal");
        $this->db->from('productos p');
        $this->db->join('lineas l', 'p.linea = l.id_linea');
        $this->db->join('almacen a', 'a.producto_id = p.id_producto');
        $this->db->join('sucursales s', 's.id = a.sucursal_id');
        $this->db->where('s.id', $ids);
        $this->db->where('p.estado', "1");
        $this->db->order_by('s.id', 'asc');
        $resultados = $this->db->get();
        return $resultados->result();
    }

    public function getProducto($id)
    {

        $this->db->where('id_producto', $id);
        $resultado = $this->db->get('productos');
        return $resultado->row();
    }

    public function save($data)
    {
        return $this->db->insert('productos', $data);
    }

    public function update($id, $data)
    {
        $this->db->where('id_producto', $id);
        return $this->db->update('productos', $data);
    }

    public function lastID()
    {
        $maxid = 0;
        $row   = $this->db->query('SELECT MAX(id_producto) AS `maxid` FROM `productos`')->row();
        if ($row) {
            $maxid = $row->maxid;
        }

        return (int) $maxid;
    }

}
