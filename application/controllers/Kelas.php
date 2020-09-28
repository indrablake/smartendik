<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kelas extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model("KelasModel");
        $this->load->library('form_validation');
    }

    public function getKelasBySekolah()
    {
        if ($this->input->is_ajax_request()) {
            $sekolah_kd = $this->input->post('sekolah');
            $data = $this->db->get_where('sekolah_kelas', array("sekolah_kd" => $sekolah_kd))->result_array();
            echo json_encode($data);
        } else {
            exit("Tidak dapat menampilkan");
        }
    }


    // Kelas
    public function listKelas()
    {
        $data['dataKelas'] = $this->db->query("SELECT sekolah_kelas.*,dat_sekolah.sekolah_nm FROM sekolah_kelas INNER JOIN dat_sekolah ON dat_sekolah.sekolah_kd=sekolah_kelas.sekolah_kd")->result_array();
        $data['head'] = 'include/head';
        $data['header'] = 'include/header';
        $data['menu'] = 'include/menu';
        $data['content'] = 'page/kelas/listKelas';
        $data['footer'] = 'include/footer';
        $data['title'] = 'List Kelas';
        $data['main_menu'] = 'master';
        $data['sub_menu'] = 'listKelas';
        $this->load->view('index', $data);
    }


    public function simpanKelas_ajax()
    {
        if ($this->input->is_ajax_request()) {
            $this->form_validation->set_rules("jenisKelas[]", "Level Kelas", 'required', ['required' => '%s tidak boleh kosong']);
            $this->form_validation->set_rules("namaKelas[]", "Nama Kelas", 'required', ['required' => '%s tidak boleh kosong']);

            if ($this->form_validation->run() != false) {

                $countKelas = count($this->input->post("jenisKelas"));
                $jenisKelas = $this->input->post('jenisKelas');
                $sekolahKD = $this->input->post('sekolahKD');
                if ($countKelas > 0) {
                    for ($i = 0; $i < $countKelas; $i++) {
                        if (trim($_POST["jenisKelas"][$i]) != '') {
                            $this->db->query("INSERT INTO sekolah_kelas(sekolah_kd,tk_kls_level,kelas_nm) VALUES ('$sekolahKD','" . $_POST['jenisKelas'][$i] . "','" . $_POST['namaKelas'][$i] . "')");
                        }
                    }
                }
                $msg = ['sukses' => 'Data Kelas berhasil disimpan'];
            } else {
                $msg = [
                    'error' => '<div class="alert alert-warning mt-1 alert-styled-left alert-dismissible"><button type="button" class="close" data-dismiss="alert"><span>×</span></button><span class="font-weight-semibold">Warning!</span>' . validation_errors() .
                        '.</div>'
                ];
            }

            echo json_encode($msg);
        }
    }


    public function hapusKelas_ajax()
    {
        if ($this->input->is_ajax_request() == true) {
            $jenisKelas = $this->input->post("jenisKelas");
            $hapus = $this->KelasModel->hapusKelas_ajax($jenisKelas);
            if ($hapus) {
                $msg = ['sukses' => 'Data Kelas Berhasil Terhapus'];
            }
            echo json_encode($msg);
        }
    }

    public function formEditKelas()
    {
        if ($this->input->is_ajax_request() == true) {
            $jenisKelas = $this->input->post('jenisKelas');
            $result = $this->db->query("SELECT sekolah_kelas.*,ref_tingkat_kelas.tk_kls_kode,dat_sekolah.sekolah_nm,dat_sekolah.sekolah_npsn FROM sekolah_kelas INNER JOIN dat_sekolah ON dat_sekolah.sekolah_kd=sekolah_kelas.sekolah_kd INNER JOIN ref_tingkat_kelas ON ref_tingkat_kelas.tk_kls_level = sekolah_kelas.tk_kls_level WHERE kelas_kd='$jenisKelas'");

            if ($result->num_rows() > 0) {
                $row = $result->row_array();
                $data = [
                    'kelasKD' => $row['kelas_kd'],
                    'kelasNama' => $row['kelas_nm'],
                    'kelasLevel' => $row['tk_kls_level'],
                    'kelasKode' => $row['tk_kls_kode'],
                    'sekolahNama' => $row['sekolah_nm'],
                    'sekolahNPSN' => $row['sekolah_npsn'],
                    'sekolahKD' => $row['sekolah_kd']
                ];
            }
            $msg = [
                'sukses' => $this->load->view('page/kelas/modal/modalEditKelas', $data, true)
            ];
            echo json_encode($msg);
        }
    }


    public function updateKelas_ajax()
    {
        if ($this->input->is_ajax_request()) {
            $kelas = $this->KelasModel;

            $this->form_validation->set_rules("jenisKelas", "Nama Kelas", 'required', ['required' => '%s tidak boleh kosong']);

            if ($this->form_validation->run() != false) {
                $kelasKD = $this->input->post('kelasKD');
                $jenisKelas = $this->input->post('jenisKelas');
                $namaKelas = $this->input->post('namaKelas');
                $sekolahKD = $this->input->post('sekolahKD');

                $data = array(
                    'sekolah_kd' => $sekolahKD,
                    'tk_kls_level' => $namaKelas,
                    'kelas_nm' => $jenisKelas
                );
                $where = array(
                    'kelas_kd' => $kelasKD
                );
                $this->KelasModel->update_data($where, $data, 'sekolah_kelas');
                $msg = ['sukses' => 'Data Kelas berhasil diupdate'];
            } else {
                $msg = [
                    'error' => '<div class="alert alert-warning mt-1 alert-styled-left alert-dismissible"><button type="button" class="close" data-dismiss="alert"><span>×</span></button><span class="font-weight-semibold">Warning!</span>' . validation_errors() .
                        '.</div>'
                ];
            }

            echo json_encode($msg);
        }
    }
    // End Kelas

}
