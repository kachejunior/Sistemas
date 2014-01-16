<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title></title>
		<style>
				body{font-family: sans-serif; font-size: 14px; color: #000;}
				p{ width: 100%; background: #e7e7e9; padding: 3px; font-family: sans-serif; font-size: 15px;}
				h3{font-size: 24px; color: #818286; font-weight: bold;}
		</style>
	</head>
	<body>
		<br>
		<h3>Datos del Atleta</h3>
		<p><b>Id de Registro:</b> <?php echo $atleta->id; ?></p>
		<p><b>Fecha de Registro:</b> <?php echo date('d-m-Y H:i:s',  strtotime($atleta->fh_registro)); ?></p><br>
		<p><b>Cedula de Identidad:</b> <?php echo $atleta->cedula; ?></p>
		<p><b>Nombre:</b> <?php echo ucwords(strtolower($atleta->nombre)); ?></p>
		<p><b>Apellido:</b> <?php echo ucwords(strtolower($atleta->apellido)); ?></p>
		<p><b>Sexo:</b> <?php echo $atleta->sexo=='M'?'Masculino':'Femenino'; ?></p>
		<p><b>Fecha de Nacimiento:</b> <?php echo date('d-m-Y',  strtotime($atleta->fecha_nacimiento)); ?></p><br>
		<p><b>Teléfono:</b> <?php echo $atleta->telefono; ?></p>
		<p><b>Correo:</b> <?php echo $atleta->correo; ?></p>
		<p><b>Dirección:</b> <?php echo $atleta->direccion; ?></p>
		<h3>Usted se inscribio para participar en</h3>
		<p><b>Evento:</b> <?php echo $atleta->evento_nombre; ?></p>
		<p><b>Categoría:</b> <?php echo $atleta->categoria_nombre; ?></p>

	</body>
	</html>