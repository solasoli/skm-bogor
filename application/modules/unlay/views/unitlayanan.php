<?php
function tambah($id,$det,$edit,$hps,$isinya)
{
  echo '
              <td>
                <div class="hidden-sm hidden-xs action-buttons">
                  <!--
                  <a class="blue" href="'.$det.'">
                    <i class="ace-icon fa fa-search-plus bigger-130"></i>
                  </a>
                  -->
                  <a class="green" href="'.$edit.'">
                    <i class="ace-icon fa fa-pencil bigger-130"></i>
                  </a>
                  <a class="red" class="btn btn-warning" title="Delete"  data-toggle="modal" data-target="#modal-warning'.$id.'">
                    <i class="ace-icon fa fa-trash-o bigger-130"></i>
                  </a>
                </div>
              </td>


        <div class="modal modal-warning fade" id="modal-warning'.$id.'">
         <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">
                      Perhatian
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">
                        &times;
                      </span>
                    </button>
              </div>
              <div class="modal-body">
                <p>Anda yakin akan menghapus data ini&hellip;<br><br>'.$isinya.'</p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
                <a href="'.$hps.'">
                <button type="button" class="btn btn-outline">Hapus</button>
                </a>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
';
}

?>
<!-- ace styles
<link rel="stylesheet" href="<?php echo base_url();?>assets/ace/assets/css/ace.min.css" class="ace-main-stylesheet" id="main-ace-style" />
-->
<!-- Theme style -->

              <h3 class="box-title">Unit Layanan</h3>
            <!-- /.box-header -->
            <!-- form start -->
    <table>
    <tr><td>

<div class="col-xs-15">
        <a href="<?php echo base_url() ?>unlay/unlay_add">
        <button type="button" class="btn btn-block btn-primary">Tambah Data</button>
      </a>
      </br>
          </div>

      
    </td></tr></table>

    <div class="clearfix">
      <div class="pull-right tableTools-container"></div>
    </div>

    <br>
    <div class="callout callout-success">
      <font size="3">Daftar Unit Layanan </font>
    </div>

    <!-- div.table-responsive -->
    <!-- div.dataTables_borderWrap -->
    <?php
      $this->db->select('*');
      $this->db->from('unit_layanan');
      $content= $this->db->get();
    ?>
    <div>
        <table class="table table-striped- table-bordered table-hover table-checkable responsive no-wrap" id="m_table_1">
          <thead>
            <tr>
              <th>No</th>
              <th>Nama Unit</th>
              <th>Is Aktif</th>
              <th></th>
            </tr>
          </thead>

          <tbody>
          <?php 
          $no=1;
          foreach ($content -> result_array() as $row): ?>
            <tr>
              <td><?php echo $no; $no=$no+1;?>.</td>
              <td><?php echo $row['nama_unit']?></td>
              <td><?php echo $row['is_aktif']?></td>
                <?php tambah($row['id'],'#',base_url().'unlay/unlay_edit/'.$row['id'],base_url().'unlay/unlay_delete/'.$row['id'],$row['nama_unit']); ?>
            </tr>
    <?php endforeach ?>

          </tbody>
        </table>
      </div>
            </form>



<script src="<?php echo base_url();?>assets/metronic5dflt/assets/vendors/base/vendors.bundle.js" type="text/javascript"></script>
<script type="text/javascript"> var DatatablesExtensionsResponsive= { init:function() { $("#m_table_1").DataTable( { responsive:!0, columnDefs:[ {} ] } ) } } ; jQuery(document).ready(function() {DatatablesExtensionsResponsive.init() } );</script>

