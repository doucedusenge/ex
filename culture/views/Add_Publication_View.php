<!DOCTYPE html>
<html lang="en">

<head>

  <?php include VIEWPATH.'includes/header.php'; ?>

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
              <h4 style='color:#007bac'>Enregistrer la publication</h4>

            </div>
          </div>
          <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
            

           <button class="btn btn-primary"><a style="color: white;" href="<?=base_url('culture/Publication/listing')?>"><span class="fa fa-list"></span> Liste</a></button> 
          </div>
        </div>
        <!-- row -->
        <div class="row">
          <div class="col-xl-12 col-xxl-12">
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


                  <form method="post" action="<?=base_url()?>culture/Publication/save">

                  <div class="row">
                      <div class="col-xl-6">
                       <label>Culture<font color="red">*</font></label>
                     
                <font color="red" id="error_nom"></font>
                <?php
                // echo form_error('Culture', '<div class="text-danger">', '</div>'); ?>
                      </div>
              
                        <div class="col-xl-6">
  
                    <div class="col-xl-6">
                    <label>Code Fournisseur<font color="red">*</font></label>
                    <input class="form-control" type="text" name="CODE_FOURNISSEUR" id="CODE_FOURNISSEUR" placeholder="code" value="<?= set_value('CODE_FOURNISSEUR') ?>">
                    <span><?= form_error('CODE_FOURNISSEUR') ?></span>
                    </div> 
                   <div class="col-xl-6">
                    <label>Secteur Activite<font color="red">*</font></label>
                  <select class="form-control" name="ID_SECTEUR_ACTIVITE" id="ID_SECTEUR_ACTIVITE">
                      <option value=""> selectionner</option>
                      <?php foreach ($secteur as $value): ?>
                        <option value="<?= $value['ID_SECTEUR_ACTIVITE']?>"><?= $value['DESCR_SECTEUR_ACTIVITE']?></option>
                      <?php endforeach ?>
                    </select>
                         <span><?= form_error('ID_SECTEUR_ACTIVITE') ?></span>
                    



                 <label>Article<font color="red">*</font></label>
                  <select class="form-control" name="ID_ARTICLE" id="ID_ARTICLE">
                      <option value=""> selectionner</option>
                      <?php foreach ($articles as $value): ?>
                        <option value="<?= $value['ID_ARTICLE']?>" <?php if ($value['ID_ARTICLE']==set_value('ID_ARTICLE')): ?>
                          selected

                        <?php endif ?> ><?= $value['DESCR_ARTICLE']?></option>
                      <?php endforeach ?>
                    </select>
                         <span><?= form_error('ID_ARTICLE') ?></span>



                     <label>unite de mesure<font color="red">*</font></label>
                  <select class="form-control" name="ID_UNITE_MESURE" id="ID_UNITE_MESURE">
                      <option value=""> --selectionner--</option>
                      <?php foreach ($unite_mesure as $value): ?>
                        <option value="<?= $value['ID_UNITE_MESURE']?>" <?php if ( $value['DESCR_UNITE_MESURE']==set_value('ID_UNITE_MESURE')): ?>
                          selected
                        <?php endif ?> ><?= $value['DESCR_UNITE_MESURE']?></option>
                      <?php endforeach ?>
                    </select> 
                         <span><?= form_error('ID_UNITE_MESURE') ?></span>

                    <label>QUANTITE<font color="red">*</font></label>
                    <input class="form-control" type="text" name="QUANTITE" id="QUANTITE" placeholder="QUANTITE" value="<?=set_value('QUANTITE')?>">
                    <span><?= form_error('QUANTITE')?></span>

                    <label>PRIX<font color="red">*</font></label>
                    <input class="form-control" type="text" name="PRIX" id="PRIX" placeholder="prix"  value="<?=set_value('PRIX')?>">
                    <span><?=form_error('PRIX')?></span>

                <font color="red" id="error_nom"></font>
                <?php echo form_error('SUP', '<div class="text-danger">', '</div>'); ?> 
                  </div>


                  </div>

              
                </div>
            <div class="row">
              <div class="col-md-4" style="margin-top: 31px;" >
              </div>
              <div class="col-md-4" style="margin-top: 31px;" >
                <button type="submit" style="float: center;width: 100%;" class="btn btn-primary" ><span class="fa fa-save"></span> Enregistrer </button>
              </div>
              <div class="col-md-4" style="margin-top: 31px;" >
              </div>
            </div>
            
          </form>
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

   
    <?php include VIEWPATH.'includes/legende.php'; ?> 


    </html>



