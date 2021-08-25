<?php
if (!defined('BASEPATH')) exit ('No direct script access allowed');

class Laporanstaff extends CI_Controller
{
    public function __construct() {
        parent::__construct();
        $this->load->model('Model_employee');
    }

    public function index()
    {
        $data['aktif'] = $this->Model_employee->jumlahaktif();
        $data['pasif'] = $this->Model_employee->jumlahresign();
        $data['out'] = $this->Model_employee->keluarnya();
        $this->load->view('header');
        $this->load->view('laporanstaff',$data);
    }
}
