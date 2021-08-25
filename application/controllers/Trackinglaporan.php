<?php
if (!defined('BASEPATH')) exit ('No direct script access allowed');

class Trackinglaporan extends CI_Controller
{
    public function __construct() {
        parent::__construct();
        $this->load->model('Model_eksploitation');
    }

    //----------------------------------- FUNGSI MENAMPILKAN DATA PERJANJIAN DARI DATABASE KE TABEL -------------------------------------------------------------------------------
    public function index()
    {
        $data['db'] = $this->Model_eksploitation->datacombobox();
        $data['kd'] = $this->Model_eksploitation->datacombobox2();
        $data['trp'] = $this->Model_eksploitation->loadsall();
        $this->load->view('header');
        $this->load->view('trackinglaporan',$data);
    }

    //----------------------------------- FUNGSI MENYIMPAN DATA KE DATABASE -------------------------------------------------------------------------------
    //Menyimpan data klien baru
    public function simpanrpt()
    {
        $this->form_validation->set_rules('inputklien', 'inputklien', 'required');
        $this->form_validation->set_rules('inputKiddie', 'inputKiddie', 'required');
        $this->form_validation->set_rules('inputcorr', 'inputcorr', 'required');
        $this->form_validation->set_rules('inputKets', 'inputKets', 'required');

        if ($this->form_validation->run()==FALSE) {
            $this->session->set_flashdata('error', "Data Gagal di Tambahkan!");
            redirect('expreport');
        } else {
            $data = array('kliens' => $_POST['inputklien'],
                          'kiddies' => $_POST['inputKiddie'],
                          'correct' => $_POST['inputcorr'],
                          'kets' => $_POST['inputKets'] );
            
            $this->Model_eksploitation->save_trp($data,'trackreport');
            redirect('expreport');
        }
    }

    //----------------------------------- FUNGSI EDIT dan HAPUS DATA EVALUASI DARI DATABASE -------------------------------------------------------------------------------
    public function editrp()
    {
        $this->form_validation->set_rules('inputId', 'inputId', 'required');
        $this->form_validation->set_rules('inputcorr', 'inputcorr', 'required');
        $this->form_validation->set_rules('inputKets', 'inputKets', 'required');

        if ($this->form_validation->run()==FALSE) {
            $this->session->set_flashdata('error', "Data Gagal di Tambahkan!");
            redirect('expreport');
        } else {
            $data = array('correct' => $_POST['inputcorr'],
                          'kets' => $_POST['inputKets']
                        );
            $where = array('idtrackreport'=> $_POST['inputId']);
            $this->Model_eksploitation->update_rpt($where,$data,'trackreport');
            redirect('expreport');
        }
    }

    public function deltrp()
    {
        $this->form_validation->set_rules('id', 'id', 'required');

        $where = array('idtrackreport'=> $_POST['id']);
        $this->Model_eksploitation->deleterpt($where,'trackreport');
        redirect('expreport');
    }
}
