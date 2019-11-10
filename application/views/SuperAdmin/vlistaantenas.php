<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Dashboard
    </h1>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Lista de antenas</h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body table-responsive no-padding">
            <table id="escuelas" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th>Nombre</th>
                <th>Lat</th>
                <th>Lon</th>
                <th>Api_key</th>
                <th>Acción</th>
              </tr>
              </thead>
              <tbody>
              <?php
                foreach ($antenas as $a) {
              ?>
              <tr>
                <td><?=$a->nombre?></td>
                <td><?=$a->lat?></td>
                <td><?=$a->lon?></td>
                <td><?=$a->api_key?></td>
                <th>
                  <h4>
                  <a href="<?=base_url()?>Admin/estadisticas/<?= $a->id_antena?>" id="verEstadisticas">
                    <i class="fa fa-bar-chart" data-antena="<?=$a->id_antena;?>"></i>
                  </a>
                  <i class= "fa fa-pencil"></i>
                  <i class= "fa fa-trash"></i>
                </h4>
                </th>
              </tr>
              <?php }?>
              </tbody>
            </table>
          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </section>
  <!-- /.content -->
</div>
<!-- DataTables -->
<script src="<?=base_url()?>assets/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?=base_url()?>assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="<?=base_url()?>assets/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="<?=base_url()?>assets/bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?=base_url()?>assets/dist/js/demo.js"></script>
<script>
$(function () {
  $('#escuelas').DataTable();

})
</script>
