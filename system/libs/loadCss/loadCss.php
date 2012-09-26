<?php
/**
 * @author oscalber
 * @copyright 2012
 */
class loadCss{
   
    public function loadCssCode($file=array()){
     
     if(isset($file)){
      $fileCss=null;
      foreach($file as $key=>$value){  
      $fileCss.='<link rel="stylesheet" type="text/css" href="'.BASE_URL.WEBFILE.DS."css/".$file[$key].".css".'" media="screen" />';
       }
    return $fileCss;    
    }
      
        
     }    
      
    
    
}


?>