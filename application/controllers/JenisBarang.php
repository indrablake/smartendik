<?php
defined('BASEPATH') or exit('No direct script access allowed');

class JenisBarang extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model("JenisBarangModel");
        $this->load->library('form_validation');
    }



    // Jenis Barang
    public function listJenisBarang()
    {
        $data['dataJenisBarang'] = $this->db->query("SELECT *FROM ref_jenis_barang")->result_array();
        $data['head'] = 'include/head';
        $data['header'] = 'include/header';
        $data['menu'] = 'include/menu';
        $data['content'] = 'page/jenisBarang/listJenisBarang';
        $data['footer'] = 'include/footer';
        $data['title'] = 'List Jenis Barang';
        $data['main_menu'] = 'iklan';
        $data['sub_menu'] = 'listJenisBarang';
        $this->load->view('index', $data);
    }


    public function simpanJenisBarang_ajax()
    {
        if ($this->input->is_ajax_request()) {
            $this->form_validation->set_rules("jenisBarang[]", "Jenis Barang", 'required|is_unique[ref_jenis_barang.jns_brg_nm]', ['required' => '%s tidak boleh kosong', 'is_unique' => '%s sudah diinput']);

            if ($this->form_validation->run() != false) {

                $countJenisBarang = count($this->input->post("jenisBarang"));
                $jenisBarang = $this->input->post('jenisBarang');
                if ($countJenisBarang > 0) {
                    for ($i = 0; $i < $countJenisBarang; $i++) {
                        if (trim($_POST["jenisBarang"][$i]) != '') {
                            $this->db->query("INSERT INTO ref_jenis_barang(jns_brg_nm) VALUES ('" . $_POST['jenisBarang'][$i] . "')");
                        }
                    }
                }
                $msg = ['sukses' => 'Data Jenis Barang berhasil disimpan'];
            } else {
                $msg = [
                    'error' => '<div class="alert alert-warning mt-1 alert-styled-left alert-dismissible"><button type="button" class="close" data-dismiss="alert"><span>×</span></button><span class="font-weight-semibold">Warning!</span>' . validation_errors() .
                        '.</div>'
                ];
            }
            echo json_encode($msg);
        }
    }


    public function hapusJenisBarang_ajax()
    {
        if ($this->input->is_ajax_request() == true) {
            $jenisBarangID = $this->input->post("jenisBarangID");
            $hapus = $this->JenisBarangModel->hapusJenisBarang_ajax($jenisBarangID);
            if ($hapus) {
                $msg = ['sukses' => 'Data Jenis Barang Berhasil Terhapus'];
            }
            echo json_encode($msg);
        }
    }

    public function formEditJenisBarang()
    {
        if ($this->input->is_ajax_request() == true) {
            $jenisBarangID = $this->input->post('jenisBarangID');
            $result = $this->db->query("SELECT *FROM ref_jenis_barang WHERE jns_brg_kd='$jenisBarangID'");

            if ($result->num_rows() > 0) {
                $row = $result->row_array();
                $data = [
                    'jenisBarangID' => $row['jns_brg_kd'],
                    'jenisBarangNama' => $row['jns_brg_nm']
                ];
            }
            $msg = [
                'sukses' => $this->load->view('page/jenisBarang/modal/modalEditJenisBarang', $data, true)
            ];
            echo json_encode($msg);
        }
    }


    public function updateJenisBarang_ajax()
    {
        if ($this->input->is_ajax_request()) {
            $jenisBarang = $this->JenisBarangModel;

            $this->form_validation->set_rules("jenisBarangNama", "Jenis Barang", 'required', ['required' => '%s tidak boleh kosong']);

            if ($this->form_validation->run() != false) {
                $jenisBarangID = $this->input->post('jenisBarangID');
                $jenisBarangNama = $this->input->post('jenisBarangNama');

                $data = array(
                    'jns_brg_nm' => $jenisBarangNama
                );
                $where = array(
                    'jns_brg_kd' => $jenisBarangID
                );
                $jenisBarang->update_data($where, $data, 'ref_jenis_barang');
                $msg = ['sukses' => 'Data Jenis Barang berhasil diupdate'];
            } else {
                $msg = [
                    'error' => '<div class="alert alert-warning mt-1 alert-styled-left alert-dismissible"><button type="button" class="close" data-dismiss="alert"><span>×</span></button><span class="font-weight-semibold">Warning!</span>' . validation_errors() .
                        '.</div>'
                ];
            }

            echo json_encode($msg);
        }
    }


    // End Jenis Barang
}
