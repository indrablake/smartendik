<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pembelajaran extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model("guru/PembelajaranModel");
        $this->load->library('form_validation');
        $this->load->helper('download');
    }

    public function listBuku()
    {
        $data['listBuku'] = $this->db->query("SELECT *FROM buku")->result_array();
        $data['head'] = 'include/head';
        $data['header'] = 'include/header';
        $data['menu'] = 'include/menu';
        $data['content'] = 'page/guru/pembelajaran/listBuku';
        $data['footer'] = 'include/footer';
        $data['title'] = 'List Buku';
        $data['main_menu'] = 'pembelajaran';
        $data['sub_menu'] = 'listBuku';
        $this->load->view('index', $data);
    }

    public function listMediaPembelajaran()
    {
        $data['listMediaPembelajaran'] = $this->db->query("SELECT *FROM mediaPembelajaran")->result_array();
        $data['head'] = 'include/head';
        $data['header'] = 'include/header';
        $data['menu'] = 'include/menu';
        $data['content'] = 'page/guru/pembelajaran/listMediaPembelajaran';
        $data['footer'] = 'include/footer';
        $data['title'] = 'List Media Pembelajaran';
        $data['main_menu'] = 'pembelajaran';
        $data['sub_menu'] = 'listMediaPembelajaran';
        $this->load->view('index', $data);
    }

    public function listMateriPembinaan()
    {
        $data['listMateriPembinaan'] = $this->db->query("SELECT *FROM materiPembinaan")->result_array();
        $data['head'] = 'include/head';
        $data['header'] = 'include/header';
        $data['menu'] = 'include/menu';
        $data['content'] = 'page/guru/pembelajaran/listMateriPembinaan';
        $data['footer'] = 'include/footer';
        $data['title'] = 'List Materi Pembinaan';
        $data['main_menu'] = 'pembelajaran';
        $data['sub_menu'] = 'listMateriPembinaan';
        $this->load->view('index', $data);
    }

    public function listBankSoal()
    {
        $data['listBankSoal'] = $this->db->query("SELECT *FROM bankSoal")->result_array();
        $data['head'] = 'include/head';
        $data['header'] = 'include/header';
        $data['menu'] = 'include/menu';
        $data['content'] = 'page/guru/pembelajaran/listBankSoal';
        $data['footer'] = 'include/footer';
        $data['title'] = 'List Bank Soal';
        $data['main_menu'] = 'pembelajaran';
        $data['sub_menu'] = 'listBankSoal';
        $this->load->view('index', $data);
    }

    // Buku Guru

    public function simpanBuku_ajax()
    {

        $buku = $this->PembelajaranModel;
        $config['upload_path'] = "./uploads/dokumen/buku   "; //path folder file upload
        $config['allowed_types'] = 'doc|docx|pdf|csv|mp4|jpeg|jpg';
        $config['encrypt_name'] = TRUE; //enkripsi file name upload

        $this->load->library('upload', $config); //call library upload 
        if ($this->upload->do_upload("file_buku")) { //upload file
            $data = array('upload_data' => $this->upload->data()); //ambil file name yang diupload

            $config['source_image'] = './uploads/dokumen/buku/' . $data['upload_data']['file_name'];

            $file = $data['upload_data']['file_name'];
            $buku = $this->input->post('buku');
            $tanggal_buku = date('Y-m-d');

            $dokumen = $data['upload_data']['file_name']; //set file name ke variable dokumen

            $data = array(
                'buku_name' => $buku,
                'buku_upload' => $file,
                'buku_tanggal' => $tanggal_buku,
                'buku_status' => 0
            );
            $result = $this->PembelajaranModel->input_data($data, 'buku');
            //kirim value ke model m_upload
            echo json_decode($result);
        }
    }

    public function formEditBuku()
    {
        if ($this->input->is_ajax_request() == true) {
            $BukuID = $this->input->post('BukuID');
            $result = $this->db->query("SELECT *FROM buku WHERE buku_id='$BukuID'");

            if ($result->num_rows() > 0) {
                $row = $result->row_array();
                $data = [
                    'buku_id' => $row['buku_id'],
                    'buku_name' => $row['buku_name'],
                    'buku_upload' => $row['buku_upload'],
                ];
            }
            $msg = [
                'sukses' => $this->load->view('page/guru/Pembelajaran/modal/modalEditBuku', $data, true)
            ];
            echo json_encode($msg);
        }
    }


    public function hapusBuku_ajax()
    {
        if ($this->input->is_ajax_request() == true) {
            $BukuID = $this->input->post("BukuID");
            $hapus = $this->db->query("UPDATE buku set buku_status='0' where buku_id='$BukuID'");
            if ($hapus) {
                $msg = ['sukses' => 'Data Buku Guru Berhasil Terhapus'];
            }
            echo json_encode($msg);
        }
    }


    public function updateBuku_ajax()
    {
        $config['upload_path'] = "./uploads/dokumen/buku   "; //path folder file upload
        $config['allowed_types'] = 'doc|docx|pdf|csv';
        $config['encrypt_name'] = TRUE; //enkripsi file name upload

        $this->load->library('upload', $config); //call library upload 

        if (!$this->upload->do_upload('file_buku')) {
            $file = $this->input->post("file_bukuOLD");
            $config['source_image'] = './uploads/dokumen/buku/' . $data['upload_data']['file_name'];
            $dokumen = $file;
        } else {

            $data = array('upload_data' => $this->upload->data());

            $config['source_image'] = './uploads/dokumen/buku/' . $data['upload_data']['file_name'];
            $file = $data['upload_data']['file_name'];
            $dokumen = $data['upload_data']['file_name'];
        }

        $bukuID = $this->input->post('bukuID');
        $bukuNama = $this->input->post('buku');

        if ($this->session->userdata('user_kd') == '') {
            $user_kd = 0;
        } else {
            $user_kd = $this->session->userdata('user_kd');
        }

        $result = $this->PembelajaranModel->updateDataBuku($bukuNama, $dokumen, $bukuID); //kirim value ke model m_upload
        echo json_decode($result);
        // End Agama
    }


    // Download Buku
    function downloadBuku($id)
    {
        $this->db->where('buku_id', $id);
        $query = $this->db->get('buku');

        if ($query->num_rows() == 0) {
            return false;
        }

        $path = '';
        $file = '';

        foreach ($query->result_array() as $result) {

            $path .= FCPATH . 'uploads/dokumen/buku/';

            // This gives the stored file name
            // This is folder 201702
            // Looks like 201702/post_1486965530_jeJNHKWXPMrwRpGBYxczIfTbaqhLnDVO.php

            $stored_file_name .= $result['buku_upload'];

            // Out puts just example "config.php"
            $original .= $result['file_name'];
            $newNameType = substr($result['buku_upload'], -5);
            $newName = 'Dokumen Buku Guru ' . date('Y-m-d') . $newNameType;
        }

        force_download($newName, file_get_contents($path . $stored_file_name));
    }
    // End Download


    // Media Pembelajaran

    public function simpanMediaPembelajaran_ajax()
    {

        $mediaPembelajaran = $this->PembelajaranModel;
        $config['upload_path'] = "./uploads/dokumen/mediaPembelajaran   "; //path folder file upload
        $config['allowed_types'] = 'doc|docx|pdf|csv|mp4|jpeg|jpg';
        $config['encrypt_name'] = TRUE; //enkripsi file name upload

        $this->load->library('upload', $config); //call library upload 
        if ($this->upload->do_upload("file_mediaPembelajaran")) { //upload file
            $data = array('upload_data' => $this->upload->data()); //ambil file name yang diupload

            $config['source_image'] = './uploads/dokumen/mediaPembelajaran/' . $data['upload_data']['file_name'];

            $file = $data['upload_data']['file_name'];
            $mediaPembelajaran = $this->input->post('mediaPembelajaran');
            $tanggal_mediaPembelajaran = date('Y-m-d');

            $dokumen = $data['upload_data']['file_name']; //set file name ke variable dokumen

            $data = array(
                'mediaPembelajaran_name' => $mediaPembelajaran,
                'mediaPembelajaran_upload' => $file,
                'mediaPembelajaran_tanggal' => $tanggal_mediaPembelajaran,
                'mediaPembelajaran_status' => 0
            );
            $result = $this->PembelajaranModel->input_data($data, 'mediaPembelajaran');
            //kirim value ke model m_upload
            echo json_decode($result);
        }
    }

    public function formEditMediaPembelajaran()
    {
        if ($this->input->is_ajax_request() == true) {
            $MediaPembelajaranID = $this->input->post('MediaPembelajaranID');
            $result = $this->db->query("SELECT *FROM mediaPembelajaran WHERE mediaPembelajaran_id='$MediaPembelajaranID'");

            if ($result->num_rows() > 0) {
                $row = $result->row_array();
                $data = [
                    'mediaPembelajaran_id' => $row['mediaPembelajaran_id'],
                    'mediaPembelajaran_name' => $row['mediaPembelajaran_name'],
                    'mediaPembelajaran_upload' => $row['mediaPembelajaran_upload'],
                ];
            }
            $msg = [
                'sukses' => $this->load->view('page/guru/Pembelajaran/modal/modalEditMediaPembelajaran', $data, true)
            ];
            echo json_encode($msg);
        }
    }


    public function hapusMediaPembelajaran_ajax()
    {
        if ($this->input->is_ajax_request() == true) {
            $MediaPembelajaranID = $this->input->post("MediaPembelajaranID");
            $hapus = $this->db->query("UPDATE mediaPembelajaran set mediaPembelajaran_status='0' where mediaPembelajaran_id='$MediaPembelajaranID'");
            if ($hapus) {
                $msg = ['sukses' => 'Data MediaPembelajaran Guru Berhasil Terhapus'];
            }
            echo json_encode($msg);
        }
    }


    public function updateMediaPembelajaran_ajax()
    {
        $config['upload_path'] = "./uploads/dokumen/mediaPembelajaran   "; //path folder file upload
        $config['allowed_types'] = 'doc|docx|pdf|csv';
        $config['encrypt_name'] = TRUE; //enkripsi file name upload

        $this->load->library('upload', $config); //call library upload 

        if (!$this->upload->do_upload('file_mediaPembelajaran')) {
            $file = $this->input->post("file_mediaPembelajaranOLD");
            $config['source_image'] = './uploads/dokumen/mediaPembelajaran/' . $data['upload_data']['file_name'];
            $dokumen = $file;
        } else {

            $data = array('upload_data' => $this->upload->data());

            $config['source_image'] = './uploads/dokumen/mediaPembelajaran/' . $data['upload_data']['file_name'];
            $file = $data['upload_data']['file_name'];
            $dokumen = $data['upload_data']['file_name'];
        }

        $mediaPembelajaranID = $this->input->post('mediaPembelajaranID');
        $mediaPembelajaranNama = $this->input->post('mediaPembelajaran');

        if ($this->session->userdata('user_kd') == '') {
            $user_kd = 0;
        } else {
            $user_kd = $this->session->userdata('user_kd');
        }

        $result = $this->PembelajaranModel->updateDataMediaPembelajaran($mediaPembelajaranNama, $dokumen, $mediaPembelajaranID); //kirim value ke model m_upload
        echo json_decode($result);
        // End Agama
    }


    // Download MediaPembelajaran
    function downloadMediaPembelajaran($id)
    {
        $this->db->where('mediaPembelajaran_id', $id);
        $query = $this->db->get('mediaPembelajaran');

        if ($query->num_rows() == 0) {
            return false;
        }

        $path = '';
        $file = '';

        foreach ($query->result_array() as $result) {

            $path .= FCPATH . 'uploads/dokumen/mediaPembelajaran/';

            // This gives the stored file name
            // This is folder 201702
            // Looks like 201702/post_1486965530_jeJNHKWXPMrwRpGBYxczIfTbaqhLnDVO.php

            $stored_file_name .= $result['mediaPembelajaran_upload'];

            // Out puts just example "config.php"
            $original .= $result['file_name'];
            $newNameType = substr($result['mediaPembelajaran_upload'], -5);
            $newName = 'Dokumen Media Pembelajaran Guru ' . date('Y-m-d') . $newNameType;
        }

        force_download($newName, file_get_contents($path . $stored_file_name));
    }
    // End Download


    // Materi Pembinaan

    public function simpanMateriPembinaan_ajax()
    {

        $materiPembinaan = $this->PembelajaranModel;
        $config['upload_path'] = "./uploads/dokumen/materiPembinaan   "; //path folder file upload
        $config['allowed_types'] = 'doc|docx|pdf|csv|mp4|jpeg|jpg';
        $config['encrypt_name'] = TRUE; //enkripsi file name upload

        $this->load->library('upload', $config); //call library upload 
        if ($this->upload->do_upload("file_materiPembinaan")) { //upload file
            $data = array('upload_data' => $this->upload->data()); //ambil file name yang diupload

            $config['source_image'] = './uploads/dokumen/materiPembinaan/' . $data['upload_data']['file_name'];

            $file = $data['upload_data']['file_name'];
            $materiPembinaan = $this->input->post('materiPembinaan');
            $tanggal_materiPembinaan = date('Y-m-d');

            $dokumen = $data['upload_data']['file_name']; //set file name ke variable dokumen

            $data = array(
                'materiPembinaan_name' => $materiPembinaan,
                'materiPembinaan_upload' => $file,
                'materiPembinaan_tanggal' => $tanggal_materiPembinaan,
                'materiPembinaan_status' => 0
            );
            $result = $this->PembelajaranModel->input_data($data, 'materiPembinaan');
            //kirim value ke model m_upload
            echo json_decode($result);
        }
    }

    public function formEditMateriPembinaan()
    {
        if ($this->input->is_ajax_request() == true) {
            $MateriPembinaanID = $this->input->post('MateriPembinaanID');
            $result = $this->db->query("SELECT *FROM materiPembinaan WHERE materiPembinaan_id='$MateriPembinaanID'");

            if ($result->num_rows() > 0) {
                $row = $result->row_array();
                $data = [
                    'materiPembinaan_id' => $row['materiPembinaan_id'],
                    'materiPembinaan_name' => $row['materiPembinaan_name'],
                    'materiPembinaan_upload' => $row['materiPembinaan_upload'],
                ];
            }
            $msg = [
                'sukses' => $this->load->view('page/guru/Pembelajaran/modal/modalEditMateriPembinaan', $data, true)
            ];
            echo json_encode($msg);
        }
    }


    public function hapusMateriPembinaan_ajax()
    {
        if ($this->input->is_ajax_request() == true) {
            $MateriPembinaanID = $this->input->post("MateriPembinaanID");
            $hapus = $this->db->query("UPDATE materiPembinaan set materiPembinaan_status='0' where materiPembinaan_id='$MateriPembinaanID'");
            if ($hapus) {
                $msg = ['sukses' => 'Data MateriPembinaan Guru Berhasil Terhapus'];
            }
            echo json_encode($msg);
        }
    }


    public function updateMateriPembinaan_ajax()
    {
        $config['upload_path'] = "./uploads/dokumen/materiPembinaan   "; //path folder file upload
        $config['allowed_types'] = 'doc|docx|pdf|csv';
        $config['encrypt_name'] = TRUE; //enkripsi file name upload

        $this->load->library('upload', $config); //call library upload 

        if (!$this->upload->do_upload('file_materiPembinaan')) {
            $file = $this->input->post("file_materiPembinaanOLD");
            $config['source_image'] = './uploads/dokumen/materiPembinaan/' . $data['upload_data']['file_name'];
            $dokumen = $file;
        } else {

            $data = array('upload_data' => $this->upload->data());

            $config['source_image'] = './uploads/dokumen/materiPembinaan/' . $data['upload_data']['file_name'];
            $file = $data['upload_data']['file_name'];
            $dokumen = $data['upload_data']['file_name'];
        }

        $materiPembinaanID = $this->input->post('materiPembinaanID');
        $materiPembinaanNama = $this->input->post('materiPembinaan');

        if ($this->session->userdata('user_kd') == '') {
            $user_kd = 0;
        } else {
            $user_kd = $this->session->userdata('user_kd');
        }

        $result = $this->PembelajaranModel->updateDataMateriPembinaan($materiPembinaanNama, $dokumen, $materiPembinaanID); //kirim value ke model m_upload
        echo json_decode($result);
        // End Agama
    }


    // Download MateriPembinaan
    function downloadMateriPembinaan($id)
    {
        $this->db->where('materiPembinaan_id', $id);
        $query = $this->db->get('materiPembinaan');

        if ($query->num_rows() == 0) {
            return false;
        }

        $path = '';
        $file = '';

        foreach ($query->result_array() as $result) {

            $path .= FCPATH . 'uploads/dokumen/materiPembinaan/';

            // This gives the stored file name
            // This is folder 201702
            // Looks like 201702/post_1486965530_jeJNHKWXPMrwRpGBYxczIfTbaqhLnDVO.php

            $stored_file_name .= $result['materiPembinaan_upload'];

            // Out puts just example "config.php"
            $original .= $result['file_name'];
            $newNameType = substr($result['materiPembinaan_upload'], -5);
            $newName = 'Dokumen Materi Pembinaan ' . date('Y-m-d') . $newNameType;
        }

        force_download($newName, file_get_contents($path . $stored_file_name));
    }
    // End Download


    // Bank Soal

    public function simpanBankSoal_ajax()
    {

        $bankSoal = $this->PembelajaranModel;
        $config['upload_path'] = "./uploads/dokumen/bankSoal   "; //path folder file upload
        $config['allowed_types'] = 'doc|docx|pdf|csv|mp4|jpeg|jpg';
        $config['encrypt_name'] = TRUE; //enkripsi file name upload

        $this->load->library('upload', $config); //call library upload 
        if ($this->upload->do_upload("file_bankSoal")) { //upload file
            $data = array('upload_data' => $this->upload->data()); //ambil file name yang diupload

            $config['source_image'] = './uploads/dokumen/bankSoal/' . $data['upload_data']['file_name'];

            $file = $data['upload_data']['file_name'];
            $bankSoal = $this->input->post('bankSoal');
            $tanggal_bankSoal = date('Y-m-d');

            $dokumen = $data['upload_data']['file_name']; //set file name ke variable dokumen

            $data = array(
                'bankSoal_name' => $bankSoal,
                'bankSoal_upload' => $file,
                'bankSoal_tanggal' => $tanggal_bankSoal,
                'bankSoal_status' => 0
            );
            $result = $this->PembelajaranModel->input_data($data, 'bankSoal');
            //kirim value ke model m_upload
            echo json_decode($result);
        }
    }

    public function formEditBankSoal()
    {
        if ($this->input->is_ajax_request() == true) {
            $BankSoalID = $this->input->post('BankSoalID');
            $result = $this->db->query("SELECT *FROM bankSoal WHERE bankSoal_id='$BankSoalID'");

            if ($result->num_rows() > 0) {
                $row = $result->row_array();
                $data = [
                    'bankSoal_id' => $row['bankSoal_id'],
                    'bankSoal_name' => $row['bankSoal_name'],
                    'bankSoal_upload' => $row['bankSoal_upload'],
                ];
            }
            $msg = [
                'sukses' => $this->load->view('page/guru/Pembelajaran/modal/modalEditBankSoal', $data, true)
            ];
            echo json_encode($msg);
        }
    }


    public function hapusBankSoal_ajax()
    {
        if ($this->input->is_ajax_request() == true) {
            $BankSoalID = $this->input->post("BankSoalID");
            $hapus = $this->db->query("UPDATE bankSoal set bankSoal_status='0' where bankSoal_id='$BankSoalID'");
            if ($hapus) {
                $msg = ['sukses' => 'Data BankSoal Guru Berhasil Terhapus'];
            }
            echo json_encode($msg);
        }
    }


    public function updateBankSoal_ajax()
    {
        $config['upload_path'] = "./uploads/dokumen/bankSoal   "; //path folder file upload
        $config['allowed_types'] = 'doc|docx|pdf|csv';
        $config['encrypt_name'] = TRUE; //enkripsi file name upload

        $this->load->library('upload', $config); //call library upload 

        if (!$this->upload->do_upload('file_bankSoal')) {
            $file = $this->input->post("file_bankSoalOLD");
            $config['source_image'] = './uploads/dokumen/bankSoal/' . $data['upload_data']['file_name'];
            $dokumen = $file;
        } else {

            $data = array('upload_data' => $this->upload->data());

            $config['source_image'] = './uploads/dokumen/bankSoal/' . $data['upload_data']['file_name'];
            $file = $data['upload_data']['file_name'];
            $dokumen = $data['upload_data']['file_name'];
        }

        $bankSoalID = $this->input->post('bankSoalID');
        $bankSoalNama = $this->input->post('bankSoal');

        if ($this->session->userdata('user_kd') == '') {
            $user_kd = 0;
        } else {
            $user_kd = $this->session->userdata('user_kd');
        }

        $result = $this->PembelajaranModel->updateDataBankSoal($bankSoalNama, $dokumen, $bankSoalID); //kirim value ke model m_upload
        echo json_decode($result);
        // End Agama
    }


    // Download BankSoal
    function downloadBankSoal($id)
    {
        $this->db->where('bankSoal_id', $id);
        $query = $this->db->get('bankSoal');

        if ($query->num_rows() == 0) {
            return false;
        }

        $path = '';
        $file = '';

        foreach ($query->result_array() as $result) {

            $path .= FCPATH . 'uploads/dokumen/bankSoal/';

            // This gives the stored file name
            // This is folder 201702
            // Looks like 201702/post_1486965530_jeJNHKWXPMrwRpGBYxczIfTbaqhLnDVO.php

            $stored_file_name .= $result['bankSoal_upload'];

            // Out puts just example "config.php"
            $original .= $result['file_name'];
            $newNameType = substr($result['bankSoal_upload'], -5);
            $newName = 'Dokumen Bank Soal ' . date('Y-m-d') . $newNameType;
        }

        force_download($newName, file_get_contents($path . $stored_file_name));
    }
    // End Download
}
