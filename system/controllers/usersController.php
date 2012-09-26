<?php
/**
 |these comments are not required to maintain documented your application
 |Estos son comentarios no obligatorios para mantener documentado tu aplicacion
 |-------------------------------------
 |	File homeController    		  |
 |-------------------------------------
 |	@package controller
 |	@File homeController.php
 |  @class controller	
 |	@version 1.0
 |	@access Dont Touch This File
 |	@copyright LuosDesign.com - 2012
 |  The name of the controller is standard MVC Luo CamelCase, but not required
 |  El nombre del controlador por estandar de luos MVC es CamelCase, pero no es obligatorio
 |  Father always extends Controller
 |  Siempre extendera del controlador padre 
 **/

class usersController extends Controller{
    /**
     | for possible work in the controller is recommended to create a private variable, this may be the name you want, but by MVC Luos standard will always have _ and followed by the driver man
     | para posibles trabajos en el controlador es recomendable crear una variable privada, esta puede ser el nombre que quieras, pero por estandar de luos MVC siempre tendra _ y seguida del hombre del controlador
    
    **/    
    private $_users;
    
    /**
      | always create a constructor for the call of the corresponding model, libraries and other preload options on the controller
      | siempre se creara un contructor para realizar el llamado de el modelo correspondiente, librerias y demas opciones a precargar en el controlador
    **/
    public function __construct() {
        /**
         | call the constructor of the parent controller
         | llamamos al constructor del controlador padre
        **/
        parent::__construct();
        /**
         | assign the corresponding model must be created in the models
         | asignamos el modelo correspondiente que debe estar creado en el directorio models
        **/
        $this->_users = $this->loadModel('users');
         /**
         | call the libraries that currently have MVC Luo, the call is the list of libraries to be loaded into an array
         | llamamos las librerias que actualmente tenga luos MVC, el llamado es la lista de librerias a cargar en un array
        **/
        $this->getLibrary(array("loadJs","methods","valid_form"));
        $this->getHelper(array("form_helper","html_helper"));
        $auth=session::get("user_id_session");
        if(isset($auth)){
        
        $userTipo=$this->_users->find('mvc_usuarios','id,privilegio',array(),array('where id='=>session::get("user_id_session"))); 
       
        $user=$this->_users->find('mvc_perfiles','*',array(),array('WHERE mvc_perfiles.identificacion ='=>session::get("user_session")));
        $this->_view->user=$user;
       
        
        
      }    
        
    }
    
    
    public function index()
    {
        
        $auth=session::get("autenticado");
        if(isset($auth)):
    
        $this->redirect('admin/index');
        
        endif;
        $this->redirect('users/login');
        enif;
        
    }
    
    public function access($arg=array()){
        
        $auth=session::get("autenticado");
        if(isset($auth)):
        $this->redireccionar();
        else:
        
        $this->_view->mensaje=$this->_getError($arg[0]);
        $this->_view->render('access', array('title'=>'error','keyword'=>'error','description'=>'error'));
        
        endif;
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
       
        if( array_key_exists($codigo,$error) ){
            
            return $error[$codigo];
            
        }else{
            
            return $error['default'];
            
        }
        
    }
   public function login(){
    if(isset($_SESSION["autenticado"])):
    
        $this->redirect('admin/index');
        
        endif;
   
    if(isset($_POST["valid"]) and $_POST["valid"]=="ok"):
    
    
            
            
            if(!$this->validEmpty("login")){
                
                $this->_view->messageError="Ingresa un Login";
                $this->_view->render('login',array('title'=>'Logueo'));
                exit;
            }
            
            if(!$this->validEmpty("pass")){
                
                $this->_view->messageError="Ingresa un Password";
                $this->_view->render('login',array('title'=>'Logueo'));
                exit;
            }
            
            $valid=$this->_users->find('mvc_usuarios','*',array(),array('WHERE user ='=>$_POST["login"],' AND pass ='=>base64_encode($_POST["pass"])));
            
            if(count($valid)>0):
                
                session::set('autenticado', true);
                session::set('level', $valid[0]["privilegio"]);
                session::set('time', time());
                session::set('user_session', $_POST['login']);
                session::set('user_id_session', $valid[0]["id"]);
            
            
            $this->redirect('admin/index');
                
            else:   
            
            $this->_view->messageError="Datos Incorrectos";
            $this->_view->render('login',array('title'=>'logueo'));
            
            endif;
    
    endif;
    
    
    $this->_view->render('login',array('title'=>'logueo'));
   }
   
