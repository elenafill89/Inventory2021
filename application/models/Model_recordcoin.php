<?php
if (!defined('BASEPATH')) exit ('No direct script access allowed');

class Model_recordcoin extends CI_Model
{
    public $tkoin;
    
    public function __construct()
    {
        parent::__construct();   
    }

    //----------------------------------- FUNGSI LOAD HALAMAN TABEL TAKING KOIN ----------------------------------
    public function tkoin_get()
    {
        $tkoin = array();
        $this->db->where('tgl_bayar is NULL');
        $this->db->from('takingkoin');

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            $tkoin = $query->result();
        }
        return $tkoin;
    }

    //----------------------------------- FUNGSI HAPUS DATA TAKING KOIN DARI DATABASE ----------------------------------
    public function get_edit($id)
    {
        $this->db->join('klien','klien.namaklien=takingkoin.lokasi','left');
        $this->db->join('kontrak','kontrak.klien=klien.idklien','left');
        $this->db->where('idtakingkoin',$id);

        $edt = $this->db->get('takingkoin')->result();
        return $edt;
    }

    public function get_edt()
    {
        $this->db->select('COUNT(nobodyindex) as jumkiddie');
        $this->db->from('takingkoin');
        // $this->db->where('lokasi',$lok);
        $this->db->order_by('YEARWEEK(tglkointaking) = NOW()');

        $lk = $this->db->get()->result();
        return $lk;
    }

    public function get_next($ix)
    {
        $this->db->join('klien','klien.namaklien=takingkoin.lokasi','left');
        $this->db->join('kontrak','kontrak.klien=klien.idklien','left');
        $this->db->where('nobodyindex',$ix);
        $this->db->order_by('tglkointaking','desc');
        $this->db->limit(1);

        $enx = $this->db->get('takingkoin')->result();
        return $enx;
    }

    //----------------------------------- FUNGSI HAPUS DATA TAKING KOIN DARI DATABASE ----------------------------------
    public function updatekoin($where,$data,$table)
    {
        $this->db->where($where);
        $this->db->update($table,$data);
    }

    public function updtkoin($data,$table)
    {
        $this->db->insert($table,$data);
    }

    //----------------------------------- FUNGSI HAPUS DATA TAKING KOIN DARI DATABASE ----------------------------------
    public function busak($where,$table)
    {
        $this->db->where($where);
        $this->db->delete($table);
    }

    //----------------------------------- FUNGSI DATA COMBOBOX PRINT ----------------------------------
    public function combo_get()
    {
        $comb = array();

        $this->db->select('DISTINCT(lokasi) as lok,idklien');
        $this->db->from('takingkoin');
        $this->db->join('klien','klien.namaklien=takingkoin.lokasi');
        $this->db->order_by('lokasi','ASC');
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            $comb = $query->result();
        }
        return $comb;
    }

    //----------------------------------- FUNGSI PRINT LAPORAN KOIN ----------------------------------
    public function takeprint($id)
    {
        $this->db->select('tglmutasi, nobodyindex, namakiddienya, koinawal, jumlahkoin, mtskoin, stokoin, teskoin, totalkoin, diffkoin, SUM(stokoin) as total, sold, kf, klien, ketkoin');
        $this->db->from('takingkoin');
        $this->db->where($id);
        $this->db->order_by('tglmutasi', 'ASC');

        return $this->db->get();
    }

    public function takestore($id)
    {
        $this->db->select('namaklien, kota');
        $this->db->from('klien');
        $this->db->where($id);

        return $this->db->get();
    }
}
