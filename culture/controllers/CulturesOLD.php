<?php

/*
CRUD des cultures
@author Martial Beramiheto
-11-01-2023
*/


class Cultures extends CI_Controller
	{     		
		function __construct()
		{
			# code...
			parent::__construct();
		}

		function index(){

			$this->load->view('Cultures_View');
		}
	//Affichage d'une liste de cultures
		function listing()
		{

			$query_principal='SELECT `ID_CULTURE`,cultures.DESCRIPTION ,SUPERFICIE AS SUP,filières.NOM_FILIERE AS flName,plantation.DESCRIPTION AS plant FROM cultures JOIN filières ON filières.`ID_FILIERE`=cultures.ID_FILIERE JOIN plantation ON  plantation.ID_PLANTATION=cultures.ID_PLANTATION WHERE 1';

			// $var_search= !empty($_POST['search']['value']) ? $_POST['search']['value'] : null;

			$var_search= !empty($_POST['search']['value']) ? $_POST['search']['value'] : null;

			$limit='LIMIT 0,10';


			if(isset($_POST["length"]) && $_POST["length"] != -1)
			{
			$limit='LIMIT '.$_POST["start"].','.$_POST["length"];
			
			}
			$order_by='';

			$order_column=array( 'ID_CULTURE','DESCRIPTION','flName','SUP','plant');
			$order_by = isset($_POST['order']) ? ' ORDER BY ' . $order_column[$_POST['order']['0']['column']] . '  ' . $_POST['order']['0']['dir'] : ' ORDER BY DESCRIPTION ASC';


			$search = !empty($_POST['search']['value']) ?  (" AND (cultures.DESCRIPTION LIKE '%$var_search%')") :'';   
			$critaire = ' ';


			$query_secondaire=$query_principal.' '.$search.' '.$critaire.' '.$order_by.'   '.$limit;

			$query_filter = $query_principal.' '.$search.' '.$critaire;

		

		$fetch_res= $this->Model->datatable($query_secondaire);
		$data = array();
		
		$u=1;


		foreach ($fetch_res as $row) {
			

			
			$sub_array = array();
			$sub_array[]=$u++;
			
			
			$sub_array[]=$row->DESCRIPTION;
			$sub_array[]=$row->flName;
			$sub_array[]=$row->SUP.'m²';
			$sub_array[]=$row->plant;
			
			$action = '<div class="dropdown" style="color:#fff;">
	         <a class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown"><i class="fa fa-cog"></i> Options  <span class="caret"></span>
	         </a>
	         <ul class="dropdown-menu dropdown-menu-left">';

	         $action .="<li>
	         <a href='".base_url('culture/Cultures/getOne/').$row->ID_CULTURE ."'>
	         <label>&nbsp;<span class='fa fa-edit'></span>&nbsp;Modifier</label>
	         </a>
	         </li>";
	         $action .="<li>
	         <a href='#' data-toggle='modal' data-target='#mydelete".$row->ID_CULTURE."'>
	         <label class='text-danger'>&nbsp;<span class='fa fa-trash'></span>&nbsp;Supprimer</label>
	         </a>
	         </li>";


			  $action .= " </ul>
	         </div>
	         <div class='modal fade' id='mydelete".$row->ID_CULTURE."'>
	         <div class='modal-dialog'>
			 <div class='modal-content'>

	         <div class='modal-body'>
	         <center>
	         <h5><strong>Voulez-vous supprimé une Culture?</strong><br> <b style:'background-color:prink';><i style='color:green;'>" . $row->DESCRIPTION."</i></b>
	         </h5>
	         </center>
	         </div>

	         <div class='modal-footer'>
	         <a class='btn btn-danger btn-md' href='" . base_url('culture/Cultures/delete/').$row->ID_CULTURE. "'>
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
		function add($id=0)
		{


		$filieres=$this->Model->getRequete('SELECT ID_FILIERE,NOM_FILIERE FROM filières
              WHERE 1');
	    $data['filieres']=$filieres;
	    $plantation=$this->Model->getRequeteOne('SELECT * FROM plantation WHERE ID_PLANTATION='.$id);
	    $data['plantation']=$plantation;

	    
	   
		$data['title'] = "Enregistrement de la culture";
        $this->load->view('Add_Culture_View',$data);


	    }

	    function save()
	    {
	    	

	    	 
	    	 $this->form_validation->set_rules('Culture','', 'trim|required',array('required'=>'<font style="color:red;size:2px;">Le champ est Obligatoire</font>'));
	    	 $this->form_validation->set_rules('ID_FILIERE','', 'trim|required',array('required'=>'<font style="color:red;size:2px;">Le champ est Obligatoire</font>'));
	    	 $this->form_validation->set_rules('SUP','', 'trim|required',array('required'=>'<font style="color:red;size:2px;">Le champ est Obligatoire</font>'));
	    	

	    	if ($this->form_validation->run() == false) {
            # code...
            $this->add();
        }else{

             
             $data_insert=array(
                    
              	'ID_PLANTATION'=>$this->input->post('ID_PLANTATION'),
          		'DESCRIPTION'=>$this->input->post('Culture'),
          		'ID_FILIERE'=>$this->input->post('ID_FILIERE'),
          		'SUPERFICIE'=>$this->input->post('SUP'),);
                $table='cultures';


                
             	$check = $this->Model->getOne($table,$data_insert);
                
               if(!empty($check))
               {

	      		$data['message'] = '<div class="alert text-white alert-primary text-center" id="message"><h4 style="color:black">'."La Culture  existe déjà".'</h4></div>';

        		$this->session->set_flashdata($data);
   
        		
       			 $this->add();
      			}else
      			{
      			 $create=$this->Model->create($table,$data_insert);


      			 if($create)

      			 {
      			 	$data['message']='<div class="alert alert-success text-center" id="message">Enregistrement effectuée  avec succès</div>';
          			$this->session->set_flashdata($data);
          			redirect(base_url('culture/Cultures'));
      			 }else
      			 {
      			 	$message['message']='<div class="alert alert-success text-center" id="message">Enregistrement échouée</div>';
          			$this->session->set_flashdata($data);
          			$this->add();
      			 }
      			}

              
		}
	}

		//Modification de la cultures
		function getOne($id)
	    {
	    	$data['title']="Modification d'une culture";
	    	$cultures=$this->Model->getRequeteOne('SELECT `ID_CULTURE`,cultures.DESCRIPTION as Nom,filières.NOM_FILIERE as flName,filières.ID_FILIERE,SUPERFICIE as SUP FROM `cultures` JOIN plantation ON plantation.ID_PLANTATION=cultures.ID_PLANTATION JOIN filières ON filières.ID_FILIERE
              WHERE ID_CULTURE='.$id);

	    	$data['cultures']=$cultures;
	    	$filières=$this->Model->getRequete('SELECT ID_FILIERE,NOM_FILIERE FROM filières
              WHERE 1');
	    	$data['filières']=$filières;
	    	
	    	 $this->load->view('Update_Culture_View',$data);

	    }

	    public function update()
	    {
	    	

	    	$ID_CULTURE=$this->input->post('ID_CULTURE');
	    	$Culture=$this->input->post('Culture');
	    	$ID_FILIERE=$this->input->post('ID_FILIERE');
	    	$SUPERFICIE=$this->input->post('SUPERFICIE');

			$this->form_validation->set_rules('Culture','','trim|required',array('required'=>'<font style="color:red;size:2px;">Le champ est Obligatoire</font>'));

	    	$this->form_validation->set_rules('ID_FILIERE','','trim|required',array('required'=>'<font style="color:red;size:2px;">Le champ est Obligatoire</font>'));
	    	$this->form_validation->set_rules('SUPERFICIE','','trim|required',array('required'=>'<font style="color:red;size:2px;">Le champ est Obligatoire</font>'));
	    	
	    	
	    	if ($this->form_validation->run() == false) {
            # code...
            $this->getOne($ID_CULTURE);
        }else{


        
	    	$formatArrayray	= array(
	    		'DESCRIPTION'=>$this->input->post('Culture'),
	    		'SUPERFICIE'=>$this->input->post('SUPERFICIE'),
	    		'ID_FILIERE'=>$this->input->post('ID_FILIERE'),
	    			    	);

	     $this->Model->update('Cultures',array('ID_CULTURE'=>$ID_CULTURE),$formatArrayray);


	    	if($formatArrayray){

	    		$data['message']='<div class="alert alert-success text-center" id="message">'."La modification est faite avec succès".'</div>';
            // $this->session->set_flashdata($data);
             redirect(base_url('culture/Cultures/'));
	    	}else{
	    		$data['message']='<div class="alert alert-success text-center" id="message">'."Modification échouée".'</div>';
            $this->session->set_flashdata($data);
            $this->getOne($id);

	    	}
	    }
	    }

	
	    //suppression de Cultures
	    function delete($id)
	    {
	    	
	    	$table='Cultures';
	    	$criteres['ID_CULTURE']=$id;
	    	$data['rows']= $this->Model->getOne( $table,$criteres);
	    	$supr=$this->Model->delete($table,$criteres);
	    	if($supr)
	    	{
	    		$data['message']='<div class="alert alert-success text-center" id="message">Suppression effectuée  avec succès</div>';
	    		$this->session->set_flashdata($data);
	    		//echo json_encode(array('status'=>true));
	    		redirect(base_url('culture/Cultures/'));
	    	}else
	    	{
	    		$data['message']='<div class="alert alert-success text-center" id="message">Suppression échouée </div>';
	    		$this->session->set_flashdata($data);
	    		redirect(base_url('culture/Cultures/'));
	    	}


	    	
	    }

	    	//details des cultures
	   


		}
?>

