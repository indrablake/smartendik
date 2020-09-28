<?php defined('BASEPATH') or exit('No direct script access allowed');

class JenjangSekolahModel extends CI_Model
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

    public function hapusJenjang_ajax($jenjangID)
    {
        return $this->db->delete('ref_jenjang_sekolah', ['jenjang_kd' => $jenjangID]);
    }

    function update_data($where, $data, $table)
    {
        $this->db->where($where);
        $this->db->update($table, $data);
    }
}
