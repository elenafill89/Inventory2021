<?php
if (!defined('BASEPATH')) exit ('No direct script access allowed');
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, OPTIONS");

class Addjob extends CI_Controller
{
    public function __construct() {
        parent::__construct();
        $this->load->model('Model_joborder');
    }

    //----------------------------------------- FUNGSI MENAMPILKAN HALAMAN ADDJOB -----------------------------------------
    public function index()
    {
        $data['cb'] = $this->Model_joborder->data_combobox();
        $data['ab'] = $this->Model_joborder->data_combobox2();
        $data['kodeotomatis'] = $this->Model_joborder->kodeotomatis();
        $this->load->view('addjob',$data);
    }

    //----------------------------------------- FUNGSI MENYIMPAN DATA DARI HALAMAN ADDJOB KE DATABASE -----------------------------------------
    public function save_data()
    {
        $id = $this->input->post('idJobOrder');
        $klien = $this->input->post('inputIdclient');
        $namajob = $this->input->post('inputJobnama');
        $jumlah = $this->input->post('inputJumlah');
        $deskripsi = $this->input->post('ket');
        $kategori = $this->input->post('kategori');
        $manager = $this->input->post('inputManager');
        $prioritas = "Belum Mulai";

        for ($i=1; $i <= $jumlah; $i++) { 
            $kodejadi = $id.".".$i;
            $nw = "Low";

            $progress = array('kodejobglobal' => $id,
                              'kodejobspesifik' => $kodejadi,
                              'status ' => $prioritas,
                              'prioritasjob' => $nw 
            );
                              
            $this->Model_joborder->add_job($progress,'joborderprogres');
        }

        $data = array('idjoborder' => $id,
                      'klien' => $klien,
                      'namajob ' => $namajob,
                      'keterangan' => $deskripsi,
                      'jumlah' => $jumlah,
                      'prioritas' => $prioritas,
                      'kategorinya' => $kategori,
                      'manager' => $manager );

        $this->Model_joborder->add_job($data,'joborder');
        redirect('job');
    }

    //----------------------------------------- FUNGSI MENYIMPAN DATA DARI HALAMAN ADDJOB KE DATABASE -----------------------------------------
    public function progres_page()
    {
        $id = $this->input->post('id');
        $data['bb'] = $this->Model_joborder->combox($id);
        $data['bs'] = $this->Model_joborder->data_combobox2();
        $data['rd'] = $this->Model_joborder->tampil($id);
        $data['b'] = $this->Model_joborder->data_divisi();
        $this->load->view('progresjob',$data);
    }

    public function progres_page2()
    {
        $id = $this->input->post('id');
        $data['bb'] = $this->Model_joborder->combox2($id);
        $data['bs'] = $this->Model_joborder->data_combobox2();
        $data['rd'] = $this->Model_joborder->tampil2($id);
        $data['b'] = $this->Model_joborder->data_divisi();
        $this->load->view('progresjob',$data);
    }

    //----------------------------------------- FUNGSI  -----------------------------------------
    public function get_pekerja()
    {
        $id = $this->input->post('divisi');
        $data = $this->Model_joborder->data_combobox2($id);

        $response = "<option value=''>--Pilih--</option>";
        foreach($data as $dt){
            $response.="<option value='".$dt->idpekerja."'>".$dt->namapkj."</option>";
        }
        json_encode($response);
    }

