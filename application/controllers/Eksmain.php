<?php
if (!defined('BASEPATH')) exit ('No direct script access allowed');

class Eksmain extends CI_Controller
{
    public function __construct() 
    {
        parent::__construct();
        $this->load->model('Model_eksploitation');
    }

    public function index()
    {
        $data['eks'] = $this->Model_eksploitation->get();
        $data['db'] = $this->Model_eksploitation->datacombobox();
        $data['kd'] = $this->Model_eksploitation->datacombobox2();
        $this->load->view('header');
        $this->load->view('maintainorder',$data);
    }

    //----------------------------------- FUNGSI MENAMPILKAN DAN MENYIMPAN DATA KE DATABASE -------------------------------------------------------------------------------

    public function save_data()
    {
        $nama = $this->input->post('inputTeknisi');
        $tanggal = $this->input->post('inputTanggal');
        $tgl = date('Y-m-d', strtotime($tanggal));
        $klien= $this->input->post('inputKlien');
        $kiddie = $this->input->post('inputBodynum');
        $komplain = $this->input->post('inputComplain');


        $data = array('petugas'=> $nama,
                      'klienname'=> $klien,
                      'kiddie'=> $kiddie,
                      'broke'=> $komplain,
                      'date_call'=> $tgl );
        
        $this->Model_eksploitation->simpan_data($data,'expmainord');
        redirect ('maintenance');
    }

    //----------------------------------- FUNGSI MENAMPILKAN DAN MENGUBAH DATA DI DATABASE -------------------------------------------------------------------------------
    public function edit_data()
    {
        $nama = $this->input->post('inputTeknisi');
        $komplain = $this->input->post('inputComplain');
        $tanggal = $this->input->post('inputSelesai');
        $tgl = date('Y-m-d', strtotime($tanggal));
        $cmawal = $this->input->post('inputAwalcm');
        $cmakhir = $this->input->post('inputAkhircm');
        $koin = $this->input->post('inputKoin');
        $des = $this->input->post('inputMaintain');

        $data = array(  'petugas'=> $nama,
                        'broke'=> $komplain,
                        'date_act'=> $tgl,
                        'cm_start'=> $cmawal,
                        'cm_last'=> $cmakhir,
                        'tes'=> $koin,
                        'desc'=> $des
        );

        $id = $this->input->post('idMaintenance');
        $where = array('idexpmainord' => $id);

        $this->Model_eksploitation->update_data($where,$data,'expmainord');
        redirect ('maintenance');
    }

    //----------------------------------- FUNGSI HAPUS DATA MAINTENANCE DARI DATABASE -------------------------------------------------------------------------------
    //Menghapus data maintenance berdasarkan idexpmainord
    public function delete_data()
    {
        $id = $this->input->post('id');
        $where = array('idexpmainord' => $id);
        $this->Model_eksploitation->delete($where,'expmainord');
        redirect ('maintenance');
    }
}
