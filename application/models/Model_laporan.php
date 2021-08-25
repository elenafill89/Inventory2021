<?php
if (!defined('BASEPATH')) exit ('No direct script access allowed');

class Model_laporan extends CI_Model
{
    public function __construct() {
        parent::__construct();
    }

    //----------------------------------- FUNGSI HALAMAN LAPORAN PRODUKSI -------------------------------------------------------------------------------
    public function tampilkiddie()
    {
        $kd = array();

        $query = $this->db->get('kiddiejadi');

        if ($query->num_rows() > 0) {
            $kd = $query->row();
        }
        return $kd;
    }

    /*Fungsi yang dipanggil untuk data hargatotalet setiap minggu Halaman Dashboard */
    public function mingguan()
    {
        $week = array();

        $this->db->select('SUM(hargatotal) as minggu');
        $this->db->from('bahanterpakai');
        $this->db->where('YEARWEEK(tglpakai) = YEARWEEK(NOW())');

        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $week = $query->result();
        }

        return $week;
    }

    /*Fungsi yang dipanggil untuk data hargatotalet setiap bulan Halaman Dashboard */
    public function bulanan()
    {
        $month = array();

        $this->db->select('SUM(hargatotal) as bulan');
        $this->db->from('bahanterpakai');
        $this->db->where('MONTH(tglpakai) = MONTH(NOW()) AND YEAR(tglpakai) = YEAR(NOW())');

        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $month = $query->result();
        }

        return $month;
    }

    /*Fungsi yang dipanggil untuk top 5 data hargatotalet setiap minggu Halaman Dashboard */
    public function tahunan()
    {
        $year = array();

        $this->db->select('SUM(hargatotal) as tahun');
        $this->db->from('bahanterpakai');
        $this->db->where('YEAR(tglpakai) = YEAR(NOW())');

        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $year = $query->result();
        }

        return $year;
    }

    /*Fungsi yang dipanggil untuk data selisih hargatotalet tabel di Halaman Dashboard */
    public function gentabl()
    {
        $selisih = array();

        $this->db->select('namajob, SUM(IF(YEARWEEK(tglpakai) = YEARWEEK(SUBDATE(tglpakai, INTERVAL 1 YEAR)), hargatotal, 0)) as kemarin, SUM(IF(YEARWEEK(tglpakai) = YEARWEEK(tglpakai), hargatotal, 0))  as now, (SUM(IF(YEARWEEK(tglpakai) = YEARWEEK(tglpakai), hargatotal, 0))-SUM(IF(YEARWEEK(tglpakai) = YEARWEEK(SUBDATE(tglpakai, INTERVAL 1 YEAR)), hargatotal, 0))) as selisih');
        $this->db->from('bahanterpakai');
        $this->db->join('lapharian','lapharian.idlapharian=bahanterpakai.kodelaporan');
        $this->db->group_by('spesifiknya');
        // $this->db->order_by('tglpakai');

        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $selisih = $query->result();
        }

        return $selisih;
    }
    //----------------------------------- FUNGSI HALAMAN LAPORAN REAPIR REPAINT -------------------------------------------------------------------------------
    //----------------------------------- FUNGSI HALAMAN EKSPLOITASI -------------------------------------------------------------------------------
    /*Fungsi yang dipanggil untuk data hargatotalet setiap minggu Halaman Dashboard */
    public function minggu()
    {
        $minggu = array();

        $this->db->select('SUM(kf) as minggu');
        $this->db->from('takingkoin');
        $this->db->where('YEARWEEK(tglkointaking) = YEARWEEK(NOW())');

        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $minggu = $query->result();
        }

        return $minggu;
    }

    /*Fungsi yang dipanggil untuk data kfet setiap bulan Halaman Dashboard */
    public function bulan()
    {
        $bulan = array();

        $this->db->select('SUM(kf) as bulan');
        $this->db->from('takingkoin');
        $this->db->where('MONTH(tglkointaking) = MONTH(NOW()) AND YEAR(tglkointaking) = YEAR(NOW())');

        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $bulan = $query->result();
        }

        return $bulan;
    }

    /*Fungsi yang dipanggil untuk top 5 data kfet setiap minggu Halaman Dashboard */
    public function tahun()
    {
        $tahun = array();

        $this->db->select('SUM(kf) as tahun');
        $this->db->from('takingkoin');
        $this->db->where('YEAR(tglkointaking) = YEAR(NOW())');

        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $tahun = $query->result();
        }

        return $tahun;
    }
    
    public function high_j()
    {
        $high = array();

        $this->db->select('lokasi');
        $this->db->select('SUM(kf) as omzet');
        $this->db->select('SUM(sharing) as share');
        $this->db->from('takingkoin');
        //$this->db->where('month(tglmutasi) = now()');
        $this->db->group_by('lokasi');
        $this->db->having('omzet > 100000');

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            $high = $query->result();
        }
        return $high;
    }

    public function tokotutup()
    {
        $tutup = array();

        $query = $this->db->get('exklien');

        if ($query->num_rows() > 0) {
            $tutup = $query->result();
        }
        return $tutup;
    }

    public function sudahvalidasi()
    {
        $tkoin = array();
        $this->db->where('tgl_bayar is not NULL');
        $this->db->from('takingkoin');

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            $tkoin = $query->result();
        }
        return $tkoin;
    }

    public function bestkiddie()
    {
        $bestkd = array();

        $this->db->select('nobodyindex');
        $this->db->select('namakiddienya');
        $this->db->select('SUM(kf) as omzet');
        $this->db->select('SUM(sharing) as share');
        $this->db->from('takingkoin');
        $this->db->where('month(tglkointaking) = month(now()) AND year(tglkointaking) = year(now())');
        $this->db->group_by('nobodyindex');
        $this->db->having('omzet > 100000');

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            $bestkd = $query->result();
        }
        return $bestkd;
    }

    public function sales()
    {
        $sell = array();

        $this->db->select('lokasi');
        $this->db->select('SUM(kf) as omzet');
        $this->db->select('SUM(sharing) as share');
        $this->db->from('takingkoin');
        $this->db->where('month(tglkointaking) = month(now()) AND year(tglkointaking) = year(now())');
        $this->db->group_by('lokasi');

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            $sell = $query->result();
        }
        return $sell;
    }

    //----------------------------------- FUNGSI HALAMAN GUDANG -------------------------------------------------------------------------------

}
