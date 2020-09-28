<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Siswa extends CI_Controller
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
     * @see https://codeigniter.com/siswa_guide/general/urls.html
     */


    public function __construct()
    {
        parent::__construct();
        $this->load->model("SiswaModel");
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
        $data['main_menu'] = 'siswa';
        $data['sub_menu'] = 'home';
        $this->load->view('index', $data);
    }

    public function tambahSiswa()
    {
        $data['head'] = 'include/head';
        $data['header'] = 'include/header';
        $data['menu'] = 'include/menu';
        $data['content'] = 'page/siswa/tambahSiswa';
        $data['footer'] = 'include/footer';
        $data['title'] = 'Tambah Siswa ';
        $data['main_menu'] = 'siswa';
        $data['sub_menu'] = 'tambahSiswa';
        $this->load->view('index', $data);
    }

    public function simpanSiswa()
    {

        $siswa = $this->SiswaModel;
        $this->form_validation->set_rules("nisn_siswa", "NISN Siswa", 'required|is_unique[TBL_STUDENT.STD_NISN]');
        $this->form_validation->set_rules("nama_depan", "Nama Depan", 'required');
        $this->form_validation->set_rules("nama_belakang", "Nama Belakang", 'required');
        $this->form_validation->set_rules("tempat_lahir", "Tempat Lahir", 'required');
        $this->form_validation->set_rules("tanggal_lahir", "Nama Belakang", 'required');
        $this->form_validation->set_rules("desa_siswa", "Desa Siswa", 'required');
        $this->form_validation->set_rules("kota_siswa", "Kota Siswa", 'required');
        $this->form_validation->set_rules("provinsi_siswa", "Provinsi Siswa", 'required');
        $this->form_validation->set_rules("telp_siswa", "Telp Siswa", 'required');
        $this->form_validation->set_rules("email_siswa", "Email Siswa", 'required');
        $this->form_validation->set_rules("jenis_kelamin", "Jenis Kelamin", 'required');
        $this->form_validation->set_rules("agama_siswa", "Agama Siswa", 'required');


        if ($this->form_validation->run() != false) {

            $nisn_siswa = $this->input->post('nisn_siswa');
            $nama_depan = $this->input->post('nama_depan');
            $nama_belakang = $this->input->post('nama_belakang');
            $tempat_lahir = $this->input->post('tempat_lahir');
            $tanggal_lahir = $this->input->post('tanggal_lahir');
            $desa_siswa = $this->input->post('desa_siswa');
            $kota_siswa = $this->input->post('kota_siswa');
            $provinsi_siswa = $this->input->post('provinsi_siswa');
            $telp_siswa = $this->input->post('telp_siswa');
            $email_siswa = $this->input->post('email_siswa');
            $alamat_siswa = $this->input->post('alamat_siswa');
            $jenis_kelamin = $this->input->post('jenis_kelamin');
            $agama_siswa = $this->input->post('agama_siswa');

            $data = array(
                'STD_NISN' => $nisn_siswa,
                'STD_FIRSTNAME' => $nama_depan,
                'STD_LASTNAME' => $nama_belakang,
                'STD_BIRTHPLACE' => $tempat_lahir,
                'STD_BIRTHDATE' => $tanggal_lahir,
                'STD_GENDER' => $jenis_kelamin,
                'REL_ID' => $agama_siswa,
                'STD_ADDRESS' => $alamat_siswa,
                'STD_VILLAGE' => $desa_siswa,
                'STD_DISTRICT' => $kota_siswa,
                'STD_CITY' => $kota_siswa,
                'STD_PROVINCE' => $provinsi_siswa,
                'STD_PHONE' => $telp_siswa,
                'STD_EMAIL' => $email_siswa
            );
            $siswa->input_siswa_group($data, 'TBL_STUDENT');
            $this->session->set_flashdata('success', 'Berhasil disimpan');

            redirect("listSiswa");
        } else {
            $this->session->set_flashdata('success', 'Gagal disimpan');
            $data['head'] = 'include/head';
            $data['header'] = 'include/header';
            $data['menu'] = 'include/menu';
            $data['content'] = 'page/siswa/tambahSiswa';
            $data['footer'] = 'include/footer';
            $data['title'] = 'Tambah Siswa ';
            $data['main_menu'] = 'siswa';
            $data['sub_menu'] = 'home';
            $this->load->view('index', $data);
        }
    }



    public function updateSiswa()
    {

        $siswa = $this->SiswaModel;
        $this->form_validation->set_rules("siswaname", "Siswaname", 'required|is_unique[TBL_USER.USER_NAME]');
        $this->form_validation->set_rules("password", "Password", 'required|trim|min_length[3]|matches[password2]', [
            'matches' => 'Password dont match !',
            'min_length' => 'Password to short'
        ]);
        $this->form_validation->set_rules("password2", "Password", 'required|trim|min_length[3]|matches[password]');
        if ($this->form_validation->run() != false) {

            $siswaname = htmlspecialchars($this->input->post('siswaname'));
            $siswaGroup = $this->input->post('siswaGroup');
            $password = $this->input->post('password');
            $data = array(
                'UG_ID' => $siswaGroup,
                'USER_NAME' => $siswaname,
                'USER_PASSWORD' => password_hash($password, PASSWORD_DEFAULT)
            );
            $siswa->input_siswa_group($data, 'TBL_USER');
            $queryID = $this->db->query("SELECT *FROM TBL_USER ORDER BY USER_ID DESC LIMIT 1");
            $queryID = $queryID->row();
            $queryID = $queryID->USER_ID;
            $this->db->query("INSERT INTO TBL_PROFILE (USER_ID) VALUES($queryID)");
            $this->session->set_flashdata('success', 'Berhasil disimpan');

            redirect("listSiswa");
        } else {
            $this->session->set_flashdata('success', 'Gagal disimpan');
            $data['head'] = 'include/head';
            $data['header'] = 'include/header';
            $data['menu'] = 'include/menu';
            $data['content'] = 'page/siswa/tambahSiswa';
            $data['footer'] = 'include/footer';
            $data['title'] = 'Tambah Siswa ';
            $data['main_menu'] = 'siswa';
            $data['sub_menu'] = 'home';
            $this->load->view('index', $data);
        }
    }




    public function tambahReligion()
    {
        $data['head'] = 'include/head';
        $data['header'] = 'include/header';
        $data['menu'] = 'include/menu';
        $data['content'] = 'page/siswa/tambahReligion';
        $data['footer'] = 'include/footer';
        $data['title'] = 'Tambah Religion ';
        $data['main_menu'] = 'siswa';
        $data['sub_menu'] = 'tambahReligion';
        $this->load->view('index', $data);
    }

    public function simpanReligion()
    {

        $siswa = $this->SiswaModel;
        $this->form_validation->set_rules("agama", "Agama", 'required|is_unique[TBL_RELIGION.REL_NAME]');

        if ($this->form_validation->run() != false) {

            $agama = $this->input->post('agama');

            $data = array(
                'REL_NAME' => $agama,
            );
            $siswa->input_siswa_group($data, 'TBL_RELIGION');
            $this->session->set_flashdata('success', 'Berhasil disimpan');

            redirect("listReligion");
        } else {
            $this->session->set_flashdata('success', 'Gagal disimpan');
            $data['head'] = 'include/head';
            $data['header'] = 'include/header';
            $data['menu'] = 'include/menu';
            $data['content'] = 'page/siswa/tambahReligion';
            $data['footer'] = 'include/footer';
            $data['title'] = 'Tambah Religion';
            $data['main_menu'] = 'siswa';
            $data['sub_menu'] = 'home';
            $this->load->view('index', $data);
        }
    }



    public function updateReligion()
    {


        $siswa = $this->SiswaModel;
        $this->form_validation->set_rules("agama", "Agama", 'required|is_unique[TBL_RELIGION.REL_NAME]');

        if ($this->form_validation->run() != false) {

            $agama = $this->input->post('agama');

            $data = array(
                'REL_NAME' => $agama,
            );
            $siswa->input_siswa_group($data, 'TBL_USER');
            $queryID = $this->db->query("SELECT *FROM TBL_USER ORDER BY USER_ID DESC LIMIT 1");
            $queryID = $queryID->row();
            $queryID = $queryID->USER_ID;
            $this->db->query("INSERT INTO TBL_PROFILE (USER_ID) VALUES($queryID)");
            $this->session->set_flashdata('success', 'Berhasil disimpan');

            redirect("listSiswa");
        } else {
            $this->session->set_flashdata('success', 'Gagal disimpan');
            $data['head'] = 'include/head';
            $data['header'] = 'include/header';
            $data['menu'] = 'include/menu';
            $data['content'] = 'page/siswa/tambahSiswa';
            $data['footer'] = 'include/footer';
            $data['title'] = 'Tambah Siswa ';
            $data['main_menu'] = 'siswa';
            $data['sub_menu'] = 'home';
            $this->load->view('index', $data);
        }
    }



    // Kelas Siswa


    public function tambahKelasSiswa()
    {
        $data['head'] = 'include/head';
        $data['header'] = 'include/header';
        $data['menu'] = 'include/menu';
        $data['content'] = 'page/siswa/tambahKelasSiswa';
        $data['footer'] = 'include/footer';
        $data['title'] = 'Tambah KelasSiswa ';
        $data['main_menu'] = 'siswa';
        $data['sub_menu'] = 'tambahKelasSiswa';
        $this->load->view('index', $data);
    }

    public function simpanKelasSiswa()
    {

        $siswa = $this->SiswaModel;
        $this->form_validation->set_rules("kelasID", "Kelas Siswa", 'required');
        $this->form_validation->set_rules("siswaID", "Siswa", 'required');
        $this->form_validation->set_rules("tahunKelasSiswa", "Tahun Masuk", 'required');

        if ($this->form_validation->run() != false) {

            $kelasID = $this->input->post('kelasID');
            $siswaID = $this->input->post('siswaID');
            $tahunKelasSiswa = $this->input->post('tahunKelasSiswa');
            $tahunKelasSiswa2 = intval($tahunKelasSiswa) + 1;
            $tahunKelas = $tahunKelasSiswa . $tahunKelasSiswa2;

            $data = array(
                'CLSMEM_STUDYYEAR' => $tahunKelas,
                'CLASS_ID' => $kelasID,
                'STD_ID' => $siswaID
            );
            $siswa->input_siswa_group($data, 'TBL_CLASSSMEMBER');
            $this->session->set_flashdata('success', 'Berhasil disimpan');

            redirect("listKelasSiswa");
        } else {
            $this->session->set_flashdata('success', 'Gagal disimpan');
            $data['head'] = 'include/head';
            $data['header'] = 'include/header';
            $data['menu'] = 'include/menu';
            $data['content'] = 'page/siswa/tambahSiswa';
            $data['footer'] = 'include/footer';
            $data['title'] = 'Tambah Siswa ';
            $data['main_menu'] = 'siswa';
            $data['sub_menu'] = 'home';
            $this->load->view('index', $data);
        }
    }



    public function updateKelasSiswa()
    {

        $siswa = $this->SiswaModel;
        $this->form_validation->set_rules("siswaname", "Siswaname", 'required|is_unique[TBL_USER.USER_NAME]');
        $this->form_validation->set_rules("password", "Password", 'required|trim|min_length[3]|matches[password2]', [
            'matches' => 'Password dont match !',
            'min_length' => 'Password to short'
        ]);
        $this->form_validation->set_rules("password2", "Password", 'required|trim|min_length[3]|matches[password]');
        if ($this->form_validation->run() != false) {

            $siswaname = htmlspecialchars($this->input->post('siswaname'));
            $siswaGroup = $this->input->post('siswaGroup');
            $password = $this->input->post('password');
            $data = array(
                'UG_ID' => $siswaGroup,
                'USER_NAME' => $siswaname,
                'USER_PASSWORD' => password_hash($password, PASSWORD_DEFAULT)
            );
            $siswa->input_siswa_group($data, 'TBL_USER');
            $queryID = $this->db->query("SELECT *FROM TBL_USER ORDER BY USER_ID DESC LIMIT 1");
            $queryID = $queryID->row();
            $queryID = $queryID->USER_ID;
            $this->db->query("INSERT INTO TBL_PROFILE (USER_ID) VALUES($queryID)");
            $this->session->set_flashdata('success', 'Berhasil disimpan');

            redirect("listSiswa");
        } else {
            $this->session->set_flashdata('success', 'Gagal disimpan');
            $data['head'] = 'include/head';
            $data['header'] = 'include/header';
            $data['menu'] = 'include/menu';
            $data['content'] = 'page/siswa/tambahSiswa';
            $data['footer'] = 'include/footer';
            $data['title'] = 'Tambah Siswa ';
            $data['main_menu'] = 'siswa';
            $data['sub_menu'] = 'home';
            $this->load->view('index', $data);
        }
    }




    // Siswa

    public function listSiswa()
    {
        $data['dataSiswa'] = $this->db->query("SELECT *FROM TBL_STUDENT")->result_array();
        $data['head'] = 'include/head';
        $data['header'] = 'include/header';
        $data['menu'] = 'include/menu';
        $data['content'] = 'page/siswa/listSiswa';
        $data['footer'] = 'include/footer';
        $data['title'] = 'List Siswa';
        $data['main_menu'] = 'siswa';
        $data['sub_menu'] = 'listSiswa';
        $this->load->view('index', $data);
    }


    public function simpanSiswa_ajax()
    {
        if ($this->input->is_ajax_request()) {
            $siswa = $this->SiswaModel;
            $this->form_validation->set_rules("nisn_siswa", "NISN Siswa", 'required|is_unique[TBL_STUDENT.STD_NISN]');
            $this->form_validation->set_rules("nama_depan", "Nama Depan", 'required');
            $this->form_validation->set_rules("nama_belakang", "Nama Belakang", 'required');
            $this->form_validation->set_rules("tempat_lahir", "Tempat Lahir", 'required');
            $this->form_validation->set_rules("tanggal_lahir", "Nama Belakang", 'required');
            $this->form_validation->set_rules("desa_siswa", "Desa Siswa", 'required');
            $this->form_validation->set_rules("kota_siswa", "Kota Siswa", 'required');
            $this->form_validation->set_rules("provinsi_siswa", "Provinsi Siswa", 'required');
            $this->form_validation->set_rules("telp_siswa", "Telp Siswa", 'required');
            $this->form_validation->set_rules("email_siswa", "Email Siswa", 'required');
            $this->form_validation->set_rules("jenis_kelamin", "Jenis Kelamin", 'required');
            $this->form_validation->set_rules("agama_siswa", "Agama Siswa", 'required');


            if ($this->form_validation->run() != false) {

                $nisn_siswa = $this->input->post('nisn_siswa');
                $nama_depan = $this->input->post('nama_depan');
                $nama_belakang = $this->input->post('nama_belakang');
                $tempat_lahir = $this->input->post('tempat_lahir');
                $tanggal_lahir = $this->input->post('tanggal_lahir');
                $desa_siswa = $this->input->post('desa_siswa');
                $kota_siswa = $this->input->post('kota_siswa');
                $provinsi_siswa = $this->input->post('provinsi_siswa');
                $telp_siswa = $this->input->post('telp_siswa');
                $email_siswa = $this->input->post('email_siswa');
                $alamat_siswa = $this->input->post('alamat_siswa');
                $jenis_kelamin = $this->input->post('jenis_kelamin');
                $agama_siswa = $this->input->post('agama_siswa');

                $data = array(
                    'STD_NISN' => $nisn_siswa,
                    'STD_FIRSTNAME' => $nama_depan,
                    'STD_LASTNAME' => $nama_belakang,
                    'STD_BIRTHPLACE' => $tempat_lahir,
                    'STD_BIRTHDATE' => $tanggal_lahir,
                    'STD_GENDER' => $jenis_kelamin,
                    'REL_ID' => $agama_siswa,
                    'STD_ADDRESS' => $alamat_siswa,
                    'STD_VILLAGE' => $desa_siswa,
                    'STD_DISTRICT' => $kota_siswa,
                    'STD_CITY' => $kota_siswa,
                    'STD_PROVINCE' => $provinsi_siswa,
                    'STD_PHONE' => $telp_siswa,
                    'STD_EMAIL' => $email_siswa
                );
                $siswa->input_siswa_group($data, 'TBL_STUDENT');
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


    public function formEditSiswa()
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
                'sukses' => $this->load->view('page/sekolah/modal/modalEditSiswa', $data, true)
            ];
            echo json_encode($msg);
        }
    }


    public function hapusSiswa_ajax()
    {
        if ($this->input->is_ajax_request() == true) {
            $siswaid = $this->input->post("siswaid");
            $hapus = $this->SiswaModel->hapusSiswa_ajax($siswaid);
            if ($hapus) {
                $msg = ['sukses' => 'Data Siswa Berhasil Terhapus'];
            }
            echo json_encode($msg);
        }
    }


    public function updateSiswa_ajax()
    {
        if ($this->input->is_ajax_request()) {
            $siswa = $this->SiswaModel;
            $this->form_validation->set_rules("siswaname", "Siswaname", 'required|is_unique[TBL_USER.USER_NAME]');
            $this->form_validation->set_rules("password", "Password", 'required|trim|min_length[3]|matches[password2]', [
                'matches' => 'Password dont match !',
                'min_length' => 'Password to short'
            ]);
            $this->form_validation->set_rules("password2", "Password", 'required|trim|min_length[3]|matches[password]');
            if ($this->form_validation->run() != false) {

                $siswaname = htmlspecialchars($this->input->post('siswaname'));
                $siswaGroup = $this->input->post('siswaGroup');
                $password = $this->input->post('password');
                $data = array(
                    'UG_ID' => $siswaGroup,
                    'USER_NAME' => $siswaname,
                    'USER_PASSWORD' => password_hash($password, PASSWORD_DEFAULT)
                );
                $siswa->input_siswa_group($data, 'TBL_USER');
                $queryID = $this->db->query("SELECT *FROM TBL_USER ORDER BY USER_ID DESC LIMIT 1");
                $queryID = $queryID->row();
                $queryID = $queryID->USER_ID;
                $this->db->query("INSERT INTO TBL_PROFILE (USER_ID) VALUES($queryID)");
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

    // Religion
    public function listReligion()
    {
        $data['dataReligion'] = $this->db->query("SELECT *FROM TBL_RELIGION")->result_array();
        $data['head'] = 'include/head';
        $data['header'] = 'include/header';
        $data['menu'] = 'include/menu';
        $data['content'] = 'page/siswa/listReligion';
        $data['footer'] = 'include/footer';
        $data['title'] = 'List Religion';
        $data['main_menu'] = 'siswa';
        $data['sub_menu'] = 'listReligion';
        $this->load->view('index', $data);
    }


    public function simpanReligion_ajax()
    {
        if ($this->input->is_ajax_request()) {
            $siswa = $this->SiswaModel;
            $this->form_validation->set_rules("agama", "Agama", 'required|is_unique[TBL_RELIGION.REL_NAME]');

            if ($this->form_validation->run() != false) {

                $agama = $this->input->post('agama');

                $data = array(
                    'REL_NAME' => $agama,
                );
                $siswa->input_siswa_group($data, 'TBL_RELIGION');
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


    public function formEditReligion()
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
                'sukses' => $this->load->view('page/sekolah/modal/modalEditSiswa', $data, true)
            ];
            echo json_encode($msg);
        }
    }


    public function hapusReligion_ajax()
    {
        if ($this->input->is_ajax_request() == true) {
            $religionID = $this->input->post("religionID");
            $hapus = $this->SiswaModel->hapusReligion_ajax($religionID);
            if ($hapus) {
                $msg = ['sukses' => 'Data Agama Berhasil Terhapus'];
            }
            echo json_encode($msg);
        }
    }


    public function updateReligion_ajax()
    {
        if ($this->input->is_ajax_request()) {
            $siswa = $this->SiswaModel;
            $this->form_validation->set_rules("siswaname", "Siswaname", 'required|is_unique[TBL_USER.USER_NAME]');
            $this->form_validation->set_rules("password", "Password", 'required|trim|min_length[3]|matches[password2]', [
                'matches' => 'Password dont match !',
                'min_length' => 'Password to short'
            ]);
            $this->form_validation->set_rules("password2", "Password", 'required|trim|min_length[3]|matches[password]');
            if ($this->form_validation->run() != false) {

                $siswaname = htmlspecialchars($this->input->post('siswaname'));
                $siswaGroup = $this->input->post('siswaGroup');
                $password = $this->input->post('password');
                $data = array(
                    'UG_ID' => $siswaGroup,
                    'USER_NAME' => $siswaname,
                    'USER_PASSWORD' => password_hash($password, PASSWORD_DEFAULT)
                );
                $siswa->input_siswa_group($data, 'TBL_USER');
                $queryID = $this->db->query("SELECT *FROM TBL_USER ORDER BY USER_ID DESC LIMIT 1");
                $queryID = $queryID->row();
                $queryID = $queryID->USER_ID;
                $this->db->query("INSERT INTO TBL_PROFILE (USER_ID) VALUES($queryID)");
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


    // Kelas SIswa
    function fetchKelasSiswa()
    {
        $output = '';
        $query = '';

        if ($this->input->post('tahun')) {
            $tahun = $this->input->post('tahun');
            $kelas = $this->input->post('kelas');
        }
        $data = $this->db->query("SELECT
        TBL_CLASSSMEMBER.*,TBL_STUDENT.STD_ID as studentID,TBL_STUDENT.STD_FIRSTNAME as firstName,
        TBL_STUDENT.STD_LASTNAME as lastName
        FROM
            TBL_CLASSSMEMBER
            INNER JOIN
            TBL_STUDENT
            ON 
            TBL_STUDENT.STD_ID = TBL_CLASSSMEMBER.STD_ID
            WHERE TBL_CLASSSMEMBER.CLSMEM_STUDYYEAR='$tahun' AND TBL_CLASSSMEMBER.CLASS_ID='$kelas'");

        $output .= '     
        <div class="resultData">        
        <button type="button" class="btn btn-primary mb-3" id="btnTambah" onclick="tambah()">Tambah Data</button>             
            <table class="table table-bordered table-hover datatable-basic table-border" id="example" >
            <tr>            
            <th>No</th>
            <th>Siswa</th>
            <th>Aksi</th>
            </tr>
        ';
        if ($data->num_rows() > 0) {
            $no = 1;
            foreach ($data->result() as $row) {

                $tombolHapus = "<button type=\"button\" class=\"btn btn-outline-danger ml-1\" title=\"Hapus data\" onclick=\"hapus('" . $row->STD_ID . "')\">
                Hapus
            </button>";
                $output .= '
                
                <tr>                                
                
                <td>' . $no++ . '</td>               
                <td>' . $row->firstName . ' ' . $row->lastName . '</td>
                <td>' .  $tombolHapus . '</td>
                </tr>
                ';
            }
        } else {
            $output .= '<tr>
       <td colspan="4">No Data Found</td>
      </tr>';
        }
        $output .= '</table>   
        </div>            
        ';
        echo $output;
    }


    public function simpanKelasSiswa_ajax()
    {
        if ($this->input->is_ajax_request()) {
            $this->form_validation->set_rules("tahunAjaran", "Tahun", 'required', ['required', 'tidak boleh kosong']);
            $this->form_validation->set_rules("tahunAjaran", "Tahun", 'required', ['required', 'tidak boleh kosong']);

            if ($this->form_validation->run() != false) {
                $siswa = count($this->input->post('siswa'));
                $tahunAjaran = $this->input->post('tahunAjaran');
                $kelasID = $this->input->post('kelasID');

                if ($siswa > 0) {
                    for ($i = 0; $i < $siswa; $i++) {
                        if (trim($_POST["siswa"][$i]) != '') {
                            $this->db->query("INSERT INTO TBL_CLASSSMEMBER(CLSMEM_STUDYYEAR,CLASS_ID,STD_ID) VALUES ('$tahunAjaran','$kelasID','" . $_POST['siswa'][$i] . "')");
                        }
                    }
                }

                $msg = ['sukses' => 'Data Siswa Kelas berhasil disimpan'];
            } else {
                $msg = [
                    'error' => '<div class="alert alert-warning mt-1 alert-styled-left alert-dismissible"><button type="button" class="close" data-dismiss="alert"><span>×</span></button><span class="font-weight-semibold">Warning!</span>' . validation_errors() .
                        '.</div>'
                ];
            }
            echo json_encode($msg);
        }
    }


    public function hapusKelasSiswa_ajax()
    {
        if ($this->input->is_ajax_request() == true) {
            $siswaid = $this->input->post("siswaID");
            $hapus = $this->SiswaModel->hapusKelasSiswa_ajax($siswaid);
            if ($hapus) {
                $msg = ['sukses' => 'Data Siswa Berhasil Terhapus'];
            }
            echo json_encode($msg);
        }
    }


    public function listKelasSiswa()
    {

        $data['jumlah'] = $this->db->query("SELECT COUNT(tc.CLASS_ID) as jumlah, ts.CLASS_NAME,ts.CLASS_LEVEL,tc.CLASS_ID FROM tbl_classsmember tc INNER JOIN tbl_schoolclass ts ON ts.CLASS_ID=tc.CLASS_ID
        GROUP BY tc.CLASS_ID")->result_array();

        $data['head'] = 'include/head';
        $data['header'] = 'include/header';
        $data['menu'] = 'include/menu';
        $data['content'] = 'page/siswa/listKelasSiswa';
        $data['footer'] = 'include/footer';
        $data['title'] = 'List KelasSiswa';
        $data['main_menu'] = 'siswa';
        $data['sub_menu'] = 'listKelasSiswa';
        $this->load->view('index', $data);
    }

    public function detailKelasSiswa()
    {
        $kelasID = $this->input->get("kelasID");
        $data['siswaKelas'] = $this->db->query("SELECT tc.*,ts.STD_NISN,ts.STD_FIRSTNAME,ts.STD_LASTNAME,ts.STD_BIRTHPLACE,ts.STD_BIRTHDATE,tr.REL_NAME,ts.STD_PHONE,ts.STD_EMAIL FROM TBL_CLASSSMEMBER tc INNER JOIN TBL_STUDENT ts ON ts.STD_ID=tc.STD_ID INNER JOIN TBL_RELIGION tr ON tr.REL_ID=ts.REL_ID WHERE CLASS_ID='$kelasID'")->result_array();

        $data['kelas'] = $this->db->query("SELECT *FROM TBL_SCHOOLCLASS WHERE CLASS_ID='$kelasID'")->row();

        $data['head'] = 'include/head';
        $data['header'] = 'include/header';
        $data['menu'] = 'include/menu';
        $data['content'] = 'page/siswa/detailKelasSiswa';
        $data['footer'] = 'include/footer';
        $data['title'] = 'Detail Kelas Siswa';
        $data['main_menu'] = 'siswa';
        $data['sub_menu'] = 'detailKelasSiswa';
        $this->load->view('index', $data);
    }
}
