<?php

abstract class libs {
    
    public function  counterVisit(){
        //se requiere el archivo para validar los datos de usuario de bdd para conectar   
    	date_default_timezone_set('Europe/Madrid');
    	$ip = $_SERVER['REMOTE_ADDR'];   
    	$fecha = date("j \d\e\l n \d\e Y");   
    	$hora = date("h:i:s");   
    	$horaun = date("h"); 
    	$minuto=date("i");  
    	$diaun = date("z");   
    	$anioun = date("Y"); 
    	$mes=date("n"); 
    	$segundos = time(); 
    	$can = "3600"; 
    	$resta = $segundos-$can;  
    	//se asignan la variables
        $sql=$this->_blog->find('luos_counter_visit','segundos, ip',array(),array('WHERE segundos >='=>$resta,' AND IP LIKE '=> $ip));
        //$sql = "SELECT segundos, ip "; 
        //$sql.= "FROM ld_contador WHERE segundos >= $resta AND IP LIKE '$ip' "; 
        //$es = mysql_query($sql, Conectar::con()) or die("Error al leer base de datos: ".mysql_error); 
    //se buscan los registros que num de seg mayor a num de seg hace una hora e IP 
    	if(count($sql)>0)   
    	{//no se cuenta la visita
    	  
    	}   
    	else   
    	{   
    	    $datos=array("ip"=>$ip,"fecha"=>$fecha,"hora"=>$hora,"horaun"=>$horaun,"diaun"=>$diaun,"anioun"=>$anioun,"minuto"=>$minuto,"mes"=>$mes,"segundos"=>$segundos);
            $this->_blog->add('luos_counter_visit',$datos);
    		//$sql = "INSERT INTO ld_contador (id, ip, fecha, hora, horaun, diaun, anioun,minuto,mes,segundos) ";   
    	//	$sql.= "VALUES ('','$ip','$fecha','$hora','$horaun','$diaun','$anioun','$minuto','$mes','$segundos')";   
    	//$es = mysql_query($sql,Conectar::con()) or die("Error al grabar un mensaje: ".mysql_error);   
    	}   
   }
   

    
}

?>