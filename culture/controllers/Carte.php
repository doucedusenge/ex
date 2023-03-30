
<?php
/*
GIS
@author Douce
-13-03-2023
*/
class Carte extends CI_Controller
{     		
	function __construct()
	{
			# code...
		parent::__construct();
	}

	function index(){
        $province=$this->Model->getRequete('SELECT PROVINCE_ID,PROVINCE_NAME, provinces.PROVINCE_LATITUDE, provinces.PROVINCE_LONGITUDE FROM provinces where 1');
        $nbrProvince = count($province);

        $centre = '-3.4279861,29.9247777';

        $zoom = 9;
        $donnees = '';
        $critaire = '';
        $critaire1 = '';
        $critaire2='';



        $PROVINCE_ID=$this->input->post('PROVINCE_ID');

        if($PROVINCE_ID > 0){
            $critaire = ' AND PROVINCE_ID = '.$PROVINCE_ID;
            $critaire1 = ' AND enqueteur.PROVINCE_ID = '.$PROVINCE_ID;
            $critaire2 = 'AND communes.PROVINCE_ID = '.$PROVINCE_ID;

            $prov = $this->Model->getOne('provinces', array('PROVINCE_ID'=>$PROVINCE_ID));
            $centre = $prov['PROVINCE_LATITUDE'].','.$prov['PROVINCE_LONGITUDE'];
            $zoom = 12;


        }

        foreach ($province as $key_donnees) {

         $donnees = $donnees.$key_donnees['PROVINCE_ID'].'<>'.$key_donnees['PROVINCE_NAME'].'<>'.$key_donnees['PROVINCE_LATITUDE'].'<>'.$key_donnees['PROVINCE_LONGITUDE'].'<>@';

     }

     $COMMUNE_ID = $this->input->post('COMMUNE_ID');

     if($COMMUNE_ID > 0){
       
       $critaire2.= ' AND enqueteur.COMMUNE_ID = '.$COMMUNE_ID; 

       $getcoords = $this->Model->getOne('communes',['COMMUNE_ID'=>$COMMUNE_ID]);
       $coordinates = $getcoords['COMMUNE_LATITUDE'].','.$getcoords['COMMUNE_LONGITUDE'];
       $zoom = 12;
   }         


   $commune=$this->Model->getRequete('SELECT COMMUNE_ID,COMMUNE_NAME, communes.COMMUNE_LATITUDE, communes.COMMUNE_LONGITUDE FROM communes WHERE 1  '.$critaire);
   $nbrCommune = count($commune);


   $donnees1 = '';
   
   if (empty($PROVINCE_ID)) {
    $commune = array();
}


foreach ($commune as $key_donnees1) {
                // code...
    $val_LAT=-3.37972;
    $val_LONG=29.365;


    $lat=$key_donnees1['COMMUNE_LATITUDE'];
    $longi=$key_donnees1['COMMUNE_LONGITUDE'];
             // Calcul distance entre deux cordonnées


    $coord1 = array("lat"=>$val_LAT,"long"=>$val_LONG);
    $coord2 = array("lat"=>$lat,"long"=>$longi);

    $distance = $this->calcule_distance($coord1,$coord2);

    $dist = $distance[0];
    $dist1 = $distance[0];

    $dist = explode(" ", $dist);


    $comm = '<a style="color:white" class="btn btn-dark btn-block"  onclick="get_detail('.$key_donnees1['COMMUNE_ID'].')" href="javascript:;">Detail</a>';

    $donnees1 = $donnees1.$key_donnees1['COMMUNE_ID'].'<>'.$key_donnees1['COMMUNE_NAME'].'<>'.$key_donnees1['COMMUNE_LATITUDE'].'<>'.$key_donnees1['COMMUNE_LONGITUDE'].'<>'.$dist1.'<>'.$comm.'<>@';

}


$critere_enq='';            
$ENQUETEUR_ID = $this->input->post('ENQUETEUR_ID');

if($ENQUETEUR_ID > 0){
    $critere_enq.= ' AND enqueteur.ENQUETEUR_ID = '.$ENQUETEUR_ID;  
}

$enqueteur = $this->Model->getRequete('SELECT enqueteur.ENQUETEUR_ID,enqueteur.NOM,enqueteur.PRENOM,enqueteur.TELEPHONE,enqueteur.EMAIL,enqueteur.DATE_NAISSANCE,
    provinces.PROVINCE_NAME,communes.COMMUNE_NAME,sexe.DESCR,sexe.SEXE_ID,enqueteur.LATITUDE,enqueteur.LONGITUDE
    FROM `enqueteur` 
    JOIN provinces ON provinces.PROVINCE_ID = enqueteur.PROVINCE_ID
    JOIN communes ON communes.COMMUNE_ID = enqueteur.COMMUNE_ID
    JOIN sexe ON sexe.SEXE_ID = enqueteur.SEXE_ID
    WHERE 1'.$critaire1.' '.$critaire2.' '.$critere_enq);
$donneesenquete='';
$nbrEnquete = count($enqueteur);


foreach ($enqueteur as $key_donneesenquente) {
                // code...
    $nom=trim($key_donneesenquente['NOM']);
    $nom = str_replace("\n","",$nom);
    $nom = str_replace("\r","",$nom);
    $nom = str_replace("\t","",$nom);
    $nom = str_replace('"','',$nom);
    $nom = str_replace("'",'',$nom);





    $prenom=trim($key_donneesenquente['PRENOM']);
    $prenom = str_replace("\n","",$prenom);
    $prenom = str_replace("\r","",$prenom);
    $prenom = str_replace("\t","",$prenom);
    $prenom = str_replace('"','',$prenom);
    $prenom = str_replace("'",'',$prenom);

    if (empty($key_donneesenquente['LONGITUDE'])) {
       $long='-1';
   }else
   {
     $long=$key_donneesenquente['LONGITUDE'];  
 }

 if (empty($key_donneesenquente['LATITUDE'])) {
   $lat='-1';
}else
{
 $lat=$key_donneesenquente['LATITUDE'];  
}


$SEXE_ID = $key_donneesenquente['SEXE_ID'];

$PROVINCE_NAME = $key_donneesenquente['PROVINCE_NAME'];
$COMMUNE_NAME = $key_donneesenquente['COMMUNE_NAME'];
$DATE_NAISSANCE = $key_donneesenquente['DATE_NAISSANCE'];

$donneesenquete = $donneesenquete.$key_donneesenquente['ENQUETEUR_ID'].'<>'.$nom.'<>'.$prenom.'<>'.$key_donneesenquente['TELEPHONE'].'<>'.$key_donneesenquente['EMAIL'].'<>'.$SEXE_ID.'<>'.$lat.'<>'.$long.'<>'.$PROVINCE_NAME.'<>'.$COMMUNE_NAME.'<>'.$DATE_NAISSANCE.'<>#';
}




$rayon_metre=0;

$data['rayon_metre']=$rayon_metre;
$data['donnees']=$donnees;
$data['province']=$province;
$data['centre']=$centre;
$data['zoom']=$zoom;
$data['PROVINCE_ID']=$PROVINCE_ID;
$data['donnees1']=$donnees1;
$data['commune']=$commune;
$data['COMMUNE_ID']=$COMMUNE_ID;
$data['donneesenquete']=$donneesenquete;
$data['enqueteur']=$enqueteur;
$data['ENQUETEUR_ID']=$ENQUETEUR_ID;
$data['nbrEnquete']=$nbrEnquete;
$data['nbrProvince']=$nbrProvince;
$data['nbrCommune']=$nbrCommune;




$this->load->view('Carte_view',$data);

}


	// function index()
	// {

	// 	$centre='-3.4282777,29.9259924';
	// 	$zoom=9;

	// 	$province=$this->Model->getRequete('SELECT PROVINCE_ID,PROVINCE_NAME,syst_provinces.PROVINCE_LATITUDE,syst_provinces.PROVINCE_LONGITUDE FROM syst_provinces WHERE 1');

 //        $donnees_provinces='';

 //        foreach($province as $key_donnees_provinces)
 //        {
 //            $donnees_provinces=$donnees_provinces.$key_donnees_provinces['PROVINCE_ID'].'<>'.$key_donnees_provinces['PROVINCE_NAME'].'<>'.$key_donnees_provinces['PROVINCE_LATITUDE'].'<>'.$key_donnees_provinces['PROVINCE_LONGITUDE'].'<>@';        
 //        }
 //        //print_r($donnees_provinces);die();

 //        $data['donnees_provinces']=$donnees_provinces;
 //        $data['province']=$province;
 //        $data['centre']=$centre;
 //        $data['zoom']=$zoom;

	// 	$this->load->view('Carte_View',$data);

	// }
	function detail($ID_PROVINCE=0)
	{


	$query_principal = 'SELECT COMMUNE_ID, COMMUNE_NAME,PROVINCE_ID FROM `syst_communes` WHERE PROVINCE_ID='.$ID_PROVINCE.'';

	$var_search = !empty($_POST["search"]["value"]) ? $_POST["search"]["value"] : null;
	$limit = 'LIMIT 0,10';

	$draw = isset($_POST['draw']);
	$start = isset($postData['start']);

	if (isset($_POST["length"]) && $_POST["length"] != -1) {
		$limit = 'LIMIT ' . $_POST["start"] . ',' . $_POST["length"];
	}

	$order_by = '';

	$search = !empty($_POST['search']['value']) ? (" AND (COMMUNE_NAME  LIKE '%$var_search%')") : '';

	$order_column='';
	$order_column = array('COMMUNE_NAME');
	$order_by = isset($_POST['order']) ? ' ORDER BY ' . $order_column[$_POST['order']['0']['column']] . '  ' . $_POST['order']['0']['dir'] : ' ORDER BY COMMUNE_NAME ASC';
	
	$critaire = ' ';
	$query_secondaire=$query_principal.' '.$search.' '.$critaire.' '.$order_by.'   '.$limit;
	$query_filter = $query_principal.' '.$search.' '.$critaire;
	$fetch_gerant = $this->Model->datatable($query_secondaire);



	$data = array();
	$u = 1;
	$commune='';

	foreach ($fetch_gerant as $row) {
	
		$equi_array = array();
		$equi_array[] = $u++;
		$equi_array[] = $row->COMMUNE_NAME;		
		
	}
	$output = array(
		"draw" => intval($_POST['draw']),
		"recordsTotal" =>$this->Model->all_data($query_principal),
		"recordsFiltered" => $this->Model->filtrer($query_filter),
		"data" => $data
	);
	echo json_encode($output);

    }

	


}
?>

