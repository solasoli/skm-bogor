<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>SKM Unit Layanan</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="../../bower_components/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="../../bower_components/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="../../bower_components/Ionicons/css/ionicons.min.css">
  <link rel="stylesheet" href="../../bower_components/bootstrap-daterangepicker/daterangepicker.css">
  <link rel="stylesheet" href="../../bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <link rel="stylesheet" href="../../plugins/iCheck/all.css">
  <link rel="stylesheet" href="../../plugins/timepicker/bootstrap-timepicker.min.css">
  <link rel="stylesheet" href="../../bower_components/select2/dist/css/select2.min.css">
  <link rel="stylesheet" href="../../dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="../../dist/css/skins/_all-skins.min.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<div class="wrapper">

  <header class="main-header">
    <section class="content-header">
      
      </section>
    </header>

    <!-- Main content -->
    <section class="content">

      <!-- SELECT2 EXAMPLE -->
      <div class="box box-primary">
        <div class="box-header with-border">
          <div class="form-group">           
           <div class="bootstrap-timepicker">
              <div class="form-group">
              <h2><center><b>

        <?php
    $this->db->where('kuesioner.id', $id);
    $this->db->join('jenis_layanan', 'jenis_layanan.id=kuesioner.id_jenis_layanan');
    $this->db->join('unit_layanan', 'unit_layanan.id=jenis_layanan.id_unit_layanan');
    $content = $this->db->get('kuesioner');


        foreach ($content -> result_array() as $key):
        $unlay=$key['nama_unit'];
        $idkues=$id;
        $jenlay=$key['jenis_layanan_diterima'];
        endforeach;


        ?>


        KUESIONER SURVEI KEPUASAN MASYARAKAT (SKM)</h2></center>
        <P><center><font size="3">PADA UNIT LAYANAN <?=strtoupper($unlay)?> KOTA BOGOR &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font></center></b>
        
                <br><br>

                <div class="col-md-6">
                  <label><font size="3">Jam Survey:</font></label>
                    <div class="input-group">
                      <input type="text" class="form-control timepicker" value='<?=date('H:i:s');?>'>
                        <div class="input-group-addon">
                          <i class="fa fa-clock-o"></i>
                        </div>
                    </div>
                </div>

                <label><font size="3">Tanggal Survey:</font></label>
                  <div class="input-group date">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                      <input type="text" class="form-control pull-right" id="tgl" value='<?=date('d-m-Y');?>'>
                  </div>
              </div>               
            </div>
            <b><font size="4"><center>PROFIL</center></font></b>
            <div class="form-group">
            <div class="col-md-6">
              <label><font size="3">Jenis Kelamin</font><br>
                <input type="radio" id="r1" name="r1" Value="L" class="minimal" checked> &nbsp;Laki-laki &nbsp;&nbsp;
                <input type="radio" id="r1" name="r1" Value="P" class="minimal"> &nbsp;Perempuan
              </label>
            </div></div>

            <div class="col-md-6">
            <div class="form-group">
              <label><font size="3">Pendidikan</font><br>
                <input type="radio" id="r2" name="r2" Value="1" class="minimal" checked> &nbsp;SD &nbsp;&nbsp;
                <input type="radio" id="r2" name="r2" Value="2" class="minimal"> &nbsp;SMP &nbsp;&nbsp;
                <input type="radio" id="r2" name="r2" Value="3" class="minimal"> &nbsp;SMA/K &nbsp;&nbsp;
                <input type="radio" id="r2" name="r2" Value="4" class="minimal"> &nbsp;D1 &nbsp;&nbsp;
                <input type="radio" id="r2" name="r2" Value="5" class="minimal"> &nbsp;D2 &nbsp;&nbsp;
                <input type="radio" id="r2" name="r2" Value="6" class="minimal"> &nbsp;D3 &nbsp;&nbsp;
                <input type="radio" id="r2" name="r2" Value="7" class="minimal"> &nbsp;S1 &nbsp;&nbsp;
                <input type="radio" id="r2" name="r2" Value="8" class="minimal"> &nbsp;S2 &nbsp;&nbsp;
                <input type="radio" id="r2" name="r2" Value="9" class="minimal"> &nbsp;S3 &nbsp;&nbsp;
              </label>
            </div></div>

            <div class="col-md-6">
            <div class="form-group">
              <label><font size="3">Pekerjaan</font><br>
                <input type="radio" id="r3" name="r3" Value="1" class="minimal" checked> &nbsp;PNS &nbsp;&nbsp;
                <input type="radio" id="r3" name="r3" Value="2" class="minimal"> &nbsp;TNI &nbsp;&nbsp;
                <input type="radio" id="r3" name="r3" Value="3" class="minimal"> &nbsp;POLRI &nbsp;&nbsp;
                <input type="radio" id="r3" name="r3" Value="4" class="minimal"> &nbsp;SWASTA &nbsp;&nbsp;
                <input type="radio" id="r3" name="r3" Value="5" class="minimal"> &nbsp;WIRAUSAHA &nbsp;&nbsp;
                <br><input type="radio" id="r3" name="r3" Value="6" class="minimal"> &nbsp;LAINNYA &nbsp;&nbsp;
              </label>
            </div></div>

            <div class="col-md-6">
            <div class="form-horizontal">
              <label><font size="3">Jenis layanan yang diterima : <?=$jenlay?></font></label>
            </div></div>
          </div>
        </div>
          <div class="box box-primary">
            <div class="box-header with-border">
              <center><h3 class="box-title"><b>PENDAPAT RESPONDEN TENTANG PELAYANAN</center></h3></b>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form">
              <div class="box-body">
                <?php
                  $this->db->select('*');
                  $this->db->where('id_kuesioner',$idkues);
                  $this->db->from('pertanyaan');
                  $content= $this->db->get();
                ?>
              <table id="dynamic-table" class="table table-striped table-bordered table-hover">
                <thead>
                  <tr>
                    <th class="hidden">
                      <label class="pos-rel">
                        <input type="checkbox" class="ace" />
                        <span class="lbl"></span>
                      </label>
                    </th>
                    <th rowspan="2" style="vertical-align:middle"><center>No</th>
                    <th rowspan="2" style="vertical-align:middle"><center>Pertanyaan</th>
                    <th colspan="4"><center>Pilihan</th>
                    <th></th>
                  </tr>
                  
                </thead>

                <tbody>
                  <?php 
                    $no=1;
                    foreach ($content -> result_array() as $row): ?>
                  <tr>
                    <td class="hidden">
                      <label class="pos-rel">
                        <input type="checkbox" class="ace" />
                        <span class="lbl"></span>
                      </label>
                    </td>
                    <td><?php echo $no; $no=$no+1;?>.</td>
                    <td><?php echo $row['pertanyaan']?></td>
                    <?php
                    for ($i=1;$i<=4;$i++)
                    {
                    $this->db->select('*');
                    $this->db->from('pilihan');
                    $this->db->where('id_pertanyaan',$row['id']);     
                    $this->db->where('bobot',$i);     
                    $content1= $this->db->get();
                    foreach ($content1 -> result_array() as $row1): ?>
                    <td><input type="radio" name="Pil<?=$no?>" id="Pil<?=$no?>" value="<?=$row1['id']?>" checked>&nbsp;&nbsp;&nbsp;<?php echo $row1['pilihan']?></td>
                    <?php endforeach ?>              
                      <?php 
                    }
                       ?>
                  </tr>
                    <?php endforeach ?> 
                </tbody>
              </table>

            </div>
          </div>
        </div>
      </div>
      <div class="col-xs-2">
        <a href="<?php echo base_url() ?>">
          <button type="button" class="btn btn-block btn-primary">Submit</button>
        </a>
          </br>
      </div>      
                </div>
            </form>
          </div>

      </div>
    </form>
      </div>
      <!-- /.tab-pane -->
    </div>

