<?php
 /**
  * auteur:Douce
  date:23/02/2023
  */

  class Cart extends CI_Controller
  {  

  	function __construct()
	 {
	 		# code...
	 	parent::__construct();
	 }
  	function index(){

        $this->load->view('Cart_View');
  	}

  function listing()
    {

      $query_principal="SELECT ID_MAGASINIER, concat (NOM, ' ', PRENOM) AS NOM FROM magasinier";

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

      $order_column=array( 'ID_MAGASINIER','NOM');
      $order_by = isset($_POST['order']) ? ' ORDER BY ' . $order_column[$_POST['order']['0']['column']] . '  ' . $_POST['order']['0']['dir'] : ' ORDER BY NOM_CLIENT ASC';


      $search = !empty($_POST['search']['value']) ?  (" AND (magasinier.NOM LIKE '%$var_search%')") :'';   
      $critaire = ' ';


      $query_secondaire=$query_principal.' '.$search.' '.$critaire.' '.$order_by.'   '.$limit;

      $query_filter = $query_principal.' '.$search.' '.$critaire;



      $fetch_res= $this->Model->datatable($query_secondaire);
      $data = array();

      $u=1;

      foreach ($fetch_res as $row) {
      
        $nombre= $this->Model->getRequete('SELECT DESCR_FONCTION, fonction_magasinier.ID_FONCTION FROM `fonction_magasinier` JOIN fonction ON fonction.ID_FONCTION=fonction_magasinier.ID_FONCTION 
    WHERE ID_MAGASINIER='.$row->ID_MAGASINIER.'');       

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

    function insert(){

      $data['error']='';
      $this->cart->destroy();
      $data['magasinier']=$this->Model->getRequete('SELECT ID_MAGASINIER,  `NOM`, `PRENOM` FROM `magasinier` ');
      $data['fonction']=$this->Model->getRequete('SELECT ID_FONCTION,  `DESCR_FONCTION` FROM `fonction`  ');

      $this->load->view('Add_Cart_View',$data);
 }

//fonction d'ajouter dans le panier
public function add_in_cart(){
   $ID_FONCTION = $this->input->post('ID_FONCTION');
   $file_data=array('id'=>$ID_FONCTION,'ID_FONCTION'=>$ID_FONCTION,'qty'=>1,'price'=>1,'name'=>'T','typecartitem'=>'FILE' );    
   $this->cart->insert($file_data);
   $html="";
   $j=1;
   $i=0;
   $html.='
   <table class="table">
   <thead class="table-dark">
   <tr>
   <th>#</th>
   <th>Fonction</th>
   <th>Action</th>
   </tr>
   </thead>
   <tbody>';

   foreach ($this->cart->contents() as $item):
      if (preg_match('/FILE/',$item['typecartitem'])) 
      {

       $info=$this->Model->getOne('fonction',array('ID_FONCTION'=>$item['ID_FONCTION']));
       $html.='
       <tr>
       <td>'.$j.'</td>
       <td>'.$info['DESCR_FONCTION'].'</td>
       <td style="width: 5px;">
       <input type="hidden" id="rowid'.$j.'" value='.$item['rowid'].'>
       <button  class="btn btn-danger btn-xs" type="button" onclick="remove_cart('.$j.')">
       Supprimer
       </button>
       </tr>';
    }

    $j++;
    $i++;
 endforeach;
 $html.=' 
 </tbody>
 </table>
 ';

 if ($i>0) {

   echo $html;
}
}
public function insertionADD(){
   $table='fonction_magasinier';
   $DEV= $this->input->post('magasinier');
   foreach ($this->cart->contents() as $key)

    //print_r($key); die();
   {

      $this->Model->create('fonction_magasinier',array('ID_FONCTION'=>$key['ID_FONCTION'],'ID_MAGASINIER'=>$DEV));

   }

   $data['message'] = '<div class="alert alert-success text-center" id="message">' . "Vous avez ajoute avec succès" . '</div>';
   $this->session->set_flashdata($data);

   $this->cart->destroy();
   redirect('culture/Cart');
}
function remove_cart_interne()
  {
    $ID_MAGASINIER=$this->input->post('ID_MAGASINIER');
     //print_r($this->cart->contents());die();

    $this->cart->remove($ID_MAGASINIER);      

    $html="";
    $j=1;
    $i=0;
    $html.='
    <table class="table">
    <thead class="table-dark">
   <tr>
       <th>#</th>
       <th>Fonction</th>
       <th>Action</th>
   </tr>
    </thead>
    <tbody>';

    foreach ($this->cart->contents() as $item):
      if (preg_match('/FILECI/',$item['typecartitem'])) {

        $html.='<tr>
       
       <td>'.$j.'</td>
       <td>'.$info['DESCR_FONCTION'].'</td>
        <td style="width: 5px;">
        <input type="hidden" id="ID_FONCTION_MAGASINIER'.$j.'" value='.$item['ID_FONCTION_MAGASINIER'].'>
        <button  class="btn btn-danger btn-xs" type="button" onclick="remove_cart_interne('.$j.')">
        x
        </button>
        </tr>' ;
      }


      $j++;
      $i++;
    endforeach;

    $html.=' </tbody>
    </table>

    ';

    if ($i>0) {
      # code...
      echo $html;
    }

  }



public function editing($ID)
 {

  $data['fonction']=$this->Model->getRequeteOne('SELECT fonction.ID_FONCTION, fonction.DESCR_FONCTION  FROM fonction_magasinier LEFT JOIN fonction on fonction.ID_FONCTION=fonction_magasinier.ID_FONCTION order BY ID_FONCTION ASC');
$data['magasinier']=$this->Model->getRequeteOne("SELECT  concat(NOM,'',PRENOM) AS NOM FROM fonction_magasinier LEFT JOIN magasinier on magasinier.ID_MAGASINIER=fonction_magasinier.ID_MAGASINIER ");

 // $data['magasinier']=$this->Model->getOne('magasinier',array('ID_MAGASINIER'=>$ID));

    // $data['id_dev']=$ID;
  
  $this->load->view('Update_Cart_View',$data);
  $this->cart->destroy();
 }
  function remove_cart()
{
 $rowid=$this->input->post('rowid');

 $this->cart->remove($rowid);      
 $html="";
 $j=1;
 $i=0;
 $html.='
 <table class="table">
 <thead>
 <tr>
 <th>#</th>
 <th>Fonction</th>
 <th>Action</th>
 </tr>
 </thead>
 <tbody>';

 foreach ($this->cart->contents() as $item):
  if (preg_match('/FILE/',$item['typecartitem'])) {
   $info=$this->Model->getOne('fonction',array('ID_FONCTION'=>$item['ID_FONCTION']));
   $html.='<tr>
   <td>'.$j.'</td>
   <td>'.$info['DESCR_FONCTION'].'</td>
   <td style="width: 5px;">
   <input type="hidden" id="rowid'.$j.'" value='.$item['rowid'].'>
   <button  class="btn btn-danger btn-xs" type="button" onclick="remove_cart('.$j.')">
   Supprimer
   </button>
   </tr>' ;
}


$j++;
$i++;
endforeach;

$html.=' </tbody>
</table>';

if ($i>0) {

  echo $html;
}
}

  


  }
?>