          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Form Tambah Soal</h3>

            <form class="form-horizontal" action="<?php echo base_url(); ?>kues/action_soal_add/<?php echo $id ?>" method="post" accept-charset="utf-8">
              <div class="box-body">
                <div class="row">

                  <div class="col-xs-12">
                    <label>Unsur Pelayanan</label>
                      <select name="unpel" id="unpel" size="1" onchange="gantijenlay();return false;" class="form-control select2" style="width: 100%;">
                        <option value='1'>Persyaratan</option>
                        <option value='2'>Prosedur</option>
                        <option value='3'>Waktu Pelayanan</option>
                        <option value='4'>Biaya/Tarif</option>
                        <option value='5'>Produk Layanan</option>
                        <option value='6'>Kopentensi Pelaksana</option>
                        <option value='7'>Perilaku Pelaksana</option>
                        <option value='8'>Maklumat Pelayanan</option>
                        <option value='9'>Penanganan Pengaduan</option>
                      </select>
                  </div>
                  <br>
                  <br>
                  <br>
                  <br>

                  <div class="col-xs-4">
                    <label>Pertanyaan</label>
                    <textarea name="tanya" id="tanya" class="form-control" rows="13"></textarea>
                  </div>
                
                  <div class="col-xs-7">
                    <label for="tambahdata2">Pilihan A</label>
                    <input type="text" class="form-control" id="pil1" name="pil1" >
                  </div>

                  <div class="col-xs-1">
                    <label for="unitlayanan" class="col-lg-25 control-label">Bobot A</label>
                    <div class="col-lg-300">
                      <div class="form-group">
                        <select class="form-control" id="bobot1" name="bobot1">
                          <option value='1'>1</option>
                          <option value='2'>2</option>
                          <option value='3'>3</option>
                          <option value='4'>4</option>
                        </select>
                      </div>
                    </div>
                  </div>
                
                  <br>
                  <div class="col-xs-7">
                    <label for="tambahdata2">Pilihan B</label>
                    <input type="text" class="form-control" id="pil2" name="pil2" >
                  </div>
                
                  <div class="col-xs-1">
                    <label for="unitlayanan" class="col-lg-25 control-label">Bobot B</label>
                    <div class="col-lg-300">
                      <div class="form-group">
                        <select class="form-control" id="bobot2" name="bobot2">
                          <option value='1'>1</option>
                          <option value='2'>2</option>
                          <option value='3'>3</option>
                          <option value='4'>4</option>
                        </select>
                      </div>
                    </div>
                  </div>

                  <br>
                  <div class="col-xs-7">
                    <label for="tambahdata2">Pilihan C</label>
                    <input type="text" class="form-control" id="pil3" name="pil3" >
                  </div>

                  <div class="col-xs-1">
                    <label for="unitlayanan" class="col-lg-25 control-label">Bobot C</label>
                    <div class="col-lg-300">
                      <div class="form-group">
                        <select class="form-control id="bobot3" name="bobot3" ">
                          <option value='1'>1</option>
                          <option value='2'>2</option>
                          <option value='3'>3</option>
                          <option value='4'>4</option>
                        </select>
                      </div>
                    </div>
                  </div>

                  <br>
                  <div class="col-xs-7">
                    <label for="tambahdata2">Pilihan D</label>
                    <input type="text" class="form-control" id="pil4" name="pil4" ">
                  </div>

                  <div class="col-xs-1">
                    <label for="unitlayanan" class="col-lg-25 control-label">Bobot D</label>
                    <div class="col-lg-300">
                      <div class="form-group">
                        <select class="form-control id="bobot4" name="bobot4" ">
                          <option value='1'>1</option>
                          <option value='2'>2</option>
                          <option value='3'>3</option>
                          <option value='4'>4</option>
                        </select>
                      </div>
                    </div>
                  </div>

                </div>

                <div class="box-footer">
                  <a href="<?php echo base_url() ?>kues/kuesioner">
                    <button type="button" class="btn btn-default">Batal</button>
                  </a>
                  <button type="submit" class="btn btn-info pull-right" value="Save">Simpan</button>
                </div>
              </div>
            </form>
          </div>
          <!-- /.box -->
        </div>
