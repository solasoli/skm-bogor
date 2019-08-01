<?php
$rnd=rand();
?>
          <div class="m-portlet">
            <div class="m-portlet__head">

                                <div class="m-portlet__head-caption">
                                    <div class="m-portlet__head-title">
                                        <h3 class="m-portlet__head-text">
                                            Kuesioner Kepuasan Masyarakat Kota Bogor
                                        </h3>
                                    </div>
                                </div>
            </div>



                <div class="box box-primary">
      <div class="box-header with-border">

                                        <h3 class="m-portlet__head-text">
                                            Silahkan pilih kuesioner
                                        </h3>
                                        <br>
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

                  <?php
                  if (isset($_COOKIE['verkue']))
                  {$verkue=$_COOKIE['verkue'];} else {$verkue='';}

                  $this->db->from('kuesioner');
                  $this->db->order_by('versi_kuesioner');
                  $this->db->where('id_jenis_layanan',$jenlay);
                  $content1= $this->db->get();

                  foreach ($content1 -> result_array() as $row1):
                  $verkue=$row1['id'];
                  endforeach;
                  ?>

<table>
<tr>
  <td>
      <div class="box-body">
        <div class="form-group">
    <a href="<?php echo base_url() ?>responden/survey/<?php echo $verkue ?>">
      <button type="button" class="btn btn-block btn-primary">Isi Kuesioner</button>
    </a>
    </div>
    </div>
  </td>
</tr>
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

