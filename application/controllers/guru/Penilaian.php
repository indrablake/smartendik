<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Penilaian extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model("guru/PenilaianModel");
        $this->load->library('form_validation');
    }

    public function listKKM()
    {
        $data['head'] = 'include/head';
        $data['header'] = 'include/header';
        $data['menu'] = 'include/menu';
        $data['content'] = 'page/guru/penilaian/listKKM';
        $data['footer'] = 'include/footer';
        $data['title'] = 'List KKM';
        $data['main_menu'] = 'penilaian';
        $data['sub_menu'] = 'kkm';
        $this->load->view('index', $data);
    }

    public function listPH()
    {
        $data['head'] = 'include/head';
        $data['header'] = 'include/header';
        $data['menu'] = 'include/menu';
        $data['content'] = 'page/guru/penilaian/listPH';
        $data['footer'] = 'include/footer';
        $data['title'] = 'List PH';
        $data['main_menu'] = 'penilaian';
        $data['sub_menu'] = 'ph';
        $this->load->view('index', $data);
    }

    public function listPAS()
    {
        $data['head'] = 'include/head';
        $data['header'] = 'include/header';
        $data['menu'] = 'include/menu';
        $data['content'] = 'page/guru/penilaian/listPAS';
        $data['footer'] = 'include/footer';
        $data['title'] = 'List PAS';
        $data['main_menu'] = 'penilaian';
        $data['sub_menu'] = 'pas';
        $this->load->view('index', $data);
    }

    public function listPraktek()
    {
        $data['head'] = 'include/head';
        $data['header'] = 'include/header';
        $data['menu'] = 'include/menu';
        $data['content'] = 'page/guru/penilaian/listPraktekIbadah';
        $data['footer'] = 'include/footer';
        $data['title'] = 'List PraktekIbadah';
        $data['main_menu'] = 'penilaian';
        $data['sub_menu'] = 'praktekIbadah';
        $this->load->view('index', $data);
    }

    public function listNilaiUS()
    {
        $data['head'] = 'include/head';
        $data['header'] = 'include/header';
        $data['menu'] = 'include/menu';
        $data['content'] = 'page/guru/penilaian/listNilaiUS';
        $data['footer'] = 'include/footer';
        $data['title'] = 'List NilaiUS';
        $data['main_menu'] = 'penilaian';
        $data['sub_menu'] = 'nilaiUS';
        $this->load->view('index', $data);
    }
}
