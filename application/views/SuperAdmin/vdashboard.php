<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Dashboard<small> (Super Admin)</small>
    </h1>
  </section>

  <!-- Main content -->
  <section class="content container-fluid">
    <div class="row">

      <div class="col-lg-3 col-md-6 col-s-12">
        <!-- small box -->
        <div class="small-box bg-yellow">
          <div class="inner">
            <h3><?=$contador["escuelas"]?></h3>

            <p>Estaciones registradas</p>
          </div>
          <div class="icon">
            <i class="fa fa-podcast"></i>
          </div>
          <br>
        </div>
      </div>
      <div class="col-lg-3 col-md-6 col-s-12">
        <!-- small box -->
        <div class="small-box bg-teal">
          <div class="inner">
            <h3><?=$contador["usuarios"]?></h3>

            <p>Usuarios registrados</p>
          </div>
          <div class="icon">
            <i class="fa fa-users"></i>
          </div>
          <br>
        </div>
      </div>
    </div>
  </section>
  <!-- /.content -->
</div>
