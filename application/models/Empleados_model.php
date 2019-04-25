<?php

/**
 * Description of Empleados_model
 *
 * @author Usuario
 */
class Empleados_model extends CI_Model
{

    public function login($usuario, $clave)
    {
        $this->db->where("usuario", $usuario);
        $this->db->where("clave", $clave);
        $resultado = $this->db->get("empleados");
        if ($resultado->num_rows() > 0) {
            return $resultado->row();
        } else {
            return false;
        }
    }

    public function getEmpleados()
    {
        $this->db->where('estado', "1");

        $resultados = $this->db->get('empleados');
        return $resultados->result();
    }

    public function getEmpleado($id)
    {
        $this->db->where('id_empleado', $id);
        $resultado = $this->db->get('empleados');
        return $resultado->row();
    }

    public function save($data)
    {
        return $this->db->insert('empleados', $data);
    }

    public function update($id, $data)
    {
        $this->db->where('id_empleado', $id);
        return $this->db->update('empleados', $data);
    }

}
