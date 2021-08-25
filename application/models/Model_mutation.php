<?php
if (!defined('BASEPATH')) exit ('No direct script access allowed');

class Model_mutation extends CI_Model
{
    public $hsl;
    public $rd;
    public $cb;

    public function __construct() {
        parent::__construct();
    }
    
    //Menampilkan data lokasi ke combobox
    public function data_combobox()
    {        
        $this->db->order_by('namaklien','ASC');
        $cb = $this->db->get('klien')->result();
        return $cb;
    }

    public function data_combobox1()
    {        
        $this->db->order_by('bodynumkids','ASC');
        $body = $this->db->get('kiddiejadi')->result();
        return $body;
    }

    //Menampilkan data mutasi di tabel
    public function ambildata()
    {
        $hslmts = array();

        $query = $this->db->get('mutasikiddie');

        if ($query->num_rows() > 0) {
            $hslmts = $query->result();
        }
        return $hslmts;
    }

    //Membuat kode otomatis dihalaman tambah klien
    public function kodeotomatis() 
    {
        $this->db->select('Right(mutasikiddie.idmutasikiddie, 8) as kode',FALSE);
        $this->db->order_by('idmutasikiddie','DESC');
        $this->db->limit(1);

        $query = $this->db->get('mutasikiddie');

        if ($query->num_rows() <> 0) {
            $data = $query->row();
            $kode = intval($data->kode) + 1;
        } else {
            $kode = 1;
        }

        $kodemax = str_pad($kode, 8, "0", STR_PAD_LEFT);
        $kodejadi = "MT".$kodemax;
        return $kodejadi;
    }

    //Menyimpan data klien
    public function simpandata($data,$table) 
    {
        $this->db->insert($table,$data);
    }

    //Menyimpan data taking koin
    public function addtk($data,$table) 
    {
        $this->db->insert($table,$data);
    }

    //Mengedit data klien berdasar id yang dipilih dari tabel
    public function update($where,$data,$table) 
    {
        $this->db->where($where);
        $this->db->update($table,$data);
    }

    //Menghapus data klien berdasar id yang dipilih dari tabel
    public function delete_mts($where,$table)
    {
        $this->db->where($where);
        $this->db->delete($table);
    }
}