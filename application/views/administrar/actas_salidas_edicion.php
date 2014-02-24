<link rel="stylesheet" href="<?php echo base_url(); ?>media/jquery-editor/jquery-te-1.4.0.css" type="text/css" media="all">

<form id="formulario_edicion_salida" class="span10 offset1">
	<!--<form class="span10 offset1" action="http://sistemas.fsbolivar.com.ve/salidas/editar" method="post">-->
	<legend>Acta de Salida</legend>
	<div class="row-fluid">
		<div class="controls">
			<div class="input-prepend span3">
				<label>Id</label>
				<span class="add-on"><i class="icon-barcode"></i></span>
				<input class="span10" name="id" type="text" placeholder="Id" disabled="disabled"  value="<?php echo $actas_salidas_detalles->id; ?>">
				<input class="span10" name="id" type="hidden" placeholder="Id"  value="<?php echo $actas_salidas_detalles->id; ?>">
			</div>
		</div>
		<div class="controls">
			<div class="input-prepend span3">
				<label>Fecha</label>
				<span class="add-on"><i class="icon-calendar"></i></span>
				<input class="span10 fecha fecha2" name="fecha_entrega" type="text" placeholder="dd/mm/aaaa" value="<?php echo $actas_salidas_detalles->fecha_entrega; ?>">
			</div>
		</div>
		<div class="controls">
			<div class="input-prepend span3">
				<label>Sede</label>
				<span class="add-on"><i class="icon-home"></i></span>
				<select class="span10" name="sede" id="sede">
					<option value="<?php echo $actas_salidas_detalles->id_sede; ?>"><?php echo $actas_salidas_detalles->nombre_sede; ?></option>
					<?php
					foreach ($sedes as $row) {
						$str = '<option value =' . $row->id . '>' . $row->nombre . '</option>';
						echo $str;
					}
					?>
				</select>
			</div>
		</div>
		<div class="input-prepend span3">
			<label>Entregado Por</label>
			<span class="add-on"><i class="icon-user"></i></span>
			<select class="span10" name="cedula" id="sede">
				<option value="<?php echo $actas_salidas_detalles->cedula_usuario; ?>"><?php echo $actas_salidas_detalles->nombre_usuario . ' ' . $actas_salidas_detalles->apellido_usuario; ?></option>
				<?php
				foreach ($usuarios as $row) {
					$str = '<option value =' . $row->cedula . '>' . $row->nombre . ' ' . $row->apellido . '</option>';
					echo $str;
				}
				?>
			</select>
		</div>
	</div>
	<div class="row-fluid">
		<div class="controls">
			<div class="input-prepend span3">
				<label>Nombre de empresa</label>
				<span class="add-on"><i class="icon-user"></i></span>
				<input class="span10" name="nombre_compannia" type="text" placeholder="Recibido por"  required value="<?php echo $actas_salidas_detalles->nombre_compannia; ?>"> 
			</div>
		</div>
		<div class="controls">
			<div class="input-prepend span3">
				<label>Entregado a</label>
				<span class="add-on"><i class="icon-user"></i></span>
				<input class="span10" name="entregado_a" type="text" placeholder="Recibido por"  required value="<?php echo $actas_salidas_detalles->entregado_a; ?>">
			</div>
		</div>
		<!--</form>-->
	</div>
	<div class="row-fluid">
		<div class="controls">
			<div class="input-prepend span12">
				<label>Detalles de la entrega</label>
				<textarea class="span10" rows="10" name="detalle_entrega" id="detalle_servicio" style="height: 300px;"><?php echo $actas_salidas_detalles->nota; ?></textarea>
			</div>
		</div>
	</div>

	<div class="row-fluid">
		<div class="controls">
			<div class="input-prepend span12">
				<!--<input type="submit" class="btn-large btn-primary  " value="Guardar">-->
				<div class="btn-group">
					<button class="btn btn-primary" type="button" id="_guardar"><i class="icon-ok icon-white"></i> Guardar</button>
					<a href="<?php echo base_url() . 'salidas/pdf_acta_salida/' . $actas_salidas_detalles->id; ?>" class="btn btn-primary" target="_blank"><i class="icon-download-alt icon-white"></i> PDF</a>
					<a href="<?php echo base_url() . 'salidas'; ?>" class="btn btn-primary"><i class="icon-backward icon-white"></i> Regresar</a>

				</div>
			</div>
		</div>
	</div>
</form>



<script type="text/javascript">var tb = '<?php echo $tb; ?>';</script>
<script src="<?php echo base_url(); ?>media/funcion_js/fn_actas_salidas.js"></script>
<script src="<?php echo base_url(); ?>media/jquery-editor/jquery-te-1.4.0.min.js"></script>
<script>
	$("textarea").jqte();
</script>
</script>