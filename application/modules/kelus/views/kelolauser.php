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
              </td>

        <div class="modal modal-warning fade" id="modal-warning'.$id.'">
         <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">
                      Perhatian
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">
                        &times;
                      </span>
                    </button>
              </div>              <div class="modal-body">
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
        <table class="table table-striped- table-bordered table-hover table-checkable responsive no-wrap" id="m_table_1">
          <thead>
            <tr>
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

<script src="<?php echo base_url();?>assets/metronic5dflt/assets/vendors/base/vendors.bundle.js" type="text/javascript"></script>
<script type="text/javascript"> var DatatablesExtensionsResponsive= { init:function() { $("#m_table_1").DataTable( { responsive:!0, columnDefs:[ {} ] } ) } } ; jQuery(document).ready(function() {DatatablesExtensionsResponsive.init() } );</script>
