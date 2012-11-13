<?php
/**
 |-------------------------------------
 |	File bootstrap model BASE FILE		  |
 |-------------------------------------
 |	@package core
 |	@File model.php
 |  @class model	
 |	@version 1.0
 |	@access Dont Touch This File
 |	@copyright LuosDesign.com - 2012
 |  @definition: is responsible for running sql queries
 |	@Author: luosdesign@gmail.com


    #=================================================================
    # Licencia:
    #   framework para el desarrollo rapido de aplicaciones
    #   Copyright (C) 2011  Luosdesign.com
    #
    #   Este programa es software libre: usted puede redistribuirlo y/o modificarlo 
    #   bajo los términos de la Licencia Pública General GNU publicada 
    #   por la Fundación para el Software Libre, ya sea la versión 3 
    #   de la Licencia, o (a su elección) cualquier versión posterior.
    #
    #   Este programa se distribuye con la esperanza de que sea útil, pero 
    #   SIN GARANTÍA ALGUNA; ni siquiera la garantía implícita 
    #   MERCANTIL o de APTITUD PARA UN PROPÓSITO DETERMINADO. 
    #   Consulte los detalles de la Licencia Pública General GNU para obtener 
    #   una información más detallada. 
    #
    #   Debería haber recibido una copia de la Licencia Pública General GNU 
    #   junto a este programa. 
    #   En caso contrario, consulte <http://www.gnu.org/licenses/>.
    # 
    # 
    #=================================================================
    # Lenguaje: PHP 5.3.9 y MySQL
    # Sistema operativo: Windows 7
    # URL: http://luosdesign.com/
    # Paradigma: PHP POO
    # Patron de diseño: MVC
    # Creado: 2012-04-09
    # Ultima modificacion: 2012-04-09 
    #=================================================================
    
    #=================================================================
    # Equipo de desarrollo / team development
    # Programacion / programming:
    # Oscar gomez - oscalber22@gmail.com
    # Guadalupe Herrera - herrerabarragan.guadalupe@gmail.com
    # Testeo / testing:
    # Oscar gomez - oscalber22@gmail.com
    # Guadalupe Herrera - lupitaastro@yahoo.com.mx 
    #=================================================================
    
    
    
    **/
class Model{
    
    protected $_db;
    protected $_typeBd;
    
    public function __construct(){
        
        $this->_db= new bd();
        $typeBd=DB_TYPE;
        $this->_db->$typeBd();
        
    }
    
     /**
     | @function: find
     | @access: public
     | @param:
     |          $table:table to selected
     |          $fields:fields to use
     |          $where:conditionals
     |          $order:sort file by field
     |          $limit:limit number of data to show
     |          
     **/
    public function find($tabla,$campos='*',$join=array(),$where=array(),$order=null,$limit=null,$security=true)
    {
        
        $sql="select ". $campos . " from ". $tabla . " ";
        
        if( !empty( $join ) ){
            
            foreach($join as $key=>$value){
                
                $sql.=$this->clean( $key ). '=' . $this->clean( $value ).' ';
                
            }
            
        }
        
        if( !empty( $where ) ){
            
            foreach( $where as $key=>$value ){
                
                if($security==true){
                    $sql.=' ' . $this->clean( $key ).$this->clean( $value ); 
                           
                 }else{
                    $sql.=' ' . ( $key ). '\''. ( $value ).'\'';
                                    
                 }                   
                                
            
            
                
            }
            
        }
        
        if( !empty( $order ) ){
            
            $sql.=' order by '. $order.' ';
            
        }
        
        if( !empty( $limit ) ){
            
            $sql.=' limit '.$limit. ' ';
        }
        
        
        
        
        $post = $this->_db->query($sql);
        
                
        return $post->fetchall();
        
        
    }
    
     
    /**
     | @function: add
     | @access: public
     | @param:
     |          $table:table to selected
     |          $values:fields to use
     |          
     |          
     |          
     |          
     **/
 
     public function add($table, $values=array(),$security=true){
        
        $sql="INSERT INTO ". $this->clean( $table ). " values(null";
        
        foreach($values as $value){
            
            if( $value != 'now()' ){
                
                if($security==true):
                
                $sql.=",'" . $this->clean($value) . "'";

                else:
                $sql.=",'" . ($value) . "'";
                
                endif;
                
                $v=array(":".$value=>$value);
            }else{
                
                if($security==true):
                
                $sql.="," . $this->clean($value) . "";
                
                
                else:
                
                $sql.="," . ($value) . "";
                print_r($sql);
                endif;
                $v=array(":".$value=>$value);
            }
        
        }
        $sql.=')';
        //INSERT INTO posts VALUES (null, :titulo, :cuerpo)
        
        $stmt = $this->_db -> prepare ( $sql, array( PDO::FETCH_ASSOC ) );
		
		 $stmt -> execute () ;
       // $this->_db->prepare(str_replace(":"," ",$sql))->execute(array($v));
                        
             
        return true;
        
     }
     
     
     
       
     /**
     | @function: delete
     | @access: public
     | @param:
     |          $table:table to selected
     |          $values:fields to use
     |          $field:default is id
     |          
     |          
     |          
     **/
 
     public function delete($table, $values=array(),$field='id'){
        
        if( !empty( $table ) and !empty( $values ) ){

        $sql = 'DELETE FROM `'.$this->clean( $table ).'` WHERE `'.$this->clean( $field ).'`='.$this->clean( $values ).';';
        

         if( $this->_db->query( $sql ) == true){
            return true;    
         }else{
            return false;
         }
                        
             
        
        }else{
            
           return false; 
            
        }
        
     }
     
      /**
     | @function: update
     | @access: public
     | @param:
     |          $table:table to selected
     |          $values:fields to use
     |          
     |          
     |          
     |          
     **/
     
