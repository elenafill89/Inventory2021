<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Newstaff extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Model_employee');
    }

    //--------------------------------- FUNGSI LOAD HALAMAN TABEL KARYAWAN ------------------------------------
    public function index()
    {
        $data['cb'] = $this->Model_employee->dtcombo();
        $data['employee'] = $this->Model_employee->allemployee();
        $data['kodeotomatis'] = $this->Model_employee->kodeotomatis();
        $this->load->view('header');
        $this->load->view('newstaff', $data);
    }

    //--------------------------------- FUNGSI SIMPAN DATA KARYAWAN BARU ------------------------------------
    public function adnew()
    {
        $id = $this->input->post('inputId');
        $lengkap = $this->input->post('inputNamal');
        $pendek = $this->input->post('inputNamap');
        $lahir = $this->input->post('inputLahir');
        $tgl = date('Y-m-d', strtotime($lahir));
        $gender = $this->input->post('inputKelamin');
        $divisi = $this->input->post('inputDivisi');
        $status = $this->input->post('inputStatus');
        $mulai = $this->input->post('inputMulai');
        $tglmulai = date('Y-m-d', strtotime($mulai));
        $alamat = $this->input->post('inputAlamat');
        $telpn = $this->input->post('inputTelepon');
        $bank = $this->input->post('inputBank');

        $data = array(
            'idpekerja' => $id,
            'namapkj' => $lengkap,
            'panggilannya' => $pendek,
            'jenisnya' => $divisi,
            'statuskerja' => $status,
            'tgllahirnya' => $tgl,
            'gender' => $gender,
            'alamattinggal' => $alamat,
            'telpon' => $telpn,
            'noreknya' => $bank,
            'mulaikerja' => $tglmulai
        );

        $this->Model_employee->save($data, 'pekerja');
        redirect('staff');
    }

    //--------------------------------- FUNGSI SIMPAN DIVISI BARU ------------------------------------
    public function adiv()
    {
        $this->form_validation->set_rules('inputNamad', 'inputNamad', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', "Data Gagal di Tambahkan!");
            redirect('staff');
        } else {
            $data = array('namastaff' => $_POST['inputNamad']);

            $this->Model_employee->simpandiv($data, 'staff');
            redirect('staff');
        }
    }

    //--------------------------------- FUNGSI SIMPAN DATA KARYAWAN BARU ------------------------------------
    public function editstf()
    {
        $this->form_validation->set_rules('inputId', 'inputId', 'required');
        $this->form_validation->set_rules('inputNamal', 'inputNamal', 'required');
        $this->form_validation->set_rules('inputNamap', 'inputNamap', 'required');
        $this->form_validation->set_rules('inputDivisi', 'inputDivisi', 'required');
        $this->form_validation->set_rules('inputStatus', 'inputStatus', 'required');
        $this->form_validation->set_rules('inputAlamat', 'inputAlamat', 'required');
        $this->form_validation->set_rules('inputTelepon', 'inputTelepon', 'required');
        $this->form_validation->set_rules('inputBank', 'inputBank', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', "Data Gagal di Tambahkan!");
            redirect('staff');
        } else {
            $data = array(
                'namapkj' => $_POST['inputNamal'],
                'panggilannya' => $_POST['inputNamap'],
                'jenisnya' => $_POST['inputDivisi'],
                'statuskerja' => $_POST['inputStatus'],
                'alamattinggal' => $_POST['inputAlamat'],
                'telpon' => $_POST['inputTelepon'],
                'noreknya' => $_POST['inputBank']
            );

            $where = array('idpekerja' => $_POST['inputId']);
            $this->Model_employee->update($where, $data, 'pekerja');
            redirect('staff');
        }
    }

    //--------------------------------- FUNGSI HAPUS DATA KARYAWAN ------------------------------------
    public function delstaff()
    {
        $id = $this->input->post('id');
        $where = array('idpekerja' => $id);
        $this->Model_employee->addto($where);
        $this->Model_employee->delet($where, 'pekerja');
        redirect('staff');
    }

    //--------------------------------- FUNGSI LOAD HALAMAN LAPORAN KARYAWAN ------------------------------------
    public function lapemplo()
    {
        $data['emplo'] = $this->Model_employee->emplo();
        $this->load->view('lapemployee', $data);
    }

    public function detailpage()
    {
        $id = $this->input->post('btnDetail');
        $data['edp'] = $this->Model_employee->detcuti($id);
        $this->load->view('lapemployeedetls', $data);
    }
}
