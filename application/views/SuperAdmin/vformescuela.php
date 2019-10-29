 <!-- Mensaje de alerta-->
 <style type="text/css">
  #map {
    width: 50%;
    height: 480px;
      margin-left: 25%;
  }
</style>
<script type="text/javascript"
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCoVLg-qh7i0lDSWbgh8Wzp-PgXFF0aaqg"></script>
<script src="https://unpkg.com/location-picker/dist/location-picker.min.js"></script>
  <div class="modal modal-danger fade" id="modal-danger">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="modal-titulo"></h4>
        </div>
        <div class="modal-body" id="modal-body">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Cerrar</button>
        </div>
      </div>
            <!-- /.modal-content -->
    </div>
          <!-- /.modal-dialog -->
  </div>
<!--Mensaje de success-->
  <div class="modal modal-success fade" id="modal-success">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Finalizado!</h4>
        </div>
        <div class="modal-body">
          <p>La escuela ha sido registrada con exito!</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline pull-left" id="success" data-dismiss="modal">Cerrar</button>
        </div>
      </div>
            <!-- /.modal-content -->
    </div>
          <!-- /.modal-dialog -->
  </div>

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
              <h3 class="box-title">Crear nueva antena</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <form id="escuela-form">
              <div>
              <h3>Datos de la antena</h3>
              <h4>Nombre representativo</h4>
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-podcast"></i></span>
                <input type="text" class="form-control" placeholder="Nombre de la antena" name="nombre">
              </div>
              <input type="hidden" class="form-control" placeholder="Latitud" name="lat" id="lat">
              <input type="hidden" class="form-control" placeholder="Longitud" name="lon" id="lon">
                  <br>

              <div id="map"></div>
                  <br>

              <button type="submit" class="btn btn-primary">Submit</button>
            </div>
          </form>
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
    $('#success').on('click',function(){
      $(location).attr('href', '<?=base_url()?>Admin')
    });
    $("#escuela-form").submit(function(e){
      e.preventDefault();
      var location = lp.getMarkerPosition();
      $("#lat").val(location.lat);
      $("#lon").val(location.lng);
      $.ajax({
        url: "<?=base_url()?>Admin/ajax_crear_antena",
        type: "post",
        dataType:'json',
        cache : false,
        data: $(this).serialize(),
        success:function(data){
          if(data.codigo==0){
            $('#modal-success').modal('show');
          }else{
            $( "#modal-titulo" ).empty();
            $( "#modal-body" ).empty();
            $( "#modal-titulo" ).append(data.respuesta);
            $( "#modal-body" ).append(data.errores);
            $('#modal-danger').modal('show');
          }
        }
      });
    });
  })
</script>
<script>
  // Get element references
  var map = document.getElementById('map');

  // Initialize LocationPicker plugin
  var lp = new locationPicker(map, {
    setCurrentPosition: true, // You can omit this, defaults to true
    lat: 19.504503,
    lng: -99.146977
  }, {
    zoom: 18 // You can set any google map options here, zoom defaults to 15
  });
</script>
