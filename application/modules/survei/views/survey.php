<?php
$rnd=rand();
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

            <br><br>
              <div class="callout callout-info">
             <font size="3">History Survei</font>
              </div>
              
              <?php
                $this->db->select('*');
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
              ?>

              <div>
              <table class="table table-striped- table-bordered table-hover table-checkable responsive no-wrap" id="m_table_1">

                <thead>
                <tr>
                  <th rowspan="2" style="vertical-align:middle"><center><p style="text-align: center">No.</p></th>
                  <th rowspan="2" style="vertical-align:middle"><center><p style="text-align: center">Tanggal<br>Survey</p></th>
                  <th rowspan="2" style="vertical-align:middle"><center><p style="text-align: center"> Jam</p></th>
                  <th rowspan="2" style="vertical-align:middle"><center><p style="text-align: center">Versi<br>Kuesioner</p></th>
                  <th colspan="5" style="vertical-align:middle"><center>Responden</th>
                  <th rowspan="2" style="vertical-align:middle"><center><p style="text-align: center"> Saran1</p></th>
                  <th rowspan="2" style="vertical-align:middle"><center><p style="text-align: center"> Saran2</p></th>
                  <th rowspan="2" style="vertical-align:middle"><center><p style="text-align: center"> Saran3</p></th>
                  <th rowspan="2" style="vertical-align:middle"><center><p style="text-align: center"> Saran4</p></th>
                </tr>
                <tr>
                  <th><center>Nama</th>
                  <th><center>JK</th>
                  <th><center>Usia</th>
                  <th><center>Pendidikan</th>
                  <th><center>Pekerjaan</th>
                </tr>
                </thead>

                <tbody>
                <?php 
                  $no=1;
                  foreach ($content -> result_array() as $row): ?>

                <tr>
                  <td><?php echo $no; $no=$no+1;?></td>   
                  <td><?php echo $row['tanggal_survey']?></td>
                  <td><?php echo $row['jam_survey']?></td>
                  <?php
                    $this->db->select('*');
                    $this->db->from('kuesioner');
                    $this->db->where('id='.$row['id_kuesioner']);
                    $content1= $this->db->get();
                    foreach ($content1 -> result_array() as $row1): ?>
                  <td><?php echo $row1['versi_kuesioner']?></td>
                  <?php endforeach ?>     

                  <?php
                    $this->db->select('*');
                    $this->db->from('responden');       
                    $this->db->where('id='.$row['id_responden']);
                    $content1= $this->db->get();
                    foreach ($content1 -> result_array() as $row1): ?>
                  <td><?php echo $row1['nama']?></td>
                  <td><?php echo $row1['jk']?></td>
                  <td><?php echo $row1['usia']?></td>
                  <?php endforeach ?>  

                  <?php
                    $this->db->select('*');
                    $this->db->from('responden');   
                    $this->db->join('pendidikan','responden.id_pendidikan=pendidikan.id');       
                    $this->db->where('responden.id='.$row['id_responden']);
                    $content1= $this->db->get();
                    foreach ($content1 -> result_array() as $row1): ?>
                    <td><?php echo $row1['pendidikan']?></td>
                  <?php endforeach ?>

                  <?php
                    $this->db->select('*');
                    $this->db->from('responden');   
                    $this->db->join('pekerjaan','responden.id_pekerjaan=pekerjaan.id');       
                    $this->db->where('responden.id='.$row['id_responden']);
                    $content1= $this->db->get();
                    foreach ($content1 -> result_array() as $row1): ?>
                    <td><?php if ($row1['id_pekerjaan']==3){echo $row1['pekerjaan_lain'];} else {echo $row1['pekerjaan'];}?></td>
                  <?php endforeach ?>
                  <td><?php echo $row['saran1']?></td>                 
                  <td><?php echo $row['saran2']?></td>                 
                  <td><?php echo $row['saran3']?></td>                 
                  <td><?php echo $row['saran4']?></td>                 
                </tr>
 <?php endforeach ?>

                </tbody>
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

