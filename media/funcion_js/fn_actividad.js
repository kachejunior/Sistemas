function vacio(q) {  
	for ( i = 0; i < q.length; i++ ){
		if ( q.charAt(i) != " " ){
			return false;
		}
	}
	return true;
}

function limpiar_form(){
	var item = ['[name=_id]', '[name=id]', '[name=nombre]','[name=fecha_inicio]','[name=fecha_final]',
		'[name=hora_inicio]','[name=hora_final]','[name=cedula_usuario]','[name=id_lugar]','[name=id_status_actividad]'];

	for( var i=0; i< item.length; i++){
		$(item[i]).val('');
	}
}

function verificar(){
	var item =['[name=nombre]','[name=fecha_inicio]','[name=fecha_final]',
		'[name=hora_inicio]','[name=hora_final]','[name=cedula_usuario]','[name=id_lugar]','[name=id_status_actividad]'];

	for( var i=0; i< item.length; i++){
		if (vacio($(item[i]).val())){
			$(item[i]).focus();
			return false;
		}
	}
	return true;
}

function actualizar(){
    var url = base_url+'actividad/get2';
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
				if(datos[i].id_status_actividad==3)
					cadena='<tr class="warning" style="text-transform: uppercase">';
				if(datos[i].id_status_actividad==2)
					cadena='<tr class="error" style="text-transform: uppercase">';
			cadena=cadena+'<td class="centrado">'+datos[i].id+'</td>'+
					'<td>'+datos[i].nombre+'</td>'+
					'<td class="centrado">'+datos[i].lugar+' ('+datos[i].sede+')</td>'+
					'<td class="centrado">'+datos[i].fecha_inicio+' al '+datos[i].fecha_final+' <br> '+datos[i].hora_inicio+'/'+datos[i].hora_final+'</td>'+
					'<td class="centrado">'+datos[i].responsable+'</td>'+
					'<td class="centrado">'+
						'<a class="btn btn-mini btn-warning" onclick="get('+datos[i].id+')">'+
						' <i class="icon-wrench icon-white"></i></a>'+
						' <a class="btn btn-mini btn-danger" onclick="eliminar('+datos[i].id+')">'+
						' <i class="icon-minus icon-white"></i></a>'+
					'</td>'+
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
	var url = base_url+'actividad/get/'+id;
	$.ajax({
			url: url,
			data: null,
			processData: 'false',
			dataType: 'json',
			type: "POST",
			success: function(datos) {
				$('#myModal').modal('show');
					$('[name=id]').val(datos.id);
					$('[name=nombre]').val(datos.nombre);
					$('[name=fecha_inicio]').val(datos.fecha_inicio);
					$('[name=fecha_final]').val(datos.fecha_final);
					$('[name=hora_inicio]').val(datos.hora_inicio);
					$('[name=hora_final]').val(datos.hora_final);
					$('[name=cedula_usuario]').val(datos.cedula_usuario);
					$('[name=id_lugar]').val(datos.id_lugar);
					$('[name=id_status_actividad]').val(datos.id_status_actividad);
			},
			error: function() {alert('Se ha producido un error');}
	});
	return true;
}

function eliminar(id){
	if(!confirm('Esta seguro. ¿Desea eliminarla?'))
		return false;
	var url = base_url+'actividad/eliminar/'+id;
	$.ajax({
			url: url,
			data: null,
			processData: 'false',
			dataType: 'json',
			type: "POST",
			success: function(datos){
				if (datos == 1)
					actualizar();
			},
			error: function() {alert('Se ha producido un error');}
	});
	return true;
}

function guardar(){
	if (!verificar()) return false;
	var post = "nombre="+$('[name=nombre]').val();
	post += "&id="+$('[name=id]').val();
	post += "&fecha_inicio="+$('[name=fecha_inicio]').val();
	post += "&fecha_final="+$('[name=fecha_final]').val();
	post += "&hora_inicio="+$('[name=hora_inicio]').val();
	post += "&hora_final="+$('[name=hora_final]').val();
	post += "&cedula_usuario="+$('[name=cedula_usuario]').val();
	post += "&id_lugar="+$('[name=id_lugar]').val();
	post += "&id_status_actividad="+$('[name=id_status_actividad]').val();
	var enlace;
	if($('[name=id]').val() =='')
		enlace = base_url +"actividad/agregar";
	else
		enlace = base_url +"actividad/editar";
	//alert(enlace+' '+post);
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
				$('#myModal').modal('hide');
			}
		},
		error: function() {alert('Se ha producido un error');}
	});
}

//function ver_por_grupo(sede){
//    var url = base_url+'lugar/get2//'+sede;
//    $.ajax({
//        url: url,
//        data: null,
//        processData: 'false',
//				dataType: 'json',
//        type: "POST",
//        success: function(datos) {
//				$('#tabla tbody').html('');
//			for (var i=0; i<datos.length; i++){
//				cadena='<tr>'+
//					'<td class="centrado">'+ datos[i].id +'</td>'+
//					'<td>'+ datos[i].nombre +'</td>'+
//					'<td class="centrado">'+ datos[i].sede+'</td>'+
//					'<td class="centrado"><a class="btn btn-mini btn-warning" onclick="get('+datos[i].id+')">'+
//					'<i class="icon-wrench icon-white"></i></a>'+
//					' <a class="btn btn-mini btn-danger" onclick="eliminar('+datos[i].id+')">'+
//					'<i class="icon-minus icon-white"></i></a></td>'+
//				'</tr>';
//				$('#tabla_general tbody').append(cadena);
//				if(!$('#tabla tbody').is(':visible')){
//					$('#tabla caption').click();
//				}
//			}
//        },
//        error: function() {alert('Se ha producido un error');}
//    });
//    return true;
//}


$(document).ready(function(){
	$('#_guardar').click(function(){
		guardar();
	});
	
	$('#myModal').on('hidden', function (){
		limpiar_form();
	});
});