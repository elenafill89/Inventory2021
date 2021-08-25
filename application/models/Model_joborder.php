<?php
if (!defined('BASEPATH')) exit ('No direct script access allowed');

class Model_joborder extends CI_Model
{
    public $hasiljob;

    public function __construct() {
        parent::__construct();
    }

    //----------------------------------------- FUNGSI MENAMPILKAN DATA DARI DATABASE KE HALAMAN JOB ORDER -----------------------------------------
    public function get_all()
    {
        $this->db->select('namaklien, namajob, jumlah, keterangan');
        $this->db->from('joborder');
        $this->db->join('klien','klien.idklien=joborder.klien');
        $this->db->where('tglmulai','DATE_SUB(Now(), INTERVAL 1 MONTH)');
        $this->db->or_where('prioritas','Belum Mulai');
        $this->db->order_by('kategorinya');

        return $this->db->get();
    }

    //----------------------------------------- FUNGSI MENYIMPAN DATA DARI HALAMAN ADDJOB KE DATABASE -----------------------------------------    
    public function ambiljob()
    {
        $hasiljob = array();
        $this->db->select('idjoborder, namajob, jumlah, namaklien, keterangan');
        $this->db->from('joborder');
        $this->db->join('klien','klien.idklien=joborder.klien');
        $this->db->where('prioritas','Belum Mulai');

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            $hasiljob = $query->result();
        }
        return $hasiljob;
    }
    
    //----------------------------------------- FUNGSI MENAMPILKAN KODE OTOMATIS JOB ORDER KE HALAMAN ADD JOB -----------------------------------------
    public function kodeotomatis()
    {
        $this->db->select('Right(joborder.idjoborder, 7) as kode',FALSE);
        $this->db->order_by('idjoborder','DESC');
        $this->db->limit(1);

        $query = $this->db->get('joborder');

        if ($query->num_rows() <> 0) {
            $data = $query->row();
            $kode = intval($data->kode) + 1;
        } else {
            $kode = 1;
        }

        $kodemax = str_pad($kode, 7, "0", STR_PAD_LEFT);
        $kodejadi = "JOB".$kodemax;
        return $kodejadi;
    }

    //----------------------------------------- FUNGSI MENAMPILKAN DATA PADA COMBOBOX DI HALAMAN ADD JOB -----------------------------------------
    //Menampilkan data kategori di combobox
    public function data_combobox()
    {
        $this->db->order_by('namakategori','ASC');
        $cb = $this->db->get('kategori')->result();
        return $cb;
    }

    //Menampilkan data namapekerja di combobox
    public function data_combobox2()
    {   
        // $this->db->where('jenisnya',$idpekerja);  
        $this->db->order_by('namapkj','ASC');
        $this->db->join('staff', 'pekerja.jenisnya=staff.idstaff');      
        $div = $this->db->get('pekerja')->result();
        return $div;
    }

    //Menampilkan data klien di combobox
    public function data_cbbox()
    {
        $this->db->order_by('namaklien','ASC');
        $box = $this->db->get('klien')->result();
        return $box;
    }

    //Menampilkan data bahan di combobox
    public function data_cbb()
    {
        $this->db->order_by('namabarang','ASC');
        $fb = $this->db->get('barang')->result();
        return $fb;
    }

    //----------------------------------------- FUNGSI MENAMPILKAN DATA PADA COMBOBOX DI HALAMAN PROGRESS -----------------------------------------
    //Menampilkan data kode job spesifik berdasar job order
    public function combox()
    {
        $this->db->select('kodejobspesifik');
        $this->db->from('joborderprogres');
        $bb = $this->db->get()->result();
        return $bb;
    }

    public function combox2($data)
    {
        $this->db->where('kodejobspesifik',$data);
        $bb = $this->db->get('joborderprogres')->result();
        return $bb;
    }

    //Menampilkan data staff di combobox
    public function data_divisi()
    {   
        $this->db->order_by('namastaff', 'ASC');     
        return $this->db->get('staff')->result();
    }
    
    //Menampilkan data pekerja di combobox
    public function data_staff($idstaff)
    {   
        // $this->db->select('idpekerja,namapkj');
        // $this->db->from('pekerja');
        $this->db->where('jenisnya',$idstaff);
        $this->db->order_by('namapkj', 'ASC');     
        $query = $this->db->get('pekerja');
        $output = '<option value="">Select Worker</option>';
        foreach ($query->result() as $row) {
            $output .= '<option value="'.$row->idpekerja.'">'.$row->namapkj.'</option>';
        }
        return $output;
    }

    //----------------------------------------- FUNGSI MENYIMPAN DATA JOB ORDER BARU KE DATABASE -----------------------------------------
    //Menyimpan Job Order baru ke database
    public function add_job($data,$table)
    {
        $this->db->insert($table,$data); 
        return $this->db->insert_id();
    }
    
    //----------------------------------------- FUNGSI MENYIMPAN DATA KATEGORI BARU KE DATABASE -----------------------------------------
    //Menyimpan kategori baru ke database
    public function add_category($data,$table)
    {
        $this->db->insert($table,$data); 
    }

    //----------------------------------------- FUNGSI MENAMPILKAN ID JOB ORDER KE HALAMAN PROGRESS -----------------------------------------
    public function tampil() 
    {
        $rd = $this->db->get('joborderprogres')->result();
        return $rd;
    }

    public function tampil3($id) 
    {
        $this->db->where('jobspesifiknya', $id);
        $mt = $this->db->get('lapharian')->result();
        return $mt;
    }

    //----------------------------------------- FUNGSI MENYIMPAN DATA PROGRES KE TABEL LAPHARIAN DI DATABASE -----------------------------------------
    public function save_pg($data, $table)
    {
        $this->db->insert($table,$data);
    }

    public function updatejp($where,$data,$table)
    {
        $this->db->where($where);
        $this->db->update($table,$data);
    }

    public function updatejo($where,$data,$table)
    {
        $this->db->where($where);
        $this->db->update($table,$data);
    }

    //----------------------------------------- FUNGSI MENYIMPAN DATA MATERIAL KE TABEL BAHANPAKAI DI DATABASE -----------------------------------------
    public function save_mt($data, $table)
    {
        $this->db->insert($table,$data);
    }


    //_*_*_*_*_*_*_*_*_*_*_*_*_*_*_*_*_*_*_*_*_* HALAMAN PENGGUNAAN MATERIAL PRODUKSI (PROGRES) _*_*_*_*_*_*_*_*_*_*_*_*_*_*_*_*_*_*_*_*_*_*_*_*_*_
    public function barangpakai($id)
    {
        $res = array();

        $this->db->select('idprogreskerja,namabarang,satuan,hargapcs,jumlahbrg,hargatotal');
        $this->db->from('bahanterpakai');
        $this->db->join('barang', 'barang.idbarang=bahanterpakai.namabrg');
        $this->db->where('spesifiknya',$id);

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            $res = $query->result();
        }
        return $res;
    }

    //_*_*_*_*_*_*_*_*_*_*_*_*_*_*_*_*_*_*_*_*_* FUNGSI DONE JOB ORDER _*_*_*_*_*_*_*_*_*_*_*_*_*_*_*_*_*_*_*_*_*_*_*_*_*_
    public function done_jo($where, $data, $table)
    {
        $this->db->where($where);
        $this->db->update($table,$data);
    }

    public function done_jp($where,$data,$table)
    {
        $this->db->where($where);
        $this->db->update($table,$data);
    }
}