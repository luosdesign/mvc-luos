<?php
/**
 * @author oscalber
 * @copyright 2012
 */
class loadFile{
    
    public function loadFileInt($file=array()){
        
        if(isset($file)){
            foreach($file as $key=>$value){
                include  "views" . DS . "layout" . DS . DEFAULT_LAYOUT . DS .$value;
                
                //require_once(BASE_URL . "views" . DS . "layout" . DS . DEFAULT_LAYOUT . DS .$value);
            }
        }
        
    }
}


?>