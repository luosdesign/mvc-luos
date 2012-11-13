<?php
/**
 |-------------------------------------
 |	File bootstrap request BASE FILE		  |
 |-------------------------------------
 |	@package core
 |	@File request.php
 |  @class request	
 |	@version 1.0
 |	@access Dont Touch This File
 |	@copyright LuosDesign.com - 2012
 |  @definition: is responsible for making the call controllers and views
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

class request{
    
    private $_modulo;
    private $_controlador;
    private $_metodo;
    private $_argumentos;
    private $_modules;
    
    public function __construct(){
        
        if( isset($_GET["url"]) ){
            $url = filter_input(INPUT_GET,"url",FILTER_SANITIZE_URL);
            $url = explode("/",$url);
            $url = array_filter($url);

            /* modulos de la app */

            $this->_modules = unserialize(MODULES_APP);
            $this->_modulo = strtolower(array_shift($url));


            if(!$this->_modulo){
                $this->_modulo = false;
            }
            else{
                if(count($this->_modules)){
                    if(!in_array($this->_modulo, $this->_modules)){
                        $this->_controlador = $this->_modulo;
                        $this->_modulo = false;
                    }
                    else{
                        $this->_controlador = strtolower(array_shift($url));
                        
                        if(!$this->_controlador){
                            $this->_controlador = 'index';
                        }
                    }
                }
                else{
                     $this->_controlador = $this->_modulo;
                     $this->_modulo = false;
                }
            }
            
            $this->_metodo = strtolower(array_shift($url));
            $this->_argumentos = $url;  

            
            /*$this->_controlador = strtolower( array_shift($url) );
            $this->_metodo = strtolower( array_shift($url) );
            $this->_argumentos = $url;*/
        
        }else{
            
            if(REDIRECT_LOAD_CONTROLLER=="1"):

                controller::redirectIndex(LOAD_CONTROLLER);
            
            else:

                $url=explode("/", LOAD_CONTROLLER);
                $url=array_filter($url);

                 if( !$this->_controlador ){
                    $this->_controlador = strtolower( array_shift($url) );
                }
                
                if( !$this->_metodo ){
                    $this->_metodo= strtolower( array_shift($url) );
                }
                
                if( !isset($this->_argumentos )){
                    $this->_argumentos=array();
                }

            endif;    

            
            
        }
        
       
       
        
    }

    public function getModulo()
    {
        return $this->_modulo;
    }
    
     /**
     | @function: getControlador
     | @access: public
     | @definition:load controllers
     |          
     **/
    public function getControlador(){
        
        return $this->_controlador;
        
    }
     /**
     | @function: getMetodo
     | @access: public
     | @definition:load metods
     |          
     **/
    public function getMetodo(){
        
        return $this->_metodo;
        
    }
    /**
     | @function: getArgs
     | @access: public
     | @definition:load arguments
     |          
     **/
    public function getArgs(){
        
        return $this->_argumentos;
        
    }
    
}

?>