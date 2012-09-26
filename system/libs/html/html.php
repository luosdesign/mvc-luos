<?php
/**
 * @author oscalber
 * @copyright 2012
 */
class html{
    
    public function loadFile($file=null){
        
       if( !empty( $file ) and is_file( "http://localhost:8080/luosdesign/webfile/redes.php" ) ){
		      
    		require_once("http://localhost:8080/luosdesign/webfile/redes.php");
            //require BASE_URL . WEBFILE . DS . $file;
    			  		
    	}else{
    		return "no econtrado";	
    	}
    		
       
        
    }
    
}


?>