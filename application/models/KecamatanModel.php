<?php defined('BASEPATH') or exit('No direct script access allowed');

class KecamatanModel extends CI_Model
{


    public $product_id;
    public $name;
    public $price;
    public $image = "default.jpg";
    public $description;

    public function hapusKecamatan_ajax($kecamatan_id)
    {
        return $this->db->delete('ref_kecamatan', ['kecamatan_kd' => $kecamatan_id]);
    }


    function update_data($where, $data, $table)
    {
        $this->db->where($where);
        $this->db->update($table, $data);
    }
    function input_data($data, $table)
    {
        $this->db->insert($table, $data);
    }
}