<script src="../../bower_components/jquery/dist/jquery.min.js"></script>
<script src="../../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="../../bower_components/select2/dist/js/select2.full.min.js"></script>
<script src="../../plugins/input-mask/jquery.inputmask.js"></script>
<script src="../../plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="../../plugins/input-mask/jquery.inputmask.extensions.js"></script>
<script src="../../bower_components/moment/min/moment.min.js"></script>
<script src="../../bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<script src="../../bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<script src="../../bower_components/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js"></script>
<script src="../../plugins/timepicker/bootstrap-timepicker.min.js"></script>
<script src="../../bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<script src="../../plugins/iCheck/icheck.min.js"></script>
<script src="../../bower_components/fastclick/lib/fastclick.js"></script>
<script src="../../dist/js/adminlte.min.js"></script>
<script src="../../dist/js/demo.js"></script>
<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

    //Datemask dd/mm/yyyy
    $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
    //Datemask2 mm/dd/yyyy
    $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
    //Money Euro
    $('[data-mask]').inputmask()

    //Date range picker
    $('#reservation').daterangepicker()
    //Date range picker with time picker
    $('#reservationtime').daterangepicker({ timePicker: true, timePickerIncrement: 30, format: 'MM/DD/YYYY h:mm A' })
    //Date range as a button
    $('#daterange-btn').daterangepicker(
      {
        ranges   : {
          'Today'       : [moment(), moment()],
          'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
          'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
          'Last 30 Days': [moment().subtract(29, 'days'), moment()],
          'This Month'  : [moment().startOf('month'), moment().endOf('month')],
          'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        startDate: moment().subtract(29, 'days'),
        endDate  : moment()
      },
      function (start, end) {
        $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
      }
    )

    //Date picker
    $('#datepicker').datepicker({
      autoclose: true
    })

    //iCheck for checkbox and radio inputs
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass   : 'iradio_minimal-blue'
    })
    //Red color scheme for iCheck
    $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
      checkboxClass: 'icheckbox_minimal-red',
      radioClass   : 'iradio_minimal-red'
    })
    //Flat red color scheme for iCheck
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-green',
      radioClass   : 'iradio_flat-green'
    })

    //Timepicker
    $('.timepicker').timepicker({
      showInputs: false
    })
  })
