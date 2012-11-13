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
 |	@copyright Licencia GNU LuosDesign.com - 2012
 |	@Author: luosdesign@gmail.com


    #=================================================================
    # Licencia:
    #   framework para el desarrollo rapido de aplicaciones
    #   Licencia GNU 2011  Luosdesign.com
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

date_default_timezone_set("America/Bogota");

define("DEFAULT_LAYOUT","alva");
define("ADMIN_LAYOUT","admin");
define("MODULES_APP",serialize(array('usuarios')));
define("BASE_URL","http://localhost:8080/tuapp/");
define("BASE_URL_LIBS",BASE_URL."system/libs/");
define("WEBFILE","webfile");
define("WEBFILE_IMAGES","webfile/images/");


define("APP_NAME","alva");
define("PREFIX_SESSION","app_");
define("EMAIL_COMPANY","");
define("APP_SLOGAN","tu slogan");
define("APP_COMPANY","");
define('SESSION_TIME', '30');
define('LOAD_CONTROLLER', 'portada/index');
define("ADMIN_CONTROLLER","admcar");
define('REDIRECT_LOAD_CONTROLLER', '0');//yes:1,no:0


define("DB_HOST","localhost");
define("DB_USER","db_user");
define("DB_PASS","db_pass");
define("DB_NAME","db_name");
define("DB_TYPE","mysql");
define("DB_CHAR","utf8");
define("DB_PORT","80");


?>