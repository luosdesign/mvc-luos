<?php
/**
 |-------------------------------------
 |	File index MVC BASE FILE		  |
 |-------------------------------------
 |	@package Webroot
 |	@File index.php	
 |	@version 1.0
 |	@access Dont Touch This File
 |	@copyright LuosDesign.com - 2012
 **/

 //define("DS", DIRECTORY_SEPARATOR);//permite identificar la url del proyecto no importa el s.o
 
try{
    
    /**
     | @include file of core  
     **/
    define( 'DS', '/' );
    define("PATH", realpath(dirname(__FILE__)). DS);
    define("APP_PATH", PATH . "system/core" . DS);
    
    require_once APP_PATH . "config.php";
    require_once APP_PATH . "request.php";
    require_once APP_PATH . "bootstrap.php";
    require_once APP_PATH . "model.php";
    require_once APP_PATH . "view.php";
    require_once APP_PATH . "bd.php";
    require_once APP_PATH . "session.php";
    require_once APP_PATH . "controller.php";
    require_once APP_PATH . "libs.php";
    
    /**
     | @call to bootstrap, to implement MVC  
     **/
    
    bootstrap::run( new request);
    
}catch(Exception $e){
    echo $e->getMessage();
}
?>