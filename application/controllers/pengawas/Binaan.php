<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Binaan extends CI_Controller
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
        $this->load->model("BinaanModel");
        $this->load->library('form_validation');
    }


    public function listGuruBinaan()
    {
        $data['head'] = 'include/head';
        $data['header'] = 'include/header';
        $data['menu'] = 'include/menu';
        $data['content'] = 'page/binaan/listGuruBinaan';
        $data['footer'] = 'include/footer';
        $data['title'] = 'List Guru Binaan';
        $data['main_menu'] = 'snp';
        $data['sub_menu'] = 'listGuruBinaan';
        $this->load->view('index', $data);
    }

    public function listSekolahBinaan()
    {
        $data['head'] = 'include/head';
        $data['header'] = 'include/header';
        $data['menu'] = 'include/menu';
        $data['content'] = 'page/binaan/listSekolahBinaan';
        $data['footer'] = 'include/footer';
        $data['title'] = 'List Sekolah Binaan';
        $data['main_menu'] = 'snp';
        $data['sub_menu'] = 'listSekolahBinaan';
        $this->load->view('index', $data);
    }
}