   public function register(){
         if(isset($_SESSION["autenticado"])):
    
        $this->redirect('admin/index');
        
        endif;
        
        if(isset($_POST["valid"])):
            
             if(!$this->_view->valid_form->mandatory($_POST["nombres"])){
                
                $this->_view->messageError="Ingresa Tu(s) Nombre(s)";
                $this->_view->render('register',array('title'=>'Registro'));
                exit;
            }
            
            if(!$this->_view->valid_form->mandatory($_POST["apellidos"])){
                
                $this->_view->messageError="Ingresa Tu(s) Apellido(s)";
                $this->_view->render('register',array('title'=>'Registro'));
                exit;
            }
            
            
            
            if(!$this->_view->valid_form->is_numeric($_POST["identificacion"])){
                
                $this->_view->messageError="La Identificacion debe ser Numero";
                $this->_view->render('register',array('title'=>'Registro'));
                exit;
            }
            
            if(!$this->_view->valid_form->is_numeric($_POST["telefono"])){
                
                $this->_view->messageError="Ingresa Un Numero  Telefonico";
                $this->_view->render('register',array('title'=>'Registro'));
                exit;
            }
            
            if(!$this->_view->valid_form->is_email($_POST["email"])){
                
                $this->_view->messageError="Ingresa Un Correo Valido";
                $this->_view->render('register',array('title'=>'Registro'));
                exit;
            }
            
            if(!$this->_view->valid_form->mandatory($_POST["pass"])){
                
                $this->_view->messageError="Ingresa Un Password";
                $this->_view->render('register',array('title'=>'Registro'));
                exit;
            }
            
            if(!$this->_view->valid_form->min_length($_POST["pass"],"6")){
                
                $this->_view->messageError="Minimo 6 Digitos";
                $this->_view->render('register',array('title'=>'Registro'));
                exit;
            }
            
            if(!$this->_view->valid_form->mandatory($_POST["rpass"])){
                
                $this->_view->messageError="Repite el Password";
                $this->_view->render('register',array('title'=>'Registro'));
                exit;
            }
            
            
            
            if(!$this->_view->valid_form->compare($_POST["pass"],$_POST["rpass"])){
                
                $this->_view->messageError="Password no concuerda";
                $this->_view->render('register',array('title'=>'Registro'));
                exit;
            }
            //is_email
            
            if(count($this->_users->find('mvc_usuarios','*',array(),array('WHERE usuarios.user ='=>$_POST["identificacion"]," Or medicos.email ="=>$_POST["email"]," Or pacientes.email ="=>$_POST["email"]," Or admin.email ="=>$_POST["email"] )))==0):
            
                $usuarios=array("user"=>$_POST["identificacion"],"pass"=>base64_encode($_POST["pass"]),"privilegio"=>"3","estado"=>"1");
                
                if($this->_users->add('mvc_usuarios',$usuarios)):
                $select_usuario=$this->_users->find('mvc_usuarios','*',array(),array('WHERE user='=>$_POST["identificacion"]));
                $datos=array("nombres"=>$_POST["nombres"],"apellidos"=>$_POST["apellidos"],"telefono"=>$_POST["telefono"],"email"=>$_POST["email"],"identificacion"=>$_POST["identificacion"],"fecha_ingreso"=>"now()","id_usuario"=>$select_usuario[0]["id"]);
                $this->_users->add('mvc_pacientes',$datos);
                
                $this->JsMessage("Has sido Registrado Exitosamente",BASE_URL.'users/login.html');    
                endif;
            
            else:
                unset($_POST);
                $this->_view->messageError="Usuario ya Existe";
                $this->_view->render('register',array('title'=>'Registro'));
            
            endif;
            
        endif;
        
        
        $this->_view->render('register',array('title'=>'Registro'));
    
   }
   
