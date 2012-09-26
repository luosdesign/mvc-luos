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
    #   bajo los t�rminos de la Licencia P�blica General GNU publicada 
    #   por la Fundaci�n para el Software Libre, ya sea la versi�n 3 
    #   de la Licencia, o (a su elecci�n) cualquier versi�n posterior.
    #
    #   Este programa se distribuye con la esperanza de que sea �til, pero 
    #   SIN GARANT�A ALGUNA; ni siquiera la garant�a impl�cita 
    #   MERCANTIL o de APTITUD PARA UN PROP�SITO DETERMINADO. 
    #   Consulte los detalles de la Licencia P�blica General GNU para obtener 
    #   una informaci�n m�s detallada. 
    #
    #   Deber�a haber recibido una copia de la Licencia P�blica General GNU 
    #   junto a este programa. 
    #   En caso contrario, consulte <http://www.gnu.org/licenses/>.
    # 
    # 
    #=================================================================
    # Lenguaje: PHP 5.3.9 y MySQL
    # Sistema operativo: Windows 7
    # URL: http://luosdesign.com/
    # Paradigma: PHP POO
    # Patron de dise�o: MVC
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
    
    private $_controlador;
    private $_metodo;
    private $_argumentos;
    
    public function __construct(){
        
        if( isset($_GET["url"]) ){
            $url = filter_input(INPUT_GET,"url",FILTER_SANITIZE_URL);
            $url = explode("/",$url);
            $url = array_filter($url);
            
            $this->_controlador = strtolower( array_shift($url) );
            $this->_metodo = strtolower( array_shift($url) );
            $this->_argumentos = $url;
        
        }else{
            
            controller::redirectIndex(LOAD_CONTROLLER);
            
        }
        
       
        if( !$this->_controlador ){
            $this->_controlador = DEFAULT_CONTROLLER;
        }
        
        if( !$this->_metodo ){
            $this->_metodo= "index";
        }
        
        if( !isset($this->_argumentos )){
            $this->_argumentos=array();
        }
        
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