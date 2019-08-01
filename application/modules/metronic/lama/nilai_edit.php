<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Penilaian</title>
	<link rel="stylesheet" href="">
</head>
<body>

       <!-- Horizontal Form -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Penilaian Perencanaan dan Evaluasi</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
  <?php foreach ($content -> result_array() as $key): ?>
            <form class="form-horizontal" action="<?php echo base_url(); ?>dashboard/action_update_nilai/<?php echo $key['id'] ?>" method="post" accept-charset="utf-8">
              <div class="box-body">
                <div class="form-group">
                  <label class="col-sm-2 control-label">Nilai</label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="nilai" placeholder="Masukkan Nilai Evaluasi" value="<?php echo $key['nilai'] ?>">>
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
  <?php endforeach ?>

          </div>

</body>
</html>