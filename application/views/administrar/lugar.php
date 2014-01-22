<form class="span10 offset1">
	<legend>Administración de Lugares</legend>
		<!-- Button to trigger modal -->
		<div class="control-group">
			<a href="#myModal" role="button" class="btn btn-success" data-toggle="modal">
				<i class="icon-plus-sign icon-white"></i> Agregar Lugar</a>
		</div>
		<table id="tabla" class="table table-hover table-bordered table-striped">
			<thead>
				<tr>
					<th class="span2">Id</th>
					<th class="span6">Nombre</th>
					<th class="span2">Sede</th>
					<th class="span2">Opción</th>
				</tr>
			</thead>
			<tbody>
			<?php
			foreach ($lista as $row)
			{
				$str = '<tr>'.
					'<td class="centrado">'.$row->id.'</td>'.
					'<td>'.strtoupper($row->nombre).'</td>'.
					'<td class="centrado">'.strtoupper($row->sede).'</td>'.
					'<td class="centrado">'.
						'<a class="btn btn-mini btn-warning" onclick="get('.$row->id.')">'.
						' <i class="icon-wrench icon-white"></i></a>'.
						' <a class="btn btn-mini btn-danger" onclick="eliminar('.$row->id.')">'.
						' <i class="icon-minus icon-white"></i></a>'.
					'</td>'.
					'</tr>';
				echo $str;
			}
			?>
			</tbody>
		</table>

</form>


<div id="myModal" class="modal hide fade span8 offset2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="left:0;">
	<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h4>Datos de Lugar</h4>
  </div>
  <div class="modal-body">
		<div class="controls">
			<div class="input-prepend span3">
				<label>Id</label>
				<span class="add-on"><i class="icon-barcode"></i></span>
				<input class="span9" name="id" type="text" placeholder="Id" disabled>
			</div>
		</div>
		<div class="controls">
			<div class="input-prepend span6">
				<label>Nombre</label>
				<span class="add-on"><i class="icon-info-sign"></i></span>
				<input class="span10" name="nombre" type="text" placeholder="Nombre" maxlength="60" required>
			</div>		
		</div>
		<div class="controls">
			<div class="input-prepend span3">
				<label>Sede</label>
				<span class="add-on"><i class="icon-globe"></i></span>
				<select class="span10" name="sede" required>
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
	</div>
  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">Cerrar</button>
		<button class="btn btn-primary pull-right" type="button" id="_guardar"><i class="icon-ok icon-white"></i> Guardar</button>
  </div>
</div>

<script type="text/javascript">var tb = '<?php echo $tb;?>';</script>
<script src="<?php echo base_url();?>media/funcion_js/fn_lugar.js"></script>