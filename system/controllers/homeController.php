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

class homeController extends Controller{
    /**
     | for possible work in the controller is recommended to create a private variable, this may be the name you want, but by MVC Luos standard will always have _ and followed by the driver man
     | para posibles trabajos en el controlador es recomendable crear una variable privada, esta puede ser el nombre que quieras, pero por estandar de luos MVC siempre tendra _ y seguida del hombre del controlador
    
    **/    
    private $_home;
    
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
        $this->_home = $this->loadModel('home');
         /**
         | call the libraries that currently have MVC Luo, the call is the list of libraries to be loaded into an array
         | llamamos las librerias que actualmente tenga luos MVC, el llamado es la lista de librerias a cargar en un array
        **/
        $this->getLibrary(array("loadJs","methods"));
        $this->getHelper(array("form_helper","html_helper"));
        
        
    }
    
    public function index()
    {
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
        $this->_view->data=$this->_home->find('visitas','*',array('LEFT OUTER JOIN medicos ON visitas.id_medico '=>' medicos.id_medico'),array());
        //$this->_home->counterVisit();
        
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
        
        $this->_view->render('index', array('title'=>'Home'),array("js/file.js","js/file2.js"),array("css/file.css","css/file2.css"));
        
    }
    
    public function add(){
        
        /**
         | se realiza las validaciones ya conocidas.
         | $this->getText: es el llaamado a una funcion del core el cual nos valida si el campo pasado como parametro esta vacio
        **/
        
        if(isset($_POST["valid"])){
            $this->_view->data=$_POST;
            
            if(!$this->getText("title_post")){
                
                $this->_view->messageError="Debes Ingresar un Titulo";
                $this->_view->render('add');
                exit;
            }
            
            if(!$this->getText("content_post")){
                
                $this->_view->messageError="Debes Ingresar un Contenido";
                $this->_view->render('add');
                exit;
            }
            
            
        /**
         | 
         | realizamos una consulta a la base de datos, consulta q es un insert.
         | @example: $this->_view->data = Indicamos que variable data es lo q pasara a la vista y el contenido de dicha variable es el resultado de la consulta.
         | @example: $this->_home->add = en este punto es donde usaremos la variable instanciada como privada al inicio del archivo, para realizar la consulta.
         | @example: $this->_home->add() = find es una funcion del core el cual te permitira realizar un select en la base de datos
         | @example: $this->_home->add('','')=esta funcion del core recibe hasta 3 parametros,
         |      parametro 1: nombre de la tabla de la base de datos (Obligatorio)
         |      parametro 2: array multidimensional de campos del a base de datos y su respectivo valor      (obligatorio)
         |      parametro 3: si deseamos que se efectue un strip_tag a los campos                            (false por defecto)
         | @example:  ($data) 
         
        **/
            $data=array('title_post'=>$_POST["title_post"],'content_post'=>$_POST["content_post"],'post_date'=>'now()');
            
            if( $this->_home->add('default_table',$data )){
          /**
           |validamos si efectivamente se inserto los valoes en la base de datos, si es asi entonces usamos una funcion del core llamada redirect para redireccionar hacia la ubicacion donde se lista los articulos de la base de datos
          
          **/      
                $this->redirect('home/index');
            }else{
          /**
          | si no se inserto pasamos una variable hacia la visata llamada messageError con su contenido, y posteriormente llamamos a la vista
          **/      
                $this->_view->messageError="Error al Agregar";
                $this->_view->render('add',array("title"=>"Agregar"));
            }
            
        }
        
        /**
        | de no exister valor $_POST es por q no se a dado clic en el buton agregar y solo se mostrar los inputs vacios
        **/
        $this->_view->render('add',array("title"=>"Agregar"));
        
    }
    
    public function edit($arg=array()){
        
        $this->_view->data=$this->_home->find('default_table','*',array(),array("WHERE id="=>$arg[0]));
        
        if(isset($_POST["valid"])){
            $this->_view->data=$_POST;
            
            if(!$this->getText("title_post")){
                
                $this->_view->messageError="Debes Ingresar un Titulo";
                $this->_view->render('edit');
                exit;
            }
            
            if(!$this->getText("content_post")){
                
                $this->_view->messageError="Debes Ingresar un Contenido";
                $this->_view->render('edit');
                exit;
            }
            
            /**
         | 
         | realizamos una consulta a la base de datos, consulta q es un update.
         | @example: $this->_view->data = Indicamos que variable data es lo q pasara a la vista esto para llenar los inputs si no pasa la validacion.
         | @example: $this->_home->update = en este punto es donde usaremos la variable instanciada como privada al inicio del archivo, para realizar la consulta.
         | @example: $this->_home->update() = update es una funcion del core el cual te permitira realizar un update en la base de datos
         | @example: $this->_home->update('','')=esta funcion del core recibe 3 parametros,
         |      parametro 1: nombre de la tabla de la base de datos (Obligatorio)
         |      parametro 2: array multidimensional de campos del a base de datos y su respectivo valor      (obligatorio)
         |      parametro 3: si deseamos que se efectue un strip_tag a los campos   (false por defecto)
         | @example:  ($data) 
         
        **/
            
            $data=array('id'=>$_POST["id"],'title_post'=>$_POST["title_post"],'content_post'=>$_POST["content_post"],'post_date'=>'now()');
            if($this->_home->update('default_table',$data)){
            /**
             | redireccionamos donde listamos los articulos
            **/                
                $this->redirect('home/index');
            }else{
            /**
             | si no actualiza nos mostrara un error en la vista q posteriormente renderizamos
            **/ 
                $this->_view->messageError="Error al Agregar";
                $this->_view->render('edit');
            }
            
        }
        
        /**
             | si no existe valor $_POST entonces mostramos los inputs con sus valores correspondientes
         **/ 
        $this->_view->render('edit',array('title'=>'Editar'));
        
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
            if($this->_home->delete('default_table',$arg[0])){
                /**
                 |rediccionamos hacia la pagina donde listamos los articulos
                **/
                 $this->redirect('home/index');
            }
        }
        
    }
    
   
    
}

?>