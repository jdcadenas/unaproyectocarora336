<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Lineas_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();

    }

    public function getLineas()
    {
        $this->db->where('estado', "1");
        $resultados = $this->db->get('lineas');
        return $resultados->result();
    }

    public function getLinea($id)
    {
        $this->db->where('id_linea', $id);
        $resultado = $this->db->get('lineas');
        return $resultado->row();
    }

    public function save($data)
    {
        return $this->db->insert('lineas', $data);
    }

    public function update($id, $data)
    {
        $this->db->where('id_linea', $id);
        return $this->db->update('lineas', $data);
    }

}