   public function listUsers($arg=array()){
        
        
        $users=$this->_users->find('mvc_usuarios','id,privilegio,estado',array(),array(),'','',true);
    
        
        foreach($users as $key=>$value){
            
            if($value["privilegio"]=="1"){
                
                $data=$this->_users->find('mvc_admin','id_usuario,nombres,apellidos,id,identificacion,email,fecha_ingreso',array(),array("where id_usuario ="=>$value["id"]));
                $data2[]=array("nombres"=>$data[0]["nombres"],"apellidos"=>$data[0]["apellidos"],"identificacion"=>$data[0]["identificacion"],"email"=>$data[0]["email"],"id"=>$data[0]["id"],"estado"=>$value["estado"],"fecha_ingreso"=>$data[0]["fecha_ingreso"],"id_usuario"=>$data[0]["id_usuario"]);
                
            }else{
                
                if($value["privilegio"]=="2"){
                
                    $data=$this->_users->find('medicos','id_usuario,nombres,apellidos,id,identificacion,email,fecha_ingreso',array(),array("where id_usuario ="=>$value["id"]));
                    $data2[]=array("nombres"=>$data[0]["nombres"],"apellidos"=>$data[0]["apellidos"],"identificacion"=>$data[0]["identificacion"],"email"=>$data[0]["email"],"id"=>$data[0]["id"],"estado"=>$value["estado"],"fecha_ingreso"=>$data[0]["fecha_ingreso"],"id_usuario"=>$data[0]["id_usuario"]);    
                    
                }else{
                    
                    if($value["privilegio"]=="3"){
                        
                        $data=$this->_users->find('pacientes','id_usuario,nombres,apellidos,id,identificacion,email,fecha_ingreso',array(),array("where id_usuario ="=>$value["id"]));
                        $data2[]=array("nombres"=>$data[0]["nombres"],"apellidos"=>$data[0]["apellidos"],"identificacion"=>$data[0]["identificacion"],"email"=>$data[0]["email"],"id"=>$data[0]["id"],"estado"=>$value["estado"],"fecha_ingreso"=>$data[0]["fecha_ingreso"],"id_usuario"=>$data[0]["id_usuario"]);
                        
                        
                    }
                    
                }
                
            }
            
        }
        //print_r($data);
        $this->_view->data=$data2;
        
        if(isset($arg[1]) and is_numeric($arg[1])){
            
            //vamos a habilitar o deshabilitar usuarios
            if($arg[0]=="habUsers"){
                
                $estado=$this->_users->find('usuarios','estado,id',array(),array("where id ="=>$arg[1]));
                
                if($estado[0]["estado"]=="1"){
                    
                    $data=array("id"=>$estado[0]["id"],"estado"=>"0");
                    $this->_users->update('usuarios',$data,true);
                    $this->redirect('users/listUsers');
                    
                }else{
                    
                    $data=array("id"=>$estado[0]["id"],"estado"=>"1");
                    $this->_users->update('usuarios',$data,true);
                    $this->redirect('users/listUsers');
                }
                
                
            }else{
                
                if($arg[0]=="elimUsers"){
                    
                    $user=$this->_users->find('visitas','*',array(),array("where id_medico ="=>$arg[1]," or id_paciente ="=>$arg[1]));
                    
                    if(count($user)>0){
                        
                        //$this->redirect('users/listUsers');
                        
                        //session::set("respError","Error al Eliminar el elemento , contiene visitas antiguas o actuales asignadas");
                        
                         $this->_view->message="Error al Eliminar el usuario , contiene visitas antiguas o actuales asignadas";                        
                        

                         
                    }else{
                        
                        $privilegio=$this->_users->find('usuarios','*',array(),array('where id ='=>$arg[1]));
                        
                        
                        $this->_users->delete('usuarios',$arg[1]);                   
                        
                        
                        $this->redirect('users/listUsers');
                        
                    }
                    
                }
                
            }
            
        }
        
        $this->_view->render('listUsers',array('title'=>'Lista de Usuarios'));
   }
   
