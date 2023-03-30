
<?php

/*
CRUD Biodata
@author Douce
-18-02-2023
*/


class Biodata extends CI_Controller
{     		
	function __construct()
	{
			# code...
		parent::__construct();
	}

	function index(){

		$this->load->view('Biodata_View');
	}
	//Affichage d'une liste de cultures
	function listing()
	{

		$query_principal='
		SELECT `ID`, biodata_cooperative_article.ID_ARTICLE, biodata_cooperative_article.ID_COOPERATIVE, DESCR_ARTICLE,NOM_COOPERATIVE,`NOMBRE_LIVESTOCK`, `AUTRE_ARTICLE` FROM `biodata_cooperative_article` JOIN ecom_article ON ecom_article.ID_ARTICLE=biodata_cooperative_article.ID_ARTICLE JOIN biodata_cooperative ON biodata_cooperative_article.ID_COOPERATIVE=biodata_cooperative.ID_COOPERATIVE WHERE 1



		';

			// $var_search= !empty($_POST['search']['value']) ? $_POST['search']['value'] : null;

		$var_search= !empty($_POST['search']['value']) ? $_POST['search']['value'] : null;

		$limit='LIMIT 0,10';


		if(isset($_POST["length"]) && $_POST["length"] != -1)
		{
			$limit='LIMIT '.$_POST["start"].','.$_POST["length"];
			
		}
		$order_by='';

		$order_column=array( 'ID_ARTICLE','ID_COOPERATIVE','NOMBRE_LIVESTOCK','AUTRE_ARTICLE');
		$order_by = isset($_POST['order']) ? ' ORDER BY ' . $order_column[$_POST['order']['0']['column']] . '  ' . $_POST['order']['0']['dir'] : ' ORDER BY PRIX ASC';


		$search = !empty($_POST['search']['value']) ?  (" AND (cultures.PRIX LIKE '%$var_search%')") :'';   
		$critaire = ' ';


		$query_secondaire=$query_principal.' '.$search.' '.$critaire.' '.$order_by.'   '.$limit;

		$query_filter = $query_principal.' '.$search.' '.$critaire;

		

		$fetch_res= $this->Model->datatable($query_secondaire);
		$data = array();
		
		$u=1;


		foreach ($fetch_res as $row) {
			

			
			$sub_array = array();
			$sub_array[]=$u++;
			
			$sub_array[]=$row->DESCR_ARTICLE;
			$sub_array[]=$row->NOM_COOPERATIVE;
			$sub_array[]=$row->NOMBRE_LIVESTOCK;
			$sub_array[]=$row->AUTRE_ARTICLE;
			
			
			$action = '<div class="dropdown" style="color:#fff;">
			<a class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown"><i class="fa fa-cog"></i> Options  <span class="caret"></span>
			</a>
			<ul class="dropdown-menu dropdown-menu-left">';

			$action .="<li>
			<a href='".base_url('culture/Biodata/getOne/').$row->ID ."'>
			<label>&nbsp;<span class='fa fa-edit'></span>&nbsp;Modifier</label>
			</a>
			</li>";
			$action .="<li>
			<a href='#' data-toggle='modal' data-target='#mydelete".$row->ID."'>
			<label class='text-danger'>&nbsp;<span class='fa fa-trash'></span>&nbsp;Supprimer</label>
			</a>
			</li>";


			$action .= " </ul>
			</div>
			<div class='modal fade' id='mydelete".$row->ID."'>
			<div class='modal-dialog'>
			<div class='modal-content'>

			<div class='modal-body'>
			<center>
			<h5><strong>Voulez-vous supprimé une Culture?</strong><br> <b style:'background-color:prink';><i style='color:green;'>" . $row->ID."</i></b>
			</h5>
			</center>
			</div>

			<div class='modal-footer'>
			<a class='btn btn-danger btn-md' href='" . base_url('culture/Biodata/delete/').$row->ID. "'>
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


    	//Ajout d'une Culture 
	function add()
	{
		$data['cooperative']= $this->Model->getRequete('SELECT `ID_COOPERATIVE`, `NOM_COOPERATIVE`, `NOM_RESPONSABLE` FROM `biodata_cooperative` WHERE 1');
		$data['article']= $this->Model->getRequete('SELECT `ID_ARTICLE`, `DESCR_ARTICLE` FROM `ecom_article` WHERE 1');

		
		$data['title'] = "Enregistrement de la culture";
		//print_r('expression');die();
		$this->load->view('Add_Biodata_View',$data);


	}

	function save()
	{
		
		$this->form_validation->set_rules('ID_ARTICLE','', 'trim|required',array(
			'required'=>'<font style="color:red;size:2px;">Le champ est Obligatoire</font>'));

		$this->form_validation->set_rules('ID_COOPERATIVE','', 'trim|required',array('required'=>'<font style="color:red;size:2px;">Le champ est Obligatoire</font>'));

		$this->form_validation->set_rules('NOMBRE_LIVESTOCK','', 'trim|required',array(
			'required'=>'<font style="color:red;size:2px;">Le champ est Obligatoire</font>'));


			// $this->form_validation->set_rules('AUTRE_ARTICLE','', 'trim|required',array('required'=>'<font style="color:red;size:2px;">Le champ est Obligatoire</font>'));

		if ($this->form_validation->run() == false) {
            # code...
			$this->add();
		}


		// if ($this->form_validation->run() == FALSE)
		// {
		// 	// print_r("expression");die();

		// 	// $data = array(
		// 	// 	'PRIX' => $this->input->post('NOMBRE_LIVESTOCK')
		// 	$this->add();
		// 	);
		
		// 	$data['error']='';

		// 	// print_r($data);die();
		// 	$this->load->view('Add_Biodata_View',$data);
		// }
		

		else
		{

			$dataInsert=array(
				'ID_ARTICLE'=>$this->input->post('ID_ARTICLE'),
				'ID_COOPERATIVE'=>$this->input->post('ID_COOPERATIVE'),
				'NOMBRE_LIVESTOCK'=>$this->input->post('NOMBRE_LIVESTOCK'),
				//'AUTRE_ARTICLE'=>$this->input->post('AUTRE_ARTICLE')
				
			);			
			//print_r($dataInsert);die();
			$table='biodata_cooperative_article';
			$this->Model->create('biodata_cooperative_article',$dataInsert);

			$data['message']='<div class="alert alert-success text-center" id="message">'."L'enregistrement d'un installation <b>".' '.$this->input->post('AUTRE_ARTICLE').'</b> '." est faite avec succès".'</div>';
			$this->session->set_flashdata($data);
			redirect(base_url('culture/Biodata'));


		}

	}
		//Modification de la cultures
	function getOne($id)
	{
	//	$id=$this->uri->segment(4);

		$data['title']="Modification ";

		$data['cooperative']= $this->Model->getRequete('SELECT `ID_COOPERATIVE`, `NOM_COOPERATIVE`, `NOM_RESPONSABLE` FROM `biodata_cooperative` WHERE 1');
		$data['article']= $this->Model->getRequete('SELECT `ID_ARTICLE`, `DESCR_ARTICLE` FROM `ecom_article` WHERE 1');

		$data['data']=$this->Model->getOne('biodata_cooperative_article',array('ID'=>$id));

		
		// print_r($data['data']);die();
		
		$this->load->view('Update_Biodata_View',$data);
	}
	public function update()
	{
		

		$id=$this->input->post('ID_ACHAT');
	   //  		'ID_ARTICLE'=>$this->input->post('ID_ARTICLE');
				// 'ID_COOPERATIVE'=>$this->input->post('ID_COOPERATIVE');
				// 'NOMBRE_LIVESTOCK'=>$this->input->post('NOMBRE_LIVESTOCK');
				// 'AUTRE_ARTICLE'=>$this->input->post('AUTRE_ARTICLE')
				// '$NOMBRE_LIVESTOCK'=>$this->input->post('NOMBRE_LIVESTOCK');
				// print_r('$NOMBRE_LIVESTOCK');die()
		
		$this->form_validation->set_rules('ID_ARTICLE','', 'trim|required',array(
			'required'=>'<font style="color:red;size:2px;">Le champ est Obligatoire</font>'));

		$this->form_validation->set_rules('ID_COOPERATIVE','', 'trim|required',array('required'=>'<font style="color:red;size:2px;">Le champ est Obligatoire</font>'));

		$this->form_validation->set_rules('NOMBRE_LIVESTOCK','', 'trim|required',array(
			'required'=>'<font style="color:red;size:2px;">Le champ est Obligatoire</font>'));

		if ($this->form_validation->run() == false) {
            # code...
			$this->getOne($id);
		}else{        
			
		
			$data['message']='<div class="text-center alert-success " id="message" style="color:#007bac">'."La modification est faite avec succès".'</div>';
			$this->session->set_flashdata($data);
			redirect(base_url('culture/Alimentation/'));
			
		}
	}
	
	 // function update()
	// {
	
	//  	$data['cooperative']= $this->Model->getRequete('SELECT `ID_COOPERATIVE`, `NOM_COOPERATIVE`, `NOM_RESPONSABLE` FROM `biodata_cooperative` WHERE 1');
	// 	$data['article']= $this->Model->getRequete('SELECT `ID_ARTICLE`, `DESCR_ARTICLE` FROM `ecom_article` WHERE 1');


	// 	if ($this->form_validation->run() == FALSE) {
	// 		$id=$this->input->post('ID'); 
	// 		$this->getOne($id);
	
	// 		//$data['data']=$this->Model->getOne('ecom_publication',array('ID_PUBLICATION'=>$id));


	// 	//	$data['error']='';

	// 		//$this->load->view('Update_Publication_View',$data);
	// 	}else
	// 	{

	// 		$id=$this->input->post('ID');
	// 		$data=array(    
	// 			'ID_ARTICLE'=>$this->input->post('ID_ARTICLE'),
	// 			'ID_COOPERATIVE'=>$this->input->post('ID_COOPERATIVE'),
	// 			'NOMBRE_LIVESTOCK'=>$this->input->post('NOMBRE_LIVESTOCK'),
	// 			'AUTRE_ARTICLE'=>$this->input->post('AUTRE_ARTICLE')
	// 		);
	// 		// print_r("expression");die();


	// 		$this->Model->update('biodata_cooperative_article',array('ID'=>$id),$data);
	// 		$datas['message']='<div class="alert alert-success text-center" id="message">La modification du  '.$this->input->post('NOMBRE_LIVESTOCK').'</b> Faite avec Succes</div>';
	// 		$this->session->set_flashdata($datas);

	// 		redirect(base_url('culture/Biodata'));
	// 	}
	// }

	
	// //suppression

	function delete()
	{
		$table="biodata_cooperative_article";
		$criteres['ID']=$this->uri->segment(4);
		$data['rows']= $this->Model->getOne( $table,$criteres);

		$this->Model->delete($table,$criteres);

		$data['message']='<div class="alert alert-success text-center" id="message">'."L\ 'evaluation <b> ".' '.$data['rows']['DESCR_ARTICLE'].' </b> '." est supprimé avec succès".'</div>';
		$this->session->set_flashdata($data);
		redirect(base_url('culture/Biodata'));
	}


	    	//details des cultures
	


}
?>

