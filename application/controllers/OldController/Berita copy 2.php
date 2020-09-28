<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Berita extends CI_Controller
{

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     *	- or -
     * 		http://example.com/index.php/welcome/index
     *	- or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see https://codeigniter.com/Berita_guide/general/urls.html
     */


    public function __construct()
    {
        parent::__construct();
        $this->load->model("BeritaModel");
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['head'] = 'include/head';
        $data['header'] = 'include/header';
        $data['menu'] = 'include/menu';
        $data['content'] = 'page/dashboard';
        $data['footer'] = 'include/footer';
        $data['title'] = 'Dashboard';
        $data['main_menu'] = 'berita';
        $data['sub_menu'] = 'home';
        $this->load->view('index', $data);
    }
    public function listBerita()
    {
        $data['head'] = 'include/head';
        $data['header'] = 'include/header';
        $data['menu'] = 'include/menu';
        $data['content'] = 'page/berita/listBerita';
        $data['footer'] = 'include/footer';
        $data['title'] = 'List Berita';
        $data['main_menu'] = 'berita';
        $data['sub_menu'] = 'listBerita';
        $this->load->view('index', $data);
    }
    public function tambahBerita()
    {
        $data['head'] = 'include/head';
        $data['header'] = 'include/header';
        $data['menu'] = 'include/menu';
        $data['content'] = 'page/berita/tambahBerita';
        $data['footer'] = 'include/footer';
        $data['title'] = 'Tambah Berita';
        $data['main_menu'] = 'berita';
        $data['sub_menu'] = 'tambahBerita';
        $this->load->view('index', $data);
    }


    public function listBeritaGroup()
    {
        $data['head'] = 'include/head';
        $data['header'] = 'include/header';
        $data['menu'] = 'include/menu';
        $data['content'] = 'page/berita/listBeritaGroup';
        $data['footer'] = 'include/footer';
        $data['title'] = 'List Berita Group';
        $data['main_menu'] = 'berita';
        $data['sub_menu'] = 'listBeritaGroup';
        $this->load->view('index', $data);
    }
    public function tambahBeritaGroup()
    {
        $data['head'] = 'include/head';
        $data['header'] = 'include/header';
        $data['menu'] = 'include/menu';
        $data['content'] = 'page/berita/tambahBeritaGroup';
        $data['footer'] = 'include/footer';
        $data['title'] = 'Tambah Berita Group';
        $data['main_menu'] = 'berita';
        $data['sub_menu'] = 'tambahBeritaGroup';
        $this->load->view('index', $data);
    }


    public function simpanBeritaAksi()
    {

        $berita = $this->BeritaModel;
        $validation = $this->form_validation;
        $validation->set_rules($berita->rulesBerita());
        if ($validation->run()) {

            $config['upload_path']          = './uploads/';
            $config['allowed_types']        = 'gif|jpg|png|mp4';
            $config['max_size']             = 0;

            // $config['max_width']            = 1024;
            // $config['max_height']           = 768;

            $this->load->library('upload', $config);


            if (!$this->upload->do_upload('file_berita')) {
                $data['error'] = $this->upload->display_errors();
                $data['head'] = 'include/head';
                $data['header'] = 'include/header';
                $data['menu'] = 'include/menu';
                $data['content'] = 'page/berita/tambahBerita';
                $data['footer'] = 'include/footer';
                $data['title'] = 'Tambah Berita ';
                $data['main_menu'] = 'berita';
                $data['sub_menu'] = 'home';
                $this->load->view('index', $data);
            } else {
                $upload_data = $this->upload->data();
                $fileUpload = $upload_data['file_name'];
            }


            if ($this->session->nama == '') {
                $np_sender = "Admin";
            } else {
                $np_sender = $this->session->nama;
            }
            $judul_berita = $this->input->post('judul_berita');
            $tanggal_berita = $this->input->post('tanggal_berita');
            $dateExpire = $this->input->post('tanggal_expire');
            $isi_berita = $this->input->post('isi_berita');
            $date = date_create($dateExpire);
            $tanggal_expire = date_format($date, "Y-m-d");

            $data = array(
                'NP_SENDER' => $np_sender,
                'NP_TITLE' => $judul_berita,
                'NP_EXPDATE' => $tanggal_expire,
                'NP_POSTDATE' => $tanggal_berita,
                'NP_CONTENT' => $isi_berita,
                "NP_IMAGELINK" => $fileUpload
            );
            $berita->input_berita($data, 'TBL_NEWSPOST');
            $this->session->set_flashdata('success', 'Berhasil disimpan');
            $data['head'] = 'include/head';
            $data['header'] = 'include/header';
            $data['menu'] = 'include/menu';
            $data['content'] = 'page/berita/listBerita';
            $data['footer'] = 'include/footer';
            $data['title'] = 'List Berita';
            $data['main_menu'] = 'berita';
            $data['sub_menu'] = 'home';
            $this->load->view('index', $data);
        } else {
            $this->session->set_flashdata('failed', 'Gagal disimpan');
            $data['head'] = 'include/head';
            $data['header'] = 'include/header';
            $data['menu'] = 'include/menu';
            $data['content'] = 'page/berita/tambahBerita';
            $data['footer'] = 'include/footer';
            $data['title'] = 'Tambah Berita ';
            $data['main_menu'] = 'berita';
            $data['sub_menu'] = 'home';
            $this->load->view('index', $data);
        }
    }

    public function editBerita()
    {
        $idBerita = $this->input->get("id");
        $data['idBerita'] = $idBerita;
        $data['resultQuery'] = $this->BeritaModel->ambilData($idBerita);
        $data['head'] = 'include/head';
        $data['header'] = 'include/header';
        $data['menu'] = 'include/menu';
        $data['content'] = 'page/berita/editBerita';
        $data['footer'] = 'include/footer';
        $data['title'] = 'Edit Berita';
        $data['main_menu'] = 'berita';
        $data['sub_menu'] = 'home';
        $this->load->view('index', $data);
    }


    public function editBeritaAksi()
    {

        $berita = $this->BeritaModel;
        $validation = $this->form_validation;
        $validation->set_rules($berita->rulesBerita());
        if ($validation->run()) {

            $config['upload_path']          = './uploads/';
            $config['allowed_types']        = 'gif|jpg|png|mp4';
            $config['max_size']             = 0;

            // $config['max_width']            = 1024;
            // $config['max_height']           = 768;

            $this->load->library('upload', $config);


            if (!$this->upload->do_upload('file_berita')) {
                $fileUpload = $this->input->post("file_berita_old");
            } else {
                $upload_data = $this->upload->data();
                $fileUpload = $upload_data['file_name'];
            }


            if ($this->session->nama == '') {
                $np_sender = "Admin";
            } else {
                $np_sender = $this->session->nama;
            }
            $judul_berita = $this->input->post('judul_berita');
            $tanggal_berita = $this->input->post('tanggal_berita');
            $isi_berita = $this->input->post('isi_berita');
            $id_berita = $this->input->post('id_berita');


            $this->db->query("UPDATE TBL_NEWSPOST SET NP_SENDER='$np_sender', NP_TITLE='$judul_berita', NP_CONTENT='$isi_berita',NP_IMAGELINK='$fileUpload' WHERE np_id='$id_berita'");
            $this->session->set_flashdata('success', 'Berhasil Diedit');
            $data['head'] = 'include/head';
            $data['header'] = 'include/header';
            $data['menu'] = 'include/menu';
            $data['content'] = 'page/berita/listBerita';
            $data['footer'] = 'include/footer';
            $data['title'] = 'List Berita';
            $data['main_menu'] = 'berita';
            $data['sub_menu'] = 'home';
            $this->load->view('index', $data);
        } else {
            $this->session->set_flashdata('failed', 'Gagal Diedit');
            $data['head'] = 'include/head';
            $data['header'] = 'include/header';
            $data['menu'] = 'include/menu';
            $data['content'] = 'page/berita/editBerita';
            $data['footer'] = 'include/footer';
            $data['title'] = 'Edit Berita ';
            $data['main_menu'] = 'berita';
            $data['sub_menu'] = 'home';
            $this->load->view('index', $data);
        }
    }

    public function deleteBerita()
    {
        $id = $this->input->get("id");
        $_id = $this->db->get_where('TBL_NEWSPOST', ['NP_ID' => $id])->row();
        $query = $this->db->delete('TBL_NEWSPOST', ['NP_ID' => $id]);

        $result = $this->db->query("SELECT *FROM TBL_NEWSPOST WHERE NP_ID='$id' AND NP_VIDEOLINK IS NULL")->num_rows();
        if ($result > 0) {
            if ($query) {
                unlink("uploads/" . $_id->NP_VIDEOLINK);
            }
        } else {
            if ($query) {
                unlink("uploads/" . $_id->NP_IMAGELINK);
            }
        }

        $this->session->set_flashdata('success', 'Berhasil Dihapus');
        redirect('listBerita');
    }


    public function simpanBerita_ajax()
    {


        $config['upload_path'] = "./uploads/Berita   "; //path folder file upload
        $config['allowed_types'] = 'gif|jpg|png|mp4';
        $config['encrypt_name'] = TRUE; //enkripsi file name upload

        $this->load->library('upload', $config); //call library upload 
        if ($this->upload->do_upload("file_berita")) { //upload file
            $data = array('upload_data' => $this->upload->data()); //ambil file name yang diupload

            $config['image_library'] = 'gd2';
            $config['source_image'] = './uploads/berita/' . $data['upload_data']['file_name'];
            // $config['create_thumb'] = TRUE;
            $config['maintain_ratio'] = FALSE;
            $config['width'] = '300';
            $config['height'] = '300';
            $config['new_image'] = './uploads/Berita/thumbnail/' . $data['upload_data']['file_name'];
            $this->load->library('image_lib', $config);
            $this->image_lib->resize();

            $file = $data['upload_data']['file_name'];

            $judul_berita = $this->input->post('judul_berita');
            $tanggal_berita = $this->input->post('tanggal_berita');
            $tanggal_expire = $this->input->post('tanggal_expire');
            $isi_berita = $this->input->post('isi_berita');


            $image = '';
            $video = '';

            if (substr($file, -3) == 'mp4') {
                $video = $data['upload_data']['file_name']; //set file name ke variable image
                $image = $data['updload_data']['file_name'];
            } else {
                $image = $data['upload_data']['file_name']; //set file name ke variable image
            }

            $result = $this->BeritaModel->simpan_upload($judul_berita, $tanggal_berita, $tanggal_expire, $isi_berita, $image, $video); //kirim value ke model m_upload
            echo json_decode($result);
        }
    }


    public function hapusBerita_ajax()
    {
        if ($this->input->is_ajax_request() == true) {
            $beritaID = $this->input->post("beritaID");
            $hapus = $this->BeritaModel->hapusBerita_ajax($beritaID);
            if ($hapus) {
                $msg = ['sukses' => 'Data Berita Berhasil Terhapus'];
            }
            echo json_encode($msg);
        }
    }
}