</script>
</body>
</html>

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
   var a = readCookie("refreshdata");
   if (a>0)
   {
      a=a-1;
      createCookie('refreshdata',a,100);
   }

   if (a==0)
   {
      eraseCookie("refreshdata");
      location.reload();            
   }
}

function gantiunlay()
{
   createCookie('unlay',document.getElementById('unlay').value,21600);
   createCookie('refreshdata',1,100);
   eraseCookie('jenlay');
   eraseCookie('verkue');
}

function gantijenlay()
{
   createCookie('jenlay',document.getElementById('jenlay').value,21600);
   createCookie('refreshdata',1,100);
   eraseCookie('verkue');
}

function gantiverkue()
{
   createCookie('verkue',document.getElementById('verkue').value,21600);
   createCookie('refreshdata',1,100);
}
</script>

    <!-- inline scripts related to this page -->
    <script type="text/javascript">
      jQuery(function($) {
        //initiate dataTables plugin
        var myTable = 
        $('#dynamic-table')
        .DataTable( {
          bAutoWidth: false,
          "aoColumns": [
            { "bSortable": false },
            null, null,  null,  null,  null,  null, 
            { "bSortable": false }
          ],
          "aaSorting": [],
          
          select: {
            style: 'multi'
          }
          } );      
        
        
        $.fn.dataTable.Buttons.defaults.dom.container.className = 'dt-buttons btn-overlap btn-group btn-overlap';
        
        new $.fn.dataTable.Buttons( myTable, {
          buttons: [
            {
            "extend": "colvis",
            "text": "<i class='fa fa-search bigger-110 blue'></i> <span class='hidden'>Show/hide columns</span>",
            "className": "btn btn-white btn-primary btn-bold",
            columns: ':not(:first):not(:last)'
            },
            {
            "extend": "copy",
            "text": "<i class='fa fa-copy bigger-110 pink'></i> <span class='hidden'>Copy to clipboard</span>",
            "className": "btn btn-white btn-primary btn-bold"
            },
            {
            "extend": "csv",
            "text": "<i class='fa fa-database bigger-110 orange'></i> <span class='hidden'>Export to CSV</span>",
            "className": "btn btn-white btn-primary btn-bold"
            },
            {
            "extend": "excel",
            "text": "<i class='fa fa-file-excel-o bigger-110 green'></i> <span class='hidden'>Export to Excel</span>",
            "className": "btn btn-white btn-primary btn-bold"
            },
            {
            "extend": "pdf",
            "text": "<i class='fa fa-file-pdf-o bigger-110 red'></i> <span class='hidden'>Export to PDF</span>",
            "className": "btn btn-white btn-primary btn-bold"
            },
            {
            "extend": "print",
            "text": "<i class='fa fa-print bigger-110 grey'></i> <span class='hidden'>Print</span>",
            "className": "btn btn-white btn-primary btn-bold",
            autoPrint: false,
            message: 'This print was produced using the Print button for DataTables'
            }     
          ]
        } );
        myTable.buttons().container().appendTo( $('.tableTools-container') );
        
        //style the message box
        var defaultCopyAction = myTable.button(1).action();
        myTable.button(1).action(function (e, dt, button, config) {
          defaultCopyAction(e, dt, button, config);
          $('.dt-button-info').addClass('gritter-item-wrapper gritter-info gritter-center white');
        });
        
        
        var defaultColvisAction = myTable.button(0).action();
        myTable.button(0).action(function (e, dt, button, config) {
          
          defaultColvisAction(e, dt, button, config);
          
          
          if($('.dt-button-collection > .dropdown-menu').length == 0) {
            $('.dt-button-collection')
            .wrapInner('<ul class="dropdown-menu dropdown-light dropdown-caret dropdown-caret" />')
            .find('a').attr('href', '#').wrap("<li />")
          }
          $('.dt-button-collection').appendTo('.tableTools-container .dt-buttons')
        });
      
        ////
      
        setTimeout(function() {
          $($('.tableTools-container')).find('a.dt-button').each(function() {
            var div = $(this).find(' > div').first();
            if(div.length == 1) div.tooltip({container: 'body', title: div.parent().text()});
            else $(this).tooltip({container: 'body', title: $(this).text()});
          });
        }, 500);
        
        myTable.on( 'select', function ( e, dt, type, index ) {
          if ( type === 'row' ) {
            $( myTable.row( index ).node() ).find('input:checkbox').prop('checked', true);
          }
        } );
        myTable.on( 'deselect', function ( e, dt, type, index ) {
          if ( type === 'row' ) {
            $( myTable.row( index ).node() ).find('input:checkbox').prop('checked', false);
          }
        } );
      
        /////////////////////////////////
        //table checkboxes
        $('th input[type=checkbox], td input[type=checkbox]').prop('checked', false);
        
        //select/deselect all rows according to table header checkbox
        $('#dynamic-table > thead > tr > th input[type=checkbox], #dynamic-table_wrapper input[type=checkbox]').eq(0).on('click', function(){
          var th_checked = this.checked;//checkbox inside "TH" table header
          
          $('#dynamic-table').find('tbody > tr').each(function(){
            var row = this;
            if(th_checked) myTable.row(row).select();
            else  myTable.row(row).deselect();
          });
        });
        
        //select/deselect a row when the checkbox is checked/unchecked
        $('#dynamic-table').on('click', 'td input[type=checkbox]' , function(){
          var row = $(this).closest('tr').get(0);
          if(this.checked) myTable.row(row).deselect();
          else myTable.row(row).select();
        });
      
        $(document).on('click', '#dynamic-table .dropdown-toggle', function(e) {
          e.stopImmediatePropagation();
          e.stopPropagation();
          e.preventDefault();
        });
        
        
        //And for the first simple table, which doesn't have TableTools or dataTables
        //select/deselect all rows according to table header checkbox
        var active_class = 'active';
        $('#simple-table > thead > tr > th input[type=checkbox]').eq(0).on('click', function(){
          var th_checked = this.checked;//checkbox inside "TH" table header
          
          $(this).closest('table').find('tbody > tr').each(function(){
            var row = this;
            if(th_checked) $(row).addClass(active_class).find('input[type=checkbox]').eq(0).prop('checked', true);
            else $(row).removeClass(active_class).find('input[type=checkbox]').eq(0).prop('checked', false);
          });
        });
        
        //select/deselect a row when the checkbox is checked/unchecked
        $('#simple-table').on('click', 'td input[type=checkbox]' , function(){
          var $row = $(this).closest('tr');
          if($row.is('.detail-row ')) return;
          if(this.checked) $row.addClass(active_class);
          else $row.removeClass(active_class);
        });
      
      
        /********************************/
        //add tooltip for small view action buttons in dropdown menu
        $('[data-rel="tooltip"]').tooltip({placement: tooltip_placement});
        
        //tooltip placement on right or left
        function tooltip_placement(context, source) {
          var $source = $(source);
          var $parent = $source.closest('table')
          var off1 = $parent.offset();
          var w1 = $parent.width();
      
          var off2 = $source.offset();
          //var w2 = $source.width();
      
          if( parseInt(off2.left) < parseInt(off1.left) + parseInt(w1 / 2) ) return 'right';
          return 'left';
        }
        
        /***************/
        $('.show-details-btn').on('click', function(e) {
          e.preventDefault();
          $(this).closest('tr').next().toggleClass('open');
          $(this).find(ace.vars['.icon']).toggleClass('fa-angle-double-down').toggleClass('fa-angle-double-up');
        });
        /***************/
      })
    </script>