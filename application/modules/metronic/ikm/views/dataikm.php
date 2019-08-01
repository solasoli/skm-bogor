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


    <div class="box-body">
      <div class="form-group">
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
        </div>
        <br><br>
      <div class="form-group">
        <label for="unitlayanan" class="col-sm-2 control-label" style="text-align: left" >Jenis Layanan</label>
          <div class="col-sm-3">
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
        <br><br>
      <div class="form-group">
        <label for="unitlayanan" class="col-sm-2 control-label" style="text-align: left">Versi Kuoesioner</label>
          <div class="col-sm-3">
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
                <option <?=$verkue==$row1['id']?'selected':''?> value="<?php echo $row1['id']?>"><?php echo $row1['versi_kuesioner']?></option>
                <?php 
                  if ($i==0)
                  {
                    if ($verkue=='')
                      {
                        $verkue=$row1['id'];
                      }
                  }
                  $i=$i+1;
                  endforeach ?>
              </select>
            </div>
          </div>
        </div>
        <br><br>

    <table>
    <tr><td>.</td></tr>
    <tr><td>
      <a href="<?php echo base_url() ?>ikm/<?php echo $unlay ?>">
        <button type="button" class="btn btn-block btn-info btn">PDF</button>
      </a>
    </td></tr></table>

    <div class="clearfix">
      <div class="pull-right tableTools-container"></div>
    </div>
    

    <!-- div.table-responsive -->
    <!-- div.dataTables_borderWrap -->
    <div>
        <table id="dynamic-table" class="table table-striped table-bordered table-hover">
          <thead>
            <tr>
              <th rowspan="2" style="vertical-align:middle"><center>No</th>
              <th colspan="9" style="vertical-align:middle"><center>Unsur Pelayanan</th>
              <th></th>
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
              <th><center></th>
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
      $this->db->select('*');
      $this->db->from('survey');
      $this->db->where('id_kuesioner=',$verkue);     
      $content= $this->db->get();
          $no=0;
          foreach ($content -> result_array() as $row): ?>
            <tr>
              <td><?php echo $no+1; $no=$no+1;?>.</td>
              <?php
              for ($u=1;$u<=9;$u++)
              {
              $this->db->select('*');
              $this->db->from('jawaban_survey');
              $this->db->join('pilihan','jawaban_survey.id_pilihan=pilihan.id');
              $this->db->join('pertanyaan','jawaban_survey.id_pertanyaan=pertanyaan.id');
              $this->db->where('id_survey',$row['id']);
              $this->db->where('id_unsur_pelayanan',$u);
              $content1= $this->db->get();
              foreach ($content1 -> result_array() as $row1): ?>
              <td><center><?php echo $row1['bobot']?></td>
              <?php 

                $nilai[$u]=$nilai[$u]+$row1['bobot'];
                endforeach ?>
              <?php } ?>
              <td></td>

            </tr>
    <?php endforeach ?>
    <?php } ?>

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

