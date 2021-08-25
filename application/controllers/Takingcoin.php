<?php
if (!defined('BASEPATH')) exit ('No direct script access allowed');

class Takingcoin extends CI_Controller
{
    public function __construct() 
    {
        parent::__construct();
        $this->load->model('Model_recordcoin');
    }

    //----------------------------------- FUNGSI LOAD HALAMAN AWAL RECORD TAKING COIN ----------------------------------
    public function index()
    {
        $data['tkoin'] = $this->Model_recordcoin->tkoin_get();
        $data['lk'] = $this->Model_recordcoin->get_edt();
        $data['comb'] = $this->Model_recordcoin->combo_get();
        $this->load->view('header');
        $this->load->view('takingcoin',$data);
    }

    //----------------------------------- FUNGSI HAPUS RECORD TAKING COIN ----------------------------------
    public function nextrecord()
    {
        $split = explode('-', $this->input->post('inputBody'));
        $ix = $split[0];
        $lok = $split[1];
        $data['enx'] = $this->Model_recordcoin->get_next($ix);
        $data['lk'] = $this->Model_recordcoin->get_edt($lok);
        $this->load->view('takingnext',$data);
    }

    public function payomzet()
    {
        $tglbaru = $this->input->post('inputBayar');
        $tgl = date('Y-m-d',strtotime($tglbaru));
        
        $data = array('tgl_bayar' => $tgl );
        
        $id = $this->input->post('inputId');
        $where = array('idtakingkoin' => $id );

        $this->Model_recordcoin->updatekoin($where,$data,'takingkoin');
        redirect('record');
    }

    public function nxtrecord()
    {
        $split = explode('-', $this->input->post('inputBody'));
        $nobody = $split[0];
        $namakiddie = $split[1];
        $lokasitoko = $this->input->post('inputklien');
        $tglmutasinya = $this->input->post('inputTglMutasi');
        $tglbaru = $this->input->post('inputTaking');
        $tgl = date('Y-m-d',strtotime($tglbaru.'+ 28 days'));
        $koinakhir = $this->input->post('inputLatest');
        $koinawal = $this->input->post('inputEarly');
        $koinaktual = $this->input->post('inputActual');
        $kointes = $this->input->post('inputTes');
        $awal = $this->input->post('inputStokA');
        $akhir = $this->input->post('inputStokZ');
        $sisanya = $this->input->post('inputSisa');
        $harga = $this->input->post('inputPrice');
        $tkad = $this->input->post('inputAddkoin');
        $tkretur = $this->input->post('inputRetur');
        $share = $this->input->post('inputShare');
        $jumkiddie = $this->input->post('inputJumkid');

        if ($share == "50") {
            $koinmutasi = $koinakhir - $koinawal;
            $kointotal = $koinaktual - $kointes ;
            $koinbeda = $koinmutasi - $kointotal;
            $diffallnya = $akhir - $tkad - $awal;
            $terjual = $koinaktual + ((abs($koinbeda)-$tkretur)/$jumkiddie);
            $sharing = $terjual * $harga / 2;
            $omzet = $terjual * $harga / 2;
        } elseif ($share == "60") {
            $koinmutasi = $koinakhir - $koinawal;
            $kointotal = $koinaktual - $kointes ;
            $koinbeda = $koinmutasi - $kointotal;
            $diffallnya = $akhir - $tkad - $awal;
            $terjual = $koinaktual + ((abs($koinbeda)-$tkretur)/$jumkiddie);
            $sharing = $terjual * $harga * 40 /100;
            $omzet = $terjual * $harga * 60 / 100;
        }

        $data = array('nobdyindex' => $nobody,
					  'namakiddienya' => $namakiddie,
					  'lokasi' => $lokasitoko,
					  'tglmutasi' => $tglmutasinya,
					  'tglkointaking' => $tglbaru,
					  'tglambilbaru' => $tgl,
                      'jumlahkoin' => $koinakhir,
                      'koinawal' => $koinawal,
                      'mtskoin' => $koinmutasi,
                      'stokoin' => $koinaktual, 
                      'teskoin' => $kointes,
                      'totalkoin' => $kointotal,
                      'diffkoin' => $koinbeda,
                      'sharing' => $sharing,
                      'kf' => $omzet,
                      'ketkoin' => $harga,
                      'awal' => $awal,
                      'akhir' => $akhir,
                      'sold' => $terjual,
                      'tkadd' => $tkad,
                      'tkreture' => $tkretur,
                      'sisa' => $sisanya,
                      'diffall' => $diffallnya
        );

        $this->Model_recordcoin->updtkoin($data,'takingkoin');
        redirect('record');
    }

