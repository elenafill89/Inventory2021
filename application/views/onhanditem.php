    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>Stok Barang Gudang RND</h1>
            <ol class="breadcrumb">
                <li><a data-toggle="modal" data-target="#addKlien" role="button" title="Add New Item" aria-expanded="flase">Tambah Barang &nbsp; <span class="glyphicon glyphicon-plus" aria-hidden="true"></span></a></li>
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
                                        <th>ID</th>
                                        <th>Nama Barang</th>
                                        <th>Unit</th>
                                        <th>Harga Barang</th>
                                        <th>Stok In</th>
                                        <th>Stok Out</th>
                                        <th>Broke</th>
                                        <th> </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($hsl as $row) { ?>
                                    <tr>
                                        <td><?= $row->idbarang ?></td>
                                        <td data-toggle="modal" data-target="#editItem<?php echo $row->idbarang; ?>"><?= $row->namabarang ?></td>
                                        <td><?= $row->satuan ?></td>
                                        <td><?= 'Rp' . number_format($row->hargapcs) ?></td>
                                        <td data-toggle="modal" data-target="#addStok<?php echo $row->idbarang; ?>"><?= number_format($row->masuk) ?></td>
                                        <td data-toggle="modal" data-target="#editStok<?php echo $row->idbarang; ?>"><?= number_format($row->keluar) ?></td>
                                        <td data-toggle="modal" data-target="#brokeStok<?php echo $row->idbarang; ?>"><?= number_format($row->rusak) ?></td>
                                        <td><a data-toggle="modal" data-target="#del<?php echo $row->idbarang ?>" role="button" title="Delete" aria-expanded="false"><span class="glyphicon glyphicon-trash"></span></a></td>
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
        <strong>Copyright &copy;2019 RND Department.</strong> All rights
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
                        <h4>Tambah Barang Baru</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Nama Barang</label>
                            <div class="col-md-8 col-sm-8 col-xs-12">
                                <input type="text" id="namaItem" name="namaItem" required="required" placeholder="ex. Papan Lembaran" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Unit</label>
                            <div class="col-md-8 col-sm-8 col-xs-12">
                                <input type="text" id="satuan" name="satuan" required="required" placeholder="ex. Pcs" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Price</label>
                            <div class="col-md-8 col-sm-8 col-xs-12">
                                <input type="text" id="inputHarga" name="inputHarga" required="required" placeholder="ex. 12500" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Jumlah Awal</label>
                            <div class="col-md-8 col-sm-8 col-xs-12">
                                <input type="text" id="inputJumlah" name="inputJumlah" required="required" placeholder="ex. 20" class="form-control">
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
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Nama Barang</label>
                            <div class="col-md-8 col-sm-8 col-xs-12">
                                <input type="text" id="namaItem" name="namaItem" required="required" value="<?php echo $r->namabarang; ?>" placeholder="ex. Papan Lembaran" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Unit</label>
                            <div class="col-md-8 col-sm-8 col-xs-12">
                                <input type="text" id="satuan" name="satuan" required="required" value="<?php echo $r->satuan; ?>" placeholder="ex. Pcs" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Price</label>
                            <div class="col-md-8 col-sm-8 col-xs-12">
                                <input type="text" id="inputHarga" name="inputHarga" required="required" value="<?php echo $r->hargapcs; ?>" placeholder="ex. 12500" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Jumlah Awal</label>
                            <div class="col-md-8 col-sm-8 col-xs-12">
                                <input type="text" id="inputJumlah" name="inputJumlah" required="required" placeholder="ex. 20" value="<?php echo $r->masuk; ?>" class="form-control">
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

    <!-- Tambah Jumlah Stok Modal -->
    <?php $id = 1;
    foreach ($hsl as $r) : $id++; ?>
    <div class="modal fade" id="addStok<?php echo $r->idbarang; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form class="form-horizontal form-label-left" method="POST" action="<?= site_url() . 'stok'; ?>">
                <div class="modal-content">
                    <div class="modal-header">
                        <div class="modal-title">
                            <h5>Tambah Stok Barang</h5>
                        </div>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="stokId" id="stokId" value="<?php echo $r->idbarang; ?>" readonly>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Jumlah Barang</label>
                            <div class="col-md-8 col-sm-8 col-xs-12">
                                <input type="text" id="jumlahItem" name="jumlahItem" required="required" placeholder="ex. 20" class="form-control">
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

    <!-- Edit Jumlah Stok Modal -->
    <?php $id = 1;
    foreach ($hsl as $r) : $id++; ?>
    <div class="modal fade" id="editStok<?php echo $r->idbarang; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form class="form-horizontal form-label-left" method="POST" action="<?= site_url() . 'usage'; ?>">
                <div class="modal-content">
                    <div class="modal-header">
                        <div class="modal-title">
                            <h5>Jumlah Barang Keluar</h5>
                        </div>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="stokId" id="stokId" value="<?php echo $r->idbarang; ?>|<?php echo $r->hargapcs; ?>" readonly>
                        <script type="text/javascript">
                            function name() {
                                var x = document.getElementById("stokId");
                                var y = document.getElementById("hargastok");
                                getBhn = x.value;
                                res = getBhn.split("|");
                                y.value = res[1];
                            }
                        </script>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Nama Karyawan</label>
                            <div class="col-md-8 col-sm-8 col-xs-12">
                                <select name="inputUser" id="inputUser" class="form-control" required="required">
                                    <?php foreach ($pkj as $staff) { ?>
                                    <option value="<?php echo $staff->idpekerja ?>"><?php echo $staff->namapkj ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Tanggal Ambil</label>
                            <div class="col-md-8 col-sm-8 col-xs-12">
                                <input type="date" id="inputTgl" name="inputTgl" required="required" placeholder="ex. 20" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Jumlah Barang</label>
                            <div class="col-md-8 col-sm-8 col-xs-12">
                                <input type="text" id="jumItem" name="jumItem" required="required" placeholder="ex. 20" class="form-control">
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

    <!-- Edit Jumlah Stok Rusak Modal -->
    <?php $id = 1;
    foreach ($hsl as $r) : $id++; ?>
    <div class="modal fade" id="brokeStok<?php echo $r->idbarang; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form class="form-horizontal form-label-left" method="POST" action="<?= site_url() . 'broken'; ?>">
                <div class="modal-content">
                    <div class="modal-header">
                        <div class="modal-title">
                            <h5>Jumlah Barang Rusak</h5>
                        </div>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="stokId" id="stokId" value="<?php echo $r->idbarang; ?>" readonly>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Jumlah Barang</label>
                            <div class="col-md-8 col-sm-8 col-xs-12">
                                <input type="text" id="jumlahRusak" name="jumlahRusak" required="required" placeholder="ex. 20" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Penyebab</label>
                            <div class="col-md-8 col-sm-8 col-xs-12">
                                <select name="penyebab" id="penyebab" class="form-control" required="required">
                                    <option value="Pembelian">Pembelian</option>
                                    <option value="Pemakaian">Pemakaian</option>
                                </select>
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
    foreach ($hsl as $rid) : $id++; ?>
    <div class="modal fade" id="del<?php echo $rid->idbarang; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form class="form-horizontal form-label-left" method="POST" action="<?= site_url() . 'item_del'; ?>">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Apakah Anda yakin?</h5>
                    </div>
                    <div class="modal-body">Dengan memilih "Delete" data akan otomatis terhapus.
                        <input type="hidden" name="id" id="id" value="<?php echo $rid->idbarang; ?>" readonly>
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
                'autoWihslh': false
            })
        })
    </script>
    </body>

    </html>