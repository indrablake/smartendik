<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pegawai extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model("PegawaiModel");
        $this->load->library('form_validation');
    }



    // Pegawaoi
    public function listPegawai()
    {
        $data['dataPegawai'] = $this->db->query("SELECT df.profile_kd, sekolah_pegawai.*,dat_sekolah.sekolah_nm,dat_sekolah.sekolah_npsn,ref_jenis_pegawai.jns_pegawai_nm FROM sekolah_pegawai INNER JOIN dat_sekolah ON dat_sekolah.sekolah_kd=sekolah_pegawai.sekolah_kd LEFT JOIN dat_profile df ON df.profile_kd=sekolah_pegawai.profile_kd  INNER JOIN ref_jenis_pegawai ON ref_jenis_pegawai.jns_pegawai_kd=sekolah_pegawai.jns_pegawai_kd")->result_array();
        $data['head'] = 'include/head';
        $data['header'] = 'include/header';
        $data['menu'] = 'include/menu';
        $data['content'] = 'page/pegawai/listPegawai';
        $data['footer'] = 'include/footer';
        $data['title'] = 'List Pegawai';
        $data['main_menu'] = 'master';
        $data['sub_menu'] = 'listPegawai';
        $this->load->view('index', $data);
    }


    public function simpanPegawai_ajax()
    {
        if ($this->input->is_ajax_request()) {

            $this->form_validation->set_rules("jenisPegawai[]", "Jenis Pegawai", 'required', ['required' => '%s tidak boleh kosong']);
            $this->form_validation->set_rules("tanggalMulai[]", "Tanggal Mulai", 'required', ['required' => '%s tidak boleh kosong']);
            $this->form_validation->set_rules("tanggalBerakhir[]", "Tanggal Akhir", 'required', ['required' => '%s tidak boleh kosong']);

            if ($this->form_validation->run() != false) {

                $countPegawai = count($this->input->post("jenisPegawai"));
                $jenisPegawai = $this->input->post('jenisPegawai');
                $sekolahKD = $this->input->post('sekolahKD');
                if ($countPegawai > 0) {
                    for ($i = 0; $i < $countPegawai; $i++) {
                        if (trim($_POST["jenisPegawai"][$i]) != '') {
                            $this->db->query("INSERT INTO sekolah_pegawai(sekolah_kd,profile_kd,jns_pegawai_kd,pegawai_tgl_mulai,pegawai_tgl_berakhir) VALUES ('$sekolahKD',0,'" . $_POST['jenisPegawai'][$i] . "','" . $_POST['tanggalMulai'][$i] . "','" . $_POST['tanggalBerakhir'][$i] . "')");
                        }
                    }
                }
                $msg = ['sukses' => 'Data Pegawai berhasil disimpan'];
            } else {
                $msg = [
                    'error' => '<div class="alert alert-warning mt-1 alert-styled-left alert-dismissible"><button type="button" class="close" data-dismiss="alert"><span>×</span></button><span class="font-weight-semibold">Warning!</span>' . validation_errors() .
                        '.</div>'
                ];
            }
            echo json_encode($msg);
        }
    }


    public function hapusPegawai_ajax()
    {
        if ($this->input->is_ajax_request() == true) {
            $jenisPegawai = $this->input->post("jenisPegawai");
            $hapus = $this->PegawaiModel->hapusPegawai_ajax($jenisPegawai);
            if ($hapus) {
                $msg = ['sukses' => 'Data Pegawai Berhasil Terhapus'];
            }
            echo json_encode($msg);
        }
    }

    public function formEditPegawai()
    {
        if ($this->input->is_ajax_request() == true) {
            $jenisPegawai = $this->input->post('jenisPegawai');
            $result =  $this->db->query("SELECT sekolah_pegawai.*,dat_sekolah.sekolah_nm,dat_sekolah.sekolah_npsn,ref_jenis_pegawai.jns_pegawai_kd,ref_jenis_pegawai.jns_pegawai_nm FROM sekolah_pegawai INNER JOIN dat_sekolah ON dat_sekolah.sekolah_kd=sekolah_pegawai.sekolah_kd INNER JOIN ref_jenis_pegawai ON ref_jenis_pegawai.jns_pegawai_kd=sekolah_pegawai.jns_pegawai_kd WHERE sekolah_pegawai.pegawai_kd='$jenisPegawai'");

            if ($result->num_rows() > 0) {
                $row = $result->row_array();
                $data = [
                    'pegawaiKD' => $row['pegawai_kd'],
                    'jenisPegawai' => $row['jns_pegawai_kd'],
                    'jenisNama' => $row['jns_pegawai_nm'],
                    'tanggalMulai' => $row['pegawai_tgl_mulai'],
                    'tanggalBerakhir' => $row['pegawai_tgl_berakhir']
                ];
            }
            $msg = [
                'sukses' => $this->load->view('page/pegawai/modal/modalEditPegawai', $data, true)
            ];
            echo json_encode($msg);
        }
    }


    public function updatePegawai_ajax()
    {
        if ($this->input->is_ajax_request()) {
            $pegawai = $this->PegawaiModel;

            $this->form_validation->set_rules("jenisPegawai", "Nama Pegawai", 'required', ['required' => '%s tidak boleh kosong']);

            if ($this->form_validation->run() != false) {
                $pegawaiKD = $this->input->post('pegawaiKD');
                $jenisPegawai = $this->input->post('jenisPegawai');
                $sekolahKD = $this->input->post('sekolahKD');
                $tanggalMulai = $this->input->post('tanggalMulai');
                $tanggalBerakhir = $this->input->post('tanggalBerakhir');

                $data = array(
                    'sekolah_kd' => $sekolahKD,
                    'jns_pegawai_kd' => $jenisPegawai,
                    'pegawai_tgl_mulai' => $tanggalMulai,
                    'pegawai_tgl_berakhir' => $tanggalBerakhir
                );
                $where = array(
                    'pegawai_kd' => $pegawaiKD
                );
                $this->PegawaiModel->update_data($where, $data, 'sekolah_pegawai');
                $msg = ['sukses' => 'Data Pegawai berhasil diupdate'];
            } else {
                $msg = [
                    'error' => '<div class="alert alert-warning mt-1 alert-styled-left alert-dismissible"><button type="button" class="close" data-dismiss="alert"><span>×</span></button><span class="font-weight-semibold">Warning!</span>' . validation_errors() .
                        '.</div>'
                ];
            }

            echo json_encode($msg);
        }
    }


    public function detailPegawaiProfile()
    {
        $data['head'] = 'include/head';
        $data['header'] = 'include/header';
        $data['menu'] = 'include/menu';
        $data['content'] = 'page/pegawai/form/tambahProfilePegawai';
        $data['footer'] = 'include/footer';
        $data['title'] = 'Detail Profile';
        $data['main_menu'] = 'master';
        $data['sub_menu'] = 'listPegawai';
        $this->load->view('index', $data);
    }


    public function detailPegawaiProfileEdit()
    {
        $profileID = $this->input->get("profileID");
        $data['dataProfileUser'] = $this->db->query("SELECT df.*,ju.jns_user_nm,rp.propinsi_nm,rp.propinsi_kd,ra.agama_nm,rd.dati2_kd,rd.dati2_nm,rk.kecamatan_kd,rk.kecamatan_nm FROM dat_profile df INNER JOIN ref_jenis_user ju ON ju.jns_user_kd = df.jns_user_kd INNER JOIN ref_propinsi rp ON rp.propinsi_kd=df.propinsi_kd INNER JOIN ref_dati2 rd ON rd.dati2_kd=df.dati2_kd
        INNER JOIN ref_kecamatan rk ON rk.kecamatan_kd=df.kecamatan_kd INNER JOIN ref_agama ra ON ra.agama_kd=df.agama_kd WHERE df.profile_kd='$profileID'")->row();
        $data['head'] = 'include/head';
        $data['header'] = 'include/header';
        $data['menu'] = 'include/menu';
        $data['content'] = 'page/pegawai/form/editProfilePegawai';
        $data['footer'] = 'include/footer';
        $data['title'] = 'Detail Profile';
        $data['main_menu'] = 'master';
        $data['sub_menu'] = 'listPegawai';
        $this->load->view('index', $data);
    }




    public function simpanPegawaiProfile_ajax()
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


                $config['upload_path'] = "./uploads/ImagePegawai   "; //path folder file upload
                $config['allowed_types'] = 'gif|jpg|png|mp4';
                $config['encrypt_name'] = TRUE; //enkripsi file name upload

                $this->load->library('upload', $config); //call library upload 
                if ($this->upload->do_upload("file_fotoUser")) { //upload file
                    $data = array('upload_data' => $this->upload->data()); //ambil file name yang diupload

                    $config['image_library'] = 'gd2';
                    $config['source_image'] = './uploads/imagePegawai/' . $data['upload_data']['file_name'];
                    // $config['create_thumb'] = TRUE;
                    $config['maintain_ratio'] = FALSE;
                    $config['width'] = '300';
                    $config['height'] = '300';
                    $config['new_image'] = './uploads/imagePegawai/thumbnail/' . $data['upload_data']['file_name'];
                    $this->load->library('image_lib', $config);
                    $this->image_lib->resize();

                    $userGroup = $this->input->post('userGroup');
                    $nik = $this->input->post('nik');
                    $nama_depan = $this->input->post('nama_depan');
                    $nama_tengah = $this->input->post('nama_tengah');
                    $nama_belakang = $this->input->post('nama_belakang');
                    $agama = $this->input->post('agama');
                    $tempat_lahir = $this->input->post('tempat_lahir');
                    $tanggalLahir = $this->input->post('tanggalLahir');
                    $jenisKelamin = $this->input->post('jenisKelamin');
                    $provinsi = $this->input->post('provinsi');
                    $kabupaten = $this->input->post('kabupaten');
                    $kecamatan = $this->input->post('kecamatan');
                    $alamat = $this->input->post('alamat');
                    $kelurahan = $this->input->post('kelurahan');
                    $kodePos = $this->input->post('kodePos');
                    $telp = $this->input->post('telp');
                    $email = $this->input->post('email');
                    $idPegawai = $this->input->post("idProfile");
                    $keterangan_jabatan = $this->input->post('keterangan_jabatan');
                    $image = $data['upload_data']['file_name'];

                    $result = $this->PegawaiModel->simpanProfile($userGroup, $nik, $nama_depan, $nama_tengah, $nama_belakang, $agama, $tempat_lahir, $tanggalLahir, $jenisKelamin, $provinsi, $kabupaten, $kecamatan, $alamat, $kelurahan, $kodePos, $telp, $email, $keterangan_jabatan, $image);
                    // $dataProfile = $this->db->query("SELECT * FROM dat_profile WHERE profile_kd IN (SELECT MAX(profile_kd) FROM dat_profile)");
                    // $dataProfile = $dataProfile->row();
                    // $idProfile = $dataProfile->profile_kd;
                    $idProfile = $this->db->insert_id();
                    $this->db->query("UPDATE sekolah_pegawai SET profile_kd='$idProfile' WHERE pegawai_kd='$idPegawai'");
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

    public function updatePegawaiProfile_ajax()
    {
        $config['upload_path'] = "./uploads/ImagePegawai   "; //path folder file upload
        $config['allowed_types'] = 'gif|jpg|png|mp4';
        $config['encrypt_name'] = TRUE; //enkripsi file name upload

        $this->load->library('upload', $config); //call library upload 

        if (!$this->upload->do_upload('file_fotoUser')) {
            $image = $this->input->post("file_fotoUserOld");
        } else {
            $data = array('upload_data' => $this->upload->data());
            $image = $data['upload_data']['file_name'];
            $config['image_library'] = 'gd2';
            $config['source_image'] = './uploads/imagePegawai/' . $data['upload_data']['file_name'];
            // $config['create_thumb'] = TRUE;
            $config['maintain_ratio'] = FALSE;
            $config['width'] = '300';
            $config['height'] = '300';
            $config['new_image'] = './uploads/imagePegawai/thumbnail/' . $data['upload_data']['file_name'];
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
        $tanggalLahir = $this->input->post('tanggalLahir');
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


    // End Pegawai

}
