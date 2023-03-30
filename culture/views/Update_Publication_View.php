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
              <h4 style='color:#007bac'>Modifie la publication</h4>

            </div>
          </div>
          <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
            

           <button class="btn btn-primary"><a style="color: white;" href="<?=base_url('culture/Publication/')?>"><span class="fa fa-list"></span> Liste</a></button> 
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


                  <form method="post" action="<?=base_url()?>culture/Publication/update">

                  <div class="row">
                      <div class="col-xl-6">
                       <label>Publication<font color="red">*</font></label>
                     
                <font color="red" id="error_nom"></font>
                <?php
                // echo form_error('Culture', '<div class="text-danger">', '</div>'); ?>
                      </div>
              
                        <div class="col-xl-6">

                    <input type="hidden" name="ID_PUBLICATION"  value="<?=$data['ID_PUBLICATION']?>">
                    <div class="col-xl-6">
                    <label>Code Fournisseur<font color="red">*</font></label>
                    <input class="form-control" type="text" value="<?=$data['CODE_FOURNISSEUR']?>" name="CODE_FOURNISSEUR" id="CODE_FOURNISSEUR" placeholder="code" >
                    </div> 
                   <div class="col-xl-6">
                    <label>Article<font color="red">*</font></label>
                  <select class="form-control" name="ID_ARTICLE" id="ID_ARTICLE">
                      <option value=""> selectionner</option>
                      <?php foreach ($articles as $value) { if ($value['ID_ARTICLE'] == $data['ID_ARTICLE']) { ?>

                            <option value="<?= $value['ID_ARTICLE']?>" selected><?= $value['DESCR_ARTICLE']?></option>
                           
                      <?php  }else{?>
                        <option value="<?= $value['ID_ARTICLE']?>" ><?= $value['DESCR_ARTICLE']?></option>
                      <?php }

                          }

                       ?>                      
                    </select>
                
                       <label>Secteur Activite<font color="red">*</font></label>
                  <select class="form-control" name="ID_SECTEUR_ACTIVITE" id="ID_SECTEUR_ACTIVITE">
                      <option value=""> selectionner</option>
                      <?php 
                        foreach ($secteur as $value) { 
                          if ($value['ID_SECTEUR_ACTIVITE'] == $data['ID_SECTEUR_ACTIVITE']) { ?>

                            <option value="<?= $value['ID_SECTEUR_ACTIVITE']?>" selected><?= $value['DESCR_SECTEUR_ACTIVITE']?></option>
                           
                      <?php  }else{?>
                        <option value="<?= $value['ID_SECTEUR_ACTIVITE']?>" ><?= $value['DESCR_SECTEUR_ACTIVITE']?></option>
                      <?php }

                          }
                       ?>                      
                    </select>

                  <label>unite de mesure<font color="red">*</font></label>
                  <select class="form-control" name="ID_UNITE_MESURE" id="ID_UNITE_MESURE">
                      <option value=""> --selectionner--</option>
                        <?php 
                        foreach ($unite_mesure as $value) { 
                          if ($value['ID_UNITE_MESURE'] == $data['ID_UNITE_MESURE']) { ?>

                            <option value="<?= $value['ID_UNITE_MESURE']?>" selected><?= $value['DESCR_UNITE_MESURE']?></option>
                           
                      <?php  }else{?>
                        <option value="<?= $value['ID_UNITE_MESURE']?>" ><?= $value['DESCR_UNITE_MESURE']?></option>
                      <?php }

                          }
                       ?> 
                    </select> 
                    <label>QUANTITE<font color="red">*</font></label>
                    <input class="form-control" type="text" name="QUANTITE" value="<?=$data['QUANTITE']?>" id="QUANTITE" placeholder="QUANTITE" >

                    <label>PRIX<font color="red">*</font></label>
                    <input class="form-control" type="text" name="PRIX" value="<?=$data['PRIX']?>" id="PRIX" placeholder="prix" >

                <font color="red" id="error_nom"></font>
                <?php echo form_error('SUP', '<div class="text-danger">', '</div>'); ?> 
                  </div>


                  </div>

              
                </div>
            <div class="row">
              <div class="col-md-4" style="margin-top: 31px;" >
              </div>
              <div class="col-md-4" style="margin-top: 31px;" >
                <button type="submit" style="float: center;width: 100%;" class="btn btn-primary" onclick=""><span class="fa fa-save"></span> Enregistrer </button>
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



