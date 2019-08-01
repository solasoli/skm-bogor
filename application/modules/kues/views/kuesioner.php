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
';
}

?>
<!-- ace styles
<link rel="stylesheet" href="<?php echo base_url();?>assets/ace/assets/css/ace.min.css" class="ace-main-stylesheet" id="main-ace-style" />
-->
<!-- Theme style -->

<table>
  <tr>
    <td>
      <div class="box-body">
        <div class="form-group">
          <label for="unitlayanan" class="col-lg-25 control-label">Unit Layanan</label>
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
    </td>
  </tr>
</table>

<table>
             <tr>
              <td>
            <div class="box-body">
            <div class="form-group">
                <label for="unitlayanan" class="col-lg-25 control-label">Jenis Layanan</label>  
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
</table>

<table>
             <tr>
              <td>
            <div class="box-body">
            <div class="form-group">
              <label for="unitlayanan" class="col-lg-25 control-label">Versi Kuesioner</label><select name="verkue" id="verkue" size="1" onchange="gantiverkue();return false;" class="form-control select2" style="width: 100%;">
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
            </tr>
</table>

<table>
<tr>
<?php
if ($jenlay!='')
{
?>
  <td>
    <div class="box-body">
    <div class="form-group">

    <a href="<?php echo base_url() ?>kues/kuesioner_add/<?php echo $jenlay ?>">
    <button type="button" class="btn btn-block btn-primary">Tambah</button>
    </a>

    </div>
    </div>
  </td>

  <?php
  if ($verkue!='')
  {
  ?>
    <td>
      <div class="box-body">
      <div class="form-group">

      <a href="<?php echo base_url() ?>kues/kuesioner_edit/<?php echo $verkue ?>">
        <button type="button" class="btn btn-block btn-primary">Ubah</button>
      </a>

      </div>
      </div>
    </td>

    <td>
        <div class="modal modal-warning fade" id="modal-warn">
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
      <div class="box-body">
      <div class="form-group">

      <a class="red" class="btn btn-warning" title="Delete"  data-toggle="modal" data-target="#modal-warn">
        <button type="button" class="btn btn-block btn-primary">Hapus</button>
      </a>

      </div>
      </div>
    </td>
<?php
  }
}
?>
</tr>


</table>

<table>
<tr>
  <td>
      <div class="box-body">
        <div class="form-group">
    <label for="unitlayanan" class="col-lg-25 control-label">Link Kuesioner :</label>  
    <br>
    <a href="<?php echo base_url() ?>responden/survey/<?php echo $verkue ?>" target="_blank">
      <label for="unitlayanan" class="col-lg-25 control-label"><?php 
      
      if ($verkue!='')
      {
          echo base_url(); ?>responden/survey/<?php echo $verkue;
      }
      ?></label>
    </a>
    </div>
    </div>
  </td>
</tr>
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
            <a href="<?php echo base_url() ?>kues/soal_add/<?php echo $verkue ?>">
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
        <table class="table table-striped- table-bordered table-hover table-checkable responsive no-wrap" id="m_table_1">
          <thead>
            <tr>
              <th rowspan="2" style="vertical-align:middle"><center>No</th>
              <th rowspan="2" style="vertical-align:middle"><center>Pertanyaan</th>
              <th colspan="4"><center>Pilihan</th>
              <th rowspan="2"></th>
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
                tambah($row['id'],'#',base_url().'kues/soal_edit/'.$row['id'],base_url().'kues/soal_delete/'.$row['id'],$row['pertanyaan']); ?>
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


<script src="<?php echo base_url();?>assets/metronic5dflt/assets/vendors/base/vendors.bundle.js" type="text/javascript"></script>
<script type="text/javascript"> var DatatablesExtensionsResponsive= { init:function() { $("#m_table_1").DataTable( { responsive:!0, columnDefs:[ {} ] } ) } } ; jQuery(document).ready(function() {DatatablesExtensionsResponsive.init() } );</script>

