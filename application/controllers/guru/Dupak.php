<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dupak extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model("guru/DupakModel");
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['head'] = 'include/head';
        $data['header'] = 'include/header';
        $data['menu'] = 'include/menu';
        $data['content'] = 'page/guru/listDupak';
        $data['footer'] = 'include/footer';
        $data['title'] = 'List Dupak';
        $data['main_menu'] = 'guru';
        $data['sub_menu'] = 'listDupak';
        $this->load->view('index', $data);
    }
}
