 <!DOCTYPE html>
<html lang="en">
<head>
  <?php include VIEWPATH.'includes/header.php'; ?>
</head>
<div id="main-wrapper">
    <?php include VIEWPATH.'includes/navybar.php'; ?> 
    <?= include VIEWPATH.'includes/menu.php'; ?>
    <div class="content-body">
      <div class="container-fluid">
         <div class="row page-titles mx-0">
        
          <div class="col-sm-12 p-md-0">
            <div class="welcome-text">
             <h4 style='color:#007bac'>Liste des achats</h4>

            </div>
             <div class="col-sm-12 p-md-0 justify-content-sm-end mt-3 mt-sm-0 d-flex">
            <a class="btn btn-primary" style="color: white; float: right;" href="<?php echo base_url() ?>culture/Alimentation/insert"><span class="fa fa-plus"></span> Nouveau</a>
          </div>
         
          </div>
          
          </div>
          <div class="row">
          <div class="col-xl-12 col-xxl-12">
            <div class="card">
              <div class="card-body">
                <div class="table-responsive">
                  <?=  $this->session->flashdata('message');?>
                    <table id="mytable" class="display" style="min-width: 100%">
                    <thead>
                      <tr>
                        <th>#</th>
                        
                        <th>Client</th>
                        <th>Produit </th>
                                         
                        <th>ACTION</th>                    
                      </tr>
                    </thead>
                    <tbody>
                      
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
 <?php include VIEWPATH.'includes/scripts_js.php'; ?>
</body>

<script>
  $('#message').delay('slow').fadeOut(3000);
  $(document).ready(function()
  {
    var row_count ="1000000";

    $("#mytable").DataTable({
      "processing":true,
      "destroy" : true,
      "serverSide":true,
      "oreder":[[ 0, 'desc' ]],
      "ajax":{
        url:"<?php echo base_url('culture/Alimentation/listing/');?>",
        type:"POST", 
      },
      lengthMenu: [[10,50, 100, row_count], [10,50, 100, "All"]],
      pageLength: 10,
      "columnDefs":[{
        "targets":[],
        "orderable":false
      }],

      dom: 'Bfrtlip',
      buttons: [
       'excel', 'pdf'
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
  });
</script>
</html>
<div class="modal" id="respons" role="dialog">
  <div class="modal-dialog modal-lg ">
    <div class="modal-content">
      <div class="modal-header">
       <h5> Responsables </h5>
        <div >    
          <i class="close fa fa-remove float-left text-primary" data-dismiss="modal"></i>  
         
        </div>
      </div>
      <div class="modal-body">
        <div class="table-responsive">
          <table id='mytable3' class="table table-bordered table-striped table-hover table-condensed " style="width: 100%;">
            <thead>
              <tr>
                <th>#</th>
                <th>NOM PRODUIT</th>
                <th>QUANTITE</th>
             
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
<script>
// THIS FUNCTION IS

  function get_produit(id)
    {
         $("#respons").modal("show");

       var row_count ="1000000";
       table=$("#mytable3").DataTable({
          "processing":true,
          "destroy" : true,
          "serverSide":true,
          "oreder":[[ 0, 'desc' ]],
          "ajax":{
            url:"<?=base_url()?>culture/Alimentation/get_produit/"+id,
            type:"POST"
        },
        lengthMenu: [[10,50, 100, row_count], [10,50, 100, "All"]],
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
            "sLengthMenu":     "Afficher MENU &eacute;l&eacute;ments",
            "sInfo":           "Affichage de l'&eacute;l&eacute;ment START &agrave; END sur TOTAL &eacute;l&eacute;ments",
            "sInfoEmpty":      "Affichage de l'&eacute;l&eacute;ment 0 &agrave; 0 sur 0 &eacute;l&eacute;ment",
            "sInfoFiltered":   "(filtr&eacute; de MAX &eacute;l&eacute;ments au total)",
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