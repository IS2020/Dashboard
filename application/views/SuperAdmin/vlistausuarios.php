  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard<small> (Super Admin)</small>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Lista de usuarios</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="usuarios" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>ID</th>
                  <th>Username</th>
                  <th>Nombre</th>
                  <th>Correo</th>
                  <th>Accion</th>
                </tr>
                </thead>
                <tbody>
                <?php
                  foreach ($usuarios as $u) {
                ?>
                <tr>
                  <td><?=$u->id_usuario?></td>
                  <td><?=$u->username?></td>
                  <td><?=$u->nombre." ".$u->appat." ".$u->apmat?></td>
                  <td><?=$u->correo?></td>
                  <th>
                    <h4>
                    <i class="fa fa-eye"></i>
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
    $('#usuarios').DataTable();

  })
</script>
