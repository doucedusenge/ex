<!DOCTYPE html>
<html lang="en">
<head>
  <?php include VIEWPATH.'includes/header.php'; ?>
</head>
<div id="main-wrapper">
    <?php include VIEWPATH.'includes/navybar.php'; ?> 
    <?= include VIEWPATH.'includes/menu.php'; ?>
    <div class="content-body">
      <div class="row">
             <div class="col-md-12">                
              <form id="myform" method="post" action="<?=base_url('culture/Reporting')?>">
                <div class="form-group col-sm-3">
                  <label for="profil">PROVINCE</label>
                  <select  class="form-control" name="PROVINCE_ID" id="PROVINCE_ID" onchange="get_submit()">
                    <option value="">---Sélectionner---</option>
                    <?php
                    foreach ($province as $value) {
                        if($value['PROVINCE_ID']==$PROVINCE_ID)
                        {
                      ?>
                      <option value="<?= $value['PROVINCE_ID'] ?>" selected><?= $value['PROVINCE_NAME'] ?></option><?php
                  }                  
                  else
                  {?>
                  <option value="<?= $value['PROVINCE_ID'] ?>" ><?= $value['PROVINCE_NAME'] ?></option>
                    <?php
                  }                      
                  }                  
                  ?>
              </select>
            <?php echo form_error('PROVINCE_ID', '<div class="text-danger">', '</div>'); ?>
              </div>
           
                <div class="form-group col-sm-3">
                  <label for="profil">Commune</label>
                  <select  class="form-control" name="COMMUNE_ID" id="COMMUNE_ID" onchange="get_communes()">
                    <option value="">---Sélectionner---</option>
                    <?php
                    foreach ($comm as $value) {
                        if($value['COMMUNE_ID']==$COMMUNE_ID)
                        {
                      ?>
                      <option value="<?= $value['COMMUNE_ID'] ?>" selected><?= $value['COMMUNE_NAME'] ?></option><?php
                  }                  
                  else
                  {?>
                  <option value="<?= $value['COMMUNE_ID'] ?>" ><?= $value['COMMUNE_NAME'] ?></option>
                    <?php
                  }                      
                  }                  
                  ?>
              </select>
              <?php echo form_error('COMMUNE_ID', '<div class="text-danger">', '</div>'); ?>
              </div>  
              <div class="form-group col-sm-3">
                  <label for="profil">Zone</label>
                  <select  class="form-control" name="ZONE_ID" id="ZONE_ID" onchange="get_zones()">
                    <option value="">---Sélectionner---</option>
                    <?php
                    foreach ($zone as $value) {
                        if($value['ZONE_ID']==$ZONE_ID)
                        {
                      ?>
                      <option value="<?= $value['ZONE_ID'] ?>" selected><?= $value['ZONE_NAME'] ?></option><?php
                  }                  
                  else
                  {?>
                    <option value="<?= $value['ZONE_ID'] ?>" ><?= $value['ZONE_NAME'] ?></option>
                    <?php
                  }                      
                  }                  
                  ?>
              </select>
              <?php echo form_error('ZONE_ID', '<div class="text-danger">', '</div>'); ?>
              </div>   

              <div class="form-group col-sm-3">
                <label for="profil">     Colline</label>
                <select  class="form-control" name="COLLINE_ID" id="COLLINE_ID" onchange="get_collines()">
                    <option value="">---Sélectionner---</option>
                    <?php
                    foreach ($col as $value) {
                        if($value['COLLINE_ID']==$COLLINE_ID)
                        {
                      ?>
                      <option value="<?= $value['COLLINE_ID'] ?>" selected><?= $value['COLLINE_NAME'] ?></option><?php
                  }                  
                  else
                  {?>
                  <option value="<?= $value['COLLINE_ID'] ?>" ><?= $value['COLLINE_NAME'] ?></option>
                    <?php
                  }                      
                  }                  
                  ?>
              </select>
            <?php echo form_error('COLLINE_ID', '<div class="text-danger">', '</div>'); ?>
              </div>                
                   
                    </form>
                    </div>
                    </div>
                
                <div id="container"></div> 

     <div class="row">
          <!------------------------ Modal de liste des equipements clients ------------------------>
          <div class="modal" id="Modal_equipement" role="dialog">
            <div class="modal-dialog modal-lg ">
              <div class="modal-content">
                <div class="modal-header">
                   <!-- <h5> Equipements </h5> -->
                   <h4 class="modal-title"></h4>
                   <div >    
                      <i class="close fa fa-remove float-left text-primary" data-dismiss="modal"></i> 

                       <select id="" name="" class="form-control multi-select"  multiple="multiple"  data-live-search="true">
                      <option value="">--Sélectionnez--</option>                
            
               </select> 

                  </div>
              </div>

              <div class="modal-body">
                <!-- <div class="table-responsive"> -->
                  <table id='mytable' class="table table-bordered table-striped table-hover table-condensed " style="width: 100%;">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>NOM</th>
                       
                    </tr>
                </thead>
                <tbody id="table3">

                </tbody>

            </table>

            <!-- </div> -->


        </div>        
    </div>
  </div>
 <?php include VIEWPATH.'includes/scripts_js.php'; ?>
