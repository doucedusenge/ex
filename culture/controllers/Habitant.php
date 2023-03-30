<?php 
/** 
 * auteur:Douce
 Date:le 01/03/2023
 */ 
class Habitant extends CI_Controller
{
	
	function __construct()
	{
		// code...
		parent::__construct();
	}

	function index()
	{
	$data['province']=$this->Model->getRequete("SELECT `PROVINCE_ID`, `PROVINCE_NAME` FROM `syst_provinces` WHERE 1 ORDER BY PROVINCE_NAME ASC");
	$this->load->view('Habitant_View',$data);
	}
	function rapport(){

		$PROVINCE_ID=$this->input->post('PROVINCE_ID');
		$COMMUNE_ID=$this->input->post('COMMUNE_ID');
        $ZONE_ID=$this->input->post('ZONE_ID');
		$COLLINE_ID=$this->input->post('COLLINE_ID');
		$cond='';
		$comm='';
		$cond1='';
		$zon='';
		$col='';

		if (empty($PROVINCE_ID)) {
		$categories='syst_provinces.PROVINCE_NAME';
		$categorieid='syst_provinces.PROVINCE_ID';
		$catemenage='homme.PROVINCE_ID';
		$localite='syst_provinces';
		}
		if(!empty($PROVINCE_ID)){

		$categories='syst_communes.COMMUNE_NAME';
		$categorieid='syst_communes.COMMUNE_ID';
		$catemenage='homme.COMMUNE_ID';
		$cond.=" AND homme.PROVINCE_ID=".$PROVINCE_ID;

		$localite='syst_communes';
		if(!empty($COMMUNE_ID)){
		$categories='syst_zones.ZONE_NAME';
		$categorieid='syst_zones.ZONE_ID';
		$catemenage='homme.ZONE_ID';
		$localite='syst_zones';
		$cond.=" AND homme.COMMUNE_ID=".$COMMUNE_ID;

		if(!empty($ZONE_ID)){
		$categories='syst_collines.COLLINE_NAME';
		$categorieid='syst_collines.COLLINE_ID';
		$catemenage='homme.COLLINE_ID';
		$localite='syst_collines';
		$cond.=" AND homme.ZONE_ID=".$ZONE_ID;

		if(!empty($COLLINE_ID)){
		$categories='syst_collines.COLLINE_NAME';
		$categorieid='syst_collines.COLLINE_ID';
		$catemenage='homme.COLLINE_ID';
		$localite='syst_collines';
		$cond.=" AND homme.COLLINE_ID=".$COLLINE_ID; 
		$localite='syst_collines';
		}
		}
		}
		}

 		$projet_local=$this->Model->getRequete("SELECT ".$categorieid." AS ID,".$categories." as name,   COUNT(`HOMME_ID`) AS nombre  FROM `homme`  LEFT JOIN 	".$localite." on ".$categorieid."=	".$catemenage."  WHERE 1 ".$cond." GROUP BY  ".$categorieid." ,".$categories."");
 		$rapport='';
 		foreach ($projet_local as $value) {

		$rapport.="{name:'".$value['name']."',y:".$value['nombre'].",key:". $value['ID']."},";

 		}
 		//print_r($rapport);die();

	// $comm= '<option selected="" disabled="">séléctionner</option>';
	// $cd= '<option selected="" disabled="">séléctionner</option>';
	// $zon= '<option selected="" disabled="">séléctionner</option>';
	// $col= '<option selected="" disabled="">séléctionner</option>';
	if (!empty($PROVINCE_ID)) {

		$critere['PROVINCE_ID'] = $PROVINCE_ID;

		$communes = $this->Model->getList('syst_communes', $critere);
		foreach ($communes as $commun) {
		if (!empty($COMMUNE_ID)) {
		  
		if ($COMMUNE_ID==$commun['COMMUNE_ID']) {
		$comm.= "<option value ='".$commun['COMMUNE_ID']."' selected>".$commun['COMMUNE_NAME']."</option>";
		}
		else{
		$comm.= "<option value ='".$commun['COMMUNE_ID']."'>".$commun['COMMUNE_NAME']."</option>";
		}

		}else{
		$comm.= "<option value ='".$commun['COMMUNE_ID']."'>".$commun['COMMUNE_NAME']."</option>";
		}
		}
		}

		if (!empty($COMMUNE_ID)) {
		  $critere2['COMMUNE_ID'] = $COMMUNE_ID;
		  $zones = $this->Model->getList('syst_zones', $critere2); 

		  foreach ($zones as $zo) {
		  if (!empty($ZONE_ID)) {
		  if ($ZONE_ID==$zo['ZONE_ID']) {
		  $zon.= "<option value ='".$zo['ZONE_ID']."' selected>".$zo['ZONE_NAME']."</option>";
		  }
		  else{
		  $zon.= "<option value ='".$zo['ZONE_ID']."'>".$zo['ZONE_NAME']."</option>";
		  }
		  
		  }else{
		  $zon.= "<option value ='".$zo['ZONE_ID']."'>".$zo['ZONE_NAME']."</option>";
		  } 
		  }

		}

		if (!empty($COMMUNE_ID)) {
		  $critere2['COMMUNE_ID'] = $COMMUNE_ID;		  
		    }
		if (!empty($ZONE_ID)) {
		  $critere1['ZONE_ID'] = $ZONE_ID;
		  $collines = $this->Model->getList('syst_collines', $critere1);

		foreach ($collines as $coll) {
		  if (!empty($COLLINE_ID)) {
		  if ($COLLINE_ID==$coll['COLLINE_ID']) {
		  $col.= "<option value ='".$coll['COLLINE_ID']."' selected>".$coll['COLLINE_NAME']."</option>";
		  }
		  else{
		  $col.= "<option value ='".$coll['COLLINE_ID']."'>".$coll['COLLINE_NAME']."</option>";
		  }
		  
		  }else{
		  $col.= "<option value ='".$coll['COLLINE_ID']."'>".$coll['COLLINE_NAME']."</option>";
		      } 
		    }
		    }

		$highchar="<script>
		Highcharts.chart('container', {
			chart: {
			    type: 'line'
			},
			title: {
			    text: ''
			},
			subtitle: {
			    text: 'nombre de personne par province'
			},
			xAxis: {
			    type:'category',
			     
			    crosshair: true
			},
			yAxis: {
			    min: 0,
			    title: {
			        text: 'Rainfall (habitants)'
			    }
			},
			tooltip: {
			    headerFormat: '<span style=\"font-size:10px\">{point.key}</span><table>',
			    pointFormat: '<tr><td style=\"color:{series.color};padding:0\">{series.name}: </td>' +
			        '<td style=\"padding:0\"><b>{point.y:.1f} mm</b></td></tr>',
			    footerFormat: '</table>',
			    shared: true,
			    useHTML: true
			},
    plotOptions: {
        line: {
             pointPadding: 0.2,
            borderWidth: 0,
            depth: 40,
             cursor:'pointer',
             point:{
                events: {
             click: function()
{            
			$(\"#titre\").html(\" Liste des projets \");
			$(\"#myModal\").modal();
			var row_count ='1000000';
			$(\"#mytable\").DataTable({
			\"processing\":true,
			\"serverSide\":true,
			\"bDestroy\": true,
			\"oreder\":[],
			\"ajax\":{
		url:\"".base_url('culture/Habitant/detail')."\",
			type:\"POST\",
			data:{
			key:this.key, 
			 
			PROVINCE_ID:$('#PROVINCE_ID').val(),
			COMMUNE_ID:$('#COMMUNE_ID').val(),
			ZONE_ID:$('#ZONE_ID').val(),
			COLLINE_ID:$('#COLLINE_ID').val(),
			
			}
			},
			lengthMenu: [[10,50, 100, row_count], [10,50, 100, \"All\"]],
			pageLength: 10,
			\"columnDefs\":[{
			\"targets\":[],
			\"orderable\":false
			}],
			dom: 'Bfrtlip',
			buttons: ['copy', 'csv', 'excel', 'pdf', 'print'
			                                                     ],
			language: {
			\"sProcessing\":     \"Traitement en cours...\",
			\"sSearch\":         \"Rechercher&nbsp;:\",
			\"sLengthMenu\":     \"Afficher _MENU_ &eacute;l&eacute;ments\",
			\"sInfo\":           \"Affichage de l'&eacute;l&eacute;ment _START_ &agrave; _END_ sur _TOTAL_ &eacute;l&eacute;ments\",
			\"sInfoEmpty\":      \"Affichage de l'&eacute;l&eacute;ment 0 &agrave; 0 sur 0 &eacute;l&eacute;ment\",
			\"sInfoFiltered\":   \"(filtr&eacute; de _MAX_ &eacute;l&eacute;ments au total)\",
			 \"sInfoPostFix\":    \"\",
			\"sLoadingRecords\": \"Chargement en cours...\",
			\"sZeroRecords\":    \"Aucun &eacute;l&eacute;ment &agrave; afficher\",
			\"sEmptyTable\":     \"Aucune donn&eacute;e disponible dans le tableau\",
			\"oPaginate\": {
			\"sFirst\":      \"Premier\",
			\"sPrevious\":   \"Pr&eacute;c&eacute;dent\",
			\"sNext\":       \"Suivant\",
			\"sLast\":       \"Dernier\"
			},
			 \"oAria\": {
			\"sSortAscending\":  \": activer pour trier la colonne par ordre croissant\",
			 \"sSortDescending\": \": activer pour trier la colonne par ordre d&eacute;croissant\"
			}
			}
			                              
			});

                   }
               }
           },
           dataLabels: {
             enabled: true,
            format: '{point.y:,f}'
         },
         showInLegend: false
     }
 }, 
 credits: {
  enabled: true,
  href: \"\",
  text: \"Mediabox\"
},

    series: [{
        name: 'Burundi',
        data: [".$rapport."]

    }]
});
   </script>
			";	

