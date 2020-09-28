<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Siswa extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model("SiswaModel");
        $this->load->library('form_validation');
    }


    // SIswa

    public function listSiswa()
    {
        $data['dataSiswa'] = $this->db->query("SELECT * from dat_profile inner join ref_jenis_user on ref_jenis_user.jns_user_kd=dat_profile.jns_user_kd
        where dat_profile.profile_status='1' AND  ref_jenis_user.jns_user_nm LIKE '%Siswa%' ")->result_array();
        $data['head'] = 'include/head';
        $data['header'] = 'include/header';
        $data['menu'] = 'include/menu';
        $data['content'] = 'page/siswa/listSiswa';
        $data['footer'] = 'include/footer';
        $data['title'] = 'List Siswa';
        $data['main_menu'] = 'master';
        $data['sub_menu'] = 'listSiswa';
        $this->load->view('index', $data);
    }


    public function tambahSiswa()
    {
        $data['head'] = 'include/head';
        $data['header'] = 'include/header';
        $data['menu'] = 'include/menu';
        $data['content'] = 'page/siswa/form/tambahSiswa';
        $data['footer'] = 'include/footer';
        $data['title'] = 'Tambah Siswa';
        $data['main_menu'] = 'master';
        $data['sub_menu'] = 'listUser';
        $this->load->view('index', $data);
    }


    public function siswaProfileEdit()
    {
        $profileID = $this->input->get("profileID");
        $data['dataProfileUser'] = $this->db->query("SELECT df.*,ju.jns_user_nm,rp.propinsi_nm,rp.propinsi_kd,ra.agama_nm,rd.dati2_kd,rd.dati2_nm,rk.kecamatan_kd,rk.kecamatan_nm FROM dat_profile df INNER JOIN ref_jenis_user ju ON ju.jns_user_kd = df.jns_user_kd INNER JOIN ref_propinsi rp ON rp.propinsi_kd=df.propinsi_kd INNER JOIN ref_dati2 rd ON rd.dati2_kd=df.dati2_kd
        INNER JOIN ref_kecamatan rk ON rk.kecamatan_kd=df.kecamatan_kd INNER JOIN ref_agama ra ON ra.agama_kd=df.agama_kd WHERE df.profile_kd='$profileID'")->row();
        $data['head'] = 'include/head';
        $data['header'] = 'include/header';
        $data['menu'] = 'include/menu';
        $data['content'] = 'page/siswa/form/editSiswaProfile';
        $data['footer'] = 'include/footer';
        $data['title'] = 'Edit Siswa Profile';
        $data['main_menu'] = 'master';
        $data['sub_menu'] = 'listSiswa';
        $this->load->view('index', $data);
    }


    public function simpanSiswaProfile_ajax()
    {
        if ($this->input->is_ajax_request()) {

            $this->form_validation->set_rules("nik", "NIS", 'required', ['required' => '%s tidak boleh kosong']);
            $this->form_validation->set_rules("nama_depan", "Nama Depan", 'required', ['required' => '%s tidak boleh kosong']);
            $this->form_validation->set_rules("nama_tengah", "Nama Tengah", 'required', ['required' => '%s tidak boleh kosong']);
            $this->form_validation->set_rules("nama_belakang", "Nama Belakang", 'required', ['required' => '%s tidak boleh kosong']);
            $this->form_validation->set_rules("tempat_lahir", "Tempat Lahir", 'required', ['required' => '%s tidak boleh kosong']);
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

                    $userSiswa = $this->db->query("SELECT jns_user_nm,jns_user_kd FROM ref_jenis_user where jns_user_nm like '%Siswa%'")->row();
                    $userSiswa = $userSiswa->jns_user_kd;
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
                    $keterangan_jabatan = '';
                    $image = $data['upload_data']['file_name'];

                    $result = $this->SiswaModel->simpanProfile($userSiswa, $nik, $nama_depan, $nama_tengah, $nama_belakang, $agama, $tempat_lahir, $tanggalLahir, $jenisKelamin, $provinsi, $kabupaten, $kecamatan, $alamat, $kelurahan, $kodePos, $telp, $email, $keterangan_jabatan, $image);
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

    public function updateSiswaProfile_ajax()
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
        $keterangan_jabatan = '';
        $profileID = $this->input->post("profileID");

        $result = $this->db->query("UPDATE dat_profile SET profile_nomor_id='$nik',profile_nm_1='$nama_depan',profile_nm_2='$nama_tengah',profile_nm_3='$nama_belakang',agama_kd='$agama',profile_tempat_lahir='$tempat_lahir',profile_tgl_lahir='$tanggalLahir',profile_jns_kelamin='$jenisKelamin',propinsi_kd='$provinsi',dati2_kd='$kabupaten',kecamatan_kd='$kecamatan',profile_alamat='$alamat',profile_kelurahan='$kelurahan',profile_kd_pos='$kodePos',profile_telp='$telp',profile_email='$email',profile_foto='$image',profile_ket_jabatan='$keterangan_jabatan' WHERE profile_kd='$profileID'");

        echo json_encode($result);
    }
    // End Siswa


}