</body>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/data.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>
<figure class="highcharts-figure">
  <p class="highcharts-description">
   <!--  Highcharts has extensive support for time series, and will adapt
    intelligently to the input data. Click and drag in the chart to zoom in
    and inspect the data. -->
  </p>
</figure>
<script type="text/javascript">
Highcharts.chart('container', {
  chart: {
    type: 'column'
  },
  title: {

    align:'center',
    text: 'statitique des habitants par province'
  },
  subtitle: {
    text: 'Source: <a href="https://worldpopulationreview.com/world-cities" target="_blank">World Population Review</a>'
  },
  xAxis: {
    type: 'category',
    labels: {
      rotation: -45,
      style: {
        fontSize: '13px',
        fontFamily: 'Verdana, sans-serif'
      }
    }
  },
  yAxis: {
    min: 0,
    title: {
      text: 'Population (millions)'
    }
  },
  legend: {
    enabled: false
  },
  plotOptions: {
            column: {
               cursor:'pointer',

               point:{
                  events: {
                     click: function()
                     {
                             //    alert(this.key);

                                // $("#titre").html("Liste des plantations");
                        $('.modal-title').text('Liste des habitants par province ');

                        $("#Modal_equipement").modal();
                        var row_count ="1000000";
                        $("#mytable").DataTable({
                          "processing":true,
                          "serverSide":true,
                          "bDestroy": true,
                          "oreder":[],
                          "ajax":{
                            url:"<?=base_url('culture/Reporting/detail')?>",
                            type:"POST",
                            data:{
                              key:this.key, 
                          }
                      },
                      lengthMenu: [[10,50, 100, row_count], [10,50, 100, "All"]],
                      pageLength: 10,
                      "columnDefs":[{
                        "targets":[],
                        "orderable":false
                    }],

                      dom: 'Bfrtlip',
                      buttons: [
                          'excel','pdf'
                          ],
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
                }
            },
            dataLabels: {
             enabled: true
         },
         showInLegend: true
     }
    //     series: {
    //         borderWidth: 0,
    //         dataLabels: {
    //             enabled: true,
    //             format: '{point.y:.0f}'
    //         }
    //     }
 },
  tooltip: {
    pointFormat:      'Province: <b>{point.y:.0f} habitants</b>'
  },
  series: [{
    name: 'Province',
    data: [

      // ['Bujumbura', 37.33],
      // ['Bubanza', 31.18],
      // ['cibitoke', 27.79],
      // ['Gitega', 22.23],
      // ['kayanza', 21.91],
      // ['Ngozi', 21.74],
      // ['', 21.32],
      <?=$rapport?>      
    ],
    dataLabels: {
      enabled: true,
      rotation: -90,
      color: '#FFFFFF',
      align: 'right',
      format: '{point.y:.0f}', // one decimal
      y: 10, // 10 pixels down from the top
      style: {
        fontSize: '13px',
        fontFamily: 'Verdana, sans-serif'
      }
    }
  }]
});

</script>
<script>
        function get_submit(){
            $('#COMMUNE_ID').html('');
            myform.action= myform.action;
            myform.submit();
        }

        function get_communes(){
            $('#ZONE_ID').html('');
            myform.action= myform.action;
            myform.submit();
        }

        function get_zones(){
            $('#COLLINE_ID').html('');
            myform.action= myform.action;
            myform.submit();
        }
        function get_collines(){
            $('#PERSONNE_ID').html('');
            myform.action= myform.action;
            myform.submit();
        }

    </script>

</html>