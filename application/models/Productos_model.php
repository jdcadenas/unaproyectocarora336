<?php

/**
 * Description of Empleados_model
 *
 * @author Usuario
 */
class Productos_model extends CI_Model
{

    public function getProductos()
    {
        $this->db->select("p.*,l.nombre_linea as lnombre");
        $this->db->from('productos p');
        $this->db->join('lineas l', 'p.linea = l.id_linea');
        $this->db->where('p.estado', "1");

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

}
