<?php
defined('BASEPATH') or exit('No direct script access allowed');

class PKB extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model("guru/PKBModel");
        $this->load->library('form_validation');
        $this->load->helper('download');
    }

    public function listPengembanganDiri()
    {
        $data['listPengembanganDiri'] = $this->db->query("SELECT *FROM pengembangandiri")->result_array();
        $data['head'] = 'include/head';
        $data['header'] = 'include/header';
        $data['menu'] = 'include/menu';
        $data['content'] = 'page/guru/pkb/listPengembanganDiri';
        $data['footer'] = 'include/footer';
        $data['title'] = 'List Pengembangan Diri';
        $data['main_menu'] = 'pkb';
        $data['sub_menu'] = 'listPengembanganDiri';
        $this->load->view('index', $data);
    }

    public function listPublikasiIlmiah()
    {
        $data['listPublikasiIlmiah'] = $this->db->query("SELECT *FROM publikasiilmiah")->result_array();
        $data['head'] = 'include/head';
        $data['header'] = 'include/header';
        $data['menu'] = 'include/menu';
        $data['content'] = 'page/guru/pkb/listPublikasiIlmiah';
        $data['footer'] = 'include/footer';
        $data['title'] = 'List Publikasi Ilmiah';
        $data['main_menu'] = 'pkb';
        $data['sub_menu'] = 'listPublikasiIlmiah';
        $this->load->view('index', $data);
    }

    public function listKarya()
    {
        $data['listKarya'] = $this->db->query("SELECT *FROM karya")->result_array();
        $data['head'] = 'include/head';
        $data['header'] = 'include/header';
        $data['menu'] = 'include/menu';
        $data['content'] = 'page/guru/pkb/listKarya';
        $data['footer'] = 'include/footer';
        $data['title'] = 'List SKL';
        $data['main_menu'] = 'pkb';
        $data['sub_menu'] = 'listKarya';
        $this->load->view('index', $data);
    }



    // Pengembangan Diri

    public function simpanPengembanganDiri_ajax()
    {

        $pengembanganDiri = $this->PKBModel;
        $config['upload_path'] = "./uploads/dokumen/pengembanganDiri   "; //path folder file upload
        $config['allowed_types'] = 'doc|docx|pdf|csv';
        $config['encrypt_name'] = TRUE; //enkripsi file name upload

        $this->load->library('upload', $config); //call library upload 
        if ($this->upload->do_upload("file_pengembanganDiri")) { //upload file
            $data = array('upload_data' => $this->upload->data()); //ambil file name yang diupload

            $config['source_image'] = './uploads/dokumen/pengembanganDiri/' . $data['upload_data']['file_name'];

            $file = $data['upload_data']['file_name'];
            $pengembanganDiri = $this->input->post('pengembanganDiri');
            $tanggal_pengembanganDiri = date('Y-m-d');

            $dokumen = $data['upload_data']['file_name']; //set file name ke variable dokumen

            $data = array(
                'pengembanganDiri_name' => $pengembanganDiri,
                'pengembanganDiri_upload' => $file,
                'pengembanganDiri_tanggal' => $tanggal_pengembanganDiri,
                'pengembanganDiri_status' => 0
            );
            $result = $this->PKBModel->input_data($data, 'pengembanganDiri');
            //kirim value ke model m_upload
            echo json_decode($result);
        }
    }

    public function formEditPengembanganDiri()
    {
        if ($this->input->is_ajax_request() == true) {
            $PengembanganDiriID = $this->input->post('PengembanganDiriID');
            $result = $this->db->query("SELECT *FROM pengembanganDiri WHERE pengembanganDiri_id='$PengembanganDiriID'");

            if ($result->num_rows() > 0) {
                $row = $result->row_array();
                $data = [
                    'pengembanganDiri_id' => $row['pengembanganDiri_id'],
                    'pengembanganDiri_name' => $row['pengembanganDiri_name'],
                    'pengembanganDiri_upload' => $row['pengembanganDiri_upload'],
                ];
            }
            $msg = [
                'sukses' => $this->load->view('page/guru/PKB/modal/modalEditPengembanganDiri', $data, true)
            ];
            echo json_encode($msg);
        }
    }


    public function hapusPengembanganDiri_ajax()
    {
        if ($this->input->is_ajax_request() == true) {
            $PengembanganDiriID = $this->input->post("PengembanganDiriID");
            $hapus = $this->db->query("UPDATE pengembanganDiri set pengembanganDiri_status='0' where pengembanganDiri_id='$PengembanganDiriID'");
            if ($hapus) {
                $msg = ['sukses' => 'Data Pengembangan Diri Berhasil Terhapus'];
            }
            echo json_encode($msg);
        }
    }


    public function updatePengembanganDiri_ajax()
    {
        $config['upload_path'] = "./uploads/dokumen/pengembanganDiri   "; //path folder file upload
        $config['allowed_types'] = 'doc|docx|pdf|csv';
        $config['encrypt_name'] = TRUE; //enkripsi file name upload

        $this->load->library('upload', $config); //call library upload 

        if (!$this->upload->do_upload('file_pengembanganDiri')) {
            $file = $this->input->post("file_pengembanganDiriOLD");
            $config['source_image'] = './uploads/dokumen/pengembanganDiri/' . $data['upload_data']['file_name'];
            $dokumen = $file;
        } else {

            $data = array('upload_data' => $this->upload->data());

            $config['source_image'] = './uploads/dokumen/pengembanganDiri/' . $data['upload_data']['file_name'];
            $file = $data['upload_data']['file_name'];
            $dokumen = $data['upload_data']['file_name'];
        }

        $pengembanganDiriID = $this->input->post('pengembanganDiriID');
        $pengembanganDiriNama = $this->input->post('pengembanganDiri');

        if ($this->session->userdata('user_kd') == '') {
            $user_kd = 0;
        } else {
            $user_kd = $this->session->userdata('user_kd');
        }

        $result = $this->PKBModel->updateDataPengembanganDiri($pengembanganDiriNama, $dokumen, $pengembanganDiriID); //kirim value ke model m_upload
        echo json_decode($result);
        // End Agama
    }


    // Download PengembanganDiri
    function downloadPengembanganDiri($id)
    {
        $this->db->where('pengembanganDiri_id', $id);
        $query = $this->db->get('pengembanganDiri');

        if ($query->num_rows() == 0) {
            return false;
        }

        $path = '';
        $file = '';

        foreach ($query->result_array() as $result) {

            $path .= FCPATH . 'uploads/dokumen/pengembanganDiri/';

            // This gives the stored file name
            // This is folder 201702
            // Looks like 201702/post_1486965530_jeJNHKWXPMrwRpGBYxczIfTbaqhLnDVO.php

            $stored_file_name .= $result['pengembanganDiri_upload'];

            // Out puts just example "config.php"
            $original .= $result['file_name'];
            $newNameType = substr($result['pengembanganDiri_upload'], -5);
            $newName = 'Dokumen PROSEM ' . date('Y-m-d') . $newNameType;
        }

        force_download($newName, file_get_contents($path . $stored_file_name));
    }
    // End Download


    // Publikasi Ilmiah

    public function simpanPublikasiIlmiah_ajax()
    {

        $publikasiIlmiah = $this->PKBModel;
        $config['upload_path'] = "./uploads/dokumen/publikasiIlmiah   "; //path folder file upload
        $config['allowed_types'] = 'doc|docx|pdf|csv';
        $config['encrypt_name'] = TRUE; //enkripsi file name upload

        $this->load->library('upload', $config); //call library upload 
        if ($this->upload->do_upload("file_publikasiIlmiah")) { //upload file
            $data = array('upload_data' => $this->upload->data()); //ambil file name yang diupload

            $config['source_image'] = './uploads/dokumen/publikasiIlmiah/' . $data['upload_data']['file_name'];

            $file = $data['upload_data']['file_name'];
            $publikasiIlmiah = $this->input->post('publikasiIlmiah');
            $tanggal_publikasiIlmiah = date('Y-m-d');

            $dokumen = $data['upload_data']['file_name']; //set file name ke variable dokumen

            $data = array(
                'publikasiIlmiah_name' => $publikasiIlmiah,
                'publikasiIlmiah_upload' => $file,
                'publikasiIlmiah_tanggal' => $tanggal_publikasiIlmiah,
                'publikasiIlmiah_status' => 0
            );
            $result = $this->PKBModel->input_data($data, 'publikasiIlmiah');
            //kirim value ke model m_upload
            echo json_decode($result);
        }
    }

    public function formEditPublikasiIlmiah()
    {
        if ($this->input->is_ajax_request() == true) {
            $PublikasiIlmiahID = $this->input->post('PublikasiIlmiahID');
            $result = $this->db->query("SELECT *FROM publikasiIlmiah WHERE publikasiIlmiah_id='$PublikasiIlmiahID'");

            if ($result->num_rows() > 0) {
                $row = $result->row_array();
                $data = [
                    'publikasiIlmiah_id' => $row['publikasiIlmiah_id'],
                    'publikasiIlmiah_name' => $row['publikasiIlmiah_name'],
                    'publikasiIlmiah_upload' => $row['publikasiIlmiah_upload'],
                ];
            }
            $msg = [
                'sukses' => $this->load->view('page/guru/PKB/modal/modalEditPublikasiIlmiah', $data, true)
            ];
            echo json_encode($msg);
        }
    }


    public function hapusPublikasiIlmiah_ajax()
    {
        if ($this->input->is_ajax_request() == true) {
            $PublikasiIlmiahID = $this->input->post("PublikasiIlmiahID");
            $hapus = $this->db->query("UPDATE publikasiIlmiah set publikasiIlmiah_status='0' where publikasiIlmiah_id='$PublikasiIlmiahID'");
            if ($hapus) {
                $msg = ['sukses' => 'Data Publikasi Ilmiah Berhasil Terhapus'];
            }
            echo json_encode($msg);
        }
    }


    public function updatePublikasiIlmiah_ajax()
    {
        $config['upload_path'] = "./uploads/dokumen/publikasiIlmiah   "; //path folder file upload
        $config['allowed_types'] = 'doc|docx|pdf|csv';
        $config['encrypt_name'] = TRUE; //enkripsi file name upload

        $this->load->library('upload', $config); //call library upload 

        if (!$this->upload->do_upload('file_publikasiIlmiah')) {
            $file = $this->input->post("file_publikasiIlmiahOLD");
            $config['source_image'] = './uploads/dokumen/publikasiIlmiah/' . $data['upload_data']['file_name'];
            $dokumen = $file;
        } else {

            $data = array('upload_data' => $this->upload->data());

            $config['source_image'] = './uploads/dokumen/publikasiIlmiah/' . $data['upload_data']['file_name'];
            $file = $data['upload_data']['file_name'];
            $dokumen = $data['upload_data']['file_name'];
        }

        $publikasiIlmiahID = $this->input->post('publikasiIlmiahID');
        $publikasiIlmiahNama = $this->input->post('publikasiIlmiah');

        if ($this->session->userdata('user_kd') == '') {
            $user_kd = 0;
        } else {
            $user_kd = $this->session->userdata('user_kd');
        }

        $result = $this->PKBModel->updateDataPublikasiIlmiah($publikasiIlmiahNama, $dokumen, $publikasiIlmiahID); //kirim value ke model m_upload
        echo json_decode($result);
        // End Agama
    }


    // Download PublikasiIlmiah
    function downloadPublikasiIlmiah($id)
    {
        $this->db->where('publikasiIlmiah_id', $id);
        $query = $this->db->get('publikasiIlmiah');

        if ($query->num_rows() == 0) {
            return false;
        }

        $path = '';
        $file = '';

        foreach ($query->result_array() as $result) {

            $path .= FCPATH . 'uploads/dokumen/publikasiIlmiah/';

            // This gives the stored file name
            // This is folder 201702
            // Looks like 201702/post_1486965530_jeJNHKWXPMrwRpGBYxczIfTbaqhLnDVO.php

            $stored_file_name .= $result['publikasiIlmiah_upload'];

            // Out puts just example "config.php"
            $original .= $result['file_name'];
            $newNameType = substr($result['publikasiIlmiah_upload'], -5);
            $newName = 'Dokumen Publikasi Ilmiah ' . date('Y-m-d') . $newNameType;
        }

        force_download($newName, file_get_contents($path . $stored_file_name));
    }
    // End Download


    // Publikasi Ilmiah

    public function simpanKarya_ajax()
    {

        $karya = $this->PKBModel;
        $config['upload_path'] = "./uploads/dokumen/karya   "; //path folder file upload
        $config['allowed_types'] = 'doc|docx|pdf|csv';
        $config['encrypt_name'] = TRUE; //enkripsi file name upload

        $this->load->library('upload', $config); //call library upload 
        if ($this->upload->do_upload("file_karya")) { //upload file
            $data = array('upload_data' => $this->upload->data()); //ambil file name yang diupload

            $config['source_image'] = './uploads/dokumen/karya/' . $data['upload_data']['file_name'];

            $file = $data['upload_data']['file_name'];
            $karya = $this->input->post('karya');
            $tanggal_karya = date('Y-m-d');

            $dokumen = $data['upload_data']['file_name']; //set file name ke variable dokumen

            $data = array(
                'karya_name' => $karya,
                'karya_upload' => $file,
                'karya_tanggal' => $tanggal_karya,
                'karya_status' => 0
            );
            $result = $this->PKBModel->input_data($data, 'karya');
            //kirim value ke model m_upload
            echo json_decode($result);
        }
    }

    public function formEditKarya()
    {
        if ($this->input->is_ajax_request() == true) {
            $KaryaID = $this->input->post('KaryaID');
            $result = $this->db->query("SELECT *FROM karya WHERE karya_id='$KaryaID'");

            if ($result->num_rows() > 0) {
                $row = $result->row_array();
                $data = [
                    'karya_id' => $row['karya_id'],
                    'karya_name' => $row['karya_name'],
                    'karya_upload' => $row['karya_upload'],
                ];
            }
            $msg = [
                'sukses' => $this->load->view('page/guru/PKB/modal/modalEditKarya', $data, true)
            ];
            echo json_encode($msg);
        }
    }


    public function hapusKarya_ajax()
    {
        if ($this->input->is_ajax_request() == true) {
            $KaryaID = $this->input->post("KaryaID");
            $hapus = $this->db->query("UPDATE karya set karya_status='0' where karya_id='$KaryaID'");
            if ($hapus) {
                $msg = ['sukses' => 'Data Publikasi Ilmiah Berhasil Terhapus'];
            }
            echo json_encode($msg);
        }
    }


    public function updateKarya_ajax()
    {
        $config['upload_path'] = "./uploads/dokumen/karya   "; //path folder file upload
        $config['allowed_types'] = 'doc|docx|pdf|csv';
        $config['encrypt_name'] = TRUE; //enkripsi file name upload

        $this->load->library('upload', $config); //call library upload 

        if (!$this->upload->do_upload('file_karya')) {
            $file = $this->input->post("file_karyaOLD");
            $config['source_image'] = './uploads/dokumen/karya/' . $data['upload_data']['file_name'];
            $dokumen = $file;
        } else {

            $data = array('upload_data' => $this->upload->data());

            $config['source_image'] = './uploads/dokumen/karya/' . $data['upload_data']['file_name'];
            $file = $data['upload_data']['file_name'];
            $dokumen = $data['upload_data']['file_name'];
        }

        $karyaID = $this->input->post('karyaID');
        $karyaNama = $this->input->post('karya');

        if ($this->session->userdata('user_kd') == '') {
            $user_kd = 0;
        } else {
            $user_kd = $this->session->userdata('user_kd');
        }

        $result = $this->PKBModel->updateDataKarya($karyaNama, $dokumen, $karyaID); //kirim value ke model m_upload
        echo json_decode($result);
        // End Agama
    }


    // Download Karya
    function downloadKarya($id)
    {
        $this->db->where('karya_id', $id);
        $query = $this->db->get('karya');

        if ($query->num_rows() == 0) {
            return false;
        }

        $path = '';
        $file = '';

        foreach ($query->result_array() as $result) {

            $path .= FCPATH . 'uploads/dokumen/karya/';

            // This gives the stored file name
            // This is folder 201702
            // Looks like 201702/post_1486965530_jeJNHKWXPMrwRpGBYxczIfTbaqhLnDVO.php

            $stored_file_name .= $result['karya_upload'];

            // Out puts just example "config.php"
            $original .= $result['file_name'];
            $newNameType = substr($result['karya_upload'], -5);
            $newName = 'Dokumen Publikasi Ilmiah ' . date('Y-m-d') . $newNameType;
        }

        force_download($newName, file_get_contents($path . $stored_file_name));
    }
    // End Download
}
