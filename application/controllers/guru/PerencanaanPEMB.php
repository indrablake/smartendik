<?php
defined('BASEPATH') or exit('No direct script access allowed');

class PerencanaanPEMB extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model("guru/PerencanaanPEMBModel");
        $this->load->library('form_validation');
        $this->load->helper('download');
    }

    public function listPROTA()
    {
        $data['listPROTA'] = $this->db->query("SELECT rtp.*,prota.*,js.* FROM prota inner join  ref_tahun_pelajaran rtp on rtp.thn_ajar_kd=prota.thn_ajar_kd inner join  ref_jenjang_sekolah js on js.jenjang_kd=prota.jenjang_kd")->result_array();

        $data['dataJenjang'] = $this->db->query("SELECT *FROM ref_jenjang_sekolah")->result_array();
        $data['dataTahun'] = $this->db->query("SELECT *FROM ref_tahun_pelajaran")->result_array();
        $data['head'] = 'include/head';
        $data['header'] = 'include/header';
        $data['menu'] = 'include/menu';
        $data['content'] = 'page/guru/perencanaanPEMB/listPROTA';
        $data['footer'] = 'include/footer';
        $data['title'] = 'List PROTA';
        $data['main_menu'] = 'perencanaan_pemb';
        $data['sub_menu'] = 'listPROTA';
        $this->load->view('index', $data);
    }

    public function listPROSEM()
    {
        $data['listPROSEM'] = $this->db->query("SELECT rtp.*,prosem.*,js.* FROM prosem inner join  ref_tahun_pelajaran rtp on rtp.thn_ajar_kd=prosem.thn_ajar_kd inner join  ref_jenjang_sekolah js on js.jenjang_kd=prosem.jenjang_kd")->result_array();

        $data['dataJenjang'] = $this->db->query("SELECT *FROM ref_jenjang_sekolah")->result_array();
        $data['dataTahun'] = $this->db->query("SELECT *FROM ref_tahun_pelajaran")->result_array();
        $data['head'] = 'include/head';
        $data['header'] = 'include/header';
        $data['menu'] = 'include/menu';
        $data['content'] = 'page/guru/perencanaanPEMB/listPROSEM';
        $data['footer'] = 'include/footer';
        $data['title'] = 'List PROSEM';
        $data['main_menu'] = 'perencanaan_pemb';
        $data['sub_menu'] = 'listPROSEM';
        $this->load->view('index', $data);
    }

    public function listSKL()
    {
        $data['listSKL'] = $this->db->query("SELECT rtp.*,skl.*,js.* FROM skl inner join  ref_tahun_pelajaran rtp on rtp.thn_ajar_kd=skl.thn_ajar_kd inner join  ref_jenjang_sekolah js on js.jenjang_kd=skl.jenjang_kd")->result_array();

        $data['dataJenjang'] = $this->db->query("SELECT *FROM ref_jenjang_sekolah")->result_array();
        $data['dataTahun'] = $this->db->query("SELECT *FROM ref_tahun_pelajaran")->result_array();
        $data['head'] = 'include/head';
        $data['header'] = 'include/header';
        $data['menu'] = 'include/menu';
        $data['content'] = 'page/guru/perencanaanPEMB/listSKL';
        $data['footer'] = 'include/footer';
        $data['title'] = 'List SKL';
        $data['main_menu'] = 'perencanaan_pemb';
        $data['sub_menu'] = 'listSKL';
        $this->load->view('index', $data);
    }

    public function listKI()
    {
        $data['listKI'] = $this->db->query("SELECT rtp.*,ki.*,js.* FROM ki inner join  ref_tahun_pelajaran rtp on rtp.thn_ajar_kd=ki.thn_ajar_kd inner join  ref_jenjang_sekolah js on js.jenjang_kd=ki.jenjang_kd")->result_array();

        $data['dataJenjang'] = $this->db->query("SELECT *FROM ref_jenjang_sekolah")->result_array();
        $data['dataTahun'] = $this->db->query("SELECT *FROM ref_tahun_pelajaran")->result_array();
        $data['head'] = 'include/head';
        $data['header'] = 'include/header';
        $data['menu'] = 'include/menu';
        $data['content'] = 'page/guru/perencanaanPEMB/listKI';
        $data['footer'] = 'include/footer';
        $data['title'] = 'List KI';
        $data['main_menu'] = 'perencanaan_pemb';
        $data['sub_menu'] = 'listKI';
        $this->load->view('index', $data);
    }

    public function listRPP()
    {
        $data['listRPP'] = $this->db->query("SELECT rtp.*,rpp_new.*,js.* FROM rpp_new inner join  ref_tahun_pelajaran rtp on rtp.thn_ajar_kd=rpp_new.thn_ajar_kd inner join  ref_jenjang_sekolah js on js.jenjang_kd=rpp_new.jenjang_kd")->result_array();
        $data['dataRPP'] = $this->db->query("SELECT tahun.thn_ajar_periode,rpp.rpp_semester,rpp.rpp_materi_pokok FROM rpp INNER JOIN ref_tahun_pelajaran tahun ON tahun.thn_ajar_kd=rpp.thn_ajar_kd");
        $data['dataJenjang'] = $this->db->query("SELECT *FROM ref_jenjang_sekolah")->result_array();
        $data['dataTahun'] = $this->db->query("SELECT *FROM ref_tahun_pelajaran")->result_array();
        $data['head'] = 'include/head';
        $data['header'] = 'include/header';
        $data['menu'] = 'include/menu';
        $data['content'] = 'page/guru/perencanaanPEMB/listRPP';
        $data['footer'] = 'include/footer';
        $data['title'] = 'List RPP';
        $data['main_menu'] = 'perencanaan_pemb';
        $data['sub_menu'] = 'listRPP';
        $this->load->view('index', $data);
    }

    public function listAnalisisKD()
    {
        $data['listAnalisisKD'] = $this->db->query("SELECT rtp.*,analisiskd.*,js.* FROM analisiskd inner join  ref_tahun_pelajaran rtp on rtp.thn_ajar_kd=analisiskd.thn_ajar_kd inner join  ref_jenjang_sekolah js on js.jenjang_kd=analisiskd.jenjang_kd")->result_array();

        $data['dataJenjang'] = $this->db->query("SELECT *FROM ref_jenjang_sekolah")->result_array();
        $data['dataTahun'] = $this->db->query("SELECT *FROM ref_tahun_pelajaran")->result_array();
        $data['head'] = 'include/head';
        $data['header'] = 'include/header';
        $data['menu'] = 'include/menu';
        $data['content'] = 'page/guru/perencanaanPEMB/listAnalisisKD';
        $data['footer'] = 'include/footer';
        $data['title'] = 'List AnalisisKD';
        $data['main_menu'] = 'perencanaan_pemb';
        $data['sub_menu'] = 'listAnalisisKD';
        $this->load->view('index', $data);
    }


    // Prota

    public function simpanPROTA_ajax()
    {


        $config['upload_path'] = "./uploads/dokumen/prota   "; //path folder file upload
        $config['allowed_types'] = 'doc|docx|pdf|csv';
        $config['encrypt_name'] = TRUE; //enkripsi file name upload

        $this->load->library('upload', $config); //call library upload 
        if ($this->upload->do_upload("file_prota")) { //upload file
            $data = array('upload_data' => $this->upload->data()); //ambil file name yang diupload

            $config['source_image'] = './uploads/dokumen/prota/' . $data['upload_data']['file_name'];

            $file = $data['upload_data']['file_name'];
            $prota = $this->input->post('prota');
            $tanggal_prota = date('Y-m-d');
            $kelas = $this->input->post("kelas");
            $jenjang_kd = $this->input->post("jenjang_kd");
            $thn_ajar_kd = $this->input->post("thn_ajar_kd");
            $semester = $this->input->post("semester");
            $dokumen = $data['upload_data']['file_name']; //set file name ke variable dokumen
            $result = $this->PerencanaanPEMBModel->simpan_upload($prota, $tanggal_prota, $file, $kelas, $jenjang_kd, $thn_ajar_kd, $semester); //kirim value ke model m_upload
            echo json_decode($result);
        }
    }

    public function formEditPROTA()
    {
        if ($this->input->is_ajax_request() == true) {
            $PROTAID = $this->input->post('PROTAID');
            $result = $this->db->query("SELECT *FROM prota WHERE prota_id='$PROTAID'");

            if ($result->num_rows() > 0) {
                $row = $result->row_array();
                $data = [
                    'prota_id' => $row['prota_id'],
                    'prota_name' => $row['prota_name'],
                    'prota_upload' => $row['prota_upload'],
                ];
            }
            $msg = [
                'sukses' => $this->load->view('page/guru/perencanaanPEMB/modal/modalEditPROTA', $data, true)
            ];
            echo json_encode($msg);
        }
    }


    public function hapusPROTA_ajax()
    {
        if ($this->input->is_ajax_request() == true) {
            $PROTAID = $this->input->post("PROTAID");
            $hapus = $this->db->query("UPDATE prota set prota_status='0' where prota_id='$PROTAID'");
            if ($hapus) {
                $msg = ['sukses' => 'Data PROTA Berhasil Terhapus'];
            }
            echo json_encode($msg);
        }
    }


    public function updatePROTA_ajax()
    {
        $config['upload_path'] = "./uploads/dokumen/prota   "; //path folder file upload
        $config['allowed_types'] = 'doc|docx|pdf|csv';
        $config['encrypt_name'] = TRUE; //enkripsi file name upload

        $this->load->library('upload', $config); //call library upload 

        if (!$this->upload->do_upload('file_prota')) {
            $file = $this->input->post("file_protaOLD");
            $config['source_image'] = './uploads/dokumen/prota/' . $data['upload_data']['file_name'];
            $dokumen = $file;
        } else {

            $data = array('upload_data' => $this->upload->data());

            $config['source_image'] = './uploads/dokumen/prota/' . $data['upload_data']['file_name'];
            $file = $data['upload_data']['file_name'];
            $dokumen = $data['upload_data']['file_name'];
        }

        $protaID = $this->input->post('protaID');
        $protaNama = $this->input->post('prota');
        $kelas = $this->input->post('kelas');
        $semester = $this->input->post('semester');
        $thn_ajar_kd = $this->input->post('thn_ajar_kd');
        $jenjang_kd = $this->input->post('jenjang_kd');
        if ($this->session->userdata('user_kd') == '') {
            $user_kd = 0;
        } else {
            $user_kd = $this->session->userdata('user_kd');
        }

        $result = $this->PerencanaanPEMBModel->updateData($protaNama, $dokumen, $protaID, $kelas, $semester, $thn_ajar_kd, $jenjang_kd); //kirim value ke model m_upload
        echo json_decode($result);
        // End Agama
    }


    // Download Prota
    function downloadPROTA($id)
    {
        $this->db->where('prota_id', $id);
        $query = $this->db->get('prota');

        if ($query->num_rows() == 0) {
            return false;
        }

        $path = '';
        $file = '';

        foreach ($query->result_array() as $result) {

            $path .= FCPATH . 'uploads/dokumen/prota/';

            // This gives the stored file name
            // This is folder 201702
            // Looks like 201702/post_1486965530_jeJNHKWXPMrwRpGBYxczIfTbaqhLnDVO.php

            $stored_file_name .= $result['prota_upload'];

            // Out puts just example "config.php"
            $original .= $result['file_name'];
            $newNameType = substr($result['prota_upload'], -5);
            $newName = 'Dokumen Baku PROTA ' . date('Y-m-d') . $newNameType;
        }

        force_download($newName, file_get_contents($path . $stored_file_name));
    }
    // End Download


    // Prosem

    public function simpanPROSEM_ajax()
    {

        $prosem = $this->PerencanaanPEMBModel;
        $config['upload_path'] = "./uploads/dokumen/prosem   "; //path folder file upload
        $config['allowed_types'] = 'doc|docx|pdf|csv';
        $config['encrypt_name'] = TRUE; //enkripsi file name upload

        $this->load->library('upload', $config); //call library upload 
        if ($this->upload->do_upload("file_prosem")) { //upload file
            $data = array('upload_data' => $this->upload->data()); //ambil file name yang diupload

            $config['source_image'] = './uploads/dokumen/prosem/' . $data['upload_data']['file_name'];

            $file = $data['upload_data']['file_name'];
            $prosem = $this->input->post('prosem');
            $tanggal_prosem = date('Y-m-d');

            $dokumen = $data['upload_data']['file_name']; //set file name ke variable dokumen

            $data = array(
                'prosem_name' => $prosem,
                'prosem_upload' => $file,
                'prosem_tanggal' => $tanggal_prosem,
                'prosem_status' => 0,
                'kelas' => $this->input->post("kelas"),
                'jenjang_kd' => $this->input->post("jenjang_kd"),
                'semester' => $this->input->post("semester"),
                'thn_ajar_kd' => $this->input->post("thn_ajar_kd")
            );
            $result = $this->PerencanaanPEMBModel->input_data($data, 'prosem');
            //kirim value ke model m_upload
            echo json_decode($result);
        }
    }

    public function formEditPROSEM()
    {
        if ($this->input->is_ajax_request() == true) {
            $PROSEMID = $this->input->post('PROSEMID');
            $result = $this->db->query("SELECT *FROM prosem WHERE prosem_id='$PROSEMID'");

            if ($result->num_rows() > 0) {
                $row = $result->row_array();
                $data = [
                    'prosem_id' => $row['prosem_id'],
                    'prosem_name' => $row['prosem_name'],
                    'prosem_upload' => $row['prosem_upload'],
                ];
            }
            $msg = [
                'sukses' => $this->load->view('page/guru/perencanaanPEMB/modal/modalEditPROSEM', $data, true)
            ];
            echo json_encode($msg);
        }
    }


    public function hapusPROSEM_ajax()
    {
        if ($this->input->is_ajax_request() == true) {
            $PROSEMID = $this->input->post("PROSEMID");
            $hapus = $this->db->query("UPDATE prosem set prosem_status='0' where prosem_id='$PROSEMID'");
            if ($hapus) {
                $msg = ['sukses' => 'Data PROSEM Berhasil Terhapus'];
            }
            echo json_encode($msg);
        }
    }


    public function updatePROSEM_ajax()
    {
        $config['upload_path'] = "./uploads/dokumen/prosem   "; //path folder file upload
        $config['allowed_types'] = 'doc|docx|pdf|csv';
        $config['encrypt_name'] = TRUE; //enkripsi file name upload

        $this->load->library('upload', $config); //call library upload 

        if (!$this->upload->do_upload('file_prosem')) {
            $file = $this->input->post("file_prosemOLD");
            $config['source_image'] = './uploads/dokumen/prosem/' . $data['upload_data']['file_name'];
            $dokumen = $file;
        } else {

            $data = array('upload_data' => $this->upload->data());

            $config['source_image'] = './uploads/dokumen/prosem/' . $data['upload_data']['file_name'];
            $file = $data['upload_data']['file_name'];
            $dokumen = $data['upload_data']['file_name'];
        }

        $prosemID = $this->input->post('prosemID');
        $prosemNama = $this->input->post('prosem');

        if ($this->session->userdata('user_kd') == '') {
            $user_kd = 0;
        } else {
            $user_kd = $this->session->userdata('user_kd');
        }
        $kelas = $this->input->post('kelas');
        $semester = $this->input->post('semester');
        $thn_ajar_kd = $this->input->post('thn_ajar_kd');
        $jenjang_kd = $this->input->post('jenjang_kd');
        $result = $this->PerencanaanPEMBModel->updateDataProsem($prosemNama, $dokumen, $prosemID); //kirim value ke model m_upload
        echo json_decode($result);
        // End Agama
    }


    // Download Prosem
    function downloadPROSEM($id)
    {
        $this->db->where('prosem_id', $id);
        $query = $this->db->get('prosem');

        if ($query->num_rows() == 0) {
            return false;
        }

        $path = '';
        $file = '';

        foreach ($query->result_array() as $result) {

            $path .= FCPATH . 'uploads/dokumen/prosem/';

            // This gives the stored file name
            // This is folder 201702
            // Looks like 201702/post_1486965530_jeJNHKWXPMrwRpGBYxczIfTbaqhLnDVO.php

            $stored_file_name .= $result['prosem_upload'];

            // Out puts just example "config.php"
            $original .= $result['file_name'];
            $newNameType = substr($result['prosem_upload'], -5);
            $newName = 'Dokumen Baku PROSEM ' . date('Y-m-d') . $newNameType;
        }

        force_download($newName, file_get_contents($path . $stored_file_name));
    }
    // End Download


    // SKL
    // Prosem

    public function simpanSKL_ajax()
    {

        $skl = $this->PerencanaanPEMBModel;
        $config['upload_path'] = "./uploads/dokumen/skl   "; //path folder file upload
        $config['allowed_types'] = 'doc|docx|pdf|csv';
        $config['encrypt_name'] = TRUE; //enkripsi file name upload

        $this->load->library('upload', $config); //call library upload 
        if ($this->upload->do_upload("file_skl")) { //upload file
            $data = array('upload_data' => $this->upload->data()); //ambil file name yang diupload

            $config['source_image'] = './uploads/dokumen/skl/' . $data['upload_data']['file_name'];

            $file = $data['upload_data']['file_name'];
            $skl = $this->input->post('skl');
            $tanggal_skl = date('Y-m-d');

            $dokumen = $data['upload_data']['file_name']; //set file name ke variable dokumen

            $data = array(
                'skl_name' => $skl,
                'skl_upload' => $file,
                'skl_tanggal' => $tanggal_skl,
                'skl_status' => 0,
                'kelas' => $this->input->post("kelas"),
                'jenjang_kd' => $this->input->post("jenjang_kd"),
                'thn_ajar_kd' => $this->input->post("thn_ajar_kd"),
                'semester' => $this->input->post("semester")
            );
            $result = $this->PerencanaanPEMBModel->input_data($data, 'skl');
            //kirim value ke model m_upload
            echo json_decode($result);
        }
    }

    public function formEditSKL()
    {
        if ($this->input->is_ajax_request() == true) {
            $SKLID = $this->input->post('SKLID');
            $result = $this->db->query("SELECT *FROM skl WHERE skl_id='$SKLID'");

            if ($result->num_rows() > 0) {
                $row = $result->row_array();
                $data = [
                    'skl_id' => $row['skl_id'],
                    'skl_name' => $row['skl_name'],
                    'skl_upload' => $row['skl_upload'],
                ];
            }
            $msg = [
                'sukses' => $this->load->view('page/guru/perencanaanPEMB/modal/modalEditSKL', $data, true)
            ];
            echo json_encode($msg);
        }
    }


    public function hapusSKL_ajax()
    {
        if ($this->input->is_ajax_request() == true) {
            $SKLID = $this->input->post("SKLID");
            $hapus = $this->db->query("UPDATE skl set skl_status='0' where skl_id='$SKLID'");
            if ($hapus) {
                $msg = ['sukses' => 'Data SKL Berhasil Terhapus'];
            }
            echo json_encode($msg);
        }
    }


    public function updateSKL_ajax()
    {
        $config['upload_path'] = "./uploads/dokumen/skl   "; //path folder file upload
        $config['allowed_types'] = 'doc|docx|pdf|csv';
        $config['encrypt_name'] = TRUE; //enkripsi file name upload

        $this->load->library('upload', $config); //call library upload 

        if (!$this->upload->do_upload('file_skl')) {
            $file = $this->input->post("file_sklOLD");
            $config['source_image'] = './uploads/dokumen/skl/' . $data['upload_data']['file_name'];
            $dokumen = $file;
        } else {

            $data = array('upload_data' => $this->upload->data());

            $config['source_image'] = './uploads/dokumen/skl/' . $data['upload_data']['file_name'];
            $file = $data['upload_data']['file_name'];
            $dokumen = $data['upload_data']['file_name'];
        }

        $sklID = $this->input->post('sklID');
        $sklNama = $this->input->post('skl');

        if ($this->session->userdata('user_kd') == '') {
            $user_kd = 0;
        } else {
            $user_kd = $this->session->userdata('user_kd');
        }
        $kelas = $this->input->post('kelas');
        $semester = $this->input->post('semester');
        $thn_ajar_kd = $this->input->post('thn_ajar_kd');
        $jenjang_kd = $this->input->post('jenjang_kd');
        $result = $this->PerencanaanPEMBModel->updateDataSKL($sklNama, $dokumen, $sklID, $kelas, $semester, $thn_ajar_kd, $jenjang_kd); //kirim value ke model m_upload
        echo json_decode($result);
        // End Agama
    }


    // Download Prota
    function downloadSKL($id)
    {
        $this->db->where('skl_id', $id);
        $query = $this->db->get('skl');

        if ($query->num_rows() == 0) {
            return false;
        }

        $path = '';
        $file = '';

        foreach ($query->result_array() as $result) {

            $path .= FCPATH . 'uploads/dokumen/skl/';

            // This gives the stored file name
            // This is folder 201702
            // Looks like 201702/post_1486965530_jeJNHKWXPMrwRpGBYxczIfTbaqhLnDVO.php

            $stored_file_name .= $result['skl_upload'];

            // Out puts just example "config.php"
            $original .= $result['file_name'];
            $newNameType = substr($result['skl_upload'], -5);
            $newName = 'Dokumen Baku SKL ' . date('Y-m-d') . $newNameType;
        }

        force_download($newName, file_get_contents($path . $stored_file_name));
    }




    // KI

    public function simpanKI_ajax()
    {

        $ki = $this->PerencanaanPEMBModel;
        $config['upload_path'] = "./uploads/dokumen/ki   "; //path folder file upload
        $config['allowed_types'] = 'doc|docx|pdf|csv';
        $config['encrypt_name'] = TRUE; //enkripsi file name upload

        $this->load->library('upload', $config); //call library upload 
        if ($this->upload->do_upload("file_ki")) { //upload file
            $data = array('upload_data' => $this->upload->data()); //ambil file name yang diupload

            $config['source_image'] = './uploads/dokumen/ki/' . $data['upload_data']['file_name'];

            $file = $data['upload_data']['file_name'];
            $ki = $this->input->post('ki');
            $tanggal_ki = date('Y-m-d');

            $dokumen = $data['upload_data']['file_name']; //set file name ke variable dokumen

            $data = array(
                'ki_name' => $ki,
                'ki_upload' => $file,
                'ki_tanggal' => $tanggal_ki,
                'ki_status' => 0,
                'kelas' => $this->input->post("kelas"),
                'jenjang_kd' => $this->input->post("jenjang_kd"),
                'thn_ajar_kd' => $this->input->post("thn_ajar_kd"),
                'semester' => $this->input->post("semester")
            );
            $result = $this->PerencanaanPEMBModel->input_data($data, 'ki');
            //kirim value ke model m_upload
            echo json_decode($result);
        }
    }

    public function formEditKI()
    {
        if ($this->input->is_ajax_request() == true) {
            $KIID = $this->input->post('KIID');
            $result = $this->db->query("SELECT *FROM ki WHERE ki_id='$KIID'");

            if ($result->num_rows() > 0) {
                $row = $result->row_array();
                $data = [
                    'ki_id' => $row['ki_id'],
                    'ki_name' => $row['ki_name'],
                    'ki_upload' => $row['ki_upload'],
                ];
            }
            $msg = [
                'sukses' => $this->load->view('page/guru/perencanaanPEMB/modal/modalEditKI', $data, true)
            ];
            echo json_encode($msg);
        }
    }


    public function hapusKI_ajax()
    {
        if ($this->input->is_ajax_request() == true) {
            $KIID = $this->input->post("KIID");
            $hapus = $this->db->query("UPDATE ki set ki_status='0' where ki_id='$KIID'");
            if ($hapus) {
                $msg = ['sukses' => 'Data KI Berhasil Terhapus'];
            }
            echo json_encode($msg);
        }
    }


    public function updateKI_ajax()
    {
        $config['upload_path'] = "./uploads/dokumen/ki   "; //path folder file upload
        $config['allowed_types'] = 'doc|docx|pdf|csv';
        $config['encrypt_name'] = TRUE; //enkripsi file name upload

        $this->load->library('upload', $config); //call library upload 

        if (!$this->upload->do_upload('file_ki')) {
            $file = $this->input->post("file_kiOLD");
            $config['source_image'] = './uploads/dokumen/ki/' . $data['upload_data']['file_name'];
            $dokumen = $file;
        } else {

            $data = array('upload_data' => $this->upload->data());

            $config['source_image'] = './uploads/dokumen/ki/' . $data['upload_data']['file_name'];
            $file = $data['upload_data']['file_name'];
            $dokumen = $data['upload_data']['file_name'];
        }

        $kiID = $this->input->post('kiID');
        $kiNama = $this->input->post('ki');

        if ($this->session->userdata('user_kd') == '') {
            $user_kd = 0;
        } else {
            $user_kd = $this->session->userdata('user_kd');
        }
        $kelas = $this->input->post('kelas');
        $semester = $this->input->post('semester');
        $thn_ajar_kd = $this->input->post('thn_ajar_kd');
        $jenjang_kd = $this->input->post('jenjang_kd');

        $result = $this->PerencanaanPEMBModel->updateDataKI($kiNama, $dokumen, $kiID, $kelas, $semester, $thn_ajar_kd, $jenjang_kd); //kirim value ke model m_upload
        echo json_decode($result);
        // End Agama
    }


    // Download Prota
    function downloadKI($id)
    {
        $this->db->where('ki_id', $id);
        $query = $this->db->get('ki');

        if ($query->num_rows() == 0) {
            return false;
        }

        $path = '';
        $file = '';

        foreach ($query->result_array() as $result) {

            $path .= FCPATH . 'uploads/dokumen/ki/';

            // This gives the stored file name
            // This is folder 201702
            // Looks like 201702/post_1486965530_jeJNHKWXPMrwRpGBYxczIfTbaqhLnDVO.php

            $stored_file_name .= $result['ki_upload'];

            // Out puts just example "config.php"
            $original .= $result['file_name'];
            $newNameType = substr($result['ki_upload'], -5);
            $newName = 'Dokumen KI/KD ' . date('Y-m-d') . $newNameType;
        }

        force_download($newName, file_get_contents($path . $stored_file_name));
    }


    // AnalisisKD

    public function simpanAnalisisKD_ajax()
    {

        $ki = $this->PerencanaanPEMBModel;
        $config['upload_path'] = "./uploads/dokumen/analisisKD   "; //path folder file upload
        $config['allowed_types'] = 'doc|docx|pdf|csv';
        $config['encrypt_name'] = TRUE; //enkripsi file name upload

        $this->load->library('upload', $config); //call library upload 
        if ($this->upload->do_upload("file_analisisKD")) { //upload file
            $data = array('upload_data' => $this->upload->data()); //ambil file name yang diupload

            $config['source_image'] = './uploads/dokumen/analisisKD/' . $data['upload_data']['file_name'];

            $file = $data['upload_data']['file_name'];
            $analisisKD = $this->input->post('analisisKD');
            $tanggal_analisisKD = date('Y-m-d');

            $dokumen = $data['upload_data']['file_name']; //set file name ke variable dokumen

            $data = array(
                'analisisKD_name' => $analisisKD,
                'analisisKD_upload' => $file,
                'analisisKD_tanggal' => $tanggal_analisisKD,
                'analisisKD_status' => 0,
                'kelas' => $this->input->post("kelas"),
                'jenjang_kd' => $this->input->post("jenjang_kd"),
                'semester' => $this->input->post("semester"),
                'thn_ajar_kd' => $this->input->post("thn_ajar_kd")
            );
            $result = $this->PerencanaanPEMBModel->input_data($data, 'analisisKD');
            //analisisKDrim value ke model m_upload
            echo json_decode($result);
        }
    }

    public function formEditAnalisisKD()
    {
        if ($this->input->is_ajax_request() == true) {
            $AnalisisKDID = $this->input->post('AnalisisKDID');
            $result = $this->db->query("SELECT *FROM analisisKD WHERE analisisKD_id='$AnalisisKDID'");

            if ($result->num_rows() > 0) {
                $row = $result->row_array();
                $data = [
                    'analisisKD_id' => $row['analisisKD_id'],
                    'analisisKD_name' => $row['analisisKD_name'],
                    'analisisKD_upload' => $row['analisisKD_upload'],
                ];
            }
            $msg = [
                'sukses' => $this->load->view('page/guru/perencanaanPEMB/modal/modalEditAnalisisKD', $data, true)
            ];
            echo json_encode($msg);
        }
    }


    public function hapusAnalisisKD_ajax()
    {
        if ($this->input->is_ajax_request() == true) {
            $AnalisisKDID = $this->input->post("AnalisisKDID");
            $hapus = $this->db->query("UPDATE analisisKD set analisisKD_status='0' where analisisKD_id='$AnalisisKDID'");
            if ($hapus) {
                $msg = ['sukses' => 'Data AnalisisKD Berhasil Terhapus'];
            }
            echo json_encode($msg);
        }
    }


    public function updateAnalisisKD_ajax()
    {
        $config['upload_path'] = "./uploads/dokumen/analisisKD   "; //path folder file upload
        $config['allowed_types'] = 'doc|docx|pdf|csv';
        $config['encrypt_name'] = TRUE; //enkripsi file name upload

        $this->load->library('upload', $config); //call library upload 

        if (!$this->upload->do_upload('file_analisisKD')) {
            $file = $this->input->post("file_analisisKDOLD");
            $config['source_image'] = './uploads/dokumen/analisisKD/' . $data['upload_data']['file_name'];
            $dokumen = $file;
        } else {

            $data = array('upload_data' => $this->upload->data());

            $config['source_image'] = './uploads/dokumen/analisisKD/' . $data['upload_data']['file_name'];
            $file = $data['upload_data']['file_name'];
            $dokumen = $data['upload_data']['file_name'];
        }
        $kelas = $this->input->post('kelas');
        $semester = $this->input->post('semester');
        $thn_ajar_kd = $this->input->post('thn_ajar_kd');
        $jenjang_kd = $this->input->post('jenjang_kd');
        $analisisKDID = $this->input->post('analisisKDID');
        $analisisKDNama = $this->input->post('analisisKD');

        if ($this->session->userdata('user_kd') == '') {
            $user_kd = 0;
        } else {
            $user_kd = $this->session->userdata('user_kd');
        }

        $result = $this->PerencanaanPEMBModel->updateDataAnalisisKD($analisisKDNama, $dokumen, $analisisKDID, $kelas, $semester, $thn_ajar_kd, $jenjang_kd);
        //analisisKDrim value ke model m_upload
        echo json_decode($result);
        // End Agama
    }


    // Download Analisis KD
    function downloadAnalisisKD($id)
    {
        $this->db->where('analisisKD_id', $id);
        $query = $this->db->get('analisisKD');

        if ($query->num_rows() == 0) {
            return false;
        }

        $path = '';
        $file = '';

        foreach ($query->result_array() as $result) {

            $path .= FCPATH . 'uploads/dokumen/analisisKD/';

            // This gives the stored file name
            // This is folder 201702
            // Looks like 201702/post_1486965530_jeJNHKWXPMrwRpGBYxczIfTbaqhLnDVO.php

            $stored_file_name .= $result['analisisKD_upload'];

            // Out puts just example "config.php"
            $original .= $result['file_name'];
            $newNameType = substr($result['analisisKD_upload'], -5);
            $newName = 'Dokumen Baku Analisis KD ' . date('Y-m-d') . $newNameType;
        }

        force_download($newName, file_get_contents($path . $stored_file_name));
    }


    // RPP

    public function simpanRPP_ajax()
    {

        $ki = $this->PerencanaanPEMBModel;
        $config['upload_path'] = "./uploads/dokumen/rpp   "; //path folder file upload
        $config['allowed_types'] = 'doc|docx|pdf|csv';
        $config['encrypt_name'] = TRUE; //enkripsi file name upload

        $this->load->library('upload', $config); //call library upload 
        if ($this->upload->do_upload("file_rpp")) { //upload file
            $data = array('upload_data' => $this->upload->data()); //ambil file name yang diupload

            $config['source_image'] = './uploads/dokumen/rpp/' . $data['upload_data']['file_name'];

            $file = $data['upload_data']['file_name'];
            $rpp = $this->input->post('rpp');
            $tanggal_rpp = date('Y-m-d');

            $dokumen = $data['upload_data']['file_name']; //set file name ke variable dokumen

            $data = array(
                'rpp_name' => $rpp,
                'rpp_upload' => $file,
                'rpp_tanggal' => $tanggal_rpp,
                'rpp_status' => 0,
                'kelas' => $this->input->post("kelas"),
                'jenjang_kd' => $this->input->post("jenjang_kd"),
                'semester' => $this->input->post("semester"),
                'thn_ajar_kd' => $this->input->post("thn_ajar_kd")
            );
            $result = $this->PerencanaanPEMBModel->input_data($data, 'rpp_new');
            //rpprim value ke model m_upload
            echo json_decode($result);
        }
    }

    public function formEditRPP()
    {
        if ($this->input->is_ajax_request() == true) {
            $RPPID = $this->input->post('RPPID');
            $result = $this->db->query("SELECT tap.*,rpp_new.*,js.* FROM rpp_new inner join ref_tahun_pelajaran tap on tap.thn_ajar_kd=rpp_new.thn_ajar_kd inner join ref_jenjang_sekolah js on js.jenjang_kd=rpp_new.jenjang_kd  WHERE rpp_id='$RPPID'");

            if ($result->num_rows() > 0) {
                $row = $result->row_array();
                $data = [
                    'rpp_id' => $row['rpp_id'],
                    'rpp_name' => $row['rpp_name'],
                    'rpp_upload' => $row['rpp_upload'],
                    'semester' => $row['semester'],
                    'kelas' => $row['kelas'],
                    'thn_ajar_kd' => $row['thn_ajar_kd'],
                    'jenjang_kd' => $row['jenjang_kd'],
                    'thn_ajar_periode' => $row['thn_ajar_periode'],
                    'jenjang_nm' => $row['jenjang_nm']
                ];
            }
            $msg = [
                'sukses' => $this->load->view('page/guru/perencanaanPEMB/modal/modalEditRPP', $data, true)
            ];
            echo json_encode($msg);
        }
    }


    public function hapusRPP_ajax()
    {
        if ($this->input->is_ajax_request() == true) {
            $RPPID = $this->input->post("RPPID");
            $hapus = $this->db->query("UPDATE rpp_new set rpp_status='0' where rpp_id='$RPPID'");
            if ($hapus) {
                $msg = ['sukses' => 'Data RPP Berhasil Terhapus'];
            }
            echo json_encode($msg);
        }
    }


    public function updateRPP_ajax()
    {
        $config['upload_path'] = "./uploads/dokumen/rpp   "; //path folder file upload
        $config['allowed_types'] = 'doc|docx|pdf|csv';
        $config['encrypt_name'] = TRUE; //enkripsi file name upload

        $this->load->library('upload', $config); //call library upload 

        if (!$this->upload->do_upload('file_rpp')) {
            $file = $this->input->post("file_rppOLD");
            $config['source_image'] = './uploads/dokumen/rpp/' . $data['upload_data']['file_name'];
            $dokumen = $file;
        } else {

            $data = array('upload_data' => $this->upload->data());

            $config['source_image'] = './uploads/dokumen/rpp/' . $data['upload_data']['file_name'];
            $file = $data['upload_data']['file_name'];
            $dokumen = $data['upload_data']['file_name'];
        }

        $rppID = $this->input->post('rppID');
        $rppNama = $this->input->post('rpp');

        if ($this->session->userdata('user_kd') == '') {
            $user_kd = 0;
        } else {
            $user_kd = $this->session->userdata('user_kd');
        }
        $kelas = $this->input->post('kelas');
        $semester = $this->input->post('semester');
        $thn_ajar_kd = $this->input->post('thn_ajar_kd');
        $jenjang_kd = $this->input->post('jenjang_kd');

        $result = $this->PerencanaanPEMBModel->updateDataRPP($rppNama, $dokumen, $rppID, $kelas, $semester, $thn_ajar_kd, $jenjang_kd); //rpprim value ke model m_upload
        echo json_decode($result);
        // End Agama
    }


    public function updateAnalisisKDPublikasi()
    {
        if ($this->input->is_ajax_request() == true) {
            $analisisKDID = $this->input->post("analisisKDID");
            $update = $this->db->query("UPDATE analisisKD SET analisisKD_status='1' WHERE analisisKD_id='$analisisKDID'");
            if ($update) {
                $msg = ['sukses' => 'Data Analisis KD Berhasil Di Publikasikan'];
            }
            echo json_encode($msg);
        }
    }

    public function updateRPPPublikasi()
    {
        if ($this->input->is_ajax_request() == true) {
            $rppID = $this->input->post("rppID");
            $update = $this->db->query("UPDATE rpp_new SET rpp_status='1' WHERE rpp_id='$rppID'");
            if ($update) {
                $msg = ['sukses' => 'Data RPP Berhasil Di Publikasikan'];
            }
            echo json_encode($msg);
        }
    }

    public function updateSKLPublikasi()
    {
        if ($this->input->is_ajax_request() == true) {
            $sklID = $this->input->post("sklID");
            $update = $this->db->query("UPDATE skl SET skl_status='1' WHERE skl_id='$sklID'");
            if ($update) {
                $msg = ['sukses' => 'Data SKL Berhasil Di Publikasikan'];
            }
            echo json_encode($msg);
        }
    }

    public function updatePROTAPublikasi()
    {
        if ($this->input->is_ajax_request() == true) {
            $protaID = $this->input->post("protaID");
            $update = $this->db->query("UPDATE prota SET prota_status='1' WHERE prota_id='$protaID'");
            if ($update) {
                $msg = ['sukses' => 'Data PROTA Berhasil Di Publikasikan'];
            }
            echo json_encode($msg);
        }
    }


    public function updatePROSEMPublikasi()
    {
        if ($this->input->is_ajax_request() == true) {
            $prosemID = $this->input->post("prosemID");
            $update = $this->db->query("UPDATE prosem SET prosem_status='1' WHERE prosem_id='$prosemID'");
            if ($update) {
                $msg = ['sukses' => 'Data PROSEM Berhasil Di Publikasikan'];
            }
            echo json_encode($msg);
        }
    }

    public function updateKIPublikasi()
    {
        if ($this->input->is_ajax_request() == true) {
            $kiID = $this->input->post("kiID");
            $update = $this->db->query("UPDATE ki SET ki_status='1' WHERE ki_id='$kiID'");
            if ($update) {
                $msg = ['sukses' => 'Data RPP Berhasil Di Publikasikan'];
            }
            echo json_encode($msg);
        }
    }


    // Download Prota
    function downloadRPP($id)
    {
        $this->db->where('rpp_id', $id);
        $query = $this->db->get('rpp_new');

        if ($query->num_rows() == 0) {
            return false;
        }

        $path = '';
        $file = '';

        foreach ($query->result_array() as $result) {

            $path .= FCPATH . 'uploads/dokumen/rpp/';

            // This gives the stored file name
            // This is folder 201702
            // Looks like 201702/post_1486965530_jeJNHKWXPMrwRpGBYxczIfTbaqhLnDVO.php

            $stored_file_name .= $result['rpp_upload'];

            // Out puts just example "config.php"
            $original .= $result['file_name'];
            $newNameType = substr($result['rpp_upload'], -5);
            $newName = 'Dokumen Baku RPP ' . date('Y-m-d') . $newNameType;
        }

        force_download($newName, file_get_contents($path . $stored_file_name));
    }
}
