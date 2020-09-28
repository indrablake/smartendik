<?php defined('BASEPATH') or exit('No direct script access allowed');

class KKMModel extends CI_Model
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

    function input_data($data, $table)
    {
        $this->db->insert($table, $data);
    }

    // Edit User Aktifasi


    // KKM
    // DataTable
    // start datatables
    var $column_order_kkm = array(null, 'komp_dasar.kd_semester', 'komp_dasar.kd_kode', 'komp_dasar.kd_keterangan', 'dat_kkm.kkm_daya_dukung', 'dat_kkm.kkm_intake'); //set column field database for datatable orderable
    var $column_search_kkm = array('komp_dasar.kd_semester', 'komp_dasar.kd_kode', 'komp_dasar.kd_keterangan', 'dat_kkm.kkm_daya_dukung', 'dat_kkm.kkm_intake'); //set column field database for datatable searchable
    var $order_kkm = array('dat_kkm.kkm_id' => 'desc'); // default order 


    private function _get_datatables_query_kkm()
    {
        $this->db->select('dat_kkm.*, komp_dasar.kd_semester, komp_dasar.kd_kode,komp_dasar.kd_tema');
        $this->db->from('dat_kkm');
        $this->db->join('komp_dasar', 'komp_dasar.kd_id = dat_kkm.kd_id');
        $i = 0;

        foreach ($this->column_search_kkm as $item) // looping awal
        {
            if ($_POST['search']['value']) // jika datatable mengirimkan pencarian dengan metode POST
            {

                if ($i === 0) // looping awal
                {
                    $this->db->group_start();
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }

                if (count($this->column_search_kkm) - 1 == $i)
                    $this->db->group_end();
            }
            $i++;
        }

        if (isset($_POST['order'])) {
            $this->db->order_by($this->column_order_kkm[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->order_kkm)) {
            $order = $this->order_kkm;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    function get_datatables_kkm($id)
    {
        $this->_get_datatables_query_kkm();
        $this->db->where('dat_kkm.kd_id', $id);
        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();

        return $query->result();
    }

    function count_filtered_kkm($id)
    {
        $this->_get_datatables_query_kkm();
        $this->db->where('dat_kkm.kd_id', $id);
        $query = $this->db->get();

        return $query->num_rows();
    }

    public function count_all_kkm($id)
    {
        $this->db->from('dat_kkm');
        $this->db->where('dat_kkm.kd_id', $id);
        return $this->db->count_all_results();
    }
    // End DataTable
    public function hapusKKM_ajax($kkmID)
    {
        return $this->db->delete('dat_kkm', ['kkm_id' => $kkmID]);
    }
}
