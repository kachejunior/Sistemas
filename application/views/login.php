<div class="span10 offset1">
	<div class="page-header">
			<h1 class="text-info" style="font-style: italic;">Mujer Vida y Futuro</h1>
			<h4 style="font-style: italic;">Sistema de Registro de Pacientes</h4>
	</div>

	<div class="span7 hidden-phone">
		<div id="myCarousel" class="carousel slide">
			<ol class="carousel-indicators">
				<li data-target="#myCarousel" data-slide-to="0" class="active"></li>
				<li data-target="#myCarousel" data-slide-to="1"></li>
				<li data-target="#myCarousel" data-slide-to="2"></li>
				<li data-target="#myCarousel" data-slide-to="3"></li>
				<li data-target="#myCarousel" data-slide-to="4"></li>
				<li data-target="#myCarousel" data-slide-to="5"></li>
			</ol>
			<!-- Carousel items -->
			<div class="carousel-inner">
				<div class="active item"><img src="<?php echo base_url(); ?>media/img/0.jpg">
				</div>
				<div class="item"><img src="<?php echo base_url(); ?>media/img/1.jpg"></div>
				<div class="item"><img src="<?php echo base_url(); ?>media/img/2.jpg">
				</div>
				<div class="item"><img src="<?php echo base_url(); ?>media/img/3.jpg">
				</div>
				<div class="item"><img src="<?php echo base_url(); ?>media/img/4.jpg"></div>
				<div class="item"><img src="<?php echo base_url(); ?>media/img/5.jpg"></div>
			</div>
			<!-- Carousel nav -->
			<a class="carousel-control left" href="#myCarousel" data-slide="prev">&lsaquo;</a>
			<a class="carousel-control right" href="#myCarousel" data-slide="next">&rsaquo;</a>
		</div>
	</div>
	
	<div class="span4">
			<form id="formulario" class="well">
				<!--<form class="span10 offset1" action="http://mujervf.fsbolivar.com.ve/usuarios/iniciar_session" method="post">-->
				<legend>Iniciar Sesión</legend>
				<div class="controls">
					<div class="input-prepend span12">
						<label>Cedula</label>
						<span class="add-on"><i class="icon-user"></i></span>
						<input class="positive-integer span11" type="text" name="cedula" maxlength="10" placeholder="Cedula" required autocomplete="off">
					</div>
				</div>
				<div class="controls">
					<div class="input-prepend span12">
						<label>Password</label>
						<span class="add-on"><i class="icon-certificate"></i></span>
						<input class="span11" type="password" name="clave" placeholder="Password" required>
					</div>
				</div>
				<div class="controls">
					<div  id="_alerta">
						
					</div>
				</div>
				<div class="controls">
					<button type="submit" class="btn btn-primary" id="_login" data-loading-text="Verificando....">Acceder</button>
				</div>
		</form>
	</div>
</div>

<script src="<?php echo base_url();?>media/funcion_js/fn_login.js"></script>