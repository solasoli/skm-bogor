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

    <table>
    <tr>
      <label for="unitlayanan" class="col-sm-2 control-label" style="text-align: left">Unit Layanan</label>
        <div class="col-sm-3">
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
    </tr>
    </table>
    
<div class="col-xs-12">    
    <table>
    <tr><td></td></tr>
    <tr><td>
      <div class="col-xs-15">
        <a href="<?php echo base_url() ?>kelus/kelus_add/<?php echo $unlay ?>">
        <button type="button" class="btn btn-block btn-primary">Tambah Data</button>
      </a>
      </br>
          </div>
    </td></tr></table>

    <div class="clearfix">
      <div class="pull-right tableTools-container"></div>
    </div>
            <br>
    <div class="callout callout-success">
      <font size="3">Daftar User</font>
    </div>

    <!-- div.table-responsive -->
    <!-- div.dataTables_borderWrap -->
    <?php
      $this->db->select('*');
      $this->db->from('users');
      $this->db->where('id_unit_layanan=',$unlay);     
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
              <th>User Login</th>
              <th>NIP</th>
              <th>Nama Lengkap</th>
              <th>Nick</th>
              <th>Nomor HP</th>
              <th>Is.Aktif</th>
              <th>Tanggal Create</th>
              <th>Terakhir Login</th>
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
              <td><?php echo $row['user_login']?></td>
              <td><?php echo $row['nip']?></td>
              <td><?php echo $row['nama_lengkap']?></td>
              <td><?php echo $row['nick']?></td>
              <td><?php echo $row['hp']?></td>
              <td><?php if ($row['is_aktif']==1){echo 'Aktif';}else{echo 'Tidak';}?></td>
              <td><?php echo $row['tgl_create']?></td>
              <td><?php echo $row['last_login']?></td>
                <?php tambah($row['id'],'#',base_url().'kelus/kelus_edit/'.$row['id'],base_url().'kelus/kelus_delete/'.$row['id'],$row['user_login'],$row['nip'],$row['nama_lengkap'],$row['nick'],$row['hp'],$row['is_aktif'],$row['tgl_create'],$row['last_login']); ?>
            </tr>
    <?php endforeach ?>

          </tbody>
        </table>
      </div>
    </div>
            </form>


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
            null, null, null, null, null, null, null, null, null, 
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