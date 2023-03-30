<?php
 /**
  * auteur:Douce
  date:21/02/2023
  CRUD alimentation with multi-select
  */

  class Alimentation extends CI_Controller
  {  

  // 	function __construct()
	 // {
	 // 		# code...
	 // 	parent::__construct();
	 // }
  	function index(){

  		$this->load->view('Alimentation_View');
  	}
 	//c'est la fonction qui nous aide  a lister
  	function listing()
  	{

  		$query_principal=' SELECT achat.ID_CLIENT,`NOM_CLIENT`,`ID_ACHAT` FROM
                    `achat` JOIN client ON client.ID_CLIENT=achat.ID_CLIENT   		';

			// $var_search= !empty($_POST['search']['value']) ? $_POST['search']['value'] : null;

  		$var_search= !empty($_POST['search']['value']) ? $_POST['search']['value'] : null;

  		$limit='LIMIT 0,10';

  		$draw= isset($_POST['draw']);
  		$start=isset($postData['start']);


  		if(isset($_POST["length"]) && $_POST["length"] != -1)
  		{
  			$limit='LIMIT '.$_POST["start"].','.$_POST["length"];

  		}
  		$order_by='';

  		$order_column=array( 'NOM_CLIENT','ID_CLIENT');
  		$order_by = isset($_POST['order']) ? ' ORDER BY ' . $order_column[$_POST['order']['0']['column']] . '  ' . $_POST['order']['0']['dir'] : ' ORDER BY NOM_CLIENT ASC';


  		$search = !empty($_POST['search']['value']) ?  (" AND (cultures.PRIX LIKE '%$var_search%')") :'';   
  		$critaire = ' ';


  		$query_secondaire=$query_principal.' '.$search.' '.$critaire.' '.$order_by.'   '.$limit;

  		$query_filter = $query_principal.' '.$search.' '.$critaire;



  		$fetch_res= $this->Model->datatable($query_secondaire);
  		$data = array();

  		$u=1;

  		foreach ($fetch_res as $row) {
  			$produit= $this->Model->getRequete('SELECT  achat_produit.ID_PRODUIT,NOM_PRODUIT, achat_produit.QUANTITE  FROM `achat_produit` JOIN  produit ON produit.ID_PRODUIT=achat_produit.ID_PRODUIT WHERE ID_ACHAT='.$row->ID_ACHAT.'');

  			$sub_array = array();
  			$sub_array[]=$u++;

			//$sub_array[]=$row->ID_PRODUIT;

			//print_r($row->ID_CLIENT);die();
  			$sub_array[]=$row->NOM_CLIENT;


  			$sub_array[]="<center><a href='javascript:;'  class='btn btn-secondary btn-md' onclick='get_produit(" . $row->ID_ACHAT . ")'>" . count($produit) . "</a></center>";
        // $sub_array[]=$produitsw;

			//$sub_array[]=$row->ID_PRODUIT;
  			//$sub_array[]=$row->QUANTITE;

  			$action = '<div class="dropdown" style="color:#fff;">
  			<a class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown"><i class="fa fa-cog"></i> Options  <span class="caret"></span>
  			</a>
  			<ul class="dropdown-menu dropdown-menu-left">';

  			$action .="<li>
  			<a href='".base_url('culture/Alimentation/getOne/').$row->ID_ACHAT ."'>
  			<label>&nbsp;<span class='fa fa-edit'></span>&nbsp;Modifier</label>
  			</a>
  			</li>";
  			$action .="<li>
  			<a href='#' data-toggle='modal' data-target='#mydelete".$row->ID_ACHAT."'>
  			<label class='text-danger'>&nbsp;<span class='fa fa-trash'></span>&nbsp;Supprimer</label>
  			</a>
  			</li>";


  			$action .= " </ul>
  			</div>
  			<div class='modal fade' id='mydelete".$row->ID_ACHAT."'>
  			<div class='modal-dialog'>
  			<div class='modal-content'>

  			<div class='modal-body'>
  			<center>
  			<h5><strong>Voulez-vous supprimé ?</strong><br> <b style:'background-color:prink';><i 
        style='color:green;'></i></b>
  			</h5>
  			</center>
  			</div>

  			<div class='modal-footer'>
  			<a class='btn btn-danger btn-md' href='" . base_url('culture/Alimentation/delete/').$row->ID_ACHAT. "'>
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

	function get_produit($id)
  	{

  		$query_principal=' SELECT  `NOM_PRODUIT` , achat_produit.QUANTITE FROM `achat_produit` JOIN produit ON produit.ID_PRODUIT=achat_produit.ID_PRODUIT WHERE ID_ACHAT='.$id.'
  		';

			// $var_search= !empty($_POST['search']['value']) ? $_POST['search']['value'] : null;

  		$var_search= !empty($_POST['search']['value']) ? $_POST['search']['value'] : null;

  		$limit='LIMIT 0,10';

  		$draw= isset($_POST['draw']);
  		$start=isset($postData['start']);


  		if(isset($_POST["length"]) && $_POST["length"] != -1)
  		{
  			$limit='LIMIT '.$_POST["start"].','.$_POST["length"];

  		}
  		$order_by='';

  		$order_column=array( 'NOM_PRODUIT','QUANTITE');
  		$order_by = isset($_POST['order']) ? ' ORDER BY ' . $order_column[$_POST['order']['0']['column']] . '  ' . $_POST['order']['0']['dir'] : ' ORDER BY NOM_PRODUIT ASC';


  		$search = !empty($_POST['search']['value']) ?  (" AND (produit.NOM_PRODUIT LIKE '%$var_search%')") :'';   
  		$critaire = ' ';


  		$query_secondaire=$query_principal.' '.$search.' '.$critaire.' '.$order_by.'   '.$limit;

  		$query_filter = $query_principal.' '.$search.' '.$critaire;



  		$fetch_res= $this->Model->datatable($query_secondaire);
  		$data = array();

  		$u=1;

  		foreach ($fetch_res as $row) {
  			//$produit= $this->Model->getRequeteOne('SELECT COUNT(ID_PRODUIT) AS nombre from `achat` WHERE ID_CLIENT='.$row->ID_CLIENT.'');

  			$sub_array = array();
  			$sub_array[]=$u++;

			//$sub_array[]=$row->ID_PRODUIT;

			//print_r($row->ID_CLIENT);die();
  			$sub_array[]=$row->NOM_PRODUIT;
			$sub_array[]=$row->QUANTITE;


  	
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

  	function insert(){
  		$data['error']='';
		$data['client'] = $this->Model->getRequete('SELECT `ID_CLIENT`, `NOM_CLIENT`, `PRENOM_CLIENT`  FROM `client` WHERE 1');

	
		$data['produit']=$this->Model->getRequete('SELECT ID_PRODUIT, `NOM_PRODUIT` FROM `produit` ');
		$data['exist']=array();
		// $data['produit'] = $this->Model->getRequete('SELECT `ID_PRODUIT`, `ID_UNITE_MESURE`, `NOM_PRODUIT`, `PRIX`, `QUANTITE` FROM `produit` WHERE 1');

		$this->load->view('Add_Alimentation_View',$data);

  	}

  	function save()
	{
		
	 		$this->form_validation->set_rules('ID_CLIENT','', 'trim|required',array(
	 		'required'=>'<font style="color:red;size:2px;">Le champ est Obligatoire</font>'));

			$this->form_validation->set_rules('ID_PRODUIT[]','', 'required',array('required'=>'<font style="color:red;size:2px;">Le champ est Obligatoire</font>'));

	 		$this->form_validation->set_rules('QUANTITE','', 'trim|required',array(
	 		'required'=>'<font style="color:red;size:2px;">Le champ est Obligatoire</font>'));

			if ($this->form_validation->run() == FALSE)
			{
			
			$this->load->view('Add_Alimentation_View');

			}	
			else
			{
        $dataInsert=array(
        'ID_CLIENT'=>$this->input->post('ID_CLIENT'),

      ); 

      $table='achat';
      $ID_ACHAT=$this->Model->insert_last_id($table,$dataInsert); 
      $produit=$this->input->post('ID_PRODUIT');
      foreach ($produit as $value) {
             $produit=array(
             'ID_ACHAT'=>$ID_ACHAT,
              'QUANTITE'=>$this->input->post('QUANTITE'),
             'ID_PRODUIT'=>$value
           );

            $table='achat_produit';

             $this->Model->create($table,$produit);
           }




			// $produit=$this->input->post('ID_PRODUIT');
			// $dataInsert=array(
			// 	'ID_CLIENT'=>$this->input->post('ID_CLIENT');
			// 	//'ID_PRODUIT'=>$this->input->post('ID_PRODUIT')
				
			// 	'QUANTITE'=>$this->input->post('QUANTITE'),
			// 	 foreach ($produit as $value) {
		 //  				$produit=array(
		 // 				'ID_PRODUIT'=>$this->input->post('ID_PROFIL'),
		 // 				'ID_VILLE'=>$value);

				
			// );

		// $product=$this->input->post('ID_PRODUIT');
		// 			  foreach ($product as $value) {
		// 			  	$dataInsert=array(
		// 				'ID_CLIENT'=>$this->input->post('ID_CLIENT'),
  //           'QUANTITE'=>$this->input->post('QUANTITE'),
		// 				'ID_PRODUIT'=>$value
  //         );
        //  print_r($product);die();

					// $table='achat';
					// $this->Model->create($table,$dataInsert);
					//   }
         //  print_r('expression');die();
   
       // print_r($dataInsert);die();


		// 	$table='achat';
		// 	$this->Model->create('achat',$dataInsert);
		// }

			$data['message']='<div class="alert alert-success text-center" id="message">'."L'enregistrement de l'achat <b>".' '.$this->input->post('QUANTITE').'</b> '." est faite avec succès".'</div>';
			$this->session->set_flashdata($data);
			redirect(base_url('culture/Alimentation'));
		

}
}
  function getOne($id)
  {
    $data['error']='';
    $data['client'] = $this->Model->getRequete('SELECT `ID_CLIENT`, `NOM_CLIENT`, `PRENOM_CLIENT`  FROM `client` WHERE 1');

    $produit= $this->Model->getRequete('SELECT  achat_produit.ID_PRODUIT  FROM `achat_produit` JOIN  produit ON produit.ID_PRODUIT=achat_produit.ID_PRODUIT WHERE ID_ACHAT='.$id.'');
    $selectedproduit=array();
    foreach ($produit as $key) {
      # code...
      $selectedproduit[]=$key['ID_PRODUIT'];
    }
    //var_dump($selectedproduit);
    //print_r($selectedproduit);die();
    $data['selectedproduit']=$selectedproduit;


    $data['produit']=$this->Model->getRequete('SELECT  `NOM_PRODUIT`,ID_PRODUIT FROM `produit` ');
    $data['exist']=array();
    $sql='SELECT DISTINCT achat.ID_ACHAT, `QUANTITE`,achat.ID_CLIENT FROM `achat_produit` JOIN       achat WHERE achat.ID_ACHAT='.$id;
    $data['data']=$this->Model->getRequeteOne($sql);
  
      $this->load->view('Update_Alimentation_View',$data);
  }
 public function update()
  {
    
    $id=$this->input->post('ID_ACHAT');
     //     'ID_ARTICLE'=>$this->input->post('ID_ARTICLE');
        
    $this->form_validation->set_rules('ID_CLIENT','', 'trim|required',array(
      'required'=>'<font style="color:red;size:2px;">Le champ est Obligatoire</font>'));

      $this->form_validation->set_rules('ID_PRODUIT[]','', 'required',array('required'=>'<font style="color:red;size:2px;">Le champ est Obligatoire</font>'));

      $this->form_validation->set_rules('QUANTITE','', 'trim|required',array(
      'required'=>'<font style="color:red;size:2px;">Le champ est Obligatoire</font>'));


    if ($this->form_validation->run() == false) {
            # code...
      $this->getOne($id);
    }else{        
    
      //$id=$this->input->post('ID_ACHAT');
      $data=array(    
        'ID_CLIENT'=>$this->input->post('ID_CLIENT'),
       
      );
      // print_r("expression");die();

      $this->Model->update('achat',array('ID_ACHAT'=>$id),$data);
      $this->Model->delete('achat_produit',array('ID_ACHAT'=>$id));
       $produit=$this->input->post('ID_PRODUIT');
        foreach ($produit as $value) {
             $produit=array(
             'ID_ACHAT'=>$id,
              'QUANTITE'=>$this->input->post('QUANTITE'),
             'ID_PRODUIT'=>$value
           );

              $table='achat_produit';

             $this->Model->create($table,$produit);
           }



      $data['message']='<div class="text-center alert-success " id="message" style="color:#007bac">'."La modification est faite avec succès".'</div>';
      $this->session->set_flashdata($data);
      redirect(base_url('culture/Alimentation/'));
      
    }
      }
    function delete($ID_ACHAT=0)
  {
    $table="achat";
    $criteres['ID_ACHAT']=$ID_ACHAT;
    $data['rows']= $this->Model->getOne( $table,$criteres);
    //print_r($criteres);die();

    $this->Model->delete($table,$criteres);

    $data['message']='<div class="alert alert-success text-center" id="message">'."L\ 'achat <b> ".' '.$data['rows']['NOM_PROFIL'].' </b> '." est supprimé avec succès".'</div>';
    $this->session->set_flashdata($data);
    redirect(base_url('culture/Alimentation'));
  }

  }
?>