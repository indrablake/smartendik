<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Sekolah extends CI_Controller
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
     * @see https://codeigniter.com/sekolah_guide/general/urls.html
     */


    public function __construct()
    {
        parent::__construct();
        $this->load->model("SekolahModel");
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
        $data['main_menu'] = 'dashboard';
        $data['sub_menu'] = 'home';
        $this->load->view('index', $data);
    }
    public function listSekolah()
    {
        $data['head'] = 'include/head';
        $data['header'] = 'include/header';
        $data['menu'] = 'include/menu';
        $data['content'] = 'page/sekolah/listSekolah';
        $data['footer'] = 'include/footer';
        $data['title'] = 'List Sekolah';
        $data['main_menu'] = 'List Sekolah';
        $data['sub_menu'] = 'listSekolah';
        $this->load->view('index', $data);
    }
    public function tambahSekolah()
    {
        $data['head'] = 'include/head';
        $data['header'] = 'include/header';
        $data['menu'] = 'include/menu';
        $data['content'] = 'page/sekolah/tambahSekolah';
        $data['footer'] = 'include/footer';
        $data['title'] = 'Tambah Sekolah';
        $data['main_menu'] = 'Tambah Sekolah';
        $data['sub_menu'] = 'tambahSekolah';
        $this->load->view('index', $data);
    }

    public function simpanSekolah()
    {

        $sekolah = $this->SekolahModel;
        $validation = $this->form_validation;
        $validation->set_rules($sekolah->rulesSekolah());
        if ($validation->run()) {


            $config['upload_path']          = './uploads/imageSekolah/';
            $config['allowed_types']        = 'gif|jpg|png';
            $config['max_size']             = 0;

            // $config['max_width']            = 1024;
            // $config['max_height']           = 768;

            $this->load->library('upload', $config);


            if (!$this->upload->do_upload('file_profile')) {
            } else {
                $upload_data = $this->upload->data();
                $fileUpload = $upload_data['file_name'];
            }


            $grade_sekolah = $this->input->post('grade_sekolah');
            $npsn_sekolah = $this->input->post('npsn_sekolah');
            $nama_sekolah = $this->input->post('nama_sekolah');
            $status_sekolah = $this->input->post('status_sekolah');
            $institusi_sekolah = $this->input->post('institusi_sekolah');
            $desa_sekolah = $this->input->post('desa_sekolah');
            $kota_sekolah = $this->input->post('kota_sekolah');
            $provinsi_sekolah = $this->input->post('provinsi_sekolah');
            $alamat_sekolah = $this->input->post('alamat_sekolah');
            $telp_sekolah = $this->input->post('telp_sekolah');
            $fax_sekolah = $this->input->post('fax_sekolah');
            $email_sekolah = $this->input->post('email_sekolah');
            $facebook_sekolah = $this->input->post('facebook_sekolah');
            $instagram_sekolah = $this->input->post('instagram_sekolah');
            $twitter_sekolah = $this->input->post('twitter_sekolah');
            $kota_sekolah = $this->input->post('kota_sekolah');
            $header1 = $this->input->post('header1');
            $header2 = $this->input->post('header2');
            $header3 = $this->input->post('header3');


            $data = array(
                'GRADE_ID' => $grade_sekolah,
                'SCH_NPSN' => $npsn_sekolah,
                'SCH_NAME' => $nama_sekolah,
                'SCH_ADDRESS' => $alamat_sekolah,
                'SCH_STATUS' => $status_sekolah,
                'SCH_INSTITUTION' => $institusi_sekolah,
                'SCH_VILLAGE' => $desa_sekolah,
                'SCH_DISTRICT' => $desa_sekolah,
                'SCH_PROVINCE' => $provinsi_sekolah,
                'SCH_CITY' => $kota_sekolah,
                'SCH_PHONE' => $telp_sekolah,
                'SCH_EMAIL' => $email_sekolah,
                'SCH_FAX' => $fax_sekolah,
                'SCH_FACEBOOK' => $facebook_sekolah,
                'SCH_TWITTER' => $twitter_sekolah,
                'SCH_INSTAGRAM' => $instagram_sekolah,
                'SCH_LOGO' => $fileUpload,
                'SCH_HEADER1' => $header1,
                'SCH_HEADER2' => $header2,
                'SCH_HEADER3' => $header3
            );
            $sekolah->input_sekolah($data, 'TBL_SCHOOL');
            $this->session->set_flashdata('success', 'Berhasil disimpan');
            $data['head'] = 'include/head';
            $data['header'] = 'include/header';
            $data['menu'] = 'include/menu';
            $data['content'] = 'page/sekolah/listSekolah';
            $data['footer'] = 'include/footer';
            $data['title'] = 'Tambah Sekolah ';
            $data['main_menu'] = 'Tambah Sekolah s';
            $data['sub_menu'] = 'home';
            $this->load->view('index', $data);
        } else {
            $this->session->set_flashdata('success', 'Gagal disimpan');
            $data['head'] = 'include/head';
            $data['header'] = 'include/header';
            $data['menu'] = 'include/menu';
            $data['content'] = 'page/sekolah/tambahSekolah';
            $data['footer'] = 'include/footer';
            $data['title'] = 'Tambah Sekolah ';
            $data['main_menu'] = 'Tambah Sekolah s';
            $data['sub_menu'] = 'home';
            $this->load->view('index', $data);
        }
    }


    public function listGrade()
    {
        $data['head'] = 'include/head';
        $data['header'] = 'include/header';
        $data['menu'] = 'include/menu';
        $data['content'] = 'page/sekolah/listGrade';
        $data['footer'] = 'include/footer';
        $data['title'] = 'List Grade';
        $data['main_menu'] = 'List Grade';
        $data['sub_menu'] = 'listGrade';
        $this->load->view('index', $data);
    }

    public function tambahGrade()
    {
        $data['head'] = 'include/head';
        $data['header'] = 'include/header';
        $data['menu'] = 'include/menu';
        $data['content'] = 'page/sekolah/tambahGrade';
        $data['footer'] = 'include/footer';
        $data['title'] = 'Tambah Grade';
        $data['main_menu'] = 'Tambah Grade';
        $data['sub_menu'] = 'tambahGrade';
        $this->load->view('index', $data);
    }

    public function simpanGrade()
    {

        $sekolah = $this->SekolahModel;
        $validation = $this->form_validation;
        $validation->set_rules($sekolah->rulesgrade());

        if ($validation->run()) {
            $grade = $this->input->post('gradeSekolah');
            $data = array(
                'GRADE_NAME' => $grade
            );
            $sekolah->input_grade($data, 'TBL_SCHOOLGRADE');

            $this->session->set_flashdata('success', 'Berhasil disimpan');
            $data['head'] = 'include/head';
            $data['header'] = 'include/header';
            $data['menu'] = 'include/menu';
            $data['content'] = 'page/sekolah/listGrade';
            $data['footer'] = 'include/footer';
            $data['title'] = 'List Grade';
            $data['main_menu'] = 'List Grade';
            $data['sub_menu'] = 'home';
            $this->load->view('index', $data);
        } else {
            $this->session->set_flashdata('failed', 'Lengkapi Data');
            $data['head'] = 'include/head';
            $data['header'] = 'include/header';
            $data['menu'] = 'include/menu';
            $data['content'] = 'page/sekolah/tambahGrade';
            $data['footer'] = 'include/footer';
            $data['title'] = 'Tambah Grade';
            $data['main_menu'] = 'Tambah Grade';
            $data['sub_menu'] = 'home';
            $this->load->view('index', $data);
        }
    }

    public function editGrade()
    {

        $grade = $this->input->post('gradeSekolah');
        $idGrade = $this->input->post('idGrade');

        $this->db->query("UPDATE TBL_SCHOOLGRADE SET GRADE_NAME='$grade' WHERE GRADE_ID='$idGrade'");

        $this->session->set_flashdata('success', 'Berhasil Diedit');
        $data['head'] = 'include/head';
        $data['header'] = 'include/header';
        $data['menu'] = 'include/menu';
        $data['content'] = 'page/sekolah/listGrade';
        $data['footer'] = 'include/footer';
        $data['title'] = 'List Grade';
        $data['main_menu'] = 'List Grade';
        $data['sub_menu'] = 'home';
        $this->load->view('index', $data);
    }

    // Kelas

    public function listKelas()
    {
        $data['dataKelas'] = $this->db->query("SELECT s.SCH_NAME , sc.* FROM TBL_SCHOOLCLASS sc INNER JOIN TBL_SCHOOL s ON s.SCH_ID = sc.SCH_ID")->result_array();
        $data['head'] = 'include/head';
        $data['header'] = 'include/header';
        $data['menu'] = 'include/menu';
        $data['content'] = 'page/sekolah/listKelas';
        $data['footer'] = 'include/footer';
        $data['title'] = 'List Kelas';
        $data['main_menu'] = 'List Kelas';
        $data['sub_menu'] = 'listKelas';
        $this->load->view('index', $data);
    }

    public function tambahKelas()
    {
        $data['head'] = 'include/head';
        $data['header'] = 'include/header';
        $data['menu'] = 'include/menu';
        $data['content'] = 'page/sekolah/tambahKelas';
        $data['footer'] = 'include/footer';
        $data['title'] = 'Tambah Kelas';
        $data['main_menu'] = 'Tambah Kelas';
        $data['sub_menu'] = 'home';
        $this->load->view('index', $data);
    }

    public function simpanKelas()
    {

        $sekolah = $this->SekolahModel;
        $validation = $this->form_validation;
        $validation->set_rules($sekolah->rulesKelas());

        if ($validation->run()) {
            $namaSekolah = $this->input->post('namaSekolah');
            $levelSekolah = $this->input->post('levelKelas');
            $namaKelas = $this->input->post('namaKelas');

            $data = array(
                'SCH_ID' => $namaSekolah,
                'CLASS_LEVEL' => $levelSekolah,
                'CLASS_NAME' => $namaKelas
            );
            $sekolah->input_grade($data, 'TBL_SCHOOLCLASS');

            $this->session->set_flashdata('success', 'Berhasil disimpan');
            redirect("listKelas");
        } else {
            $this->session->set_flashdata('failed', 'Lengkapi Data');
            $data['head'] = 'include/head';
            $data['header'] = 'include/header';
            $data['menu'] = 'include/menu';
            $data['content'] = 'page/sekolah/tambahSekolah';
            $data['footer'] = 'include/footer';
            $data['title'] = 'Tambah Sekolah';
            $data['main_menu'] = 'Tambah Sekolah';
            $data['sub_menu'] = 'home';
            $this->load->view('index', $data);
        }
    }


    public function editKelas()
    {
        $sekolah = $this->SekolahModel;
        $namaSekolah = $this->input->post('namaSekolah');
        $levelSekolah = $this->input->post('levelKelas');
        $namaKelas = $this->input->post('kelasSekolah');
        $idSekolah = $this->input->post("idSekolah");

        $data = array(
            'SCH_ID' => $namaSekolah,
            'CLASS_LEVEL' => $levelSekolah,
            'CLASS_NAME' => $namaKelas
        );
        $where = array(
            'CLASS_ID' => $idSekolah
        );

        $sekolah = $this->SekolahModel;
        $sekolah->update_data($where, $data, 'TBL_SCHOOLCLASS');

        $this->session->set_flashdata('success', 'Berhasil Diedit');
        redirect("listKelas");
    }


    // STPPATK

    public function listSTPPATK()
    {
        $data['dataSTPPATK'] = $this->db->query("SELECT s.SCH_NAME,s.SCH_NPSN , st.* FROM TBL_STPPATK st INNER JOIN TBL_SCHOOL s ON s.SCH_ID = st.SCH_ID")->result_array();
        $data['head'] = 'include/head';
        $data['header'] = 'include/header';
        $data['menu'] = 'include/menu';
        $data['content'] = 'page/sekolah/listSTPPATK';
        $data['footer'] = 'include/footer';
        $data['title'] = 'List STPPATK';
        $data['main_menu'] = 'List STPPATK';
        $data['sub_menu'] = 'listSTPPATK';
        $this->load->view('index', $data);
    }

    public function tambahSTPPATK()
    {
        $data['head'] = 'include/head';
        $data['header'] = 'include/header';
        $data['menu'] = 'include/menu';
        $data['content'] = 'page/sekolah/tambahSTPPATK';
        $data['footer'] = 'include/footer';
        $data['title'] = 'Tambah STPPATK';
        $data['main_menu'] = 'Tambah STPPATK';
        $data['sub_menu'] = 'home';
        $this->load->view('index', $data);
    }

    public function simpanSTPPATK()
    {

        $sekolah = $this->SekolahModel;
        $this->form_validation->set_rules('stppatk_year', 'Tahun', 'trim|required');
        $this->form_validation->set_rules('stppatk_studyyear', 'Tahun Pembelajaran', 'trim|required');
        $this->form_validation->set_rules('stppatk_number', 'Angka', 'trim|required');
        $this->form_validation->set_rules('stppatk_appointedplace', 'Lokasi', 'trim|required');
        $this->form_validation->set_rules('stppatk_appointeddate', 'Tanggal', 'trim|required');
        $this->form_validation->set_rules('stppatk_headmaster', 'Kepala', 'trim|required');
        $this->form_validation->set_rules('stppatk_institutionhead', 'Institution', 'trim|required');

        if ($this->form_validation->run() != false) {
            $sch_id = $this->input->post('sch_id');
            $stppatk_year = $this->input->post('stppatk_year');
            $stppatk_studyyear1 = $this->input->post('stppatk_studyyear');
            $stppatk_studyyear2 = intval($stppatk_studyyear1) + 1;
            $stppatk_studyyear = $stppatk_studyyear2;
            $stppatk_number = $this->input->post('stppatk_number');
            $stppatk_appointedplace = $this->input->post('stppatk_appointedplace');
            $stppatk_appointeddate = $this->input->post('stppatk_appointeddate');
            $stppatk_headmaster = $this->input->post('stppatk_headmaster');
            $stppatk_institutionhead = $this->input->post('stppatk_institutionhead');

            $data = array(
                'SCH_ID' => $sch_id,
                'STPPATK_YEAR' => $stppatk_year,
                'STPPATK_STUDYYEAR' => $stppatk_studyyear,
                'STPPATK_NUMBER' => $stppatk_number,
                'STPPATK_APPOINTEDPLACE' => $stppatk_appointedplace,
                'STPPATK_APPOINTEDDATE' => $stppatk_appointeddate,
                'STPPATK_HEADMASTER' => $stppatk_headmaster,
                'STPPATK_INSTITUTIONHEAD' => $stppatk_institutionhead,

            );
            $sekolah->input_grade($data, 'TBL_STPPATK');

            $this->session->set_flashdata('success', 'Berhasil disimpan');
            redirect("listSTPPATK");
        } else {
            $this->session->set_flashdata('failed', 'Lengkapi Data');
            $data['head'] = 'include/head';
            $data['header'] = 'include/header';
            $data['menu'] = 'include/menu';
            $data['content'] = 'page/sekolah/tambahSekolah';
            $data['footer'] = 'include/footer';
            $data['title'] = 'Tambah Sekolah';
            $data['main_menu'] = 'Tambah Sekolah';
            $data['sub_menu'] = 'home';
            $this->load->view('index', $data);
        }
    }

    public function editSTPPATK()
    {

        $sekolah = $this->SekolahModel;
        $this->form_validation->set_rules('stppatk_year', 'Tahun', 'trim|required');
        $this->form_validation->set_rules('stppatk_studyyear', 'Tahun Pembelajaran', 'trim|required');
        $this->form_validation->set_rules('stppatk_number', 'Angka', 'trim|required');
        $this->form_validation->set_rules('stppatk_appointedplace', 'Lokasi', 'trim|required');
        $this->form_validation->set_rules('stppatk_appointeddate', 'Tanggal', 'trim|required');
        $this->form_validation->set_rules('stppatk_headmaster', 'Kepala', 'trim|required');
        $this->form_validation->set_rules('stppatk_institutionhead', 'Institution', 'trim|required');

        if ($this->form_validation->run() != false) {
            $sch_id = $this->input->post('sch_id');
            $stppatk_year = $this->input->post('stppatk_year');
            $stppatk_studyyear1 = $this->input->post('stppatk_studyyear');
            $stppatk_studyyear2 = intval($stppatk_studyyear1) + 1;
            $stppatk_studyyear = $stppatk_studyyear2;
            $stppatk_number = $this->input->post('stppatk_number');
            $stppatk_id = $this->input->post('stppatk_id');
            $stppatk_appointedplace = $this->input->post('stppatk_appointedplace');
            $stppatk_appointeddate = $this->input->post('stppatk_appointeddate');
            $stppatk_headmaster = $this->input->post('stppatk_headmaster');
            $stppatk_institutionhead = $this->input->post('stppatk_institutionhead');

            $data = array(
                'SCH_ID' => $sch_id,
                'STPPATK_YEAR' => $stppatk_year,
                'STPPATK_STUDYYEAR' => $stppatk_studyyear,
                'STPPATK_NUMBER' => $stppatk_number,
                'STPPATK_APPOINTEDPLACE' => $stppatk_appointedplace,
                'STPPATK_APPOINTEDDATE' => $stppatk_appointeddate,
                'STPPATK_HEADMASTER' => $stppatk_headmaster,
                'STPPATK_INSTITUTIONHEAD' => $stppatk_institutionhead,
            );
            $where = array(
                'STPPATK_ID' => $stppatk_id
            );

            $sekolah = $this->SekolahModel;
            $sekolah->update_data($where, $data, 'TBL_STPPATK');


            $this->session->set_flashdata('success', 'Berhasil disimpan');
            redirect("listSTPPATK");
        } else {
            $this->session->set_flashdata('failed', 'Lengkapi Data');
            $data['head'] = 'include/head';
            $data['header'] = 'include/header';
            $data['menu'] = 'include/menu';
            $data['content'] = 'page/sekolah/tambahSekolah';
            $data['footer'] = 'include/footer';
            $data['title'] = 'Tambah Sekolah';
            $data['main_menu'] = 'Tambah Sekolah';
            $data['sub_menu'] = 'home';
            $this->load->view('index', $data);
        }
    }

    // Ajax
    public function dataGrade()
    {
        $data = $this->SekolahModel->grade_list();
        echo json_encode($data);
    }

    public function simpanGrade_ajax()
    {
        if ($this->input->is_ajax_request()) {
            $sekolah = $this->SekolahModel;

            $this->form_validation->set_rules("gradeSekolah", "Grade Kelas", 'required|is_unique[TBL_SCHOOLGRADE.GRADE_NAME]', ['required' => '%s tidak boleh kosong', 'is_unique' => '%s data sudah ada']);

            if ($this->form_validation->run() == TRUE) {

                // $namaSekolah = $this->input->post('namaSekolah');
                $gradeSekolah = $this->input->post('gradeSekolah');
                $data = array(
                    'GRADE_NAME' => $gradeSekolah
                );
                $sekolah->input_sekolah($data, 'TBL_SCHOOLGRADE');
                $msg = ['sukses' => 'Data Grade Sekolah berhasil disimpan'];
            } else {
                $msg = [
                    'error' => '<div class="alert alert-warning mt-1 alert-styled-left alert-dismissible"><button type="button" class="close" data-dismiss="alert"><span>×</span></button><span class="font-weight-semibold">Warning!</span>' . validation_errors() .
                        '.</div>'
                ];
            }

            echo json_encode($msg);
        }
    }


    public function formEditGrade()
    {
        if ($this->input->is_ajax_request() == true) {
            $gradeID = $this->input->post('gradeID');
            $result = $this->db->query("SELECT *FROM TBL_SCHOOLGRADE WHERE GRADE_ID='$gradeID'");

            if ($result->num_rows() > 0) {
                $row = $result->row_array();
                $data = [
                    'GRADE_ID' => $row['GRADE_ID'],
                    'GRADE_NAME' => $row['GRADE_NAME']
                ];
            }
            $msg = [
                'sukses' => $this->load->view('page/sekolah/modal/modalEditGrade', $data, true)
            ];
            echo json_encode($msg);
        }
    }


    public function hapusGrade_ajax()
    {
        if ($this->input->is_ajax_request() == true) {
            $gradeID = $this->input->post("gradeID");
            $hapus = $this->SekolahModel->hapusGrade_ajax($gradeID);
            if ($hapus) {
                $msg = ['sukses' => 'Data Tema Program Semester Berhasil Terhapus'];
            }
            echo json_encode($msg);
        }
    }


    public function updateGrade_ajax()
    {
        if ($this->input->is_ajax_request()) {
            $grade = $this->input->post('gradeSekolah');
            $idGrade = $this->input->post('idGrade');

            $this->db->query("UPDATE TBL_SCHOOLGRADE SET GRADE_NAME='$grade' WHERE GRADE_ID='$idGrade'");
            $msg = ['sukses' => 'Data Program Semester berhasil diupdate'];
            // redirect("listProgramSemester");
        } else {
            $msg = [
                'error' => '<div class="alert alert-warning mt-1 alert-styled-left alert-dismissible"><button type="button" class="close" data-dismiss="alert"><span>×</span></button><span class="font-weight-semibold">Warning!</span>' . validation_errors() .
                    '.</div>'
            ];
        }

        echo json_encode($msg);
    }


    // STPPATK



    public function simpanSTPPATK_ajax()
    {
        if ($this->input->is_ajax_request()) {
            $sekolah = $this->SekolahModel;
            $this->form_validation->set_rules('stppatk_year', 'Tahun', 'trim|required');
            $this->form_validation->set_rules('stppatk_studyyear', 'Tahun Pembelajaran', 'trim|required');
            $this->form_validation->set_rules('stppatk_number', 'Angka', 'trim|required');
            $this->form_validation->set_rules('stppatk_appointedplace', 'Lokasi', 'trim|required');
            $this->form_validation->set_rules('stppatk_appointeddate', 'Tanggal', 'trim|required');
            $this->form_validation->set_rules('stppatk_headmaster', 'Kepala', 'trim|required');
            $this->form_validation->set_rules('stppatk_institutionhead', 'Institution', 'trim|required');

            if ($this->form_validation->run() != false) {
                $sch_id = $this->input->post('sch_id');
                $stppatk_year = $this->input->post('stppatk_year');
                $stppatk_studyyear1 = $this->input->post('stppatk_studyyear');
                $stppatk_studyyear2 = intval($stppatk_studyyear1) + 1;
                $stppatk_studyyear = $stppatk_studyyear1 . $stppatk_studyyear2;
                $stppatk_number = $this->input->post('stppatk_number');
                $stppatk_appointedplace = $this->input->post('stppatk_appointedplace');
                $stppatk_appointeddate = $this->input->post('stppatk_appointeddate');
                $stppatk_headmaster = $this->input->post('stppatk_headmaster');
                $stppatk_institutionhead = $this->input->post('stppatk_institutionhead');

                $data = array(
                    'SCH_ID' => $sch_id,
                    'STPPATK_YEAR' => $stppatk_year,
                    'STPPATK_STUDYYEAR' => $stppatk_studyyear,
                    'STPPATK_NUMBER' => $stppatk_number,
                    'STPPATK_APPOINTEDPLACE' => $stppatk_appointedplace,
                    'STPPATK_APPOINTEDDATE' => $stppatk_appointeddate,
                    'STPPATK_HEADMASTER' => $stppatk_headmaster,
                    'STPPATK_INSTITUTIONHEAD' => $stppatk_institutionhead,
                );
                $sekolah->input_grade($data, 'TBL_STPPATK');
                $msg = ['sukses' => 'Data Grade Sekolah berhasil disimpan'];
            } else {
                $msg = [
                    'error' => '<div class="alert alert-warning mt-1 alert-styled-left alert-dismissible"><button type="button" class="close" data-dismiss="alert"><span>×</span></button><span class="font-weight-semibold">Warning!</span>' . validation_errors() .
                        '.</div>'
                ];
            }

            echo json_encode($msg);
        }
    }


    public function formEditSTPPATK()
    {
        if ($this->input->is_ajax_request() == true) {
            $stppatkID = $this->input->post('stppatkID');
            $result = $this->db->query("SELECT s.SCH_NAME,s.SCH_NPSN , st.* FROM TBL_STPPATK st INNER JOIN TBL_SCHOOL s ON s.SCH_ID = st.SCH_ID WHERE STPPATK_ID='$stppatkID'");

            if ($result->num_rows() > 0) {
                $row = $result->row_array();
                $data = [
                    'STPPATK_ID' => $row['STPPATK_ID'],
                    'SCH_NAME' => $row['SCH_NAME'],
                    'SCH_ID' => $row['SCH_ID'],
                    'STPPATK_YEAR' => $row['STPPATK_YEAR'],
                    'STPPATK_STUDYYEAR' => $row['STPPATK_STUDYYEAR'],
                    'STPPATK_NUMBER' => $row['STPPATK_NUMBER'],
                    'STPPATK_APPOINTEDPLACE' => $row['STPPATK_APPOINTEDPLACE'],
                    'STPPATK_APPOINTEDDATE' => $row['STPPATK_APPOINTEDDATE'],
                    'STPPATK_HEADMASTER' => $row['STPPATK_HEADMASTER'],
                    'STPPATK_INSTITUTIONHEAD' => $row['STPPATK_INSTITUTIONHEAD'],
                ];
            }
            $msg = [
                'sukses' => $this->load->view('page/sekolah/modal/modalEditSTPPATK', $data, true)
            ];
            echo json_encode($msg);
        }
    }


    public function hapusSTPPATK_ajax()
    {
        if ($this->input->is_ajax_request() == true) {
            $stppatkID = $this->input->post("stppatkID");
            $hapus = $this->SekolahModel->hapusSTPPATK_ajax($stppatkID);
            if ($hapus) {
                $msg = ['sukses' => 'Data STPPATK Berhasil Terhapus'];
            }
            echo json_encode($msg);
        }
    }


    public function updateSTPPATK_ajax()
    {
        if ($this->input->is_ajax_request()) {
            $sekolah = $this->SekolahModel;
            $stppatk_id = $this->input->post("stppatk_id");
            $sch_id = $this->input->post('sch_id');
            $stppatk_year = $this->input->post('stppatk_year');
            $stppatk_studyyear1 = $this->input->post('stppatk_studyyear');
            $stppatk_studyyear2 = intval($stppatk_studyyear1) + 1;
            $stppatk_studyyear = $stppatk_studyyear1 . $stppatk_studyyear2;
            $stppatk_number = $this->input->post('stppatk_number');
            $stppatk_appointedplace = $this->input->post('stppatk_appointedplace');
            $stppatk_appointeddate = $this->input->post('stppatk_appointeddate');
            $stppatk_headmaster = $this->input->post('stppatk_headmaster');
            $stppatk_institutionhead = $this->input->post('stppatk_institutionhead');

            $data = array(
                'SCH_ID' => $sch_id,
                'STPPATK_YEAR' => $stppatk_year,
                'STPPATK_STUDYYEAR' => $stppatk_studyyear,
                'STPPATK_NUMBER' => $stppatk_number,
                'STPPATK_APPOINTEDPLACE' => $stppatk_appointedplace,
                'STPPATK_APPOINTEDDATE' => $stppatk_appointeddate,
                'STPPATK_HEADMASTER' => $stppatk_headmaster,
                'STPPATK_INSTITUTIONHEAD' => $stppatk_institutionhead,
            );
            $where = array(
                'STPPATK_ID' => $this->input->post('stppatk_id')
            );
            $sekolah->update_data($where, $data, 'TBL_STPPATK');
            $msg = ['sukses' => 'Data STPPATK berhasil diupdate'];
            // redirect("listProgramSemester");
        } else {
            $msg = [
                'error' => '<div class="alert alert-warning mt-1 alert-styled-left alert-dismissible"><button type="button" class="close" data-dismiss="alert"><span>×</span></button><span class="font-weight-semibold">Warning!</span>' . validation_errors() .
                    '.</div>'
            ];
        }

        echo json_encode($msg);
    }


    // Sekolah

    public function simpanSekolah_ajax()
    {
        if ($this->input->is_ajax_request()) {
            $sekolah = $this->SekolahModel;
            $validation = $this->form_validation;
            $validation->set_rules($sekolah->rulesSekolah());
            if ($validation->run()) {


                $config['upload_path']          = './uploads/imageSekolah/';
                $config['allowed_types']        = 'gif|jpg|png';
                $config['max_size']             = 0;

                // $config['max_width']            = 1024;
                // $config['max_height']           = 768;

                $this->load->library('upload', $config);


                if (!$this->upload->do_upload('file_profile')) {
                } else {
                    $upload_data = $this->upload->data();
                    $fileUpload = $upload_data['file_name'];
                }


                $grade_sekolah = $this->input->post('grade_sekolah');
                $npsn_sekolah = $this->input->post('npsn_sekolah');
                $nama_sekolah = $this->input->post('nama_sekolah');
                $status_sekolah = $this->input->post('status_sekolah');
                $institusi_sekolah = $this->input->post('institusi_sekolah');
                $desa_sekolah = $this->input->post('desa_sekolah');
                $kota_sekolah = $this->input->post('kota_sekolah');
                $provinsi_sekolah = $this->input->post('provinsi_sekolah');
                $alamat_sekolah = $this->input->post('alamat_sekolah');
                $telp_sekolah = $this->input->post('telp_sekolah');
                $fax_sekolah = $this->input->post('fax_sekolah');
                $email_sekolah = $this->input->post('email_sekolah');
                $facebook_sekolah = $this->input->post('facebook_sekolah');
                $instagram_sekolah = $this->input->post('instagram_sekolah');
                $twitter_sekolah = $this->input->post('twitter_sekolah');
                $kota_sekolah = $this->input->post('kota_sekolah');
                $header1 = $this->input->post('header1');
                $header2 = $this->input->post('header2');
                $header3 = $this->input->post('header3');


                $data = array(
                    'GRADE_ID' => $grade_sekolah,
                    'SCH_NPSN' => $npsn_sekolah,
                    'SCH_NAME' => $nama_sekolah,
                    'SCH_ADDRESS' => $alamat_sekolah,
                    'SCH_STATUS' => $status_sekolah,
                    'SCH_INSTITUTION' => $institusi_sekolah,
                    'SCH_VILLAGE' => $desa_sekolah,
                    'SCH_DISTRICT' => $desa_sekolah,
                    'SCH_PROVINCE' => $provinsi_sekolah,
                    'SCH_CITY' => $kota_sekolah,
                    'SCH_PHONE' => $telp_sekolah,
                    'SCH_EMAIL' => $email_sekolah,
                    'SCH_FAX' => $fax_sekolah,
                    'SCH_FACEBOOK' => $facebook_sekolah,
                    'SCH_TWITTER' => $twitter_sekolah,
                    'SCH_INSTAGRAM' => $instagram_sekolah,
                    'SCH_LOGO' => $fileUpload,
                    'SCH_HEADER1' => $header1,
                    'SCH_HEADER2' => $header2,
                    'SCH_HEADER3' => $header3
                );
                $sekolah->input_sekolah($data, 'TBL_SCHOOL');
                $msg = ['sukses' => 'Data Grade Sekolah berhasil disimpan'];
            } else {
                $msg = [
                    'error' => '<div class="alert alert-warning mt-1 alert-styled-left alert-dismissible"><button type="button" class="close" data-dismiss="alert"><span>×</span></button><span class="font-weight-semibold">Warning!</span>' . validation_errors() .
                        '.</div>'
                ];
            }

            echo json_encode($msg);
        }
    }


    // Kelas


    public function simpanKelas_ajax()
    {
        if ($this->input->is_ajax_request()) {
            $sekolah = $this->SekolahModel;
            $validation = $this->form_validation;
            $validation->set_rules($sekolah->rulesKelas());

            if ($validation->run()) {
                $namaSekolah = $this->input->post('namaSekolah');
                $levelSekolah = $this->input->post('levelKelas');
                $namaKelas = $this->input->post('namaKelas');

                $data = array(
                    'SCH_ID' => $namaSekolah,
                    'CLASS_LEVEL' => $levelSekolah,
                    'CLASS_NAME' => $namaKelas
                );
                $sekolah->input_grade($data, 'TBL_SCHOOLCLASS');

                $msg = ['sukses' => 'Data Grade Sekolah berhasil disimpan'];
            } else {
                $msg = [
                    'error' => '<div class="alert alert-warning mt-1 alert-styled-left alert-dismissible"><button type="button" class="close" data-dismiss="alert"><span>×</span></button><span class="font-weight-semibold">Warning!</span>' . validation_errors() .
                        '.</div>'
                ];
            }

            echo json_encode($msg);
        }
    }


    public function formEditKelas()
    {
        if ($this->input->is_ajax_request() == true) {
            $classid = $this->input->post('classid');
            $result = $this->db->query("SELECT s.SCH_NAME , sc.* FROM TBL_SCHOOLCLASS sc INNER JOIN TBL_SCHOOL s ON s.SCH_ID = sc.SCH_ID WHERE sc.CLASS_ID='$classid'");

            if ($result->num_rows() > 0) {
                $row = $result->row_array();
                $data = [
                    'CLASS_ID' => $row['CLASS_ID'],
                    'SCH_ID' => $row['SCH_ID'],
                    'CLASS_LEVEL' => $row['CLASS_LEVEL'],
                    'CLASS_NAME' => $row['CLASS_NAME'],
                    'SCH_NAME' => $row['SCH_NAME']
                ];
            }
            $msg = [
                'sukses' => $this->load->view('page/sekolah/modal/modalEditKelas', $data, true)
            ];
            echo json_encode($msg);
        }
    }


    public function hapusKelas_ajax()
    {
        if ($this->input->is_ajax_request() == true) {
            $classid = $this->input->post("classid");
            $hapus = $this->SekolahModel->hapusKelas_ajax($classid);
            if ($hapus) {
                $msg = ['sukses' => 'Data Kelas Berhasil Terhapus'];
            }
            echo json_encode($msg);
        }
    }


    public function updateKelas_ajax()
    {
        if ($this->input->is_ajax_request()) {
            $sekolah = $this->SekolahModel;
            $namaSekolah = $this->input->post('namaSekolah');
            $levelSekolah = $this->input->post('levelKelas');
            $namaKelas = $this->input->post('kelasSekolah');

            $data = array(
                'SCH_ID' => $namaSekolah,
                'CLASS_LEVEL' => $levelSekolah,
                'CLASS_NAME' => $namaKelas,

            );
            $where = array(
                'CLASS_ID' => $this->input->post('idSekolah')
            );
            $sekolah->update_data($where, $data, 'TBL_SCHOOLCLASS');
            $msg = ['sukses' => 'Data Kelas berhasil diupdate'];
            // redirect("listProgramSemester");
        } else {
            $msg = [
                'error' => '<div class="alert alert-warning mt-1 alert-styled-left alert-dismissible"><button type="button" class="close" data-dismiss="alert"><span>×</span></button><span class="font-weight-semibold">Warning!</span>' . validation_errors() .
                    '.</div>'
            ];
        }

        echo json_encode($msg);
    }
}
