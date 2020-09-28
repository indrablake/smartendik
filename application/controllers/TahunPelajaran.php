<?php
defined('BASEPATH') or exit('No direct script access allowed');

class TahunPelajaran extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model("TahunPelajaranModel");
        $this->load->library('form_validation');
    }

    // Tahun Pelajaran
    function listTahunPelajaran()
    {
        $data['dataTahunPelajaran'] = $this->db->query("SELECT *FROM ref_tahun_pelajaran")->result_array();
        $data['head'] = 'include/head';
        $data['header'] = 'include/header';
        $data['menu'] = 'include/menu';
        $data['content'] = 'page/tahunPelajaran/listTahunPelajaran';
        $data['footer'] = 'include/footer';
        $data['title'] = 'List Tahun Pelajaran';
        $data['main_menu'] = 'master';
        $data['sub_menu'] = 'listTahunPelajaran';
        $this->load->view('index', $data);
    }



    public function simpanTahunPelajaran_ajax()
    {
        if ($this->input->is_ajax_request()) {


            $tahunAjaran1 = $this->input->post("tahunAjaran");
            $tahunAjaran2 = intval($tahunAjaran1) + 1;
            $tahunAjaran = $tahunAjaran1 . '/' . $tahunAjaran2;

            $this->form_validation->set_rules('tahunAjaran', "Tahun Ajaran", 'required|is_unique[ref_tahun_pelajaran.thn_ajar_periode]', ['required' => '%s tidak boleh kosong', 'is_unique' => '%s sudah diinput']);
            $this->form_validation->set_rules("tanggalMulai", "Tanggal Mulai", 'required', ['required' => '%s tidak boleh kosong']);
            $this->form_validation->set_rules("tanggalBerakhir", "Tanggal Akhir", 'required', ['required' => '%s tidak boleh kosong']);

            if ($this->form_validation->run() != false) {
                $countTahunPelajaran = count($this->input->post("tahunAjaran"));
                $tahunAjaran1 = $this->input->post("tahunAjaran");
                $tahunAjaran2 = intval($tahunAjaran1) + 1;
                $tahunAjaran = $tahunAjaran1 . '/' . $tahunAjaran2;

                $tanggalMulai = $this->input->post('tanggalMulai');
                $tanggalBerakhir = $this->input->post('tanggalBerakhir');
                if ($countTahunPelajaran > 0) {
                    for ($i = 0; $i < $countTahunPelajaran; $i++) {
                        if (trim($_POST["tahunAjaran"]) != '') {
                            $this->db->query("INSERT INTO ref_tahun_pelajaran(thn_ajar_periode,thn_ajar_tgl_mulai,thn_ajar_tgl_akhir) VALUES ('$tahunAjaran','$tanggalMulai','$tanggalBerakhir')");
                        }
                    }
                }
                $msg = ['sukses' => 'Data Tahun Pelajaran berhasil disimpan'];
            } else {
                $msg = [
                    'error' => '<div class="alert alert-warning mt-1 alert-styled-left alert-dismissible"><button type="button" class="close" data-dismiss="alert"><span>×</span></button><span class="font-weight-semibold">Warning!</span>' . validation_errors() .
                        '.</div>'
                ];
            }
            echo json_encode($msg);
        }
    }


    public function hapusTahunPelajaran_ajax()
    {
        if ($this->input->is_ajax_request() == true) {
            $tahunAjaran = $this->input->post("jenisTahunPelajaran");
            $hapus = $this->TahunPelajaranModel->hapusTahunPelajaran_ajax($tahunAjaran);
            if ($hapus) {
                $msg = ['sukses' => 'Data Tahun Ajaran Berhasil Terhapus'];
            }
            echo json_encode($msg);
        }
    }

    public function formEditTahunPelajaran()
    {
        if ($this->input->is_ajax_request() == true) {
            $tahunPelajaran = $this->input->post('jenisTahunPelajaran');
            $result = $this->db->query("SELECT *FROM ref_tahun_pelajaran WHERE thn_ajar_kd='$tahunPelajaran'");

            if ($result->num_rows() > 0) {
                $row = $result->row_array();
                $data = [
                    'tahunAjaranKD' => $row['thn_ajar_kd'],
                    'tahunPeriode' => $row['thn_ajar_periode'],
                    'tanggalMulai' => $row['thn_ajar_tgl_mulai'],
                    'tanggalAkhir' => $row['thn_ajar_tgl_akhir']
                ];
            }
            $msg = [
                'sukses' => $this->load->view('page/tahunPelajaran/modal/modalEditTahunPelajaran', $data, true)
            ];
            echo json_encode($msg);
        }
    }


    public function updateTahunPelajaran_ajax()
    {
        if ($this->input->is_ajax_request()) {
            $tahunPelajaran = $this->TahunPelajaranModel;

            $this->form_validation->set_rules("tahunAjaranEdit", "Tahun Ajaran", 'required', ['required' => '%s tidak boleh kosong']);
            $this->form_validation->set_rules("tanggalMulai", "Tanggal Mulai", 'required', ['required' => '%s tidak boleh kosong']);
            $this->form_validation->set_rules("tanggalBerakhir", "Tanggal Berakhir", 'required', ['required' => '%s tidak boleh kosong']);

            if ($this->form_validation->run() != false) {
                $tahunAjaran1 = $this->input->post('tahunAjaranEdit');
                $tahunAjaranKD = $this->input->post('tahunAjaranKD');
                $tahunAjaran2 = intval($tahunAjaran1) + 1;

                $tahunAjaran = $tahunAjaran1 . '/' . $tahunAjaran2;
                $tanggalMulai = $this->input->post('tanggalMulai');
                $tanggalBerakhir = $this->input->post('tanggalBerakhir');
                $data = array(
                    'thn_ajar_periode' => $tahunAjaran,
                    'thn_ajar_tgl_mulai' => $tanggalMulai,
                    'thn_ajar_tgl_akhir' => $tanggalBerakhir
                );
                $where = array(
                    'thn_ajar_kd' => $tahunAjaranKD
                );
                $this->TahunPelajaranModel->update_data($where, $data, 'ref_tahun_pelajaran');
                $msg = ['sukses' => 'Data Tahun Pelajaran berhasil diupdate'];
            } else {
                $msg = [
                    'error' => '<div class="alert alert-warning mt-1 alert-styled-left alert-dismissible"><button type="button" class="close" data-dismiss="alert"><span>×</span></button><span class="font-weight-semibold">Warning!</span>' . validation_errors() .
                        '.</div>'
                ];
            }

            echo json_encode($msg);
        }
    }

    // Tahun Pelajaran

}
