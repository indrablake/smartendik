<?php
defined('BASEPATH') or exit('No direct script access allowed');

class JenjangSekolah extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model("JenjangSekolahModel");
        $this->load->library('form_validation');
    }


    // Jenjang Kelas

    public function listJenjangSekolah()
    {
        $data['dataJenjangSekolah'] = $this->db->query("SELECT *FROM ref_jenjang_sekolah")->result_array();
        $data['head'] = 'include/head';
        $data['header'] = 'include/header';
        $data['menu'] = 'include/menu';
        $data['content'] = 'page/jenjangsekolah/listJenjang';
        $data['footer'] = 'include/footer';
        $data['title'] = 'List Jenjang Sekolah';
        $data['main_menu'] = 'master';
        $data['sub_menu'] = 'listJenjangSekolah';
        $this->load->view('index', $data);
    }


    public function simpanJenjangSekolah_ajax()
    {
        if ($this->input->is_ajax_request()) {


            $this->form_validation->set_rules("jenjangSekolah[]", "Jengjang Sekolah", 'required|is_unique[ref_jenjang_sekolah.jenjang_nm]', ['required' => '%s tidak boleh kosong', 'is_unique' => '%s sudah diinput']);

            if ($this->form_validation->run() != false) {

                $countJenjangSekolah = count($this->input->post("jenjangSekolah"));
                $jenjangSekolah = $this->input->post('jenjangSekolah');

                if ($countJenjangSekolah > 0) {
                    for ($i = 0; $i < $countJenjangSekolah; $i++) {
                        if (trim($_POST["jenjangSekolah"][$i]) != '') {
                            $this->db->query("INSERT INTO ref_jenjang_sekolah(jenjang_nm) VALUES ('" . $_POST['jenjangSekolah'][$i] . "')");
                        }
                    }
                }
                $msg = ['sukses' => 'Data Jenjang Sekolah berhasil disimpan'];
            } else {
                $msg = [
                    'error' => '<div class="alert alert-warning mt-1 alert-styled-left alert-dismissible"><button type="button" class="close" data-dismiss="alert"><span>×</span></button><span class="font-weight-semibold">Warning!</span>' . validation_errors() .
                        '.</div>'
                ];
            }


            echo json_encode($msg);
        }
    }


    public function hapusJenjang_ajax()
    {
        if ($this->input->is_ajax_request() == true) {
            $jenjangID = $this->input->post("jenjangID");
            $hapus = $this->JenjangSekolahModel->hapusJenjang_ajax($jenjangID);
            if ($hapus) {
                $msg = ['sukses' => 'Data Provinsi Berhasil Terhapus'];
            }
            echo json_encode($msg);
        }
    }

    public function formEditJenjang()
    {
        if ($this->input->is_ajax_request() == true) {
            $jenjangID = $this->input->post('jenjangID');
            $result = $this->db->query("SELECT *FROM ref_jenjang_sekolah WHERE jenjang_kd='$jenjangID'");

            if ($result->num_rows() > 0) {
                $row = $result->row_array();
                $data = [
                    'jenjangKD' => $row['jenjang_kd'],
                    'jenjangNama' => $row['jenjang_nm'],
                ];
            }
            $msg = [
                'sukses' => $this->load->view('page/jenjangsekolah/modal/modalEditJenjang', $data, true)
            ];
            echo json_encode($msg);
        }
    }


    public function updateJenjang_ajax()
    {
        if ($this->input->is_ajax_request()) {
            $jenjangSekolah = $this->JenjangSekolahModel;

            $this->form_validation->set_rules("jenjangNama", "Jenjang Nama Sekolah", 'required', ['required' => '%s tidak boleh kosong']);


            if ($this->form_validation->run() != false) {
                $jenjangNama = $this->input->post('jenjangNama');
                $jenjangKD = $this->input->post('jenjangKD');

                $data = array(
                    'jenjang_nm' => $jenjangNama
                );
                $where = array(
                    'jenjang_kd' => $jenjangKD
                );
                $this->JenjangSekolahModel->update_data($where, $data, 'ref_jenjang_sekolah');
                $msg = ['sukses' => 'Data Jenjang Sekolah berhasil diupdate'];
            } else {
                $msg = [
                    'error' => '<div class="alert alert-warning mt-1 alert-styled-left alert-dismissible"><button type="button" class="close" data-dismiss="alert"><span>×</span></button><span class="font-weight-semibold">Warning!</span>' . validation_errors() .
                        '.</div>'
                ];
            }

            echo json_encode($msg);
        }
    }

    // End Jenjang Sekolah
}
