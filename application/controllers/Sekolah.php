<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Sekolah extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model("SekolahModel");
        $this->load->library('form_validation');
    }




    // Sekolah

    public function listSekolah()
    {
        $data['listSekolah'] = $this->db->query("SELECT
        *
    FROM
        dat_sekolah
        INNER JOIN
        ref_jenjang_sekolah
        ON 
            dat_sekolah.jenjang_kd = ref_jenjang_sekolah.jenjang_kd
        INNER JOIN
        ref_dati2
        ON 
            dat_sekolah.dati2_kd = ref_dati2.dati2_kd
        INNER JOIN
        ref_propinsi
        ON 
            dat_sekolah.propinsi_kd = ref_propinsi.propinsi_kd
        INNER JOIN
        ref_kecamatan
        ON 
            dat_sekolah.kecamatan_kd = ref_kecamatan.kecamatan_kd")->result_array();
        $data['head'] = 'include/head';
        $data['header'] = 'include/header';
        $data['menu'] = 'include/menu';
        $data['content'] = 'page/sekolah/listSekolah';
        $data['footer'] = 'include/footer';
        $data['title'] = 'List Sekolah';
        $data['main_menu'] = 'master';
        $data['sub_menu'] = 'listSekolah';
        $this->load->view('index', $data);
    }


    public function tambahSekolah()
    {
        $data['head'] = 'include/head';
        $data['header'] = 'include/header';
        $data['menu'] = 'include/menu';
        $data['content'] = 'page/sekolah/form/tambahSekolah';
        $data['footer'] = 'include/footer';
        $data['title'] = 'Tambah Sekolah';
        $data['main_menu'] = 'master';
        $data['sub_menu'] = 'listSekolah';
        $this->load->view('index', $data);
    }

    public function simpanSekolah_ajax()
    {
        if ($this->input->is_ajax_request()) {
            $this->form_validation->set_rules("jenjang_Sekolah", "Jenjang Sekolah", 'required', ['required' => '%s tidak boleh kosong']);
            $this->form_validation->set_rules("npsn_sekolah", "NPSN Sekolah", 'required|is_unique[dat_sekolah.sekolah_npsn]', ['required' => '%s tidak boleh kosong', 'is_unique' => '%s sudah diinput']);
            $this->form_validation->set_rules("nama_sekolah", "Nama Sekolah", 'required', ['required' => '%s tidak boleh kosong']);
            $this->form_validation->set_rules("status_sekolah", "Status Sekolah", 'required', ['required' => '%s tidak boleh kosong']);
            $this->form_validation->set_rules("yayasan_sekolah", "Yayasan Sekolah", 'required', ['required' => '%s tidak boleh kosong']);
            $this->form_validation->set_rules("alamat_sekolah", "Alamat Sekolah", 'required', ['required' => '%s tidak boleh kosong']);
            $this->form_validation->set_rules("kelurahan", "Kelurahan", 'required', ['required' => '%s tidak boleh kosong']);
            $this->form_validation->set_rules("header1", "Header 1 Sekolah", 'required', ['required' => '%s tidak boleh kosong']);
            $this->form_validation->set_rules("header2", "Header 2 Sekolah", 'required', ['required' => '%s tidak boleh kosong']);
            $this->form_validation->set_rules("header3", "Header 3 Sekolah", 'required', ['required' => '%s tidak boleh kosong']);


            if ($this->form_validation->run() != false) {


                $config['upload_path'] = "./uploads/ImageSekolah   "; //path folder file upload
                $config['allowed_types'] = 'gif|jpg|png|mp4';
                $config['encrypt_name'] = TRUE; //enkripsi file name upload

                $this->load->library('upload', $config); //call library upload 
                if ($this->upload->do_upload("file_logo_sekolah")) { //upload file
                    $data = array('upload_data' => $this->upload->data()); //ambil file name yang diupload

                    $config['image_library'] = 'gd2';
                    $config['source_image'] = './uploads/ImageSekolah/' . $data['upload_data']['file_name'];
                    // $config['create_thumb'] = TRUE;
                    $config['maintain_ratio'] = FALSE;
                    $config['width'] = '300';
                    $config['height'] = '300';
                    $config['new_image'] = './uploads/ImageSekolah/thumbnail/' . $data['upload_data']['file_name'];
                    $this->load->library('image_lib', $config);
                    $this->image_lib->resize();
                    $jenjang_Sekolah = $this->input->post('jenjang_Sekolah');
                    $npsn_sekolah = $this->input->post('npsn_sekolah');
                    $nama_sekolah = $this->input->post('nama_sekolah');
                    $status_sekolah = $this->input->post('status_sekolah');
                    $yayasan_sekolah = $this->input->post('yayasan_sekolah');
                    $provinsi = $this->input->post('provinsi');
                    $kecamatan = $this->input->post('kecamatan');
                    $kabupaten = $this->input->post('kabupaten');
                    $alamat_sekolah = $this->input->post('alamat_sekolah');
                    $kelurahan = $this->input->post('kelurahan');
                    $kode_pos = $this->input->post('kode_pos');
                    $telp_sekolah = $this->input->post('telp_sekolah');
                    $fax_sekolah = $this->input->post('fax_sekolah');
                    $email_sekolah = $this->input->post('email_sekolah');
                    $website_sekolah = $this->input->post('twitter_sekolah');
                    $facebook_sekolah = $this->input->post('facebook_sekolah');
                    $instagram_sekolah = $this->input->post('instagram_sekolah');
                    $twitter_sekolah = $this->input->post('twitter_sekolah');
                    $header1 = $this->input->post('header1');
                    $header2 = $this->input->post('header2');
                    $header3 = $this->input->post('header3');

                    $image = $data['upload_data']['file_name'];

                    $result = $this->SekolahModel->simpanSekolah($jenjang_Sekolah, $npsn_sekolah, $nama_sekolah, $status_sekolah, $yayasan_sekolah, $provinsi, $kecamatan, $kabupaten, $alamat_sekolah, $kelurahan, $kode_pos, $telp_sekolah, $fax_sekolah, $email_sekolah, $website_sekolah, $facebook_sekolah, $instagram_sekolah, $twitter_sekolah, $image, $header1, $header2, $header3);
                }
                $result = [
                    'sukses' => 'Berhasil Disimpan'
                ];
            } else {
                $result = [
                    'error' => '<div class="alert alert-warning mt-1 alert-styled-left alert-dismissible"><button type="button" class="close" data-dismiss="alert"><span>×</span></button><span class="font-weight-semibold">Warning!</span>' . validation_errors() .
                        '.</div>'
                ];
            }
            echo json_encode($result);
        }
    }

    public function formEditSekolah()
    {
        $idSekolah = $this->input->get("id");
        $data['sekolah'] = $this->db->query("SELECT
    *
FROM
    dat_sekolah
    INNER JOIN
    ref_jenjang_sekolah
    ON 
        dat_sekolah.jenjang_kd = ref_jenjang_sekolah.jenjang_kd
    INNER JOIN
    ref_dati2
    ON 
        dat_sekolah.dati2_kd = ref_dati2.dati2_kd
    INNER JOIN
    ref_propinsi
    ON 
        dat_sekolah.propinsi_kd = ref_propinsi.propinsi_kd
    INNER JOIN
    ref_kecamatan
    ON 
        dat_sekolah.kecamatan_kd = ref_kecamatan.kecamatan_kd WHERE dat_sekolah.sekolah_kd='$idSekolah'")->row();

        $data['head'] = 'include/head';
        $data['header'] = 'include/header';
        $data['menu'] = 'include/menu';
        $data['content'] = 'page/sekolah/form/editSekolah';
        $data['footer'] = 'include/footer';
        $data['title'] = 'Edit Sekolah';
        $data['main_menu'] = 'master';
        $data['sub_menu'] = 'listSekolah';
        $this->load->view('index', $data);
    }

    public function updateSekolah_ajax()
    {
        $config['upload_path'] = "./uploads/ImageSekolah   "; //path folder file upload
        $config['allowed_types'] = 'gif|jpg|png|mp4';
        $config['encrypt_name'] = TRUE; //enkripsi file name upload

        $this->load->library('upload', $config); //call library upload 

        if (!$this->upload->do_upload('file_fotoSekolah')) {
            $image = $this->input->post("file_fotoSekolahOld");
        } else {
            $data = array('upload_data' => $this->upload->data());
            $image = $data['upload_data']['file_name'];
            $config['image_library'] = 'gd2';
            $config['source_image'] = './uploads/imageSekolah/' . $data['upload_data']['file_name'];
            // $config['create_thumb'] = TRUE;
            $config['maintain_ratio'] = FALSE;
            $config['width'] = '300';
            $config['height'] = '300';
            $config['new_image'] = './uploads/imageSekolah/thumbnail/' . $data['upload_data']['file_name'];
            $this->load->library('image_lib', $config);
            $this->image_lib->resize();
        }


        //ambil file name yang diupload

        $sekolahID = $this->input->post('sekolahID');
        $jenjang_Sekolah = $this->input->post('jenjang_Sekolah');
        $npsn_sekolah = $this->input->post('npsn_sekolah');
        $nama_sekolah = $this->input->post('nama_sekolah');
        $status_sekolah = $this->input->post('status_sekolah');
        $yayasan_sekolah = $this->input->post('yayasan_sekolah');
        $provinsi = $this->input->post('provinsi');
        $kecamatan = $this->input->post('kecamatan');
        $kabupaten = $this->input->post('kabupaten');
        $alamat_sekolah = $this->input->post('alamat_sekolah');
        $kelurahan = $this->input->post('kelurahan');
        $kode_pos = $this->input->post('kode_pos');
        $telp_sekolah = $this->input->post('telp_sekolah');
        $fax_sekolah = $this->input->post('fax_sekolah');
        $email_sekolah = $this->input->post('email_sekolah');
        $website_sekolah = $this->input->post('twitter_sekolah');
        $facebook_sekolah = $this->input->post('facebook_sekolah');
        $instagram_sekolah = $this->input->post('instagram_sekolah');
        $twitter_sekolah = $this->input->post('twitter_sekolah');
        $header1 = $this->input->post('header1');
        $header2 = $this->input->post('header2');
        $header3 = $this->input->post('header3');


        $image = $data['upload_data']['file_name'];

        $result = $this->SekolahModel->updateSekolah($jenjang_Sekolah, $npsn_sekolah, $nama_sekolah, $status_sekolah, $yayasan_sekolah, $provinsi, $kecamatan, $kabupaten, $alamat_sekolah, $kelurahan, $kode_pos, $telp_sekolah, $fax_sekolah, $email_sekolah, $website_sekolah, $facebook_sekolah, $instagram_sekolah, $twitter_sekolah, $image, $header1, $header2, $header3, $sekolahID);
        echo json_encode($result);
    }

    public function hapusSekolah_ajax()
    {
        if ($this->input->is_ajax_request() == true) {
            $sekolahID = $this->input->post("sekolahID");
            $hapus = $this->SekolahModel->hapusSekolah_ajax($sekolahID);
            if ($hapus) {
                $msg = ['sukses' => 'Data Sekolah Berhasil Terhapus'];
            }
            echo json_encode($msg);
        }
    }

    // End Sekolah
}
