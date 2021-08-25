<?php
if (!defined('BASEPATH')) exit ('No direct script access allowed');

class Permit extends CI_Controller
{
    public function __construct() 
    {
        parent::__construct();
        $this->load->model('Model_employee');
    }

    //------------------------------ FUNGSI MENAMPILKAN DATA CUTI KARYAWAN -----------------------------------
    public function index()
    {
        $data['cb'] = $this->Model_employee->empl();
        $data['hsl'] = $this->Model_employee->get_permit();
        $this->load->view('header');
        $this->load->view('permit',$data);
    }

    //------------------------------- FUNGSI MENYIMPAN DATA CUTI BARU ----------------------------------------
    public function cuti()
    {
        $this->form_validation->set_rules('namaPkj', 'namaPkj', 'required');
        $this->form_validation->set_rules('inputIjin', 'inputIjin', 'required');
        $this->form_validation->set_rules('inputMulai', 'inputMulai', 'required');
        $this->form_validation->set_rules('inputSelesai', 'inputSelesai', 'required');
        $this->form_validation->set_rules('inputKeterangan', 'inputKeterangan', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', "Data Gagal di Tambahkan!");
            redirect('permit');
        } else {
            $date1 = new DateTime(date('Y-m-d',strtotime($_POST['inputMulai'])));
            $date2 = new DateTime(date('Y-m-d',strtotime($_POST['inputSelesai'])));
            $intv = $date2->diff($date1)->format("%d");
            $data = array('pekerja' => $_POST['namaPkj'],
                          'alasancuti' => $_POST['inputIjin'],
                          'tglmulai' => $_POST['inputMulai'],
                          'tglselesai' => $_POST['inputSelesai'],
                          'ketnya' => $_POST['inputKeterangan'],
                          'hari' => $intv
                         );
            
            $this->Model_employee->addcuti($data,'cuti');
            redirect('permit');
        }
    }
}
