  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 2.6.08
    </div>
    <strong>Copyright &copy;2021 Iventory1.0</strong> All rights
    reserved.
  </footer>

  <!-- Add the sidebar's background. This div must be placed
        immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
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
  <!-- datepicker -->
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
  <script>
    $(function() {
      /* ChartJS
       * -------
       * Here we will create a few charts using ChartJS
       */

      //--------------
      //- AREA CHART -
      //--------------

      // Get context with jQuery - using jQuery's .get() method.
      var areaChartCanvas = $('#salesChart').get(0).getContext('2d')
      // This will get the first returned node in the jQuery collection.
      var areaChart = new Chart(areaChartCanvas)

      var areaChartData = {
        labels: [],
        datasets: [{
          label: 'Kiddie Ride',
          fillColor: 'rgba(210, 214, 222, 1)',
          lineTension: 0,
          strokeColor: 'rgba(210, 214, 222, 1)',
          borderDash: [5, 5],
          pointColor: 'rgba(210, 214, 222, 1)',
          pointStrokeColor: '#c1c7d1',
          pointHighlightFill: '#fff',
          pointHighlightStroke: 'rgba(220,220,220,1)',
          data: []
        }]
      }

      var areaChartOptions = {
        //Boolean - If we should show the scale at all
        showScale: true,
        //Boolean - Whether grid lines are shown across the chart
        scaleShowGridLines: false,
        //String - Colour of the grid lines
        scaleGridLineColor: 'rgba(0,0,0,.05)',
        //Number - Width of the grid lines
        scaleGridLineWidth: 1,
        //Boolean - Whether to show horizontal lines (except X axis)
        scaleShowHorizontalLines: true,
        //Boolean - Whether to show vertical lines (except Y axis)
        scaleShowVerticalLines: true,
        //Boolean - Whether the line is curved between points
        bezierCurve: true,
        //Number - Tension of the bezier curve between points
        bezierCurveTension: 0.3,
        //Boolean - Whether to show a dot for each point
        pointDot: false,
        //Number - Radius of each point dot in pixels
        pointDotRadius: 4,
        //Number - Pixel width of point dot stroke
        pointDotStrokeWidth: 1,
        //Number - amount extra to add to the radius to cater for hit detection outside the drawn point
        pointHitDetectionRadius: 20,
        //Boolean - Whether to show a stroke for datasets
        datasetStroke: true,
        //Number - Pixel width of dataset stroke
        datasetStrokeWidth: 2,
        //Boolean - Whether to fill the dataset with a color
        datasetFill: true,
        //String - A legend template
        legendTemplate: '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<datasets.length; i++){%><li><span style="background-color:<%=datasets[i].lineColor%>"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>',
        //Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
        maintainAspectRatio: true,
        //Boolean - whether to make the chart responsive to window resizing
        responsive: true
      }

      //Create the line chart
      areaChart.Line(areaChartData, areaChartOptions)

      //-------------
      //- LINE CHART -
      //--------------
      var lineChartCanvas = $('#salesChart').get(0).getContext('2d')
      var lineChart = new Chart(lineChartCanvas)
      var lineChartOptions = areaChartOptions
      lineChartOptions.datasetFill = false
      lineChart.Line(areaChartData, lineChartOptions)
    })
  </script>
  </body>

  </html>