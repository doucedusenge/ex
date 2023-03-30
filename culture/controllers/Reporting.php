<?php 
/** 
 * auteur:Douce
 Date:le 03/03/2023
 */ 
class Reporting extends CI_Controller
        {	    	
	function index()
	       {
			$PROVINCE_ID=$this->input->post('PROVINCE_ID'); 
			$ZONE_ID=$this->input->post('ZONE_ID'); 
			$COMMUNE_ID=$this->input->post('COMMUNE_ID'); 	
			$COLLINE_ID=$this->input->post('COLLINE_ID');
			$buja= $this->Model->getRequete('SELECT syst_provinces.PROVINCE_ID as ID, `PROVINCE_NAME` as name,COUNT(PERSONNE_ID) as perso FROM `syst_provinces`  LEFT JOIN personne on personne.PROVINCE_ID= syst_provinces.PROVINCE_ID GROUP BY ID,name');

			$data['province']= $this->Model->getRequete('SELECT PROVINCE_ID, `PROVINCE_NAME` FROM `syst_provinces` WHERE 1');
		  //  $data ['commune']= $this->Model->getRequete('SELECT `COMMUNE_ID`, `COMMUNE_NAME` FROM `syst_communes` WHERE 1');
		 	// $data['zone']= $this->Model->getRequete('SELECT `ZONE_ID`, `ZONE_NAME` FROM `syst_zones` WHERE 1');
		$prov='';
		$comm='';
		$zone='';
		$col='';
		if (!empty($PROVINCE_ID)) {
			$prov= ' AND syst_communes.PROVINCE_ID='.$PROVINCE_ID.'';

			$comm=$this->Model->getRequete('SELECT `COMMUNE_ID`, `COMMUNE_NAME` FROM `syst_communes` WHERE syst_communes.PROVINCE_ID='.$PROVINCE_ID.' order BY COMMUNE_NAME ASC');

			$buja= $this->Model->getRequete(   'SELECT syst_communes.COMMUNE_ID AS ID, `COMMUNE_NAME` AS name,COUNT(PERSONNE_ID) as perso FROM `syst_communes` LEFT JOIN personne on personne.COMMUNE_ID= syst_communes.COMMUNE_ID WHERE 1  '.$prov.' GROUP BY PERSONNE_ID');

		}
 		if(!empty($COMMUNE_ID))
        {
            $condition="";
            $condition.=' and syst_zones.COMMUNE_ID='.$COMMUNE_ID;
            $zone=$this->Model->getRequete('SELECT ZONE_ID,ZONE_NAME FROM syst_zones WHERE COMMUNE_ID='.$COMMUNE_ID.' ORDER BY ZONE_NAME ASC');

            $buja=$this->Model->getRequete('SELECT syst_zones.ZONE_ID AS ID,ZONE_NAME AS name,COUNT(syst_collines.COLLINE_ID) AS perso FROM syst_zones LEFT JOIN syst_collines ON syst_zones.ZONE_ID=syst_collines.ZONE_ID WHERE 1 '.$condition.' GROUP BY ID,NAME ;');
            //print_r($com);die();
        }
        if(!empty($ZONE_ID))
        {
            $ZONE="";
            $ZONE.='and syst_collines.ZONE_ID='.$ZONE_ID;
            $col=$this->Model->getRequete('SELECT COLLINE_ID,COLLINE_NAME FROM syst_collines WHERE ZONE_ID='.$ZONE_ID.' ORDER BY COLLINE_NAME ASC');
            $buja=$this->Model->getRequete('SELECT syst_collines.COLLINE_ID AS ID,COLLINE_NAME AS name,syst_collines.COLLINE_ID as perso FROM syst_collines WHERE 1 '.$ZONE.' GROUP BY ID,NAME ;');
            //print_r($com);die();
        }
        if(!empty($COLLINE_ID))
        {
            $condition="";
            $condition.=' and syst_collines.COLLINE_ID='.$COLLINE_ID;
           
            $buja=$this->Model->getRequete('SELECT syst_collines.COLLINE_ID AS ID,COLLINE_NAME AS name  , COUNT(PERSONNE_ID) as perso FROM syst_collines LEFT JOIN personne on  personne.COLLINE_ID=syst_collines.COLLINE_ID WHERE '.$condition.' GROUP BY ID,NAME ');

            //print_r($com);die();
        }

		$rapport='';
		foreach ($buja as $value) {

	 	$rapport.="{name:'".$value['name']."',y:".$value['perso'].",key:". $value['ID']."},";
	}
		// print_r($rapport);die();
		$data['rapport']=$rapport;
		$data['PROVINCE_ID']=$PROVINCE_ID;
		$data['ZONE_ID']=$ZONE_ID;
		$data['comm']=$comm;
		$data['COMMUNE_ID']=$COMMUNE_ID;
		$data['zone']=$zone;
		$data['COLLINE_ID']=$COLLINE_ID;
		$data['col']=$col;
		//$data['population']=$population;
		
		
		//$data['title'] = "Publication";
		      $this->load->view('Reporting_View',$data);
	}
	function detail(){

	$PROVINCE_ID=$this->input->post('key'); 

	$query_principal = 'SELECT personne.NOM  FROM `syst_provinces` LEFT JOIN personne on personne.PROVINCE_ID=syst_provinces.PROVINCE_ID WHERE syst_provinces.PROVINCE_ID='.$PROVINCE_ID.'';

	$var_search = !empty($_POST["search"]["value"]) ? $_POST["search"]["value"] : null;
	$limit = 'LIMIT 0,10';

	$draw = isset($_POST['draw']);
	$start = isset($postData['start']);

	if (isset($_POST["length"]) && $_POST["length"] != -1) {
		$limit = 'LIMIT ' . $_POST["start"] . ',' . $_POST["length"];
	}

	$order_by = '';

	$search = !empty($_POST['search']['value']) ? (" AND (personne.NOM  LIKE '%$var_search%')") : '';

	$order_column='';
	$order_column = array('NOM');

	$order_by = isset($_POST['order']) ? ' ORDER BY ' . $order_column[$_POST['order']['0']['column']] . '  ' . $_POST['order']['0']['dir'] : ' ORDER BY NOM ASC';
	
	$critaire = ' ';


	$query_secondaire=$query_principal.' '.$search.' '.$critaire.' '.$order_by.'   '.$limit;

	$query_filter = $query_principal.' '.$search.' '.$critaire;

	$fetch_gerant = $this->Model->datatable($query_secondaire);
	$data = array();
	$u = 1;
	foreach ($fetch_gerant as $row) {

		$equi_array = array();
		$equi_array[] = $u++;
		$equi_array[] = $row->NOM;
		$data[] = $equi_array;
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