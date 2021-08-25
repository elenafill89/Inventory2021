<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Model_gudang extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    //--------------------------- SQL QUERY HALAMAN PODUCT RELEASE ------------------------------------
    //Menampilkan data barang untuk tabel
    public function ambildata()
    {
        $this->db->order_by('kodebrg', 'ASC');
        return $hsl = $this->db->from('invtbarang')
            ->join('invtcategory', 'invtcategory.idinvtcategory=invtbarang.kategoribrg')
            ->get()
            ->result();
    }

    //Menampilkan data kategori
    public function datacombobox()
    {
        $this->db->order_by('catname', 'ASC');
        $pkj = $this->db->get('invtcategory')->result();
        return $pkj;
    }

    //Membuat kode otomatis dihalaman tambah barang
    public function kodebarang()
    {
        $this->db->select('Right(invtbarang.kodebrg, 6) as kode', FALSE);
        $this->db->order_by('kodebrg', 'DESC');
        $this->db->limit(1);

        $query = $this->db->get('invtbarang');

        if ($query->num_rows() <> 0) {
            $data = $query->row();
            $kode = intval($data->kode) + 1;
        } else {
            $kode = 1;
        }

        $kodemax = str_pad($kode, 6, "0", STR_PAD_LEFT);
        $kodebrang = "GNA" . $kodemax;
        return $kodebrang;
    }

    //Menyimpan data barang baru
    public function simpan_data($data, $table)
    {
        $this->db->insert($table, $data);
    }

    //Mengubah edit barang
    public function edit_data($where, $data, $table)
    {
        $this->db->where($where);
        $this->db->update($table, $data);
    }

    //Menghapus data Barang
    public function hapus($where, $table)
    {
        $this->db->where($where);
        $this->db->delete($table);
    }

    //Menyimpan tambah KATEGORI
    public function tambahstok($data, $table)
    {
        $this->db->insert($table, $data);
    }


    //------------------------------ SQL QUERY HALAMAN SUPPLIER ---------------------------------------
    //Menampilkan data supplier
    public function ambilmolding()
    {
        $hslmolding = array();

        $query = $this->db->get('dbsupplier');

        if ($query->num_rows() > 0) {
            $hslmolding = $query->result();
        }
        return $hslmolding;
    }

    //Membuat kode otomatis dihalaman tambah supplier
    public function kodeotomatis()
    {
        $this->db->select('Right(dbsupplier.kodesupp, 6) as kode', FALSE);
        $this->db->order_by('kodesupp', 'DESC');
        $this->db->limit(1);

        $query = $this->db->get('dbsupplier');

        if ($query->num_rows() <> 0) {
            $data = $query->row();
            $kode = intval($data->kode) + 1;
        } else {
            $kode = 1;
        }

        $kodemax = str_pad($kode, 6, "0", STR_PAD_LEFT);
        $kodejadi = "S-" . $kodemax;
        return $kodejadi;
    }

    //Menyimpan data supplier baru
    public function add_molding($data, $table)
    {
        $this->db->insert($table, $data);
    }

    //Ambil data supplier berdasar id
    public function tampilmolding($id)
    {
        $this->db->where('idsupplier', $id);
        $md = $this->db->get('dbsupplier')->result();
        return $md;
    }

    //Mengedit data supplier
    public function edit_molding($where, $data, $table)
    {
        $this->db->where($where);
        $this->db->update($table, $data);
    }

    //Menghapus data supplier
    public function busakmolding($where, $table)
    {
        $this->db->where($where);
        $this->db->delete($table);
    }

    //------------------------------ SQL QUERY HALAMAN PURCHASE ORDER -----------------------------------
    //Menampilkan data item po dari tabel temporary
    public function ambilitemp()
    {
        $this->db->order_by('idtemppo', 'ASC');
        return $hasil = $this->db->from('temppo')
            ->join('invtbarang', 'invtbarang.kodebrg=temppo.tempbrg')
            ->get()
            ->result();
    }

    //Menampilkan data umum po dari tabel temporary
    public function ambilitemp2()
    {
        $this->db->order_by('idtemppurch', 'ASC');
        return $prch = $this->db->from('temppurch')
            ->join('dbcustomer', 'dbcustomer.custcode=temppurch.custpurch')
            ->join('dbsupplier', 'dbsupplier.kodesupp=temppurch.suppurch')
            ->get()
            ->result();
    }

    //Menampilkan data customer
    public function ambilcust()
    {
        $cust = array();

        $query = $this->db->get('dbcustomer');

        if ($query->num_rows() > 0) {
            $cust = $query->result();
        }
        return $cust;
    }

    //Menampilkan data barang di dropdown box
    public function ambilbrg()
    {
        $brg = array();

        $query = $this->db->get('invtbarang');

        if ($query->num_rows() > 0) {
            $brg = $query->result();
        }
        return $brg;
    }

    //Membuat kode otomatis dihalaman tambah nomor PO
    public function kodepo()
    {
        $this->db->select('Right(purchorder.purchaseorderid, 6) as kode', FALSE);
        $this->db->order_by('purchaseorderid', 'DESC');
        $this->db->limit(1);

        $query = $this->db->get('purchorder');

        if ($query->num_rows() <> 0) {
            $data = $query->row();
            $kode = intval($data->kode) + 1;
        } else {
            $kode = 1;
        }

        $kodemax = str_pad($kode, 6, "0", STR_PAD_LEFT);
        $kdpo = "PO-" . $kodemax;
        return $kdpo;
    }


    public function simpanalat($data, $table)
    {
        $this->db->insert($table, $data);
    }

    //Mengedit data item yang akan dimasukkan ke PO
    public function ubahalat($where, $data, $table)
    {
        $this->db->where($where);
        $this->db->update($table, $data);
    }

    public function alatinven($data, $table)
    {
        $this->db->insert($table, $data);
    }

    //Menyimpan data item yang akan dimasukkan ke PO
    public function alatrusak($data, $table)
    {
        $this->db->insert($table, $data);
    }

    //Menyimpan data header ke tabel temporary temppurch
    public function simpaninven($where, $data, $table)
    {
        $this->db->where($where);
        $this->db->update($table, $data);
    }

    public function hapusalat($where, $table)
    {
        $this->db->where($where);
        $this->db->delete($table);
    }

    //Menghapus data di tabel temppo saat cancel dan submit
    public function hapustemp1()
    {
        $query = "DELETE FROM temppo";
        return $this->db->query($query);
    }

    //Menghapus data di tabel temppurch saat cancel dan submit
    public function hapustemp2($where, $data, $table)
    {
        $this->db->where($where);
        $this->db->update($table, $data);
    }

    //Memindahkan data dari tabel temppo ke tabel purchorderitem
    public function movetemp1($table)
    {
        $query = $this->db->get('temppo');
        foreach ($query->result() as $row) {
            $data = array(
                'purchorderid' => $row->purchidbrg,
                'purchorderbrg' => $row->tempbrg,
                'qtypurchorder' => $row->qtybrg,
                'purchorderprice' => $row->pricebrg,
                'tipeitempurch' => $row->typebrg,
                'totalpricepurch' => $row->totalbrg,
                'statuspurch' => $row->statusbrg
            );
        }
        $this->db->insert($table, $data);
    }

    //Memindahkan data dari tabel temppurch ke tabel purchorder
    public function movetemp2($table)
    {
        $query = $this->db->get('temppurch');
        foreach ($query->result() as $row) {
            $data = array(
                'purchaseorderid' => $row->purchid,
                'datepurch' => $row->tglpurch,
                'supppurchorder' => $row->suppurch,
                'custpurchorder' => $row->custpurch,
                'paymentpurchorder' => $row->paypurch,
                'commentspurchorder' => $row->comentpurch,
                'typepurchorder' => $row->tipepurch,
                'statuspurchorder' => $row->sttpurch
            );
        }
        $this->db->insert($table, $data);
    }

    //Menyimpan data payment PO
    public function simpanpayment($data, $table)
    {
        $this->db->insert($table, $data);
    }

    //Mengambil data transaksi PO
    public function ambilpo()
    {
        $this->db->order_by('idpurchorder', 'ASC');
        return $poall = $this->db->from('purchorder')
            ->join('dbcustomer', 'dbcustomer.custcode=purchorder.custpurchorder')
            ->join('dbsupplier', 'dbsupplier.kodesupp=purchorder.supppurchorder')
            ->join('purchorderpayment', 'purchorderpayment.purchorderid=purchorder.purchaseorderid')
            ->join('purchorderitem', 'purchorderitem.purchorderid=purchorder.purchaseorderid')
            ->join('invtbarang', 'invtbarang.kodebrg=purchorderitem.purchorderbrg')
            ->join('invtcategory', 'invtcategory.idinvtcategory=invtbarang.kategoribrg')
            ->get()
            ->result();
    }

    public function ambilpodetil($id)
    {
        $this->db->where('purchaseorderid', $id);
        return $podtl = $this->db->from('purchorder')
            ->join('dbcustomer', 'dbcustomer.custcode=purchorder.custpurchorder')
            ->join('dbsupplier', 'dbsupplier.kodesupp=purchorder.supppurchorder')
            ->join('purchorderpayment', 'purchorderpayment.purchorderid=purchorder.purchaseorderid')
            ->join('purchorderitem', 'purchorderitem.purchorderid=purchorder.purchaseorderid')
            ->join('invtbarang', 'invtbarang.kodebrg=purchorderitem.purchorderbrg')
            ->join('invtcategory', 'invtcategory.idinvtcategory=invtbarang.kategoribrg')
            ->get()
            ->result();
    }

    public function updatestatus($where, $data, $table)
    {
        $this->db->where($where);
        $this->db->update($table, $data);
    }


    //------------------------------ SQL QUERY HALAMAN RECEIVING PO -----------------------------------
    public function rcvpo()
    {
        $hpo = array();
        $this->db->select('purchaseorderid');
        $this->db->from('purchorder');
        $this->db->where('statuspurchorder', 'Processed');

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            $hpo = $query->result();
        }
        return $hpo;
    }
}
