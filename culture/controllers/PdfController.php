<?php
/**
 * auteur:Douce
 date:le 01/03/2023
 */
class PdfController extends CI_Controller  
{
   function index()
    {
        $data['karangamuntu']= $this->Model->getRequeteOne('SELECT  syst_provinces.PROVINCE_NAME , `IZINA`, syst_communes.COMMUNE_NAME,syst_zones.ZONE_NAME,`AMATAZIRANO`, `SE`, `NYINA`, `ITARIKI`, `ZONE_NAME`PROVINCE_ID,`AKAZI_AKORA`, `PHOTO`, `IGIKUMU` FROM `karangamuntu` LEFT JOIN syst_zones on syst_zones.ZONE_ID=karangamuntu.ZONE_ID LEFT JOIN  syst_communes on syst_communes.COMMUNE_ID=syst_zones.COMMUNE_ID LEFT JOIN syst_provinces on syst_provinces.PROVINCE_ID=syst_communes.PROVINCE_ID WHERE INDANGAMUNTU_ID=1');

        // $data['ahoyabaye']= $this->Model->getRequeteOne('SELECT PROVINCE_NAME,COMMUNE_NAME ,syst_zones.ZONE_NAME, `ITARIKI`  FROM `ahoyabaye`  LEFT JOIN syst_zones ON syst_zones.ZONE_ID=ahoyabaye.ZONE_ID LEFT JOIN syst_communes on syst_communes.COMMUNE_ID=syst_zones.COMMUNE_ID LEFT JOIN syst_provinces ON syst_communes.PROVINCE_ID=syst_provinces.PROVINCE_ID WHERE INDANGAMUNTU_ID=1');

           // print_r($data);die();
        $this->load->library('Pdff');
        $html = $this->load->view('Pdf_View', $data, true);
        $this->pdff->createPDF($html, 'mypdf', false);
    }

}
?>