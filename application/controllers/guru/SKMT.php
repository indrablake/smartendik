<?php
defined('BASEPATH') or exit('No direct script access allowed');

class SKMT extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model("guru/SKMTModel");
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['head'] = 'include/head';
        $data['header'] = 'include/header';
        $data['menu'] = 'include/menu';
        $data['content'] = 'page/guru/listSKMT';
        $data['footer'] = 'include/footer';
        $data['title'] = 'List SKMT';
        $data['main_menu'] = 'skmt';
        $data['sub_menu'] = 'listSKMT';
        $this->load->view('index', $data);
    }
}
