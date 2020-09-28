<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
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
		$data['head'] = 'include/head';
		$data['header'] = 'include/header';
		$data['menu'] = 'include/menu';
		$data['content'] = 'page/dashboard';
		$data['footer'] = 'include/footer';
		$data['title'] = 'Dashboard';
		$data['main_menu'] = 'dashboard';
		$data['sub_menu'] = 'home';
		$this->load->view('index', $data);
	}
	public function contoh()
	{
		$id = $this->input->get("id");
		echo $id;
	}
}
