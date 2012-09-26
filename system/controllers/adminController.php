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

class adminController extends Controller{
    /**
     | for possible work in the controller is recommended to create a private variable, this may be the name you want, but by MVC Luos standard will always have _ and followed by the driver man
     | para posibles trabajos en el controlador es recomendable crear una variable privada, esta puede ser el nombre que quieras, pero por estandar de luos MVC siempre tendra _ y seguida del hombre del controlador
    
    **/    
    private $_admin;
    
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
        $this->_admin = $this->loadModel('admin');
         /**
         | call the libraries that currently have MVC Luo, the call is the list of libraries to be loaded into an array
         | llamamos las librerias que actualmente tenga luos MVC, el llamado es la lista de librerias a cargar en un array
        **/
        $this->getLibrary(array("loadJs","methods","valid_form"));
        $this->getHelper(array("form_helper","html_helper"));
        $auth=session::get("autenticado");
         if(empty($auth)):
    
            $this->redirect('users/index');
            
          endif;
        
        $userTipo=$this->_admin->find('mvc_usuarios','id,privilegio',array(),array('where id='=>session::get("user_id_session"))); 
       
        $user=$this->_admin->find('mvc_perfiles','*',array(),array('WHERE mvc_perfiles.identificacion ='=>session::get("user_id_session")));
        $this->_view->user=$user;
                
       
        if($userTipo[0]["privilegio"]=="1"){
            
            
        }else{
            if($userTipo[0]["privilegio"]=="2"){
              
              $this->redirect('consulta/index');
            
            }else{
                if($userTipo[0]["privilegio"]=="3"){
                    
                 $this->redirect('consulta/index');
            
                }
            }
        }
          
        
        session::checkTimeOutSession();
        
        
    }
    
    public function index()
    {
        $auth=session::get("autenticado");
        if(!isset($auth)):
    
            $this->redirect('users/index');
            
          endif;
        /**
         | 
         | realizamos una consulta a la base de datos, y automaticamente pasamos los valores devueltos a la vista correspondiente.
         | @example: $this->_view->data = Indicamos que variable data es lo q pasara a la vista y el contenido de dicha variable es el resultado de la consulta.
         | @example: $this->_home->find = en este punto es donde usaremos la variable instanciada como privada al inicio del archivo, para realizar la consulta.
         | @example: $this->_home->find() = find es una funcion del core el cual te permitira realizar un select en la base de datos
         | @example: $this->_home->find('','',array(),array(),'','')=esta funcion del core recibe hasta 6 parametros,
         |      parametro 1: nombre de la tabla de la base de datos (Obligatorio)
         |      parametro 2: campos a seleccionar por defecto *     (por default es *)
         |      parametro 3: union de tablas con join               (opcional)
         |      parametro 4: where sql                              (opcional)
         |      parametro 5: campo por el cual ordenar, order by    (opcional)
         | @example:  (id) 
         |      parametro 6: limite de consulta limit               (opcional)
         | @example: (limit,10)     
        **/
        
        $this->_view->data=$this->_admin->find('mvc_campeonato','*',array(),array());
        
        
        $this->_view->render('index', array('title'=>'administracion de campeonatos'));
        
    }
    
    public function add(){
        
        
        /**
         | se realiza las validaciones ya conocidas.
         | $this->getText: es el llaamado a una funcion del core el cual nos valida si el campo pasado como parametro esta vacio
        **/
        
        if(isset($_POST["valid"])){
            $this->_view->data=$_POST;
            
            if(!$this->_view->valid_form->mandatory($_POST["nombre_campeonato"])){
                
                $this->_view->messageError="Debes Agregar un nombre de campeonato";
                $this->_view->render('add',array('title'=>'Agregar Campeonato'),array("js/jquery-ui.js","js/file_js.js"),array("css/ui-lightness/jquery-ui-1.8.16.custom.css"));
                exit;
            }
            
            if(!$this->_view->valid_form->mandatory($_POST["fecha_ini"])){
                
                $this->_view->messageError="Debes Seleccionar una fecha de inicio";
                $this->_view->render('add',array('title'=>'Agregar Campeonato'),array("js/jquery-ui.js","js/file_js.js"),array("css/ui-lightness/jquery-ui-1.8.16.custom.css"));
                exit;
            }
            
            if(!$this->_view->valid_form->mandatory($_POST["fecha_fin"])){
                
                $this->_view->messageError="Debes Seleccionar una Fecha de fin";
                $this->_view->render('add',array('title'=>'Agregar Campeonato'),array("js/jquery-ui.js","js/file_js.js"),array("css/ui-lightness/jquery-ui-1.8.16.custom.css"));
                exit;
            }
            
            if($this->_admin->find('mvc_campeonato','*',array(),array('where nombre_campeonato ='=>$_POST["nombre_campeonato"]))){
                
                $this->_view->messageError="Nombre de campeonato ya existe";
                $this->_view->render('add',array('title'=>'Agregar Campeonato'),array("js/jquery-ui.js","js/file_js.js"),array("css/ui-lightness/jquery-ui-1.8.16.custom.css"));
                exit;
            }
                       
        
            
            
            unset($_POST["valid"]);
            $_POST["estado"]="1";
            if( $this->_admin->add('mvc_campeonato',$_POST )){
          /**
           |validamos si efectivamente se inserto los valoes en la base de datos, si es asi entonces usamos una funcion del core llamada redirect para redireccionar hacia la ubicacion donde se lista los articulos de la base de datos
                
          **/   
                $this->_view->messageError="Agregado con exito";
                $this->_view->methods->timeRedirect("2",BASE_URL."admin/index.html");   
                //$this->redirect('admin/index');
            }else{
          /**
          | si no se inserto pasamos una variable hacia la visata llamada messageError con su contenido, y posteriormente llamamos a la vista
          **/      
                $this->_view->messageError="Error al Agregar";
                $this->_view->render('add',array("title"=>"Agregar Campeonato"));
            }
            
        }
        
        /**
        | de no exister valor $_POST es por q no se a dado clic en el buton agregar y solo se mostrar los inputs vacios
        **/
        $this->_view->render('add',array("title"=>"Agregar Campeonato"),array("js/jquery-ui.js","js/file_js.js"),array("css/ui-lightness/jquery-ui-1.8.16.custom.css"));
        
    }
    
    public function edit($arg=array()){
        
        $data=$this->_admin->find('mvc_campeonato','*',array(),array("WHERE id="=>$arg[0]));
        $this->_view->data=$data;
        
        
        if(isset($_POST["valid"])){
            
            if(!$this->_view->valid_form->mandatory($_POST["nombre_campeonato"])){
                
                $this->_view->messageError="Debes Agregar un nombre de campeonato";
                $this->_view->render('add',array('title'=>'Editar Campeonato'),array("js/jquery-ui.js","js/file_js.js"),array("css/ui-lightness/jquery-ui-1.8.16.custom.css"));
                exit;
            }
            
            if(!$this->_view->valid_form->mandatory($_POST["fecha_inicio"])){
                
                $this->_view->messageError="Debes Seleccionar una fecha de inicio";
                $this->_view->render('add',array('title'=>'Editar Campeonato'),array("js/jquery-ui.js","js/file_js.js"),array("css/ui-lightness/jquery-ui-1.8.16.custom.css"));
                exit;
            }
            
            if(!$this->_view->valid_form->mandatory($_POST["fecha_fin"])){
                
                $this->_view->messageError="Debes Seleccionar una Fecha de fin";
                $this->_view->render('add',array('title'=>'Editar Campeonato'),array("js/jquery-ui.js","js/file_js.js"),array("css/ui-lightness/jquery-ui-1.8.16.custom.css"));
                exit;
            }
            
            if($this->_admin->find('mvc_campeonato','*',array(),array('where nombre_campeonato ='=>$_POST["nombre_campeonato"],' and id !='=>$arg[0]))){
                
                $this->_view->messageError="Nombre de campeonato ya existe";
                $this->_view->render('add',array('title'=>'Editar Campeonato'),array("js/jquery-ui.js","js/file_js.js"),array("css/ui-lightness/jquery-ui-1.8.16.custom.css"));
                exit;
            }
            
          
            
            
            unset($_POST["valid"]);
            
            
            
            if($this->_admin->update('mvc_campeonato',$_POST)){
            /**
             | redireccionamos donde listamos los articulos
            **/        
            
                $this->_view->messageError="Actualizado con Exito";
                $this->_view->methods->timeRedirect("2",BASE_URL."admin/index.html");        
                
            }else{
            /**
             | si no actualiza nos mostrara un error en la vista q posteriormente renderizamos
            **/ 
                $this->_view->messageError="Error al Actualizar";
                $this->_view->render('edit',array('title'=>'Editar'),array("js/jquery-ui.js","js/file_js.js"),array("css/ui-lightness/jquery-ui-1.8.16.custom.css"));
            }
            
        }
        
        /**
             | si no existe valor $_POST entonces mostramos los inputs con sus valores correspondientes
         **/ 
        $this->_view->render('edit',array('title'=>'Editar Campeonato'),array("js/jquery-ui.js","js/file_js.js"),array("css/ui-lightness/jquery-ui-1.8.16.custom.css"));
        
    }
    
    public function delete($arg=array()){
        
        if(isset($arg[0]) and is_numeric($arg[0])){
            /**
             
             | 
             | realizamos una consulta a la base de datos, consulta q es un delete.
             | esta funcion recibe un parametro es por eso que se debe poner como parametro $arg=array(), para que reciba los valores pasados por url
             | delete: pasamos dos parametros.
             | parametro 1= nombre de tabla de base de datos
             | parametro 2= id del elemento a eliminar q lo recibira $arg en la posicion en este caso 0
             
            **/
            $visita=$this->_citas->find('visitas','*',array(),array('where id ='=>$arg[0]));
            $hoy=strtotime(date("y-m-d"));
            if($this->_citas->delete('visitas',$arg[0])){
                /**
                 |rediccionamos hacia la pagina donde listamos los articulos
                **/
                
                if(strtotime($visita[0]["fecha"])>$hoy){
                 
                 $this->redirect('citas/next');
                    
                }else{
                    if(strtotime($visita[0]["fecha"])<$hoy){
                 
                      $this->redirect('citas/last');  
                        
                    }else{
                        
                        $this->redirect('citas/index');
                        
                    }
                     
                }
                
                 
            }
        }
        
     }
    
    
    public function addTeam(){
        
      
        $campeonatos=$this->_admin->find('mvc_campeonato','*',array(),array());
        $this->_view->campeonatos=$campeonatos;
        
        
        
        $this->_view->render('addTeam', array('title'=>'Agregar Equipos'),array("js/jquery-ui.js","js/file_js.js"),array("css/ui-lightness/jquery-ui-1.8.16.custom.css"));
    }
    
    
    public function searchUsers(){
        
        $search_fin[1]=array("resp"=>"0");
        
     $auth=session::get("autenticado");
      
      
      if(!empty($auth)){
        
        if(isset($_POST["valor"]) and $_POST["valor"]=="1"){
            
            
            
          
          if(!$this->_view->valid_form->mandatory($_POST["search"])){
            unset($search_fin);
            $search_fin[1]=array("resp"=>"0");     
            
          }else{  
            unset($search_fin);
            $palabra=$_POST["search"];
            //$search_query=$this->_search->search('luos_post','*',array(),array("WHERE title_post LIKE '%$palabra%' OR content_post LIKE '%$palabra%' "=>" "),' title_post ',''.$inicio.',10');
            $search=$this->_admin->search('mvc_perfiles','*',array(),array('WHERE nombres LIKE  '=>' "%'.$palabra.'%"',' OR apellidos LIKE '=>' "%'.$palabra.'%"', ' OR identificacion LIKE '=>' "%'.$palabra.'%"' ));
            $i=0;
            foreach($search as $key=>$value){
                $i++;
                $search_fin[$i]=array('resp'=>'1','id'=>$value["id"],'nombres'=>$this->_view->methods->cutWord($value["nombres"],"23"),'apellidos'=>$this->_view->methods->cutWord($value["apellidos"],"23"),'identificacion'=>$value["identificacion"]);
                
            }
          
          }        
            
            //$search=array('id'=>$search[0]["id"],'nombres'=>$search[0]["nombres"],'apellidos'=>$search[0]["apellidos"]);
            
            
            print_r(json_encode($search_fin));
            
        }else{
            
            if(isset($_POST["valor"]) and $_POST["valor"]=="2"){
                
                
                
            }
            
        }
        
      }else{
       
       $search_fin[0]=array("resp"=>"2"); 
        
      }  
        
    }
    
    public function register_team(){
        print_r($_POST);
        if(isset($_POST["valor"]) and $_POST["valor"]=="1"){
            
            if(!$this->_view->valid_form->mandatory($_POST["inp21"]) or !$this->_view->valid_form->mandatory($_POST["inp22"])){
                
                $resp=array("resp"=>"2");
                
            }else{
            
                if(!$this->_view->valid_form->mandatory($_POST["inp1"]) or !$this->_view->valid_form->mandatory($_POST["inp2"]) or !$this->_view->valid_form->mandatory($_POST["inp3"]) or !$this->_view->valid_form->mandatory($_POST["inp4"]) or !$this->_view->valid_form->mandatory($_POST["inp5"]) or !$this->_view->valid_form->mandatory($_POST["inp6"]) or !$this->_view->valid_form->mandatory($_POST["inp7"]) or !$this->_view->valid_form->mandatory($_POST["inp8"]) or !$this->_view->valid_form->mandatory($_POST["inp9"]) or !$this->_view->valid_form->mandatory($_POST["inp10"]) or !$this->_view->valid_form->mandatory($_POST["inp11"]) or !$this->_view->valid_form->mandatory($_POST["inp12"]) or !$this->_view->valid_form->mandatory($_POST["inp13"]) or !$this->_view->valid_form->mandatory($_POST["inp14"]) or !$this->_view->valid_form->mandatory($_POST["inp15"]) or !$this->_view->valid_form->mandatory($_POST["inp16"]) or !$this->_view->valid_form->mandatory($_POST["inp17"]) or !$this->_view->valid_form->mandatory($_POST["inp18"]) or !$this->_view->valid_form->mandatory($_POST["inp19"]) or !$this->_view->valid_form->mandatory($_POST["inp20"])){
                    
                    $resp=array("resp"=>"3");
                    
                }else{
                    
                    $resp=array("resp"=>"1");
                        
                }
                
                
                
            }
            
            
            
            print_r(json_encode($resp));
        }
        
    }
    
    public function last(){
        if(!isset($_SESSION["autenticado"])):
    
            $this->redirect('users/index');
            
          endif;
        /**
         | 
         | realizamos una consulta a la base de datos, y automaticamente pasamos los valores devueltos a la vista correspondiente.
         | @example: $this->_view->data = Indicamos que variable data es lo q pasara a la vista y el contenido de dicha variable es el resultado de la consulta.
         | @example: $this->_home->find = en este punto es donde usaremos la variable instanciada como privada al inicio del archivo, para realizar la consulta.
         | @example: $this->_home->find() = find es una funcion del core el cual te permitira realizar un select en la base de datos
         | @example: $this->_home->find('','',array(),array(),'','')=esta funcion del core recibe hasta 6 parametros,
         |      parametro 1: nombre de la tabla de la base de datos (Obligatorio)
         |      parametro 2: campos a seleccionar por defecto *     (por default es *)
         |      parametro 3: union de tablas con join               (opcional)
         |      parametro 4: where sql                              (opcional)
         |      parametro 5: campo por el cual ordenar, order by    (opcional)
         | @example:  (id) 
         |      parametro 6: limite de consulta limit               (opcional)
         | @example: (limit,10)     
        **/
        
        $hoy=date("y/m/d");
        
        
        if($_SESSION["level"]=="1"){
        $this->_view->data=$this->_citas->find('visitas','visitas.id as id_visita,visitas.id_medico,visitas.id_paciente,visitas.hora_inicio,visitas.estado,visitas.fecha,pacientes.id,pacientes.nombres as nombre_paciente,pacientes.apellidos as apellido_paciente,medicos.id,medicos.nombres as nombre_medico,medicos.apellidos as apellido_medico ',array('LEFT OUTER JOIN medicos ON visitas.id_medico '=>' medicos.id',' LEFT OUTER JOIN pacientes ON visitas.id_paciente '=>' pacientes.id'),array("WHERE fecha < "=>$hoy),'','',false);    
        }else{
            if($_SESSION["level"]=="2"){
            $this->_view->data=$this->_citas->find('visitas','visitas.id as id_visita,visitas.id_medico,visitas.id_paciente,visitas.hora_inicio,visitas.estado,visitas.fecha,pacientes.id,pacientes.nombres as nombre_paciente,pacientes.apellidos as apellido_paciente,medicos.id,medicos.nombres as nombre_medico,medicos.apellidos as apellido_medico ',array('LEFT OUTER JOIN medicos ON visitas.id_medico '=>' medicos.id',' LEFT OUTER JOIN pacientes ON visitas.id_paciente '=>' pacientes.id'),array("WHERE fecha < "=>$hoy," and medicos.id_usuario ="=>$_SESSION["user_id_session"]),'','',false);    
            }else{
            $this->_view->data=$this->_citas->find('visitas','visitas.id as id_visita,visitas.id_medico,visitas.id_paciente,visitas.hora_inicio,visitas.estado,visitas.fecha,pacientes.id,pacientes.nombres as nombre_paciente,pacientes.apellidos as apellido_paciente,medicos.id,medicos.nombres as nombre_medico,medicos.apellidos as apellido_medico ',array('LEFT OUTER JOIN medicos ON visitas.id_medico '=>' medicos.id',' LEFT OUTER JOIN pacientes ON visitas.id_paciente '=>' pacientes.id'),array("WHERE fecha < "=>$hoy," and pacientes.id_usuario ="=>$_SESSION["user_id_session"]),'','',false);    
            }
            
                
        }
        
        
        /**
         |  call the render method which we call the hearing to which he desired to pass parameters
         |  llamamos a el metodo render el cual nos llamara la vista a la cual se le pasara los parametros deseados
         |  render recibe dos parametros,
         |      1. el nombre de el archivo que se ha creado en vistas
         |      2. un array con parametros a pasar al layout header, es opcional
         |      3. un array con archivos js que queramos cargar unicamente en esta vista, es recomendable usar este parametro unicamente si deseas cargar dicho archivo en esta unica vista ó cuando requieres cargar ciertos archivos en ciertas vistas
         |      4. un array con archivos css que queramos cargar unicamente en esta vista, es recomendable usar este parametro unicamente si deseas cargar dicho archivo en esta unica vista ó cuando requieres cargar ciertos archivos en ciertas vistas
         |      @example: title=>'titulo', keyword=>'keyword'
        **/
        
        $this->_view->render('last', array('title'=>'Citas Actuales'));
    }
    
    public function next(){
         if(!isset($_SESSION["autenticado"])):
    
            $this->redirect('users/index');
            
          endif;
        /**
         | 
         | realizamos una consulta a la base de datos, y automaticamente pasamos los valores devueltos a la vista correspondiente.
         | @example: $this->_view->data = Indicamos que variable data es lo q pasara a la vista y el contenido de dicha variable es el resultado de la consulta.
         | @example: $this->_home->find = en este punto es donde usaremos la variable instanciada como privada al inicio del archivo, para realizar la consulta.
         | @example: $this->_home->find() = find es una funcion del core el cual te permitira realizar un select en la base de datos
         | @example: $this->_home->find('','',array(),array(),'','')=esta funcion del core recibe hasta 6 parametros,
         |      parametro 1: nombre de la tabla de la base de datos (Obligatorio)
         |      parametro 2: campos a seleccionar por defecto *     (por default es *)
         |      parametro 3: union de tablas con join               (opcional)
         |      parametro 4: where sql                              (opcional)
         |      parametro 5: campo por el cual ordenar, order by    (opcional)
         | @example:  (id) 
         |      parametro 6: limite de consulta limit               (opcional)
         | @example: (limit,10)     
        **/
        
        $hoy=date("y/m/d");
        
        
        if($_SESSION["level"]=="1"){
        $this->_view->data=$this->_citas->find('visitas','visitas.id as id_visita,visitas.id_medico,visitas.id_paciente,visitas.hora_inicio,visitas.estado,visitas.fecha,pacientes.id,pacientes.nombres as nombre_paciente,pacientes.apellidos as apellido_paciente,medicos.id,medicos.nombres as nombre_medico,medicos.apellidos as apellido_medico ',array('LEFT OUTER JOIN medicos ON visitas.id_medico '=>' medicos.id',' LEFT OUTER JOIN pacientes ON visitas.id_paciente '=>' pacientes.id'),array("WHERE fecha > "=>$hoy),'','',false);    
        }else{
            if($_SESSION["level"]=="2"){
            $this->_view->data=$this->_citas->find('visitas','visitas.id as id_visita,visitas.id_medico,visitas.id_paciente,visitas.hora_inicio,visitas.estado,visitas.fecha,pacientes.id,pacientes.nombres as nombre_paciente,pacientes.apellidos as apellido_paciente,medicos.id,medicos.nombres as nombre_medico,medicos.apellidos as apellido_medico ',array('LEFT OUTER JOIN medicos ON visitas.id_medico '=>' medicos.id',' LEFT OUTER JOIN pacientes ON visitas.id_paciente '=>' pacientes.id'),array("WHERE fecha > "=>$hoy," and medicos.id_usuario ="=>$_SESSION["user_id_session"]),'','',false);    
            }else{
            $this->_view->data=$this->_citas->find('visitas','visitas.id as id_visita,visitas.id_medico,visitas.id_paciente,visitas.hora_inicio,visitas.estado,visitas.fecha,pacientes.id,pacientes.nombres as nombre_paciente,pacientes.apellidos as apellido_paciente,medicos.id,medicos.nombres as nombre_medico,medicos.apellidos as apellido_medico ',array('LEFT OUTER JOIN medicos ON visitas.id_medico '=>' medicos.id',' LEFT OUTER JOIN pacientes ON visitas.id_paciente '=>' pacientes.id'),array("WHERE fecha > "=>$hoy," and pacientes.id_usuario ="=>$_SESSION["user_id_session"]),'','',false);    
            }
            
                
        }
        
        /**
         |  call the render method which we call the hearing to which he desired to pass parameters
         |  llamamos a el metodo render el cual nos llamara la vista a la cual se le pasara los parametros deseados
         |  render recibe dos parametros,
         |      1. el nombre de el archivo que se ha creado en vistas
         |      2. un array con parametros a pasar al layout header, es opcional
         |      3. un array con archivos js que queramos cargar unicamente en esta vista, es recomendable usar este parametro unicamente si deseas cargar dicho archivo en esta unica vista ó cuando requieres cargar ciertos archivos en ciertas vistas
         |      4. un array con archivos css que queramos cargar unicamente en esta vista, es recomendable usar este parametro unicamente si deseas cargar dicho archivo en esta unica vista ó cuando requieres cargar ciertos archivos en ciertas vistas
         |      @example: title=>'titulo', keyword=>'keyword'
        **/
        
        $this->_view->render('last', array('title'=>'Citas Actuales'));
    }
    
    
     public function addMedico(){
        
        $this->_view->tipo=$this->_citas->find('especialidades','*',array(),array());
        
        if(isset($_POST["valid"])):
            
             if(!$this->_view->valid_form->mandatory($_POST["nombres"])){
                
                $this->_view->messageError="Ingresa  Nombre(s)";
                $this->_view->render('addmedic',array('title'=>'Registro'));
                exit;
            }
            
            if(!$this->_view->valid_form->mandatory($_POST["apellidos"])){
                
                $this->_view->messageError="Ingresa Apellido(s)";
                $this->_view->render('addmedic',array('title'=>'Registro'));
                exit;
            }
            
            
            
            if(!$this->_view->valid_form->is_numeric($_POST["identificacion"])){
                
                $this->_view->messageError="La Identificacion debe ser Numero";
                $this->_view->render('addmedic',array('title'=>'Registro'));
                exit;
            }
            
            if(!$this->_view->valid_form->is_numeric($_POST["telefono"])){
                
                $this->_view->messageError="Ingresa Un Numero  Telefonico";
                $this->_view->render('addmedic',array('title'=>'Registro'));
                exit;
            }
            
            if(!$this->_view->valid_form->is_email($_POST["email"])){
                
                $this->_view->messageError="Ingresa Un Correo Valido";
                $this->_view->render('addmedic',array('title'=>'Registro'));
                exit;
            }
            
            if(!$this->_view->valid_form->mandatory($_POST["tipo"])){
                
                $this->_view->messageError="Selecciona una especialidad";
                $this->_view->render('addmedic',array('title'=>'Registro'));
                exit;
            }
            
            
            if(!$this->_view->valid_form->mandatory($_POST["pass"])){
                
                $this->_view->messageError="Ingresa Un Password";
                $this->_view->render('addmedic',array('title'=>'Registro'));
                exit;
            }
            
            if(!$this->_view->valid_form->min_length($_POST["pass"],"6")){
                
                $this->_view->messageError="Minimo 6 Digitos";
                $this->_view->render('addmedic',array('title'=>'Registro'));
                exit;
            }
            
            if(!$this->_view->valid_form->mandatory($_POST["rpass"])){
                
                $this->_view->messageError="Repite el Password";
                $this->_view->render('addmedic',array('title'=>'Registro'));
                exit;
            }
            
            
            
            if(!$this->_view->valid_form->compare($_POST["pass"],$_POST["rpass"])){
                
                $this->_view->messageError="Password no concuerda";
                $this->_view->render('addmedic',array('title'=>'Registro'));
                exit;
            }
            //is_email
            
            if(count($this->_citas->find('usuarios,medicos,pacientes,admin','*',array(),array('WHERE usuarios.user ='=>$_POST["identificacion"]," Or medicos.email ="=>$_POST["email"]," Or pacientes.email ="=>$_POST["email"]," Or pacientes.email ="=>$_POST["email"] )))==0):
            
                $usuarios=array("user"=>$_POST["identificacion"],"pass"=>base64_encode($_POST["pass"]),"privilegio"=>"2","estado"=>"1");
                
                if($this->_citas->add('usuarios',$usuarios)):
                $_POST["fecha"]="now()";
                $select_usuario=$this->_citas->find('usuarios','*',array(),array('WHERE user='=>$_POST["identificacion"]));
                $datos=array("nombres"=>$_POST["nombres"],"apellidos"=>$_POST["apellidos"],"telefono"=>$_POST["telefono"],"email"=>$_POST["email"],"identificacion"=>$_POST["identificacion"],"especialidad"=>$_POST["tipo"],"fecha_ingreso"=>$_POST["fecha"],"id_usuario"=>$select_usuario[0]["id"]);
                $this->_citas->add('medicos',$datos);
                
                $this->JsMessage("Has sido Registrado Exitosamente",BASE_URL.'citas/index.html');    
                endif;
            
            else:
                unset($_POST);
                $this->_view->messageError="Usuario ya Existe";
                $this->_view->render('addmedic',array('title'=>'Registro'));
            
            endif;
            
        endif;
        
        
        
        if(isset($_POST["valid_ajax"])):
            
             if(!$this->_view->valid_form->mandatory($_POST["nombres"])){
                
                echo "1";
                
                exit;
            }
            
            if(!$this->_view->valid_form->mandatory($_POST["apellidos"])){
                
                echo "2";
                
                exit;
            }
            
            
            
            if(empty($_POST["identificacion"]) or !$this->_view->valid_form->is_numeric($_POST["identificacion"])){
                
                echo "3";
                
                exit;
            }
            
            if(empty($_POST["telefono"]) or !$this->_view->valid_form->is_numeric($_POST["telefono"])){
                
                echo "4";
               
                exit;
            }
            
            if(!$this->_view->valid_form->is_email($_POST["email"])){
                
                echo "5";
                
                exit;
            }
            
            if(!$this->_view->valid_form->mandatory($_POST["tipo"])){
                
                echo "6";
                
                exit;
            }
            
            
            if(!$this->_view->valid_form->mandatory($_POST["pass"])){
                
                echo "7";
                
                exit;
            }
            
            if(!$this->_view->valid_form->min_length($_POST["pass"],"6")){
                
                echo "8";
                
                exit;
            }
            
            if(!$this->_view->valid_form->mandatory($_POST["rpass"])){
                
                echo "9";
                
                exit;
            }
            
            
            
            if(!$this->_view->valid_form->compare($_POST["pass"],$_POST["rpass"])){
                
                echo "10";
                
                exit;
            }
            //is_email
            
            if(count($this->_citas->find('usuarios,medicos,pacientes,admin','*',array(),array('WHERE usuarios.user ='=>$_POST["identificacion"]," Or medicos.email ="=>$_POST["email"]," Or pacientes.email ="=>$_POST["email"]," Or pacientes.email ="=>$_POST["email"] )))==0):
            
                $usuarios=array("user"=>$_POST["identificacion"],"pass"=>base64_encode($_POST["pass"]),"privilegio"=>"2","estado"=>"1");
                
                if($this->_citas->add('usuarios',$usuarios)):
                $_POST["fecha"]="now()";
                $select_usuario=$this->_citas->find('usuarios','*',array(),array('WHERE user='=>$_POST["identificacion"]));
                $datos=array("nombres"=>$_POST["nombres"],"apellidos"=>$_POST["apellidos"],"telefono"=>$_POST["telefono"],"email"=>$_POST["email"],"identificacion"=>$_POST["identificacion"],"especialidad"=>$_POST["tipo"],"fecha_ingreso"=>$_POST["fecha"],"id_usuario"=>$select_usuario[0]["id"]);
                $this->_citas->add('medicos',$datos);
                
                echo "11";  
                exit;  
                endif;
            
            else:
                unset($_POST);
                echo "12";
                exit;
            
            endif;
            
        endif;
        
        
        $this->_view->render('addmedic',array("title"=>"Registro de Medico"),array("js/jquery-ui.js","js/file_js.js"),array("css/ui-lightness/jquery-ui-1.8.16.custom.css"));
        
    }
    
    public function changeData(){
        
        
        
        if(isset($_POST["valid"])){
          
          if(!$this->_view->valid_form->mandatory($_POST["pass"])){
                
                $this->_view->messageError="Ingresa Un Password";
                $this->_view->render('changeData',array('title'=>'Cambio de dato'));
                exit;
            }
            
            if(!$this->_view->valid_form->min_length($_POST["pass"],"6")){
                
                $this->_view->messageError="Minimo 6 Digitos";
                $this->_view->render('changeData',array('title'=>'Cambio de dato'));
                exit;
            }
            
            if(!$this->_view->valid_form->mandatory($_POST["rpass"])){
                
                $this->_view->messageError="Repite el Password";
                $this->_view->render('changeData',array('title'=>'Cambio de dato'));
                exit;
            }
            
            
            
            if(!$this->_view->valid_form->compare($_POST["pass"],$_POST["rpass"])){
                
                $this->_view->messageError="Password no concuerda";
                $this->_view->render('changeData',array('title'=>'Cambio de dato'));
                exit;
            }
            
            $data=array("id"=>$_SESSION["user_id_session"],"pass"=>base64_encode($_POST["pass"]));
            if($this->_citas->update('usuarios',$data)){
                $this->_view->messageOk="Actualizado con Exito";
                $this->_view->render('changeData',array('title'=>'Cambio de dato'));
                exit;
            }else{
                $this->_view->messageError="Error al Actualizar los datos";
                $this->_view->render('changeData',array('title'=>'Cambio de dato'));
                exit;
            }
            
        }
        
        
        if(isset($_POST["valid_ajax"])){
          
          if(!$this->_view->valid_form->mandatory($_POST["pass"])){
                
                echo "1";
                
                exit;
            }
            
            if(!$this->_view->valid_form->min_length($_POST["pass"],"6")){
                
                echo "2";
                
                exit;
            }
            
            if(!$this->_view->valid_form->mandatory($_POST["rpass"])){
                
                echo "3";
                
                exit;
            }
            
            
            
            if(!$this->_view->valid_form->compare($_POST["pass"],$_POST["rpass"])){
                
                echo "4";
                
                exit;
            }
            
            $data=array("id"=>$_SESSION["user_id_session"],"pass"=>base64_encode($_POST["pass"]));
            if($this->_citas->update('usuarios',$data)){
                
                echo "5";
                
                exit;
            }else{
                
                echo "6";
                
                exit;
            }
            
        }
        
        if(isset($_POST["valid2"])){
            
            if(!$this->_view->valid_form->mandatory($_POST["name"])){
                
                $this->_view->messageError="Ingresa Nombre(s)";
                $this->_view->render('changeData',array('title'=>'Cambio de dato'));
                exit;
            }
            
            if(!$this->_view->valid_form->mandatory($_POST["apelli"])){
                
                $this->_view->messageError="Ingresa Apellido(s)";
                $this->_view->render('changeData',array('title'=>'Cambio de dato'));
                exit;
            }
            
            if( !$this->_view->valid_form->is_numeric($_POST["tel"])){
                
                $this->_view->messageError="Ingresa un telefono valido";
                $this->_view->render('changeData',array('title'=>'Cambio de dato'));
                exit;
            }
            
            if(!$this->_view->valid_form->is_email($_POST["email"])){
                
                $this->_view->messageError="Ingresa un email valido";
                $this->_view->render('changeData',array('title'=>'Cambio de dato'));
                exit;
            }
            
            $userTipo=$this->_citas->find('usuarios','id,privilegio',array(),array('where id='=>$_SESSION["user_id_session"]));
            
            /*if($userTipo[0]["privilegio"]=="1"){
           
                $search=$this->_citas->find('admin','*',array(),array('WHERE admin.email ='=>$_POST["email"]," and admin.id_usuario="=>$_SESSION["user_id_session"]));
                
            }else{
                if($userTipo[0]["privilegio"]=="2"){
                    
                    $search=$this->_citas->find('medicos','*',array(),array('WHERE medicos.email ='=>$_POST["email"]," and medicos.id_usuario="=>$_SESSION["user_id_session"]));
                    
                }else{
                    if($userTipo[0]["privilegio"]=="3"){
                    
                        $search=$this->_citas->find('pacientes','*',array(),array('WHERE pacientes.email ='=>$_POST["email"]," and pacientes.id_usuario="=>$_SESSION["user_id_session"]));
                        
                    }
                }
            }*/
            
             $search=$this->_citas->find('admin,medicos,pacientes','*',array(),array('WHERE admin.email ='=>$_POST["email"]," and admin.id_usuario="=>$_SESSION["user_id_session"],' or medicos.email ='=>$_POST["email"]," and medicos.id_usuario="=>$_SESSION["user_id_session"],' or pacientes.email ='=>$_POST["email"]," and pacientes.id_usuario="=>$_SESSION["user_id_session"]));
            
            
            if(count($search)==0){
                
                $this->_view->messageError="Este correo ya existe";
                $this->_view->render('changeData',array('title'=>'Cambio de dato'));
                exit;
                
            }
            
            if($userTipo[0]["privilegio"]=="1"){
            
                $idUser=$this->_citas->find('admin','id_usuario,id',array(),array('where id_usuario ='=>$_SESSION["user_id_session"]));    
            
            }else{
                
                if($userTipo[0]["privilegio"]=="2"){
                
                    $idUser=$this->_citas->find('medicos','id_usuario,id',array(),array('where id_usuario ='=>$_SESSION["user_id_session"]));    
                    
                }else{
                    
                    if($userTipo[0]["privilegio"]=="3"){
                       
                        $idUser=$this->_citas->find('pacientes','id_usuario,id',array(),array('where id_usuario ='=>$_SESSION["user_id_session"]));
                        
                    }
                    
                    
                }
                    
            }
            
            
            
            $data=array("id"=>$idUser[0]["id"],"nombres"=>$_POST["name"],"apellidos"=>$_POST["apelli"],"telefono"=>$_POST["tel"],"email"=>$_POST["email"]);
            
            if($userTipo[0]["privilegio"]=="1"){
           
                if($this->_citas->update('admin',$data)){
                    $this->_view->messageOk="Actualizado con Exito";
                    $this->_view->render('changeData',array('title'=>'Cambio de dato'));
                    exit;
                }else{
                    $this->_view->messageError="Error al Actualizar los datos";
                    $this->_view->render('changeData',array('title'=>'Cambio de dato'));
                    exit;
                }
                
            }else{
                if($userTipo[0]["privilegio"]=="2"){
                    
                    if($this->_citas->update('medicos',$data)){
                        $this->_view->messageOk="Actualizado con Exito";
                        $this->_view->render('changeData',array('title'=>'Cambio de dato'));
                        exit;
                    }else{
                        $this->_view->messageError="Error al Actualizar los datos";
                        $this->_view->render('changeData',array('title'=>'Cambio de dato'));
                        exit;
                    }
                    
                }else{
                    if($userTipo[0]["privilegio"]=="3"){
                    
                        if($this->_citas->update('pacientes',$data)){
                        $this->_view->messageOk="Actualizado con Exito";
                        $this->_view->render('changeData',array('title'=>'Cambio de dato'));
                        exit;
                    }else{
                        $this->_view->messageError="Error al Actualizar los datos";
                        $this->_view->render('changeData',array('title'=>'Cambio de dato'));
                        exit;
                    }
                        
                    }
                }
            }
            
            
            
            
        }
        
        if(isset($_POST["valid2_ajax"])){
            
            if(!$this->_view->valid_form->mandatory($_POST["name"])){
                
                echo "1";
                
                exit;
            }
            
            if(!$this->_view->valid_form->mandatory($_POST["apelli"])){
                
                echo "2";
                
                exit;
            }
            
            if( !$this->_view->valid_form->is_numeric($_POST["tel"])){
                
                echo "3";
                
                exit;
            }
            
            if(!$this->_view->valid_form->is_email($_POST["email"])){
                
                echo "4";
                
                exit;
            }
            
            $userTipo=$this->_citas->find('usuarios','id,privilegio',array(),array('where id='=>$_SESSION["user_id_session"]));
            
            /*if($userTipo[0]["privilegio"]=="1"){
           
                $search=$this->_citas->find('admin','*',array(),array('WHERE admin.email ='=>$_POST["email"]," and admin.id_usuario="=>$_SESSION["user_id_session"]));
                
            }else{
                if($userTipo[0]["privilegio"]=="2"){
                    
                    $search=$this->_citas->find('medicos','*',array(),array('WHERE medicos.email ='=>$_POST["email"]," and medicos.id_usuario="=>$_SESSION["user_id_session"]));
                    
                }else{
                    if($userTipo[0]["privilegio"]=="3"){
                    
                        $search=$this->_citas->find('pacientes','*',array(),array('WHERE pacientes.email ='=>$_POST["email"]," and pacientes.id_usuario="=>$_SESSION["user_id_session"]));
                        
                    }
                }
            }*/
            
             $search=$this->_citas->find('admin,medicos,pacientes','*',array(),array('WHERE admin.email ='=>$_POST["email"]," and admin.id_usuario="=>$_SESSION["user_id_session"],' or medicos.email ='=>$_POST["email"]," and medicos.id_usuario="=>$_SESSION["user_id_session"],' or pacientes.email ='=>$_POST["email"]," and pacientes.id_usuario="=>$_SESSION["user_id_session"]));
            
            
            if(count($search)==0){
                
                echo "5";
                
                exit;
                
            }
            
            if($userTipo[0]["privilegio"]=="1"){
            
                $idUser=$this->_citas->find('admin','id_usuario,id',array(),array('where id_usuario ='=>$_SESSION["user_id_session"]));    
            
            }else{
                
                if($userTipo[0]["privilegio"]=="2"){
                
                    $idUser=$this->_citas->find('medicos','id_usuario,id',array(),array('where id_usuario ='=>$_SESSION["user_id_session"]));    
                    
                }else{
                    
                    if($userTipo[0]["privilegio"]=="3"){
                       
                        $idUser=$this->_citas->find('pacientes','id_usuario,id',array(),array('where id_usuario ='=>$_SESSION["user_id_session"]));
                        
                    }
                    
                    
                }
                    
            }
            
            
            
            $data=array("id"=>$idUser[0]["id"],"nombres"=>$_POST["name"],"apellidos"=>$_POST["apelli"],"telefono"=>$_POST["tel"],"email"=>$_POST["email"]);
            
            if($userTipo[0]["privilegio"]=="1"){
           
                if($this->_citas->update('admin',$data)){
                    echo "6";
                
                    exit;
                }else{
                    echo "7";
                
                    exit;
                }
                
            }else{
                if($userTipo[0]["privilegio"]=="2"){
                    
                    if($this->_citas->update('medicos',$data)){
                        echo "8";
                
                        exit;
                    }else{
                        echo "7";
                       
                        exit;
                    }
                    
                }else{
                    if($userTipo[0]["privilegio"]=="3"){
                    
                        if($this->_citas->update('pacientes',$data)){
                        echo "8";
                      
                        exit;
                    }else{
                        echo "7";
                      
                        exit;
                    }
                        
                    }
                }
            }
            
            
            
            
        }
        
        $this->_view->render('changeData',array("title"=>"Cambio de dato"),array("js/jquery-ui.js","js/file_js.js"),array("css/ui-lightness/jquery-ui-1.8.16.custom.css"));
    }
    
    public function specialty(){
        
        $this->_view->data=$this->_citas->find('especialidades','*');
        
        if(isset($_POST["valid"]) and $_POST["valid"]=="ok"){
            
            if(!$this->_view->valid_form->mandatory($_POST["especialidad"])){
               $this->_view->messageError="Campo especialidad esta vacio";
                $this->_view->render('specialty',array("title"=>"Agregar Especialidad"),array("js/jquery-ui.js","js/file_js.js"),array("css/ui-lightness/jquery-ui-1.8.16.custom.css"));
                exit;  
            }
            
            unset($_POST["valid"]);
            
            if($this->_citas->add('especialidades',$_POST,false)){
                $this->_view->data=$this->_citas->find('especialidades','*');
                $this->_view->messageOk="Agregado con Exito";
                $this->_view->render('specialty',array("title"=>"Agregar Especialidad"),array("js/jquery-ui.js","js/file_js.js"),array("css/ui-lightness/jquery-ui-1.8.16.custom.css"));
                exit;
            }else{
                $this->_view->data=$this->_citas->find('especialidades','*');
                $this->_view->messageError="Error al agregar la especialidad";
                $this->_view->render('specialty',array("title"=>"Agregar Especialidad"),array("js/jquery-ui.js","js/file_js.js"),array("css/ui-lightness/jquery-ui-1.8.16.custom.css"));
                exit;
            }
            
        }
        
        $this->_view->render('specialty',array("title"=>"Agregar Especialidad"),array("js/jquery-ui.js","js/file_js.js"),array("css/ui-lightness/jquery-ui-1.8.16.custom.css"));
    }
    
    public function edit_specialty($arg=array()){
        
        $data=$this->_citas->find('especialidades','*',array(),array('WHERE id ='=>$arg[0]));
        
        if(isset($_POST["valid"]) and $_POST["valid"]=="ok"){
            
            unset($_POST["valid"]);
            if($this->_citas->update('especialidades',$_POST,false)){
                $this->redirect('citas/specialty');
            }else{
                $this->_view->data=$data;
                $this->_view->messageError="Error al actualizar la especialidad";
                $this->_view->render('specialty',array("title"=>"Agregar Especialidad"),array("js/jquery-ui.js","js/file_js.js"),array("css/ui-lightness/jquery-ui-1.8.16.custom.css"));
                exit;
            }
            
        }
        
        $this->_view->data=$data;
        
        $this->_view->render('edit_specialty',array('title'=>'Editar especialidad'));
    }
    
    public function delete_specialty($arg=array()){
        if(isset($arg[0]) and is_numeric($arg[0])){
         
            if($this->_citas->delete('especialidades',$arg[0])){
                 $this->redirect('citas/specialty');
            }
        }
    }
    
    public function cargaMedico(){
        $result=$this->_citas->find('medicos','*',array(),array('WHERE especialidad ='=> $_POST["id_dato"]));
        $val=null;
        if(!empty($result)):
            
            foreach($result as $key=>$values){
                $val.="<option value='".$values["id"]."'>".$this->_view->methods->cutWord($values["nombres"]." ".$values["apellidos"],"25")."</option>";        
            }
        
        
        print_r(json_encode($val));
        else:
        $val="<option value='0'>No Hay Medicos Asignados</option>";
        print_r(json_encode($val));
        endif;
    }
    
   
   
    
}

?>