<?php
defined('BASEPATH') or exit('No direct script access allowed');

class JenisPegawai extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model("JenisPegawaiModel");
        $this->load->library('form_validation');
    }

    // Jenis Pegawai
    public function listJenisPegawai()
    {
        $data['dataJenisPegawai'] = $this->db->query("SELECT *FROM ref_jenis_pegawai")->result_array();
        $data['head'] = 'include/head';
        $data['header'] = 'include/header';
        $data['menu'] = 'include/menu';
        $data['content'] = 'page/jenisPegawai/listJenisPegawai';
        $data['footer'] = 'include/footer';
        $data['title'] = 'List Jenis Pegawai';
        $data['main_menu'] = 'master';
        $data['sub_menu'] = 'listJenisPegawai';
        $this->load->view('index', $data);
    }


    public function simpanJenisPegawai_ajax()
    {
        if ($this->input->is_ajax_request()) {

            $this->form_validation->set_rules("jenisPegawai[]", "Jenis Pegawai", 'required|is_unique[ref_jenis_pegawai.jns_pegawai_nm]', ['required' => '%s tidak boleh kosong', 'is_unique' => '%s sudah diinput']);

            if ($this->form_validation->run() != false) {

                $countJenisPegawai = count($this->input->post("jenisPegawai"));
                $jenisPegawai = $this->input->post('jenisPegawai');
                if ($countJenisPegawai > 0) {
                    for ($i = 0; $i < $countJenisPegawai; $i++) {
                        if (trim($_POST["jenisPegawai"][$i]) != '') {
                            $this->db->query("INSERT INTO ref_jenis_pegawai(jns_pegawai_nm) VALUES ('" . $_POST['jenisPegawai'][$i] . "')");
                        }
                    }
                }
                $msg = ['sukses' => 'Data Jenis Pegawai berhasil disimpan'];
            } else {
                $msg = [
                    'error' => '<div class="alert alert-warning mt-1 alert-styled-left alert-dismissible"><button type="button" class="close" data-dismiss="alert"><span>×</span></button><span class="font-weight-semibold">Warning!</span>' . validation_errors() .
                        '.</div>'
                ];
            }

            echo json_encode($msg);
        }
    }


    public function hapusJenisPegawai_ajax()
    {
        if ($this->input->is_ajax_request() == true) {
            $jenisPegawaiID = $this->input->post("jenisPegawaiID");
            $hapus = $this->JenisPegawaiModel->hapusJenisPegawai_ajax($jenisPegawaiID);
            if ($hapus) {
                $msg = ['sukses' => 'Data Jenis Pegawai Berhasil Terhapus'];
            }
            echo json_encode($msg);
        }
    }

    public function formEditJenisPegawai()
    {
        if ($this->input->is_ajax_request() == true) {
            $jenisPegawaiID = $this->input->post('jenisPegawaiID');
            $result = $this->db->query("SELECT *FROM ref_jenis_pegawai WHERE jns_pegawai_kd='$jenisPegawaiID'");

            if ($result->num_rows() > 0) {
                $row = $result->row_array();
                $data = [
                    'jenisPegawaiID' => $row['jns_pegawai_kd'],
                    'jenisPegawaiNama' => $row['jns_pegawai_nm']
                ];
            }
            $msg = [
                'sukses' => $this->load->view('page/jenisPegawai/modal/modalEditJenisPegawai', $data, true)
            ];
            echo json_encode($msg);
        }
    }


    public function updateJenisPegawai_ajax()
    {
        if ($this->input->is_ajax_request()) {
            $jenisPegawai = $this->JenisPegawaiModel;

            $this->form_validation->set_rules("jenisPegawaiNama", "Jenis Pegawai", 'required', ['required' => '%s tidak boleh kosong']);

            if ($this->form_validation->run() != false) {
                $jenisPegawaiID = $this->input->post('jenisPegawaiID');
                $jenisPegawaiNama = $this->input->post('jenisPegawaiNama');

                $data = array(
                    'jns_pegawai_nm' => $jenisPegawaiNama
                );
                $where = array(
                    'jns_pegawai_kd' => $jenisPegawaiID
                );
                $this->JenisPegawaiModel->update_data($where, $data, 'ref_jenis_pegawai');
                $msg = ['sukses' => 'Data Jenis Pegawai berhasil diupdate'];
            } else {
                $msg = [
                    'error' => '<div class="alert alert-warning mt-1 alert-styled-left alert-dismissible"><button type="button" class="close" data-dismiss="alert"><span>×</span></button><span class="font-weight-semibold">Warning!</span>' . validation_errors() .
                        '.</div>'
                ];
            }

            echo json_encode($msg);
        }
    }
}

    // End Jenis Pegawai
