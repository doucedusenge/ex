<?php 
/** 
 * auteur:Douce
 Date:le 01/03/2023
 */ 
class Karangamuntu extends CI_Controller
{
	
	function __construct()
	{
		// code...
		parent::__construct();
	}

	function index()
	{
		$flux = file_get_contents('php://input');
		$array_form = array('DATA_JSON'=>$flux);

	    $this->Model->create('json_test',$array_form);

		$this->traitement();
	}

      // fonction pour le traitement
	function traitement($value='')
	{
		$FORMATION=$this->Model->getList("json_test",array('TRAITER'=>0));

	    foreach ($FORMATION as $key) {

		$DATA_JSON = $key['DATA_JSON'];
		$ID=$key['ID'];
		$DATA_JSON = str_replace("/","_", $DATA_JSON);
		$DATA_JSON = json_decode($DATA_JSON);
		echo $DATA_JSON->_id;		
		echo $DATA_JSON->imyidondoro_nom;
		echo $DATA_JSON->imyidondoro_prenom;
		echo $DATA_JSON->imyidondoro_mere;
		echo $DATA_JSON->imyidondoro_pere;
		echo $DATA_JSON->imyidondoro_commune;
		echo $DATA_JSON->imyidondoro_fonction;
		echo $DATA_JSON->imyidondoro_province;
		echo $DATA_JSON->imyidondoro_commune;
		echo $DATA_JSON->imyidondoro_zone;
		echo $DATA_JSON->imyidondoro_etat_civil;
		echo $DATA_JSON->imyidondoro_etat_civil;
		echo $DATA_JSON->umuntu_image;
		echo $DATA_JSON->umuntu_photo;
		echo $DATA_JSON->_submission_time;
		echo $DATA_JSON->_attachments[0]->mimetype;
		echo $DATA_JSON->amatohoza_amatohoza_repeat[0]->amatohoza_amatohoza_repeat_zone3;
		echo $DATA_JSON->amatohoza_amatohoza_repeat[0]->amatohoza_amatohoza_repeat_date;
	}
		
		foreach ($DATA_JSON->_attachments as $key) {
			# code...
			echo $key->id;
			echo $key->mimetype;
			
		}
		  foreach ($DATA_JSON->amatohoza_amatohoza_repeat as $value ) {	
				# code..
			echo $value->amatohoza_amatohoza_repeat_date;
			echo $value->amatohoza_amatohoza_repeat_zone3;
			echo $value->amatohoza_amatohoza_repeat_commune2;
			echo $value->amatohoza_amatohoza_repeat_province2;
		}

	     echo"<pre>";
	      print_r($DATA_JSON);die();  

	      //Traitement de image 
      if (isset($DATA_JSON->liste_signature)) {
            # code...
        $SIGNATURE=$DATA_JSON->liste_signature;
      }
         
      if($SIGNATURE !=NULL){
        $image_url = $DATA_JSON->_attachments[0]->download_medium_url;
        $image_url = str_replace("https:__kc.kobotoolbox.org_media_original?media_file", "   https:__kc.kobotoolbox.org_media_medium?media_file", $image_url);
           file_put_contents('culture/'.$SIGNATURE, file_get_contents($image_url));
        
      }  
      //traiteme  d'image (signature)
         $IGIKUMU=NULL;
      if (isset($DATA_JSON->liste_signature)) {
            # code...
        $IGIKUMU=$DATA_JSON->liste_signature;
      }
         
      if($IGIKUMU !=NULL){
        $image_url = $DATA_JSON->_attachments[0]->download_medium_url;
        $image_url = str_replace("https:__kc.kobotoolbox.org_media_original?media_file", "   https:__kc.kobotoolbox.org_media_medium?media_file", $image_url);
           file_put_contents('culture/'.$SIGNATURE, file_get_contents($image_url));
        
      } 
  			
	                     	
	    $data_insert=array(
	      		'IZINA'=>$DATA_JSON->imyidondoro_nom,
	      		'AMATAZIRANO'=>$DATA_JSON->imyidondoro_prenom,
	      		'SE'=>$DATA_JSON->imyidondoro_pere,
	      		'NYINA'=>$DATA_JSON->imyidondoro_mere,	      		
	      		'ZONE_ID'=>$DATA_JSON->imyidondoro_zone,	      		
	      		'AKAZI_AKORA'=>$DATA_JSON->imyidondoro_fonction,
	      		'ARUBATSE_ID'=>$DATA_JSON->imyidondoro_etat_civil,
	      		'ITARIKI'=>$DATA_JSON->_submission_time,
	      		'IGIKUMU'=>$DATA_JSON->umuntu_image,
	      		'PHOTO'=>$DATA_JSON->umuntu_photo, 
	      		
	      	);
	      	$table='karangamuntu';
	        $carte=$this->Model->insert_last_id($table,$data_insert);   
			  foreach ($DATA_JSON->amatohoza_amatohoza_repeat as $key ) {	
					$DATA_JSON->amatohoza_amatohoza_repeat=array(
					    'ITARIKI'=>$key->amatohoza_amatohoza_repeat_date,
					    'ZONE_ID'=>$key->amatohoza_amatohoza_repeat_zone3,
					    'KARANGAMUNTU_ID'=>$carte,
				);	
	      	 	$tablee='ahoyabaye';
    		  $this->Model->create($tablee,$DATA_JSON->amatohoza_amatohoza_repeat);

											
		}
	      	  
	
  			
			

			
	}
}

	


?>