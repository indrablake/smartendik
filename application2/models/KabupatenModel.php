<?php defined('BASEPATH') or exit('No direct script access allowed');

class KabupatenModel extends CI_Model
{


    public $product_id;
    public $name;
    public $price;
    public $image = "default.jpg";
    public $description;

    public function hapusKabupaten_ajax($kabupaten_id)
    {
        return $this->db->delete('ref_dati2', ['dati2_kd' => $kabupaten_id]);
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
