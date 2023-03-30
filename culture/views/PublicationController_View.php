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
             <h4 style='color:#007bac'>Liste des cultures</h4>
            <!--<a href="<?=base_url()?>culture/Biodata/add" class="btn btn-primary">Nouveau</a>-->
              <button class="btn btn-dark float-right" onclick="new_Publi()" >ajouter </button>
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
                        
                        <th>PUBLICATION</th>
                        <th>CODE FOURNISSEUR</th>
                        <th>SECTEUR_ACTIVITE</th>
                        <th>ARTICLE</th>
                        <th>UNITE MESURE</th>
                        <th>QUANTITE</th>
                        <th>PRIX</th>
                                          
                        <th>ACTION</th>                    
                      </tr>
                    </thead>
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

<!-- modal create -->

<div class="modal fade" id="test_modal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <form id="myForm">
        <h6>Formulaire d'ajout </h6>

        <input type="hidden" name="ID_PUBLICATION" id="ID_PUBLICATION">
        <div class="form-group col-sm-12">
  
                <div >
                    <label>Code Fournisseur<font color="red">*</font></label>
                    <input class="form-control" type="text" name="CODE_FOURNISSEUR" id="CODE_FOURNISSEUR" placeholder="code" value="<?= set_value('CODE_FOURNISSEUR') ?>">
                    <span><?= form_error('CODE_FOURNISSEUR') ?></span>

                   <label>Secteur Activite<font color="red">*</font></label>
                  <select class="form-control" name="ID_SECTEUR_ACTIVITE" id="ID_SECTEUR_ACTIVITE">
                      <option value=""> selectionner</option>
                      <?php foreach ($secteur as $value): ?>
                        <option value="<?= $value['ID_SECTEUR_ACTIVITE']?>"><?= $value['DESCR_SECTEUR_ACTIVITE']?></option>
                      <?php endforeach ?>
                    </select>
                         <span><?= form_error('ID_SECTEUR_ACTIVITE') ?></span>




                     <label>unite de mesure<font color="red">*</font></label>
                  <select class="form-control" name="ID_UNITE_MESURE" id="ID_UNITE_MESURE">
                      <option value=""> --selectionner--</option>
                      <?php foreach ($unite_mesure as $value): ?>
                        <option value="<?= $value['ID_UNITE_MESURE']?>">
                        <!--   selected
                        <?php endif ?> ><?= $value['DESCR_UNITE_MESURE']?></option>
                      <?php endforeach  -->?>
                    </select> 
                         <span><?= form_error('ID_UNITE_MESURE') ?></span>
                         

                     <label>QUANTITE<font color="red">*</font></label>
                    <input class="form-control" type="text" name="QUANTITE" id="QUANTITE" placeholder="QUANTITE" value="<?=set_value('QUANTITE')?>">
                    <span><?= form_error('QUANTITE')?></span>

                    <label>PRIX<font color="red">*</font></label>
                    <input class="form-control" type="text" name="PRIX" id="PRIX" placeholder="prix"  value="<?=set_value('PRIX')?>">
                    <span><?=form_error('PRIX')?></span>    


                   <!--   <label>Article<font color="red">*</font></label>
                  <select class="form-control" name="ID_ARTICLE" id="ID_ARTICLE">
                      <option value=""> selectionner</option>
                      <?php foreach ($articles as $value): ?>
                        <option value="<?= $value['ID_ARTICLE']?>" <?php if ($value['ID_ARTICLE']==set_value('ID_ARTICLE')): ?>
                          selected

                        <?php endif ?> ><?= $value['DESCR_ARTICLE']?></option>
                      <?php endforeach ?>
                    </select>
                         <span><?= form_error('ID_ARTICLE') ?></span>
      -->

                    

                <!--  <label>ARTICLE</label> -->
                 <!-- <select required class="form-control" name="ID_ARTICLE" id="ID_ARTICLE" required>
                  <option value="">---Sélectionner---</option>
                                <?php
                                foreach ($articles as $value) {
                                    ?>
                                    <option value="<?= $value['ID_ARTICLE'] ?>"><?= $value['DESCR_ARTICLE'] ?></option>
                                    <?php
                                }
                                ?>
                            </select> -->
                 <!--            <select class="form-control" name="ID_ARTICLE" id="ID_ARTICLE">
                                <option value="">---Sélectionner---</option>
                                <?php
                                foreach ($articles as $value) {
                                    ?>
                               <option value="<?= $value['ID_ARTICLE'] ?>"><?= $value['DESCR_ARTICLE'] ?></option>
                                    <?php
                                }
                                ?>
                            </select>
 -->


            <!--              <span><?= form_error('ID_ARTICLE') ?></span>
                </div>

         
                 <label>ACTIVITE</label>
                 <select required class="form-control" name="ID_SECTEUR_ACTIVITE" id="ID_SECTEUR_ACTIVITE" required>
                  <option value="">---Sélectionner---</option>
                                <?php
                                foreach ($secteur as $value) {
                                    ?>
                                    <option value="<?= $value['ID_SECTEUR_ACTIVITE'] ?>"><?= $value['DESCR_SECTEUR_ACTIVITE'] ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                         <span><?= form_error('ID_SECTEUR_ACTIVITE') ?></span> -->



                <!--  <label>Article<font color="red">*</font></label>
                  <select class="form-control" name="ID_ARTICLE" id="ID_ARTICLE">
                      <option value=""> selectionner</option>
                      <?php foreach ($articles as $value): ?>
                        <option value="<?= $value['ID_ARTICLE']?>" <?php if ($value['ID_ARTICLE']==set_value('ID_ARTICLE')): ?>
                          selected

                        <?php endif ?> ><?= $value['DESCR_ARTICLE']?></option>
                      <?php endforeach ?>
                    </select>
                         <span><?= form_error('ID_ARTICLE') ?></span> -->



                 <!--     <label>unite de mesure<font color="red">*</font></label>
                  <select class="form-control" name="ID_UNITE_MESURE" id="ID_UNITE_MESURE">
                      <option value=""> --selectionner--</option>
                      <?php foreach ($unite_mesure as $value): ?>
                        <option value="<?= $value['ID_UNITE_MESURE']?>" <?php if ( $value['DESCR_UNITE_MESURE']==set_value('ID_UNITE_MESURE')): ?>
                          selected
                        <?php endif ?> ><?= $value['DESCR_UNITE_MESURE']?></option>
                      <?php endforeach ?>
                    </select> 
                         <span><?= form_error('ID_UNITE_MESURE') ?></span> -->
<!-- 
                    <label>QUANTITE<font color="red">*</font></label>
                    <input class="form-control" type="text" name="QUANTITE" id="QUANTITE" placeholder="QUANTITE" value="<?=set_value('QUANTITE')?>">
                    <span><?= form_error('QUANTITE')?></span>

                    <label>PRIX<font color="red">*</font></label>
                    <input class="form-control" type="text" name="PRIX" id="PRIX" placeholder="prix"  value="<?=set_value('PRIX')?>">
                            <font id="erCOURS" color="red"></font> -->
        </div>

            <br>

           <!-- <input type="submit" name="submit" value="Enregistrer" class="btn btn-secondary">-->
        
        <div class="modal-footer">
                    <button type="button" class="btn btn-dark" data-dismiss="modal">close</button>
                    <button type="button" id="btnSave" onclick="save_publication();"  class="btn btn-success">trer</button>
                </div>
      </form>
    </div>
  </div>
</div>

</body>
<!-- <?php include VIEWPATH.'includes/legende.php';?> -->

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
        url:"<?php echo base_url('culture/PublicationController/listing/');?>",
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
 <script type="text/javascript">
       var save_method;
       function new_Publi()
       {
        save_method = 'add';
        $('#test_modal').modal('show');
        $('#myForm')[0].reset();
        //$('.form-group').removeClass('has-error');
       // $('[name = "TEL"]').val('+257');
       // $('.help-block').empty();
        $('#btnSave').text('Enregistrer');
        //$('.modal-title').text('Nouveau Partenaire');
    }
</script> 
<script type="text/javascript">

   function save_publication() {
        var ID_ARTICLE = $('#ID_ARTICLE').val();
        var ID_SECTEUR_ACTIVITE = $('#ID_SECTEUR_ACTIVITE').val();
        var QUANTITE = $('#QUANTITE').val();
        var PRIX = $('#PRIX').val();

        $('#erARTICLE').html('');
        $('#erSECTEUR').html('');
        $('#erQUANTITE').html('');
        $('#erPRIX').html('');
  
        var statut = 2;
        if (ID_ARTICLE == '') {
            statut = 1;
            $('#erARTICLE').html('Le champ est obligatoire');
        }
        if (ID_SECTEUR_ACTIVITE == '') {
            statut = 1;
            $('#erSECTEUR').html('Le champ est obligatoire');
        }
        if (QUANTITE == '') {
            statut = 1;
            $('#erQUANTITE').html('Le champ est obligatoire');
        }

        if (PRIX == '') {
            statut = 1;
            $('#erPRIX').html('Le champ est obligatoire');
        }
 
      var url;
       if (statut == 2) {
          var form_data = new FormData($("#myForm")[0]);
          if(save_method=='add') {
       // alert(save_method)

              url = "<?= base_url('culture/PublicationController/addPublication') ?>";
              $.ajax({
                url: url,
                type: 'POST',
                dataType:'JSON',
                data: form_data ,
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) 

                {
                    console.log(data)
                                    // alert("hh");
                                window.location.reload()      
                               Swal.fire({
                                icon: 'success',
                                title: 'Success',
                                text: 'Ajout avec succès !',
                                timer: 2000,
                            }).then(() => {
                             $('#test_modal').modal('hide')
                            })
                            $("#myForm")[0].reset();
                        }
                    })
          } 
          else 
          {
              url = "<?= base_url('culture/PublicationController/update/') ?>";
              Swal.fire({
                title: 'Êtes-vous sûr?',
                text: "Vous souhaitez modifier cet Etudiant !",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Oui, modifier-le!',
                cancelButtonText: "Non",
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: url,
                        type: 'POST',
                        dataType:'JSON',
                        data: form_data ,
                        contentType: false,
                        cache: false,
                        processData: false,
                        success: function(data) {
                          alert();
                           Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: ' Modification avec succès !',
                            timer: 1500,
                        }).then(() => {
                            $('#test_modal').modal('hide')
                                
                        })
                        $("#myForm")[0].reset();
                    }
                })
                }
            })
        }
    }
}
</script>

