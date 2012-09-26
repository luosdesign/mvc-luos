<?PHP
/************************************************************************

Rar for PHP

Interprete para compresion con WinRar

Autor: José Manuel Busto López
Version: 1.1
Fecha: 20-01-2006
Licencia: Lesser General Public License (LGPL)

Copyright (C) 2006  José Manuel Busto López

This library is free software; you can redistribute it and/or
modify it under the terms of the GNU Lesser General Public
License as published by the Free Software Foundation; either
version 2.1 of the License, or (at your option) any later version.

This library is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
Lesser General Public License for more details.

You should have received a copy of the GNU Lesser General Public
License along with this library; if not, write to the Free Software
Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA

*************************************************************************/


class rarGenerate{
	/* Variables que se deben configurar */
	private $rar="c:\\Archiv~1\\WinRar\\rar.exe"; 		//Localizacion del archivo rar.exe
	private $rarpasswords="";	  		        //Archivo de registro de contraseñas. Vacio para no almacenar la contraseña
	private $defaultCompresion="Maximo";			//Nivel de compresión por defecto.
	private $mkSolid=true;					//Crear por defecto un archivo solido.
	private $limiteTiempo=7200;				//Número de segundos que se puede ejecutar el script.
	private $recovery="";
	
	
	
	/* DE AQUI EN ADELANTE NO MODIFICAR*/
	private $filename="";
	private $password="";
	private $solid="";
	private $error=array( 255=>"USER BREAK", 9=> "CREATE ERROR", 8=>"MEMORY ERROR",
						7=>"USER ERROR", 6=> "OPEN ERROR", 5=>"WRITE ERROR",
						4=>"LOCKED ARCHIVE", 3=>"CRC ERROR", 2=>"FATAL ERROR",
						1=>"WARNING" , 0=>"SUCCESS");

	 
	/*******************************************************************************
	**	Constructor de la clase
	**
	**	Params:
	**	@filename: Ruta y nombre del archivo de salida.
	**	@password: Clave de cifrado del archivo de salida (no requerido).
	**
	*******************************************************************************/
	function __construct($filename, $password=''){
		$this->filename=$filename;
		$this->password=$password==''?"":"-hp\"".$password."\"";
		$this->compression($this->defaultCompresion, $this->mkSolid);
	}

	/*******************************************************************************
	**	Añadir archivo al volumen
	**
	**	Params:
	**	@file: Ruta y nombre del archivo a comprimir.
	**
	*******************************************************************************/
	public function addfile($file){
		set_time_limit($this->limiteTiempo);
		if (file_exists($file)){
		$ulLinea=exec("$this->rar a $this->recovery $this->compresion $this->solid $this->password $this->filename $file",$varBin, $retorno);
		if($retorno!=0) echo "<b>ERROR:</b><br/>Codigo de retorno: $retorno - ".$this->error[$retorno]." <br/> Ultima linea de salida: $ulLinea";		
		}
		
	}

	/*******************************************************************************
	**	Añadir carpeta al volumen
	**
	**	Params:
	**	@folder: Ruta y nombre de la carpeta a comprimir.
	**	@recursive: 
	**	  - true: Se comprime el directorio y todos sus subdirectorios (defecto)
	**	  - false: Solo se comprime el directorio indicado
	**
	*******************************************************************************/

	public function addfolder($folder, $recursive=true){
		set_time_limit($this->limiteTiempo);
		if (is_dir($folder)){
			$recur=$recursive? '-r': '';
			$ulLinea=exec("$this->rar a $this->recovery $this->compresion $this->solid $this->password $this->filename $folder $recur", $varBin,$retorno);
		if($retorno!=0) echo "<b>ERROR:</b><br/>Codigo de retorno: $retorno - ".$this->error[$retorno]." <br/> Ultima linea de salida: $ulLinea";
		}
	}

	/*******************************************************************************
	**	Poner contraseña al archivo
	**
	**	Params:
	**	@password: Contraseña del archivo
	**	  - AUTO: Se genera una contraseña y se guarda en el fichero indicado por
	**		  la variable $rarpasswords.(defecto)
	**	  - Otro valor: Contraseña del archivo
	**
	*******************************************************************************/

