<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kompetensi extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model("KompetensiModel");
        $this->load->library('form_validation');
    }



    // Kompetensi Komponen
    public function listKompetensiKomponen()
    {
        $data['dataSiswa'] = $this->db->query("SELECT rkk.*,kd.* FROM ref_komponen_kd  rkk inner join komp_dasar kd ON kd.kd_id=rkk.kd_id")->result_array();
        $data['head'] = 'include/head';
        $data['header'] = 'include/header';
        $data['menu'] = 'include/menu';
        $data['content'] = 'page/kompetensi/listKompetensiKomponen';
        $data['footer'] = 'include/footer';
        $data['title'] = 'List Kompetensi Komponen';
        $data['main_menu'] = 'kompetensi';
        $data['sub_menu'] = 'listKompKomponen';
        $this->load->view('index', $data);
    }
    public function formTambahKompetensiKomponen()
    {
        // $data['dataRPP'] = $this->RPPModel->getData();
        $data['head'] = 'include/head';
        $data['header'] = 'include/header';
        $data['menu'] = 'include/menu';
        $data['content'] = 'page/Kompetensi/form/tambahKompetensiInti';
        $data['footer'] = 'include/footer';
        $data['title'] = 'List Kompetensi Inti';
        $data['main_menu'] = 'kompetensi';
        $data['sub_menu'] = 'listKompInti';
        $this->load->view('index', $data);
    }

    public function formEditKompKomponen()
    {
        if ($this->input->is_ajax_request() == true) {
            $kdID = $this->input->post('kdID');
            $kompKomponenID = $this->input->post('kompKomponenID');
            $result = $this->db->query("SELECT *FROM ref_komponen_kd WHERE kd_id='$kdID' and rkk_id='$kompKomponenID'");

            if ($result->num_rows() > 0) {
                $row = $result->row_array();
                $data = [
                    'rkkID' => $row['rkk_id'],
                    'komponenKompetensi' => $row['rkk_nama'],
                    'komposisiKompetensi' => $row['rkk_komposisi']
                ];
            }
            $msg = [
                'sukses' => $this->load->view('page/kompetensi/form/modalEditKompetensiKomponen', $data, true)
            ];
            echo json_encode($msg);
        }
    }


    public function simpanKompKomponen_ajax()
    {
        if ($this->input->is_ajax_request()) {

            $this->form_validation->set_rules("namaKomponen[]", "Nama Komponen", 'required', ['required' => '%s tidak boleh kosong']);
            $this->form_validation->set_rules("komposisi[]", "Komposisi", 'required', ['required' => '%s tidak boleh kosong']);

            if ($this->form_validation->run() != false) {

                $countKompKomponen = count($this->input->post("namaKomponen"));
                $query = $this->db->query("SELECT *FROM komp_dasar")->result_array();

                foreach ($query as $q) {
                    if ($countKompKomponen > 0) {
                        $number = $this->db->query("select max(rkk_Id) as rkk_id from ref_komponen_kd where kd_id='" . $q['kd_id'] . "'")->row();
                        $idLast = $number->rkk_id;
                        if ($idLast == NULL) {
                            $idLast = 1;
                        } else {
                            $idLast = intval($number->rkk_id) + 1;
                        }
                        for ($i = 0; $i < $countKompKomponen; $i++) {

                            if (trim($_POST["namaKomponen"][$i]) != '') {
                                $this->db->query("INSERT INTO ref_komponen_kd(kd_id,rkk_id,rkk_nama,rkk_komposisi) VALUES ('" . $q['kd_id'] . "','" . $idLast++ . "','" . $_POST["namaKomponen"][$i] . "','" . $_POST["komposisi"][$i] . "')");
                            }
                        }
                    }
                }
                $msg = ['sukses' => 'Data Kompetensi Komponen berhasil disimpan'];
            } else {
                $msg = [
                    'error' => '<div class="alert alert-warning mt-1 alert-styled-left alert-dismissible"><button type="button" class="close" data-dismiss="alert"><span>×</span></button><span class="font-weight-semibold">Warning!</span>' . validation_errors() .
                        '.</div>'
                ];
            }
            echo json_encode($msg);
        }
    }


    public function updateKompKomponen_ajax()
    {
        if ($this->input->is_ajax_request()) {
            $kompetensi = $this->KompetensiModel;

            $this->form_validation->set_rules("komponenKompetensi", "Nama Komponen", 'required', ['required' => '%s tidak boleh kosong']);
            $this->form_validation->set_rules("komposisiKompetensi", "Komposisi", 'required', ['required' => '%s tidak boleh kosong']);

            if ($this->form_validation->run() != false) {
                $namaKomponen = $this->input->post('komponenKompetensi');
                $komposisi = $this->input->post('komposisiKompetensi');
                $rkkID = $this->input->post('rkkID');

                $data = array(
                    'rkk_nama' => $namaKomponen,
                    'rkk_komposisi' => $komposisi
                );
                $where = array(
                    'rkk_id' => $rkkID
                );
                $kompetensi->update_data($where, $data, 'ref_komponen_kd');
                $msg = ['sukses' => 'Data Kompetensi Komponen berhasil diupdate'];
            } else {
                $msg = [
                    'error' => '<div class="alert alert-warning mt-1 alert-styled-left alert-dismissible"><button type="button" class="close" data-dismiss="alert"><span>×</span></button><span class="font-weight-semibold">Warning!</span>' . validation_errors() .
                        '.</div>'
                ];
            }

            echo json_encode($msg);
        }
    }

    public function hapusKompKomponen_ajax()
    {
        if ($this->input->is_ajax_request() == true) {
            $kdID = $this->input->post("kdID");
            $kompKomponenID = $this->input->post("kompKomponenID");
            $delete = $this->db->query("DELETE from ref_komponen_kd where rkk_id='$kompKomponenID '");
            if ($delete) {
                $msg = ['sukses' => 'Data Kompetensi Komponen Berhasil Terhapus'];
            }
            echo json_encode($msg);
        }
    }


    // Kompetensi Inti
    public function listKompetensiInti()
    {
        $data['dataSiswa'] = $this->db->query("SELECT js.jenjang_nm,ki.* FROM komp_inti  ki inner join ref_jenjang_sekolah js ON js.jenjang_kd=ki.jenjang_kd")->result_array();
        $data['head'] = 'include/head';
        $data['header'] = 'include/header';
        $data['menu'] = 'include/menu';
        $data['content'] = 'page/kompetensi/listKompetensiInti';
        $data['footer'] = 'include/footer';
        $data['title'] = 'List Kompetensi Inti';
        $data['main_menu'] = 'kompetensi';
        $data['sub_menu'] = 'listKompInti';
        $this->load->view('index', $data);
    }
    public function formTambahKompetensiInti()
    {
        // $data['dataRPP'] = $this->RPPModel->getData();
        $data['head'] = 'include/head';
        $data['header'] = 'include/header';
        $data['menu'] = 'include/menu';
        $data['content'] = 'page/Kompetensi/form/tambahKompetensiInti';
        $data['footer'] = 'include/footer';
        $data['title'] = 'List Kompetensi Inti';
        $data['main_menu'] = 'kompetensi';
        $data['sub_menu'] = 'listKompInti';
        $this->load->view('index', $data);
    }

    public function formEditKompInti()
    {
        if ($this->input->is_ajax_request() == true) {
            $kompIntiID = $this->input->post('kompIntiID');
            $result = $this->db->query("SELECT js.jenjang_nm,js.jenjang_kd,tp.thn_ajar_kd,tp.thn_ajar_periode,ki.* FROM komp_inti ki inner join ref_jenjang_sekolah js on js.jenjang_kd=ki.jenjang_kd INNER join ref_tahun_pelajaran tp on tp.thn_ajar_kd=ki.thn_ajar_kd  WHERE ki.ki_id='$kompIntiID'");

            if ($result->num_rows() > 0) {
                $row = $result->row_array();
                $data = [
                    'tahunKD' => $row['thn_ajar_kd'],
                    'tahunPeriode' => $row['thn_ajar_periode'],
                    'jenjangKD' => $row['jenjang_kd'],
                    'jenjangNama' => $row['jenjang_nm'],
                    'kodeKI' => $row['ki_kode'],
                    'keteranganKI' => $row['ki_keterangan'],
                    'kiKD' => $row['ki_id']
                ];
            }
            $msg = [
                'sukses' => $this->load->view('page/kompetensi/form/modalEditKompetensiInti', $data, true)
            ];
            echo json_encode($msg);
        }
    }


    public function formEditKompDasar()
    {
        if ($this->input->is_ajax_request() == true) {
            $kompDasarID = $this->input->post('kompDasarID');
            $result = $this->db->query("SELECT js.jenjang_nm,rt.thn_ajar_periode,rt.thn_ajar_kd,ki.ki_id,ki.ki_kode,ki.ki_keterangan,kd.* FROM komp_dasar kd inner join komp_inti ki on ki.ki_id=kd.ki_id INNER JOIN ref_tahun_pelajaran rt ON rt.thn_ajar_kd=ki.thn_ajar_kd INNER JOIN ref_jenjang_sekolah js ON js.jenjang_kd=ki.jenjang_kd  WHERE kd.kd_id='$kompDasarID'");

            if ($result->num_rows() > 0) {
                $row = $result->row_array();
                $data = [
                    'kiKode' => $row['ki_kode'],
                    'kiKeterangan' => $row['ki_keterangan'],
                    'kdID' => $row['kd_id'],
                    'kiID' => $row['ki_id'],
                    'kdGroup' => $row['kd_group'],
                    'jenjangNama' => $row['jenjang_nm'],
                    'tahunPeriode' => $row['thn_ajar_periode'],
                    'kdSemester' => $row['kd_semester'],
                    'kdKode' => $row['kd_kode'],
                    'kdKeterangan' => $row['kd_keterangan'],
                    'kdAlokasi' => $row['kd_alokasi_waktu'],
                    'kdTema' => $row['kd_tema'],
                    'kdSubTema' => $row['kd_sub_tema'],
                    'kdCapaian' => $row['kd_capaian_perkembangan']
                ];
            }
            $msg = [
                'sukses' => $this->load->view('page/kompetensi/form/modalEditKompetensiDasar', $data, true)
            ];
            echo json_encode($msg);
        }
    }

    public function updateKompDasar_ajax()
    {
        if ($this->input->is_ajax_request()) {
            $kompetensi = $this->KompetensiModel;

            $this->form_validation->set_rules("kompetensiInti", "Kompetensi Inti", 'required', ['required' => '%s tidak boleh kosong']);
            $this->form_validation->set_rules("kdSemester", "Kode Semester", 'required', ['required' => '%s tidak boleh kosong']);
            $this->form_validation->set_rules("kdKode", "Kode Kompetensi Dasar", 'required', ['required' => '%s tidak boleh kosong']);
            $this->form_validation->set_rules("kdKeterangan", "Keterangan Kompetensi Dasar", 'required', ['required' => '%s tidak boleh kosong']);

            $this->form_validation->set_rules("kdAlokasiWaktu", "Kode Alokasi Wakti", 'required', ['required' => '%s tidak boleh kosong']);
            $this->form_validation->set_rules("kdTema", "Tema Kompetensi Dasar", 'required', ['required' => '%s tidak boleh kosong']);
            $this->form_validation->set_rules("kdSubTema", "Sub Tema Kompetensi Dasar", 'required', ['required' => '%s tidak boleh kosong']);
            $this->form_validation->set_rules("kdCapaian", "Capaian Kompetensi Dasar", 'required', ['required' => '%s tidak boleh kosong']);




            if ($this->form_validation->run() != false) {
                $kompetensiInti = $this->input->post('kompetensiInti');
                $kdSemester = $this->input->post('kdSemester');
                $kdKode = $this->input->post('kdKode');
                $kdKeterangan = $this->input->post('kdKeterangan');
                $kdAlokasiWaktu = $this->input->post('kdAlokasiWaktu');
                $kdID = $this->input->post('kdID');
                $kdTema = $this->input->post('kdTema');
                $kdSubTema = $this->input->post('kdSubTema');
                $kdGroup = $this->input->post('kdGroup');
                $kdCapaian = $this->input->post('kdCapaian');


                $data = array(
                    'ki_id' => $kompetensiInti,
                    'kd_semester' => $kdSemester,
                    'kd_kode' => $kdKode,
                    'kd_group' => $kdGroup,
                    'kd_keterangan' => $kdKeterangan,
                    'kd_alokasi_waktu' => $kdAlokasiWaktu,
                    'kd_tema' => $kdTema,
                    'kd_sub_tema' => $kdSubTema,
                    'kd_capaian_perkembangan' => $kdCapaian,
                );
                $where = array(
                    'kd_id' => $kdID
                );
                $kompetensi->update_data($where, $data, 'komp_dasar');
                $msg = ['sukses' => 'Data Kompetensi Dasar berhasil diupdate'];
            } else {
                $msg = [
                    'error' => '<div class="alert alert-warning mt-1 alert-styled-left alert-dismissible"><button type="button" class="close" data-dismiss="alert"><span>×</span></button><span class="font-weight-semibold">Warning!</span>' . validation_errors() .
                        '.</div>'
                ];
            }

            echo json_encode($msg);
        }
    }


    public function updateKompInti_ajax()
    {
        if ($this->input->is_ajax_request()) {
            $kompetensi = $this->KompetensiModel;

            $this->form_validation->set_rules("jenjangSekolah", "Jenjang Sekolah", 'required', ['required' => '%s tidak boleh kosong']);
            $this->form_validation->set_rules("tahunAjaran", "Tahun Ajaran", 'required', ['required' => '%s tidak boleh kosong']);
            $this->form_validation->set_rules("kiKode", "Kode Kompetensi Inti", 'required', ['required' => '%s tidak boleh kosong']);
            $this->form_validation->set_rules("kiKeterangan", "Keterangan Kompetensi Inti", 'required', ['required' => '%s tidak boleh kosong']);
            if ($this->form_validation->run() != false) {
                $jenjangSekolah = $this->input->post('jenjangSekolah');
                $tahunAjaran = $this->input->post('tahunAjaran');
                $kiKD = $this->input->post('kiKD');
                $kiKode = $this->input->post('kiKode');
                $kiKeterangan = $this->input->post('kiKeterangan');

                $data = array(
                    'jenjang_kd' => $jenjangSekolah,
                    'thn_ajar_kd' => $tahunAjaran,
                    'ki_kode' => $kiKode,
                    'ki_keterangan' => $kiKeterangan,
                );
                $where = array(
                    'ki_id' => $kiKD
                );
                $kompetensi->update_data($where, $data, 'komp_inti');
                $msg = ['sukses' => 'Data Kompetensi Inti berhasil diupdate'];
            } else {
                $msg = [
                    'error' => '<div class="alert alert-warning mt-1 alert-styled-left alert-dismissible"><button type="button" class="close" data-dismiss="alert"><span>×</span></button><span class="font-weight-semibold">Warning!</span>' . validation_errors() .
                        '.</div>'
                ];
            }

            echo json_encode($msg);
        }
    }



    public function simpanKompetensiInti_ajax()
    {
        if ($this->input->is_ajax_request()) {

            $this->form_validation->set_rules("jenjangSekolah[]", "Jenjang Sekolah", 'required', ['required' => 'tidak boleh kosong']);
            $this->form_validation->set_rules("tahunAjaran[]", "Tahun Ajaran", 'required', ['required' => 'tidak boleh kosong']);
            $this->form_validation->set_rules("kiKode[]", "Kode Kompetensi Inti", 'required', ['required' => 'tidak boleh kosong']);
            $this->form_validation->set_rules("kiKeterangan[]", "Keterangan Kompetensi Inti", 'required', ['required' => 'tidak boleh kosong']);

            if ($this->form_validation->run() != false) {

                $countjenjangSekolah = count($this->input->post("jenjangSekolah"));

                if ($countjenjangSekolah > 0) {
                    for ($i = 0; $i < $countjenjangSekolah; $i++) {
                        if (trim($_POST["jenjangSekolah"][$i]) != '') {
                            $this->db->query("INSERT INTO komp_inti(jenjang_kd,thn_ajar_kd,ki_kode,ki_keterangan,ki_status) VALUES ('" . $_POST["jenjangSekolah"][$i] . "','" . $_POST["tahunAjaran"][$i] . "','" . $_POST["kiKode"][$i] . "','" . $_POST["kiKeterangan"][$i] . "','0')");
                        }
                    }
                }
                $msg = ['sukses' => 'Data Kompetensi Inti berhasil disimpan'];
            } else {
                $msg = [
                    'error' => '<div class="alert alert-warning mt-1 alert-styled-left alert-dismissible"><button type="button" class="close" data-dismiss="alert"><span>×</span></button><span class="font-weight-semibold">Warning!</span>' . validation_errors() .
                        '.</div>'
                ];
            }
            echo json_encode($msg);
        }
    }

    public function formDetailKompInti()
    {
        if ($this->input->is_ajax_request() == true) {
            $kompIntiID = $this->input->post('kompIntiID');
            $result = $this->db->query("SELECT js.jenjang_nm,js.jenjang_kd,tp.thn_ajar_kd,tp.thn_ajar_periode,ki.* FROM komp_inti ki inner join ref_jenjang_sekolah js on js.jenjang_kd=ki.jenjang_kd INNER join ref_tahun_pelajaran tp on tp.thn_ajar_kd=ki.thn_ajar_kd  WHERE ki.ki_id='$kompIntiID'");

            if ($result->num_rows() > 0) {
                $row = $result->row_array();
                $data = [
                    'tahunKD' => $row['thn_ajar_kd'],
                    'tahunPeriode' => $row['thn_ajar_periode'],
                    'jenjangKD' => $row['jenjang_kd'],
                    'jenjangNama' => $row['jenjang_nm'],
                    'kodeKI' => $row['ki_kode'],
                    'keteranganKI' => $row['ki_keterangan'],
                    'kiKD' => $row['ki_id']
                ];
            }
            $msg = [
                'sukses' => $this->load->view('page/kompetensi/form/modalDetailKompetensiInti', $data, true)
            ];
            echo json_encode($msg);
        }
    }

    public function formDetailKompDasar()
    {
        if ($this->input->is_ajax_request() == true) {
            $kompDasarID = $this->input->post('kompDasarID');
            $result = $this->db->query("SELECT js.jenjang_nm,rt.thn_ajar_periode,rt.thn_ajar_kd,ki.ki_id,ki.ki_kode,ki.ki_keterangan,kd.* FROM komp_dasar kd inner join komp_inti ki on ki.ki_id=kd.ki_id INNER JOIN ref_tahun_pelajaran rt ON rt.thn_ajar_kd=ki.thn_ajar_kd INNER JOIN ref_jenjang_sekolah js ON js.jenjang_kd=ki.jenjang_kd  WHERE kd.kd_id='$kompDasarID'");

            if ($result->num_rows() > 0) {
                $row = $result->row_array();
                $data = [
                    'kiKode' => $row['ki_kode'],
                    'kiKeterangan' => $row['ki_keterangan'],
                    'kdID' => $row['kd_id'],
                    'kiID' => $row['ki_id'],
                    'jenjangNama' => $row['jenjang_nm'],
                    'tahunPeriode' => $row['thn_ajar_periode'],
                    'kdSemester' => $row['kd_semester'],
                    'kdKode' => $row['kd_kode'],
                    'kdKeterangan' => $row['kd_keterangan'],
                    'kdAlokasi' => $row['kd_alokasi_waktu'],
                    'kdTema' => $row['kd_tema'],
                    'kdSubTema' => $row['kd_sub_tema'],
                    'kdCapaian' => $row['kd_capaian_perkembangan']
                ];
            }
            $msg = [
                'sukses' => $this->load->view('page/kompetensi/form/modalDetailKompetensiDasar', $data, true)
            ];
            echo json_encode($msg);
        }
    }

    public function hapusKompDasar_ajax()
    {
        if ($this->input->is_ajax_request() == true) {
            $kompDasarID = $this->input->post("kompDasarID");
            $update = $this->db->query("UPDATE komp_dasar SET kd_status='4' WHERE kd_id='$kompDasarID '");
            $updateKompDasarAlokasi = $this->db->query("DELETE from komp_dasar_alokasi WHERE kd_id='$kompDasarID '");
            $updateKKM = $this->db->query("DELETE from kkm WHERE kd_id='$kompDasarID '");
            if ($update) {
                $msg = ['sukses' => 'Data Kompetensi Dasar Berhasil Terhapus'];
            }
            echo json_encode($msg);
        }
    }


    public function hapusKompInti_ajax()
    {
        if ($this->input->is_ajax_request() == true) {
            $kompIntiID = $this->input->post("kompIntiID");
            $update = $this->db->query("UPDATE komp_inti SET ki_status='4' WHERE ki_id='$kompIntiID '");
            $updateKompDasar = $this->db->query("UPDATE komp_dasar SET kd_status='4' WHERE ki_id='$kompIntiID '");
            if ($update) {
                $msg = ['sukses' => 'Data Kompetensi Inti Berhasil Terhapus'];
            }
            echo json_encode($msg);
        }
    }

    public function ambilDataKompInti()
    {
        if ($this->input->is_ajax_request() == true) {

            $this->load->model('KompetensiModel', 'kompetensi');
            $list = $this->kompetensi->get_datatables_kompInti();
            $data = array();

            $no = $_POST['start'];
            foreach ($list as $field) {


                $no++;
                $tombolEdit = "<button type=\"button\" class=\"btn  btn-sm btn-outline-success\" title=\"Edit data\" onclick=\"edit('" . $field->ki_id . "')\">
                    Edit
                </button>";
                $tombolHapus = "<button type=\"button\" class=\"btn  btn-sm btn-outline-danger ml-1\" title=\"Hapus data\" onclick=\"hapus('" . $field->ki_id . "')\">
                    Hapus
                </button>";

                $tombolDetail = "<button type=\"button\" class=\"btn  btn-sm btn-outline-primary ml-1\" title=\"Edit data\" onclick=\"detail('" . $field->ki_id . "')\">
                Detail
            </button>";

                $tombolPublikasikan = "<button type=\"button\" class=\"btn  btn-sm btn-outline-danger ml-1\" title=\"Publikasi Data\" onclick=\"publikasi('" . $field->ki_id . "')\">
                Publikasi
            </button>";

                $row = array();
                $row[] = $no . ".";
                $row[] = $field->jenjang_nm;
                $row[] = $field->thn_ajar_periode;
                $row[] = $field->ki_kode;
                if ($field->ki_status == '0') {
                    $row[] = 'Draf';
                } else if ($field->ki_status == '1') {
                    $row[] = 'Publikasi';
                } else if ($field->ki_status == '4') {
                    $row[] = 'Tidak Di Publikasi';
                }
                if ($field->ki_status == '0') {
                    $row[] = $tombolEdit . $tombolHapus . $tombolDetail . $tombolPublikasikan;
                } else if ($field->ki_status == '1') {
                    $row[] =  $tombolHapus . $tombolDetail;
                } else if ($field->ki_status == '4') {
                    $row[] = '';
                }
                $data[] = $row;
            }

            $output = array(
                "draw" => $_POST['draw'],
                "recordsTotal" => $this->kompetensi->count_all_kompInti(),
                "recordsFiltered" => $this->kompetensi->count_filtered_kompInti(),
                "data" => $data,
            );
            //output dalam format JSON
            echo json_encode($output);
        } else {
            exit('Maaf data tidak bisa ditampilkan');
        }
    }

    // Kompetensi Dasar
    public function listKompetensiDasar()
    {

        $data['head'] = 'include/head';
        $data['header'] = 'include/header';
        $data['menu'] = 'include/menu';
        $data['content'] = 'page/kompetensi/listKompetensiDasar';
        $data['footer'] = 'include/footer';
        $data['title'] = 'List Kompetensi Dasar';
        $data['main_menu'] = 'kompetensi';
        $data['sub_menu'] = 'listKompDasar';
        $this->load->view('index', $data);
    }

    function fetchKompDasar()
    {
        $queryID = $this->input->post("query");
        $id = $this->input->post("kiID");
        $this->load->model('KompetensiModel', 'kompetensi');
        $list = $this->kompetensi->get_datatables_kompDasar($id);
        $data = array();

        $no = $_POST['start'];
        foreach ($list as $field) {


            $no++;
            $tombolEdit = "<button type=\"button\" class=\"btn  btn-sm btn-outline-success\" title=\"Edit data\" onclick=\"edit('" . $field->ki_id . "')\">
                    Edit
                </button>";
            $tombolHapus = "<button type=\"button\" class=\"btn  btn-sm btn-outline-danger ml-1\" title=\"Hapus data\" onclick=\"hapus('" . $field->ki_id . "')\">
                    Hapus
                </button>";

            $row = array();
            $row[] = $no . ".";
            $row[] = $field->kd_semester;
            $row[] = $field->kd_alokasi_waktu;
            $row[] =  substr($field->kd_tema, 0, 20) . ' ...';;
            $row[] = substr($field->kd_sub_tema, 0, 20) . ' ...';
            $row[] = $tombolEdit . $tombolHapus;
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->kompetensi->count_all_kompDasar($id),
            "recordsFiltered" => $this->kompetensi->count_filtered_kompDasar($id),
            "data" => $data,
        );
        //output dalam format JSON
        echo json_encode($output);
    }

    public function ambilDataKompDasar()
    {
        if ($this->input->is_ajax_request() == true) {
            $id = $this->input->post("kiID");
            $this->load->model('KompetensiModel', 'kompetensi');
            $list = $this->kompetensi->get_datatables_kompDasar($id);
            $data = array();

            $no = $_POST['start'];
            foreach ($list as $field) {


                $no++;
                $tombolEdit = "<button type=\"button\" class=\"btn  btn-sm btn-outline-success\" title=\"Edit data\" onclick=\"edit('" . $field->kd_id . "')\">
                    Edit
                </button>";
                $tombolHapus = "<button type=\"button\" class=\"btn  btn-sm btn-outline-danger ml-1\" title=\"Hapus data\" onclick=\"hapus('" . $field->kd_id . "')\">
                    Hapus
                </button>";

                $tombolDetail = "<button type=\"button\" class=\"btn  btn-sm btn-outline-primary ml-1\" title=\"Edit data\" onclick=\"detail('" . $field->kd_id . "')\">
                Detail
            </button>";

                $tombolPublikasikan = "<button type=\"button\" class=\"btn  btn-sm btn-outline-danger ml-1\" title=\"Publikasi Data\" onclick=\"publikasi('" . $field->kd_id . "')\">
                Publikasi
            </button>";

                $row = array();
                $row[] = $no . ".";
                $row[] = $field->kd_semester;
                $row[] = $field->kd_alokasi_waktu;
                $row[] =  substr($field->kd_tema, 0, 20) . ' ...';;
                $row[] = substr($field->kd_sub_tema, 0, 20) . ' ...';
                if ($field->kd_status == '0') {
                    $row[] = 'Draf';
                } else if ($field->kd_status == '1') {
                    $row[] = 'Publikasi';
                } else if ($field->kd_status == '4') {
                    $row[] = 'Tidak Di Publikasi';
                }
                if ($field->kd_status == '0') {
                    $row[] = $tombolEdit . $tombolHapus . $tombolDetail . $tombolPublikasikan;
                } else if ($field->kd_status == '1') {
                    $row[] =  $tombolHapus . $tombolDetail;
                } else if ($field->kd_status == '4') {
                    $row[] = '';
                }
                $data[] = $row;
            }

            $output = array(
                "draw" => $_POST['draw'],
                "recordsTotal" => $this->kompetensi->count_all_kompDasar($id),
                "recordsFiltered" => $this->kompetensi->count_filtered_kompDasar($id),
                "data" => $data,
            );
            //output dalam format JSON
            echo json_encode($output);
        } else {
            exit('Maaf data tidak bisa ditampilkan');
        }
    }

    public function formTambahKompetensiDasar()
    {
        // $data['dataRPP'] = $this->RPPModel->getData();
        $data['head'] = 'include/head';
        $data['header'] = 'include/header';
        $data['menu'] = 'include/menu';
        $data['content'] = 'page/Kompetensi/form/tambahKompetensiDasar';
        $data['footer'] = 'include/footer';
        $data['title'] = 'List Kompetensi Dasar';
        $data['main_menu'] = 'kompetensi';
        $data['sub_menu'] = 'listKompDasar';
        $this->load->view('index', $data);
    }

    public function simpanKompetensiDasar_ajax()
    {
        if ($this->input->is_ajax_request()) {

            $this->form_validation->set_rules("kompetensiInti[]", "Kompetensi Inti", 'required', ['required' => 'tidak boleh kosong']);
            $this->form_validation->set_rules("kdSemester[]", "Semester", 'required', ['required' => 'tidak boleh kosong']);
            $this->form_validation->set_rules("kdKode[]", "Kode Kompetensi Dasar", 'required', ['required' => 'tidak boleh kosong']);
            $this->form_validation->set_rules("kdKeterangan[]", "Keterangan Kompetensi Dasar", 'required', ['required' => 'tidak boleh kosong']);
            $this->form_validation->set_rules("kdAlokasiWaktu[]", "Alokasi Waktu Kompetensi Dasar", 'required', ['required' => 'tidak boleh kosong']);
            $this->form_validation->set_rules("kdTema[]", "Tema Kompetensi Dasar", 'required', ['required' => 'tidak boleh kosong']);
            $this->form_validation->set_rules("kdSubTema[]", "Sub Tema Kompetensi Dasar", 'required', ['required' => 'tidak boleh kosong']);
            $this->form_validation->set_rules("kdGroup[]", "Kompetensi Dasar Group", 'required', ['required' => 'tidak boleh kosong']);
            $this->form_validation->set_rules("kdCapaian[]", "Capaian Perkembangan Kompetensi Dasar", 'required', ['required' => 'tidak boleh kosong']);

            if ($this->form_validation->run() != false) {

                $countKompInti = count($this->input->post("kompetensiInti"));

                if ($countKompInti > 0) {
                    for ($i = 0; $i < $countKompInti; $i++) {
                        if (trim($_POST["kompetensiInti"][$i]) != '') {
                            $this->db->query("INSERT INTO komp_dasar(ki_id,kd_semester,kd_kode,kd_keterangan,kd_alokasi_waktu,kd_tema,kd_sub_tema,kd_capaian_perkembangan,kd_status,kd_group) VALUES ('" . $_POST["kompetensiInti"][$i] . "','" . $_POST["kdSemester"][$i] . "','" . $_POST["kdKode"][$i] . "','" . $_POST["kdKeterangan"][$i] . "','" . $_POST["kdAlokasiWaktu"][$i] . "','" . $_POST["kdTema"][$i] . "','" . $_POST["kdSubTema"][$i] . "','" . $_POST["kdCapaian"][$i] . "','0','" . $_POST["kdGroup"][$i] . "')");
                        }
                    }
                }
                $msg = ['sukses' => 'Data Kompetensi Dasar berhasil disimpan'];
            } else {
                $msg = [
                    'error' => '<div class="alert alert-warning mt-1 alert-styled-left alert-dismissible"><button type="button" class="close" data-dismiss="alert"><span>×</span></button><span class="font-weight-semibold">Warning!</span>' . validation_errors() .
                        '.</div>'
                ];
            }
            echo json_encode($msg);
        }
    }


    // Komp Dasar Alokasi
    public function listKompetensiDasarAlokasi()
    {

        $data['head'] = 'include/head';
        $data['header'] = 'include/header';
        $data['menu'] = 'include/menu';
        $data['content'] = 'page/kompetensi/listKompetensiDasarAlokasi';
        $data['footer'] = 'include/footer';
        $data['title'] = 'List Kompetensi Dasar Alokasi';
        $data['main_menu'] = 'kompetensi';
        $data['sub_menu'] = 'listKompDasarAlokasi';
        $this->load->view('index', $data);
    }

    function fetchKompDasarAlokasi()
    {
        $queryID = $this->input->post("query");
        $this->load->model('RPPModel', 'rpph');
        $list = $this->rpph->get_datatables_media_rpph($queryID);
        $data = array();

        $no = $_POST['start'];
        foreach ($list as $field) {


            $no++;
            $tombolEdit = "<button type=\"button\" class=\"btn  btn-sm btn-outline-success\" title=\"Edit data\" onclick=\"edit('" . $field->kda_id . "')\">
                     Edit
                 </button>";
            $tombolHapus = "<button type=\"button\" class=\"btn  btn-sm btn-outline-danger ml-1\" title=\"Hapus data\" onclick=\"hapus('" . $field->kda_id . "')\">
                     Hapus
                 </button>";

            $row = array();
            $row[] = $no . ".";
            $row[] = $field->thn_ajar_periode . ' [ Semester : ' . $field->rpp_semester . ' ]';
            $row[] = substr($field->rppmb_media, 0, 20) . ' ...';
            $row[] = $tombolEdit . $tombolHapus;
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->rpph->count_all_media_rpph($queryID),
            "recordsFiltered" => $this->rpph->count_filtered_media_rpph($queryID),
            "data" => $data,
        );
        //output dalam format JSON
        echo json_encode($output);
    }

    public function ambilDataKompDasarAlokasi()
    {
        if ($this->input->is_ajax_request() == true) {
            $id = $this->input->post("kdID");
            $this->load->model('KompetensiModel', 'kompetensi');
            $list = $this->kompetensi->get_datatables_kompDasarAlokasi($id);
            $data = array();

            $no = $_POST['start'];
            foreach ($list as $field) {


                $no++;
                $tombolEdit = "<button type=\"button\" class=\"btn  btn-sm btn-outline-success\" title=\"Edit data\" onclick=\"edit('" . $field->kda_id . "')\">
                    Edit
                </button>";
                $tombolHapus = "<button type=\"button\" class=\"btn  btn-sm btn-outline-danger ml-1\" title=\"Hapus data\" onclick=\"hapus('" . $field->kda_id . "')\">
                    Hapus
                </button>";

                $row = array();
                $row[] = $no . ".";
                $row[] = $field->kad_bulan;
                $row[] = $field->kad_minggu;
                $row[] =  $field->kad_jml_jam;
                $row[] = $tombolEdit . $tombolHapus;
                $data[] = $row;
            }

            $output = array(
                "draw" => $_POST['draw'],
                "recordsTotal" => $this->kompetensi->count_all_kompDasarAlokasi($id),
                "recordsFiltered" => $this->kompetensi->count_filtered_kompDasarAlokasi($id),
                "data" => $data,
            );
            //output dalam format JSON
            echo json_encode($output);
        } else {
            exit('Maaf data tidak bisa ditampilkan');
        }
    }

    public function formTambahKompetensiDasarAlokasi()
    {
        // $data['dataRPP'] = $this->RPPModel->getData();
        $data['head'] = 'include/head';
        $data['header'] = 'include/header';
        $data['menu'] = 'include/menu';
        $data['content'] = 'page/Kompetensi/form/tambahKompetensiDasarAlokasi';
        $data['footer'] = 'include/footer';
        $data['title'] = 'List Kompetensi Dasar Alokasi';
        $data['main_menu'] = 'kompetensi';
        $data['sub_menu'] = 'listKompDasarAlokasi';
        $this->load->view('index', $data);
    }

    public function simpanKompetensiDasarAlokasi_ajax()
    {
        if ($this->input->is_ajax_request()) {

            $this->form_validation->set_rules("kdID[]", "Kompetensi Dasar", 'required', ['required' => 'tidak boleh kosong']);
            $this->form_validation->set_rules("kdBulan[]", "Bulan", 'required', ['required' => 'tidak boleh kosong']);
            $this->form_validation->set_rules("kdMinggu[]", "Minggu", 'required', ['required' => 'tidak boleh kosong']);
            $this->form_validation->set_rules("kdJam[]", "Jumlah Jam", 'required', ['required' => 'tidak boleh kosong']);

            if ($this->form_validation->run() != false) {

                $countKD = count($this->input->post("kdID"));

                if ($countKD > 0) {
                    for ($i = 0; $i < $countKD; $i++) {
                        if (trim($_POST["kdID"][$i]) != '') {
                            $this->db->query("INSERT INTO komp_dasar_alokasi(kd_id,kad_bulan,kad_minggu,kad_jml_jam) VALUES ('" . $_POST["kdID"][$i] . "','" . $_POST["kdBulan"][$i] . "','" . $_POST["kdMinggu"][$i] . "','" . $_POST["kdJam"][$i] . "')");
                        }
                    }
                }
                $msg = ['sukses' => 'Data Kompetensi Dasar Alokasi berhasil disimpan'];
            } else {
                $msg = [
                    'error' => '<div class="alert alert-warning mt-1 alert-styled-left alert-dismissible"><button type="button" class="close" data-dismiss="alert"><span>×</span></button><span class="font-weight-semibold">Warning!</span>' . validation_errors() .
                        '.</div>'
                ];
            }
            echo json_encode($msg);
        }
    }

    public function formEditKompDasarAlokasi()
    {
        if ($this->input->is_ajax_request() == true) {
            $kompDasarAlokasiID = $this->input->post('kompDasarAlokasiID');
            $result = $this->db->query("SELECT kd.kd_semester,kd.kd_kode,kad.* FROM komp_dasar_alokasi kad inner join komp_dasar kd on kd.kd_id=kad.kd_id   WHERE kad.kda_id='$kompDasarAlokasiID'");

            if ($result->num_rows() > 0) {
                $row = $result->row_array();
                $data = [
                    'kadKode' => $row['kda_id'],
                    'kdID' => $row['kd_id'],
                    'kdSemester' => $row['kd_semester'],
                    'kdKode' => $row['kd_kode'],
                    'kadBulan' => $row['kad_bulan'],
                    'kadMinggu' => $row['kad_minggu'],
                    'kadJumlah' => $row['kad_jml_jam']
                ];
            }
            $msg = [
                'sukses' => $this->load->view('page/kompetensi/form/modalEditKompetensiDasarAlokasi', $data, true)
            ];
            echo json_encode($msg);
        }
    }

    public function updateKompDasarAlokasi_ajax()
    {
        if ($this->input->is_ajax_request()) {
            $kompetensi = $this->KompetensiModel;

            $this->form_validation->set_rules("kompetensiDasar", "Kompetensi Dasar", 'required', ['required' => '%s tidak boleh kosong']);
            $this->form_validation->set_rules("kadBulan", "Kompetensi Dasar Bulan", 'required', ['required' => '%s tidak boleh kosong']);
            $this->form_validation->set_rules("kadMinggu", "Kompetensi Dasar Minggu", 'required', ['required' => '%s tidak boleh kosong']);
            $this->form_validation->set_rules("kadJumlah", "Kompetensi Dasar Jumlah Jam", 'required', ['required' => '%s tidak boleh kosong']);



            if ($this->form_validation->run() != false) {
                $kompetensiDasar = $this->input->post('kompetensiDasar');
                $kadBulan = $this->input->post('kadBulan');
                $kadMinggu = $this->input->post('kadMinggu');
                $kadJumlah = $this->input->post('kadJumlah');
                $kadKode = $this->input->post('kadKode');

                $data = array(
                    'kd_id' => $kompetensiDasar,
                    'kad_bulan' => $kadBulan,
                    'kad_minggu' => $kadMinggu,
                    'kad_jml_jam' => $kadJumlah
                );
                $where = array(
                    'kda_id' => $kadKode
                );
                $kompetensi->update_data($where, $data, 'komp_dasar_alokasi');
                $msg = ['sukses' => 'Data Kompetensi Dasar Alokasi berhasil diupdate'];
            } else {
                $msg = [
                    'error' => '<div class="alert alert-warning mt-1 alert-styled-left alert-dismissible"><button type="button" class="close" data-dismiss="alert"><span>×</span></button><span class="font-weight-semibold">Warning!</span>' . validation_errors() .
                        '.</div>'
                ];
            }

            echo json_encode($msg);
        }
    }


    public function updateKompDasarPublikasi()
    {

        if ($this->input->is_ajax_request() == true) {
            $kiID = $this->input->post("kompDasarID");
            $update = $this->db->query("UPDATE komp_dasar SET kd_status='1' WHERE kd_id='$kiID'");
            if ($update) {
                $msg = ['sukses' => 'Data Kompetensi Dasar Berhasil Di Publikasikan'];
            }
            echo json_encode($msg);
        }
    }

    public function updateKompIntiPublikasi()
    {

        if ($this->input->is_ajax_request() == true) {
            $kiID = $this->input->post("kompIntiID");
            $update = $this->db->query("UPDATE komp_inti SET ki_status='1' WHERE ki_id='$kiID'");
            if ($update) {
                $msg = ['sukses' => 'Data Kompetensi Inti Berhasil Di Publikasikan'];
            }
            echo json_encode($msg);
        }
    }
}
