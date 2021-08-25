<?php
if (!defined('BASEPATH')) exit ('No direct script access allowed');

class Model_klien extends CI_Model
{
    public $hasil;
    public $ed;

    public function __construct() {
        parent::__construct();
    }

    //Menampilkan semua data dari database ke tampilan tabel
    public function ambildata() 
    {
        $hasil = array();

        $query = $this->db->get('dbcustomer');

        if ($query->num_rows() > 0) {
            $hasil = $query->result();
        }
        return $hasil;
    }

    //Mengambil data klien berdasar id yng dipilih di tabel
    public function tampil($id) 
    {
        $this->db->where('iddbcustomer', $id);
        $ed = $this->db->get('dbcustomer')->result();
        return $ed;
    }

    //Membuat kode otomatis dihalaman tambah klien
    public function kodeotomatis() 
    {
        $this->db->select('Right(dbcustomer.custcode, 6) as kode',FALSE);
        $this->db->order_by('custcode','DESC');
        $this->db->limit(1);

        $query = $this->db->get('dbcustomer');

        if ($query->num_rows() <> 0) {
            $data = $query->row();
            $kode = intval($data->kode) + 1;
        } else {
            $kode = 1;
        }

        $kodemax = str_pad($kode, 6, "0", STR_PAD_LEFT);
        $kodejadi = "C-".$kodemax;
        return $kodejadi;
    }

    //Menyimpan data klien
    public function simpandata($data,$table) 
    {
        $this->db->insert($table,$data);
    }

    //Mengedit data klien berdasar id yang dipilih dari tabel
    public function update($where,$data,$table) 
    {
        $this->db->where($where);
        $this->db->update($table,$data);
    }

    //Menghapus data klien dari database
    public function delete_klien($where,$table)
    {
        $this->db->where($where);
        $this->db->delete($table);
    }
}