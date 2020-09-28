<?php
defined('BASEPATH') or exit('No direct script access allowed');

class KKM extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model("KKMModel");
        $this->load->library('form_validation');
    }
    // KKM
    public function listKKM()
    {

        $data['head'] = 'include/head';
        $data['header'] = 'include/header';
        $data['menu'] = 'include/menu';
        $data['content'] = 'page/kkm/listKKM';
        $data['footer'] = 'include/footer';
        $data['title'] = 'List KKM';
        $data['main_menu'] = 'kkm';
        $data['sub_menu'] = 'listKKM';
        $this->load->view('index', $data);
    }

    function fetchKKM()
    {
        $id = $this->input->post("kdID");
        $this->load->model('KompetensiModel', 'kompetensi');
        $list = $this->kompetensi->get_datatables_kkm($id);
        $data = array();

        $no = $_POST['start'];
        foreach ($list as $field) {


            $no++;
            $tombolEdit = "<button type=\"button\" class=\"btn  btn-sm btn-outline-success\" title=\"Edit data\" onclick=\"edit('" . $field->kkm_id . "')\">
                Edit
            </button>";
            $tombolHapus = "<button type=\"button\" class=\"btn  btn-sm btn-outline-danger ml-1\" title=\"Hapus data\" onclick=\"hapus('" . $field->kkm_id . "')\">
                Hapus
            </button>";

            $row = array();
            $row[] = $no . ".";
            $row[] = $field->kkm_indikator;
            $row[] = $field->kkm_daya_dukung;
            $row[] = $tombolEdit . $tombolHapus;
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->kompetensi->count_all_kkm($id),
            "recordsFiltered" => $this->kompetensi->count_filtered_kkm($id),
            "data" => $data,
        );
        //output dalam format JSON
        echo json_encode($output);
    }

    public function ambilDataKKM()
    {
        if ($this->input->is_ajax_request() == true) {
            $id = $this->input->post("kdID");
            $this->load->model('KKMModel', 'kkm');
            $list = $this->kkm->get_datatables_kkm($id);
            $data = array();

            $no = $_POST['start'];
            foreach ($list as $field) {


                $no++;
                $tombolEdit = "<button type=\"button\" class=\"btn  btn-sm btn-outline-success\" title=\"Edit data\" onclick=\"edit('" . $field->kkm_id . "')\">
                    Edit
                </button>";
                $tombolHapus = "<button type=\"button\" class=\"btn  btn-sm btn-outline-danger ml-1\" title=\"Hapus data\" onclick=\"hapus('" . $field->kkm_id . "')\">
                    Hapus
                </button>";

                $row = array();
                $row[] = $no . ".";
                $row[] = $field->kkm_indikator;
                $row[] = $field->kkm_daya_dukung;
                $row[] = $tombolEdit . $tombolHapus;
                $data[] = $row;
            }

            $output = array(
                "draw" => $_POST['draw'],
                "recordsTotal" => $this->kkm->count_all_kkm($id),
                "recordsFiltered" => $this->kkm->count_filtered_kkm($id),
                "data" => $data,
            );
            //output dalam format JSON
            echo json_encode($output);
        } else {
            exit('Maaf data tidak bisa ditampilkan');
        }
    }

    public function formTambahKKM()
    {
        // $data['dataRPP'] = $this->RPPModel->getData();
        $data['head'] = 'include/head';
        $data['header'] = 'include/header';
        $data['menu'] = 'include/menu';
        $data['content'] = 'page/Kompetensi/form/tambahKKM';
        $data['footer'] = 'include/footer';
        $data['title'] = 'List KKM';
        $data['main_menu'] = 'kkm';
        $data['sub_menu'] = 'listKKM';
        $this->load->view('index', $data);
    }

    public function simpanKKM_ajax()
    {
        if ($this->input->is_ajax_request()) {

            $this->form_validation->set_rules("inputIndikator", " Indikator", 'required', ['required' => 'tidak boleh kosong']);
            $this->form_validation->set_rules("inputKompleksitas", "Kompleksitas", 'required', ['required' => 'tidak boleh kosong']);
            $this->form_validation->set_rules("inputDayaDukung", "Daya Dukung", 'required', ['required' => 'tidak boleh kosong']);
            $this->form_validation->set_rules("inputIntake", "Intake", 'required', ['required' => 'tidak boleh kosong']);

            if ($this->form_validation->run() != false) {

                $countKD = count($this->input->post("inputIndikator"));

                if ($countKD > 0) {
                    for ($i = 0; $i < $countKD; $i++) {
                        if (trim($_POST["inputIndikator"][$i]) != '') {
                            $this->db->query("INSERT INTO dat_kkm(kd_id,kkm_indikator,kkm_kompleksitas,kkm_daya_dukung,kkm_intake) VALUES ('" . $_POST["kdID"][$i] . "','" . $_POST["inputIndikator"][$i] . "','" . $_POST["inputKompleksitas"][$i] . "','" . $_POST["inputDayaDukung"][$i] . "','" . $_POST["inputIntake"][$i] . "')");
                        }
                    }
                }
                $msg = ['sukses' => 'Data KKM berhasil disimpan'];
            } else {
                $msg = [
                    'error' => '<div class="alert alert-warning mt-1 alert-styled-left alert-dismissible"><button type="button" class="close" data-dismiss="alert"><span>×</span></button><span class="font-weight-semibold">Warning!</span>' . validation_errors() .
                        '.</div>'
                ];
            }
            echo json_encode($msg);
        }
    }


    public function formEditKKM()
    {
        if ($this->input->is_ajax_request() == true) {
            $kkmID = $this->input->post('kkmID');
            $result = $this->db->query("SELECT kd.kd_semester,kd.kd_kode,kkm.* FROM dat_kkm kkm inner join komp_dasar kd on kd.kd_id=kkm.kd_id   WHERE kkm.kkm_id='$kkmID'");

            if ($result->num_rows() > 0) {
                $row = $result->row_array();
                $data = [
                    'kkmID' => $row['kkm_id'],
                    'kdID' => $row['kd_id'],
                    'kkmIndikator' => $row['kkm_indikator'],
                    'kdSemester' => $row['kd_semester'],
                    'kdKode' => $row['kd_kode'],
                    'kkmKompleksitas' => $row['kkm_kompleksitas'],
                    'kkmDaya' => $row['kkm_daya_dukung'],
                    'kkmIntake' => $row['kkm_intake']
                ];
            }
            $msg = [
                'sukses' => $this->load->view('page/kkm/modalEditKKM', $data, true)
            ];
            echo json_encode($msg);
        }
    }

    public function updateKKM_ajax()
    {
        if ($this->input->is_ajax_request()) {
            $kkm = $this->KKMModel;

            $this->form_validation->set_rules("kompetensiDasar", "Kompetensi Dasar", 'required', ['required' => '%s tidak boleh kosong']);
            $this->form_validation->set_rules("kkmIndikator", "KKM Indikator", 'required', ['required' => '%s tidak boleh kosong']);
            $this->form_validation->set_rules("kkmKompleksitas", "KKM Kompleksitas", 'required', ['required' => '%s tidak boleh kosong']);
            $this->form_validation->set_rules("kkmDaya", "KKM Daya", 'required', ['required' => '%s tidak boleh kosong']);
            $this->form_validation->set_rules("kkmIntake", "KKM Intake", 'required', ['required' => '%s tidak boleh kosong']);



            if ($this->form_validation->run() != false) {
                $kompetensiDasar = $this->input->post('kompetensiDasar');
                $kkmIndikator = $this->input->post('kkmIndikator');
                $kkmKompleksitas = $this->input->post('kkmKompleksitas');
                $kkmDaya = $this->input->post('kkmDaya');
                $kkmIntake = $this->input->post('kkmIntake');
                $kkmID = $this->input->post('kkmID');

                $data = array(
                    'kd_id' => $kompetensiDasar,
                    'kkm_indikator' => $kkmIndikator,
                    'kkm_kompleksitas' => $kkmKompleksitas,
                    'kkm_daya_dukung' => $kkmDaya,
                    'kkm_intake' => $kkmIntake
                );
                $where = array(
                    'kkm_id' => $kkmID
                );
                $kkm->update_data($where, $data, 'dat_kkm');
                $msg = ['sukses' => 'Data KKM berhasil diupdate'];
            } else {
                $msg = [
                    'error' => '<div class="alert alert-warning mt-1 alert-styled-left alert-dismissible"><button type="button" class="close" data-dismiss="alert"><span>×</span></button><span class="font-weight-semibold">Warning!</span>' . validation_errors() .
                        '.</div>'
                ];
            }

            echo json_encode($msg);
        }
    }

    public function hapusKKM_ajax()
    {
        $this->load->model('KKMModel', 'kkm');
        if ($this->input->is_ajax_request() == true) {
            $kkmID = $this->input->post("kkmID");
            $hapus = $this->kkm->hapusKKM_ajax($kkmID);
            if ($hapus) {
                $msg = ['sukses' => 'Data KKM Berhasil Terhapus'];
            }
            echo json_encode($msg);
        }
    }
    // End KKM
}
