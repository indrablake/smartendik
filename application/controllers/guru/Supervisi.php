<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Supervisi extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model("guru/SupervisiModel");
        $this->load->library('form_validation');
    }

    public function listJadwal()
    {
        $data['head'] = 'include/head';
        $data['header'] = 'include/header';
        $data['menu'] = 'include/menu';
        $data['content'] = 'page/guru/supervisi/listJadwal';
        $data['footer'] = 'include/footer';
        $data['title'] = 'List Jadwal';
        $data['main_menu'] = 'supervisi';
        $data['sub_menu'] = 'jadwalSupervisi';
        $this->load->view('index', $data);
    }

    public function listHasil()
    {
        $data['head'] = 'include/head';
        $data['header'] = 'include/header';
        $data['menu'] = 'include/menu';
        $data['content'] = 'page/guru/supervisi/listHasil';
        $data['footer'] = 'include/footer';
        $data['title'] = 'List Hasil';
        $data['main_menu'] = 'supervisi';
        $data['sub_menu'] = 'hasil';
        $this->load->view('index', $data);
    }

    public function listPAS()
    {
        $data['head'] = 'include/head';
        $data['header'] = 'include/header';
        $data['menu'] = 'include/menu';
        $data['content'] = 'page/guru/supervisi/listPAS';
        $data['footer'] = 'include/footer';
        $data['title'] = 'List PAS';
        $data['main_menu'] = 'supervisi';
        $data['sub_menu'] = 'pas';
        $this->load->view('index', $data);
    }

    public function listPraktek()
    {
        $data['head'] = 'include/head';
        $data['header'] = 'include/header';
        $data['menu'] = 'include/menu';
        $data['content'] = 'page/guru/supervisi/listPraktekIbadah';
        $data['footer'] = 'include/footer';
        $data['title'] = 'List PraktekIbadah';
        $data['main_menu'] = 'supervisi';
        $data['sub_menu'] = 'praktekIbadah';
        $this->load->view('index', $data);
    }

    public function listNilaiUS()
    {
        $data['head'] = 'include/head';
        $data['header'] = 'include/header';
        $data['menu'] = 'include/menu';
        $data['content'] = 'page/guru/supervisi/listNilaiUS';
        $data['footer'] = 'include/footer';
        $data['title'] = 'List NilaiUS';
        $data['main_menu'] = 'supervisi';
        $data['sub_menu'] = 'nilaiUS';
        $data['sub_menu'] = 'nilaiUS';
        $this->load->view('index', $data);
    }
}
