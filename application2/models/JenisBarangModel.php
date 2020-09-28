<?php defined('BASEPATH') or exit('No direct script access allowed');

class JenisBarangModel extends CI_Model
{


    public $product_id;
    public $name;
    public $price;
    public $image = "default.jpg";
    public $description;


    function input_data($data, $table)
    {
        $this->db->insert($table, $data);
    }

    public function hapusJenisBarang_ajax($jenisBarang)
    {
        return $this->db->delete('ref_jenis_barang', ['jns_brg_kd' => $jenisBarang]);
    }
    function update_data($where, $data, $table)
    {
        $this->db->where($where);
        $this->db->update($table, $data);
    }
}
