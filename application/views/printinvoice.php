<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Inventory1.0 | Purchase Order</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="assets/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="assets/bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="assets/dist/css/AdminLTE.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>

<body onload="window.print();">
  <div class="wrapper">
    <!-- Main content -->
    <section class="invoice">
      <!-- title row -->
      <?php if (isset($podtl[0])) { ?>
        <div class="row">
          <div class="col-xs-12">
            <h2 class="page-header">
              PT. Globalindo Nusantara
              <small class="float-right">Date: <?= date('d/m/y') ?></small>
            </h2>
          </div>
          <!-- /.col -->
        </div>
        <!-- info row -->
        <div class="row invoice-info">
          <div class="col-sm-4 invoice-col">
            Purchase From
            <address>
              <strong><?= $podtl[0]->namasupp ?></strong><br>
              <?= $podtl[0]->alamatsupp ?><br>
              Phone: <?= $podtl[0]->telpsupp ?><br>
            </address>
          </div>
          <!-- /.col -->
          <div class="col-sm-4 invoice-col">
            Ship To
            <address>
              <strong><?= $podtl[0]->custname ?></strong><br>
              <?= $podtl[0]->custaddress ?><br>
              Phone: <?= $podtl[0]->custtelp ?><br>
            </address>
          </div>
          <!-- /.col -->
          <div class="col-sm-4 invoice-col">
            <b>Purchase Order</b><br>
            <br>
            <b>PO Number:</b> <?= $podtl[0]->purchaseorderid ?><br>
            <b>PO Date:</b> <?= $podtl[0]->datepurch ?><br>
            <b>Vendor ID:</b> <?= $podtl[0]->kodesupp ?>
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->

        <!-- Table row -->
        <div class="row">
          <div class="col-xs-12 table-responsive">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>Qty</th>
                  <th>Product</th>
                  <th>Type #</th>
                  <th>Price</th>
                  <th>Total</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($podtl as $row) { ?>
                  <tr>
                    <td><?= $row->qtypurchorder ?></td>
                    <td><?= $row->namabrg ?></td>
                    <td><?= $row->tipeitempurch ?></td>
                    <td><?= "Rp" . number_format($row->purchorderprice, 0, ',', '.')  ?></td>
                    <td><?= "Rp" . number_format($row->totalpricepurch, 0, ',', '.') ?></td>
                  </tr>
                <?php }; ?>
              </tbody>
            </table>
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->

        <div class="row">
          <!-- accepted payments column -->
          <div class="col-xs-6">
            <p class="lead">Payment Methods:</p>
            <p><?= $podtl[0]->paymentpurchorder ?></p>

            <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">
              <?= $podtl[0]->commentspurchorder ?>
            </p>
          </div>
          <!-- /.col -->
          <div class="col-xs-6">

            <div class="table-responsive">
              <table class="table">
                <tr>
                  <th style="width:50%">Subtotal:</th>
                  <td><?php echo "Rp" . number_format($podtl[0]->subtotalpurch, 0, ',', '.'); ?></td>
                </tr>
                <tr>
                  <th>Tax (10%)</th>
                  <td><?php echo "Rp" . number_format($podtl[0]->taxpurch, 0, ',', '.'); ?></td>
                </tr>
                <tr>
                  <th>Shipping:</th>
                  <td><?php echo "Rp" . number_format($podtl[0]->shippurch, 0, ',', '.'); ?></td>
                </tr>
                <tr>
                  <th>Total:</th>
                  <td><?php echo "Rp" . number_format($podtl[0]->totalpurch, 0, ',', '.'); ?></td>
                </tr>
              </table>
            </div>
          </div>
          <!-- /.col -->
        </div>
      <?php }; ?>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- ./wrapper -->

  <script type="text/javascript">
    window.addEventListener("load", window.print());
  </script>
</body>

</html>