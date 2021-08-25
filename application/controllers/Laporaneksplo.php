<?php
if (!defined('BASEPATH')) exit ('No direct script access allowed');

class Laporaneksplo extends CI_Controller
{
    public function __construct() {
        parent::__construct();
        $this->load->model('Model_laporan');
    }

    public function index()
    {
        $data['minggu'] = $this->Model_laporan->minggu();
        $data['bulan'] = $this->Model_laporan->bulan();
        $data['tahun'] = $this->Model_laporan->tahun();
        $data['tkoin'] = $this->Model_laporan->sudahvalidasi();
        $data['tutup'] = $this->Model_laporan->tokotutup();
        $data['bestkd'] = $this->Model_laporan->bestkiddie();
        $data['sell'] = $this->Model_laporan->sales();
        $this->load->view('header');
        $this->load->view('laporaneksplo',$data);
    }
}
