<?php
if (!defined('BASEPATH')) exit ('No direct script access allowed');

class Datapc extends CI_Controller
{
    public function __construct() {
        parent::__construct();
        $this->load->model('Model_asset');
    }
    //----------------------------------- FUNGSI HALAMAN DATA PC -------------------------------------------------------------------------------

    public function index()
    {
        $data['datapc'] = $this->Model_asset->tampildata();
        $data['dep'] = $this->Model_asset->dept();
        $this->load->view('header');
        $this->load->view('datapage',$data);
    }

    public function simpanpc()
    {
        $nama = $this->input->post('inputNama');
        $dep = $this->input->post('inputDept');
        $namapc = $this->input->post('inputPc');
        $mac = $this->input->post('inputMac');
        $os = $this->input->post('inputOs');
        $idpd = $this->input->post('inputPd');
        $key = $this->input->post('inputKey');


        $data = array('userpc'=> $nama,
                      'lokuser'=> $dep,
                      'pcname'=> $namapc,
                      'ospc'=> $os,
                      'macpc'=> $mac,
                      'idpdpc'=> $idpd,
                      'keypdpc'=> $key );
        
        $this->Model_asset->simpanall($data,'datapc');
        redirect ('datpc');
    }

    public function editpc()
    {
        $nama = $this->input->post('inputNama');
        $dep = $this->input->post('inputDept');
        $namapc = $this->input->post('inputPc');
        $mac = $this->input->post('inputMac');
        $os = $this->input->post('inputOs');
        $idpd = $this->input->post('inputPd');
        $key = $this->input->post('inputKey');


        $data = array('userpc'=> $nama,
                      'lokuser'=> $dep,
                      'pcname'=> $namapc,
                      'ospc'=> $os,
                      'macpc'=> $mac,
                      'idpdpc'=> $idpd,
                      'keypdpc'=> $key );

        $id = $this->input->post('id');
        $where = array('iddatapc' => $id);

        $this->Model_asset->updateall($where,$data,'datapc');
        redirect ('datpc');
    }

    public function hapuspc()
    {
        $id = $this->input->post('id');
        $where = array('iddatapc' => $id);
        $this->Model_asset->deleteall($where,'datapc');
        redirect('datpc');
    }
}
