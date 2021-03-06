<?php defined('BASEPATH') or exit('No direct script access allowed');

class SupervisiModel extends CI_Model
{


    public $product_id;
    public $name;
    public $price;
    public $image = "default.jpg";
    public $description;

    public function hapusPKB_ajax($PKBID)
    {
        return $this->db->delete('ref_PKB', ['PKB_kd' => $PKBID]);
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
