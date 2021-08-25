    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>All Products</h1>
            <ol class="breadcrumb">
                <li><a data-toggle="modal" data-target="#addKlien" role="button" title="Add New Product" aria-expanded="flase">Add Product &nbsp; <span class="glyphicon glyphicon-plus" aria-hidden="true"></span></a></li> &nbsp; &nbsp;
                <li><a data-toggle="modal" data-target="#addStok" role="button" title="Add New Category" aria-expanded="flase">Add Category &nbsp; <span class="glyphicon glyphicon-plus" aria-hidden="true"></span></a></li>
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
                                        <th>ID Product</th>
                                        <th>Name Product</th>
                                        <th>Description</th>
                                        <th>Category</th>
                                        <th>Unit</th>
                                        <th> </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($hsl as $row) { ?>
                                    <tr>
                                        <td><?= $row->kodebrg ?></td>
                                        <td><?= $row->namabrg ?></td>
                                        <td><?= $row->descbrg ?></td>
                                        <td><?= $row->catname ?></td>
                                        <td><?= $row->satuanbrg ?></td>
                                        <td><a data-toggle="modal" data-target="#editItem<?php echo $row->idbarang ?>" role="button" title="Edit" aria-expanded="false"><span class="glyphicon glyphicon-edit"></span></a>
                                        </td>
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
            <form class="form-horizontal form-label-left" method="POST" action="<?= site_url() . 'daily'; ?>">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4>Add New Product</h4>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="inputPanjang" id="inputPanjang" value="<?php echo $kodebrang; ?>" readonly>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Name Product</label>
                            <div class="col-md-8 col-sm-8 col-xs-12">
                                <input type="text" id="namaItem" name="namaItem" required="required" placeholder="ex. Papan Lembaran" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Description</label>
                            <div class="col-md-8 col-sm-8 col-xs-12">
                                <textarea type="text" id="inputJumlah" name="inputJumlah" required="required" placeholder="ex. Spesifikasi Produk" class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Category</label>
                            <div class="col-md-8 col-sm-8 col-xs-12">
                                <select name="inputHarga" id="inputHarga" class="form-control" required="required">
                                    <option value="#">-- Choose Category --</option>
                                    <?php foreach ($pkj as $combo) { ?>
                                    <option value="<?php echo $combo->idinvtcategory ?>"><?php echo $combo->catname ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Unit</label>
                            <div class="col-md-8 col-sm-8 col-xs-12">
                                <input type="text" id="satuan" name="satuan" required="required" placeholder="ex. Pcs" class="form-control">
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
    foreach ($hsl as $r) : $id++; ?>
    <div class="modal fade" id="editItem<?php echo $r->idbarang; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form class="form-horizontal form-label-left" method="POST" action="<?= site_url() . 'change'; ?>">
                <div class="modal-content">
                    <div class="modal-header">
                        <div class="modal-title">
                            <h5>Edit Data</h5>
                        </div>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="stokId" id="stokId" value="<?php echo $r->idbarang; ?>" readonly>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Name Product</label>
                            <div class="col-md-8 col-sm-8 col-xs-12">
                                <input type="text" id="namaItem" name="namaItem" required="required" value="<?php echo $r->namabrg; ?>" placeholder="ex. Papan Lembaran" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Description</label>
                            <div class="col-md-8 col-sm-8 col-xs-12">
                                <textarea type="text" id="inputJumlah" name="inputJumlah" required="required" placeholder="ex. 20" value="<?php echo $r->descbrg; ?>" class="form-control"> <?php echo $r->descbrg; ?></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                            <button type="<?= site_url() . 'details'; ?>" class="btn btn-primary">Advanced Setting</button>
                            <button type="submit" class="btn btn-success">Submit</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <?php endforeach; ?>

    <!-- Tambah Kategori Modal-->
    <div class="modal fade" id="addStok" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form class="form-horizontal form-label-left" method="POST" action="<?= site_url() . 'stok'; ?>">
                <div class="modal-content">
                    <div class="modal-header">
                        <div class="modal-title">
                            <h5>Add New Category</h5>
                        </div>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Category Name</label>
                            <div class="col-md-8 col-sm-8 col-xs-12">
                                <input type="text" id="jumlahItem" name="jumlahItem" required="required" placeholder="ex. Obat Mata" class="form-control">
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
                'autoWihslh': false
            })
        })
    </script>
    </body>

    </html>