<?php
/**
 |-------------------------------------
 |	File view MVC BASE FILE		  |
 |-------------------------------------
 |	@package Core
 |	@file view.php
 |  @class view	
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
class view{
    
   private $_controlador;
   private $_js;
   
   public function __construct(request $peticion){


        //parent::__construct();
        $this->_request = $peticion;
        $this->_js = array();
        $this->_rutas = array();
        
        $modulo = $this->_request->getModulo();
        $this->_controlador = $this->_request->getControlador();
        
        if($modulo){
            $this->_rutas['view'] = PATH . 'modules' . DS . $modulo . DS . 'views' . DS . $this->_controlador . DS;
            $this->_rutas['js'] = BASE_URL . 'modules/' . $modulo . '/views/' . $this->_controlador . '/js/';
        }
        else{
            $this->_rutas['view'] = PATH . 'system/views' . DS . $this->_controlador . DS;
            $this->_rutas['js'] = BASE_URL . 'system/views/' . $this->_controlador . '/js/';
        }

   } 
    /**
     | @function: render
     | @access: public
     | @param:
     |          $vista:view to render
     |          $item:parameters to pass
     |          $fileJs:files js to load in view
     |          $fileCss:files css to load in view
     | @definition:render view in controller         
     **/
   public function render($vista, $item=array(),$fileJ=array(),$fileC=array()){
        
        if($this->_controlador==ADMIN_CONTROLLER or $this->_controlador=="users"){

            $layoutFinal=ADMIN_LAYOUT;

        }else{

            $layoutFinal=DEFAULT_LAYOUT;
        }

        $menu=array(
            array(
                "id"=>"inicio",
                "titulo"=>"inicio",
                "enlace"=>BASE_URL
                
            ),
            
            array(
                "id"=>"citas",
                "titulo"=>"Citas",
                "enlace"=>BASE_URL . "citas"
                
            )
        );
        
        $js=array();
        
        
        if(count($this->_js)){
            
            $js=$this->_js;
        }
        
        /**
         | @var: $_layoutParams
         | @access: public
         | @param:
         |          $vista:view to render
         |          $item:parameters pass to view
         | @definition:render parameters in view          
         **/
             $_layoutParams= array(
                "ruta_general"=>BASE_URL . "layout/" . $layoutFinal . "/",
                "ruta_css"=>BASE_URL . "layout/" . $layoutFinal . "/css/",
                "ruta_img"=>BASE_URL . "layout/" . $layoutFinal . "/images/",
                "ruta_img_admin"=>BASE_URL .WEBFILE. "/img/",
                "ruta_js"=>BASE_URL . "layout/" . $layoutFinal . "/js/",
                "ruta_webfile"=>BASE_URL,
                "menu"=>$menu,
                "js"=>$js,
                "controlador"=>$this->_controlador,
                "metodo"=>$vista,
                "param_views"=>$item
                
            );
            
            /**
         | @var: $fileJs
         | @access: public
         | 
         |          
         |          
         | @definition:render files js in view         
         **/
         
            if( !empty( $fileJ ) ){

                $fileJs=null;
                foreach( $fileJ as $key=>$value ){
                
                    
                    $fileJs.="<script type='text/javascript' src='". BASE_URL . "layout" . DS . $layoutFinal . DS . $value ."'></script>";
                    
                }
                    
            }
            
               /**
         | @var: $fileCss
         | @access: public
         | 
         |          
         |          
         | @definition:render files css in view         
         **/
            if( !empty( $fileC ) ){
                $fileCss=null;
                foreach( $fileC as $key=>$value ){
                    
                    $fileCss.="<link type='text/css' rel='stylesheet' href='". BASE_URL . "layout" . DS . $layoutFinal . DS . $value ."' /> ";
                    
                    
                }
                    
            }
            
            
                    
            if($vista=="error"):

            $rutaView=PATH . "system/views" . DS . "error" . DS . $vista . ".phtml";
            else:

            $rutaView=PATH . "system/views" . DS . $this->_controlador . DS . $vista . ".phtml";
            endif;
        
            
          
        
            if( is_readable($rutaView) ){
                
               
              
                
                include_once PATH . "layout" . DS . $layoutFinal . DS . "header.php";
                include_once $rutaView;
                include_once PATH . "layout" . DS . $layoutFinal . DS . "footer.php";
               
              
                
            
           }else{
            
                //throw new Exception("Error de vista");
            
                controller::redirect('error/access/2020');
            
           }
   }

   
   /**
     | @function: setJs
     | @access: public
     | @param:
     |          $js:file to load
     |          $item:parameters to pass
     |          
     **/
   public function setJs($js=array()){
    
        if(is_array($js) && count($js)){
            for($i=0;$i<count($js);$i++){
                $this->_js[]=BASE_URL . "system/views/" . $this->_controlador . "/js/" . $js[$i] . ".js";
            }
        }else{
            
            throw new Exception("Error de js");
            
        }
    
   }
    
}


?>