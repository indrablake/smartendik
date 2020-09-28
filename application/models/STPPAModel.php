<?php
defined('BASEPATH') or exit('No direct script access allowed');

class STPPAModel extends CI_Model
{

    var $column_order = array(null, 'stppa.jenjang_kd',  'ref_tahun_pelajaran.thn_ajar_periode', '	ref_tahun_pelajaran.thn_ajar_tgl_mulai', 'ref_tahun_pelajaran.thn_ajar_tgl_akhir', null); //set column field database for datatable orderable
    var $column_order_sub_lingkup = array(null, null, 'stppa_sub_lingkup.ssl_keterangan', 'total', null); //set column field database for datatable orderable
    var $column_order_detail = array(null, null, 'stppa_detail.ssd_keterangan', null); //set column field database for datatable orderable
    var $column_search = array('ref_jenjang_sekolah.jenjang_nm'); //set column field database for datatable searchable
    var $column_search_sub_lingkup = array('stppa_sub_lingkup.ssl_keterangan'); //set column field database for datatable searchable
    var $column_search_detail = array('stppa_detail.ssd_keterangan'); //set column field database for datatable searchable
    // var $column_search = array('ref_jenjang_sekolah.jenjang_nm,ref_tahun_pelajaran.thn_ajar_periode,ref_tahun_pelajaran.thn_ajar_tgl_mulai, ref_tahun_pelajaran.thn_ajar_tgl_akhir'); //set column field database for datatable searchable
    var $order = array('stppa.jenjang_kd' => 'desc'); // default order 
    var $order_sub_lingkup = array('stppa_sub_lingkup.ssl_keterangan' => 'desc'); // default order 
    var $order_detail = array('stppa_detail.ssd_keterangan' => 'desc'); // default order 

    public function _get_datatables_query()
    {
        $this->db->select('stppa.*,ref_jenjang_sekolah.jenjang_nm as JENJANG_NM ,IFNULL(sl.sl_keterangan,"-") as LINGKUP,ref_tahun_pelajaran.thn_ajar_periode as TAHUN_AJAR,ref_tahun_pelajaran.thn_ajar_tgl_mulai AS MULAI, ref_tahun_pelajaran.thn_ajar_tgl_akhir AS AKHIR');
        // $this->db->select('stppa.*, ref_jenjang_sekolah.jenjang_nm as JENJANG_NM,IFNULL(stppa_lingkup.sl_keterangan,"-") as LINGKUP, ref_tahun_pelajaran.thn_ajar_periode as TAHUN_AJAR, ref_tahun_pelajaran.thn_ajar_tgl_mulai AS MULAI, ref_tahun_pelajaran.thn_ajar_tgl_akhir AS AKHIR');
        $this->db->from('stppa');
        $this->db->join('stppa_lingkup sl', 'sl.stppa_id = stppa.stppa_id', 'left');
        // $this->db->join('stppa_sub_lingkup', 'stppa_sub_lingkup.sl_id = stppa_lingkup.sl_id');
        $this->db->join('ref_jenjang_sekolah', 'stppa.jenjang_kd = ref_jenjang_sekolah.jenjang_kd', 'left');
        $this->db->join('ref_tahun_pelajaran', 'stppa.thn_ajar_kd = ref_tahun_pelajaran.thn_ajar_kd', 'left');
        /*$this->db->select('stppa.stppa_id');
	    $this->db->from('stppa');*/
        //return $this->db->get()->result_array();
        $i = 0;

        foreach ($this->column_search as $item) // looping awal
        {
            if (isset($_POST['search']['value'])) // jika datatable mengirimkan pencarian dengan metode POST
            {

                if ($i === 0) // looping awal
                {
                    $this->db->group_start();
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }

                if (count($this->column_search) - 1 == $i)
                    $this->db->group_end();
            }
            $i++;
        }

        if (isset($_POST['order'])) {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->order)) {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
        $this->db->group_by('stppa.stppa_id');
    }


