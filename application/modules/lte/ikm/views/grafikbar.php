    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-6">

          <!-- BAR CHART -->
          <div class="box box-success">

            <div class="box-header with-border">
              <h3 class="box-title">Bar Chart</h3>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>

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
    </section>
    <!-- /.content -->


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
        label: 'Elektronik',
        backgroundColor: color(window.chartColors.red).alpha(0.5).rgbString(),
        borderColor: window.chartColors.red,
        borderWidth: 1,
        data: [65, 59, 80, 81, 56, 55, 40]
      }, {
        label: 'ABC',
        backgroundColor: color(window.chartColors.blue).alpha(0.5).rgbString(),
        borderColor: window.chartColors.blue,
        borderWidth: 1,
        data: [15, 39, 50, 61, 26, 95, 50]
      }, {
        label: 'ABC1',
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
