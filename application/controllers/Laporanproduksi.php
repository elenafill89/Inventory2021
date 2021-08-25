<?php
if (!defined('BASEPATH')) exit ('No direct script access allowed');

class Laporanproduksi extends CI_Controller
{
    public function __construct() {
        parent::__construct();
        $this->load->model('Model_laporan');
    }

    public function index()
    {
        $data['week'] = $this->Model_laporan->mingguan();
        $data['month'] = $this->Model_laporan->bulanan();
        $data['year'] = $this->Model_laporan->tahunan();
        $data['selisih'] = $this->Model_laporan->gentabl();
        $this->load->view('header');
        $this->load->view('laporanproduksi',$data);
    }
}
