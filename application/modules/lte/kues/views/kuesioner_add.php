<?php
    $this->db->where('jenis_layanan.id', $id);
    $this->db->join('unit_layanan','unit_layanan.id=jenis_layanan.id_unit_layanan');
    $kueri = $this->db->get('jenis_layanan');
    foreach ($kueri -> result_array() as $key):
?>
       <!-- Horizontal Form -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Form Kuesioner - Tambah Versi Kuesioner</h3>
            </div>
            <form class="form-horizontal" action="<?php echo base_url(); ?>kues/action_kues_add/<?php echo $id ?>" method="post" accept-charset="utf-8">
            <table>
            <tr>
            <td>
                <div class="box-body">
                <div class="form-group">
                  <label class="col-xs-12 control-label">Unit Layanan</label>
                </div>
                </div>
            </td>
            <td>
              <?=$key['nama_unit']?>
            </td>
            </tr>

            <tr>
            <td>
                <div class="box-body">
                <div class="form-group">
                  <label class="col-xs-12 control-label">Jenis Layanan</label>
                </div>
                </div>
            </td>
            <td>
              <?=$key['jenis_layanan_diterima']?>
            </td>
            </tr>
<?php endforeach ?>

            <tr><td>
                  <div class="box-body">
                  <div class="form-group">
                    <label for="unitlayanan" class="col-xs-12 control-label">Versi Kuesioner</label></td>
                    <td>
                    <input type="text" class="form-control" id="verkue" name="verkue" placeholder="Masukan Versi Kuesioner"></td>
                  </div>
              </td></tr>
              </div>
              </table>
              <!-- /.box-body -->
              <div class="box-footer">
                <a href="<?php echo base_url() ?>kues/kuesioner">
                <button type="button" class="btn btn-default">Batal</button>
                </a>
                <button type="submit" class="btn btn-info pull-right" value="Save">Simpan</button>
              </div>
              <!-- /.box-footer -->
            </form>
          </div>
