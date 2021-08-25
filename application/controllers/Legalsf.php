<?php
if (!defined('BASEPATH')) exit ('No direct script access allowed');

class Legalsf extends CI_Controller
{
    public function __construct() {
        parent::__construct();
        $this->load->model('Model_asset');
    }
    //----------------------------------- FUNGSI HALAMAN DATA PC -------------------------------------------------------------------------------

    public function index()
    {
        $data['legal'] = $this->Model_asset->tampillegal();
        $this->load->view('header');
        $this->load->view('legal',$data);
    }

    public function simpansf()
    {
        $nama = $this->input->post('inputSoft');
        $versi = $this->input->post('inputVersi');
        $jenis = $this->input->post('inputJenis');
        $seri = $this->input->post('inputSeri');
        $key = $this->input->post('inputKey');
        $jum = $this->input->post('inputJum');
        $tgl = $this->input->post('inputTgl');
        $tanggal = date('Y-m-d', strtotime($tgl));
        $ket = $this->input->post('inputKet');
        $harga = $this->input->post('inputHarga');


        $data = array('namasoft'=> $nama,
                      'versisoft'=> $versi,
                      'lisensoft'=> $jenis,
                      'serisoft'=> $seri,
                      'keysoft'=> $key,
                      'jumsoft'=> $jum,
                      'tglbuy'=> $tanggal,
                      'ketsoft'=> $ket,
                      'hargasoft'=> $harga );
        
        $this->Model_asset->simpanall($data,'legalsoft');
        redirect ('leglsf');
    }

    public function editsf()
    {
        $nama = $this->input->post('inputSoft');
        $versi = $this->input->post('inputVersi');
        $jenis = $this->input->post('inputJenis');
        $seri = $this->input->post('inputSeri');
        $key = $this->input->post('inputKey');
        $jum = $this->input->post('inputJum');
        $tgl = $this->input->post('inputTgl');
        $tanggal = date('Y-m-d', strtotime($tgl));
        $ket = $this->input->post('inputKet');
        $harga = $this->input->post('inputHarga');


        $data = array('namasoft'=> $nama,
                      'versisoft'=> $versi,
                      'lisensoft'=> $jenis,
                      'serisoft'=> $seri,
                      'keysoft'=> $key,
                      'jumsoft'=> $jum,
                      'tglbuy'=> $tanggal,
                      'ketsoft'=> $ket,
                      'hargasoft'=> $harga );

        $id = $this->input->post('id');
        $where = array('idlegalsoft' => $id);

        $this->Model_asset->updateall($where,$data,'legalsoft');
        redirect ('leglsf');
    }

    public function hapussf()
    {
        $id = $this->input->post('id');
        $where = array('idlegalsoft' => $id);
        $this->Model_asset->deleteall($where,'legalsoft');
        redirect('leglsf');
    }
}
