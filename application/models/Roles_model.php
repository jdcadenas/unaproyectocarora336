<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Roles_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();

    }

    public function getRoles()
    {

        $resultados = $this->db->get('roles');
        return $resultados->result();
    }

    public function getRol($id)
    {
        $this->db->where('id_rol', $id);
        $resultado = $this->db->get('roles');
        return $resultado->row();
    }

    public function save($data)
    {
        return $this->db->insert('roles', $data);
    }

    public function update($id, $data)
    {
        $this->db->where('id_rol', $id);
        return $this->db->update('roles', $data);
    }

}
