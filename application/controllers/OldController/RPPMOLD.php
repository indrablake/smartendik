<?php
defined('BASEPATH') or exit('No direct script access allowed');

class RPPM extends CI_Controller
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
     * @see https://codeigniter.com/RPPM_guide/general/urls.html
     */


    public function __construct()
    {
        parent::__construct();
        $this->load->model("RPPMModel");
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
        $data['main_menu'] = 'RPPM';
        $data['sub_menu'] = 'home';
        $this->load->view('index', $data);
    }
    public function listRPPM()
    {
        $data['query'] = $this->db->query("SELECT sc.CLASS_ID,sc.CLASS_NAME,sc.CLASS_LEVEL, r.* FROM TBL_RPPM r INNER JOIN TBL_SCHOOLCLASS sc ON sc.CLASS_ID=r.CLASS_ID")->result_array();
        $data['head'] = 'include/head';
        $data['header'] = 'include/header';
        $data['menu'] = 'include/menu';
        $data['content'] = 'page/RPPM/listRPPM';
        $data['footer'] = 'include/footer';
        $data['title'] = 'Daftar RPPM';
        $data['main_menu'] = 'RPPM';
        $data['sub_menu'] = 'listRPPM';
        $this->load->view('index', $data);
    }

    public function tambahRPPM()
    {

        $data['head'] = 'include/head';
        $data['header'] = 'include/header';
        $data['menu'] = 'include/menu';
        $data['content'] = 'page/RPPM/tambahRPPM';
        $data['footer'] = 'include/footer';
        $data['title'] = 'Tambah RPPM ';
        $data['main_menu'] = 'RPPM';
        $data['sub_menu'] = 'tambahRPPM';
        $this->load->view('index', $data);
    }

    public function editRPPM()
    {
        $id = $this->input->get("id");
        $data['isi_value'] = $this->RPPMModel->getData($id);
        $data['head'] = 'include/head';
        $data['header'] = 'include/header';
        $data['menu'] = 'include/menu';
        $data['content'] = 'page/RPPM/editRPPM';
        $data['footer'] = 'include/footer';
        $data['title'] = 'Edit RPPM ';
        $data['main_menu'] = 'RPPM';
        $data['sub_menu'] = 'editRPPM';
        $this->load->view('index', $data);
    }

    public function simpanRPPM()
    {

        $RPPM = $this->RPPMModel;
        $this->form_validation->set_rules("kelasID", "Nama Kelas", 'required');
        $this->form_validation->set_rules("tahunRPPM", "Tahun RPPM", 'required');
        $this->form_validation->set_rules("semesterRPPM", "RPPM Semester", 'required');
        $this->form_validation->set_rules("bulanRPPM", "Bulan", 'required');

        $this->form_validation->set_rules("mingguRPPM", "Minggu", 'required');
        $this->form_validation->set_rules("temaRPPM", "Tema", 'required');
        $this->form_validation->set_rules("subTemaRPPM", "SubTema ", 'required');
        $this->form_validation->set_rules("modelPembelajaran", "Model Pembelajaran", 'required');


        if ($this->form_validation->run() != false) {

            $kelasID = $this->input->post('kelasID');
            $tahun1 = $this->input->post('tahunRPPM');
            $tahun2 = intval($tahun1) + 1;
            $tahunRPPM = $tahun1 . '/' . $tahun2;
            $semesterRPPM = $this->input->post('semesterRPPM');
            $bulanRPPM = $this->input->post('bulanRPPM');
            $mingguRPPM = $this->input->post('mingguRPPM');
            $temaRPPM = $this->input->post('temaRPPM');
            $subTemaRPPM = $this->input->post('subTemaRPPM');
            $modelPembelajaran = $this->input->post('modelPembelajaran');


            $data = array(
                'CLASS_ID' => $kelasID,
                'RPPM_STUDYYEAR' => $tahunRPPM,
                'RPPM_SEMESTER' => $semesterRPPM,
                'RPPM_MONTH' => $bulanRPPM,
                'RPPM_THEME' => $temaRPPM,
                'RPPM_SUBTHEME' => $subTemaRPPM,
                'RPPM_WEEK' => $mingguRPPM,
                'RPPM_STUDYMODEL' => $modelPembelajaran
            );
            $RPPM->input_data($data, 'TBL_RPPM');
            $this->session->set_flashdata('success', 'Berhasil disimpan');

            redirect("listRPPM");
        } else {
            $this->session->set_flashdata('success', 'Gagal disimpan');
            $data['head'] = 'include/head';
            $data['header'] = 'include/header';
            $data['menu'] = 'include/menu';
            $data['content'] = 'page/RPPM/tambahRPPM';
            $data['footer'] = 'include/footer';
            $data['title'] = 'Tambah RPPM ';
            $data['main_menu'] = 'RPPM';
            $data['sub_menu'] = 'tambahRPPM';
            $this->load->view('index', $data);
        }
    }

    public function updateRPPM()
    {

        $RPPM = $this->RPPMModel;
        $this->form_validation->set_rules("kelasID", "Nama Kelas", 'required');
        $this->form_validation->set_rules("tahunRPPM", "Tahun RPPM", 'required');
        $this->form_validation->set_rules("semesterRPPM", "RPPM Semester", 'required');
        $this->form_validation->set_rules("bulanRPPM", "Bulan", 'required');

        $this->form_validation->set_rules("mingguRPPM", "Minggu", 'required');
        $this->form_validation->set_rules("temaRPPM", "Tema", 'required');
        $this->form_validation->set_rules("subTemaRPPM", "SubTema ", 'required');
        $this->form_validation->set_rules("modelPembelajaran", "Model Pembelajaran", 'required');


        if ($this->form_validation->run() != false) {

            $kelasID = $this->input->post('kelasID');
            $tahunRPPM = $this->input->post('tahunRPPM');
            $semesterRPPM = $this->input->post('semesterRPPM');
            $bulanRPPM = $this->input->post('bulanRPPM');
            $mingguRPPM = $this->input->post('mingguRPPM');
            $temaRPPM = $this->input->post('temaRPPM');
            $subTemaRPPM = $this->input->post('subTemaRPPM');
            $modelPembelajaran = $this->input->post('modelPembelajaran');
            $RPPMID = $this->input->post("RPPMID");

            $where = array(
                "RPPM_ID" => $RPPMID
            );
            $data = array(
                'CLASS_ID' => $kelasID,
                'RPPM_STUDYYEAR' => $tahunRPPM,
                'RPPM_SEMESTER' => $semesterRPPM,
                'RPPM_MONTH' => $bulanRPPM,
                'RPPM_THEME' => $temaRPPM,
                'RPPM_SUBTHEME' => $subTemaRPPM,
                'RPPM_WEEK' => $mingguRPPM,
                'RPPM_STUDYMODEL' => $modelPembelajaran
            );
            $RPPM->update_data($where, $data, 'TBL_RPPM');
            $this->session->set_flashdata('success', 'Berhasil Diedit');

            redirect("listRPPM");
        } else {
            $this->session->set_flashdata('success', 'Gagal Diedit');
            $data['head'] = 'include/head';
            $data['header'] = 'include/header';
            $data['menu'] = 'include/menu';
            $data['content'] = 'page/RPPM/tambahRPPM';
            $data['footer'] = 'include/footer';
            $data['title'] = 'Tambah RPPM ';
            $data['main_menu'] = 'RPPM';
            $data['sub_menu'] = 'tambahRPPM';
            $this->load->view('index', $data);
        }
    }

    // RPPM Activity
    public function listRPPMActivity()
    {
        $data['query'] = $this->db->query("SELECT r.RPPM_STUDYYEAR,ra.*, sc.CLASS_LEVEL,sc.CLASS_NAME FROM TBL_RPPMACTIVITY ra INNER JOIN TBL_RPPM r ON r.RPPM_ID=ra.RPPM_ID INNER JOIN TBL_SCHOOLCLASS sc ON sc.CLASS_ID=r.CLASS_ID")->result_array();
        $data['head'] = 'include/head';
        $data['header'] = 'include/header';
        $data['menu'] = 'include/menu';
        $data['content'] = 'page/RPPM/listRPPMActivity';
        $data['footer'] = 'include/footer';
        $data['title'] = 'Daftar RPPM Kegiatan';
        $data['main_menu'] = 'RPPM';
        $data['sub_menu'] = 'listRPPMActivity';
        $this->load->view('index', $data);
    }

    public function tambahRPPMActivity()
    {
        $data['query'] = $this->db->query("SELECT r.*,ra.*, r.*,sc.CLASS_LEVEL,sc.CLASS_NAME FROM TBL_RPPMACTIVITY ra INNER JOIN TBL_RPPM r ON ra.RPPM_ID=r.RPPM_ID INNER JOIN TBL_SCHOOLCLASS sc ON sc.CLASS_ID=r.CLASS_ID")->result_array();
        $data['head'] = 'include/head';
        $data['header'] = 'include/header';
        $data['menu'] = 'include/menu';
        $data['content'] = 'page/RPPM/tambahRPPMActivity';
        $data['footer'] = 'include/footer';
        $data['title'] = 'Tambah RPPM Kegiatan';
        $data['main_menu'] = 'RPPM';
        $data['sub_menu'] = 'tambahRPPMActivity';
        $this->load->view('index', $data);
    }

    public function editRPPMActivity()
    {
        $id = $this->input->get("id");
        $data['isi_value'] = $this->RPPMModel->getData($id);
        $data['head'] = 'include/head';
        $data['header'] = 'include/header';
        $data['menu'] = 'include/menu';
        $data['content'] = 'page/RPPM/editRPPMActivity';
        $data['footer'] = 'include/footer';
        $data['title'] = 'Edit RPPM Kegiatan';
        $data['main_menu'] = 'RPPM';
        $data['sub_menu'] = 'editRPPMActivity';
        $this->load->view('index', $data);
    }

    public function simpanRPPMActivity()
    {

        $RPPM = $this->RPPMModel;
        $this->form_validation->set_rules("RPPMID", "RPPM ID", 'required');
        $this->form_validation->set_rules("indexHari", "Hari", 'required');
        $this->form_validation->set_rules("deskripsiActivity", "Kegiatan Pembelajaran", 'required');


        if ($this->form_validation->run() != false) {

            $RPPMID = $this->input->post('RPPMID');
            $indexHari = $this->input->post('indexHari');
            $deskripsiActivity = $this->input->post('deskripsiActivity');

            $data = array(
                'RPPM_ID' => $RPPMID,
                'RPPMACTIVITY_DAYINDEX' => $indexHari,
                'RPPMACTIVITY_DESC' => $deskripsiActivity
            );
            $RPPM->input_data($data, 'TBL_RPPMACTIVITY');
            $this->session->set_flashdata('success', 'Berhasil disimpan');

            redirect("tambahRPPMActivity");
        } else {
            $this->session->set_flashdata('success', 'Gagal disimpan');
            $data['head'] = 'include/head';
            $data['header'] = 'include/header';
            $data['menu'] = 'include/menu';
            $data['content'] = 'page/RPPM/tambahRPPMActivity';
            $data['footer'] = 'include/footer';
            $data['title'] = 'Tambah RPPM Kegiatan';
            $data['main_menu'] = 'RPPM';
            $data['sub_menu'] = 'tambahRPPMActivity';
            $this->load->view('index', $data);
        }
    }

    public function updateRPPMActivity()
    {


        $RPPM = $this->RPPMModel;
        $this->form_validation->set_rules("RPPMID", "RPPM ID", 'required');
        $this->form_validation->set_rules("indexHari", "Hari", 'required');
        $this->form_validation->set_rules("deskripsiActivity", "Kegiatan Pembelajaran", 'required');


        if ($this->form_validation->run() != false) {

            $RPPMID = $this->input->post('RPPMID');
            $indexHari = $this->input->post('indexHari');
            $deskripsiActivity = $this->input->post('deskripsiActivity');

            $data = array(
                'RPPM_ID' => $RPPMID,
                'RPPMACTIVITY_DAYINDEX' => $indexHari,
                'RPPMACTIVITY_DESC' => $deskripsiActivity
            );
            $RPPMActivityID = $this->input->post("RPPMActivityID");
            $where = array("RPPMACTIVITY_ID" => $RPPMActivityID);
            $RPPM->update_data($where, $data, 'TBL_RPPMACTIVITY');
            $this->session->set_flashdata('success', 'Berhasil diedit');

            redirect("tambahRPPMActivity");
        } else {
            $this->session->set_flashdata('success', 'Gagal disimpan');
            $data['head'] = 'include/head';
            $data['header'] = 'include/header';
            $data['menu'] = 'include/menu';
            $data['content'] = 'page/RPPM/tambahRPPMActivity';
            $data['footer'] = 'include/footer';
            $data['title'] = 'Tambah RPPM Kegiatan';
            $data['main_menu'] = 'RPPM';
            $data['sub_menu'] = 'tambahRPPMActivity';
            $this->load->view('index', $data);
        }
    }


    // RPPM Learning
    // RPPM Activity
    public function listRPPMLearning()
    {
        $data['query'] = $this->db->query("SELECT rl.*, r.RPPM_STUDYYEAR,sc.CLASS_LEVEL,sc.CLASS_NAME FROM TBL_RPPMLEARNING rl INNER JOIN TBL_RPPM r ON r.RPPM_ID=rl.RPPM_ID INNER JOIN TBL_SCHOOLCLASS sc ON sc.CLASS_ID=r.CLASS_ID ")->result_array();
        $data['head'] = 'include/head';
        $data['header'] = 'include/header';
        $data['menu'] = 'include/menu';
        $data['content'] = 'page/RPPM/listRPPMLearning';
        $data['footer'] = 'include/footer';
        $data['title'] = 'Daftar RPPM Pembelajaran';
        $data['main_menu'] = 'RPPM';
        $data['sub_menu'] = 'listRPPMLearning';
        $this->load->view('index', $data);
    }

    public function tambahRPPMLearning()
    {
        $data['query'] = $this->db->query("SELECT rl.*, r.RPPM_STUDYYEAR,sc.CLASS_LEVEL,sc.CLASS_NAME FROM TBL_RPPMLEARNING rl INNER JOIN TBL_RPPM r ON r.RPPM_ID=rl.RPPM_ID INNER JOIN TBL_SCHOOLCLASS sc ON sc.CLASS_ID=r.CLASS_ID ")->result_array();
        $data['head'] = 'include/head';
        $data['header'] = 'include/header';
        $data['menu'] = 'include/menu';
        $data['content'] = 'page/RPPM/tambahRPPMLearning';
        $data['footer'] = 'include/footer';
        $data['title'] = 'Tambah RPPM Pembelajaran';
        $data['main_menu'] = 'RPPM';
        $data['sub_menu'] = 'tambahRPPMLearning';
        $this->load->view('index', $data);
    }

    public function editRPPMLearning()
    {
        $id = $this->input->get("id");
        $data['isi_value'] = $this->RPPMModel->getData($id);
        $data['head'] = 'include/head';
        $data['header'] = 'include/header';
        $data['menu'] = 'include/menu';
        $data['content'] = 'page/RPPM/editRPPMLearning';
        $data['footer'] = 'include/footer';
        $data['title'] = 'Edit RPPM Pembelajaran';
        $data['main_menu'] = 'RPPM';
        $data['sub_menu'] = 'editRPPMLearning';
        $this->load->view('index', $data);
    }

    public function simpanRPPMLearning()
    {

        $RPPM = $this->RPPMModel;
        $this->form_validation->set_rules("RPPMID", "RPPM ID", 'required');
        // $this->form_validation->set_rules("kodeLearning", "Kode Learning", 'required');
        // $this->form_validation->set_rules("teoriLearning", "Teori Learning", 'required');
        // $this->form_validation->set_rules("tujuanLearning", "Tujuan Learning", 'required');


        if ($this->form_validation->run() != false) {

            $RPPMID = $this->input->post('RPPMID');
            // $kodeLearning = $this->input->post('kodeLearning');
            // $teoriLearning = $this->input->post('teoriLearning');
            // $tujuanLearning = $this->input->post('tujuanLearning');

            // $data = array(
            //     'RPPM_ID' => $RPPMID,
            //     'RPPMLearning_CODE' => $kodeLearning,
            //     'RPPMLearning_THEORY' => $teoriLearning,
            //     'RPPMLearning_GOAL' => $tujuanLearning
            // );
            // $RPPM->input_data($data, 'TBL_RPPMLearning');

            $kodeLearning = count($this->input->post("kodeLearning"));
            $teoriLearning = count($this->input->post("teoriLearning"));
            $tujuanLearning = count($this->input->post("tujuanLearning"));

            if ($kodeLearning > 0 && $teoriLearning > 0 && $tujuanLearning > 0) {
                for ($i = 0; $i < $kodeLearning; $i++) {
                    if (trim($_POST["kodeLearning"][$i]) != '') {
                        $this->db->query("INSERT INTO TBL_RPPMLearning(RPPM_ID,RPPMLearning_CODE,RPPMLearning_THEORY,RPPMLearning_GOAL) VALUES ('$RPPMID','" . $_POST['kodeLearning'][$i] . "','" . $_POST['teoriLearning'][$i] . "','" . $_POST['tujuanLearning'][$i] . "')");
                    }
                }
            }
            $this->session->set_flashdata('success', 'Berhasil disimpan');

            redirect("listRPPMLearning");
        } else {
            $this->session->set_flashdata('success', 'Gagal disimpan');
            $data['head'] = 'include/head';
            $data['header'] = 'include/header';
            $data['menu'] = 'include/menu';
            $data['content'] = 'page/RPPM/tambahRPPMLearning';
            $data['footer'] = 'include/footer';
            $data['title'] = 'Tambah RPPM Pembelajaran';
            $data['main_menu'] = 'RPPM';
            $data['sub_menu'] = 'tambahRPPMLearning';
            $this->load->view('index', $data);
        }
    }

    public function updateRPPMLearning()
    {

        $RPPM = $this->RPPMModel;
        $this->form_validation->set_rules("RPPMID", "RPPM ID", 'required');
        $this->form_validation->set_rules("kodeLearning", "Kode Learning", 'required');
        $this->form_validation->set_rules("teoriLearning", "Teori Learning", 'required');
        $this->form_validation->set_rules("tujuanLearning", "Tujuan Learning", 'required');


        if ($this->form_validation->run() != false) {

            $RPPMID = $this->input->post('RPPMID');
            $kodeLearning = $this->input->post('kodeLearning');
            $teoriLearning = $this->input->post('teoriLearning');
            $tujuanLearning = $this->input->post('tujuanLearning');

            if ($RPPMID == '') {
                $data = array(

                    'RPPMLearning_CODE' => $kodeLearning,
                    'RPPMLearning_THEORY' => $teoriLearning,
                    'RPPMLearning_GOAL' => $tujuanLearning
                );
            } else {
                $data = array(
                    'RPPM_ID' => $RPPMID,
                    'RPPMLearning_CODE' => $kodeLearning,
                    'RPPMLearning_THEORY' => $teoriLearning,
                    'RPPMLearning_GOAL' => $tujuanLearning
                );
            }



            $RPPMLearningID = $this->input->post("RPPMLearningID");
            $where = array("RPPMLEARNING_ID" => $RPPMLearningID);
            $RPPM->update_data($where, $data, 'TBL_RPPMLearning');
            $this->session->set_flashdata('success', 'Berhasil Diedit');

            redirect("listRPPMLearning");
        } else {
            $this->session->set_flashdata('success', 'Gagal Diedit');
            $data['head'] = 'include/head';
            $data['header'] = 'include/header';
            $data['menu'] = 'include/menu';
            $data['content'] = 'page/RPPM/listRPPMLearning';
            $data['footer'] = 'include/footer';
            $data['title'] = 'List RPPM Pembelajaran';
            $data['main_menu'] = 'RPPM';
            $data['sub_menu'] = 'listRPPMLearning';
            $this->load->view('index', $data);
        }
    }



    public function deleteRPPM()
    {
        $id = $this->input->get("id");
        $result = $this->db->query("SELECT *FROM TBL_RPPMACTIVITY WHERE RPPM_ID='$id'")->num_rows();
        $result2 = $this->db->query("SELECT *FROM TBL_RPPMLEARNING WHERE RPPM_ID='$id'")->num_rows();
        if ($result > 0 && $result2 > 0) {
            $this->session->set_flashdata('failed', 'Data Gagal Dihapus');
        } else {
            $query = $this->db->delete('TBL_RPPM', ['RPPM_ID' => $id]);
            $this->session->set_flashdata('success', 'Berhasil Dihapus');
        }
        redirect('listRPPM');
    }

    public function deleteRPPMActivity()
    {
        $id = $this->input->get("id");

        $query = $this->db->delete('TBL_RPPMACTIVITY', ['RPPMACTIVITY_ID' => $id]);
        $this->session->set_flashdata('success', 'Berhasil Dihapus');

        redirect('listRPPMActivity');
    }

    public function deleteRPPMLearning()
    {
        $id = $this->input->get("id");

        $query = $this->db->delete('TBL_RPPMLEARNING', ['RPPMLEARNING_ID' => $id]);
        $this->session->set_flashdata('success', 'Berhasil Dihapus');
        redirect('listRPPMLearning');
    }



    public function deleteKompetensiRPPM()
    {
        $id = $this->input->get("id");
        $query = $this->db->delete('TBL_PROMES_COMPETENCY', ['COMPETENCY_ID' => $id]);
        $this->session->set_flashdata('success', 'Berhasil Dihapus');
        redirect('listKompetensiRPPM');
    }

    function fetchLearning()
    {
        $output = '';
        $query = '';

        if ($this->input->post('query')) {
            $query = $this->input->post('query');
        }
        $data = $this->db->query("SELECT rp.*,rpm.*,sc.SCH_NAME, cl.CLASS_NAME,cl.CLASS_LEVEL FROM TBL_RPPMLEARNING rp INNER JOIN TBL_RPPM rpm ON rpm.RPPM_ID=rp.RPPM_ID INNER JOIN tbl_schoolclass cl ON cl.CLASS_ID=rpm.CLASS_ID
        INNER JOIN tbl_school sc ON sc.SCH_ID=cl.SCH_ID WHERE rp.RPPM_ID='$query'");
        $output .= '
  <div class="table-responsive">
  <button style="text-align:right;display: none;" class="btn btn-primary mr-1 mt-1 mb-3" id="btnTambah" data-toggle="modal" data-target="#modalTambahRPPM">Tambah Data</button>



     <table class="table table-bordered table-striped">
      <tr>
      
       <th>RPPM ID</th>
       <th>Kode Pembelajaran</th>
       <th>Teori Pembelajaran</th>
       <th>Tujuan Pembelajaran</th>
       <th>Action</th>
      </tr>
  ';
        if ($data->num_rows() > 0) {
            foreach ($data->result() as $row) {
                $tombolEdit = "<button type=\"button\" class=\"btn btn-outline-info\" title=\"Edit data\" onclick=\"edit('" . $row->RPPMLEARNING_ID . "')\">
                Edit
            </button>";

                $tombolHapus = "<button type=\"button\" class=\"btn btn-outline-danger ml-1\" title=\"Hapus data\" onclick=\"hapus('" . $row->RPPMLEARNING_ID . "')\">
            Hapus
        </button>";

                $output .= '
      <tr>
      
       <td>' . $row->SCH_NAME . '-' . $row->CLASS_LEVEL . '-' . $row->CLASS_NAME . '</td>
       <td>' . $row->RPPMLEARNING_CODE . '</td>
       <td>' . $row->RPPMLEARNING_THEORY . '</td>
       <td>' . $row->RPPMLEARNING_GOAL . '</td>
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
        $data = $this->db->query("SELECT rp.*,rpm.*,sc.SCH_NAME, cl.CLASS_NAME,cl.CLASS_LEVEL FROM TBL_RPPMACTIVITY rp INNER JOIN TBL_RPPM rpm ON rpm.RPPM_ID=rp.RPPM_ID INNER JOIN tbl_schoolclass cl ON cl.CLASS_ID=rpm.CLASS_ID
        INNER JOIN tbl_school sc ON sc.SCH_ID=cl.SCH_ID WHERE rp.RPPM_ID='$query'");
        $output .= '
  <div class="table-responsive">
     <table class="table table-bordered table-stripped">
      <tr>
       <th>RPPM ID</th>
       <th>Hari</th>
       <th>Deskripsi</th>
       <th>Action</th>
      </tr>
  ';
        if ($data->num_rows() > 0) {
            foreach ($data->result() as $row) {

                $tombolHapus = "<button type=\"button\" class=\" btn-sm btn btn-outline-danger ml-1\" title=\"Hapus data\" onclick=\"hapus('" . $row->RPPMACTIVITY_ID . "')\">
                Hapus
            </button>";
                $output .= '
      <tr>
       <td>' . $row->SCH_NAME . '-' . $row->CLASS_LEVEL . '-' . $row->CLASS_NAME . '</td>
       <td>' . $row->RPPMACTIVITY_DAYINDEX . '</td>
       <td>' . $row->RPPMACTIVITY_DESC . '</td>
       <td> <button class="btn btn-sm btn-outline-primary" data-toggle="modal" data-target="#modal_edit' . $row->RPPMACTIVITY_ID . '">Edit</button>' . $tombolHapus . '</td>
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
            <button style="text-align:right;display: none;" class="btn btn-primary mr-1 mt-1" id="btnTambah" data-toggle="modal" data-target="#modal_tambah">Tambah Data</button>
            <a href="deleteRPPM?id=" class="btn btn-danger mt-1 ">Hapus</a>
            </div>
        ';
        echo $output;
    }

    // Ajax
    public function ambilDataRPPM()
    {
        if ($this->input->is_ajax_request() == true) {
            $this->load->model('RPPMModel', 'rppm');
            $list = $this->rppm->get_datatables_rppm();
            $data = array();

            $no = $_POST['start'];
            foreach ($list as $field) {


                $no++;
                $tombolEdit = "<button type=\"button\" class=\"btn  btn-sm btn-outline-success\" title=\"Edit data\" onclick=\"edit('" . $field->RPPM_ID . "')\">
                    Edit
                </button>";
                $tombolHapus = "<button type=\"button\" class=\"btn  btn-sm btn-outline-danger ml-1\" title=\"Hapus data\" onclick=\"hapus('" . $field->RPPM_ID . "')\">
                    Hapus
                </button>";
                $tombolDetail = "<a class=\"btn  btn-sm btn-outline-primary ml-1\" title=\"Detail data\" >
                    Detail
                </a>";

                $row = array();
                $row[] = "<input type=\"checkbox\" class=\"centangPromes\" value=\"$field->RPPM_ID\" name=\"rppmID[]\">";
                $row[] = $no . ".";
                $row[] = $field->RPPM_STUDYYEAR;
                $row[] = $field->CLASS_LEVEL . '-' . $field->CLASS_NAME;
                $row[] = $field->RPPM_SEMESTER;
                $bulan = '';
                switch ($field->RPPM_MONTH) {
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

                $row[] = $field->RPPM_WEEK;
                $row[] = $tombolEdit . $tombolHapus . $tombolDetail;
                $data[] = $row;
            }

            $output = array(
                "draw" => $_POST['draw'],
                "recordsTotal" => $this->rppm->count_all_rppm(),
                "recordsFiltered" => $this->rppm->count_filtered_rppm(),
                "data" => $data,
            );
            //output dalam format JSON
            echo json_encode($output);
        } else {
            exit('Maaf data tidak bisa ditampilkan');
        }
    }




    public function simpanRPPM_ajax()
    {
        if ($this->input->is_ajax_request()) {
            $RPPM = $this->RPPMModel;
            $this->form_validation->set_rules("kelasID", "Nama Kelas", 'required');
            $this->form_validation->set_rules("tahunRPPM", "Tahun RPPM", 'required');
            $this->form_validation->set_rules("semesterRPPM", "RPPM Semester", 'required');
            $this->form_validation->set_rules("bulanRPPM", "Bulan", 'required');

            $this->form_validation->set_rules("mingguRPPM", "Minggu", 'required');
            $this->form_validation->set_rules("temaRPPM", "Tema", 'required');
            $this->form_validation->set_rules("subTemaRPPM", "SubTema ", 'required');
            $this->form_validation->set_rules("modelPembelajaran", "Model Pembelajaran", 'required');


            if ($this->form_validation->run() != false) {

                $kelasID = $this->input->post('kelasID');
                $tahun1 = $this->input->post('tahunRPPM');
                $tahun2 = intval($tahun1) + 1;
                $tahunRPPM = $tahun1 . '/' . $tahun2;
                $semesterRPPM = $this->input->post('semesterRPPM');
                $bulanRPPM = $this->input->post('bulanRPPM');
                $mingguRPPM = $this->input->post('mingguRPPM');
                $temaRPPM = $this->input->post('temaRPPM');
                $subTemaRPPM = $this->input->post('subTemaRPPM');
                $modelPembelajaran = $this->input->post('modelPembelajaran');


                $data = array(
                    'CLASS_ID' => $kelasID,
                    'RPPM_STUDYYEAR' => $tahunRPPM,
                    'RPPM_SEMESTER' => $semesterRPPM,
                    'RPPM_MONTH' => $bulanRPPM,
                    'RPPM_THEME' => $temaRPPM,
                    'RPPM_SUBTHEME' => $subTemaRPPM,
                    'RPPM_WEEK' => $mingguRPPM,
                    'RPPM_STUDYMODEL' => $modelPembelajaran
                );
                $RPPM->input_data($data, 'TBL_RPPM');

                $msg = ['sukses' => 'Data RPPM berhasil disimpan'];
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
            $rppmID = $this->input->post('rppmID');
            $jmlData = count($rppmID);
            $hapusData = $this->RPPMModel->deleteMultiple_ajax($rppmID, $jmlData);
            if ($hapusData == true) {
                $msg = ['sukses' => "data RPPM berhasil dihapus"];
            }
            echo json_encode($msg);
        } else {
            exit("Maaf Data Tidak Bisa DiLanjutkan");
        }
    }

    public function formEditRPPM()
    {
        if ($this->input->is_ajax_request() == true) {
            $rppmID = $this->input->post('rppmID');
            $result = $this->RPPMModel->getData2($rppmID);

            if ($result->num_rows() > 0) {
                $row = $result->row_array();
                $data = [
                    'RPPM_ID' => $row['RPPM_ID'],
                    'RPPM_THEME' => $row['RPPM_THEME'],
                    'CLASS_LEVEL' => $row['CLASS_LEVEL'],
                    'CLASS_ID' => $row['CLASS_ID'],
                    'CLASS_NAME' => $row['CLASS_NAME'],
                    'RPPM_STUDYYEAR' => $row['RPPM_STUDYYEAR'],
                    'RPPM_MONTH' => $row['RPPM_MONTH'],
                    'RPPM_SEMESTER' => $row['RPPM_SEMESTER'],
                    'RPPM_WEEK' => $row['RPPM_WEEK'],
                    'RPPM_STUDYMODEL' => $row['RPPM_STUDYMODEL'],
                    'RPPM_SUBTHEME' => $row['RPPM_SUBTHEME']
                ];
            }
            $msg = [
                'sukses' => $this->load->view('page/rppm/modalEditRPPM', $data, true)
            ];
            echo json_encode($msg);
        }
    }

    public function hapusRPPM_ajax()
    {
        if ($this->input->is_ajax_request() == true) {
            $rppmID = $this->input->post("rppmID");
            $hapus = $this->RPPMModel->hapusRPPM_ajax($rppmID);
            if ($hapus) {
                $msg = ['sukses' => 'Data RPPM Berhasil Terhapus'];
            }
            echo json_encode($msg);
        }
    }

    public function hapusRPPMActivity_ajax()
    {
        if ($this->input->is_ajax_request() == true) {
            $rppmActID = $this->input->post("rppmActID");
            $hapus = $this->RPPMModel->hapusRPPMActivity_ajax($rppmActID);
            if ($hapus) {
                $msg = ['sukses' => 'Data RPPM Activity Berhasil Terhapus'];
            }
            echo json_encode($msg);
        }
    }

    // RPPM Learning

    public function simpanRPPMLearning_ajax()
    {
        if ($this->input->is_ajax_request()) {

            $RPPM = $this->RPPMModel;
            $this->form_validation->set_rules("RPPMID", "RPPM ID", 'required');
            if ($this->form_validation->run() != false) {

                $RPPMID = $this->input->post('RPPMID');
                $kodeLearning = count($this->input->post("kodeLearning"));
                $teoriLearning = count($this->input->post("teoriLearning"));
                $tujuanLearning = count($this->input->post("tujuanLearning"));

                if ($kodeLearning > 0 && $teoriLearning > 0 && $tujuanLearning > 0) {
                    for ($i = 0; $i < $kodeLearning; $i++) {
                        if (trim($_POST["kodeLearning"][$i]) != '') {
                            $this->db->query("INSERT INTO TBL_RPPMLearning(RPPM_ID,RPPMLearning_CODE,RPPMLearning_THEORY,RPPMLearning_GOAL) VALUES ('$RPPMID','" . $_POST['kodeLearning'][$i] . "','" . $_POST['teoriLearning'][$i] . "','" . $_POST['tujuanLearning'][$i] . "')");
                        }
                    }
                }
                $msg = ['sukses' => 'Data Pencapaian RPPM berhasil disimpan'];
            } else {
                $msg = [
                    'error' => '<div class="alert alert-warning mt-1 alert-styled-left alert-dismissible"><button type="button" class="close" data-dismiss="alert"><span>×</span></button><span class="font-weight-semibold">Warning!</span>' . validation_errors() .
                        '.</div>'
                ];
            }
            echo json_encode($msg);
        }
    }

    public function updateRPPM_ajax()
    {
        if ($this->input->is_ajax_request()) {
            $RPPM = $this->RPPMModel;
            $this->form_validation->set_rules("kelasID", "Nama Kelas", 'required');
            $this->form_validation->set_rules("tahunRPPM", "Tahun RPPM", 'required');
            $this->form_validation->set_rules("semesterRPPM", "RPPM Semester", 'required');
            $this->form_validation->set_rules("bulanRPPM", "Bulan", 'required');

            $this->form_validation->set_rules("mingguRPPM", "Minggu", 'required');
            $this->form_validation->set_rules("temaRPPM", "Tema", 'required');
            $this->form_validation->set_rules("subTemaRPPM", "SubTema ", 'required');
            $this->form_validation->set_rules("modelPembelajaran", "Model Pembelajaran", 'required');


            if ($this->form_validation->run() != false) {

                $kelasID = $this->input->post('kelasID');
                $tahunRPPM = $this->input->post('tahunRPPM');
                $semesterRPPM = $this->input->post('semesterRPPM');
                $bulanRPPM = $this->input->post('bulanRPPM');
                $mingguRPPM = $this->input->post('mingguRPPM');
                $temaRPPM = $this->input->post('temaRPPM');
                $subTemaRPPM = $this->input->post('subTemaRPPM');
                $modelPembelajaran = $this->input->post('modelPembelajaran');
                $RPPMID = $this->input->post("RPPMID");

                $where = array(
                    "RPPM_ID" => $RPPMID
                );
                $data = array(
                    'CLASS_ID' => $kelasID,
                    'RPPM_STUDYYEAR' => $tahunRPPM,
                    'RPPM_SEMESTER' => $semesterRPPM,
                    'RPPM_MONTH' => $bulanRPPM,
                    'RPPM_THEME' => $temaRPPM,
                    'RPPM_SUBTHEME' => $subTemaRPPM,
                    'RPPM_WEEK' => $mingguRPPM,
                    'RPPM_STUDYMODEL' => $modelPembelajaran
                );
                $RPPM->update_data($where, $data, 'TBL_RPPM');
                $msg = ['sukses' => 'Data RPPM berhasil diupdate'];
            } else {
                $msg = [
                    'error' => '<div class="alert alert-warning mt-1 alert-styled-left alert-dismissible"><button type="button" class="close" data-dismiss="alert"><span>×</span></button><span class="font-weight-semibold">Warning!</span>' . validation_errors() .
                        '.</div>'
                ];
            }

            echo json_encode($msg);
        }
    }


    public function formEditRPPMLearning()
    {
        if ($this->input->is_ajax_request() == true) {
            $rppmID = $this->input->post('rppmID');
            $result = $this->db->query("SELECT rl.*, r.RPPM_STUDYYEAR,sc.CLASS_LEVEL,sc.CLASS_NAME FROM TBL_RPPMLEARNING rl INNER JOIN TBL_RPPM r ON r.RPPM_ID=rl.RPPM_ID INNER JOIN TBL_SCHOOLCLASS sc ON sc.CLASS_ID=r.CLASS_ID WHERE RPPMLEARNING_ID='$rppmID'");

            if ($result->num_rows() > 0) {
                $row = $result->row_array();
                $data = [
                    'RPPMLEARNING_ID' => $row['RPPMLEARNING_ID'],
                    'RPPM_ID' => $row['RPPM_ID'],
                    'CLASS_LEVEL' => $row['CLASS_LEVEL'],
                    'CLASS_NAME' => $row['CLASS_NAME'],
                    'RPPMLEARNING_CODE' => $row['RPPMLEARNING_CODE'],
                    'RPPMLEARNING_THEORY' => $row['RPPMLEARNING_THEORY'],
                    'RPPMLEARNING_GOAL' => $row['RPPMLEARNING_GOAL']
                ];
            }
            $msg = [
                'sukses' => $this->load->view('page/rppm/modalEditRPPMLearning', $data, true)
            ];
            echo json_encode($msg);
        }
    }

    public function updateRPPMLearning_ajax()
    {
        if ($this->input->is_ajax_request()) {
            $RPPM = $this->RPPMModel;
            $this->form_validation->set_rules("RPPMID", "RPPM ID", 'required');
            $this->form_validation->set_rules("kodeLearning", "Kode Learning", 'required');
            $this->form_validation->set_rules("teoriLearning", "Teori Learning", 'required');
            $this->form_validation->set_rules("tujuanLearning", "Tujuan Learning", 'required');


            if ($this->form_validation->run() != false) {

                $RPPMID = $this->input->post('RPPMID');
                $kodeLearning = $this->input->post('kodeLearning');
                $teoriLearning = $this->input->post('teoriLearning');
                $tujuanLearning = $this->input->post('tujuanLearning');

                if ($RPPMID == '') {
                    $data = array(

                        'RPPMLearning_CODE' => $kodeLearning,
                        'RPPMLearning_THEORY' => $teoriLearning,
                        'RPPMLearning_GOAL' => $tujuanLearning
                    );
                } else {
                    $data = array(
                        'RPPM_ID' => $RPPMID,
                        'RPPMLearning_CODE' => $kodeLearning,
                        'RPPMLearning_THEORY' => $teoriLearning,
                        'RPPMLearning_GOAL' => $tujuanLearning
                    );
                }
                $RPPMLearningID = $this->input->post("RPPMLearningID");
                $where = array("RPPMLEARNING_ID" => $RPPMLearningID);
                $RPPM->update_data($where, $data, 'TBL_RPPMLearning');
                $msg = ['sukses' => 'Data Pencapaian RPPM berhasil diupdate'];
            } else {
                $msg = [
                    'error' => '<div class="alert alert-warning mt-1 alert-styled-left alert-dismissible"><button type="button" class="close" data-dismiss="alert"><span>×</span></button><span class="font-weight-semibold">Warning!</span>' . validation_errors() .
                        '.</div>'
                ];
            }

            echo json_encode($msg);
        }
    }


    public function hapusRPPMLearning_ajax()
    {
        if ($this->input->is_ajax_request() == true) {
            $rppmLearnID = $this->input->post("rppmLearnID");
            $hapus = $this->RPPMModel->hapusRPPMLearning_ajax($rppmLearnID);
            if ($hapus) {
                $msg = ['sukses' => 'Data Pencapaian RPPM Berhasil Terhapus'];
            }
            echo json_encode($msg);
        }
    }
}
