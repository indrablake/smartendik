<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Program extends CI_Controller
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
     * @see https://codeigniter.com/program_guide/general/urls.html
     */


    public function __construct()
    {
        parent::__construct();
        $this->load->model("ProgramModel");
        $this->load->library('form_validation');
    }

    // Get Ajax
    function get_ajax()
    {
        $list = $this->ProgramModel->get_datatables();
        $data = array();
        $no = @$_POST['start'];
        foreach ($list as $item) {
            $no++;
            $row = array();
            $row[] = $no . ".";
            $row[] = $item->CLASS_LEVEL . '-' . $item->CLASS_NAME;
            $row[] = $item->PROMES_SEMESTER;
            $row[] = $item->PROMES_YEAR;
            $row[] = '<a href="' . site_url('item/edit/' . $item->PROMES_ID) . '" class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i> Detail</a>
            <button class="btn btn-success ubah-program" data-toggle="modal" data-id="' . $item->PROMES_ID . '">Edit</button>';
            // add html for action

            $data[] = $row;
        }
        $output = array(
            "draw" => @$_POST['draw'],
            "recordsTotal" => $this->ProgramModel->count_all(),
            "recordsFiltered" => $this->ProgramModel->count_filtered(),
            "data" => $data,
        );
        // output to json format
        echo json_encode($output);
    }
    // Get Data Ajax
    public function getDataPromes()
    {
        $result = $this->db->query("SELECT sc.CLASS_NAME,sc.CLASS_LEVEL, pm.* FROM TBL_PROMES pm  INNER JOIN TBL_SCHOOLCLASS sc ON sc.CLASS_ID=pm.CLASS_ID")->result();
        echo json_encode($result);
    }

    // Hapus Ajax Program
    public function hapusProgram()
    {
        // id yang telah diparsing pada ajax ajaxcrud.php data{id:id}
        $id = $this->input->post('id');

        $data = $this->ProgramModel->hapusdataProgram($id);
        echo json_encode($data);
    }

    // Edit Data Ajax
    public function updateProgram_ajax()
    {
        // id yang telah diparsing pada ajax ajaxcrud.php data{id:id}
        $id = $this->input->post('id');
        $data['queryKelas'] = $this->ProgramModel->getDataKelas();
        $data['dataProgram'] = $this->ProgramModel->promesEdit($id);
        $this->load->view('page/program/formEditProgram', $data);
    }

    // Ubah Program
    public function ubahProgram_ajax($id)
    {
        $program = $this->ProgramModel;
        $namaKelas = $this->input->post('namaKelas');
        $semesterProgram = $this->input->post('semesterProgram');
        $tahunProgram = $this->input->post('tahunProgram');
        $tahunProgram2 = (int)$tahunProgram + 1;
        $idPromes = $this->input->post("promesID");
        $tahunPromes = $tahunProgram . '/' . $tahunProgram2;

        $strategiPembelajaran = $this->input->post('strategiPembelajaran');


        $data = array(
            'CLASS_ID' => $namaKelas,
            'PROMES_SEMESTER' => $semesterProgram,
            'PROMES_YEAR' => $tahunPromes,
            'PROMES_STRATEGY' => $strategiPembelajaran
        );
        $where = array(
            'PROMES_ID' => $idPromes
        );
        $result = $program->update_data($where, $data, 'TBL_PROMES');
        echo json_encode($result);
    }

    // Index
    public function index()
    {
        $data['queryGroup'] = $this->ProgramModel->getDataKelas();
        $data['head'] = 'include/head';
        $data['header'] = 'include/header';
        $data['menu'] = 'include/menu';
        $data['content'] = 'page/dashboard';
        $data['footer'] = 'include/footer';
        $data['title'] = 'Dashboard';
        $data['main_menu'] = 'program';
        $data['sub_menu'] = 'home';
        $this->load->view('index', $data);
    }
    public function listProgram()
    {
        $data['queryGroup'] = $this->ProgramModel->getDataKelas();
        $data['head'] = 'include/head';
        $data['header'] = 'include/header';
        $data['menu'] = 'include/menu';
        $data['content'] = 'page/program/listProgram';
        $data['footer'] = 'include/footer';
        $data['title'] = 'List Program Semester';
        $data['main_menu'] = 'program';
        $data['sub_menu'] = 'listProgram';
        $this->load->view('index', $data);
    }

    public function tambahProgram()
    {
        $data['head'] = 'include/head';
        $data['header'] = 'include/header';
        $data['menu'] = 'include/menu';
        $data['content'] = 'page/program/tambahProgram';
        $data['footer'] = 'include/footer';
        $data['title'] = 'Tambah Program Semester';
        $data['main_menu'] = 'program';
        $data['queryGroup'] = $this->ProgramModel->getDataKelas();
        $data['sub_menu'] = 'tambahProgram';
        $this->load->view('index', $data);
    }

    public function editProgram()
    {
        $id = $this->input->get("id");
        $data['isiValue'] = $this->ProgramModel->getData($id);
        $data['queryKelas'] = $this->ProgramModel->getDataKelas();
        $data['head'] = 'include/head';
        $data['header'] = 'include/header';
        $data['menu'] = 'include/menu';
        $data['content'] = 'page/program/editProgram';
        $data['footer'] = 'include/footer';
        $data['title'] = 'Edit Program Semester';
        $data['main_menu'] = 'program';
        $data['sub_menu'] = 'editProgram';
        $this->load->view('index', $data);
    }

    public function simpanProgram()
    {

        $program = $this->ProgramModel;

        $this->form_validation->set_rules("namaKelas", "Nama Kelas", 'required');
        $this->form_validation->set_rules("semesterProgram", "Program Semester", 'required');
        $this->form_validation->set_rules("tahunProgram", "Tahun Program Semester", 'required');
        $this->form_validation->set_rules("strategiPembelajaran", "Strategi Pembelajaran", 'required');

        if ($this->form_validation->run()) {

            // $namaSekolah = $this->input->post('namaSekolah');
            $namaKelas = $this->input->post('namaKelas');
            $semesterProgram = $this->input->post('semesterProgram');
            $tahunProgram = $this->input->post('tahunProgram');
            $tahunProgram2 = (int)$tahunProgram + 1;

            $tahunPromes = $tahunProgram . '/' . $tahunProgram2;

            $strategiPembelajaran = $this->input->post('strategiPembelajaran');


            $data = array(
                'CLASS_ID' => $namaKelas,
                'PROMES_SEMESTER' => $semesterProgram,
                'PROMES_YEAR' => $tahunPromes,
                'PROMES_STRATEGY' => $strategiPembelajaran
            );
            // $program->input_data($data, 'TBL_PROMES');
            $resultHasil = $program->input_data($data, 'TBL_PROMES');
            echo json_encode($resultHasil);



            // redirect("listProgramSemester");
        } else {
            $this->session->set_flashdata('success', 'Gagal disimpan');
            $data['head'] = 'include/head';
            $data['header'] = 'include/header';
            $data['menu'] = 'include/menu';
            $data['content'] = 'page/program/tambahProgram';
            $data['footer'] = 'include/footer';
            $data['title'] = 'Tambah Program ';
            $data['main_menu'] = 'program';
            $data['sub_menu'] = 'home';
            $this->load->view('index', $data);
        }
    }

    public function updateProgram()
    {

        $program = $this->ProgramModel;

        $this->form_validation->set_rules("namaKelas", "Nama Kelas", 'required');
        $this->form_validation->set_rules("semesterProgram", "Program Semester", 'required');
        $this->form_validation->set_rules("tahunProgram", "Tahun Program Semester", 'required');
        $this->form_validation->set_rules("strategiPembelajaran", "Strategi Pembelajaran", 'required');

        if ($this->form_validation->run()) {

            // $namaSekolah = $this->input->post('namaSekolah');
            $namaKelas = $this->input->post('namaKelas');
            $semesterProgram = $this->input->post('semesterProgram');
            $tahunProgram = $this->input->post('tahunProgram');
            $tahunProgram2 = (int)$tahunProgram + 1;
            $idPromes = $this->input->post("promesID");
            $tahunPromes = $tahunProgram . '/' . $tahunProgram2;

            $strategiPembelajaran = $this->input->post('strategiPembelajaran');


            $data = array(
                'CLASS_ID' => $namaKelas,
                'PROMES_SEMESTER' => $semesterProgram,
                'PROMES_YEAR' => $tahunPromes,
                'PROMES_STRATEGY' => $strategiPembelajaran
            );
            $where = array(
                'PROMES_ID' => $idPromes
            );
            $program->update_data($where, $data, 'TBL_PROMES');
            $this->session->set_flashdata('success', 'Berhasil disimpan');

            redirect("listProgramSemester");

            $this->load->view('index', $data);
        } else {
            $this->session->set_flashdata('success', 'Gagal disimpan');
            $data['head'] = 'include/head';
            $data['header'] = 'include/header';
            $data['menu'] = 'include/menu';
            $data['content'] = 'page/program/tambahProgram';
            $data['footer'] = 'include/footer';
            $data['title'] = 'Tambah Program ';
            $data['main_menu'] = 'program';
            $data['sub_menu'] = 'home';
            $this->load->view('index', $data);
        }
    }


    // List Tema Program Semester

    public function listTemaProgram()
    {

        $data['query'] = $this->db->query("SELECT pm.*, pt.*,sc.CLASS_LEVEL,sc.CLASS_NAME FROM TBL_PROMES_THEME pt  INNER JOIN TBL_PROMES pm ON pm.PROMES_ID=pt.PROMES_ID
        INNER JOIN tbl_schoolclass sc ON sc.CLASS_ID=pm.CLASS_ID")->result_array();
        $data['head'] = 'include/head';
        $data['header'] = 'include/header';
        $data['menu'] = 'include/menu';
        $data['content'] = 'page/program/listTemaProgram';
        $data['footer'] = 'include/footer';
        $data['title'] = 'List Tema Program Semester';
        $data['main_menu'] = 'program';
        $data['sub_menu'] = 'listTemaProgramSemester';
        $this->load->view('index', $data);
    }

    public function tambahTemaProgram()
    {
        $data['query'] = $this->db->query("SELECT pm.*, pt.* FROM TBL_PROMES_THEME pt  INNER JOIN TBL_PROMES pm ON pm.PROMES_ID=pt.PROMES_ID")->result_array();
        $data['queryPromes'] = $this->ProgramModel->getDataPromes();
        $data['head'] = 'include/head';
        $data['header'] = 'include/header';
        $data['menu'] = 'include/menu';
        $data['content'] = 'page/program/tambahTemaProgram';
        $data['footer'] = 'include/footer';
        $data['title'] = 'Tambah Tema Program Semester';
        $data['main_menu'] = 'program';
        $data['sub_menu'] = 'tambahTemaProgramSemester';
        $this->load->view('index', $data);
    }

    public function listTujuanProgram()
    {
        $data['query'] = $this->db->query("SELECT ps.SUBTHEME_NAME, pg.* FROM TBL_PROMES_GOAL pg  INNER JOIN TBL_PROMES_SUBTHEME ps ON ps.SUBTHEME_ID=pg.SUBTHEME_ID")->result_array();
        $data['head'] = 'include/head';
        $data['header'] = 'include/header';
        $data['menu'] = 'include/menu';
        $data['content'] = 'page/program/listTujuanProgram';
        $data['footer'] = 'include/footer';
        $data['title'] = 'List Tujuan Program Semester';
        $data['main_menu'] = 'program';
        $data['sub_menu'] = 'listTujuanProgramSemester';
        $this->load->view('index', $data);
    }

    public function tambahTujuanProgram()
    {
        $data['query'] = $this->db->query("SELECT ps.SUBTHEME_NAME, pg.* FROM TBL_PROMES_GOAL pg  INNER JOIN TBL_PROMES_SUBTHEME ps ON ps.SUBTHEME_ID=pg.SUBTHEME_ID")->result_array();

        $data['querySub'] = $this->db->query("SELECT *FROM TBL_PROMES_THEME")->result_array();
        // $data['querySub'] = $this->db->query("SELECT *FROM TBL_PROMES_SUBTHEME ps INNER JOIN TBL_PROMES_THEME pt ON pt.THEME_ID=ps.THEME_ID")->result_array();

        $data['head'] = 'include/head';
        $data['header'] = 'include/header';
        $data['menu'] = 'include/menu';
        $data['content'] = 'page/program/tambahTujuanProgram';
        $data['footer'] = 'include/footer';
        $data['title'] = 'Tambah Tujuan Program Semester';
        $data['main_menu'] = 'program';
        $data['sub_menu'] = 'tambahTujuanProgramSemester';
        $this->load->view('index', $data);
    }

    public function listKompetensiProgram()
    {
        $data['query'] = $this->db->query("SELECT pg.GOAL_DESC, pc.* FROM TBL_PROMES_COMPETENCY pc  INNER JOIN TBL_PROMES_GOAL pg ON pg.GOAL_ID=pc.GOAL_ID")->result_array();
        $data['head'] = 'include/head';
        $data['header'] = 'include/header';
        $data['menu'] = 'include/menu';
        $data['content'] = 'page/program/listKompetensiProgram';
        $data['footer'] = 'include/footer';
        $data['title'] = 'List Kompetensi Program Semester';
        $data['main_menu'] = 'program';
        $data['sub_menu'] = 'listKompetensiProgramSemester';
        $this->load->view('index', $data);
    }

    public function tambahKompetensiProgram()
    {
        $data['query'] = $this->db->query("SELECT pg.GOAL_DESC,pg.GOAL_ID as goalID, pc.* FROM TBL_PROMES_COMPETENCY pc  INNER JOIN TBL_PROMES_GOAL pg ON pg.GOAL_ID=pc.GOAL_ID")->result_array();

        $data['queryGoal'] = $this->db->query("SELECT pg.GOAL_DESC,pg.GOAL_ID,ps.SUBTHEME_NAME FROM TBL_PROMES_GOAL pg INNER JOIN TBL_PROMES_SUBTHEME ps ON ps.SUBTHEME_ID=pg.SUBTHEME_ID")->result_array();
        $data['head'] = 'include/head';
        $data['header'] = 'include/header';
        $data['menu'] = 'include/menu';
        $data['content'] = 'page/program/tambahKompetensiProgram';
        $data['footer'] = 'include/footer';
        $data['title'] = 'Tambah Kompetensi Program Semester';
        $data['main_menu'] = 'program';
        $data['sub_menu'] = 'tambahKompetensiProgramSemester';
        $this->load->view('index', $data);
    }


    // Simpan Tema Program
    public function simpanTemaProgram()
    {
        $program = $this->ProgramModel;

        $this->form_validation->set_rules("promesID", "Promes ID", 'required');
        // $this->form_validation->set_rules("evaluasiBulanan", "Evaluasi Bulanan", 'required');
        // $this->form_validation->set_rules("alokasiWaktu", "Alokasi Waktu", 'required');


        if ($this->form_validation->run() != false) {
            $namaTema = count($this->input->post('temaPromes'));
            $promesID = $this->input->post('promesID');
            $evaluasiBulanan = count($this->input->post('evaluasiBulanan'));
            $alokasiWaktu = count($this->input->post('alokasiWaktu'));

            if ($namaTema > 0) {
                for ($i = 0; $i < $namaTema; $i++) {
                    if (trim($_POST["temaPromes"][$i]) != '') {
                        $this->db->query("INSERT INTO TBL_PROMES_THEME(PROMES_ID,THEME_THEME,THEME_MONTHLY_EVALUATION,THEME_TIME_ALLOCATION) VALUES ('$promesID','" . $_POST['temaPromes'][$i] . "','" . $_POST['evaluasiBulanan'][$i] . "','" . $_POST['alokasiWaktu'][$i] . "')");
                    }
                }
            }

            $this->session->set_flashdata('success', 'Berhasil disimpan');
            redirect("listTemaProgramSemester");
        } else {
            $this->session->set_flashdata('failed', 'Lengkapi Data');
            $data['head'] = 'include/head';
            $data['header'] = 'include/header';
            $data['menu'] = 'include/menu';
            $data['content'] = 'page/program/tambahTemaProgram';
            $data['footer'] = 'include/footer';
            $data['title'] = 'Tambah Tema Program Semester';
            $data['main_menu'] = 'program';
            $data['sub_menu'] = 'tambahTemaProgramSemester';
            $this->load->view('index', $data);
        }
    }

    public function updateTemaProgram()
    {


        $program = $this->ProgramModel;
        $this->form_validation->set_rules("temaPromes", "Tema Program Semester", 'required');
        $this->form_validation->set_rules("evaluasiBulanan", "Evaluasi Bulanan", 'required');
        $this->form_validation->set_rules("alokasiWaktu", "Alokasi Waktu", 'required');


        if ($this->form_validation->run() != false) {
            $namaTema = $this->input->post('temaPromes');
            $promesID = $this->input->post('promesID');
            $evaluasiBulanan = $this->input->post('evaluasiBulanan');
            $idTheme = $this->input->post("THEMEID");
            $alokasiWaktu = $this->input->post('alokasiWaktu');
            $data = array(
                'THEME_THEME' => $namaTema,
                'THEME_MONTHLY_EVALUATION' => $evaluasiBulanan,
                'THEME_TIME_ALLOCATION' => $alokasiWaktu
            );
            $where = array(
                "THEME_ID" => $idTheme
            );
            $program->update_data($where, $data, 'TBL_PROMES_THEME');

            $this->session->set_flashdata('success', 'Berhasil Diedit');
            redirect("listTemaProgramSemester");
        } else {
            $this->session->set_flashdata('failed', 'Lengkapi Data');
            $data['head'] = 'include/head';
            $data['header'] = 'include/header';
            $data['menu'] = 'include/menu';
            $data['content'] = 'page/program/editTemaProgram';
            $data['footer'] = 'include/footer';
            $data['title'] = 'Edit Tema Program Semester';
            $data['main_menu'] = 'program';
            $data['sub_menu'] = 'editTemaProgramSemester';
            $this->load->view('index', $data);
        }
    }


    // Tujuan Program Semester
    public function simpanTujuanProgram()
    {
        $program = $this->ProgramModel;

        $this->form_validation->set_rules("subTheme", "Nama Sub Tema", 'required');
        // $this->form_validation->set_rules("deskripsiTujuan", "Deskripsi Tujuan", 'required');


        if ($this->form_validation->run() != false) {
            $subTheme = $this->input->post('subTheme');
            $deskripsiTujuan = count($this->input->post("deskripsiTujuan"));

            if ($deskripsiTujuan > 0) {
                for ($i = 0; $i < $deskripsiTujuan; $i++) {
                    if (trim($_POST["deskripsiTujuan"][$i]) != '') {
                        $this->db->query("INSERT INTO TBL_PROMES_GOAL(SUBTHEME_ID,GOAL_DESC) VALUES ('$subTheme','" . $_POST['deskripsiTujuan'][$i] . "')");
                    }
                }
            }

            $this->session->set_flashdata('success', 'Berhasil disimpan');
            redirect("listTujuanProgramSemester");
        } else {
            $this->session->set_flashdata('failed', 'Lengkapi Data');
            $data['head'] = 'include/head';
            $data['header'] = 'include/header';
            $data['menu'] = 'include/menu';
            $data['content'] = 'page/program/tambahTujuanProgram';
            $data['footer'] = 'include/footer';
            $data['title'] = 'Tambah Tujuan Program Semester';
            $data['main_menu'] = 'program';
            $data['sub_menu'] = 'tambahTujuanProgramSemester';
            $this->load->view('index', $data);
        }
    }

    public function updateTujuanProgram()
    {


        $program = $this->ProgramModel;

        $this->form_validation->set_rules("deskripsiTujuan", "Deksripsi Tujuan", 'required');

        if ($this->form_validation->run() != false) {
            $deskripsiTujuan = $this->input->post('deskripsiTujuan');
            $data = array(
                'GOAL_DESC' => $deskripsiTujuan
            );
            $idGoal = $this->input->post("idGoal");
            $where = array(
                "GOAL_ID" => $idGoal
            );
            $program->update_data($where, $data, 'TBL_PROMES_GOAL');

            $this->session->set_flashdata('success', 'Berhasil Diedit');
            redirect("listTujuanProgramSemester");
        } else {
            $this->session->set_flashdata('failed', 'Lengkapi Data');
            $data['head'] = 'include/head';
            $data['header'] = 'include/header';
            $data['menu'] = 'include/menu';
            $data['content'] = 'page/program/listTujuanProgram';
            $data['footer'] = 'include/footer';
            $data['title'] = 'List Tujuan Program Semester';
            $data['main_menu'] = 'program';
            $data['sub_menu'] = 'listTujuanProgramSemester';
            $this->load->view('index', $data);
        }
    }


    // Kompetensi Program Semester
    public function simpanKompetensiProgram()
    {
        $program = $this->ProgramModel;

        $this->form_validation->set_rules("goalID", "Kode Tujuan", 'required');
        // $this->form_validation->set_rules("kodeKompetensi", "Kode Kompetensi", 'required');
        // $this->form_validation->set_rules("descKompetensi", "Deskripsi Kompetensi", 'required');


        if ($this->form_validation->run() != false) {
            $goalID = $this->input->post('goalID');

            $kodeKompetensi = count($this->input->post("kodeKompetensi"));

            if ($kodeKompetensi > 0) {
                for ($i = 0; $i < $kodeKompetensi; $i++) {
                    if (trim($_POST["kodeKompetensi"][$i]) != '') {
                        $this->db->query("INSERT INTO TBL_PROMES_COMPETENCY(GOAL_ID,COMPETENCY_CODE,COMPETENCY_DESC) VALUES ('$goalID','" . $_POST['kodeKompetensi'][$i] . "','" . $_POST['descKompetensi'][$i] . "')");
                    }
                }
            }

            $this->session->set_flashdata('success', 'Berhasil disimpan');
            redirect("listKompetensiProgramSemester");
        } else {
            $this->session->set_flashdata('failed', 'Lengkapi Data');
            $data['head'] = 'include/head';
            $data['header'] = 'include/header';
            $data['menu'] = 'include/menu';
            $data['content'] = 'page/program/tambahKompetensiProgram';
            $data['footer'] = 'include/footer';
            $data['title'] = 'Tambah Kompetensi Program Semester';
            $data['main_menu'] = 'program';
            $data['sub_menu'] = 'tambahKompetensiProgramSemester';
            $this->load->view('index', $data);
        }
    }
    // Kompetensi Program Semester
    public function updateKompetensiProgram()
    {
        $program = $this->ProgramModel;


        $this->form_validation->set_rules("kodeKompetensi", "Kode Kompetensi", 'required');
        $this->form_validation->set_rules("descKompetensi", "Deskripsi Kompetensi", 'required');


        if ($this->form_validation->run() != false) {
            $kodeTujuan = $this->input->post('kodeTujuan');
            $kodeKompetensi = $this->input->post('kodeKompetensi');
            $descKompetensi = $this->input->post('descKompetensi');
            $idKompetensi = $this->input->post("kompetensiID");
            $data = array(

                'COMPETENCY_CODE' => $kodeKompetensi,
                'COMPETENCY_DESC' => $descKompetensi
            );
            $where = array(
                'COMPETENCY_ID' => $idKompetensi
            );
            $program->update_data($where, $data, 'TBL_PROMES_COMPETENCY');

            $this->session->set_flashdata('success', 'Berhasil Diedit');
            redirect("listKompetensiProgramSemester");
        } else {
            $this->session->set_flashdata('failed', 'Lengkapi Data');
            $data['head'] = 'include/head';
            $data['header'] = 'include/header';
            $data['menu'] = 'include/menu';
            $data['content'] = 'page/program/editKompetensiProgram';
            $data['footer'] = 'include/footer';
            $data['title'] = 'Edit Kompetensi Program Semester';
            $data['main_menu'] = 'program';
            $data['sub_menu'] = 'EditKompetensiProgramSemester';
            $this->load->view('index', $data);
        }
    }

    public function deleteProgram()
    {
        $id = $this->input->get("id");
        $result = $this->db->query("SELECT *FROM TBL_PROMES_SUBTHEME WHERE PROMES_ID='$id'")->num_rows();
        if ($result > 0) {
            $this->session->set_flashdata('failed', 'Data Gagal Dihapus');
        } else {
            $query = $this->db->delete('TBL_PROMES', ['PROMES_ID' => $id]);
            $this->session->set_flashdata('success', 'Berhasil Dihapus');
        }
        redirect('listProgramSemester');
    }

    public function deleteTemaProgram()
    {
        $id = $this->input->get("id");
        $result = $this->db->query("SELECT *FROM TBL_PROMES_GOAL WHERE SUBTHEME_ID='$id'")->num_rows();
        if ($result > 0) {
            $this->session->set_flashdata('failed', 'Data Gagal Dihapus');
        } else {
            $query = $this->db->delete('TBL_PROMES_SUBTHEME', ['SUBTHEME_ID' => $id]);
            $this->session->set_flashdata('success', 'Berhasil Dihapus');
        }
        redirect('listTemaProgramSemester');
    }

    public function deleteTujuanProgram()
    {
        $id = $this->input->get("id");
        $result = $this->db->query("SELECT *FROM TBL_PROMES_COMPETENCY WHERE GOAL_ID='$id'")->num_rows();
        if ($result > 0) {
            $this->session->set_flashdata('failed', 'Data Gagal Dihapus');
        } else {
            $query = $this->db->delete('TBL_PROMES_GOAL', ['GOAL_ID' => $id]);
            $this->session->set_flashdata('success', 'Berhasil Dihapus');
        }
        redirect('listTujuanProgramSemester');
    }

    public function deleteKompetensiProgram()
    {
        $id = $this->input->get("id");
        $query = $this->db->delete('TBL_PROMES_COMPETENCY', ['COMPETENCY_ID' => $id]);
        $this->session->set_flashdata('success', 'Berhasil Dihapus');
        redirect('listKompetensiProgramSemester');
    }


    // List Sub Theme


    // List Tema Program Semester

    public function listSubTemaProgram()
    {

        $data['query'] = $this->db->query("SELECT ps.SUBTHEME_NAME,pt.THEME_THEME,ps.SUBTHEME_ID,pt.THEME_iD FROM tbl_promes_subtheme ps
        INNER JOIN tbl_promes_theme pt ON pt.THEME_ID=ps.THEME_ID")->result_array();
        $data['head'] = 'include/head';
        $data['header'] = 'include/header';
        $data['menu'] = 'include/menu';
        $data['content'] = 'page/program/listSubTemaProgram';
        $data['footer'] = 'include/footer';
        $data['title'] = 'List Tema Program Semester';
        $data['main_menu'] = 'program';
        $data['sub_menu'] = 'listSubTemaProgramSemester';
        $this->load->view('index', $data);
    }

    public function tambahSubTemaProgram()
    {
        $data['query'] = $this->db->query("SELECT pt.*, ps.* FROM TBL_PROMES_SUBTHEME ps  INNER JOIN TBL_PROMES_THEME pt ON pt.THEME_ID=pt.THEME_ID")->result_array();
        $data['queryTheme'] = $this->ProgramModel->getDataTheme();
        $data['head'] = 'include/head';
        $data['header'] = 'include/header';
        $data['menu'] = 'include/menu';
        $data['content'] = 'page/program/tambahSubTemaProgram';
        $data['footer'] = 'include/footer';
        $data['title'] = 'Tambah Sub Tema Program Semester';
        $data['main_menu'] = 'program';
        $data['sub_menu'] = 'tambahSubTemaProgramSemester';
        $this->load->view('index', $data);
    }


    public function simpanSubTemaProgram()
    {


        $this->form_validation->set_rules("themeID", "Tema Program Semester", 'required');
        // $this->form_validation->set_rules("subTemaPromes", "SubTema Program Semester", 'required');


        if ($this->form_validation->run() != false) {
            $subTemaPromes = count($this->input->post("subTemaPromes"));
            $themeID = $this->input->post('themeID');

            if ($subTemaPromes > 0) {
                for ($i = 0; $i < $subTemaPromes; $i++) {
                    if (trim($_POST["subTemaPromes"][$i]) != '') {
                        $this->db->query("INSERT INTO TBL_PROMES_SUBTHEME(THEME_ID,SUBTHEME_NAME) VALUES ('$themeID','" . $_POST['subTemaPromes'][$i] . "')");
                    }
                }
            }

            $this->session->set_flashdata('success', 'Berhasil disimpan');
            redirect("listSubTemaProgramSemester");
        } else {
            $this->session->set_flashdata('failed', 'Lengkapi Data');
            redirect("tambahSubTemaProgramSemester");
        }
    }

    public function updateSubTemaProgram()
    {


        $program = $this->ProgramModel;
        $this->form_validation->set_rules("subTemaPromes", "Sub Tema Program Semester", 'required');

        if ($this->form_validation->run() != false) {
            $themeID = $this->input->post('themeID');
            $subThemeID = $this->input->post('subThemeID');
            $subTemaPromes = $this->input->post('subTemaPromes');
            $data = array(
                'SUBTHEME_NAME' => $subTemaPromes
            );
            $where = array(
                "SUBTHEME_ID" => $subThemeID
            );
            $program->update_data($where, $data, 'TBL_PROMES_SUBTHEME');

            $this->session->set_flashdata('success', 'Berhasil Diedit');
            redirect("listSubTemaProgramSemester");
        } else {
            $this->session->set_flashdata('failed', 'Lengkapi Data');
            $data['head'] = 'include/head';
            $data['header'] = 'include/header';
            $data['menu'] = 'include/menu';
            $data['content'] = 'page/program/tambahSubTemaProgram';
            $data['footer'] = 'include/footer';
            $data['title'] = 'Edit Tema Program Semester';
            $data['main_menu'] = 'program';
            $data['sub_menu'] = 'editSubTemaProgramSemester';
            $this->load->view('index', $data);
        }
    }



    function fetchTemaPromes()
    {
        $output = '';
        $query = '';

        if ($this->input->post('query')) {
            $query = $this->input->post('query');
        }
        $data = $this->db->query("SELECT
        tbl_promes.*,tbl_promes.CLASS_ID as classPromes,tbl_promes.PROMES_ID as promesid,
            tbl_schoolclass.CLASS_LEVEL,tbl_schoolclass.CLASS_NAME,tbl_promes_theme.*
        FROM
            tbl_promes
            INNER JOIN
            tbl_schoolclass
            ON 
                tbl_promes.CLASS_ID = tbl_schoolclass.CLASS_ID
            INNER JOIN
            tbl_promes_theme
            ON 
                tbl_promes.PROMES_ID = tbl_promes_theme.PROMES_ID WHERE tbl_promes_theme.PROMES_ID='$query'");

        $output .= '
        
            <table class="table table-hover" id="example" >
            <tr>
            <th></th>
            <th>No</th>
            <th>Tema</th>
            <th>Evaluasi Penilaian Bulan</th>
            <th>Alokasi Waktu</th>
            <th>Aksi</th>
            </tr>
        ';
        if ($data->num_rows() > 0) {
            $no = 1;
            foreach ($data->result() as $row) {
                $output .= '
      <tr>
      <td>
        
            <input type="checkbox" name="' . $row->THEME_ID . '">
        
      </td>
       <td>' . $no++ . '</td>
       <td>' . $row->THEME_THEME . '</td>
       <td>' . $row->THEME_MONTHLY_EVALUATION . '</td>
       <td>' . $row->THEME_TIME_ALLOCATION . '</td>
       <td> <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal_edit' . $row->THEME_ID . '">Edit</button></td>
      </tr>
    ';
            }
        } else {
            $output .= '<tr>
       <td colspan="4">No Data Found</td>
      </tr>';
        }
        $output .= '</table>
    <button style="text-align:right;display: none;" class="btn btn-primary mr-1" id="btnTambah" data-toggle="modal" data-target="#modal_tambah">Tambah Data</button> <button class="btn btn-danger">Hapus Data</button>
        ';
        echo $output;
    }




    function fetchSubTemaPromes()
    {
        $output = '';
        $query = '';

        if ($this->input->post('query')) {
            $query = $this->input->post('query');
        }
        $data = $this->db->query("SELECT
        tbl_promes_theme.*,tbl_promes_subtheme.*,tbl_promes_subtheme.THEME_ID as temaID
        FROM
            tbl_promes_subtheme
            INNER JOIN
            tbl_promes_theme
            ON 
                tbl_promes_theme.THEME_ID = tbl_promes_subtheme.THEME_ID WHERE tbl_promes_subtheme.THEME_ID='$query'");

        $output .= '
        
            <table class="table table-hover" id="example" >
            <tr>
            <th></th>
            <th>No</th>
            <th>Sub Tema</th>
            <th>Aksi</th>
            </tr>
        ';
        if ($data->num_rows() > 0) {
            $no = 1;
            foreach ($data->result() as $row) {
                $output .= '
      <tr>
      <td>
        
            <input type="checkbox" name="' . $row->SUBTHEME_ID . '">
        
      </td>
       <td>' . $no++ . '</td>
       <td>' . $row->SUBTHEME_NAME . '</td>
       <td> <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal_edit' . $row->SUBTHEME_ID . '">Edit</button></td>
      </tr>
    ';
            }
        } else {
            $output .= '<tr>
       <td colspan="4">No Data Found</td>
      </tr>';
        }
        $output .= '</table>
    <button style="text-align:right;display: none;" class="btn btn-primary mr-1" id="btnTambah" data-toggle="modal" data-target="#modal_tambah">Tambah Data</button> <button class="btn btn-danger">Hapus Data</button>
        ';
        echo $output;
    }


    function fetchTujuanPromes()
    {
        $output = '';
        $query = '';

        if ($this->input->post('query')) {
            $query = $this->input->post('query');
        }
        $data = $this->db->query("SELECT
        tbl_promes_goal.*,tbl_promes_subtheme.*        
        FROM
            tbl_promes_goal
            INNER JOIN
            tbl_promes_subtheme
            ON 
            tbl_promes_subtheme.SUBTHEME_ID = tbl_promes_goal.SUBTHEME_ID WHERE tbl_promes_goal.SUBTHEME_ID='$query'");
        // $data = $this->db->query("SELECT
        // tbl_promes_goal.*,tbl_promes_subtheme.*        
        // FROM
        //     tbl_promes_goal
        //     INNER JOIN
        //     tbl_promes_subtheme
        //     ON 
        //     tbl_promes_subtheme.SUBTHEME_ID = tbl_promes_goal.SUBTHEME_ID WHERE tbl_promes_goal.SUBTHEME_ID='$query'");

        $output .= '
        
            <table class="table table-hover" id="example" >
            <tr>
            <th></th>
            <th>No</th>
            <th>Deskripsi Pencapaian</th>
            <th>Aksi</th>
            </tr>
        ';
        if ($data->num_rows() > 0) {
            $no = 1;
            foreach ($data->result() as $row) {
                $output .= '
      <tr>
      <td>
        
            <input type="checkbox" name="' . $row->GOAL_ID . '">
        
      </td>
       <td>' . $no++ . '</td>
       <td>' . $row->GOAL_DESC . '</td>
       <td> <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal_edit' . $row->GOAL_ID . '">Edit</button></td>
      </tr>
    ';
            }
        } else {
            $output .= '<tr>
       <td colspan="4">No Data Found</td>
      </tr>';
        }
        $output .= '</table>
    <button style="text-align:right;display: none;" class="btn btn-primary mr-1" id="btnTambah" data-toggle="modal" data-target="#modal_tambah">Tambah Data</button> <button class="btn btn-danger">Hapus Data</button>
        ';
        echo $output;
    }



    // Kompetensi Dasar
    function fetchKompetensiDasar()
    {
        $output = '';
        $query = '';

        if ($this->input->post('query')) {
            $query = $this->input->post('query');
        }
        $data = $this->db->query("SELECT
        tbl_promes_competency.*,tbl_promes_goal.*        
        FROM
            tbl_promes_competency
            INNER JOIN
            tbl_promes_goal
            ON 
            tbl_promes_goal.GOAL_ID = tbl_promes_competency.GOAL_ID WHERE tbl_promes_competency.GOAL_ID='$query'");

        $output .= '
        
            <table class="table table-hover" id="example" >
            <tr>
            <th></th>
            <th>No</th>
            <th>Kode Kompetensi</th>
            <th>Kompetensi Dasar</th>
            <th>Aksi</th>
            </tr>
        ';
        if ($data->num_rows() > 0) {
            $no = 1;
            foreach ($data->result() as $row) {
                $output .= '
      <tr>
      <td>
        
            <input type="checkbox" name="' . $row->COMPETENCY_ID . '">
        
      </td>
       <td>' . $no++ . '</td>
       <td>' . $row->COMPETENCY_CODE . '</td>
       <td>' . $row->COMPETENCY_DESC . '</td>
       <td> <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal_edit' . $row->COMPETENCY_ID . '">Edit</button></td>
      </tr>
    ';
            }
        } else {
            $output .= '<tr>
       <td colspan="4">No Data Found</td>
      </tr>';
        }
        $output .= '</table>
    <button style="text-align:right;display: none;" class="btn btn-primary mr-1" id="btnTambah" data-toggle="modal" data-target="#modal_tambah">Tambah Data</button> <button class="btn btn-danger">Hapus Data</button>
        ';
        echo $output;
    }
}
