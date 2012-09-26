<?php
/**
 |-------------------------------------
 |	File facebook BASE FILE		  |
 |-------------------------------------
 |	@package helper
 |	@File html_helper.php
 |  @class html_helper	
 |	@version 1.0
 |	@access Dont Touch This File
 |	@copyright LuosDesign.com - 2012
 |  @definition: use helper html
 **/

class html_helper{
    
    /**
     | @function: open_tag
     | @access: public
     | @definition:create open tag and its attributes 
     |          
     **/
    public function open_tag($tag=array(),$attr=array()){
        $tag="<".$tag." ";
        
        if(!empty($attr)){
        
            foreach($attr as $key=>$value){
                
                $tag.= $key . "= '" . $value . "' ";
            }
            
        }
        
        $tag.=" >";
        return $tag;
    }
    
    /**
     | @function: content_tag
     | @access: public
     | @definition:create content_tag tag and its attributes 
     |          
     **/
    public function content_table($attr=array()){
        $tag="<tr ";
            
            foreach($attr as $key=>$value){
                $tag.=$key . "= '" . $value . "' ";
            }
        
        $tag.=" >";
        
        return $tag;
    }
    
    /**
     | @function: close_tag
     | @access: public
     | @definition:create close tag and its attributes 
     |          
     **/
    public function close_tag($tag=array()){
        $tag="</".$tag.">";
        
        
        return $tag;
    }
}

?>