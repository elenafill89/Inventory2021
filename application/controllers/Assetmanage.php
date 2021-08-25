<?php
if (!defined('BASEPATH')) exit ('No direct script access allowed');

class Assetmanage extends CI_Controller
{
    public function __construct() {
        parent::__construct();
        $this->load->model('Model_asset');
    }
    //----------------------------------- FUNGSI HALAMAN PEMBELIAN ASSET IT -------------------------------------------------------------------------------

    public function index()
    {
        $data['beli'] = $this->Model_asset->tampilbeli();
        $data['dep'] = $this->Model_asset->dept();
        $data['spp'] = $this->Model_asset->supp();
        $this->load->view('header');
        $this->load->view('buypage',$data);
    }

    public function simpanbuy()
    {
        $tanggal = $this->input->post('inputTanggal');
        $tgl = date('Y-m-d', strtotime($tanggal));
        $merk = $this->input->post('inputMerk');
        $jenis = $this->input->post('inputJenis');
        $spesifikasi = $this->input->post('inputSpek');
        $supp = $this->input->post('inputSupp');
        $pengguna = $this->input->post('inputUser');
        $dept = $this->input->post('inputDept');
        $jumnya = $this->input->post('inputJumlah');
        $harga = $this->input->post('inputHarga');
        $ket = $this->input->post('inputKet');


        $data = array('tglbeli'=> $tgl,
                      'merkhard'=> $merk,
                      'jenisbrg'=> $jenis,
                      'spekbrg'=> $spesifikasi,
                      'supplier'=> $supp,
                      'deptujuan'=> $dept,
                      'pemakai'=> $pengguna,
                      'jumbeli'=> $jumnya,
                      'hargabeli'=> $harga,
                      'keterangan'=> $ket );
        
        $this->Model_asset->simpanall($data,'pembelian');
        redirect ('buy');
    }

    public function simpansupp()
    {
        $nama = $this->input->post('namasupp');
        $alamat = $this->input->post('alamatsp');
        $telpon = $this->input->post('telsup');
        $website = $this->input->post('websup');


        $data = array('namasupp'=> $nama,
                      'alamatsupp'=> $alamat,
                      'notelpsupp'=> $telpon,
                      'websupp'=> $website );
        
        $this->Model_asset->simpanall($data,'supplier');
        redirect ('buy');
    }

    public function edit_buy()
    {
        $tanggal = $this->input->post('inputTanggal');
        $tgl = date('Y-m-d', strtotime($tanggal));
        $merk = $this->input->post('inputMerk');
        $jenis = $this->input->post('inputJenis');
        $spesifikasi = $this->input->post('inputSpek');
        $pengguna = $this->input->post('inputUser');
        $dept = $this->input->post('inputDept');
        $jumnya = $this->input->post('inputJumlah');
        $harga = $this->input->post('inputHarga');
        $ket = $this->input->post('inputKet');


        $data = array('tglbeli'=> $tgl,
                      'merkhard'=> $merk,
                      'jenisbrg'=> $jenis,
                      'spekbrg'=> $spesifikasi,
                      'deptujuan'=> $dept,
                      'pemakai'=> $pengguna,
                      'jumbeli'=> $jumnya,
                      'hargabeli'=> $harga,
                      'keterangan'=> $ket );

        $id = $this->input->post('id');
        $where = array('idpembelian' => $id);

        $this->Model_asset->updateall($where,$data,'pembelian');
        redirect ('buy');
    }

    public function hapus_buy()
    {
        $id = $this->input->post('id');
        $where = array('idpembelian' => $id);
        $this->Model_asset->deleteall($where,'pembelian');
        redirect('buy');
    }
}
