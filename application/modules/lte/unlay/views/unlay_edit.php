<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Edit Data</title>
	<link rel="stylesheet" href="">
</head>
<body>

       <!-- Horizontal Form -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Edit Data Unit Layanan</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
  <?php foreach ($content -> result_array() as $key): ?>
            <form class="form-horizontal" action="<?php echo base_url(); ?>unlay/action_unlay_update/<?php echo $key['id'] ?>" method="post" accept-charset="utf-8">
              <div class="box-body">
                <div class="form-group">
                  <label class="col-sm-2 control-label">Unit Layanan</label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="unlay" placeholder="Masukkan Nama Unit Layanan" value="<?php echo $key['nama_unit'] ?>">
                  </div>
                </div>
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <a href="<?php echo base_url() ?>unlay/unitlayanan">
                <button type="button" class="btn btn-default">Batal</button>
                </a>
                <button type="submit" class="btn btn-info pull-right" value="Save">Simpan</button>
              </div>
              <!-- /.box-footer -->
            </form>
  <?php endforeach ?>

          </div>

</body>
</html>