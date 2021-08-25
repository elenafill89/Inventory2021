    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>New Purchase Order</h1>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <form class="form-horizontal">
                    <div class="col-md-12">
                        <div class="box box-warning">
                            <?php if (isset($podtl[0])) { ?>
                                <div class="box-header with-border">
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label"> PO Number </label>

                                            <div class="col-sm-9">
                                                <input type="text" name="inputKode" id="inputKode" placeholder="<?php echo $podtl[0]->purchaseorderid; ?>" value="<?php echo $podtl[0]->purchaseorderid; ?>" class="form-control" readonly>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label"> Vendor </label>

                                            <div class="col-sm-9">
                                                <input type="text" name="inputVendor" id="inputVendor" placeholder="<?php echo $podtl[0]->namasupp; ?>" value="<?php echo $podtl[0]->namasupp; ?>" class="form-control" readonly>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label"> Warehouse </label>

                                            <div class="col-sm-9">
                                                <input type="text" name="inputCust" id="inputCust" placeholder="<?php echo $podtl[0]->custname; ?>" value="<?php echo $podtl[0]->custname; ?>" class="form-control" readonly>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Date</label>

                                            <div class="col-sm-9">
                                                <div class="input-group date">
                                                    <div class="input-group-addon">
                                                        <i class="fa fa-calendar"></i>
                                                    </div>
                                                    <input type="date" class="form-control pull-left" name="datepicker" id="datepicker" value="<?php echo $podtl[0]->datepurch ?>" readonly>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Payment Type</label>

                                            <div class="col-sm-9">
                                                <input type="text" name="paymenttp" id="paymenttp" placeholder="<?php echo $podtl[0]->paymentpurchorder; ?>" value="<?php echo $podtl[0]->paymentpurchorder; ?>" class="form-control" readonly>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Comments</label>

                                            <div class="col-sm-9">
                                                <textarea type="text" id="compo" name="compo" class="form-control" readonly> <?php echo $podtl[0]->commentspurchorder ?> </textarea>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">PO Type</label>

                                            <div class="col-sm-6">
                                                <input type="text" class="form-control" name="purchordtp" id="purchordtp" placeholder="<?php echo $podtl[0]->typepurchorder; ?>" value="<?php echo $podtl[0]->typepurchorder; ?>" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="box-body">
                                    <div class="col-xs-12 table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">Qty</th>
                                                    <th class="text-center">Name Product</th>
                                                    <th class="text-center">Type Product</th>
                                                    <th class="text-center">Price</th>
                                                    <th class="text-center">Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($podtl as $row) {
                                                ?>
                                                    <tr>
                                                        <td class="text-center"><?= $row->qtypurchorder ?></td>
                                                        <td><?= $row->namabrg ?></td>
                                                        <td class="text-center"><?= $row->tipeitempurch ?></td>
                                                        <td class="text-right"><?= "Rp" . number_format($row->purchorderprice, 0, ',', '.')  ?></td>
                                                        <td class="text-right"><?= "Rp" . number_format($row->totalpricepurch, 0, ',', '.') ?></td>
                                                    </tr>
                                                <?php }; ?>
                                            </tbody>
                                        </table>
                                    </div>


                                    <div class="col-md-10 col-sm-6">
                                        <div class="form-group">
                                            <label class="col-sm-2 col-md-3 control-label"> Sub Total </label>

                                            <div class="col-sm-10 col-md-3">
                                                <input type="text" name="inputSub" id="inputSub" min="0" placeholder="<?php echo "Rp" . number_format($podtl[0]->subtotalpurch, 0, ',', '.'); ?>" value="<?php echo "Rp" . number_format($podtl[0]->subtotalpurch, 0, ',', '.'); ?>" class="form-control text-right amount" readonly>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-2 col-md-3 control-label"> Tax Amount </label>

                                            <div class="col-sm-10 col-md-3">
                                                <input type="text" name="inputTax" id="inputTax" placeholder="<?php echo "Rp" . number_format($podtl[0]->taxpurch, 0, ',', '.'); ?>" value="<?php echo "Rp" . number_format($podtl[0]->taxpurch, 0, ',', '.'); ?>" class="form-control text-right amount" readonly>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-2 col-md-3 control-label"> Shipment Amount </label>

                                            <div class="col-sm-10 col-md-3">
                                                <input type="text" name="inputShip" id="inputShip" placeholder="<?php echo "Rp" . number_format($podtl[0]->shippurch, 0, ',', '.'); ?>" value="<?php echo "Rp" . number_format($podtl[0]->shippurch, 0, ',', '.'); ?>" class="form-control text-right amount" readonly>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-2 col-md-3 control-label"> GRAND TOTAL </label>

                                            <div class="col-sm-10 col-md-3">
                                                <input type="text" name="inputTotal" id="inputTotal" placeholder="<?php echo "Rp" . number_format($podtl[0]->totalpurch, 0, ',', '.'); ?>" value="<?php echo "Rp" . number_format($podtl[0]->totalpurch, 0, ',', '.'); ?>" class="form-control text-right amount" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="box-footer">
                                    <?php if ($podtl[0]->statuspurchorder == "Open Order") { ?>
                                        <a href="<?= site_url() . 'tools'; ?>"><button type="button" class="btn btn-default">Back</button></a>
                                        <a data-toggle="modal" data-target="#cancel<?php echo $podtl[0]->idpurchorder ?>" role="button" title="Cancel" aria-expanded="false"><button type="button" class="btn btn-info pull-right">Cancel PO</button></a>
                                    <?php } elseif ($podtl[0]->statuspurchorder == "Processed") { ?>
                                        <form name="form" action="<?= site_url() . 'printpo'; ?>" method="POST">
                                            <input type="hidden" name="btndtl" value="<?php echo $row->purchaseorderid; ?>">
                                            <button type="submit" class="btn"><a type="submit" role="button" aria-expanded="false"><span class="glyphicon glyphicon-print"></span>&nbsp; Print</a></button>
                                        </form>
                                        <a href="<?= site_url() . 'tools'; ?>"><button type="button" class="btn btn-default">Back</button></a>
                                    <?php } else { ?>
                                        <a href="<?= site_url() . 'tools'; ?>"><button type="button" class="btn btn-default">Back</button></a>
                                    <?php }; ?>
                                </div>
                            <?php }; ?>
                        </div>
                    </div>
                </form>
            </div>
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

    <!-- Cancel PO Modal -->
    <?php $id = 1;
    foreach ($podtl as $rid) : $id++; ?>
        <div class="modal fade" id="cancel<?php echo $rid->idpurchorder; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <form class="form-horizontal form-label-left" method="POST" action="<?= site_url() . 'ctools'; ?>">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Apakah Anda yakin?</h5>
                        </div>
                        <div class="modal-body">Dengan memilih "Yes" maka status PO berubah jadi Canceled dan prosesnya tidak dapat dilanjutkan.
                            <input type="hidden" name="id" id="id" value="<?php echo $rid->purchaseorderid; ?>" readonly>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-success">Yes</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    <?php endforeach; ?>

    <!-- jQuery 3 -->
    <script src="assets/bower_components/jquery/dist/jquery.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="assets/bower_components/jquery-ui/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button);
    </script>
    <!-- Select2 -->
    <script src="assets/bower_components/select2/dist/js/select2.full.min.js"></script>
    <!-- Bootstrap 3.3.7 -->
    <script src="assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- Morris.js charts -->
    <script src="assets/bower_components/raphael/raphael.min.js"></script>
    <script src="assets/bower_components/morris.js/morris.min.js"></script>
    <!-- DataTables untuk Table responsive -->
    <script src="assets/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <!-- Sparkline -->
    <script src="assets/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
    <!-- jvectormap -->
    <script src="assets/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
    <script src="assets/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
    <!-- jQuery Knob Chart -->
    <script src="assets/bower_components/jquery-knob/dist/jquery.knob.min.js"></script>
    <!-- daterangepicker -->
    <script src="assets/bower_components/moment/min/moment.min.js"></script>
    <script src="assets/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
    <!-- bootstrap datepicker -->
    <script src="assets/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
    <!-- Bootstrap WYSIHTML5 -->
    <script src="assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
    <!-- Slimscroll -->
    <script src="assets/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
    <!-- FastClick -->
    <script src="assets/bower_components/fastclick/lib/fastclick.js"></script>
    <!-- AdminLTE App -->
    <script src="assets/dist/js/adminlte.min.js"></script>
    <!-- ChartJS untuk chart Bulanan Dashboard -->
    <script src="assets/bower_components/chart.js/Chart.js"></script>
    <!-- page script untuk Table responsive -->
    <script>
        $(function() {
            //Initialize Select2 Elements
            $('.select2').select2()

            $('#example1').DataTable()
            $('#example2').DataTable({
                'paging': true,
                'lengthChange': false,
                'searching': false,
                'ordering': true,
                'info': true,
                'autoWidth': false
            })
        })
    </script>
    <!-- page script -->

    </body>

    </html>