    public function _get_datatables_query_sub_lingkup($id_lingkup)
    {
        $this->db->select('stppa_sub_lingkup.ssl_id ,stppa_sub_lingkup.ssl_keterangan as keterangan, count(stppa_detail.ssl_id) as total');
        // $this->db->select('stppa.*, ref_jenjang_sekolah.jenjang_nm as JENJANG_NM,IFNULL(stppa_lingkup.sl_keterangan,"-") as LINGKUP, ref_tahun_pelajaran.thn_ajar_periode as TAHUN_AJAR, ref_tahun_pelajaran.thn_ajar_tgl_mulai AS MULAI, ref_tahun_pelajaran.thn_ajar_tgl_akhir AS AKHIR');
        $this->db->from('stppa_sub_lingkup');
        $this->db->join('stppa_lingkup', 'stppa_sub_lingkup.sl_id = stppa_lingkup.sl_id', 'left');
        $this->db->join('stppa_detail', 'stppa_sub_lingkup.ssl_id = stppa_detail.ssl_id', 'left');
        $this->db->group_by('stppa_sub_lingkup.ssl_id');
        $i = 0;
        /*
	   SELECT stppa_sub_lingkup.ssl_keterangan as `keterangan`, COUNT(stppa_detail.ssl_id) as `TOTAL`
	   FROM `stppa_sub_lingkup`
	   LEFT JOIN `stppa_detail` ON stppa_sub_lingkup.ssl_id = stppa_detail.ssl_id
	   WHERE stppa_sub_lingkup.`sl_id` = '3'
	   GROUP BY stppa_sub_lingkup.`ssl_id`
	   ORDER BY `TOTAL`
	    */
        $this->db->where('stppa_sub_lingkup.sl_id', $id_lingkup);
        // $this->db->where('stppa_sub_lingkup.sl_id != ', null,FALSE);

        foreach ($this->column_search_sub_lingkup as $item) // looping awal
        {
            if (isset($_POST['search']['value'])) // jika datatable mengirimkan pencarian dengan metode POST
            {

                if ($i === 0) // looping awal
                {
                    $this->db->group_start();
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }

                if (count($this->column_search_sub_lingkup) - 1 == $i)
                    $this->db->group_end();
            }
            $i++;
        }

        if (isset($_POST['order'])) {
            $this->db->order_by($this->column_order_sub_lingkup[$_POST['order']['0']['column']], $_POST['order']['0']['dir'], 'total');
        } else if (isset($this->order)) {
            $order = $this->order_sub_lingkup;
            $this->db->order_by(key($order), $order[key($order)], 'total');
        }
        //$this->db->group_by('stppa.stppa_id');
    }

