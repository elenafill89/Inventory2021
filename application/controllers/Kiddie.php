<?php
if (!defined('BASEPATH')) exit ('No direct script access allowed');

class Kiddie extends CI_Controller
{
    public function __construct() {
        parent::__construct();
        $this->load->model('Model_produk');
    }

    public function index()
    {
        $data['kids'] = $this->Model_produk->get_all();
        $this->load->view('header');
        $this->load->view('kiddie',$data);
    }

    // public function save_kiddie()
    // {
    //     $nama = $this->input->post('inputKiddie');
    //     $body = $this->input->post('inputBody');
    //     $tanggal = $this->input->post('tanggalMulai');
    //     $tgl = date('Y-m-d', $tanggal);

    //     $data = array('namakids' => $nama,
    //                   'bodynumkids' => $body,
    //                   'tgljadi' => $tgl );

    //     $this->Model_produk->simpan($data,'kiddiejadi');
    //     redirect('kiddie');
    // }

    public function hapus_dt()
    {
        $id = $this->input->get('id');
        $where = array('bodynumkids' => $id);
        $this->Model_produk->hapussaja($where,'kiddiejadi');
        redirect ('kiddie');
    }

    public function save_kiddie() {

        $this->form_validation->set_rules('namaKiddie', 'namaKiddie', 'required');
        $this->form_validation->set_rules('bodyNumber', 'bodyNumber', 'required');
        $this->form_validation->set_rules('inputTanggal', 'inputTanggal', 'required');
        $jumlah = "1";
        $kosong = " ";
        if ($this->form_validation->run()==FALSE) {
            $this->session->set_flashdata('error', "Data Gagal di Tambahkan!");
            redirect('kiddie');
        } else {
            $data = array('namakids' => $_POST['namaKiddie'],
                          'bodynumkids' => $_POST['bodyNumber'],
                          'tgljadi' => date('Y-m-d',strtotime($_POST['inputTanggal'])),
                          'jumlahkids' => $jumlah,
                          'kodeproduksi' => $kosong );
            
            $this->Model_produk->simpan_data($data,'kiddiejadi');
            redirect('kiddie');
        }     
    }
}
