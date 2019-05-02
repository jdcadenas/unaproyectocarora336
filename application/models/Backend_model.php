<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Backend_model extends CI_Model
{

    public function cuentaFilas($tabla)
    {
        if ($tabla != "ventas") {
            $this->db->where('estado', '1');
        }

        $resultados = $this->db->get($tabla);
        return $resultados->num_rows();

    }

}

/* End of file Bakend_modelo.php */
/* Location: ./application/models/Bakend_modelo.php */
