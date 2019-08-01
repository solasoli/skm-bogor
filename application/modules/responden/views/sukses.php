  <!-- Main content -->
    <?php
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
        <h2><center><b>Terima Kasih</b></center></h2>
        <h4><center><b>Survei telah disimpan...</b></center></h4>
      </div>
      <br>
    </div>

<table>
<tr>
  <td>
    <div class="box-body">
    <div class="form-group">
      <a href="<?php echo base_url() ?>responden/survey/<?=$id?>">
        <button type="button" class="btn btn-block btn-primary">Form Survei</button>
      </a>
    </div>
    </div>
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
