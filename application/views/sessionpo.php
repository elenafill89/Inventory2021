<?php

      session_start();

      $barangnama   = $_POST['companyName'];
      $barangtipe   = $_POST['inputTelepon'];
      $barangjumlah = $_POST['alamat'];
      $barangharga  = $_POST['inputKota'];
      $barangkode   = $_POST['inputKode'];
      $barangstatus = $_POST['purchordstt'];
      $barangtotal  = $barangjumlah * $barangharga;

      $itempo = [
        'purchorderid' => $barangkode,
        'purchorderbrg' => $barangnama,
        'qtypurchorder' => $barangjumlah,
        'purchorderprice' => $barangharga,
        'tipeitempurch' => $barangtipe,
        'totalpricepurch' => $barangtotal,
        'statuspurch' => $barangstatus
      ];

      $_SESSION['poitem'][] = $itempo;

      header('location: tooladdpo.php?');
      // if(isset($_POST['additem'])):
      //     //membuat session array dengan variabel - variabel POST
      //     $_SESSION['pos']=$_POST;
      // endif;
       
      // if(isset($_SESSION['pos'])):
      //     $inputVendor   =$_SESSION['pos']['inputVendor'];
      //     $inputCust =$_SESSION['pos']['inputCust'];
      //     $datepicker   =$_SESSION['pos']['datepicker']; 
      //     $paymenttp   =$_SESSION['pos']['paymenttp']; 
      //     $compo   =$_SESSION['pos']['compo']; 
      // else:
      //     $inputVendor   ='';
      //     $inputCust ='';
      //     $datepicker   ='';
      //     $paymenttp   ='';
      //     $compo   ='';
      // endif;
    ?>