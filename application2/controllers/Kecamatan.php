<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kecamatan extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model("KecamatanModel");
        $this->load->library('form_validation');
    }




    // Kecamatan
    public function listKecamatan()
    {
        $data['dataProvinsi'] = $this->db->query("SELECT *FROM ref_propinsi")->result_array();
        $data['dataKabupaten'] = $this->db->query("SELECT *FROM ref_dati2")->result_array();
        $data['dataKecamatan'] = $this->db->query("SELECT ref_dati2.dati2_nm, ref_propinsi.propinsi_nm,ref_kecamatan.* FROM ref_kecamatan INNER JOIN ref_dati2 ON ref_dati2.dati2_kd=ref_kecamatan.dati2_kd INNER JOIN ref_propinsi ON ref_propinsi.propinsi_kd=ref_kecamatan.propinsi_kd")->result_array();
        $data['head'] = 'include/head';
        $data['header'] = 'include/header';
        $data['menu'] = 'include/menu';
        $data['content'] = 'page/kecamatan/listKecamatan';
        $data['footer'] = 'include/footer';
        $data['title'] = 'List Kecamatan';
        $data['main_menu'] = 'master';
        $data['sub_menu'] = 'listKecamatan';
        $this->load->view('index', $data);
    }


    public function simpanKecamatan_ajax()
    {
        if ($this->input->is_ajax_request()) {
            $this->form_validation->set_rules("propinsiID", "Nama Provinsi", 'required', ['required' => '%s tidak boleh kosong']);
            $this->form_validation->set_rules("kabupatenID", "Nama Kabupaten", 'required', ['required' => '%s tidak boleh kosong']);
            $this->form_validation->set_rules("kecamatanNama[]", "Nama Kecamatan", 'required', ['required' => '%s tidak boleh kosong']);
            // $this->form_validation->set_rules("subTemaPromes", "SubTema Program Semester", 'required');
            if ($this->form_validation->run() != false) {
                $countKecamatanNama = count($this->input->post("kecamatanNama"));
                $propinsiID = $this->input->post('propinsiID');
                $kabupatenID = $this->input->post('kabupatenID');
                if ($countKecamatanNama > 0) {
                    for ($i = 0; $i < $countKecamatanNama; $i++) {
                        if (trim($_POST["kecamatanNama"][$i]) != '') {
                            $this->db->query("INSERT INTO ref_kecamatan(propinsi_kd,dati2_kd,kecamatan_nm) VALUES ('$propinsiID','$kabupatenID','" . $_POST['kecamatanNama'][$i] . "')");
                        }
                    }
                }
                $msg = ['sukses' => 'Data Kecamatan berhasil disimpan'];
            } else {
                $msg = [
                    'error' => '<div class="alert alert-warning mt-1 alert-styled-left alert-dismissible"><button type="button" class="close" data-dismiss="alert"><span>×</span></button><span class="font-weight-semibold">Warning!</span>' . validation_errors() .
                        '.</div>'
                ];
            }
            echo json_encode($msg);
        }
    }


    public function hapusKecamatan_ajax()
    {
        if ($this->input->is_ajax_request() == true) {
            $kecamatanID = $this->input->post("kecamatanID");
            $hapus = $this->KecamatanModel->hapusKecamatan_ajax($kecamatanID);
            if ($hapus) {
                $msg = ['sukses' => 'Data Kecamatan Berhasil Terhapus'];
            }
            echo json_encode($msg);
        }
    }

    public function formEditKecamatan()
    {
        if ($this->input->is_ajax_request() == true) {
            $kecamatanID = $this->input->post('kecamatanID');
            $data['dataProvinsi'] = $this->db->query("SELECT *FROM ref_propinsi")->result_array();
            $data['dataKabupaten'] = $this->db->query("SELECT *FROM ref_dati2")->result_array();
            $result = $this->db->query("SELECT ref_dati2.dati2_nm,ref_dati2.dati2_kd, ref_propinsi.propinsi_nm,ref_kecamatan.* FROM ref_kecamatan INNER JOIN ref_dati2 ON ref_dati2.dati2_kd=ref_kecamatan.dati2_kd INNER JOIN ref_propinsi ON ref_propinsi.propinsi_kd=ref_kecamatan.propinsi_kd WHERE ref_kecamatan.kecamatan_kd='$kecamatanID'");

            if ($result->num_rows() > 0) {
                $row = $result->row_array();
                $data = [
                    'kabupatenID' => $row['dati2_kd'],
                    'kabupatenNama' => $row['dati2_nm'],
                    'kecamatanID' => $row['kecamatan_kd'],
                    'propinsi_kd' => $row['propinsi_kd'],
                    'propinsi_nm' => $row['propinsi_nm'],
                    'kecamatanNama' => $row['kecamatan_nm'],
                ];
            }
            $msg = [
                'sukses' => $this->load->view('page/kecamatan/modal/modalEditKecamatan', $data, true)
            ];
            echo json_encode($msg);
        }
    }


    public function updateKecamatan_ajax()
    {
        if ($this->input->is_ajax_request()) {
            $kecamatan = $this->KecamatanModel;

            $this->form_validation->set_rules("kecamatan", "Nama Kecamatan", 'required', ['required' => '%s tidak boleh kosong']);

            if ($this->form_validation->run() != false) {
                $kabupatenID = $this->input->post('kabupatenID');
                $kecamatanID = $this->input->post('kecamatanID');
                $propinsiID = $this->input->post('propinsiID');
                $kecamatanNama = $this->input->post('kecamatan');

                $data = array(
                    'dati2_kd' => $kabupatenID,
                    'kecamatan_nm' => $kecamatanNama,
                    'propinsi_kd' => $propinsiID
                );
                $where = array(
                    'kecamatan_kd' => $kecamatanID
                );
                $this->KecamatanModel->update_data($where, $data, 'ref_kecamatan');
                $msg = ['sukses' => 'Data Kecamatan berhasil diupdate'];
            } else {
                $msg = [
                    'error' => '<div class="alert alert-warning mt-1 alert-styled-left alert-dismissible"><button type="button" class="close" data-dismiss="alert"><span>×</span></button><span class="font-weight-semibold">Warning!</span>' . validation_errors() .
                        '.</div>'
                ];
            }

            echo json_encode($msg);
        }
    }


    // End Kecamatan
}
