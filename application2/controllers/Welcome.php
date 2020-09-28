<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Welcome extends CI_Controller
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
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
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
}
