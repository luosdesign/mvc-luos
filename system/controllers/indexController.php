<?php

/**
 * @author 
 * @copyright 2012
 */

class indexController extends controller{
    
    public function __construct(){
        parent::__construct();
        session::checkTimeOutSession();
        
    }
    public function index(){
        
        $post = $this->loadModel("post");
        
        
        $this->_view->titulo="portada";
        $this->_view->render("index","inicio");
        
    }
    
}

?>