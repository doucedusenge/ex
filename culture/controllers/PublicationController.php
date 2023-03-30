<?php

/*
CRUD Publication
@auteur:Douce
219/02/2023
*/


class PublicationController extends CI_Controller
{     		
	function __construct()
	{
			# code...
		parent::__construct();
	}

	function index()
	{

		 $data['title']="";
	
		$data['articles'] = $this->Model->getRequete('SELECT `ID_ARTICLE`, `DESCR_ARTICLE` FROM `ecom_article` WHERE 1 ORDER by DESCR_ARTICLE ASC');
		$data['secteur'] = $this->Model->getRequete('SELECT `ID_SECTEUR_ACTIVITE`, `DESCR_SECTEUR_ACTIVITE` FROM `ecom_secteur_activite` WHERE 1 ORDER BY DESCR_SECTEUR_ACTIVITE ASC');
		$data['unite_mesure']= $this->Model->getRequete('SELECT `ID_UNITE_MESURE`, `DESCR_UNITE_MESURE` FROM `se_unite_mesure` WHERE 1 ORDER BY DESCR_UNITE_MESURE');

		$this->load->view('PublicationController_view',$data);
	}
	//Affichage d'une liste de cultures
	function listing()
	{

		$query_principal='
		SELECT ID_PUBLICATION,CODE_FOURNISSEUR,ecom_publication.ID_SECTEUR_ACTIVITE,DESCR_SECTEUR_ACTIVITE,ecom_publication.ID_ARTICLE,ecom_publication.ID_UNITE_MESURE,QUANTITE,PRIX,DESCR_UNITE_MESURE,STATUT, ecom_article.DESCR_ARTICLE FROM `ecom_publication`   JOIN ecom_article on ecom_article.ID_ARTICLE=ecom_publication.ID_ARTICLE JOIN ecom_secteur_activite on ecom_secteur_activite.ID_SECTEUR_ACTIVITE=ecom_publication.ID_SECTEUR_ACTIVITE JOIN se_unite_mesure on se_unite_mesure.ID_UNITE_MESURE=ecom_publication.ID_UNITE_MESURE  WHERE 1 
		';

			// $var_search= !empty($_POST['search']['value']) ? $_POST['search']['value'] : null;

		$var_search= !empty($_POST['search']['value']) ? $_POST['search']['value'] : null;

		$limit='LIMIT 0,10';


		if(isset($_POST["length"]) && $_POST["length"] != -1)
		{
			$limit='LIMIT '.$_POST["start"].','.$_POST["length"];
			
		}
		$order_by='';

		$order_column=array( 'CODE_FOURNISSEUR','ID_PUBLICATION','ID_UNITE_MESURE','QUANTITE','PRIX','STATUT');
		$order_by = isset($_POST['order']) ? ' ORDER BY ' . $order_column[$_POST['order']['0']['column']] . '  ' . $_POST['order']['0']['dir'] : ' ORDER BY PRIX ASC';


		$search = !empty($_POST['search']['value']) ?  (" AND (ecom_publication.PRIX LIKE '%$var_search%') OR(ecom_publication.CODE_FOURNISSEUR LIKE '%$var_search%') OR(ecom_article.DESCR_ARTICLE LIKE '%$var_search%') ") :'';   
		$critaire = ' ';


		$query_secondaire=$query_principal.' '.$search.' '.$critaire.' '.$order_by.'   '.$limit;

		$query_filter = $query_principal.' '.$search.' '.$critaire;

		

		$fetch_res= $this->Model->datatable($query_secondaire);
		$data = array();
		
		$u=1;

		foreach ($fetch_res as $row)
		{
			
			$sub_array = array();
			$sub_array[]=$u++;
			
			$sub_array[]=$row->ID_PUBLICATION;
			$sub_array[]=$row->CODE_FOURNISSEUR;
			$sub_array[]=$row->DESCR_SECTEUR_ACTIVITE;
			$sub_array[]=$row->DESCR_ARTICLE;
			$sub_array[]=$row->DESCR_UNITE_MESURE;
			$sub_array[]=$row->QUANTITE;
			$sub_array[]=$row->PRIX;
			//$sub_array[]=$row->STATUT;
			
			$action = '<div class="dropdown" style="color:#fff;">
			<a class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown"><i class="fa fa-cog"></i> Options  <span class="caret"></span>
			</a>
			<ul class="dropdown-menu dropdown-menu-left">';

			$action .="<li>

<a class='btn btn-secondary' href='javascript:;' onclick='Edit_Pub('.$row->ID_PUBLICATION.')' >Modifier</a>
			<label>&nbsp;<span class='fa fa-edit'></span>&nbsp;Modifier</label>
			</a>
			</li>";
			$action .="<li>
			<a href='#' data-toggle='modal' data-target='#mydelete".$row->ID_PUBLICATION."'>
			<label class='text-danger'>&nbsp;<span class='fa fa-trash'></span>&nbsp;Supprimer</label>
			</a>
			</li>";


			$action .= " </ul>
			</div>
			<div class='modal fade' id='mydelete".$row->ID_PUBLICATION."'>
			<div class='modal-dialog'>
			<div class='modal-content'>

			<div class='modal-body'>
			<center>
			<h5><strong>Voulez-vous supprimé une Culture?</strong><br> <b style:'background-color:prink';><i style='color:green;'>" . $row->ID_PUBLICATION."</i></b>
			</h5>
			</center>
			</div>

			<div class='modal-footer'>

			Supprimer
			</a>


			<button class='btn btn-primary btn-md' data-dismiss='modal'>
			Quitter
			</button>
			</div>

			</div>
			</div>
			</div>";

			$sub_array[]=$action;


			$data[] = $sub_array;
		}

		$output = array(
			"draw" => intval($_POST['draw']),
			"recordsTotal" =>$this->Model->all_data($query_principal),
			"recordsFiltered" => $this->Model->filtrer($query_filter),
			"data" => $data
		);

		echo json_encode($output);

	}