    //----------------------------------------- FUNGSI MENYIMPAN PROGRES KERJA SETIAP HARINYA -----------------------------------------
    public function progres_sv()
    {
        $idglobal = $this->input->post('idJobOrder');
        $idspesifik = $this->input->post('idJobsub');
        $tanggal = $this->input->post('inputTanggal');
        $tgl = date('Y-m-d',strtotime($tanggal));
        $divisi = $this->input->post('divisi');
        $pekerja = $this->input->post('pekerja');
        $aktivitas = $this->input->post('ket');
        $jamulai = $this->input->post('inputJammulai');
        $jamm = date('H:i:s',strtotime($jamulai));
        $jamselesai = $this->input->post('inputJamselesai');
        $jams = date('H:i:s',strtotime($jamselesai));
        $total = $this->input->post('inputSelisih');
        $status = $this->input->post('inputStatus');

        $data = array('tanggal' => $tgl,
                      'namapekerjanya' => $pekerja,
                      'bagian' => $divisi,
                      'aktivitasnya' => $aktivitas,
                      'jobnya' => $idglobal,
                      'jobspesifiknya' => $idspesifik,
                      'mulaijam' => $jamm,
                      'selesaijam' => $jams,
                      'totaljamnya' => $total );

        $this->Model_joborder->save_pg($data,'lapharian');

        if ($status = "Sedang Dikerjakan") {
            $pj = "High";
        }  else {
            $pj = "Low";
        }

        $data1 = array('status' => $status,
                       'prioritasjob' => $pj );

        $where = array('kodejobspesifik' => $idspesifik);
        $this->Model_joborder->updatejp($where,$data1,'joborderprogres');

        $data2 = array('prioritas' => $status );

        $wheres = array('idjoborder' => $idglobal);
        $this->Model_joborder->updatejo($wheres,$data2,'joborder');
        redirect('progres_material');
    }

    //----------------------------------------- FUNGSI MENYIMPAN DATA MATERIAL SETIAP HARINYA -----------------------------------------
    public function material_sv()
    {
        $idspesifik = $this->input->post('id');
        $tanggal = $this->input->post('inputTanggal');
        $tgl = date('Y-m-d',$tanggal);
        $split = explode('|', $this->input->post('inputBarang'));
        $namabarang = $split[0];
        $harga = $split[1];
        $jumbrg = $this->input->post('inputJum');
        $hargatotal = $jumbrg * $harga;

        $data = array('tglpakai' => $tgl,
                      'namabrg' => $namabarang,
                      'jumlahbrg' => $jumbrg,
                      'hargatotal' => $hargatotal,
                      'spesifiknya' => $idspesifik );

        $this->Model_joborder->save_mt($data,'bahanpakai');
        redirect('progress');
    }

    //_*_*_*_*_*_*_*_*_*_*_*_*_*_*_*_*_*_*_*_*_* HALAMAN PENGGUNAAN MATERIAL PRODUKSI (PROGRES) _*_*_*_*_*_*_*_*_*_*_*_*_*_*_*_*_*_*_*_*_*_*_*_*_*_
    public function tampilmatused()
    {
        $id = $_POST['id'];
        $data['rd'] = $this->Model_joborder->tampil2($id);
        $data['fb'] = $this->Model_joborder->data_cbb();
        $data['res'] = $this->Model_joborder->barangpakai($id);
        $this->load->view('matused', $data);
    }

    public function simpanmatt()
    {
        $idspesifik = $this->input->post('idClient');
        $jum = $this->input->post('inputJumlah');
        $split = explode('|', $this->input->post('inputBarang'));
        $barang = $split[0];
        $harga = $split[1];
        $total = $jum * $harga;
        // $tgl = mktime(date("d"),date("m"),date("Y"));

        $data = array('tglpakai' => date('%Y-%m-%d'),
                      'namabrg' => $barang,
                      'jumlahbrg' => $jum,
                      'hargatotal' => $total,
                      'spesifiknya' => $idspesifik );

        $this->Model_joborder->save_mt($data,'bahanterpakai');
        redirect('progres_material');
    }

    //_*_*_*_*_*_*_*_*_*_*_*_*_*_*_*_*_*_*_*_*_* FUNGSI JOB ORDER DONE DI HALAMAN HIGH PRIORITY _*_*_*_*_*_*_*_*_*_*_*_*_*_*_*_*_*_*_*_*_*_*_*_*_*_
    public function done()
    {
        $idjob = $this->input->post('id');
        $tgl = mktime(date("m"),date("d"),date("Y"));
        $status = "Selesai";
        $pj = "Low";

        $data = array('prioritas' => $status );

        $where = array('idjoborder' => $idjob);
        $this->Model_joborder->done_jo($where,$data,'joborder');

        $data1 = array('status' => $status,
                       'prioritasjob' => $pj,
                       'tgjadi' => date('Y-m-d', strtotime($tgl)) );

        $wheres = array('kodejobspesifik' => $idjob);
        $this->Model_joborder->done_jp($wheres,$data1,'joborderprogres');
        redirect('progres_material');
    }
}