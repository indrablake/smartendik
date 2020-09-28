<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model("UserModel");
        $this->load->library('form_validation');

<<<<<<< HEAD





    // User
    public function listUser()
    {
        $data['dataUser'] = $this->db->query("SELECT df.profile_kd,du.* FROM dat_user du LEFT JOIN dat_profile df ON df.profile_kd=du.profile_kd WHERE du.profile_kd='' ||  profile_status IN (0,1) ORDER BY user_kd DESC")->result_array();
        $data['head'] = 'include/head';
        $data['header'] = 'include/header';
        $data['menu'] = 'include/menu';
        $data['content'] = 'page/user/listUser';
        $data['footer'] = 'include/footer';
        $data['title'] = 'List User';
        $data['main_menu'] = 'master';
        $data['sub_menu'] = 'listUser';
        $this->load->view('index', $data);
    }

    public function simpanUser_ajax()
    {
        if ($this->input->is_ajax_request()) {
            $user = $this->UserModel;
            $this->form_validation->set_rules("username", "Username", 'required|is_unique[dat_user.user_nm]', ['required' => '%s tidak boleh kosong', 'is_unique' => '%s sudah ada']);
            $this->form_validation->set_rules("password", "Password", 'required|trim|min_length[3]|matches[password2]', [
                'matches' => 'Password Tidak Sama !',
                'min_length' => 'Password tidak boleh kurang dari 3 karakter'
            ]);
            $this->form_validation->set_rules("password2", "Password", 'required|trim|min_length[3]|matches[password]', [
                'matches' => 'Password Tidak Sama !'
            ]);

            if ($this->form_validation->run() != false) {
                $username = htmlspecialchars($this->input->post('username'));
                $password = $this->input->post('password');
                $data = array(
                    'user_nm' => $username,
                    'profile_kd' => 0,
                    'user_password' => password_hash($password, PASSWORD_DEFAULT)
                );
                $user->input_data($data, 'dat_user');
                $msg = ['sukses' => 'Data User berhasil disimpan'];
            } else {
                $msg = [
                    'error' => '<div class="alert alert-warning mt-1 alert-styled-left alert-dismissible"><button type="button" class="close" data-dismiss="alert"><span>×</span></button><span class="font-weight-semibold">Warning!</span>' . validation_errors() .
                        '.</div>'
                ];
            }
            echo json_encode($msg);
        }
    }


    public function hapusUser_ajax()
    {
        if ($this->input->is_ajax_request() == true) {
            $userID = $this->input->post("userID");
            $hapus =     $this->db->query("UPDATE dat_profile SET profile_status='2' WHERE profile_kd='$userID' ");
            if ($hapus) {
                $msg = ['sukses' => 'Data User Berhasil Terhapus'];
=======
    }


#SELECT * FROM `dat_user` LEFT JOIN dat_profile on dat_profile.profile_kd = dat_user.profile_kd WHERE dat_user.user_kd = '10'
     public function login()
    {
        if ($this->input->is_ajax_request()) {
            $username       = $this->input->post('id');
            $password       = $this->input->post('password');
            $res=$this->UserModel->get_data(array("dat_user.user_nm"=>$username));
            if (!empty($res)) {
                $cek = $res;
                if (password_verify($password,$cek->user_password)) {
                    # code...
                    // $res=$this->UserModel->get_data(array("dat_user.user_nm"=>$username));
                    $msg['sukses']="Berhasil masuk";
                    $msg['data']=$res;
                    $array = array(
                        'user' => $res
                    );
                    
                    $this->session->set_userdata( $array );
                }else{
                 $msg['error']="Akun tidak ditemukan";   
                }
                
            }else{
                $msg['error']="Akun tidak ditemukan";
                
            }   
            echo json_encode($msg);      
        }else{
            exit("Tidak dapat menampilkan");
        }

    }


    public function dashboard()
    {
        if ($this->session->has_userdata('user')) {
            // var_dump($this->session->userdata('user'));
                    $cnt = array();

                    $sess = $this->session->userdata('user');
                    switch (intval($sess->jns_user_kd)) {
                        case 1: ## guru
                            $query = "select (select count(brt.berita_kd) from dat_berita brt where brt.user_kd = '".$sess->user_kd."' ) as `cnt_berita`, (select count(sk.sekolah_kd) from sekolah_kelas sk left join anggota_kelas on anggota_kelas.kelas_kd = sk.kelas_kd where anggota_kelas.profile_kd = '".$sess->profile_kd."' ) as `cnt_sekolah`, (select count(ak.kelas_kd) from guru_mengajar gm inner join sekolah_kelas sk on gm.kelas_kd = sk.kelas_kd inner join anggota_kelas ak on sk.kelas_kd = ak.kelas_kd where ak.profile_kd = '".$sess->profile_kd."'  ) as `cnt_murid`";
                            $cnt = $this->db->query($query)->row();
                            break;
                        
                        case 7:#siswa
                            $query = "select (select count(brt.berita_kd) from dat_berita brt where brt.user_kd = '".$sess->user_kd."' ) as `cnt_berita` ,  (select count(ak.kelas_kd) from anggota_kelas ak where ak.kelas_kd = '".$sess->kelas_kd."' ) as `cnt_anggota`  ";
                            $cnt = $this->db->query($query)->row();
                            break;
                        
                        default:
                            $query = "select (select count(brt.berita_kd) from dat_berita brt where brt.user_kd = '".$sess->user_kd."' ) as `cnt_berita` ,  (select count(ak.kelas_kd) from anggota_kelas ak where ak.kelas_kd = '".$sess->kelas_kd."' ) as `cnt_anggota`  ";
                            $cnt = $this->db->query($query)->row();
                            break;
                                                    
                    }
                    // var_dump($cnt);
                    $query= "select * from dat_berita where user_kd = '".$sess->user_kd."'";
                    $data['berita']=$this->db->query($query)->row();
                    $query= "select * from dat_iklan";
                    $data['iklan']=$this->db->query($query)->row();
                    $data['user']=$sess;
                    $data['role']=intval($sess->jns_user_kd);
                    $data['count_data']=$cnt;
                    $data['head'] = 'include/head';
                    $data['header'] = 'include/header';
                    $data['menu'] = 'include/menu';
                    $data['content'] = 'page/dashboard';
                    $data['footer'] = 'include/footer';
                    $data['title'] = 'Dashboard';
                    $data['main_menu'] = 'Home';
                    $data['sub_menu'] = 'Dashboard';
                    $this->load->view('index', $data);
        }else{
            $this->session->set_flashdata('message',"Anda harus masuk terlebih dahulu.");
            redirect('/','refresh');
        }
    }

    public function logout()
    {
        if ($this->session->has_userdata('user')) {
            $this->session->unset_userdata('user');
            redirect('/','refresh');
        }else{
            redirect('/','refresh');
        }
    }


    // User
    public function listUser()
    {
        $data['dataUser'] = $this->db->query("SELECT df.profile_kd,du.* FROM dat_user du LEFT JOIN dat_profile df ON df.profile_kd=du.profile_kd WHERE du.profile_kd='' ||  profile_status IN (0,1) ORDER BY user_kd DESC")->result_array();
        $data['head'] = 'include/head';
        $data['header'] = 'include/header';
        $data['menu'] = 'include/menu';
        $data['content'] = 'page/user/listUser';
        $data['footer'] = 'include/footer';
        $data['title'] = 'List User';
        $data['main_menu'] = 'master';
        $data['sub_menu'] = 'listUser';
        $this->load->view('index', $data);
    }

    public function simpanUser_ajax()
    {
        if ($this->input->is_ajax_request()) {
            $user = $this->UserModel;
            $this->form_validation->set_rules("username", "Username", 'required|is_unique[dat_user.user_nm]', ['required' => '%s tidak boleh kosong', 'is_unique' => '%s sudah ada']);
            $this->form_validation->set_rules("password", "Password", 'required|trim|min_length[3]|matches[password2]', [
                'matches' => 'Password Tidak Sama !',
                'min_length' => 'Password tidak boleh kurang dari 3 karakter'
            ]);
            $this->form_validation->set_rules("password2", "Password", 'required|trim|min_length[3]|matches[password]', [
                'matches' => 'Password Tidak Sama !'
            ]);

            if ($this->form_validation->run() != false) {
                $username = htmlspecialchars($this->input->post('username'));
                $password = $this->input->post('password');
                $data = array(
                    'user_nm' => $username,
                    'profile_kd' => 0,
                    'user_password' => password_hash($password, PASSWORD_DEFAULT)
                );
                $user->input_data($data, 'dat_user');
                $msg = ['sukses' => 'Data User berhasil disimpan'];
            } else {
                $msg = [
                    'error' => '<div class="alert alert-warning mt-1 alert-styled-left alert-dismissible"><button type="button" class="close" data-dismiss="alert"><span>×</span></button><span class="font-weight-semibold">Warning!</span>' . validation_errors() .
                        '.</div>'
                ];
>>>>>>> 1425fa7f19ec4b3b216007223877c59eace7f5b7
            }
            echo json_encode($msg);
        }
    }

<<<<<<< HEAD
    public function hapusUserPermanen_ajax()
    {
        if ($this->input->is_ajax_request() == true) {
            $userID = $this->input->post("userID");
            $hapus = $this->UserModel->hapusUserPermanen_ajax($userID);
=======

    public function hapusUser_ajax()
    {
        if ($this->input->is_ajax_request() == true) {
            $userID = $this->input->post("userID");
            $hapus =     $this->db->query("UPDATE dat_profile SET profile_status='2' WHERE profile_kd='$userID' ");
>>>>>>> 1425fa7f19ec4b3b216007223877c59eace7f5b7
            if ($hapus) {
                $msg = ['sukses' => 'Data User Berhasil Terhapus'];
            }
            echo json_encode($msg);
        }
    }

<<<<<<< HEAD
=======
    public function hapusUserPermanen_ajax()
    {
        if ($this->input->is_ajax_request() == true) {
            $userID = $this->input->post("userID");
            $hapus = $this->UserModel->hapusUserPermanen_ajax($userID);
            if ($hapus) {
                $msg = ['sukses' => 'Data User Berhasil Terhapus'];
            }
            echo json_encode($msg);
        }
    }

>>>>>>> 1425fa7f19ec4b3b216007223877c59eace7f5b7

    public function detailProfile()
    {
        $data['head'] = 'include/head';
        $data['header'] = 'include/header';
        $data['menu'] = 'include/menu';
        $data['content'] = 'page/user/form/tambahProfile';
        $data['footer'] = 'include/footer';
        $data['title'] = 'Detail Profile';
        $data['main_menu'] = 'master';
        $data['sub_menu'] = 'listUser';
        $this->load->view('index', $data);
    }
<<<<<<< HEAD


=======


>>>>>>> 1425fa7f19ec4b3b216007223877c59eace7f5b7
    public function detailProfileEdit()
    {
        $profileID = $this->input->get("profileID");
        $data['dataProfileUser'] = $this->db->query("SELECT df.*,ju.jns_user_nm,rp.propinsi_nm,rp.propinsi_kd,ra.agama_nm,rd.dati2_kd,rd.dati2_nm,rk.kecamatan_kd,rk.kecamatan_nm FROM dat_profile df INNER JOIN ref_jenis_user ju ON ju.jns_user_kd = df.jns_user_kd INNER JOIN ref_propinsi rp ON rp.propinsi_kd=df.propinsi_kd INNER JOIN ref_dati2 rd ON rd.dati2_kd=df.dati2_kd
        INNER JOIN ref_kecamatan rk ON rk.kecamatan_kd=df.kecamatan_kd INNER JOIN ref_agama ra ON ra.agama_kd=df.agama_kd WHERE df.profile_kd='$profileID'")->row();
        $data['head'] = 'include/head';
        $data['header'] = 'include/header';
        $data['menu'] = 'include/menu';
        $data['content'] = 'page/user/form/editProfile';
        $data['footer'] = 'include/footer';
        $data['title'] = 'Detail Profile';
        $data['main_menu'] = 'master';
        $data['sub_menu'] = 'listUser';
        $this->load->view('index', $data);
    }


    public function simpanDetailProfile_ajax()
    {
        if ($this->input->is_ajax_request()) {

            $this->form_validation->set_rules("nik", "NIK", 'required', ['required' => '%s tidak boleh kosong']);
            $this->form_validation->set_rules("nama_depan", "Nama Depan", 'required', ['required' => '%s tidak boleh kosong']);
            $this->form_validation->set_rules("nama_tengah", "Nama Tengah", 'required', ['required' => '%s tidak boleh kosong']);
            $this->form_validation->set_rules("nama_belakang", "Nama Belakang", 'required', ['required' => '%s tidak boleh kosong']);
            $this->form_validation->set_rules("tempat_lahir", "Tempat Lahir", 'required', ['required' => '%s tidak boleh kosong']);
            $this->form_validation->set_rules("keterangan_jabatan", "Keterangan Jabatan", 'required', ['required' =>  '%s tidak boleh kosong']);
            $this->form_validation->set_rules("alamat", "Alamat", 'required', ['required' => '%s tidak boleh kosong']);

            if ($this->form_validation->run() != false) {


                $config['upload_path'] = "./uploads/ImageUser   "; //path folder file upload
                $config['allowed_types'] = 'gif|jpg|png|mp4';
                $config['encrypt_name'] = TRUE; //enkripsi file name upload

                $this->load->library('upload', $config); //call library upload 
                if ($this->upload->do_upload("file_fotoUser")) { //upload file
                    $data = array('upload_data' => $this->upload->data()); //ambil file name yang diupload

                    $config['image_library'] = 'gd2';
                    $config['source_image'] = './uploads/imageUser/' . $data['upload_data']['file_name'];
                    // $config['create_thumb'] = TRUE;
                    $config['maintain_ratio'] = FALSE;
                    $config['width'] = '300';
                    $config['height'] = '300';
                    $config['new_image'] = './uploads/imageUser/thumbnail/' . $data['upload_data']['file_name'];
                    $this->load->library('image_lib', $config);
                    $this->image_lib->resize();

                    $jenis = $this->input->post('userGroup');
                    $userGroup = preg_replace("/[^0-9]/", "", $jenis);

                    $nik = $this->input->post('nik');
                    $nama_depan = $this->input->post('nama_depan');
                    $nama_tengah = $this->input->post('nama_tengah');
                    $nama_belakang = $this->input->post('nama_belakang');
                    $agama = $this->input->post('agama');
                    $tempat_lahir = $this->input->post('tempat_lahir');
                    $tanggalLahir = $this->input->post('tanggal_lahir');
                    $jenisKelamin = $this->input->post('jenisKelamin');
                    $provinsi = $this->input->post('provinsi');
                    $kabupaten = $this->input->post('kabupaten');
                    $kecamatan = $this->input->post('kecamatan');
                    $alamat = $this->input->post('alamat');
                    $kelurahan = $this->input->post('kelurahan');
                    $kodePos = $this->input->post('kodePos');
                    $telp = $this->input->post('telp');
                    $email = $this->input->post('email');
                    $idUser = $this->input->post("idProfile");
                    $keterangan_jabatan = $this->input->post('keterangan_jabatan');
                    $image = $data['upload_data']['file_name'];

                    $result = $this->UserModel->simpanProfile($userGroup, $nik, $nama_depan, $nama_tengah, $nama_belakang, $agama, $tempat_lahir, $tanggalLahir, $jenisKelamin, $provinsi, $kabupaten, $kecamatan, $alamat, $kelurahan, $kodePos, $telp, $email, $keterangan_jabatan, $image);
                    // $dataProfile = $this->db->query("SELECT * FROM dat_profile WHERE profile_kd IN (SELECT MAX(profile_kd) FROM dat_profile)");
                    // $dataProfile = $dataProfile->row();
                    // $idProfile = $dataProfile->profile_kd;
                    $idProfile = $this->db->insert_id();
                    $jenisUser = $this->input->post("jenis");
                    // Pengawas
                    $sekolahID = $this->input->post("sekolahID");
                    $pengawasMulai = $this->input->post("tanggalPengawasMulai");
                    $pengawasAkhir = $this->input->post("tanggalPengawasAkhir");
                    // End Pengawas
                    // Admin
                    $adminMulai = $this->input->post("tanggalAdminMulai");
                    $adminAkhir = $this->input->post("tanggalAdminAkhir");
                    // End Admin
                    // Pegawai  
                    $sekolahID = $this->input->post("sekolahID");
                    $kelasID = $this->input->post("kelasID");
                    $pegawai = $this->input->post('jenisPegawai');
                    $jenisPegawai = preg_replace("/[^0-9]/", "", $pegawai);
                    $jenisPegawaiGuru = $this->input->post("jenisPegawaiGuru");
                    $pegawaiMulai = $this->input->post("tanggalPegawaiMulai");
                    $pegawaiAkhir = $this->input->post("tanggalPegawaiAkhir");
                    $pegawai = strtolower($jenisPegawai);
                    // End Pegawai

                    if ($jenisUser == 'admin') {

                        $this->db->query("INSERT INTO admin_regional (profile_kd,propinsi_kd,dati2_kd,adm_tgl_mulai,adm_tgl_akhir) VALUES ('$idProfile','$provinsi','$kabupaten','$adminMulai','$adminAkhir')");
                    } else if ($jenisUser == 'pengawas') {

                        $this->db->query("INSERT INTO pengawas_sekolah (profile_kd,sekolah_kd,pws_skl_tgl_mulai,pws_skl_tgl_akhir) VALUES ('$idProfile','$sekolahID','$pengawasMulai','$pengawasAkhir')");
                    } else if ($jenisUser == 'pegawai') {

                        $this->db->query("INSERT INTO sekolah_pegawai (sekolah_kd,profile_kd,jns_pegawai_kd,pegawai_tgl_mulai,pegawai_tgl_berakhir) VALUES ('$idProfile','$sekolahID','$jenisPegawai','$pegawaiMulai','$pegawaiAkhir')");
                        $idPegawai = $this->db->insert_id();
                        if ($jenisPegawaiGuru == 'guru') {
                            $this->db->query("INSERT INTO guru_mengajar(pegawai_kd,kelas_kd) VALUES('$idPegawai','$kelasID')");
                        }
                    }

                    $this->db->query("UPDATE dat_user SET profile_kd='$idProfile' WHERE user_kd='$idUser'");
                }
                $result = [
                    'sukses' => 'Berhasil Ditambahkan'
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

    public function updateDetailProfile_ajax()
    {
        $config['upload_path'] = "./uploads/ImageUser   "; //path folder file upload
        $config['allowed_types'] = 'gif|jpg|png|mp4';
        $config['encrypt_name'] = TRUE; //enkripsi file name upload

        $this->load->library('upload', $config); //call library upload 

        if (!$this->upload->do_upload('file_fotoUser')) {
            $image = $this->input->post("file_fotoUserOld");
        } else {
            $data = array('upload_data' => $this->upload->data());
            $image = $data['upload_data']['file_name'];
            $config['image_library'] = 'gd2';
            $config['source_image'] = './uploads/imageUser/' . $data['upload_data']['file_name'];
            // $config['create_thumb'] = TRUE;
            $config['maintain_ratio'] = FALSE;
            $config['width'] = '300';
            $config['height'] = '300';
            $config['new_image'] = './uploads/imageUser/thumbnail/' . $data['upload_data']['file_name'];
            $this->load->library('image_lib', $config);
            $this->image_lib->resize();
        }

        //ambil file name yang diupload
        $profileID = $this->input->post('profileID');
        $userGroup = $this->input->post('userGroup');
        $nik = $this->input->post('nik');
        $nama_depan = $this->input->post('nama_depan');
        $nama_tengah = $this->input->post('nama_tengah');
        $nama_belakang = $this->input->post('nama_belakang');
        $agama = $this->input->post('agama');
        $tempat_lahir = $this->input->post('tempat_lahir');
        $tanggalLahir = $this->input->post('tanggal_lahir');
        $jenisKelamin = $this->input->post('jenisKelamin');
        $provinsi = $this->input->post('provinsi');
        $kabupaten = $this->input->post('kabupaten');
        $kecamatan = $this->input->post('kecamatan');
        $alamat = $this->input->post('alamat');
        $kelurahan = $this->input->post('kelurahan');
        $kodePos = $this->input->post('kodePos');
        $telp = $this->input->post('telp');
        $email = $this->input->post('email');
        $keterangan_jabatan = $this->input->post('keterangan_jabatan');

        $result = $this->db->query("UPDATE dat_profile SET jns_user_kd='$userGroup',profile_nomor_id='$nik',profile_nm_1='$nama_depan',profile_nm_2='$nama_tengah',profile_nm_3='$nama_belakang',agama_kd='$agama',profile_tempat_lahir='$tempat_lahir',profile_tgl_lahir='$tanggalLahir',profile_jns_kelamin='$jenisKelamin',propinsi_kd='$provinsi',dati2_kd='$kabupaten',kecamatan_kd='$kecamatan',profile_alamat='$alamat',profile_kelurahan='$kelurahan',profile_kd_pos='$kodePos',profile_telp='$telp',profile_email='$email',profile_foto='$image',profile_ket_jabatan='$keterangan_jabatan' WHERE profile_kd='$profileID'");

        echo json_encode($result);
    }
    // End User

}
