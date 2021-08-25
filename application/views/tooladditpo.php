    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>New Purchase Order</h1>
      </section>

      <!-- Main content -->
      <section class="content">
        <div class="row">
          <?php echo validation_errors(); ?>
          <?php if (isset($msg)) {
            echo $msg;
          } ?>
          <form class="form-horizontal" method="POST" action="<?= site_url() . 'alltool'; ?>">
            <div class="col-md-12">
              <div class="box box-warning">
                <?php foreach ($prch as $pc) { ?>
                  <div class="box-header with-border">
                    <div class="col-md-8">
                      <div class="form-group">
                        <label class="col-sm-2 control-label"> PO Number </label>

                        <div class="col-sm-10">
                          <input type="text" name="inputKode" id="inputKode" placeholder="<?php echo $kdpo; ?>" value="<?php echo $kdpo; ?>" class="form-control" readonly>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-2 control-label"> Vendor </label>

                        <div class="col-sm-10">
                          <input type="text" name="inputVendor" id="inputVendor" placeholder="<?php echo $pc->namasupp; ?>" value="<?php echo $pc->namasupp; ?>" class="form-control" readonly>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-2 control-label"> Warehouse </label>

                        <div class="col-sm-10">
                          <input type="text" name="inputCust" id="inputCust" placeholder="<?php echo $pc->custname; ?>" value="<?php echo $pc->custname; ?>" class="form-control" readonly>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-2 control-label">Date</label>

                        <div class="col-sm-10">
                          <div class="input-group date">
                            <div class="input-group-addon">
                              <i class="fa fa-calendar"></i>
                            </div>
                            <input type="date" class="form-control pull-left" name="datepicker" id="datepicker" value="<?php echo $pc->tglpurch ?>" readonly>
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-2 control-label">Payment Type</label>

                        <div class="col-sm-10">
                          <input type="text" name="paymenttp" id="paymenttp" placeholder="<?php echo $pc->tipepurch; ?>" value="<?php echo $pc->tipepurch; ?>" class="form-control" readonly>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-2 control-label">Comments</label>

                        <div class="col-sm-10">
                          <textarea type="text" id="compo" name="compo" class="form-control" readonly> <?php echo $pc->comentpurch ?> </textarea>
                        </div>
                      </div>
                      <input type="hidden" name="purchordtp" id="purchordtp" value="STO" readonly>
                    </div>
                  </div>
                <?php } ?>

                <div class="box-body">
                  <ol class="breadcrumb">
                    <li><a data-toggle="modal" data-target="#addKlien" role="button" title="Add Item" aria-expanded="flase">Add Item &nbsp; <span class="glyphicon glyphicon-plus" aria-hidden="true" name="addto" id="addto" href="<?p= site_url() . 'addsess'; ?>"></span></a></li>
                  </ol>

                  <div class="col-xs-12 table-responsive">
                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <th class="text-center">Qty</th>
                          <th class="text-center">Name Product</th>
                          <th class="text-center">Type Product</th>
                          <th class="text-center">Price</th>
                          <th class="text-center">Total</th>
                          <th> </th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach ($hasil as $row) {
                          $subtl[] = $row->totalbrg;

                          $suball = array_sum($subtl);
                          $stax = $suball * 0.1;
                          $tl = $suball + $stax;
                        ?>
                          <tr>
                            <td class="text-center"><?= $row->qtybrg ?></td>
                            <td><?= $row->namabrg ?></td>
                            <td class="text-center"><?= $row->typebrg ?></td>
                            <td class="text-right"><?= "Rp" . number_format($row->pricebrg, 0, ',', '.')  ?></td>
                            <td class="text-right"><?= "Rp" . number_format($row->totalbrg, 0, ',', '.') ?></td>
                            <td class="text-center">
                              <a data-toggle="modal" data-target="#edit<?php echo $row->idtemppo ?>" role="button" title="Edit" aria-expanded="false"><span class="glyphicon glyphicon-edit"></span></a> &nbsp; &nbsp;
                              <a data-toggle="modal" data-target="#del<?php echo $row->idtemppo ?>" role="button" title="Delete" aria-expanded="false"><span class="glyphicon glyphicon-trash"></span></a>
                            </td>
                          </tr>
                        <?php }; ?>
                      </tbody>
                    </table>
                  </div>


                  <div class="col-md-8">
                    <?php
                    ?>
                    <div class="form-group">
                      <label class="col-sm-2 control-label"> Sub Total </label>

                      <div class="col-sm-10">
                        <input type="text" name="inputSub" id="inputSub" min="0" placeholder="0" value="<?= $suball; ?>" class="form-control text-right amount" readonly>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-2 control-label"> Tax Amount </label>

                      <div class="col-sm-10">
                        <input type="text" name="inputTax" id="inputTax" placeholder="0" min="0" value="<?= $stax; ?>" class="form-control text-right amount" required>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-2 control-label"> Shipment Amount </label>

                      <div class="col-sm-10">
                        <input type="text" name="inputShip" id="inputShip" placeholder="0" min="0" value="0" class="form-control text-right amount" required>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-2 control-label"> GRAND TOTAL </label>

                      <div class="col-sm-10">
                        <input type="text" name="inputTotal" id="inputTotal" placeholder="<?= $tl; ?>" class="form-control text-right amount" readonly>
                      </div>
                    </div>
                  </div>
                </div>


                <div class="box-footer">
                  <a href="<?= site_url() . 'ntools'; ?>"><button type="button" class="btn btn-default">Cancel</button></a>
                  <button type="submit" class="btn btn-info pull-right">Submit</button>
                </div>
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

    <!-- Add Modal -->
    <div class="modal fade" id="addKlien" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <?php echo validation_errors(); ?>
        <?php if (isset($msg)) {
          echo $msg;
        } ?>
        <form class="form-horizontal form-label-left" method="POST" action="<?= site_url() . 'temptool'; ?>">
          <div class="modal-content">
            <div class="modal-header">
              <h4>Add Item</h4>
            </div>
            <div class="modal-body">
              <input type="hidden" name="inputKode" id="inputKode" value="<?php echo $kdpo; ?>" class="form-control" readonly>
              <input type="hidden" name="purchordstt" id="purchordstt" value="Open Order" readonly>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Product Name</label>
                <div class="col-md-8 col-sm-8 col-xs-12">
                  <select class="form-control select2" style="width: 100%;" name="companyName" id="companyName" required="required">
                    <option selected="selected"> -- Pick Item -- </option>
                    <?php foreach ($brg as $br) { ?>
                      <option value="<?php echo $br->kodebrg ?>"> <?php echo $br->namabrg; ?></option>
                    <?php }; ?>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Type Product</label>
                <div class="col-md-8 col-sm-8 col-xs-12">
                  <input type="text" class="form-control has-feedback-left" id="inputTelepon" name="inputTelepon" required="required" placeholder="ex. MI982HJ">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Qty</label>
                <div class="col-md-2 col-sm-2 col-xs-12">
                  <input type="text" id="alamat" name="alamat" required="required" placeholder="5" class="form-control">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Price</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" id="inputKota" name="inputKota" required="required" placeholder="ex. 125900" class="form-control">
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                <button type="submit" class="btn btn-success" name="addpo" id="addpo">Submit</button>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>

    <!-- Edit Modal -->
    <?php $id = 1;
    foreach ($hasil as $r) : $id++; ?>
      <div class="modal fade" id="edit<?php echo $r->idtemppo; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <form class="form-horizontal form-label-left" method="POST" action="<?= site_url() . 'editools'; ?>">
            <div class="modal-content">
              <div class="modal-header">
                <div class="modal-title">
                  <h5>Edit Items</h5>
                </div>
              </div>
              <div class="modal-body">
                <input type="hidden" name="idClient" id="idClient" value="<?php echo $r->idtemppo; ?>" readonly>
                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12">Type Product</label>
                  <div class="col-md-8 col-sm-8 col-xs-12">
                    <input type="text" id="companyName" name="companyName" required="required" value="<?php echo $r->typebrg; ?>" placeholder="ex. SN03498HY3" class="form-control">
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12">Price</label>
                  <div class="col-md-8 col-sm-8 col-xs-12">
                    <input type="text" class="form-control has-feedback-left" id="inputTelepon" name="inputTelepon" required="required" value="<?php echo $r->pricebrg; ?>" placeholder="ex. 3">
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12">QTY</label>
                  <div class="col-md-8 col-sm-8 col-xs-12">
                    <input type="text" class="form-control has-feedback-left" id="inputharga" name="inputharga" required="required" value="<?php echo $r->qtybrg; ?>" placeholder="ex. 3">
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                  <button type="reset" class="btn btn-primary">Reset</button>
                  <button type="submit" class="btn btn-success">Submit</button>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    <?php endforeach; ?>

    <!-- Delete Modal -->
    <?php $id = 1;
    foreach ($hasil as $rid) : $id++; ?>
      <div class="modal fade" id="del<?php echo $rid->idtemppo; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <form class="form-horizontal form-label-left" method="POST" action="<?= site_url() . 'deltool'; ?>">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Apakah Anda yakin?</h5>
              </div>
              <div class="modal-body">Dengan memilih "Delete" data Klien akan otomatis terhapus tanpa disimpan ke Toko yang Tutup.
                <input type="hidden" name="id" id="id" value="<?php echo $rid->idtemppo; ?>" readonly>
              </div>
              <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-success">Delete</button>
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

        //Date picker
        $('#datepicker').datepicker({
          autoclose: true
        })

        //Grand Total
        $('#inputTax, #inputShip').keyup(function() {
          var value1 = parseFloat($('#inputTax').val()) || $stax;
          var value2 = parseFloat($('#inputShip').val()) || 0;
          var value3 = parseFloat($('#inputSub').val()) || $suball;
          $('#inputTotal').val(value1 + value2 + value3);
        });
      })
    </script>
    <!-- page script -->

    </body>

    </html>