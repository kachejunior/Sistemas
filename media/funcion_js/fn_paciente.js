var mensaje_exito= '<div class="alert alert-success" id="_mensaje"><button type="button" class="close" data-dismiss="alert">×</button><strong>Guardado con Exito!</strong></div>';
var mensaje_error_datos= '<div class="alert alert-error" id="_mensaje"><button type="button" class="close" data-dismiss="alert">×</button><strong>Error al Guardar!</strong> Verifica los datos (La cedula puede ser repetida o faltan campos)</div>';
var tipo_usuario = $('[name=tipo_usuario]').val();
function vacio(q) {  
	for ( i = 0; i < q.length; i++ ){
		if ( q.charAt(i) != " " ){
			return false;
		}
	}
	return true;
}

function limpiar_form(){
	var item = ['[name=cedula]','[name=bandera]','[name=nombre]','[name=apellido]','[name=fecha_nacimiento]','[name=telefono1]', '[name=telefono2]',
		'[name=direccion]','[name=municipio]','[name=parroquia]','[name=fecha_atencion]','[name=n_hijos]','[name=esterilizada]'
	,'[name=fecha_esterilizacion]','[name=observacion]'];

	for( var i=0; i< item.length; i++){
		$(item[i]).val('');
	}
	
	$('#agregado').html('');
}

function verificar(){
	var item =['[name=cedula]', '[name=nombre]','[name=apellido]','[name=fecha_nacimiento]',
		'[name=direccion]','[name=municipio]','[name=parroquia]','[name=telefono1]',
		'[name=fecha_esterilizacion]','[name=observacion]'];
	for( var i=0; i< item.length; i++){
		if (vacio($(item[i]).val())){
			alert('Campos sin completar');
			$(item[i]).focus();
			return false;
		}
	}
	return true;
}

function cargarParroquias(){
	var post = "evento="+$('[name=municipio]').val();
    var url = base_url+'bolivar/get2';
    $.ajax({
        url: url,
        data: post,
        processData: 'false',
		dataType: 'json',
        type: "POST",
        success: function(datos) {
			$('#parroquia').html('');
			for (var i=0; i<datos.length; i++){
				var cadena = '<option value ='+datos[i].id+'>'+datos[i].detalle+'</option>' ;
				$('#parroquia').append(cadena);
				if(!$('#parroquia').is(':visible')){
					$('#parroquia caption').click();
				}
			}
        },
        error: function() {alert('Se ha producido un error');}
    });
    return true;
}

function cargarParroquiasGet(municipio, parroquia){
	var post = "municipio="+municipio;
    var url = base_url+'bolivar/get2';
    $.ajax({
        url: url,
        data: post,
        processData: 'false',
		dataType: 'json',
        type: "POST",
        success: function(datos) {
			$('#parroquia').html('');
			for (var i=0; i<datos.length; i++){
				if(datos[i].id==parroquia){
					var cadena = '<option value ='+datos[i].id+' selected>'+datos[i].detalle+'</option>' ;
					$('#parroquia').append(cadena);	
				}
				else{
				var cadena = '<option value ='+datos[i].id+'>'+datos[i].detalle+'</option>' ;
				$('#parroquia').append(cadena);
				}
				if(!$('#parroquia').is(':visible')){
					$('#parroquia caption').click();
				}
			}
			return true;
        },
        error: function() {alert('Se ha producido un error'); return false;}
    });
    return true;
}

