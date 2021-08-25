<?php
if (!defined('BASEPATH')) exit ('No direct script access allowed');

class Model_eksploitation extends CI_Model
{
    public function __construct() {
        parent::__construct();
    }

    //----------------------------------- FUNGSI MENAMPILKAN DATA DARI DATABASE -------------------------------------------------------------------------------
    //Menampilkan data perjanjian dari database ke views eksploperjanjian
    public function get_all()
    {
        $dt = array();

        $this->db->select('idkontrak, namaklien, kepalatk, hpnya, kota, alamatkantor, notelp, start_cont, end_cont, owner, position, omzet, price, numb_of_cont');
        $this->db->from('kontrak');
        $this->db->join('klien','klien.idklien=kontrak.klien');
        
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            $dt = $query->result();
        }

        return $dt;
    }

    //Menampilkan data klien dari database ke views combobox
    public function datacombobox()
    {
        $db = array();
        $this->db->order_by('namaklien','ASC');
        
        $query = $this->db->get('klien');

        if ($query->num_rows() > 0) {
            $db = $query->result();
        }

        return $db;
    }

    //Menampilkan data klien dari database ke views combobox
    public function datacombobox2()
    {
        $kd = array();
        $this->db->order_by('bodynumkids','ASC');
        
        $query = $this->db->get('kiddiejadi');

        if ($query->num_rows() > 0) {
            $kd = $query->result();
        }

        return $kd;
    }

    //-------------------------------------------------- FUNGSI MENYIMPAN DATA KE DATABASE --------------------------------------------------
    //Menyimpan data ke tabel bahaneksplo
    public function save($table,$data)
    {
        $this->db->insert($data,$table);
    }

    //----------------------------------- FUNGSI HAPUS DATA PERJANJIAN DARI DATABASE -------------------------------------------------------------------------------
    //Menghapus data perjanjian dari database
    public function delete_cont($where,$table)
    {
        $this->db->where($where);
        $this->db->delete($table);
    }

    //----------------------------------- FUNGSI MENAMPILKAN DATA MAINTENACE DARI DATABASE -------------------------------------------------------------------------------
    //Menampilkan data maintenance dari database ke views eksploperjanjian
    public function get()
    {
        $eks = array();

        $this->db->select('idexpmainord, petugas, namaklien, alamatkantor, namakids, bodynumkids, broke, date_call, date_act, cm_start, cm_last, tes, desc');
        $this->db->from('expmainord');
        $this->db->join('klien','klien.idklien=expmainord.klienname');
        $this->db->join('kiddiejadi','kiddiejadi.idkiddiejadi=expmainord.kiddie');
        
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            $eks = $query->result();
        }

        return $eks;
    }

    //-------------------------------------------- FUNGSI LOAD HALAMAN EDIT DATA MAINTENANCE --------------------------------------------------------
    //Menampilkan data mutasi berdasar id yang dipilih di tabel,
    //untuk fungsi halaman edit
    public function tampil($id) 
    {
        $this->db->where('idexpmainord', $id);
        $mtc = $this->db->get('expmainord')->result();
        return $mtc;
    }

    //------------------------------------------- FUNGSI MENYIMPAN DAN MENGEDIT DATA MAINTENANCE EKSPLOTASI ---------------------------------------------------------
    //Simpan data expmainord
    public function simpan_data($table,$data)
    {
        $this->db->insert($data,$table);
    }

    //Mengedit data expmainord berdasar idnya
    public function update_data($where,$data,$table) 
    {
        $this->db->where($where);
        $this->db->update($table,$data);
    }

    //-------------------------------------------- FUNGSI LOAD HALAMAN DATA TRACKING LAPORAN --------------------------------------------------------
    //Menampilkan data laporan
    public function loadsall()
    {
        $trp = array();

        $this->db->select('idtrackreport,correct,kets,namaklien,namakids,bodynumkids,');
        $this->db->from('trackreport');
        $this->db->join('klien','klien.idklien=trackreport.kliens','left');
        $this->db->join('kiddiejadi','kiddiejadi.bodynumkids=trackreport.kiddies','left');
        
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            $trp = $query->result();
        }

        return $trp;
    }

    //------------------------------------------- FUNGSI MENYIMPAN DAN MENGEDIT DATA TRACKING LAPORAN ---------------------------------------------------------
    //Simpan data tracking laporan
    public function save_trp($table,$data)
    {
        $this->db->insert($data,$table);
    }

    //Mengedit data tracking laporan
    public function update_trp($where,$data,$table) 
    {
        $this->db->where($where);
        $this->db->update($table,$data);
    }

    //Menghapus data tracking laporan
    public function deleterpt($where,$table)
    {
        $this->db->where($where);
        $this->db->delete($table);
    }
}
