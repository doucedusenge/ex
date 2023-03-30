<?php 
/** Ndayizeye eric
 *  eric@mediabox.bi
 * le 28/01/2023
 * Traitement de données de presence dans la formation/paeej
 */ 
class Insccription extends CI_Controller
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

	            $this->Model->insert_last_id('json_test',$array_form);

		$this->traitement();#TODO remove this in production
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

	     echo"<pre>";
	      print_r($DATA_JSON);die();
	            
				// $ID_FORMATION=NULL;
				// if (isset($DATA_JSON->liste_localite_colline)) {
	   //      		# code...
				// 	    $ID_FORMATION=$DATA_JSON->liste_localite_colline;      	

			// $NOM=NULL;
			// 	if (isset($DATA_JSON->form_nom)) {
			// 	        		# code...
			// 	$NOM=$DATA_JSON->form_nom;
			// }

			// $PRENOM=NULL;
			// 	if (isset($DATA_JSON->form_prenom)) {
			// 	        		# code...
			// 	$PRENOM=$DATA_JSON->form_prenom;
			// }
			// $AGE=NULL;
			// 	if (isset($DATA_JSON->form_age)) {
			// 	        		# code...
			// 	$AGE=$DATA_JSON->form_age;
			// }
			
			// $ID_FONCTION=NULL;
			// 	if (isset($DATA_JSON->form_fonction)) {
			// 	        		# code...
			// 	$ID_FONCTION=$DATA_JSON->form_fonction;
			// }
			// $SEXE_ID=NULL;
			// 	if (isset($DATA_JSON->form_fonction)) {
			// 	        		# code...
			// 	$SEXE_ID=$DATA_JSON->form_fonction;
			// }
			// $TELEPHONE=NULL;
			// 	if (isset($DATA_JSON->)) {
			// 	        		# code...
			// 	$TELEPHONE=$DATA_JSON->;
			// }

			// $GMAIL=NULL;
			// 	if (isset($DATA_JSON->begina_gmail)) {
			// 	        		# code...
			// 	$GMAIL=$DATA_JSON->begina_gmail;
			// }

			// $IMAGE=NULL;
			// 	if (isset($DATA_JSON->begina_photo)) {
			// 	        		# code...
			// 	$IMAGE=$DATA_JSON->begina_photo;
			// }
			// $DATE=NULL;
			// 	if (isset($DATA_JSON->begina_date)) {
			// 	        		# code...
			// 	$DATE=$DATA_JSON->begina_date;
			// }

			// $data_insert=array(
			// 	'NOM'=>$NOM,
			// 	'PRENOM'=>$PRENOM,
			// 	'AGE'=>$AGE,
			// 	'TELEPHONE'=>$TELEPHONE,
			// 	'GMAIL'=>$GMAIL,
			// 	'DATE'=>$DATE,
			// 	'ID_FONCTION'=>$ID_FONCTION,
			// 	'SEXE_ID'=>$SEXE_ID

			// )
			// $form_insert=$this->Model->getOne('formation',$data_insert);
			//  if (empty($form_insert)) {
			//  	$this->Model->create('formation',$data_insert);
			// }
			




				}
	

		}	

	}


?>