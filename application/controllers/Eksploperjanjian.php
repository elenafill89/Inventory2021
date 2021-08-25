<?php
if (!defined('BASEPATH')) exit ('No direct script access allowed');

class Eksploperjanjian extends CI_Controller
{
    public function __construct() {
        parent::__construct();
        $this->load->model('Model_eksploitation');
    }

    //----------------------------------- FUNGSI MENAMPILKAN DATA PERJANJIAN DARI DATABASE KE TABEL -------------------------------------------------------------------------------
    public function index()
    {
        $data['dt'] = $this->Model_eksploitation->get_all();
        $data['db'] = $this->Model_eksploitation->datacombobox();
        $this->load->view('header');
        $this->load->view('perjanjian',$data);
    }

    //----------------------------------- FUNGSI MENYIMPAN DATA KE DATABASE -------------------------------------------------------------------------------
    //Menyimpan data klien baru
    public function save_cont()
    {
        $id = $this->input->post('inputCompany');
        $tanggal = $this->input->post('inputMulai');
        $mulai = date('Y-m-d', strtotime($tanggal));
        $tgl = $this->input->post('inputSelesai');
        $selesai = date('Y-m-d', strtotime($tgl));
        $nama = $this->input->post('inputPic');
        $posisi = $this->input->post('inputJabatan');
        $omzet = $this->input->post('inputOmzet');
        $harga = $this->input->post('inputPrice');
        $surat = $this->input->post('inputSpk');

        $data = array('klien' => $id,
                      'start_cont' => $mulai,
                      'end_cont' => $selesai,
                      'owner' => $nama,
                      'position' => $posisi,
                      'omzet' => $omzet,
                      'price' => $harga,
                      'numb_of_cont' => $surat );
        
        $this->Model_eksploitation->save($data,'kontrak');
        redirect ('contract');
    }

    //Mengubah data dari klien berdasar id yang dipilih di tabel
    public function editdata()
    {
        $tanggal = $this->input->post('inputMulai');
        $mulai = date('Y-m-d', strtotime($tanggal));
        $tgl = $this->input->post('inputSelesai');
        $selesai = date('Y-m-d', strtotime($tgl));
        $nama = $this->input->post('inputPic');
        $posisi = $this->input->post('inputJabatan');
        $omzet = $this->input->post('inputOmzet');
        $harga = $this->input->post('inputPrice');
        $surat = $this->input->post('inputSpk');

        $data = array('start_cont' => $mulai,
                    'end_cont' => $selesai,
                    'owner' => $nama,
                    'position' => $posisi,
                    'omzet' => $omzet,
                    'price' => $harga,
                    'numb_of_cont' => $surat
        );
                      
        $id = $this->input->post('idKontrak');
        $where = array('idkontrak' => $id);

        $this->Model_eksploitation->update_data($where,$data,'kontrak');
        redirect ('contract');
    }

    //----------------------------------- FUNGSI HAPUS DATA PERJANJIAN DARI DATABASE -------------------------------------------------------------------------------
    //Menghapus data perjanjian berdasarkan idkontrak
    public function hapus()
    {
        $id = $this->input->post('id');
        $where = array('idkontrak' => $id);
        $this->Model_eksploitation->delete_cont($where,'kontrak');
        redirect ('contract');
    }
}
