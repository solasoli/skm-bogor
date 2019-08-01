
<?php
function tambah($id,$det,$edit,$hps,$isinya)
{
  echo '
              <td>
                <div class="hidden-sm hidden-xs action-buttons">
                  <a class="blue" href="'.$det.'">
                    <i class="ace-icon fa fa-search-plus bigger-130"></i>
                  </a>
                  <a class="green" href="'.$edit.'">
                    <i class="ace-icon fa fa-pencil bigger-130"></i>
                  </a>
                  <a class="red" class="btn btn-warning" title="Delete"  data-toggle="modal" data-target="#modal-warning'.$id.'">
                    <i class="ace-icon fa fa-trash-o bigger-130"></i>
                  </a>
                </div>

                  <div class="hidden-md hidden-lg">
                  <div class="inline pos-rel">
                    <button class="btn btn-minier btn-yellow dropdown-toggle" data-toggle="dropdown" data-position="auto">
                      <i class="ace-icon fa fa-caret-down icon-only bigger-120"></i>
                    </button>

                    <ul class="dropdown-menu dropdown-only-icon dropdown-yellow dropdown-menu-right dropdown-caret dropdown-close">
                      <li>
                        <a href="'.$det.'" class="tooltip-info" data-rel="tooltip" title="View">
                          <span class="blue">
                            <i class="ace-icon fa fa-search-plus bigger-120"></i>
                          </span>
                        </a>
                      </li>

                      <li>
                        <a href="'.$edit.'" class="tooltip-success" data-rel="tooltip" title="Edit">
                          <span class="green">
                            <i class="ace-icon fa fa-pencil-square-o bigger-120"></i>
                          </span>
                        </a>
                      </li>

                      <li>
                        <a class="btn btn-warning" data-rel="tooltip" title="Delete"  data-toggle="modal" data-target="#modal-warning'.$id.'">
                          <span class="red">
                            <i class="ace-icon fa fa-trash-o bigger-120"></i>
                          </span>
                        </a>
                      </li>
                    </ul>
                  </div>
                </div>

        <div class="modal modal-warning fade" id="modal-warning'.$id.'">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Perhatian</h4>
              </div>
              <div class="modal-body">
                <p>Anda yakin akan menghapus data ini&hellip;<br><br>'.$isinya.'</p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
                <a href="'.$hps.'">
                <button type="button" class="btn btn-outline">Hapus</button>
                </a>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
              </td>
';
}

?>
<!-- ace styles -->
<link rel="stylesheet" href="<?php echo base_url();?>assets/ace/assets/css/ace.min.css" class="ace-main-stylesheet" id="main-ace-style" />
<!-- Theme style -->
<link rel="stylesheet" href="<?php echo base_url();?>assets/lte/dist/css/AdminLTE.min.css">

