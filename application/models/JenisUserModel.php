<?php defined('BASEPATH') or exit('No direct script access allowed');

class JenisUserModel extends CI_Model
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

    public function hapusJenisUser_ajax($jenisUserID)
    {
        return $this->db->delete('ref_jenis_user', ['jns_user_kd' => $jenisUserID]);
    }

    function update_data($where, $data, $table)
    {
        $this->db->where($where);
        $this->db->update($table, $data);
    }
}
