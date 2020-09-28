<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Agama extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model("AgamaModel");
        $this->load->library('form_validation');
    }




    //Agama
    public function listAgama()
    {
        $data['dataReligion'] = $this->db->query("SELECT *FROM ref_agama")->result_array();
        $data['head'] = 'include/head';
        $data['header'] = 'include/header';
        $data['menu'] = 'include/menu';
        $data['content'] = 'page/agama/listAgama';
        $data['footer'] = 'include/footer';
        $data['title'] = 'List Agama';
        $data['main_menu'] = 'master';
        $data['sub_menu'] = 'listAgama';
        $this->load->view('index', $data);
    }



    public function simpanAgama_ajax()
    {
        if ($this->input->is_ajax_request()) {
            $agama = $this->AgamaModel;
            $this->form_validation->set_rules("agama", "Agama", 'required|is_unique[ref_agama.agama_nm]', ['required' => '%s tidak boleh kosong', 'is_unique' => '%s sudah diinput']);
            if ($this->form_validation->run() != false) {

                $agama = $this->input->post('agama');

                $data = array(
                    'agama_nm' => $agama
                );
                $agama->input_data($data, 'ref_agama');
                $msg = ['sukses' => 'Data Agama berhasil disimpan'];
            } else {
                $msg = [
                    'error' => '<div class="alert alert-warning mt-1 alert-styled-left alert-dismissible"><button type="button" class="close" data-dismiss="alert"><span>×</span></button><span class="font-weight-semibold">Warning!</span>' . validation_errors() .
                        '.</div>'
                ];
            }

            echo json_encode($msg);
        }
    }

    public function formEditAgama()
    {
        if ($this->input->is_ajax_request() == true) {
            $agamaID = $this->input->post('agamaID');
            $result = $this->db->query("SELECT *FROM ref_agama WHERE agama_kd='$agamaID'");

            if ($result->num_rows() > 0) {
                $row = $result->row_array();
                $data = [
                    'agama_kd' => $row['agama_kd'],
                    'agama_nm' => $row['agama_nm'],
                ];
            }
            $msg = [
                'sukses' => $this->load->view('page/agama/modal/modalEditAgama', $data, true)
            ];
            echo json_encode($msg);
        }
    }


    public function hapusAgama_ajax()
    {
        if ($this->input->is_ajax_request() == true) {
            $agamaID = $this->input->post("agamaID");
            $hapus = $this->AgamaModel->hapusAgama_ajax($agamaID);
            if ($hapus) {
                $msg = ['sukses' => 'Data Agama Berhasil Terhapus'];
            }
            echo json_encode($msg);
        }
    }


    public function updateAgama_ajax()
    {
        if ($this->input->is_ajax_request()) {
            $agama = $this->AgamaModel;

            $this->form_validation->set_rules("agama", "Agama", 'required', ['required' => '%s tidak boleh kosong']);

            if ($this->form_validation->run() != false) {
                $agamaID = $this->input->post('agamaID');
                $agama = $this->input->post('agama');

                $data = array(
                    'agama_nm' => $agama
                );
                $where = array(
                    'agama_kd' => $agamaID
                );
                $this->AgamaModel->update_data($where, $data, 'ref_agama');
                $msg = ['sukses' => 'Data Agama berhasil diupdate'];
            } else {
                $msg = [
                    'error' => '<div class="alert alert-warning mt-1 alert-styled-left alert-dismissible"><button type="button" class="close" data-dismiss="alert"><span>×</span></button><span class="font-weight-semibold">Warning!</span>' . validation_errors() .
                        '.</div>'
                ];
            }

            echo json_encode($msg);
        }
        // End Agama
    }
}
