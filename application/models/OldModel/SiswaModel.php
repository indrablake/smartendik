<?php defined('BASEPATH') or exit('No direct script access allowed');

class SiswaModel extends CI_Model
{


    public $product_id;
    public $name;
    public $price;
    public $image = "default.jpg";
    public $description;


    function update_data($where, $data, $table)
    {
        $this->db->where($where);
        $this->db->update($table, $data);
    }

    function input_siswa_group($data, $table)
    {
        $this->db->insert($table, $data);
    }

    public function hapusReligion_ajax($relid)
    {
        return $this->db->delete('TBL_RELIGION', ['REL_ID' => $relid]);
    }

    public function hapusSiswa_ajax($stdid)
    {
        return $this->db->delete('TBL_STUDENT', ['STD_ID' => $stdid]);
    }

    public function hapusKelasSiswa_ajax($stdid)
    {
        return $this->db->delete('TBL_CLASSSMEMBER', ['STD_ID' => $stdid]);
    }
}