function actualizar(){
    var url = base_url+'paciente/get2';
    $.ajax({
        url: url,
        data: null,
        processData: 'false',
				dataType: 'json',
        type: "POST",
        success: function(datos) {
				$('#tabla tbody').html('');
			for (var i=0; i<datos.length; i++){
				cadena='<tr class="success" style="text-transform: uppercase">';
				if(datos[i].esterilizada=='no')
					cadena='<tr class="info" style="text-transform: uppercase">';
				if(datos[i].esterilizada=='tq')
					cadena='<tr class="warning" style="text-transform: uppercase">';
				cadena +='<td class="centrado">'+(i+1)+'</td>';
				cadena +='<td class="centrado">'+datos[i].cedula+'</td>'+
					'<td>'+datos[i].nombre+' '+datos[i].apellido+'</td>'+
					'<td class="centrado">'+datos[i].fecha_nacimiento+'</td>'+
					'<td class="centrado">'+datos[i].detalle+'</td>'+
					'<td class="centrado">'+datos[i].telefono1+'</td>'+
					'<td class="centrado">'+datos[i].esterilizada+'</td>'+
					'<td class="centrado">';		
				if(tipo_usuario==1)
				{
				cadena +='<a class="btn btn-mini btn-warning" onclick="get(\''+datos[i].cedula+'\')">'+
							   ' <i class="icon-wrench icon-white"></i></a>';
				cadena +=' <a class="btn btn-mini btn-danger" onclick="eliminar(\''+datos[i].cedula+'\')">'+
							    ' <i class="icon-minus icon-white"></i></a>';
				}
				if(tipo_usuario==2)
				{
				cadena +='<a class="btn btn-mini btn-warning" onclick="get(\''+datos[i].cedula+'\')">'+
							   ' <i class="icon-wrench icon-white"></i></a>';
				}
				cadena +=	'</td>'+
				'</tr>';
				$('#tabla tbody').append(cadena);
				if(!$('#tablal tbody').is(':visible')){
					$('#tabla caption').click();
				}
			}
        },
        error: function() {alert('Se ha producido un error');}
    });
    return true;
}


function get(id){
	var url = base_url+'paciente/get/'+id;
	$.ajax({
			url: url,
			data: null,
			processData: 'false',
			dataType: 'json',
			type: "POST",
			success: function(datos) {
				if(cargarParroquiasGet(datos.municipio, datos.parroquia)){
				$('#myModal').modal('show');
					$('[name=bandera]').val(1);
					$('[name=cedula]').val(datos.cedula);
					$('[name=nombre]').val(datos.nombre);
					$('[name=apellido]').val(datos.apellido);
					$('[name=fecha_nacimiento]').val(datos.fecha_nacimiento);
					$('[name=direccion]').val(datos.direccion);
					$('[name=telefono1]').val(datos.telefono1);
					$('[name=telefono2]').val(datos.telefono2);
					$('[name=municipio]').val(datos.municipio);
					$('[name=parroquia]').val(datos.parroquia);
					$('[name=fecha_atencion]').val(datos.fecha_atencion);
					$('[name=n_hijos]').val(datos.n_hijos);
					$('[name=esterilizada]').val(datos.esterilizada);
					$('[name=fecha_esterilizacion]').val(datos.fecha_esterilizacion);
					$('[name=observacion]').val(datos.observacion);
			
					if(datos.agregado!=null){$('#agregado').html('Agregado por '+datos.agregado);}
					else{$('#agregado').html('Agregado por trabajo Social');}
				
				

				}
			},
			error: function() {alert('Se ha producido un error');}
	});
	return true;
}

function eliminar(cedula){
	if(!confirm('Esta seguro. ¿Desea eliminarla?'))
		return false;
	var url = base_url+'paciente/eliminar/'+cedula;
	$.ajax({
			url: url,
			data: null,
			processData: 'false',
			dataType: 'json',
			type: "POST",
			success: function(datos){
				if ($.isNumeric(datos) || datos>0){
				//	alert(datos);
					actualizar();
					}
			},
			error: function() {alert('Se ha producido un error');}
	});
	return true;
}