    public function _get_datatables_query_detail($id_sublingkup)
    {
        $this->db->select('stppa_detail.ssd_id,stppa_detail.ssd_keterangan AS keterangan');
        // $this->db->select('stppa.*, ref_jenjang_sekolah.jenjang_nm as JENJANG_NM,IFNULL(stppa_lingkup.sl_keterangan,"-") as LINGKUP, ref_tahun_pelajaran.thn_ajar_periode as TAHUN_AJAR, ref_tahun_pelajaran.thn_ajar_tgl_mulai AS MULAI, ref_tahun_pelajaran.thn_ajar_tgl_akhir AS AKHIR');
        $this->db->from('stppa_detail');
        //$this->db->join('stppa_sub_lingkup', 'stppa_detail.ssl_id = stppa_sub_lingkup.ssl_id','inner');
        $this->db->group_by('stppa_detail.ssd_id');
        $i = 0;
        $this->db->where('stppa_detail.ssl_id', $id_sublingkup);
        // $this->db->where('stppa_detail.sl_id != ', null,FALSE);

        foreach ($this->column_search_detail as $item) // looping awal
        {
            if (isset($_POST['search']['value'])) // jika datatable mengirimkan pencarian dengan metode POST
            {

                if ($i === 0) // looping awal
                {
                    $this->db->group_start();
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }

                if (count($this->column_search_detail) - 1 == $i)
                    $this->db->group_end();
            }
            $i++;
        }

        if (isset($_POST['order'])) {
            $this->db->order_by($this->column_order_detail[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->order_detail)) {
            $order = $this->order_detail;
            $this->db->order_by(key($order), $order[key($order)]);
        }
        //$this->db->group_by('stppa.stppa_id');
    }

    public function get_datatables()
    {
        $this->_get_datatables_query();
        /*  if ($_POST['length'] != -1)
	        $this->db->limit($_POST['length'], $_POST['start']);*/
        $query = $this->db->get();
        return $query->result();
    }


    public function get_datatables_sub_lingkup($id_sub)
    {
        $this->_get_datatables_query_sub_lingkup($id_sub);
        $query = $this->db->get();
        return $query->result();
    }

    public function get_datatables_detail($id_sub)
    {
        $this->_get_datatables_query_detail($id_sub);
        $query = $this->db->get();
        return $query->result();
    }

    public function count_all()
    {
        $this->db->from('stppa');
        return $this->db->count_all_results();
    }

    public function count_filtered()
    {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all_sub_lingkup()
    {
        $this->db->from('stppa_sub_lingkup');
        return $this->db->count_all_results();
    }

    public function count_filtered_sub_lingkup($id_lingkup)
    {
        $this->_get_datatables_query_sub_lingkup($id_lingkup);
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all_detail()
    {
        // $this->db->get_where('stppa_detail',array("ssl_id"=>$id_sublingkup));
        $this->db->from('stppa_detail');
        return $this->db->count_all_results();
    }

    public function count_filtered_detail($id_sublingkup)
    {
        $this->_get_datatables_query_detail($id_sublingkup);
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function add($table, $value)
    {
        $this->db->insert($table, $value);
        return $this->db->insert_id();
    }

    public function update($table, $id, $value)
    {
        $this->db->where($id);
        return $this->db->update($table, $value);
    }

    public function delete($table, $id)
    {
        return $this->db->delete($table, array("stppa_id" => $id));
    }

    public function getSTPPA($value)
    {
        if (!empty($value)) {
            if (isset($value['limit']) && isset($value['offset'])) {
                $this->db->limit($value['limit']);
                $this->db->offset($value['offset']);
            } else {
                if (isset($value['id'])) {
                    return    $this->db->get_where('stppa', 'stppa_id', $value['id']);
                } else {
                    return $this->db->get('stppa')->result_array();
                }
            }
        } else {
            return $this->db->get('stppa')->result_array();
        }
    }


    function getSTPPAJoin($id)
    {
        $result = $this->db->query("SELECT  rjs.jenjang_nm, sl.sl_keterangan AS lingkup, stppa.*, rtp.thn_ajar_periode AS periode, rtp.thn_ajar_tgl_mulai AS mulai, rtp.thn_ajar_tgl_akhir AS akhir FROM stppa INNER JOIN stppa_lingkup sl ON sl.stppa_id = stppa.stppa_id INNER JOIN ref_jenjang_sekolah rjs ON stppa.jenjang_kd = rjs.jenjang_kd INNER JOIN ref_tahun_pelajaran rtp ON stppa.thn_ajar_kd = rtp.thn_ajar_kd WHERE stppa.stppa_id='$id'");
        return $result;
    }

    public function getSTPPALingkup($value)
    {
        if (!empty($value)) {
            if (isset($value['limit']) && isset($value['offset'])) {
                $this->db->limit($value['limit']);
                $this->db->offset($value['offset']);
            } else {
                if (isset($value['id'])) {
                    return    $this->db->get_where('stppa_lingkup', 'sl_id', $value['id']);
                } else {
                    return $this->db->get('stppa_lingkup')->result_array();
                }
            }
        } else {
            return $this->db->get('stppa_lingkup')->result_array();
        }
    }

    public function getSTPPASubLingkup($value)
    {
        if (!empty($value)) {
            if (isset($value['limit']) && isset($value['offset'])) {
                $this->db->limit($value['limit']);
                $this->db->offset($value['offset']);
            } else {
                if (isset($value['id'])) {
                    return    $this->db->get_where('stppa_sub_lingkup', 'ssl_id', $value['id']);
                } else {
                    return $this->db->get('stppa_sub_lingkup')->result_array();
                }
            }
        } else {
            return $this->db->get('stppa_sub_lingkup')->result_array();
        }
    }

    public function getSTPPADetail($value)
    {
        if (!empty($value)) {
            if (isset($value['limit']) && isset($value['offset'])) {
                $this->db->limit($value['limit']);
                $this->db->offset($value['offset']);
            } else {
                if (isset($value['id'])) {
                    return    $this->db->get_where('stppa_detail', 'ssd_id', $value['id']);
                } else {
                    return $this->db->get('stppa_detail')->result_array();
                }
            }
        } else {
            return $this->db->get('stppa_detail')->result_array();
        }
    }

    public function hapusSTPPA_ajax($stppa_id)
    {
        return $this->db->delete('stppa', ['stppa_id' => $stppa_id]);
    }
    public function hapusSTPPALingkup_ajax($sl_id)
    {
        return $this->db->delete('stppa_lingkup', ['sl_id' => $sl_id]);
    }
    public function hapusSTPPASubLingkup_ajax($ssl_id)
    {
        return $this->db->delete('stppa_sub_lingkup', ['ssl_id' => $ssl_id]);
    }
    public function hapusSTPPASubLingkupData_ajax($sl_id)
    {
        return $this->db->delete('stppa_sub_lingkup', ['sl_id' => $sl_id]);
    }
    public function hapusSTPPADetail_ajax($ssd_id)
    {
        return $this->db->delete('stppa_detail', ['ssd_id' => $ssd_id]);
    }
    public function hapusSTPPADetailData_ajax($ssl_id)
    {
        return $this->db->delete('stppa_detail', ['ssl_id' => $ssl_id]);
    }
}

/* End of file STPPAModel.php */
/* Location: ./application/models/STPPAModel.php */