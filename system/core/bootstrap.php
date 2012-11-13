<?php
/**
 |-------------------------------------
 |	File bootstrap MVC BASE FILE		  |
 |-------------------------------------
 |	@package Core
 |	@File bootstrap.php
 |  @class bootstrap	
 |	@version 1.0
 |	@access Dont Touch This File
 |	@copyright LuosDesign.com - 2012
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

class bootstrap{
    
    public static function run(request $peticion){
        
        $modulo = $peticion->getModulo();
        $controller = $peticion->getControlador() . "Controller";
        //$rutaControlador = PATH . "system/controllers" . DS . $controller . ".php";
        
        $metodo = $peticion->getMetodo();
        $args=$peticion->getArgs();
        

        if($modulo){
            $rutaModulo = PATH . 'system/controllers' . DS . $modulo . 'Controller.php';
            
            if(is_readable($rutaModulo)){
                require_once $rutaModulo;
                $rutaControlador = PATH . 'modules'. DS . $modulo . DS . 'controllers' . DS . $controller . '.php';
            }
            else{
                
                throw new Exception('Error de base de modulo');
            }
        }
        else{
            $rutaControlador = PATH . 'system/controllers' . DS . $controller . '.php';
        }
        
        
        if( is_readable($rutaControlador) ){//si existe el archivo y es legible
            
            require_once $rutaControlador;
            
            $controller= new $controller;
            
            if(method_exists($controller,$metodo)){
                
            }else{
                controller::redirect('error/access/3030');
            }
            
            
            if( is_callable( array($controller, $metodo) ) ){
                
                $metodo = $peticion->getMetodo();
                
            }else{
                $controller = "errorController";
                $rutaControlador = PATH . "system/controllers" . DS . "errorController.php";
        
                require_once $rutaControlador;
            
                $controller= new $controller;
                              
                $metodo = "index";
                
                
            }
            
            
            
            if(isset($args) and count($args)>0){
            
                call_user_func_array(array($controller,$metodo),array($args));
                
                
            }else{
               
                call_user_func(array($controller,$metodo));
            }
            
            
        }else{
            
            //throw new Exception("No encontrado");
            
             $controller = "errorController";
             controller::redirect('error/access/3030'); 
            
        }
        
    }
    
}


?>