$comm= '<option selected="" disabled="">séléctionner</option>';
$cd= '<option selected="" disabled="">séléctionner</option>';
$zon= '<option selected="" disabled="">séléctionner</option>';
$col= '<option selected="" disabled="">séléctionner</option>';


if (!empty($PROVINCE_ID)) {

$critere['PROVINCE_ID'] = $PROVINCE_ID;

$communes = $this->Model->getList('syst_communes', $critere);


foreach ($communes as $commun) {
if (!empty($COMMUNE_ID)) {
  
if ($COMMUNE_ID==$commun['COMMUNE_ID']) {
$comm.= "<option value ='".$commun['COMMUNE_ID']."' selected>".$commun['COMMUNE_NAME']."</option>";
}
else{
$comm.= "<option value ='".$commun['COMMUNE_ID']."'>".$commun['COMMUNE_NAME']."</option>";
}

}else{
$comm.= "<option value ='".$commun['COMMUNE_ID']."'>".$commun['COMMUNE_NAME']."</option>";
}
}
}

if (!empty($COMMUNE_ID)) {
  $critere2['COMMUNE_ID'] = $COMMUNE_ID;
  $zones = $this->Model->getList('syst_zones', $critere2);
  


  foreach ($zones as $zo) {
  if (!empty($ZONE_ID)) {
  if ($ZONE_ID==$zo['ZONE_ID']) {
  $zon.= "<option value ='".$zo['ZONE_ID']."' selected>".$zo['ZONE_NAME']."</option>";
  }
  else{
  $zon.= "<option value ='".$zo['ZONE_ID']."'>".$zo['ZONE_NAME']."</option>";
  }  
  }else{
  $zon.= "<option value ='".$zo['ZONE_ID']."'>".$zo['ZONE_NAME']."</option>";
  } 
  }

}

