<!DOCTYPE html>
<html lang="en">
<head>
  <?php include VIEWPATH.'includes/header.php'; ?>
</head>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/series-label.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>
<script src="https://code.highcharts.com/themes/high-contrast-light.js"></script>
<div id="main-wrapper">
    <?php include VIEWPATH.'includes/navybar.php'; ?> 
    <?= include VIEWPATH.'includes/menu.php'; ?>
    <div class="content-body">
      <div class="row">
             <div class="col-md-12">                
                <div class=" col-sm-3">
                  <label for="profil">PROVINCE</label>
                  <select  class="form-control" name="PROVINCE_ID" id="PROVINCE_ID" onchange="submit_prov();get_rapport()">
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
                    <div class="form-group col-md-3">
                        Commune
                        <select class="form-control"onchange="submit_com();get_rapport()" name="COMMUNE_ID" id="COMMUNE_ID">
                       </select>
                        </div>
                            <div class="form-group col-md-3">
                            Zone
                            <select class="form-control"onchange="submit_zon();get_rapport()" name="ZONE_ID" id="ZONE_ID">  
                           </select>
                            </div>
                            <div class="form-group col-md-3">
                                Colline
                                <select class="form-control"onchange="submit_zon();get_rapport()" name="COLLINE_ID" id="COLLINE_ID">
                                 </select>
                                </div> 
                              </div>
                            </div>

                <div class="modal fade" id="myModal" role="dialog">
                    <div class="modal-dialog modal-lg" style ="width:1000px">
                      <div class="modal-content  modal-lg">
                        <div class="modal-header">
                          <!--   <button type="button" class="close" data-dismiss="modal">&times;</button> -->
                          <h4 class="modal-title"><span id="titre"></span></h4>
                      </div>
                      <div class="modal-body">
                          <div class="table-responsive">
                            <table id='mytable' class='table table-bordered table-striped table-hover table-condensed' style="width:1000px">
                              <thead>
                                <th>#</th>
                                <th>NOM</th>
                               <th>PROVINCE</th>
                               <th>COMMUNE</th>
                               <th>ZONE</th>
                               <th>COLLINES</th>
                            </thead>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              </div>
          </div>
      </div>
  </div>
                
    <div id="container"  class="col-md-12"></div>

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
 
    </div>
  </div>
<div id="nouveau">
</div>
 <?php include VIEWPATH.'includes/scripts_js.php'; ?>
</body>

<script type="text/javascript">
    $( document ).ready(function() {
        get_rapport();
    // alert();
});
    
</script>
<script> 
    function get_rapport(){
        var PROVINCE_ID=$('#PROVINCE_ID').val();
        var COMMUNE_ID=$('#COMMUNE_ID').val();
        var ZONE_ID=$('#ZONE_ID').val();
        var COLLINE_ID=$('#COLLINE_ID').val();  
      
        $.ajax({
            url : "<?=base_url()?>culture/Habitant/rapport",
            type : "POST",
            dataType: "JSON",
            cache:false,
            data:{
              
                PROVINCE_ID:PROVINCE_ID, 
                COMMUNE_ID:COMMUNE_ID,
                ZONE_ID:ZONE_ID,
                COLLINE_ID:COLLINE_ID,
            
            },
            success:function(data){   
                $('#container').html("");             
                $('#nouveau').html(data.highchart );
                      
                $('#COMMUNE_ID').html(data.comm);
                $('#ZONE_ID').html(data.zon); 
                $('#COLLINE_ID').html(data.col);                 
            },          

        });  
    }
    function submit_prov() {
        $('#COMMUNE_ID').html('');
        $('#ZONE_ID').html('');
        $('#COLLINE_ID').html('');
    }

    function submit_com() {
        $('#ZONE_ID').html('');
        $('#COLLINE_ID').html('');

    }

    function submit_zon() {
        $('#COLLINE_ID').html('');
    }
</script> 
<script type="text/javascript">

 $(document).ready(function(){
  setInterval(function() {
   check_new();
 },1000);
});
</script>


<script type="text/javascript">
  function check_new() {
    $.ajax({
      url : "<?=base_url()?>/culture/Habitant/check_new",
      type : "GET",
      dataType: "JSON",
      cache:false,
      success:function(data) {       
        if(data.new==1) {
          window.location.href="<?= base_url('culture/Habitant/'); ?>";          
        }
      }
    });
  }
</script>

  </html>