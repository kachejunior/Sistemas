<table id="tabla" class="table table-hover table-bordered table-striped" >
		<thead>
			<tr style="background:#802c59; color: #FFF ">
				<th style="text-align: center;">Cedula</th>
				<th style="text-align: center;">Nombre y Apellido</th>
				<th style="text-align: center;">F. Nacimiento</th>
				<th style="text-align: center;">N Hijos</th>
				<th style="text-align: center;">Municipio</th>
				<th style="text-align: center;">Direccion</th>
				<th style="text-align: center;">Telefono 1</th>
				<th style="text-align: center;">Telefono 2</th>
				<th style="text-align: center;">Estatus</th>
				<th style="text-align: center;">Fecha de Atencion</th>
				<th style="text-align: center;">Observacion</th>
			</tr>
		</thead>
		<tbody>
			<?php
			foreach ($pacientes as $row)
			{
				$str = '<tr style="text-transform: uppercase; border:solid 1px #000">'.
					'<td  style="text-align: center;">'.$row->cedula.'</td>'.
					'<td  style="text-align: center;">'.ucwords(strtolower($row->nombre)).' '.ucwords(strtolower($row->apellido)).'</td>'.	
					'<td  style="text-align: center;">'.$row->fecha_nacimiento.'</td>'.
					'<td  style="text-align: center;">'.$row->n_hijos.'</td>'.
					'<td  style="text-align: center;">'.$row->detalle.'</td>'.		
					'<td  style="text-align: center;">'.$row->direccion.'</td>'.
					'<td  style="text-align: center;">'.$row->telefono1.'</td>'.
					'<td  style="text-align: center;">'.$row->telefono2.'</td>'.
					'<td  style="text-align: center;">'.$row->esterilizada.'</td>'.	
					'<td  style="text-align: center;">'.$row->fecha_atencion.'</td>'.	
					'<td  style="text-align: center;">'.$row->observacion.'</td>'.	
					'</tr>';
				echo $str;
			}
			?>
		</tbody>
	</table>


<?php 
	header("Content-type: application/vnd-ms-excel; charset=iso-8859-1");
	header("Content-Disposition: attachment; filename=MujerVF_".date('d-m-Y').".xls");
?>