	function addPublication(){
		//	$NOM=$this->input->post('NOM');

	$CODE_FOURNISSEUR=$this->input->post('CODE_FOURNISSEUR');
	$ID_SECTEUR_ACTIVITE=$this->input->post('ID_SECTEUR_ACTIVITE');
	$ID_ARTICLE=$this->input->post('ID_ARTICLE');
	$ID_UNITE_MESURE=$this->input->post('ID_UNITE_MESURE');
	$QUANTITE=$this->input->post('QUANTITE');
	$PRIX=$this->input->post('PRIX');

	$data_insert=array(
		'CODE_FOURNISSEUR'=>$CODE_FOURNISSEUR,
		'ID_SECTEUR_ACTIVITE'=>$ID_SECTEUR_ACTIVITE,
		'ID_ARTICLE'=>$ID_ARTICLE,
		'ID_UNITE_MESURE'=>$ID_UNITE_MESURE,
		'QUANTITE'=>$QUANTITE,
		'PRIX'=>$PRIX,
	);
	$tabl='ecom_publication';
	$as=$this->Model->insert_last_id($tabl,$data_insert);
	//print_r($as);die();

	echo json_encode(array('status' => TRUE));
}

	function delete($id){

	$table="ecom_publication";
	$this->Model->delete($table,array('ID_PUBLICATION'=>$id));

	echo json_encode(array('status' => TRUE));
}


    	//Ajout d'une Culture 
	function add($id=0)
	{


		$data['articles'] = $this->Model->getRequete('SELECT `ID_ARTICLE`, `DESCR_ARTICLE` FROM `ecom_article` WHERE 1 ORDER by DESCR_ARTICLE ASC');
		$data['secteur'] = $this->Model->getRequete('SELECT `ID_SECTEUR_ACTIVITE`, `DESCR_SECTEUR_ACTIVITE` FROM `ecom_secteur_activite` WHERE 1 ORDER BY DESCR_SECTEUR_ACTIVITE ASC');
		$data['unite_mesure']= $this->Model->getRequete('SELECT `ID_UNITE_MESURE`, `DESCR_UNITE_MESURE` FROM `se_unite_mesure` WHERE 1 ORDER BY DESCR_UNITE_MESURE');

		$data['title'] = "Publication";
		$this->load->view('Add_Publication_View',$data);


	}
	// function save()
	// {
		
	//  		$this->form_validation->set_rules('CODE_FOURNISSEUR','', 'trim|required',array(
	//  		'required'=>'<font style="color:red;size:2px;">Le champ est Obligatoire</font>'));

