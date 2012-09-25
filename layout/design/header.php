<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" 
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title><?php  echo $_layoutParams['param_views']['title']; ?></title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf8" />
        <link href="<?php echo $_layoutParams['ruta_css']; ?>estilos.css" rel="stylesheet" type="text/css" />
        <script src="<?php echo BASE_URL; ?>webfile/js/jquery.js" type="text/javascript"></script>
        <script src="<?php echo BASE_URL; ?>webfile/js/jquery.validate.js" type="text/javascript"></script>
    
        <?php if(isset($_layoutParams['js']) && count($_layoutParams['js'])): ?>
        <?php for($i=0; $i < count($_layoutParams['js']); $i++): ?>
        
        <script src="<?php echo $_layoutParams['js'][$i] ?>" type="text/javascript"></script>
        
        <?php endfor; ?>
        <?php endif; ?>
        
      
    <?php
    if(isset($fileJs)):
    echo $fileJs;
    endif;
    
    
    if(isset($fileJs)):
    echo $fileCss;
    endif;
    
    if($_layoutParams['metodo']=="listUsers"){
    ?>
    
    <script src="<?php echo $_layoutParams['ruta_js']; ?>script_valid.js" type="text/javascript"></script>
    
    <?php    
    }
    
    ?>
    
    </head>

    
        <body>
        <!--ventana modal msn-->

        <div id="dialogo_mensajes" title="Mensaje" >
        
     
        
            <h6></h6><br />
        
        
        
        
        
        </div>	
        
        <!--fin ventana modal msn-->	
            <div id="main">
                <div id="header">
                  <div id="header_in">
                    <div id="logo">
                        <h1><?php echo APP_NAME; ?></h1>
                    </div>
                    <?php
                    $auth=session::get("autenticado");
                    if(isset($auth)):
                    ?>
                    <div id="menu">
                        <div id="top_menu">
                            <ul>
                            
                            <li><a href="<?php echo BASE_URL . "admin" . DS . "index.html" ; ?>">Inicio</a></li>
                                                        
                            
                            <?php
                            
                            $level=session::get("level");
                            if($level=="1"):
                            
                            ?>
                            <div class="line_menu"></div>
                            <li><a href="<?php echo BASE_URL . "admin" . DS . "add.html" ; ?>">Agregar Campeonato</a></li>
                            <div class="line_menu"></div>
                            <li><a href="<?php echo BASE_URL . "admin" . DS . "addTeam.html" ; ?>">Agregar Equipos</a></li>
                            <div class="line_menu"></div>
                            <li><a href="<?php echo BASE_URL . "admin" . DS . "specialty.html" ; ?>">Especialidad</a></li>
                            <div class="line_menu"></div>
                            <li><a href="<?php echo BASE_URL . "admin" . DS . "listUsers.html" ; ?>">Usuarios</a></li>
                            <?php
                            endif;
                            ?>
                            <div class="line_menu"></div>
                            <li><a href="<?php echo BASE_URL . "citas" . DS . "changeData.html" ; ?>">Cambio datos</a></li>
                            
                            <div class="line_menu"></div>
                            <li><a href="<?php echo BASE_URL . "users" . DS . "out.html" ; ?>">Salir</a></li>

                            
                            </ul>
                        </div>
                    </div>
                    <?php
                    endif;
                    ?>
                </div>
              </div>
              
                <div id="content">
                   
                   <div id="saludo"> 
                    <?php
                    if(isset($_SESSION["autenticado"])){
                    echo "Hola, ".$this->user[0]["nombres"]." ".$this->user[0]["apellidos"]. " bienvenido";    
                    }
                     
                    
                    ?>
                    </div>
                    <noscript><p>Para el correcto funcionamiento debe tener el soporte de javascript habilitado</p></noscript>
                    <div id="error"><?php if(isset($this->_error)) echo $this->_error; ?></div>