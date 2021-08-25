<?php
if (!defined('BASEPATH')) exit ('No direct script access allowed');

class Model_produk extends CI_Model
{
    public function __construct() {
        parent::__construct();
    }

    public function get_all()
    {
        $kids = array();

        $query = $this->db->get('kiddiejadi');

        if ($query->num_rows() > 0) {
            $kids = $query->result();
        }
        return $kids;
    }

    public function simpan_data($data,$table)
    {
        $this->db->insert($table,$data); 
    }

    public function hapussaja($where,$table)
    {
        $this->db->where($where);
        $this->db->delete($table);
    }
}
