jQuery(function($){

});    

$(document).ready(function() {
   
   	$.datepicker.regional['es'] = {
		closeText: 'Cerrar',
		prevText: '&#x3c;Ant',
		nextText: 'Sig&#x3e;',
		currentText: 'Hoy',
		monthNames: ['Enero','Febrero','Marzo','Abril','Mayo','Junio',
		'Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],
		monthNamesShort: ['Ene','Feb','Mar','Abr','May','Jun',
		'Jul','Ago','Sep','Oct','Nov','Dic'],
		dayNames: ['Domingo','Lunes','Martes','Mi&eacute;rcoles','Jueves','Viernes','S&aacute;bado'],
		dayNamesShort: ['Dom','Lun','Mar','Mi&eacute;','Juv','Vie','S&aacute;b'],
		dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','S&aacute;'],
		weekHeader: 'Sm',
		dateFormat: 'yy-mm-dd',
		firstDay: 1,
		isRTL: false,
		showMonthAfterYear: false,
		yearSuffix: ''};
	$.datepicker.setDefaults($.datepicker.regional['es']);
   
   $(".datepicker").datepicker();
   
   
   
    
});


function carga_combo(url,id_dato)
{

	
		
		url=url;
		$.ajax({
					 
					 url: url,
					 data: {"valor":"1","id_dato":id_dato},
					async:true,
					cache: false,
					
					contentType: "application/x-www-form-urlencoded",
					dataType: "json",
					error: function(objeto, quepaso, otroobj){
						alert("Estas viendo esto por que fallé");
						alert("Pasó lo siguiente: "+quepaso);
					},
					global: true,
					ifModified: false,
					processData:true,
					 beforeSend: function(objeto){
          		  $(".info").css("display", "inline");
       			 },
					success: function(datas) {
							// do something
						//$("#contenido").load(url);
							$("#medico_cita").html('');
							$("#medico_cita").append(datas);
							
						},
					timeout: 3000,
					type: "POST"
					});
					
		return false;	
}


function validar_add(){
    
    if($("#tipo_cita").val()==0){
        $(".msn_error").html("Selecciona un Tipo de Cita");
        
        return false;
        
    }else{
        
        if($("#medico_cita").val()==0){
        $(".msn_error").html("Selecciona un Medico");
        return false;
        
        }else{
            
             if($("#hora_cita").val()==0){
                $(".msn_error").html("Selecciona una Hora");
                return false;
            
            }else{
                
                if($("#fecha").val()==0){
                $(".msn_error").html("Selecciona una Fecha");
                return false;
            
                }else{
                    $("#form_add").submit();
                }
                
            }
               
        }   
           
    }
    
}

function change_pass(url,layout){
        
        $(".msn_resp:eq(0)").html("<img src='"+url+"layout/"+layout+"/img/loading.gif"+"' />");
    	url=url+"citas/changeData.html";
        	
		$.ajax({
					 
					 url: url,
					 data: {"valid_ajax":"ok","pass":$("#pass").val(),"rpass":$("#rpass").val()},
					async:true,
					cache: false,
					
					contentType: "application/x-www-form-urlencoded",
					dataType: "html",
					error: function(objeto, quepaso, otroobj){
					   $(".msn_resp:eq(0)").html('Hubo un error en la peticion, recarga la pagina, porfavor');						
						
					},
					global: true,
					ifModified: false,
					processData:true,
					
					success: function(datas) {
					   
                            if(datas==1){
                                $(".msn_resp:eq(0)").html("Ingresa Un Password");
                                $("input[name=pass]").focus();
                                return false;    
                            }
                            
                            if(datas==2){
                                $(".msn_resp:eq(0)").html("Minimo 6 Digitos");
                                $("input[name=pass]").focus();
                                return false;
                                
                            }
                            
                            if(datas==3){
                                $(".msn_resp:eq(0)").html("Repite el Password");
                                $("input[name=rpass]").focus();
                                return false;
                                
                            }
                            
                            if(datas==4){
                                $(".msn_resp:eq(0)").html("Password no concuerda");
                                $("input[name=pass]").focus();
                                $("input[name=pass]").val("");
                                $("input[name=rpass]").val("");
                                return false;
                                
                            }
                            
                            if(datas==5){
                                $(".msn_resp:eq(0)").html("Actualizado con Exito");
                                $("input[name=pass]").focus();
                                $("input[name=pass]").val("");
                                $("input[name=rpass]").val("");
                                return false;
                                
                            }
                            
                            if(datas==6){
                                $(".msn_resp:eq(0)").html("Error al Actualizar los datos");
                                $("input[name=pass]").focus();
                                $("input[name=pass]").val("");
                                $("input[name=rpass]").val("");
                                return false;
                                
                            }
							
							
						},
					timeout: 3000,
					type: "POST"
					});
					
		return false;	
    
    
}
      
            
function change_data(url,layout){
        
        $(".msn_resp:eq(1)").html("<img src='"+url+"layout/"+layout+"/img/loading.gif"+"' />");
    	url=url+"citas/changeData.html";
        	
		$.ajax({
					 
					 url: url,
					 data: {"valid2_ajax":"ok","name":$("input[name=name]").val(),"apelli":$("input[name=apelli]").val(),"tel":$("input[name=tel]").val(),"email":$("input[name=email]").val()},
					async:true,
					cache: false,
					
					contentType: "application/x-www-form-urlencoded",
					dataType: "html",
					error: function(objeto, quepaso, otroobj){
					   $(".msn_resp:eq(1)").html('Hubo un error en la peticion, recarga la pagina, porfavor');						
						
					},
					global: true,
					ifModified: false,
					processData:true,
					
					success: function(datas) {
					   
                            if(datas==1){
                                $(".msn_resp:eq(1)").html("Ingresa Nombre(s)");
                                $("input[name=name]").focus();
                                return false;    
                            }
                            
                            if(datas==2){
                                $(".msn_resp:eq(1)").html("Ingresa Apellido(s)");
                                $("input[name=apelli]").focus();
                                return false;
                                
                            }
                            
                            if(datas==3){
                                $(".msn_resp:eq(1)").html("Ingresa un telefono valido");
                                $("input[name=tel]").focus();
                                $("input[name=tel]").val("");
                                return false;
                                
                            }
                            
                            if(datas==4){
                                $(".msn_resp:eq(1)").html("Ingresa un email valido");
                                $("input[name=email]").focus();
                                $("input[name=email]").val("");
                                return false;
                                
                            }
                            
                            if(datas==5){
                                $(".msn_resp:eq(1)").html("Este correo ya existe");
                                $("input[name=email]").focus();
                                $("input[name=email]").val("");
                        
                                return false;
                                
                            }
                            
                            if(datas==6){
                                $(".msn_resp:eq(1)").html("Actualizado con Exito");
                                $("input[name=name]").focus();
                                $("input[name=apelli]").val("");
                                $("input[name=tel]").val("");
                                $("input[name=name]").val("");
                                $("input[name=email]").val("");
                                
                                return false;
                                
                            }
							
							if(datas==7){
                                $(".msn_resp:eq(1)").html("Error al Actualizar los datos");
                                $("input[name=name]").focus();
                                $("input[name=apelli]").val("");
                                $("input[name=tel]").val("");
                                $("input[name=name]").val("");
                                $("input[name=email]").val("");
                                
                                return false;
                                
                            }
                            
                            if(datas==8){
                                $(".msn_resp:eq(1)").html("Actualizado con Exito");
                                $("input[name=name]").focus();
                                location.reload();
                             
                                return false;
                                
                            }
                            
						},
					timeout: 3000,
					type: "POST"
					});
					
		return false;	
    
    
}

function validMedic(url,layout){
        
        $(".msn_resp:eq(0)").html("<img src='"+url+"layout/"+layout+"/img/loading.gif"+"' />");
    	url=url+"citas/addMedico.html";
        	
		$.ajax({
					 
					 url: url,
					 data: {"valid_ajax":"ok","nombres":$("input[name=nombres]").val(),"apellidos":$("input[name=apellidos]").val(),"identificacion":$("input[name=identificacion]").val(),"telefono":$("input[name=telefono]").val(),"email":$("input[name=email]").val(),"tipo":$("#tipo_cita option:selected").val(),"pass":$("input[name=pass]").val(),"rpass":$("input[name=rpass]").val()},
					async:true,
					cache: false,
					
					contentType: "application/x-www-form-urlencoded",
					dataType: "html",
					error: function(objeto, quepaso, otroobj){
					   $(".msn_resp:eq(0)").html('Hubo un error en la peticion, recarga la pagina, porfavor');						
						
					},
					global: true,
					ifModified: false,
					processData:true,
					
					success: function(datas) {
					   
                            if(datas==1){
                                $(".msn_resp:eq(0)").html("Ingresa Nombre(s)");
                                $("input[name=nombres]").focus();
                                return false;    
                            }
                            
                            if(datas==2){
                                $(".msn_resp:eq(0)").html("Ingresa Apellido(s)");
                                $("input[name=apellidos]").focus();
                                return false;
                                
                            }
                            
                            if(datas==3){
                                $(".msn_resp:eq(0)").html("La Identificacion debe ser Numero");
                                $("input[name=identificacion]").focus();
                                $("input[name=identificacion]").val("");
                                return false;
                                
                            }
                            
                            if(datas==4){
                                $(".msn_resp:eq(0)").html("Ingresa Un Numero Telefonico");
                                $("input[name=telefono]").focus();
                                
                                return false;
                                
                            }
                            
                            if(datas==5){
                                $(".msn_resp:eq(0)").html("Ingresa Un Correo Valido");
                                $("input[name=email]").focus();
                                $("input[name=email]").val("");
                        
                                return false;
                                
                            }
                            
                            if(datas==6){
                                $(".msn_resp:eq(0)").html("Selecciona una especialidad");
                                $("#tipo_cita").focus();
        
                                
                                return false;
                                
                            }
							
							if(datas==7){
                                $(".msn_resp:eq(0)").html("Ingresa Un Password");
                                $("input[name=pass]").focus();
                                

                                
                                return false;
                                
                            }
                            
                            if(datas==8){
                                $(".msn_resp:eq(0)").html("Minimo 6 Digitos");
                                $("input[name=pass]").focus();
                                $("input[name=pass]").val();
                             
                                return false;
                                
                            }
                            
                            if(datas==9){
                                $(".msn_resp:eq(0)").html("Repite el Password");
                                $("input[name=rpass]").focus();
                                
                             
                                return false;
                                
                            }
                            
                            if(datas==10){
                                $(".msn_resp:eq(0)").html("Password no concuerda");
                                $("input[name=pass]").focus();
                                $("input[name=rpass]").focus();
                                
                             
                                return false;
                                
                            }
                            
                            if(datas==11){
                                $(".msn_resp:eq(0)").html("Has sido Registrado Exitosamente");
                                $("input[name=nombres]").focus();
                                location.reload();
                             
                                return false;
                                
                            }
                            
                            if(datas==12){
                                $(".msn_resp:eq(0)").html("Usuario ya Existe");
                                $("input[name=nombres]").focus();
                                
                             
                                return false;
                                
                            }
                            
						},
					timeout: 3000,
					type: "POST"
					});
					
		return false;	
    
    
}


function validUser(url,layout){
        
        $(".msn_resp:eq(0)").html("<img src='"+url+"layout/"+layout+"/img/loading.gif"+"' />");
    	url=url+"users/addUser.html";
        	
		$.ajax({
					 
					 url: url,
					 data: {"valid_ajax":"ok","usuario":$("input[name=usuario]").val(),"email":$("input[name=email]").val(),"tipo":$("#tipo_cita option:selected").val(),"pass":$("input[name=pass]").val(),"rpass":$("input[name=rpass]").val()},
					async:true,
					cache: false,
					
					contentType: "application/x-www-form-urlencoded",
					dataType: "html",
					error: function(objeto, quepaso, otroobj){
					   $(".msn_resp:eq(0)").html('Hubo un error en la peticion, recarga la pagina, porfavor');						
						
					},
					global: true,
					ifModified: false,
					processData:true,
					
					success: function(datas) {
					   
                            if(datas==1){
                                $(".msn_resp:eq(0)").html("Ingresa Un(s) Documento de Usuario(s)");
                                $("input[name=nombres]").focus();
                                return false;    
                            }
                            
                            if(datas==2){
                                $(".msn_resp:eq(0)").html("Ingresa Un Correo Valido");
                                $("input[name=apellidos]").focus();
                                return false;
                                
                            }
                            
                            if(datas==3){
                                $(".msn_resp:eq(0)").html("Seleccione un tipo de usuario");
                                $("input[name=identificacion]").focus();
                                $("input[name=identificacion]").val("");
                                return false;
                                
                            }
                            
                            if(datas==4){
                                $(".msn_resp:eq(0)").html("Ingresa Un Password");
                                $("input[name=telefono]").focus();
                                
                                return false;
                                
                            }
                            
                            if(datas==5){
                                $(".msn_resp:eq(0)").html("Minimo 6 Digitos");
                                $("input[name=email]").focus();
                                $("input[name=email]").val("");
                        
                                return false;
                                
                            }
                            
                            if(datas==6){
                                $(".msn_resp:eq(0)").html("Repite el Password");
                                $("#tipo_cita").focus();
        
                                
                                return false;
                                
                            }
							
							if(datas==7){
                                $(".msn_resp:eq(0)").html("Password no concuerda");
                                $("input[name=pass]").focus();
                                

                                
                                return false;
                                
                            }
                            
                            if(datas==8){
                                $(".msn_resp:eq(0)").html("Documento ya Existe");
                                $("input[name=pass]").focus();
                                $("input[name=pass]").val();
                             
                                return false;
                                
                            }
                            
                            if(datas==9){
                                $(".msn_resp:eq(0)").html("Usuario Registrado");
                                $("input[name=rpass]").focus();
                                
                             
                                return false;
                                
                            }
                            
                            if(datas==10){
                                $(".msn_resp:eq(0)").html("Usuario ya Existe");
                                $("input[name=pass]").focus();
                                $("input[name=rpass]").focus();
                                
                             
                                return false;
                                
                            }
                            
                           
                            
						},
					timeout: 3000,
					type: "POST"
					});
					
		return false;	
    
    
}