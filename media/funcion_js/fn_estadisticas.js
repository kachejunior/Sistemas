function vacio(q) {  
	for ( i = 0; i < q.length; i++ ){
		if ( q.charAt(i) != " " ){
			return false;
		}
	}
	return true;
}

function verificar(){
	var item =['[name=fecha_inicio]', '[name=fecha_final]'];
	for( var i=0; i< item.length; i++){
		if (vacio($(item[i]).val())){
			$(item[i]).focus();
			return false;
		}
	}
	return true;
}

function actualizar_atendidas(){
   var post = "fecha_inicio="+$('[name=fecha_inicio]').val();
  post += "&fecha_final="+$('[name=fecha_final]').val();
  var url = base_url+'estadistica/getAtendidas';
    $.ajax({
        url: url,
        data: post,
        processData: 'false',
		dataType: 'json',
        type: "POST",
        success: function(datos) {
			$('#total_atendidos').html(datos);	
        },
        error: function() {alert('Se ha producido un error');}
    });
    return true;
}

function actualizar_esterilizadas(){
   var post = "fecha_inicio="+$('[name=fecha_inicio]').val();
  post += "&fecha_final="+$('[name=fecha_final]').val();
  var url = base_url+'estadistica/getEsterilizadas';
    $.ajax({
        url: url,
        data: post,
        processData: 'false',
		dataType: 'json',
        type: "POST",
        success: function(datos) {
			$('#total_esterilizadas').html(datos);	
        },
        error: function() {alert('Se ha producido un error');}
    });
    return true;
}

function actualizar_tratamiento(){
   var post = "fecha_inicio="+$('[name=fecha_inicio]').val();
  post += "&fecha_final="+$('[name=fecha_final]').val();
  var url = base_url+'estadistica/getTratamiento';
    $.ajax({
        url: url,
        data: post,
        processData: 'false',
		dataType: 'json',
        type: "POST",
        success: function(datos) {
			$('#total_tratamiento').html(datos);	
        },
        error: function() {alert('Se ha producido un error');}
    });
    return true;
}

function actualizar_municipales(){
   var post = "fecha_inicio="+$('[name=fecha_inicio]').val();
  post += "&fecha_final="+$('[name=fecha_final]').val();
  var url = base_url+'estadistica/getMunicipales';
    $.ajax({
        url: url,
        data: post,
        processData: 'false',
		dataType: 'json',
        type: "POST",
        success: function(datos) {
			$('#tabla_municipales tbody').html('');
			for (var i=0; i<datos.length; i++){
				if(!$.isNumeric(datos[i].totalsi))
					totalsi=0;
				else
					totalsi=datos[i].totalsi;
				if(!$.isNumeric(datos[i].totaltq))
					totaltq=0;
				else
					totaltq=datos[i].totaltq;
				cadena='<tr style="text-transform: uppercase">'+
					'<td class="centrado">'+datos[i].detalle+'</td>'+
					'<td class="centrado">'+datos[i].totalcompleto+'</td>'+
					'<td class="centrado">'+totalsi+'</td>'+
					'<td class="centrado">'+totaltq+'</td>'+
				'</tr>';
				$('#tabla_municipales tbody').append(cadena);
				if(!$('#tabla_municipales tbody').is(':visible')){
					$('#tabla_municipales caption').click();
				}
			}
        },
        error: function() {alert('Se ha producido un error');}
    });
    return true;
}

function actualizar_parroquiales(){
   var post = "fecha_inicio="+$('[name=fecha_inicio]').val();
  post += "&fecha_final="+$('[name=fecha_final]').val();
  post += "&municipio="+$('[name=municipio]').val();
  var url = base_url+'estadistica/getParroquiales';
    $.ajax({
        url: url,
        data: post,
        processData: 'false',
		dataType: 'json',
        type: "POST",
        success: function(datos) {
			$('#tabla_parroquiales tbody').html('');
			for (var i=0; i<datos.length; i++){
				if(!$.isNumeric(datos[i].totalsi))
					totalsi=0;
				else
					totalsi=datos[i].totalsi;
				if(!$.isNumeric(datos[i].totaltq))
					totaltq=0;
				else
					totaltq=datos[i].totaltq;
				cadena='<tr style="text-transform: uppercase">'+
					'<td class="centrado">'+datos[i].detalle+'</td>'+
					'<td class="centrado">'+datos[i].totalcompleto+'</td>'+
					'<td class="centrado">'+totalsi+'</td>'+
					'<td class="centrado">'+totaltq+'</td>'+
				'</tr>';
				$('#tabla_parroquiales tbody').append(cadena);
				if(!$('#tabla_parroquiales tbody').is(':visible')){
					$('#tabla_parroquiales caption').click();
				}
			}
        },
        error: function() {alert('Se ha producido un error');}
    });
    return true;
}

$(".positive-integer").numeric({ decimal: false, negative: false }, function() {this.value = ""; this.focus(); });
	
	$.mask.definitions['*']='[24]';
	$(".telefono").mask("(0*99)999-9999");
	$.mask.definitions['+']='[ve]';
	
	$(".cedula").mask("+-9999999?999");
	
	
	$('.fecha').datepicker({format: 'dd-mm-yyyy',language: 'es'});
	


$(document).ready(function(){
	$('#_buscar_fecha').click(function(){
		if(verificar()){
			actualizar_atendidas();
			actualizar_esterilizadas();
			actualizar_tratamiento();
			actualizar_municipales();
			
			if($.isNumeric($('[name=municipio]').val())){
				actualizar_parroquiales();}
		}
		else
			alert('Se requiere Fecha de Inicio y Fecha de Fin');
	});
	
	$('#_municipio').change(function(){
		actualizar_parroquiales();
	});
	
	$('#myModal').on('hidden', function (){
		limpiar_form();
	});
});