if (!empty($COMMUNE_ID)) {
  $critere2['COMMUNE_ID'] = $COMMUNE_ID;  
    }

if (!empty($ZONE_ID)) {
  $critere1['ZONE_ID'] = $ZONE_ID;
  $collines = $this->Model->getList('syst_collines', $critere1);

foreach ($collines as $coll) {
  if (!empty($COLLINE_ID)) {
  if ($COLLINE_ID==$coll['COLLINE_ID']) {
  $col.= "<option value ='".$coll['COLLINE_ID']."' selected>".$coll['COLLINE_NAME']."</option>";
  }
  else{
  $col.= "<option value ='".$coll['COLLINE_ID']."'>".$coll['COLLINE_NAME']."</option>";
  }
  
  }else{
  $col.= "<option value ='".$coll['COLLINE_ID']."'>".$coll['COLLINE_NAME']."</option>";
      } 
    }
 } 			
echo json_encode(array('highchart'=>$highchar,'col'=>$col,'zon'=>$zon,'comm'=>$comm));

	}


function detail()
    {
 
	    $KEY=$this->input->post('key');
	 	$PROVINCE_ID=$this->input->post('PROVINCE_ID');
		$COMMUNE_ID=$this->input->post('COMMUNE_ID');
		$ZONE_ID=$this->input->post('ZONE_ID');
		$COLLINE_ID=$this->input->post('COLLINE_ID');	
		$cond='';
		$cond1='';
		$crif='';

		if(!empty($PROVINCE_ID)){

		$cond.=" AND homme.PROVINCE_ID=".$PROVINCE_ID;

		}
		if(!empty($COMMUNE_ID)){
		$cond.=" AND homme.COMMUNE_ID=".$COMMUNE_ID;

		}
		if(!empty($ZONE_ID)){

		$cond.=" AND homme.ZONE_ID=".$ZONE_ID;

		}
		if(!empty($COLLINE_ID)){

		 $cond.=" AND homme.COLLINE_ID=".$COLLINE_ID; 
		 
		 }
		 $criteres='';

		$var_search = !empty($_POST['search']['value']) ? $_POST['search']['value'] : null;     


		$query_principal='SELECT NOM,syst_provinces.PROVINCE_ID ,syst_provinces.PROVINCE_NAME ,syst_collines.COLLINE_NAME,syst_collines.COLLINE_ID,syst_communes.COMMUNE_ID,syst_communes.COMMUNE_NAME ,syst_zones.ZONE_NAME  FROM `homme` LEFT JOIN syst_provinces on syst_provinces.PROVINCE_ID=homme.PROVINCE_ID LEFT JOIN syst_communes on   syst_communes.COMMUNE_ID=homme.COMMUNE_ID LEFT JOIN syst_zones on  syst_zones.ZONE_ID=homme.ZONE_ID LEFT JOIN syst_collines on syst_collines.COLLINE_ID=homme.COLLINE_ID WHERE 1  ' .$cond ;

		        $limit='LIMIT 0,10';
        if($_POST['length'] != -1)
        {
            $limit='LIMIT '.$_POST["start"].','.$_POST["length"];
        }
        $order_by='';
        if($_POST['order']['0']['column']!=0)
        {
            $order_by = isset($_POST['order']) ? ' ORDER BY '.$_POST['order']['0']['column'] .'  '.$_POST['order']['0']['dir'] : ' ORDER BY NOM  ASC'; 
        }
		$search = !empty($_POST['search']['value']) ? (" AND (personne.NOM  LIKE '%$var_search%')") : '';


		$critaire=' ';
 		if(empty($PROVINCE_ID)){

		$critaire.=" AND homme.PROVINCE_ID=".$KEY;

		}

		if(!empty($PROVINCE_ID)){
		$critaire=" AND homme.COMMUNE_ID=".$KEY;

		}
		if(!empty($COMMUNE_ID)){

		$critaire=" AND homme.ZONE_ID=".$KEY;

		}
		if(!empty($ZONE_ID)){

		 $critaire=" AND homme.COLLINE_ID=".$KEY; 
		 
		 }
		 if(!empty($COLLINE_ID)){

		 $critaire=" AND homme.COLLINE_ID=".$KEY; 
		 
 		} 
        $query_secondaire=$query_principal.'  '.$critaire.' '.$search.' '.$order_by.'   '.$limit;
        $query_filter=$query_principal.'  '.$critaire.' '.$search;

        $fetch_data = $this->Model->datatable($query_secondaire);
        $u=0;
        $data = array();
        foreach ($fetch_data as $row) 
        {
         $u++;
         $intrant=array();
         $intrant[] = $u;             
         $intrant[] =$row->NOM;        
         $intrant[] =$row->PROVINCE_NAME;        
         $intrant[] =$row->COMMUNE_NAME;        
         $intrant[] =$row->ZONE_NAME;        
         $intrant[] =$row->COLLINE_NAME;        
         $data[] = $intrant;
        }

        $output = array(
            "draw" =>intval($_POST['draw']),
            "recordsTotal" =>$this->Model->all_data($query_principal),
            "recordsFiltered" => $this->Model->filtrer($query_filter),
            "data" => $data
        );
        echo json_encode($output);
    }
  //   public function check_new()
  //       {
		// $sql='SELECT COUNT(*) AS x FROM homme WHERE STATUT=0';
  //       $nu=$this->Model->getRequeteOne($sql);
  //        $send=0;

  //       if ($nu['x']>0) {

  //       $send=1;
  //       $data=array('STATUT'=>1);
  //       $this->Model->update('homme',array('STATUT'=>0),$data);
  //       }
  //       $output=array('new'=>$send);
  //       echo json_encode($output);
  //       }
public function check_new()
                        {

           $sql='SELECT COUNT(*) AS syst_iot FROM homme WHERE STATUT=0';
                          $nu=$this->Model->getRequeteOne($sql);
                          $send=0;

                          if ($nu['syst_iot']>0) {

                            $send=1;
                            $data=array('STATUT'=>1);
                            $this->Model->update('homme',array('STATUT'=>0),$data);
                          }
                          $output=array('new'=>$send);
                          echo json_encode($output);
                        }




	


			
	
}

	


?>