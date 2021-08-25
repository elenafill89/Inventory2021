<?php
if (!defined('BASEPATH')) exit ('No direct script access allowed');

class Newjob extends CI_Controller
{
    public function __construct() 
    {
        parent::__construct();
        $this->load->model('Model_joborder');
        // $this->load->library('excel');
        // $this->load->library('pdf');
    }

    //----------------------------------------- FUNGSI MELOAD HALAMAN TABEL JOB ORDER -----------------------------------------
    public function index()
    {
        $data['hasiljob'] = $this->Model_joborder->ambiljob();
        $data['cb'] = $this->Model_joborder->data_combobox();
        $data['box'] = $this->Model_joborder->data_cbbox();
        $data['kodeotomatis'] = $this->Model_joborder->kodeotomatis();
        $data['rd'] = $this->Model_joborder->tampil();
        $data['bb'] = $this->Model_joborder->combox();
        $this->load->view('header');
        $this->load->view('newjob',$data);
    }

    //----------------------------------------- FUNGSI MENYIMPAN DATA TAMBAH KATEGORI DARI MODAL -----------------------------------------
    public function popup_box() {

        $this->form_validation->set_rules('namakat', 'namakat', 'required');
        if ($this->form_validation->run()==FALSE) {
            $this->session->set_flashdata('error', "Data Gagal di Tambahkan!");
            redirect('job');
        } else {
            $data = array('namakategori' => $_POST['namakat'] );
            
            $this->Model_joborder->add_category($data,'kategori');
            redirect('job');
        }     
    }

    //----------------------------------------- FUNGSI MENGEKSPORT DATA DARI HALAMAN TABEL -----------------------------------------
    public function export()
    {
        $this->excel->setActiveSheetIndex(0);

        //name the worksheet
        $this->excel->getActiveSheet()->setTitle('RENCANA KERJA RND');

        //set cell A1 content with some text
        $this->excel->setActiveSheetIndex(0)->setCellValue('A1',"RENCANA KERJA RND");
        
        //merge cell A1 until C1
        $this->excel->getActiveSheet()->mergeCells('A1:D1');

        $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(TRUE);
        $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(14);
        $this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $this->excel->getActiveSheet()->getStyle('A1')->getFill()->getStartColor()->setARGB('#333');
        for($col = ord('A'); $col <= ord('D'); $col++){ 
           //set column dimension 
           $this->excel->getActiveSheet()->getColumnDimension(chr($col))->setAutoSize(true);
           
           //change the font size
           $this->excel->getActiveSheet()->getStyle(chr($col))->getFont()->setSize(12);
                 
           $this->excel->getActiveSheet()->getStyle(chr($col))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
        }

        $joborder = $this->Model_joborder->get_all();
        $exceldata="";
        foreach($joborder->result_array() as $rw) {
            $exceldata[] = $rw;
        }

        //Fill data
        $this->excel->getActiveSheet()->fromArray($exceldata,null,'A5');

        $this->excel->setActiveSheetIndex(0)->setCellValue('A5',"KLIEN");
        $this->excel->setActiveSheetIndex(0)->setCellValue('B5',"NAMA");
        $this->excel->setActiveSheetIndex(0)->setCellValue('C5',"QTY");
        $this->excel->setActiveSheetIndex(0)->setCellValue('D5',"KETERANGAN");

        $this->excel->getActiveSheet()->getStyle('A5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $this->excel->getActiveSheet()->getStyle('B5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $this->excel->getActiveSheet()->getStyle('C5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $this->excel->getActiveSheet()->getStyle('D5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        
        $this->excel->getActiveSheet()->getStyle('A5')->getFont()->setBold(TRUE);
        $this->excel->getActiveSheet()->getStyle('B5')->getFont()->setBold(TRUE);
        $this->excel->getActiveSheet()->getStyle('C5')->getFont()->setBold(TRUE);
        $this->excel->getActiveSheet()->getStyle('D5')->getFont()->setBold(TRUE);
        
        $filename='PHPJoborder.xls'; //save our workbook as this file name
        header('Content-Type: application/vnd.ms-excel'); //mime type
        header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
        header('Cache-Control: max-age=0'); //no cache

        //save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
        //if you want to save it as .XLSX Excel 2007 format
        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
        //force user to download the Excel file without writing it to server's HD
        $objWriter->save('php://output');
        redirect('job');
    }

    //----------------------------------------- FUNGSI MENGEKSPORT DATA DARI HALAMAN TABEL -----------------------------------------
    public function printaja()
    {
        $pdf = new FPDF('l','mm','A4');

        // membuat halaman baru
        $pdf->AddPage();
        
        // setting jenis font yang akan digunakan
        $pdf->SetFont('Arial','B',16);

        // mencetak string 
        $pdf->Cell(258,7,'RENCANA KERJA RND',0,1,'C');

        // Memberikan space kebawah agar tidak terlalu rapat
        $pdf->Cell(10,7,'',0,1);
        $pdf->SetFont('Arial','B',14);
        // $pdf->Cell(28,6,'ID',1,0);
        $pdf->Cell(62,6,'KLIEN',1,0,'C');
        $pdf->Cell(142,6,'NAMA',1,0,'C');
        $pdf->Cell(20,6,'ORDER',1,0,'C');
        $pdf->Cell(48,6,'KET',1,1,'C');
        $pdf->SetFont('Arial','',12);
        $mahasiswa = $this->Model_joborder->get_all();
        foreach ($mahasiswa->result() as $row){
            // $pdf->Cell(28,6,$row->idjoborder,1,0);
            $pdf->Cell(62,6,$row->namaklien,1,0); 
            $pdf->Cell(142,6,$row->namajob,1,0);
            $pdf->Cell(20,6,$row->jumlah,1,0,'C');
            $pdf->Cell(48,6,$row->keterangan,1,1); 
        }
        $pdf->Output();
    }
}
