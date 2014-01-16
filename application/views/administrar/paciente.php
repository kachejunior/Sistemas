

<form class="span10 offset1"  id="form-paciente" action="<?php echo base_url().'paciente/exporte_xls';?>" method='post'>
<!--<form class="span10 offset1" action="http://mujervf.fsbolivar.com.ve/paciente/buscar" method="post">-->
	<h2>Administración de Pacientes</h2>
		<!-- Button to trigger modal -->
			<div class="accordion" id="accordion2">
                <div class="accordion-group" style="border-color:#FFF ">
                  <div class="accordion-heading accordion-toggle" style=" height:25px;">
                    <a class="collapsed text-info" data-toggle="collapse" data-parent="#accordion2" href="#collapseOne" style="margin-top:5px; ">
                     Busqueda Avanzada <i class="icon-search"></i>
                    </a>
				  <a href="#myModal" role="button" class="btn-info btn-small pull-right" data-toggle="modal">
				  <i class="icon-plus-sign icon-white"></i> Agregar Paciente</a>						
                  </div>
                  <div id="collapseOne" class="accordion-body collapse" style="height: 0px;">
                    <div class="accordion-inner span12">
						<div class="control-group">					
							<div class="controls">
								<div class="input-prepend span3">
									<label>Cedula</label>
									<span class="add-on"><i class="icon-barcode"></i></span>
									<input class="span9 positive-integer" name="_cedula" type="text" placeholder="Cedula">
								</div>
							</div>

							<div class="controls">
								<div class="input-prepend span3">
									<label>Nombre/Apellido</label>
									<span class="add-on"><i class="icon-barcode"></i></span>
									<input class="span9" name="_nombre" type="text" placeholder="Nombre/Apellido"  onkeyup="aMays(event, this)">
								</div>
							</div>

							<div class="controls">
								<div class="input-prepend span3">
									<label>Estado</label>
									<span class="add-on"><i class="icon-ok"></i></span>
									<select class="span9" name="_esterilizada">
										<option value="">--Todos--</option>
										<option value="no">En Proceso</option>
										<option value="si">Esterilizada</option>
										<option value="tq">Tratamiento Quirurgico</option>
									</select>
								</div>		
							</div>

							<div class="controls">
								<div class="input-prepend span3">
									<label>Municipio</label>
									<span class="add-on"><i class="icon-home"></i></span>
									<select class="span9" name="_municipio">
										<option value="">--Todos--</option>
										<?php foreach ($municipios as $row)
												{
													$str = '<option value ='.$row->id.'>'.$row->detalle.'</option>';
													echo $str;
												} 		
										?>
									</select>
								</div>		
							</div>
							<div class="controls">
								<div class="input-prepend span3">
									<label>Fecha Inicio Atencion</label>
									<span class="add-on"><i class="icon-calendar"></i></span>
									<input class="span9 fecha" name="_fecha_inicio" type="text" placeholder="Fecha Inicio">
								</div>
							</div>
							<div class="controls">
								<div class="input-prepend span3">
									<label>Fecha Final Atencion</label>
									<span class="add-on"><i class="icon-calendar"></i></span>
									<input class="span9 fecha" name="_fecha_final" type="text" placeholder="Fecha Final">
								</div>
							</div>
							<div class="controls">
									<div class="input-prepend span1">
										<label style="color:#fff;">Buscar</label>
										<button class="btn btn-info " type="button" id="_buscar"><i class="icon-search icon-white"></i>Buscar</button>
										<input  type="submit" class="btn btn-info" type="button" id="_buscar" style='margin-left: 10px;' value="Exportar XLS">
										<!--<input type="submit">-->
									</div>		
							</div>
							
                    </div>
                  </div>
                </div>
              </div>	
		</div>
		</form>
		<form class="span10 offset1"  id="form-paciente">
		<table id="tabla" class="table table-hover table-bordered table-striped" >
			<thead>
				<tr style="background:#802c59; color: #FFF ">
					<th class="span1">N</th>
					<th class="span1">Cedula</th>
					<th class="span3">Nombre y Apellido</th>
					<th class="span2">F. Nacimiento</th>
					<th class="span2">Municipio</th>
					<th class="span2">Telefono</th>
					<th class="span1">Estatus</th>
					<th class="span1" >Edicion</th>
				</tr>
			</thead>
			<tbody>
			<?php
			$numero_guia = 1;
			foreach ($paciente as $row)
			{
				if($row->esterilizada=='si')
					$clase='success';
				if($row->esterilizada=='no')
					$clase='info';
				if($row->esterilizada=='tq')
					$clase='warning';
				$str = '<tr class="'.$clase.'" style="text-transform: uppercase">'.
					'<td class="centrado">'.$numero_guia.'</td>'.
					'<td class="centrado">'.$row->cedula.'</td>'.
					'<td>'.ucwords(strtolower($row->nombre)).' '.ucwords(strtolower($row->apellido)).'</td>'.	
					'<td class="centrado">'.$row->fecha_nacimiento.'</td>'.
					'<td class="centrado">'.$row->detalle.'</td>'.
					'<td class="centrado">'.$row->telefono1.'</td>'.
					'<td class="centrado">'.$row->esterilizada.'</td>'.			
					'<td class="centrado">';		
			 if($this->session->userdata('grupo_usuario')==1) { 
				$str=$str.'<a class="btn btn-mini btn-warning" onclick="get(\''.$row->cedula.'\')">'.
						' <i class="icon-wrench icon-white"></i></a>';
				$str=$str.' <a class="btn btn-mini btn-danger" onclick="eliminar(\''.$row->cedula.'\')">'.
						' <i class="icon-minus icon-white"></i></a>';
			}
			 if($this->session->userdata('grupo_usuario')==2) { 
				$str=$str.'<a class="btn btn-mini btn-warning" onclick="get(\''.$row->cedula.'\')">'.
						' <i class="icon-wrench icon-white"></i></a>';
			}
				$str=$str.'</td>'.			
					'</tr>';
				echo $str;
				$numero_guia=$numero_guia+1;
			}
			?>
			</tbody>
		</table>
		<div class="pagination" id="paginacion">
			<ul>
				<?php  if($pagina>1) { ?><li><a href="<?php $antes = $pagina-1; echo base_url().'paciente/p/'.$antes; ?>">Anterior</a></li><?php }?>
				<?php 
					$i=1;
					while ($i<=$paginas+1) {
					echo '<li><a href="'.  base_url().'paciente/p/'.$i.'">'.$i.'</a></li>';
					$i++;
				}?>
				<?php  if($pagina<$paginas) { ?><li><a href="<?php $siguiente = $pagina+1; echo base_url().'paciente/p/'.$siguiente; ?>">Siguiente</a></li><?php }?>
			</ul>
		</div>
			



