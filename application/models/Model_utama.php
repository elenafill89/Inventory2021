<?php
if (!defined('BASEPATH')) exit ('No direct script access allowed');

class Model_utama extends CI_Model
{
    public $hasil;
    public $nw;
    public $hg;

    public function __construct() {
        parent::__construct();
    }

    //---------------------------------- FUNGSI TAMPILKAN JUMLAH KIDDIE JADI -------------------------------------------
    public function result_kiddie()
    {
        $this->db->select('COUNT(idkiddiejadi) as jadi');
        $this->db->from('kiddiejadi');

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            $hasil = $query->row();
        }
        return $hasil;
    }

    //---------------------------------- FUNGSI TAMPILKAN JUMLAH DATA CURRENT JOB -------------------------------------------
    public function current_job()
    {
        $this->db->select('COUNT(idjoborderprogres) as now');
        $this->db->from('joborderprogres');
        $this->db->where('status="Belum Mulai"');

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            $nw = $query->row();
        }
        return $nw;
    }

    //---------------------------------- FUNGSI TAMPILKAN JUMLAH DATA HIGH JOB -------------------------------------------
    public function high_job()
    {
        $hg = array();

        $this->db->select('COUNT(idjoborderprogres) as now');
        $this->db->from('joborderprogres');
        $this->db->where('status="Sedang Dikerjakan"');

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            $hg = $query->row();
        }
        return $hg;
    }

    //---------------------------------- FUNGSI TAMPILKAN JUMLAH DATA PENDING -------------------------------------------
    public function pending_job()
    {
        $pj = array();

        $this->db->select('COUNT(idjoborderprogres) as now');
        $this->db->from('joborderprogres');
        $this->db->where('status="Di Tunda"');

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            $pj = $query->row();
        }
        return $pj;
    }

    //---------------------------------- FUNGSI TAMPILKAN DATA HIGH PRIORITY -------------------------------------------
    public function high_j()
    {
        $high = array();

        $this->db->select('DISTINCT(jobspesifiknya) as jb, jobnya,namajob,namaklien,jumlah,tanggal,aktivitasnya');
        $this->db->from('lapharian');
        $this->db->join('joborder','lapharian.jobnya=joborder.idjoborder','left');
        $this->db->join('klien','klien.idklien=joborder.klien','left');
        $this->db->join('joborderprogres','joborderprogres.kodejobglobal=lapharian.jobnya');
        $this->db->where('status="Sedang Dikerjakan"');
        $this->db->order_by('tanggal','DESC');
        $this->db->limit('1');

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            $high = $query->result();
        }
        return $high;
    }

    //---------------------------------- FUNGSI TAMPILKAN DATA PENDING -------------------------------------------
    public function pending()
    {
        $pen = array();

        $this->db->select('kodejobglobal','namajob','namaklien','jumlah','tanggal','aktivitasnya');
        $this->db->from('joborderprogres');
        $this->db->join('joborder','joborder.idjoborder=joborderprogres.kodejobglobal');
        $this->db->join('klien','klien.idklien=joborder.klien','left');
        $this->db->join('lapharian','lapharian.jobnya=joborderprogres.kodejobglobal');
        $this->db->where('status="Di Tunda"');

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            $pen = $query->result();
        }
        return $pen;
    }

    //---------------------------------- FUNGSI TAMPILKAN KALENDER -------------------------------------------
    public function get_event()
    {
        return $this->db->get('takingkoin');
    }
    
    //---------------------------------- FUNGSI TAMPILKAN OMZET KIDDIE TERBAIK -------------------------------------------
    public function high_k()
    {
        $kd = array();

        $this->db->select('nobodyindex');
        $this->db->select('namakiddienya');
        $this->db->select('SUM(kf) as omzet');
        $this->db->select('SUM(sharing) as share');
        $this->db->from('takingkoin');
        $this->db->where('YEARWEEK(tglmutasi) = YEARWEEK(now())');
        $this->db->group_by('nobodyindex');

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            $kd = $query->result();
        }
        return $kd;
    }

    //---------------------------------- FUNGSI TAMPILKAN CHART KIDDIE JADI -------------------------------------------
    public function chartthn() //Menampilkan data per tahun
    {
        $tahun = array();

        $this->db->select('SUM(jumlahkids) as kid','year(tgljadi)');
        $this->db->from('kiddiejadi');
        $this->db->group_by('year(tgljadi)');

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            $tahun = $query->result();
        }
        return $tahun;
    }

    public function chartbln() //Menampilkan data per bulan berdasar tahun x
    {
        $bulan = array();

        $this->db->select('SUM(jumlahkids) as kid','MONTHNAME(tgljadi) as bll');
        $this->db->from('kiddiejadi');
        $this->db->where('YEAR(tgljadi) = YEAR(NOW())');
        $this->db->group_by('MONTHNAME(tgljadi)');

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            $bulan = $query->result();
        }
        return $bulan;
    }

    public function chartmgg($where) //Menampilkan data per minggu berdasar tahun x
    {
        $minggu = array();

        $this->db->select('SUM(jumlahkids) as kid');
        $this->db->from('kiddiejadi');
        $this->db->where('year(tgljadi)',$where);
        $this->db->group_by('yearweek(tgljadi)');

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            $minggu = $query->result();
        }
        return $minggu;
    }
}