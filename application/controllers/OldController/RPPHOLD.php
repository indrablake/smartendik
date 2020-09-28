<?php
defined('BASEPATH') or exit('No direct script access allowed');

class RPPH extends CI_Controller
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
     * @see https://codeigniter.com/RPPH_guide/general/urls.html
     */


    public function __construct()
    {
        parent::__construct();
        $this->load->model("RPPHModel");
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
        $data['main_menu'] = 'RPPH';
        $data['sub_menu'] = 'home';
        $this->load->view('index', $data);
    }
    public function listRPPH()
    {
        $data['query'] = $this->db->query("SELECT sc.CLASS_ID,sc.CLASS_NAME, r.* FROM TBL_RPPH r INNER JOIN TBL_SCHOOLCLASS sc ON sc.CLASS_ID=r.CLASS_ID")->result_array();
        $data['head'] = 'include/head';
        $data['header'] = 'include/header';
        $data['menu'] = 'include/menu';
        $data['content'] = 'page/RPPH/listRPPH';
        $data['footer'] = 'include/footer';
        $data['title'] = 'Daftar RPPH';
        $data['main_menu'] = 'RPPH';
        $data['sub_menu'] = 'listRPPH';
        $this->load->view('index', $data);
    }

    public function tambahRPPH()
    {
        $data['head'] = 'include/head';
        $data['header'] = 'include/header';
        $data['menu'] = 'include/menu';
        $data['content'] = 'page/RPPH/tambahRPPH';
        $data['footer'] = 'include/footer';
        $data['title'] = 'Tambah RPPH ';
        $data['main_menu'] = 'RPPH';
        $data['sub_menu'] = 'tambahRPPH';
        $this->load->view('index', $data);
    }

    public function editRPPH()
    {
        $id = $this->input->get("id");
        $data['isi_value'] = $this->RPPHModel->getData($id);
        $data['head'] = 'include/head';
        $data['header'] = 'include/header';
        $data['menu'] = 'include/menu';
        $data['content'] = 'page/RPPH/editRPPH';
        $data['footer'] = 'include/footer';
        $data['title'] = 'Edit RPPH ';
        $data['main_menu'] = 'RPPH';
        $data['sub_menu'] = 'editRPPH';
        $this->load->view('index', $data);
    }

    public function simpanRPPH()
    {

        $RPPH = $this->RPPHModel;
        $this->form_validation->set_rules("kelasID", "Nama Kelas", 'required');
        $this->form_validation->set_rules("tahunRPPH", "Tahun RPPH", 'required');
        $this->form_validation->set_rules("semesterRPPH", "RPPH Semester", 'required');
        $this->form_validation->set_rules("bulanRPPH", "Bulan", 'required');

        $this->form_validation->set_rules("mingguRPPH", "Minggu", 'required');
        $this->form_validation->set_rules("temaRPPH", "Tema", 'required');
        $this->form_validation->set_rules("subTemaRPPH", "SubTema ", 'required');
        $this->form_validation->set_rules("strategiRPPH", "Strategi RPPH", 'required');

        if ($this->form_validation->run() != false) {
            $kelasID = $this->input->post('kelasID');
            $tahunRPPH1 = $this->input->post('tahunRPPH');
            $tahunRPPH2 = intval($tahunRPPH1) + 1;

            $tahunRPPH = $tahunRPPH1 . '/' . $tahunRPPH2;


            $bulanRPPH = $this->input->post('bulanRPPH');
            $mingguRPPH = $this->input->post('mingguRPPH');
            $temaRPPH = $this->input->post('temaRPPH');
            $subTemaRPPH = $this->input->post('subTemaRPPH');
            $strategiRPPH = $this->input->post('strategiRPPH');
            $semesterRPPH = $this->input->post('semesterRPPH');


            $data = array(
                'CLASS_ID' => $kelasID,
                'RPPH_STUDYYEAR' => $tahunRPPH,
                'RPPH_SEMESTER' => $semesterRPPH,
                'RPPH_MONTH' => $bulanRPPH,
                'RPPH_THEME' => $temaRPPH,
                'RPPH_SUBTHEME' => $subTemaRPPH,
                'RPPH_WEEK' => $mingguRPPH,
                'RPPH_STRATEGY' => $strategiRPPH
            );
            $RPPH->input_data($data, 'TBL_RPPH');
            $this->session->set_flashdata('success', 'Berhasil disimpan');

            redirect("listRPPH");
        } else {
            $this->session->set_flashdata('success', 'Gagal disimpan');
            $data['head'] = 'include/head';
            $data['header'] = 'include/header';
            $data['menu'] = 'include/menu';
            $data['content'] = 'page/RPPH/tambahRPPH';
            $data['footer'] = 'include/footer';
            $data['title'] = 'Tambah RPPH ';
            $data['main_menu'] = 'RPPH';
            $data['sub_menu'] = 'tambahRPPH';
            $this->load->view('index', $data);
        }
    }

    public function updateRPPH()
    {

        $RPPH = $this->RPPHModel;
        $this->form_validation->set_rules("kelasID", "Nama Kelas", 'required');
        $this->form_validation->set_rules("tahunRPPH", "Tahun RPPH", 'required');
        $this->form_validation->set_rules("semesterRPPH", "RPPH Semester", 'required');
        $this->form_validation->set_rules("bulanRPPH", "Bulan", 'required');

        $this->form_validation->set_rules("mingguRPPH", "Minggu", 'required');
        $this->form_validation->set_rules("temaRPPH", "Tema", 'required');
        $this->form_validation->set_rules("subTemaRPPH", "SubTema ", 'required');
        $this->form_validation->set_rules("strategiRPPH", "Strategi RPPH", 'required');


        if ($this->form_validation->run() != false) {

            $kelasID = $this->input->post('kelasID');
            $tahunRPPH = $this->input->post('tahunRPPH');
            $semesterRPPH = $this->input->post('semesterRPPH');
            $bulanRPPH = $this->input->post('bulanRPPH');
            $mingguRPPH = $this->input->post('mingguRPPH');
            $temaRPPH = $this->input->post('temaRPPH');
            $subTemaRPPH = $this->input->post('subTemaRPPH');
            $strategiRPPH = $this->input->post('strategiRPPH');
            $RPPHID = $this->input->post("RPPHID");

            $where = array(
                "RPPH_ID" => $RPPHID
            );
            $data = array(
                'CLASS_ID' => $kelasID,
                'RPPH_STUDYYEAR' => $tahunRPPH,
                'RPPH_SEMESTER' => $semesterRPPH,
                'RPPH_MONTH' => $bulanRPPH,
                'RPPH_THEME' => $temaRPPH,
                'RPPH_SUBTHEME' => $subTemaRPPH,
                'RPPH_WEEK' => $mingguRPPH,
                'RPPH_STRATEGY' => $strategiRPPH
            );
            $RPPH->update_data($where, $data, 'TBL_RPPH');
            $this->session->set_flashdata('success', 'Berhasil Diedit');

            redirect("listRPPH");
        } else {
            $this->session->set_flashdata('success', 'Gagal Diedit');
            $data['head'] = 'include/head';
            $data['header'] = 'include/header';
            $data['menu'] = 'include/menu';
            $data['content'] = 'page/RPPH/tambahRPPH';
            $data['footer'] = 'include/footer';
            $data['title'] = 'Tambah RPPH ';
            $data['main_menu'] = 'RPPH';
            $data['sub_menu'] = 'tambahRPPH';
            $this->load->view('index', $data);
        }
    }

    // RPPH Activity
    public function listRPPHActivity()
    {
        $data['query'] = $this->db->query("SELECT r.*,ra.*,sc.CLASS_LEVEL,sc.CLASS_NAME,s.SCH_NAME FROM TBL_RPPHACTIVITY ra 
        INNER JOIN TBL_RPPH r ON ra.RPPH_ID=r.RPPH_ID
        INNER JOIN TBL_SCHOOLCLASS sc ON sc.CLASS_ID=r.CLASS_ID
        INNER JOIN TBL_SCHOOL s ON s.SCH_ID=sc.SCH_ID")->result_array();
        $data['head'] = 'include/head';
        $data['header'] = 'include/header';
        $data['menu'] = 'include/menu';
        $data['content'] = 'page/RPPH/listRPPHActivity';
        $data['footer'] = 'include/footer';
        $data['title'] = 'Daftar RPPH ActivKegiatanity';
        $data['main_menu'] = 'RPPH';
        $data['sub_menu'] = 'listRPPHActivity';
        $this->load->view('index', $data);
    }

    public function tambahRPPHActivity()
    {
        $data['query'] = $this->db->query("SELECT r.RPPH_ID,sc.CLASS_NAME,sc.CLASS_LEVEL,school.SCH_NAME,ra.* FROM TBL_RPPHACTIVITY ra 
        INNER JOIN TBL_RPPH r ON ra.RPPH_ID=r.RPPH_ID
        INNER JOIN TBL_SCHOOLCLASS sc ON sc.CLASS_ID=r.CLASS_ID
        INNER JOIN TBL_SCHOOL school ON school.SCH_ID=sc.SCH_ID")->result_array();

        $data['query2'] = $this->db->query("SELECT r.RPPH_ID,sc.CLASS_NAME,sc.CLASS_LEVEL,school.SCH_NAME,ra.* FROM TBL_RPPHACTIVITY ra 
INNER JOIN TBL_RPPH r ON ra.RPPH_ID=r.RPPH_ID
INNER JOIN TBL_SCHOOLCLASS sc ON sc.CLASS_ID=r.CLASS_ID
INNER JOIN TBL_SCHOOL school ON school.SCH_ID=sc.SCH_ID")->result_array();

        $data['queryDetail'] = $this->db->query("SELECT rad.*,r.RPPH_ID,r.RPPHACTIVITY_ID,r.RPPHACTIVITY_NAME FROM `tbl_rpphactdetail` as rad INNER JOIN tbl_rpphactivity r 
        ON r.RPPHACTIVITY_ID=rad.RPPHACTIVITY_ID")->row();
        $data['head'] = 'include/head';
        $data['header'] = 'include/header';
        $data['menu'] = 'include/menu';
        $data['content'] = 'page/RPPH/tambahRPPHActivity';
        $data['footer'] = 'include/footer';
        $data['title'] = 'Tambah RPPH Kegiatan';
        $data['main_menu'] = 'RPPH';
        $data['sub_menu'] = 'tambahRPPHActivity';
        $this->load->view('index', $data);
    }

    public function editRPPHActivity()
    {
        $id = $this->input->get("id");
        $data['isi_value'] = $this->RPPHModel->getData($id);
        $data['head'] = 'include/head';
        $data['header'] = 'include/header';
        $data['menu'] = 'include/menu';
        $data['content'] = 'page/RPPH/editRPPHActivity';
        $data['footer'] = 'include/footer';
        $data['title'] = 'Edit RPPH Activity';
        $data['main_menu'] = 'RPPH';
        $data['sub_menu'] = 'editRPPHActivity';
        $this->load->view('index', $data);
    }

    public function simpanDetailRPPHActivity()
    {

        $RPPH = $this->RPPHModel;
        $this->form_validation->set_rules("RPPHActivityID", "RPPH Activity ID", 'required');
        if ($this->form_validation->run() != false) {
            $aktifitasDetail = count($this->input->post("aktifitasDetail"));
            $idActivity = $this->input->post('RPPHActivityID');
            $result2 = $this->db->query("SELECT *FROM TBL_RPPHACTDETAIL WHERE RPPHACTIVITY_ID=$idActivity ORDER BY RPPHACTDETAIL_INDEX DESC LIMIT 1")->row();
            if ($aktifitasDetail > 0) {
                $result = intval($result2->RPPHACTDETAIL_INDEX);
                for ($i = 0; $i < $aktifitasDetail; $i++) {
                    $result += 1;
                    if (trim($_POST["aktifitasDetail"][$i]) != '') {
                        $RPPHID = $this->input->post('RPPHID');
                        $this->db->query("INSERT INTO TBL_RPPHACTDETAIL(RPPHACTIVITY_ID,RPPHACTDETAIL_INDEX,RPPHACTDETAIL_DESC) VALUES ('$idActivity',$result,'" . $_POST['aktifitasDetail'][$i] . "')");
                    }
                }
            }
            $this->session->set_flashdata('success', 'Berhasil Ditambahkan');

            redirect("listRPPHActivity");
        } else {
            $this->session->set_flashdata('success', 'Gagal disimpan');
            $data['head'] = 'include/head';
            $data['header'] = 'include/header';
            $data['menu'] = 'include/menu';
            $data['content'] = 'page/RPPH/tambahRPPHActivity';
            $data['footer'] = 'include/footer';
            $data['title'] = 'Tambah RPPH Kegiatan';
            $data['main_menu'] = 'RPPH';
            $data['sub_menu'] = 'tambahRPPHActivity';
            $this->load->view('index', $data);
        }
    }

    function delete_detail_activity()
    {
        $activityIndex = $this->input->post('activityIndex');
        $this->db->where('RPPHACTDETAIL_INDEX', $activityIndex);
        $result = $this->db->delete('TBL_RPPHACTDETAIL');
        return $result;
    }

    public function simpanRPPHActivity()
    {

        $RPPH = $this->RPPHModel;
        $this->form_validation->set_rules("RPPHID", "RPPH ID", 'required');
        $this->form_validation->set_rules("activityName", "Activity Name", 'required');
        $this->form_validation->set_rules("activityTime", "Activity Time", 'required');
        $this->form_validation->set_rules("activityTime2", "Activity Time", 'required');


        if ($this->form_validation->run() != false) {

            $RPPHID = $this->input->post('RPPHID');
            $activityName = $this->input->post('activityName');
            $activityTime1 = $this->input->post('activityTime');
            $activityTime2 = $this->input->post('activityTime2');
            $aktifitas = count($this->input->post("aktifitas"));
            $index = $this->db->query("SELECT *FROM TBL_RPPHACTDETAIL WHERE RPPHACTIVITY_ID=$RPPHID ORDER BY RPPHACTDETAIL_INDEX DESC LIMIT 1")->num_rows();
            $result2 = $this->db->query("SELECT *FROM TBL_RPPHACTDETAIL WHERE RPPHACTIVITY_ID=$RPPHID ORDER BY RPPHACTDETAIL_INDEX DESC LIMIT 1")->row();


            $waktu = str_replace(['.', ':', ' AM', ' PM', ' '], ['', '', '', '', ''], $activityTime1);
            $waktu2 = str_replace(['.', ':', ' AM', ' PM', ' '], ['', '', '', '', ''], $activityTime2);
            if (strlen($waktu) == 3) {
                $waktu = '0' . $waktu;
            }
            if (strlen($waktu2) == 3) {
                $waktu2 = '0' . $waktu2;
            }
            $activityTime = $waktu . $waktu2;

            $data = array(
                'RPPH_ID' => $RPPHID,
                'RPPHACTIVITY_NAME' => $activityName,
                'RPPHACTIVITY_TIME' => $activityTime
            );
            $RPPH->input_data($data, 'TBL_RPPHACTIVITY');
            $activityQuery = $this->db->query("SELECT *FROM TBL_RPPHACTIVITY ORDER BY RPPHACTIVITY_ID DESC LIMIT 1")->row();
            $idActivity = $activityQuery->RPPHACTIVITY_ID;
            if ($aktifitas > 0) {
                $result = intval($result2->RPPHACTDETAIL_INDEX);
                for ($i = 0; $i < $aktifitas; $i++) {
                    $result += 1;
                    if (trim($_POST["aktifitas"][$i]) != '') {
                        $RPPHID = $this->input->post('RPPHID');
                        $this->db->query("INSERT INTO TBL_RPPHACTDETAIL(RPPHACTIVITY_ID,RPPHACTDETAIL_INDEX,RPPHACTDETAIL_DESC) VALUES ('$idActivity',$result,'" . $_POST['aktifitas'][$i] . "')");
                    }
                }
            }
            $this->session->set_flashdata('success', 'Berhasil disimpan');

            redirect("listRPPHActivity");
        } else {
            $this->session->set_flashdata('success', 'Gagal disimpan');
            $data['head'] = 'include/head';
            $data['header'] = 'include/header';
            $data['menu'] = 'include/menu';
            $data['content'] = 'page/RPPH/tambahRPPHActivity';
            $data['footer'] = 'include/footer';
            $data['title'] = 'Tambah RPPH Kegiatan';
            $data['main_menu'] = 'RPPH';
            $data['sub_menu'] = 'tambahRPPHActivity';
            $this->load->view('index', $data);
        }
    }

    public function updateRPPHActivity()
    {


        $RPPH = $this->RPPHModel;
        $this->form_validation->set_rules("RPPHID", "RPPH ID", 'required');
        $this->form_validation->set_rules("activityName", "Activity Name", 'required');
        $this->form_validation->set_rules("activityTime", "Activity Time", 'required');


        if ($this->form_validation->run() != false) {

            $RPPHID = $this->input->post('RPPHID');
            $activityName = $this->input->post('activityName');
            $activityTime = $this->input->post('activityTime');

            $data = array(
                'RPPH_ID' => $RPPHID,
                'RPPHACTIVITY_NAME' => $activityName,
                'RPPHACTIVITY_TIME' => $activityTime
            );
            $RPPHActivityID = $this->input->post("RPPHActivityID");
            $where = array("RPPHACTIVITY_ID" => $RPPHActivityID);
            $RPPH->update_data($where, $data, 'TBL_RPPHACTIVITY');



            $this->session->set_flashdata('success', 'Berhasil disimpan');

            redirect("listRPPHActivity");
        } else {
            $this->session->set_flashdata('success', 'Gagal disimpan');
            $data['head'] = 'include/head';
            $data['header'] = 'include/header';
            $data['menu'] = 'include/menu';
            $data['content'] = 'page/RPPH/tambahRPPHActivity';
            $data['footer'] = 'include/footer';
            $data['title'] = 'Tambah RPPH Kegiatan';
            $data['main_menu'] = 'RPPH';
            $data['sub_menu'] = 'tambahRPPHActivity';
            $this->load->view('index', $data);
        }
    }


    // RPPH Learning
    // RPPH Activity
    public function listRPPHLearning()
    {
        $data['query'] = $this->db->query("SELECT r.*,rl.*,sc.CLASS_LEVEL,sc.CLASS_NAME,s.SCH_NAME FROM TBL_RPPHLEARNING rl 
        INNER JOIN TBL_RPPH r ON rl.RPPH_ID=r.RPPH_ID
        INNER JOIN TBL_SCHOOLCLASS sc ON sc.CLASS_ID=r.CLASS_ID
        INNER JOIN TBL_SCHOOL s ON s.SCH_ID=sc.SCH_ID")->result_array();
        $data['head'] = 'include/head';
        $data['header'] = 'include/header';
        $data['menu'] = 'include/menu';
        $data['content'] = 'page/RPPH/listRPPHLearning';
        $data['footer'] = 'include/footer';
        $data['title'] = 'Daftar RPPH Pembelajaran';
        $data['main_menu'] = 'RPPH';
        $data['sub_menu'] = 'listRPPHLearning';
        $this->load->view('index', $data);
    }

    public function tambahRPPHLearning()
    {
        $data['query'] = $this->db->query("SELECT r.*,rl.*,sc.CLASS_LEVEL,sc.CLASS_NAME,s.SCH_NAME FROM TBL_RPPHLEARNING rl 
        INNER JOIN TBL_RPPH r ON rl.RPPH_ID=r.RPPH_ID
        INNER JOIN TBL_SCHOOLCLASS sc ON sc.CLASS_ID=r.CLASS_ID
        INNER JOIN TBL_SCHOOL s ON s.SCH_ID=sc.SCH_ID")->result_array();
        $data['head'] = 'include/head';
        $data['header'] = 'include/header';
        $data['menu'] = 'include/menu';
        $data['content'] = 'page/RPPH/tambahRPPHLearning';
        $data['footer'] = 'include/footer';
        $data['title'] = 'Tambah RPPH Pembelajaran';
        $data['main_menu'] = 'RPPH';
        $data['sub_menu'] = 'tambahRPPHLearning';
        $this->load->view('index', $data);
    }

    public function editRPPHLearning()
    {
        $id = $this->input->get("id");
        $data['isi_value'] = $this->RPPHModel->getData($id);
        $data['head'] = 'include/head';
        $data['header'] = 'include/header';
        $data['menu'] = 'include/menu';
        $data['content'] = 'page/RPPH/editRPPHLearning';
        $data['footer'] = 'include/footer';
        $data['title'] = 'Edit RPPH Pembelajaran';
        $data['main_menu'] = 'RPPH';
        $data['sub_menu'] = 'editRPPHLearning';
        $this->load->view('index', $data);
    }

    public function simpanRPPHLearning()
    {

        $RPPH = $this->RPPHModel;
        $this->form_validation->set_rules("RPPHID", "RPPH ID", 'required');
        // $this->form_validation->set_rules("kodeLearning", "Kode Learning", 'required');
        // $this->form_validation->set_rules("teoriLearning", "Teori Learning", 'required');
        // $this->form_validation->set_rules("tujuanLearning", "Tujuan Learning", 'required');


        if ($this->form_validation->run() != false) {

            $RPPHID = $this->input->post('RPPHID');
            $kodeLearning = count($this->input->post('kodeLearning'));
            $teoriLearning = count($this->input->post('teoriLearning'));
            $tujuanLearning = count($this->input->post('tujuanLearning'));


            // $data = array(
            //     'RPPH_ID' => $RPPHID,
            //     'RPPHLearning_CODE' => $kodeLearning,
            //     'RPPHLearning_THEORY' => $teoriLearning,
            //     'RPPHLearning_GOAL' => $tujuanLearning
            // );
            // $RPPH->input_data($data, 'TBL_RPPHLearning');

            if ($kodeLearning > 0 && $teoriLearning > 0 && $tujuanLearning > 0) {
                for ($i = 0; $i < $kodeLearning; $i++) {
                    if (trim($_POST["kodeLearning"][$i]) != '') {
                        $RPPHID = $this->input->post('RPPHID');
                        $this->db->query("INSERT INTO TBL_RPPHLearning(RPPH_ID,RPPHLearning_CODE,RPPHLearning_THEORY,RPPHLearning_GOAL) VALUES ('$RPPHID','" . $_POST['kodeLearning'][$i] . "','" . $_POST['teoriLearning'][$i] . "','" . $_POST['tujuanLearning'][$i] . "')");
                    }
                }
            }

            $this->session->set_flashdata('success', 'Berhasil disimpan');

            redirect("listRPPHLearning");
        } else {
            $this->session->set_flashdata('success', 'Gagal disimpan');
            $data['head'] = 'include/head';
            $data['header'] = 'include/header';
            $data['menu'] = 'include/menu';
            $data['content'] = 'page/RPPH/tambahRPPHLearning';
            $data['footer'] = 'include/footer';
            $data['title'] = 'Tambah RPPH Pembelajaran';
            $data['main_menu'] = 'RPPH';
            $data['sub_menu'] = 'tambahRPPHLearning';
            $this->load->view('index', $data);
        }
    }

    public function updateRPPHLearning()
    {

        $RPPH = $this->RPPHModel;
        $this->form_validation->set_rules("RPPHID", "RPPH ID", 'required');
        $this->form_validation->set_rules("kodeLearning", "Kode Learning", 'required');
        $this->form_validation->set_rules("teoriLearning", "Teori Learning", 'required');
        $this->form_validation->set_rules("tujuanLearning", "Tujuan Learning", 'required');


        if ($this->form_validation->run() != false) {

            $RPPHID = $this->input->post('RPPHID');
            $kodeLearning = $this->input->post('kodeLearning');
            $teoriLearning = $this->input->post('teoriLearning');
            $tujuanLearning = $this->input->post('tujuanLearning');

            $data = array(
                'RPPH_ID' => $RPPHID,
                'RPPHLearning_CODE' => $kodeLearning,
                'RPPHLearning_THEORY' => $teoriLearning,
                'RPPHLearning_GOAL' => $tujuanLearning
            );

            $RPPHLearningID = $this->input->post("RPPHLearningID");
            $where = array("RPPHLEARNING_ID" => $RPPHLearningID);
            $RPPH->update_data($where, $data, 'TBL_RPPHLearning');
            $this->session->set_flashdata('success', 'Berhasil Diedit');

            redirect("listRPPHLearning");
        } else {
            $this->session->set_flashdata('success', 'Gagal Diedit');
            $data['head'] = 'include/head';
            $data['header'] = 'include/header';
            $data['menu'] = 'include/menu';
            $data['content'] = 'page/RPPH/listRPPHLearning';
            $data['footer'] = 'include/footer';
            $data['title'] = 'Daftar RPPH Learning';
            $data['main_menu'] = 'RPPH';
            $data['sub_menu'] = 'listRPPHLearning';
            $this->load->view('index', $data);
        }
    }








    // RPPH Material
    public function listRPPHMaterial()
    {
        $data['query'] = $this->db->query("SELECT r.*,rm.*,sc.CLASS_LEVEL,sc.CLASS_NAME,s.SCH_NAME FROM TBL_RPPHMATERIAL rm 
        INNER JOIN TBL_RPPH r ON rm.RPPH_ID=r.RPPH_ID
        INNER JOIN TBL_SCHOOLCLASS sc ON sc.CLASS_ID=r.CLASS_ID
        INNER JOIN TBL_SCHOOL s ON s.SCH_ID=sc.SCH_ID")->result_array();
        $data['head'] = 'include/head';
        $data['header'] = 'include/header';
        $data['menu'] = 'include/menu';
        $data['content'] = 'page/RPPH/listRPPHMaterial';
        $data['footer'] = 'include/footer';
        $data['title'] = 'Daftar RPPH Bahan Pembelajaran';
        $data['main_menu'] = 'RPPH';
        $data['sub_menu'] = 'listRPPHMaterial';
        $this->load->view('index', $data);
    }

    public function tambahRPPHMaterial()
    {
        $data['query'] = $this->db->query("SELECT r.*,rm.*,sc.CLASS_LEVEL,sc.CLASS_NAME,s.SCH_NAME FROM TBL_RPPHMATERIAL rm 
        INNER JOIN TBL_RPPH r ON rm.RPPH_ID=r.RPPH_ID
        INNER JOIN TBL_SCHOOLCLASS sc ON sc.CLASS_ID=r.CLASS_ID
        INNER JOIN TBL_SCHOOL s ON s.SCH_ID=sc.SCH_ID")->result_array();
        $data['head'] = 'include/head';
        $data['header'] = 'include/header';
        $data['menu'] = 'include/menu';
        $data['content'] = 'page/RPPH/tambahRPPHMaterial';
        $data['footer'] = 'include/footer';
        $data['title'] = 'Tambah RPPH Bahan Pembelajaran';
        $data['main_menu'] = 'RPPH';
        $data['sub_menu'] = 'tambahRPPHMaterial';
        $this->load->view('index', $data);
    }

    public function editRPPHMaterial()
    {
        $id = $this->input->get("id");
        $data['isi_value'] = $this->RPPHModel->getData($id);
        $data['head'] = 'include/head';
        $data['header'] = 'include/header';
        $data['menu'] = 'include/menu';
        $data['content'] = 'page/RPPH/editRPPHMaterial';
        $data['footer'] = 'include/footer';
        $data['title'] = 'Edit RPPH Bahan Pembelajaran';
        $data['main_menu'] = 'RPPH';
        $data['sub_menu'] = 'editRPPHMaterial';
        $this->load->view('index', $data);
    }

    public function simpanRPPHMaterial()
    {

        $RPPH = $this->RPPHModel;
        $this->form_validation->set_rules("RPPHID", "RPPH ID", 'required');
        // $this->form_validation->set_rules("aktifitasMaterial", "Material Activity", 'required');
        // $this->form_validation->set_rules("peralatanMaterial", "Material Tools", 'required');



        if ($this->form_validation->run() != false) {

            $RPPHID = $this->input->post('RPPHID');
            $aktifitasMaterial = count($this->input->post('aktifitasMaterial'));
            $peralatanMaterial = count($this->input->post('peralatanMaterial'));

            if ($aktifitasMaterial > 0 && $peralatanMaterial > 0) {
                for ($i = 0; $i < $aktifitasMaterial; $i++) {
                    if (trim($_POST["aktifitasMaterial"][$i]) != '') {
                        $RPPHID = $this->input->post('RPPHID');
                        $this->db->query("INSERT INTO TBL_RPPHMATERIAL(RPPH_ID,RPPHMATERIAL_ACTIVITY,RPPHMATERIAL_TOOLS) VALUES ('$RPPHID','" . $_POST['aktifitasMaterial'][$i] . "','" . $_POST['peralatanMaterial'][$i] . "')");
                    }
                }
            }
            $this->session->set_flashdata('success', 'Berhasil disimpan');

            redirect("listRPPHMaterial");
        } else {
            $this->session->set_flashdata('success', 'Gagal disimpan');
            $data['head'] = 'include/head';
            $data['header'] = 'include/header';
            $data['menu'] = 'include/menu';
            $data['content'] = 'page/RPPH/tambahRPPHMaterial';
            $data['footer'] = 'include/footer';
            $data['title'] = 'Tambah RPPH Material';
            $data['main_menu'] = 'RPPH';
            $data['sub_menu'] = 'tambahRPPHMaterial';
            $this->load->view('index', $data);
        }
    }

    public function updateRPPHMaterial()
    {

        $RPPH = $this->RPPHModel;
        $this->form_validation->set_rules("RPPHID", "RPPH ID", 'required');
        $this->form_validation->set_rules("aktifitasMaterial", "Material Activity", 'required');
        $this->form_validation->set_rules("peralatanMaterial", "Material Tools", 'required');



        if ($this->form_validation->run() != false) {

            $RPPHID = $this->input->post('RPPHID');
            $aktifitasMaterial = $this->input->post('aktifitasMaterial');
            $RPPHMaterialID = $this->input->post('RPPHMaterialID');
            $peralatanMaterial = $this->input->post('peralatanMaterial');

            $data = array(
                'RPPH_ID' => $RPPHID,
                'RPPHMaterial_ACTIVITY' => $aktifitasMaterial,
                'RPPHMaterial_TOOLS' => $peralatanMaterial
            );

            $where = array("RPPHMATERIAL_ID" => $RPPHMaterialID);
            $RPPH->update_data($where, $data, 'TBL_RPPHMATERIAL');
            $this->session->set_flashdata('success', 'Berhasil Diedit');

            redirect("listRPPHMaterial");
        } else {
            $this->session->set_flashdata('success', 'Gagal Diedit');
            $data['head'] = 'include/head';
            $data['header'] = 'include/header';
            $data['menu'] = 'include/menu';
            $data['content'] = 'page/RPPH/listRPPHMaterial';
            $data['footer'] = 'include/footer';
            $data['title'] = 'Daftar RPPH Bahan Pembelajaran';
            $data['main_menu'] = 'RPPH';
            $data['sub_menu'] = 'listRPPHMaterial';
            $this->load->view('index', $data);
        }
    }



    // RPPH Valuation indicator
    public function listRPPHValIndicator()
    {
        $data['query'] = $this->db->query("SELECT rvi.*,s.SCH_NAME, sc.CLASS_LEVEL,sc.CLASS_NAME,r.RPPH_STUDYYEAR,r.RPPH_THEME FROM TBL_RPPHVALUATIONINDICATOR rvi INNER JOIN TBL_RPPH r ON r.RPPH_ID=rvi.RPPH_ID        
        INNER JOIN tbl_schoolclass sc ON sc.CLASS_ID=r.CLASS_ID
				INNER JOIN tbl_school s ON s.SCH_ID=sc.SCH_ID
        ")->result_array();
        $data['head'] = 'include/head';
        $data['header'] = 'include/header';
        $data['menu'] = 'include/menu';
        $data['content'] = 'page/RPPH/listRPPHValIndicator';
        $data['footer'] = 'include/footer';
        $data['title'] = 'Daftar RPPH Indikator Penilaian';
        $data['main_menu'] = 'RPPH';
        $data['sub_menu'] = 'listRPPHValIndicator';
        $this->load->view('index', $data);
    }

    public function tambahRPPHValIndicator()
    {
        $data['query'] = $this->db->query("SELECT rvi.*,s.SCH_NAME,r.RPPH_ID, sc.CLASS_LEVEL,sc.CLASS_NAME,r.RPPH_STUDYYEAR,r.RPPH_THEME FROM TBL_RPPHVALUATIONINDICATOR rvi INNER JOIN TBL_RPPH r ON r.RPPH_ID=rvi.RPPH_ID        
        INNER JOIN tbl_schoolclass sc ON sc.CLASS_ID=r.CLASS_ID
				INNER JOIN tbl_school s ON s.SCH_ID=sc.SCH_ID
        ")->result_array();
        $data['head'] = 'include/head';
        $data['header'] = 'include/header';
        $data['menu'] = 'include/menu';
        $data['content'] = 'page/RPPH/tambahRPPHValIndicator';
        $data['footer'] = 'include/footer';
        $data['title'] = 'Tambah RPPH Indikator Penilaian';
        $data['main_menu'] = 'RPPH';
        $data['sub_menu'] = 'tambahRPPHValIndicator';
        $this->load->view('index', $data);
    }

    public function editRPPHValIndicator()
    {
        $id = $this->input->get("id");
        $data['isi_value'] = $this->RPPHModel->getData($id);
        $data['head'] = 'include/head';
        $data['header'] = 'include/header';
        $data['menu'] = 'include/menu';
        $data['content'] = 'page/RPPH/editRPPHValIndicator';
        $data['footer'] = 'include/footer';
        $data['title'] = 'Edit RPPH Indikator Penilaian';
        $data['main_menu'] = 'RPPH';
        $data['sub_menu'] = 'editRPPHValIndicator';
        $this->load->view('index', $data);
    }

    public function simpanRPPHValIndicator()
    {

        $RPPH = $this->RPPHModel;
        $this->form_validation->set_rules("RPPHID", "RPPH ID", 'required');
        $this->form_validation->set_rules("descValuasi", "Valuation Deskripsi", 'required');
        // $this->form_validation->set_rules("valIndicatorIndex", "Valuation Indicator Index", 'required');
        // $this->form_validation->set_rules("detailCode", "Valuation Indicator Code", 'required');
        // $this->form_validation->set_rules("detailTeknik", "Valuation Indicator Teknik", 'required');
        // $this->form_validation->set_rules("detailIndikator", "Valuation Indicator Detail", 'required');



        if ($this->form_validation->run() != false) {

            $RPPHID = $this->input->post('RPPHID');

            $result2 = $this->db->query("SELECT *FROM TBL_RPPHVALUATIONINDICATOR WHERE RPPH_ID=$RPPHID ORDER BY RPPHVALINDICATOR_INDEX DESC LIMIT 1")->row();
            $resultCount = count($result2);
            if ($resultCount > 0) {
                $result = intval($result2->RPPHVALINDICATOR_INDEX);
                $result += 1;
            } else {
                $result = intval(1);
            }

            $descValuasi = $this->input->post('descValuasi');
            $detailCode = count($this->input->post("detailCode"));
            $detailTeknik = count($this->input->post("detailTeknik"));
            $detailIndikator = count($this->input->post("detailIndikator"));

            $data = array(
                'RPPH_ID' => $RPPHID,
                'RPPHVALINDICATOR_INDEX' => $result,
                'RPPHVALINDICATOR_DESC' => $descValuasi
            );
            $RPPH->input_data($data, 'TBL_RPPHVALUATIONINDICATOR');
            if ($detailCode > 0 && $detailTeknik > 0 && $detailIndikator > 0) {
                $resultCount = count($result2);
                if ($resultCount > 0) {
                    $result = intval($result2->RPPHVALINDICATOR_INDEX);
                } else {
                    $result = intval(1);
                }

                for ($i = 0; $i < $detailCode; $i++) {
                    $result += 1;
                    if (trim($_POST["detailCode"][$i]) != '') {
                        $RPPHID = $this->input->post('RPPHID');
                        $this->db->query("INSERT INTO TBL_RPPHVALINDICATORDETAIL(RPPH_ID,RPPHVALINDICATOR_INDEX,RPPHVALINDDET_CODE,RPPHVALINDDET_TECHNIQUE,RPPHVALINDDET_INDICATOR) VALUES ('$RPPHID','$result','" . $_POST['detailCode'][$i] . "','" . $_POST['detailTeknik'][$i] . "','" . $_POST['detailIndikator'][$i] . "')");
                    }
                }
            }
            $this->session->set_flashdata('success', 'Berhasil disimpan');

            redirect("listRPPHValIndicator");
        } else {
            $this->session->set_flashdata('success', 'Lengkapi Data');
            $data['head'] = 'include/head';
            $data['header'] = 'include/header';
            $data['menu'] = 'include/menu';
            $data['content'] = 'page/RPPH/tambahRPPHValIndicator';
            $data['footer'] = 'include/footer';
            $data['title'] = 'Tambah RPPH Indikator Penilaian';
            $data['main_menu'] = 'RPPH';
            $data['sub_menu'] = 'tambahRPPHValIndicator';
            $this->load->view('index', $data);
        }
    }

    public function updateRPPHValIndicator()
    {

        $RPPH = $this->RPPHModel;
        $this->form_validation->set_rules("RPPHID", "RPPH ID", 'required');
        // $this->form_validation->set_rules("valIndicatorIndex", "Valuation Indicator Index", 'required|is_unique[TBL_RPPHVALUATIONINDICATOR.RPPHVALINDICATOR_INDEX]');
        $this->form_validation->set_rules("valIndicatorDesc", "Valuation Indicator Desc", 'required');



        if ($this->form_validation->run() != false) {

            $RPPHID = $this->input->post('RPPHID');
            $valIndicatorIndex = $this->input->post('RPPHValIndikatorID');
            $valIndicatorDesc = $this->input->post('valIndicatorDesc');

            $data = array(
                'RPPH_ID' => $RPPHID,
                'RPPHVALINDICATOR_INDEX' => $valIndicatorIndex,
                'RPPHVALINDICATOR_DESC' => $valIndicatorDesc
            );
            $where = array("RPPHVALINDICATOR_INDEX" => $valIndicatorIndex);
            $RPPH->update_data($where, $data, 'TBL_RPPHVALUATIONINDICATOR');
            $this->session->set_flashdata('success', 'Berhasil Diedit');

            redirect("listRPPHValIndicator");
        } else {
            $this->session->set_flashdata('success', 'Gagal Diedit');
            $data['head'] = 'include/head';
            $data['header'] = 'include/header';
            $data['menu'] = 'include/menu';
            $data['content'] = 'page/RPPH/listRPPHValIndicator';
            $data['footer'] = 'include/footer';
            $data['title'] = 'Daftar RPPH ValIndicator';
            $data['main_menu'] = 'RPPH';
            $data['sub_menu'] = 'listRPPHValIndicator';
            $this->load->view('index', $data);
        }
    }


    // RPPH Valuation Technique
    public function listRPPHValTechnique()
    {
        $data['query'] = $this->db->query("SELECT rvt.*, sc.CLASS_LEVEL,sc.CLASS_NAME,r.RPPH_STUDYYEAR,r.RPPH_THEME FROM TBL_RPPHVALUATIONTECHNIQUE rvt INNER JOIN TBL_RPPH r ON r.RPPH_ID=rvt.RPPH_ID
        INNER JOIN tbl_schoolclass sc ON sc.CLASS_ID=r.CLASS_ID")->result_array();
        $data['head'] = 'include/head';
        $data['header'] = 'include/header';
        $data['menu'] = 'include/menu';
        $data['content'] = 'page/RPPH/listRPPHValTechnique';
        $data['footer'] = 'include/footer';
        $data['title'] = 'Daftar RPPH Tehknik Penilaian';
        $data['main_menu'] = 'RPPH';
        $data['sub_menu'] = 'listRPPHValTechnique';
        $this->load->view('index', $data);
    }

    public function tambahRPPHValTechnique()
    {
        $data['query'] = $this->db->query("SELECT rvt.*, sc.CLASS_LEVEL,sc.CLASS_NAME,r.RPPH_STUDYYEAR,r.RPPH_THEME FROM TBL_RPPHVALUATIONTECHNIQUE rvt INNER JOIN TBL_RPPH r ON r.RPPH_ID=rvt.RPPH_ID
        INNER JOIN tbl_schoolclass sc ON sc.CLASS_ID=r.CLASS_ID")->result_array();
        $data['head'] = 'include/head';
        $data['header'] = 'include/header';
        $data['menu'] = 'include/menu';
        $data['content'] = 'page/RPPH/tambahRPPHValTechnique';
        $data['footer'] = 'include/footer';
        $data['title'] = 'Tambah RPPH Teknik Penilaian';
        $data['main_menu'] = 'RPPH';
        $data['sub_menu'] = 'tambahRPPHValTechnique';
        $this->load->view('index', $data);
    }

    public function editRPPHValTechnique()
    {
        $id = $this->input->get("id");
        $data['isi_value'] = $this->RPPHModel->getData($id);
        $data['head'] = 'include/head';
        $data['header'] = 'include/header';
        $data['menu'] = 'include/menu';
        $data['content'] = 'page/RPPH/editRPPHValTechnique';
        $data['footer'] = 'include/footer';
        $data['title'] = 'Edit RPPH Teknik Penilaian';
        $data['main_menu'] = 'RPPH';
        $data['sub_menu'] = 'editRPPHValTechnique';
        $this->load->view('index', $data);
    }

    public function simpanRPPHValTechnique()
    {

        $RPPH = $this->RPPHModel;
        $this->form_validation->set_rules("RPPHID", "RPPH ID", 'required');
        // $this->form_validation->set_rules("valTechniqueDesc", "Valuation Technique Desc", 'required');



        if ($this->form_validation->run() != false) {


            $valTechniqueDesc = count($this->input->post('valTechniqueDesc'));

            if ($valTechniqueDesc > 0) {
                for ($i = 0; $i < $valTechniqueDesc; $i++) {
                    if (trim($_POST["valTechniqueDesc"][$i]) != '') {
                        $RPPHID = $this->input->post('RPPHID');
                        $this->db->query("INSERT INTO TBL_RPPHVALUATIONTECHNIQUE(RPPH_ID,RPPHVALTECH_DESC) VALUES ('$RPPHID','" . $_POST['valTechniqueDesc'][$i] . "')");
                    }
                }
            }
            $this->session->set_flashdata('success', 'Berhasil disimpan');

            redirect("listRPPHValTechnique");
        } else {
            $this->session->set_flashdata('success', 'Gagal disimpan');
            $data['head'] = 'include/head';
            $data['header'] = 'include/header';
            $data['menu'] = 'include/menu';
            $data['content'] = 'page/RPPH/tambahRPPHValTechnique';
            $data['footer'] = 'include/footer';
            $data['title'] = 'Tambah RPPH Teknik Penilaian';
            $data['main_menu'] = 'RPPH';
            $data['sub_menu'] = 'tambahRPPHValTechnique';
            $this->load->view('index', $data);
        }
    }

    public function updateRPPHValTechnique()
    {


        $RPPH = $this->RPPHModel;
        $this->form_validation->set_rules("RPPHID", "RPPH ID", 'required');
        $this->form_validation->set_rules("valTechniqueDesc", "Valuation Technique Desc", 'required');



        if ($this->form_validation->run() != false) {

            $RPPHID = $this->input->post('RPPHID');
            $RPPHVALTECH = $this->input->post('RPPHVALTECH');
            $valTechniqueDesc = $this->input->post('valTechniqueDesc');

            $data = array(
                'RPPH_ID' => $RPPHID,
                'RPPHVALTECH_DESC' => $valTechniqueDesc
            );

            $where = array("RPPHVALTECH_ID" => $RPPHVALTECH);
            $RPPH->update_data($where, $data, 'TBL_RPPHVALUATIONTECHNIQUE');
            $this->session->set_flashdata('success', 'Berhasil Diedit');

            redirect("listRPPHValTechnique");
        } else {
            $this->session->set_flashdata('success', 'Gagal Diedit');
            $data['head'] = 'include/head';
            $data['header'] = 'include/header';
            $data['menu'] = 'include/menu';
            $data['content'] = 'page/RPPH/listRPPHValTechnique';
            $data['footer'] = 'include/footer';
            $data['title'] = 'Daftar RPPH Teknik Penilaian';
            $data['main_menu'] = 'RPPH';
            $data['sub_menu'] = 'listRPPHValTechnique';
            $this->load->view('index', $data);
        }
    }


    // RPPH Valuation Indicator Detail
    public function listRPPHValIndicatorDetail()
    {
        $data['query'] = $this->db->query("SELECT rvd.*, r.*,sc.CLASS_LEVEL,sc.CLASS_NAME FROM TBL_RPPHVALINDICATORDETAIL rvd 
        INNER JOIN TBL_RPPHVALUATIONINDICATOR rvi ON rvi.RPPHVALINDICATOR_INDEX=rvd.RPPHVALINDICATOR_INDEX
        INNER JOIN TBL_RPPH r ON r.RPPH_ID=rvd.RPPH_ID
        INNER JOIN TBL_SCHOOLCLASS sc ON sc.CLASS_ID=r.CLASS_ID")->result_array();
        $data['head'] = 'include/head';
        $data['header'] = 'include/header';
        $data['menu'] = 'include/menu';
        $data['content'] = 'page/RPPH/listRPPHValIndicatorDetail';
        $data['footer'] = 'include/footer';
        $data['title'] = 'Daftar RPPH Penilaian Detail Indicator ';
        $data['main_menu'] = 'RPPH';
        $data['sub_menu'] = 'listRPPHValIndicatorDetail';
        $this->load->view('index', $data);
    }

    public function tambahRPPHValIndicatorDetail()
    {
        $data['query'] = $this->db->query("SELECT rvd.*, r.*,sc.CLASS_LEVEL,sc.CLASS_NAME FROM TBL_RPPHVALINDICATORDETAIL rvd 
        INNER JOIN TBL_RPPHVALUATIONINDICATOR rvi ON rvi.RPPHVALINDICATOR_INDEX=rvd.RPPHVALINDICATOR_INDEX
        INNER JOIN TBL_RPPH r ON r.RPPH_ID=rvd.RPPH_ID
        INNER JOIN TBL_SCHOOLCLASS sc ON sc.CLASS_ID=r.CLASS_ID")->result_array();
        $data['head'] = 'include/head';
        $data['header'] = 'include/header';
        $data['menu'] = 'include/menu';
        $data['content'] = 'page/RPPH/tambahRPPHValIndicatorDetail';
        $data['footer'] = 'include/footer';
        $data['title'] = 'Tambah RPPH Penilaian Detail Indicator';
        $data['main_menu'] = 'RPPH';
        $data['sub_menu'] = 'tambahRPPHValIndicatorDetail';
        $this->load->view('index', $data);
    }

    public function editRPPHValIndicatorDetail()
    {
        $id = $this->input->get("id");
        $data['isi_value'] = $this->RPPHModel->getData($id);
        $data['head'] = 'include/head';
        $data['header'] = 'include/header';
        $data['menu'] = 'include/menu';
        $data['content'] = 'page/RPPH/editRPPHValIndicatorDetail';
        $data['footer'] = 'include/footer';
        $data['title'] = 'Edit RPPH Penilaian Detail Indicator';
        $data['main_menu'] = 'RPPH';
        $data['sub_menu'] = 'editRPPHValIndicatorDetail';
        $this->load->view('index', $data);
    }

    public function simpanRPPHValDetail()
    {

        $RPPH = $this->RPPHModel;
        $this->form_validation->set_rules("RPPHID", "RPPH ID", 'required');
        if ($this->form_validation->run() != false) {
            $RPPHID = $this->input->post('RPPHID');
            $RPPHVALINDEX = $this->input->post('RPPHVALINDEX');
            $detailCode = count($this->input->post("detailCode"));
            $idActivity = $this->input->post('RPPHActivityID');
            $result2 = $this->db->query("SELECT *FROM TBL_RPPHVALINDICATORDETAIL WHERE RPPH_ID='$RPPHID' ORDER BY RPPHVALINDICATOR_INDEX DESC LIMIT 1")->row();
            $resultCount = count($result2);
            if ($resultCount > 0) {
                $result = intval($result2->RPPHVALINDICATOR_INDEX);
            } else {
                $result = intval(1);
            }
            if ($detailCode > 0) {
                for ($i = 0; $i < $detailCode; $i++) {
                    $result += 1;
                    if (trim($_POST["detailCode"][$i]) != '') {
                        $RPPHID = $this->input->post('RPPHID');
                        $this->db->query("INSERT INTO TBL_RPPHVALINDICATORDETAIL(RPPH_ID,RPPHVALINDICATOR_INDEX,RPPHVALINDDET_CODE,RPPHVALINDDET_TECHNIQUE,RPPHVALINDDET_INDICATOR) VALUES ('$RPPHID','$RPPHVALINDEX','" . $_POST['detailCode'][$i] . "','" . $_POST['detailTeknik'][$i] . "','" . $_POST['detailIndikator'][$i] . "')");
                    }
                }
            }
            $this->session->set_flashdata('success', 'Berhasil Ditambahkan');

            redirect("listRPPHActivity");
        } else {
            $this->session->set_flashdata('success', 'Gagal disimpan');
            $data['head'] = 'include/head';
            $data['header'] = 'include/header';
            $data['menu'] = 'include/menu';
            $data['content'] = 'page/RPPH/tambahRPPHActivity';
            $data['footer'] = 'include/footer';
            $data['title'] = 'Tambah RPPH Kegiatan';
            $data['main_menu'] = 'RPPH';
            $data['sub_menu'] = 'tambahRPPHActivity';
            $this->load->view('index', $data);
        }
    }

    public function updateRPPHValIndicatorDetail()
    {



        $RPPH = $this->RPPHModel;
        $this->form_validation->set_rules("RPPHID", "RPPH ID", 'required|is_unique[TBL_RPPHVALINDICATORDETAIL.RPPH_ID]');
        $this->form_validation->set_rules("valIndicatorIndex", "Valuation Indicator Index", 'required|is_unique[TBL_RPPHVALINDICATORDETAIL.RPPHVALINDICATOR_INDEX]');
        $this->form_validation->set_rules("valIndDetCode", "Valuation Indicator Detail Code", 'required|is_unique[TBL_RPPHVALINDICATORDETAIL.RPPHVALINDDET_CODE]');
        $this->form_validation->set_rules("valIndDetTech", "Valuation Indicator Detail Technique", 'required|is_unique[TBL_RPPHVALINDICATORDETAIL.RPPHVALINDDET_TECHNIQUE]');
        $this->form_validation->set_rules("valIndDetIndicator", "Valuation Indicator Detail Indicator", 'required');


        if ($this->form_validation->run() != false) {

            $RPPHID = $this->input->post('RPPHID');

            $valIndicatorIndex = $this->input->post('valIndicatorIndex');
            $valIndDetCode = $this->input->post('valIndDetCode');
            $valIndDetTech = $this->input->post('valIndDetTech');
            $valIndDetCode = $this->input->post('valIndDetCode');
            $valIndDetIndicator = $this->input->post('valIndDetIndicator');

            $data = array(
                'RPPH_ID' => $RPPHID,
                'RPPHVALINDICATOR_INDEX' => $valIndicatorIndex,
                'RPPHVALINDICATOR_CODE' => $valIndDetCode,
                'RPPHVALINDICATOR_TECHNIQUE' => $valIndDetTech,
                'RPPHVALINDICATOR_INDICATOR' => $valIndDetIndicator,
            );

            $where = array("RPPH_ID" => $RPPHID);
            $RPPH->update_data($where, $data, 'TBL_RPPHVALINDICATORDETAIL');
            $this->session->set_flashdata('success', 'Berhasil Diedit');

            redirect("listRPPHValIndicatorDetail");
        } else {
            $this->session->set_flashdata('success', 'Gagal Diedit');
            $data['head'] = 'include/head';
            $data['header'] = 'include/header';
            $data['menu'] = 'include/menu';
            $data['content'] = 'page/RPPH/listRPPHValIndicatorDetail';
            $data['footer'] = 'include/footer';
            $data['title'] = 'Daftar RPPH Penilaian Detail Indikator';
            $data['main_menu'] = 'RPPH';
            $data['sub_menu'] = 'listRPPHValIndicatorDetail';
            $this->load->view('index', $data);
        }
    }


    // public function simpanDetailRPPHActivity()
    // {

    //     $RPPH = $this->RPPHModel;
    //     $this->form_validation->set_rules("RPPHActivityID", "RPPH Activity ID", 'required');
    //     if ($this->form_validation->run() != false) {
    //         $aktifitasDetail = count($this->input->post("aktifitasDetail"));
    //         $idActivity = $this->input->post('RPPHActivityID');
    //         $result2 = $this->db->query("SELECT *FROM TBL_RPPHACTDETAIL WHERE RPPHACTIVITY_ID=$idActivity ORDER BY RPPHACTDETAIL_INDEX DESC LIMIT 1")->row();
    //         if ($aktifitasDetail > 0) {
    //             for ($i = 0; $i < $aktifitasDetail; $i++) {
    //                 $result += 1;
    //                 if (trim($_POST["aktifitasDetail"][$i]) != '') {
    //                     $RPPHID = $this->input->post('RPPHID');
    //                     $this->db->query("INSERT INTO TBL_RPPHACTDETAIL(RPPHACTIVITY_ID,RPPHACTDETAIL_INDEX,RPPHACTDETAIL_DESC) VALUES ('$idActivity',$result,'" . $_POST['aktifitasDetail'][$i] . "')");
    //                 }
    //             }
    //         }
    //         $this->session->set_flashdata('success', 'Berhasil Ditambahkan');

    //         redirect("listRPPHActivity");
    //     } else {
    //         $this->session->set_flashdata('success', 'Gagal disimpan');
    //         $data['head'] = 'include/head';
    //         $data['header'] = 'include/header';
    //         $data['menu'] = 'include/menu';
    //         $data['content'] = 'page/RPPH/tambahRPPHActivity';
    //         $data['footer'] = 'include/footer';
    //         $data['title'] = 'Tambah RPPH Kegiatan';
    //         $data['main_menu'] = 'RPPH';
    //         $data['sub_menu'] = 'tambahRPPHActivity';
    //         $this->load->view('index', $data);
    //     }
    // }

    // RPPH Valuation ACTIVITY DETAIL
    public function listRPPHActDetail()
    {
        $data['query'] = $this->db->query("SELECT rad.*, ra.* FROM TBL_RPPHACTDETAIL rad 
        INNER JOIN TBL_RPPHACTIVITY ra ON ra.RPPHACTIVITY_ID=rad.RPPHACTIVITY_ID")->result_array();
        $data['head'] = 'include/head';
        $data['header'] = 'include/header';
        $data['menu'] = 'include/menu';
        $data['content'] = 'page/RPPH/listRPPHActivityDetail';
        $data['footer'] = 'include/footer';
        $data['title'] = 'Daftar RPPH Activity Detail';
        $data['main_menu'] = 'RPPH';
        $data['sub_menu'] = 'listRPPHActivityDetail';
        $this->load->view('index', $data);
    }

    public function tambahRPPHActDetail()
    {
        $data['query'] = $this->db->query("SELECT rvd.*, r.*,sc.CLASS_LEVEL,sc.CLASS_NAME FROM TBL_RPPHVALINDICATORDETAIL rvd 
        INNER JOIN TBL_RPPHVALUATIONINDICATOR rvi ON rvi.RPPHVALINDICATOR_INDEX=rvd.RPPHVALINDICATOR_INDEX
        INNER JOIN TBL_RPPH r ON r.RPPH_ID=rvd.RPPH_ID
        INNER JOIN TBL_SCHOOLCLASS sc ON sc.CLASS_ID=r.CLASS_ID")->result_array();
        $data['head'] = 'include/head';
        $data['header'] = 'include/header';
        $data['menu'] = 'include/menu';
        $data['content'] = 'page/RPPH/tambahRPPHActivityDetail';
        $data['footer'] = 'include/footer';
        $data['title'] = 'Tambah RPPH Kegiatan Detail';
        $data['main_menu'] = 'RPPH';
        $data['sub_menu'] = 'tambahRPPHActivityDetail';
        $this->load->view('index', $data);
    }

    public function editRPPHActDetail()
    {
        $id = $this->input->get("id");
        $data['isi_value'] = $this->RPPHModel->getData($id);
        $data['head'] = 'include/head';
        $data['header'] = 'include/header';
        $data['menu'] = 'include/menu';
        $data['content'] = 'page/RPPH/editRPPHActivityDetail';
        $data['footer'] = 'include/footer';
        $data['title'] = 'Edit RPPH Kegiatan Detail';
        $data['main_menu'] = 'RPPH';
        $data['sub_menu'] = 'editRPPHActivityDetail';
        $this->load->view('index', $data);
    }

    public function simpanRPPHActDetail()
    {

        $RPPH = $this->RPPHModel;
        $this->form_validation->set_rules("RPPHActDetailID", "RPPH Activity Detail ID", 'required|is_unique[TBL_RPPHACTDETAIL.RPPHACTIVITY_ID]');
        $this->form_validation->set_rules("actDetailIndex", "Activity Detail Index", 'required|is_unique[TBL_RPPHACTDETAIL.RPPHACTDETAIL_INDEX]');
        $this->form_validation->set_rules("actDetailDesc", "Activity Detail Deskripsi", 'required');



        if ($this->form_validation->run() != false) {

            $RPPHActDetailID = $this->input->post('RPPHActDetailID');

            $actDetailIndex = $this->input->post('actDetailIndex');
            $actDetailDesc = $this->input->post('actDetailDesc');
            $data = array(
                'RPPHACTIVITY_ID' => $RPPHActDetailID,
                'RPPHACTDETAIL_INDEX' => $actDetailIndex,
                'RPPHACTDETAIL_DESC' => $actDetailDesc
            );
            $RPPH->input_data($data, 'TBL_RPPHACTDETAIL');
            $this->session->set_flashdata('success', 'Berhasil disimpan');

            redirect("listRPPHActivityDetail");
        } else {
            $this->session->set_flashdata('success', 'Gagal disimpan');
            $data['head'] = 'include/head';
            $data['header'] = 'include/header';
            $data['menu'] = 'include/menu';
            $data['content'] = 'page/RPPH/tambahRPPHActivityDetail';
            $data['footer'] = 'include/footer';
            $data['title'] = 'Tambah RPPH Kegiatan Detail';
            $data['main_menu'] = 'RPPH';
            $data['sub_menu'] = 'tambahRPPHActivityDetail';
            $this->load->view('index', $data);
        }
    }

    public function updateRPPHActDetail()
    {


        $RPPH = $this->RPPHModel;
        // $this->form_validation->set_rules("actDetailIndex", "Activity Detail Index", 'required|is_unique[TBL_RPPHACTDETAIL.RPPHACTDETAIL_INDEX]');
        $this->form_validation->set_rules("RPPHActivityID", "RPPH Activity ID", 'required');



        if ($this->form_validation->run() != false) {

            $RPPHActivityID = $this->input->post('RPPHActivityID');

            $actDetailIndex = $this->input->post('actDetailIndex');
            $aktifitas = count($this->input->post('aktifitas'));
            $RPPHACTINDEX = $this->input->post("RPPHACTINDEX");
            if ($aktifitas > 0) {
                for ($i = 0; $i < $aktifitas; $i++) {
                    if (trim($_POST["aktifitas"][$i]) != '') {
                        $RPPHActivityID = $this->input->post('RPPHActivityID');
                        $this->db->query("UPDATE TBL_RPPHACTDETAIL SET RPPHACTDETAIL_DESC='" . $_POST['aktifitas'][$i] . "' WHERE  RPPHACTDETAIL_INDEX='" . $_POST['RPPHACTINDEX'][$i] . "'");
                    }
                }
            }

            $this->session->set_flashdata('success', 'Berhasil Diedit');

            redirect("listRPPHActivityDetail");
        } else {
            $this->session->set_flashdata('success', 'Gagal Diedit');
            $data['head'] = 'include/head';
            $data['header'] = 'include/header';
            $data['menu'] = 'include/menu';
            $data['content'] = 'page/RPPH/listRPPHActivityDetail';
            $data['footer'] = 'include/footer';
            $data['title'] = 'Daftar RPPH Kegiatan Detail';
            $data['main_menu'] = 'RPPH';
            $data['sub_menu'] = 'listRPPHActivityDetail';
            $this->load->view('index', $data);
        }
    }

    public function updateRPPHValDetail()
    {


        $RPPH = $this->RPPHModel;
        // $this->form_validation->set_rules("actDetailIndex", "Activity Detail Index", 'required|is_unique[TBL_RPPHACTDETAIL.RPPHACTDETAIL_INDEX]');
        $this->form_validation->set_rules("RPPHValIndikatorID", "RPPH Activity ID", 'required');



        if ($this->form_validation->run() != false) {

            $RPPHActivityID = $this->input->post('RPPHActivityID');

            $RPPHVALINDEX = count($this->input->post('RPPHVALINDEX'));
            $detailCode = count($this->input->post("detailCode"));

            if ($detailCode > 0) {
                for ($i = 0; $i < $detailCode; $i++) {
                    if (trim($_POST["detailCode"][$i]) != '') {
                        $this->db->query("UPDATE TBL_RPPHVALINDICATORDETAIL SET RPPHVALINDDET_TECHNIQUE='" . $_POST['detailTeknik'][$i] . "',RPPHVALINDDET_INDICATOR='" . $_POST['detailIndikator'][$i] . "' WHERE  RPPHVALINDDET_CODE='" . $_POST['RPPHVALINDEX'][$i] . "'");
                    }
                }
            }

            $this->session->set_flashdata('success', 'Berhasil Diedit');

            redirect("listRPPHValIndicator");
        } else {
            $this->session->set_flashdata('success', 'Gagal Diedit');
            $data['head'] = 'include/head';
            $data['header'] = 'include/header';
            $data['menu'] = 'include/menu';
            $data['content'] = 'page/RPPH/listRPPHActivityDetail';
            $data['footer'] = 'include/footer';
            $data['title'] = 'Daftar RPPH Kegiatan Detail';
            $data['main_menu'] = 'RPPH';
            $data['sub_menu'] = 'listRPPHActivityDetail';
            $this->load->view('index', $data);
        }
    }





    public function deleteRPPH()
    {
        $id = $this->input->get("id");
        $result = $this->db->query("SELECT *FROM TBL_RPPHACTIVITY WHERE RPPH_ID='$id'")->num_rows();
        $result2 = $this->db->query("SELECT *FROM TBL_RPPHLEARNING WHERE RPPH_ID='$id'")->num_rows();
        if ($result > 0 && $result2 > 0) {
            $this->session->set_flashdata('failed', 'Data Gagal Dihapus');
        } else {
            $query = $this->db->delete('TBL_RPPH', ['RPPH_ID' => $id]);
            $this->session->set_flashdata('success', 'Berhasil Dihapus');
        }
        redirect('listRPPH');
    }

    public function deleteRPPHActivity()
    {
        $id = $this->input->get("id");

        $query = $this->db->delete('TBL_RPPHACTIVITY', ['RPPHACTIVITY_ID' => $id]);
        $this->session->set_flashdata('success', 'Berhasil Dihapus');

        redirect('listRPPHActivity');
    }

    public function deleteRPPHLearning()
    {
        $id = $this->input->get("id");

        $query = $this->db->delete('TBL_RPPHLEARNING', ['RPPHLEARNING_ID' => $id]);
        $this->session->set_flashdata('success', 'Berhasil Dihapus');
        redirect('listRPPHLearning');
    }



    public function deleteKompetensiRPPH()
    {
        $id = $this->input->get("id");
        $query = $this->db->delete('TBL_PROMES_COMPETENCY', ['COMPETENCY_ID' => $id]);
        $this->session->set_flashdata('success', 'Berhasil Dihapus');
        redirect('listKompetensiRPPH');
    }

    function fetchLearning()
    {
        $output = '';
        $query = '';

        if ($this->input->post('query')) {
            $query = $this->input->post('query');
        }
        $data = $this->db->query("SELECT rp.*,rpm.*,sc.SCH_NAME, cl.CLASS_NAME,cl.CLASS_LEVEL FROM TBL_RPPHLEARNING rp INNER JOIN TBL_RPPH rpm ON rpm.RPPH_ID=rp.RPPH_ID INNER JOIN tbl_schoolclass cl ON cl.CLASS_ID=rpm.CLASS_ID
        INNER JOIN tbl_school sc ON sc.SCH_ID=cl.SCH_ID WHERE rp.RPPH_ID='$query'");
        $output .= '
  <div class="table-responsive">
  <button  class="btn btn-primary  mt-1 mb-3" id="btnTambah" data-toggle="modal" data-target="#modal_tambah">Tambah Data</button>
     <table class="table table-bordered table-striped">
      <tr>
      <th></th>
       <th>No</th>
       <th>Kode Pembelajaran</th>
       <th>Teori Pembelajaran</th>
       <th>Tujuan Pembelajaran</th>
       <th>Action</th>
      </tr>
  ';
        if ($data->num_rows() > 0) {
            $no = 1;
            foreach ($data->result() as $row) {

                $tombolEdit = "<button type=\"button\" class=\"btn btn-sm btn-primary ml-1\" title=\"Edit data\" onclick=\"edit('" . $row->RPPHLEARNING_ID . "')\">
                Edit
            </button>";


                $tombolHapus = "<button type=\"button\" class=\"btn btn-sm btn-danger ml-1\" title=\"Hapus data\" onclick=\"hapus('" . $row->RPPHLEARNING_ID . "')\">
                Hapus
            </button>";

                $output .= '
      <tr>
      <td><input type="checkbox" name="' . $row->RPPHLEARNING_ID . '">        </td>
       <td>' . $no++ . '</td>
       <td>' . $row->RPPHLEARNING_CODE . '</td>
       <td>' . $row->RPPHLEARNING_THEORY . '</td>
       <td>' . $row->RPPHLEARNING_GOAL . '</td>
       <td>' . $tombolEdit . $tombolHapus . '</td>
      </tr>
    ';
            }
        } else {
            $output .= '<tr>
       <td colspan="4">No Data Found</td>
      </tr>';
        }
        $output .= '</table>
        ';
        echo $output;
    }




    function fetchActivity()
    {
        $output = '';
        $query = '';

        if ($this->input->post('query')) {
            $query = $this->input->post('query');
        }
        $data = $this->db->query("SELECT rp.*,rpm.*,sc.SCH_NAME, cl.CLASS_NAME,cl.CLASS_LEVEL FROM TBL_RPPHACTIVITY rp INNER JOIN TBL_RPPH rpm ON rpm.RPPH_ID=rp.RPPH_ID INNER JOIN tbl_schoolclass cl ON cl.CLASS_ID=rpm.CLASS_ID
        INNER JOIN tbl_school sc ON sc.SCH_ID=cl.SCH_ID WHERE rp.RPPH_ID='$query'");
        $output .= '
  <div class="table-responsive">
  <button  class="btn btn-primary  mt-1 mb-3" id="btnTambah" data-toggle="modal" data-target="#modalTambahRPPHAct">Tambah Data</button>
     <table class="table table-bordered table-striped">
      <tr>
      <th>No</th>    
       <th>Nama Kegiatan</th>
       <th>Waktu Kegiatan</th>
       <th>Action</th>
      </tr>
  ';
        if ($data->num_rows() > 0) {
            $no = 1;
            foreach ($data->result() as $row) {

                $tombolEdit = "<button type=\"button\" class=\"btn btn-sm btn-primary ml-1\" title=\"Edit data\" onclick=\"edit('" . $row->RPPHACTIVITY_ID . "')\">
                Edit
            </button>";

                $tombolDetail = "<button type=\"button\" class=\"btn btn-sm btn-success ml-1\" title=\"Detail data\" onclick=\"detail('" . $row->RPPHACTIVITY_ID . "')\">
                Detail
            </button>";

                $tombolHapus = "<button type=\"button\" class=\"btn btn-sm btn-danger ml-1\" title=\"Hapus data\" onclick=\"hapus('" . $row->RPPHACTIVITY_ID . "')\">
                Hapus
            </button>";

                if (strlen($row->RPPHACTIVITY_TIME) == 8) {
                }
                $time1 = substr($row->RPPHACTIVITY_TIME, 0, 2);
                $time2 = substr($row->RPPHACTIVITY_TIME, 2, 2);
                $time3 = substr($row->RPPHACTIVITY_TIME, 4, 2);
                $time4 = substr($row->RPPHACTIVITY_TIME, 6, 2);
                $waktuTime = $time1 . ':' . $time2 . ' - ' . $time3 . ':' . $time4;
                $output .= '
      <tr>
       <td>' . $no++ . '</td>
       <td>' . $row->RPPHACTIVITY_NAME . '</td>
       <td>' . $waktuTime . '</td>
       <td>
      ' . $tombolEdit . $tombolDetail . $tombolHapus . '
       </td>
      </tr>
    ';
            }
        } else {
            $output .= '<tr>
       <td colspan="4">No Data Found</td>
      </tr>';
        }
        $output .= '</table>
        ';
        echo $output;
    }

    function fetchMaterial()
    {
        $output = '';
        $query = '';

        if ($this->input->post('query')) {
            $query = $this->input->post('query');
        }
        $data = $this->db->query("SELECT rp.*,rpm.*,sc.SCH_NAME, cl.CLASS_NAME,cl.CLASS_LEVEL FROM TBL_RPPHMATERIAL rp INNER JOIN TBL_RPPH rpm ON rpm.RPPH_ID=rp.RPPH_ID INNER JOIN tbl_schoolclass cl ON cl.CLASS_ID=rpm.CLASS_ID
        INNER JOIN tbl_school sc ON sc.SCH_ID=cl.SCH_ID WHERE rp.RPPH_ID='$query'");
        $output .= '
  <div class="table-responsive">
  <button  class="btn btn-primary mb-3 mt-1 mt-1" id="btnTambah" data-toggle="modal" data-target="#modalTambahMaterial">Tambah Data</button>
     <table class="table table-bordered table-striped">
      <tr>
       <th>Np</th>
       <th>Kegiatan</th>
       <th>Alat,Bahan,dan Sumber</th>
       <th>Action</th>
      </tr>
  ';
        if ($data->num_rows() > 0) {
            $no = 1;
            foreach ($data->result() as $row) {

                $tombolEdit = "<button type=\"button\" class=\"btn btn-sm btn-primary ml-1\" title=\"Edit data\" onclick=\"edit('" . $row->RPPHMATERIAL_ID . "')\">
                Edit
            </button>";


                $tombolHapus = "<button type=\"button\" class=\"btn btn-sm btn-danger ml-1\" title=\"Hapus data\" onclick=\"hapus('" . $row->RPPHMATERIAL_ID . "')\">
                Hapus
            </button>";

                $output .= '
      <tr>
      
       <td>' . $no++ . '</td>
       <td>' . $row->RPPHMATERIAL_ACTIVITY . '</td>
       <td>' . $row->RPPHMATERIAL_TOOLS . '</td>
       <td>' . $tombolEdit . $tombolHapus . '</td>
      </tr>
    ';
            }
        } else {
            $output .= '<tr>
       <td colspan="4">No Data Found</td>
      </tr>';
        }
        $output .= '</table>
        ';
        echo $output;
    }




    function fetchValIndicator()
    {
        $output = '';
        $query = '';

        if ($this->input->post('query')) {
            $query = $this->input->post('query');
        }
        $data = $this->db->query("SELECT rp.*,rpm.RPPH_STUDYYEAR,rpm.RPPH_THEME,sc.SCH_NAME, cl.CLASS_NAME,cl.CLASS_LEVEL FROM TBL_RPPHVALUATIONINDICATOR rp INNER JOIN TBL_RPPH rpm ON rpm.RPPH_ID=rp.RPPH_ID INNER JOIN tbl_schoolclass cl ON cl.CLASS_ID=rpm.CLASS_ID
        INNER JOIN tbl_school sc ON sc.SCH_ID=cl.SCH_ID WHERE rp.RPPH_ID='$query'");
        $output .= '
  <div class="table-responsive">
  <button  class="btn btn-primary  mt-1 mb-3" id="btnTambah" data-toggle="modal" data-target="#modalTambahRPPHValIndicator">Tambah Data</button>

     <table class="table table-bordered table-striped">
      <tr>
       <th>No</th>
       <th>Program Pengembangan</th>
       <th>Jumlah Indikator</th>
       <th>Action</th>
      </tr>
  ';
        if ($data->num_rows() > 0) {
            $no = 1;
            foreach ($data->result() as $row) {

                $tombolEdit = "<button type=\"button\" class=\"btn btn-sm btn-primary ml-1\" title=\"Edit data\" onclick=\"edit('" . $row->RPPHVALINDICATOR_INDEX . "')\">
                Edit
            </button>";

                $tombolDetail = "<button type=\"button\" class=\"btn btn-sm btn-success ml-1\" title=\"Detail data\" onclick=\"detail('" . $row->RPPHVALINDICATOR_INDEX . "')\">
                Detail
            </button>";

                $tombolHapus = "<button type=\"button\" class=\"btn btn-sm btn-danger ml-1\" title=\"Hapus data\" onclick=\"hapus('" . $row->RPPHVALINDICATOR_INDEX . "')\">
                Hapus
            </button>";

                $output .= '
      <tr>
       <td>' . $no++ . '</td>       
       <td>' . $row->RPPHVALINDICATOR_DESC . '</td>
       <td>' . $row->RPPHVALINDICATOR_INDEX . '</td>
       <td>' . $tombolEdit . $tombolHapus . $tombolDetail . '</td>

      </tr>
    ';
            }
        } else {
            $output .= '<tr>
       <td colspan="4">No Data Found</td>
      </tr>';
        }
        $output .= '</table>
        ';
        echo $output;
    }


    // Val Technique
    function fetchValTechnique()
    {
        $output = '';
        $query = '';

        if ($this->input->post('query')) {
            $query = $this->input->post('query');
        }
        $data = $this->db->query("SELECT rp.*,rpm.RPPH_STUDYYEAR,rpm.RPPH_THEME,sc.SCH_NAME, cl.CLASS_NAME,cl.CLASS_LEVEL FROM TBL_RPPHVALUATIONTECHNIQUE rp INNER JOIN TBL_RPPH rpm ON rpm.RPPH_ID=rp.RPPH_ID INNER JOIN tbl_schoolclass cl ON cl.CLASS_ID=rpm.CLASS_ID
        INNER JOIN tbl_school sc ON sc.SCH_ID=cl.SCH_ID WHERE rp.RPPH_ID='$query'");
        $output .= '
  <div class="table-responsive">
  <button  class="btn btn-primary  mt-1 mb-3" id="btnTambah" data-toggle="modal" data-target="#modalTambahTeknik">Tambah Data</button>
     <table class="table table-bordered table-striped">
      <tr>
       <th>No</th>
       <th>Teknik Penilaian</th>
       <th>Action</th>
      </tr>
  ';
        if ($data->num_rows() > 0) {
            $no = 1;
            foreach ($data->result() as $row) {

                $tombolEdit = "<button type=\"button\" class=\"btn btn-sm btn-primary ml-1\" title=\"Edit data\" onclick=\"edit('" . $row->RPPHVALTECH_ID . "')\">
                Edit
            </button>";


                $tombolHapus = "<button type=\"button\" class=\"btn btn-sm btn-danger ml-1\" title=\"Hapus data\" onclick=\"hapus('" . $row->RPPHVALTECH_ID . "')\">
                Hapus
            </button>";

                $output .= '
      <tr>
       <td>' . $no++ . '</td>       
       <td>' . $row->RPPHVALTECH_DESC . '</td>
       <td>' . $tombolEdit . $tombolHapus . '</td>
      </tr>
    ';
            }
        } else {
            $output .= '<tr>
       <td colspan="4">No Data Found</td>
      </tr>';
        }
        $output .= '</table>
        ';
        echo $output;
    }


    // Val Indicator Detail
    function fetchValIndicatorDetail()
    {
        $output = '';
        $query = '';

        if ($this->input->post('query') && $this->input->post('query2')) {
            $query = $this->input->post('query');
            $query2 = $this->input->post('query2');
        }
        $data = $this->db->query("SELECT rp.*,rpm.RPPH_STUDYYEAR,rpm.RPPH_THEME,sc.SCH_NAME, cl.CLASS_NAME,cl.CLASS_LEVEL FROM TBL_RPPHVALINDICATORDETAIL rp INNER JOIN TBL_RPPH rpm ON rpm.RPPH_ID=rp.RPPH_ID INNER JOIN tbl_schoolclass cl ON cl.CLASS_ID=rpm.CLASS_ID
        INNER JOIN tbl_school sc ON sc.SCH_ID=cl.SCH_ID WHERE rp.RPPH_ID='$query' AND rp.RPPHVALINDICATOR_INDEX='$query2'");
        $output .= '
  <div class="table-responsive">
     <table class="table table-bordered table-striped">
      <tr>
        <th></th>
       <th>No</th>
       <th>Valuasi Indicator Index</th>
       <th>Valuasi Indicator Detail Kode</th>
       <th>Valuasi Indicator Detail Technique</th>
       <th>Valuasi Indicator Detail Indicator</th>
       <th>Action</th>
      </tr>
  ';
        if ($data->num_rows() > 0) {
            $no = 1;
            foreach ($data->result() as $row) {
                $output .= '
      <tr>
      <td><input type="checkbox" name="' . $row->RPPH_ID . '"></td> 
    <td>' . $no++ . '</td>
       <td>' . $row->SCH_NAME . '-' . $row->CLASS_LEVEL . '-' . $row->CLASS_NAME . '</td>       
       <td>' . $row->RPPHVALINDICATOR_INDEX . '</td>
       <td>' . $row->RPPHVALINDDET_CODE . '</td>
       <td>' . $row->RPPHVALINDDET_TECHNIQUE . '</td>
       <td>' . $row->RPPHVALINDDET_INDICATOR . '</td>
       <td><button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal_edit' . $row->RPPHVALINDICATOR_INDEX . '">Edit</button>
       <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal_detail' . $row->RPPHVALINDICATOR_INDEX . '">EdDetailit</button>
       </td>
      </tr>
    ';
            }
        } else {
            $output .= '<tr>
       <td colspan="4">No Data Found</td>
      </tr>';
        }
        $output .= '</table>
        <div style="text-align:center">
        <button  class="btn btn-primary  mt-1 mt-1" id="btnTambah" data-toggle="modal" data-target="#modal_tambah">Tambah Data</button>
        <a href="deleteRPPH?id=" class="btn btn-danger mt-1 btn-sm">Hapus</a>
        </div>
        ';

        echo $output;
    }


    function fetchActDetail()
    {
        $output = '';
        $query = '';

        if ($this->input->post('query')) {
            $query = $this->input->post('query');
        }
        $data = $this->db->query("SELECT rad.*,ra.RPPHACTIVITY_NAME,ra.RPPHACTIVITY_TIME,ra.RPPHACTIVITY_ID FROM TBL_RPPHACTDETAIL rad INNER JOIN TBL_RPPHACTIVITY ra ON ra.RPPHACTIVITY_ID=rad.RPPHACTIVITY_ID WHERE rad.RPPHACTIVITY_ID='$query'");
        $output .= '
  <div class="table-responsive">
     <table class="table table-bordered table-striped">
      <tr>
      <th></th>
      <th>No</th>
       <th>RPPH Activity ID</th>
       <th>Activity Detail Index</th>
       <th>Activity Detail Deskripsi</th>
       <th>Action</th>
      </tr>
  ';
        if ($data->num_rows() > 0) {
            $no = 1;
            foreach ($data->result() as $row) {
                $output .= '
      <tr>
      <td><input type="checkbox" name="' . $row->RPPHACTIVITY_ID . '"></td>
      <td>' . $no++ . '</td>
       <td>' . $row->RPPHACTIVITY_ID . '-' . $row->RPPHACTIVITY_NAME . '</td>
       <td>' . $row->RPPHACTDETAIL_INDEX . '</td>
       <td>' . $row->RPPHACTDETAIL_DESC . '</td>
       <td><button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal_edit' . $row->RPPHACTIVITY_ID . '">Edit</button></td>
      </tr>
    ';
            }
        } else {
            $output .= '<tr>
       <td colspan="4">No Data Found</td>
      </tr>';
        }
        $output .= '</table>
        <div style="text-align:center">
        <button  class="btn btn-primary  mt-1 mt-1" id="btnTambah" data-toggle="modal" data-target="#modal_tambah">Tambah Data</button>
        <a href="deleteRPPH?id=" class="btn btn-danger mt-1 btn-sm">Hapus</a>
        </div>
        ';
        echo $output;
    }



    // Ajax
    // Controller

    public function ambilDataRPPH()
    {
        if ($this->input->is_ajax_request() == true) {
            $this->load->model('RPPHModel', 'rpph');
            $list = $this->rpph->get_datatables_rpph();
            $data = array();

            $no = $_POST['start'];
            foreach ($list as $field) {


                $no++;
                $tombolEdit = "<button type=\"button\" class=\"btn  btn-sm btn-outline-success\" title=\"Edit data\" onclick=\"edit('" . $field->RPPH_ID . "')\">
                    Edit
                </button>";
                $tombolHapus = "<button type=\"button\" class=\"btn  btn-sm btn-outline-danger ml-1\" title=\"Hapus data\" onclick=\"hapus('" . $field->RPPH_ID . "')\">
                    Hapus
                </button>";
                $tombolDetail = "<a class=\"btn  btn-sm btn-outline-primary ml-1\" title=\"Detail data\" >
                    Detail
                </a>";

                $row = array();
                $row[] = "<input type=\"checkbox\" class=\"centangPromes\" value=\"$field->RPPH_ID\" name=\"rpphID[]\">";
                $row[] = $no . ".";
                $row[] = $field->RPPH_STUDYYEAR;
                $row[] = $field->CLASS_LEVEL . '-' . $field->CLASS_NAME;
                $row[] = $field->RPPH_SEMESTER;
                $bulan = '';
                switch ($field->RPPH_MONTH) {
                    case 1:
                        $bulan = "Januari";
                        break;
                    case 2:
                        $bulan = "Februari";
                        break;
                    case 3:
                        $bulan = "Maret";
                        break;
                    case 4:
                        $bulan = "April";
                        break;
                    case 5:
                        $bulan = "Mei";
                        break;
                    case 6:
                        $bulan = "Juni";
                        break;
                    case 7:
                        $bulan = "Juli";
                        break;
                    case 8:
                        $bulan = "Agustus";
                        break;
                    case 9:
                        $bulan = "September";
                        break;
                    case 10:
                        $bulan = "Oktober";
                        break;
                    case 11:
                        $bulan = "November";
                        break;
                    case 12:
                        $bulan = "Desember";
                        break;
                };
                $row[] = $bulan;

                $row[] = $field->RPPH_WEEK;
                $row[] = $field->RPPH_THEME . '/' . $field->RPPH_SUBTHEME;
                $row[] = $tombolEdit . $tombolHapus . $tombolDetail;
                $data[] = $row;
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

    public function simpanRPPH_ajax()
    {
        if ($this->input->is_ajax_request()) {
            $RPPH = $this->RPPHModel;
            $this->form_validation->set_rules("kelasID", "Nama Kelas", 'required');
            $this->form_validation->set_rules("tahunRPPH", "Tahun RPPH", 'required');
            $this->form_validation->set_rules("semesterRPPH", "RPPH Semester", 'required');
            $this->form_validation->set_rules("bulanRPPH", "Bulan", 'required');

            $this->form_validation->set_rules("mingguRPPH", "Minggu", 'required');
            $this->form_validation->set_rules("temaRPPH", "Tema", 'required');
            $this->form_validation->set_rules("subTemaRPPH", "SubTema ", 'required');
            $this->form_validation->set_rules("strategiRPPH", "Strategi RPPH", 'required');

            if ($this->form_validation->run() != false) {
                $kelasID = $this->input->post('kelasID');
                $tahunRPPH1 = $this->input->post('tahunRPPH');
                $tahunRPPH2 = intval($tahunRPPH1) + 1;

                $tahunRPPH = $tahunRPPH1 . '/' . $tahunRPPH2;


                $bulanRPPH = $this->input->post('bulanRPPH');
                $mingguRPPH = $this->input->post('mingguRPPH');
                $temaRPPH = $this->input->post('temaRPPH');
                $subTemaRPPH = $this->input->post('subTemaRPPH');
                $strategiRPPH = $this->input->post('strategiRPPH');
                $semesterRPPH = $this->input->post('semesterRPPH');


                $data = array(
                    'CLASS_ID' => $kelasID,
                    'RPPH_STUDYYEAR' => $tahunRPPH,
                    'RPPH_SEMESTER' => $semesterRPPH,
                    'RPPH_MONTH' => $bulanRPPH,
                    'RPPH_THEME' => $temaRPPH,
                    'RPPH_SUBTHEME' => $subTemaRPPH,
                    'RPPH_WEEK' => $mingguRPPH,
                    'RPPH_STRATEGY' => $strategiRPPH
                );
                $RPPH->input_data($data, 'TBL_RPPH');
                $msg = ['sukses' => 'Data RPPH berhasil disimpan'];
            } else {
                $msg = [
                    'error' => '<div class="alert alert-warning mt-1 alert-styled-left alert-dismissible"><button type="button" class="close" data-dismiss="alert"><span>×</span></button><span class="font-weight-semibold">Warning!</span>' . validation_errors() .
                        '.</div>'
                ];
            }
            echo json_encode($msg);
        }
    }


    public function deleteMultiple_ajax()
    {
        if ($this->input->is_ajax_request() == true) {
            $rpphID = $this->input->post('rpphID');
            $jmlData = count($rpphID);
            $hapusData = $this->RPPHModel->deleteMultiple_ajax($rpphID, $jmlData);
            if ($hapusData == true) {
                $msg = ['sukses' => "data RPPH berhasil dihapus"];
            }
            echo json_encode($msg);
        } else {
            exit("Maaf Data Tidak Bisa DiLanjutkan");
        }
    }

    public function formEditRPPH()
    {
        if ($this->input->is_ajax_request() == true) {
            $rpphID = $this->input->post('rpphID');
            $result = $this->RPPHModel->getData2($rpphID);

            if ($result->num_rows() > 0) {
                $row = $result->row_array();
                $data = [
                    'RPPH_ID' => $row['RPPH_ID'],
                    'RPPH_THEME' => $row['RPPH_THEME'],
                    'CLASS_LEVEL' => $row['CLASS_LEVEL'],
                    'CLASS_ID' => $row['CLASS_ID'],
                    'CLASS_NAME' => $row['CLASS_NAME'],
                    'RPPH_STUDYYEAR' => $row['RPPH_STUDYYEAR'],
                    'RPPH_MONTH' => $row['RPPH_MONTH'],
                    'RPPH_SEMESTER' => $row['RPPH_SEMESTER'],
                    'RPPH_WEEK' => $row['RPPH_WEEK'],
                    'RPPH_STRATEGY' => $row['RPPH_STRATEGY'],
                    'RPPH_SUBTHEME' => $row['RPPH_SUBTHEME']
                ];
            }
            $msg = [
                'sukses' => $this->load->view('page/rpph/modal/modalEditRPPH', $data, true)
            ];
            echo json_encode($msg);
        }
    }

    public function hapusRPPH_ajax()
    {
        if ($this->input->is_ajax_request() == true) {
            $rpphID = $this->input->post("rpphID");
            $hapus = $this->RPPHModel->hapusRPPH_ajax($rpphID);
            if ($hapus) {
                $msg = ['sukses' => 'Data RPPH Berhasil Terhapus'];
            }
            echo json_encode($msg);
        }
    }

    public function updateRPPH_ajax()
    {
        if ($this->input->is_ajax_request()) {
            $RPPH = $this->RPPHModel;
            $this->form_validation->set_rules("kelasID", "Nama Kelas", 'required');
            $this->form_validation->set_rules("tahunRPPH", "Tahun RPPH", 'required');
            $this->form_validation->set_rules("semesterRPPH", "RPPH Semester", 'required');
            $this->form_validation->set_rules("bulanRPPH", "Bulan", 'required');

            $this->form_validation->set_rules("mingguRPPH", "Minggu", 'required');
            $this->form_validation->set_rules("temaRPPH", "Tema", 'required');
            $this->form_validation->set_rules("subTemaRPPH", "SubTema ", 'required');
            $this->form_validation->set_rules("strategiRPPH", "Strategi RPPH", 'required');


            if ($this->form_validation->run() != false) {

                $kelasID = $this->input->post('kelasID');
                $tahunRPPH = $this->input->post('tahunRPPH');
                $semesterRPPH = $this->input->post('semesterRPPH');
                $bulanRPPH = $this->input->post('bulanRPPH');
                $mingguRPPH = $this->input->post('mingguRPPH');
                $temaRPPH = $this->input->post('temaRPPH');
                $subTemaRPPH = $this->input->post('subTemaRPPH');
                $strategiRPPH = $this->input->post('strategiRPPH');
                $RPPHID = $this->input->post("RPPHID");

                $where = array(
                    "RPPH_ID" => $RPPHID
                );
                $data = array(
                    'CLASS_ID' => $kelasID,
                    'RPPH_STUDYYEAR' => $tahunRPPH,
                    'RPPH_SEMESTER' => $semesterRPPH,
                    'RPPH_MONTH' => $bulanRPPH,
                    'RPPH_THEME' => $temaRPPH,
                    'RPPH_SUBTHEME' => $subTemaRPPH,
                    'RPPH_WEEK' => $mingguRPPH,
                    'RPPH_STRATEGY' => $strategiRPPH
                );
                $RPPH->update_data($where, $data, 'TBL_RPPH');
                $msg = ['sukses' => 'Data RPPH berhasil diupdate'];
            } else {
                $msg = [
                    'error' => '<div class="alert alert-warning mt-1 alert-styled-left alert-dismissible"><button type="button" class="close" data-dismiss="alert"><span>×</span></button><span class="font-weight-semibold">Warning!</span>' . validation_errors() .
                        '.</div>'
                ];
            }

            echo json_encode($msg);
        }
    }


    // Aktivity
    public function simpanRPPHActivity_ajax()
    {
        if ($this->input->is_ajax_request()) {
            $RPPH = $this->RPPHModel;
            $this->form_validation->set_rules("RPPHID", "RPPH ID", 'required');
            $this->form_validation->set_rules("activityName", "Activity Name", 'required');
            $this->form_validation->set_rules("activityTime", "Activity Time", 'required');
            $this->form_validation->set_rules("activityTime2", "Activity Time", 'required');


            if ($this->form_validation->run() != false) {

                $RPPHID = $this->input->post('RPPHID');
                $activityName = $this->input->post('activityName');
                $activityTime1 = $this->input->post('activityTime');
                $activityTime2 = $this->input->post('activityTime2');
                $aktifitas = count($this->input->post("aktifitas"));
                $index = $this->db->query("SELECT *FROM TBL_RPPHACTDETAIL WHERE RPPHACTIVITY_ID=$RPPHID ORDER BY RPPHACTDETAIL_INDEX DESC LIMIT 1")->num_rows();
                $result2 = $this->db->query("SELECT *FROM TBL_RPPHACTDETAIL WHERE RPPHACTIVITY_ID=$RPPHID ORDER BY RPPHACTDETAIL_INDEX DESC LIMIT 1")->row();


                $waktu = str_replace(['.', ':', '::', ' AM', ' PM', ' '], ['', '', '', '', ''], $activityTime1);
                $waktu2 = str_replace(['.', ':', '::', ' AM', ' PM', ' '], ['', '', '', '', ''], $activityTime2);
                if (strlen($waktu) == 3) {
                    $waktu = '0' . $waktu;
                }
                if (strlen($waktu2) == 3) {
                    $waktu2 = '0' . $waktu2;
                }
                $activityTime = $waktu . $waktu2;

                $data = array(
                    'RPPH_ID' => $RPPHID,
                    'RPPHACTIVITY_NAME' => $activityName,
                    'RPPHACTIVITY_TIME' => $activityTime
                );
                $RPPH->input_data($data, 'TBL_RPPHACTIVITY');
                $activityQuery = $this->db->query("SELECT *FROM TBL_RPPHACTIVITY ORDER BY RPPHACTIVITY_ID DESC LIMIT 1")->row();
                $idActivity = $activityQuery->RPPHACTIVITY_ID;
                if ($aktifitas > 0) {
                    $result = intval($result2->RPPHACTDETAIL_INDEX);
                    for ($i = 0; $i < $aktifitas; $i++) {
                        $result += 1;
                        if (trim($_POST["aktifitas"][$i]) != '') {
                            $RPPHID = $this->input->post('RPPHID');
                            $this->db->query("INSERT INTO TBL_RPPHACTDETAIL(RPPHACTIVITY_ID,RPPHACTDETAIL_INDEX,RPPHACTDETAIL_DESC) VALUES ('$idActivity',$result,'" . $_POST['aktifitas'][$i] . "')");
                        }
                    }
                }
                $msg = ['sukses' => 'Data RPPH berhasil disimpan'];
            } else {
                $msg = [
                    'error' => '<div class="alert alert-warning mt-1 alert-styled-left alert-dismissible"><button type="button" class="close" data-dismiss="alert"><span>×</span></button><span class="font-weight-semibold">Warning!</span>' . validation_errors() .
                        '.</div>'
                ];
            }
            echo json_encode($msg);
        }
    }



    public function formEditRPPHActivity()
    {
        if ($this->input->is_ajax_request() == true) {

            $rpphActID = $this->input->post('rpphActID');

            $result = $this->db->query("SELECT r.RPPH_ID,sc.CLASS_ID,sc.CLASS_NAME,sc.CLASS_LEVEL,school.SCH_NAME,ra.* FROM TBL_RPPHACTIVITY ra 
            INNER JOIN TBL_RPPH r ON ra.RPPH_ID=r.RPPH_ID
            INNER JOIN TBL_SCHOOLCLASS sc ON sc.CLASS_ID=r.CLASS_ID
            INNER JOIN TBL_SCHOOL school ON school.SCH_ID=sc.SCH_ID WHERE ra.RPPHACTIVITY_ID='$rpphActID'");


            $data['queryDetail'] = $this->db->query("SELECT rad.*,r.RPPH_ID,r.RPPHACTIVITY_ID,r.RPPHACTIVITY_NAME FROM `tbl_rpphactdetail` as rad INNER JOIN tbl_rpphactivity r 
            ON r.RPPHACTIVITY_ID=rad.RPPHACTIVITY_ID")->row();



            if ($result->num_rows() > 0) {
                $row = $result->row_array();
                $data = [
                    'RPPHACTIVITY_ID' => $row['RPPHACTIVITY_ID'],
                    'CLASS_LEVEL' => $row['CLASS_LEVEL'],
                    'CLASS_ID' => $row['CLASS_ID'],
                    'RPPH_ID' => $row['RPPH_ID'],
                    'CLASS_NAME' => $row['CLASS_NAME'],
                    'RPPHACTIVITY_NAME' => $row['RPPHACTIVITY_NAME'],
                    'RPPHACTIVITY_TIME' => $row['RPPHACTIVITY_TIME'],

                ];
            }
            $msg = [
                'sukses' => $this->load->view('page/rpph/modal/modalEditActivity', $data, true)
            ];
            echo json_encode($msg);
        }
    }



    public function formDetailRPPHActivity()
    {
        if ($this->input->is_ajax_request() == true) {

            $rpphActID = $this->input->post('rpphActID');


            $result = $this->db->query("SELECT rad.*,r.RPPH_ID,r.RPPHACTIVITY_ID as activityID,r.RPPHACTIVITY_NAME FROM `tbl_rpphactivity` as r LEFT JOIN tbl_rpphactdetail rad 
            ON rad.RPPHACTIVITY_ID=r.RPPHACTIVITY_ID WHERE r.RPPHACTIVITY_ID='$rpphActID'");


            if ($result->num_rows() > 0) {
                $row = $result->row_array();
                $data = [
                    'RPPHACTIVITY_ID' => $row['activityID'],
                    'RPPHACTIVITY_NAME' => $row['RPPHACTIVITY_NAME'],
                ];
            }
            $msg = [
                'sukses' => $this->load->view('page/rpph/modal/modalDetailActivity', $data, true)
            ];

            echo json_encode($msg);
        }
    }

    public function hapusRPPHActivity_ajax()
    {
        if ($this->input->is_ajax_request() == true) {
            $rpphActID = $this->input->post("rpphActID");
            $hapus = $this->RPPHModel->hapusRPPHActivity_ajax($rpphActID);
            if ($hapus) {
                $msg = ['sukses' => 'Data Kegiatan RPPH Berhasil Terhapus'];
            }
            echo json_encode($msg);
        }
    }

    public function updateRPPHActivity_ajax()
    {
        if ($this->input->is_ajax_request()) {



            $RPPH = $this->RPPHModel;
            $this->form_validation->set_rules("RPPHID", "RPPH ID", 'required');
            $this->form_validation->set_rules("activityName", "Activity Name", 'required');
            $this->form_validation->set_rules("activityTime", "Activity Time", 'required');


            if ($this->form_validation->run() != false) {

                $RPPHID = $this->input->post('RPPHID');
                $activityName = $this->input->post('activityName');
                $activityTime1 = $this->input->post('activityTime');
                $activityTime2 = $this->input->post('activityTime2');
                $waktu = str_replace(['.', ':', ' AM', ' PM', ' '], ['', '', '', '', ''], $activityTime1);
                $waktu2 = str_replace(['.', ':', ' AM', ' PM', ' '], ['', '', '', '', ''], $activityTime2);
                if (strlen($waktu) == 3) {
                    $waktu = '0' . $waktu;
                }
                if (strlen($waktu2) == 3) {
                    $waktu2 = '0' . $waktu2;
                }
                $activityTime = $waktu . $waktu2;

                $data = array(
                    'RPPH_ID' => $RPPHID,
                    'RPPHACTIVITY_NAME' => $activityName,
                    'RPPHACTIVITY_TIME' => $activityTime
                );
                $RPPHActivityID = $this->input->post("RPPHActivityID");
                $where = array("RPPHACTIVITY_ID" => $RPPHActivityID);
                $RPPH->update_data($where, $data, 'TBL_RPPHACTIVITY');




                $msg = ['sukses' => 'Data RPPH berhasil disimpan'];
            } else {
                $msg = [
                    'error' => '<div class="alert alert-warning mt-1 alert-styled-left alert-dismissible"><button type="button" class="close" data-dismiss="alert"><span>×</span></button><span class="font-weight-semibold">Warning!</span>' . validation_errors() .
                        '.</div>'
                ];
            }
            echo json_encode($msg);
        }
    }

    public function updateRPPHActivityDetail_ajax()
    {
        if ($this->input->is_ajax_request()) {

            $RPPH = $this->RPPHModel;
            $this->form_validation->set_rules("RPPHActivityID", "RPPH Activity ID", 'required');



            if ($this->form_validation->run() != false) {

                $RPPHActivityID = $this->input->post('RPPHActivityID');

                $actDetailIndex = $this->input->post('actDetailIndex');
                $aktifitas = count($this->input->post('aktifitas'));
                $RPPHACTINDEX = $this->input->post("RPPHACTINDEX");
                if ($aktifitas > 0) {
                    for ($i = 0; $i < $aktifitas; $i++) {
                        $result += 1;
                        if (trim($_POST["aktifitas"][$i]) != '') {
                            $RPPHActivityID = $this->input->post('RPPHActivityID');
                            $this->db->query("UPDATE TBL_RPPHACTDETAIL SET RPPHACTDETAIL_DESC='" . $_POST['aktifitas'][$i] . "' WHERE  RPPHACTDETAIL_INDEX='" . $_POST['RPPHACTINDEX'][$i] . "'");
                        }
                    }
                }

                $msg = ['sukses' => 'Data RPPH berhasil disimpan'];
            } else {
                $msg = [
                    'error' => '<div class="alert alert-warning mt-1 alert-styled-left alert-dismissible"><button type="button" class="close" data-dismiss="alert"><span>×</span></button><span class="font-weight-semibold">Warning!</span>' . validation_errors() .
                        '.</div>'
                ];
            }
            echo json_encode($msg);
        }
    }


    public function simpanDetailRPPHActivity_ajax()
    {
        if ($this->input->is_ajax_request()) {


            $RPPH = $this->RPPHModel;
            $this->form_validation->set_rules("RPPHActivityID", "RPPH Activity ID", 'required');
            if ($this->form_validation->run() != false) {
                $aktifitasDetail = count($this->input->post("aktifitasDetail"));
                $idActivity = $this->input->post('RPPHActivityID');
                $result2 = $this->db->query("SELECT *FROM TBL_RPPHACTDETAIL WHERE RPPHACTIVITY_ID=$idActivity ORDER BY RPPHACTDETAIL_INDEX DESC LIMIT 1");
                $result2 = $result2->row();
                if ($aktifitasDetail > 0) {
                    if (!empty($result2->RPPHACTDETAIL_INDEX)) {
                        $result = intval($result2->RPPHACTDETAIL_INDEX);
                    } else {
                        $result = 1;
                    }

                    for ($i = 0; $i < $aktifitasDetail; $i++) {
                        $result += 1;
                        if (trim($_POST["aktifitasDetail"][$i]) != '') {
                            $RPPHID = $this->input->post('RPPHID');
                            $this->db->query("INSERT INTO TBL_RPPHACTDETAIL(RPPHACTIVITY_ID,RPPHACTDETAIL_INDEX,RPPHACTDETAIL_DESC) VALUES ('$idActivity',$result,'" . $_POST['aktifitasDetail'][$i] . "')");
                        }
                    }
                }
                $msg = ['sukses' => 'Data RPPH berhasil disimpan'];
            } else {
                $msg = [
                    'error' => '<div class="alert alert-warning mt-1 alert-styled-left alert-dismissible"><button type="button" class="close" data-dismiss="alert"><span>×</span></button><span class="font-weight-semibold">Warning!</span>' . validation_errors() .
                        '.</div>'
                ];
            }
            echo json_encode($msg);
        }
    }


    // Learning
    public function simpanRPPHLearning_ajax()
    {
        if ($this->input->is_ajax_request()) {

            $RPPH = $this->RPPHModel;
            $this->form_validation->set_rules("RPPHID", "RPPH ID", 'required');
            if ($this->form_validation->run() != false) {

                $RPPHID = $this->input->post('RPPHID');
                $kodeLearning = count($this->input->post('kodeLearning'));
                $teoriLearning = count($this->input->post('teoriLearning'));
                $tujuanLearning = count($this->input->post('tujuanLearning'));

                if ($kodeLearning > 0 && $teoriLearning > 0 && $tujuanLearning > 0) {
                    for ($i = 0; $i < $kodeLearning; $i++) {
                        if (trim($_POST["kodeLearning"][$i]) != '') {
                            $RPPHID = $this->input->post('RPPHID');
                            $this->db->query("INSERT INTO TBL_RPPHLearning(RPPH_ID,RPPHLearning_CODE,RPPHLearning_THEORY,RPPHLearning_GOAL) VALUES ('$RPPHID','" . $_POST['kodeLearning'][$i] . "','" . $_POST['teoriLearning'][$i] . "','" . $_POST['tujuanLearning'][$i] . "')");
                        }
                    }
                }

                $msg = ['sukses' => 'Data Pembelajaran RPPH berhasil disimpan'];
            } else {
                $msg = [
                    'error' => '<div class="alert alert-warning mt-1 alert-styled-left alert-dismissible"><button type="button" class="close" data-dismiss="alert"><span>×</span></button><span class="font-weight-semibold">Warning!</span>' . validation_errors() .
                        '.</div>'
                ];
            }
            echo json_encode($msg);
        }
    }


    public function updateRPPHLearning_ajax()
    {
        if ($this->input->is_ajax_request()) {
            $RPPH = $this->RPPHModel;
            $this->form_validation->set_rules("RPPHID", "RPPH ID", 'required');
            $this->form_validation->set_rules("aktifitasMaterial", "Material Activity", 'required');
            $this->form_validation->set_rules("peralatanMaterial", "Material Tools", 'required');



            if ($this->form_validation->run() != false) {

                $RPPHID = $this->input->post('RPPHID');
                $aktifitasMaterial = $this->input->post('aktifitasMaterial');
                $RPPHMaterialID = $this->input->post('RPPHMaterialID');
                $peralatanMaterial = $this->input->post('peralatanMaterial');

                $data = array(
                    'RPPH_ID' => $RPPHID,
                    'RPPHMaterial_ACTIVITY' => $aktifitasMaterial,
                    'RPPHMaterial_TOOLS' => $peralatanMaterial
                );

                $where = array("RPPHMATERIAL_ID" => $RPPHMaterialID);
                $RPPH->update_data($where, $data, 'TBL_RPPHMATERIAL');
                $msg = ['sukses' => 'Data Pembelajaran RPPH berhasil Diupdate'];
            } else {
                $msg = [
                    'error' => '<div class="alert alert-warning mt-1 alert-styled-left alert-dismissible"><button type="button" class="close" data-dismiss="alert"><span>×</span></button><span class="font-weight-semibold">Warning!</span>' . validation_errors() .
                        '.</div>'
                ];
            }
            echo json_encode($msg);
        }
    }


    public function hapusRPPHLearning_ajax()
    {
        if ($this->input->is_ajax_request() == true) {
            $rpphMaterialID = $this->input->post("rpphMaterialID");
            $hapus = $this->RPPHModel->hapusRPPHMaterial_ajax($rpphMaterialID);
            if ($hapus) {
                $msg = ['sukses' => 'Data Bahan Pembelajaran RPPH Berhasil Terhapus'];
            }
            echo json_encode($msg);
        }
    }

    public function formEditRPPHLearning()
    {
        if ($this->input->is_ajax_request() == true) {
            $rpphLearnID = $this->input->post('rpphLearnID');
            $result = $this->db->query("SELECT r.*,rl.*,sc.CLASS_LEVEL,sc.CLASS_NAME,s.SCH_NAME FROM TBL_RPPHLEARNING rl 
            INNER JOIN TBL_RPPH r ON rl.RPPH_ID=r.RPPH_ID
            INNER JOIN TBL_SCHOOLCLASS sc ON sc.CLASS_ID=r.CLASS_ID
            INNER JOIN TBL_SCHOOL s ON s.SCH_ID=sc.SCH_ID WHERE rl.RPPHLEARNING_ID='$rpphLearnID'");

            if ($result->num_rows() > 0) {
                $row = $result->row_array();
                $data = [
                    'RPPH_ID' => $row['RPPH_ID'],
                    'RPPHLEARNING_THEORY' => $row['RPPHLEARNING_THEORY'],
                    'RPPHLEARNING_GOAL' => $row['RPPHLEARNING_GOAL'],
                    'RPPHLEARNING_CODE' => $row['RPPHLEARNING_CODE'],
                    'RPPHLEARNING_ID' => $row['RPPHLEARNING_ID'],
                    'CLASS_LEVEL' => $row['CLASS_LEVEL'],
                    'CLASS_NAME' => $row['CLASS_NAME']
                ];
            }
            $msg = [
                'sukses' => $this->load->view('page/rpph/modal/modalEditLearning', $data, true)
            ];
            echo json_encode($msg);
        }
    }

    // Material

    public function simpanRPPHMaterial_ajax()
    {
        if ($this->input->is_ajax_request()) {

            $RPPH = $this->RPPHModel;
            $this->form_validation->set_rules("RPPHID", "RPPH ID", 'required');

            if ($this->form_validation->run() != false) {

                $RPPHID = $this->input->post('RPPHID');
                $aktifitasMaterial = count($this->input->post('aktifitasMaterial'));
                $peralatanMaterial = count($this->input->post('peralatanMaterial'));

                if ($aktifitasMaterial > 0 && $peralatanMaterial > 0) {
                    for ($i = 0; $i < $aktifitasMaterial; $i++) {
                        if (trim($_POST["aktifitasMaterial"][$i]) != '') {
                            $RPPHID = $this->input->post('RPPHID');
                            $this->db->query("INSERT INTO TBL_RPPHMATERIAL(RPPH_ID,RPPHMATERIAL_ACTIVITY,RPPHMATERIAL_TOOLS) VALUES ('$RPPHID','" . $_POST['aktifitasMaterial'][$i] . "','" . $_POST['peralatanMaterial'][$i] . "')");
                        }
                    }
                }

                $msg = ['sukses' => 'Data Pembelajaran RPPH berhasil disimpan'];
            } else {
                $msg = [
                    'error' => '<div class="alert alert-warning mt-1 alert-styled-left alert-dismissible"><button type="button" class="close" data-dismiss="alert"><span>×</span></button><span class="font-weight-semibold">Warning!</span>' . validation_errors() .
                        '.</div>'
                ];
            }
            echo json_encode($msg);
        }
    }


    public function updateRPPHMaterial_ajax()
    {
        if ($this->input->is_ajax_request()) {
            $RPPH = $this->RPPHModel;
            $this->form_validation->set_rules("RPPHID", "RPPH ID", 'required');
            $this->form_validation->set_rules("aktifitasMaterial", "Material Activity", 'required');
            $this->form_validation->set_rules("peralatanMaterial", "Material Tools", 'required');



            if ($this->form_validation->run() != false) {

                $RPPHID = $this->input->post('RPPHID');
                $aktifitasMaterial = $this->input->post('aktifitasMaterial');
                $RPPHMaterialID = $this->input->post('RPPHMaterialID');
                $peralatanMaterial = $this->input->post('peralatanMaterial');

                $data = array(
                    'RPPH_ID' => $RPPHID,
                    'RPPHMaterial_ACTIVITY' => $aktifitasMaterial,
                    'RPPHMaterial_TOOLS' => $peralatanMaterial
                );

                $where = array("RPPHMATERIAL_ID" => $RPPHMaterialID);
                $RPPH->update_data($where, $data, 'TBL_RPPHMATERIAL');
                $msg = ['sukses' => 'Data Pembelajaran RPPH berhasil Diupdate'];
            } else {
                $msg = [
                    'error' => '<div class="alert alert-warning mt-1 alert-styled-left alert-dismissible"><button type="button" class="close" data-dismiss="alert"><span>×</span></button><span class="font-weight-semibold">Warning!</span>' . validation_errors() .
                        '.</div>'
                ];
            }
            echo json_encode($msg);
        }
    }


    public function hapusRPPHMaterial_ajax()
    {
        if ($this->input->is_ajax_request() == true) {
            $rpphMaterialID = $this->input->post("rpphMaterialID");
            $hapus = $this->RPPHModel->hapusRPPHLearning_ajax($rpphMaterialID);
            if ($hapus) {
                $msg = ['sukses' => 'Data Kegiatan Pembelajaran RPPH Berhasil Terhapus'];
            }
            echo json_encode($msg);
        }
    }

    public function formEditRPPHMaterial()
    {
        if ($this->input->is_ajax_request() == true) {
            $rpphMaterialID = $this->input->post('rpphMaterialID');
            $result = $this->db->query("SELECT r.*,rm.*,sc.CLASS_LEVEL,sc.CLASS_NAME,s.SCH_NAME FROM TBL_RPPHMATERIAL rm 
            INNER JOIN TBL_RPPH r ON rm.RPPH_ID=r.RPPH_ID
            INNER JOIN TBL_SCHOOLCLASS sc ON sc.CLASS_ID=r.CLASS_ID
            INNER JOIN TBL_SCHOOL s ON s.SCH_ID=sc.SCH_ID WHERE rm.RPPHMATERIAL_ID='$rpphMaterialID'");

            if ($result->num_rows() > 0) {
                $row = $result->row_array();
                $data = [
                    'RPPH_ID' => $row['RPPH_ID'],
                    'RPPHMATERIAL_ACTIVITY' => $row['RPPHMATERIAL_ACTIVITY'],
                    'RPPHMATERIAL_TOOLS' => $row['RPPHMATERIAL_TOOLS'],
                    'RPPHMATERIAL_ID' => $row['RPPHMATERIAL_ID'],
                    'CLASS_LEVEL' => $row['CLASS_LEVEL'],
                    'CLASS_NAME' => $row['CLASS_NAME']
                ];
            }
            $msg = [
                'sukses' => $this->load->view('page/rpph/modal/modalEditMaterial', $data, true)
            ];
            echo json_encode($msg);
        }
    }

    // Indikator Technique

    public function simpanRPPHTeknik_ajax()
    {
        if ($this->input->is_ajax_request()) {

            $RPPH = $this->RPPHModel;
            $this->form_validation->set_rules("RPPHID", "RPPH ID", 'required');
            if ($this->form_validation->run() != false) {
                $valTechniqueDesc = count($this->input->post('valTechniqueDesc'));
                if ($valTechniqueDesc > 0) {
                    for ($i = 0; $i < $valTechniqueDesc; $i++) {
                        if (trim($_POST["valTechniqueDesc"][$i]) != '') {
                            $RPPHID = $this->input->post('RPPHID');
                            $this->db->query("INSERT INTO TBL_RPPHVALUATIONTECHNIQUE(RPPH_ID,RPPHVALTECH_DESC) VALUES ('$RPPHID','" . $_POST['valTechniqueDesc'][$i] . "')");
                        }
                    }
                }
                $msg = ['sukses' => 'Data Pembelajaran RPPH berhasil disimpan'];
            } else {
                $msg = [
                    'error' => '<div class="alert alert-warning mt-1 alert-styled-left alert-dismissible"><button type="button" class="close" data-dismiss="alert"><span>×</span></button><span class="font-weight-semibold">Warning!</span>' . validation_errors() .
                        '.</div>'
                ];
            }
            echo json_encode($msg);
        }
    }


    public function updateRPPHTeknik_ajax()
    {
        if ($this->input->is_ajax_request()) {
            $RPPH = $this->RPPHModel;
            $this->form_validation->set_rules("RPPHID", "RPPH ID", 'required');
            $this->form_validation->set_rules("valTechniqueDesc", "Valuation Technique Desc", 'required');

            if ($this->form_validation->run() != false) {

                $RPPHID = $this->input->post('RPPHID');
                $RPPHVALTECH = $this->input->post('RPPHVALTECH');
                $valTechniqueDesc = $this->input->post('valTechniqueDesc');

                $data = array(
                    'RPPH_ID' => $RPPHID,
                    'RPPHVALTECH_DESC' => $valTechniqueDesc
                );

                $where = array("RPPHVALTECH_ID" => $RPPHVALTECH);
                $RPPH->update_data($where, $data, 'TBL_RPPHVALUATIONTECHNIQUE');
                $msg = ['sukses' => 'Data Teknik RPPH berhasil Diupdate'];
            } else {
                $msg = [
                    'error' => '<div class="alert alert-warning mt-1 alert-styled-left alert-dismissible"><button type="button" class="close" data-dismiss="alert"><span>×</span></button><span class="font-weight-semibold">Warning!</span>' . validation_errors() .
                        '.</div>'
                ];
            }
            echo json_encode($msg);
        }
    }


    public function hapusRPPHTeknik_ajax()
    {
        if ($this->input->is_ajax_request() == true) {
            $rpphTeknikID = $this->input->post("rpphTeknikID");
            $hapus = $this->RPPHModel->hapusRPPHTechnique_ajax($rpphTeknikID);
            if ($hapus) {
                $msg = ['sukses' => 'Data Teknik RPPH Berhasil Terhapus'];
            }
            echo json_encode($msg);
        }
    }

    public function formEditRPPHTeknik()
    {
        if ($this->input->is_ajax_request() == true) {
            $rpphTeknikID = $this->input->post('rpphTeknikID');
            $result = $this->db->query("SELECT rvt.*, sc.CLASS_LEVEL,sc.CLASS_NAME,r.RPPH_STUDYYEAR,r.RPPH_THEME FROM TBL_RPPHVALUATIONTECHNIQUE rvt INNER JOIN TBL_RPPH r ON r.RPPH_ID=rvt.RPPH_ID
            INNER JOIN tbl_schoolclass sc ON sc.CLASS_ID=r.CLASS_ID WHERE rvt.RPPHVALTECH_ID='$rpphTeknikID'");

            if ($result->num_rows() > 0) {
                $row = $result->row_array();
                $data = [
                    'RPPH_ID' => $row['RPPH_ID'],
                    'RPPHVALTECH_DESC' => $row['RPPHVALTECH_DESC'],
                    'RPPHVALTECH_ID' => $row['RPPHVALTECH_ID'],
                ];
            }
            $msg = [
                'sukses' => $this->load->view('page/rpph/modal/modalEditTeknik', $data, true)
            ];
            echo json_encode($msg);
        }
    }

    // RPPH Val Indicator
    public function simpanRPPHValIndicator_ajax()
    {
        if ($this->input->is_ajax_request()) {
            $RPPH = $this->RPPHModel;
            $this->form_validation->set_rules("RPPHID", "RPPH ID", 'required');
            $this->form_validation->set_rules("descValuasi", "Valuation Deskripsi", 'required');
            // $this->form_validation->set_rules("valIndicatorIndex", "Valuation Indicator Index", 'required');
            // $this->form_validation->set_rules("detailCode", "Valuation Indicator Code", 'required');
            // $this->form_validation->set_rules("detailTeknik", "Valuation Indicator Teknik", 'required');
            // $this->form_validation->set_rules("detailIndikator", "Valuation Indicator Detail", 'required');



            if ($this->form_validation->run() != false) {

                $RPPHID = $this->input->post('RPPHID');

                $result2 = $this->db->query("SELECT *FROM TBL_RPPHVALUATIONINDICATOR WHERE RPPH_ID=$RPPHID ORDER BY RPPHVALINDICATOR_INDEX DESC LIMIT 1");
                $resultCount = $result2->num_rows();
                if ($resultCount > 0) {
                    $result = intval($result2->row()->RPPHVALINDICATOR_INDEX);
                    $result += 1;
                } else {
                    $result = intval(1);
                }

                $descValuasi = $this->input->post('descValuasi');
                $detailCode = count($this->input->post("detailCode"));
                $detailTeknik = count($this->input->post("detailTeknik"));
                $detailIndikator = count($this->input->post("detailIndikator"));

                $data = array(
                    'RPPH_ID' => $RPPHID,
                    'RPPHVALINDICATOR_INDEX' => $result,
                    'RPPHVALINDICATOR_DESC' => $descValuasi
                );
                $RPPH->input_data($data, 'TBL_RPPHVALUATIONINDICATOR');
                if ($detailCode > 0 && $detailTeknik > 0 && $detailIndikator > 0) {
                    $resultCount = $this->input->post('RPPHID');
                    if ($resultCount > 0) {
                        $result = intval($result2->RPPHVALINDICATOR_INDEX);
                    } else {
                        $result = intval(1);
                    }

                    for ($i = 0; $i < $detailCode; $i++) {
                        $result += 1;
                        if (trim($_POST["detailCode"][$i]) != '') {
                            $RPPHID = $this->input->post('RPPHID');
                            $this->db->query("INSERT INTO TBL_RPPHVALINDICATORDETAIL(RPPH_ID,RPPHVALINDICATOR_INDEX,RPPHVALINDDET_CODE,RPPHVALINDDET_TECHNIQUE,RPPHVALINDDET_INDICATOR) VALUES ('$RPPHID','$result','" . $_POST['detailCode'][$i] . "','" . $_POST['detailTeknik'][$i] . "','" . $_POST['detailIndikator'][$i] . "')");
                        }
                    }
                }
                $msg = ['sukses' => 'Data RPPH berhasil disimpan'];
            } else {
                $msg = [
                    'error' => '<div class="alert alert-warning mt-1 alert-styled-left alert-dismissible"><button type="button" class="close" data-dismiss="alert"><span>×</span></button><span class="font-weight-semibold">Warning!</span>' . validation_errors() .
                        '.</div>'
                ];
            }
            echo json_encode($msg);
        }
    }



    public function formEditRPPHValIndicator()
    {
        if ($this->input->is_ajax_request() == true) {

            $rpphValIndicatorID = $this->input->post('rpphValIndicatorID');

            $result = $this->db->query("SELECT rvi.*,sc.CLASS_ID,s.SCH_NAME,r.RPPH_ID, sc.CLASS_LEVEL,sc.CLASS_NAME,r.RPPH_STUDYYEAR,r.RPPH_THEME FROM TBL_RPPHVALUATIONINDICATOR rvi INNER JOIN TBL_RPPH r ON r.RPPH_ID=rvi.RPPH_ID        
            INNER JOIN tbl_schoolclass sc ON sc.CLASS_ID=r.CLASS_ID
                    INNER JOIN tbl_school s ON s.SCH_ID=sc.SCH_ID WHERE rvi.RPPHVALINDICATOR_INDEX='$rpphValIndicatorID'");


            if ($result->num_rows() > 0) {
                $row = $result->row_array();
                $data = [
                    'RPPHVALINDICATOR_INDEX' => $row['RPPHVALINDICATOR_INDEX'],
                    'CLASS_LEVEL' => $row['CLASS_LEVEL'],
                    'CLASS_ID' => $row['CLASS_ID'],
                    'RPPH_ID' => $row['RPPH_ID'],
                    'CLASS_NAME' => $row['CLASS_NAME'],
                    'RPPHVALINDICATOR_DESC' => $row['RPPHVALINDICATOR_DESC']
                ];
            }
            $msg = [
                'sukses' => $this->load->view('page/rpph/modal/modalEditValIndicator', $data, true)
            ];
            echo json_encode($msg);
        }
    }



    public function formDetailRPPHValIndicator()
    {
        if ($this->input->is_ajax_request() == true) {

            $rpphValIndex = $this->input->post('rpphValIndex');


            $result = $this->db->query("SELECT rad.*,r.RPPH_ID,r.RPPHVALINDICATOR_INDEX as indicatorIndex,r.RPPHVALINDICATOR_DESC FROM `tbl_rpphvaluationindicator` as r LEFT JOIN tbl_rpphvalindicatordetail rad 
            ON rad.RPPHVALINDICATOR_INDEX=r.RPPHVALINDICATOR_INDEX WHERE r.RPPHVALINDICATOR_INDEX='$rpphValIndex'");


            if ($result->num_rows() > 0) {
                $row = $result->row_array();
                $data = [
                    'RPPHVALINDICATOR_DESC' => $row['RPPHVALINDICATOR_DESC'],
                    'RPPH_ID' => $row['RPPH_ID'],
                    'RPPHVALINDICATOR_INDEX' => $row['RPPHVALINDICATOR_INDEX']
                ];
            }
            $msg = [
                'sukses' => $this->load->view('page/rpph/modal/modalDetailValIndicator', $data, true)
            ];

            echo json_encode($msg);
        }
    }

    public function hapusRPPHValIndicator_ajax()
    {
        if ($this->input->is_ajax_request() == true) {
            $rpphValId = $this->input->post("rpphValId");
            $hapus = $this->RPPHModel->hapusRPPHActivity_ajax($rpphValId);
            if ($hapus) {
                $msg = ['sukses' => 'Data Val Indikator RPPH Berhasil Terhapus'];
            }
            echo json_encode($msg);
        }
    }

    public function updateRPPHValIndicator_ajax()
    {
        if ($this->input->is_ajax_request()) {

            $RPPH = $this->RPPHModel;
            $this->form_validation->set_rules("RPPHID", "RPPH ID", 'required');
            // $this->form_validation->set_rules("valIndicatorIndex", "Valuation Indicator Index", 'required|is_unique[TBL_RPPHVALUATIONINDICATOR.RPPHVALINDICATOR_INDEX]');
            $this->form_validation->set_rules("valIndicatorDesc", "Valuation Indicator Desc", 'required');

            if ($this->form_validation->run() != false) {

                $RPPHID = $this->input->post('RPPHID');
                $valIndicatorIndex = $this->input->post('RPPHValIndikatorID');
                $valIndicatorDesc = $this->input->post('valIndicatorDesc');

                $data = array(
                    'RPPH_ID' => $RPPHID,
                    'RPPHVALINDICATOR_INDEX' => $valIndicatorIndex,
                    'RPPHVALINDICATOR_DESC' => $valIndicatorDesc
                );
                $where = array("RPPHVALINDICATOR_INDEX" => $valIndicatorIndex);
                $RPPH->update_data($where, $data, 'TBL_RPPHVALUATIONINDICATOR');


                $msg = ['sukses' => 'Data RPPH berhasil disimpan'];
            } else {
                $msg = [
                    'error' => '<div class="alert alert-warning mt-1 alert-styled-left alert-dismissible"><button type="button" class="close" data-dismiss="alert"><span>×</span></button><span class="font-weight-semibold">Warning!</span>' . validation_errors() .
                        '.</div>'
                ];
            }
            echo json_encode($msg);
        }
    }

    public function updateRPPHValIndicatorDetail_ajax()
    {
        if ($this->input->is_ajax_request()) {
            $RPPH = $this->RPPHModel;

            $RPPHActivityID = $this->input->post('RPPHActivityID');

            $RPPHVALINDEX = count($this->input->post('RPPHVALINDEX'));
            $detailCode = count($this->input->post("detailCode"));

            if ($detailCode > 0) {
                for ($i = 0; $i < $detailCode; $i++) {
                    if (trim($_POST["detailCode"][$i]) != '') {
                        $this->db->query("UPDATE TBL_RPPHVALINDICATORDETAIL SET RPPHVALINDDET_TECHNIQUE='" . $_POST['detailTeknik'][$i] . "',RPPHVALINDDET_INDICATOR='" . $_POST['detailIndikator'][$i] . "' WHERE  RPPHVALINDDET_CODE='" . $_POST['RPPHVALINDEX'][$i] . "'");
                    }
                }
            }
            $msg = ['sukses' => 'Data Valuasi Indikator RPPH berhasil disimpan'];

            echo json_encode($msg);
        }
    }


    public function simpanDetailRPPHValIndicator_ajax()
    {
        if ($this->input->is_ajax_request()) {

            $RPPH = $this->RPPHModel;
            $this->form_validation->set_rules("RPPHID", "RPPH ID", 'required');
            if ($this->form_validation->run() != false) {
                $RPPHID = $this->input->post('RPPHID');
                $RPPHVALINDEX = $this->input->post('RPPHVALINDEX');
                $detailCode = count($this->input->post("detailCode"));
                $idActivity = $this->input->post('RPPHActivityID');
                $result2 = $this->db->query("SELECT *FROM TBL_RPPHVALINDICATORDETAIL WHERE RPPH_ID='$RPPHID' ORDER BY RPPHVALINDICATOR_INDEX DESC LIMIT 1");
                $resultCount = $result2->num_rows();
                if ($resultCount > 0) {
                    $result = intval($result2->row()->RPPHVALINDICATOR_INDEX);
                } else {
                    $result = intval(1);
                }
                if ($detailCode > 0) {
                    for ($i = 0; $i < $detailCode; $i++) {
                        $result += 1;
                        if (trim($_POST["detailCode"][$i]) != '') {
                            $RPPHID = $this->input->post('RPPHID');
                            $this->db->query("INSERT INTO TBL_RPPHVALINDICATORDETAIL(RPPH_ID,RPPHVALINDICATOR_INDEX,RPPHVALINDDET_CODE,RPPHVALINDDET_TECHNIQUE,RPPHVALINDDET_INDICATOR) VALUES ('$RPPHID','$RPPHVALINDEX','" . $_POST['detailCode'][$i] . "','" . $_POST['detailTeknik'][$i] . "','" . $_POST['detailIndikator'][$i] . "')");
                        }
                    }
                }
                $msg = ['sukses' => 'Data RPPH berhasil disimpan'];
            } else {
                $msg = [
                    'error' => '<div class="alert alert-warning mt-1 alert-styled-left alert-dismissible"><button type="button" class="close" data-dismiss="alert"><span>×</span></button><span class="font-weight-semibold">Warning!</span>' . validation_errors() .
                        '.</div>'
                ];
            }
            echo json_encode($msg);
        }
    }

    function delete_detail_val()
    {
        $valIndex = $this->input->post('valIndex');
        $this->db->where('RPPHVALINDDET_CODE', $valIndex);
        $result = $this->db->delete('TBL_RPPHVALINDICATORDETAIL');
        $msg = [
            'sukses' => '<div class="alert alert-success mt-1 alert-styled-left alert-dismissible"><button type="button" class="close" data-dismiss="alert"><span>×</span></button><span class="font-weight-semibold">Data Berhasil Dihapus!</span>.</div>'
        ];
        echo json_encode($msg);
    }
}