	public function setPassword($password='AUTO'){
	    if($this->rarpasswords=="") 	$save=false;
	    else						    $save=true;
		$this->more=0;
		$this->space=0;
		if ($password=='AUTO') $this->password="-hp\"".$this->genPass($save)."\"";
		else $this->password="-hp\"".$password."\"";
	}

	/*******************************************************************************
	**	Generar contraseña
	**
	**	Params:
	**	@save: Indica si se guarda la contraseña en un fichero
	**  Devuelve la contraseña generada.
	**	NOTA: La longitud puede variar entre 8 y 32 caracteres.  
	**
	*******************************************************************************/
	private function genPass($save){
	  	mt_srand((double)microtime()*1000000);
	  	$exclude="\"";
	  	$num=mt_rand(8,32);
		for($i=0;$i<$num;$i++){
		    do{
				mt_srand((double)microtime()*1000000);
				$next=chr(mt_rand(0,255));
			}while($next==$exclude);
			$valor[$i]=$next;					  
		}
			$pass=implode("",$valor);
			if ($save){
				$f=fopen($this->rarpasswords, 'a');
				fwrite($f, "Archivo: $this->filename \r\nPassword=$pass \r\n\r\n");
				fclose($f);
			}
			return $pass;
	}
	
	/*******************************************************************************
	**	Obtener la contraseña
	**	Devuelve la contraseña del fichero si existe. En caso contrario NULL
	**
	*******************************************************************************/
	public function getPassword(){
	  	if ($this->password=="") return NULL;
	  	else return substr($this->password, 4,strlen($this->password)-5);
	}
	
	/*******************************************************************************
	**	Nivel de compresion
	**
	**	Params:
	**	@level: Nivel de compresion: NINGUNO, BAJO, MEDIO, NORMAL, ALTO, MAXIMO
	**	@solid: Indica si se desea un archivo solido.
	**  Devuelve la contraseña generada.
	**	
	*******************************************************************************/
	
	public function compression($level, $solid=true){
	   switch(strtoupper($level)){
	     case 'NINGUNO': 	$this->compresion="-m0";
		     				break;
	     case 'BAJO': 		$this->compresion="-m1";
		     			  	break;
		 case 'MEDIO': 		$this->compresion="-m2";
		 					break;
		 case 'NORMAL': 	$this->compresion="-m3";
		 					break;
		 case 'ALTO':		$this->compresion="-m4";
		 				    break;
		 case 'MAXIMO': 	$this->compresion="-m5";
					
		 					break;		 
		}
		if ($solid) $this->solid="-s";
		else	   $this->solid="";	  
	}

	/*******************************************************************************
	**	Datos de recuperación
	**
	**	Params:
	**	@level: % del tamaño del archivo para datos de recuperación (1-10)
	**	
	*******************************************************************************/

	public function setRecovery($level){
		if ($level>10) $level=10;
		if ($level==0) $level=1;
		$this->recovery="-rr".$level."p";
	}

	/*******************************************************************************
	**	Añadir lista de archivos
	**
	**	Params:
	**	@lista: lista de archivos a añadir al volumen. Puede ser un array o una
	**		cadena de caracteres separadas por ";"
	**	
	*******************************************************************************/

	public function addList($lista){
		if (!is_array($lista))
			$lista=explode(";", $lista);		
		for($i=0; $i<count($lista); $i++)
			$cadena.=trim($lista[$i])."\n";
		$nombre=tempnam(getcwd(), "arc");
		$f=fopen($nombre, 'a');
		fwrite($f, $cadena."\n");
		fclose($f);
		set_time_limit($this->limiteTiempo);
		$ulLinea=exec("$this->rar a $this->recovery $this->compresion $this->solid $this->password $this->filename @$nombre", $varBin,$retorno);
		unlink($nombre);
		if($retorno!=0) echo "<b>ERROR:</b><br/>Codigo de retorno: $retorno - ".$this->error[$retorno]." <br/> Ultima linea de salida: $ulLinea";
	}

	
	
}
?>