	// 			$this->form_validation->set_rules('ID_ARTICLE','', 'trim|required',array('required'=>'<font style="color:red;size:2px;">Le champ est Obligatoire</font>'));

	//  		$this->form_validation->set_rules('ID_SECTEUR_ACTIVITE','', 'trim|required',array(
	//  		'required'=>'<font style="color:red;size:2px;">Le champ est Obligatoire</font>'));


 //      	$this->form_validation->set_rules('ID_UNITE_MESURE','', 'trim|required',array('required'=>'<font style="color:red;size:2px;">Le champ est Obligatoire</font>'));

	//  		$this->form_validation->set_rules('QUANTITE','', 'trim|required',array(
	//  		'required'=>'<font style="color:red;size:2px;">Le champ est Obligatoire</font>'));

	//  		$this->form_validation->set_rules('PRIX','', 'trim|required',array(
	//  		'required'=>'<font style="color:red;size:2px;">Le champ est Obligatoire</font>'));



	// 	if ($this->form_validation->run() == FALSE)
	// 	{
	// 		// print_r("expression");die();

	// 		$data = array(
	// 			'PRIX' => $this->input->post('PRIX')
	// 		);
		
	// 		$data['error']='';

	// 		// print_r($data);die();
	// 		$this->load->view('Add_Publication_View',$data);


	// 	}
		

	// 	else
	// 	{

	// 		$dataInsert=array(
	// 			'CODE_FOURNISSEUR'=>$this->input->post('CODE_FOURNISSEUR'),
	// 			'ID_SECTEUR_ACTIVITE'=>$this->input->post('ID_SECTEUR_ACTIVITE'),
	// 			'ID_ARTICLE'=>$this->input->post('ID_ARTICLE'),
	// 			'ID_UNITE_MESURE'=>$this->input->post('ID_UNITE_MESURE'),
	// 			'QUANTITE'=>$this->input->post('QUANTITE'),
	// 			'PRIX'=>$this->input->post('PRIX')
	// 		);
			
	// 		// print_r($dataInsert);die();
	// 		$table='ecom_publication';
	// 		$this->Model->create('ecom_publication',$dataInsert);

	// 		$data['message']='<div class="alert alert-success text-center" id="message">'."L'enregistrement d'un installation <b>".' '.$this->input->post('QUANTITE').'</b> '." est faite avec succès".'</div>';
	// 		$this->session->set_flashdata($data);
	// 		redirect(base_url('culture/Publication'));


	// 	}

	// }

