<?php
defined('BASEPATH') or exit('No direct script access allowed');

class JenisUser extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model("JenisUserModel");
        $this->load->library('form_validation');
    }



    // Jenis User
    public function listJenisUser()
    {
        $data['dataJenisUser'] = $this->db->query("SELECT *FROM ref_jenis_user")->result_array();
        $data['head'] = 'include/head';
        $data['header'] = 'include/header';
        $data['menu'] = 'include/menu';
        $data['content'] = 'page/jenisUser/listJenisUser';
        $data['footer'] = 'include/footer';
        $data['title'] = 'List Jenis User';
        $data['main_menu'] = 'master';
        $data['sub_menu'] = 'listJenisUser';
        $this->load->view('index', $data);
    }


    public function simpanJenisUser_ajax()
    {
        if ($this->input->is_ajax_request()) {

            $this->form_validation->set_rules("jenisUserNama[]", "Jenis User", 'required|is_unique[ref_jenis_user.jns_user_nm]', ['required' => '%s tidak boleh kosong', 'is_unique' => '%s sudah diinput']);


            if ($this->form_validation->run() != false) {

                $countJenisUser = count($this->input->post("jenisUserNama"));
                $jenisUserNama = $this->input->post('jenisUserNama');
                if ($countJenisUser > 0) {
                    for ($i = 0; $i < $countJenisUser; $i++) {
                        if (trim($_POST["jenisUserNama"][$i]) != '') {
                            $this->db->query("INSERT INTO ref_jenis_user(jns_user_nm) VALUES ('" . $_POST['jenisUserNama'][$i] . "')");
                        }
                    }
                }
                $msg = ['sukses' => 'Data Jenis User berhasil disimpan'];
            } else {
                $msg = [
                    'error' => '<div class="alert alert-warning mt-1 alert-styled-left alert-dismissible"><button type="button" class="close" data-dismiss="alert"><span>×</span></button><span class="font-weight-semibold">Warning!</span>' . validation_errors() .
                        '.</div>'
                ];
            }

            echo json_encode($msg);
        }
    }


    public function hapusJenisUser_ajax()
    {
        if ($this->input->is_ajax_request() == true) {
            $jenisUserID = $this->input->post("jenisUserID");
            $hapus = $this->JenisUserModel->hapusJenisUser_ajax($jenisUserID);
            if ($hapus) {
                $msg = ['sukses' => 'Data Jenis User Berhasil Terhapus'];
            }
            echo json_encode($msg);
        }
    }

    public function formEditJenisUser()
    {
        if ($this->input->is_ajax_request() == true) {
            $jenisUserID = $this->input->post('jenisUserID');
            $result = $this->db->query("SELECT *FROM ref_jenis_user WHERE jns_user_kd='$jenisUserID'");

            if ($result->num_rows() > 0) {
                $row = $result->row_array();
                $data = [
                    'jenisUserID' => $row['jns_user_kd'],
                    'jenisUserNama' => $row['jns_user_nm']
                ];
            }
            $msg = [
                'sukses' => $this->load->view('page/jenisUser/modal/modalEditJenisUser', $data, true)
            ];
            echo json_encode($msg);
        }
    }


    public function updateJenisUser_ajax()
    {
        if ($this->input->is_ajax_request()) {
            $jenisUser = $this->JenisUserModel;

            $this->form_validation->set_rules("jenisUserNama", "Jenis User", 'required', ['required' => '%s tidak boleh kosong']);

            if ($this->form_validation->run() != false) {
                $jenisUserID = $this->input->post('jenisUserID');
                $jenisUserNama = $this->input->post('jenisUserNama');

                $data = array(
                    'jns_user_nm' => $jenisUserNama
                );
                $where = array(
                    'jns_user_kd' => $jenisUserID
                );
                $this->JenisUserModel->update_data($where, $data, 'ref_jenis_user');
                $msg = ['sukses' => 'Data Jenis User berhasil diupdate'];
            } else {
                $msg = [
                    'error' => '<div class="alert alert-warning mt-1 alert-styled-left alert-dismissible"><button type="button" class="close" data-dismiss="alert"><span>×</span></button><span class="font-weight-semibold">Warning!</span>' . validation_errors() .
                        '.</div>'
                ];
            }

            echo json_encode($msg);
        }
    }


    // End Jenis User
}
