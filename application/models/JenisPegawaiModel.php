<?php defined('BASEPATH') or exit('No direct script access allowed');

class JenisPegawaiModel extends CI_Model
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

    public function hapusJenisPegawai_ajax($jenisPegawai)
    {
        return $this->db->delete('ref_jenis_pegawai', ['jns_pegawai_kd' => $jenisPegawai]);
    }
    function update_data($where, $data, $table)
    {
        $this->db->where($where);
        $this->db->update($table, $data);
    }
}
