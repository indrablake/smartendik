<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Api extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('BeritaModel', 'berita');
        $this->load->model('IklanModel', 'iklan');
    }

    public function sekolah()
    {
        header('Content-Type: application/json');
        if ($this->input->is_ajax_request()) {
            $sid = ($this->input->get('id') ? $this->input->get('id') : null);
            $queryGroup = $this->db->query("SELECT *FROM dat_sekolah " . ($sid != null ? "where sekolah_kd = '$sid'" : "") . "");
            $queryGroup = ($sid != null ? $queryGroup->result_array() : $queryGroup->result_array());
        } else {
            $queryGroup = "Invalid method";
        }
        echo json_encode($queryGroup);
    }

    public function kelas()
    {
        header('Content-Type: application/json');
        if ($this->input->is_ajax_request()) {
            $sid = ($this->input->get('id') ? $this->input->get('id') : null);
            $queryGroup = $this->db->query("SELECT *FROM sekolah_kelas " . ($sid != null ? "where sekolah_kd = '$sid'" : "") . "");
            $queryGroup = ($sid != null ? $queryGroup->result_array() : $queryGroup->result_array());
        } else {
            $queryGroup = "Invalid method";
        }
        echo json_encode($queryGroup);
    }

    public function snp_poin()
    {
        header('Content-Type: application/json');
        if ($this->input->is_ajax_request()) {
            $sid = ($this->input->get('id') ? $this->input->get('id') : null);
            $queryGroup = $this->db->query("SELECT * FROM snp_poin sp inner join ref_snp rs on sp.snp_id = rs.snp_id " . ($sid != null ? "where rs.snp_id = '$sid' " : "") . "");
            $queryGroup = ($sid != null ? $queryGroup->result_array() : $queryGroup->row_array());
        } else {
            $queryGroup = "Invalid method";
        }
        echo json_encode($queryGroup);
    }

    public function snp_nilai()
    {
        header('Content-Type: application/json');
        if ($this->input->is_ajax_request()) {
            $sid = ($this->input->get('id') ? $this->input->get('id') : null);
            $queryGroup = $this->db->query("SELECT * FROM snp_poin_ket_nilai spkn " . ($sid != null ? "where spkn.snpp_id = '$sid'   " : "") . "");
            $queryGroup = ($sid != null ? $queryGroup->result_array() : $queryGroup->row_array());
        } else {
            $queryGroup = "Invalid method";
        }
        echo json_encode($queryGroup);
    }

    public function snp_ref()
    {
        header('Content-Type: application/json');
        if ($this->input->is_ajax_request()) {
            $sid = ($this->input->get('id') ? $this->input->get('id') : null);
            $queryGroup = $this->db->query("SELECT * FROM  " . ($sid != null ? "where spkn.snpp_id = '$sid'" : "") . "");
            $queryGroup = ($sid != null ? $queryGroup->result_array() : $queryGroup->row_array());
        } else {
            $queryGroup = "Invalid method";
        }
        echo json_encode($queryGroup);
    }

    public function download()
    {
        $id = $this->input->get('id');
    }
}

/* End of file Api.php */
/* Location: ./application/controllers/Api.php */