      public function update( $table, $values=array(),$security=true ){
        
         if( !empty( $table ) and !empty( $values ) and is_array( $values ) ){
			
		$sql =	"UPDATE `".$this->clean( $table )."` 
				 SET";
					
		foreach( $values as $key => $value ) {
			
			if( $key != 'id' ){
				
				if( $value != 'now()' ){
					
                    if($security==true):
                    
					$sql .= ", `".$this->clean( $key )."`='".$this->clean( $value )."'" ;
                    
                    else:
                    
                    $sql .= ", `".( $key )."`='".( $value )."'" ;
                    
                    endif;
				
				}else{
					
                    if($security==true):
                    
					$sql .= ", `".$this->clean( $key )."`=".$this->clean( $value )."" ;
                    
                    else:
                    $sql .= ", `".( $key )."`=".( $value )."" ;
                    endif;
					
				}
				
			}
		}
		$sql .= " WHERE `id`=".$this->clean( $values["id"] ).';';
		
		$count = strlen('UPDATE `'.$this->clean( $table ).'` SET,       ');
	       
	    $sql = substr_replace( $sql,'UPDATE `'.$this->clean( $table ).'` SET',0, $count );
       
       //echo $sql;
                      
	  if( $this ->_db->query( $sql ) == true ){

		return true;	

	  }else{

		return false;	

	  }


	  }else {

		return false;	

	  }
     }
     
     
     /**
     | @function: clean
     | @access: public
     | @param:
     |          $val:parameter to clean, add quotes to make sure
     |          $val:Aplicar comillas sobre la variable para hacerla segura          
     |          
     |          
     |          
     |          
     **/
    
	public function clean( $val=null )
	{
	   if( !empty( $val ) ) {

          if ( get_magic_quotes_gpc() ) {
        	
        	$valor = stripslashes( $val );
          
          }
        		
        			// Colocar comillas si no es entero
          if ( !is_numeric( $val ) ) {
        	
        		$val = trim( $val ) ;
        		$val = strip_tags( $val );
        //		$value = mysql_real_escape_string( $value ) ;
          }
          
          //removing most known vulnerable words
          $codes = array( "script", "java", "applet", "iframe", "meta", "object", "html", "<", ">", ";", "'", "%" );
          $string = str_replace( $codes,"", $val );
          
          
          return $val;
          
          }else{
        	return 'null';  
          }
	}
    
     /**
     | @function: sarch
     | @access: public
     | @param:
     |          $table:name table
     |          $fields:files to selected          
     |          $join:join use
     |          $join:union to use
     |          $where:where to use
     |          $order:order to use
     |          $limit:limit to use
     |          
     **/
    
    public function search($table,$fields='*',$join=array(),$where=array(),$order=null,$limit=null)
    {
        
        $sql="select ". $fields . " from ". $table . " ";
        
        if( !empty( $join ) ){
            
            foreach($join as $key=>$value){
                
                $sql.=$this->clean( $key ). '=' . $this->clean( $value ).' ';
                
            }
            
        }
        
        if( !empty( $where ) ){
            
            foreach( $where as $key=>$value ){
            $sql.=' ' . $this->clean( $key ).''.$this->clean( $value ).'';
                
            }
            
        }
        
        if( !empty( $order ) ){
            
            $sql.=' order by '. $order.' ';
            
        }
        
        if( !empty( $limit ) ){
            
            $sql.=' limit '.$limit. ' ';
        }
        
        
        
        $post = $this->_db->query($sql);
        
        return $post->fetchall();
        
        
    }
    
    /**
     | @function: counterVisit
     | @access: public
     | @definition:counter visit by database
     |          
     |                    
     |          
     |          
     |          
     |          
     |          
     |          
     **/
    
    public function  counterVisit(){
        //se requiere el archivo para validar los datos de usuario de bdd para conectar   
    	
    	$ip = $_SERVER['REMOTE_ADDR'];   
    	$fecha = date("j \d\e\l n \d\e Y");   
    	$hora = date("h:i:s");   
    	$horaun = date("h"); 
    	$minuto=date("i");  
    	$diaun = date("z");   
    	$anioun = date("Y"); 
    	$mes=date("n"); 
    	$segundos = time(); 
    	$can = "3600"; 
    	$resta = $segundos-$can;  
    	//se asignan la variables
        $sql=$this->find('counter_visit','segundos, ip',array(),array('WHERE segundos >='=>$resta,' AND IP LIKE '=> $ip));
        //$sql = "SELECT segundos, ip "; 
        //$sql.= "FROM ld_contador WHERE segundos >= $resta AND IP LIKE '$ip' "; 
        //$es = mysql_query($sql, Conectar::con()) or die("Error al leer base de datos: ".mysql_error); 
    //se buscan los registros que num de seg mayor a num de seg hace una hora e IP 
    	if(count($sql)>0)   
    	{//no se cuenta la visita
    	  
    	}   
    	else   
    	{   
    	   $datos=array("ip"=>$ip,"hora"=>$hora,"fecha"=>$fecha,"mes"=>$mes,"horaun"=>$horaun,"minuto"=>$minuto,"diaun"=>$diaun,"anioun"=>$anioun,"segundos"=>$segundos);
            $this->add('counter_visit',$datos);
    		//$sql = "INSERT INTO ld_contador (id, ip, fecha, hora, horaun, diaun, anioun,minuto,mes,segundos) ";   
    	//	$sql.= "VALUES ('','$ip','$fecha','$hora','$horaun','$diaun','$anioun','$minuto','$mes','$segundos')";   
    	//$es = mysql_query($sql,Conectar::con()) or die("Error al grabar un mensaje: ".mysql_error);   
    	}   
   }

    
}

?>