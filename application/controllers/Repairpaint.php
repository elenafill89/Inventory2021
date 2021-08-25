<?php
if (!defined('BASEPATH')) exit ('No direct script access allowed');

class Repairpaint extends CI_Controller
{
    public function __construct() 
    {
        parent::__construct();
        $this->load->model('Model_repairpaint');
        $this->load->helper('form');
        $this->load->helper('url');
    }

    //---------------------------------------------------------------------------------------------------
    //Load halaman Tabel Awal Repair repaint
    public function index()
    {
        $data['hasilnya'] = $this->Model_repairpaint->ambil();
        $data['cb'] = $this->Model_repairpaint->data_combobox();
        $data['kodeotomatis'] = $this->Model_repairpaint->kodeotomatis();
        $data['body'] = $this->Model_repairpaint->dataBody();
        $data['pkj'] = $this->Model_repairpaint->dataPkj();
        $data['b'] = $this->Model_repairpaint->data_combobox2();
        $this->load->view('header');
        $this->load->view('repairpaint',$data);
    }

    //Menyimpan data repair repaint baru
    public function save_data()
    {
        $id = $this->input->post('inputId');
        $tanggal = $this->input->post('inputTanggal');
        $tgl = date('Y-m-d', strtotime($tanggal));
        $nobody = $this->input->post('inputBody');
        $idklien = $this->input->post('inputKlien');
        $servis = $this->input->post('inputService');
        $ket = $this->input->post('keterangan');


        $data = array('ideksploitasi'=> $id,
                      'tgleksplomasuk'=> $tgl,
                      'klieneksplo'=> $idklien,
                      'kiddieksplo'=> $nobody,
                      'jenisservis'=> $servis,
                      'keteranganeksplo'=> $ket );
        
        $this->Model_repairpaint->simpandata($data,'eksploitasi');
        redirect ('repair');
    }

    //----------------------------------------------------------------------------------------------------
    //Mengubah data eksploitasi yang sudah selesai
    public function edit_data()
    {
        $tanggal = $this->input->post('tanggalSelesai');
        $tgl = date('Y-m-d', strtotime($tanggal));
        $jam = $this->input->post('inputJam');
        $pekerja = $this->input->post('inputPekerja');

        $data = array(  'tglselesai'=> $tgl,
                        'jamtotal'=> $jam,
                        'namakrywn'=> $pekerja
        );

        $id = $this->input->post('idEksploitasi');
        $where = array('ideksploitasi' => $id);

        $this->Model_repairpaint->update($where,$data,'eksploitasi');
        redirect ('repair');
    }

    //----------------------------------------------------------------------------------------------------
    //Menampung data bahan yang akan disimpan ke database
    public function add_material()
    {
        $ideksplo = $this->input->post('inputId');
        $split = explode('|', $this->input->post('inputBahan'));
        $bahan = $split[0];
        $harga = $split[1];
        $satuan = $split[2];
        $jumlah = $this->input->post('inputJumbahan');
        $total = $jumlah * $harga;


        $data = array('namabahan'=> $bahan,
                      'satuanbahan'=> $satuan,
                      'hargabahan'=> $harga,
                      'jumlahbahan'=> $jumlah,
                      'hargatotalbahan'=> $total,
                      'kodeeksplo'=> $ideksplo );
        
        $this->Model_repairpaint->save_material($data,'bahaneksplo');
        redirect('repair');
    }

    //Menampilkan data di modal
    public function get_data()
    {
        $idx = $this->input->post('id');
        $data['ed'] = $this->Model_repairpaint->modal_edit($idx);
        $this->load->view('addrepairpaint/#editModal',$data);
    }

    //Menampung data perubahan jumlah bahan
    public function edit_material()
    {
        $harga = $this->input->post('inputharga');
        $jumlah = $this->input->post('inputJumnew');
        $total = $jumlah * $harga;


        $data = array('jumlahbahan'=> $jumlah,
                      'hargatotalbahan'=> $total );
        
        $ideksplo = $this->input->post('inputId');
        $where = array('idbahaneksplo' => $ideksplo);

        $this->Model_repairpaint->update_material($where,$data,'bahaneksplo');
        redirect ('edit_r');
    }
}
