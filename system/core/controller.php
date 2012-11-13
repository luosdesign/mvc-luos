<?php
/**
 |-------------------------------------
 |	File controller MVC BASE FILE		  |
 |-------------------------------------
 |	@package Core
 |	@File controller.php
 |  @class controller	
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

abstract class controller{//abstract para que no pueda ser instanciada
    
    protected $_view;
    protected $_request;
    
    public function __construct(){
        
        $this->_request = new Request();
        $this->_view = new View($this->_request);
        
    }
    abstract public function index();
    /**
     | @function: loadModel
     | @access: protected
     | @param:
     |          $model:model to load
     |          
     |          
     **/
    protected function loadModel($modelo, $modulo = false){
        

        $modelo = $modelo . 'Model';
        $rutaModelo = PATH . 'system/models' . DS . $modelo . '.php';
        
        if(!$modulo){
            $modulo = $this->_request->getModulo();
        }
        
        if($modulo){
           if($modulo != 'default'){
               $rutaModelo = PATH . 'modules' . DS . $modulo . DS . 'models' . DS . $modelo . '.php';
           } 
        }
        
        if(is_readable($rutaModelo)){
            require_once $rutaModelo;
            $modelo = new $modelo;
            return $modelo;
        }
        else {
            echo $rutaModelo;
            //throw new Exception('Error de modelo');
             $this->redirect('error/access/1010');
        }


        
        
    }
    /**
     | @function: getLibrary
     | @access: protected
     | @param:
     |          $libreria:lribrary to load
     |          
     |          
     **/
    protected function getLibrary($libreria=array()){
        
        
        if( !empty($libreria) ){
            foreach($libreria as $lib){
                $rutaLibreria=PATH . "system/libs" . DS .$lib . DS . $lib . ".php";
                if(is_readable($rutaLibreria)){
                    
                    
                    require_once $rutaLibreria;
                    
                    $nameLibrary=($lib);//lcfirst($lib);
                    
                    $this->_view->$nameLibrary=new $lib;
                    
                }else{
                    
                    throw new Exception("Error de libreria");
                    
                }
            }
        }
    }
    
    
    /**
     | @function: getLibrary
     | @access: protected
     | @param:
     |          $libreria:lribrary to load
     |          
     |          
     **/
    protected function getHelper($helper=array()){
        
        
        if( !empty($helper) ){
            foreach($helper as $help){
                $rutaLibreria=PATH . "system/helpers" . DS .$help . DS . $help . ".php";
                
                if(is_readable($rutaLibreria)){
                    
                    
                    require_once $rutaLibreria;
                    
                    $nameLibrary=($help);//lcfirst($help);
                    
                    $this->_view->$nameLibrary=new $help;
                    
                }else{
                    
                    throw new Exception("Error de helper");
                    
                }
            }
        }
    }
    
     /**
     | @function: getText
     | @access: protected
     | @param:
     |          $clave:strip to text
     |          
     |          
     **/
    protected function getText($clave){
        
        if( isset($_POST[$clave]) && !empty($_POST[$clave]) ){
            
            $_POST[$clave]=htmlspecialchars($_POST[$clave],ENT_QUOTES);
            
            return $_POST[$clave];
            
        }
        
        return '';
        
    }
    
    /**
     | @function: getText
     | @access: protected
     | @param:
     |          $clave:strip to text
     |          
     |          
     **/
    protected function validEmpty($clave){
        
        if( isset($_POST[$clave]) && !empty($_POST[$clave]) ){
            
            $_POST[$clave]=htmlspecialchars($_POST[$clave],ENT_QUOTES);
            
            return true;
            
        }
        
        return false;
        
    }
    
     /**
     | @function: getInt
     | @access: protected
     | @param:
     |          $clave:strip to int
     |          
     |          
     **/
    protected function getInt($clave){
        
        if( isset($_POST[$clave]) && !empty($_POST[$clave]) ){
            
            $_POST[$clave]=filter_input(INPUT_POST, $clave, FILTER_VALIDATE_INT);
            
            return $_POST[$clave];
            
        }
        
        return 0;
        
        
    }
    /**
     | @function: redirect
     | @access: protected
     | @param:
     |          $ruta:$route to redirect, route contoller/metod
     |          
     |          
     **/
    public function redirect($route=false){
        if($route){
            header("Location: ". BASE_URL . $route . '.html');
            exit();
        }else{
            header("Location: ". BASE_URL);
            exit(); 
        }
        
    }

    /**
     | @function: redirect
     | @access: protected
     | @param:
     |          $ruta:$route to redirect, route contoller/metod
     |          
     |          
     **/
    public function redirectSin($route=false){
        if($route){
            header("Location: ". BASE_URL . $route );
            exit();
        }else{
            header("Location: ". BASE_URL);
            exit(); 
        }
        
    }
    
    /**
     | @function: redirectComplete
     | @access: protected
     | @param:
     |          $route:route to redirect, route complete
     |          
     |          
     **/
    protected function redirectComplete($route=false){
        
        if($route){
            header("Location: ". $route);
            exit;
        }else{
            header("Location: ". BASE_URL);
            exit;
        }
        
    }
     /**
     | @function: redirectIndex
     | @access: protected
     | @param:
     |          $route:route to redirect, route complete
     |          
     |          
     **/
    public static function redirectIndex($route=false){
        
        if($route){
            Header("HTTP/1.1 301 Moved Permanently");
            header("Location: ". BASE_URL . $route . '.html');
            exit;
        }else{
            header("Location: ". BASE_URL);
            exit;
        }
        
    }
    /**
     | @function: redirectError
     | @access: protected
     | @param:
     |          $route:route to redirect when no error
     |          $error:number error. example: 303,301,404
     |          
     **/
    public static function redirectError($route=false,$error){
        
        if($route){
            header("HTTP/1.1 ".$error." Moved Permanently");
            header("Location: ". BASE_URL . $route . '.html');
            exit;
        }else{
            header("Location: ". BASE_URL);
            exit;
        }
        
    }
    
    /**
     | @function: redirectTimer
     | @access: protected
     | @param:
     |          $router:redict url
     |          $time:time
     |          
     **/
    
    public static function redirectTimer($router=false,$time){
       
       if($router){
       
        header('refresh '.$time.'; url='.$router.'');
        exit;
       } 
    }
    
    /**
     | @function: compara_fechas
     | @access: protected
     | @param:
     |          $fecha1:date1 
     |          $fecha2:date2
     |          
     **/
    
    public static function compara_fechas($fecha1,$fecha2)
    {
    if (preg_match("/[0-9]{1,2}\/[0-9]{1,2}\/([0-9][0-9]){1,2}/",$fecha1))
    list($dia1,$mes1,$año1)=split("/",$fecha1);
    if (preg_match("/[0-9]{1,2}-[0-9]{1,2}-([0-9][0-9]){1,2}/",$fecha1))
    list($dia1,$mes1,$año1)=split("-",$fecha1);
    if (preg_match("/[0-9]{1,2}\/[0-9]{1,2}\/([0-9][0-9]){1,2}/",$fecha2))
    list($dia2,$mes2,$año2)=split("/",$fecha2);
    if (preg_match("/[0-9]{1,2}-[0-9]{1,2}-([0-9][0-9]){1,2}/",$fecha2))
    list($dia2,$mes2,$año2)=split("-",$fecha2);
    $dif = mktime(0,0,0,$mes1,$dia1, $año1) - mktime(0,0,0, $mes2,$dia2,$año2);
    return ($dif);
    }
    
    
    /**
     | @function: filtrarInt
     | @access: protected
     | @param:
     |          $int:filter integer
     |          
     |          
     **/
    protected function filtrarInt($int){
        
        $int=(int) $int;
        
        if(is_int($int)){
            return $int;
        }else{
            return 0;
        }
        
    }
    /**
     | @function: getPostParam
     | @access: protected
     | @param:
     |          $clave:passing parameters
     |          
     |          
     **/
    protected function getPostParam($clave){
        
        if( isset($_POST[$clave]) ){
            
            return $_POST[$clave];
        }
        
    }
     /**
     | @function: flashMessage
     | @access: protected
     | @param:
     |          $message:message to show
     |          $link:link to redirect
     | @definition:show  alert jquery ui         
     **/
    protected function flashMessage($message,$link=null){
        
        $script="<script type='text/javascript'>$(document).ready(function(){ $('#message').dialog('open');$('#message p').html('<font color=\"green\">".$message."</font>'); ";
       
        $script.="});</script>";
        
        return $script;
    }
     /**
     | @function: JsMessage
     | @access: protected
     | @param:
     |          $message:message to show
     |          $enlace:link to redirect
     | @definition:show js alert         
     **/
    protected function JsMessage($message,$link=null){
        
        $script="<script type='text/javascript'>alert('".$message."');";
        if(isset($link)):
        $script.="window.location='".$link."';";
        endif;
        $script.="</script>";
        echo  $script;
    }
     /**
     | @function: getAlphaNumeric
     | @access: protected
     | @param:
     |          $value:value to verify
     |          
     | @definition:validate content AlphaNumeric         
     **/
    protected function getAlphaNumeric($value){ 
            //ereg("^[a-zA-Z0-9\-_]{3,20}$", $value
            //preg_match('/'.$patron.'/', $cadena_texto);
            $patron="^[a-zA-Z0-9\-_]{3,20}$";
       if (preg_match('/'.$patron.'/', $value)) { 
          //echo "El nombre de usuario $nombre_usuario es correcto<br>"; 
          return true; 
       } else { 
           //echo "El nombre de usuario $nombre_usuario no es válido<br>"; 
          return false; 
       } 
    } 
    /**
     | @function: loadJsOnly
     | @access: protected
     | @param:
     |          $file:file to load
     |          
     | @definition:load file js         
     **/
    protected function loadJsOnly($file=array()){
        
        if(!empty($file)){
           foreach($file as $key=>$value){
                $scriptFile.="<script type='text/javascript' src='".BASE_URL.WEBFILE.DS."js/".$file.".js"."'></script><br />";
                
           } 
        }
        
        return $scriptFile;
    }
     /**
     | @function: loadCssOnly
     | @access: protected
     | @param:
     |          $file:file to load
     |          
     | @definition:load file css         
     **/
     protected function loadCssOnly($file=array()){
        
        if(!empty($file)){
           foreach($file as $key=>$value){
                $file.='<link rel="stylesheet" type="text/css" href="'.BASE_URL.WEBFILE.DS."js/".$value.".css".'" media="screen" />';
                
           } 
        }
        
        return $file;
    }
}