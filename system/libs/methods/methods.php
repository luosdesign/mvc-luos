<?php
/**
 * @author oscalber
 * @copyright 2012
 */
class methods{
    
    private $name = 'Methods';	
	
	public function dateToString($date)
		{
		
		//pasamos año-mes-dia por dia-mes-año
        $patron="([0-9]{2,4})-([0-9]{1,2})-([0-9]{1,2})";
		preg_match('/'.$patron.'/' , $date, $newdate); 

	    $thedate=$newdate[3]."/".$newdate[2]."/".$newdate[1]; 

	    //consultamos que dia es la fecha usando jddayofweek 
	    //cal_to_jd — Convertir un calendario soportado a la Fecha Juliana
	    //JDDayOfWeek — Devuelve el día de la semana
	    //CAL_GREGORIAN es el tipo que se pasa en la funcion jddayofweek
	    $i = strtotime($date);
	    $dias=jddayofweek(cal_to_jd(CAL_GREGORIAN, date("m",$i),date("d",$i), date("Y",$i)) , 0 );


		/*lista de dias en numeros y pasados a letras en español*/
		//$dias=date(w);
		if($dias==1){$dia="Lunes";}if($dias==2){$dia="Martes";}if($dias==3){$dia="Miercoles";}if($dias==4){$dia="Jueves";}if($dias==5){$dia="Viernes";}if($dias==6){$dia="Sabado";}if($dias==0){$dia="Domingo";};  
		//numero dia
		$n_dia=$newdate[3];

		/*lista de meses en numeros y pasados a letras en español*/
		$meses=$newdate[2];
		if($meses==1){$mes="Enero";}if($meses==2){$mes="Febrero";}if($meses==3){$mes="Marzo";}if($meses==4){$mes="Abril";}if($meses==5){$mes="Mayo";}if($meses==6){$mes="Junio";}if($meses==7){$mes="Julio";}if($meses==8){$mes="Agosto";}if($meses==9){$mes="Septiembre";}if($meses==10){$mes="Octubre";}if($meses==11){$mes="Noviembre";}if($meses==12){$mes="Diciembre";};
		
		/*año*/
		$ano=$newdate[1];
		//armamos el string
		$this->fecha_cad=$dia.",".$n_dia." de ".$mes." de ".$ano;
		//returnamos el string
		return $this->fecha_cad;
	}
    
    public function compara_fechas($fecha1,$fecha2)
    {
    if (preg_match("/[0-9]{1,2}\/[0-9]{1,2}\/([0-9][0-9]){1,2}/",$fecha1))
    list($dia1,$mes1,$año1)=split("/",$fecha1);
    if (preg_match("/[0-9]{1,2}-[0-9]{1,2}-([0-9][0-9]){1,2}/",$fecha1))
    list($dia1,$mes1,$año1)=split("-",$fecha1);
    if (preg_match("/[0-9]{1,2}\/[0-9]{1,2}\/([0-9][0-9]){1,2}/",$fecha2))
    list($dia2,$mes2,$año2)=split("/",$fecha2);
    if (preg_match("/[0-9]{1,2}-[0-9]{1,2}-([0-9][0-9]){1,2}/",$fecha2))
    list($dia2,$mes2,$año2)=split("-",$fecha2);
    $dif = mktime(0,0,0,$mes1,$dia1, $año1) - mktime(0,0,0, $mes2,$dia2,$año2);
    return ($dif);
    //devuelve un numero positivo si la primera fecha es mayor que la segunda, uno negativo si la primera es menor que la seguna y 0 si son iguales. Como bono funciona con ambos formatos:
    }
    
     public function cutWord($cadena,$size="10",$final="..."){
        
         $string = substr( $cadena, 0, $size ); 
        
        if(strlen($cadena)>$size){
            $string.=$final;
        }
        
        return $string;
        
    }
    
    public function timeRedirect($time,$redirect){
        
        header( "refresh:$time;url=".$redirect."" );
        
    }
    
    

    
    
}


?>