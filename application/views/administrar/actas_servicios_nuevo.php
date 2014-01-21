<form class="span10 offset1">
	<!--<form class="span10 offset1" action="http://sistemas.fsbolivar.com.ve/servicios/agregar" method="post">-->
	<legend>Acta de Servicio</legend>
		<div class="row-fluid">
			<div class="controls">
				<div class="input-prepend span3">
					<label>Id</label>
					<span class="add-on"><i class="icon-barcode"></i></span>
					<input class="span10" name="id" type="text" placeholder="Id" disabled>
				</div>
			</div>
			<div class="controls">
				<div class="input-prepend span3">
					<label>Fecha</label>
					<span class="add-on"><i class="icon-calendar"></i></span>
					<input class="span10 fecha fecha2" name="fecha_servicio" type="text" placeholder="dd/mm/aaaa">
				</div>
			</div>
		</div>
		<div class="row-fluid">
		<div class="controls">
			<div class="input-prepend span3">
				<label>Sede</label>
				<span class="add-on"><i class="icon-home"></i></span>
				<select class="span10" name="sede" id="sede">
					<option>--Sede--</option>
					<?php 
						foreach ($sedes as $row)
						{
							$str = '<option value ='.$row->id.'>'.$row->nombre.'</option>';
							echo $str;
						} 		
					?>
				</select>
			</div>
		</div>
		<div class="controls">
			<div class="input-prepend span3">
				<label>Gerencia</label>
				<span class="add-on"><i class="icon-briefcase"></i></span>
				<select class="span10" name="gerencia" id="sede">
					<option>--Gerencia--</option>
					<?php 
						foreach ($gerencias as $row)
						{
							$str = '<option value ='.$row->id.'>'.$row->nombre.'</option>';
							echo $str;
						} 		
					?>
				</select>
			</div>
		</div>
		<div class="controls">
			<div class="input-prepend span3">
				<label>Entregado Por</label>
				<span class="add-on"><i class="icon-user"></i></span>
				<select class="span10" name="cedula" id="sede">
					<option>--Usuario--</option>
					<?php 
						foreach ($usuarios as $row)
						{
							$str = '<option value ='.$row->cedula.'>'.$row->nombre.' '.$row->apellido.'</option>';
							echo $str;
						} 		
					?>
				</select>
			</div>
		</div>
		<div class="controls">
			<div class="input-prepend span3">
				<label>Realizado a</label>
				<span class="add-on"><i class="icon-user"></i></span>
				<input class="span10" name="realizado_a" type="text" placeholder="Recibido por"  required>
			</div>
		</div>
	<!--</form>-->
	</div>
	<div class="row-fluid">
		<div class="controls">
			<div class="input-prepend span12">
				<label>Detalles del Servicio</label>
				<span class="add-on"><i class="icon-text-height"></i></span>
				<textarea class="span10" rows="10" name="detalle_servicio"></textarea>
			</div>
		</div>
	</div>
	<div class="row-fluid">
		<div class="controls">
			<div class="input-prepend span12">
				<!--<input type="submit" class="btn-large btn-primary  " value="Guardar">-->
					<div class="btn-group">
					<button class="btn btn-primary" type="button" id="_guardar"><i class="icon-ok icon-white"></i> Guardar</button>
<!--					<a href="<?php echo base_url().'servicios/pdf_acta_servicio/'.$actas_servicio_detalles->id;?>" class="btn btn-primary" target="_blank"><i class="icon-download-alt icon-white"></i> PDF</a>-->
					<a href="<?php echo base_url().'servicios';?>" class="btn btn-primary"><i class="icon-backward icon-white"></i> Regresar</a>
				
				</div>
			</div>
		</div>
	</div>
</form>

<script type="text/javascript">var tb = '<?php echo $tb;?>';</script>
<script src="<?php echo base_url();?>media/funcion_js/fn_actas_servicios.js"></script>