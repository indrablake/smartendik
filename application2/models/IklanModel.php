<?php defined('BASEPATH') or exit('No direct script access allowed');

class IklanModel extends CI_Model
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

    public function hapusIklan_ajax($iklanID)
    {
        return $this->db->delete('dat_iklan', ['iklan_kd' => $iklanID]);
    }

    function update_data($where, $data, $table)
    {
        $this->db->where($where);
        $this->db->update($table, $data);
    }
}