function guardar(){
	if (!verificar()){alert('Faltan campos por completar'); return false; }
	
	var post= "cedula="+$('[name=cedula]').val();
	post += "&nombre="+$('[name=nombre]').val();
	post += "&apellido="+$('[name=apellido]').val();
	post += "&fecha_nacimiento="+$('[name=fecha_nacimiento]').val();
	post += "&direccion="+$('[name=direccion]').val();
	post += "&municipio="+$('[name=municipio]').val();
	post += "&parroquia="+$('[name=parroquia]').val();
	post += "&telefono1="+$('[name=telefono1]').val();
	post += "&telefono2="+$('[name=telefono2]').val();
	post += "&fecha_atencion="+$('[name=fecha_atencion]').val();
	post += "&n_hijos="+$('[name=n_hijos]').val();
	post += "&esterilizada="+$('[name=esterilizada]').val();
	post += "&fecha_esterilizacion="+$('[name=fecha_esterilizacion]').val();
	post += "&observacion="+$('[name=observacion]').val();
	var enlace;
	if($('[name=bandera]').val() ==0)
		enlace = base_url +"paciente/agregar";
	else
		enlace = base_url +"paciente/editar";
	//alert(enlace + ' ' + post);
	$.ajax({
			url: enlace,
			data: post,
			processData: 'false',
			type: 'POST',
			success: function(datos){
			if(!$.isNumeric(datos) || datos<1){
				$('#_formulario').append(mensaje_error_datos);
				return false;
			}else{
				$('#_formulario').append(mensaje_exito);
				actualizar();
				$('[name=bandera]').val(1);
				//$('#myModal').modal('hide');
			}
		},
		error: function() {alert('Se ha producido un error');}
	});
}


function verificar(){
	var item =['[name=cedula]', '[name=nombre]','[name=apellido]','[name=fecha_nacimiento]',
		'[name=direccion]','[name=municipio]','[name=parroquia]','[name=telefono1]',
		'[name=telefono2]', '[name=fecha_esterilizacion]','[name=observacion]'];
	for( var i=0; i< item.length; i++){
		if (vacio($(item[i]).val())){
			$(item[i]).focus();
			return false;
		}
	}
	return true;
}

function buscar(){
	var post= "_cedula="+$('[name=_cedula]').val();
	post += "&_nombre="+$('[name=_nombre]').val();
	post += "&_municipio="+$('[name=_municipio]').val();
	post += "&_esterilizada="+$('[name=_esterilizada]').val();
	post += "&_fecha_inicio="+$('[name=_fecha_inicio]').val();
	post += "&_fecha_final="+$('[name=_fecha_final]').val();
    var url = base_url+'paciente/buscar';
	
	//alert(post);
    $.ajax({
        url: url,
        data: post,
        processData: 'false',
	   dataType: 'json',
        type: "POST",
        success: function(datos) {
				$('#tabla tbody').html('');
				$('#paginacion').html('');
			for (var i=0; i<datos.length; i++){
				cadena='<tr class="success" style="text-transform: uppercase">';
				if(datos[i].esterilizada=='no')
					cadena='<tr class="info" style="text-transform: uppercase">';
				if(datos[i].esterilizada=='tq')
					cadena='<tr class="warning" style="text-transform: uppercase">';
				cadena +='<td class="centrado">'+(i+1)+'</td>';
				cadena +='<td class="centrado">'+datos[i].cedula+'</td>'+
					'<td>'+datos[i].nombre+' '+datos[i].apellido+'</td>'+
					'<td class="centrado">'+datos[i].fecha_nacimiento+'</td>'+
					'<td class="centrado">'+datos[i].detalle+'</td>'+
					'<td class="centrado">'+datos[i].telefono1+'</td>'+
					'<td class="centrado">'+datos[i].esterilizada+'</td>'+
					'<td class="centrado">';
					if(tipo_usuario==1)
					{
					cadena +='<a class="btn btn-mini btn-warning" onclick="get(\''+datos[i].cedula+'\')">'+
									 ' <i class="icon-wrench icon-white"></i></a>';
					cadena +=' <a class="btn btn-mini btn-danger" onclick="eliminar(\''+datos[i].cedula+'\')">'+
										' <i class="icon-minus icon-white"></i></a>';
					}
					if(tipo_usuario==2)
					{
					cadena +='<a class="btn btn-mini btn-warning" onclick="get(\''+datos[i].cedula+'\')">'+
									 ' <i class="icon-wrench icon-white"></i></a>';
					}
						cadena +=	'</td>'+
				'</tr>';
				$('#tabla tbody').append(cadena);
				if(!$('#tablal tbody').is(':visible')){
					$('#tabla caption').click();
				}
			}
        },
					error: function() {alert('Se ha producido un error');}
    });
    return true;
}

