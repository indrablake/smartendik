<?php defined('BASEPATH') or exit('No direct script access allowed');

class TingkatKelasModel extends CI_Model
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

    public function hapusTingkatKelas_ajax($kelasLevel)
    {
        return $this->db->delete('ref_tingkat_kelas', ['tk_kls_level' => $kelasLevel]);
    }
    function update_data($where, $data, $table)
    {
        $this->db->where($where);
        $this->db->update($table, $data);
    }
}
