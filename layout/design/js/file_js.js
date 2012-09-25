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
   
   
   $('#dialogo_mensajes').dialog({

                // Indica si la ventana se abre de forma autom?tica
        
                autoOpen: false,
        
                // Indica si la ventana es modal
        
                modal: true,
        
                // Largo
        
                width: 300,
        
                // Alto
        
                height: 221,
        
                // Creamos los botones
        
                buttons: {
        
                             
        
                    Aceptar: function() {
        
                        // Cerrar ventana de di?logo
        
                       
        
                        $(this).dialog( "close" );
        
                    }
        
         
        
                }
        
            });
   
   
    
});



function search_users(url)
{

var search=$('#search_user').val();
	
		
		url=url;
		$.ajax({
					 
					 url: url,
					 data: {"valor":"1","search":search},
					async:true,
					cache: false,
					
					contentType: "application/x-www-form-urlencoded",
					dataType: "json",
				
					global: true,
					ifModified: false,
					processData:true,
					 beforeSend: function(objeto){
          		  $(".info").css("display", "inline");
       			 },
					success: function(datas) {
					   
							// do something
						//$("#contenido").load(url);
							$(".sortable tbody tr").remove();
                            $(".sortable tbody tr:eq(0)").remove();
                           if(datas[1]["resp"]==0){
                                    
                                    $(".sortable tbody:eq(0)").html("<tr id='tr_men'><td  colspan='4' style='width: 97%;'>No se ha encontrado ningun usuario con el criterio de busqueda agregado.</td></tr>");
                                    
                            }else{
                                
                                if(datas[1]["resp"]==2){
                                    
                                       location.reload();
                                  
                                  }else{
                                    
                                     $.each(datas, function(indice, val){
                                
                                      
                                      if($("#table2").find("#el1_"+datas[indice]["id"]).length=="0"){
                                        
                                        $(".sortable tbody:eq(0)").append("<tr id='antel_"+datas[indice]["id"]+"'><td >"+datas[indice]["identificacion"]+"</td><td>"+datas[indice]["nombres"]+"</td><td>"+datas[indice]["apellidos"]+"</td><td ><a href='javascript:void(0)' onclick='javascript:pasar_team("+datas[indice]["id"]+","+'\"'+datas[indice]["identificacion"]+'\"'+","+'\"'+datas[indice]["nombres"]+'\"'+","+'\"'+datas[indice]["apellidos"]+'\"'+")'>Asignar</a></td></tr>");    
                                         $(".sortable tbody #tr_men").remove();
                                        
                                      }else{
                                        
                                        if($(".sortable tbody #tr_men").length == 0 && $(".sortable tbody tr").length==0 || $(".sortable tbody #tr_men").length == 0 && datas[1]["resp"]==0 || $(".sortable tbody tr").length == 0 && datas[1]["resp"]==0 || $(".sortable tbody #tr_men").length == 0){
                                            
                                            $(".sortable tbody:eq(0)").html("<tr id='tr_men'><td  colspan='4' style='width: 97%;'>Los usuarios en el criterio de busqueda ya estan agregados.</td></tr>");
                                            
                                        }else{
                                            
                                            $(".sortable tbody:eq(0)").html("<tr id='tr_men'><td  colspan='4' style='width: 97%;'>Los usuarios en el criterio de busqueda ya estan agregados.</td></tr>");
                                            
                                        }
                                        
                                        
                                        
                                      } 
                                        
                                        
                                        
                                        
                                  
                                      
                                    
                                      });
                                        
                                     $("#controls").append('<script type="text/javascript">var sorter = new TINY.table.sorter("sorter");sorter.head = "head";sorter.asc = "asc";sorter.desc = "desc";sorter.even = "evenrow";sorter.odd = "oddrow";sorter.evensel = "evenselected";sorter.oddsel = "oddselected";sorter.paginate = true;sorter.currentid = "currentpage";sorter.limitid = "pagelimit"; sorter.init("table",1);</script>');
                                                
                                            
                                        
                                    
                                    
                                  }
                                  
                            }
                            
							//$("#medico_cita").append(datas);
							
						},
					timeout: 3000,
					type: "POST"
					});
					
		return false;	
}

function pasar_team(id,iden,name,apel,url){
        
        
        
        if($("#table2").find("#el1_"+id).length=="0"){
            
          
          if($("#table2 tbody tr").length < "5"){
            
            $("#table2 tbody tr:eq(5)").remove();
            $("#table2 tbody ").append("<tr id='tr_"+id+"'><td> <input type='hidden' name='el0_"+id+"' value='"+id+"' readOnly='readOnly'/>  <input id='el1_"+id+"' type='text' name='el2_"+id+"' value='"+iden+"' readOnly='readOnly'/></td><td><input type='text' name='id='el3_"+id+"'' value='"+name+"' readOnly='readOnly'/></td><td><input type='text' name='id='el4_"+id+"'' value='"+apel+"' readOnly='readOnly'/></td><td id='el4_"+id+"'><a href='javascript:void(0)' onclick='javascript: delete_team("+id+","+'\"'+iden+'\"'+","+'\"'+name+'\"'+","+'\"'+apel+'\"'+") '>Eliminar</a></td></tr>");        
            $("#antel_"+id).css({"display":"none"});
            
          }else{
            
            if($("#table2 tbody tr:eq(5)").length==1){
             
             
                
            }else{
             
             $("#table2 tbody").append("<tr><td  colspan='4' style='width: 97%;'>Solo puedes agregar 5 miembros por equipo</td></tr>");   
                
            }
             
                   
            
          } 
            
                                    
            
            
        }else{
            
            
            
            
        }
        
        //alert(id+iden+name+apel+url);
        
       //$("#table2 tbody tr").remove();                              
       
                                        
     
}

