<?php
if (!defined('BASEPATH')) exit ('No direct script access allowed');

class Klien extends CI_Controller
{
    public function __construct() 
    {
        parent::__construct();
        $this->load->model('Model_klien');
    }

    //Menampilkan data dari database klien pada tabel
    public function index()
    {
        $data['kodeotomatis'] = $this->Model_klien->kodeotomatis();
        $data['hasil'] = $this->Model_klien->ambildata();
        $this->load->view('header');
        $this->load->view('klien', $data);
    }

    //Menyimpan data klien baru
    public function simpan()
    {
        $id = $this->input->post('idClient');
        $nama = $this->input->post('companyName');
        $telepon = $this->input->post('inputTelepon');
        $alamat = $this->input->post('alamat');
        $npwp = $this->input->post('inputKota');

        $data = array('custcode' => $id,
                      'custname' => $nama,
                      'custtelp' => $telepon,
                      'custaddress' => $alamat,
                      'custnpwp' => $npwp );
        
        $this->Model_klien->simpandata($data,'dbcustomer');
        redirect ('client');
    }

    //Mengubah data dari klien berdasar id yang dipilih di tabel
    public function editdata()
    {
        $nama = $this->input->post('companyName');
        $telepon = $this->input->post('inputTelepon');
        $alamat = $this->input->post('alamat');
        $npwp = $this->input->post('inputKota');

        $data = array('custname' => $nama,
                      'custtelp' => $telepon,
                      'custaddress' => $alamat,
                      'custnpwp' => $npwp
        );
                      
        $id = $this->input->post('idClient');
        $where = array('iddbcustomer' => $id);

        $this->Model_klien->update($where,$data,'dbcustomer');
        redirect ('client');
    }

    //Menghapus data klien berdasarkan idklien
    public function hapus()
    {
        $id = $this->input->post('id');
        $where = array('iddbcustomer' => $id);
        $this->Model_klien->delete_klien($where,'dbcustomer');
        redirect ('client');
    }
}
