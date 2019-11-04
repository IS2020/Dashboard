
<!-- Content Wrapper. Contains page content -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.1/dist/leaflet.css" integrity="sha512-Rksm5RenBEKSKFjgI3a41vrjkw4EVPlJ3+OiI65vTjIdo9brlAacEuKOiQ5OFh7cOI1bkDwLqdLw3Zg0cRJAAQ=="crossorigin="" />
<link rel="stylesheet" type="text/css" href="https://unpkg.com/leaflet.markercluster@1.3.0/dist/MarkerCluster.css" />
<link rel="stylesheet" type="text/css" href="https://unpkg.com/leaflet.markercluster@1.3.0/dist/MarkerCluster.Default.css" />
<script src="https://unpkg.com/leaflet@1.3.1/dist/leaflet.js" integrity="sha512-/Nsx9X4HebavoBvEBuyp3I7od5tA0UzAxs+j83KgC8PU0kgB4XiK4Lfe4y4cgBtaRJQEIFCW+oC506aPT2L1zw=="crossorigin=""></script>
<script type='text/javascript' src='https://code.jquery.com/jquery-3.3.1.min.js'></script>
<script type='text/javascript' src='https://unpkg.com/leaflet.markercluster@1.3.0/dist/leaflet.markercluster.js'></script>
<style type="text/css">
    #map{ /* la carte DOIT avoir une hauteur sinon elle n'apparaît pas */
        height:500px;
        width: 100%;
    }
</style>
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
            <h3><?=$contador["antenas"]?></h3>

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
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Mapa de geófonos</h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <div id="imap">
    <div id="map">
        <!-- Ici s'affichera la carte -->
    </div>
          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
      </div>
      <!-- /.col -->
    </div>
  </section>
  <!-- /.content -->
</div>
<script type="text/javascript">
    var theme = 'https://{s}.tile.openstreetmap.fr/osmfr/{z}/{x}/{y}.png';
    var lat = 19.504426;
    var lon = -99.146903;
    var alt =481;
    var macarte = null;
    //var trace = new Array();
    var i = 0;
    //var marker1;
    var markerClusters; // Servira à stocker les groupes de marqueurs
    var popup = L.popup();
  function initMap(){

      // Nous définissons le dossier qui contiendra les marqueurs
      //var iconBase = 'img';
      // Créer l'objet "macarte" et l'insèrer dans l'élément HTML qui a l'ID "map"
      macarte = L.map('map').setView([lat, lon], 17);
      markerClusters = L.markerClusterGroup; // Nous initialisons les groupes de marqueurs
      // Leaflet ne récupère pas les cartes (tiles) sur un serveur par défaut. Nous devons lui préciser où nous souhaitons les récupérer. Ici, openstreetmap.fr
      L.tileLayer(theme, {
          // Il est toujours bien de laisser le lien vers la source des données
          //attribution: 'données © OpenStreetMap/ODbL - rendu OSM France',
          minZoom: 1,
          maxZoom: 20
      }).addTo(macarte);
      <?php foreach ($antenas as $a) {?>
      L.marker([<?=$a->lat?>,<?=$a->lon?>],{title:'<?=$a->nombre?>'}).addTo(macarte);
      <?}?>
  }




    $(document).ready(function(){
        initMap();
    });
</script>
