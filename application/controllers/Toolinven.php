<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Toolinven extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        // $this->load->model('MY_Form_validation');
        $this->load->model('Model_gudang');
    }

    //----------------------------------- FUNGSI LOAD HALAMAN UTAMA Purchase Order --------------------------------
    public function index()
    {
        $data['poall'] = $this->Model_gudang->ambilpo();
        $this->load->view('header');
        $this->load->view('toolinven', $data);
    }

    //----------------------------------- FUNGSI HALAMAN TAMBAH PURCHASE ORDER --------------------------------
    public function adding()
    {

        $data['hasil'] = $this->Model_gudang->ambilitemp();
        $data['datasession'] = $this->session->userdata('svdata');
        $data['brg'] = $this->Model_gudang->ambilbrg();
        $data['cust'] = $this->Model_gudang->ambilcust();
        $data['hslmolding'] = $this->Model_gudang->ambilmolding();
        $data['kdpo'] = $this->Model_gudang->kodepo();
        // $this->load->setcookie($_SESSION['pos']);
        $this->load->view('header');
        $this->load->view('tooladdpo', $data);

        print_r($_SESSION);
    }

    public function addsess()
    {
        $data['hasil'] = $this->Model_gudang->ambilitemp();
        $data['prch'] = $this->Model_gudang->ambilitemp2();
        $data['brg'] = $this->Model_gudang->ambilbrg();
        $data['kdpo'] = $this->Model_gudang->kodepo();
        $this->load->view('header');
        $this->load->view('tooladditpo', $data);
    }

    public function invent()
    {
        $this->form_validation->set_rules('inputKode', 'inputKode', 'required');
        $this->form_validation->set_rules('inputVendor', 'inputVendor', 'required');
        $this->form_validation->set_rules('inputCust', 'inputCust', 'required');
        $this->form_validation->set_rules('datepicker', 'datepicker', 'required');
        $this->form_validation->set_rules('paymenttp', 'paymenttp', 'required');
        $this->form_validation->set_rules('compo', 'compo', 'required');
        $this->form_validation->set_rules('purchordtp', 'purchordtp', 'required');
        $statuspo = "Open Order";
        $edp = "1";

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', "Data Gagal di Tambahkan!");
            redirect('ntools');
        } else {
            $data1 = array(
                'purchid' => $_POST['inputKode'],
                'tglpurch' => date('Y-m-d', strtotime($_POST['datepicker'])),
                'suppurch' => $_POST['inputVendor'],
                'custpurch' => $_POST['inputCust'],
                'paypurch' => $_POST['paymenttp'],
                'sttpurch' => $statuspo,
                'comentpurch' => $_POST['compo'],
                'tipepurch' => $_POST['purchordtp']
            );
            $where = array('idtemppurch' => $edp);
            $this->Model_gudang->simpaninven($where,  $data1, 'temppurch');
        }
        // $this->form_validation->resetpostdata();
        redirect('additpo');
    }

    //----------------------------------- FUNGSI UBAH DATA ITEM PO --------------------------------
    public function editing()
    {
        $this->form_validation->set_rules('companyName', 'companyName', 'required');
        $prc = $this->input->post('inputTelepon', 'inputTelepon', 'required');
        $qtt = $this->input->post('inputharga', 'inputharga', 'required');
        $this->form_validation->set_rules('idClient', 'idClient', 'required');
        $totalh = $prc * $qtt;

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', "Data Gagal di Tambahkan!");
            redirect('ntools');
        } else {
            $data = array(
                'typebrg' => $_POST['companyName'],
                'pricebrg' => $_POST['inputTelepon'],
                'qtybrg' => $_POST['inputharga'],
                'totalbrg' => $totalh
            );

            $where = array('idtemppo' => $_POST['idClient']);
            $this->Model_gudang->ubahalat($where, $data, 'temppo');
            // $this->form_validation->resetpostdata();
            redirect('additpo');
        }
    }

    //----------------------- FUNGSI MEMINDAHKAN DATA DARI TEMP TABEL TO REAL TABEL ---------------------------
    public function moveall()
    {
        $this->form_validation->set_rules('inputKode', 'inputKode', 'required');
        $this->form_validation->set_rules('inputSub', 'inputSub', 'required');
        $this->form_validation->set_rules('inputTax', 'inputTax', 'required');
        $this->form_validation->set_rules('inputShip', 'inputShip', 'required');
        $this->form_validation->set_rules('inputTotal', 'inputTotal', 'required');
        $stt = "Open Order";

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', "Data Gagal di Tambahkan!");
            redirect('ntools');
        } else {
            $data = array(
                'purchorderid' => $_POST['inputKode'],
                'subtotalpurch' => $_POST['inputSub'],
                'taxpurch' => $_POST['inputTax'],
                'shippurch' => $_POST['inputShip'],
                'totalpurch' => $_POST['inputTotal'],
                'statuspurch' => $stt
            );
            $this->Model_gudang->simpanpayment($data, 'purchorderpayment');
        }

        $this->Model_gudang->movetemp1('purchorderitem');
        $this->Model_gudang->movetemp2('purchorder');
        redirect('ntools');
    }

    //----------------------------------- FUNGSI TAMBAH DATA TEMPORARY ITEM --------------------------------
    public function broken()
    {
        $this->form_validation->set_rules('inputKode', 'inputKode', 'required');
        $this->form_validation->set_rules('companyName', 'companyName', 'required');
        $this->form_validation->set_rules('inputTelepon', 'inputTelepon', 'required');
        $qty = $this->input->post('alamat', 'alamat', 'required');
        $prc = $this->input->post('inputKota', 'inputKota', 'required');
        $totalhrg = $qty * $prc;
        $sttbrg = "Open Order";


        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', "Data Gagal di Tambahkan!");
            redirect('ntools');
        } else {
            $data = array(
                'tempbrg' => $_POST['companyName'],
                'qtybrg' => $_POST['alamat'],
                'pricebrg' => $_POST['inputKota'],
                'totalbrg' => $totalhrg,
                'typebrg' => $_POST['inputTelepon'],
                'purchidbrg' => $_POST['inputKode'],
                'statusbrg' => $sttbrg
            );

            $this->Model_gudang->alatrusak($data, 'temppo');
            // $this->form_validation->resetpostdata();
            redirect('additpo');
        }
    }

    //----------------------------------- FUNGSI HAPUS DATA ITEM PO --------------------------------
    public function deleting()
    {
        $id = $this->input->post('id');
        $where = array('idtemppo' => $id);
        $this->Model_gudang->hapusalat($where, 'temppo');
        redirect('additpo');
    }

    //----------------------------------- FUNGSI BERSIHKAN DATA TABEL TEMPORARY --------------------------------
    public function cancelpo()
    {
        $edp = '1';
        $data1 = array(

            'purchid' => NULL,
            'tglpurch' => NULL,
            'suppurch' => NULL,
            'custpurch' => NULL,
            'paypurch' => NULL,
            'sttpurch' => NULL,
            'comentpurch' => NULL,
            'tipepurch' => NULL
        );
        $where = array('idtemppurch' => $edp);
        $this->Model_gudang->hapustemp2($where, $data1, 'temppurch');
        $this->Model_gudang->hapustemp1();
        // $this->form_validation->resetpostdata();
        redirect('tools');
    }

    //----------------------------------- FUNGSI LIHAT HALAMAN DETIL --------------------------------
    public function inventdetil()
    {
        $id = $this->input->post('btnEdit');
        $data['podtl'] = $this->Model_gudang->ambilpodetil($id);
        $this->load->view('header');
        $this->load->view('tooldetail', $data);
    }

    //----------------------------------- FUNGSI CETAK HALAMAN DETIL --------------------------------
    public function printdetil()
    {
        $id = $this->input->post('btndtl');
        $stord = "Processed";
        $data3 = array('statuspurchorder' => $stord);
        $data1 = array('statuspurch' => $stord);
        $data2 = array('statuspurch' => $stord);
        $where = array('purchaseorderid' => $id);
        $where1 = array('purchorderid' => $id);
        $this->Model_gudang->hapustemp2($where, $data3, 'purchorder');
        $this->Model_gudang->hapustemp2($where1, $data1, 'purchorderitem');
        $this->Model_gudang->hapustemp2($where1, $data2, 'purchorderpayment');


        $data['podtl'] = $this->Model_gudang->ambilpodetil($id);
        $this->load->view('printpo', $data);
    }

    public function printdtl()
    {
        $id = $this->input->post('btndtl');
        $data['podtl'] = $this->Model_gudang->ambilpodetil($id);
        $this->load->view('printpo', $data);
    }

    //----------------------------------- FUNGSI CANCELING PO --------------------------------
    public function canceled()
    {
        $id = $this->input->post('id');
        $stord = "Canceled";
        $data3 = array('statuspurchorder' => $stord);
        $data1 = array('statuspurch' => $stord);
        $data2 = array('statuspurch' => $stord);
        $where = array('purchaseorderid' => $id);
        $where1 = array('purchorderid' => $id);
        $this->Model_gudang->updatestatus($where, $data3, 'purchorder');
        $this->Model_gudang->updatestatus($where1, $data1, 'purchorderitem');
        $this->Model_gudang->updatestatus($where1, $data2, 'purchorderpayment');
        redirect('tools');
    }

    //----------------------------------- FUNGSI RECEIVING PO --------------------------------
    public function receivpo()
    {
        $data['hpo'] = $this->Model_gudang->rcvpo();
        $this->load->view('header');
        $this->load->view('receivedpo', $data);
    }

    public function tookdt()
    {
        $id = $this->input->post('btndtl');
        $data['podtl'] = $this->Model_gudang->ambilpodetil($id);
        echo json_encode($data['podtl']);
    }
}
