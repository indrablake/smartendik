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


    // Ajax
    // Controller Ajax
    public function ambildata()
    {
        if ($this->input->is_ajax_request() == true) {
            $this->load->model('BeritaModel', 'berita');
            $list = $this->berita->getData();
            $data = array();

            $no = $_POST['start'];
            foreach ($list as $field) {
                $no++;
                $tombolEdit = "<a href=\"editBerita?id=\" class=\"btn btn-warning btn-sm\"><i class=\"icon-pencil\" style=\"font-size: 12px;\"></i></a>";
                $tombolHapus = "<a href=\"deleteBerita?id=\" class=\"btn btn-warning btn-sm\"><i class=\"icon-pencil\" style=\"font-size: 12px;\"></i></a>";

                $row = array();
                $row[] = "<input type=\"checkbox\" class=\"centangPromes\" value=\"\" name=\"promesID[]\">";
                $row[] = $no . ".";
                $row[] = $field['NP_SENDER'];
                $row[] = $field['NP_TITLE'];
                $row[] = $field['NP_POSTDATE'];
                $row[] = "<img src=\"base_url()\"";
                $row[] = $tombolEdit . $tombolHapus;
                $data[] = $row;
            }

            $output = array(

                "data" => $data,
            );
            //output dalam format JSON
            echo json_encode($output);
        } else {
            exit('Maaf data tidak bisa ditampilkan');
        }
    }

    public function simpanBerita_ajax()
    {
        if ($this->input->is_ajax_request()) {
            $berita = $this->BeritaModel;
            $validation = $this->form_validation;
            $validation->set_rules($berita->rulesBerita());


            $config['upload_path']          = './uploads/';
            $config['allowed_types']        = 'gif|jpg|png|mp4';
            $config['max_size']             = 0;

            // $config['max_width']            = 1024;
            // $config['max_height']           = 768;

            $this->load->library('upload', $config);
            $fileUpload = '';
            if (!empty($_FILES['file_berita']['name'])) {
                $this->upload->do_upload('file_berita');
                $upload_data = $this->upload->data();
                $fileUpload = $upload_data['file_name'];
                var_dump($fileUpload);
                return false;
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
                'NP_POSTDATE' => "2020",
                'NP_CONTENT' => $isi_berita,
                "NP_IMAGELINK" => $fileUpload
            );
            $berita->input_berita($data, 'TBL_NEWSPOST');
            $msg = ['sukses' => 'Berita berhasil disimpan'];




            // redirect("listProgramSemester");
            // } else {
            //     $msg = [
            //         'error' => '<div class="alert alert-warning mt-1 alert-styled-left alert-dismissible"><button type="button" class="close" data-dismiss="alert"><span>×</span></button><span class="font-weight-semibold">Warning!</span>' . validation_errors() .
            //             '.</div>'
            //     ];
            // }

            echo json_encode($msg);
        }
    }


    public function updateBerita_ajax()
    {
        if ($this->input->is_ajax_request()) {
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
                $msg = ['sukses' => 'Data Sub Tema Program Semester berhasil diupdate'];
            } else {
                $msg = [
                    'error' => '<div class="alert alert-warning mt-1 alert-styled-left alert-dismissible"><button type="button" class="close" data-dismiss="alert"><span>×</span></button><span class="font-weight-semibold">Warning!</span>' . validation_errors() .
                        '.</div>'
                ];
            }

            echo json_encode($msg);
        }
    }


    public function hapusBerita_ajax()
    {
        if ($this->input->is_ajax_request() == true) {
            $id = $this->input->get("id");
            $_id = $this->db->get_where('TBL_NEWSPOST', ['NP_ID' => $id])->row();
            $query = $this->db->delete('TBL_NEWSPOST', ['NP_ID' => $id]);

            $result = $this->db->query("SELECT *FROM TBL_NEWSPOST WHERE NP_ID='$id' AND NP_VIDEOLINK IS NULL")->num_rows();
            if ($result > 0) {
                if ($query) {
                    unlink("uploads/" . $_id->NP_VIDEOLINK);
                    $msg = ['sukses' => 'Data Kompetensi Program Semester Berhasil Terhapus'];
                }
            } else {
                if ($query) {
                    unlink("uploads/" . $_id->NP_IMAGELINK);
                    $msg = ['sukses' => 'Data Kompetensi Program Semester Berhasil Terhapus'];
                }
            }
            echo json_encode($msg);
        }
    }
}
