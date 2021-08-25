    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>All Suppliers</h1>
            <ol class="breadcrumb">
                <li><a data-toggle="modal" data-target="#addKlien" role="button" title="Add New Supplier" aria-expanded="flase">Add Supplier &nbsp; <span class="glyphicon glyphicon-plus" aria-hidden="true"></span></a></li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <!-- <h3 class="box-title">Data Table With Full Features</h3> -->
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>ID Supplier</th>
                                        <th>Name Supplier</th>
                                        <th>Address</th>
                                        <th>Phone Number</th>
                                        <th>NPWP</th>
                                        <th> </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($hslmolding as $row) { ?>
                                    <tr>
                                        <td><?= $row->kodesupp ?></td>
                                        <td><?= $row->namasupp ?></td>
                                        <td><?= $row->alamatsupp ?></td>
                                        <td><?= $row->telpsupp ?></td>
                                        <td><?= $row->npwpsupp ?></td>
                                        <td><a data-toggle="modal" data-target="#edit<?php echo $row->idsupplier ?>" role="button" title="Edit" aria-expanded="false"><span class="glyphicon glyphicon-edit"></span></a>
                                            <a data-toggle="modal" data-target="#del<?php echo $row->idsupplier ?>" role="button" title="Delete" aria-expanded="false"><span class="glyphicon glyphicon-trash"></span></a></td>
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

    <!-- Add Modal -->
    <div class="modal fade" id="addKlien" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form class="form-horizontal form-label-left" method="POST" action="<?= site_url() . 'addsupplier'; ?>">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4>Add New Supplier</h4>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="inputPanjang" id="inputPanjang" value="<?php echo $kodeotomatis; ?>" readonly>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Supplier's Name</label>
                            <div class="col-md-8 col-sm-8 col-xs-12">
                                <input type="text" id="namaMolding" name="namaMolding" required="required" placeholder="ex. Pecos Poeny" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Phone Number</label>
                            <div class="col-md-8 col-sm-8 col-xs-12">
                                <input type="text" id="moldingCode" name="moldingCode" required="required" placeholder="ex. #765" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">NPWP</label>
                            <div class="col-md-8 col-sm-8 col-xs-12">
                                <input type="text" id="inputQty" name="inputQty" required="required" placeholder="ex. 10" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Address</label>
                            <div class="col-md-8 col-sm-8 col-xs-12">
                                <textarea type="text" id="inputSet" name="inputSet" required="required" placeholder="ex. Jl. CTX gang melati no. 4" class="form-control"></textarea>
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

    <!-- Edit Modal -->
    <?php $id = 1;
    foreach ($hslmolding as $r) : $id++; ?>
    <div class="modal fade" id="edit<?php echo $r->idsupplier; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form class="form-horizontal form-label-left" method="POST" action="<?= site_url() . 'editsupplier'; ?>">
                <div class="modal-content">
                    <div class="modal-header">
                        <div class="modal-title">
                            <h5>Edit Data Supplier</h5>
                        </div>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="moldingId" id="moldingId" value="<?php echo $r->idsupplier; ?>" readonly>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Supplier's Name</label>
                            <div class="col-md-8 col-sm-8 col-xs-12">
                                <input type="text" id="namaMolding" name="namaMolding" required="required" value="<?php echo $r->namasupp; ?>" placeholder="ex. Pecos Poeny" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Phone Number</label>
                            <div class="col-md-8 col-sm-8 col-xs-12">
                                <input type="text" id="moldingCode" name="moldingCode" required="required" placeholder="ex. #765" value="<?php echo $r->telpsupp; ?>" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">NPWP</label>
                            <div class="col-md-8 col-sm-8 col-xs-12">
                                <input type="text" id="inputQty" name="inputQty" required="required" placeholder="ex. 10" value="<?php echo $r->npwpsupp; ?>" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Address</label>
                            <div class="col-md-8 col-sm-8 col-xs-12">
                                <textarea type="text" id="inputSet" name="inputSet" required="required" placeholder="ex. Jl. CTX gang melati no. 4" class="form-control"> <?php echo $r->alamatsupp; ?> </textarea>
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
    foreach ($hslmolding as $rid) : $id++; ?>
    <div class="modal fade" id="del<?php echo $rid->idsupplier; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form class="form-horizontal form-label-left" method="POST" action="<?= site_url() . 'deletesupplier'; ?>">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Apakah Anda yakin?</h5>
                    </div>
                    <div class="modal-body">Dengan memilih "Delete" data akan otomatis terhapus.
                        <input type="hidden" name="id" id="id" value="<?php echo $rid->idsupplier; ?>" readonly>
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
                'autoWihslmoldingh': false
            })
        })
    </script>
    </body>

    </html>