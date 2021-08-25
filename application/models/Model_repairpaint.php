<?php
if (!defined('BASEPATH')) exit ('No direct script access allowed');

class Model_repairpaint extends CI_Model
{
    public $hasilnya;
    public $hs;

    public function __construct() {
        parent::__construct();
    }

    //--------------------------------------- FUNGSI LOAD ADD NEW REAPIR REPAINT -------------------------------------------------------------
    //Menampilkan data eksploitasi di tabel
    public function ambil()
    {
       $hasilnya = array();
       $this->db->select('ideksploitasi, namakids, bodynumkids, keteranganeksplo, tgleksplomasuk,tglselesai');
       $this->db->from('eksploitasi');
       $this->db->join('klien', 'klien.idklien=eksploitasi.klieneksplo','left');
       $this->db->join('kiddiejadi', 'kiddiejadi.idkiddiejadi=eksploitasi.kiddieksplo','left');

       $query = $this->db->get();

       if ($query->num_rows() > 0) {
           $hasilnya = $query->result();
       }
       return $hasilnya;
    }

    //Menampilkan data bahan di combobox
    public function dataBody()
    {        
        $body = $this->db->get('kiddiejadi')->result();
        return $body;
    }

    public function dataPkj()
    {        
        $pkj = $this->db->get('pekerja')->result();
        return $pkj;
    }

    //Menampilkan kode saat menambahkan repair repaint baru
    public function kodeotomatis()
    {
        $this->db->select('Right(eksploitasi.ideksploitasi, 7) as kode',FALSE);
        $this->db->order_by('ideksploitasi','DESC');
        $this->db->limit(1);

        $query = $this->db->get('eksploitasi');

        if ($query->num_rows() <> 0) {
            $data = $query->row();
            $kode = intval($data->kode) + 1;
        } else {
            $kode = 1;
        }

        $kodemax = str_pad($kode, 7, "0", STR_PAD_LEFT);
        $kodejadi = "RRP".$kodemax;
        return $kodejadi;
    }

    //-------------------------------------------- FUNGSI LOAD HALAMAN COMPLETE REPAIR REPAINT --------------------------------------------------------
    //Menampilkan data mutasi berdasar id yang dipilih di tabel,
    //untuk fungsi halaman edit
    public function tampil($id) 
    {
        $this->db->where('ideksploitasi', $id);
        $rd = $this->db->get('eksploitasi')->result();
        return $rd;
    }

    //Menampilkan data toko tujuan di combobox
    public function data_combobox()
    {        
        $this->db->order_by('namaklien','asc');
        $cb = $this->db->get('klien')->result();
        return $cb;
    }

    //Menampilkan data bahan di combobox
    public function data_combobox2()
    {        
        $b = $this->db->get('barang')->result();
        return $b;
    }

    //Menampilkan data bahan eksploitasi dari tabel bahaneksplo
    public function get_material($id)
    {
       $hsl = array();
       $this->db->select('idbahaneksplo,namabarang,satuan,hargapcs,jumlahbahan,hargatotalbahan');
       $this->db->from('bahaneksplo');
       $this->db->join('barang', 'barang.idbarang=bahaneksplo.namabahan');
       $this->db->where('kodeeksplo', $id);

       $query = $this->db->get();

       if ($query->num_rows() > 0) {
           $hsl = $query->result();
       }
       return $hsl;
    }
    
    //------------------------------------------- FUNGSI MENYIMPAN DAN MENGEDIT DATA REPAIR REPAINT ---------------------------------------------------------
    //Simpan data eksploitasi dari halaman addrepairpaint
    public function simpandata($table,$data)
    {
        $this->db->insert($data,$table);
    }

    //Mengedit data klien berdasar id yang dipilih dari tabel
    public function update($where,$data,$table) 
    {
        $this->db->where($where);
        $this->db->update($table,$data);
    }

    //-------------------------------------------------- FUNGSI MENYIMPAN DAN MENGUPDATE DATA BAHAN REPAIR REPAINT --------------------------------------------------
    //Menyimpan data ke tabel bahaneksplo
    public function save_material($table,$data)
    {
        $this->db->insert($data,$table);
    }

    //Menambahkan data ke modal edit
    public function modal_edit($idx) 
    {
        $this->db->where('idbahaneksplo', $idx);
        $ed = $this->db->get('bahaneksplo')->result();
        return $ed;
    }

    //Mengubah data jumlah dan harga total bahaneksplo
    public function update_material($where,$data,$table) 
    {
        $this->db->where($where);
        $this->db->update($table,$data);
    }
}