function delete_team(id,iden,name,apel){
    
    $("#table2 tbody tr:eq(5)").remove(); 
    $("#table2 tbody #tr_"+id+"").remove(); 
    $("#antel_"+id+"").css({"display":"table-row"});
    
    if($("#antel_"+id+"").length=="0"){
        
        $(".sortable tbody").append("<tr id='antel_"+id+"'><td >"+iden+"</td><td>"+name+"</td><td>"+apel+"</td><td ><a href='javascript:void(0)' onclick='javascript:pasar_team("+id+","+'\"'+iden+'\"'+","+'\"'+name+'\"'+","+'\"'+apel+'\"'+")'>Asignar</a></td></tr>");
        
    }
    
     
    
    
}

function valid_register_team(url){
    
    if($("#table2 input").length<20){
        
        $("#dialogo_mensajes").dialog({ title: "Alerta!" });
        $("#dialogo_mensajes").dialog("open");
        $("#dialogo_mensajes h6").html("Debes insertar 5 integrantes por equipo");
        
        
    }else{
        
        if($("#table2").length>20){
            $("#dialogo_mensajes").dialog("open");
            $("#dialogo_mensajes h6").html("Debes insertar solo 5 integrantes por equipo");    
            
                
        }else{
            
            if($("#name_team").val()==0){
                
                 $("#dialogo_mensajes").dialog("open");
                 $("#dialogo_mensajes h6").html("Debes agregar un nombre de equipo");
                
            }else{
                
                if($("#campeonato").val()==0 ){
                    
                     $("#dialogo_mensajes").dialog("open");
                     $("#dialogo_mensajes h6").html("Debes seleccionar un campeonato"); 
                    
                }else{
                    
                    
                    	url=url;
                		$.ajax({
                					 
                					 url: url,
                					 data: {"valor":"1","inp1":$("#table2 input:eq(0)").val(),"inp2":$("#table2 input:eq(1)").val(),"inp3":$("#table2 input:eq(2)").val(),"inp4":$("#table2 input:eq(3)").val(),"inp5":$("#table2 input:eq(4)").val(),"inp6":$("#table2 input:eq(5)").val(),"inp7":$("#table2 input:eq(6)").val(),"inp8":$("#table2 input:eq(7)").val(),"inp9":$("#table2 input:eq(8)").val(),"inp10":$("#table2 input:eq(9)").val(),"inp11":$("#table2 input:eq(10)").val(),"inp12":$("#table2 input:eq(11)").val(),"inp13":$("#table2 input:eq(12)").val(),"inp14":$("#table2 input:eq(13)").val(),"inp15":$("#table2 input:eq(14)").val(),"inp16":$("#table2 input:eq(15)").val(),"inp17":$("#table2 input:eq(16)").val(),"inp18":$("#table2 input:eq(17)").val(),"inp19":$("#table2 input:eq(18)").val(),"inp20":$("#table2 input:eq(19)").val(),"inp21":$("#name_team").val(),"inp22":$("#campeonato").val()},
                					async:true,
                					cache: false,
                					
                					contentType: "application/x-www-form-urlencoded",
                					dataType: "json",
                				
                					global: true,
                					ifModified: false,
                					processData:true,
                					 beforeSend: function(objeto){
                          		  $(".info").css("display", "inline");
                       			 },
                					success: function(datas) {
                					   
                						  if(datas["resp"]=="1"){
                						      
                                                $("#dialogo_mensajes").dialog("open");
                                                $("#dialogo_mensajes h6").html("Insertado con exito"); 
                                              
                						  }else{
                						      
                                              if(datas["resp"]=="2"){
                                                
                                                $("#dialogo_mensajes").dialog("open");
                                                $("#dialogo_mensajes h6").html("Los campos nombre de equipo y campeonato son obligatorios");
                                                
                                              }else{
                                                
                                                if(datas["resp"]=="3"){
                                                    
                                                    $("#dialogo_mensajes").dialog("open");
                                                    $("#dialogo_mensajes h6").html("Debes tener seleccionado minimo/maximo 5 integrantes de el equipo");
                                                    
                                                }
                                                
                                              }
                                              
                						  }
                							
                						},
                					timeout: 3000,
                					type: "POST"
                					});
                					
                		return false;	
                    
                    
                    
                    
                }
                
                
            }
            
            
        }
        
    }
    
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