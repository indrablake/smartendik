<?php defined('BASEPATH') or exit('No direct script access allowed');

class SNPMODEL extends CI_Model
{


    public $product_id;
    public $name;
    public $price;
    public $image = "default.jpg";
    public $description;

    function getData()
    {
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


    // DataTable
    // start datatables
    var $column_order_snp = array(null, 'snp_nm'); //set column field database for datatable orderable
    var $column_search_snp = array('snp_nm'); //set column field database for datatable searchable
    var $order_snp = array('snp_id' => 'desc'); // default order 


    private function _get_datatables_query_snp()
    {
        $this->db->select('ref_snp.*');
        $this->db->from('ref_snp');
        $id = array('0', '1');
        $this->db->where_in('ref_snp.snp_status', $id);

        $i = 0;

        foreach ($this->column_search_snp as $item) // looping awal
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

                if (count($this->column_search_snp) - 1 == $i)
                    $this->db->group_end();
            }
            $i++;
        }

        if (isset($_POST['order'])) {
            $this->db->order_by($this->column_order_snp[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->order_snp)) {
            $order = $this->order_snp;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    function get_datatables_snp()
    {
        $this->_get_datatables_query_snp();
        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    function count_filtered_snp()
    {
        $this->_get_datatables_query_snp();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all_snp()
    {
        $this->_get_datatables_query_snp();
        $query = $this->db->count_all_results();
        return  $query;
    }

    // End DataTable
    // DataTable
    // start datatables
    var $column_order_snp_poin = array(null, 'ref_snp.snp_nm', 'snp_poin.snpp_ket'); //set column field database for datatable orderable
    var $column_search_snp_poin = array('ref_snp.snp_nm', 'snp_poin.snpp_ket'); //set column field database for datatable searchable
    var $order_snp_poin = array('snpp_id' => 'desc'); // default order 


    private function _get_datatables_query_snp_poin()
    {
        $this->db->select('snp_poin.*,ref_snp.snp_nm,ref_snp.snp_id');
        $this->db->from('snp_poin');
        $this->db->join('ref_snp', 'snp_poin.snp_id = ref_snp.snp_id');
        $id = array('1');
        $this->db->where_in('snp_poin.snpp_status', $id);


        $i = 0;

        foreach ($this->column_search_snp_poin as $item) // looping awal
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

                if (count($this->column_search_snp_poin) - 1 == $i)
                    $this->db->group_end();
            }
            $i++;
        }

        if (isset($_POST['order'])) {
            $this->db->order_by($this->column_order_snp_poin[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->order_snp_poin)) {
            $order = $this->order_snp_poin;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    function get_datatables_snp_poin($id)
    {
        $this->_get_datatables_query_snp_poin();
        $this->db->where('snp_poin.snp_id', $id);

        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    function count_filtered_snp_poin($id)
    {
        $this->_get_datatables_query_snp_poin();
        $this->db->where('snp_poin.snp_id', $id);
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all_snp_poin($id)
    {
        $this->db->from('snp_poin');
        $this->db->where('snp_poin.snp_id', $id);
        $this->db->where('snp_poin.snpp_status', '1');
        $query = $this->db->count_all_results();

        return  $query;
    }


    // SNP Ket Poin
    // DataTable
    // start datatables
    var $column_order_snp_ket_poin = array(null, 'snp_poin.snpp_ket', 'snp_poin_ket_nilai.spkn_abjad'); //set column field database for datatable orderable
    var $column_search_snp_ket_poin = array('snp_poin.snpp_ket', 'snp_poin_ket_nilai.spkn_abjad'); //set column field database for datatable searchable
    var $order_snp_ket_poin = array('spkn_id' => 'desc'); // default order 


    private function _get_datatables_query_snp_ket_poin()
    {
        $this->db->select('snp_poin_ket_nilai.*,snp_poin.snpp_ket');
        $this->db->from('snp_poin_ket_nilai');
        $this->db->join('snp_poin', 'snp_poin_ket_nilai.snpp_id = snp_poin.snpp_id');



        $i = 0;

        foreach ($this->column_search_snp_ket_poin as $item) // looping awal
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

                if (count($this->column_search_snp_ket_poin) - 1 == $i)
                    $this->db->group_end();
            }
            $i++;
        }

        if (isset($_POST['order'])) {
            $this->db->order_by($this->column_order_snp_ket_poin[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->order_snp_ket_poin)) {
            $order = $this->order_snp_ket_poin;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    function get_datatables_snp_ket_poin($id)
    {
        $this->_get_datatables_query_snp_ket_poin();
        $this->db->where('snp_poin_ket_nilai.snpp_id', $id);

        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    function count_filtered_snp_ket_poin($id)
    {
        $this->_get_datatables_query_snp_ket_poin();
        $this->db->where('snp_poin_ket_nilai.snpp_id', $id);
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all_snp_ket_poin($id)
    {
        $this->db->from('snp_poin_ket_nilai');
        $this->db->where('snp_poin_ket_nilai.snpp_id', $id);
        $query = $this->db->count_all_results();

        return  $query;
    }
    // End SNP Ket Poin

    // Delete
    public function hapusSNP_ajax($snpID)
    {
        return $this->db->delete('ref_snp', ['snp_id' => $snpID]);
    }

    public function hapusSNPPoin_ajax($snppID)
    {
        return $this->db->delete('snp_poin', ['snpp_id' => $snppID]);
    }
}
