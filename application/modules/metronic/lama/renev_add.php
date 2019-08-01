<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Input Data</title>
	<link rel="stylesheet" href="">
</head>
<body>

       <!-- Horizontal Form -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Input Data Perencanaan dan Evaluasi</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" action="<?php echo base_url(); ?>dashboard/action_add_renev" method="post" accept-charset="utf-8">
              <div class="box-body">

                <div class="form-group">
                  <label class="col-sm-2 control-label">Organisasi Perangkat Daerah</label>

                  <div class="col-sm-10">
					<select name="opd" size="1" style="position:absolute;">
          			<?php
            			$this->db->from('opd');
            			$content1= $this->db->get();
            			foreach ($content1 -> result_array() as $row1): ?>
          			<option value="<?php echo $row1['id']?>"><?php echo $row1['nama_opd']?></option>
          			<?php endforeach ?>
 					</select>
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-2 control-label">Objek Evaluasi</label>

                  <div class="col-sm-10">
					<select name="objek" size="1" style="position:absolute;">
						<option selected value="1">RKA</option>
						<option value="2">RENJA</option>
						<option value="3">RENSTRA</option>
						<option value="4">LAKIP</option>
					</select>
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-2 control-label">Jenis Task</label>

                  <div class="col-sm-10">
					<select name="jenis" size="1" style="position:absolute;">
						<option selected value="1">Ketersediaan Data</option>
						<option value="2">Ketersediaan Renstra</option>
						<option value="3">Ketersediaan Kerangka Pendanaan</option>
					</select>
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-2 control-label">Evaluasi</label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="evaluasi" placeholder="Masukkan Bahan Evaluasi Rencana Pembangunan">
                  </div>
                </div>

              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <button type="submit" class="btn btn-default">Cancel</button>
                <button type="submit" class="btn btn-info pull-right" value="Save">Simpan</button>
              </div>
              <!-- /.box-footer -->
            </form>
          </div>

</body>
</html>