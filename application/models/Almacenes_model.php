<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
/**
 * Description of Empleados_model
 *
 * @author Usuario
 */
class Almacenes_model extends CI_Model
{

    public function getProductosAlmacen($valor)
    {
        /*SELECT p.*,l.nombre_linea as lnombre, s.id as idsucursal, s.nombre as sucursal
        from productos p
        join lineas l on p.linea = l.id_linea
        join almacen a on p.id_producto = a.producto_id
        join sucursales s on s.id = a.sucursal_id
        where p.estado='1' */

        $this->db->select("p.*,l.nombre_linea as lnombre, s.id as idsucursal, s.nombre as sucursal");
        $this->db->from('productos p');
        $this->db->join('lineas l', 'p.linea = l.id_linea');
        $this->db->join('almacen a', 'p.id_producto = a.producto_id');
        $this->db->join('sucursales s', 's.id = a.sucursal_id');
        $this->db->where('p.estado', "1");

        $resultados = $this->db->get();
        return $resultados->result();
    }

    public function getProductoAlmacen($id_sucursal, $id_producto)
    {
        $this->db->where('producto_id', $id_producto);
        $this->db->where('sucursal_id', $id_sucursal);
        $resultado = $this->db->get('almacen');
        return $resultado->row();
    }

    public function save($data)
    {
        return $this->db->insert('almacen', $data);
    }

    public function update($id_sucursal, $id_producto, $data)
    {
        $this->db->where('sucursal_id', $id_sucursal);
        $this->db->where('producto_id', $id_producto);
        return $this->db->update('almacen', $data);
    }

}
