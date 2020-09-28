<?php
defined('BASEPATH') or exit('No direct script access allowed');

class RPP extends CI_Controller
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
     * @see https://codeigniter.com/RPP_guide/general/urls.html
     */


    public function __construct()
    {
        parent::__construct();
        $this->load->model("RPPModel");
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
        $data['main_menu'] = 'rpp';
        $data['sub_menu'] = 'listRPP';
        $this->load->view('index', $data);
    }

    public function listRPP()
    {
        $data['dataRPP'] = $this->db->query("SELECT tahun.thn_ajar_periode,rpp.rpp_semester,rpp.rpp_materi_pokok FROM rpp INNER JOIN ref_tahun_pelajaran tahun ON tahun.thn_ajar_kd=rpp.thn_ajar_kd");
        $data['head'] = 'include/head';
        $data['header'] = 'include/header';
        $data['menu'] = 'include/menu';
        $data['content'] = 'page/RPP/listRPP';
        $data['footer'] = 'include/footer';
        $data['title'] = 'List RPP';
        $data['main_menu'] = 'rpp';
        $data['sub_menu'] = 'listRPP';
        $this->load->view('index', $data);
    }


    public function formTambahRPP()
    {
        $data['dataRPP'] = $this->RPPModel->getData();
        $data['head'] = 'include/head';
        $data['header'] = 'include/header';
        $data['menu'] = 'include/menu';
        $data['content'] = 'page/RPP/form/tambahRPP';
        $data['footer'] = 'include/footer';
        $data['title'] = 'Tambah RPP';
        $data['main_menu'] = 'rpp';
        $data['sub_menu'] = 'listRPP';
        $this->load->view('index', $data);
    }

    public function formTambahTujuanRPP()
    {
        $data['dataRPP'] = $this->RPPModel->getData();
        $data['head'] = 'include/head';
        $data['header'] = 'include/header';
        $data['menu'] = 'include/menu';
        $data['content'] = 'page/RPP/form/tambahTujuanRPP';
        $data['footer'] = 'include/footer';
        $data['title'] = 'Tambah Tujuan RPP';
        $data['main_menu'] = 'rpp';
        $data['sub_menu'] = 'home';
        $this->load->view('index', $data);
    }

    public function ambilDataRPP()
    {
        if ($this->input->is_ajax_request() == true) {
            $this->load->model('RPPModel', 'rpph');
            $list = $this->rpph->get_datatables_rpph();
            $data = array();

            $no = $_POST['start'];
            foreach ($list as $field) {


                $no++;
                $tombolEdit = "<button type=\"button\" class=\"btn  btn-sm btn-outline-success ml-1\" title=\"Edit data\" onclick=\"edit('" . $field->rpp_id . "')\">
                    Edit
                </button>";
                $tombolHapus = "<button type=\"button\" class=\"btn  btn-sm btn-outline-danger ml-1\" title=\"Hapus data\" onclick=\"hapus('" . $field->rpp_id . "')\">
                    Hapus
                </button>";
                $tombolDetail = "<button type=\"button\" class=\"btn  btn-sm btn-outline-primary ml-1\" title=\"Edit data\" onclick=\"detail('" . $field->rpp_id . "')\">
                Detail
            </button>";
                $tombolPublikasikan = "<button type=\"button\" class=\"btn  btn-sm btn-outline-danger ml-1\" title=\"Publikasi Data\" onclick=\"publikasi('" . $field->rpp_id . "')\">
                Publikasi
            </button>";
                $id = base_url('RPP/detailExport?id=' . $field->rpp_id);
                $tombolExport = "<a class=\"btn  btn-sm btn-outline-danger ml-1\" title=\"Export Data\" href=\"" . $id . "\" >
                Export
            </a>";

                if ($field->rpp_status < 4) {
                    $row = array();
                    $row[] = $no . ".";
                    $row[] = $field->thn_ajar_periode;
                    $row[] = $field->rpp_semester;
                    if ($field->rpp_status == '0') {
                        $row[] = 'Draf';
                    } else if ($field->rpp_status == '1') {
                        $row[] = 'Publikasi';
                    } else if ($field->rpp_status == '4') {
                        $row[] = 'Tidak Di Publikasi';
                    }
                    if ($field->rpp_status == '0') {
                        $row[] = $tombolEdit . $tombolHapus . $tombolDetail . $tombolPublikasikan;
                    } else if ($field->rpp_status == '1') {
                        $row[] =  $tombolHapus . $tombolDetail . $tombolExport;
                    } else if ($field->rpp_status == '4') {
                        $row[] = '';
                    }
                    $data[] = $row;
                }
            }

            $output = array(
                "draw" => $_POST['draw'],
                "recordsTotal" => $this->rpph->count_all_rpph(),
                "recordsFiltered" => $this->rpph->count_filtered_rpph(),
                "data" => $data,
            );
            //output dalam format JSON
            echo json_encode($output);
        } else {
            exit('Maaf data tidak bisa ditampilkan');
        }
    }

    public function updateRPPPublikasi()
    {
        $this->load->model('RPPModel', 'rpp');
        if ($this->input->is_ajax_request() == true) {
            $rppID = $this->input->post("rppID");
            $update = $this->db->query("UPDATE rpp SET rpp_status='1' WHERE rpp_id='$rppID'");
            if ($update) {
                $msg = ['sukses' => 'Data RPP Berhasil Di Publikasikan'];
            }
            echo json_encode($msg);
        }
    }

    public function formEditRPP()
    {
        if ($this->input->is_ajax_request() == true) {
            $rppID = $this->input->post('rppID');
            $result = $this->db->query("SELECT rpp.*,ref_tahun_pelajaran.thn_ajar_kd,ref_tahun_pelajaran.thn_ajar_periode FROM rpp INNER JOIN ref_tahun_pelajaran ON ref_tahun_pelajaran.thn_ajar_kd=rpp.thn_ajar_kd WHERE rpp.rpp_id='$rppID'");
            if ($result->num_rows() > 0) {
                $row = $result->row_array();
                $data = [
                    'rppID' => $row['rpp_id'],
                    'tahunKode' => $row['thn_ajar_kd'],
                    'tahunPeriode' => $row['thn_ajar_periode'],
                    'semester' => $row['rpp_semester'],
                    'materiPokok' => $row['rpp_materi_pokok']
                ];
            }
            $msg = [
                'sukses' => $this->load->view('page/rpp/modal/modalEditRPP', $data, true)
            ];
            echo json_encode($msg);
        }
    }

    public function formDetailRPP()
    {
        if ($this->input->is_ajax_request() == true) {
            $rppID = $this->input->post('rppID');
            $result = $this->db->query("SELECT rpp.*,ref_tahun_pelajaran.thn_ajar_kd,ref_tahun_pelajaran.thn_ajar_periode FROM rpp INNER JOIN ref_tahun_pelajaran ON ref_tahun_pelajaran.thn_ajar_kd=rpp.thn_ajar_kd WHERE rpp.rpp_id='$rppID'");
            if ($result->num_rows() > 0) {
                $row = $result->row_array();
                $data = [
                    'rppID' => $row['rpp_id'],
                    'tahunKode' => $row['thn_ajar_kd'],
                    'tahunPeriode' => $row['thn_ajar_periode'],
                    'semester' => $row['rpp_semester'],
                    'materiPokok' => $row['rpp_materi_pokok']
                ];
            }
            $msg = [
                'sukses' => $this->load->view('page/rpp/modal/modalDetailRPP', $data, true)
            ];
            echo json_encode($msg);
        }
    }

    public function simpanRPP_ajax()
    {
        if ($this->input->is_ajax_request()) {
            $RPP = $this->RPPModel;
            $this->form_validation->set_rules("tahunAjaran", "Tahun Ajaran", 'required', ['required' => '%s tidak boleh kosong']);
            $this->form_validation->set_rules("materiPokok", "Materi Pokok", 'required', ['required' => '%s tidak boleh kosong']);
            $this->form_validation->set_rules("rppSemester", "RPP Semester", 'required', ['required' => '%s tidak boleh kosong']);

            if ($this->form_validation->run() != false) {
                $tahunAjaran = $this->input->post('tahunAjaran');
                $materiPokok = $this->input->post('materiPokok');
                $rppSemester = $this->input->post('rppSemester');

                $data = array(
                    'thn_ajar_kd' => $tahunAjaran,
                    'rpp_materi_pokok' => $materiPokok,
                    'rpp_semester' => $rppSemester,
                    'rpp_status' => '0'
                );
                $RPP->input_data($data, 'rpp');
                $msg = ['sukses' => 'Data RPP berhasil disimpan'];
            } else {
                $msg = [
                    'error' => '<div class="alert alert-warning mt-1 alert-styled-left alert-dismissible"><button type="button" class="close" data-dismiss="alert"><span>×</span></button><span class="font-weight-semibold">Warning!</span>' . validation_errors() .
                        '.</div>'
                ];
            }
            echo json_encode($msg);
        }
    }

    public function updateRPP_ajax()
    {
        if ($this->input->is_ajax_request()) {
            $RPP = $this->RPPModel;
            $this->form_validation->set_rules("tahunAjaran", "Tahun Ajaran", 'required', ['required' => '%s tidak boleh kosong']);
            $this->form_validation->set_rules("materiPokok", "Materi Pokok", 'required', ['required' => '%s tidak boleh kosong']);
            $this->form_validation->set_rules("rppSemester", "RPP Semester", 'required', ['required' => '%s tidak boleh kosong']);

            if ($this->form_validation->run() != false) {
                $tahunAjaran = $this->input->post('tahunAjaran');
                $materiPokok = $this->input->post('materiPokok');
                $rppSemester = $this->input->post('rppSemester');
                $rppID = $this->input->post("rppID");

                $where = array(
                    "rpp_id" => $rppID
                );
                $data = array(
                    'thn_ajar_kd' => $tahunAjaran,
                    'rpp_materi_pokok' => $materiPokok,
                    'rpp_semester' => $rppSemester
                );
                $RPP->update_data($where, $data, 'rpp');
                $msg = ['sukses' => 'Data RPP berhasil diupdate'];
            } else {
                $msg = [
                    'error' => '<div class="alert alert-warning mt-1 alert-styled-left alert-dismissible"><button type="button" class="close" data-dismiss="alert"><span>×</span></button><span class="font-weight-semibold">Warning!</span>' . validation_errors() .
                        '.</div>'
                ];
            }

            echo json_encode($msg);
        }
    }


    public function simpanRPPTujuan_ajax()
    {
        if ($this->input->is_ajax_request()) {

            $this->form_validation->set_rules("rppKeterangan[]", "Keterangan Pembelajaran", 'required', ['required' => 'tidak boleh kosong']);

            if ($this->form_validation->run() != false) {
                $countrppKeterangan = count($this->input->post("rppKeterangan"));
                if ($countrppKeterangan > 0) {
                    for ($i = 0; $i < $countrppKeterangan; $i++) {
                        if (trim($_POST["rppKeterangan"][$i]) != '') {
                            $this->db->query("INSERT INTO  rpp_tujuan_pembelajaran(rpp_id,rpptp_keterangan) VALUES ('" . $_POST["rppID"][$i] . "','" . $_POST["rppKeterangan"][$i] . "')");
                        }
                    }
                }
                $msg = ['sukses' => 'Data Tahun Pelajaran berhasil disimpan'];
            } else {
                $msg = [
                    'error' => '<div class="alert alert-warning mt-1 alert-styled-left alert-dismissible"><button type="button" class="close" data-dismiss="alert"><span>×</span></button><span class="font-weight-semibold">Warning!</span>' . validation_errors() .
                        '.</div>'
                ];
            }
            echo json_encode($msg);
        }
    }


    // Tambah Pembelajaran RPP
    public function formTambahPembelajaranRPP()
    {
        $data['dataRPP'] = $this->RPPModel->getData();
        $data['head'] = 'include/head';
        $data['header'] = 'include/header';
        $data['menu'] = 'include/menu';
        $data['content'] = 'page/RPP/form/tambahPembelajaranRPP';
        $data['footer'] = 'include/footer';
        $data['title'] = 'List RPP';
        $data['main_menu'] = 'rpp';
        $data['sub_menu'] = 'listPembelajaranRPP';
        $this->load->view('index', $data);
    }

    public function simpanRPPPembelajaran_ajax()
    {
        if ($this->input->is_ajax_request()) {

            $this->form_validation->set_rules("rppKeterangan[]", "Keterangan Pembelajaran", 'required', ['required' => 'tidak boleh kosong']);
            $this->form_validation->set_rules("rppCatatan[]", "Catatan Pembelajaran", 'required', ['required' => 'tidak boleh kosong']);
            $this->form_validation->set_rules("rppGroup[]", "Group Pembelajaran", 'required', ['required' => 'tidak boleh kosong']);

            if ($this->form_validation->run() != false) {

                $countrppID = count($this->input->post("rppID"));

                if ($countrppID > 0) {
                    for ($i = 0; $i < $countrppID; $i++) {
                        if (trim($_POST["rppID"][$i]) != '') {
                            $this->db->query("INSERT INTO rpp_langkah_pembelajaran(rpp_id,rpplb_keterangan,rpplb_group,rpplb_catatan) VALUES ('" . $_POST["rppID"][$i] . "','" . $_POST["rppKeterangan"][$i] . "','" . $_POST["rppGroup"][$i] . "','" . $_POST["rppCatatan"][$i] . "')");
                        }
                    }
                }
                $msg = ['sukses' => 'Data Langkah Pelajaran berhasil disimpan'];
            } else {
                $msg = [
                    'error' => '<div class="alert alert-warning mt-1 alert-styled-left alert-dismissible"><button type="button" class="close" data-dismiss="alert"><span>×</span></button><span class="font-weight-semibold">Warning!</span>' . validation_errors() .
                        '.</div>'
                ];
            }
            echo json_encode($msg);
        }
    }

    // Penilaian

    public function formTambahPenilaianRPP()
    {
        $data['dataRPP'] = $this->RPPModel->getData();
        $data['head'] = 'include/head';
        $data['header'] = 'include/header';
        $data['menu'] = 'include/menu';
        $data['content'] = 'page/RPP/form/tambahPenilaianRPP';
        $data['footer'] = 'include/footer';
        $data['title'] = 'Tambah Penilaian RPP';
        $data['main_menu'] = 'rpp';
        $data['sub_menu'] = 'listPenilaianRPP';
        $this->load->view('index', $data);
    }

    public function simpanRPPPenilaian_ajax()
    {
        if ($this->input->is_ajax_request()) {

            $this->form_validation->set_rules("rppKeterangan[]", "Keterangan Pembelajaran", 'required', ['required' => 'tidak boleh kosong']);

            if ($this->form_validation->run() != false) {
                $countrppID = count($this->input->post("rppID"));
                if ($countrppID > 0) {
                    for ($i = 0; $i < $countrppID; $i++) {
                        if (trim($_POST["rppID"][$i]) != '') {
                            $this->db->query("INSERT INTO rpp_penilaian(rpp_id,rppp_keterangan) VALUES ('" . $_POST["rppID"][$i] . "','" . $_POST["rppKeterangan"][$i] . "')");
                        }
                    }
                }
                $msg = ['sukses' => 'Data Penilaian berhasil disimpan'];
            } else {
                $msg = [
                    'error' => '<div class="alert alert-warning mt-1 alert-styled-left alert-dismissible"><button type="button" class="close" data-dismiss="alert"><span>×</span></button><span class="font-weight-semibold">Warning!</span>' . validation_errors() .
                        '.</div>'
                ];
            }
            echo json_encode($msg);
        }
    }


    // Media Pembelajaran

    public function formTambahMediaRPP()
    {
        $data['dataRPP'] = $this->RPPModel->getData();
        $data['head'] = 'include/head';
        $data['header'] = 'include/header';
        $data['menu'] = 'include/menu';
        $data['content'] = 'page/RPP/form/tambahMediaPembelajaran';
        $data['footer'] = 'include/footer';
        $data['title'] = 'Tambah Media RPP';
        $data['main_menu'] = 'rpp';
        $data['sub_menu'] = 'home';
        $this->load->view('index', $data);
    }


    public function simpanRPPMediaPembelajaran_ajax()
    {
        if ($this->input->is_ajax_request()) {

            $this->form_validation->set_rules("rppMedia[]", "Media Pembelajaran", 'required', ['required' => 'tidak boleh kosong']);
            $this->form_validation->set_rules("rppAlat[]", "Alat Pembelajaran", 'required', ['required' => 'tidak boleh kosong']);
            $this->form_validation->set_rules("rppSumber[]", "Sumber Pembelajaran", 'required', ['required' => 'tidak boleh kosong']);

            if ($this->form_validation->run() != false) {

                $countrppID = count($this->input->post("rppID"));

                if ($countrppID > 0) {
                    for ($i = 0; $i < $countrppID; $i++) {
                        if (trim($_POST["rppID"][$i]) != '') {
                            $this->db->query("INSERT INTO rpp_media_pembelajaran(rpp_id,rppmb_media,rppmb_alat,rppmb_sumber) VALUES ('" . $_POST["rppID"][$i] . "','" . $_POST["rppMedia"][$i] . "','" . $_POST["rppAlat"][$i] . "','" . $_POST["rppSumber"][$i] . "')");
                        }
                    }
                }
                $msg = ['sukses' => 'Data Media Pelajaran berhasil disimpan'];
            } else {
                $msg = [
                    'error' => '<div class="alert alert-warning mt-1 alert-styled-left alert-dismissible"><button type="button" class="close" data-dismiss="alert"><span>×</span></button><span class="font-weight-semibold">Warning!</span>' . validation_errors() .
                        '.</div>'
                ];
            }
            echo json_encode($msg);
        }
    }

    function listTujuanRPP()
    {
        $data['dataRPP'] = $this->db->query("SELECT tahun.thn_ajar_periode,rpp.rpp_semester,rpp.rpp_materi_pokok FROM rpp INNER JOIN ref_tahun_pelajaran tahun ON tahun.thn_ajar_kd=rpp.thn_ajar_kd");
        $data['head'] = 'include/head';
        $data['header'] = 'include/header';
        $data['menu'] = 'include/menu';
        $data['content'] = 'page/RPP/listTujuanRPP';
        $data['footer'] = 'include/footer';
        $data['title'] = 'List Tujuan RPP';
        $data['main_menu'] = 'rpp';
        $data['sub_menu'] = 'listTujuanRPP';
        $this->load->view('index', $data);
    }


    public function ambilDataTujuanRPP()
    {
        if ($this->input->is_ajax_request() == true) {
            $id = $this->input->post("rppTPID");
            $this->load->model('RPPModel', 'rpph');
            $list = $this->rpph->get_datatables_tujuan_rpph($id);
            $data = array();

            $no = $_POST['start'];
            foreach ($list as $field) {


                $no++;
                $tombolEdit = "<button type=\"button\" class=\"btn  btn-sm btn-outline-success\" title=\"Edit data\" onclick=\"edit('" . $field->rpptp_id . "')\">
                    Edit
                </button>";
                $tombolHapus = "<button type=\"button\" class=\"btn  btn-sm btn-outline-danger ml-1\" title=\"Hapus data\" onclick=\"hapus('" . $field->rpptp_id . "')\">
                    Hapus
                </button>";

                $row = array();
                $row[] = $no . ".";
                $row[] = $field->thn_ajar_periode . ' [ Semester : ' . $field->rpp_semester . ' ]';
                $row[] = substr($field->rpptp_keterangan, 0, 20) . ' ...';
                $row[] = $tombolEdit . $tombolHapus;
                $data[] = $row;
            }

            $output = array(
                "draw" => $_POST['draw'],
                "recordsTotal" => $this->rpph->count_all_tujuan_rpph($id),
                "recordsFiltered" => $this->rpph->count_filtered_tujuan_rpph($id),
                "data" => $data,
            );
            //output dalam format JSON
            echo json_encode($output);
        } else {
            exit('Maaf data tidak bisa ditampilkan');
        }
    }

    public function formEditTujuanRPP()
    {
        if ($this->input->is_ajax_request() == true) {
            $rppTPID = $this->input->post('rppTPID');
            $result = $this->db->query("SELECT rpp_tujuan_pembelajaran.*,rpp.rpp_semester,rpp.thn_ajar_kd,ref_tahun_pelajaran.thn_ajar_kd,ref_tahun_pelajaran.thn_ajar_periode FROM rpp_tujuan_pembelajaran
            INNER JOIN rpp ON rpp.rpp_id=rpp_tujuan_pembelajaran.rpp_id
            INNER JOIN ref_tahun_pelajaran ON ref_tahun_pelajaran.thn_ajar_kd=rpp.thn_ajar_kd WHERE rpp_tujuan_pembelajaran.rpptp_id='$rppTPID'");
            if ($result->num_rows() > 0) {
                $row = $result->row_array();
                $data = [
                    'rppID' => $row['rpp_id'],
                    'rppTPID' => $row['rpptp_id'],
                    'tahunKode' => $row['thn_ajar_kd'],
                    'tahunPeriode' => $row['thn_ajar_periode'],
                    'semester' => $row['rpp_semester'],
                    'keterangan' => $row['rpptp_keterangan']
                ];
            }
            $msg = [
                'sukses' => $this->load->view('page/rpp/modal/modalEditTujuanRPP', $data, true)
            ];
            echo json_encode($msg);
        }
    }

    public function updateTujuanRPP_ajax()
    {
        if ($this->input->is_ajax_request()) {
            $RPP = $this->RPPModel;
            $this->form_validation->set_rules("rppID", "RPP ID", 'required', ['required' => '%s tidak boleh kosong']);

            $this->form_validation->set_rules("rppKeterangan", "Keterangan Pembelajaran RPP", 'required', ['required' => '%s tidak boleh kosong']);

            if ($this->form_validation->run() != false) {
                $rpp = $this->input->post('rppID');
                $keterangan = $this->input->post('rppKeterangan');
                $rppTPID = $this->input->post('rppTPID');
                $where = array(
                    "rpptp_id" => $rppTPID
                );
                $data = array(
                    'rpp_id' => $rpp,
                    'rpptp_keterangan' => $keterangan,
                );
                $RPP->update_data($where, $data, 'rpp_tujuan_pembelajaran');
                $msg = ['sukses' => 'Data Tujuan Pembelajaran RPP berhasil diupdate'];
            } else {
                $msg = [
                    'error' => '<div class="alert alert-warning mt-1 alert-styled-left alert-dismissible"><button type="button" class="close" data-dismiss="alert"><span>×</span></button><span class="font-weight-semibold">Warning!</span>' . validation_errors() .
                        '.</div>'
                ];
            }

            echo json_encode($msg);
        }
    }


    // Media
    function listMediaRPP()
    {
        $data['dataRPP'] = $this->db->query("SELECT tahun.thn_ajar_periode,rpp.rpp_semester,rpp.rpp_materi_pokok FROM rpp INNER JOIN ref_tahun_pelajaran tahun ON tahun.thn_ajar_kd=rpp.thn_ajar_kd");
        $data['head'] = 'include/head';
        $data['header'] = 'include/header';
        $data['menu'] = 'include/menu';
        $data['content'] = 'page/RPP/listMediaRPP';
        $data['footer'] = 'include/footer';
        $data['title'] = 'List Media RPP';
        $data['main_menu'] = 'rpp';
        $data['sub_menu'] = 'listMediaRPP';
        $this->load->view('index', $data);
    }
    public function formEditMediaRPP()
    {
        if ($this->input->is_ajax_request() == true) {
            $rppMediaID = $this->input->post('rppMediaID');
            $result = $this->db->query("SELECT rpp_media_pembelajaran.*,rpp.rpp_semester,rpp.thn_ajar_kd,ref_tahun_pelajaran.thn_ajar_kd,ref_tahun_pelajaran.thn_ajar_periode FROM rpp_media_pembelajaran
            INNER JOIN rpp ON rpp.rpp_id=rpp_media_pembelajaran.rpp_id
            INNER JOIN ref_tahun_pelajaran ON ref_tahun_pelajaran.thn_ajar_kd=rpp.thn_ajar_kd WHERE rpp_media_pembelajaran.rppmp_id='$rppMediaID'");
            if ($result->num_rows() > 0) {
                $row = $result->row_array();
                $data = [
                    'rppID' => $row['rpp_id'],
                    'rppMediaID' => $row['rppmp_id'],
                    'tahunKode' => $row['thn_ajar_kd'],
                    'tahunPeriode' => $row['thn_ajar_periode'],
                    'semester' => $row['rpp_semester'],
                    'media' => $row['rppmb_media'],
                    'alat' => $row['rppmb_alat'],
                    'sumber' => $row['rppmb_sumber']
                ];
            }
            $msg = [
                'sukses' => $this->load->view('page/rpp/modal/modalEditMediaRPP', $data, true)
            ];
            echo json_encode($msg);
        }
    }


    public function ambilDataMediaRPP()
    {
        if ($this->input->is_ajax_request() == true) {
            $id = $this->input->post("rppmpID");
            $this->load->model('RPPModel', 'rpph');
            $list = $this->rpph->get_datatables_media_rpph($id);
            $data = array();

            $no = $_POST['start'];
            foreach ($list as $field) {


                $no++;
                $tombolEdit = "<button type=\"button\" class=\"btn  btn-sm btn-outline-success\" title=\"Edit data\" onclick=\"edit('" . $field->rppmp_id . "')\">
                    Edit
                </button>";
                $tombolHapus = "<button type=\"button\" class=\"btn  btn-sm btn-outline-danger ml-1\" title=\"Hapus data\" onclick=\"hapus('" . $field->rppmp_id . "')\">
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
                "recordsTotal" => $this->rpph->count_all_media_rpph($id),
                "recordsFiltered" => $this->rpph->count_filtered_media_rpph($id),
                "data" => $data,
            );
            //output dalam format JSON
            echo json_encode($output);
        } else {
            exit('Maaf data tidak bisa ditampilkan');
        }
    }

    public function updateMediaRPP_ajax()
    {
        if ($this->input->is_ajax_request()) {
            $RPP = $this->RPPModel;
            $this->form_validation->set_rules("rppID", "RPP ID", 'required', ['required' => '%s tidak boleh kosong']);

            $this->form_validation->set_rules("rppMedia", "Media Pembelajaran RPP", 'required', ['required' => '%s tidak boleh kosong']);
            $this->form_validation->set_rules("rppAlat", "Alat Pembelajaran RPP", 'required', ['required' => '%s tidak boleh kosong']);
            $this->form_validation->set_rules("rppSumber", "Sumber Pembelajaran RPP", 'required', ['required' => '%s tidak boleh kosong']);


            if ($this->form_validation->run() != false) {
                $rpp = $this->input->post('rppID');
                $rppMediaID = $this->input->post('rppMediaID');
                $rppMedia = $this->input->post('rppMedia');
                $rppAlat = $this->input->post('rppAlat');
                $rppSumber = $this->input->post('rppSumber');
                $where = array(
                    "rppmp_id" => $rppMediaID
                );
                $data = array(
                    'rpp_id' => $rpp,
                    'rppmb_media' => $rppMedia,
                    'rppmb_alat' => $rppAlat,
                    'rppmb_sumber' => $rppSumber
                );
                $RPP->update_data($where, $data, 'rpp_media_pembelajaran');
                $msg = ['sukses' => 'Data Media Pembelajaran RPP berhasil diupdate'];
            } else {
                $msg = [
                    'error' => '<div class="alert alert-warning mt-1 alert-styled-left alert-dismissible"><button type="button" class="close" data-dismiss="alert"><span>×</span></button><span class="font-weight-semibold">Warning!</span>' . validation_errors() .
                        '.</div>'
                ];
            }

            echo json_encode($msg);
        }
    }

    // Langkah
    function listLangkahRPP()
    {
        $data['dataRPP'] = $this->db->query("SELECT tahun.thn_ajar_periode,rpp.rpp_semester,rpp.rpp_materi_pokok FROM rpp INNER JOIN ref_tahun_pelajaran tahun ON tahun.thn_ajar_kd=rpp.thn_ajar_kd");
        $data['head'] = 'include/head';
        $data['header'] = 'include/header';
        $data['menu'] = 'include/menu';
        $data['content'] = 'page/RPP/listLangkahRPP';
        $data['footer'] = 'include/footer';
        $data['title'] = 'List Langkah RPP';
        $data['main_menu'] = 'rpp';
        $data['sub_menu'] = 'listPembelajaranRPP';
        $this->load->view('index', $data);
    }

    public function ambilDataLangkahRPP()
    {
        if ($this->input->is_ajax_request() == true) {
            $id = $this->input->post("rpplpID");
            $this->load->model('RPPModel', 'rpph');
            $list = $this->rpph->get_datatables_langkah_rpph($id);
            $data = array();

            $no = $_POST['start'];
            foreach ($list as $field) {


                $no++;
                $tombolEdit = "<button type=\"button\" class=\"btn  btn-sm btn-outline-success\" title=\"Edit data\" onclick=\"edit('" . $field->rpplp_id . "')\">
                    Edit
                </button>";
                $tombolHapus = "<button type=\"button\" class=\"btn  btn-sm btn-outline-danger ml-1\" title=\"Hapus data\" onclick=\"hapus('" . $field->rpplp_id . "')\">
                    Hapus
                </button>";

                $row = array();
                $row[] = $no . ".";
                $row[] = $field->thn_ajar_periode . ' [ Semester : ' . $field->rpp_semester . ' ]';
                $row[] = substr($field->rpplb_keterangan, 0, 20) . ' ...';
                $row[] = $tombolEdit . $tombolHapus;
                $data[] = $row;
            }

            $output = array(
                "draw" => $_POST['draw'],
                "recordsTotal" => $this->rpph->count_all_langkah_rpph($id),
                "recordsFiltered" => $this->rpph->count_filtered_langkah_rpph($id),
                "data" => $data,
            );
            //output dalam format JSON
            echo json_encode($output);
        } else {
            exit('Maaf data tidak bisa ditampilkan');
        }
    }
    // End Langkah
    // Penilaian
    function listPenilaianRPP()
    {
        $data['dataRPP'] = $this->db->query("SELECT tahun.thn_ajar_periode,rpp.rpp_semester,rpp.rpp_materi_pokok FROM rpp INNER JOIN ref_tahun_pelajaran tahun ON tahun.thn_ajar_kd=rpp.thn_ajar_kd");
        $data['head'] = 'include/head';
        $data['header'] = 'include/header';
        $data['menu'] = 'include/menu';
        $data['content'] = 'page/RPP/listPenilaianRPP';
        $data['footer'] = 'include/footer';
        $data['title'] = 'List Penilaian RPP';
        $data['main_menu'] = 'rpp';
        $data['sub_menu'] = 'listPenilaianRPP';
        $this->load->view('index', $data);
    }


    public function ambilDataPenilaianRPP()
    {
        if ($this->input->is_ajax_request() == true) {
            $id = $this->input->post("rppTPID");
            $this->load->model('RPPModel', 'rpph');
            $list = $this->rpph->get_datatables_penilaian_rpph($id);
            $data = array();

            $no = $_POST['start'];
            foreach ($list as $field) {


                $no++;
                $tombolEdit = "<button type=\"button\" class=\"btn  btn-sm btn-outline-success\" title=\"Edit data\" onclick=\"edit('" . $field->rppp_id . "')\">
                    Edit
                </button>";
                $tombolHapus = "<button type=\"button\" class=\"btn  btn-sm btn-outline-danger ml-1\" title=\"Hapus data\" onclick=\"hapus('" . $field->rppp_id . "')\">
                    Hapus
                </button>";

                $row = array();
                $row[] = $no . ".";
                $row[] = $field->thn_ajar_periode . ' [ Semester : ' . $field->rpp_semester . ' ]';
                $row[] = substr($field->rppp_keterangan, 0, 20) . ' ...';
                $row[] = $tombolEdit . $tombolHapus;
                $data[] = $row;
            }

            $output = array(
                "draw" => $_POST['draw'],
                "recordsTotal" => $this->rpph->count_all_penilaian_rpph($id),
                "recordsFiltered" => $this->rpph->count_filtered_penilaian_rpph($id),
                "data" => $data,
            );
            //output dalam format JSON
            echo json_encode($output);
        } else {
            exit('Maaf data tidak bisa ditampilkan');
        }
    }
    public function formEditLangkahRPP()
    {
        if ($this->input->is_ajax_request() == true) {
            $rpplpID = $this->input->post('rpplpID');
            $result = $this->db->query("SELECT rpp_langkah_pembelajaran.*,rpp.rpp_semester,rpp.thn_ajar_kd,ref_tahun_pelajaran.thn_ajar_kd,ref_tahun_pelajaran.thn_ajar_periode FROM rpp_langkah_pembelajaran
            INNER JOIN rpp ON rpp.rpp_id=rpp_langkah_pembelajaran.rpp_id
            INNER JOIN ref_tahun_pelajaran ON ref_tahun_pelajaran.thn_ajar_kd=rpp.thn_ajar_kd WHERE rpp_langkah_pembelajaran.rpplp_id='$rpplpID'");
            if ($result->num_rows() > 0) {
                $row = $result->row_array();
                $data = [
                    'rppLangkahID' => $row['rpplp_id'],
                    'rppID' => $row['rpp_id'],
                    'tahunKode' => $row['thn_ajar_kd'],
                    'tahunPeriode' => $row['thn_ajar_periode'],
                    'semester' => $row['rpp_semester'],
                    'keterangan' => $row['rpplb_keterangan'],
                    'groupRPP' => $row['rpplb_group'],
                    'catatan' => $row['rpplb_catatan']
                ];
            }
            $msg = [
                'sukses' => $this->load->view('page/rpp/modal/modalEditLangkahRPP', $data, true)
            ];
            echo json_encode($msg);
        }
    }
    public function formEditPenilaianRPP()
    {
        if ($this->input->is_ajax_request() == true) {
            $rpppID = $this->input->post('rpppID');
            $result = $this->db->query("SELECT rpp_penilaian.*,rpp.rpp_semester,rpp.thn_ajar_kd,ref_tahun_pelajaran.thn_ajar_kd,ref_tahun_pelajaran.thn_ajar_periode FROM rpp_penilaian
            INNER JOIN rpp ON rpp.rpp_id=rpp_penilaian.rpp_id
            INNER JOIN ref_tahun_pelajaran ON ref_tahun_pelajaran.thn_ajar_kd=rpp.thn_ajar_kd WHERE rpp_penilaian.rppp_id='$rpppID'");
            if ($result->num_rows() > 0) {
                $row = $result->row_array();
                $data = [
                    'rppID' => $row['rpp_id'],
                    'rpppID' => $row['rppp_id'],
                    'tahunKode' => $row['thn_ajar_kd'],
                    'tahunPeriode' => $row['thn_ajar_periode'],
                    'semester' => $row['rpp_semester'],
                    'keterangan' => $row['rppp_keterangan']
                ];
            }
            $msg = [
                'sukses' => $this->load->view('page/rpp/modal/modalEditPenilaianRPP', $data, true)
            ];
            echo json_encode($msg);
        }
    }

    public function updateLangkahRPP_ajax()
    {
        if ($this->input->is_ajax_request()) {
            $this->load->model('RPPModel', 'rpp');
            $this->form_validation->set_rules("rppID", "RPP ID", 'required', ['required' => '%s tidak boleh kosong']);
            $this->form_validation->set_rules("rppKeterangan", "Keterangan RPP", 'required', ['required' => '%s tidak boleh kosong']);
            $this->form_validation->set_rules("rppGroup", "Group RPP", 'required', ['required' => '%s tidak boleh kosong']);
            $this->form_validation->set_rules("rppCatatan", "Catatan RPP", 'required', ['required' => '%s tidak boleh kosong']);

            if ($this->form_validation->run() != false) {
                $rpp = $this->input->post('rppID');
                $keterangan = $this->input->post('rppKeterangan');
                $group = $this->input->post('rppGroup');
                $catatan = $this->input->post('rppCatatan');
                $rplpID = $this->input->post('rppLangkahID');
                $where = array(
                    "rpplp_id" => $rplpID
                );
                $data = array(
                    'rpp_id' => $rpp,
                    'rpplb_keterangan' => $keterangan,
                    'rpplb_group' => $group,
                    'rpplb_catatan' => $catatan
                );
                $this->rpp->update_data($where, $data, 'rpp_langkah_pembelajaran');
                $msg = ['sukses' => 'Data Langkah Pembelajaran RPP berhasil diupdate'];
            } else {
                $msg = [
                    'error' => '<div class="alert alert-warning mt-1 alert-styled-left alert-dismissible"><button type="button" class="close" data-dismiss="alert"><span>×</span></button><span class="font-weight-semibold">Warning!</span>' . validation_errors() .
                        '.</div>'
                ];
            }

            echo json_encode($msg);
        }
    }

    public function updatePenilaianRPP_ajax()
    {
        if ($this->input->is_ajax_request()) {
            $RPP = $this->load->model('RPPModel', 'rpp');
            $this->form_validation->set_rules("rppID", "RPP ID", 'required', ['required' => '%s tidak boleh kosong']);

            $this->form_validation->set_rules("rppKeterangan", "Keterangan Penilaian RPP", 'required', ['required' => '%s tidak boleh kosong']);

            if ($this->form_validation->run() != false) {
                $rpp = $this->input->post('rppID');
                $keterangan = $this->input->post('rppKeterangan');
                $rpppID = $this->input->post('rpppID');
                $where = array(
                    "rppp_id" => $rpppID
                );
                $data = array(
                    'rpp_id' => $rpp,
                    'rppp_keterangan' => $keterangan,
                );
                $this->rpp->update_data($where, $data, 'rpp_penilaian');
                $msg = ['sukses' => 'Data Penilaian  RPP berhasil diupdate'];
            } else {
                $msg = [
                    'error' => '<div class="alert alert-warning mt-1 alert-styled-left alert-dismissible"><button type="button" class="close" data-dismiss="alert"><span>×</span></button><span class="font-weight-semibold">Warning!</span>' . validation_errors() .
                        '.</div>'
                ];
            }

            echo json_encode($msg);
        }
    }

    // Hapus Data

    public function hapusRPP_ajax()
    {
        $this->load->model('RPPModel', 'rpp');
        if ($this->input->is_ajax_request() == true) {
            $rppID = $this->input->post("rppID");
            $update = $this->db->query("UPDATE rpp SET rpp_status='4' WHERE rpp_id='$rppID'");
            $updateRPPTP = $this->db->query("DELETE FROM rpp_tujuan_pembelajaran WHERE rpp_id='$rppID'");
            $updateRPPLP = $this->db->query("DELETE FROM rpp_langkah_pembelajaran WHERE rpp_id='$rppID'");
            $updatePenilaian = $this->db->query("DELETE FROM rpp_penilaian WHERE rpp_id='$rppID'");
            $updateRPPMP = $this->db->query("DELETE FROM rpp_media_pembelajaran WHERE rpp_id='$rppID'");
            if ($update) {
                $msg = ['sukses' => 'Data Tujuan Pembelajaran RPP Berhasil Terhapus'];
            }
            echo json_encode($msg);
        }
    }

    public function hapusTujuanRPP_ajax()
    {
        $this->load->model('RPPModel', 'rpp');
        if ($this->input->is_ajax_request() == true) {
            $rpptpID = $this->input->post("rppTPID");
            $hapus = $this->rpp->hapusTujuanRPP_ajax($rpptpID);
            if ($hapus) {
                $msg = ['sukses' => 'Data Tujuan Pembelajaran RPP Berhasil Terhapus'];
            }
            echo json_encode($msg);
        }
    }
    public function hapusDataPenilaianRPP_ajax()
    {
        $this->load->model('RPPModel', 'rpp');
        if ($this->input->is_ajax_request() == true) {
            $rpppenilaianID = $this->input->post("rpppenilaianID");
            $hapus = $this->rpp->hapusPenilaianRPP_ajax($rpppenilaianID);
            if ($hapus) {
                $msg = ['sukses' => 'Data  Penilaian RPP Berhasil Terhapus'];
            }
            echo json_encode($msg);
        }
    }
    public function hapusMediaRPP_ajax()
    {
        $this->load->model('RPPModel', 'rpp');
        if ($this->input->is_ajax_request() == true) {
            $rppmpID = $this->input->post("rppmpID");
            $hapus = $this->rpp->hapusMediaRPP_ajax($rppmpID);
            if ($hapus) {
                $msg = ['sukses' => 'Data Media RPP Berhasil Terhapus'];
            }
            echo json_encode($msg);
        }
    }
    public function hapusPembelajaranRPP_ajax()
    {
        $this->load->model('RPPModel', 'rpp');
        if ($this->input->is_ajax_request() == true) {
            $rpplpID = $this->input->post("rpplpID");
            $hapus = $this->rpp->hapusPembelajaranRPP_ajax($rpplpID);
            if ($hapus) {
                $msg = ['sukses' => 'Data Langkah Pembelajaran RPP Berhasil Terhapus'];
            }
            echo json_encode($msg);
        }
    }
    // End Hapus Data



    // Fetch Data
    function fetchTujuan()
    {
        $queryID = $this->input->post("query");
        $this->load->model('RPPModel', 'rpph');
        $list = $this->rpph->get_datatables_tujuan_rpph($queryID);
        $data = array();

        $no = $_POST['start'];
        foreach ($list as $field) {


            $no++;
            $tombolEdit = "<button type=\"button\" class=\"btn  btn-sm btn-outline-success\" title=\"Edit data\" onclick=\"edit('" . $field->rpptp_id . "')\">
                    Edit
                </button>";
            $tombolHapus = "<button type=\"button\" class=\"btn  btn-sm btn-outline-danger ml-1\" title=\"Hapus data\" onclick=\"hapus('" . $field->rpptp_id . "')\">
                    Hapus
                </button>";

            $row = array();
            $row[] = $no . ".";
            $row[] = $field->thn_ajar_periode . ' [ Semester : ' . $field->rpp_semester . ' ]';
            $row[] = substr($field->rpptp_keterangan, 0, 20) . ' ...';
            $row[] = $tombolEdit . $tombolHapus;
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->rpph->count_all_tujuan_rpph(),
            "recordsFiltered" => $this->rpph->count_filtered_tujuan_rpph(),
            "data" => $data,
        );
        //output dalam format JSON
        echo json_encode($output);
    }

    function fetchPenilaian()
    {
        $queryID = $this->input->post("query");
        $this->load->model('RPPModel', 'rpph');
        $list = $this->rpph->get_datatables_penilaian_rpph($queryID);
        $data = array();

        $no = $_POST['start'];
        foreach ($list as $field) {


            $no++;
            $tombolEdit = "<button type=\"button\" class=\"btn  btn-sm btn-outline-success\" title=\"Edit data\" onclick=\"edit('" . $field->rppp_id . "')\">
                    Edit
                </button>";
            $tombolHapus = "<button type=\"button\" class=\"btn  btn-sm btn-outline-danger ml-1\" title=\"Hapus data\" onclick=\"hapus('" . $field->rppp_id . "')\">
                    Hapus
                </button>";

            $row = array();
            $row[] = $no . ".";
            $row[] = $field->thn_ajar_periode . ' [ Semester : ' . $field->rpp_semester . ' ]';
            $row[] = substr($field->rppp_keterangan, 0, 20) . ' ...';
            $row[] = $tombolEdit . $tombolHapus;
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->rpph->count_all_penilaian_rpph($queryID),
            "recordsFiltered" => $this->rpph->count_filtered_penilaian_rpph($queryID),
            "data" => $data,
        );
        //output dalam format JSON
        echo json_encode($output);
    }


    function fetchMedia()
    {
        $queryID = $this->input->post("query");
        $this->load->model('RPPModel', 'rpph');
        $list = $this->rpph->get_datatables_media_rpph($queryID);
        $data = array();

        $no = $_POST['start'];
        foreach ($list as $field) {


            $no++;
            $tombolEdit = "<button type=\"button\" class=\"btn  btn-sm btn-outline-success\" title=\"Edit data\" onclick=\"edit('" . $field->rppmp_id . "')\">
                    Edit
                </button>";
            $tombolHapus = "<button type=\"button\" class=\"btn  btn-sm btn-outline-danger ml-1\" title=\"Hapus data\" onclick=\"hapus('" . $field->rppmp_id . "')\">
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


    function fetchLangkah()
    {
        $queryID = $this->input->post("query");
        $this->load->model('RPPModel', 'rpph');
        $list = $this->rpph->get_datatables_langkah_rpph($queryID);
        $data = array();

        $no = $_POST['start'];
        foreach ($list as $field) {


            $no++;
            $tombolEdit = "<button type=\"button\" class=\"btn  btn-sm btn-outline-success\" title=\"Edit data\" onclick=\"edit('" . $field->rpplp_id . "')\">
                Edit
            </button>";
            $tombolHapus = "<button type=\"button\" class=\"btn  btn-sm btn-outline-danger ml-1\" title=\"Hapus data\" onclick=\"hapus('" . $field->rpplp_id . "')\">
                Hapus
            </button>";

            $row = array();
            $row[] = $no . ".";
            $row[] = $field->thn_ajar_periode . ' [ Semester : ' . $field->rpp_semester . ' ]';
            $row[] = substr($field->rpplb_keterangan, 0, 20) . ' ...';
            $row[] = $tombolEdit . $tombolHapus;
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->rpph->count_all_langkah_rpph($queryID),
            "recordsFiltered" => $this->rpph->count_filtered_langkah_rpph($queryID),
            "data" => $data,
        );
        //output dalam format JSON
        echo json_encode($output);
    }
    // End Fetch


    public function detailExport()
    {
        $id = $this->input->get("id");
        $data['queryRPP'] = $this->db->query("SELECT tahun.thn_ajar_periode,rpp.* from rpp inner join ref_tahun_pelajaran tahun on tahun.thn_ajar_kd=rpp.thn_ajar_kd WHERE rpp_id='$id'")->row();
        $this->load->view('page/RPP/detailRPP', $data);
    }
}
