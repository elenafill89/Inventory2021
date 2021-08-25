    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h2>All Purchase Order</h2>

            <ol class="breadcrumb">
                <li>
                    <a class="btn btn-app" href="addtool" title="Add New PO">
                        <i class="fa fa-tasks"></i>
                        <h6><b>New Purchase Order</b></h6>
                    </a>
                    <a class="btn btn-app" href="receivpo" title="Receiving PO from Vendor">
                        <i class="fa fa-level-down"></i>
                        <h6><b>Receive Purchase Order</b></h6>
                    </a>
                </li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Purchase Order</th>
                                        <th>Date</th>
                                        <th>Vendor</th>
                                        <th>Customer</th>
                                        <th>Payment Type</th>
                                        <th>Type PO</th>
                                        <th>Status</th>
                                        <th> </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($poall as $row) { ?>
                                        <tr>
                                            <td>
                                                <form name="form" action="<?= site_url() . 'detiltool'; ?>" method="POST">
                                                    <input type="hidden" name="btnEdit" value="<?php echo $row->purchaseorderid; ?>">
                                                    <button type="submit" class="btn"><?= $row->purchaseorderid ?></button>
                                                </form>
                                            </td>
                                            <td><?= $row->datepurch ?></td>
                                            <td><?= $row->namasupp ?></td>
                                            <td><?= $row->custname ?></td>
                                            <td><?= $row->paymentpurchorder ?></td>
                                            <td><?= $row->typepurchorder ?></td>
                                            <td><?= $row->statuspurchorder ?></td>

                                            <?php if ($row->statuspurchorder == "Open Order") { ?>
                                                <td>
                                                    <form name="form" action="<?= site_url() . 'printtool'; ?>" method="POST">
                                                        <input type="hidden" name="btndtl" value="<?php echo $row->purchaseorderid; ?>">
                                                        <button type="submit" class="btn"><a type="submit" role="button" title="Submit PO" aria-expanded="false"><span class="glyphicon glyphicon-send"></span>&nbsp; Submit PO</a></button>
                                                    </form>
                                                </td>
                                            <?php } else { ?>
                                                <td><span class="glyphicon glyphicon-send"></span>&nbsp; Submited </td>
                                            <?php }; ?>
                                        </tr>
                                    <?php }; ?>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <footer class="main-footer">
        <div class="pull-right hidden-xs">
            <b>Version</b> 2.6.08
        </div>
        <strong>Copyright &copy;2021 Inventory1.0</strong> All rights
        reserved.
    </footer>
    </div>
    <!-- ./wrapper -->


    <!-- jQuery 3 -->
    <script src="assets/bower_components/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap 3.3.7 -->
    <script src="assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- DataTables -->
    <script src="assets/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <!-- SlimScroll -->
    <script src="assets/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
    <!-- FastClick -->
    <script src="assets/bower_components/fastclick/lib/fastclick.js"></script>
    <!-- AdminLTE App -->
    <script src="assets/dist/js/adminlte.min.js"></script>
    <!-- page script -->
    <script>
        $(function() {
            $('#example1').DataTable()
            $('#example2').DataTable({
                'paging': true,
                'lengthChange': false,
                'searching': false,
                'ordering': true,
                'info': true,
                'autoWihsltoolh': false
            })
        })
    </script>
    </body>

    </html>