function importar_xls(){
	var post= "_cedula="+$('[name=_cedula]').val();
	post += "&_nombre="+$('[name=_nombre]').val();
	post += "&_municipio="+$('[name=_municipio]').val();
	post += "&_esterilizada="+$('[name=_esterilizada]').val();
	post += "&_fecha_inicio="+$('[name=_fecha_inicio]').val();
	post += "&_fecha_final="+$('[name=_fecha_final]').val();
    var url = base_url+'paciente/buscar';
	
	//alert(post);
    $.ajax({
        url: url,
        data: post,
        processData: 'false',
	   dataType: 'json',
        type: "POST",
        success: function(datos) {
				$('#tabla tbody').html('');
			for (var i=0; i<datos.length; i++){
				cadena='<tr class="success" style="text-transform: uppercase">';
				if(datos[i].esterilizada=='no')
					cadena='<tr class="info" style="text-transform: uppercase">';
				if(datos[i].esterilizada=='tq')
					cadena='<tr class="warning" style="text-transform: uppercase">';
				cadena +='<td class="centrado">'+datos[i].cedula+'</td>'+
					'<td>'+datos[i].nombre+' '+datos[i].apellido+'</td>'+
					'<td class="centrado">'+datos[i].fecha_nacimiento+'</td>'+
					'<td class="centrado">'+datos[i].detalle+'</td>'+
					'<td class="centrado">'+datos[i].telefono1+'</td>'+
					'<td class="centrado">'+datos[i].esterilizada+'</td>'+
					'<td class="centrado">';
					if(tipo_usuario==1)
					{
					cadena +='<a class="btn btn-mini btn-warning" onclick="get(\''+datos[i].cedula+'\')">'+
									 ' <i class="icon-wrench icon-white"></i></a>';
					cadena +=' <a class="btn btn-mini btn-danger" onclick="eliminar(\''+datos[i].cedula+'\')">'+
										' <i class="icon-minus icon-white"></i></a>';
					}
					if(tipo_usuario==2)
					{
					cadena +='<a class="btn btn-mini btn-warning" onclick="get(\''+datos[i].cedula+'\')">'+
									 ' <i class="icon-wrench icon-white"></i></a>';
					}
						cadena +=	'</td>'+
				'</tr>';
				$('#tabla tbody').append(cadena);
				if(!$('#tablal tbody').is(':visible')){
					$('#tabla caption').click();
				}
			}
        },
					error: function() {alert('Se ha producido un error');}
    });
    return true;
}


function aMays(e, elemento) {
tecla=(document.all) ? e.keyCode : e.which; 
 elemento.value = elemento.value.toUpperCase();
}

$(".positive-integer").numeric({ decimal: false, negative: false }, function() {this.value = ""; this.focus(); });
	
	$.mask.definitions['*']='[24]';
	$(".telefono").mask("(0*99)999-9999");
	$.mask.definitions['+']='[ve]';
	$(".cedula").mask("+-9999999?999");
	
	$.mask.definitions['m']='[01]';
	$.mask.definitions['d']='[0123]';
	$.mask.definitions['Y']='[12]';
	$.mask.definitions['y']='[089]';
     $(".fecha2").mask("d9-m9-Yy99");
	
	$('.fecha').datepicker({format: 'yyyy-mm-dd',language: 'es'});
	


$(document).ready(function(){
			 
	$('#_guardar').click(function(){
		guardar();
	});
	
//	$('#_nuevo_paciente').click(function(){
//		$('#fecha_nacimiento').datepicker({
//										language: 'es',
//										format: 'dd-mm-yyyy',
//										autoclose: true,
//										weekStart: 1
//						});
//					$('#fecha_atencion').datepicker({
//										 language: 'es',
//										 format: 'dd-mm-yyyy',
//										 autoclose: true,
//										 weekStart: 1
//						 });
//					$('#fecha_esterilizacion').datepicker({
//										 language: 'es',
//										 format: 'dd-mm-yyyy',
//										 autoclose: true,
//										 weekStart: 1
//						 });
//	});
	
	$('#_cerrar').click(function(){
		$('#_mensaje').remove();
		$('#cedula').addClass('span9 cedula');
	});
	
	$('#_buscar').click(function(){
		buscar();
	});
	
	$('#municipio').change(function(){
		cargarParroquias();
	});
	
	$('#myModal').on('hidden', function (){
		limpiar_form();
	});
	

});

