<form class="form-horizontal" action="<?php echo base_url(); ?>responden/action_survey_add/<?php echo $id ?>" method="post" accept-charset="utf-8">

  <!-- Main content -->
    <?php
      date_default_timezone_set('Asia/Jakarta');
      $this->db->where('kuesioner.id', $id);
      $this->db->join('jenis_layanan', 'jenis_layanan.id=kuesioner.id_jenis_layanan');
      $this->db->join('unit_layanan', 'unit_layanan.id=jenis_layanan.id_unit_layanan');
      $content = $this->db->get('kuesioner');

      foreach ($content -> result_array() as $key):
        $unlay=$key['nama_unit'];
        $idkues=$id;
        $jenlay=$key['jenis_layanan_diterima'];
      endforeach;
    ?>

    <!-- SELECT2 EXAMPLE -->
    <div class="box box-primary">
      <div class="box-header with-border">
        <h2><center><b>KUESIONER SURVEI KEPUASAN MASYARAKAT (SKM)</b></center></h2>
        <h4><center><b>PADA UNIT LAYANAN <?=strtoupper($unlay)?> KOTA BOGOR </b></center></h4>
        <h4><center><b>JENIS LAYANAN : <?=strtoupper($jenlay)?></b></center></h4>

        <?php
          if (isset($_SESSION['err']))
          {
          if ($_SESSION['err']==1)
          {
        ?>
        <span style="color:#FF0000;">
        <h4><center><b>Error : <?=$_SESSION['errnya']?></b></center></h4>
        </span>
        <?php
          $_SESSION['err']=0;
          }
          }
        ?>
      </div>
      <br>

      <div class="box-body">
        <div class="col-md-6">
          <label><font size="3">Tanggal Survei:</font></label>
          <div class="input-group mb-3">
            <div class="input-group-addon">
              <i class="fa fa-calendar"></i>
            </div>
            <?php
              $rnd=rand(1,10000000000);
            ?>
            <input type="hidden" class="form-control pull-right" id="rnd" name="rnd" value='<?=$rnd?>'>
            <input style="background-color: #eaebed;" type="text" class="form-control pull-right" id="tgl" name="tgl" value='<?=date('d-m-Y');?>' readonly>
          </div>
        </div>               

        <div class="col-md-6">
          <label><font size="3">Jam Survei:</font></label>
          <div class="input-group">
            <input style="background-color: #eaebed;" type="text" class="form-control timepicker" id="jam" name="jam" value='<?=date('H:i:s');?>' readonly>
            <div class="input-group-addon"><i class="fa fa-clock-o"></i></div>
          </div>
        </div>


        <div class="col-md-12">
        <br>
        <font size="4"><center><b>PROFIL</b></center></font>
        </div>

        <div class="col-md-6">
          <br>
          <label><font size="3">Nama</font></label>
            <input type="text" class="form-control" id="nama" name="nama">
        </div>

        <div class="col-md-6">
          <br>
          <label><font size="3">Usia</font></label>
            <input type="text" class="form-control" id="usia" name="usia">
        </div>

        <div class="col-md-6">
          <br>
          <label><font size="3">Jenis Kelamin</font></label>
          <br>
          <input type="radio" id="r1" name="r1" Value="L" class="minimal" checked> &nbsp;Laki-laki &nbsp;&nbsp;
          <input type="radio" id="r1" name="r1" Value="P" class="minimal"> &nbsp;Perempuan
        </div>

        <div class="col-md-6">
            <br>
            <label><font size="3">Pendidikan</font></label>
            <br>
            <input type="radio" id="r2" name="r2" Value="1" class="minimal" checked> &nbsp;SD &nbsp;&nbsp;
            <input type="radio" id="r2" name="r2" Value="2" class="minimal"> &nbsp;SMP &nbsp;&nbsp;
            <input type="radio" id="r2" name="r2" Value="3" class="minimal"> &nbsp;SMA/K &nbsp;&nbsp;
            <input type="radio" id="r2" name="r2" Value="4" class="minimal"> &nbsp;D1 &nbsp;&nbsp;
            <input type="radio" id="r2" name="r2" Value="5" class="minimal"> &nbsp;D2 &nbsp;&nbsp;
            <input type="radio" id="r2" name="r2" Value="6" class="minimal"> &nbsp;D3 &nbsp;&nbsp;
            <input type="radio" id="r2" name="r2" Value="7" class="minimal"> &nbsp;S1 &nbsp;&nbsp;
            <input type="radio" id="r2" name="r2" Value="8" class="minimal"> &nbsp;S2 &nbsp;&nbsp;
            <input type="radio" id="r2" name="r2" Value="9" class="minimal"> &nbsp;S3 &nbsp;&nbsp;
        </div>

        <div class="col-md-6">
          <br>
          <label><font size="3">Pekerjaan</font></label>
          <br>
            <input type="radio" id="r3" name="r3" Value="1" class="minimal" checked> &nbsp;PNS &nbsp;&nbsp;
            <input type="radio" id="r3" name="r3" Value="2" class="minimal"> &nbsp;TNI &nbsp;&nbsp;
            <input type="radio" id="r3" name="r3" Value="3" class="minimal"> &nbsp;POLRI &nbsp;&nbsp;
            <input type="radio" id="r3" name="r3" Value="4" class="minimal"> &nbsp;SWASTA &nbsp;&nbsp;
            <input type="radio" id="r3" name="r3" Value="5" class="minimal"> &nbsp;WIRAUSAHA &nbsp;&nbsp;
            <input type="radio" id="r3" name="r3" Value="6" class="minimal"> &nbsp;LAINNYA &nbsp;&nbsp;
        </div>
      </div>

      <div class="box box-primary">
        <div class="box-header with-border">
            <h4><center><b>PENDAPAT RESPONDEN TENTANG PELAYANAN</b></center></h4>
        </div>

        <div class="box-body">
        <!-- /.box-header -->
        <!-- form start -->
          <?php
            $this->db->select('*');
            $this->db->where('id_kuesioner',$id);
            $this->db->from('pertanyaan');
            $content= $this->db->get();
          ?>
          <table class="table table-striped- table-bordered table-hover table-checkable responsive no-wrap" id="m_table_1">
            <thead>
              <tr>
                <th rowspan="2" style="vertical-align:middle"><center>No</center></th>
                <th rowspan="2" style="vertical-align:middle"><center>Pertanyaan</center></th>
                <th colspan="4"><center>Pilihan</center></th>
              </tr>                  
              <tr>
                <th colspan="1"><center>A</center></th>
                <th colspan="1"><center>B</center></th>
                <th colspan="1"><center>C</center></th>
                <th colspan="1"><center>D</center></th>
              </tr>                  
            </thead>

            <tbody>
              <?php 
                $no=1;
                foreach ($content -> result_array() as $row): ?>
              <tr>
                <td><?php echo $no;?>.</td>
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
                    <td><input type="radio" name="no<?=$no?>" id="no<?=$no?>" value="<?=$row['id']?>.<?=$row1['id']?>"<?=$i==4?' checked':''?>>&nbsp;&nbsp;&nbsp;<?php echo $row1['pilihan']?></td>
                    <?php endforeach ?>              
                <?php 
                  }
                ?>
              </tr>
              <?php
                    $no=$no+1;
                    endforeach ;
              ?> 
            </tbody>
          </table>
        </div>
      <div class="box box-primary">
        <div class="box-header with-border">
            <h4><center><b>MASUKAN / SARAN RESPONDEN TENTANG PELAYANAN</b></center></h4>
        </div>
        <div class="box-body">


          <div class="col-md-12">
            <br>
            <label><font size="3">Saran 1</font></label>
            <br>
          </div>
          <div class="col-md-12">
            <table>
            <tr>
              <td>
                <label><font size="3">Kategori&nbsp&nbsp</font></label>
              </td>
              <td>
                <select name="katsar1" id="katsar1" size="1" class="form-control select2" style="width: 100%;">
                  <option value="1">Persyaratan</option>
                  <option value="2">Prosedur</option>
                  <option value="3">Waktu Pelayanan</option>
                  <option value="4">Biaya / Tarif</option>
                  <option value="5">Produk Layanan</option>
                  <option value="6">Kompetensi Pelaksana</option>
                  <option value="7">Perilaku Pelaksana</option>
                  <option value="8">Penanganan Pengaduan</option>
                  <option value="9">Sarana Dan Prasarana</option>
                  <option selected value="99">Lainnya</option>
                </select>
              </td>
            </tr>
            </table>
          </div>
          <div class="col-md-12">
               <textarea class="form-control" rows="5" name="saran1" id="saran1" placeholder="Masukkan saran pelayanan"></textarea>
          </div>

          <div class="col-md-12">
            <br>
            <label><font size="3">Saran 2</font></label>
            <br>
          </div>
          <div class="col-md-12">
            <table>
            <tr>
              <td>
                <label><font size="3">Kategori&nbsp&nbsp</font></label>
              </td>
              <td>
                <select name="katsar2" id="katsar2" size="1" class="form-control select2" style="width: 100%;">
                  <option value="1">Persyaratan</option>
                  <option value="2">Prosedur</option>
                  <option value="3">Waktu Pelayanan</option>
                  <option value="4">Biaya / Tarif</option>
                  <option value="5">Produk Layanan</option>
                  <option value="6">Kompetensi Pelaksana</option>
                  <option value="7">Perilaku Pelaksana</option>
                  <option value="8">Penanganan Pengaduan</option>
                  <option value="9">Sarana Dan Prasarana</option>
                  <option selected value="99">Lainnya</option>
                </select>
              </td>
            </tr>
            </table>
          </div>
          <div class="col-md-12">
               <textarea class="form-control" rows="5" name="saran2" id="saran2" placeholder="Masukkan saran pelayanan"></textarea>
          </div>

          <div class="col-md-12">
            <br>
            <label><font size="3">Saran 3</font></label>
            <br>
          </div>
          <div class="col-md-12">
            <table>
            <tr>
              <td>
                <label><font size="3">Kategori&nbsp&nbsp</font></label>
              </td>
              <td>
                <select name="katsar3" id="katsar3" size="1" class="form-control select2" style="width: 100%;">
                  <option value="1">Persyaratan</option>
                  <option value="2">Prosedur</option>
                  <option value="3">Waktu Pelayanan</option>
                  <option value="4">Biaya / Tarif</option>
                  <option value="5">Produk Layanan</option>
                  <option value="6">Kompetensi Pelaksana</option>
                  <option value="7">Perilaku Pelaksana</option>
                  <option value="8">Penanganan Pengaduan</option>
                  <option value="9">Sarana Dan Prasarana</option>
                  <option selected value="99">Lainnya</option>
                </select>
              </td>
            </tr>
            </table>
          </div>
          <div class="col-md-12">
               <textarea class="form-control" rows="5" name="saran3" id="saran3" placeholder="Masukkan saran pelayanan"></textarea>
          </div>

          <div class="col-md-12">
            <br>
            <label><font size="3">Saran 4</font></label>
            <br>
          </div>
          <div class="col-md-12">
            <table>
            <tr>
              <td>
                <label><font size="3">Kategori&nbsp&nbsp</font></label>
              </td>
              <td>
                <select name="katsar4" id="katsar4" size="1" class="form-control select2" style="width: 100%;">
                  <option value="1">Persyaratan</option>
                  <option value="2">Prosedur</option>
                  <option value="3">Waktu Pelayanan</option>
                  <option value="4">Biaya / Tarif</option>
                  <option value="5">Produk Layanan</option>
                  <option value="6">Kompetensi Pelaksana</option>
                  <option value="7">Perilaku Pelaksana</option>
                  <option value="8">Penanganan Pengaduan</option>
                  <option value="9">Sarana Dan Prasarana</option>
                  <option selected value="99">Lainnya</option>
                </select>
              </td>
            </tr>
            </table>
          </div>
          <div class="col-md-12">
               <textarea class="form-control" rows="5" name="saran4" id="saran4" placeholder="Masukkan saran pelayanan"></textarea>
          </div>

        </div>
      </div>
      </div>
    </div>

<table>
<tr>
  <td>
    <div class="box-body">
    <div class="form-group">
      <button type="submit" class="btn btn-block btn-primary">Simpan</button>
    </div>
    </div>
  </td>
  <td>
  &nbsp;&nbsp;&nbsp;&nbsp;
  </td>
  <td>  
    <div class="box-body">
    <div class="form-group">
    <a href="<?php echo base_url() ?>responden/start">
      <button type="button" class="btn btn-block btn-primary">Pilih Survei</button>
    </a>    
    </div>
    </div>
  </td>
  </tr>
</table>
</form>

<script src="<?php echo base_url();?>assets/metronic5dflt/assets/vendors/base/vendors.bundle.js" type="text/javascript"></script>
<script type="text/javascript"> var DatatablesExtensionsResponsive= { init:function() { $("#m_table_1").DataTable( { responsive:!0, columnDefs:[ {} ] } ) } } ; jQuery(document).ready(function() {DatatablesExtensionsResponsive.init() } );</script>

<!--begin::Base Scripts -->
<script src="<?php echo base_url();?>assets/metronic5dflt/assets/vendors/custom/datatables/datatables.bundle.js" type="text/javascript"></script>
