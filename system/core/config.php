<?php
/**
 |-------------------------------------
 |	File bootstrap config BASE FILE		  |
 |-------------------------------------
 |	@package Core
 |	@File config.php
 |  @class config	
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


define("DEFAULT_CONTROLLER","users");
define("DEFAULT_LAYOUT","design");
define("BASE_URL","http://localhost:8080/mvc_luos_campeonato/");
define("BASE_URL_LIBS",BASE_URL."system/libs/");
define("WEBFILE","webfile");
define("WEBFILE_IMAGES","webfile/images/");


define("APP_NAME","mvc luos campeonato");
define("PREFIX_SESSION","mvc_");
define("EMAIL_COMPANY","oscalber22@gmail.com");
define("APP_SLOGAN","Dise�o, Desarrollo y Aprendizaje Autodidacta");
define("APP_COMPANY","www.luosdesign.com");
define('SESSION_TIME', '30');
define('LOAD_CONTROLLER', 'users/index');
define('ADMIN_LAYOUT', 'admin');

define("DB_HOST","localhost");
define("DB_USER","root");
define("DB_PASS","");
define("DB_NAME","mvc_campeonato");
define("DB_TYPE","mysql");
define("DB_CHAR","utf8");
define("DB_PORT","80");


?>