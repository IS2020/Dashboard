<script src="<?=base_url() ?>assets/bower_components/chart.js/Chart.js"></script>
<script src="<?=base_url()?>/assets/highcharts/code/highcharts.src.js"></script>
<?php if($reportes){?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Reportes de la antena <?=$nombreAntena;?>
    </h1>
  </section>
  <!-- Main content -->
  <section class="content">
    <?php foreach ($reportes as $r) {
    ?>
    <div class="row">
      <div class="col-xs-12">
        <div class="box box-primary">
          <div class="box-header with-border">
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
              <div class="box-body">
                <div id="container<?php echo $r->idReporte?>" style="height: 400px; min-width: 310px"></div>
            </div>
          </div>
        </div>
        <!-- /.box -->
      </div>
      <!-- /.col -->
    </div>
  <?php }?>
    <!-- /.row -->
  </section>
  <!-- /.content -->
</div>
<script>
  $(function () {
    <?php foreach ($reportes as $r) {?>
    Highcharts.chart('container<?=$r->idReporte ?>', {

       rangeSelector: {
           selected: 1
       },

       title: {
           text: 'Estadisticas de la antena <?=$r->date;?> UTC'
       },

       series: [{
           name: 'Value',
           data: <? echo json_encode($r->values) ?>,
           tooltip: {
               valueDecimals: 4
           }
       },
     ]
   });
    <?php }?>
  })
</script>
<?php }else{?>
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Reportes de la antena <?=$nombreAntena;?>
      </h1>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box box-primary">
            <div class="box-header with-border">
                <div class="box-tools pull-right">
                  <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                </div>
                <div class="box-body">
                  <div style="height: 400px; min-width: 310px"><h2>No hay reportes.</h2></div>
              </div>
            </div>
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
<?php }?>
