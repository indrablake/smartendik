<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
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
     * @see https://codeigniter.com/user_guide/general/urls.html
     */


    public function __construct()
    {
        parent::__construct();
        $this->load->model("UserModel");
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
        $data['main_menu'] = 'user';
        $data['sub_menu'] = 'home';
        $this->load->view('index', $data);
    }
    public function listUser()
    {
        $data['head'] = 'include/head';
        $data['header'] = 'include/header';
        $data['menu'] = 'include/menu';
        $data['content'] = 'page/user/listUser';
        $data['footer'] = 'include/footer';
        $data['title'] = 'List User';
        $data['main_menu'] = 'user';
        $data['sub_menu'] = 'listUser';
        $this->load->view('index', $data);
    }
    public function tambahProfile()
    {
        $data['head'] = 'include/head';
        $data['header'] = 'include/header';
        $data['menu'] = 'include/menu';
        $data['content'] = 'page/user/tambahProfile';
        $data['footer'] = 'include/footer';
        $data['title'] = 'Tambah Profile';
        $data['main_menu'] = 'user';
        $data['sub_menu'] = 'tambahProfile';
        $this->load->view('index', $data);
    }

    public function simpanUser()
    {

        $user = $this->UserModel;
        $this->form_validation->set_rules("username", "Username", 'required|is_unique[TBL_USER.USER_NAME]');
        $this->form_validation->set_rules("password", "Password", 'required|trim|min_length[3]|matches[password2]', [
            'matches' => 'Password dont match !',
            'min_length' => 'Password to short'
        ]);
        $this->form_validation->set_rules("password2", "Password", 'required|trim|min_length[3]|matches[password]');
        if ($this->form_validation->run() != false) {

            $username = htmlspecialchars($this->input->post('username'));
            $userGroup = $this->input->post('userGroup');
            $password = $this->input->post('password');
            $data = array(
                'UG_ID' => $userGroup,
                'USER_NAME' => $username,
                'USER_PASSWORD' => password_hash($password, PASSWORD_DEFAULT)
            );
            $user->input_user_group($data, 'TBL_USER');
            $queryID = $this->db->query("SELECT *FROM TBL_USER ORDER BY USER_ID DESC LIMIT 1");
            $queryID = $queryID->row();
            $queryID = $queryID->USER_ID;

            $config['upload_path']          = './uploads/imageUser/';
            $config['allowed_types']        = 'gif|jpg|png';
            $config['max_size']             = 0;

            // $config['max_width']            = 1024;
            // $config['max_height']           = 768;

            $this->load->library('upload', $config);


            if (!$this->upload->do_upload('file_profile')) {
                $fileUpload = $this->input->post("file_old");
            } else {
                $upload_data = $this->upload->data();
                $fileUpload = $upload_data['file_name'];
            }


            $schid = $this->input->post('sekolahID');
            $user_id = $this->input->post($user_id);
            $nik = $this->input->post('nik');
            $nama_lengkap = $this->input->post('nama_lengkap');
            $tempat_lahir = $this->input->post('tempat_lahir');
            $bulan = $this->input->post('bulan');
            $tanggal = $this->input->post('tanggal');
            $tahun = $this->input->post('tahun');
            $nama_lengkap = $this->input->post('nama_lengkap');
            $alamat = $this->input->post('alamat');
            $phone = $this->input->post('phone');
            $provinsi = $this->input->post('provinsi');
            $city = $this->input->post('city');
            $agama = $this->input->post('agama');
            $jenis_kelamin = $this->input->post('jenis_kelamin');
            $email = $this->input->post('email');
            $sekolahID = $this->input->post('sekolahID');


            $tanggalLahir = "$tahun" . '-' . "$bulan" . '-' . "$tanggal";

            $data2 = array(
                'USER_ID' => $queryID,
                'SCH_ID' => $schid,
                'PROFILE_NIK' => $nik,
                'PROFILE_NAME' => $nama_lengkap,
                'PROFILE_BIRTHPLACE' => $tempat_lahir,
                'PROFILE_BIRTHDATE' => $tanggalLahir,
                'PROFILE_GENDER' => $jenis_kelamin,
                'PROFILE_RELIGION' => $agama,
                'PROFILE_ADDRESS' => $alamat,
                'PROFILE_CITY' => $city,
                'SCH_ID' => $sekolahID,
                'PROFILE_PROVINCE' => $provinsi,
                'PROFILE_phone' => $phone,
                'PROFILE_EMAIL' => $email,
                'PROFILE_PHOTO' => $fileUpload
            );

            $user->input_user_group($data2, 'TBL_PROFILE');


            $this->session->set_flashdata('success', 'Berhasil disimpan');

            redirect("listUser");
        } else {
            $this->session->set_flashdata('success', 'Gagal disimpan');
            $data['head'] = 'include/head';
            $data['header'] = 'include/header';
            $data['menu'] = 'include/menu';
            $data['content'] = 'page/user/tambahUser';
            $data['footer'] = 'include/footer';
            $data['title'] = 'Tambah User ';
            $data['main_menu'] = 'user';
            $data['sub_menu'] = 'home';
            $this->load->view('index', $data);
        }
    }

    public function tambahUser()
    {
        $data['head'] = 'include/head';
        $data['header'] = 'include/header';
        $data['menu'] = 'include/menu';
        $data['content'] = 'page/user/tambahUser';
        $data['footer'] = 'include/footer';
        $data['title'] = 'Tambah User ';
        $data['main_menu'] = 'user';
        $data['sub_menu'] = 'tambahUser';
        $this->load->view('index', $data);
    }

    public function simpanProfile()
    {

        $user = $this->UserModel;
        $validation = $this->form_validation;
        $validation->set_rules($user->rulesUser());
        if ($validation->run()) {

            $config['upload_path']          = './uploads/imageUser/';
            $config['allowed_types']        = 'gif|jpg|png';
            $config['max_size']             = 0;

            // $config['max_width']            = 1024;
            // $config['max_height']           = 768;

            $this->load->library('upload', $config);


            if (!$this->upload->do_upload('logo_sekolah')) {
                $data['error'] = $this->upload->display_errors();
                $data['head'] = 'include/head';
                $data['header'] = 'include/header';
                $data['menu'] = 'include/menu';
                $data['content'] = 'page/user/listUser';
                $data['footer'] = 'include/footer';
                $data['title'] = 'Tambah Profile ';
                $data['main_menu'] = 'user';
                $data['sub_menu'] = 'home';
                $this->load->view('index', $data);
            } else {
                $upload_data = $this->upload->data();
                $fileUpload = $upload_data['file_name'];
            }



            $userGroup = $this->input->post('userGroup');
            $nik = $this->input->post('nik');
            $nama_lengkap = $this->input->post('nama_lengkap');
            $tempat_lahir = $this->input->post('tempat_lahir');
            $bulan = $this->input->post('bulan');
            $tanggal = $this->input->post('tanggal');
            $tahun = $this->input->post('tahun');
            $nama_lengkap = $this->input->post('nama_lengkap');
            $alamat = $this->input->post('alamat');
            $phone = $this->input->post('phone');
            $provinsi = $this->input->post('provinsi');
            $city = $this->input->post('city');
            $agama = $this->input->post('agama');
            $jenis_kelamin = $this->input->post('jenis_kelamin');
            $email = $this->input->post('email');
            $sekolahID = $this->input->post("sekolahID");


            $tanggalLahir = "$tahun" . '-' . "$bulan" . '-' . "$tanggal";

            $data = array(
                'USER_ID' => $userGroup,
                'PROFILE_NIK' => $nik,
                'PROFILE_NAME' => $nama_lengkap,
                'SCH_ID' => $sekolahID,
                'PROFILE_BIRTHPLACE' => $tempat_lahir,
                'PROFILE_BIRTHDATE' => $tanggalLahir,
                'PROFILE_GENDER' => $jenis_kelamin,
                'PROFILE_RELIGION' => $agama,
                'PROFILE_ADDRESS' => $alamat,
                'PROFILE_CITY' => $city,
                'PROFILE_PROVINCE' => $provinsi,
                'PROFILE_phone' => $phone,
                'PROFILE_EMAIL' => $email,
                'PROFILE_PHOTO' => $fileUpload
            );


            $user->input_user_group($data, 'TBL_PROFILE');
            $this->session->set_flashdata('success', 'Berhasil disimpan');
            $data['head'] = 'include/head';
            $data['header'] = 'include/header';
            $data['menu'] = 'include/menu';
            $data['content'] = 'page/user/listUser';
            $data['footer'] = 'include/footer';
            $data['title'] = 'Tambah User Group';
            $data['main_menu'] = 'user';
            $data['sub_menu'] = 'home';
            $this->load->view('index', $data);
        } else {
            $this->session->set_flashdata('failed', 'Gagal disimpan');
            $data['head'] = 'include/head';
            $data['header'] = 'include/header';
            $data['menu'] = 'include/menu';
            $data['content'] = 'page/user/tambahProfile';
            $data['footer'] = 'include/footer';
            $data['title'] = 'Tambah Profile ';
            $data['main_menu'] = 'user';
            $data['sub_menu'] = 'home';
            $this->load->view('index', $data);
        }
    }


    public function updateProfile()
    {

        $user = $this->UserModel;
        $validation = $this->form_validation;
        $validation->set_rules($user->rulesUser());
        if ($validation->run()) {

            $config['upload_path']          = './uploads/imageUser/';
            $config['allowed_types']        = 'gif|jpg|png';
            $config['max_size']             = 0;

            // $config['max_width']            = 1024;
            // $config['max_height']           = 768;

            $this->load->library('upload', $config);


            if (!$this->upload->do_upload('file_profile')) {
                $fileUpload = $this->input->post("file_old");
            } else {
                $upload_data = $this->upload->data();
                $fileUpload = $upload_data['file_name'];
            }



            $user_id = $this->input->post('user_id');
            $nik = $this->input->post('nik');
            $nama_lengkap = $this->input->post('nama_lengkap');
            $tempat_lahir = $this->input->post('tempat_lahir');
            $bulan = $this->input->post('bulan');
            $tanggal = $this->input->post('tanggal');
            $tahun = $this->input->post('tahun');
            $nama_lengkap = $this->input->post('nama_lengkap');
            $alamat = $this->input->post('alamat');
            $phone = $this->input->post('phone');
            $provinsi = $this->input->post('provinsi');
            $city = $this->input->post('city');
            $agama = $this->input->post('agama');
            $jenis_kelamin = $this->input->post('jenis_kelamin');
            $email = $this->input->post('email');
            $sekolahID = $this->input->post('sekolahID');


            $tanggalLahir = "$tahun" . '-' . "$bulan" . '-' . "$tanggal";

            $data = array(
                'PROFILE_NIK' => $nik,
                'PROFILE_NAME' => $nama_lengkap,
                'PROFILE_BIRTHPLACE' => $tempat_lahir,
                'PROFILE_BIRTHDATE' => $tanggalLahir,
                'PROFILE_GENDER' => $jenis_kelamin,
                'PROFILE_RELIGION' => $agama,
                'PROFILE_ADDRESS' => $alamat,
                'PROFILE_CITY' => $city,
                'SCH_ID' => $sekolahID,
                'PROFILE_PROVINCE' => $provinsi,
                'PROFILE_phone' => $phone,
                'PROFILE_EMAIL' => $email,
                'PROFILE_PHOTO' => $fileUpload
            );

            $where = array(
                'USER_ID' => $user_id
            );

            $user->update_data($where, $data, 'TBL_PROFILE');
            $this->session->set_flashdata('success', 'Berhasil disimpan');
            redirect('listUser');
        } else {
            $this->session->set_flashdata('failed', 'Gagal disimpan');
            $data['head'] = 'include/head';
            $data['header'] = 'include/header';
            $data['menu'] = 'include/menu';
            $data['content'] = 'page/user/detailProfile';
            $data['footer'] = 'include/footer';
            $data['title'] = 'Tambah Profile ';
            $data['main_menu'] = 'user';
            $data['sub_menu'] = 'home';
            $this->load->view('index', $data);
        }
    }



    public function listUserGroup()
    {
        $data['head'] = 'include/head';
        $data['header'] = 'include/header';
        $data['menu'] = 'include/menu';
        $data['content'] = 'page/user/listUserGroup';
        $data['footer'] = 'include/footer';
        $data['title'] = 'List User Group';
        $data['main_menu'] = 'user';
        $data['sub_menu'] = 'listUserGroup';
        $this->load->view('index', $data);
    }
    public function tambahProfileGroup()
    {
        $data['head'] = 'include/head';
        $data['header'] = 'include/header';
        $data['menu'] = 'include/menu';
        $data['content'] = 'page/user/tambahProfileGroup';
        $data['footer'] = 'include/footer';
        $data['title'] = 'Tambah User Group';
        $data['main_menu'] = 'user';
        $data['sub_menu'] = 'tambahProfilegroup';
        $this->load->view('index', $data);
    }

    public function simpanUserGroup()
    {

        $user = $this->UserModel;
        $validation = $this->form_validation;
        $validation->set_rules($user->rulesUserGroup());
        if ($validation->run()) {

            $groupUser = $this->input->post('groupUser');
            $data = array(
                'UG_NAME' => $groupUser
            );
            $user->input_user_group($data, 'TBL_USERGROUP');
            $this->session->set_flashdata('success', 'Berhasil disimpan');
            $data['head'] = 'include/head';
            $data['header'] = 'include/header';
            $data['menu'] = 'include/menu';
            $data['content'] = 'page/user/listUserGroup';
            $data['footer'] = 'include/footer';
            $data['title'] = 'Tambah User Group';
            $data['main_menu'] = 'user';
            $data['sub_menu'] = 'home';
            $this->load->view('index', $data);
        } else {
            $this->session->set_flashdata('success', 'Gagal disimpan');
            $data['head'] = 'include/head';
            $data['header'] = 'include/header';
            $data['menu'] = 'include/menu';
            $data['content'] = 'page/user/tambahProfileGroup';
            $data['footer'] = 'include/footer';
            $data['title'] = 'Tambah User Group';
            $data['main_menu'] = 'user';
            $data['sub_menu'] = 'home';
            $this->load->view('index', $data);
        }
    }

    public function editUserGroup()
    {

        $groupUser = $this->input->post('groupUser');
        $idUG = $this->input->post('idUG');

        $this->db->query("UPDATE TBL_USERGROUP SET UG_NAME='$groupUser' WHERE UG_ID='$idUG'");

        $this->session->set_flashdata('success', 'Berhasil Diedit');
        $data['head'] = 'include/head';
        $data['header'] = 'include/header';
        $data['menu'] = 'include/menu';
        $data['content'] = 'page/user/listUserGroup';
        $data['footer'] = 'include/footer';
        $data['title'] = 'List User Group';
        $data['main_menu'] = 'user';
        $data['sub_menu'] = 'home';
        $this->load->view('index', $data);
    }

    public function detailProfile()
    {
        $id = $this->input->get("id");
        $data['queryResult'] = $this->db->query("SELECT u.USER_NAME , p.*,s.SCH_NAME FROM TBL_PROFILE p LEFT JOIN TBL_USER u ON u.USER_ID = p.USER_ID LEFT JOIN TBL_SCHOOL s ON s.SCH_ID=p.SCH_ID WHERE p.USER_ID='$id'")->row();
        $data['head'] = 'include/head';
        $data['header'] = 'include/header';
        $data['menu'] = 'include/menu';
        $data['content'] = 'page/user/detailProfile';
        $data['footer'] = 'include/footer';
        $data['title'] = 'Detail Profile';
        $data['main_menu'] = 'user';
        $data['sub_menu'] = 'home';
        $this->load->view('index', $data);
    }

    public function deleteUser()
    {
        $id = $this->input->get("id");
        $query = $this->db->delete('TBL_USER', ['USER_ID' => $id]);
        $this->session->set_flashdata('success', 'Berhasil Dihapus');
        redirect('listUser');
    }

    public function login()
    {
        $this->form_validation->set_rules('username', 'Username', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');

        if ($this->form_validation->run() != false) {
            $username = $this->input->post("username");
            $password = $this->input->post("password");
            $user = $this->db->get_where('TBL_USER', ['USER_NAME' => $username])->row_array();
            $ug = $user['UG_ID'];
            $userID = $user['USER_ID'];
            if ($user) {
                $group = $this->db->query("SELECT *FROM TBL_USER INNER JOIN TBL_USERGROUP ON TBL_USERGROUP.UG_ID=TBL_USER.UG_ID
                INNER JOIN TBL_PROFILE ON TBL_PROFILE.USER_ID = TBL_USER.USER_ID WHERE TBL_USER.USER_ID=$userID")->row_array();
                if (password_verify($password, $user['USER_PASSWORD'])) {
                    $data = [
                        'username' => $group['USER_NAME'],
                        'profile_name' => $group['PROFILE_NAME'],
                        'ug_name' => $group['UG_NAME'],
                        'ug_id' => $group['UG_ID'],
                        'profile_nik' => $group['PROFILE_NIK'],
                        'schid' => $group['SCH_ID'],
                    ];
                    $this->session->set_userdata($data);
                    redirect("Home");
                } else {
                    $this->session->set_flashdata("message", "<div class='alert alert-danger' role='alert'>Username/Password anda salah</div>");
                    redirect("Welcome");
                }
            } else {
                $this->session->set_flashdata("message", "<div class='alert alert-danger' role='alert'>Username/Password anda salah</div>");
                redirect("Welcome");
            }
        }
    }


    public function logout()
    {
        $this->session->unset_userdata('username');
        $this->session->unset_userdata('ug_id');
        $this->session->set_flashdata('message', '<div class="alert alert-success">Anda Sudah Logout </div>');
        redirect("login");
    }
}
