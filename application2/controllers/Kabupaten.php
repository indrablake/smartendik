<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kabupaten extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model("KabupatenModel");
        $this->load->library('form_validation');
    }
    // Kabupaten
    public function listKabupaten()
    {
        $data['dataProvinsi'] = $this->db->query("SELECT propinsi_nm,propinsi_kd FROM ref_propinsi ORDER BY propinsi_nm ASC")->result_array();
        $data['dataKabupaten'] = $this->db->query("SELECT ref_propinsi.propinsi_nm,ref_dati2.* FROM ref_dati2 INNER JOIN ref_propinsi ON ref_propinsi.propinsi_kd=ref_dati2.propinsi_kd ORDER BY ref_dati2.dati2_nm ASC")->result_array();
        $data['head'] = 'include/head';
        $data['header'] = 'include/header';
        $data['menu'] = 'include/menu';
        $data['content'] = 'page/kabupaten/listKabupaten';
        $data['footer'] = 'include/footer';
        $data['title'] = 'List Kabupaten';
        $data['main_menu'] = 'master';
        $data['sub_menu'] = 'listKabupaten';
        $this->load->view('index', $data);
    }


    public function simpanKabupaten_ajax()
    {
        if ($this->input->is_ajax_request()) {
            $this->form_validation->set_rules("kabupatenNama[]", "Nama Kabupaten", 'required|is_unique[ref_dati2.dati2_nm]', ['required' => '%s tidak boleh kosong', 'is_unique' => ['%s sudah diinput']]);
            // $this->form_validation->set_rules("subTemaPromes", "SubTema Program Semester", 'required');
            if ($this->form_validation->run() != false) {
                $countKabupatenNama = count($this->input->post("kabupatenNama"));
                $propinsiID = $this->input->post('propinsiID');

                if ($countKabupatenNama > 0) {
                    for ($i = 0; $i < $countKabupatenNama; $i++) {
                        if (trim($_POST["kabupatenNama"][$i]) != '') {
                            $this->db->query("INSERT INTO ref_dati2(propinsi_kd,dati2_nm) VALUES ('$propinsiID','" . $_POST['kabupatenNama'][$i] . "')");
                        }
                    }
                }
                $msg = ['sukses' => 'Data Kabupaten berhasil disimpan'];
            } else {
                $msg = [
                    'error' => '<div class="alert alert-warning mt-1 alert-styled-left alert-dismissible"><button type="button" class="close" data-dismiss="alert"><span>×</span></button><span class="font-weight-semibold">Warning!</span>' . validation_errors() .
                        '.</div>'
                ];
            }
            echo json_encode($msg);
        }
    }


    public function hapusKabupaten_ajax()
    {
        if ($this->input->is_ajax_request() == true) {
            $kabupatenID = $this->input->post("kabupatenID");
            $hapus = $this->KabupatenModel->hapusKabupaten_ajax($kabupatenID);
            $this->db->query("DELETE ref_kecamatan where dati2_kd='$kabupatenID'");
            if ($hapus) {
                $msg = ['sukses' => 'Data Kabupaten Berhasil Terhapus'];
            }
            echo json_encode($msg);
        }
    }

    public function formEditKabupaten()
    {
        if ($this->input->is_ajax_request() == true) {
            $kabupatenID = $this->input->post('kabupatenID');
            $result = $this->db->query("SELECT ref_propinsi.propinsi_nm,ref_dati2.* FROM ref_dati2 INNER JOIN ref_propinsi ON ref_propinsi.propinsi_kd=ref_dati2.propinsi_kd WHERE ref_dati2.dati2_kd='$kabupatenID'");

            if ($result->num_rows() > 0) {
                $row = $result->row_array();
                $data = [
                    'kabupatenID' => $row['dati2_kd'],
                    'propinsi_kd' => $row['propinsi_kd'],
                    'propinsi_nm' => $row['propinsi_nm'],
                    'kabupatenNama' => $row['dati2_nm'],
                ];
            }
            $msg = [
                'sukses' => $this->load->view('page/kabupaten/modal/modalEditKabupaten', $data, true)
            ];
            echo json_encode($msg);
        }
    }


    public function updateKabupaten_ajax()
    {

        if ($this->input->is_ajax_request()) {
            $this->load->model("KabupatenModel");


            $this->form_validation->set_rules("kabupaten", "Nama Kabupaten", 'required', ['required' => '%s tidak boleh kosong']);

            if ($this->form_validation->run() != false) {
                $kabupaten = $this->input->post('kabupaten');
                $kabupatenID = $this->input->post('kabupatenID');
                $propinsiID = $this->input->post('propinsiID');

                $data = array(
                    'dati2_nm' => $kabupaten,
                    'propinsi_kd' => $propinsiID
                );
                $where = array(
                    'dati2_kd' => $kabupatenID
                );
                $this->KabupatenModel->update_data($where, $data, 'ref_dati2');
                $msg = ['sukses' => 'Data Kabupaten berhasil diupdate'];
            } else {
                $msg = [
                    'error' => '<div class="alert alert-warning mt-1 alert-styled-left alert-dismissible"><button type="button" class="close" data-dismiss="alert"><span>×</span></button><span class="font-weight-semibold">Warning!</span>' . validation_errors() .
                        '.</div>'
                ];
            }

            echo json_encode($msg);
        }
    }


    // End Kabupaten

}
