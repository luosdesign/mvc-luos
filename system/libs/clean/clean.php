<?php
/**
 |-------------------------------------
 |	File clean session BASE FILE		  |
 |-------------------------------------
 |	@package libs
 |	@File clean.php
 |  @class clean	
 |	@version 1.0
 |	@access Dont Touch This File
 |	@copyright LuosDesign.com - 2012
 |  @definition: clean data with strip_tags
 **/
class clean{
    
    public function limpia($var){
	$var = strip_tags($var);
	$malo = array("\\",";","\'","'"); // Aqui poner caracteres no permitidos
	$i=0;$o=count($malo);
	while($i<=$o){
		$var = str_replace($malo[$i],"",$var);
		$i++;
	}
	return $var;
    }
    
}


?>