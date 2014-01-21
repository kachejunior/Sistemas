<form class="span10 offset1">
	<legend>Administración de Usuarios</legend>
		<!-- Button to trigger modal -->
		<div class="control-group">
			<a href="#myModal" role="button" class="btn btn-primary pull-right" data-toggle="modal" style="margin-bottom: 10px;">
				<i class="icon-plus-sign icon-white"></i> Agregar Usuario</a>
		</div>
		<table id="tabla" class="table table-hover table-bordered table-striped">
			<thead>
				<tr style="background:#d44413; color: #FFF">
					<th class="span2">Cedula</th>
					<th class="span4">Nombre</th>
					<th class="span2">Correo</th>
					<th class="span2">Teléfono</th>
					<th class="span2">Opciones</th>
				</tr>
			</thead>
			<tbody>
			<?php
			foreach ($lista as $row)
			{
				$str = '<tr>'.
					'<td class="centrado">'.$row->cedula.'</td>'.
					'<td>'.ucwords(strtolower($row->nombre)).' '.ucwords(strtolower($row->apellido)).'</td>'.
					'<td class="centrado">'.strtolower($row->correo).'</td>'.
					'<td class="centrado">'.$row->telefono.'</td>'.
					'<td class="centrado">'.
						'<a class="btn btn-mini btn-warning" onclick="get('.$row->cedula.');">'.
						' <i class="icon-wrench icon-white"></i></a>'.
						' <a class="btn btn-mini btn-danger" onclick="eliminar('.$row->cedula.');">'.
						' <i class="icon-minus icon-white"></i></a>'.
						' <a class="btn btn-mini btn-danger" onclick="reset_passwd('.$row->cedula.');">'.
						' <i class="icon-refresh icon-white"></i></a>'.
					'</td>'.
					'</tr>';
				echo $str;
			}
			?>
			</tbody>
		</table>

<div id="myModal" class="modal hide fade span10 offset1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="left:0;">
	<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h4>Datos de Usuario</h4>
  </div>
  <div class="modal-body">
		<div class="controls">
			<div class="input-prepend span4">
				<label>Cedula</label>
				<span class="add-on"><i class="icon-barcode"></i></span>
				<input class="span9" name="cedula" type="text" placeholder="Cedula" maxlength="9" required>
				<input name="_cedula" type="hidden">
			</div>
		</div>
		<div class="controls">
			<div class="input-prepend span4">
				<label>Nombre</label>
				<span class="add-on"><i class="icon-user"></i></span>
				<input class="span9" name="nombre" type="text" placeholder="Nombre" maxlength="60" required>
			</div>		
		</div>
		<div class="controls">
			<div class="input-prepend span4">
				<label>Apellido</label>
				<span class="add-on"><i class="icon-user"></i></span>
				<input class="span9" name="apellido" type="text" placeholder="Apellido" maxlength="60" required>
			</div>		
		</div>
		<div class="controls">
			<div class="input-prepend span4">
				<label>Teléfono</label>
				<span class="add-on"><i class="icon-signal"></i></span>
				<input class="span9" name="telefono" type="text" placeholder="Teléfono" maxlength="12" required>
			</div>		
		</div>
		<div class="controls">
			<div class="input-prepend span4">
				<label>Correo</label>
				<span class="add-on"><i class="icon-envelope"></i></span>
				<input class="span9" name="correo" type="email" placeholder="Correo" maxlength="150" required>
			</div>		
		</div>
		<div class="controls">
			<div class="input-prepend span4">
				<label>Grupo</label>
				<span class="add-on"><i class="icon-briefcase"></i></span>
				<select class="span9" name="grupo_usuario" required>
					<?php
					foreach ($grupo_usuario as $row)
					{
						$str = '<option value="'.$row->id.'">'.$row->nombre.'</option>';
						echo $str;
					}
					?>
				</select>
			</div>		
		</div>
		<div class="controls">
			<div class="input-prepend span4">
				<label>Sede</label>
				<span class="add-on"><i class="icon-tag"></i></span>
				<select class="span9" name="sede" required>
					<?php
					foreach ($sede as $row)
					{
						$str = '<option value="'.$row->id.'">'.$row->nombre.'</option>';
						echo $str;
					}
					?>
				</select>
			</div>		
		</div>
		<div class="controls">
			<div class="input-prepend span4">
				<label>Status</label>
				<span class="add-on"><i class="icon-flag"></i></span>
				<select class="span9" name="status_usuario" required>
					<?php
					foreach ($status_usuario as $row)
					{
						$str = '<option value="'.$row->id.'">'.$row->nombre.'</option>';
						echo $str;
					}
					?>
				</select>
			</div>		
		</div>
	</div>
  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">Cerrar</button>
		<button class="btn btn-info pull-right" type="button" id="_guardar"><i class="icon-ok icon-white"></i> Guardar</button>
  </div>
</div>
</form>
<script src="<?php echo base_url();?>media/funcion_js/fn_usuarios.js"></script>
