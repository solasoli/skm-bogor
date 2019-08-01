<?php
$rnd=rand();
?>

<?php
function tambah($id,$det,$edit,$hps,$isinya)
{
  echo '
              <td>
                <div class="hidden-sm hidden-xs action-buttons">
                  <!--
                  <a class="blue" href="'.$det.'">
                    <i class="ace-icon fa fa-search-plus bigger-130"></i>
                  </a>
                  -->
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
                      <!--
                      <li>
                        <a href="'.$det.'" class="tooltip-info" data-rel="tooltip" title="View">
                          <span class="blue">
                            <i class="ace-icon fa fa-search-plus bigger-120"></i>
                          </span>
                        </a>
                      </li>
                      -->

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
<!-- ace styles
<link rel="stylesheet" href="<?php echo base_url();?>assets/ace/assets/css/ace.min.css" class="ace-main-stylesheet" id="main-ace-style" />
-->
<!-- Theme style -->
<link rel="stylesheet" href="<?php echo base_url();?>assets/lte/dist/css/AdminLTE.min.css">
          <div class="box box-primary">
            <div class="box-header">
              <h3 class="box-title">Form Kuesioner</h3>
              <br><br>
              <table>
              <tr>
              <td>
            <div class="box-body">
            <div class="form-group">
            <div class="row">
            <div class="col-xs-12">
                  <label for="unitlayanan" class="col-lg-25 control-label">Unit Layanan</label></td>
                  <td>
                  <div class="col-lg-300">
                   <div class="form-group">
                  <select name="unlay" id="unlay" size="1" onchange="gantiunlay();return false;" class="form-control select2" style="width: 100%;">
                    <?php
                      if (isset($_COOKIE['unlay']))
                      {$unlay=$_COOKIE['unlay'];} else {$unlay='';}
                      $this->db->from('unit_layanan');
                      $content1= $this->db->get();
                      $i=0;                     
                      foreach ($content1 -> result_array() as $row1): ?>
                    <option <?=$unlay==$row1['id']?'selected':''?> value="<?php echo $row1['id']?>"><?php echo $row1['nama_unit']?></option>
                    <?php 
                      if ($i==0)
                      {
                        if ($unlay=='')
                          {
                            $unlay=$row1['id'];
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
             <tr>
              <td>
            <div class="box-body">
            <div class="form-group">
                  <label for="unitlayanan" class="col-lg-25 control-label">Jenis Layanan</label></td>
                  <td>
                  <div class="col-lg-300">
                   <div class="form-group">
                  <select name="jenlay" id="jenlay" size="1" onchange="gantijenlay();return false;" class="form-control select2" style="width: 100%;">
                    <?php
                      if (isset($_COOKIE['jenlay']))
                      {$jenlay=$_COOKIE['jenlay'];} else {$jenlay='';}
                      $this->db->from('jenis_layanan');
                      $this->db->where('id_unit_layanan',$unlay);
                      $content1= $this->db->get();
                      $i=0;
                      foreach ($content1 -> result_array() as $row1): ?>
                    <option <?=$jenlay==$row1['id']?'selected':''?> value="<?php echo $row1['id']?>"><?php echo $row1['jenis_layanan_diterima']?></option>
                    <?php 
                      if ($i==0)
                      {
                        if ($jenlay=='')
                          {
                            $jenlay=$row1['id'];
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
             <tr>
              <td>
            <div class="box-body">
            <div class="form-group">
              <label for="unitlayanan" class="col-lg-25 control-label">Versi Kuesioner</label></td>
                <td>
                  <div class="col-lg-30">
                   <div class="form-group">
                  <select name="verkue" id="verkue" size="1" onchange="gantiverkue();return false;" class="form-control select2" style="width: 100%;">
                  <?php
                    if (isset($_COOKIE['verkue']))
                    {$verkue=$_COOKIE['verkue'];} else {$verkue='';}
                    $this->db->from('kuesioner');
                    $this->db->where('id_jenis_layanan',$jenlay);
                    $content1= $this->db->get();
                    $i=0;
                    foreach ($content1 -> result_array() as $row1): ?>
                  <option 
                  <?php
                  if ($verkue==$row1['id'])
                  {echo 'selected';$versi=$row1['versi_kuesioner'];}
                  else
                  {echo '';}
                  ?>


                  value="<?php echo $row1['id']?>"><?php echo $row1['versi_kuesioner']?></option>
                  <?php 
                    if ($i==0)
                    {
                      if ($verkue=='')
                        {
                          $verkue=$row1['id'];
                          $versi=$row1['versi_kuesioner'];
                        }
                    }
                    $i=$i+1;
                    endforeach ?>
                  </select>  
                </div>                
              </div>
            </div>
            </div></td>

<?php
    if ($jenlay!='')
    {
?>
    <td>
    <div class="box-body">
      <div class="form-group">
      <div class="col-xs-30">    
      <a href="<?php echo base_url() ?>kues/kuesioner_add/<?php echo $jenlay ?>">
      <button type="button" class="btn btn-block btn-primary">Tambah</button>
      </a></div></div></div>
    </td>

<?php
    if ($verkue!='')
    {
?>
    <td>
    <div class="box-body">
    <div class="form-group">
    <div class="col-xs-30">
      <a href="<?php echo base_url() ?>kues/kuesioner_edit/<?php echo $verkue ?>">
        <button type="button" class="btn btn-block btn-primary">Ubah</button>
      </a></div></div></div>
    </td>

    <td>
    <div class="box-body">
    <div class="form-group">
    <div class="col-xs-30">

        <div class="modal modal-warning fade" id="modal-warn">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Perhatian</h4>
              </div>
              <div class="modal-body">
                <p>Anda yakin akan menghapus versi kuesioner ini&hellip;<br><br><?=$versi?></p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
                <a href="<?=base_url().'kues/kuesioner_delete/'.$verkue?>">
                <button type="button" class="btn btn-outline">Hapus</button>
                </a>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->



                  <a class="red" class="btn btn-warning" title="Delete"  data-toggle="modal" data-target="#modal-warn">
        <button type="button" class="btn btn-block btn-primary">Hapus</button>
                  </a>


</div></div></div>

    </td>

              <tr>
              <td>
            <div class="box-body">
            <div class="form-group">
            <div class="row">
            <div class="col-xs-12">
                  <label for="unitlayanan" class="col-lg-25 control-label">Link Kuesioner</label></td>
                  <td>
                  <div class="col-lg-300">
                   <div class="form-group">

                  <a href="<?php echo base_url() ?>responden/survey/<?php echo $verkue ?>">
                  <label for="unitlayanan" class="col-lg-25 control-label"><?php echo base_url() ?>responden/survey/<?php echo $verkue ?></label>
                  </a>
                  </td>
                </div>
              </div>
            </div>
            </div></td>
            </tr>
             <tr>

<?php
    }
  }
?>
            <tr>
    </table>

    <div class="box box-success">
        <div class="box-header with-border">
          <h3 class="box-title">Isi Kuesioner</h3>
        </div>
            <div class="form-group">

<?php
    if ($verkue!='')
    {
?>
    <td>
      <div class="box-body">
          <div class="col-xs-3">
            <a href="<?php echo base_url() ?>kues/tambahsoal_add/<?php echo $verkue ?>">
            <button type="button" class="btn btn-block btn-success"><font size="3">Tambah Soal</font></button>
            </a>
          </div>
      </div>
    </td>

<?php
    }
?>

    <div class="clearfix">
      <div class="pull-right tableTools-container-success"></div>
    </div>

    <br>
    <div class="callout callout-success">
      <font size="3">Soal Kuesioner</font>
    </div>

    <!-- div.table-responsive -->
    <!-- div.dataTables_borderWrap -->
    <?php
      $this->db->select('*');
      $this->db->from('pertanyaan');
      $this->db->where('id_kuesioner=',$verkue);     
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
              <th rowspan="2" style="vertical-align:middle"><center>No</th>
              <th rowspan="2" style="vertical-align:middle"><center>Pertanyaan</th>
              <th colspan="4"><center>Pilihan</th>
              <th></th>
            </tr>
            <tr>
              <th><center>A</th>
              <th><center>B</th>
              <th><center>C</th>
              <th><center>D</th>
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
              <td><?php echo $row1['pilihan']?></td>
              <?php endforeach ?>              
                <?php 
              }
                tambah($row['id'],'#',base_url().'jenlay/jenlay_edit/'.$row['id'],base_url().'jenlay/jenlay_delete/'.$row['id'],$row['pertanyaan']); ?>
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