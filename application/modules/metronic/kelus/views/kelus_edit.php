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
              <h3 class="box-title">Edit Data User</h3>
            <!-- /.box-header -->
            <!-- form start -->
  <?php foreach ($content -> result_array() as $key): ?>
            <form class="form-horizontal" action="<?php echo base_url(); ?>kelus/action_kelus_update/<?php echo $key['id'] ?>" method="post" accept-charset="utf-8">
              <div class="box-body">
                <div class="form-group">
                  <label class="col-sm-2 control-label">User Login</label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="userlogin" placeholder="Masukkan User Login" value="<?php echo $key['user_login'] ?>">
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-2 control-label">NIP</label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="nip" placeholder="Masukkan NIP" value="<?php echo $key['nip'] ?>">
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-2 control-label">Nama Lengkap</label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="namalengkap" placeholder="Masukkan Nama Lengkap" value="<?php echo $key['nama_lengkap'] ?>"> 
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-2 control-label">Nick</label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="nick" placeholder="Masukkan Nick" value="<?php echo $key['nick'] ?>">
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-2 control-label">Nomer HP</label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="hp" placeholder="Masukkan Nomer HP" value="<?php echo $key['hp'] ?>">
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-2 control-label">Is Aktif</label>

                  <div class="col-sm-10">
                    <select name="is_aktif" id="is_aktif" size="1" class="form-control select2" style="width: 100%;">
                      <option <?=$key['is_aktif']==1?'selected':''?> value="1">Aktif</option>
                      <option <?=$key['is_aktif']==0?'selected':''?> value="0">Tidak Aktif</option>
                    </select>
                  </div>
                </div>

              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <a href="<?php echo base_url() ?>kelus/kelolauser">
                <button type="button" class="btn btn-default">Batal</button>
                </a>
                <button type="submit" class="btn btn-info pull-right" value="Save">Simpan</button>
              </div>
              <!-- /.box-footer -->
            </form>
  <?php endforeach ?>

</body>
</html>