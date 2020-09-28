<?php defined('BASEPATH') or exit('No direct script access allowed');

class SKMtModel extends CI_Model
{


    public $product_id;
    public $name;
    public $price;
    public $image = "default.jpg";
    public $description;

    public function hapusSKMT_ajax($SKMTID)
    {
        return $this->db->delete('ref_skmt', ['skmt_kd' => $skmtID]);
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
