<?php
/**
 |-------------------------------------
 |	File facebook BASE FILE		  |
 |-------------------------------------
 |	@package helper
 |	@File valid_form_helper.php
 |  @class valid_form_helper	
 |	@version 1.0
 |	@access Dont Touch This File
 |	@copyright LuosDesign.com - 2012
 |  @definition: use valid form helper
 **/
class valid_form{
    
    public function validate($value,$rules=array()){
        
        if(!empty($rules)):
            
            $cont=0;
            foreach($rules as $key=>$values){
                
                    
                    if($this->$key($value,$values[0])==false){
                        
                    return true;    
                        
                        
                    }    
                
                
              $cont=$cont+1;  
            }
        
        endif;
        
    }
    
    public function mandatory($value){
        $value=str_replace(" ", "" , $value);
        if(empty($value) or $value=="0" or $value==" "){
            return false;
        }else{
            return true;
        }
        
    }
    
    public function min_length($value,$min){
        
        if(strlen($value)>=$min):
        
            return true;
          
        else:
        
            return false;
        
        endif;
        
    }
    
    public function max_length($value,$max){
        
        if(strlen($value)<=$max):
        
            return true;
        
        else:
            
            return false;
        
        endif;
        
    }
    
    public function like_length($value,$max){
        
        if(strlen($value)==$max):
        
            return true;
        
        else:
            
            return false;
        
        endif;
        
    }
    public function compare($val1,$val2){
        
        if($val1==$val2){
            return true;
        }else{
            return false;
        }
        
    }
    public function is_numeric($value){
      
      if(!empty($value)):
        
        if (is_numeric($value)):

        return true;
        
        else:
        
        return false;
        
        endif;
      
      else:
      
      return true;
     
      endif;  
    }
    
    public function is_email($email){
        $mail_correcto = 0; 
        //compruebo unas cosas primero
        if ((strlen($email) >= 6) && (substr_count($email,"@") == 1) && (substr($email,0,1) != "@") && (substr($email,strlen($email)-1,1) != "@")){ 
           if ((!strstr($email,"'")) && (!strstr($email,"\"")) && (!strstr($email,"\\")) && (!strstr($email,"\$")) && (!strstr($email," "))) { 
              //miro si tiene caracter . 
              if (substr_count($email,".")>= 1){ 
                 //obtengo la terminacion del dominio 
                 $term_dom = substr(strrchr ($email, '.'),1); 
                 //compruebo que la terminación del dominio sea correcta 
                 if (strlen($term_dom)>1 && strlen($term_dom)<5 && (!strstr($term_dom,"@")) ){ 
                    //compruebo que lo de antes del dominio sea correcto 
                    $antes_dom = substr($email,0,strlen($email) - strlen($term_dom) - 1); 
                    $caracter_ult = substr($antes_dom,strlen($antes_dom)-1,1); 
                    if ($caracter_ult != "@" && $caracter_ult != "."){ 
                       $mail_correcto = 1; 
                    } 
                 } 
              } 
           } 
        } 
        return $mail_correcto; 
    }
}
?>