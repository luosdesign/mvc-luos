<?php
/**
 |-------------------------------------
 |	File errorController    		  |
 |-------------------------------------
 |	@package controller
 |	@File errorController.php
 |  @class controller	
 |	@version 1.0
 |	@access Dont Touch This File
 |	@copyright LuosDesign.com - 2012
 |   
 **/
class errorController extends Controller{
    
    public function __construct(){
        parent::__construct();
    }
    
    public function index(){
        
        $this->_view->mensaje=$this->_getError();
        $this->_view->render('index', array('title'=>'error','keyword'=>'error','description'=>'error'));
        
    }
    
    public function access($arg=array()){
       $this->_view->mensaje=$this->_getError($arg[0]);
       $this->_view->render('access', array('title'=>'error','keyword'=>'error','description'=>'error'));
       
        
    }
    
    private function _getError($codigo=false){
        
      if($codigo){
        
        $codigo=$this->filtrarInt($codigo);
        
        if( is_int($codigo) )
            $codigo=$codigo;
        
      }else{
        $codigo='default';
      }
        
        $error['default']='Ha Ocurrido un Error y la P&aacute;gina no Podra Mostrarse';
        $error['5050']='Acceso Restringido';
        $error['8080']='Tiempo de Session Agotado,Vuelve a Loguearte';
        $error['4040']='Ups p&aacute;gina no encontrada';
        $error['4000']='Ups Error 400';
        $error['2020']='Ups Error de vista';
        $error['1010']='Ups Error de modelo';
        $error['3030']='Ups Error de controlador';
        $error['3003']='Estamos en mantenimiento';
        if( array_key_exists($codigo,$error) ){
            
            return $error[$codigo];
            
        }else{
            
            return $error['default'];
            
        }
        
    }
    
 }
 ?>   