	function getOne($id)
	{
	//	$id=$this->uri->segment(4);

		$data['title']="Modification ";

		$data['articles'] = $this->Model->getRequete('SELECT `ID_ARTICLE`, `DESCR_ARTICLE` FROM `ecom_article` WHERE 1 ORDER by DESCR_ARTICLE ASC');
		$data['secteur'] = $this->Model->getRequete('SELECT `ID_SECTEUR_ACTIVITE`, `DESCR_SECTEUR_ACTIVITE` FROM `ecom_secteur_activite` WHERE 1 ORDER BY DESCR_SECTEUR_ACTIVITE ASC');
		$data['unite_mesure']= $this->Model->getRequete('SELECT `ID_UNITE_MESURE`, `DESCR_UNITE_MESURE` FROM `se_unite_mesure` WHERE 1 ORDER BY DESCR_UNITE_MESURE');

		$data['data']=$this->Model->getOne('ecom_publication',array('ID_PUBLICATION'=>$id));

		
		// print_r($data['data']);die();
	
	  $this->load->view('Update_Publication_View',$data);
	}
	function update()
	{
		
	 		$this->form_validation->set_rules('CODE_FOURNISSEUR','', 'trim|required',array(
	 		'required'=>'<font style="color:red;size:2px;">Le champ est Obligatoire</font>'));

				$this->form_validation->set_rules('ID_ARTICLE','', 'trim|required',array('required'=>'<font style="color:red;size:2px;">Le champ est Obligatoire</font>'));

	 		$this->form_validation->set_rules('ID_SECTEUR_ACTIVITE','', 'trim|required',array(
	 		'required'=>'<font style="color:red;size:2px;">Le champ est Obligatoire</font>'));


      	$this->form_validation->set_rules('ID_UNITE_MESURE','', 'trim|required',array('required'=>'<font style="color:red;size:2px;">Le champ est Obligatoire</font>'));

	 		$this->form_validation->set_rules('QUANTITE','', 'trim|required',array(
	 		'required'=>'<font style="color:red;size:2px;">Le champ est Obligatoire</font>'));

	 		$this->form_validation->set_rules('PRIX','', 'trim|required',array(
	 		'required'=>'<font style="color:red;size:2px;">Le champ est Obligatoire</font>'));


		if ($this->form_validation->run() == FALSE) {
			$id=$this->input->post('ID_PUBLICATION'); 
			$this->getOne($id);
			
			$data['data']=$this->Model->getOne('ecom_publication',array('ID_PUBLICATION'=>$id));


			$data['error']='';

			$this->load->view('Update_Publication_View',$data);
		}else
		{

			$id=$this->input->post('ID_PUBLICATION');
			$data=array(    
				'CODE_FOURNISSEUR'=>$this->input->post('CODE_FOURNISSEUR'),
				'ID_SECTEUR_ACTIVITE'=>$this->input->post('ID_SECTEUR_ACTIVITE'),
				'ID_ARTICLE'=>$this->input->post('ID_ARTICLE'),
				'ID_UNITE_MESURE'=>$this->input->post('ID_UNITE_MESURE'),
				'QUANTITE'=>$this->input->post('QUANTITE'),
				'PRIX'=>$this->input->post('PRIX')
			);
			// print_r("expression");die();


			$this->Model->update('ecom_publication',array('ID_PUBLICATION'=>$id),$data);
			$datas['message']='<div class="alert alert-success text-center" id="message">La modification du  '.$this->input->post('NOM_PROFIL').'</b> Faite avec Succes</div>';
			$this->session->set_flashdata($datas);

			redirect(base_url('culture/PublicationC'));
		}
	}
	// 	function delete()
	// {
	// 	$table="ecom_publication";
	// 	$criteres['ID_PUBLICATION']=$this->uri->segment(4);
	// 	$data['rows']= $this->Model->getOne( $table,$criteres);

	// 	$this->Model->delete($table,$criteres);

	// 	$data['message']='<div class="alert alert-success text-center" id="message">'."L\ 'evaluation <b> ".' '.$data['rows']['NOM_PROFIL'].' </b> '." est supprimé avec succès".'</div>';
	// 	$this->session->set_flashdata($data);
	// 	redirect(base_url('culture/Publication'));
	// }



	//     function save()
	//     {   	


	//     	 $this->form_validation->set_rules('Culture','', 'trim|required',array('required'=>'<font style="color:red;size:2px;">Le champ est Obligatoire</font>'));
	//     	 $this->form_validation->set_rules('ID_FILIERE','', 'trim|required',array('required'=>'<font style="color:red;size:2px;">Le champ est Obligatoire</font>'));
	//     	 $this->form_validation->set_rules('SUP','', 'trim|required',array('required'=>'<font style="color:red;size:2px;">Le champ est Obligatoire</font>'));


	//     	if ($this->form_validation->run() == false) {
 //            # code...
 //            $this->add();
 //        }else{


 //             $data_insert=array(
 //              	'ID_PUBLICATION'=>$this->input->post('ID_PUBLICATION'),
 //          		'CODE_FOURNISSEUR'=>$this->input->post('CODE_FOURNISSEUR'),
 //          		'ID_SECTEUR_ACTIVITE'=>$this->input->post('ID_SECTEUR_ACTIVITE'),

 //          		'QUANTITE'=>$this->input->post('QUANTITE'),
 //          		'PRIX'=>$this->input->post('PRIX'),);
 //                $table='cultures';

 //               //  print_r($data_insert);die(); 


 //             	$check = $this->Model->getOne($table,$data_insert);

 //               if(!empty($check))
 //               {

	//       		$data['message'] = '<div class="alert text-white alert-primary text-center" id="message"><h4 style="color:black">'."La Culture  existe déjà".'</h4></div>';

 //        		$this->session->set_flashdata($data);


 //       			 $this->add();
 //      			}else
 //      			{
 //      			 $create=$this->Model->create($table,$data_insert);


