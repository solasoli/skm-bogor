<?php
$rnd=rand();
?>

<table>
             <tr>
              <td>
            <div class="box-body">
            <div class="form-group">
              <label for="unitlayanan" class="col-lg-25 control-label">Tahun</label>

              <select name="tahun" id="tahun" size="1" onchange="gantitahun();return false;" class="form-control select2" style="width: 100%;">
                  <?php
                  if (isset($_COOKIE['tahun']))
                  {$tahun=$_COOKIE['tahun'];} else {$tahun='';}
                  $this->db->select('*,year(tanggal_survey) as"thn"');
                  $this->db->from('survey');
                  $this->db->group_by('year(tanggal_survey)');
                  $this->db->join('kuesioner','kuesioner.id=survey.id_kuesioner');
                  $this->db->where('id_jenis_layanan',1);
                   $content1= $this->db->get();
                  $i=0;
                  foreach ($content1 -> result_array() as $row1): ?>
                <option <?=$tahun==$row1['thn']?'selected':''?> value="<?php echo $row1['thn']?>"><?php echo $row1['thn']?></option>
                <?php 
                  if ($i==0)
                  {
                    if ($tahun=='')
                      {
                        $tahun=$row1['thn'];
                      }
                  }
                  $i=$i+1;
                  endforeach ?>
              </select>
                </div>                
              </div>
            </div>
            </div></td>
            </tr>
</table>

    <br>

<script>
var myVar=setInterval(function(){myTimer()},1000);

   function createCookie(name,value,days) 
   {
      if (days) 
      {
         var date = new Date();
         date.setTime(date.getTime()+(days*24*60*60*1000));
         var expires = "; expires="+date.toGMTString();
      }
      else var expires = "";
      document.cookie = name+"="+value+expires+"; path=/";
   }

   function readCookie(name) 
   {
      var nameEQ = name + "=";
      var ca = document.cookie.split(';');
      for(var i=0;i < ca.length;i++) 
         {
         var c = ca[i];
         while (c.charAt(0)==' ') c = c.substring(1,c.length);
         if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
         }
      return null;
   }

   function eraseCookie(name) 
   {
      createCookie(name,"",-1);
   }

/* untuk reload */
function myTimer() 
{
   var a = readCookie("refreshdata<?php echo $rnd;?>");
   if (a>0)
   {
      a=a-1;
      createCookie('refreshdata<?php echo $rnd;?>',a,100);
   }

   if (a==0)
   {
      eraseCookie("refreshdata<?php echo $rnd;?>");
      location.reload();            
   }
}

function gantiunlay()
{
   createCookie('unlay',document.getElementById('unlay').value,21600);
   createCookie('refreshdata<?php echo $rnd;?>',1,100);
   eraseCookie('jenlay');
   eraseCookie('verkue');
}

function gantijenlay()
{
   createCookie('jenlay',document.getElementById('jenlay').value,21600);
   createCookie('refreshdata<?php echo $rnd;?>',1,100);
   eraseCookie('verkue');
}

function gantiverkue()
{
   createCookie('verkue',document.getElementById('verkue').value,21600);
   createCookie('refreshdata<?php echo $rnd;?>',1,100);
}
</script>





<script src="<?php echo base_url();?>assets/metronic5dflt/assets/vendors/base/vendors.bundle.js" type="text/javascript"></script>
<script type="text/javascript"> var DatatablesExtensionsResponsive= { init:function() { $("#m_table_1").DataTable( { responsive:!0, columnDefs:[ {} ] } ) } } ; jQuery(document).ready(function() {DatatablesExtensionsResponsive.init() } );</script>


    <div class="clearfix">
      <div class="pull-right tableTools-container"></div>
    </div>
    <div class="table-header">
      Grafik IKM Tingkat Kota
    </div>

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



<!-- ChartJS -->
<script src="<?php echo base_url();?>vendor/chart/chart.js"></script>
<script src="<?php echo base_url();?>vendor/chart/utils.js"></script>

<!-- page script -->
<script>
    var MONTHS = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
    var color = Chart.helpers.color;
    var barChartData = {
      labels: ['IKM'],
      datasets: 
      [

      <?php
            $content1= $this->db->query("select nama_unit, avg(ikm) as 'rikm' from survey left join kuesioner on kuesioner.id=survey.id_kuesioner left join jenis_layanan on jenis_layanan.id=kuesioner.id_jenis_layanan left join unit_layanan on unit_layanan.id=jenis_layanan.id_unit_layanan group by id_unit_layanan");
            $i=0;
            foreach ($content1 -> result_array() as $row1): ?>
            <?php $i=$i+1;?>

      {
        label: '<?php echo $row1['nama_unit']; ?>',
        <?=$i==1?'backgroundColor: color(window.chartColors.green).alpha(0.5).rgbString(),borderColor: window.chartColors.green,':''?>
        <?=$i==2?'backgroundColor: color(window.chartColors.red).alpha(0.5).rgbString(),borderColor: window.chartColors.red,':''?>
        <?=$i==3?'backgroundColor: color(window.chartColors.blue).alpha(0.5).rgbString(),borderColor: window.chartColors.blue,':''?>
        <?=$i==4?'backgroundColor: color(window.chartColors.yellow).alpha(0.5).rgbString(),borderColor: window.chartColors.yellow,':''?>
        <?=$i==5?'backgroundColor: color(window.chartColors.purple).alpha(0.5).rgbString(),borderColor: window.chartColors.purple,':''?>
        <?=$i==6?'backgroundColor: color(window.chartColors.cyan).alpha(0.5).rgbString(),borderColor: window.chartColors.cyan,':''?>
        borderWidth: 1,
        data: [<?=$row1['rikm']?>]
      },
            <?php endforeach ?>

      ]

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

