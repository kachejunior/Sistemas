<form class="span10 offset1">
	<!--<form class="span10 offset1" action="http://sistemas.fsbolivar.com.ve/inventario/buscar" method="post">-->
	<legend>Control de Inventario</legend>
	<!-- Button to trigger modal -->
	<div class="accordion" id="accordion2">
		<div class="accordion-group" style="border-color:#FFF ">
			<div class="accordion-heading accordion-toggle" style=" height:25px;">
				<a class="collapsed text-info" data-toggle="collapse" data-parent="#accordion2" href="#collapseOne" style="margin-top:5px; ">
					Busqueda Avanzada <i class="icon-search"></i>
				</a>
				<a href="#myModal" role="button" class="btn-primary btn-small pull-right" data-toggle="modal">
					<i class="icon-plus-sign icon-white"></i> Agregar Articulo</a>						
			</div>
			<div id="collapseOne" class="accordion-body collapse" style="height: 0px;">
				<div class="accordion-inner span12">
					<div class="control-group">
						<div class="controls">
							<div class="input-prepend span3">
								<label>Nombre</label>
								<span class="add-on"><i class="icon-barcode"></i></span>
								<input class="span9" name="_nombre" type="text" placeholder="Nombre/Apellido"  onkeyup="aMays(event, this)">
							</div>
						</div>
						<div class="controls">
							<div class="input-prepend span3">
								<label>Sede</label>
								<span class="add-on"><i class="icon-home"></i></span>
								<select class="span9" name="_sede" id="_sede">
									<option value="">--Sede--</option>
									<?php
									foreach ($sedes as $row) {
										$str = '<option value =' . $row->id . '>' . $row->nombre . '</option>';
										echo $str;
									}
									?>
								</select>
							</div>		
						</div>
						<div class="controls">
							<div class="input-prepend span3">
								<label>Tipo Articulo</label>
								<span class="add-on"><i class="icon-list"></i></span>
								<select class="span9" name="_tipo_articulo" id="_tipo_articulo">
									<option value="">--Tipo--</option>
									<?php
									foreach ($tipos_articulos as $row) {
										$str = '<option value =' . $row->id . '>' . $row->nombre . '</option>';
										echo $str;
									}
									?>
								</select>
							</div>		
						</div>
						<div class="controls">
							<div class="input-prepend span3">
								<label>Estado</label>
								<span class="add-on"><i class="icon-calendar"></i></span>
								<select class="span9" name="_status" id="_status">
									<option>--Todos--</option>
									<option value="A">Agotado</option>
								</select>
							</div>
						</div>
						<div class="controls">
							<div class="input-prepend span1">
								<label style="color:#fff;">Buscar</label>
								<button class="btn btn-primary " type="button" id="_buscar" title="Filtrar Busqueda"><i class="icon-search icon-white"></i></button>
								<button class="btn btn-primary " type="button" id="_exportar_xls" title="Descargar ODS"><i class="icon-download-alt icon-white"></i></button>

<!--<input type="submit">-->
							</div>		
						</div>

					</div>
				</div>
			</div>
		</div>	
	</div>
	<!--</form>-->
	<table id="tabla" class="table table-hover table-bordered table-striped">
		<thead>
			<tr style="background:#d44413; color: #FFF">
				<th class="span1">Id</th>
				<th class="span1">Sede</th>
				<th class="span3">Tipo Articulo</th>
				<th class="span5">Nombre</th>
				<th class="span1">Cantidad</th>
				<th class="span1">Opción</th>
			</tr>
		</thead>
		<tbody>
<?php
foreach ($articulos as $row) {
	$str = '<tr>' .
					'<td class="centrado">' . $row->id . '</td>' .
					'<td>' . $row->nombre_sede . '</td>' .
					'<td>' . $row->nombre_tipo_articulo . '</td>' .
					'<td>' . $row->nombre . '</td>' .
					'<td>' . $row->cantidad_disponible . '</td>' .
					'<td class="centrado">' .
					'<a class="btn btn-mini btn-warning" onclick="get(' . $row->id . ')">' .
					' <i class="icon-wrench icon-white"></i></a>' .
					' <a class="btn btn-mini btn-danger" onclick="eliminar(' . $row->id . ')">' .
					' <i class="icon-minus icon-white"></i></a>' .
					'</td>' .
					'</tr>';
	echo $str;
}
?>
		</tbody>
	</table>




	<div id="myModal" class="modal hide fade span8 offset2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="left:0;">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			<h4>Datos de Articulo</h4>
		</div>
		<div class="modal-body">
			<div class="controls">
				<div class="input-prepend span3">
					<label>Id</label>
					<span class="add-on"><i class="icon-barcode"></i></span>
					<input class="span10" name="id" type="text" placeholder="Id" disabled>
				</div>
			</div>
			<div class="controls">
				<div class="input-prepend span9">
					<label>Nombre</label>
					<span class="add-on"><i class="icon-info-sign"></i></span>
					<input class="span10" name="nombre" type="text" placeholder="Nombre" maxlength="100" required>
				</div>		
			</div>
			<div class="controls">
				<div class="input-prepend span3">
					<label>Sede</label>
					<span class="add-on"><i class="icon-home"></i></span>
					<select class="span9" name="sede" id="sede">
						<option>--Sede--</option>
<?php
foreach ($sedes as $row) {
	$str = '<option value =' . $row->id . '>' . $row->nombre . '</option>';
	echo $str;
}
?>
					</select>
				</div>		
			</div>
			<div class="controls">
				<div class="input-prepend span3">
					<label>Tipo Articulo</label>
					<span class="add-on"><i class="icon-list"></i></span>
					<select class="span9" name="tipo_articulo" id="tipo_articulo">
						<option>--Tipo--</option>
<?php
foreach ($tipos_articulos as $row) {
	$str = '<option value =' . $row->id . '>' . $row->nombre . '</option>';
	echo $str;
}
?>
					</select>
				</div>		
			</div>
			<div class="controls">
				<div class="input-prepend span3">
					<label>Color</label>
					<span class="add-on"><i class="icon-tint"></i></span>
					<input class="span10" name="color" type="text" value="N/A" placeholder="Color" maxlength="50">
				</div>		
			</div>
			<div class="controls">
				<div class="input-prepend span3">
					<label>Cantidad Inicial</label>
					<span class="add-on"><i class="icon-asterisk"></i></span>
					<input class="span10" name="cantidad_disponible" id="cantidad_disponible" type="text" value="0" >
				</div>		
			</div>
			<div class="controls">
				<div class="span11"  id="_mensaje_alerta">
				</div>		
			</div>
		</div>
		<div class="modal-footer">
			<button class="btn" data-dismiss="modal" aria-hidden="true">Cerrar</button>
			<button class="btn btn-primary pull-right" type="button" id="_guardar"><i class="icon-ok icon-white"></i> Guardar</button>
	<!--												<input type="submit">-->

		</div>
	</div>
</form>

<script type="text/javascript">var tb = '<?php echo $tb; ?>';</script>
<script src="<?php echo base_url(); ?>media/funcion_js/fn_articulos.js"></script>