 //      			 if($create)

 //      			 {
 //      			 	$data['message']='<div class="alert alert-success text-center" id="message">Enregistrement effectuée  avec succès</div>';
 //          			$this->session->set_flashdata($data);
 //          			redirect(base_url('culture/Cultures'));
 //      			 }else
 //      			 {
 //      			 	$message['message']='<div class="alert alert-success text-center" id="message">Enregistrement échouée</div>';
 //          			$this->session->set_flashdata($data);
 //          			$this->add();
 //      			 }
 //      			}


	// 	}
	// }



	// function update()
	//  {

	// 		$this->form_validation->set_rules('CODE_FOURNISSEUR','', 'trim|required',array(
	// 		'required'=>'<font style="color:red;size:2px;">Le champ est Obligatoire</font>'));

	// 			$this->form_validation->set_rules('ID_ARTICLE','', 'trim|required',array('required'=>'<font style="color:red;size:2px;">Le champ est Obligatoire</font>'));

	// 		$this->form_validation->set_rules('ID_SECTEUR_ACTIVITE','', 'trim|required',array(
	// 		'required'=>'<font style="color:red;size:2px;">Le champ est Obligatoire</font>'));


 //     	$this->form_validation->set_rules('ID_UNITE_MESURE','', 'trim|required',array('required'=>'<font style="color:red;size:2px;">Le champ est Obligatoire</font>'));

	// 		$this->form_validation->set_rules('QUANTITE','', 'trim|required',array(
	// 		'required'=>'<font style="color:red;size:2px;">Le champ est Obligatoire</font>'));

	// 		$this->form_validation->set_rules('PRIX','', 'trim|required',array(
	// 		'required'=>'<font style="color:red;size:2px;">Le champ est Obligatoire</font>'));


	// $id=$this->input->post('ID_PUBLICATION');

	//     	if ($this->form_validation->run() == false) {
 //            # code...
 //            $this->getOne($ID_PUBLICATION);
 //        }else{

	//     	$formatArrayray	= array(
	//     	'CODE_FOURNISSEUR'=>$this->input->post('CODE_FOURNISSEUR'),
	// 			'ID_SECTEUR_ACTIVITE'=>$this->input->post('ID_SECTEUR_ACTIVITE'),
	// 			'ID_ARTICLE'=>$this->input->post('ID_ARTICLE'),
	// 			'ID_UNITE_MESURE'=>$this->input->post('ID_UNITE_MESURE'),
	// 			'QUANTITE'=>$this->input->post('QUANTITE'),
	// 			'PRIX'=>$this->input->post('PRIX')
	//     			    	);

	 

	//      $this->Model->update('ecom_publication',array('ID_PUBLICATION'=>$ID_PUBLICATION),$formatArrayray);


	//     	if($formatArrayray){

	//     		$data['message']='<div class="alert alert-success text-center" id="message">'."La modification est faite avec succès".'</div>';
 //            // $this->session->set_flashdata($data);
 //             redirect(base_url('culture/Publication/'));
	//     	}else{
	//     		$data['message']='<div class="alert alert-success text-center" id="message">'."Modification échouée".'</div>';
 //            $this->session->set_flashdata($data);
 //            $this->getOne($id);

	//     	}
	//     }
	//     }

	
	    //suppression de Cultures
	    // function delete($id)
	    // {

	    // 	$table='Cultures';
	    // 	$criteres['ID_CULTURE']=$id;
	    // 	$data['rows']= $this->Model->getOne( $table,$criteres);
	    // 	$supr=$this->Model->delete($table,$criteres);
	    // 	if($supr)
	    // 	{
	    // 		$data['message']='<div class="alert alert-success text-center" id="message">Suppression effectuée  avec succès</div>';
	    // 		$this->session->set_flashdata($data);
	    // 		//echo json_encode(array('status'=>true));
	    // 		redirect(base_url('culture/Cultures/'));
	    // 	}else
	    // 	{
	    // 		$data['message']='<div class="alert alert-success text-center" id="message">Suppression échouée </div>';
	    // 		$this->session->set_flashdata($data);
	    // 		redirect(base_url('culture/Cultures/'));
	    // 	}



	    // }

	    	//details des cultures



}
?>

