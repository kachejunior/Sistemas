<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title></title>
		<style>
				body{font-family: sans-serif; font-size: 14px; color: #000;}
		</style>
	</head>
	<body>
		<p style="text-align: right;"><b>Nº: </b> <?php echo $row->id; ?></p>
		<p style="text-align: right;"><b>Fecha: </b> <?php echo date('d-m-Y',  strtotime($row->f_solicitud)); ?></p>

		<p style="text-align: justify;"><b>SOLICITUD: </b> <?php echo strtoupper($row->donativo)." ".strtoupper($row->detalle_solicitud); ?></p>
		<p style="text-align: justify;"><b>NOMBRE DEL BENEFICIARIO: </b><?php echo strtoupper($row->nombre_paciente); ?></p>
		<div style="width:100%; clear:both;">
				<div style="width:70%; float:left;"><b>Nº DE CEDULA DEL BENEFICIARIO: </b>
		<?php if($row->cedula_paciente) echo strtoupper ($row->cedula_paciente);
		else echo "--------------------"; ?></div>
				<div style="width:29%; float:left;"><b>EDAD: </b><?php
				echo $row->edad; 
				if($row->escala=='M')
						echo " MESES";
				else if($row->escala=='D')
						echo " DIAS";
				else
						echo " AÑOS";
				?></div>
		</div>

		<p style="text-align: justify;"><b>NOMBRE DEL REPRESENTANTE: </b>
						<?php if($row->cedrif_solicitante!= $row->cedula_paciente)
								echo strtoupper($row->nombre_solicitante);
						else echo "--------------------";
								?></p>
		<p style="text-align: justify;"><b>CEDULA DEL REPRESENTANTE: </b>
						<?php if($row->cedrif_solicitante!= $row->cedula_paciente)
								echo strtoupper($row->cedrif_solicitante);
						else echo "--------------------";?></p>
		<p style="text-align: justify;"><b>PROCEDENCIA:</b> ESTADO <?php echo strtoupper($row->estado); ?>,
				<?php echo strtoupper($row->municipio); ?>, PARROQUIA <?php echo strtoupper($row->parroquia); ?></p>
		<p style="text-align: justify;"><b>DIRECCION: </b><?php echo strtoupper($row->direccion); ?></p>
		<p style="text-align: justify;"><b>TELEFONOS: </b>
		<?php if($row->telefonos) echo $row->telefonos;
		else echo "--------------------"; ?></p>
		<p style="text-align: justify;"><b>DIAGNOSTICO: </b><?php echo strtoupper($row->diagnostico); ?></p>
		<div style="width:100%; clear:both;">
				<div style="width:70%; float:left;"><b>REFERIDO POR: </b>
		<?php if($row->referido_por) echo strtoupper($row->referido_por);
		else echo "--------------------"; ?></div>
				<div style="width:29%; float:left;"><b>APERTURADO: </b><?php echo $row->receptor; ?></div>
		</div>

		<p style="text-align: center;"><b>DOCUMENTACION EXIGIDA</b></p>

		<table style="width:90%; border: solid 1px ; border-collapse: collapse;
					 margin: auto; font-size: 11px;" border="1">
				<tr>
						<td style="width:50%; text-align: left;"><input type="checkbox"/> Carta Explicativa Solicitando Donación</td>
						<td style="width:50%; text-align: left;"><input type="checkbox"/> Récipe Médico</td>
				</tr>
				<tr>
						<td style="width:50%; text-align: left;"><input type="checkbox"/> Copia de la Partida de Nacimiento o C.I. del Beneficiario</td>
						<td style="width:50%; text-align: left;"><input type="checkbox"/> Ordenes de Exámenes</td>
				</tr>
				<tr>
						<td style="width:50%; text-align: left;"><input type="checkbox"/> Copia de la C.I. del Representante</td>
						<td style="width:50%; text-align: left;"><input type="checkbox"/> Constancia de Fecha de Cita</td>
				</tr>
				<tr>
						<td style="width:50%; text-align: left;"><input type="checkbox"/> Informe Médico o Control Prenatal</td>
						<td style="width:50%; text-align: left;"><input type="checkbox"/> Presupuesto Vigente</td>
				</tr>
		</table>
		<br/>
		<p style="text-align: justify;"><b>OBSERVACIONES: </b><?php echo strtoupper($row->observaciones); ?></p>

		<hr/><hr/><hr/><hr/>

</body>
</html>