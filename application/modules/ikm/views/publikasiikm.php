<?php
$rnd=rand();
?>
            <!-- /.box-header -->
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
 
      <div class="form-group">

    <!--
    <table>
    <tr><td>.</td></tr>
    <tr><td>
      <a href="<?php echo base_url() ?>ikm/<?php echo $unlay ?>">
        <button type="button" class="btn btn-block btn-info btn">PDF</button>
      </a>
    </td></tr></table>
    -->

                  <table id="example1" class="table table-bordered table-striped">
                    <tbody>
                    <tr>
                      <?php
                      $this->db->from('unit_layanan');
                      $this->db->where('id='.$unlay);
                      $content1= $this->db->get();
                      foreach ($content1 -> result_array() as $row1): 
                      $unlay1=strtoupper($row1['nama_unit']);
                      endforeach ?>

                      <?php
                      $jenlay1="";
                      $this->db->from('jenis_layanan');
                      $this->db->where('id='.$jenlay);
                      $content1= $this->db->get();
                      foreach ($content1 -> result_array() as $row1): 
                      $jenlay1=strtoupper($row1['jenis_layanan_diterima']);
                      endforeach ?>


                      <td><center><b>INDEKS KEPUASAN MASYARAKAT (IKM)<br>UNIT PELAYANAN <?=$unlay1?><br>PEMERINTAHAN KOTA BOGOR<br>
                      <?php
                      if ($bulan==''){echo 'TAHUN';}
                      if ($bulan=='1'){echo 'JANUARI';}
                      if ($bulan=='2'){echo 'FEBRUARI';}
                      if ($bulan=='3'){echo 'MARET';}
                      if ($bulan=='4'){echo 'APRIL';}
                      if ($bulan=='5'){echo 'MEI';}
                      if ($bulan=='6'){echo 'JUNI';}
                      if ($bulan=='7'){echo 'JULI';}
                      if ($bulan=='8'){echo 'AGUSTUS';}
                      if ($bulan=='9'){echo 'SEPTEMBER';}
                      if ($bulan=='10'){echo 'OKTOBER';}
                      if ($bulan=='11'){echo 'NOVEMBER';}
                      if ($bulan=='12'){echo 'DESEMBER';}

                      ?>
                      2018</b></center></td><br><br>
                        <table id="example1" class="table table-bordered table-striped">
                          <thead>
                          <tr>
                            <th><center>Nilai IKM</th>
                            <th>Nama Layanan : <?=$jenlay1?></th>
                          </tr>
                          </thead>
                          <tbody>
                          <tr>












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
              $no=0;
              $jkl=0;
              $jkp=0;
              $ikm=0;
              $pd1=0;
              $pd2=0;
              $pd3=0;
              $pd4=0;
              $pd5=0;
              $pd6=0;
              $pd7=0;
              $pd8=0;
              $pd9=0;

      if($verkue!='')
      {
          $this->db->select('*, survey.id as "sid"');
          $this->db->from('survey');
          $this->db->join('responden','survey.id_responden=responden.id');
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
          $this->db->where('id_kuesioner=',$verkue);     
          $content= $this->db->get();
          $no=0;
          foreach ($content -> result_array() as $row): ?>
              <?php 
              $no=$no+1;
              if($row['jk']=='L')
                {$jkl=$jkl+1;}
              else
                {$jkp=$jkp+1;}

              if($row['id_pendidikan']==1) {$pd1=$pd1+1;}
              if($row['id_pendidikan']==2) {$pd2=$pd2+1;}
              if($row['id_pendidikan']==3) {$pd3=$pd3+1;}
              if($row['id_pendidikan']==4) {$pd4=$pd4+1;}
              if($row['id_pendidikan']==5) {$pd5=$pd5+1;}
              if($row['id_pendidikan']==6) {$pd6=$pd6+1;}
              if($row['id_pendidikan']==7) {$pd7=$pd7+1;}
              if($row['id_pendidikan']==8) {$pd8=$pd8+1;}
              if($row['id_pendidikan']==9) {$pd9=$pd9+1;}

              for ($u=1;$u<=9;$u++)
              {
              $this->db->select('sum(bobot) as "bobots",count(*) as "byk"');
              $this->db->from('jawaban_survey');
              $this->db->join('pilihan','jawaban_survey.id_pilihan=pilihan.id');
              $this->db->join('pertanyaan','jawaban_survey.id_pertanyaan=pertanyaan.id');
              $this->db->where('id_survey',$row['sid']);
              $this->db->where('id_unsur_pelayanan',$u);
              $content1= $this->db->get();
              foreach ($content1 -> result_array() as $row1): ?>
              <?php 
                $nilai[$u]=$nilai[$u]+($row1['bobots']/$row1['byk']);
                endforeach ?>
              <?php } ?>
    <?php endforeach ?>
    <?php 
                $jml=0;
                $ikm=0;
                if($no>0)
                {
                    for ($i=1;$i<=9;$i++)
                    {
                      $jml=$jml+($nilai[$i]/$no*0.111);
                    }
                    $ikm=$jml*25;
                }
    
    } ?>







                            <td><center><h1><?=$ikm?></h1></center></td>
                            <td> <p align="center"><b>Responden</b></p><br>
                                Jumlah : <?=$no?> Orang<br>
                                Jenis Kelamin<br>
                                  &nbsp; &nbsp; &nbsp; Laki-laki : <?=$jkl?> Orang<br>
                                  &nbsp; &nbsp; &nbsp; Perempuan : <?=$jkp?> Orang<br>
                                Pendidikan<br>
                                  &nbsp; &nbsp; &nbsp; SD : <?=$pd1?> Orang<br>
                                  &nbsp; &nbsp; &nbsp; SMP : <?=$pd2?> Orang<br>
                                  &nbsp; &nbsp; &nbsp; SMA/K : <?=$pd3?> Orang<br>
                                  &nbsp; &nbsp; &nbsp; D I : <?=$pd4?> Orang<br>
                                  &nbsp; &nbsp; &nbsp; D II : <?=$pd5?> Orang<br>
                                  &nbsp; &nbsp; &nbsp; D III : <?=$pd6?> Orang<br>
                                  &nbsp; &nbsp; &nbsp; S1 : <?=$pd7?> Orang<br>
                                  &nbsp; &nbsp; &nbsp; S2 : <?=$pd8?> Orang<br>
                                  &nbsp; &nbsp; &nbsp; S3 : <?=$pd9?> Orang<br>
                                </td>
                            </td>
                          </tr>
                          </tbody>
                          <tfoot>
                            <th></th>
                            <th></th>
                          </tfoot>
                        </table><br><br>
                      <td><center><b>TERIMA KASIH ATAS PENILAIAN YANG TELAH ANDA BERIKAN<br>MASUKAN ANDA SANGAT BERMANFAAT UNTUK KEMAJUAN UNIT<br>KAMI AGAR TERUS MEMPERBAIKI DAN MENINGKATKAN<br>KUALITAS PELAYANAN BAGI MASYARAKAT</b></center>
                      </td>
                    </tr>
                    </tbody>
                    <td><br><br>
                    <!--
                      <div class="col-xs-2">
                        <a href="renev_add" button type="button" class="btn btn-block btn-primary">PDF</a></button></div>
                        -->
                      </div>

                    </td>
                  </table>

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