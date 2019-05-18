<?php if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}
/**
 * Description of Empleados_model
 *
 * @author Usuario
 */
class Productos_model extends CI_Model {

	public function getProductos($ids = 0) {
		$this->db->select("p.*,l.nombre_linea as lnombre, a.cantidad as cantidadAlmacen,
         s.nombre as sucursal,s.ubicacion as ubicacion,s.id as id_sucursal");
		$this->db->from('productos p');
		$this->db->join('lineas l', 'p.linea = l.id_linea');
		$this->db->join('almacen a', 'a.producto_id = p.id_producto');
		$this->db->join('sucursales s', 's.id = a.sucursal_id');
		if ($ids != 0) {
			$this->db->where('s.id', $ids);
		}

		$this->db->where('p.estado', "1");
		$this->db->order_by('s.id', 'asc');
		$resultados = $this->db->get();
		return $resultados->result();
	}
	public function getProductosHistorico($ids = 0, $ide = 0, $idp = 0) {
		$this->db->select("p.*,l.nombre_linea as lnombre, a.cantidad as cantidadAlmacen,
         s.nombre as sucursal,s.ubicacion as ubicacion,s.id as id_sucursal");
		$this->db->from('productos p');
		$this->db->join('lineas l', 'p.linea = l.id_linea');
		$this->db->join('almacen a', 'a.producto_id = p.id_producto');
		$this->db->join('sucursales s', 's.id = a.sucursal_id');
		if ($ids != 0) {
			$this->db->where('s.id', $ids);
		}

		$this->db->where('p.estado', "1");
		$this->db->order_by('s.id', 'asc');
		$resultados = $this->db->get();
		return $resultados->result();
	}

	public function getProducto($id) {
		$this->db->select("p.*,l.nombre_linea as lnombre, a.cantidad as cantidadAlmacen,
         s.nombre as sucursal,s.ubicacion as ubicacion,s.id as id_sucursal");
		$this->db->from('productos p');
		$this->db->join('lineas l', 'p.linea = l.id_linea');
		$this->db->join('almacen a', 'a.producto_id = p.id_producto');
		$this->db->join('sucursales s', 's.id = a.sucursal_id');

		$this->db->where('p.id_producto', $id);
		$resultado = $this->db->get();
		return $resultado->row();
	}

	public function crear_thumbnail($fileName, $width, $height) {
		$this->load->library('image_lib');
		$config['image_library'] = 'gd2';
		$config['source_image'] = 'assets/images/productos/' . $fileName;
		$config['create_thumb'] = true;
		$config['maintain_ratio'] = true;
		$config['width'] = $width;
		$config['height'] = $height;
		$config['new_image'] = 'assets/images/productos/' . $fileName;
		$this->image_lib->initialize($config);
		if (!$this->image_lib->resize()) {
			echo $this->image_lib->display_errors();
		}
	}
	public function subir_imagen_producto($id) {

		$config['upload_path'] = 'assets/images/productos/';
		$config['allowed_types'] = '*';
		$config['max_size'] = '1000';
		$config['max_width'] = '1024';
		$config['max_height'] = '768';
		$config['overwrite'] = true;
		$config['file_name'] = $id;
		$this->load->library('upload', $config);
		//  $this->crear_thumbnail($id, 75, 50);

		if (!$this->upload->do_upload("imagen_producto")) {
			$error = array('error' => $this->upload->display_errors());
			echo "<pre>";
			print_r($error);
			print_r($config);
			exit;
		} else {
			$data = array('imagen_producto' => $this->upload->data());
			return 'assets/images/productos/' . $data['imagen_producto']['file_name'];

		}
	}

	public function save($data) {

		$data["estado"] = '1';
		$data["imagen_producto"] = $this->subir_imagen_producto($data['codigo']);

		return $this->db->insert('productos', $data);
	}

	public function update($id, $data) {

		if (!empty($_FILES['imagen_producto']['name'])) {
			$data["imagen_producto"] = $this->subir_imagen_producto($data['codigo']);
		}

		$this->db->where('id_producto', $id);
		return $this->db->update('productos', $data);
	}

	public function lastID() {
		$maxid = 0;
		$row = $this->db->query('SELECT MAX(id_producto) AS `maxid` FROM `productos`')->row();
		if ($row) {
			$maxid = $row->maxid;
		}

		return (int) $maxid;
	}

}
