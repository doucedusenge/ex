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


                  <form method="post" action="<?=base_url()?>culture/Biodata/update">

                  <div class="row">
                      <div class="col-xl-6">
                       <label>Publication<font color="red">*</font></label>
                     
               		 <font color="red" id="error_nom"></font>
               			<?php
                // echo form_error('Culture', '<div class="text-danger">', '</div>'); ?>
                      </div>
              
                        <div class="col-xl-6">
                        <div class="col-xl-6">
                   	 <input type="hidden" name="ID"  value="<?=$data['ID']?>">  
                   	 <label>Article</label>
                   	<select class="form-control" name="ID_ARTICLE" id="ID_ARTICLE">
                      <option value=""> selectionner</option>
                      <?php foreach ($article as $value) { if ($value['ID_ARTICLE'] == $data['ID_ARTICLE']) { ?>

                            <option value="<?= $value['ID_ARTICLE']?>" selected><?= $value['DESCR_ARTICLE']?></option>
                           
                      <?php  }else{?>
                        <option value="<?= $value['ID_ARTICLE']?>" ><?= $value['DESCR_ARTICLE']?></option>
                      <?php }

                          }

                       ?>                      
                    </select>
                   
                   	<label>Nom de la cooperative<font color="red">*</font></label>
                  <select class="form-control" name="ID_COOPERATIVE" id="ID_COOPERATIVE">
                      <option value=""> selectionner</option>
                      <?php foreach ($cooperative as $value) { if ($value['ID_COOPERATIVE'] == $data['ID_COOPERATIVE']) { ?>

                            <option value="<?= $value['ID_COOPERATIVE']?>" selected><?= $value['NOM_COOPERATIVE']?></option>
                           
                      <?php  }else{?>
                        <option value="<?= $value['ID_COOPERATIVE']?>" ><?= $value['NOM_COOPERATIVE']?></option>
                      <?php }

                          }

                       ?>                      
                    </select>

           	 <label>stock</label>
           	 <input type="text" name="NOMBRE_LIVESTOCK" id="NOMBRE_LIVESTOCK" value="<?=$data['NOMBRE_LIVESTOCK']?>"  class="form-control"> 
       
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



