    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Main content -->
        <section class="content">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-aqua">
                        <span class="info-box-icon"><i class="fa fa-dashboard"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Current Job</span>
                            <span class="info-box-number"> </span>

                            <div class="progress">
                                <div class="progress-bar" style="width: 70%"></div>
                            </div>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-green">
                        <span class="info-box-icon"><i class="fa fa-level-up"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">High Priority</span>
                            <span class="info-box-number"> </span>

                            <div class="progress">
                                <div class="progress-bar" style="width: 70%"></div>
                            </div>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-yellow">
                        <span class="info-box-icon"><i class="fa fa-hourglass-o"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Pending Job</span>
                            <span class="info-box-number"> </span>

                            <div class="progress">
                                <div class="progress-bar" style="width: 70%"></div>
                            </div>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-red">
                        <span class="info-box-icon"><i class="fa fa-optin-monster"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Kidddies</span>
                            <span class="info-box-number"> </span>

                            <div class="progress">
                                <div class="progress-bar" style="width: 100%"></div>
                            </div>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->

            <div class="row">
                <div class="col-md-12">
                    <div class="box box-default collapsed-box">
                        <div class="box-header with-border">
                            <h3 class="box-title">HIGH PRIORITY <small>Sedang Di Kerjakan</small></h3>

                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                                </button>
                            </div>
                            <!-- /.box-tools -->
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Kode Job</th>
                                        <th>Nama Job</th>
                                        <th>Tanggal</th>
                                        <th>Aktivitasnya</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- </?php foreach ($high as $row) { ?> -->
                                    <tr>
                                        <!-- <td></?php echo $row->jb ?></td>
                                        <td></?php echo $row->namajob ?></td>
                                        <td></?php echo $row->tanggal ?></td>
                                        <td></?php echo $row->aktivitasnya ?></td> -->
                                    </tr>
                                    <!-- </?php }; ?> -->
                                </tbody>
                            </table>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>
            </div>

            
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-default collapsed-box">
                        <div class="box-header with-border">
                            <h3 class="box-title">PENDING JOB</h3>

                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                                </button>
                            </div>
                            <!-- /.box-tools -->
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Nama Job</th>
                                        <th>Tanggal</th>
                                        <th>Aktivitasnya</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- </?php foreach ($pen as $row) { ?> -->
                                    <tr>
<!--                                         <td></?php echo $row->namajob ?></td>
                                        <td></?php echo $row->tanggal ?></td>
                                        <td></?php echo $row->aktivitasnya ?></td> -->
                                    </tr>
                                    <!-- </?php }; ?> -->
                                </tbody>
                            </table>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>
            </div>

            <!-- Main row -->
            <div class="row">
                <!-- Left col -->
                <section class="col-lg-12 connectedSortable">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">OMZET KIDDIE RIDE MINGGU INI</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Body Number</th>
                                        <th>Kiddies Name</th>
                                        <th>Omzet</th>
                                        <th>Share</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- </?php foreach ($kd as $row) { ?> -->
                                    <tr>
<!--                                         <td></?php echo $row->nobodyindex ?></td>
                                        <td></?php echo $row->namakiddienya ?></td>
                                        <td></?php echo 'Rp ' . number_format($row->omzet, 0, ',', '.') ?></td>
                                        <td></?php echo 'Rp ' . number_format($row->share, 0, ',', '.') ?></td> -->
                                    </tr>
                                    <!-- </?php }; ?> -->
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Body Number</th>
                                        <th>Kiddies Name</th>
                                        <th>Omzet</th>
                                        <th>Share</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </section>
                <!-- /.Left col -->

            </div>
            <!-- /.row (main row) -->

        </section>
        <!-- /.content -->
    </div>