<!DOCTYPE html>
<html lang="en">

<head>
  <?php include VIEWPATH.'includes/header.php'; ?>
  <script src='https://api.mapbox.com/mapbox.js/v3.3.1/mapbox.js'></script> 
  <link href='https://api.mapbox.com/mapbox.js/v3.3.1/mapbox.css' rel='stylesheet' />
  <meta name='viewport' content='initial-scale=1,maximum-scale=1,user-scalable=no' />
  <script src='https://api.mapbox.com/mapbox.js/v3.3.1/mapbox.js'></script>sssss
  <link href='https://api.mapbox.com/mapbox.js/v3.3.1/mapbox.css' rel='stylesheet' />
  <script src='https://api.mapbox.com/mapbox.js/v3.2.0/mapbox.js'></script>
<link href='https://api.mapbox.com/mapbox.js/v3.2.0/mapbox.css' rel='stylesheet' />
 <script src='https://api.mapbox.com/mapbox.js/plugins/leaflet-markercluster/v1.0.0/leaflet.markercluster.js'></script>
<link href='https://api.mapbox.com/mapbox.js/plugins/leaflet-markercluster/v1.0.0/MarkerCluster.css' rel='stylesheet' />
<link href='https://api.mapbox.com/mapbox.js/plugins/leaflet-markercluster/v1.0.0/MarkerCluster.Default.css' rel='stylesheet' />

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

<script src='https://api.mapbox.com/mapbox.js/plugins/leaflet-zoomslider/v0.7.0/L.Control.Zoomslider.js'></script>
<link href='https://api.mapbox.com/mapbox.js/plugins/leaflet-zoomslider/v0.7.0/L.Control.Zoomslider.css' rel='stylesheet'/>

<script src='https://api.mapbox.com/mapbox.js/plugins/leaflet-fullscreen/v1.0.1/Leaflet.fullscreen.min.js'></script>
<link href='https://api.mapbox.com/mapbox.js/plugins/leaflet-fullscreen/v1.0.1/leaflet.fullscreen.css' rel='stylesheet' />
  <style>
      body { margin:0; padding:0; }
      #map { position:absolute; top:0; bottom:0; width:100%; }
  </style>

  <style>
   #map {top:-35px; bottom:0; width:100%;height:520px; }

   .mapbox-improve-map{
    display: none;
}

.leaflet-control-attribution{
    display: none !important;
}
.leaflet-control-attribution{
    display: none !important;
}
.search-ui {

}

.circle-green {
    background-color: #829b35;
    border-radius: 50%
}
</style>

