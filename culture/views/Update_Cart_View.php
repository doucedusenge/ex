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
							<h4 style='color:#007bac'>Enregistrer un magasinier</h4>

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

              <form method="post" action="<?=base_url()?>culture/Cart/insertionEdit">

              	<div class="row">
              		<div class="col-xl-12">
              			<!- <label> *<font color="red">*</font></label>

              			<font color="red" id="error_nom"></font>
              			<?php
                   // echo form_error('Culture', '<div class="text-danger">', '</div>'); ?>
               </div>

               <div class="col-md-12">

               	<div class="col-md-12">
               		<label>NOM
               			<?php  print_r($data['magasinier']); ?>
               		 <font color="red">*</font></label>
               		<select class="form-control" name="magasinier" id="magasinier" class="form-control select2">
               			<option value=""> selectionner</option>
               			<?php foreach ($magasinier as $value) { if ($value['ID_MAGASINIER'] == $data['ID_MAGASINIER']) { ?>

               				<option value="<?= $value['ID_MAGASINIER']?>" selected><?= $value['NOM']?></option>

               			<?php  }else{?>
               				<option value="<?= $value['ID_MAGASINIER']?>" ><?= $value['NOM']?></option>
               			<?php }
               		}
               		?>                  

               	</select>
               	<span><?= form_error('magasinier') ?></span>
               </div>

               <div class="col-md-6">
               	<label>Fonction        	<?php 
                        print_r($data['ID_FONCTION']);
               	?><font color="red">*</font></label>
               	<select class="form-control" name="id_fonction" id="id_fonction" class="form-control select2">              
               		<option value=""> selectionner</option>
               		<?php
               		$fonction =$this->Model->getRequete('SELECT `ID_FONCTION`, `DESCR_FONCTION` FROM `fonction` ');
               		foreach ($fonction as $key)
               		{

               			echo "<option value='".$key['ID_FONCTION']."' >".$key['DESCR_FONCTION']."</option>";


               		}
               		?>
               	</select>
               	<span><?= form_error('ID_FONCTION') ?></span>
               </div>

           </div>


       </div>
       <div class="row">
       	<div class="col-md-4" style="margin-top: 31px;" >
       	</div>
       	<div class="card-footer col-md-3" style="margin-top: 3px;" >
       		<button type="button" style="float: center;width: 100%;" class="btn btn-primary" onclick="info_cart()" ><span class="fa fa-plus"></span>  </button>
       		<div class="row">
      <!--   <div class="col-xl-12 col-xxl-12">
    
        </div>
    -->              </div>
    <div class="col-md-4" style="margin-top: 31px;" >
    </div>
</div>
<div class="row" id="CART_FILE"></div>
<button type="submit" style="float: center;width: 100%;" class="btn btn-primary" ><span class="fa fa-save"></span> enregistre </button>
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

</body><script type="text/javascript">
	$(document).ready(function(){
		get_cart_id(<?=$id_dev?>)
	})
</script>
<script type="text/javascript">

	function info_cart()
	{
		new_file();
    //$('#BtnInfo_cart')[0].reset();

    var file=new FormData();
    var ID_FONCTION=$('#occupation').val();
     //alert(ID_HOBBY)
     file.append('ID_FONCTION',ID_FONCTION);


     if (ID_FONCTION!="") 
     {
     	$.ajax({
     		url:"<?=base_url('formation/Panier/add_in_cart')?>",
     		data:file,
     		type:'POST',
     		contentType:false,
     		processData:false,
     		success:function(response)
     		{
     			if (response) 
     			{
     				$('#CART_FILE').html(response);
     				CART_FILE.innerHTML=response;
     				$('#SHOW_FOOTER').show();
     				$('#ID_FONCTION').val('');


     				$('#ID_FONCTION').css('border-color','#4169E1');
     				$('#BtnInfo_cart').attr('disabled',false);

     			}else{

     				$('#SHOW_FOOTER').show();
     			}
     		}

     	});
     }else{
     	var valid=true;
     	if(!$('#ID_FONCTION').val())
     	{

     		$('#ID_FONCTION').css('border-color','red');
     		valid=false;
     	}else{

     		$('#ID_FONCTION').css('border-color','#4169E1');
     		valid=true;
     	}

     	return valid;
     }


 }
    //info_cart(); 
    
    $("#hobby").change(function()
    {
    	$('#BtnInfo_cart').attr('disabled',false);
    });



//Fonction pour la suppression dans le cart
function remove_cart(id)
{

	var rowid=$('#rowid'+id).val();
	console.log('id'+rowid);

	$.post('<?=base_url('culture/Cart/remove_cart')?>',
	{
		rowid:rowid
	},function(data)
	{
		if (data) 
		{
			CART_FILE.innerHTML=data;
			$('#CART_FILE').html(data);
			$('#SHOW_FOOTER').hide();
		}
		else
		{
			$('#SHOW_FOOTER').hide();
		}


	})
}

function new_file()
{
        //$('#myform1')[0].reset(); 
        $('#btnNew_File').html('Chargement....');
        $('#btnNew_File').attr("disabled",false);
        var DEVELOPPEUR = $('#magasinier').val();

        if($('#magasinier').val()==''){
        	$('#magasinier').css('border-color','red');
        }else{
        	$('#magasinier').css('border-color','green');


        	var url1;
        	var test_vide=1; 

        	url1="<?php echo base_url('culture/Cart')?>";
        	var formData1 = new FormData($('#file_form')[0]);


        	if (DEVELOPPEUR=='') {
        		test_vide=0
        		$("#dev_error").html("Le champ est obligatoire");
        	}else{
        		test_vide=1
        		$("#dev_error").html("");
        	}


        	if (test_vide=1 ) {
        		$.ajax({

        			url:url1,
        			type:"POST",
        			data:formData1,
        			contentType:false,
        			processData:false,
        			dataType:"JSON",
        			success: function(data)
        			{
        				if(data.status) 
        				{
        					window.location.replace('<?= base_url('/culture/Cart/') ?>');
        				}


        				$('#btnNew_File').text('Enregistrer');
        				$('#btnNew_File').attr('disabled',false); 


        			},
        			error: function (jqXHR, textStatus, errorThrown)
        			{
              // alert('Erreur s\'est produite');
              $('#btnNew_File').text('Enregistrer');
              $('#btnNew_File').attr('disabled',false);

          }


      });

        	}else{
        		$('#SHOW_FOOTER').show();
        		$('#btnNew_File').text('Enregistrer');
        		$('#btnNew_File').attr('disabled',false);
        		$('#myform1')[0].reset();
        	}

        }
    }
</script>

<script type="text/javascript">
	function get_cart_id(id=<?=$id_dev?>)
	{

  // alert(id)
    $.post('<?=base_url('culture/Cart/editerCart')?>',
  {
  	id:id
  },
  function(data)
  {

    // alert(data)
    $('#CART_FILE').html(data);
});
}
</script>

<?php include VIEWPATH.'includes/legende.php'; ?> 


</html>

