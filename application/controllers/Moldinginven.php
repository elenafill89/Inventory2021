<?php
if (!defined('BASEPATH')) exit ('No direct script access allowed');

class Moldinginven extends CI_Controller
{
    public function __construct() 
    {
        parent::__construct();
        $this->load->model('Model_gudang');
    }

    //-------------------------------- FUNGSI LOAD HALAMAN TABEL MOLDING -----------------------------------------------
    public function index()
    {
        $data['kodeotomatis'] = $this->Model_gudang->kodeotomatis();
        $data['hslmolding'] = $this->Model_gudang->ambilmolding();
        $this->load->view('header');
        $this->load->view('moldinginven',$data);
    }

    //-------------------------------- FUNGSI SIMPAN DATA MOLDING BARU -----------------------------------------------
    public function addmolding()
    {
        $this->form_validation->set_rules('namaMolding', 'namaMolding', 'required');
        $this->form_validation->set_rules('moldingCode', 'moldingCode', 'required');
        $this->form_validation->set_rules('inputQty', 'inputQty', 'required');
        $this->form_validation->set_rules('inputSet', 'inputSet', 'required');
        $this->form_validation->set_rules('inputPanjang', 'inputPanjang', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', "Data Gagal di Tambahkan!");
            redirect('molding');
        } else {
            $data = array('namasupp' => $_POST['namaMolding'],
                          'telpsupp' => $_POST['moldingCode'], 
                          'npwpsupp' => $_POST['inputQty'],
                          'alamatsupp' => $_POST['inputSet'],
                          'kodesupp' => $_POST['inputPanjang']
                        );

            $this->Model_gudang->add_molding($data,'dbsupplier');
            redirect('moldinginven');
        }
    }

    //-------------------------------- FUNGSI UBAH DATA MOLDING -----------------------------------------------
    public function tampil()
    {
        $id = $this->input->post('id');
        $data['md'] = $this->Model_gudang->tampilmolding($id);
        $this->load->view('moldinginven',$data);
    }

    public function editmold()
    {
        $this->form_validation->set_rules('moldingId', 'moldingId', 'required');
        $this->form_validation->set_rules('namaMolding', 'namaMolding', 'required');
        $this->form_validation->set_rules('moldingCode', 'moldingCode', 'required');
        $this->form_validation->set_rules('inputQty', 'inputQty', 'required');
        $this->form_validation->set_rules('inputSet', 'inputSet', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', "Data Gagal di Tambahkan!");
            redirect('moldinginven');
        } else {
            $data = array('namasupp' => $_POST['namaMolding'],
                          'telpsupp' => $_POST['moldingCode'], 
                          'npwpsupp' => $_POST['inputQty'],
                          'alamatsupp' => $_POST['inputSet']
                        );

            $where = array('idsupplier' => $_POST['moldingId']);

            $this->Model_gudang->edit_molding($where, $data,'dbsupplier');
            redirect('moldinginven');
        }
    }

    //-------------------------------- FUNGSI HAPUS DATA MOLDING BARU -----------------------------------------------
    public function busakmolding()
    {
        $id = $this->input->post('id');
        $where = array('idsupplier' => $id);
        $this->Model_gudang->busakmolding($where,'dbsupplier');
        redirect('moldinginven');
    }
}
