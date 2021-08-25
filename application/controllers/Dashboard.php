<?php
if (!defined('BASEPATH')) exit ('No direct script access allowed');

class Dashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();  

        if ($this->session->userdata('status') != "login") {
            redirect(base_url('Login'));
        }

        // $this->table = 'takingkoin';
        // $this->load->model('Model_utama');
    }

    //---------------------------------- FUNGSI LOAD HALAMAN DASHBOAD -------------------------------------------
    public function index()
    {
        // $data_calendar = $this->Model_utama->get_event();
        // $calendar = array();
        // foreach($data_calendar->result() as $r) {
        //     $calendar [] = array(
        //         'id' =>$r->idtakingkoin,
        //         'title' =>$r->lokasi,
        //         'description' =>$r->namakiddienya,
        //         'number' =>$r->nobodyindex,
        //         'date' =>$r->idtakingkoin
        //     );
        // }

        // // $datagrafik = $this->Model_utama->chartbln();
        // $data['get'] = json_encode($calendar);
        // $data['kd'] = $this->Model_utama->high_k();
        // $data['hasil'] = $this->Model_utama->result_kiddie();
        // $data['nw'] = $this->Model_utama->current_job();
        // $data['pj'] = $this->Model_utama->pending_job();
        // $data['hg'] = $this->Model_utama->high_job();
        // $data['high'] = $this->Model_utama->high_j();
        // $data['pen'] = $this->Model_utama->pending();
        // $id = $this->input->post('year');                       //untuk menampilkan data pada chart
        // $data['tahun'] = $this->Model_utama->chartthn();
        // $data = array('bulan' => $datagrafik); 
        // $data['minggu'] = $this->Model_utama->chartmgg($id);
        $this->load->view('header');
        $this->load->view('dashboard');
        $this->load->view('footer');
    }

}
