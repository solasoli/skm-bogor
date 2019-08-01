<div class="login-box">
  <div class="login-logo">
    <a href="/"><img src="<?= base_url(); ?>vendor/images/logo.png" width="60px" alt="User Image">&nbsp;&nbsp;<b>E-Evkin</b> </a>
  </div>
  <!-- /.login-logo -->
  <?php if($this->session->userdata('login_error', true)){ ?>
    <div class="callout callout-danger" style="width:120%;left:-10%;position:relative;">
      <h4 align="center">Login Gagal!</h4>
      <p align="center">Anda salah memasukkan email/username atau password.<br>Silahkan dicoba kembali atau hubungi administrator.</p>
    </div>
    <?php $this->session->unset_userdata('login_error'); ?>
  <?php } ?>

  <div class="login-box-body">
    <p class="login-box-msg">Masukkan email/username & password</p>

    <form action="<?= base_url(); ?>auth/validate" method="post">
      <input type="hidden" name="<?= $this->security->get_csrf_token_name();?>" value="<?= $this->security->get_csrf_hash();?>">

      <div class="form-group has-feedback">
        <input class="form-control" name="username" placeholder="Email / Username" value="<?=  ($this->session->userdata('fail_username', true))? $this->session->userdata('fail_username') : '' ?>" required>
        <?php $this->session->unset_userdata('fail_username'); ?>
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>

      <div class="form-group has-feedback">
        <input type="password" name="password" class="form-control" placeholder="Password" value="<?=  ($this->session->userdata('fail_password', true))? $this->session->userdata('fail_password') : '' ?>" required>
        <?php $this->session->unset_userdata('fail_password'); ?>
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>

      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck">
            <label>
              <input type="checkbox"> Remember Me
            </label>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Masuk</button>
        </div>
        <!-- /.col -->
      </div>
    </form>
    <?php $this->session->sess_destroy(); ?>
    <a href="#">Saya lupa password</a><br>
  </div>
  <!-- /.login-box-body --></br>
<div style="text-align:center;color:#756ff2"><p class="login-box-msg"> E-Evkin Evaluasi Kinerja Pelaksanaan Perencanaan  Pembangunan Daerah
Kota Bogor </br>All Right Reserved</p></div>
</div>
<!-- /.login-box -->
