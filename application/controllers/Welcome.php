<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Welcome extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('WelcomeModel');
	}
	public function index()
	{
		$this->load->view('welcome_message');
	}

	public function dashboard()
	{
		$this->load->view('FrontEnd/include/header');
		$this->load->view('FrontEnd/page/dashboard');
		$this->load->view('FrontEnd/include/footer');
	}

	public function detailBerita()
	{
		$id = $this->input->get("id");
		$data['result'] = $this->db->query("SELECT *FROM dat_berita where berita_kd='$id'")->row();
		$this->load->view('FrontEnd/include/header');
		$this->load->view('FrontEnd/page/detailBerita', $data);
		$this->load->view('FrontEnd/include/footer');
	}
	public function detailProfile()
	{
		$id = $this->input->get("id");

		$this->load->view('FrontEnd/include/header');
		$this->load->view('FrontEnd/page/detailProfile');
		$this->load->view('FrontEnd/include/footer');
	}

	public function visiMisi()
	{
		$this->load->view('FrontEnd/include/header');
		$this->load->view('FrontEnd/page/visi');
		$this->load->view('FrontEnd/include/footer');
	}

	public function pengurusSurat()
	{
		$this->load->view('FrontEnd/include/header');
		$this->load->view('FrontEnd/page/pengurusSurat');
		$this->load->view('FrontEnd/include/footer');
	}
	public function adart()
	{
		$this->load->view('FrontEnd/include/header');
		$this->load->view('FrontEnd/page/adart');
		$this->load->view('FrontEnd/include/footer');
	}

	public function auth()
	{
		$this->load->view('welcome_message');
	}


	public function register()
	{
		$this->load->view('FrontEnd/include/header');
		$this->load->view('FrontEnd/page/register');
		$this->load->view('FrontEnd/include/footer');
	}


	function get_kabupaten()
	{
		$id = $this->input->post('id');
		$data = $this->WelcomeModel->get_kabupaten($id);
		echo json_encode($data);
	}

	function get_kecamatan()
	{
		$id_provinsi = $this->input->post('id_provinsi');
		$id_kabupaten = $this->input->post('id_kabupaten');
		$dataKecamatan = $this->WelcomeModel->get_kecamatan($id_provinsi, $id_kabupaten);
		echo json_encode($dataKecamatan);
	}


	function registrasiUser()
	{
		if ($this->input->is_ajax_request()) {
			$this->form_validation->set_rules("validasi_cek", "Validasi Cek", 'required', ['required' => '%s perlu di centang']);
			$this->form_validation->set_rules("jenisUser", "Jenis User", 'required', ['required' => '%s tidak boleh kosong']);
			$this->form_validation->set_rules("nip", "NIP", 'required', ['required' => '%s tidak boleh kosong']);
			$this->form_validation->set_rules("nama1", "Nama Depan", 'required', ['required' => '%s tidak boleh kosong']);
			$this->form_validation->set_rules("tempat_lahir", "Tempat Lahir", 'required', ['required' => '%s tidak boleh kosong']);
			$this->form_validation->set_rules("tanggalLahir", "Tanggal Lahir", 'required', ['required' => '%s tidak boleh kosong']);

			$this->form_validation->set_rules("alamat", "Alamat", 'required', ['required' => '%s tidak boleh kosong']);
			$this->form_validation->set_rules("nik", "NIK", 'required', ['required' => '%s tidak boleh kosong']);
			$this->form_validation->set_rules("nuptk", "NUPTK", 'required', ['required' => '%s tidak boleh kosong']);

			$this->form_validation->set_rules("nrg", "NRG", 'required', ['required' => '%s tidak boleh kosong']);
			$this->form_validation->set_rules("pendidikanTerakhir", "Pendidikan Terakhir", 'required', ['required' => '%s tidak boleh kosong']);
			$this->form_validation->set_rules("jenisKelamin", "Jenis Kelamin", 'required', ['required' => '%s tidak boleh kosong']);
			$this->form_validation->set_rules("agama", "Agama", 'required', ['required' => '%s tidak boleh kosong']);
			$this->form_validation->set_rules("nrg", "NRG", 'required', ['required' => '%s tidak boleh kosong']);
			$this->form_validation->set_rules("provinsi", "Provinsi", 'required', ['required' => '%s tidak boleh kosong']);
			$this->form_validation->set_rules("kabupaten", "Kabupaten", 'required', ['required' => '%s tidak boleh kosong']);
			$this->form_validation->set_rules("kecamatan", "Kecamatan", 'required', ['required' => '%s tidak boleh kosong']);
			$this->form_validation->set_rules("kelurahan", "Kelurahan", 'required', ['required' => '%s tidak boleh kosong']);
			$this->form_validation->set_rules("kodePos", "Kode Pos", 'required', ['required' => '%s tidak boleh kosong']);
			$this->form_validation->set_rules("alamat", "Alamat", 'required', ['required' => '%s tidak boleh kosong']);
			$this->form_validation->set_rules("username", "Username", 'required', ['required' => '%s tidak boleh kosong']);
			$this->form_validation->set_rules("password", "Password", 'required|trim|min_length[3]|matches[password2]', [
				'matches' => 'Password Tidak Sama !',
				'min_length' => 'Password tidak boleh kurang dari 3 karakter'
			]);
			$this->form_validation->set_rules("password2", "Password", 'required|trim|min_length[3]|matches[password]', [
				'matches' => 'Password Tidak Sama !'
			]);

			if ($this->form_validation->run() != false) {

				$nip = $this->input->post('nip');
				$nik = $this->input->post('nik');
				$nama1 = $this->input->post('nama1');
				$nama2 = $this->input->post('nama2');
				$nama3 = $this->input->post('nama3');
				$tempat_lahir = $this->input->post('tempat_lahir');
				$tanggalLahir = $this->input->post('tanggalLahir');
				$nuptk = $this->input->post('nuptk');
				$nrg = $this->input->post('nrg');
				$telp = $this->input->post('telp');
				$email = $this->input->post('email');
				$pendidikanTerakhir = $this->input->post('pendidikanTerakhir');
				$provinsi = $this->input->post('provinsi');
				$kabupaten = $this->input->post('kabupaten');
				$kecamatan = $this->input->post('kecamatan');
				$kelurahan = $this->input->post('kelurahan');
				$kodePos = $this->input->post("kodePos");
				$alamat = $this->input->post('alamat');
				$jenisKelamin = $this->input->post('jenisKelamin');
				$agama = $this->input->post('agama');
				$username = $this->input->post('username');
				$password = $this->input->post('password');
				$jenisUser = $this->input->post('jenisUser');

				$this->WelcomeModel->simpanProfile(
					$jenisUser,
					$nip,
					$nik,
					$nama1,
					$nama2,
					$nama3,
					$agama,
					$tempat_lahir,
					$tanggalLahir,
					$jenisKelamin,
					$provinsi,
					$kabupaten,
					$kecamatan,
					$alamat,
					$kelurahan,
					$kodePos,
					$telp,
					$email,
					$pendidikanTerakhir,
					$nuptk,
					$nrg
				);
				// $idProfile = $dataProfile->profile_kd;
				$idProfile = $this->db->insert_id();
				$this->db->query("INSERT INTO dat_user (profile_kd,user_nm,user_password) VALUES ('$idProfile','$username','$password')");
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

					$result = $this->UserModel->simpanProfile($userGroup, $nik, $nama_depan, $nama_tengah, $nama_belakang, $agama, $tempat_lahir, $tanggalLahir, $jenisKelamin, $provinsi, $kabupaten, $kecamatan, $alamat, $kelurahan, $kodePos, $telp, $email, $keterangan_jabatan, $image);
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

							$countkelasID = count($this->input->post("kelasID"));
							if ($countkelasID > 0) {
								for ($i = 0; $i < $countkelasID; $i++) {
									if (trim($_POST["kelasID[" . $i . "]"]) != '') {
										$this->db->query("INSERT INTO guru_mengajar(pegawai_kd,kelas_kd) VALUES('" . $idPegawai . "','" . $_POST["kelasID[" . $i . "]"] . "')");
									}
								}
							}
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
}
