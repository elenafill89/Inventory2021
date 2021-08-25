<?php
if (!defined('BASEPATH')) exit ('No direct script access allowed');

class Model_login extends CI_Model
{
    public function __construct()
    {
      parent::__construct();   
    }

    public function datacombo()
    {
        $this->db->order_by('namadept','ASC');
        $combo = $this->db->get('departemen')->result();
        return $combo;
    }

    public function simpanuser($data,$table)
    {
        $this->db->insert($table,$data);
    }

    public function update($where,$data,$table)
    {
        $this->db->where($where);
        $this->db->update($table,$data);
    }

    public function loginrnd($where)
    {
        $this->db->from('usradmin');
        $this->db->where($where);
        $cek = $this->db->get();
        return $cek;
    }

    public function logintamu($where)
    {
        $this->db->from('usradmin');
        $this->db->where($where);
        $cek = $this->db->get();
        return $cek;
    }

    public function loginacc($where)
    {
        $this->db->from('usradmin');
        $this->db->where($where);
        $cek = $this->db->get();
        return $cek;
    }

    public function logineks($where)
    {
        $this->db->from('usradmin');
        $this->db->where($where);
        $cek = $this->db->get();
        return $cek;
    }
}
