<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; ">
<meta charset="UTF-8" />
<title><?php  echo $_layoutParams['param_views']['title']; ?></title>

<script src="<?php echo $_layoutParams['ruta_js']; ?>jquery-1.8.2.min.js"></script>
<script src="<?php echo $_layoutParams['ruta_js']; ?>jquery_placeholder.js"></script>
<link href='http://fonts.googleapis.com/css?family=PT+Sans:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
<link href="<?php echo $_layoutParams['ruta_css']; ?>reset.css" rel="stylesheet" type="text/css" />


<link href="<?php echo $_layoutParams['ruta_css']; ?>sharp.css" rel="stylesheet" type="text/css" />
<script src="http://cdn.jquerytools.org/1.2.7/full/jquery.tools.min.js"></script>

<script type="text/javascript" src="<?php echo BASE_URL."webfile/wysywy"; ?>/nicEdit.js"></script>
	<script type="text/javascript">
		bkLib.onDomLoaded(function() { 
			  
			  new nicEditor({buttonList : ['bold','italic','underline','html','link'],maxHeight : 316}).panelInstance('wysiwy');
			//nicEditors.allTextAreas({buttonList : ['bold','italic','underline','html','link'],maxHeight : 316}) 

		});

		//new nicEditor({buttonList : ['bold','italic','underline','html','image']}).panelInstance('area4');
	</script>



 <?php
    if(isset($fileJs)):
    echo $fileJs;
    endif;
    
    
    if(isset($fileCss)):
    echo $fileCss;
    endif;
 ?>   


</head>

<body>

      <div id="mainContent">
	    