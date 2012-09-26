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