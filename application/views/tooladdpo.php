<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>New Purchase Order</h1>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <form class="form-horizontal" method="POST" action="<?= site_url() . 'inventool'; ?>">
        <div class="col-md-12">
          <div class="box box-warning">
            <div class="box-header with-border">
            </div>

            <div class="box-body">

              <div class="col-md-8">
                <div class="form-group">
                  <label class="col-sm-2 control-label"> PO Number </label>

                  <div class="col-sm-10">
                    <input type="text" name="inputKode" id="inputKode" value="<?php echo $kdpo; ?>" class="form-control" readonly>
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-2 control-label"> Vendor </label>

                  <div class="col-sm-10">
                    <select class="form-control select2" style="width: 100%;" name="inputVendor" id="inputVendor" required="required">
                      <option selected="selected"> Pick Vendor </option>
                      <?php foreach ($hslmolding as $vd) { ?>
                        <option value="<?php echo $vd->kodesupp ?>"> <?php echo $vd->namasupp ?></option>
                      <?php }; ?>
                    </select>
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-2 control-label"> Warehouse </label>

                  <div class="col-sm-10">
                    <select class="form-control select2" style="width: 100%;" name="inputCust" id="inputCust" required="required">
                      <option selected="selected"> Pick Warehouse </option>
                      <?php foreach ($cust as $cs) { ?>
                        <option value="<?php echo $cs->custcode ?>"> <?php echo $cs->custname; ?></option>
                      <?php }; ?>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label">Date</label>

                  <div class="col-sm-10">
                    <div class="input-group date">
                      <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                      </div>
                      <input type="text" class="form-control pull-left" name="datepicker" id="datepicker">
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label">Payment Type</label>

                  <div class="col-sm-10">
                    <select class="form-control" name="paymenttp" id="paymenttp" required="required">
                      <option selected="selected"> Choose Payment </option>
                      <option value="Bank Transfer"> Bank Transfer </option>
                      <option value="Cash"> Cash </option>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label">Comments</label>

                  <div class="col-sm-10">
                    <textarea type="text" id="compo" name="compo" required="required" class="form-control"></textarea>
                  </div>
                </div>
                <input type="hidden" name="purchordtp" id="purchordtp" value="STO" readonly>
              </div>
            </div>

            <div class="box-footer">
              <a href="<?= site_url() . 'ntools'; ?>"><button type="button" class="btn btn-default">Cancel</button></a>
              <button type="submit" class="btn btn-success pull-right">Add Item</button>
            </div>
          </div>
      </form>
    </div>
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
  })
</script>
<!-- page script -->

</body>

</html>