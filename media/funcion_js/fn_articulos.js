var mensaje_exito= '<div class="alert alert-success" id="_mensaje"><button type="button" class="close" data-dismiss="alert">×</button><strong>Guardado con Exito!</strong></div>';
var mensaje_error_datos= '<div class="alert alert-error" id="_mensaje"><button type="button" class="close" data-dismiss="alert">×</button><strong>Error al Guardar!</strong> Verifica los datos (La cedula puede ser repetida o faltan campos)</div>';

function vacio(q) {  
	for ( i = 0; i < q.length; i++ ){
		if ( q.charAt(i) != " " ){
			return false;
		}
	}
	return true;
}

function limpiar_form(){
	var item = ['[name=id]', '[name=nombre]','[name=sede]' ,'[name=tipo_articulo]' ,'[name=color]'];
	
	for( var i=0; i< item.length; i++){
		$(item[i]).val('');
	}
	$('[name=cantidad_disponible]').val(0);
	$('#_mensaje_alerta').append('');
}

function verificar(){
	var item = ['[name=nombre]','[name=sede]' ,'[name=tipo_articulo]'];

	for( var i=0; i< item.length; i++){
		if (vacio($(item[i]).val())){
			$(item[i]).focus();
			return false;
		}
	}
	return true;
}

function actualizar(){
    var url = base_url+'inventario/get';
    $.ajax({
        url: url,
        data: null,
        processData: 'false',
				dataType: 'json',
        type: "POST",
        success: function(datos) {
				$('#tabla tbody').html('');
			for (var i=0; i<datos.length; i++){
				cadena='<tr>'+
					'<td class="centrado">'+ datos[i].id +'</td>'+
					'<td>'+ datos[i].nombre_sede +'</td>'+
					'<td class="centrado">'+ datos[i].nombre_tipo_articulo+'</td>'+
					'<td class="centrado">'+ datos[i].nombre+'</td>'+
					'<td class="centrado">'+ datos[i].cantidad_disponible+'</td>'+
					'<td class="centrado"><a class="btn btn-mini btn-warning" onclick="get('+datos[i].id+')">'+
					'<i class="icon-wrench icon-white"></i></a>'+
					' <a class="btn btn-mini btn-danger" onclick="eliminar('+datos[i].id+')">'+
					'<i class="icon-minus icon-white"></i></a></td>'+
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
	var url = base_url+'inventario/get/'+id;
	//alert(url);
	//$(location).attr('href', url)
	$.ajax({
			url: url,
			data: null,
			processData: 'false',
			dataType: 'json',
			type: "POST",
			success: function(datos) {
					$('#myModal').modal('show');
					//alert(datos.id+' '+datos.nombre);
					$('[name=id]').val(datos.id);
					$('[name=nombre]').val(datos.nombre);
					$('[name=sede]').val(datos.id_sede);
					$('[name=tipo_articulo]').val(datos.id_tipo_articulo);
					$('[name=color]').val(datos.color);
					$('[name=cantidad_disponible]').val(datos.cantidad_disponible);
			},
			error: function() {alert('Se ha producido un error');}
	});
	return true;
}

function eliminar(id){
	if(!confirm('Esta seguro. ¿Desea eliminarla?'))
		return false;
	var url = base_url+'inventario/eliminar/'+id;
	$.ajax({
			url: url,
			data: null,
			processData: 'false',
			dataType: 'json',
			type: "POST",
			success: function(datos){
				if (datos == 1)
					actualizar();
					alert('Registro eliminado exitosamente');
			},
			error: function() {alert('Se ha producido un error');}
	});
	return true;
}

function guardar(){
	if (!verificar()) return false;
	var post = "nombre="+$('[name=nombre]').val();
	post += "&sede="+$('[name=sede]').val();
	post += "&tipo_articulo="+$('[name=tipo_articulo]').val();
	post += "&color="+$('[name=color]').val();
	post += "&cantidad_disponible="+$('[name=cantidad_disponible]').val();
	var enlace;
	if($('[name=id]').val() =='')
		enlace = base_url +"inventario/agregar";
	else
		enlace = base_url +"inventario/editar";
	
	//alert(post+'  '+enlace);
	$.ajax({
			url: enlace,
			data: post,
			processData: 'false',
			type: 'POST',
			success: function(datos){
			if(!$.isNumeric(datos) || datos<1){
				alert('Error al guardar.\nVerifique los datos he intente de nuevo');
				return false;
			}else{
				actualizar();
				alert('Exito al guardar');
				$('#myModal').modal('hide');
				//$('#_mensaje_alerta').append(mensaje_exito);
			}
		},
		error: function() {alert('Se ha producido un error');}
	});
}

/*---------------------Busqueda por filtro----------------------------*/
function buscar(){
	var post= "_nombre="+$('[name=_nombre]').val();
	post += "&_sede="+$('[name=_sede]').val();
	post += "&_tipo_articulo="+$('[name=_tipo_articulo]').val();
	post += "&_status="+$('[name=_status]').val();
    var url = base_url+'inventario/buscar';
	
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
				cadena='<tr>'+
					'<td class="centrado">'+ datos[i].id +'</td>'+
					'<td>'+ datos[i].nombre_sede +'</td>'+
					'<td class="centrado">'+ datos[i].nombre_tipo_articulo+'</td>'+
					'<td class="centrado">'+ datos[i].nombre+'</td>'+
					'<td class="centrado">'+ datos[i].cantidad_disponible+'</td>'+
					'<td class="centrado"><a class="btn btn-mini btn-warning" onclick="get('+datos[i].id+')">'+
					'<i class="icon-wrench icon-white"></i></a>'+
					' <a class="btn btn-mini btn-danger" onclick="eliminar('+datos[i].id+')">'+
					'<i class="icon-minus icon-white"></i></a></td>'+
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

$(document).ready(function(){
	$('#_guardar').click(function(){
		guardar();
	});
	
	$('#_buscar').click(function(){
		buscar();
	});
	
	$('#myModal').on('hidden', function (){
		limpiar_form();
	});
});