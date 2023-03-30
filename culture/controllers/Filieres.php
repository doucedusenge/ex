
<?php 
	/**
CRUD des filières 

*fait par Martial BERAMIHETO
10-01-2023
*/
class Filieres extends CI_Controller
	{     		
		function __construct()
		{
			# code...
			parent::__construct();
		}

		function index()
	{

		$this->load->view('Filière_View');
	}

	//Affichage d'une liste
	function listing()
	{
		$query_principal='SELECT ID_FILIERE,NOM_FILIERE FROM filières WHERE 1';

		$var_search= !empty($_POST['search']['value']) ? $_POST['search']['value'] : null;

		$limit='LIMIT 0,10';


		if($_POST['length'] != 0){
			$limit='LIMIT '.$_POST["start"].','.$_POST["length"];
		}
		$order_by='';

		$order_column=array( 'ID_FILIERE','NOM_FILIERE');
		
		$order_by = isset($_POST['order']) ? ' ORDER BY ' . $order_column[$_POST['order']['0']['column']] . '  ' . $_POST['order']['0']['dir'] : ' ORDER BY NOM_FILIERE ASC';


		$search = !empty($_POST['search']['value']) ?  (" AND (`NOM_FILIERE` LIKE '%$var_search%')") :'';   

		$critaire = '';

		
		$query_secondaire=$query_principal.' '.$critaire.' '.$search.' '.$order_by.'   '.$limit;
		
		$query_filter = $query_principal.' '.$critaire.' '.$search;

		// $abonne='';

		$fetch_res= $this->Model->datatable($query_secondaire);
		$data = array();
		
		$u=0;
		foreach ($fetch_res as $row) {

			
			
			$u++;
			$sub_array = array();
			$sub_array[]=$u;
			
			$sub_array[]=$row->NOM_FILIERE;
			
			
			$action = '<div class="dropdown" style="color:#fff;">
	         <a class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown"><i class="fa fa-cog"></i> Options  <span class="caret"></span>
	         </a>
	         <ul class="dropdown-menu dropdown-menu-left">';

	         $action .="<li>
	         <a href='".base_url('culture/Filieres/getOne/').$row->ID_FILIERE ."'>
	         <label>&nbsp;<span class='fa fa-edit'></span>&nbsp;Modifier</label>
	         </a>
	         </li>";
	         $action .="<li>
	         <a href='#' data-toggle='modal' data-target='#mydelete".$row->ID_FILIERE."'>
	         <label class='text-danger'>&nbsp;<span class='fa fa-trash'></span>&nbsp;Supprimer</label>
	         </a>
	         </li>";


			  $action .= " </ul>
	         </div>
	         <div class='modal fade' id='mydelete".$row->ID_FILIERE."'>
	         <div class='modal-dialog'>
			 <div class='modal-content'>

	         <div class='modal-body'>
	         <center>
	         <h5><strong>Voulez-vous supprimé une plantation?</strong><br> <b style:'background-color:prink';><i style='color:green;'>" . $row->NOM_FILIERE."</i></b>
	         </h5>
	         </center>
	         </div>

	         <div class='modal-footer'>
	         <a class='btn btn-danger btn-md' href='" . base_url('culture/Filieres/delete/').$row->ID_FILIERE. "'>
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


//Ajout d'une filière
		function add()
		{
		$data['title'] = 'Enregistrement de filière';
        $this->load->view('Add_Filiere_View',$data);


	    }
	//form_validation
	    function save()
	    {
	    	// $NOM_FILIERE=$this->input()->NOM_FILIERE

	    	 $this->form_validation->set_rules('NOM_FILIERE','', 'trim|required',array('required'=>'<font style="color:red;size:2px;">Le champ est Obligatoire</font>'));
	    	if ($this->form_validation->run() == false) {
            # code...
            $this->add();
        }else{

             
             $data_insert=array(
                    
              'NOM_FILIERE'=>$this->input->post('NOM_FILIERE'));
                $table='filières';


               $check = $this->Model->getOne($table,$data_insert);
                
               if(!empty($check))
               {

	      		$data['message'] = '<div class="alert alert-primary text-center" id="message"><h4 style="color:black">'."La filière  existe déjà".'</h4></div>';

        		$this->session->set_flashdata($data);
   
        		//redirect(base_url('culture/Filieres/add'));
       			 $this->add();
      			}else
      			{
      			 $create=$this->Model->create($table,$data_insert);


      			 if($create)

      			 {
      			 	$data['message']='<div class="alert alert-success text-center" id="message">Enregistrement effectuée  avec succès</div>';
          $this->session->set_flashdata($data);
          redirect(base_url('culture/Filieres'));
      			 }else
      			 {
      			 	$message['message']='<div class="alert alert-success text-center" id="message">L\'enregistrement échouée</div>';
          $this->session->set_flashdata($data);
          $this->add();
      			 }
      			}

              //  $this->Model->create($table,$data_insert);
              //  $data['message']='<div class="alert alert-success text-center" id="message">'."Enrengistrement effectuée avec succès".'</div>';
             	// $this->session->set_flashdata($data);
              //  	redirect(base_url('culture/Filieres/'));
    		}
}




	    function getOne($id)
	    {
	    	$data['title']="Modification d'une filière";
	    	$filières=$this->Model->getRequeteOne('SELECT ID_FILIERE,NOM_FILIERE FROM filières
              WHERE ID_FILIERE='.$id);
	    	$data['filières']=$filières;
	    	//echo json_encode(array('info'=>$data));
	    	 $this->load->view('Update_Filière_View',$data);

	    }

	    public function update()
	    {
	    	

	    	$id=$this->input->post('ID_FILIERE');
	    	$NOM_FILIERE=$this->input->post('NOM_FILIERE');
	    	$this->form_validation->set_rules('NOM_FILIERE','','trim|required',array('required'=>'<font style="color:red;size:2px;">Le champ est Obligatoire</font>'));
	    	
	    	if ($this->form_validation->run() == false) {
            # code...
            $this->getOne($id);
        }else{


        
	    	$formatArrayray	= array(
	    		'NOM_FILIERE'=>$this->input->post('NOM_FILIERE'),
	    		
	    	);


	    	$update= $this->Model->update('filières',array('ID_FILIERE'=>$id),$formatArrayray);


	    	

	    	$data['message']='<div class="alert alert-success text-center" id="message">'."La modification est faite avec succès".'</div>';
            $this->session->set_flashdata($data);
             redirect(base_url('culture/Filieres/'));
	    	
	    }
	}
	
	    //suppression de filières
	    function delete($id)
	    {
	    	
	    	$table='filières';
	    	$criteres['ID_FILIERE']=$id;
	    	$data['rows']= $this->Model->getOne( $table,$criteres);
	    	$this->Model->delete($table,$criteres);
	    	$data['message']='<div class="alert alert-success text-center" id="message">'."La Suprression est faite avec succès".'</div>';
             $this->session->set_flashdata($data);
	    	//echo json_encode(array('status'=>true));
	    	redirect(base_url('culture/Filieres/'));
	    }

	}
?>