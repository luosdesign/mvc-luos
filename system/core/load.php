<?php
/**
 |-------------------------------------
 |	File bootstrap load BASE FILE		  |
 |-------------------------------------
 |	@package core
 |	@File load.php
 |  @class load	
 |	@version 1.0
 |	@access Dont Touch This File
 |	@copyright LuosDesign.com - 2012
 |  @definition: load objects
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
class load{
    
    private $Object="";
    
    public function initObject( $Object ){
            
         	$this->Object = new $Object;

        	if( is_object( $this->Object ) ){
        
        		return $this->Object;	
        
        	}else{
        
        			return false;	
        
        	}	
    
       
    
    }
    
     
    
}

?>