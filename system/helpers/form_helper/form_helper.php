<?php
/**
 |-------------------------------------
 |	File facebook BASE FILE		  |
 |-------------------------------------
 |	@package helper
 |	@File form_helper.php
 |  @class form_helper	
 |	@version 1.0
 |	@access Dont Touch This File
 |	@copyright LuosDesign.com - 2012
 |  @definition: makes use of session variables in MVC
 **/

class form_helper{
    
    /**
     | @function: form_open
     | @access: public
     | @definition:create form tag and its attributes 
     |          
     **/
    public function form_open( $param=array() ){
        $form='<form ';
        
        foreach( $param as $key=>$value ){
            
            $form.=$key . "= '" . $value . "' ";
        }
        $form.=" >";
        
        return $form;
    }
    
    /**
     | @function: form_input
     | @access: public
     | @definition:create form input tag and its attributes 
     |          
     **/
    public function form_input($input=array()){
        $form='<input ';
        
       if(!empty( $input )): 
            foreach($input as $key=>$value){
              $form.=$key . "= '" . $value . "' ";  
            }
       endif; 
        $form.=' >'; 
        
        return $form;       
    }
    
    
    
    /**
     | @function: form_textarea
     | @access: public
     | @definition:create form form_textarea and its attributes 
     |          
     **/
    public function form_textarea($data=null,$attr=array()){
        $form='<textarea ';
        
        if(!empty( $attr )):
        
            foreach( $attr as $key=>$value ){
                $form.= $key . "= '" . $value ."' ";
            }
        endif;
        $form.=' >';
        
        $form.=$data;
        
        $form.='</textarea>';
        
        return $form;
    }
    
    /**
     | @function: form_select
     | @access: public
     | @definition:create form form_select and its attributes 
     |          
     **/
    public function form_select($attr=array(),$options=array(),$attrOption=array()){
        $form='<select ';
        
        if( !empty( $attr ) ):
        
            foreach( $attr as $key=>$value ){
                
                $form.= $key . "= '" . $value . "' ";
            }
        
        endif; 
          
            
        $form.=" >";
        
        if( !empty( $options ) ):
        
            foreach($options as $key=>$value_2){
                $form.="<option ";
                    foreach($value_2 as $key_2=>$value_3){
                      $form.=$key_2 . "= '" . $value_3 . "' ";  
                    }    
                $form.=" >";
                $form.=$value_2["value"];
                $form.="</option>";
            }
        
        endif;
        
        $form.='</select>';
        
        return $form;
    }
    
    
    
    /**
     | @function: form_close
     | @access: public
     | @definition:create form close tag and its attributes 
     |          
     **/
    public function form_close(){
        $form='</form>';
        
        return $form;
    }
}

?>