<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class STPPA extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('STPPAModel');
		//$this->load->model('MasterDataModel');
		$this->load->library('form_validation');
		$this->load->library('RaxLoader');
	}

	// public function index()
	// {
	//     $data['data_stppa'] = $this->db->query("SELECT * FROM stppa")->result_array();
 //   	    $data['head'] = 'include/head';
 //   	    $data['header'] = 'include/header';
 //   	    $data['menu'] = 'include/menu';
 //   	    $data['content'] = 'page/master/listSTPPA';
 //   	    $data['footer'] = 'include/footer';
 //   	    $data['title'] = 'List STPPA';
 //   	    $data['main_menu'] = 'STPPA';
 //   	    $data['sub_menu'] = 'listSTPPA';
 //   	    $this->load->view('index', $data);
	// }

	public function test()
	{ $this->load->model('STPPAModel', 'stppa');
	        $list = $this->stppa->get_datatables();
			        var_dump ($list);
	        die();
	}

	public function index()
	{
	    $data['data_stppa'] = $this->db->query("SELECT * FROM stppa")->result_array();
   	    $data['head'] = 'include/head';
   	    $data['header'] = 'include/header';
   	    $data['menu'] = 'include/menu';
   	    $data['content'] = 'page/stppa/listSTPPA';
   	    $data['footer'] = 'include/footer';
   	    $data['title'] = 'List STPPA';
   	    $data['main_menu'] = 'STPPA';
   	    $data['sub_menu'] = 'listSTPPA';
   	    $this->load->view('index', $data);
	}

	public function listSTPPASubLingkup()
	{
	    // $data['data_stppa_sub_lingkup'] = $this->db->query("SELECT * FROM stppa_sub_lingkup")->result_array();
   	    $data['head'] = 'include/head';
   	    $data['header'] = 'include/header';
   	    $data['menu'] = 'include/menu';
   	    $data['content'] = 'page/stppa/sublingkup/listSTPPASubLingkup';
   	    $data['footer'] = 'include/footer';
   	    $data['title'] = 'List STPPA Sub Lingkup';
   	    $data['main_menu'] = 'STPPA';
   	    $data['sub_menu'] = 'listSTPPASubLingkup';
   	    $this->load->view('index', $data);
	}


	public function listSTPPADetail()
	{
	    // $data['data_stppa_sub_lingkup'] = $this->db->query("SELECT * FROM stppa_sub_lingkup")->result_array();
   	    $data['head'] = 'include/head';
   	    $data['header'] = 'include/header';
   	    $data['menu'] = 'include/menu';
   	    $data['content'] = 'page/stppa/detail_lingkup/listSTPPADetailLingkup';
   	    $data['footer'] = 'include/footer';
   	    $data['title'] = 'List STPPA Detail';
   	    $data['main_menu'] = 'STPPA';
   	    $data['sub_menu'] = 'listSTPPADetailLingkup';
   	    $this->load->view('index', $data);
	}

	public function getTahunAjar()
	{
		$kd = $this->input->get('kd');
		$r 	= $this->db->get_where('ref_tahun_pelajaran',  array('thn_ajar_kd' => $kd))->row_array();
		echo json_encode($r);
	}

	public function updateStatus()
	{
		if ($this->input->is_ajax_request()) {
			$kd = $this->input->post('id');
			$status = $this->input->post('status');
			$r 	= $this->db->get_where('stppa',  array('stppa_id' => $kd))->row_array();
	        if (!empty($r)) {
	        	$cek = $this->db->update('stppa', array(
	        		"stppa_status"=>$status
	        	), array(
	        		"stppa_id"=>$kd
	        	));
	        	$msg = ['sukses' => 'STPPA berhasil '.($status=="0"?"tidak ditayangkan":"di tayangkan")];
	        }else{
	        	$msg = [
	        	    'error' => '<div class="alert alert-warning mt-1 alert-styled-left alert-dismissible"><button type="button" class="close" data-dismiss="alert"><span>×</span></button><span class="font-weight-semibold">Warning!</span>Data tidak ditemukan.</div>'
	        	];
	        }
	        echo json_encode($msg);
        } else {
        	exit("Tidak dapat menampilkan");
        }
	}

	public function getSTPPA()
	{
		if ($this->input->is_ajax_request()) {
			$kd = $this->input->post('id');
			$r 	= $this->db->get_where('stppa',  array('stppa_id' => $kd))->row_array();
			echo json_encode($r);
		}else{
			exit("Tidak dapat menampikan");
		}
	}

	public function formDetailSTPPA()
	{
	    if ($this->input->is_ajax_request() == true) {
	        $stppaID = $this->input->post('stppa_id');
	        // $stppaID = $this->input->post('stppa_id');
	        $result = $this->STPPAModel->getSTPPAJoin($stppaID);

/*	        if ($result->num_rows() > 0) {
	             
	        }*/
	           $row = $result->row_array();
	           $lingkup =$this->db->get_where('stppa_lingkup',array("stppa_id"=>$stppaID))->result_array();
	           $data = [
	               'STPPA_ID' => $row['stppa_id'],
	               'JENJANG_KD' => $row['jenjang_kd'],
	               'JENJANG_NM' => $row['jenjang_nm'],
	               'PERIODE' => $row['periode'],
	               'MULAI' => $row['mulai'],
	               'AKHIR' => $row['akhir'],
	               'STPPA_LINGKUP'=>$lingkup
	               
	           ];
	           // if (!empty($lingkup)) {
	           // 	$data['STPPA_LINGKUP']
	           // }
	        	$msg = [
	        	    'sukses' => $this->load->view('page/stppa/modalDetailSTPPA', $data, true)
	        	];  
	        echo json_encode($msg);
	    }
	}

	public function ambilDataSTPPA()
	{
	    if ($this->input->is_ajax_request() == true) {
	        $this->load->model('STPPAModel', 'stppa');
	        $list = $this->stppa->get_datatables();
	        $data = array();

	        $no = $_POST['start'];
	        foreach ($list as $field) {


	            $no++;
	            $tombolGrup="<div  class='btn-group  btn-group-sm' role='group'>";
	            // $tombolSub = "<button type=\"button\" class=\"btn btn-outline-primary\" title=\"Sub data\" onclick=\"list_sub('" . $field->stppa_id . "')\">
	            //     Sub Data
	            // </button>";
	            $tombolStatus = "
	            <button type=\"button\" class=\"btn btn-outline-secondary\" data-status=\"$field->stppa_status\" data-id=\"$field->stppa_id\"  onclick=\"set_status(this)\">
	                ".($field->stppa_status=='1'?'Draf':'Tayangkan')."
	            </button>"; 
	            $tombolDetail = "
	            <button type=\"button\" data-target=\"#modalSubLingkup\" data-toggle=\"modal\" class=\"btn btn-outline-info\" title=\"Detail data\" onclick=\"detail('" . $field->stppa_id . "')\">
	                View
	            </button>"; 
	            $tombolEdit = "
	            <button type=\"button\" class=\"btn btn-outline-success\" title=\"Edit data\" onclick=\"edit('" . $field->stppa_id . "')\">
	                Edit
	            </button>";
	            $tombolHapus = "<button type=\"button\" class=\"btn btn-outline-danger\" title=\"Hapus data\" onclick=\"hapus('" . $field->stppa_id . "')\">
	                Hapus
	            </button>";
	            // $tombolInfo = "<button class=\"btn btn-outline-primary\" title=\"View data\" >
	            //     View Data
	            // </button>";
	            $tombolPrint = "<button class=\"btn btn-outline-primary\" title=\"Print data\" >
	                Print Data
	            </button>";
	            $row = array();
	            $row[] = "<input type=\"checkbox\" class=\"centangSTPPA\" value=\"$field->stppa_id\" name=\"stppaID[]\">";
	            $row[] = $no . ".";
	            $row[] = $field->JENJANG_NM;
	            // $row[] = $field->LINGKUP;
	            $row[] = $field->TAHUN_AJAR;
	            $row[] = date('j F Y',strtotime($field->MULAI));
	            $row[] = date('j F Y',strtotime($field->AKHIR));
	            $row[] = $tombolGrup.$tombolStatus.$tombolDetail.$tombolEdit . $tombolHapus . $tombolPrint.'</div>';
	            $data[] = $row;
	        }

	        $output = array(
	            "draw" => $_POST['draw'],
	            "recordsTotal" => $this->stppa->count_all(),
	            "recordsFiltered" => $this->stppa->count_filtered(),
	            "data" => $data,
	        );
	        // output dalam format JSON
	        echo json_encode($output);
	    } else {
	        exit('Maaf data tidak bisa ditampilkan');
	    }
	}

	public function getLingkupSTPPA()
	{
		if ($this->input->is_ajax_request()==true) {
			$stppa_id 	= $this->input->post('id');
			$query		= $this->db->query("SELECT sl.sl_id,sl.stppa_id,sl.sl_keterangan FROM stppa_lingkup sl left join stppa s on sl.stppa_id = s.stppa_id where sl.stppa_id = '$stppa_id' ")->result_array();
			echo json_encode($query);
		}else{
			exit('Maaf data tidak bisa ditampilkan');
		}
	}

	public function getSubLingkupSTPPA()
	{
		if ($this->input->is_ajax_request()==true) {
			$stppa_id 		= $this->input->post('stppa_id');
			$lingkup_id 	= $this->input->post('id_lingkup');
			$sub_lingkup_id = $this->input->post('id');
			$query		= $this->db->query("SELECT `ssl`.ssl_id,`sl`.stppa_id,`ssl`.ssl_keterangan FROM stppa_sub_lingkup `ssl` left join stppa_lingkup `sl` on `ssl`.sl_id = `sl`.sl_id where `ssl`.sl_id = '$lingkup_id' and `sl`.stppa_id = '$stppa_id' ")->result_array();
			echo json_encode($query);
		}else{
			exit('Maaf data tidak bisa ditampilkan');
		}
	}

	public function getDetailSTPPA()
	{
		if ($this->input->is_ajax_request()==true) {
			$sub_lingkup_id = $this->input->post('id_sublingkup');
			$query		= $this->db->query("SELECT `ssd`.ssd_id,`ssl`.ssl_id,`sl`.stppa_id,`ssd`.ssd_keterangan FROM stppa_detail `ssd` left join stppa_sub_lingkup `ssl` on `ssd`.ssl_id  =`ssl`.ssl_id left join stppa_lingkup `sl` on `ssl`.sl_id = `sl`.sl_id where `ssd`.ssl_id = '$sub_lingkup_id'")->result_array();
			echo json_encode($query);
		}else{
			exit('Maaf data tidak bisa ditampilkan');
		}
	}

	public function ambilDataSTPPASubLingkup()
	{
	    if ($this->input->is_ajax_request() == true) {
	    	$this->load->model('STPPAModel', 'stppa_sub_lingkup');
	    	$list = $this->stppa_sub_lingkup->get_datatables_sub_lingkup($_POST['id']);
	    	$data = array();
	    	$no = $_POST['start'];
	    	foreach ($list as $field) {
	    	    $no++;
	    	    $tombolGrup="<div  class='btn-group  btn-group-sm' role='group'>";
	    	    // $tombolSub = "<button type=\"button\" class=\"btn btn-outline-primary\" title=\"Sub data\" onclick=\"list_sub('" . $field->stppa_id . "')\">
	    	    //     Sub Data
	    	    $tombolHapus = "<button type=\"button\" class=\"btn btn-outline-danger\" title=\"Hapus data\" onclick=\"hapus_sub('" . $field->ssl_id . "')\">
	    	        Hapus
	    	    </button>";
	    	    $row = array();
	    	    $row[] = "<input type=\"checkbox\" class=\"centang\" value=\"$field->ssl_id\" name=\"stppaID[]\">";
	    	    $row[] = $no . ".";
	    	    $row[] = $field->keterangan;
	    	    // $row[] = $field->LINGKUP;
	    	    $row[] = $field->total;
	    	    $row[] = $tombolGrup . $tombolHapus .'</div>';
	    	    $data[] = $row;
	    	}

	    	$output = array(
	    	    "draw" => $_POST['draw'],
	    	    "recordsTotal" => $this->stppa_sub_lingkup->count_all_sub_lingkup(),
	    	    "recordsFiltered" => $this->stppa_sub_lingkup->count_filtered_sub_lingkup($_POST['id']),
	    	    "data" => $data,
	    	);
	    	// output dalam format JSON
	    	echo json_encode($output);
	    } else {
	        exit('Maaf data tidak bisa ditampilkan');
	    }
	}


	public function ambilDataSTPPADetail()
	{
	    if ($this->input->is_ajax_request() == true) {
	    	$this->load->model('STPPAModel', 'stppa_detail');
	    	$list = $this->stppa_detail->get_datatables_detail($_POST['id']);
	    	$data = array();
	    	$no = $_POST['start'];
	    	foreach ($list as $field) {
	    	    $no++;
	    	    $tombolGrup="<div  class='btn-group  btn-group-sm' role='group'>";
	    	    // $tombolSub = "<button type=\"button\" class=\"btn btn-outline-primary\" title=\"Sub data\" onclick=\"list_sub('" . $field->stppa_id . "')\">
	    	    //     Sub Data
	    	    $tombolHapus = "<button type=\"button\" class=\"btn btn-outline-danger\" title=\"Hapus data\" onclick=\"hapus_sub('" . $field->ssd_id . "')\">
	    	        Hapus
	    	    </button>";
	    	    $row = array();
	    	    $row[] = "<input type=\"checkbox\" class=\"centangSTPPADetail\" value=\"$field->ssd_id\" name=\"STPPADetailID[]\">";
	    	    $row[] = $no . ".";
	    	    $row[] = $field->keterangan;
	    	    $row[] = $tombolGrup . $tombolHapus .'</div>';
	    	    $data[] = $row;
	    	}

	    	$output = array(
	    	    "draw" => $_POST['draw'],
	    	    "list"=>$list,
	    	    "id"=>$_POST['id'],
	    	    "recordsTotal" => $this->stppa_detail->count_all_detail(),
	    	    "recordsFiltered" => $this->stppa_detail->count_filtered_detail($_POST['id']),
	    	    "data" => $data,
	    	);
	    	// output dalam format JSON
	    	echo json_encode($output);
	    } else {
	        exit('Maaf data tidak bisa ditampilkan');
	    }
	}



	function rules(){
	    $this->form_validation->set_message('max_length', '{field} tidak dapat lebih dari {param} karakter.');
	    $this->form_validation->set_message('min_length', '{field} tidak dapat kurang dari {param} karakter.');
	    $this->form_validation->set_message('required', 'Memerlukan {field}.');
	    $this->form_validation->set_message('valid_email', '{field} tidak valid.');
	    $this->form_validation->set_message('matches', '{field} tidak serupa.');
	    $this->form_validation->set_message('is_unique', '{field} telah digunakan.');
	}

	public function cek_jenjang($par){
	    $cek = $this->db->get_where('ref_jenjang_sekolah',array("jenjang_kd"=>$par))->row();

	    if(empty($cek))
	    {
	       $this->form_validation->set_message('cek_jenjang', 'Jenjang tidak ditemukan');
	       return FALSE;
	    } 
	    return TRUE;
	}

	public function cek_periode($par){
	    $cek = $this->db->get_where('ref_tahun_pelajaran',array("thn_ajar_kd"=>$par))->row();

	    if(empty($cek))
	    {
	       $this->form_validation->set_message('cek_periode', 'Periode tidak ditemukan');
	       return FALSE;
	    } 
	    return TRUE;
	}

	public function cek_stppa($par){
	    $cek = $this->db->get_where('stppa',array("stppa_id"=>$par))->row();

	    if(empty($cek))
	    {
	       $this->form_validation->set_message('cek_stppa', 'STPPA tidak ditemukan');
	       return FALSE;
	    } 
	    return TRUE;
	}

	public function cek_stppa_lingkup($par){
	    $cek = $this->db->get_where('stppa_lingkup',array("sl_id"=>$par))->row();

	    if(empty($cek))
	    {
	       $this->form_validation->set_message('cek_stppa_lingkup', 'STPPA Lingkup tidak ditemukan');
	       return FALSE;
	    } 
	    return TRUE;
	}

	public function cek_stppa_sub_lingkup($par){
	    $cek = $this->db->get_where('stppa_sub_lingkup',array("ssl_id"=>$par))->row();

	    if(empty($cek))
	    {
	       $this->form_validation->set_message('cek_stppa_sub_lingkup', 'STPPA Sub Lingkup tidak ditemukan');
	       return FALSE;
	    } 
	    return TRUE;
	}

	public function simpanSTPPA_ajax()
	{
	    if ($this->input->is_ajax_request()) {
	        $STPPA = $this->STPPAModel;
	        $this->form_validation->set_rules("jenjang", "Jenjang STPPA", 'required|xss_clean|callback_cek_jenjang');
	        $this->form_validation->set_rules("periode", "Periode STPPA", 'required|xss_clean|callback_cek_periode');
	        if (!empty($_POST['stppa'])) {
	       		$input = $this->input->post();
	        	for ($i=0; $i <count(); $i++) { 
	        		$this->form_validation->set_rules("stppa[".$i."]", "Periode STPPA", 'required|xss_clean|max_length[512]');
	        	}
	        }
	        $this->rules();
	       
	        if ($this->form_validation->run() != false) {
	            
	        	$jenjang_kd 	= $this->input->post('jenjang');
	        	$thn_ajar_kd 	= $this->input->post('periode');
	        	$lingkup 		= $this->input->post('lingkup');

	            $data = array(
	                'jenjang_kd' => $jenjang_kd,
	                'thn_ajar_kd' => $thn_ajar_kd
	            );
	            $id = $STPPA->add('stppa',$data);
	            if (!empty($id)) {
	            	for ($i=0; $i <count($lingkup); $i++) { 
		        		$data = array(
		        		    'stppa_id' => $id,
		        		    'sl_keterangan' => $lingkup[$i]
		        		);
		        		$id_lingkup = $STPPA->add('stppa_lingkup',$data);
		        	}
		        	$msg = ['sukses' => 'Data STPPA berhasil disimpan'];
	            }
	        } else {
	            $msg = [
	                'error' => '<div class="alert alert-warning mt-1 alert-styled-left alert-dismissible"><button type="button" class="close" data-dismiss="alert"><span>×</span></button><span class="font-weight-semibold">Warning!</span>' . validation_errors() .
	                    '.</div>'
	            ];
	        }
	        echo json_encode($msg);
	    }
	}

	public function simpanSTPPASublingkup_ajax()
	{
	    if ($this->input->is_ajax_request()) {
	        $STPPA = $this->STPPAModel;
	        $this->form_validation->set_rules("add_stppa", "STPPA", 'required|xss_clean|callback_cek_stppa');
	        $this->form_validation->set_rules("add_stppa_lingkup", "STPPA Lingkup", 'required|xss_clean|callback_cek_stppa_lingkup');
	        if (!empty($_POST['add_sublingkup'])) {
	       		$input = $this->input->post();
	        	for ($i=0; $i <count($_POST['add_sublingkup']); $i++) { 
	        		$this->form_validation->set_rules("add_sublingkup[".$i."]", "STPPA Sub lingkup", 'required|xss_clean|max_length[512]');
	        	}
	        }
	        $this->rules();
	       
	        if ($this->form_validation->run() != false) {
	            
	        	$stppa 	= $this->input->post('add_stppa');
	        	$stppa_lingkup 	= $this->input->post('add_stppa_lingkup');
	        	$stppa_sublingkup 	= $this->input->post('add_sublingkup');
	            if (!empty($stppa_sublingkup)) {
	            	for ($i=0; $i <count($stppa_sublingkup); $i++) { 
		        		$data = array(
		        		    'sl_id' => $stppa_lingkup,
		        		    'ssl_keterangan' => $stppa_sublingkup[$i]
		        		);
		        		$id_lingkup = $STPPA->add('stppa_sub_lingkup',$data);
		        	}
		        	$msg = ['sukses' => 'Data Sub lingkup STPPA berhasil disimpan'];
	            }else{
	            	$msg = [
	            	    'error' => '<div class="alert alert-warning mt-1 alert-styled-left alert-dismissible"><button type="button" class="close" data-dismiss="alert"><span>×</span></button><span class="font-weight-semibold">Warning!</span>' . validation_errors() .
	            	        '.</div>'
	            	];
	            }
	        } else {
	            $msg = [
	                'error' => '<div class="alert alert-warning mt-1 alert-styled-left alert-dismissible"><button type="button" class="close" data-dismiss="alert"><span>×</span></button><span class="font-weight-semibold">Warning!</span>' . validation_errors() .'.</div>'
	            ];
	        }
	        echo json_encode($msg);
	    }
	}

	public function simpanSTPPADetail_ajax()
	{
	    if ($this->input->is_ajax_request()) {
	        $STPPA = $this->STPPAModel;
	        $this->form_validation->set_rules("add_stppa", "STPPA", 'required|xss_clean|callback_cek_stppa');
	        $this->form_validation->set_rules("add_stppa_lingkup", "STPPA Lingkup", 'required|xss_clean|callback_cek_stppa_lingkup');
	        $this->form_validation->set_rules("add_stppa_sub_lingkup", "STPPA Sub Lingkup", 'required|xss_clean|callback_cek_stppa_sub_lingkup');
	        if (!empty($_POST['add_stppa_detail'])) {
	       		$input = $this->input->post();
	        	for ($i=0; $i <count($_POST['add_stppa_detail']); $i++) { 
	        		$this->form_validation->set_rules("add_stppa_detail[".$i."]", "STPPA Sub lingkup", 'required|xss_clean|max_length[512]');
	        	}
	        }
	        $this->rules();
	       
	        if ($this->form_validation->run() != false) {
	            
	        	$stppa 	= $this->input->post('add_stppa');
	        	$stppa_lingkup 		= $this->input->post('add_stppa_lingkup');
	        	$stppa_sublingkup 	= $this->input->post('add_stppa_sub_lingkup');
	        	$stppa_detail 		= $this->input->post('add_stppa_detail');
	            if (!empty($stppa_detail)) {
	            	for ($i=0; $i <count($stppa_detail); $i++) { 
		        		$data = array(
		        		    'ssl_id' => $stppa_sublingkup,
		        		    'ssd_keterangan' => $stppa_detail[$i]
		        		);
		        		$id_lingkup = $STPPA->add('stppa_detail',$data);
		        	}
		        	$msg = ['sukses' => 'Data Detail STPPA berhasil disimpan'];
	            }else{
	            	$msg = [
	            	    'error' => '<div class="alert alert-warning mt-1 alert-styled-left alert-dismissible"><button type="button" class="close" data-dismiss="alert"><span>×</span></button><span class="font-weight-semibold">Warning!</span>' . validation_errors() .
	            	        '.</div>'
	            	];
	            }
	        } else {
	            $msg = [
	                'error' => '<div class="alert alert-warning mt-1 alert-styled-left alert-dismissible"><button type="button" class="close" data-dismiss="alert"><span>×</span></button><span class="font-weight-semibold">Warning!</span>' . validation_errors() .'.</div>'
	            ];
	        }
	        echo json_encode($msg);
	    }
	}

	public function deleteMultiple_ajax()
	{
	    if ($this->input->is_ajax_request() == true) {
	        $stppaID = $this->input->post('stppaID');
	        $jmlData = count($stppaID);
	        $hapusData = $this->STPPAModel->deleteMultiple_ajax($stppaID, $jmlData);
	        if ($hapusData == true) {
	            $msg = ['sukses' => "Data SPPTA berhasil dihapus"];
	        }
	        echo json_encode($msg);
	    } else {
	        exit("Maaf Data Tidak Bisa DiLanjutkan");
	    }
	}

	public function test_()
	{
		$lingkup 		= $this->input->post('lingkup');
		foreach ($lingkup as $key => $value) {
			echo $value;
		}
	}

	// public function test2()
	// {
	// 	$lingkup 		= $this->input->post('lingkup_edit');
	// 	$idlingkup 		= $this->input->post('idlingkup_edit');
	// 	foreach ($idlingkup as $key => $value) {
	// 		echo "lingkup : ".$lingkup[$key]."<br>";
	// 	}
	// }

	public function updateSTPPA_ajax()
	{

		if ($this->input->is_ajax_request() == true) {
		    $STPPA = $this->STPPAModel;
	        $this->form_validation->set_rules("edit_jenjang", "Jenjang STPPA", 'required|xss_clean|callback_cek_jenjang');
	        $this->form_validation->set_rules("edit_periode", "Periode STPPA", 'required|xss_clean|callback_cek_periode');
	        if (!empty($_POST['lingkup_edit'])) {
	        	for ($i=0; $i <count($this->input->post('lingkup_edit')); $i++) { 
	        		$this->form_validation->set_rules("lingkup_edit[".$i."]", "Periode STPPA", 'required|xss_clean|max_length[512]');
	        	}
	        }
	        $this->rules();
	       
	        if ($this->form_validation->run() != false) {
	            
	        	$jenjang_kd 	= $this->input->post('edit_jenjang');
	        	$thn_ajar_kd 	= $this->input->post('edit_periode');
	        	$lingkup 		= $this->input->post('lingkup_edit');
	        	$idlingkup 		= $this->input->post('idlingkup_edit');
	        	$STPPAID 		= $this->input->post("edit_stppa_id");
	            $data = array(
	                'jenjang_kd' => $jenjang_kd,
	                'thn_ajar_kd' => $thn_ajar_kd
	            );

		        $where = array(
		            "stppa_id" => $STPPAID
		        );

		        $id = $STPPA->update('stppa',$where,$data);
		        if (!empty($id)) {
		        	$data2 = array();
		        	$no = 0;
		        	$kes="";
		        	foreach ($lingkup as $key => $value) {
		        		//$kes.= "lingkup : ".$lingkup[$key]."<br>";
		        		if (!empty($idlingkup[$key])) {
		        			$data2 = array(
		        			    'sl_keterangan' => $lingkup[$key]
		        			);
		        			$this->db->update('stppa_lingkup',$data2, 
		        				array('sl_id' => $idlingkup[$key])
		        			);
		        		}else{
		        			$data2 = array(
		        				'stppa_id'=>$STPPAID,
		        			    'sl_keterangan' => $lingkup[$key]
		        			);
		        			$this->db->insert('stppa_lingkup',$data2);
		        		}
		        		// $isData = $this->db->query("select sl_keterangan from stppa_lingkup where sl_id='".$idlingkup[$key]."'")->row();
		        		// $dd = $isData->sl_keterangan;
		        		// if (isset($isData->sl_keterangan)) {
		        			
		        		// }else{
		        			
		        		// }
		        	}
		        	$this->session->set_flashdata('success',"Data STPPA berhasil disimpan");
		        	$msg = ['sukses' => "Data STPPA berhasil diubah"];
		        }else{
		        	$msg = [
		        	    'error' => '<div class="alert alert-warning mt-1 alert-styled-left alert-dismissible"><button type="button" class="close" data-dismiss="alert"><span>×</span></button><span class="font-weight-semibold">Warning!</span>' . validation_errors() .
		        	        '.</div>'
		        	];
		        }

		        echo json_encode($msg);
		    }
		}else{
			exit("Maaf Data Tidak Bisa DiLanjutkan");
		}
	    
	}

	public function updateSTPPASubLingkup_ajax()
	{

		if ($this->input->is_ajax_request()) {
		    $STPPA = $this->STPPAModel;
		    $this->form_validation->set_rules("edit_stppa", "STPPA", 'required|xss_clean|callback_cek_stppa');
		    $this->form_validation->set_rules("edit_stppa_lingkup", "STPPA Lingkup", 'required|xss_clean|callback_cek_stppa_lingkup');
		    if (!empty($_POST['edit_sublingkup'])) {
		   		$input = $this->input->post();
		    	for ($i=0; $i <count($_POST['edit_sublingkup']); $i++) { 
		    		$this->form_validation->set_rules("edit_sublingkup[".$i."]", "STPPA Sub lingkup", 'required|xss_clean|max_length[512]');
		    	}
		    }
		    $this->rules();
		    if ($this->form_validation->run() != false) {
		        
		    	$stppa 				= $this->input->post('edit_stppa');
		    	$stppa_lingkup 		= $this->input->post('edit_stppa_lingkup');
		    	$stppa_sublingkup 	= ($this->input->post('edit_sublingkup')?$this->input->post('edit_sublingkup'):null);
		    	$stppa_sublingkup_id= $this->input->post('id_sublingkup');
		        if ($stppa_sublingkup!=null&&!empty($stppa_sublingkup)) {
		        	$data2 = array();
		        	$no = 0;
		        	$kes="";
		        	foreach ($stppa_sublingkup as $key => $value) {
		        		//$kes.= "lingkup : ".$lingkup[$key]."<br>";
		        		if (!empty($stppa_sublingkup_id[$key])) {
		        			$data2 = array(
		        			    'ssl_keterangan' => $stppa_sublingkup[$key]
		        			);
		        			$this->db->update('stppa_sub_lingkup',$data2, 
		        				array('ssl_id' => $stppa_sublingkup_id[$key])
		        			);
		        		}else{
		        			$data2 = array(
		        				'sl_id'=>$stppa_lingkup,
		        			    'ssl_keterangan' => $stppa_sublingkup[$key]
		        			);
		        			$this->db->insert('stppa_sub_lingkup',$data2);
		        		}
		        	}
		        	$this->session->set_flashdata('success',"Data STPPA berhasil disimpan");
		        	$msg = ['sukses' => "Data Sub Lingkup STPPA berhasil ".(!empty($stppa_sublingkup_id)?"ditambah":"diubah")];
		        }else{
		        	$data2 = array(
		        		'sl_id'=>$stppa_lingkup,
		        		'ssl_keterangan' => null
		        	);
		        	$ret = $this->db->insert('stppa_sub_lingkup',$data2);
		        	if (!empty($ret)) {
		        		$msg = ['sukses' => "Data Sub Lingkup STPPA berhasil ".(!empty($stppa_sublingkup_id)?"ditambah":"diubah")];
		        	}else{
		        		$msg = [
		        		    'error' => '<div class="alert alert-warning mt-1 alert-styled-left alert-dismissible"><button type="button" class="close" data-dismiss="alert"><span>×</span></button><span class="font-weight-semibold">Warning!</span>' . validation_errors() .
		        		        '.</div>'
		        		];
		        	}
		        }

		        echo json_encode($msg);
		    }
		}else{
			exit("Maaf Data Tidak Bisa DiLanjutkan");
		}
	    
	}

	public function updateSTPPADetail_ajax()
	{

		if ($this->input->is_ajax_request()) {
		    $STPPA = $this->STPPAModel;
		    $this->form_validation->set_rules("edit_stppa", "STPPA", 'required|xss_clean|callback_cek_stppa');
		    $this->form_validation->set_rules("edit_stppa_lingkup", "STPPA Lingkup", 'required|xss_clean|callback_cek_stppa_lingkup');
		    $this->form_validation->set_rules("edit_stppa_sub_lingkup", "STPPA Sub Lingkup", 'required|xss_clean|callback_cek_stppa_sub_lingkup');
		    if (!empty($_POST['edit_detail'])) {
		   		$input = $this->input->post();
		    	for ($i=0; $i <count($_POST['edit_detail']); $i++) { 
		    		$this->form_validation->set_rules("edit_detail[".$i."]", "Detail STPPA", 'required|xss_clean|max_length[512]');
		    	}
		    }
		    $this->rules();
		    if ($this->form_validation->run() != false) {
		        
		    	$stppa 				= $this->input->post('edit_stppa');
		    	$stppa_lingkup 		= $this->input->post('edit_stppa_lingkup');
		    	$stppa_sublingkup 	= $this->input->post('edit_sublingkup');
		    	$stppa_detail 		= $this->input->post('edit_detail');
		    	$stppa_detail_id= $this->input->post('id_detail');
		    	$data2 = array();
		    	foreach ($stppa_detail as $key => $value) {
		    		if (!empty($stppa_detail_id[$key])) {
		    			$data2 = array(
		    			    'ssd_keterangan' => $stppa_detail[$key]
		    			);
		    			$this->db->update('stppa_sub_lingkup',$data2, 
		    				array('ssd_id' => $stppa_detail_id[$key])
		    			);
		    		}else{
		    			$data2 = array(
		    				'ssl_id'=>$stppa_sublingkup,
		    			    'ssd_keterangan' => $stppa_detail[$key]
		    			);
		    			$this->db->insert('stppa_detail',$data2);
		    		}
		    	}
		    	$this->session->set_flashdata('success',"Data Detail STPPA berhasil ".(!empty($stppa_detail_id)?"ditambah":"diubah"));
		    	$msg = ['sukses' => "Data Sub Lingkup STPPA berhasil ".(!empty($stppa_detail_id)?"ditambah":"diubah")];

		        echo json_encode($msg);
		    }
		}else{
			exit("Maaf Data Tidak Bisa DiLanjutkan");
		}
	    
	}

	public function formEditSTPPA()
	{
	    if ($this->input->is_ajax_request() == true) {
	        $stppaID = $this->input->post('stppa_id');
	        // $stppaID = $this->input->post('stppa_id');
	        $result = $this->STPPAModel->getSTPPAJoin($stppaID);

/*	        if ($result->num_rows() > 0) {
	             
	        }*/
	           $row = $result->row_array();
	           $lingkup =$this->db->get_where('stppa_lingkup',array("stppa_id"=>$stppaID))->result_array();
	           $data = [
	               'STPPA_ID' => $row['stppa_id'],
	               'JENJANG_KD' => $row['jenjang_kd'],
	               'JENJANG_NM' => $row['jenjang_nm'],
	               'PERIODE' => $row['periode'],
	               'TAHUN_AJAR' => $row['thn_ajar_kd'],
	               'MULAI' => $row['mulai'],
	               'AKHIR' => $row['akhir'],
	               'STPPA_LINGKUP'=>$lingkup
	               
	           ];
	           // if (!empty($lingkup)) {
	           // 	$data['STPPA_LINGKUP']
	           // }
	        	$msg = [
	        	    'sukses' => $this->load->view('page/stppa/modalEditSTPPA', $data, true)
	        	];  
	        echo json_encode($msg);
	    }
	}

	public function formEditSTPPASubLingkup()
	{
	    if ($this->input->is_ajax_request() == true) {
	        $stppaID = $this->input->post('stppa_id');
	        $lingkupID = $this->input->post('lingkup_id');
	        // $stppaID = $this->input->post('stppa_id');
	        $result = $this->STPPAModel->getSTPPAJoin($stppaID);
/*	        if ($result->num_rows() > 0) {
	             
	        }*/
	           $row = $result->row_array();
	           $lingkup =$this->db->get_where('stppa_lingkup',array("sl_id"=>$lingkupID))->row_array();
	           $sublingkup =$this->db->get_where('stppa_sub_lingkup',array("sl_id"=>$lingkupID))->result_array();
	           $data = [
	               'STPPA_LINGKUP'=>$lingkup,
	               'STPPA_SUB_LINGKUP'=>$sublingkup
	               
	           ];
	           // if (!empty($lingkup)) {
	           // 	$data['STPPA_LINGKUP']
	           // }
	        	$msg = [
	        	    'sukses' => $this->load->view('page/stppa/sublingkup/modalEditSTPPASubLingkup', $data, true)
	        	];  
	        echo json_encode($msg);
	    }
	}

	public function formEditDetailSTPPA()
	{
	    if ($this->input->is_ajax_request() == true) {
	        $stppaID = $this->input->post('stppa_id');
	        // $stppaID = $this->input->post('stppa_id');
	        $result = $this->STPPAModel->getSTPPAJoin($stppaID);

/*	        if ($result->num_rows() > 0) {
	             
	        }*/
	           $row = $result->row_array();
	           $lingkup =$this->db->get_where('stppa_lingkup',array("stppa_id"=>$stppaID))->result_array();
	           $data = [
	               'STPPA_ID' => $row['stppa_id'],
	               'JENJANG_KD' => $row['jenjang_kd'],
	               'JENJANG_NM' => $row['jenjang_nm'],
	               'PERIODE' => $row['periode'],
	               'MULAI' => $row['mulai'],
	               'AKHIR' => $row['akhir'],
	               'STPPA_LINGKUP'=>$lingkup
	               
	           ];
	           // if (!empty($lingkup)) {
	           // 	$data['STPPA_LINGKUP']
	           // }
	        	$msg = [
	        	    'sukses' => $this->load->view('page/stppa/modalDetailSTPPA', $data, true)
	        	];  
	        echo json_encode($msg);
	    }
	}

	public function hapusSTPPA_ajax()
	{
	    if ($this->input->is_ajax_request() == true) {
	        $stppaID = $this->input->post("stppaID");
	        $hapus = $this->STPPAModel->hapusSTPPA_ajax($stppaID);
	        if ($hapus) {
	            $msg = ['sukses' => 'Data STPPA Berhasil Terhapus'];
	        }
	        echo json_encode($msg);
	    }
	}

	public function hapusSTPPALingkup_ajax()
	{
	    if ($this->input->is_ajax_request() == true) {
	        $slID = $this->input->post("sl_id");
	        $hapus = $this->STPPAModel->hapusSTPPALingkup_ajax($slID);
	        if ($hapus) {
	            $msg = ['sukses' => 'Data Lingkup STPPA Berhasil Terhapus'];
	        }else{
	        	$msg = ['error' => 'Data Lingkup STPPA Gagal Terhapus'];
	        }
	        echo json_encode($msg);
	    }
	}
	public function hapusSTPPASubLingkup_ajax()
	{
	    if ($this->input->is_ajax_request() == true) {
	        $sslID = $this->input->post("sub_id");
	        $hapus = $this->STPPAModel->hapusSTPPASubLingkup_ajax($sslID);
	        if ($hapus) {
	            $msg = ['sukses' => 'Data Sub Lingkup Berhasil Terhapus'];
	        }
	        echo json_encode($msg);
	    }
	}
	public function hapusSTPPASubLingkupData_ajax()
	{
	    if ($this->input->is_ajax_request() == true) {
	        $slID = $this->input->post("id");
	        $cek   = $this->db->get_where('stppa_sub_lingkup', array("sl_id"=>$slID))->num_rows();
	        if ($cek>0) {
	        	$hapus = $this->STPPAModel->hapusSTPPASubLingkupData_ajax($slID);
	        	if ($hapus) {
	        	    $msg = ['sukses' => 'Data Sub Lingkup Serta Isinya Berhasil Terhapus'];
	        	}else{

	        	}
	        }else{
	        	$msg = ['error' => 'Tidak terdapat Sub Lingkup'];
	        }
	        echo json_encode($msg);
	    }else{
	    	exit("Tidak dapat diakses");
	    }
	}
	public function hapusSTPPADetail_ajax()
	{
	    if ($this->input->is_ajax_request() == true) {
	        $ssdID = $this->input->post("detail_id");
	        $hapus = $this->STPPAModel->hapusSTPPADetail_ajax($ssdID);
	        if ($hapus) {
	            $msg = ['sukses' => 'Data Detail Sub Lingkup Berhasil Terhapus'];
	        }
	        echo json_encode($msg);
	    }
	}
	public function hapusSTPPADetailData_ajax()
	{
	    if ($this->input->is_ajax_request() == true) {
	        $ssdID = $this->input->post("id");
	        $hapus = $this->STPPAModel->hapusRPPMDetailData_ajax($ssdID);
	        if ($hapus) {
	            $msg = ['sukses' => 'Data Detail Berhasil Terhapus'];
	        }
	        echo json_encode($msg);
	    }
	}


}

/* End of file STPPA.php */
/* Location: ./application/controllers/STPPA.php */