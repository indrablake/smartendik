<?php
defined('BASEPATH') or exit('No direct script access allowed');

class SNP extends CI_Controller
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
     * @see https://codeigniter.com/SNP_guide/general/urls.html
     */


    public function __construct()
    {
        parent::__construct();
        $this->load->model("SNPModel");
        $this->load->library('form_validation');
    }

    public function listSNP()
    {
        $data['head'] = 'include/head';
        $data['header'] = 'include/header';
        $data['menu'] = 'include/menu';
        $data['content'] = 'page/SNP/listSNP';
        $data['footer'] = 'include/footer';
        $data['title'] = 'List SNP';
        $data['main_menu'] = 'snp';
        $data['sub_menu'] = 'listSNP';
        $this->load->view('index', $data);
    }


    public function ambilDataSNP()
    {
        if ($this->input->is_ajax_request() == true) {
            $this->load->model('SNPModel', 'snp');
            $list = $this->snp->get_datatables_snp();
            $data = array();

            $no = $_POST['start'];
            foreach ($list as $field) {


                $no++;
                $tombolEdit = "<button type=\"button\" class=\"btn  btn-sm btn-outline-success ml-1\" title=\"Edit data\" onclick=\"edit('" . $field->snp_id . "')\">
                    Edit
                </button>";
                $tombolHapus = "<button type=\"button\" class=\"btn  btn-sm btn-outline-danger ml-1\" title=\"Hapus data\" onclick=\"hapus('" . $field->snp_id . "')\">
                    Hapus
                </button>";

                if ($field->snp_status < 4) {
                    $row = array();
                    $row[] = $no . ".";
                    $row[] = $field->snp_nm;

                    $row[] =  $tombolHapus . $tombolEdit;
                    $data[] = $row;
                }
            }

            $output = array(
                "draw" => $_POST['draw'],
                "recordsTotal" => $this->snp->count_all_snp(),
                "recordsFiltered" => $this->snp->count_filtered_snp(),
                "data" => $data,
            );
            //output dalam format JSON
            echo json_encode($output);
        } else {
            exit('Maaf data tidak bisa ditampilkan');
        }
    }



    public function formEditSNP()
    {
        if ($this->input->is_ajax_request() == true) {
            $snpID = $this->input->post('snpID');
            $result = $this->db->query("SELECT ref_snp.* FROM ref_snp WHERE snp_id='$snpID'");
            if ($result->num_rows() > 0) {
                $row = $result->row_array();
                $data = [
                    'snpID' => $row['snp_id'],
                    'snpNama' => $row['snp_nm'],
                ];
            }
            $msg = [
                'sukses' => $this->load->view('page/snp/modal/modalEditSNP', $data, true)
            ];
            echo json_encode($msg);
        }
    }


    public function simpanSNP_ajax()
    {
        if ($this->input->is_ajax_request()) {
            $SNP = $this->SNPModel;
            $this->form_validation->set_rules("pemantauanSNP", "Nama SNP", 'required', ['required' => '%s tidak boleh kosong']);

            if ($this->form_validation->run() != false) {
                $snpNama = $this->input->post('pemantauanSNP');

                $data = array(
                    'snp_nm' => $snpNama,
                    'snp_status' => '1'
                );
                $SNP->input_data($data, 'ref_snp');
                $msg = ['sukses' => 'Data Pemantauan SNP berhasil disimpan'];
            } else {
                $msg = [
                    'error' => '<div class="alert alert-warning mt-1 alert-styled-left alert-dismissible"><button type="button" class="close" data-dismiss="alert"><span>×</span></button><span class="font-weight-semibold">Warning!</span>' . validation_errors() .
                        '.</div>'
                ];
            }
            echo json_encode($msg);
        }
    }

    public function updateSNP_ajax()
    {
        if ($this->input->is_ajax_request()) {
            $SNP = $this->SNPModel;
            $this->form_validation->set_rules("pemantauanSNP", "Nama SNP", 'required', ['required' => '%s tidak boleh kosong']);

            if ($this->form_validation->run() != false) {
                $snpNama = $this->input->post('pemantauanSNP');
                $snpID = $this->input->post("snpID");

                $where = array(
                    "snp_id" => $snpID
                );
                $data = array(
                    'snp_nm' => $snpNama
                );
                $SNP->update_data($where, $data, 'ref_snp');
                $msg = ['sukses' => 'Data Pemantauan SNP berhasil diupdate'];
            } else {
                $msg = [
                    'error' => '<div class="alert alert-warning mt-1 alert-styled-left alert-dismissible"><button type="button" class="close" data-dismiss="alert"><span>×</span></button><span class="font-weight-semibold">Warning!</span>' . validation_errors() .
                        '.</div>'
                ];
            }

            echo json_encode($msg);
        }
    }

    public function hapusSNP_ajax()
    {
        $this->load->model('SNPModel', 'snp');
        if ($this->input->is_ajax_request() == true) {
            $snpID = $this->input->post("snpID");
            $update = $this->db->query("UPDATE snp SET snp_status='0' WHERE snp_id='$snpID'");
            if ($update) {
                $msg = ['sukses' => 'Data Pemantauan SNP Berhasil Terhapus'];
            }
            echo json_encode($msg);
        }
    }







    // SNP Poin

    public function listSNPPoin()
    {
        $data['head'] = 'include/head';
        $data['header'] = 'include/header';
        $data['menu'] = 'include/menu';
        $data['content'] = 'page/SNP/listSNPPoin';
        $data['footer'] = 'include/footer';
        $data['title'] = 'List SNP';
        $data['main_menu'] = 'snp';
        $data['sub_menu'] = 'listSNPPoin';
        $this->load->view('index', $data);
    }

    public function formTambahSNPPoin()
    {
        $data['dataSNP'] = $this->SNPModel->getData();
        $data['head'] = 'include/head';
        $data['header'] = 'include/header';
        $data['menu'] = 'include/menu';
        $data['content'] = 'page/SNP/form/tambahSNPPoin';
        $data['footer'] = 'include/footer';
        $data['title'] = 'Tambah Pemantauan SNP Poin';
        $data['main_menu'] = 'snp';
        $data['sub_menu'] = 'listSNPPoin';
        $this->load->view('index', $data);
    }


    public function ambilDataSNPPoin()
    {
        if ($this->input->is_ajax_request() == true) {
            $this->load->model('SNPModel', 'snp');
            $id = $this->input->post("snpID");
            $list = $this->snp->get_datatables_snp_poin($id);
            $data = array();

            $no = $_POST['start'];
            foreach ($list as $field) {


                $no++;
                $tombolEdit = "<button type=\"button\" class=\"btn  btn-sm btn-outline-success ml-1\" title=\"Edit data\" onclick=\"edit('" . $field->snpp_id . "')\">
                    Edit
                </button>";
                $tombolHapus = "<button type=\"button\" class=\"btn  btn-sm btn-outline-danger ml-1\" title=\"Hapus data\" onclick=\"hapus('" . $field->snpp_id . "')\">
                    Hapus
                </button>";

                if ($field->snpp_status < 4) {
                    $row = array();
                    $row[] = $no . ".";
                    $row[] = $field->snp_nm;
                    $row[] = $field->snpp_ket;
                    $row[] =  $tombolHapus . $tombolEdit;
                    $data[] = $row;
                }
            }

            $output = array(
                "draw" => $_POST['draw'],
                "recordsTotal" => $this->snp->count_all_snp_poin($id),
                "recordsFiltered" => $this->snp->count_filtered_snp_poin($id),
                "data" => $data,
            );
            //output dalam format JSON
            echo json_encode($output);
        } else {
            exit('Maaf data tidak bisa ditampilkan');
        }
    }



    public function formEditSNPPoin()
    {
        if ($this->input->is_ajax_request() == true) {
            $snppID = $this->input->post('snppID');
            $result = $this->db->query("SELECT ref_snp.*,snp_poin.* FROM snp_poin INNER JOIN ref_snp on ref_snp.snp_id=snp_poin.snp_id WHERE snp_poin.snpp_id='$snppID'");
            if ($result->num_rows() > 0) {
                $row = $result->row_array();
                $data = [
                    'snppID' => $row['snpp_id'],
                    'snppKet' => $row['snpp_ket'],
                    'snpID' => $row['snp_id'],
                    'snpNama' => $row['snp_nm'],
                ];
            }
            $msg = [
                'sukses' => $this->load->view('page/snp/modal/modalEditSNPPoin', $data, true)
            ];
            echo json_encode($msg);
        }
    }


    public function simpanSNPPoin_ajax()
    {
        if ($this->input->is_ajax_request()) {

            $this->form_validation->set_rules("snpp_ket[]", "Keterangan Pemantauan SNP Poin", 'required', ['required' => 'tidak boleh kosong']);
            $this->form_validation->set_rules("snpID", "Keterangan Pemantauan SNP Poin", 'required', ['required' => 'tidak boleh kosong']);

            if ($this->form_validation->run() != false) {
                $countsnppKeterangan = count($this->input->post("snpp_ket"));
                if ($countsnppKeterangan > 0) {
                    for ($i = 0; $i < $countsnppKeterangan; $i++) {
                        if (trim($_POST["snpp_ket"][$i]) != '') {
                            $this->db->query("INSERT INTO  snp_poin(snp_id,snpp_ket,snpp_status) VALUES ('" . $_POST["snpID"] . "','" . $_POST["snpp_ket"][$i] . "','1')");
                        }
                    }
                }
                $msg = ['sukses' => 'Data Pemantauan SNP Poin berhasil disimpan'];
            } else {
                $msg = [
                    'error' => '<div class="alert alert-warning mt-1 alert-styled-left alert-dismissible"><button type="button" class="close" data-dismiss="alert"><span>×</span></button><span class="font-weight-semibold">Warning!</span>' . validation_errors() .
                        '.</div>'
                ];
            }
            echo json_encode($msg);
        }
    }

    public function updateSNPPoin_ajax()
    {
        if ($this->input->is_ajax_request()) {
            $SNP = $this->SNPModel;
            $this->form_validation->set_rules("snpp_ket", "Keterangan SNP Poin", 'required', ['required' => '%s tidak boleh kosong']);

            if ($this->form_validation->run() != false) {
                $snpKet = $this->input->post('snpp_ket');
                $snpID = $this->input->post('snpID');
                $snppID = $this->input->post('snppID');
                $data = array(
                    'snpp_ket' => $snpKet,
                    'snp_id' => $snpID
                );
                $where = array(
                    "snpp_id" => $snppID
                );
                $SNP->update_data($where, $data, 'snp_poin');
                $msg = ['sukses' => 'Data SNP Poin berhasil diupdate'];
            } else {
                $msg = [
                    'error' => '<div class="alert alert-warning mt-1 alert-styled-left alert-dismissible"><button type="button" class="close" data-dismiss="alert"><span>×</span></button><span class="font-weight-semibold">Warning!</span>' . validation_errors() .
                        '.</div>'
                ];
            }

            echo json_encode($msg);
        }
    }

    public function hapusSNPPoin_ajax()
    {
        $this->load->model('SNPModel', 'snp');
        if ($this->input->is_ajax_request() == true) {
            $snppID = $this->input->post("snppID");
            $update = $this->db->query("UPDATE snp_poin SET snpp_status='0' WHERE snpp_id='$snppID'");
            if ($update) {
                $msg = ['sukses' => 'Data SNP Poin Berhasil Terhapus'];
            }
            echo json_encode($msg);
        }
    }


    // Fetch Data
    function fetchSNPPoin()
    {
        $queryID = $this->input->post("query");
        $this->load->model('SNPModel', 'snpp');
        $list = $this->snpp->get_datatables_snp_poin($queryID);
        $data = array();

        $no = $_POST['start'];
        foreach ($list as $field) {


            $no++;
            $tombolEdit = "<button type=\"button\" class=\"btn  btn-sm btn-outline-success\" title=\"Edit data\" onclick=\"edit('" . $field->snpp_id . "')\">
                     Edit
                 </button>";
            $tombolHapus = "<button type=\"button\" class=\"btn  btn-sm btn-outline-danger ml-1\" title=\"Hapus data\" onclick=\"hapus('" . $field->snpp_id . "')\">
                     Hapus
                 </button>";

            $row = array();
            $row[] = $no . ".";
            $row[] = $field->snp_nm;
            $row[] = $field->snpp_ket;
            $row[] = $tombolEdit . $tombolHapus;
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->snpp->count_all_snp_poin(),
            "recordsFiltered" => $this->snpp->count_filtered_snp_poin(),
            "data" => $data,
        );
        //output dalam format JSON
        echo json_encode($output);
    }



    // SNP Ket Poin



    // SNP Poin

    public function listSNPKetPoin()
    {
        $data['head'] = 'include/head';
        $data['header'] = 'include/header';
        $data['menu'] = 'include/menu';
        $data['content'] = 'page/snp/listSNPKetPoin';
        $data['footer'] = 'include/footer';
        $data['title'] = 'List SNP Keterangan Poin';
        $data['main_menu'] = 'snp';
        $data['sub_menu'] = 'listSNPKetPoin';
        $this->load->view('index', $data);
    }

    public function formTambahSNPKetPoin()
    {
        $data['dataSNP'] = $this->db->query("SELECT *FROM snp_poin where snpp_status='1'")->result_array();
        $data['head'] = 'include/head';
        $data['header'] = 'include/header';
        $data['menu'] = 'include/menu';
        $data['content'] = 'page/SNP/form/tambahSNPKetPoin';
        $data['footer'] = 'include/footer';
        $data['title'] = 'Tambah Pemantauan SNP Keterangan Poin';
        $data['main_menu'] = 'snp';
        $data['sub_menu'] = 'listSNPKetPoin';
        $this->load->view('index', $data);
    }


    public function ambilDataSNPKetPoin()
    {
        if ($this->input->is_ajax_request() == true) {
            $this->load->model('SNPModel', 'snp');
            $id = $this->input->post("snpID");
            $list = $this->snp->get_datatables_snp_ket_poin($id);
            $data = array();

            $no = $_POST['start'];
            foreach ($list as $field) {


                $no++;
                $tombolEdit = "<button type=\"button\" class=\"btn  btn-sm btn-outline-success ml-1\" title=\"Edit data\" onclick=\"edit('" . $field->spkn_id . "','" . $field->snpp_id . "')\">
                    Edit
                </button>";
                $tombolHapus = "<button type=\"button\" class=\"btn  btn-sm btn-outline-danger ml-1\" title=\"Hapus data\" onclick=\"hapus('" . $field->spkn_id . "','" . $field->snpp_id . "')\">
                    Hapus
                </button>";

                $tombolDetail = "<button type=\"button\" class=\"btn  btn-sm btn-outline-danger ml-1\" title=\"Detail data\" onclick=\"detail('" . $field->spkn_id . "','" . $field->snpp_id . "')\">
                    Detail
                </button>";


                $row = array();
                $row[] = $no . ".";
                $row[] = $field->spkn_id;
                $row[] = $field->spkn_min;
                $row[] = $field->spkn_max;
                $row[] =  $tombolHapus . $tombolEdit . $tombolDetail;
                $data[] = $row;
            }

            $output = array(
                "draw" => $_POST['draw'],
                "recordsTotal" => $this->snp->count_all_snp_ket_poin($id),
                "recordsFiltered" => $this->snp->count_filtered_snp_ket_poin($id),
                "data" => $data,
            );
            //output dalam format JSON
            echo json_encode($output);
        } else {
            exit('Maaf data tidak bisa ditampilkan');
        }
    }



    public function formEditSNPKetPoin()
    {
        if ($this->input->is_ajax_request() == true) {
            $spknID = $this->input->post('spknID');
            $snppID = $this->input->post('snppID');
            $result = $this->db->query("SELECT spk.* , snpp.* from snp_poin_ket_nilai spk inner join snp_poin snpp on snpp.snpp_id=spk.snpp_id WHERE spk.spkn_id='$spknID' and spk.snpp_id='$snppID'");
            if ($result->num_rows() > 0) {
                $row = $result->row_array();
                $data = [
                    'spknID' => $row['spkn_id'],
                    'snppID' => $row['snpp_id'],
                    'snppNama' => $row['snpp_ket'],
                    'spknAbjad' => $row['spkn_id'],
                    'spknMin' => $row['spkn_min'],
                    'spknMax' => $row['spkn_max'],
                    'spknKet' => $row['spkn_ket']
                ];
            }
            $msg = [
                'sukses' => $this->load->view('page/snp/modal/modalEditSNPKetPoin', $data, true)
            ];
            echo json_encode($msg);
        }
    }


    public function simpanSNPKetPoin_ajax()
    {
        if ($this->input->is_ajax_request()) {

            $this->form_validation->set_rules("spkn_id[]", "Abjad Keterangan SNP Poin", 'required', ['%s required' => 'tidak boleh kosong']);

            $this->form_validation->set_rules("spkn_min[]", "Nilai Minimum Keterangan SNP Poin", 'required', ['required' => '%s tidak boleh kosong']);

            $this->form_validation->set_rules("spkn_max[]", "Nilai Maximum Keterangan SNP Poin", 'required', ['required' => '%s tidak boleh kosong']);

            $this->form_validation->set_rules("spkn_ket[]", "Keterangan SNP Poin", 'required', ['required' => '%s tidak boleh kosong']);


            if ($this->form_validation->run() != false) {
                $countsnppKeterangan = count($this->input->post("spkn_id"));
                if ($countsnppKeterangan > 0) {
                    for ($i = 0; $i < $countsnppKeterangan; $i++) {
                        if (trim($_POST["spkn_id"][$i]) != '') {
                            $this->db->query("INSERT INTO  snp_poin_ket_nilai(snpp_id,spkn_id,spkn_min,spkn_max,spkn_ket) VALUES ('" . $_POST["snppID"][$i] . "','" . $_POST["spkn_id"][$i] . "','" . $_POST["spkn_min"][$i] . "','" . $_POST["spkn_max"][$i] . "','" . $_POST["spkn_ket"][$i] . "')");
                        }
                    }
                }
                $msg = ['sukses' => 'Data Keterangan SNP Poin berhasil disimpan'];
            } else {
                $msg = [
                    'error' => '<div class="alert alert-warning mt-1 alert-styled-left alert-dismissible"><button type="button" class="close" data-dismiss="alert"><span>×</span></button><span class="font-weight-semibold">Warning!</span>' . validation_errors() .
                        '.</div>'
                ];
            }
            echo json_encode($msg);
        }
    }

    public function updateSNPKetPoin_ajax()
    {
        if ($this->input->is_ajax_request()) {
            $SNP = $this->SNPModel;
            $this->form_validation->set_rules("spkn_id", "Abjad Keterangan SNP Poin", 'required', ['required' => '%s tidak boleh kosong']);
            $this->form_validation->set_rules("spkn_min", "Nilai Min Keterangan SNP Poin", 'required', ['required' => '%s tidak boleh kosong']);
            $this->form_validation->set_rules("spkn_max", "Nilai Max Keterangan SNP Poin", 'required', ['required' => '%s tidak boleh kosong']);
            $this->form_validation->set_rules("spkn_ket", "Keterangan SNP Poin", 'required', ['required' => '%s tidak boleh kosong']);

            if ($this->form_validation->run() != false) {
                $spknKet = $this->input->post('spkn_ket');
                $spknAbjad = $this->input->post('spkn_id');
                $spknMin = $this->input->post('spkn_min');
                $spknMax = $this->input->post('spkn_max');
                $spknID = $this->input->post('spknID');
                $snppID = $this->input->post('snppID');
                $data = array(
                    'spkn_ket' => $spknKet,
                    'snpp_id' => $snppID,
                    'spkn_id' => $spknAbjad,
                    'spkn_min' => $spknMin,
                    'spkn_max' => $spknMax,
                );
                $where = array(
                    "spkn_id" => $spknID,
                    "snpp_id" => $snppID
                );
                $SNP->update_data($where, $data, 'snp_poin_ket_nilai');
                $msg = ['sukses' => 'Data Keterangan SNP Poin berhasil diupdate'];
            } else {
                $msg = [
                    'error' => '<div class="alert alert-warning mt-1 alert-styled-left alert-dismissible"><button type="button" class="close" data-dismiss="alert"><span>×</span></button><span class="font-weight-semibold">Warning!</span>' . validation_errors() .
                        '.</div>'
                ];
            }

            echo json_encode($msg);
        }
    }

    public function hapusSNPKetPoin_ajax()
    {
        $this->load->model('SNPModel', 'snp');
        if ($this->input->is_ajax_request() == true) {
            $spknID = $this->input->post("spknID");
            $snppID = $this->input->post("snppID");
            $update = $this->db->query("DELETE FROM snp_poin_ket_nilai WHERE spkn_id='$spknID' and  snpp_id='$snppID'");
            if ($update) {
                $msg = ['sukses' => 'Data SNP Keterangan Poin Berhasil Terhapus'];
            }
            echo json_encode($msg);
        }
    }


    // Fetch Data
    function fetchSNPKetPoin()
    {
        $queryID = $this->input->post("query");
        $this->load->model('SNPModel', 'snpp');
        $list = $this->snpp->get_datatables_snp_poin($queryID);
        $data = array();

        $no = $_POST['start'];
        foreach ($list as $field) {


            $no++;
            $tombolEdit = "<button type=\"button\" class=\"btn  btn-sm btn-outline-success\" title=\"Edit data\" onclick=\"edit('" . $field->spkn_id . "','" . $field->snpp_id . "')\">
                     Edit
                 </button>";
            $tombolHapus = "<button type=\"button\" class=\"btn  btn-sm btn-outline-danger ml-1\" title=\"Hapus data\" onclick=\"hapus('" . $field->spkn_id . "','" . $field->snpp_id . "')\">
                     Hapus
                 </button>";

            $row = array();
            $row[] = $no . ".";
            $row[] = $field->snp_nm;
            $row[] = $field->snpp_ket;
            $row[] = $tombolEdit . $tombolHapus;
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->snpp->count_all_snp_poin(),
            "recordsFiltered" => $this->snpp->count_filtered_snp_poin(),
            "data" => $data,
        );
        //output dalam format JSON
        echo json_encode($output);
    }
}
