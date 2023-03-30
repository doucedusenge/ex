<?php
 /**
  * auteur:Douce
  date:23/02/2023
  */

  class Exercice extends CI_Controller
  {  

    function __construct()
   {
      # code...
    parent::__construct();
   }
    function index(){
      $this->load->view('Exercice_View');
    }

  function listing()
    {
    $query_principal="";
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

      $order_column=array( 'NOM');
      $order_by = isset($_POST['order']) ? ' ORDER BY ' . $order_column[$_POST['order']['0']['column']] . '  ' . $_POST['order']['0']['dir'] : ' ORDER BY NOM_CLIENT ASC';


      $search = !empty($_POST['search']['value']) ?  (" AND (magasinier.NOM LIKE '%$var_search%')") :'';   
      $critaire = ' ';
      $query_secondaire=$query_principal.' '.$search.' '.$critaire.' '.$order_by.'   '.$limit;

      $query_filter = $query_principal.' '.$search.' '.$critaire;



      $fetch_res= $this->Model->datatable($query_secondaire);
      $data = array();

      $u=1;

      foreach ($fetch_res as $row) {
      
       $nombre= $this->Model->getRequete('SELECT fonction.DESCR_FONCTION, fonction_magasinier.ID_FONCTION ,magasinier.ID_MAGASINIER   FROM `fonction_magasinier` LEFT JOIN fonction ON fonction.ID_FONCTION=fonction_magasinier.ID_FONCTION JOIN  magasinier on magasinier.ID_MAGASINIER=fonction_magasinier.ID_MAGASINIER
          WHERE magasinier.ID_MAGASINIER=2='.$row->ID_MAGASINIER.'');
       

        $sub_array = array();
        $sub_array[]=$u++;
        $sub_array[]=$row->NOM;
      

       $sub_array[]="<center><a href='javascript:;'  class='btn btn-secondary btn-md' onclick='get_produit(".$row->ID_MAGASINIER.")'>" .count($nombre) . "</a></center>";

     $action = '<div class="dropdown" style="color:#fff;">
        <a class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown"><i class="fa fa-cog"></i> Options  <span class="caret"></span>
        </a>
        <ul class="dropdown-menu dropdown-menu-left">';

        $action .="<li>
              <a href='".base_url('culture/Cart/editing/').$row->ID_MAGASINIER ."'>
        <label>&nbsp;<span class='fa fa-edit'></span>&nbsp;Modifier</label>
        </a>
        </li>";
        $action .="<li>
        <a href='#' data-toggle='modal' data-target='#mydelete".$row->ID_MAGASINIER."'>
        <label class='text-danger'>&nbsp;<span class='fa fa-trash'></span>&nbsp;Supprimer</label>
        </a>
        </li>";


        $action .= " </ul>
        </div>
        <div class='modal fade' id='mydelete".$row->ID_MAGASINIER."'>
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
        <a class='btn btn-danger btn-md' href='" . base_url('culture/Alimentation/delete/').$row->ID_MAGASINIER. "'>
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
    function add(){

        $this->load->view('Add_Exercice_View');
    }

    }
?>