</head>
<body>
  <?php include VIEWPATH.'includes/loadpage.php'; ?>  
  <div id="main-wrapper">
    <?php include VIEWPATH.'includes/navybar.php'; ?> 
    <?php include VIEWPATH.'includes/menu.php'; ?> 
    <div class="content-body">
      <div class="container-fluid">
        <div class="row page-titles mx-0">
          <div class="col-sm-6 p-md-0">
            <div class="welcome-text">
              <h4 style='color:#007bac'>Carte</h4>

            </div>
          </div>
          <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">           

         
          </div>
        </div>
        <!-- row -->
        <div class="row">
          <div class="col-xl-12    col-xxl-12">
            <div class="card">
              <div class="card-header">
                <!-- <h4 class="card-title">Type de beneficiaire</h4> -->
              </div>
              <div class="card-body">
                <div class="basic-form">
                    
              <!-- 
              <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css"> -->
              <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />
              <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script> --><!-- 
              <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.bundle.min.js"></script> -->
              <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>

            <div id="map" style="height:400px; t: 400px">
              Fkffkkfkf
            </div>  
  <div class="modal" id="respons" role="dialog">
  <div class="modal-dialog modal-lg ">
    <div class="modal-content">
      <div class="modal-header">
       <h5> Commune par province </h5>
        <div >    
          <i class="close fa fa-remove float-left text-primary" data-dismiss="modal"></i>  
         
        </div>
      </div>
      <div class="modal-body">
        <div class="table-responsive">
          <table id='mytable' class="table table-bordered table-striped table-hover table-condensed " style="width: 100%;">
            <thead>
              <tr>
                <th>#</th>
                <th>NOM COMMUNE</th>         
              </tr>
            </thead>
            <tbody id="table3">
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>                           
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
    </div>

    <?php include VIEWPATH.'includes/legende.php'; ?> 
    <?php include VIEWPATH.'includes/scripts_js.php'; ?>


    </body>
  <script src='https://api.mapbox.com/mapbox.js/plugins/leaflet-markercluster/v1.0.0/leaflet.markercluster.js'></script>
  <link href='https://api.mapbox.com/mapbox.js/plugins/leaflet-markercluster/v1.0.0/MarkerCluster.css' rel='stylesheet' />
  <link href='https://api.mapbox.com/mapbox.js/plugins/leaflet-markercluster/v1.0.0/MarkerCluster.Default.css' rel='stylesheet' />

   <script>   
    L.mapbox.accessToken = 'pk.eyJ1IjoibWFydGlubWJ4IiwiYSI6ImNrMDc1MmozajAwcGczZW1sMjMwZWxtZDQifQ.u8xhrt1Wn4A82X38f5_Iyw';
    // var map = L.mapbox.map('map')
    //   .setView([40, -74.50], 9)
    //   .addLayer(L.mapbox.styleLayer('mapbox://styles/mapbox/streets-v11'));
    var centre='<?=$centre?>';
    var centre = centre.split(',');
    var zoom ='<?= $zoom?>';
    var map = L.mapbox.map('map')
    .setView([centre[0],centre[1]],zoom)
    .addLayer(L.mapbox.styleLayer('mapbox://styles/mapbox/streets-v11'));
    var clusterGroup= new L.MarkerClusterGroup();
    var donnprov ='<?= $donnees_provinces?>';
    var donnprov = donnprov.split('@');
    for (var i = 0; i<(donnprov.length)-1;  i++){
            var index =donnprov[i].split('<>');
            var marker = L.marker([index[2],index[3]],

     {
    icon: L.mapbox.marker.icon({
        'marker-color':'blue',
        'marker-symbol':'restaurant',
        'marker-size':'large'
      })
    // icon: L.mapbox.icon({
    //   'marker-color':'red',
    //   'marker-symbol':'cafe',
    //   'marker-size':'large'
    // })
      });
     marker.bindPopup('<h5>'+ index[1]+'</h5>  <a class="btn btn-secondary" onclick="get_detail('+index[0]+')">detail</a>');
      clusterGroup.addLayer(marker);
     }
    // var popup = L.popup(latlng, {content: '<p>Hello world!<br />This is a nice popup.</p>')
    // .openOn(map);
     map.addLayer(clusterGroup);
     L.circle([-3.08459, 29.3948], {radius: 20000}).addTo(map);
     L.circle([-3.43143, 29.9079], {radius: 2000}).addTo(map);
     var latlngs = [
        [-3.34607, 29.4835],
        [-3.3931005, 29.3690935],
        [-3.94794, 29.6169]
      ];
     var polygon = L.polygon(latlngs, {color: 'black'}).addTo(map);   
     var latlngs = [
      [-3.43143, 29.9079],
      [-3.01417, 29.3533],
     
      ];
    // var popup = L.popup()
    //     .setLatLng(latlng)
    //     .setContent('<p>Hello world!<br />This is a nice popup.</p>')
    //     .openOn(map);


  var polyline = L.polyline(latlngs, {color: 'red'}).addTo(map);

// zoom the map to the polyline
  map.fitBounds(polyline.getBounds());


  var polyline = L.polyline(latlngs, {color: 'red'}).addTo(map);

// zoom the map to the polyline
 // map.fitBounds(polyline.getBounds());

  </script>
 

<script>
  function get_detail(ID_PROVINCE)
    {
 
    var id_province=ID_PROVINCE;

      $("#respons").modal("show");
      $("#mytable").DataTable({
      "destroy" : true,
      "processing":true,
      "serverSide":true,
      "oreder":[[ 1, 'asc' ]],
      "ajax":{
       url:"<?=base_url()?>culture/Carte/detail/"+id_province,
        type:"POST",
        data : { },
        beforeSend : function() {
        }
      },
      lengthMenu: [[10,50, 100, -1], [10,50, 100, "All"]],
      pageLength: 10,
      "columnDefs":[{
        "targets":[],
        "orderable":false
      }],
      dom: 'Bfrtlip',
      buttons: ['excel', 'pdf'],
      language: {
        "sProcessing":     "Traitement en cours...",
        "sSearch":         "Rechercher&nbsp;:",
        "sLengthMenu":     "Afficher _MENU_ &eacute;l&eacute;ments",
        "sInfo":           "Affichage de l'&eacute;l&eacute;ment _START_ &agrave; _END_ sur _TOTAL_ &eacute;l&eacute;ments",
        "sInfoEmpty":      "Affichage de l'&eacute;l&eacute;ment 0 &agrave; 0 sur 0 &eacute;l&eacute;ment",
        "sInfoFiltered":   "(filtr&eacute; de _MAX_ &eacute;l&eacute;ments au total)",
        "sInfoPostFix":    "",
        "sLoadingRecords": "Chargement en cours...",
        "sZeroRecords":    "Aucun &eacute;l&eacute;ment &agrave; afficher",
        "sEmptyTable":     "Aucune donn&eacute;e disponible dans le tableau",
        "oPaginate": {
          "sFirst":      "Premier",
          "sPrevious":   "Pr&eacute;c&eacute;dent",
          "sNext":       "Suivant",
          "sLast":       "Dernier"
        },
        "oAria": {
          "sSortAscending":  ": activer pour trier la colonne par ordre croissant",
          "sSortDescending": ": activer pour trier la colonne par ordre d&eacute;croissant"
        }
      }
    });

  
   }

</script>
  </html>

