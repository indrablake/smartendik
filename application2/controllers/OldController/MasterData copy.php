<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MasterData extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model("MasterDataModel");
        $this->load->library('form_validation');
    }
    // Provinsi

    public function listProvinsi()
    {
        $data['dataProvinsi'] = $this->db->query("SELECT *FROM ref_propinsi ORDER BY propinsi_nm ASC")->result_array();
        $data['head'] = 'include/head';
        $data['header'] = 'include/header';
        $data['menu'] = 'include/menu';
        $data['content'] = 'page/master/listProvinsi';
        $data['footer'] = 'include/footer';
        $data['title'] = 'List Provinsi';
        $data['main_menu'] = 'master';
        $data['sub_menu'] = 'listProvinsi';
        $this->load->view('index', $data);
    }


    public function simpanProvinsi_ajax()
    {
        if ($this->input->is_ajax_request()) {

            $this->form_validation->set_rules("provinsiNama[]", "Nama Provinsi", 'required|is_unique[ref_propinsi.propinsi_nm]', ['required' => '%s tidak boleh kosong', 'is_unique' => '%s  sudah diinput']);

            if ($this->form_validation->run() != false) {

                $countProvinsiNama = count($this->input->post("provinsiNama"));
                $provinsiNama = $this->input->post('provinsiNama');

                if ($countProvinsiNama > 0) {
                    for ($i = 0; $i < $countProvinsiNama; $i++) {
                        if (trim($_POST["provinsiNama"][$i]) != '') {
                            $this->db->query("INSERT INTO ref_propinsi(propinsi_nm) VALUES ('" . $_POST['provinsiNama'][$i] . "')");
                        }
                    }
                }
                $msg = ['sukses' => 'Data Provinsi berhasil disimpan'];
            } else {
                $msg = [
                    'error' => '<div class="alert alert-warning mt-1 alert-styled-left alert-dismissible"><button type="button" class="close" data-dismiss="alert"><span>×</span></button><span class="font-weight-semibold">Warning!</span>' . validation_errors() .
                        '.</div>'
                ];
            }


            echo json_encode($msg);
        }
    }


    public function hapusProvinsi_ajax()
    {
        if ($this->input->is_ajax_request() == true) {
            $provinsiID = $this->input->post("provinsiID");
            $hapus = $this->MasterDataModel->hapusProvinsi_ajax($provinsiID);
            if ($hapus) {
                $msg = ['sukses' => 'Data Provinsi Berhasil Terhapus'];
            }
            echo json_encode($msg);
        }
    }

    public function formEditProvinsi()
    {
        if ($this->input->is_ajax_request() == true) {
            $provinsiID = $this->input->post('provinsiID');
            $result = $this->db->query("SELECT *FROM ref_propinsi WHERE propinsi_kd='$provinsiID'");

            if ($result->num_rows() > 0) {
                $row = $result->row_array();
                $data = [
                    'propinsi_id' => $row['propinsi_kd'],
                    'propinsi_nm' => $row['propinsi_nm'],
                ];
            }
            $msg = [
                'sukses' => $this->load->view('page/master/modal/modalEditProvinsi', $data, true)
            ];
            echo json_encode($msg);
        }
    }


    public function updateProvinsi_ajax()
    {
        if ($this->input->is_ajax_request()) {
            $master = $this->MasterDataModel;

            $this->form_validation->set_rules("provinsi", "Nama Provinsi", 'required', ['required' => '%s tidak boleh kosong']);


            if ($this->form_validation->run() != false) {
                $provinsi = $this->input->post('provinsi');
                $provinsiID = $this->input->post('provinsiID');

                $data = array(
                    'propinsi_nm' => $provinsi
                );
                $where = array(
                    'propinsi_kd' => $provinsiID
                );
                $master->update_data($where, $data, 'ref_propinsi');
                $msg = ['sukses' => 'Data Provinsi berhasil diupdate'];
            } else {
                $msg = [
                    'error' => '<div class="alert alert-warning mt-1 alert-styled-left alert-dismissible"><button type="button" class="close" data-dismiss="alert"><span>×</span></button><span class="font-weight-semibold">Warning!</span>' . validation_errors() .
                        '.</div>'
                ];
            }

            echo json_encode($msg);
        }
    }


    // End Provinsi


    // Kabupaten
    public function listKabupaten()
    {
        $data['dataProvinsi'] = $this->db->query("SELECT propinsi_nm,propinsi_kd FROM ref_propinsi ORDER BY propinsi_nm ASC")->result_array();
        $data['dataKabupaten'] = $this->db->query("SELECT ref_propinsi.propinsi_nm,ref_dati2.* FROM ref_dati2 INNER JOIN ref_propinsi ON ref_propinsi.propinsi_kd=ref_dati2.propinsi_kd ORDER BY ref_dati2.dati2_nm ASC")->result_array();
        $data['head'] = 'include/head';
        $data['header'] = 'include/header';
        $data['menu'] = 'include/menu';
        $data['content'] = 'page/master/listKabupaten';
        $data['footer'] = 'include/footer';
        $data['title'] = 'List Kabupaten';
        $data['main_menu'] = 'master';
        $data['sub_menu'] = 'listKabupaten';
        $this->load->view('index', $data);
    }


    public function simpanKabupaten_ajax()
    {
        if ($this->input->is_ajax_request()) {
            $this->form_validation->set_rules("kabupatenNama[]", "Nama Kabupaten", 'required|is_unique[ref_dati2.dati2_nm]', ['required' => '%s tidak boleh kosong', 'is_unique' => ['%s sudah diinput']]);
            // $this->form_validation->set_rules("subTemaPromes", "SubTema Program Semester", 'required');
            if ($this->form_validation->run() != false) {
                $countKabupatenNama = count($this->input->post("kabupatenNama"));
                $propinsiID = $this->input->post('propinsiID');

                if ($countKabupatenNama > 0) {
                    for ($i = 0; $i < $countKabupatenNama; $i++) {
                        if (trim($_POST["kabupatenNama"][$i]) != '') {
                            $this->db->query("INSERT INTO ref_dati2(propinsi_kd,dati2_nm) VALUES ('$propinsiID','" . $_POST['kabupatenNama'][$i] . "')");
                        }
                    }
                }
                $msg = ['sukses' => 'Data Kabupaten berhasil disimpan'];
            } else {
                $msg = [
                    'error' => '<div class="alert alert-warning mt-1 alert-styled-left alert-dismissible"><button type="button" class="close" data-dismiss="alert"><span>×</span></button><span class="font-weight-semibold">Warning!</span>' . validation_errors() .
                        '.</div>'
                ];
            }
            echo json_encode($msg);
        }
    }


    public function hapusKabupaten_ajax()
    {
        if ($this->input->is_ajax_request() == true) {
            $kabupatenID = $this->input->post("kabupatenID");
            $hapus = $this->MasterDataModel->hapusKabupaten_ajax($kabupatenID);
            if ($hapus) {
                $msg = ['sukses' => 'Data Kabupaten Berhasil Terhapus'];
            }
            echo json_encode($msg);
        }
    }

    public function formEditKabupaten()
    {
        if ($this->input->is_ajax_request() == true) {
            $kabupatenID = $this->input->post('kabupatenID');
            $result = $this->db->query("SELECT ref_propinsi.propinsi_nm,ref_dati2.* FROM ref_dati2 INNER JOIN ref_propinsi ON ref_propinsi.propinsi_kd=ref_dati2.propinsi_kd WHERE ref_dati2.dati2_kd='$kabupatenID'");

            if ($result->num_rows() > 0) {
                $row = $result->row_array();
                $data = [
                    'kabupatenID' => $row['dati2_kd'],
                    'propinsi_kd' => $row['propinsi_kd'],
                    'propinsi_nm' => $row['propinsi_nm'],
                    'kabupatenNama' => $row['dati2_nm'],
                ];
            }
            $msg = [
                'sukses' => $this->load->view('page/master/modal/modalEditKabupaten', $data, true)
            ];
            echo json_encode($msg);
        }
    }


    public function updateKabupaten_ajax()
    {
        if ($this->input->is_ajax_request()) {
            $master = $this->MasterDataModel;

            $this->form_validation->set_rules("kabupaten", "Nama Kabupaten", 'required', ['required' => '%s tidak boleh kosong']);

            if ($this->form_validation->run() != false) {
                $kabupaten = $this->input->post('kabupaten');
                $kabupatenID = $this->input->post('kabupatenID');
                $propinsiID = $this->input->post('propinsiID');

                $data = array(
                    'dati2_nm' => $kabupaten,
                    'propinsi_kd' => $propinsiID
                );
                $where = array(
                    'dati2_kd' => $kabupatenID
                );
                $master->update_data($where, $data, 'ref_dati2');
                $msg = ['sukses' => 'Data Kabupaten berhasil diupdate'];
            } else {
                $msg = [
                    'error' => '<div class="alert alert-warning mt-1 alert-styled-left alert-dismissible"><button type="button" class="close" data-dismiss="alert"><span>×</span></button><span class="font-weight-semibold">Warning!</span>' . validation_errors() .
                        '.</div>'
                ];
            }

            echo json_encode($msg);
        }
    }


    // End Kabupaten

    // Kecamatan
    public function listKecamatan()
    {
        $data['dataProvinsi'] = $this->db->query("SELECT *FROM ref_propinsi")->result_array();
        $data['dataKabupaten'] = $this->db->query("SELECT *FROM ref_dati2")->result_array();
        $data['dataKecamatan'] = $this->db->query("SELECT ref_dati2.dati2_nm, ref_propinsi.propinsi_nm,ref_kecamatan.* FROM ref_kecamatan INNER JOIN ref_dati2 ON ref_dati2.dati2_kd=ref_kecamatan.dati2_kd INNER JOIN ref_propinsi ON ref_propinsi.propinsi_kd=ref_kecamatan.propinsi_kd")->result_array();
        $data['head'] = 'include/head';
        $data['header'] = 'include/header';
        $data['menu'] = 'include/menu';
        $data['content'] = 'page/master/listKecamatan';
        $data['footer'] = 'include/footer';
        $data['title'] = 'List Kecamatan';
        $data['main_menu'] = 'master';
        $data['sub_menu'] = 'listKecamatan';
        $this->load->view('index', $data);
    }


    public function simpanKecamatan_ajax()
    {
        if ($this->input->is_ajax_request()) {
            $this->form_validation->set_rules("propinsiID", "Nama Provinsi", 'required', ['required' => '%s tidak boleh kosong']);
            $this->form_validation->set_rules("kabupatenID", "Nama Kabupaten", 'required', ['required' => '%s tidak boleh kosong']);
            $this->form_validation->set_rules("kecamatanNama[]", "Nama Kecamatan", 'required', ['required' => '%s tidak boleh kosong']);
            // $this->form_validation->set_rules("subTemaPromes", "SubTema Program Semester", 'required');
            if ($this->form_validation->run() != false) {
                $countKecamatanNama = count($this->input->post("kecamatanNama"));
                $propinsiID = $this->input->post('propinsiID');
                $kabupatenID = $this->input->post('kabupatenID');
                if ($countKecamatanNama > 0) {
                    for ($i = 0; $i < $countKecamatanNama; $i++) {
                        if (trim($_POST["kecamatanNama"][$i]) != '') {
                            $this->db->query("INSERT INTO ref_kecamatan(propinsi_kd,dati2_kd,kecamatan_nm) VALUES ('$propinsiID','$kabupatenID','" . $_POST['kecamatanNama'][$i] . "')");
                        }
                    }
                }
                $msg = ['sukses' => 'Data Kecamatan berhasil disimpan'];
            } else {
                $msg = [
                    'error' => '<div class="alert alert-warning mt-1 alert-styled-left alert-dismissible"><button type="button" class="close" data-dismiss="alert"><span>×</span></button><span class="font-weight-semibold">Warning!</span>' . validation_errors() .
                        '.</div>'
                ];
            }
            echo json_encode($msg);
        }
    }


    public function hapusKecamatan_ajax()
    {
        if ($this->input->is_ajax_request() == true) {
            $kecamatanID = $this->input->post("kecamatanID");
            $hapus = $this->MasterDataModel->hapusKecamatan_ajax($kecamatanID);
            if ($hapus) {
                $msg = ['sukses' => 'Data Kecamatan Berhasil Terhapus'];
            }
            echo json_encode($msg);
        }
    }

    public function formEditKecamatan()
    {
        if ($this->input->is_ajax_request() == true) {
            $kecamatanID = $this->input->post('kecamatanID');
            $data['dataProvinsi'] = $this->db->query("SELECT *FROM ref_propinsi")->result_array();
            $data['dataKabupaten'] = $this->db->query("SELECT *FROM ref_dati2")->result_array();
            $result = $this->db->query("SELECT ref_dati2.dati2_nm,ref_dati2.dati2_kd, ref_propinsi.propinsi_nm,ref_kecamatan.* FROM ref_kecamatan INNER JOIN ref_dati2 ON ref_dati2.dati2_kd=ref_kecamatan.dati2_kd INNER JOIN ref_propinsi ON ref_propinsi.propinsi_kd=ref_kecamatan.propinsi_kd WHERE ref_kecamatan.kecamatan_kd='$kecamatanID'");

            if ($result->num_rows() > 0) {
                $row = $result->row_array();
                $data = [
                    'kabupatenID' => $row['dati2_kd'],
                    'kabupatenNama' => $row['dati2_nm'],
                    'kecamatanID' => $row['kecamatan_kd'],
                    'propinsi_kd' => $row['propinsi_kd'],
                    'propinsi_nm' => $row['propinsi_nm'],
                    'kecamatanNama' => $row['kecamatan_nm'],
                ];
            }
            $msg = [
                'sukses' => $this->load->view('page/master/modal/modalEditKecamatan', $data, true)
            ];
            echo json_encode($msg);
        }
    }


    public function updateKecamatan_ajax()
    {
        if ($this->input->is_ajax_request()) {
            $master = $this->MasterDataModel;

            $this->form_validation->set_rules("kecamatan", "Nama Kecamatan", 'required', ['required' => '%s tidak boleh kosong']);

            if ($this->form_validation->run() != false) {
                $kabupatenID = $this->input->post('kabupatenID');
                $kecamatanID = $this->input->post('kecamatanID');
                $propinsiID = $this->input->post('propinsiID');
                $kecamatanNama = $this->input->post('kecamatan');

                $data = array(
                    'dati2_kd' => $kabupatenID,
                    'kecamatan_nm' => $kecamatanNama,
                    'propinsi_kd' => $propinsiID
                );
                $where = array(
                    'kecamatan_kd' => $kecamatanID
                );
                $master->update_data($where, $data, 'ref_kecamatan');
                $msg = ['sukses' => 'Data Kecamatan berhasil diupdate'];
            } else {
                $msg = [
                    'error' => '<div class="alert alert-warning mt-1 alert-styled-left alert-dismissible"><button type="button" class="close" data-dismiss="alert"><span>×</span></button><span class="font-weight-semibold">Warning!</span>' . validation_errors() .
                        '.</div>'
                ];
            }

            echo json_encode($msg);
        }
    }


    // End Kecamatan

    // Jenis User
    public function listJenisUser()
    {
        $data['dataJenisUser'] = $this->db->query("SELECT *FROM ref_jenis_user")->result_array();
        $data['head'] = 'include/head';
        $data['header'] = 'include/header';
        $data['menu'] = 'include/menu';
        $data['content'] = 'page/master/listJenisUser';
        $data['footer'] = 'include/footer';
        $data['title'] = 'List Jenis User';
        $data['main_menu'] = 'master';
        $data['sub_menu'] = 'listJenisUser';
        $this->load->view('index', $data);
    }


    public function simpanJenisUser_ajax()
    {
        if ($this->input->is_ajax_request()) {

            $this->form_validation->set_rules("jenisUserNama[]", "Jenis User", 'required|is_unique[ref_jenis_user.jns_user_nm]', ['required' => '%s tidak boleh kosong', 'is_unique' => '%s sudah diinput']);


            if ($this->form_validation->run() != false) {

                $countJenisUser = count($this->input->post("jenisUserNama"));
                $jenisUserNama = $this->input->post('jenisUserNama');
                if ($countJenisUser > 0) {
                    for ($i = 0; $i < $countJenisUser; $i++) {
                        if (trim($_POST["jenisUserNama"][$i]) != '') {
                            $this->db->query("INSERT INTO ref_jenis_user(jns_user_nm) VALUES ('" . $_POST['jenisUserNama'][$i] . "')");
                        }
                    }
                }
                $msg = ['sukses' => 'Data Jenis User berhasil disimpan'];
            } else {
                $msg = [
                    'error' => '<div class="alert alert-warning mt-1 alert-styled-left alert-dismissible"><button type="button" class="close" data-dismiss="alert"><span>×</span></button><span class="font-weight-semibold">Warning!</span>' . validation_errors() .
                        '.</div>'
                ];
            }

            echo json_encode($msg);
        }
    }


    public function hapusJenisUser_ajax()
    {
        if ($this->input->is_ajax_request() == true) {
            $jenisUserID = $this->input->post("jenisUserID");
            $hapus = $this->MasterDataModel->hapusJenisUser_ajax($jenisUserID);
            if ($hapus) {
                $msg = ['sukses' => 'Data Jenis User Berhasil Terhapus'];
            }
            echo json_encode($msg);
        }
    }

    public function formEditJenisUser()
    {
        if ($this->input->is_ajax_request() == true) {
            $jenisUserID = $this->input->post('jenisUserID');
            $result = $this->db->query("SELECT *FROM ref_jenis_user WHERE jns_user_kd='$jenisUserID'");

            if ($result->num_rows() > 0) {
                $row = $result->row_array();
                $data = [
                    'jenisUserID' => $row['jns_user_kd'],
                    'jenisUserNama' => $row['jns_user_nm']
                ];
            }
            $msg = [
                'sukses' => $this->load->view('page/master/modal/modalEditJenisUser', $data, true)
            ];
            echo json_encode($msg);
        }
    }


    public function updateJenisUser_ajax()
    {
        if ($this->input->is_ajax_request()) {
            $master = $this->MasterDataModel;

            $this->form_validation->set_rules("jenisUserNama", "Jenis User", 'required', ['required' => '%s tidak boleh kosong']);

            if ($this->form_validation->run() != false) {
                $jenisUserID = $this->input->post('jenisUserID');
                $jenisUserNama = $this->input->post('jenisUserNama');

                $data = array(
                    'jns_user_nm' => $jenisUserNama
                );
                $where = array(
                    'jns_user_kd' => $jenisUserID
                );
                $master->update_data($where, $data, 'ref_jenis_user');
                $msg = ['sukses' => 'Data Jenis User berhasil diupdate'];
            } else {
                $msg = [
                    'error' => '<div class="alert alert-warning mt-1 alert-styled-left alert-dismissible"><button type="button" class="close" data-dismiss="alert"><span>×</span></button><span class="font-weight-semibold">Warning!</span>' . validation_errors() .
                        '.</div>'
                ];
            }

            echo json_encode($msg);
        }
    }


    // End Jenis User


    //Agama
    public function listAgama()
    {
        $data['dataReligion'] = $this->db->query("SELECT *FROM ref_agama")->result_array();
        $data['head'] = 'include/head';
        $data['header'] = 'include/header';
        $data['menu'] = 'include/menu';
        $data['content'] = 'page/master/listAgama';
        $data['footer'] = 'include/footer';
        $data['title'] = 'List Agama';
        $data['main_menu'] = 'master';
        $data['sub_menu'] = 'listAgama';
        $this->load->view('index', $data);
    }



    public function simpanAgama_ajax()
    {
        if ($this->input->is_ajax_request()) {
            $master = $this->MasterDataModel;
            $this->form_validation->set_rules("agama", "Agama", 'required|is_unique[ref_agama.agama_nm]', ['required' => '%s tidak boleh kosong', 'is_unique' => '%s sudah diinput']);
            if ($this->form_validation->run() != false) {

                $agama = $this->input->post('agama');

                $data = array(
                    'agama_nm' => $agama
                );
                $master->input_data($data, 'ref_agama');
                $msg = ['sukses' => 'Data Agama berhasil disimpan'];
            } else {
                $msg = [
                    'error' => '<div class="alert alert-warning mt-1 alert-styled-left alert-dismissible"><button type="button" class="close" data-dismiss="alert"><span>×</span></button><span class="font-weight-semibold">Warning!</span>' . validation_errors() .
                        '.</div>'
                ];
            }

            echo json_encode($msg);
        }
    }

    public function formEditAgama()
    {
        if ($this->input->is_ajax_request() == true) {
            $agamaID = $this->input->post('agamaID');
            $result = $this->db->query("SELECT *FROM ref_agama WHERE agama_kd='$agamaID'");

            if ($result->num_rows() > 0) {
                $row = $result->row_array();
                $data = [
                    'agama_kd' => $row['agama_kd'],
                    'agama_nm' => $row['agama_nm'],
                ];
            }
            $msg = [
                'sukses' => $this->load->view('page/master/modal/modalEditAgama', $data, true)
            ];
            echo json_encode($msg);
        }
    }


    public function hapusAgama_ajax()
    {
        if ($this->input->is_ajax_request() == true) {
            $agamaID = $this->input->post("agamaID");
            $hapus = $this->MasterDataModel->hapusAgama_ajax($agamaID);
            if ($hapus) {
                $msg = ['sukses' => 'Data Agama Berhasil Terhapus'];
            }
            echo json_encode($msg);
        }
    }


    public function updateAgama_ajax()
    {
        if ($this->input->is_ajax_request()) {
            $master = $this->MasterDataModel;

            $this->form_validation->set_rules("agama", "Agama", 'required', ['required' => '%s tidak boleh kosong']);

            if ($this->form_validation->run() != false) {
                $agamaID = $this->input->post('agamaID');
                $agama = $this->input->post('agama');

                $data = array(
                    'agama_nm' => $agama
                );
                $where = array(
                    'agama_kd' => $agamaID
                );
                $master->update_data($where, $data, 'ref_agama');
                $msg = ['sukses' => 'Data Agama berhasil diupdate'];
            } else {
                $msg = [
                    'error' => '<div class="alert alert-warning mt-1 alert-styled-left alert-dismissible"><button type="button" class="close" data-dismiss="alert"><span>×</span></button><span class="font-weight-semibold">Warning!</span>' . validation_errors() .
                        '.</div>'
                ];
            }

            echo json_encode($msg);
        }
        // End Agama
    }




    // User
    public function listUser()
    {
        $data['dataUser'] = $this->db->query("SELECT df.profile_kd,du.* FROM dat_user du LEFT JOIN dat_profile df ON df.profile_kd=du.profile_kd WHERE du.profile_kd='' ||  profile_status IN (0,1) ORDER BY user_kd DESC")->result_array();
        $data['head'] = 'include/head';
        $data['header'] = 'include/header';
        $data['menu'] = 'include/menu';
        $data['content'] = 'page/master/listUser';
        $data['footer'] = 'include/footer';
        $data['title'] = 'List User';
        $data['main_menu'] = 'siswa';
        $data['sub_menu'] = 'listUser';
        $this->load->view('index', $data);
    }

    public function simpanUser_ajax()
    {
        if ($this->input->is_ajax_request()) {
            $master = $this->MasterDataModel;
            $this->form_validation->set_rules("username", "Username", 'required|is_unique[dat_user.user_nm]', ['required' => '%s tidak boleh kosong', 'is_unique' => '%s sudah ada']);
            $this->form_validation->set_rules("password", "Password", 'required|trim|min_length[3]|matches[password2]', [
                'matches' => 'Password Tidak Sama !',
                'min_length' => 'Password tidak boleh kurang dari 3 karakter'
            ]);
            $this->form_validation->set_rules("password2", "Password", 'required|trim|min_length[3]|matches[password]', [
                'matches' => 'Password Tidak Sama !'
            ]);

            if ($this->form_validation->run() != false) {
                $username = htmlspecialchars($this->input->post('username'));
                $password = $this->input->post('password');
                $data = array(
                    'user_nm' => $username,
                    'profile_kd' => 0,
                    'user_password' => password_hash($password, PASSWORD_DEFAULT)
                );
                $master->input_data($data, 'dat_user');
                $msg = ['sukses' => 'Data User berhasil disimpan'];
            } else {
                $msg = [
                    'error' => '<div class="alert alert-warning mt-1 alert-styled-left alert-dismissible"><button type="button" class="close" data-dismiss="alert"><span>×</span></button><span class="font-weight-semibold">Warning!</span>' . validation_errors() .
                        '.</div>'
                ];
            }
            echo json_encode($msg);
        }
    }


    public function hapusUser_ajax()
    {
        if ($this->input->is_ajax_request() == true) {
            $userID = $this->input->post("userID");
            $hapus =     $this->db->query("UPDATE dat_profile SET profile_status='2' WHERE profile_kd='$userID' ");
            if ($hapus) {
                $msg = ['sukses' => 'Data User Berhasil Terhapus'];
            }
            echo json_encode($msg);
        }
    }

    public function hapusUserPermanen_ajax()
    {
        if ($this->input->is_ajax_request() == true) {
            $userID = $this->input->post("userID");
            $hapus = $this->MasterDataModel->hapusUserPermanen_ajax($userID);
            if ($hapus) {
                $msg = ['sukses' => 'Data User Berhasil Terhapus'];
            }
            echo json_encode($msg);
        }
    }


    public function detailProfile()
    {
        $data['head'] = 'include/head';
        $data['header'] = 'include/header';
        $data['menu'] = 'include/menu';
        $data['content'] = 'page/master/form/tambahProfile';
        $data['footer'] = 'include/footer';
        $data['title'] = 'Detail Profile';
        $data['main_menu'] = 'master';
        $data['sub_menu'] = 'listUser';
        $this->load->view('index', $data);
    }


    public function detailProfileEdit()
    {
        $profileID = $this->input->get("profileID");
        $data['dataProfileUser'] = $this->db->query("SELECT df.*,ju.jns_user_nm,rp.propinsi_nm,rp.propinsi_kd,ra.agama_nm,rd.dati2_kd,rd.dati2_nm,rk.kecamatan_kd,rk.kecamatan_nm FROM dat_profile df INNER JOIN ref_jenis_user ju ON ju.jns_user_kd = df.jns_user_kd INNER JOIN ref_propinsi rp ON rp.propinsi_kd=df.propinsi_kd INNER JOIN ref_dati2 rd ON rd.dati2_kd=df.dati2_kd
        INNER JOIN ref_kecamatan rk ON rk.kecamatan_kd=df.kecamatan_kd INNER JOIN ref_agama ra ON ra.agama_kd=df.agama_kd WHERE df.profile_kd='$profileID'")->row();
        $data['head'] = 'include/head';
        $data['header'] = 'include/header';
        $data['menu'] = 'include/menu';
        $data['content'] = 'page/master/form/editProfile';
        $data['footer'] = 'include/footer';
        $data['title'] = 'Detail Profile';
        $data['main_menu'] = 'master';
        $data['sub_menu'] = 'listUser';
        $this->load->view('index', $data);
    }


    public function simpanDetailProfile_ajax()
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
                    $userGroup = preg_replace("/[^0-9]/", "", $jenis);

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
                    $idUser = $this->input->post("idProfile");
                    $keterangan_jabatan = $this->input->post('keterangan_jabatan');
                    $image = $data['upload_data']['file_name'];

                    $result = $this->MasterDataModel->simpanProfile($userGroup, $nik, $nama_depan, $nama_tengah, $nama_belakang, $agama, $tempat_lahir, $tanggalLahir, $jenisKelamin, $provinsi, $kabupaten, $kecamatan, $alamat, $kelurahan, $kodePos, $telp, $email, $keterangan_jabatan, $image);
                    // $dataProfile = $this->db->query("SELECT * FROM dat_profile WHERE profile_kd IN (SELECT MAX(profile_kd) FROM dat_profile)");
                    // $dataProfile = $dataProfile->row();
                    // $idProfile = $dataProfile->profile_kd;
                    $idProfile = $this->db->insert_id();
                    $jenisUser = $this->input->post("jenis");
                    // Pengawas
                    $sekolahID = $this->input->post("sekolahID");
                    $pengawasMulai = $this->input->post("tanggalPengawasMulai");
                    $pengawasAkhir = $this->input->post("tanggalPengawasAkhir");
                    // End Pengawas
                    // Admin
                    $adminMulai = $this->input->post("tanggalAdminMulai");
                    $adminAkhir = $this->input->post("tanggalAdminAkhir");
                    // End Admin
                    // Pegawai  
                    $sekolahID = $this->input->post("sekolahID");
                    $kelasID = $this->input->post("kelasID");
                    $pegawai = $this->input->post('jenisPegawai');
                    $jenisPegawai = preg_replace("/[^0-9]/", "", $pegawai);
                    $jenisPegawaiGuru = $this->input->post("jenisPegawaiGuru");
                    $pegawaiMulai = $this->input->post("tanggalPegawaiMulai");
                    $pegawaiAkhir = $this->input->post("tanggalPegawaiAkhir");
                    $pegawai = strtolower($jenisPegawai);
                    // End Pegawai

                    if ($jenisUser == 'admin') {

                        $this->db->query("INSERT INTO admin_regional (profile_kd,propinsi_kd,dati2_kd,adm_tgl_mulai,adm_tgl_akhir) VALUES ('$idProfile','$provinsi','$kabupaten','$adminMulai','$adminAkhir')");
                    } else if ($jenisUser == 'pengawas') {

                        $this->db->query("INSERT INTO pengawas_sekolah (profile_kd,sekolah_kd,pws_skl_tgl_mulai,pws_skl_tgl_akhir) VALUES ('$idProfile','$sekolahID','$pengawasMulai','$pengawasAkhir')");
                    } else if ($jenisUser == 'pegawai') {

                        $this->db->query("INSERT INTO sekolah_pegawai (sekolah_kd,profile_kd,jns_pegawai_kd,pegawai_tgl_mulai,pegawai_tgl_berakhir) VALUES ('$idProfile','$sekolahID','$jenisPegawai','$pegawaiMulai','$pegawaiAkhir')");
                        $idPegawai = $this->db->insert_id();
                        if ($jenisPegawaiGuru == 'guru') {
                            $this->db->query("INSERT INTO guru_mengajar(pegawai_kd,kelas_kd) VALUES('$idPegawai','$kelasID')");
                        }
                    }

                    $this->db->query("UPDATE dat_user SET profile_kd='$idProfile' WHERE user_kd='$idUser'");
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

    public function updateDetailProfile_ajax()
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
        $profileID = $this->input->post('profileID');
        $userGroup = $this->input->post('userGroup');
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
        $keterangan_jabatan = $this->input->post('keterangan_jabatan');

        $result = $this->db->query("UPDATE dat_profile SET jns_user_kd='$userGroup',profile_nomor_id='$nik',profile_nm_1='$nama_depan',profile_nm_2='$nama_tengah',profile_nm_3='$nama_belakang',agama_kd='$agama',profile_tempat_lahir='$tempat_lahir',profile_tgl_lahir='$tanggalLahir',profile_jns_kelamin='$jenisKelamin',propinsi_kd='$provinsi',dati2_kd='$kabupaten',kecamatan_kd='$kecamatan',profile_alamat='$alamat',profile_kelurahan='$kelurahan',profile_kd_pos='$kodePos',profile_telp='$telp',profile_email='$email',profile_foto='$image',profile_ket_jabatan='$keterangan_jabatan' WHERE profile_kd='$profileID'");

        echo json_encode($result);
    }
    // End User

    // Jenjang Kelas

    public function listJenjangSekolah()
    {
        $data['dataJenjangSekolah'] = $this->db->query("SELECT *FROM ref_jenjang_sekolah")->result_array();
        $data['head'] = 'include/head';
        $data['header'] = 'include/header';
        $data['menu'] = 'include/menu';
        $data['content'] = 'page/master/listJenjang';
        $data['footer'] = 'include/footer';
        $data['title'] = 'List Jenjang Sekolah';
        $data['main_menu'] = 'master';
        $data['sub_menu'] = 'listJenjangSekolah';
        $this->load->view('index', $data);
    }


    public function simpanJenjangSekolah_ajax()
    {
        if ($this->input->is_ajax_request()) {


            $this->form_validation->set_rules("jenjangSekolah[]", "Jengjang Sekolah", 'required|is_unique[ref_jenjang_sekolah.jenjang_nm]', ['required' => '%s tidak boleh kosong', 'is_unique' => '%s sudah diinput']);

            if ($this->form_validation->run() != false) {

                $countJenjangSekolah = count($this->input->post("jenjangSekolah"));
                $jenjangSekolah = $this->input->post('jenjangSekolah');

                if ($countJenjangSekolah > 0) {
                    for ($i = 0; $i < $countJenjangSekolah; $i++) {
                        if (trim($_POST["jenjangSekolah"][$i]) != '') {
                            $this->db->query("INSERT INTO ref_jenjang_sekolah(jenjang_nm) VALUES ('" . $_POST['jenjangSekolah'][$i] . "')");
                        }
                    }
                }
                $msg = ['sukses' => 'Data Jenjang Sekolah berhasil disimpan'];
            } else {
                $msg = [
                    'error' => '<div class="alert alert-warning mt-1 alert-styled-left alert-dismissible"><button type="button" class="close" data-dismiss="alert"><span>×</span></button><span class="font-weight-semibold">Warning!</span>' . validation_errors() .
                        '.</div>'
                ];
            }


            echo json_encode($msg);
        }
    }


    public function hapusJenjang_ajax()
    {
        if ($this->input->is_ajax_request() == true) {
            $jenjangID = $this->input->post("jenjangID");
            $hapus = $this->MasterDataModel->hapusJenjang_ajax($jenjangID);
            if ($hapus) {
                $msg = ['sukses' => 'Data Provinsi Berhasil Terhapus'];
            }
            echo json_encode($msg);
        }
    }

    public function formEditJenjang()
    {
        if ($this->input->is_ajax_request() == true) {
            $jenjangID = $this->input->post('jenjangID');
            $result = $this->db->query("SELECT *FROM ref_jenjang_sekolah WHERE jenjang_kd='$jenjangID'");

            if ($result->num_rows() > 0) {
                $row = $result->row_array();
                $data = [
                    'jenjangKD' => $row['jenjang_kd'],
                    'jenjangNama' => $row['jenjang_nm'],
                ];
            }
            $msg = [
                'sukses' => $this->load->view('page/master/modal/modalEditJenjang', $data, true)
            ];
            echo json_encode($msg);
        }
    }


    public function updateJenjang_ajax()
    {
        if ($this->input->is_ajax_request()) {
            $master = $this->MasterDataModel;

            $this->form_validation->set_rules("jenjangNama", "Jenjang Nama Sekolah", 'required', ['required' => '%s tidak boleh kosong']);


            if ($this->form_validation->run() != false) {
                $jenjangNama = $this->input->post('jenjangNama');
                $jenjangKD = $this->input->post('jenjangKD');

                $data = array(
                    'jenjang_nm' => $jenjangNama
                );
                $where = array(
                    'jenjang_kd' => $jenjangKD
                );
                $master->update_data($where, $data, 'ref_jenjang_sekolah');
                $msg = ['sukses' => 'Data Jenjang Sekolah berhasil diupdate'];
            } else {
                $msg = [
                    'error' => '<div class="alert alert-warning mt-1 alert-styled-left alert-dismissible"><button type="button" class="close" data-dismiss="alert"><span>×</span></button><span class="font-weight-semibold">Warning!</span>' . validation_errors() .
                        '.</div>'
                ];
            }

            echo json_encode($msg);
        }
    }

    // End Jenjang Sekolah

    // Jenis Pegawai
    public function listJenisPegawai()
    {
        $data['dataJenisPegawai'] = $this->db->query("SELECT *FROM ref_jenis_pegawai")->result_array();
        $data['head'] = 'include/head';
        $data['header'] = 'include/header';
        $data['menu'] = 'include/menu';
        $data['content'] = 'page/master/listJenisPegawai';
        $data['footer'] = 'include/footer';
        $data['title'] = 'List Jenis Pegawai';
        $data['main_menu'] = 'master';
        $data['sub_menu'] = 'listJenisPegawai';
        $this->load->view('index', $data);
    }


    public function simpanJenisPegawai_ajax()
    {
        if ($this->input->is_ajax_request()) {

            $this->form_validation->set_rules("jenisPegawai[]", "Jenis Pegawai", 'required|is_unique[ref_jenis_pegawai.jns_pegawai_nm]', ['required' => '%s tidak boleh kosong', 'is_unique' => '%s sudah diinput']);

            if ($this->form_validation->run() != false) {

                $countJenisPegawai = count($this->input->post("jenisPegawai"));
                $jenisPegawai = $this->input->post('jenisPegawai');
                if ($countJenisPegawai > 0) {
                    for ($i = 0; $i < $countJenisPegawai; $i++) {
                        if (trim($_POST["jenisPegawai"][$i]) != '') {
                            $this->db->query("INSERT INTO ref_jenis_pegawai(jns_pegawai_nm) VALUES ('" . $_POST['jenisPegawai'][$i] . "')");
                        }
                    }
                }
                $msg = ['sukses' => 'Data Jenis Pegawai berhasil disimpan'];
            } else {
                $msg = [
                    'error' => '<div class="alert alert-warning mt-1 alert-styled-left alert-dismissible"><button type="button" class="close" data-dismiss="alert"><span>×</span></button><span class="font-weight-semibold">Warning!</span>' . validation_errors() .
                        '.</div>'
                ];
            }

            echo json_encode($msg);
        }
    }


    public function hapusJenisPegawai_ajax()
    {
        if ($this->input->is_ajax_request() == true) {
            $jenisPegawaiID = $this->input->post("jenisPegawaiID");
            $hapus = $this->MasterDataModel->hapusJenisPegawai_ajax($jenisPegawaiID);
            if ($hapus) {
                $msg = ['sukses' => 'Data Jenis Pegawai Berhasil Terhapus'];
            }
            echo json_encode($msg);
        }
    }

    public function formEditJenisPegawai()
    {
        if ($this->input->is_ajax_request() == true) {
            $jenisPegawaiID = $this->input->post('jenisPegawaiID');
            $result = $this->db->query("SELECT *FROM ref_jenis_pegawai WHERE jns_pegawai_kd='$jenisPegawaiID'");

            if ($result->num_rows() > 0) {
                $row = $result->row_array();
                $data = [
                    'jenisPegawaiID' => $row['jns_pegawai_kd'],
                    'jenisPegawaiNama' => $row['jns_pegawai_nm']
                ];
            }
            $msg = [
                'sukses' => $this->load->view('page/master/modal/modalEditJenisPegawai', $data, true)
            ];
            echo json_encode($msg);
        }
    }


    public function updateJenisPegawai_ajax()
    {
        if ($this->input->is_ajax_request()) {
            $master = $this->MasterDataModel;

            $this->form_validation->set_rules("jenisPegawaiNama", "Jenis Pegawai", 'required', ['required' => '%s tidak boleh kosong']);

            if ($this->form_validation->run() != false) {
                $jenisPegawaiID = $this->input->post('jenisPegawaiID');
                $jenisPegawaiNama = $this->input->post('jenisPegawaiNama');

                $data = array(
                    'jns_pegawai_nm' => $jenisPegawaiNama
                );
                $where = array(
                    'jns_pegawai_kd' => $jenisPegawaiID
                );
                $master->update_data($where, $data, 'ref_jenis_pegawai');
                $msg = ['sukses' => 'Data Jenis Pegawai berhasil diupdate'];
            } else {
                $msg = [
                    'error' => '<div class="alert alert-warning mt-1 alert-styled-left alert-dismissible"><button type="button" class="close" data-dismiss="alert"><span>×</span></button><span class="font-weight-semibold">Warning!</span>' . validation_errors() .
                        '.</div>'
                ];
            }

            echo json_encode($msg);
        }
    }


    // End Jenis Pegawai


    // Jenis Barang
    public function listJenisBarang()
    {
        $data['dataJenisBarang'] = $this->db->query("SELECT *FROM ref_jenis_barang")->result_array();
        $data['head'] = 'include/head';
        $data['header'] = 'include/header';
        $data['menu'] = 'include/menu';
        $data['content'] = 'page/master/listJenisBarang';
        $data['footer'] = 'include/footer';
        $data['title'] = 'List Jenis Barang';
        $data['main_menu'] = 'master';
        $data['sub_menu'] = 'listJenisBarang';
        $this->load->view('index', $data);
    }


    public function simpanJenisBarang_ajax()
    {
        if ($this->input->is_ajax_request()) {
            $this->form_validation->set_rules("jenisBarang[]", "Jenis Barang", 'required|is_unique[ref_jenis_barang.jns_brg_nm]', ['required' => '%s tidak boleh kosong', 'is_unique' => '%s sudah diinput']);

            if ($this->form_validation->run() != false) {

                $countJenisBarang = count($this->input->post("jenisBarang"));
                $jenisBarang = $this->input->post('jenisBarang');
                if ($countJenisBarang > 0) {
                    for ($i = 0; $i < $countJenisBarang; $i++) {
                        if (trim($_POST["jenisBarang"][$i]) != '') {
                            $this->db->query("INSERT INTO ref_jenis_barang(jns_brg_nm) VALUES ('" . $_POST['jenisBarang'][$i] . "')");
                        }
                    }
                }
                $msg = ['sukses' => 'Data Jenis Barang berhasil disimpan'];
            } else {
                $msg = [
                    'error' => '<div class="alert alert-warning mt-1 alert-styled-left alert-dismissible"><button type="button" class="close" data-dismiss="alert"><span>×</span></button><span class="font-weight-semibold">Warning!</span>' . validation_errors() .
                        '.</div>'
                ];
            }
            echo json_encode($msg);
        }
    }


    public function hapusJenisBarang_ajax()
    {
        if ($this->input->is_ajax_request() == true) {
            $jenisBarangID = $this->input->post("jenisBarangID");
            $hapus = $this->MasterDataModel->hapusJenisBarang_ajax($jenisBarangID);
            if ($hapus) {
                $msg = ['sukses' => 'Data Jenis Barang Berhasil Terhapus'];
            }
            echo json_encode($msg);
        }
    }

    public function formEditJenisBarang()
    {
        if ($this->input->is_ajax_request() == true) {
            $jenisBarangID = $this->input->post('jenisBarangID');
            $result = $this->db->query("SELECT *FROM ref_jenis_barang WHERE jns_brg_kd='$jenisBarangID'");

            if ($result->num_rows() > 0) {
                $row = $result->row_array();
                $data = [
                    'jenisBarangID' => $row['jns_brg_kd'],
                    'jenisBarangNama' => $row['jns_brg_nm']
                ];
            }
            $msg = [
                'sukses' => $this->load->view('page/master/modal/modalEditJenisBarang', $data, true)
            ];
            echo json_encode($msg);
        }
    }


    public function updateJenisBarang_ajax()
    {
        if ($this->input->is_ajax_request()) {
            $master = $this->MasterDataModel;

            $this->form_validation->set_rules("jenisBarangNama", "Jenis Barang", 'required', ['required' => '%s tidak boleh kosong']);

            if ($this->form_validation->run() != false) {
                $jenisBarangID = $this->input->post('jenisBarangID');
                $jenisBarangNama = $this->input->post('jenisBarangNama');

                $data = array(
                    'jns_brg_nm' => $jenisBarangNama
                );
                $where = array(
                    'jns_brg_kd' => $jenisBarangID
                );
                $master->update_data($where, $data, 'ref_jenis_barang');
                $msg = ['sukses' => 'Data Jenis Barang berhasil diupdate'];
            } else {
                $msg = [
                    'error' => '<div class="alert alert-warning mt-1 alert-styled-left alert-dismissible"><button type="button" class="close" data-dismiss="alert"><span>×</span></button><span class="font-weight-semibold">Warning!</span>' . validation_errors() .
                        '.</div>'
                ];
            }

            echo json_encode($msg);
        }
    }


    // End Jenis Barang

    // Sekolah

    public function listSekolah()
    {
        $data['listSekolah'] = $this->db->query("SELECT
        *
    FROM
        dat_sekolah
        INNER JOIN
        ref_jenjang_sekolah
        ON 
            dat_sekolah.jenjang_kd = ref_jenjang_sekolah.jenjang_kd
        INNER JOIN
        ref_dati2
        ON 
            dat_sekolah.dati2_kd = ref_dati2.dati2_kd
        INNER JOIN
        ref_propinsi
        ON 
            dat_sekolah.propinsi_kd = ref_propinsi.propinsi_kd
        INNER JOIN
        ref_kecamatan
        ON 
            dat_sekolah.kecamatan_kd = ref_kecamatan.kecamatan_kd")->result_array();
        $data['head'] = 'include/head';
        $data['header'] = 'include/header';
        $data['menu'] = 'include/menu';
        $data['content'] = 'page/master/listSekolah';
        $data['footer'] = 'include/footer';
        $data['title'] = 'List Sekolah';
        $data['main_menu'] = 'master';
        $data['sub_menu'] = 'listSekolah';
        $this->load->view('index', $data);
    }


    public function tambahSekolah()
    {
        $data['head'] = 'include/head';
        $data['header'] = 'include/header';
        $data['menu'] = 'include/menu';
        $data['content'] = 'page/master/form/tambahSekolah';
        $data['footer'] = 'include/footer';
        $data['title'] = 'Tambah Sekolah';
        $data['main_menu'] = 'master';
        $data['sub_menu'] = 'listSekolah';
        $this->load->view('index', $data);
    }

    public function simpanSekolah_ajax()
    {
        if ($this->input->is_ajax_request()) {
            $this->form_validation->set_rules("jenjang_Sekolah", "Jenjang Sekolah", 'required', ['required' => '%s tidak boleh kosong']);
            $this->form_validation->set_rules("npsn_sekolah", "NPSN Sekolah", 'required|is_unique[dat_sekolah.sekolah_npsn]', ['required' => '%s tidak boleh kosong', 'is_unique' => '%s sudah diinput']);
            $this->form_validation->set_rules("nama_sekolah", "Nama Sekolah", 'required', ['required' => '%s tidak boleh kosong']);
            $this->form_validation->set_rules("status_sekolah", "Status Sekolah", 'required', ['required' => '%s tidak boleh kosong']);
            $this->form_validation->set_rules("yayasan_sekolah", "Yayasan Sekolah", 'required', ['required' => '%s tidak boleh kosong']);
            $this->form_validation->set_rules("alamat_sekolah", "Alamat Sekolah", 'required', ['required' => '%s tidak boleh kosong']);
            $this->form_validation->set_rules("kelurahan", "Kelurahan", 'required', ['required' => '%s tidak boleh kosong']);
            $this->form_validation->set_rules("header1", "Header 1 Sekolah", 'required', ['required' => '%s tidak boleh kosong']);
            $this->form_validation->set_rules("header2", "Header 2 Sekolah", 'required', ['required' => '%s tidak boleh kosong']);
            $this->form_validation->set_rules("header3", "Header 3 Sekolah", 'required', ['required' => '%s tidak boleh kosong']);


            if ($this->form_validation->run() != false) {


                $config['upload_path'] = "./uploads/ImageSekolah   "; //path folder file upload
                $config['allowed_types'] = 'gif|jpg|png|mp4';
                $config['encrypt_name'] = TRUE; //enkripsi file name upload

                $this->load->library('upload', $config); //call library upload 
                if ($this->upload->do_upload("file_logo_sekolah")) { //upload file
                    $data = array('upload_data' => $this->upload->data()); //ambil file name yang diupload

                    $config['image_library'] = 'gd2';
                    $config['source_image'] = './uploads/ImageSekolah/' . $data['upload_data']['file_name'];
                    // $config['create_thumb'] = TRUE;
                    $config['maintain_ratio'] = FALSE;
                    $config['width'] = '300';
                    $config['height'] = '300';
                    $config['new_image'] = './uploads/ImageSekolah/thumbnail/' . $data['upload_data']['file_name'];
                    $this->load->library('image_lib', $config);
                    $this->image_lib->resize();
                    $jenjang_Sekolah = $this->input->post('jenjang_Sekolah');
                    $npsn_sekolah = $this->input->post('npsn_sekolah');
                    $nama_sekolah = $this->input->post('nama_sekolah');
                    $status_sekolah = $this->input->post('status_sekolah');
                    $yayasan_sekolah = $this->input->post('yayasan_sekolah');
                    $provinsi = $this->input->post('provinsi');
                    $kecamatan = $this->input->post('kecamatan');
                    $kabupaten = $this->input->post('kabupaten');
                    $alamat_sekolah = $this->input->post('alamat_sekolah');
                    $kelurahan = $this->input->post('kelurahan');
                    $kode_pos = $this->input->post('kode_pos');
                    $telp_sekolah = $this->input->post('telp_sekolah');
                    $fax_sekolah = $this->input->post('fax_sekolah');
                    $email_sekolah = $this->input->post('email_sekolah');
                    $website_sekolah = $this->input->post('twitter_sekolah');
                    $facebook_sekolah = $this->input->post('facebook_sekolah');
                    $instagram_sekolah = $this->input->post('instagram_sekolah');
                    $twitter_sekolah = $this->input->post('twitter_sekolah');
                    $header1 = $this->input->post('header1');
                    $header2 = $this->input->post('header2');
                    $header3 = $this->input->post('header3');

                    $image = $data['upload_data']['file_name'];

                    $result = $this->MasterDataModel->simpanSekolah($jenjang_Sekolah, $npsn_sekolah, $nama_sekolah, $status_sekolah, $yayasan_sekolah, $provinsi, $kecamatan, $kabupaten, $alamat_sekolah, $kelurahan, $kode_pos, $telp_sekolah, $fax_sekolah, $email_sekolah, $website_sekolah, $facebook_sekolah, $instagram_sekolah, $twitter_sekolah, $image, $header1, $header2, $header3);
                }
                $result = [
                    'sukses' => 'Berhasil Disimpan'
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

    public function formEditSekolah()
    {
        $idSekolah = $this->input->get("id");
        $data['sekolah'] = $this->db->query("SELECT
    *
FROM
    dat_sekolah
    INNER JOIN
    ref_jenjang_sekolah
    ON 
        dat_sekolah.jenjang_kd = ref_jenjang_sekolah.jenjang_kd
    INNER JOIN
    ref_dati2
    ON 
        dat_sekolah.dati2_kd = ref_dati2.dati2_kd
    INNER JOIN
    ref_propinsi
    ON 
        dat_sekolah.propinsi_kd = ref_propinsi.propinsi_kd
    INNER JOIN
    ref_kecamatan
    ON 
        dat_sekolah.kecamatan_kd = ref_kecamatan.kecamatan_kd WHERE dat_sekolah.sekolah_kd='$idSekolah'")->row();

        $data['head'] = 'include/head';
        $data['header'] = 'include/header';
        $data['menu'] = 'include/menu';
        $data['content'] = 'page/master/form/editSekolah';
        $data['footer'] = 'include/footer';
        $data['title'] = 'Edit Sekolah';
        $data['main_menu'] = 'master';
        $data['sub_menu'] = 'listSekolah';
        $this->load->view('index', $data);
    }

    public function updateSekolah_ajax()
    {
        $config['upload_path'] = "./uploads/ImageSekolah   "; //path folder file upload
        $config['allowed_types'] = 'gif|jpg|png|mp4';
        $config['encrypt_name'] = TRUE; //enkripsi file name upload

        $this->load->library('upload', $config); //call library upload 

        if (!$this->upload->do_upload('file_fotoSekolah')) {
            $image = $this->input->post("file_fotoSekolahOld");
        } else {
            $data = array('upload_data' => $this->upload->data());
            $image = $data['upload_data']['file_name'];
            $config['image_library'] = 'gd2';
            $config['source_image'] = './uploads/imageSekolah/' . $data['upload_data']['file_name'];
            // $config['create_thumb'] = TRUE;
            $config['maintain_ratio'] = FALSE;
            $config['width'] = '300';
            $config['height'] = '300';
            $config['new_image'] = './uploads/imageSekolah/thumbnail/' . $data['upload_data']['file_name'];
            $this->load->library('image_lib', $config);
            $this->image_lib->resize();
        }


        //ambil file name yang diupload

        $sekolahID = $this->input->post('sekolahID');
        $jenjang_Sekolah = $this->input->post('jenjang_Sekolah');
        $npsn_sekolah = $this->input->post('npsn_sekolah');
        $nama_sekolah = $this->input->post('nama_sekolah');
        $status_sekolah = $this->input->post('status_sekolah');
        $yayasan_sekolah = $this->input->post('yayasan_sekolah');
        $provinsi = $this->input->post('provinsi');
        $kecamatan = $this->input->post('kecamatan');
        $kabupaten = $this->input->post('kabupaten');
        $alamat_sekolah = $this->input->post('alamat_sekolah');
        $kelurahan = $this->input->post('kelurahan');
        $kode_pos = $this->input->post('kode_pos');
        $telp_sekolah = $this->input->post('telp_sekolah');
        $fax_sekolah = $this->input->post('fax_sekolah');
        $email_sekolah = $this->input->post('email_sekolah');
        $website_sekolah = $this->input->post('twitter_sekolah');
        $facebook_sekolah = $this->input->post('facebook_sekolah');
        $instagram_sekolah = $this->input->post('instagram_sekolah');
        $twitter_sekolah = $this->input->post('twitter_sekolah');
        $header1 = $this->input->post('header1');
        $header2 = $this->input->post('header2');
        $header3 = $this->input->post('header3');


        $image = $data['upload_data']['file_name'];

        $result = $this->MasterDataModel->updateSekolah($jenjang_Sekolah, $npsn_sekolah, $nama_sekolah, $status_sekolah, $yayasan_sekolah, $provinsi, $kecamatan, $kabupaten, $alamat_sekolah, $kelurahan, $kode_pos, $telp_sekolah, $fax_sekolah, $email_sekolah, $website_sekolah, $facebook_sekolah, $instagram_sekolah, $twitter_sekolah, $image, $header1, $header2, $header3, $sekolahID);
        echo json_encode($result);
    }

    public function hapusSekolah_ajax()
    {
        if ($this->input->is_ajax_request() == true) {
            $sekolahID = $this->input->post("sekolahID");
            $hapus = $this->MasterDataModel->hapusSekolah_ajax($sekolahID);
            if ($hapus) {
                $msg = ['sukses' => 'Data Sekolah Berhasil Terhapus'];
            }
            echo json_encode($msg);
        }
    }

    // End Sekolah

    // Kelas
    public function listKelas()
    {
        $data['dataKelas'] = $this->db->query("SELECT sekolah_kelas.*,dat_sekolah.sekolah_nm FROM sekolah_kelas INNER JOIN dat_sekolah ON dat_sekolah.sekolah_kd=sekolah_kelas.sekolah_kd")->result_array();
        $data['head'] = 'include/head';
        $data['header'] = 'include/header';
        $data['menu'] = 'include/menu';
        $data['content'] = 'page/master/listKelas';
        $data['footer'] = 'include/footer';
        $data['title'] = 'List Kelas';
        $data['main_menu'] = 'master';
        $data['sub_menu'] = 'listKelas';
        $this->load->view('index', $data);
    }


    public function simpanKelas_ajax()
    {
        if ($this->input->is_ajax_request()) {
            $this->form_validation->set_rules("jenisKelas[]", "Level Kelas", 'required', ['required' => '%s tidak boleh kosong']);
            $this->form_validation->set_rules("namaKelas[]", "Nama Kelas", 'required', ['required' => '%s tidak boleh kosong']);

            if ($this->form_validation->run() != false) {

                $countKelas = count($this->input->post("jenisKelas"));
                $jenisKelas = $this->input->post('jenisKelas');
                $sekolahKD = $this->input->post('sekolahKD');
                if ($countKelas > 0) {
                    for ($i = 0; $i < $countKelas; $i++) {
                        if (trim($_POST["jenisKelas"][$i]) != '') {
                            $this->db->query("INSERT INTO sekolah_kelas(sekolah_kd,tk_kls_level,kelas_nm) VALUES ('$sekolahKD','" . $_POST['jenisKelas'][$i] . "','" . $_POST['namaKelas'][$i] . "')");
                        }
                    }
                }
                $msg = ['sukses' => 'Data Kelas berhasil disimpan'];
            } else {
                $msg = [
                    'error' => '<div class="alert alert-warning mt-1 alert-styled-left alert-dismissible"><button type="button" class="close" data-dismiss="alert"><span>×</span></button><span class="font-weight-semibold">Warning!</span>' . validation_errors() .
                        '.</div>'
                ];
            }

            echo json_encode($msg);
        }
    }


    public function hapusKelas_ajax()
    {
        if ($this->input->is_ajax_request() == true) {
            $jenisKelas = $this->input->post("jenisKelas");
            $hapus = $this->MasterDataModel->hapusKelas_ajax($jenisKelas);
            if ($hapus) {
                $msg = ['sukses' => 'Data Kelas Berhasil Terhapus'];
            }
            echo json_encode($msg);
        }
    }

    public function formEditKelas()
    {
        if ($this->input->is_ajax_request() == true) {
            $jenisKelas = $this->input->post('jenisKelas');
            $result = $this->db->query("SELECT sekolah_kelas.*,ref_tingkat_kelas.tk_kls_kode,dat_sekolah.sekolah_nm,dat_sekolah.sekolah_npsn FROM sekolah_kelas INNER JOIN dat_sekolah ON dat_sekolah.sekolah_kd=sekolah_kelas.sekolah_kd INNER JOIN ref_tingkat_kelas ON ref_tingkat_kelas.tk_kls_level = sekolah_kelas.tk_kls_level WHERE kelas_kd='$jenisKelas'");

            if ($result->num_rows() > 0) {
                $row = $result->row_array();
                $data = [
                    'kelasKD' => $row['kelas_kd'],
                    'kelasNama' => $row['kelas_nm'],
                    'kelasLevel' => $row['tk_kls_level'],
                    'kelasKode' => $row['tk_kls_kode'],
                    'sekolahNama' => $row['sekolah_nm'],
                    'sekolahNPSN' => $row['sekolah_npsn'],
                    'sekolahKD' => $row['sekolah_kd']
                ];
            }
            $msg = [
                'sukses' => $this->load->view('page/master/modal/modalEditKelas', $data, true)
            ];
            echo json_encode($msg);
        }
    }


    public function updateKelas_ajax()
    {
        if ($this->input->is_ajax_request()) {
            $master = $this->MasterDataModel;

            $this->form_validation->set_rules("jenisKelas", "Nama Kelas", 'required', ['required' => '%s tidak boleh kosong']);

            if ($this->form_validation->run() != false) {
                $kelasKD = $this->input->post('kelasKD');
                $jenisKelas = $this->input->post('jenisKelas');
                $namaKelas = $this->input->post('namaKelas');
                $sekolahKD = $this->input->post('sekolahKD');

                $data = array(
                    'sekolah_kd' => $sekolahKD,
                    'tk_kls_level' => $namaKelas,
                    'kelas_nm' => $jenisKelas
                );
                $where = array(
                    'kelas_kd' => $kelasKD
                );
                $master->update_data($where, $data, 'sekolah_kelas');
                $msg = ['sukses' => 'Data Kelas berhasil diupdate'];
            } else {
                $msg = [
                    'error' => '<div class="alert alert-warning mt-1 alert-styled-left alert-dismissible"><button type="button" class="close" data-dismiss="alert"><span>×</span></button><span class="font-weight-semibold">Warning!</span>' . validation_errors() .
                        '.</div>'
                ];
            }

            echo json_encode($msg);
        }
    }
    // End Kelas


    // Pegawaoi
    public function listPegawai()
    {
        $data['dataPegawai'] = $this->db->query("SELECT df.profile_kd, sekolah_pegawai.*,dat_sekolah.sekolah_nm,dat_sekolah.sekolah_npsn,ref_jenis_pegawai.jns_pegawai_nm FROM sekolah_pegawai INNER JOIN dat_sekolah ON dat_sekolah.sekolah_kd=sekolah_pegawai.sekolah_kd LEFT JOIN dat_profile df ON df.profile_kd=sekolah_pegawai.profile_kd  INNER JOIN ref_jenis_pegawai ON ref_jenis_pegawai.jns_pegawai_kd=sekolah_pegawai.jns_pegawai_kd")->result_array();
        $data['head'] = 'include/head';
        $data['header'] = 'include/header';
        $data['menu'] = 'include/menu';
        $data['content'] = 'page/master/listPegawai';
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
            $hapus = $this->MasterDataModel->hapusPegawai_ajax($jenisPegawai);
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
                'sukses' => $this->load->view('page/master/modal/modalEditPegawai', $data, true)
            ];
            echo json_encode($msg);
        }
    }


    public function updatePegawai_ajax()
    {
        if ($this->input->is_ajax_request()) {
            $master = $this->MasterDataModel;

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
                $master->update_data($where, $data, 'sekolah_pegawai');
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
        $data['content'] = 'page/master/form/tambahProfilePegawai';
        $data['footer'] = 'include/footer';
        $data['title'] = 'Detail Profile';
        $data['main_menu'] = 'master';
        $data['sub_menu'] = 'listUser';
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
        $data['content'] = 'page/master/form/editProfilePegawai';
        $data['footer'] = 'include/footer';
        $data['title'] = 'Detail Profile';
        $data['main_menu'] = 'master';
        $data['sub_menu'] = 'listUser';
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

                    $result = $this->MasterDataModel->simpanProfile($userGroup, $nik, $nama_depan, $nama_tengah, $nama_belakang, $agama, $tempat_lahir, $tanggalLahir, $jenisKelamin, $provinsi, $kabupaten, $kecamatan, $alamat, $kelurahan, $kodePos, $telp, $email, $keterangan_jabatan, $image);
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


    // Iklan
    public function listIklan()
    {
        $data['dataIklan'] = $this->db->query("SELECT df.profile_kd, sekolah_pegawai.*,dat_sekolah.sekolah_nm,dat_sekolah.sekolah_npsn,ref_jenis_pegawai.jns_pegawai_nm FROM sekolah_pegawai INNER JOIN dat_sekolah ON dat_sekolah.sekolah_kd=sekolah_pegawai.sekolah_kd LEFT JOIN dat_profile df ON df.profile_kd=sekolah_pegawai.profile_kd  INNER JOIN ref_jenis_pegawai ON ref_jenis_pegawai.jns_pegawai_kd=sekolah_pegawai.jns_pegawai_kd")->result_array();
        $data['head'] = 'include/head';
        $data['header'] = 'include/header';
        $data['menu'] = 'include/menu';
        $data['content'] = 'page/master/listIklan';
        $data['footer'] = 'include/footer';
        $data['title'] = 'List Iklan';
        $data['main_menu'] = 'master';
        $data['sub_menu'] = 'listIklan';
        $this->load->view('index', $data);
    }



    public function hapusIklan_ajax()
    {
        if ($this->input->is_ajax_request() == true) {
            $jenisPegawai = $this->input->post("jenisPegawai");
            $hapus = $this->MasterDataModel->hapusPegawai_ajax($jenisPegawai);
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
        $data['content'] = 'page/master/form/editIklan';
        $data['footer'] = 'include/footer';
        $data['title'] = 'List Iklan';
        $data['main_menu'] = 'iklan';
        $data['sub_menu'] = 'listIklan';
        $this->load->view('index', $data);
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
        $data['content'] = 'page/master/form/tambahIklan';
        $data['footer'] = 'include/footer';
        $data['title'] = 'Detail Ilan';
        $data['main_menu'] = 'master';
        $data['sub_menu'] = 'listIklan';
        $this->load->view('index', $data);
    }


    public function tambahIklan()
    {
        $data['head'] = 'include/head';
        $data['header'] = 'include/header';
        $data['menu'] = 'include/menu';
        $data['content'] = 'page/master/form/tambahIklan';
        $data['footer'] = 'include/footer';
        $data['title'] = 'Detail Profile';
        $data['main_menu'] = 'master';
        $data['sub_menu'] = 'listUser';
        $this->load->view('index', $data);
    }



    public function simpanIklan_ajax()
    {
        $master = $this->MasterDataModel;
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
            $master->input_data($data, 'dat_iklan');
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
                        $this->db->query("INSERT INTO dat_iklan_gambar(iklan_kd,iklan_gambar_link) VALUES('$idIklan',' $namaFoto')");
                        echo json_encode($result);
                        echo 'File successfully uploaded : uploads/imageIklan/' . $namaFoto . ' ';
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

    // List Kelas
    function listTingkatKelas()
    {
        $data['dataTingkatKelas'] = $this->db->query("SELECT *FROM ref_tingkat_kelas")->result_array();
        $data['head'] = 'include/head';
        $data['header'] = 'include/header';
        $data['menu'] = 'include/menu';
        $data['content'] = 'page/master/listTingkatKelas';
        $data['footer'] = 'include/footer';
        $data['title'] = 'List Tingkat Kelas';
        $data['main_menu'] = 'master';
        $data['sub_menu'] = 'listTingkatKelas';
        $this->load->view('index', $data);
    }



    public function simpanTingkatKelas_ajax()
    {
        if ($this->input->is_ajax_request()) {

            $this->form_validation->set_rules("levelKelas", "Level Kelas", 'required|is_unique[ref_tingkat_kelas.tk_kls_kode]', ['required' => '%s tidak boleh kosong', 'is_unique' => '%s sudah ada']);

            $this->form_validation->set_rules("kodeKelas", "Kode Kelas", 'required', ['required' => '%s tidak boleh kosong']);
            if ($this->form_validation->run() != false) {
                $countKelas = count($this->input->post("levelKelas"));
                $levelKelas = $this->input->post('levelKelas');
                $kodeKelas = $this->input->post('kodeKelas');
                if ($countKelas > 0) {
                    for ($i = 0; $i < $countKelas; $i++) {
                        if (trim($_POST["levelKelas"]) != '') {
                            $this->db->query("INSERT INTO ref_tingkat_kelas(tk_kls_level,tk_kls_kode) VALUES ('$levelKelas','$kodeKelas')");
                        }
                    }
                }
                $msg = ['sukses' => 'Data Tingkat Kelas berhasil disimpan'];
            } else {
                $msg = [
                    'error' => '<div class="alert alert-warning mt-1 alert-styled-left alert-dismissible"><button type="button" class="close" data-dismiss="alert"><span>×</span></button><span class="font-weight-semibold">Warning!</span>' . validation_errors() .
                        '.</div>'
                ];
            }
            echo json_encode($msg);
        }
    }


    public function hapusTingkatKelas_ajax()
    {
        if ($this->input->is_ajax_request() == true) {
            $kelasLevel = $this->input->post("jenisTingkatKelas");
            $hapus = $this->MasterDataModel->hapusTingkatKelas_ajax($kelasLevel);
            if ($hapus) {
                $msg = ['sukses' => 'Data Tingkat Kelas Berhasil Terhapus'];
            }
            echo json_encode($msg);
        }
    }

    public function formEditTingkatKelas()
    {
        if ($this->input->is_ajax_request() == true) {
            $kelasLevel = $this->input->post('jenisTingkatKelas');
            $result = $this->db->query("SELECT *FROM ref_tingkat_kelas WHERE tk_kls_level='$kelasLevel'");

            if ($result->num_rows() > 0) {
                $row = $result->row_array();
                $data = [
                    'kelasLevel' => $row['tk_kls_level'],
                    'kelasKode' => $row['tk_kls_kode']
                ];
            }
            $msg = [
                'sukses' => $this->load->view('page/master/modal/modalEditTingkatKelas', $data, true)
            ];
            echo json_encode($msg);
        }
    }


    public function updateTingkatKelas_ajax()
    {
        if ($this->input->is_ajax_request()) {
            $master = $this->MasterDataModel;

            $this->form_validation->set_rules("kelasLevel", "Nama Level", 'required', ['required' => '%s tidak boleh kosong']);
            $this->form_validation->set_rules("kelasKode", "Nama Kelas", 'required', ['required' => '%s tidak boleh kosong']);

            if ($this->form_validation->run() != false) {
                $kelasLevel = $this->input->post('kelasLevel');
                $kelasKode = $this->input->post('kelasKode');
                $kelasLevelNew = $this->input->post('kelasLevelNew');
                $data = array(
                    'tk_kls_level' => $kelasLevelNew,
                    'tk_kls_kode' => $kelasKode
                );
                $where = array(
                    'tk_kls_level' => $kelasLevel
                );
                $master->update_data($where, $data, 'ref_tingkat_kelas');
                $msg = ['sukses' => 'Data Tingkat Kelas berhasil diupdate'];
            } else {
                $msg = [
                    'error' => '<div class="alert alert-warning mt-1 alert-styled-left alert-dismissible"><button type="button" class="close" data-dismiss="alert"><span>×</span></button><span class="font-weight-semibold">Warning!</span>' . validation_errors() .
                        '.</div>'
                ];
            }

            echo json_encode($msg);
        }
    }
    // End Tingkat Kelas

    // Tahun Pelajaran
    function listTahunPelajaran()
    {
        $data['dataTahunPelajaran'] = $this->db->query("SELECT *FROM ref_tahun_pelajaran")->result_array();
        $data['head'] = 'include/head';
        $data['header'] = 'include/header';
        $data['menu'] = 'include/menu';
        $data['content'] = 'page/master/listTahunPelajaran';
        $data['footer'] = 'include/footer';
        $data['title'] = 'List Tahun Pelajaran';
        $data['main_menu'] = 'master';
        $data['sub_menu'] = 'listTahunPelajaran';
        $this->load->view('index', $data);
    }



    public function simpanTahunPelajaran_ajax()
    {
        if ($this->input->is_ajax_request()) {


            $tahunAjaran1 = $this->input->post("tahunAjaran");
            $tahunAjaran2 = intval($tahunAjaran1) + 1;
            $tahunAjaran = $tahunAjaran1 . '/' . $tahunAjaran2;

            $this->form_validation->set_rules('tahunAjaran', "Tahun Ajaran", 'required|is_unique[ref_tahun_pelajaran.thn_ajar_periode]', ['required' => '%s tidak boleh kosong', 'is_unique' => '%s sudah diinput']);
            $this->form_validation->set_rules("tanggalMulai", "Tanggal Mulai", 'required', ['required' => '%s tidak boleh kosong']);
            $this->form_validation->set_rules("tanggalBerakhir", "Tanggal Akhir", 'required', ['required' => '%s tidak boleh kosong']);

            if ($this->form_validation->run() != false) {
                $countTahunPelajaran = count($this->input->post("tahunAjaran"));
                $tahunAjaran1 = $this->input->post("tahunAjaran");
                $tahunAjaran2 = intval($tahunAjaran1) + 1;
                $tahunAjaran = $tahunAjaran1 . '/' . $tahunAjaran2;

                $tanggalMulai = $this->input->post('tanggalMulai');
                $tanggalBerakhir = $this->input->post('tanggalBerakhir');
                if ($countTahunPelajaran > 0) {
                    for ($i = 0; $i < $countTahunPelajaran; $i++) {
                        if (trim($_POST["tahunAjaran"]) != '') {
                            $this->db->query("INSERT INTO ref_tahun_pelajaran(thn_ajar_periode,thn_ajar_tgl_mulai,thn_ajar_tgl_akhir) VALUES ('$tahunAjaran','$tanggalMulai','$tanggalBerakhir')");
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


    public function hapusTahunPelajaran_ajax()
    {
        if ($this->input->is_ajax_request() == true) {
            $tahunAjaran = $this->input->post("jenisTahunPelajaran");
            $hapus = $this->MasterDataModel->hapusTahunPelajaran_ajax($tahunAjaran);
            if ($hapus) {
                $msg = ['sukses' => 'Data Tahun Ajaran Berhasil Terhapus'];
            }
            echo json_encode($msg);
        }
    }

    public function formEditTahunPelajaran()
    {
        if ($this->input->is_ajax_request() == true) {
            $tahunPelajaran = $this->input->post('jenisTahunPelajaran');
            $result = $this->db->query("SELECT *FROM ref_tahun_pelajaran WHERE thn_ajar_kd='$tahunPelajaran'");

            if ($result->num_rows() > 0) {
                $row = $result->row_array();
                $data = [
                    'tahunAjaranKD' => $row['thn_ajar_kd'],
                    'tahunPeriode' => $row['thn_ajar_periode'],
                    'tanggalMulai' => $row['thn_ajar_tgl_mulai'],
                    'tanggalAkhir' => $row['thn_ajar_tgl_akhir']
                ];
            }
            $msg = [
                'sukses' => $this->load->view('page/master/modal/modalEditTahunPelajaran', $data, true)
            ];
            echo json_encode($msg);
        }
    }


    public function updateTahunPelajaran_ajax()
    {
        if ($this->input->is_ajax_request()) {
            $master = $this->MasterDataModel;

            $this->form_validation->set_rules("tahunAjaranEdit", "Tahun Ajaran", 'required', ['required' => '%s tidak boleh kosong']);
            $this->form_validation->set_rules("tanggalMulai", "Tanggal Mulai", 'required', ['required' => '%s tidak boleh kosong']);
            $this->form_validation->set_rules("tanggalBerakhir", "Tanggal Berakhir", 'required', ['required' => '%s tidak boleh kosong']);

            if ($this->form_validation->run() != false) {
                $tahunAjaran1 = $this->input->post('tahunAjaranEdit');
                $tahunAjaranKD = $this->input->post('tahunAjaranKD');
                $tahunAjaran2 = intval($tahunAjaran1) + 1;

                $tahunAjaran = $tahunAjaran1 . '/' . $tahunAjaran2;
                $tanggalMulai = $this->input->post('tanggalMulai');
                $tanggalBerakhir = $this->input->post('tanggalBerakhir');
                $data = array(
                    'thn_ajar_periode' => $tahunAjaran,
                    'thn_ajar_tgl_mulai' => $tanggalMulai,
                    'thn_ajar_tgl_akhir' => $tanggalBerakhir
                );
                $where = array(
                    'thn_ajar_kd' => $tahunAjaranKD
                );
                $master->update_data($where, $data, 'ref_tahun_pelajaran');
                $msg = ['sukses' => 'Data Tahun Pelajaran berhasil diupdate'];
            } else {
                $msg = [
                    'error' => '<div class="alert alert-warning mt-1 alert-styled-left alert-dismissible"><button type="button" class="close" data-dismiss="alert"><span>×</span></button><span class="font-weight-semibold">Warning!</span>' . validation_errors() .
                        '.</div>'
                ];
            }

            echo json_encode($msg);
        }
    }

    // Tahun Pelajaran


    // SIswa

    public function listSiswa()
    {
        $data['dataSiswa'] = $this->db->query("SELECT * from dat_profile inner join ref_jenis_user on ref_jenis_user.jns_user_kd=dat_profile.jns_user_kd
        where dat_profile.profile_status='1' AND  ref_jenis_user.jns_user_nm LIKE '%Siswa%' ")->result_array();
        $data['head'] = 'include/head';
        $data['header'] = 'include/header';
        $data['menu'] = 'include/menu';
        $data['content'] = 'page/master/listSiswa';
        $data['footer'] = 'include/footer';
        $data['title'] = 'List Siswa';
        $data['main_menu'] = 'siswa';
        $data['sub_menu'] = 'listSiswa';
        $this->load->view('index', $data);
    }


    public function tambahSiswa()
    {
        $data['head'] = 'include/head';
        $data['header'] = 'include/header';
        $data['menu'] = 'include/menu';
        $data['content'] = 'page/master/form/tambahSiswa';
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
        $data['content'] = 'page/master/form/editSiswaProfile';
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

                    $result = $this->MasterDataModel->simpanProfile($userSiswa, $nik, $nama_depan, $nama_tengah, $nama_belakang, $agama, $tempat_lahir, $tanggalLahir, $jenisKelamin, $provinsi, $kabupaten, $kecamatan, $alamat, $kelurahan, $kodePos, $telp, $email, $keterangan_jabatan, $image);
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
    // End User

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
        $data['sub_menu'] = 'listKompetensiInti';
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
        $data['sub_menu'] = 'home';
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
            $master = $this->MasterDataModel;

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
                $kdCapaian = $this->input->post('kdCapaian');


                $data = array(
                    'ki_id' => $kompetensiInti,
                    'kd_semester' => $kdSemester,
                    'kd_kode' => $kdKode,
                    'kd_keterangan' => $kdKeterangan,
                    'kd_alokasi_waktu' => $kdAlokasiWaktu,
                    'kd_tema' => $kdTema,
                    'kd_sub_tema' => $kdSubTema,
                    'kd_capaian_perkembangan' => $kdCapaian,
                );
                $where = array(
                    'kd_id' => $kdID
                );
                $master->update_data($where, $data, 'komp_dasar');
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
            $master = $this->MasterDataModel;

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
                $master->update_data($where, $data, 'komp_inti');
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
            if ($update) {
                $msg = ['sukses' => 'Data Kompetensi Inti Berhasil Terhapus'];
            }
            echo json_encode($msg);
        }
    }

    public function ambilDataKompInti()
    {
        if ($this->input->is_ajax_request() == true) {

            $this->load->model('MasterDataModel', 'master');
            $list = $this->master->get_datatables_kompInti();
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
                "recordsTotal" => $this->master->count_all_kompInti(),
                "recordsFiltered" => $this->master->count_filtered_kompInti(),
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
        $data['sub_menu'] = 'listKompetensiDasar';
        $this->load->view('index', $data);
    }

    function fetchKompDasar()
    {
        $queryID = $this->input->post("query");
        $id = $this->input->post("kiID");
        $this->load->model('MasterDataModel', 'master');
        $list = $this->master->get_datatables_kompDasar($id);
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
            "recordsTotal" => $this->master->count_all_kompDasar($id),
            "recordsFiltered" => $this->master->count_filtered_kompDasar($id),
            "data" => $data,
        );
        //output dalam format JSON
        echo json_encode($output);
    }

    public function ambilDataKompDasar()
    {
        if ($this->input->is_ajax_request() == true) {
            $id = $this->input->post("kiID");
            $this->load->model('MasterDataModel', 'master');
            $list = $this->master->get_datatables_kompDasar($id);
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
                "recordsTotal" => $this->master->count_all_kompDasar($id),
                "recordsFiltered" => $this->master->count_filtered_kompDasar($id),
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
        $data['sub_menu'] = 'home';
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
            $this->form_validation->set_rules("kdCapaian[]", "Capaian Perkembangan Kompetensi Dasar", 'required', ['required' => 'tidak boleh kosong']);

            if ($this->form_validation->run() != false) {

                $countKompInti = count($this->input->post("kompetensiInti"));

                if ($countKompInti > 0) {
                    for ($i = 0; $i < $countKompInti; $i++) {
                        if (trim($_POST["kompetensiInti"][$i]) != '') {
                            $this->db->query("INSERT INTO komp_dasar(ki_id,kd_semester,kd_kode,kd_keterangan,kd_alokasi_waktu,kd_tema,kd_sub_tema,kd_capaian_perkembangan,kd_status) VALUES ('" . $_POST["kompetensiInti"][$i] . "','" . $_POST["kdSemester"][$i] . "','" . $_POST["kdKode"][$i] . "','" . $_POST["kdKeterangan"][$i] . "','" . $_POST["kdAlokasiWaktu"][$i] . "','" . $_POST["kdTema"][$i] . "','" . $_POST["kdSubTema"][$i] . "','" . $_POST["kdCapaian"][$i] . "','0')");
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
        $data['sub_menu'] = 'listKompetensiDasarAlokasi';
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
            $this->load->model('MasterDataModel', 'master');
            $list = $this->master->get_datatables_kompDasarAlokasi($id);
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
                "recordsTotal" => $this->master->count_all_kompDasarAlokasi($id),
                "recordsFiltered" => $this->master->count_filtered_kompDasarAlokasi($id),
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
        $data['sub_menu'] = 'home';
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
                    'kadJumlah' => $row['kad_minggu']
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
            $master = $this->MasterDataModel;

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
                $master->update_data($where, $data, 'komp_dasar_alokasi');
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
            $kompDasarID = $this->input->post("kompDasarID");
            $update = $this->db->query("UPDATE komp_dasar SET kd_status='1' WHERE kd_id='$kompDasarID'");
            if ($update) {
                $msg = ['sukses' => 'Data Kompetensi Dasar Berhasil Di Publikasikan'];
            }
            echo json_encode($msg);
        }
    }

    public function updateKompIntiPublikasi()
    {

        if ($this->input->is_ajax_request() == true) {
            $kiID = $this->input->post("kiID");
            $update = $this->db->query("UPDATE komp_inti SET ki_status='1' WHERE ki_id='$kiID'");
            if ($update) {
                $msg = ['sukses' => 'Data Kompetensi Inti Berhasil Di Publikasikan'];
            }
            echo json_encode($msg);
        }
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
        $data['main_menu'] = 'kompetensi';
        $data['sub_menu'] = 'listKKM';
        $this->load->view('index', $data);
    }

    function fetchKKM()
    {
        $id = $this->input->post("kdID");
        $this->load->model('MasterDataModel', 'master');
        $list = $this->master->get_datatables_kkm($id);
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
            "recordsTotal" => $this->master->count_all_kkm($id),
            "recordsFiltered" => $this->master->count_filtered_kkm($id),
            "data" => $data,
        );
        //output dalam format JSON
        echo json_encode($output);
    }

    public function ambilDataKKM()
    {
        if ($this->input->is_ajax_request() == true) {
            $id = $this->input->post("kdID");
            $this->load->model('MasterDataModel', 'master');
            $list = $this->master->get_datatables_kkm($id);
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
                "recordsTotal" => $this->master->count_all_kkm($id),
                "recordsFiltered" => $this->master->count_filtered_kkm($id),
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
        $data['sub_menu'] = 'home';
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
            $master = $this->MasterDataModel;

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
                $master->update_data($where, $data, 'dat_kkm');
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

    // End KKM
}