    //----------------------------------- FUNGSI EDIT DATA TAKING KOIN ----------------------------------
    public function edit_page()
    {
        $split = explode('|', $this->input->post('btnEdit'));
        $id = $split[0];
        $lok = $split[1];
        $data['edt'] = $this->Model_recordcoin->get_edit($id);
        $data['lk'] = $this->Model_recordcoin->get_edt($lok);
        $this->load->view('takingnew',$data);
    }

    public function edit_tool()
    {
        $tglbaru = $this->input->post('inputTaking');
        $tgl = date('Y-m-d',strtotime($tglbaru.'+ 28 days'));
        $koinakhir = $this->input->post('inputLatest');
        $koinawal = $this->input->post('inputEarly');
        $koinmutasi = $this->input->post('inputMutasi');
        $koinaktual = $this->input->post('inputActual');
        $kointes = $this->input->post('inputTes');
        $awal = $this->input->post('inputStokA');
        $akhir = $this->input->post('inputStokZ');
        $sisanya = $this->input->post('inputSisa');
        $harga = $this->input->post('inputPrice');
        $tkad = $this->input->post('inputAddkoin');
        $tkretur = $this->input->post('inputRetur');
        $share = $this->input->post('inputShare');
        $jumkiddie = $this->input->post('inputJumkid');

        if ($share == "50") {
            $koinmutasi = $koinakhir - $koinawal;
            $kointotal = $koinaktual - $kointes ;
            $koinbeda = $koinmutasi - $kointotal;
            $diffallnya = $akhir - $tkad - $awal;
            $terjual = $koinaktual + ((abs($koinbeda)-$tkretur)/$jumkiddie);
            $sharing = $terjual * $harga / 2;
            $omzet = $terjual * $harga / 2;
        } elseif ($share == "60") {
            $koinmutasi = $koinakhir - $koinawal;
            $kointotal = $koinaktual - $kointes ;
            $koinbeda = $koinmutasi - $kointotal;
            $diffallnya = $akhir - $tkad - $awal;
            $terjual = $koinaktual + ((abs($koinbeda)-$tkretur)/$jumkiddie);
            $sharing = $terjual * $harga * 40 /100;
            $omzet = $terjual * $harga * 60 / 100;
        }

        $data = array('tglkointaking' => $tglbaru,
					  'tglambilbaru' => $tgl,
                      'jumlahkoin' => $koinakhir,
                      'koinawal' => $koinawal,
                      'mtskoin' => $koinmutasi,
                      'stokoin' => $koinaktual, 
                      'teskoin' => $kointes,
                      'totalkoin' => $kointotal,
                      'diffkoin' => $koinbeda,
                      'sharing' => $sharing,
                      'kf' => $omzet,
                      'ketkoin' => $harga,
                      'awal' => $awal,
                      'akhir' => $akhir,
                      'sold' => $terjual,
                      'tkadd' => $tkad,
                      'tkreture' => $tkretur,
                      'sisa' => $sisanya,
                      'diffall' => $diffallnya
        );
        
        $id = $this->input->post('inputId');
        $where = array('idtakingkoin' => $id );

        $this->Model_recordcoin->updatekoin($where,$data,'takingkoin');
        redirect('record');
    }