<div id="myModal" class="modal hide fade span10 offset1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="left:0; ">
	<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h2>Datos de Paciente <small class="text-info" id="agregado"></small></h2>
  </div>
  <div class="modal-body" id="_formulario">
		<fieldset>
			<legend>Datos Personales</legend>
			<div class="controls">
				<div class="input-prepend span3">
					<label>Cedula</label>
					<span class="add-on"><i class="icon-barcode"></i></span>
					<input class="span9 cedula" name="cedula" id="cedula" type="text" placeholder="Ejem: V-5555555" >
					<input name="bandera" type="hidden" value="0">
				</div>
			</div>
			<div class="controls">
				<div class="input-prepend span3">
					<label>Nombre</label>
					<span class="add-on"><i class="icon-user"></i></span>
					<input class="span9" name="nombre" type="text" placeholder="Nombre" maxlength="255" required  onkeyup="aMays(event, this)">
				</div>		
			</div>
			<div class="controls">
				<div class="input-prepend span3">
					<label>Apellido</label>
					<span class="add-on"><i class="icon-user"></i></span>
					<input class="span9" name="apellido" type="text" placeholder="Apellido" maxlength="255" required  onkeyup="aMays(event, this)">
				</div>		
			</div>
			<div class="controls">
				<div class="input-prepend span3">
					<label>Fecha de Nacimiento</label>
					<span class="add-on"><i class="icon-calendar"></i></span>
					<input class="span9 fecha2" name="fecha_nacimiento"   id="fecha_nacimiento" type="text" placeholder="aaaa-mm-dd" maxlength="20" required>
				</div>		
			</div>
			<div class="controls">
				<div class="input-prepend span3">
					<label>Telefono1</label>
					<span class="add-on"><i class="icon-headphones"></i></span>
					<input class="span9 telefono " name="telefono1" type="text" placeholder="Telefono1" maxlength="20" required>
				</div>		
			</div>
			<div class="controls">
				<div class="input-prepend span3">
					<label>Telefono2</label>
					<span class="add-on"><i class="icon-headphones"></i></span>
					<input class="span9 telefono" name="telefono2" type="text" placeholder="Telefono2" maxlength="20" >
				</div>		
			</div>
		</fieldset>
		<fieldset>
			<legend>Datos de Direccion</legend>
			<div class="controls">
				<div class="input-prepend span12">
					<label>Direccion</label>
					<span class="add-on"><i class="icon-home"></i></span>
					<input class="span10" name="direccion" type="text" placeholder="Direccion"  onkeyup="aMays(event, this)">
				</div>		
			</div>
			<div class="controls">
				<div class="input-prepend span3">
					<label>Municipio</label>
					<span class="add-on"><i class="icon-home"></i></span>
					<select class="span9" name="municipio" id="municipio">
						<option>--Municipio--</option>
						<?php foreach ($municipios as $row)
								{
									$str = '<option value ='.$row->id.'>'.$row->detalle.'</option>';
									echo $str;
								} 		
						?>
					</select>
				</div>		
			</div>
			<div class="controls">
				<div class="input-prepend span3">
					<label>Parroquia</label>
					<span class="add-on"><i class="icon-home"></i></span>
					<select class="span9" name="parroquia" id="parroquia">
						<option>--Parroquia--</option>
					</select>
				</div>		
			</div>
		</fieldset>
		<fieldset>
			<legend>Datos de Atencion</legend>
			<div class="controls">
				<div class="input-prepend span3">
					<label>Fecha de Atencion</label>
					<span class="add-on"><i class="icon-calendar"></i></span>
					<input class="span9 fecha2" name="fecha_atencion"  id="fecha_atencion" type="text" placeholder="aaaa-mm-dd" maxlength="20" required>
				</div>		
			</div>
			<div class="controls">
				<div class="input-prepend span3">
					<label>Numero de Hijos</label>
					<span class="add-on"><i class="icon-signal"></i></span>
					<input class="span9 positive-integer" name="n_hijos" type="number" min="0" value="0"  required>
				</div>		
			</div>
			<div class="controls">
				<div class="input-prepend span3">
					<label>Esterilizada</label>
					<span class="add-on"><i class="icon-ok"></i></span>
					<select class="span9" name="esterilizada">
						<option value="no">En Proceso</option>
						<option value="si">Esterilizada</option>
						<option value="tq">Tratamiento Quirurgico</option>
					</select>
				</div>		
			</div>
			<div class="controls">
				<div class="input-prepend span3">
					<label>Fecha de Esterilizacion</label>
					<span class="add-on"><i class="icon-calendar"></i></span>
					<input class="span9 fecha2" name="fecha_esterilizacion" id="fecha_esterilizacion" type="text" placeholder="aaaa-mm-dd" maxlength="20">
					<span class="help-block">aaaa-mm-dd</span>
				</div>		
			</div>
			<div class="controls">
				<div class="input-prepend span12">
					<label>Observacion</label>
					<span class="add-on"><i class="icon-search"></i></span>
					<input class="span10" name="observacion" type="text" placeholder="observacion"   onkeyup="aMays(event, this)">
				</div>		
			</div>
		</fieldset>
	</div>
  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true" id="_cerrar">Cerrar</button>
		<button class="btn btn-info pull-right" type="button" id="_guardar"><i class="icon-ok icon-white"></i> Guardar</button>
		<!--<input type="submit">-->
  </div>
</div>
</form>

<script type="text/javascript">var tb = '<?php echo $tb;?>';</script>
<script src="<?php echo base_url();?>media/funcion_js/fn_paciente.js"></script>