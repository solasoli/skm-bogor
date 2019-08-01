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




<table>
  <tr>
    <td>
      <div class="box-body">
        <div class="form-group">
          <label for="unitlayanan" class="col-lg-25 control-label">Unit Layanan</label>
          <select 

            <?php
              if ($_SESSION['skm_isadmin']!=1)
              {
          echo '
          style="background-color: #eaebed;"
          disabled';
              }        
            ?>
          name="unlay" id="unlay" size="1" onchange="gantiunlay();return false;" class="form-control select2" style="width: 100%;">
            <?php
                      if (isset($_COOKIE['unlay']))
                      {$unlay=$_COOKIE['unlay'];} else {$unlay='';}
                      $this->db->from('unit_layanan');
                      $content1= $this->db->get();
                      $i=0;                     
                      foreach ($content1 -> result_array() as $row1): ?>
            <option 
            <?php
              if ($_SESSION['skm_isadmin']==1)
              {
                if($unlay==$row1['id'])
                {echo 'selected';}
              }
              else
              {
                if ($_SESSION['skm_idunitlayanan']==$row1['id'])
                {$unlay=$row1['id']; echo 'selected';}
              }
            ?>
             value="<?php echo $row1['id']?>"><?php echo $row1['nama_unit']?></option>
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
              <label for="unitlayanan" class="col-lg-25 control-label">Versi Kuesioner</label>
              <select name="verkue" id="verkue" size="1" onchange="gantiverkue();return false;" class="form-control select2" style="width: 100%;">
                  <?php
                    if (isset($_COOKIE['verkue']))
                    {$verkue=$_COOKIE['verkue'];} else {$verkue='';}
                  ?>
                  <option <?=$verkue==''?'selected':''?> value="">Semua</option>
                  <?php
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
                  $this->db->where('id_jenis_layanan',$jenlay);
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

