
<link href="<?php echo base_url();?>media/css/bootstrap-timepicker.min.css" rel="stylesheet">
<script src="<?php echo base_url();?>media/js/bootstrap-timepicker.min.js"></script>

<form class="span10 offset1">
	<!--<form class="span10 offset1" action="http://sistemas.fsbolivar.com.ve/actividad/buscar" method="post">-->
	<legend>Administración de Actividades</legend>
		<!-- Button to trigger modal -->
		<div class="accordion" id="accordion2">
                <div class="accordion-group" style="border-color:#FFF ">
                  <div class="accordion-heading accordion-toggle" style=" height:25px;">
                    <a class="collapsed text-info" data-toggle="collapse" data-parent="#accordion2" href="#collapseOne" style="margin-top:5px; ">
                     Busqueda Avanzada <i class="icon-search"></i>
                    </a>
				  <a href="#myModal" role="button" class="btn btn-primary pull-right" data-toggle="modal" style="margin-bottom:10px; ">
				  <i class="icon-plus-sign icon-white"></i> Agregar Actividad</a>				
                  </div>
                  <div id="collapseOne" class="accordion-body collapse" style="height: 0px;">
                    <div class="accordion-inner span12">
						<div class="control-group">
							<div class="controls">
								<div class="input-prepend span3">
									<label>Sede</label>
									<span class="add-on"><i class="icon-home"></i></span>
									<select class="span9" name="_sede" id="_sede">
										<option value="">--Sede--</option>
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
									<label>Lugar</label>
									<span class="add-on"><i class="icon-list"></i></span>
									<select class="span9" name="_lugar" id="_gerencia">
										<option value="">--Lugar--</option>
										
									</select>
								</div>		
							</div>
							<div class="controls">
								<div class="input-prepend span3">
									<label>Fecha Inicio</label>
									<span class="add-on"><i class="icon-calendar"></i></span>
									<input class="span9 fecha" name="_fecha_inicio" type="text" placeholder="Fecha Inicio">
								</div>
							</div>
							<div class="controls">
								<div class="input-prepend span3">
									<label>Fecha Final</label>
									<span class="add-on"><i class="icon-calendar"></i></span>
									<input class="span9 fecha" name="_fecha_final" type="text" placeholder="Fecha Final">
								</div>
							</div>
							<div class="controls">
									<div class="input-prepend span1">
										<label style="color:#fff;">Buscar</label>
										<button class="btn btn-primary " type="button" id="_buscar"><i class="icon-search icon-white"></i></button>
										<button class="btn btn-primary " type="button" id="_exportar_xls"><i class="icon-download-alt icon-white"></i></button>
										
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
					<th class="span1">ID</th>
					<th class="span4">Nombre</th>
					<th class="span2">Lugar</th>
					<th class="span2">Fecha / Hora</th>
					<th class="span2">Responsable</th>
					<th class="span1">Edicion</th>
				</tr>
			</thead>
			<tbody>
			<?php
			foreach ($lista as $row)
			{
				if($row->id_status_actividad==1)
					$clase='success';
				if($row->id_status_actividad==3)
					$clase='warning';
				if($row->id_status_actividad==2)
					$clase='error';
				$str = '<tr class="'.$clase.'">'.
					'<td class="centrado">'.$row->id.'</td>'.
					'<td>'.ucwords(strtolower($row->nombre)).'</td>'.
					'<td class="centrado">'.$row->lugar.' ('.$row->sede.')</td>'.
					'<td class="centrado">'.$row->fecha_inicio.' al '.$row->fecha_final.' <br> '.$row->hora_inicio.'/'.$row->hora_final.'</td>'.
					'<td class="centrado">'.$row->responsable.'</td>'.
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


<div id="myModal" class="modal hide fade span10 offset1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="left:0;">
	<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h4>Datos de Actividad</h4>
  </div>
  <div class="modal-body">
		<div class="controls">
			<div class="input-prepend span3">
				<label>ID</label>
				<span class="add-on"><i class="icon-barcode"></i></span>
				<input class="span9" name="id" type="text" placeholder="ID" maxlength="8" disabled>
			</div>
		</div>
		<div class="controls">
			<div class="input-prepend span9">
				<label>Nombre</label>
				<span class="add-on"><i class="icon-book"></i></span>
				<input class="span10" name="nombre" type="text" placeholder="Nombre" maxlength="255" required>
			</div>		
		</div>
		<div class="controls">
			<div class="input-prepend span3">
				<label>Fecha de Inicio</label>
				<span class="add-on"><i class="icon-calendar"></i></span>
				<input class="span9 fecha" name="fecha_inicio" type="text" placeholder="Fecha Inicio" maxlength="20" required>
			</div>		
		</div>
		<div class="controls">
			<div class="input-prepend span3">
				<label>Fecha de Fin</label>
				<span class="add-on"><i class="icon-calendar"></i></span>
				<input class="span9 fecha" name="fecha_final" type="text" placeholder="Fecha Final" maxlength="20" required>
			</div>		
		</div>
		<div class="controls">
			<div class="input-prepend span3 bootstrap-timepicker">
				<label>Hora Inicio</label>
				<span class="add-on"><i class="icon-time"></i></span>
				<input class="span9 tiempo" name="hora_inicio" type="text"  placeholder="Hora Inicio" maxlength="20" required>
			</div>		
		</div>
		<div class="controls">
			<div class="input-prepend span3 bootstrap-timepicker">
				<label>Hora Final</label>
				<span class="add-on"><i class="icon-time"></i></span>
				<input class="span9 tiempo" name="hora_final" type="text" id="timepicker" placeholder="Hora final" maxlength="20" required>
			</div>		
		</div>
		<div class="controls">
			<div class="input-prepend span3">
				<label>Responsable</label>
				<span class="add-on"><i class="icon-user"></i></span>
				<select class="span9" name="cedula_usuario" required>
					<?php
					foreach ($usuario as $row)
					{
						$str = '<option value="'.$row->cedula.'">'.$row->nombre.'</option>';
						echo $str;
					}
					?>
				</select>
			</div>		
		</div>
		<div class="controls">
			<div class="input-prepend span3 ">
				<label>Lugar</label>
				<span class="add-on"><i class="icon-globe"></i></span>
				<select class="span9" name="id_lugar" required>
					<?php
					foreach ($lugar as $row)
					{
						$str = '<option value="'.$row->id.'">'.$row->nombre.' ('.$row->sede.')</option>';
						echo $str;
					}
					?>
				</select>
			</div>		
		</div>
		<div class="controls">
			<div class="input-prepend span3">
				<label>Status</label>
				<span class="add-on"><i class="icon-flag"></i></span>
				<select class="span9" name="id_status_actividad" required>
					<?php
					foreach ($status_actividad as $row)
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

<script>
	$('.fecha').datepicker({
		format: 'dd-mm-yyyy',
		language: 'es'
	});
	
	$('.tiempo').timepicker({
                minuteStep: 1,
                template: 'modal'
            });
</script>

<script type="text/javascript">var tb = '<?php echo $tb;?>';</script>
<script src="<?php echo base_url();?>media/funcion_js/fn_actividad.js"></script>