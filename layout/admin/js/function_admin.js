function search_subcat(url)
{

var search=$(".section[name='cat'] option:selected").val();
	
		
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

						if(datas[0]["resp"]!="0"){

						 $(".section[name='subcat']").html('');  
						 $(".section[name='subcat']").append('<option value="0">Seleccione subcategoria</option>')
						 $.each(datas, function(indice, val){
						   
							$(".section[name='subcat']").append("<option value='"+datas[indice]["idvalor"]+"'>"+datas[indice]["subcategoria"]+"</option>");

						  });
						}else{

							if(datas[0]["resp"]=="0"){
								$(".section[name='subcat']").html('');
								
								$(".section[name='subcat']").append('<option value="0">No hay subcategorias</option>');  		

							}

						     

						}

					},
					timeout: 3000,
					type: "POST"
					});
					
		return false;	
}


function search_products(url)
{

var search=$(".section[name='subcat'] option:selected").val();
	
		
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

						if(datas[0]["resp"]!="0"){

						 $(".section[name='producto']").html('');  
						 $.each(datas, function(indice, val){
						   
							$(".section[name='producto']").append("<option value='"+datas[indice]["idvalor"]+"'>"+datas[indice]["name"]+"</option>");

						  });
						}else{

							if(datas[0]["resp"]=="0"){
								$(".section[name='producto']").html('');
								
								$(".section[name='producto']").append('<option value="0">No hay productos</option>');  		

							}

						     

						}

					},
					timeout: 3000,
					type: "POST"
					});
					
		return false;	
}


function cargaproductos(url,id)
{

var search=id;
	
		
		url=url;
		$.ajax({
					 
					 url: url,
					 data: {"valid":"ok","search":search},
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

						if(datas[0]["resp"]!="0"){

						 $(".section[name='producto']").html('');  
						 $.each(datas, function(indice, val){
						   
							$(".section[name='producto']").append("<option value='"+datas[indice]["idvalor"]+"'>"+datas[indice]["name"]+"</option>");

						  });
						}else{

							if(datas[0]["resp"]=="0"){
								$(".section[name='producto']").html('');
								
								$(".section[name='producto']").append('<option value="0">No hay productos</option>');  		

							}

						     

						}

					},
					timeout: 3000,
					type: "POST"
					});
					
		return false;	
}

