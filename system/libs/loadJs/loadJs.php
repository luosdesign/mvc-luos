<?php
/**
 * @author oscalber
 * @copyright 2012
 */
class loadJs{
   
    public function loadJsCode($code=array()){
       $js=array();     
      foreach($code as $key=>$value){  
      $js='<script type="text/javascript">'.$value.'</script>';
       }
    return $js;    
    }
    
    public function loadFileJs($file=array()){
        if(isset($file)){
          $fileJs=null;
          foreach($file as $key=>$value){  
          $fileJs.='<script type="text/javascript" src="'.BASE_URL.WEBFILE.DS."js/".$file[$key].".js".'" media="screen"></script>';
           }
        return $fileJs;    
        } 
    }
    
    public function loadFileWebFile($file=array()){
        if(isset($file)){
          $fileJs=null;
          foreach($file as $key=>$value){  
          $fileJs.='<script type="text/javascript" src="'.BASE_URL.WEBFILE.DS.$file[$key].".js".'" media="screen"></script>';
           }
        return $fileJs;    
        } 
    }
    
}


?>