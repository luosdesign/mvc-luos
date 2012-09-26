<?php
/**
 |-------------------------------------
 |	File bootstrap bd BASE FILE		  |
 |-------------------------------------
 |	@package Core
 |	@File bd.php
 |  @class bd	
 |	@version 1.0
 |	@access Dont Touch This File
 |	@copyright LuosDesign.com - 2012
 |   
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

class bd extends PDO{
    
    
     /**
     | @var SQLite
     | @access -> public
     | @example: 
     |		/opt/databases/mydb.sq3
     |		sqlite::memory: 
     | @default: /opt/databases/mydb.sq3	
     **/
  
       
    private $SQLite;
    
    public function __construct(){
     $this->SQLite = 'system/opt/databases/luosdesign.sqlite';   
     
    }
    
     /**
     | @function mysql
     | @access -> public
     | @example: 
     |		
     |		 
     | @definition: conection database mysql	
     **/
    public function mysql(){
        try {
            parent::__construct(
                "mysql:host=" . DB_HOST .
                ";dbname=" . DB_NAME,
                DB_USER, 
                DB_PASS, 
                array(
                    PDO::MYSQL_ATTR_INIT_COMMAND=>"SET NAMES " . DB_CHAR
                    ));
         }  
        catch(PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
        }    
    }
     /**
     | @function sqlite
     | @access -> public
     | @example: 
     |		
     |		 
     | @definition: conection database sqlite	
     **/
     public function sqlite(){
      try{  
            parent::__construct(
                'sqlite:'.$this->SQLite.''
            );
        }
        catch(PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
        }            
                
    }
     /**
     | @function pgsql
     | @access -> public
     | @example: 
     |		
     |		 
     | @definition: conection database pgsql	
     **/
    public function pgsql(){
        try{ 
            parent::__construct(
                'pgsql:
        	     host='.DB_TYPE.';
        	     port='.DB_PORT.';
                 dbname='.DB_NAME.';
        	     user='.DB_USER.';
        	     password='.DB_PASS.''
            
            );
       
       }
        catch(PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
        }     
        
    }
     /**
     | @function informix
     | @access -> public
     | @example: 
     |		
     |		 
     | @definition: conection database informix	
     **/
    public function informix(){
        try{
          parent::__construct( 'informix:
				              host='.DB_HOST.'; 
							  service=9800;
    						  database='.DB_NAME.'; 
							  server=ids_server; 
							  protocol=onsoctcp;
    						  EnableScrollableCursors=1', DB_USER, DB_PASS );
                              
        }
        catch(PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
        }                              
			
    }
    /**
     | @function oci
     | @access -> public
     | @example: 
     |		
     |		 
     | @definition: conection database oci	
     **/
    public function oci(){
        try{
            parent::__construct( 'oci:
    							  dbname='.DB_NAME.'; 
                                  charset=CL8MSWIN1251', DB_USER, DB_PASS  );
                                  
        }
        catch(PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
        }                                  
    }
    
    public function odbc(){
        try{
            parent::__construct( "odbc: MSSQLServer" , DB_USER , DB_PASS ); 
             
        }
        catch(PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
            exit;
        }   
        //echo var_dump ( $dbh ) ;     
        //unset ( $dbh );
    }
    
}    
    
    /**
 * private $data;
 *     
 *     public function __construct(){
 *         
 *         $this->data=array();
 *     }
 *     public static function Conectar(){
 *         
 *         $con=mysql_connect(self::SERVER_DB,self::USER_DB,self::PASS_DB);
 *         mysql_query("SET NAMES 'utf8'");
 *         mysql_select_db(self::NAME_DB);
 *         
 *         return $con;
 *     }
 *     
 *     public function runQuery( $query ){
 *         
 *         $res=mysql_query( $query,$this->Conectar() );
 *         
 *         while($reg=mysql_fetch_assoc($res)){
 *             $this->data[]=$reg;
 *         }
 *         
 *         return $this->data;
 *         
 *     }
 */


?>