<?php
if (!defined('BASEPATH')) exit ('No direct script access allowed');

class Mikrotik extends CI_Controller
{
    public function __construct() {
        parent::__construct();
        $this->load->model('Model_asset');
    }
    //----------------------------------- FUNGSI HALAMAN DATA PC -------------------------------------------------------------------------------

    public function index()
    {
        $data['mkt'] = $this->Model_asset->tampilmkt();
        $this->load->view('header');
        $this->load->view('mikrotik',$data);
    }

    public function simpanmkt()
    {
        $mac = $this->input->post('inputMac');
        $ip = $this->input->post('inputIp');
        $nama = $this->input->post('inputNama');
        $versi = $this->input->post('inputVersi');
        $seri = $this->input->post('inputSeri');


        $data = array('macadd'=> $mac,
                      'ipadd'=> $ip,
                      'namaidentitas'=> $nama,
                      'versisoft'=> $versi,
                      'versihard'=> $seri );
        
        $this->Model_asset->simpanall($data,'mikrotik');
        redirect ('mkt');
    }

    public function editmkt()
    {
        $mac = $this->input->post('inputMac');
        $ip = $this->input->post('inputIp');
        $nama = $this->input->post('inputNama');
        $versi = $this->input->post('inputVersi');
        $seri = $this->input->post('inputSeri');


        $data = array('macadd'=> $mac,
                      'ipadd'=> $ip,
                      'namaidentitas'=> $nama,
                      'versisoft'=> $versi,
                      'versihard'=> $seri );

        $id = $this->input->post('id');
        $where = array('idmikrotik' => $id);

        $this->Model_asset->updateall($where,$data,'mikrotik');
        redirect ('mkt');
    }

    public function hapusmkt()
    {
        $id = $this->input->post('id');
        $where = array('idmikrotik' => $id);
        $this->Model_asset->deleteall($where,'mikrotik');
        redirect('mkt');
    }
}