    // public function prin()
    // {
    //     $this->form_validation->set_rules('inputKlien', 'inputKlien', 'required');

    //     if ($this->form_validation->run()==FALSE) {
    //         $this->session->set_flashdata('error', "Data Gagal di Tambahkan!");
    //         redirect('record');
    //     } else {
    //         $data = array('namaklien' => $_POST['inputKlien']);
    //         $data2 = array('lokasi' => $_POST['inputKlien']);
            
    //         $pdf = new FPDF('L','mm','A4');

    //         // membuat halaman baru
    //         $pdf->AddPage();
    //         $pdf->SetAutoPageBreak(true,60);
    //         $pdf->AliasNbPages();
            
    //         // setting jenis font yang akan digunakan
    //         $pdf->SetFont('Arial','B',12);

    //         // mencetak string 
    //         $pdf->Cell(0,7,'OUTSIDE OPERATION',0,1);

    //         $judul = $this->Model_recordcoin->takestore($data);
    //         foreach ($judul->result() as $rw){
    //             // MENCETAK TOKO 
    //             $pdf->Cell(0,7,$rw->namaklien,0,1); 
    //             $pdf->Cell(0,7,$rw->kota,0,1); 
    //         }


    //         $laporan = $this->Model_recordcoin->takeprint($data2);
    //         // Memberikan space kebawah agar tidak terlalu rapat
    //         $pdf->Cell(10,7,'',0,1);
    //         $pdf->SetFont('Arial','B',11);
    //         // $pdf->Cell(0,6,'NO',1,0,'C');
    //         $pdf->Cell(25,0,'DATE ROLLING',1,0,'C');
    //         $pdf->Cell(25,6,'NO MACHINE',1,0,'C');
    //         $pdf->Cell(55,6,'MACHINE',1,0,'C');
    //         $pdf->Cell(20,6,'BEGIN CM',1,0,'C');
    //         $pdf->Cell(20,6,'ENDING CM',1,0,'C');
    //         $pdf->Cell(15,6,'MUTASI CM',1,0,'C');
    //         $pdf->Cell(15,6,'ACTUAL COIN',1,0,'C');
    //         $pdf->Cell(15,6,'TEST',1,0,'C');
    //         $pdf->Cell(15,6,'TOTAL',1,0,'C');
    //         $pdf->Cell(15,6,'DIFF',1,0,'C');
    //         $pdf->Cell(45,6,'REMARKS',1,1,'C');
    //         $pdf->SetFont('Arial','',11);
        
    //         foreach ($laporan->result() as $row){
    //             // $pdf->Cell(10,6,$x,1,0,'C');
    //             $pdf->Cell(25,6,$row->tglmutasi,1,'C'); 
    //             $pdf->Cell(25,6,$row->nobodyindex,1,'C');
    //             $pdf->Cell(55,6,$row->namakiddienya,1,0);
    //             $pdf->Cell(25,6,$row->koinawal,1,'C'); 
    //             $pdf->Cell(25,6,$row->jumlahkoin,1,'C'); 
    //             $pdf->Cell(15,6,$row->mtskoin,1,'C'); 
    //             $pdf->Cell(15,6,$row->stokoin,1,'C'); 
    //             $pdf->Cell(15,6,$row->teskoin,1,0,'C'); 
    //             $pdf->Cell(15,6,$row->totalkoin,1,0,'C'); 
    //             $pdf->Cell(15,6,$row->diffkoin,1,0,'C'); 
    //             $pdf->Cell(45,6,'',1,1,'C'); 
    //         }    
            
    //         $pdf->SetAutoPageBreak(false);
    //         $pdf->AliasNbPages();
    //         $pdf->Output();
    //     }
    // }

    //----------------------------------- FUNGSI LOAD HALAMAN PETA ----------------------------------
    public function mapnya()
    {
        $this->load->view('header');
        $this->load->view('eksplomap');
    }
}