<table>
             <tr>
              <td>
            <div class="box-body">
            <div class="form-group">
              <label for="unitlayanan" class="col-lg-25 control-label">Bulan</label>

              <select name="bulan" id="bulan" size="1" onchange="gantibulan();return false;" class="form-control select2" style="width: 100%;">
                  <?php
                  if (isset($_COOKIE['bulan']))
                  {$bulan=$_COOKIE['bulan'];} else {$bulan='';}
                  $this->db->select('*,year(tanggal_survey) as"thn"');
                  $this->db->from('survey');
                  $this->db->group_by('year(tanggal_survey)');
                  $this->db->join('kuesioner','kuesioner.id=survey.id_kuesioner');
                  $this->db->where('id_jenis_layanan',$jenlay);
                  $content1= $this->db->get();
                  $i=0;
                  foreach ($content1 -> result_array() as $row1):  
                  if ($i==0)
                  {
                  ?>
                    <option <?=$bulan==''?'selected':''?> value="">Semua</option>
                    <option <?=$bulan==1?'selected':''?> value="1">Januari</option>
                    <option <?=$bulan==2?'selected':''?> value="2">Februari</option>
                    <option <?=$bulan==3?'selected':''?> value="3">Maret</option>
                    <option <?=$bulan==4?'selected':''?> value="4">April</option>
                    <option <?=$bulan==5?'selected':''?> value="5">Mei</option>
                    <option <?=$bulan==6?'selected':''?> value="6">Juni</option>
                    <option <?=$bulan==7?'selected':''?> value="7">Juli</option>
                    <option <?=$bulan==8?'selected':''?> value="8">Agustus</option>
                    <option <?=$bulan==9?'selected':''?> value="9">September</option>
                    <option <?=$bulan==10?'selected':''?> value="10">Oktober</option>
                    <option <?=$bulan==11?'selected':''?> value="11">November</option>
                    <option <?=$bulan==12?'selected':''?> value="12">Desember</option>
                  <?php
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

    <div class="clearfix">
      <div class="pull-right tableTools-container"></div>
    </div>
    

    <!-- div.table-responsive -->
    <!-- div.dataTables_borderWrap -->
    <div>
        <table class="table table-striped- table-bordered table-hover table-checkable responsive no-wrap" id="m_table_1">
          <thead>
            <tr>
              <th rowspan="2" style="vertical-align:middle"><center>No</th>
              <th colspan="9" style="vertical-align:middle"><center>Unsur Pelayanan</th>
              <th rowspan="2" style="vertical-align:middle"><center>Jumlah</th>
            </tr>
            <tr>
              <th><center>U1</th>
              <th><center>U2</th>
              <th><center>U3</th>
              <th><center>U4</th>
              <th><center>U5</th>
              <th><center>U6</th>
              <th><center>U7</th>
              <th><center>U8</th>
              <th><center>U9</th>
            </tr>
          </thead>

          <tbody>
    <?php
              $nilai[1]=0;
              $nilai[2]=0;
              $nilai[3]=0;
              $nilai[4]=0;
              $nilai[5]=0;
              $nilai[6]=0;
              $nilai[7]=0;
              $nilai[8]=0;
              $nilai[9]=0;
              $no=1;

        if($verkue!='')
        {
          $this->db->select('*,survey.id as "sid"');
          $this->db->from('survey');
                $this->db->join('kuesioner','survey.id_kuesioner=kuesioner.id');
                $this->db->join('jenis_layanan','kuesioner.id_jenis_layanan=jenis_layanan.id');
                $this->db->where('year(tanggal_survey)='.$tahun);
                if ($bulan!='')
                {
                  $this->db->where('month(tanggal_survey)='.$bulan);
                }
                if ($verkue!='')
                {
                  $this->db->where('kuesioner.id='.$verkue);
                }
                $this->db->where('id_jenis_layanan='.$jenlay);


          $content= $this->db->get();
          $no=0;
          foreach ($content -> result_array() as $row): ?>
            <tr>
              <td><?php echo $no+1; $no=$no+1;?>.</td>
              <?php
              for ($u=1;$u<=9;$u++)
              {
                $this->db->select('sum(bobot) as "bobots",count(*) as "byk"');
                $this->db->from('jawaban_survey');
                $this->db->join('pilihan','jawaban_survey.id_pilihan=pilihan.id');
                $this->db->join('pertanyaan','jawaban_survey.id_pertanyaan=pertanyaan.id');
                $this->db->where('id_survey',$row['sid']);
                $this->db->where('id_unsur_pelayanan',$u);
                $this->db->group_by('id_unsur_pelayanan');
                $content1= $this->db->get();
                  foreach ($content1 -> result_array() as $row1): ?>
                  <td><center><?php echo ($row1['bobots']/$row1['byk']) ?></td>
                  <?php 
                  $nilai[$u]=$nilai[$u]+($row1['bobots']/$row1['byk']);
                  endforeach ?>
                <?php 
              } ?>
              <td></td>
            </tr>
    <?php endforeach ?>
    <?php 
        }    

        if ($no==0)
        {$no=1;}
    ?>

          </tbody>
          <tfoot>
                <tr>
                  <th><center>E Nilai/<br>Unsur</th>
                  <th><center><?=$nilai[1]?></th>
                  <th><center><?=$nilai[2]?></th>
                  <th><center><?=$nilai[3]?></th>
                  <th><center><?=$nilai[4]?></th>
                  <th><center><?=$nilai[5]?></th>
                  <th><center><?=$nilai[6]?></th>
                  <th><center><?=$nilai[7]?></th>
                  <th><center><?=$nilai[8]?></th>
                  <th><center><?=$nilai[9]?></th>
                  <th></th>
                </tr>
                <tr>
                  <th><center>NRR/<br>Unsur</th>
                  <th><center><?=$nilai[1]/$no?></th>
                  <th><center><?=$nilai[2]/$no?></th>
                  <th><center><?=$nilai[3]/$no?></th>
                  <th><center><?=$nilai[4]/$no?></th>
                  <th><center><?=$nilai[5]/$no?></th>
                  <th><center><?=$nilai[6]/$no?></th>
                  <th><center><?=$nilai[7]/$no?></th>
                  <th><center><?=$nilai[8]/$no?></th>
                  <th><center><?=$nilai[9]/$no?></th>
                  <th></th>
                </tr>
                <tr>
                  <th><center>NRR<br>Tertimbang/<br>Unsur</th>
                  <th><center><?=$nilai[1]/$no*0.111?></th>
                  <th><center><?=$nilai[2]/$no*0.111?></th>
                  <th><center><?=$nilai[3]/$no*0.111?></th>
                  <th><center><?=$nilai[4]/$no*0.111?></th>
                  <th><center><?=$nilai[5]/$no*0.111?></th>
                  <th><center><?=$nilai[6]/$no*0.111?></th>
                  <th><center><?=$nilai[7]/$no*0.111?></th>
                  <th><center><?=$nilai[8]/$no*0.111?></th>
                  <th><center><?=$nilai[9]/$no*0.111?></th>
                  <th>
                  <?php
                    $jml=0;
                    for ($i=1;$i<=9;$i++)
                    {
                      $jml=$jml+($nilai[$i]/$no*0.111);
                    }
                    $ikm=$jml*25;
                    echo $jml;
                  ?>
                  </th>
                </tr>
                <tr>
                  <th colspan="10"><center>IKM UNIT LAYANAN</th>
                  <th><?=$ikm?></th>
                </tr>
                </tfoot>
        </table>
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
   eraseCookie('tahun');
   eraseCookie('bulan');
}

function gantijenlay()
{
   createCookie('jenlay',document.getElementById('jenlay').value,21600);
   createCookie('refreshdata<?php echo $rnd;?>',1,100);
   eraseCookie('verkue');
   eraseCookie('tahun');
   eraseCookie('bulan');
}

function gantiverkue()
{
   createCookie('verkue',document.getElementById('verkue').value,21600);
   createCookie('refreshdata<?php echo $rnd;?>',1,100);
   eraseCookie('tahun');
   eraseCookie('bulan');
}

function gantitahun()
{
   createCookie('tahun',document.getElementById('tahun').value,21600);
   createCookie('refreshdata<?php echo $rnd;?>',1,100);
   eraseCookie('bulan');
}

function gantibulan()
{
   createCookie('bulan',document.getElementById('bulan').value,21600);
   createCookie('refreshdata<?php echo $rnd;?>',1,100);
}

</script>

<script src="<?php echo base_url();?>assets/metronic5dflt/assets/vendors/base/vendors.bundle.js" type="text/javascript"></script>
<script type="text/javascript"> var DatatablesExtensionsResponsive= { init:function() { $("#m_table_1").DataTable( { responsive:!0, columnDefs:[ {} ] } ) } } ; jQuery(document).ready(function() {DatatablesExtensionsResponsive.init() } );</script>
