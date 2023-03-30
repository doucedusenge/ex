<!DOCTYPE html>
<html lang="en">

<head>

  <?php include VIEWPATH.'includes/header.php'; ?>

</head>

<body>
  <?php include VIEWPATH.'includes/loadpage.php'; ?>  
  <div id="main-wrapper">
    <?php include VIEWPATH.'includes/navybar.php'; ?> 
    <?= include VIEWPATH.'includes/menu.php'; ?> 

    <div class="content-body">
      <div class="container-fluid">
        <div class="row page-titles mx-0">
          <div class="col-sm-6 p-md-0">
            <div class="welcome-text">
              <h4 style='color:#007bac'><?=$title?></h4>

            </div>
          </div>
          <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
            <!-- <button class="btn btn-primary"><a style="color: white;"href="<?=base_url('culture/Filieres/listing')?>"><font class="fa fa-list"></font>  Liste</a></button> -->
          </div>
        </div>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.2/css/bootstrap-select.min.css">

  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.2/js/bootstrap-select.min.js"></script>

        <!-- row -->
        <div class="row">
          <div class="col-xl-12 col-xxl-12">
            <div class="card">

              <div class="card-body">

               <form method="post" action="<?=base_url()?>culture/Filieres/update">
            <div class="row">
              <input type="hidden" name="ID_FILIERE" id="ID_FILIERE" value="<?=$filières['ID_FILIERE']?>">
          

              <div class="col-lg-4" id="div_nom" >
                <label>Nom de la filère</label>
                <input class="form-control" type="text" name="NOM_FILIERE" id="NOM_FILIERE" placeholder="Nom" value="<?=$filières['NOM_FILIERE']?>">
                 <?php echo form_error('NOM_FILIERE', '<div class="text-danger">', '</div>'); ?> 
              </div>

              
           
              
              <div class="col-md-4" style="margin-top: 31px;" >
                <button style="float: center;width: 100%;" class="btn btn-primary" onclick=""><span class="fa fa-edit"></span> Modifier </button>
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



  <?php include VIEWPATH.'includes/scripts_js.php'; ?>

</body>

<?php include VIEWPATH.'includes/legende.php';?> 


</html>