<script type="text/javascript">
  
  function delete($id){

  $table="ecom_publication";
  $this->Model->delete($table,array('ID_PUBLICATION'=>$id));

  echo json_encode(array('status' => TRUE));
}
</script>
<script type="text/javascript">
  
function Edit_Pub(id) {
    save_method = 'update';
    $('#test_modal').modal('show');
    $('.modal-title').text('Modification d\'un Etudiant');
    $('.form-group').removeClass('has-error');
    $('#btnSave').text('Editer')
    $('#myForm')[0].reset();
    $('.help-block').empty();
    $.ajax({
        url: "<?= base_url() ?>culture/PublicationController/" + id,
        type: "POST",
        dataType: "JSON",
        success: function(data) {
            $('#ID_PUBLICATION').html(data.html_cours);   
            $('#ID_ARTICLE').val(ID_ARTICLE);
            $('#ID_SECTEUR_ACTIVITE').val(data.ID_SECTEUR_ACTIVITE);
            $('#QUANTITE').val(data.QUANTITE);
            $('#PRIX').val(data.PRIX);
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.log('Erreur : ' + textStatus);
        }
    });
}

</script>


<!-- <script>
  function get_sous_menu(id)
    {
         $("#sous_menu").modal("show");
         

       var row_count ="1000000";
       table=$("#mytable3").DataTable({
          "processing":true,
          "destroy" : true,
          "serverSide":true,
          "oreder":[[ 0, 'desc' ]],
          "ajax":{
            url:"<?=base_url()?>culture/Biodata/listing/"+id,
            type:"POST"
        },
        lengthMenu: [[10,50, 100, row_count], [10,50, 100, "All"]],
        pageLength: 10,
        "columnDefs":[{
            "targets":[],
            "orderable":false
        }],

        
        
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

</script> -->

<!------------------------ Modal de liste des filieres ------------------------>


<div class="modal" id="sous_menu" role="dialog">
  <div class="modal-dialog modal-lg ">
    <div class="modal-content">
      <div class="modal-body">
        <div class="table-responsive">
          <table id='mytable3' class="table table-bordered table-striped table-hover table-condensed " style="width: 100%;">
            <thead>
              <tr>
                <th>#</th>
                <th>NOM</th>
                
              </tr>
            </thead>
            <tbody id="table3">

            </tbody>

          </table>

        </div>
        <div >      
          <button class="btn mb-1 btn-primary" class="close" data-dismiss="modal">Quitter</button>
        </div>

      </div>
    </div>
  </div>
</div>

</html>