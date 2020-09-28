<?php defined('BASEPATH') or exit('No direct script access allowed');

class TahunPelajaranModel extends CI_Model
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

    public function hapusTahunPelajaran_ajax($tahunPelajaran)
    {
        return $this->db->delete('ref_tahun_pelajaran', ['thn_ajar_kd' => $tahunPelajaran]);
    }
    function update_data($where, $data, $table)
    {
        $this->db->where($where);
        $this->db->update($table, $data);
    }
}