   public function addUser(){
    
            if(isset($_POST["valid"])){
                
                
                
                if(!$this->_view->valid_form->mandatory($_POST["usuario"]) or !$this->_view->valid_form->is_numeric($_POST["usuario"])){
                
                    $this->_view->messageError="Ingresa Un(s) Documento de Usuario(s)";
                    $this->_view->render('addUser',array('title'=>'Agregar Usuario'));
                    exit;
                }
                
    
                
                if(!$this->_view->valid_form->is_email($_POST["email"])){
                    
                    $this->_view->messageError="Ingresa Un Correo Valido";
                    $this->_view->render('addUser',array('title'=>'Agregar Usuario'));
                    exit;
                }
                
                if(!$this->_view->valid_form->mandatory($_POST["tipo"])){
                    
                    $this->_view->messageError="Seleccione un tipo de usuario";
                    $this->_view->render('addUser',array('title'=>'Agregar Usuario'));
                    exit;
                }
                
                if(!$this->_view->valid_form->mandatory($_POST["pass"])){
                    
                    $this->_view->messageError="Ingresa Un Password";
                    $this->_view->render('addUser',array('title'=>'Agregar Usuario'));
                    exit;
                }
                
                if(!$this->_view->valid_form->min_length($_POST["pass"],"6")){
                    
                    $this->_view->messageError="Minimo 6 Digitos";
                    $this->_view->render('addUser',array('title'=>'Agregar Usuario'));
                    exit;
                }
                
                if(!$this->_view->valid_form->mandatory($_POST["rpass"])){
                    
                    $this->_view->messageError="Repite el Password";
                    $this->_view->render('addUser',array('title'=>'Agregar Usuario'));
                    exit;
                }
                
                
                
                if(!$this->_view->valid_form->compare($_POST["pass"],$_POST["rpass"])){
                    
                    $this->_view->messageError="Password no concuerda";
                    $this->_view->render('addUser',array('title'=>'Agregar Usuario'));
                    exit;
                }
                
                if(count($this->_users->find('usuarios','*',array(),array('WHERE usuarios.user ='=>$_POST["usuario"] )))==1):
                
                    $this->_view->messageError="Documento ya Existe";
                    $this->_view->render('addUser',array('title'=>'Agregar Usuario'));
                    exit;
                
                endif;
                
                if(count($this->_users->find('usuarios,medicos,pacientes,admin','*',array(),array('WHERE medicos.email ='=>$_POST["email"]," Or pacientes.email ="=>$_POST["email"]," Or admin.email ="=>$_POST["email"] )))==0):
            
                    $usuarios=array("user"=>$_POST["usuario"],"pass"=>base64_encode($_POST["pass"]),"privilegio"=>$_POST["tipo"],"estado"=>"1");
                    
                    if($this->_users->add('usuarios',$usuarios)):
                    $select_usuario=$this->_users->find('usuarios','*',array(),array('WHERE user='=>$_POST["usuario"]));
                    $datos=array("nombres"=>"","apellidos"=>"","telefono"=>"","email"=>$_POST["email"],"identificacion"=>$_POST["usuario"],"fecha_ingreso"=>"now()","id_usuario"=>$select_usuario[0]["id"]);
                    
                    if($_POST["tipo"]=="1"){
                        
                        $this->_users->add('admin',$datos);
                        
                    }else{
                        
                        if($_POST["tipo"]=="2"){
                            
                            $this->_users->add('medicos',$datos);
                            
                        }else{
                            
                            if($_POST["tipo"]=="3"){
                               
                               $this->_users->add('pacientes',$datos);
                                
                            }
                            
                        }
                        
                    }
                    
                    
                    $this->_view->messageOk="Usuario Registrado";
                    $this->_view->render('addUser',array('title'=>'Agregar Usuario'));    
                    endif;
                
                else:
                    unset($_POST);
                    $this->_view->messageError="Usuario ya Existe";
                    $this->_view->render('addUser',array('title'=>'Agregar Usuario'));
                
                endif;
                
                
            }
            
            
             if(isset($_POST["valid_ajax"])){
                
                
                
                if(!$this->_view->valid_form->mandatory($_POST["usuario"]) or !$this->_view->valid_form->is_numeric($_POST["usuario"])){
                
                    echo "1";
                   
                    exit;
                }
                
    
                
                if(!$this->_view->valid_form->is_email($_POST["email"])){
                    
                    echo "2";
                   
                    exit;
                }
                
                if(!$this->_view->valid_form->mandatory($_POST["tipo"])){
                    
                    echo "3";
                 
                    exit;
                }
                
                if(!$this->_view->valid_form->mandatory($_POST["pass"])){
                    
                    echo "4";
                 
                    exit;
                }
                
                if(!$this->_view->valid_form->min_length($_POST["pass"],"6")){
                    
                    echo "5";
                 
                    exit;
                }
                
                if(!$this->_view->valid_form->mandatory($_POST["rpass"])){
                    
                    echo "6";
                   
                    exit;
                }
                
                
                
                if(!$this->_view->valid_form->compare($_POST["pass"],$_POST["rpass"])){
                    
                    echo "7";
                   
                    exit;
                }
                
                if(count($this->_users->find('usuarios','*',array(),array('WHERE usuarios.user ='=>$_POST["usuario"] )))==1):
                
                    echo "8";
                  
                    exit;
                
                endif;
                
                if(count($this->_users->find('usuarios,medicos,pacientes,admin','*',array(),array('WHERE medicos.email ='=>$_POST["email"]," Or pacientes.email ="=>$_POST["email"]," Or admin.email ="=>$_POST["email"] )))==0):
            
                    $usuarios=array("user"=>$_POST["usuario"],"pass"=>base64_encode($_POST["pass"]),"privilegio"=>$_POST["tipo"],"estado"=>"1");
                    
                    if($this->_users->add('usuarios',$usuarios)):
                    $select_usuario=$this->_users->find('usuarios','*',array(),array('WHERE user='=>$_POST["usuario"]));
                    $datos=array("nombres"=>"","apellidos"=>"","telefono"=>"","email"=>$_POST["email"],"identificacion"=>$_POST["usuario"],"fecha_ingreso"=>"now()","id_usuario"=>$select_usuario[0]["id"]);
                    
                    if($_POST["tipo"]=="1"){
                        
                        $this->_users->add('admin',$datos);
                        
                    }else{
                        
                        if($_POST["tipo"]=="2"){
                            
                            $this->_users->add('medicos',$datos);
                            
                        }else{
                            
                            if($_POST["tipo"]=="3"){
                               
                               $this->_users->add('pacientes',$datos);
                                
                            }
                            
                        }
                        
                    }
                    
                    
                    echo "9";
                    
                    exit; 
                    
                    endif;
                
                else:
                
                    unset($_POST);
                
                    echo "10";
                
                    exit;
                
                endif;
                
                
            }
            
            
            $this->_view->render('addUser',array('title'=>'Agregar Usuario'),array("js/jquery-ui.js","js/file_js.js"),array("css/ui-lightness/jquery-ui-1.8.16.custom.css"));
   }
   