<div class="row">
  <div class="col-xs-12">
    <h3 class="header smaller lighter blue">Perencanaan dan Evaluasi</h3>
    <table>
    <tr>
      <td width="40">
          Tahun
      </td>
      <td>
          <select name="tahun" id="tahun" size="1" onchange="gantitahun();return false;">
          <?php
            if (isset($_COOKIE['thn']))
            {$thn=$_COOKIE['thn'];} else {$thn=date('Y');}
            $content1= $this->db->query('select tahun from task group by tahun');
            foreach ($content1 -> result_array() as $row1): ?>
          <option <?=$thn==$row1['tahun']?'selected':''?> value="<?php echo $row1['tahun']?>"><?php echo $row1['tahun']?></option>
          <?php endforeach ?>
          </select>                          
      </td>
    </tr>
    </table>
    <table>
    <tr>
      <td width="40">
          OPD
      </td>
      <td>
          <select name="opd" id="opd" size="1" onchange="gantiopd();return false;">
          <?php
            if (isset($_COOKIE['opd']))
            {$opd=$_COOKIE['opd'];} else {$opd='';}
            $this->db->from('opd');
            $content1= $this->db->get();
            foreach ($content1 -> result_array() as $row1): ?>
          <option <?=$opd==$row1['id']?'selected':''?> value="<?php echo $row1['id']?>"><?php echo $row1['nama_opd']?></option>
          <?php endforeach ?>
          </select>                          
      </td>
    </tr>
    </table>
    <table>
    <tr>
      <td width="40">
          Objek
      </td>
      <td>
          <?php
          if (isset($_COOKIE['objek']))
          {$objek=$_COOKIE['objek'];} else {$objek='Semua';}
          ?>
          <select name="objek" id="objek" size="1" onchange="gantiobjek();return false;">
          <option <?=$objek=='Semua'?'selected':''?> value="Semua">Semua</option>
          <option <?=$objek=='1'?'selected':''?> value="1">RKA</option>
          <option <?=$objek=='2'?'selected':''?> value="2">RENJA</option>
          <option <?=$objek=='3'?'selected':''?> value="3">RENSTRA</option>
          <option <?=$objek=='4'?'selected':''?> value="4">LAKIP</option>
          </select>                    
      </td>
      <td width="40" align="right">
          Jenis
      </td>
      <td>
          <?php
          if (isset($_COOKIE['jenis']))
          {$jenis=$_COOKIE['jenis'];} else {$jenis='Semua';}
          ?>
          <select name="jenis" id="jenis" size="1" onchange="gantijenis();return false;">
          <option <?=$jenis=='semua'?'selected':''?> value="Semua">Semua</option>
          <option <?=$jenis=='1'?'selected':''?> value="1">Ketersediaan Dana</option>
          <option <?=$jenis=='2'?'selected':''?> value="2">Ketersediaan Renstra</option>
          <option <?=$jenis=='3'?'selected':''?> value="3">Ketersediaan Kerangka Pendanaan</option>
          </select>                          
      </td>
      <td width="45" align="right">
          Status
      </td>
      <td>
          <?php
          if (isset($_COOKIE['status']))
          {$status=$_COOKIE['status'];} else {$status='Semua';}
          ?>
          <select name="status" id="status" size="1" onchange="gantistatus();return false;">
          <option <?=$status=='semua'?'selected':''?> value="Semua">Semua</option>
          <option <?=$status=='1'?'selected':''?> value="1">Selesai</option>
          <option <?=$status=='0'?'selected':''?> value="0">Belum Selesai</option>
          </select>                          
      </td>
    </tr>
    </table>
    <table>
    <tr><td>.</td></tr>
    <tr><td>
      <a href="<?php echo base_url() ?>dashboard/add_renev">
        <button type="button" class="btn btn-block btn-info btn">Tambah Data</button>
      </a>
    </td></tr></table>

    <div class="clearfix">
      <div class="pull-right tableTools-container"></div>
    </div>
    <div class="table-header">
      Data Perencanaan dan Evaluasi
    </div>

    <!-- div.table-responsive -->
    <!-- div.dataTables_borderWrap -->
    <?php
      $this->db->select('task.id,objek,jenis_task,evaluasi,tgl_create,tgl_update,is_selesai');
      $this->db->from('task');
      $this->db->join('objek_evaluasi','objek_evaluasi.id=task.id_objek','Left');
      $this->db->join('jenis_task','jenis_task.id=task.id_jenis','Left');
      if (isset($_COOKIE['status']))
      {
        $status=$_COOKIE['status'];
      }
      else
      {
        $status="Semua";
      }
      if (!($status=='Semua'||$status==''))
      {$this->db->where('is_selesai', $status);}
      if (!($jenis=='Semua'||$jenis==''))
      {$this->db->where('id_jenis', $jenis);}
      if (!($objek=='Semua'||$objek==''))
      {$this->db->where('id_objek', $objek);}
      if (!($opd=='Semua'||$opd==''))
      {$this->db->where('id_opd', $opd);}
      if ($_SESSION['is_staf']=='1')
      {$this->db->where('id_staf', $_SESSION['id_staf']);}
      else
      {
        if ($_SESSION['is_koor']=='1')
        {$this->db->where('id_koor', $_SESSION['id_koor']);}
        else
        {
          if ($_SESSION['is_pngjwb']=='1')
          {$this->db->where('id_pngjwb', $_SESSION['id_pngjwb']);}
        }
      }

      $content= $this->db->get();
    ?>
    <div>
        <table id="dynamic-table" class="table table-striped table-bordered table-hover">
          <thead>
            <tr>
              <th class="hidden">
                <label class="pos-rel">
                  <input type="checkbox" class="ace" />
                  <span class="lbl"></span>
                </label>
              </th>
              <th>No</th>
              <th>Objek</th>
              <th>Jenis</th>
              <th>Bahan Evaluasi</th>
              <th>Create</th>
              <th>Update</th>
              <th>Status</th>
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
              <td><?php echo $row['objek']?></td>
              <td><?php echo $row['jenis_task']?></td>
              <td><?php echo $row['evaluasi']?></td>
              <td><?php echo $row['tgl_create']?></td>
              <td><?php echo $row['tgl_update']?></td>
              <td><?php if($row['is_selesai']==1)
                {echo '
                <span class="label label-sm label-success arrowed arrowed-right">Sudah Selesai</span>
                ';}
                else
                {echo '
                <span class="label label-sm label-warning arrowed arrowed-left">Belum Selesai</span>
                ';}
                ?>
              </td>

                <?php tambah($row['id'],'#',base_url().'dashboard/edit_renev/'.$row['id'],base_url().'dashboard/delete_renev/'.$row['id'],$row['evaluasi']); ?>
            </tr>
    <?php endforeach ?>

          </tbody>
        </table>
      </div>
    </div>
  </div>




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

function gantistatus()
{
   createCookie('status',document.getElementById('status').value,21600);
   createCookie('refreshdata',1,100);
}

function gantijenis()
{
   createCookie('jenis',document.getElementById('jenis').value,21600);
   createCookie('refreshdata',1,100);
}

function gantiobjek()
{
   createCookie('objek',document.getElementById('objek').value,21600);
   createCookie('refreshdata',1,100);
}

function gantiopd()
{
   createCookie('opd',document.getElementById('opd').value,21600);
   createCookie('refreshdata',1,100);
}

function gantitahun()
{
   createCookie('thn',document.getElementById('tahun').value,21600);
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
            null, null,null, null, null, null,null,
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