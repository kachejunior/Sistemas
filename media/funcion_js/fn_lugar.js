function vacio(q) {  
	for ( i = 0; i < q.length; i++ ){
		if ( q.charAt(i) != " " ){
			return false;
		}
	}
	return true;
}

function limpiar_form(){
	var item = ['[name=_id]', '[name=id]', '[name=nombre]','[name=sede]'];

	for( var i=0; i< item.length; i++){
		$(item[i]).val('');
	}
}

function verificar(){
	var item =
	['[name=nombre]','[name=sede]'];

	for( var i=0; i< item.length; i++){
		if (vacio($(item[i]).val())){
			$(item[i]).focus();
			return false;
		}
	}
	return true;
}

function actualizar(){
    var url = base_url+'lugar/get2';
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
					'<td>'+ datos[i].nombre +'</td>'+
					'<td class="centrado">'+ datos[i].sede+'</td>'+
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
	var url = base_url+'lugar/get/'+id;
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
					$('[name=sede]').val(datos.id_sedes);
			},
			error: function() {alert('Se ha producido un error');}
	});
	return true;
}

function eliminar(id){
	if(!confirm('Esta seguro. ¿Desea eliminarla?'))
		return false;
	var url = base_url+'lugar/eliminar/'+id;
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
	post += "&sede="+$('[name=sede]').val();
	var enlace;
	if($('[name=id]').val() =='')
		enlace = base_url +"lugar/agregar";
	else
		enlace = base_url +"lugar/editar";
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

function ver_por_grupo(sede){
    var url = base_url+'lugar/get2//'+sede;
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
					'<td>'+ datos[i].nombre +'</td>'+
					'<td class="centrado">'+ datos[i].sede+'</td>'+
					'<td class="centrado"><a class="btn btn-mini btn-warning" onclick="get('+datos[i].id+')">'+
					'<i class="icon-wrench icon-white"></i></a>'+
					' <a class="btn btn-mini btn-danger" onclick="eliminar('+datos[i].id+')">'+
					'<i class="icon-minus icon-white"></i></a></td>'+
				'</tr>';
				$('#tabla_general tbody').append(cadena);
				if(!$('#tabla tbody').is(':visible')){
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
	
	$('#myModal').on('hidden', function (){
		limpiar_form();
	});
});