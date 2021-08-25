<?php
if (!defined('BASEPATH')) exit ('No direct script access allowed');

class Mutation extends CI_Controller
{
    public function __construct() 
    {
        parent::__construct();
        $this->load->model('Model_mutation');
    }

    public function index()
    {
        $data['hslmts'] = $this->Model_mutation->ambildata();
        $data['kodeotomatis'] = $this->Model_mutation->kodeotomatis();
        $data['cb'] = $this->Model_mutation->data_combobox();
        $data['body'] = $this->Model_mutation->data_combobox1();
        $this->load->view('header');
        $this->load->view('mutation', $data);
    }

    
    //Fungsi untuk menyimpan data yang baru
    public function simpan()
    {
      $this->form_validation->set_rules('idmutasi', 'idmutasi', 'required');
      $this->form_validation->set_rules('inputTgl', 'inputTgl', 'required');
      $this->form_validation->set_rules('loklama', 'loklama', 'required');
      $this->form_validation->set_rules('lokbaru', 'lokbaru', 'required');
      $this->form_validation->set_rules('tipe', 'tipe', 'required');
      $this->form_validation->set_rules('kondisi', 'kondisi', 'required');
      $this->form_validation->set_rules('inputketerangan', 'inputketerangan', 'required');
      $this->form_validation->set_rules('inputbodynum', 'inputbodynum', 'required');
        
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', "Data Gagal di Tambahkan!");
            redirect('mutation');
        } else {
            $jumkoin = "0";
            $data = array('idmutasikiddie'=> $_POST['idmutasi'],
                      'tglmutasi'=> $_POST['inputTgl'],
                      'lokasilama'=> $_POST['loklama'],
                      'lokasibaru'=> $_POST['lokbaru'],
                      'jenismutasi'=> $_POST['tipe'],
                      'kondisi'=> $_POST['kondisi'],
                      'keterangan'=> $_POST['inputketerangan'],
                      'namabrgmutasinya'=> $kiddies,
                      'nobodynya'=> $nobody
                        );
        
            $this->Model_mutation->simpandata($data,'mutasikiddie');

            redirect('mutation');
        }

        $id = $this->input->post('idmutasi');
        $tanggal = $this->input->post('inputTgl');
        $tgl = date('Y-m-d', strtotime($tanggal));
        $tgltk = date('Y-m-d', strtotime($tanggal.'+ 28 days'));
        $loklama = $this->input->post('loklama');
        $lokbaru = $this->input->post('lokbaru');
        $tipemutasi = $this->input->post('tipe');
        $kondisibrg = $this->input->post('kondisi');
        $ket = $this->input->post('inputketerangan');
        $split = explode('|', $this->input->post('inputbodynum'));
        $nobody = $split[0];
        $kiddies = $split[1];


        $data = array('idmutasikiddie'=> $id,
                      'tglmutasi'=> $tgl,
                      'lokasilama'=> $loklama,
                      'lokasibaru'=> $lokbaru,
                      'jenismutasi'=> $tipemutasi,
                      'kondisi'=> $kondisibrg,
                      'keterangan'=> $ket,
                      'namabrgmutasinya'=> $kiddies,
                      'nobodynya'=> $nobody );
        
        $this->Model_mutation->simpandata($data,'mutasikiddie');

        if ($tipemutasi == "Penukaran") {
            // if (x) {
            //     $tglroling = date_add($tanggal,DateInterval(180)); //CEK LAGI VALIDITAS DATA DARI TABEL KONTRAK
            //     $tglr = date('Y-m-d', $tglroling);
            // } else {
            //     $tglroling = date_add($tanggal,DateInterval(90));
            //     $tglr = date('Y-m-d', $tglroling);
            // }

            $data1 = array('nobodyindex' => $nobody,
                           'namakiddienya' => $kiddies,
                           'lokasi' => $lokbaru,
                           'jumlahkoin' => $jumkoin,
                           'tglmutasi' => $tgl, 
                           'tglkointaking' => $tgltk, 
                           'tglambilbaru' => $tgltk, 
                           'koinawal' => $jumkoin, 
                           'mtskoin' => $jumkoin, 
                           'stokoin' => $jumkoin, 
                           'teskoin' => $jumkoin, 
                           'totalkoin' => $jumkoin, 
                           'diffkoin' => $jumkoin, 
                           'sharing' => $jumkoin, 
                           'kf' => $jumkoin, 
                           'ketkoin' => $jumkoin, 
                           'awal' => $jumkoin, 
                           'akhir' => $jumkoin, 
                           'sold' => $jumkoin, 
                           'tkadd' => $jumkoin, 
                           'tkreture' => $jumkoin, 
                           'sisa' => $jumkoin, 
                           'diffall' => $jumkoin );
                           //,'tglkointaking' => $tglr

            $this->Model_mutation->addtk($data1,'takingkoin');
        } elseif ($tipemutasi == "Pengiriman") {
            $data1 = array('nobodyindex' => $nobody,
                           'namakiddienya' => $kiddies,
                           'lokasi' => $lokbaru,
                           'jumlahkoin' => $jumkoin,
                           'tglmutasi' => $tgl,
                           'tglkointaking' => $tgltk, 
                           'tglambilbaru' => $tgltk, 
                           'koinawal' => $jumkoin, 
                           'mtskoin' => $jumkoin, 
                           'stokoin' => $jumkoin, 
                           'teskoin' => $jumkoin, 
                           'totalkoin' => $jumkoin, 
                           'diffkoin' => $jumkoin, 
                           'sharing' => $jumkoin, 
                           'kf' => $jumkoin, 
                           'ketkoin' => $jumkoin, 
                           'awal' => $jumkoin, 
                           'akhir' => $jumkoin, 
                           'sold' => $jumkoin, 
                           'tkadd' => $jumkoin, 
                           'tkreture' => $jumkoin, 
                           'sisa' => $jumkoin, 
                           'diffall' => $jumkoin );
                           //,'tglkointaking' => $tglr

            $this->Model_mutation->addtk($data1,'takingkoin');
        } else {
            redirect('mutation');
        }
        redirect ('mutation');
    }

    //Mengubah data dari mutasi berdasar id yang dipilih di tabel
    public function edit()
    {
        $tanggal = $this->input->post('inputTgl');
        $tgl = date('Y-m-d', strtotime($tanggal));
        $loklama = $this->input->post('loklama');
        $lokbaru = $this->input->post('lokbaru');
        $tipemutasi = $this->input->post('tipe');
        $kondisibrg = $this->input->post('kondisi');
        $ket = $this->input->post('inputketerangan');

        $data = array(  'tglmutasi'=> $tgl,
                        'lokasilama'=> $loklama,
                        'lokasibaru'=> $lokbaru,
                        'jenismutasi'=> $tipemutasi,
                        'kondisi'=> $kondisibrg,
                        'keterangan'=> $ket
        );

        $id = $this->input->post('idmutasi');
        $where = array('idmutasikiddie' => $id);

        $this->Model_mutation->update($where,$data,'mutasikiddie');
        redirect ('mutation');
    }

    //Menghapus data dari mutasi berdasar id yang dipilih di tabel
    public function hapus()
    {
        $id = $this->input->post('idmutasi');
        $where = array('idmutasikiddie' => $id);
        $this->Model_mutation->delete_mts($where,'mutasikiddie');
        redirect ('mutation');
    }
}