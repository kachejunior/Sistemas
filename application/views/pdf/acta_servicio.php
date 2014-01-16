<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title></title>
		<link href="<?php echo base_url();?>media/css/pdf.css" rel="stylesheet" media="all">
	</head>
	<body>
		<p style="text-align: center; line-height:150%;"><b>ACTA DE SERVICIO</b><br/>(ID <?php echo strtoupper($actas_servicio_detalles->id);  echo ' '.strtoupper($actas_servicio_detalles->nombre_sede)?>)<br></p>

		<table class="ecabezado_pdf">
			<tr>
				<td class="fecha"><strong>FECHA</strong></td>
				<td class="nombre"><?php echo $actas_servicio_detalles->fecha_servicio?></td>
			</tr>
			<tr>
				<td class="fecha"><strong>PARA</strong></td>
				<td class="nombre"><?php echo strtoupper($actas_servicio_detalles->realizado_a)?></td>
			</tr>
			<tr>
				<td class="gerencia"><strong>GERENCIA</strong></td>
				<td class="nombre"><?php echo strtoupper($actas_servicio_detalles->nombre_gerencia)?></td>
			</tr>
		</table>

		<table class="datos_solicitud" style="margin-top: 20px;">
			<tr>
				<td>Por medio del presente acta hago constar la realizacion del siguiente servicio:</td>
			</tr>
		</table>
		<table class="datos_solicitud" style="margin-top: 10px;">
			<tr>
				<td ><?php echo str_replace("\n", '<br>',$actas_servicio_detalles->detalle_servicio); ?></td>
			</tr>
		</table>

		<table class="firmas" style="margin-top: 300px; border:0px;">
			<tr>
				<td class="centrado">___________________________</td>
				<td class="centrado" style="width:300px;"></td>
				<td class="centrado">___________________________</td>
			</tr>
			<tr>
				<td class="municipio centrado" style="text-align:center">FIRMA DEL ENCARGADO</td>
				<td class="municipio centrado"></td>
				<td class="municipio centrado" style="text-align:center">FIRMA DEL USUARIO</td>
			</tr>
			<tr>
				<td class="centrado" style="text-align:center"><?php echo strtoupper($actas_servicio_detalles->nombre_usuario).' '.strtoupper($actas_servicio_detalles->apellido_usuario); ?></td>
				
			</tr>
			<tr><td class="centrado" style="text-align:center">C.I. <?php echo strtoupper($actas_servicio_detalles->cedula_usuario); ?></td></tr>
		</table>

	</body>
</html>