<?php
if (!defined('BASEPATH')) exit ('No direct script access allowed');

class Model_asset extends CI_Model
{
    public function __construct() {
        parent::__construct();
    }

    public function dept()
    {
        $dep = array();

        $query = $this->db->get('departemen');
        if ($query->num_rows() > 0) {
            $dep = $query->result();
        }

        return $dep;
    } 

    public function supp()
    {
        $spp = array();

        $query = $this->db->get('supplier');
        if ($query->num_rows() > 0) {
            $spp = $query->result();
        }

        return $spp;
    }

    //----------------------------------- FUNGSI HALAMAN PEMBELIAN ASSET IT -------------------------------------------------------------------------------
    public function tampilbeli()
    {
        $beli = array();

        $this->db->select('namasupp,idpembelian,tglbeli,jenisbrg,spekbrg,supplier,deptujuan,pemakai,jumbeli,hargabeli,keterangan,merkhard');
        $this->db->from('pembelian');
        $this->db->join('supplier','supplier.idsupplier=pembelian.supplier');
        
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $beli = $query->result();
        }

        return $beli;
    }    

    public function simpanall($table,$data)
    {
        $this->db->insert($data,$table);
    } 

    public function updateall($where,$data,$table)
    {
        $this->db->where($where);
        $this->db->update($table,$data);
    }
    
    public function deleteall($where,$table)
    {
        $this->db->where($where);
        $this->db->delete($table);        
    }
    //----------------------------------- FUNGSI HALAMAN DATA PC -------------------------------------------------------------------------------
    public function tampildata()
    {
        $datapc = array();

        $query = $this->db->get('datapc');
        if ($query->num_rows() > 0) {
            $datapc = $query->result();
        }

        return $datapc;
    }   

    //----------------------------------- FUNGSI HALAMAN LEGAL SOFTWARE -------------------------------------------------------------------------------
    public function tampillegal()
    {
        $legal = array();

        $query = $this->db->get('legalsoft');
        if ($query->num_rows() > 0) {
            $legal = $query->result();
        }

        return $legal;
    }   

    //----------------------------------- FUNGSI HALAMAN MIKROTIK -------------------------------------------------------------------------------
    public function tampilmkt()
    {
        $mkt = array();

        $query = $this->db->get('mikrotik');
        if ($query->num_rows() > 0) {
            $mkt = $query->result();
        }

        return $mkt;
    }   
}
