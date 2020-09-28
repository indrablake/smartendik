<?php defined('BASEPATH') or exit('No direct script access allowed');

class RPPMODEL extends CI_Model
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
    function getData()
    {
    }


    // DataTable
    // start datatables
    var $column_order_rpph = array(null, 'rpp.thn_ajar_kd', 'rpp.rpp_semester', 'rpp.rpp_materi_pokok', 'ref_tahun_pelajaran.thn_ajar_periode'); //set column field database for datatable orderable
    var $column_search_rpph = array('thn_ajar_kd', 'rpp.rpp_semester', 'rpp.rpp_materi_pokok', 'ref_tahun_pelajaran.thn_ajar_periode'); //set column field database for datatable searchable
    var $order_rpph = array('rpp.rpp_id' => 'desc'); // default order 


    private function _get_datatables_query_rpph()
    {
        $this->db->select('rpp.*, ref_tahun_pelajaran.thn_ajar_periode, ref_tahun_pelajaran.thn_ajar_kd');
        $this->db->from('rpp');
        $this->db->join('ref_tahun_pelajaran', 'rpp.thn_ajar_kd = ref_tahun_pelajaran.thn_ajar_kd');
        $id = array('0', '1');
        $this->db->where_in('rpp.rpp_status', $id);

        $i = 0;

        foreach ($this->column_search_rpph as $item) // looping awal
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

                if (count($this->column_search_rpph) - 1 == $i)
                    $this->db->group_end();
            }
            $i++;
        }

        if (isset($_POST['order'])) {
            $this->db->order_by($this->column_order_rpph[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->order_rpph)) {
            $order = $this->order_rpph;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    function get_datatables_rpph()
    {
        $this->_get_datatables_query_rpph();
        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    function count_filtered_rpph()
    {
        $this->_get_datatables_query_rpph();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all_rpph()
    {
        $this->_get_datatables_query_rpph();
        $query = $this->db->count_all_results();
        return  $query;
    }
    public function deleteMultiple_ajax($rpphID, $jmlData)
    {
        for ($i = 0; $i < $jmlData; $i++) {
            $this->db->delete('rpp', ['rpp_id' => $rpphID[$i]]);
        }
        return true;
    }
    // End DataTable

    // DataTable Tujuan RPP
    // start datatables Tujuan RPP
    var $column_order_tujuan_rpph = array(null, 'rpp.thn_ajar_kd', 'rpp.rpp_semester', 'rpp.rpp_materi_pokok', 'ref_tahun_pelajaran.thn_ajar_periode', 'rpp_tujuan_pembelajaran.rpptp_keterangan'); //set column field database for datatable orderable
    var $column_search_tujuan_rpph = array('rpp.thn_ajar_kd', 'rpp.rpp_semester', 'rpp.rpp_materi_pokok', 'ref_tahun_pelajaran.thn_ajar_periode', 'rpp_tujuan_pembelajaran.rpptp_keterangan'); //set column field database for datatable searchable
    var $order_tujuan_rpph = array('rpp_tujuan_pembelajaran.rpptp_id' => 'desc'); // default order 


    private function _get_datatables_query_tujuan_rpph()
    {
        $this->db->select('rpp_tujuan_pembelajaran.*, ref_tahun_pelajaran.thn_ajar_periode, ref_tahun_pelajaran.thn_ajar_kd,rpp.thn_ajar_kd,rpp.rpp_semester');
        $this->db->from('rpp_tujuan_pembelajaran');
        $this->db->join('rpp', 'rpp.rpp_id = rpp_tujuan_pembelajaran.rpp_id');
        $this->db->join('ref_tahun_pelajaran', 'rpp.thn_ajar_kd = ref_tahun_pelajaran.thn_ajar_kd');
        $i = 0;

        foreach ($this->column_search_tujuan_rpph as $item) // looping awal
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

                if (count($this->column_search_tujuan_rpph) - 1 == $i)
                    $this->db->group_end();
            }
            $i++;
        }

        if (isset($_POST['order'])) {
            $this->db->order_by($this->column_order_tujuan_rpph[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->order_tujuan_rpph)) {
            $order = $this->order_tujuan_rpph;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    function get_datatables_tujuan_rpph($id)
    {
        $this->_get_datatables_query_tujuan_rpph();
        $this->db->where('rpp_tujuan_pembelajaran.rpp_id', $id);
        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    function count_filtered_tujuan_rpph($id)
    {
        $this->_get_datatables_query_tujuan_rpph();
        $this->db->where('rpp_tujuan_pembelajaran.rpp_id', $id);
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all_tujuan_rpph($id)
    {
        $this->db->from('rpp_tujuan_pembelajaran');
        $this->db->where('rpp_tujuan_pembelajaran.rpp_id', $id);
        return $this->db->count_all_results();
    }

    // End DataTable
    // DataTable Media RPP
    // start datatables Media RPP
    var $column_order_media_rpph = array(null, 'rpp.thn_ajar_kd', 'rpp.rpp_semester', 'rpp.rpp_materi_pokok', 'ref_tahun_pelajaran.thn_ajar_periode', 'rpp_media_pembelajaran.rppmb_media'); //set column field database for datatable orderable
    var $column_search_media_rpph = array('rpp.thn_ajar_kd', 'rpp.rpp_semester', 'rpp.rpp_materi_pokok', 'ref_tahun_pelajaran.thn_ajar_periode', 'rpp_media_pembelajaran.rppmb_media'); //set column field database for datatable searchable
    var $order_media_rpph = array('rpp_media_pembelajaran.rppmp_id' => 'desc'); // default order 


    private function _get_datatables_query_media_rpph()
    {
        $this->db->select('rpp_media_pembelajaran.*, ref_tahun_pelajaran.thn_ajar_periode, ref_tahun_pelajaran.thn_ajar_kd,rpp.thn_ajar_kd,rpp.rpp_semester');
        $this->db->from('rpp_media_pembelajaran');
        $this->db->join('rpp', 'rpp.rpp_id = rpp_media_pembelajaran.rpp_id');
        $this->db->join('ref_tahun_pelajaran', 'rpp.thn_ajar_kd = ref_tahun_pelajaran.thn_ajar_kd');
        $i = 0;

        foreach ($this->column_search_media_rpph as $item) // looping awal
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

                if (count($this->column_search_media_rpph) - 1 == $i)
                    $this->db->group_end();
            }
            $i++;
        }

        if (isset($_POST['order'])) {
            $this->db->order_by($this->column_order_media_rpph[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->order_media_rpph)) {
            $order = $this->order_media_rpph;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    function get_datatables_media_rpph($id)
    {
        $this->_get_datatables_query_media_rpph();
        $this->db->where('rpp_media_pembelajaran.rpp_id', $id);
        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    function count_filtered_media_rpph($id)
    {
        $this->_get_datatables_query_media_rpph();
        $this->db->where('rpp_media_pembelajaran.rpp_id', $id);
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all_media_rpph($id)
    {
        $this->db->from('rpp_media_pembelajaran');
        $this->db->where('rpp_media_pembelajaran.rpp_id', $id);
        return $this->db->count_all_results();
    }

    // End DataTable

    // DataTable Media RPP
    // start datatables Media RPP
    var $column_order_langkah_rpph = array(null, 'rpp.thn_ajar_kd', 'rpp.rpp_semester', 'rpp.rpp_materi_pokok', 'ref_tahun_pelajaran.thn_ajar_periode', 'rpp_langkah_pembelajaran.rpplb_keterangan'); //set column field database for datatable orderable
    var $column_search_langkah_rpph = array('rpp.thn_ajar_kd', 'rpp.rpp_semester', 'rpp.rpp_materi_pokok', 'ref_tahun_pelajaran.thn_ajar_periode', 'rpp_langkah_pembelajaran.rpplb_keterangan'); //set column field database for datatable searchable
    var $order_langkah_rpph = array('rpp_langkah_pembelajaran.rpplp_id' => 'desc'); // default order 


    private function _get_datatables_query_langkah_rpph()
    {
        $this->db->select('rpp_langkah_pembelajaran.*, ref_tahun_pelajaran.thn_ajar_periode, ref_tahun_pelajaran.thn_ajar_kd,rpp.thn_ajar_kd,rpp.rpp_semester');
        $this->db->from('rpp_langkah_pembelajaran');
        $this->db->join('rpp', 'rpp.rpp_id = rpp_langkah_pembelajaran.rpp_id');
        $this->db->join('ref_tahun_pelajaran', 'rpp.thn_ajar_kd = ref_tahun_pelajaran.thn_ajar_kd');
        $i = 0;

        foreach ($this->column_search_langkah_rpph as $item) // looping awal
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

                if (count($this->column_search_langkah_rpph) - 1 == $i)
                    $this->db->group_end();
            }
            $i++;
        }

        if (isset($_POST['order'])) {
            $this->db->order_by($this->column_order_langkah_rpph[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->order_langkah_rpph)) {
            $order = $this->order_langkah_rpph;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    function get_datatables_langkah_rpph($id)
    {
        $this->_get_datatables_query_langkah_rpph();
        $this->db->where('rpp_langkah_pembelajaran.rpp_id', $id);
        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    function count_filtered_langkah_rpph($id)
    {
        $this->_get_datatables_query_langkah_rpph();
        $this->db->where('rpp_langkah_pembelajaran.rpp_id', $id);
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all_langkah_rpph($id)
    {
        $this->db->from('rpp_langkah_pembelajaran');
        $this->db->where('rpp_langkah_pembelajaran.rpp_id', $id);
        return $this->db->count_all_results();
    }

    // End DataTable
    // DataTable Tujuan RPP
    // start datatables Tujuan RPP
    var $column_order_penilaian_rpph = array(null, 'rpp.thn_ajar_kd', 'rpp.rpp_semester', 'rpp.rpp_materi_pokok', 'ref_tahun_pelajaran.thn_ajar_periode', 'rpp_penilaian.rppp_keterangan'); //set column field database for datatable orderable
    var $column_search_penilaian_rpph = array('rpp.thn_ajar_kd', 'rpp.rpp_semester', 'rpp.rpp_materi_pokok', 'ref_tahun_pelajaran.thn_ajar_periode', 'rpp_penilaian.rppp_keterangan'); //set column field database for datatable searchable
    var $order_penilaian_rpph = array('rpp_penilaian.rppp_id' => 'desc'); // default order 


    private function _get_datatables_query_penilaian_rpph()
    {
        $this->db->select('rpp_penilaian.*, ref_tahun_pelajaran.thn_ajar_periode, ref_tahun_pelajaran.thn_ajar_kd,rpp.thn_ajar_kd,rpp.rpp_semester');
        $this->db->from('rpp_penilaian');
        $this->db->join('rpp', 'rpp.rpp_id = rpp_penilaian.rpp_id');
        $this->db->join('ref_tahun_pelajaran', 'rpp.thn_ajar_kd = ref_tahun_pelajaran.thn_ajar_kd');
        $i = 0;

        foreach ($this->column_search_penilaian_rpph as $item) // looping awal
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

                if (count($this->column_search_penilaian_rpph) - 1 == $i)
                    $this->db->group_end();
            }
            $i++;
        }

        if (isset($_POST['order'])) {
            $this->db->order_by($this->column_order_penilaian_rpph[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->order_penilaian_rpph)) {
            $order = $this->order_penilaian_rpph;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    function get_datatables_penilaian_rpph($id)
    {
        $this->_get_datatables_query_penilaian_rpph();
        $this->db->where('rpp_penilaian.rpp_id', $id);
        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    function count_filtered_penilaian_rpph($id)
    {
        $this->_get_datatables_query_penilaian_rpph();
        $this->db->where('rpp_penilaian.rpp_id', $id);
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all_penilaian_rpph($id)
    {
        $this->db->from('rpp_penilaian');
        $this->db->where('rpp_penilaian.rpp_id', $id);
        return $this->db->count_all_results();
    }
    // End DataTable

    // Delete
    public function hapusTujuanRPP_ajax($rppTPID)
    {
        return $this->db->delete('rpp_tujuan_pembelajaran', ['rpptp_id' => $rppTPID]);
    }
    public function hapusPembelajaranRPP_ajax($rpplpID)
    {
        return $this->db->delete('rpp_langkah_pembelajaran', ['rpplp_id' => $rpplpID]);
    }
    public function hapusMediaRPP_ajax($rppmpID)
    {
        return $this->db->delete('rpp_media_pembelajaran', ['rppmp_id' => $rppmpID]);
    }

    public function hapusPenilaianRPP_ajax($rpppID)
    {
        return $this->db->delete('rpp_penilaian', ['rppp_id' => $rpppID]);
    }
}
