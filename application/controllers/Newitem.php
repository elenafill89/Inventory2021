<?php
if (!defined('BASEPATH')) exit ('No direct script access allowed');

class Newitem extends CI_Controller
{
    public function __construct() 
    {
        parent::__construct();
        $this->load->model('Model_gudang');
    }

    //------------------------------ FUNGSI MELOAD HALAMAN TABEL STOK BARANG GUDANG ---------------------------------------
    public function index()
    {
        $data['hsl'] = $this->Model_gudang->ambildata();
        $data['pkj'] = $this->Model_gudang->datacombobox();
        $data['kodebrang'] = $this->Model_gudang->kodebarang();
        $this->load->view('header');
        $this->load->view('newitem',$data);
    }

    //------------------------------ FUNGSI MENAMPUNG DATA BARANG BARU GUDANG ---------------------------------------
    public function additem()
    {
        $this->form_validation->set_rules('namaItem', 'namaItem', 'required');
        $this->form_validation->set_rules('satuan', 'satuan', 'required');
        $this->form_validation->set_rules('inputHarga', 'inputHarga', 'required');
        $this->form_validation->set_rules('inputJumlah', 'inputJumlah', 'required');
        $this->form_validation->set_rules('inputPanjang', 'inputPanjang', 'required');

        if ($this->form_validation->run()==FALSE) {
            $this->session->set_flashdata('error', "Data Gagal di Tambahkan!");
            redirect('item');
        } else {
            $data = array('namabrg' => $_POST['namaItem'],
                          'satuanbrg' => $_POST['satuan'],
                          'kategoribrg' => $_POST['inputHarga'],
                          'kodebrg' => $_POST['inputPanjang'],
                          'descbrg' => $_POST['inputJumlah']
                           );
            
            $this->Model_gudang->simpan_data($data,'invtbarang');
            redirect('item');
        }
    }

    //------------------------------ FUNGSI MENAMPUNG EDITAM HARGA BARANG GUDANG ---------------------------------------
    public function edititem()
    {
        $this->form_validation->set_rules('namaItem', 'namaItem', 'required');
        $this->form_validation->set_rules('inputJumlah', 'inputJumlah', 'required');

        if ($this->form_validation->run()==FALSE) {
            $this->session->set_flashdata('error', "Data Gagal di Tambahkan!");
            redirect('item');
        } else {
            $data = array('namabrg' => $_POST['namaItem'],
                          'descbrg' => $_POST['inputJumlah'] 
                        );

            $where = array('idbarang'=> $_POST['stokId']);
            $this->Model_gudang->edit_data($where,$data,'invtbarang');
            redirect('item');
        }
    }

    //------------------------------ FUNGSI MENGHAPUS DATA BARANG GUDANG ---------------------------------------
    public function hapus()
    {
        $id = $this->input->post('id');
        $where = array('idbarang' => $id);
        $this->Model_gudang->hapus($where,'invtbarang');
        redirect('item');
    }

    //------------------------------ FUNGSI MENAMPUNG DATA STOK BARU BARANG GUDANG ---------------------------------------
    public function stockitem()
    {
        $this->form_validation->set_rules('jumlahItem', 'jumlahItem', 'required');

        if ($this->form_validation->run()==FALSE) {
            $this->session->set_flashdata('error', "Data Gagal di Tambahkan!");
            redirect('item');
        } else {
            $data = array('catname' => $_POST['jumlahItem'] );

            $this->Model_gudang->tambahstok($data,'invtcategory');
            redirect('item');
        }
    }

    //------------------------------ FUNGSI MENAMPUNG DATA PENGURANGAN STOK BARANG GUDANG ---------------------------------------
    public function loseitem()
    {
        $this->form_validation->set_rules('inputUser', 'inputUser', 'required');
        $this->form_validation->set_rules('inputTgl', 'inputTgl', 'required');
        $jumlah = $this->input->post('jumItem', 'jumItem', 'required');
        $split = explode('-', $this->input->post('stokId'));
        $id = $split[0];
        $harga = $split[1];
        $total = $jumlah * $harga;

        if ($this->form_validation->run()==FALSE) {
            $this->session->set_flashdata('error', "Data Gagal di Tambahkan!");
            redirect('item');
        } else {
            $data1 = $jumlah;
            $where = array('idbarang' => $id);
            $this->Model_gudang->kurangistok($data1,$where);

            $data2 = array('namapemakai' => $_POST['inputUser'],
                           'barangnya' => $id,
                           'jumlahnya' => $jumlah,
                           'totalharga' => $total,
                           'tglambil' => date('Y-m-d',strtotime($_POST['inputTgl'])) );
            
            $this->Model_gudang->simpanpemakai($data2,'pemakaianharian');

            redirect('item');
        }
    }

    //------------------------------ FUNGSI MENAMPUNG DATA BARANG RUSAK GUDANG ---------------------------------------
    public function stockrusak()
    {
        $this->form_validation->set_rules('stokId', 'stokId', 'required');
        $this->form_validation->set_rules('jumlahRusak', 'jumlahRusak', 'required');
        $this->form_validation->set_rules('penyebab', 'penyebab', 'required');
        if ($this->form_validation->run()==FALSE) {
            $this->session->set_flashdata('error', "Data Gagal di Tambahkan!");
            redirect('item');
        } else {
            if ($_POST['penyebab'] == "Pembelian") {
                $data = $_POST['jumlahRusak'];
                $where = array('idbarang' => $_POST['stokId']);
                $this->Model_gudang->stokrusakmasuk($data,$where);
                redirect('item');
            } else {
                $data = $_POST['jumlahRusak'];
                $where = array('idbarang' => $_POST['stokId']);
                $this->Model_gudang->stokrusakkeluar($data,$where);
                redirect('item');
            }
        }
    }

    //------------------------------ FUNGSI MEMBUKA HALAMAN DETIL BARANG ---------------------------------------
    public function detailsitem(){
        $data['pkj'] = $this->Model_gudang->datacombobox();
        $data['hsl'] = $this->Model_gudang->ambildata();
        $this->load->view('header');
        $this->load->view('newitem',$data);
    }
}