   public function remember(){
        if(!isset($_SESSION["autenticado"])):
    
    if(isset($_POST["valid"])){
        
    
        $rem=$this->_users->find('medicos,pacientes,admin','*',array(),array('where medicos.email ='=>$_POST["email"]," or pacientes.email ="=>$_POST["email"]," or admin.email ="=>$_POST["email"]));
        $user=$this->_users->find('usuarios','*',array(),array('where id ='=>$rem[0]["id_usuario"]));
        $pass=base64_decode($user[0]["pass"]);
        if(count($rem)>0){
                            $correo=$rem[0]["email"];
                            $remitente=EMAIL_COMPANY;
            				$asunto="Recordatorio de tu password";
            				$cuerpo=
            				"
            				<html>
            				<head>
            				<body>
            					<table align='left' width='600'>
            				<tr>
            				<td valign='top' align='left' width='200'>
            				Hola, hemos recuperado tu password en control de citas:
            				</td>
            				<td valign='top' align='left' width='400'>
                            Tu password: ".$pass."
                            </td>
            				</tr>
            				<tr>
            				<td valign='top' align='left' width='200'>
                            Gracias...
            				</td>
                                                       
                            </tr>	
                           	  		
            				</table>
            				</body>
            				</head>
            				<html>
            				";
            				
            				$sheader="From:".$remitente."\nReply-To:".$remitente."\n"; 
            				$sheader=$sheader."X-Mailer:PHP/".phpversion()."\n"; 
            				$sheader=$sheader."Mime-Version: 1.0\n"; 
            				$sheader=$sheader."Content-Type: text/html"; 
            				$para = $correo;
            				
            				mail($para,$asunto,$cuerpo,$sheader);
            
            $this->_view->messageError="El password ha sido enviado a su correo";
            //$this->_view->render('addUser',array('title'=>'recordar datos'));
            exit;
            header( "refresh:3;url=".BASE_URL."" );
        }else{
            
            
            $this->redirect('citas/index');
            
        }
            
        }
        
        endif;
        
        $this->_view->render('remember',array('title'=>'Recordar Password'));
   }
   
    public function out(){
        session::destroy();
         
    
        $this->redirect('citas/index');
        
        
    }
    
    
}

?>