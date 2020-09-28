<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Provinsi extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model("ProvinsiModel");
        $this->load->library('form_validation');
    }
    // Provinsi

    public function listProvinsi()
    {
        $data['dataProvinsi'] = $this->db->query("SELECT *FROM ref_propinsi ORDER BY propinsi_nm ASC")->result_array();
        $data['head'] = 'include/head';
        $data['header'] = 'include/header';
        $data['menu'] = 'include/menu';
        $data['content'] = 'page/provinsi/listProvinsi';
        $data['footer'] = 'include/footer';
        $data['title'] = 'List Provinsi';
        $data['main_menu'] = 'master';
        $data['sub_menu'] = 'listProvinsi';
        $this->load->view('index', $data);
    }


    public function simpanProvinsi_ajax()
    {
        if ($this->input->is_ajax_request()) {

            $this->form_validation->set_rules("provinsiNama[]", "Nama Provinsi", 'required|is_unique[ref_propinsi.propinsi_nm]', ['required' => '%s tidak boleh kosong', 'is_unique' => '%s  sudah diinput']);

            if ($this->form_validation->run() != false) {

                $countProvinsiNama = count($this->input->post("provinsiNama"));
                $provinsiNama = $this->input->post('provinsiNama');

                if ($countProvinsiNama > 0) {
                    for ($i = 0; $i < $countProvinsiNama; $i++) {
                        if (trim($_POST["provinsiNama"][$i]) != '') {
                            $this->db->query("INSERT INTO ref_propinsi(propinsi_nm) VALUES ('" . $_POST['provinsiNama'][$i] . "')");
                        }
                    }
                }
                $msg = ['sukses' => 'Data Provinsi berhasil disimpan'];
            } else {
                $msg = [
                    'error' => '<div class="alert alert-warning mt-1 alert-styled-left alert-dismissible"><button type="button" class="close" data-dismiss="alert"><span>×</span></button><span class="font-weight-semibold">Warning!</span>' . validation_errors() .
                        '.</div>'
                ];
            }


            echo json_encode($msg);
        }
    }


    public function hapusProvinsi_ajax()
    {
        if ($this->input->is_ajax_request() == true) {
            $provinsiID = $this->input->post("provinsiID");
            $hapus = $this->ProvinsiModel->hapusProvinsi_ajax($provinsiID);
            $this->db->query("DELETE ref_dati2 where propinsi_kd='$provinsiID'");
            $this->db->query("DELETE ref_kecamatan where propinsi_kd='$provinsiID'");
            if ($hapus) {
                $msg = ['sukses' => 'Data Provinsi Berhasil Terhapus'];
            }
            echo json_encode($msg);
        }
    }

    public function formEditProvinsi()
    {
        if ($this->input->is_ajax_request() == true) {
            $provinsiID = $this->input->post('provinsiID');
            $result = $this->db->query("SELECT *FROM ref_propinsi WHERE propinsi_kd='$provinsiID'");

            if ($result->num_rows() > 0) {
                $row = $result->row_array();
                $data = [
                    'propinsi_id' => $row['propinsi_kd'],
                    'propinsi_nm' => $row['propinsi_nm'],
                ];
            }
            $msg = [
                'sukses' => $this->load->view('page/provinsi/modal/modalEditProvinsi', $data, true)
            ];
            echo json_encode($msg);
        }
    }


    public function updateProvinsi_ajax()
    {
        if ($this->input->is_ajax_request()) {
            $provinsi = $this->ProvinsiModel;

            $this->form_validation->set_rules("provinsi", "Nama Provinsi", 'required', ['required' => '%s tidak boleh kosong']);


            if ($this->form_validation->run() != false) {
                $provinsi = $this->input->post('provinsi');
                $provinsiID = $this->input->post('provinsiID');

                $data = array(
                    'propinsi_nm' => $provinsi
                );
                $where = array(
                    'propinsi_kd' => $provinsiID
                );
                $this->ProvinsiModel->update_data($where, $data, 'ref_propinsi');
                $msg = ['sukses' => 'Data Provinsi berhasil diupdate'];
            } else {
                $msg = [
                    'error' => '<div class="alert alert-warning mt-1 alert-styled-left alert-dismissible"><button type="button" class="close" data-dismiss="alert"><span>×</span></button><span class="font-weight-semibold">Warning!</span>' . validation_errors() .
                        '.</div>'
                ];
            }

            echo json_encode($msg);
        }
    }


    // End Provinsi

}
