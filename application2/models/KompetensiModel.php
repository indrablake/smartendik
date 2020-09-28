<?php defined('BASEPATH') or exit('No direct script access allowed');

class KompetensiModel extends CI_Model
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


    // DataTable
    // start datatables
    var $column_order_kompInti = array(null, 'komp_inti.jenjang_kd', 'komp_inti.ki_kode', 'komp_inti.ki_keterangan', 'ref_tahun_pelajaran.thn_ajar_periode', 'ref_jenjang_sekolah.jenjang_nm'); //set column field database for datatable orderable
    var $column_search_kompInti = array('komp_inti.jenjang_kd', 'komp_inti.ki_kode', 'komp_inti.ki_keterangan', 'ref_tahun_pelajaran.thn_ajar_periode', 'ref_jenjang_sekolah.jenjang_nm'); //set column field database for datatable searchable
    var $order_kompInti = array('komp_inti.ki_id' => 'desc'); // default order 


    private function _get_datatables_query_kompInti()
    {
        $this->db->select('komp_inti.*, ref_tahun_pelajaran.thn_ajar_periode, ref_tahun_pelajaran.thn_ajar_kd,ref_jenjang_sekolah.jenjang_nm');
        $this->db->from('komp_inti');
        $this->db->join('ref_tahun_pelajaran', 'ref_tahun_pelajaran.thn_ajar_kd = komp_inti.thn_ajar_kd');
        $this->db->join('ref_jenjang_sekolah', 'ref_jenjang_sekolah.jenjang_kd = komp_inti.jenjang_kd');
        $id = array('0', '1');
        $this->db->where_in('ki_status', $id);
        $i = 0;

        foreach ($this->column_search_kompInti as $item) // looping awal
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

                if (count($this->column_search_kompInti) - 1 == $i)
                    $this->db->group_end();
            }
            $i++;
        }

        if (isset($_POST['order'])) {
            $this->db->order_by($this->column_order_kompInti[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->order_kompInti)) {
            $order = $this->order_kompInti;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    function get_datatables_kompInti()
    {
        $this->_get_datatables_query_kompInti();

        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    function count_filtered_kompInti()
    {
        $this->_get_datatables_query_kompInti();

        $query = $this->db->get();

        return $query->num_rows();
    }

    public function count_all_kompInti()
    {
        $this->_get_datatables_query_kompInti();
        $query = $this->db->count_all_results();
        return $query;
    }
    // End DataTable

    // KompDasar
    // DataTable
    // start datatables
    var $column_order_kompDasar = array(null, 'komp_inti.jenjang_kd', 'komp_inti.ki_kode', 'komp_inti.ki_keterangan', 'ref_tahun_pelajaran.thn_ajar_periode', 'ref_jenjang_sekolah.jenjang_nm'); //set column field database for datatable orderable
    var $column_search_kompDasar = array('komp_inti.jenjang_kd', 'komp_inti.ki_kode', 'komp_inti.ki_keterangan', 'ref_tahun_pelajaran.thn_ajar_periode', 'ref_jenjang_sekolah.jenjang_nm'); //set column field database for datatable searchable
    var $order_kompDasar = array('komp_inti.ki_id' => 'desc'); // default order 


    private function _get_datatables_query_kompDasar()
    {
        $this->db->select('komp_dasar.*, komp_inti.ki_kode, komp_inti.ki_keterangan');
        $this->db->from('komp_dasar');
        $this->db->join('komp_inti', 'komp_dasar.ki_id = komp_inti.ki_id');
        $id = array('0', '1');
        $this->db->where_in('komp_dasar.kd_status', $id);
        $i = 0;

        foreach ($this->column_search_kompDasar as $item) // looping awal
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

                if (count($this->column_search_kompDasar) - 1 == $i)
                    $this->db->group_end();
            }
            $i++;
        }

        if (isset($_POST['order'])) {
            $this->db->order_by($this->column_order_kompDasar[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->order_kompDasar)) {
            $order = $this->order_kompDasar;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    function get_datatables_kompDasar($id)
    {
        $this->_get_datatables_query_kompDasar();
        $this->db->where('komp_dasar.ki_id', $id);

        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    function count_filtered_kompDasar($id)
    {
        $this->_get_datatables_query_kompDasar();
        $this->db->where('komp_dasar.ki_id', $id);
        $query = $this->db->get();

        return $query->num_rows();
    }

    public function count_all_kompDasar($id)
    {
        $this->_get_datatables_query_kompDasar();
        $this->db->where('komp_dasar.ki_id', $id);
        $query = $this->db->count_all_results();
        return $query;
    }
    // End DataTable


    // KompDasar
    // DataTable
    // start datatables
    var $column_order_kompDasarAlokasi = array(null, 'komp_dasar.kd_semester', 'komp_dasar.kd_kode', 'komp_dasar.kd_keterangan', 'komp_dasar_alokasi.kad_jml_jam', 'komp_dasar_alokasi.kad_minggu', 'komp_dasar_alokasi.kad_bulan', 'komp_dasar_alokasi.kad_bulan'); //set column field database for datatable orderable
    var $column_search_kompDasarAlokasi = array('komp_dasar.kd_semester', 'komp_dasar.kd_kode', 'komp_dasar.kd_keterangan', 'komp_dasar_alokasi.kad_jml_jam', 'komp_dasar_alokasi.kad_minggu', 'komp_dasar_alokasi.kad_bulan', 'komp_dasar_alokasi.kad_bulan'); //set column field database for datatable searchable
    var $order_kompDasarAlokasi = array('komp_dasar_alokasi.kda_id' => 'desc'); // default order 


    private function _get_datatables_query_kompDasarAlokasi()
    {
        $this->db->select('komp_dasar_alokasi.*, komp_dasar.kd_kode, komp_dasar.kd_semester');
        $this->db->from('komp_dasar_alokasi');
        $this->db->join('komp_dasar', 'komp_dasar.kd_id = komp_dasar_alokasi.kd_id');
        $i = 0;

        foreach ($this->column_search_kompDasarAlokasi as $item) // looping awal
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

                if (count($this->column_search_kompDasarAlokasi) - 1 == $i)
                    $this->db->group_end();
            }
            $i++;
        }

        if (isset($_POST['order'])) {
            $this->db->order_by($this->column_order_kompDasarAlokasi[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->order_kompDasarAlokasi)) {
            $order = $this->order_kompDasarAlokasi;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    function get_datatables_kompDasarAlokasi($id)
    {
        $this->_get_datatables_query_kompDasarAlokasi();
        $this->db->where('komp_dasar_alokasi.kd_id', $id);
        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    function count_filtered_kompDasarAlokasi($id)
    {
        $this->_get_datatables_query_kompDasarAlokasi();
        $this->db->where('komp_dasar_alokasi.kd_id', $id);
        $query = $this->db->get();

        return $query->num_rows();
    }

    public function count_all_kompDasarAlokasi($id)
    {
        $this->db->from('komp_dasar_alokasi');
        $this->db->where('komp_dasar_alokasi.kd_id', $id);
        return $this->db->count_all_results();
    }
    // End DataTable


    // KKM
    // DataTable
    // start datatables
    var $column_order_kkm = array(null, 'komp_dasar.kd_semester', 'komp_dasar.kd_kode', 'komp_dasar.kd_keterangan', '.kad_jml_jam', 'dat_kkm.kkm_daya_dukung', 'dat_kkm.kkm_intake'); //set column field database for datatable orderable
    var $column_search_kkm = array('komp_dasar.kd_semester', 'komp_dasar.kd_kode', 'komp_dasar.kd_keterangan', '.kad_jml_jam', 'dat_kkm.kkm_daya_dukung', 'dat_kkm.kkm_intake'); //set column field database for datatable searchable
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
        $this->db->where('kkm_id', $id);
        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    function count_filtered_kkm($id)
    {
        $this->_get_datatables_query_kkm();
        $this->db->where('kkm_id', $id);
        $query = $this->db->get();

        return $query->num_rows();
    }

    public function count_all_kkm($id)
    {
        $this->db->from('dat_kkm');
        $this->db->where('kkm_id', $id);
        return $this->db->count_all_results();
    }
    // End DataTable


}
