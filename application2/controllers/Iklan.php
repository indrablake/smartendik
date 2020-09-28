<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Iklan extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model("IklanModel");
        $this->load->library('form_validation');
    }


    // Iklan
    public function listIklan()
    {
        $data['dataIklan'] = $this->db->query("SELECT df.profile_kd, sekolah_pegawai.*,dat_sekolah.sekolah_nm,dat_sekolah.sekolah_npsn,ref_jenis_pegawai.jns_pegawai_nm FROM sekolah_pegawai INNER JOIN dat_sekolah ON dat_sekolah.sekolah_kd=sekolah_pegawai.sekolah_kd LEFT JOIN dat_profile df ON df.profile_kd=sekolah_pegawai.profile_kd  INNER JOIN ref_jenis_pegawai ON ref_jenis_pegawai.jns_pegawai_kd=sekolah_pegawai.jns_pegawai_kd")->result_array();
        $data['head'] = 'include/head';
        $data['header'] = 'include/header';
        $data['menu'] = 'include/menu';
        $data['content'] = 'page/iklan/listIklan';
        $data['footer'] = 'include/footer';
        $data['title'] = 'List Iklan';
        $data['main_menu'] = 'iklan';
        $data['sub_menu'] = 'listIklan';
        $this->load->view('index', $data);
    }



    public function hapusIklan_ajax()
    {
        if ($this->input->is_ajax_request() == true) {
            $iklanID = $this->input->post("iklanID");
            $hapus = $this->IklanModel->hapusIklan_ajax($iklanID);
            if ($hapus) {
                $msg = ['sukses' => 'Data Pegawai Berhasil Terhapus'];
            }
            echo json_encode($msg);
        }
    }

    public function formEditIklan()
    {

        $kodeIklan = $this->input->get('id');
        $data['resultImage'] = $this->db->query("SELECT iklan_gambar_link FROM dat_iklan_gambar WHERE iklan_kd='$kodeIklan'")->result_array();
        $data['iklanResult'] =  $this->db->query("SELECT iklan.iklan_kd,iklan.iklan_pengirim,iklan.iklan_judul,iklan.iklan_deskripsi,iklan.iklan_tgl_kirim,barang.jns_brg_nm,iklan.iklan_status FROM dat_iklan iklan LEFT JOIN ref_jenis_barang barang ON barang.jns_brg_kd=iklan.jns_brg_kd WHERE iklan.iklan_kd='$kodeIklan'")->row();
        $data['head'] = 'include/head';
        $data['header'] = 'include/header';
        $data['menu'] = 'include/menu';
        $data['content'] = 'page/iklan/form/editIklan';
        $data['footer'] = 'include/footer';
        $data['title'] = 'List Iklan';
        $data['main_menu'] = 'iklan';
        $data['sub_menu'] = 'listIklan';
        $this->load->view('index', $data);
    }

    public function updateIklanPublikasi()
    {

        if ($this->input->is_ajax_request() == true) {
            $iklanID = $this->input->post("iklanID");
            $update = $this->db->query("UPDATE dat_iklan SET iklan_status='1' WHERE iklan_kd='$iklanID'");
            if ($update) {
                $msg = ['sukses' => 'Data Iklan Berhasil Di Publikasikan'];
            }
            echo json_encode($msg);
        }
    }


    public function approved_ajax()
    {
        if ($this->input->is_ajax_request()) {

            $statusIklan = $this->input->post('statusIklan');
            $kodeIklan = $this->input->post('kodeIklan');

            $this->db->query("UPDATE dat_iklan SET iklan_status='$statusIklan' WHERE iklan_kd='$kodeIklan'");
            $msg = ['sukses' => 'Data Iklan berhasil diupdate'];
            echo json_encode($msg);
        }
    }
    public function detailIklanProfile()
    {
        $data['head'] = 'include/head';
        $data['header'] = 'include/header';
        $data['menu'] = 'include/menu';
        $data['content'] = 'page/iklan/form/tambahIklan';
        $data['footer'] = 'include/footer';
        $data['title'] = 'Detail Ilan';
        $data['main_menu'] = 'iklan';
        $data['sub_menu'] = 'listIklan';
        $this->load->view('index', $data);
    }


    public function tambahIklan()
    {
        $data['head'] = 'include/head';
        $data['header'] = 'include/header';
        $data['menu'] = 'include/menu';
        $data['content'] = 'page/iklan/form/tambahIklan';
        $data['footer'] = 'include/footer';
        $data['title'] = 'Detail Profile';
        $data['main_menu'] = 'iklan';
        $data['sub_menu'] = 'listIklan';
        $this->load->view('index', $data);
    }



    public function simpanIklan_ajax()
    {
        $iklan = $this->IklanModel;
        if (isset($_FILES['file_fotoIklan']) && !empty($_FILES['file_fotoIklan'])) {
            $jenisBarang = $this->input->post('jenisBarang');
            $iklanJudul = $this->input->post('iklanJudul');
            $iklanDeskripsi = $this->input->post('iklanDeskripsi');
            $iklanExpired = $this->input->post('iklanExpired');

            $data = array(
                'jns_brg_kd' => $jenisBarang,
                'iklan_pengirim' => '0',
                'iklan_disetujui_oleh' => '0',
                'iklan_judul' => $iklanJudul,
                'iklan_deskripsi' => $iklanDeskripsi,
                'iklan_tgl_kirim' => '2020-01-09',
                'iklan_tgl_expired' => $iklanExpired,
                'iklan_status' => '0',
            );
            $iklan->input_data($data, 'dat_iklan');
            $idIklan = $this->db->insert_id();
            $no_files = count($_FILES["file_fotoIklan"]['name']);
            for ($i = 0; $i < $no_files; $i++) {
                if ($_FILES["file_fotoIklan"]["error"][$i] > 0) {
                    echo "Error: " . $_FILES["file_fotoIklan"]["error"][$i] . "<br>";
                } else {
                    if (file_exists('uploads/imageIklan/' . $_FILES["file_fotoIklan"]["name"][$i])) {
                        echo 'File already exists : uploads/imageIklan/' . $_FILES["file_fotoIklan"]["name"][$i];
                    } else {
                        $tipe = substr($_FILES["file_fotoIklan"]["name"][$i], -5);
                        $namaFoto = $this->RandomString() . $tipe;
                        move_uploaded_file($_FILES["file_fotoIklan"]["tmp_name"][$i], 'uploads/imageIklan/' . $namaFoto);
                        $foto = $_FILES['file_fotoIklan']['name'][$i];
                        $result = $this->db->query("INSERT INTO dat_iklan_gambar(iklan_kd,iklan_gambar_link) VALUES('$idIklan',' $namaFoto')");

                        echo json_decode($result);
                    }
                }
            }
        } else {
            echo 'Please choose at least one file';
        }
    }


    function RandomString()
    {
        $str = rand();
        $result = hash("sha256", $str);
        return $result;
    }
    // End Iklan

}
