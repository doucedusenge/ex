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
              <h4 style='color:#007bac'>Enregistrer l'achat</h4>

            </div>
          </div>
          <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
            

         <!--   <button class="btn btn-primary"><a style="color: white;" href="<?=base_url('culture/Publication/listing')?>"><span class="fa fa-list"></span> Liste</a></button>  -->
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


                  <form method="post" action="<?=base_url()?>culture/Alimentation/save">

                  <div class="row">
                      <div class="col-xl-6">
                       <label>Achat<font color="red">*</font></label>
                     
                      <font color="red" id="error_nom"></font>
                      <?php
                      // echo form_error('Culture', '<div class="text-danger">', '</div>'); ?>
                            </div>
              
                   <div class="col-md-6">
                    <label>NOM CLIENT<font color="red">*</font></label>
                      <select class="form-control" name="ID_CLIENT" id="ID_CLIENT" class="form-control select2">
                      <option value=""> selectionner</option>
                      <?php foreach ($client as $value): ?>
                        <option value="<?= $value['ID_CLIENT']?>"><?= $value['NOM_CLIENT']?></option>
                      <?php endforeach ?>
                    </select>
                         <span><?= form_error('ID_CLIENT') ?></span>
                    </div>

                   <div class="col-md-6">
                    <label>NOM PRODUIT<font color="red">*</font></label>
                        
     <select id="ID_PRODUIT" name="ID_PRODUIT[]" class="form-control multi-select"  multiple="multiple"  data-live-search="true">
                      <option value="">--Sélectionnez--</option>
                      <?php
                      foreach ($produit as $key) {

                      if(in_array($key['ID_PRODUIT'],$exist)) 
                      {  ?>
           <option value="<?=$key['ID_PRODUIT']?>" selected><?=$key['NOM_PRODUIT']?></option> 
                  <?php   } else {
                  echo "<option value=".$key['ID_PRODUIT']." >".$key['NOM_PRODUIT']." </option>";
                   }
                 }
                 ?>       
      
               </select>
                         <span><?= form_error('ID_PRODUIT') ?></span>
                       </div>

                <div class="col-md-6">
                    <label>QUANTITE<font color="red">*</font></label>
                    <input class="form-control" type="text" name="QUANTITE" id="QUANTITE" placeholder="QUANTITE" value="<?=set_value('QUANTITE')?>">
                    <span><?= form_error('QUANTITE')?></span>

                  </div>
                <font color="red" id="error_nom"></font>
                <?php echo form_error('SUP', '<div class="text-danger">', '</div>'); ?> 
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

<select id="ID_CLIENT" name="ID_CLIENT[]" class="form-control select2 selectpicker"  multiple="multiple"  data-live-search="true">
                      <option value="">--Sélectionnez--</option>
                      <?php
                      foreach ($client as $value) {

                      if(in_array($value['ID_CLIENT'],$exist)) 
                      {  ?>
                       <option value="<?=$value['ID_CLIENT']?>" selected><?=$value['NOM_CLIENT']?></option> 
                  <?php   } else {
                     echo "<option value=".$value['ID_CLIENT']." >".$vaue['NOM_CLIENT']." </option>";
                   }
                 }
                 ?>       
               </select>

