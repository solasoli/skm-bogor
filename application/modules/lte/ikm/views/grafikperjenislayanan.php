<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <!-- DataTables -->
</head>
<body class="hold-transition skin-blue sidebar-mini">
    <!-- Main content -->
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Grafik IKM per Jenis Layanan</h3>
              <td><br><br>
              </td>
            </div>
            <!-- /.box-header -->
            <div class="box-body">

              <!-- BAR CHART -->
          <div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title">Bar Chart</h3>


            <div class="box-body">
              <div class="chart">
                <canvas id="canvas" style="height:230px"></canvas>
              </div>
            </div>
            <!-- /.box-body -->
          </div>

          <!-- /.box -->
        </div>
        <!-- /.col (RIGHT) -->
      </div>
      <!-- /.row -->


<!-- ChartJS -->
<script src="<?php echo base_url();?>vendor/chart/chart.js"></script>
<script src="<?php echo base_url();?>vendor/chart/utils.js"></script>

<!-- page script -->
<script>
    var MONTHS = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
    var color = Chart.helpers.color;
    var barChartData = {
      labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
      datasets: [{
        label: 'PBB',
        backgroundColor: color(window.chartColors.red).alpha(0.5).rgbString(),
        borderColor: window.chartColors.red,
        borderWidth: 1,
        data: [65, 59, 80, 81, 56, 55, 40]
      }, {
        label: 'BPHTB',
        backgroundColor: color(window.chartColors.blue).alpha(0.5).rgbString(),
        borderColor: window.chartColors.blue,
        borderWidth: 1,
        data: [15, 39, 50, 61, 26, 95, 50]
      }, {
        label: 'PDL',
        backgroundColor: color(window.chartColors.green).alpha(0.5).rgbString(),
        borderColor: window.chartColors.green,
        borderWidth: 1,
        data: [15, 39, 50, 61, 26, 95, 50]
      }]

    };

    window.onload = function() {
      var ctx = document.getElementById('canvas').getContext('2d');
      window.myBar = new Chart(ctx, {
        type: 'bar',
        data: barChartData,
        options: {
          responsive: true,
          legend: {
            position: 'top',
          },
          title: {
            display: false,
            text: 'Chart.js Bar Chart'
          }
        }
      });

    };


    var colorNames = Object.keys(window.chartColors);
  </script>


            </div>
            </div>
      </body>
</html>
