<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title></title>
		<style>
				body{font-family: sans-serif; font-size: 14px; color: #000;}
				p{ width: 100%; background: #e7e7e9; padding: 3px; font-family: sans-serif; font-size: 15px;}
				h3{font-size: 22px; color: #818286; font-weight: bold;}
		</style>
	</head>
	<body>
		<h3>Estadisticas</h3>
		<table>
				<thead>
					<tr>
						<td width="80%"><h4>Estado</h4></th>
						<th width="20%"><h4>Numero de inscritos</h4></th>
					</tr>
				</thead>
				<tbody>
					<tr style='border-top:2px solid'><td>Validados</td><td><?php echo $total_atletas_validados; ?></td></tr>
					<tr style='border-top:2px solid'><td>No validados</td><td><?php echo $total_atletas_no_validados; ?></td></tr>
					<tr style='border-top:2px solid'><td>TOTAL INSCRITOS</td><td><?php echo $total_atletas; ?></td></tr>
				</tbody>
		</table>
		<h3>Estadisticas de Caminata</h3>
		<table>
				<thead>
					<tr>
						<td width="80%"><h4>Categoria</h4></th>
						<th width="20%"><h4>Numero de Inscritos</h4></th>
					</tr>
				</thead>
				<tbody>
					<?php
					foreach ($atletas_categoria_caminata as $row)
					{
						echo '<tr  style="text-transform: uppercase"><td>'.$row->categoria_nombre.'</td><td class="centrado">'.$row->count.'</td></tr>';
					}
					?>
					<tr style='border-top:2px solid'><td>TOTAL CAMINATA</td><td><?php echo $total_atletas_caminata; ?></td></tr>
				</tbody>
		</table>
		<h3>Estadisticas de carrera</h3>
		<table>
				<thead>
					<tr>
						<td width="80%"><h4>Categoria</h4></th>
						<th width="20%"><h4>Numero de Inscritos</h4></th>
					</tr>
				</thead>
				<tbody>
					<?php
					foreach ($atletas_categoria_carrera as $row)
					{
						echo '<tr  style="text-transform: uppercase"><td>'.$row->categoria_nombre.'</td><td class="centrado">'.$row->count.'</td></tr>';
					}
					?>
					<tr style='border-top:2px solid'><td>TOTAL CARRERA</td><td><?php echo $total_atletas_carrera; ?></td></tr>
				</tbody>
		</table>

	</body>
	</html>