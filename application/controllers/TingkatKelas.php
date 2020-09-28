<?php
defined('BASEPATH') or exit('No direct script access allowed');

class TingkatKelas extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model("TingkatKelasModel");
        $this->load->library('form_validation');
    }



    // List Kelas
    function listTingkatKelas()
    {
        $data['dataTingkatKelas'] = $this->db->query("SELECT *FROM ref_tingkat_kelas")->result_array();
        $data['head'] = 'include/head';
        $data['header'] = 'include/header';
        $data['menu'] = 'include/menu';
        $data['content'] = 'page/tingkatKelas/listTingkatKelas';
        $data['footer'] = 'include/footer';
        $data['title'] = 'List Tingkat Kelas';
        $data['main_menu'] = 'master';
        $data['sub_menu'] = 'listTingkatKelas';
        $this->load->view('index', $data);
    }



    public function simpanTingkatKelas_ajax()
    {
        if ($this->input->is_ajax_request()) {

            $this->form_validation->set_rules("levelKelas", "Level Kelas", 'required|is_unique[ref_tingkat_kelas.tk_kls_kode]', ['required' => '%s tidak boleh kosong', 'is_unique' => '%s sudah ada']);

            $this->form_validation->set_rules("kodeKelas", "Kode Kelas", 'required', ['required' => '%s tidak boleh kosong']);
            if ($this->form_validation->run() != false) {
                $countKelas = count($this->input->post("levelKelas"));
                $levelKelas = $this->input->post('levelKelas');
                $kodeKelas = $this->input->post('kodeKelas');
                if ($countKelas > 0) {
                    for ($i = 0; $i < $countKelas; $i++) {
                        if (trim($_POST["levelKelas"]) != '') {
                            $this->db->query("INSERT INTO ref_tingkat_kelas(tk_kls_level,tk_kls_kode) VALUES ('$levelKelas','$kodeKelas')");
                        }
                    }
                }
                $msg = ['sukses' => 'Data Tingkat Kelas berhasil disimpan'];
            } else {
                $msg = [
                    'error' => '<div class="alert alert-warning mt-1 alert-styled-left alert-dismissible"><button type="button" class="close" data-dismiss="alert"><span>×</span></button><span class="font-weight-semibold">Warning!</span>' . validation_errors() .
                        '.</div>'
                ];
            }
            echo json_encode($msg);
        }
    }


    public function hapusTingkatKelas_ajax()
    {
        if ($this->input->is_ajax_request() == true) {
            $kelasLevel = $this->input->post("jenisTingkatKelas");
            $hapus = $this->TingkatKelasModel->hapusTingkatKelas_ajax($kelasLevel);
            if ($hapus) {
                $msg = ['sukses' => 'Data Tingkat Kelas Berhasil Terhapus'];
            }
            echo json_encode($msg);
        }
    }

    public function formEditTingkatKelas()
    {
        if ($this->input->is_ajax_request() == true) {
            $kelasLevel = $this->input->post('jenisTingkatKelas');
            $result = $this->db->query("SELECT *FROM ref_tingkat_kelas WHERE tk_kls_level='$kelasLevel'");

            if ($result->num_rows() > 0) {
                $row = $result->row_array();
                $data = [
                    'kelasLevel' => $row['tk_kls_level'],
                    'kelasKode' => $row['tk_kls_kode']
                ];
            }
            $msg = [
                'sukses' => $this->load->view('page/tingkatKelas/modal/modalEditTingkatKelas', $data, true)
            ];
            echo json_encode($msg);
        }
    }


    public function updateTingkatKelas_ajax()
    {
        if ($this->input->is_ajax_request()) {
            $tingkatKelas = $this->TingkatKelasModel;

            $this->form_validation->set_rules("kelasLevel", "Nama Level", 'required', ['required' => '%s tidak boleh kosong']);
            $this->form_validation->set_rules("kelasKode", "Nama Kelas", 'required', ['required' => '%s tidak boleh kosong']);

            if ($this->form_validation->run() != false) {
                $kelasLevel = $this->input->post('kelasLevel');
                $kelasKode = $this->input->post('kelasKode');
                $kelasLevelNew = $this->input->post('kelasLevelNew');
                $data = array(
                    'tk_kls_level' => $kelasLevelNew,
                    'tk_kls_kode' => $kelasKode
                );
                $where = array(
                    'tk_kls_level' => $kelasLevel
                );
                $this->TingkatKelasModel->update_data($where, $data, 'ref_tingkat_kelas');
                $msg = ['sukses' => 'Data Tingkat Kelas berhasil diupdate'];
            } else {
                $msg = [
                    'error' => '<div class="alert alert-warning mt-1 alert-styled-left alert-dismissible"><button type="button" class="close" data-dismiss="alert"><span>×</span></button><span class="font-weight-semibold">Warning!</span>' . validation_errors() .
                        '.</div>'
                ];
            }

            echo json_encode($msg);
        }
    }
    // End Tingkat Kelas
}
