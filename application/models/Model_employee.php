<?php
if (!defined('BASEPATH')) exit ('No direct script access allowed');

class Model_employee extends CI_Model
{
    public $employee;

    public function __construct() {
        parent::__construct();
    }

    //--------------------------------- FUNGSI TAMPILKAN DATA KARYAWAN ------------------------------------
    public function allemployee()
    {
        $employee = array();

        $this->db->select('idpekerja, namapkj, panggilannya, namastaff, jenisnya, statuskerja, tgllahirnya, alamattinggal, telpon, noreknya, mulaikerja');
        $this->db->from('pekerja');
        $this->db->join('staff', 'staff.idstaff=pekerja.jenisnya');

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            $employee = $query->result();
        }
        return $employee;
    }

    public function kodeotomatis() 
    {
        $this->db->select('Right(pekerja.idpekerja, 3) as kode',FALSE);
        $this->db->order_by('idpekerja','DESC');
        $this->db->limit(1);

        $query = $this->db->get('pekerja');

        if ($query->num_rows() <> 0) {
            $data = $query->row();
            $kode = intval($data->kode) + 1;
        } else {
            $kode = 1;
        }

        $kodemax = str_pad($kode, 3, "0", STR_PAD_LEFT);
        $kodejadi = "RD".$kodemax;
        return $kodejadi;
    }

    //--------------------------------- FUNGSI TAMPILKAN DATA DIVISI DI COMBO BOX ------------------------------------
    public function dtcombo()
    {
        $this->db->order_by('namastaff','ASC');
        $cb = $this->db->get('staff')->result();
        return $cb;
    }

    //--------------------------------- FUNGSI MENYIMPAN DATA STAFF BARU ------------------------------------
    public function save($data,$table)
    {
        $this->db->insert($table,$data);
    }

    //--------------------------------- FUNGSI MENYIMPAN DATA DIVISI BARU ------------------------------------
    public function simpandiv($data,$table)
    {
        $this->db->insert($table,$data);
    }

    //--------------------------------- FUNGSI MENGUBAH DATA KARYAWAN ------------------------------------
    public function tampil($id) 
    {
        $this->db->where('idpekerja', $id);
        $this->db->select('idpekerja, namapkj, panggilannya, namastaff, statuskerja, alamattinggal, telpon, noreknya, jenisnya');
        $this->db->from('pekerja');
        $this->db->join('staff', 'staff.idstaff=pekerja.jenisnya');
        $ed = $this->db->get()->result();
        return $ed;
    }

    public function update($where,$data,$table)
    {
        $this->db->where($where);
        $this->db->update($table,$data);
    }

    //--------------------------------- FUNGSI MENGHAPUS DATA KARYAWAN ------------------------------------
    public function addto($where)
    {
        $keluar = 'INSERT INTO resign(namakeluar,panggilankeluar,jeniskeluar,statuskeluar,tgllahirkeluar,kelaminkeluar,alamateluar,telpkeluar,norekeluar,tglmsk) SELECT namapkj,panggilannya,jenisnya,statuskerja,tgllahirnya,gender,alamattinggal,telpon,noreknya,mulaikerja FROM pekerja WHERE idpekerja = ?';   
        $update = 'UPDATE resign SET tglkeluar = NOW() ORDER BY idresign DESC LIMIT 1';   
        $this->db->trans_start(); 
        $this->db->query($keluar,array($where)); 
        $this->db->query($update); 
        $this->db->trans_complete(); 

        if($this->db->trans_status() === FALSE) {
            echo 'rollback!';
        } else {
            echo 'commited!';
        }
    }

    public function delet($where,$table)
    {
        $this->db->where($where);
        $this->db->delete($table);
    }

    //--------------------------------- FUNGSI MENGATUR HALAMAN PERMIT ------------------------------------
    public function get_permit()
    {
        $hsl = array();

        $this->db->select('idcuti,namapkj,alasancuti,tglmulai,tglselesai,ketnya,hari');
        $this->db->join('pekerja', 'pekerja.idpekerja=cuti.pekerja');
        $this->db->from('cuti');

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            $hsl = $query->result();
        }
        return $hsl;
    }

    public function empl()
    {
        $this->db->order_by('namapkj','ASC');
        $cb = $this->db->get('pekerja')->result();
        return $cb;
    }

    public function addcuti($data,$table)
    {
        $this->db->insert($table,$data);
    }

    //---------------------------------- FUNGSI TAMPILKAN LAPORAN EMPLOYEE -------------------------------------------
    public function emplo()
    {
        $emplo = array();

        $this->db->select('idpekerja','namapkj');
        $this->db->select('panggilannya');
        $this->db->select('SUM(hari) as cuti');
        $this->db->select('SUM(totalover) as overtime');
        $this->db->select('SUM(sisareplace) as replacetime');
        $this->db->from('pekerja');
        $this->db->join('cuti', 'pekerja.idpekerja=cuti.pekerja','left');
        $this->db->join('overtime', 'pekerja.idpekerja=overtime.pekerjaover','left');
        $this->db->join('replacetime', 'pekerja.idpekerja=replacetime.pekerjareplace','left');
        $this->db->where('year(tglmulai) = now() AND year(tglover) = now() AND year(tglreplace) = now()');
        $this->db->group_by('idpekerja');

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            $emplo = $query->result();
        }
        return $emplo;
    }

    //---------------------------------- FUNGSI TAMPILKAN DETIL LAPORAN CUTI -------------------------------------------
    public function detcuti($groupby)
    {
        $edp = array();

        $this->db->select('namapkj','tglmulai','tglselesai','alasancuti','ketnya','tglover','mulaiover','selesaiover','totalover','alasanover','tglreplace','mulaireplace','selesaireplace','sisareplace');
        $this->db->from('pekerja');
        $this->db->join('cuti', 'pekerja.idpekerja=cuti.pekerja','left');
        $this->db->join('overtime', 'pekerja.idpekerja=overtime.pekerjaover','left');
        $this->db->join('replacetime', 'pekerja.idpekerja=replacetime.pekerjareplace','left');
        $this->db->where('year(tglmulai) = now() AND year(tglover) = now() AND year(tglreplace) = now()');
        $this->db->group_by('idpekerja');

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            $edp = $query->result();
        }
        return $edp;
    }

    //--------------------------------- FUNGSI HALAMAN LAPORAN KARYAWAN ------------------------------------
    public function jumlahaktif()
    {
        $aktif = array();

        $this->db->select('COUNT(idpekerja) as akt');
        $this->db->from('pekerja');

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            $aktif = $query->result();
        }
        return $aktif;
    }

    public function jumlahresign()
    {
        $pasif = array();

        $this->db->select('COUNT(idresign) as jum');
        $this->db->from('resign');

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            $pasif = $query->result();
        }
        return $pasif;
    }

    public function keluarnya()
    {
        $out = array();

        $this->db->select('namastaff,namakeluar,statuskeluar,telpkeluar,tglmsk,tglkeluar');
        $this->db->from('resign');
        $this->db->join('staff','staff.idstaff=resign.jeniskeluar');

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            $out = $query->result();
        }
        return $out;
    }
}
