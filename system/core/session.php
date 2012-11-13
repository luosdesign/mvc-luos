<?php
session_start();
/**
 |-------------------------------------
 |	File bootstrap session BASE FILE		  |
 |-------------------------------------
 |	@package core
 |	@File session.php
 |  @class session	
 |	@version 1.0
 |	@access Dont Touch This File
 |	@copyright LuosDesign.com - 2012
 |  @definition: makes use of session variables in MVC
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

class session{
    
    
    
     /**
     | @function: set
     | @access: public
     | @definition:create variables to session
     |          
     **/
    public static function set( $clave,$valor ){
        
        if(!empty($clave))
        $_SESSION[PREFIX_SESSION.$clave] = $valor;
        
    }
     /**
     | @function: get
     | @access: public
     | @definition:verifies variables to session
     |          
     **/
    public static function get( $clave ){
        
        if(isset($_SESSION[PREFIX_SESSION.$clave]))
            return $_SESSION[PREFIX_SESSION.$clave];
        
    }
    /**
     | @function: access
     | @access: public
     | @definition:verifies access to system MVC
     |          
     **/
    public static function access($level)
    {
        if(!session::get('autenticado')){
            header('location:' . BASE_URL . 'error/access/5050.html');
            exit;
        }
        
        session::timeOutSession();
        
        if(session::getLevel($level) > Session::getLevel(Session::get('level'))){
            header('location:' . BASE_URL . 'error/access/5050.html');
            exit;
        }
    }
     /**
     | @function: accesoView
     | @access: public
     | @definition:verifies access to view from system MVC
     |          
     **/
    public static function accesView($level)
    {
        if(!session::get('autenticado')){
            return false;
        }
        
        if(session::getLevel($level) > session::getLevel(session::get('level'))){
            return false;
        }
        
        return true;
    }
     /**
     | @function: getLevel
     | @access: public
     | @definition:verifies access to level access from system MVC
     |          
     **/
    public static function getLevel($level)
    {
        $role['1'] = 3;
        $role['2'] = 2;
        $role['3'] = 1;
        
        if(!array_key_exists($level, $role)){
            throw new Exception('Error de acceso');
        }
        else{
            return $role[$level];
        }
    }
     /**
     | @function: accessStrict
     | @access: public
     | @definition:verifies access strict
     |          
     **/
    public static function accessStrict(array $level,$noAdmin=false){
        
       if( !session::get('autenticado') ){
        
            header('location:' . BASE_URL . 'error/access/5050.html');
            exit; 
        
       } 
       session::timeOutSession();
       
       if( $noAdmin == false ){
            
            if(session::get('level')=='1'){
                return;
            }
            
       }
       
       if( count( $level ) ){
        
            if(in_array(session::get('level'),$level)){
                return;
            }
        
       }
       header('location:' . BASE_URL . 'error/access/5050.html');
        
    }
     /**
     | @function: accessViewStrict
     | @access: public
     | @definition:verifies access strict to view
     |          
     **/
    public static function accessViewStrict(array $level,$noAdmin=false){
         if( !session::get('autenticado') ){
        
            return false; 
        
       } 
       
       if( $noAdmin == false ){
            
            if(session::get('level')=='1'){
                return true;
            }
            
       }
       
       if( count( $level ) ){
        
            if(in_array(session::get('level'),$level)){
                return true;
            }
        
       }
       return false;
     
    }
    /**
     | @function: timeOutSession
     | @access: public
     | @definition:timeOut of session
     |          
     **/
    public static function timeOutSession(){
        
        if( !session::get('time') or !defined('SESSION_TIME') ){
            
            throw new Exception('No se ha definido el tiempo de sesion');
            
        }
        
        if(SESSION_TIME == 0){
            return;
        }
        
        if(time() - session::get('time') > (SESSION_TIME * 60)){
            session::destroy();
            header('Location:'.BASE_URL."error/access/8080.html");  
        }else{
            session::set('time',time());
        }
        
    }
    /**
     | @function: checkTimeOutSession
     | @access: public
     | @definition:verifies timeOut of session
     |          
     **/
    public static function checkTimeOutSession(){
         if(time() - session::get('time') > (SESSION_TIME * 60)){
            session::destroy();
            //header('Location:'.BASE_URL."error/access/8080.html");
            
        }else{
            session::set('time',time());
        }
    }
    /**
     | @function: accessStrictView
     | @access: public
     | @definition:verifies access strict to view
     |          
     **/
    public static function accessStrictView($level,$noAdmin,$url=null){
        
        if( !session::get('autenticado') ){
            
            if( empty($url )) {
            header('location:' . BASE_URL . 'error/access/5050.html');    
            }else{
            header('location:' . BASE_URL . $url);    
            }
            
            exit; 
        
       } 
       session::timeOutSession();
       
       if( $noAdmin == false ){
            
            if(session::get('level')=='1'){
                return;
            }
            
       }
       
       if( count( $level ) ){
        
            if(in_array(session::get('level'),$level)){
                return;
            }
        
       }
       header('location:' . BASE_URL . 'error/access/5050.html');
        
    }
    
    /**
     | @function: accessStrictView
     | @access: public
     | @definition:destroy session
     |          
     **/
    public static function destroy($clave=false){
        
        if($clave){
            if(is_array($clave)){
                for($i = 0; $i < count($clave); $i++){
                    if(isset($_SESSION[$clave[$i]])){
                        unset($_SESSION[$clave[$i]]);
                    }
                }
            }
            else{
                if(isset($_SESSION[$clave])){
                    unset($_SESSION[$clave]);
                }
            }
        }
        else{
            
            session_destroy();
        }
        
    }
}


?>