<?php defined('BASEPATH') or exit('No direct script access allowed');

class DupakModel extends CI_Model
{


    public $product_id;
    public $name;
    public $price;
    public $image = "default.jpg";
    public $description;

    public function hapusDupak_ajax($DupakID)
    {
        return $this->db->delete('ref_Dupak', ['Dupak_kd' => $DupakID]);
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
