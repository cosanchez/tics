<?php 

$nombre = $this->session->userdata('nombre');

	if ($nombre!=null) {
			

		redirect (base_url().'index.php/welcome/ETL');
		
		}



?>



<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

	<title>login</title>
	
	<link href="<?php echo base_url();?>css/login/bootstrap.min.css" rel="stylesheet">
	<link href="<?php echo base_url();?>css/signin.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/login2.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/index.css">

	<script type="text/javascript" src="<?php echo base_url();?>js/jquery-3.1.1.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>js/bootstrap.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>js/login2.js"></script>

	<script type="text/javascript" src="<?php echo base_url();?>mysql/js/RegistrarUsuario.js"></script>

	
</head>
<body>

	<div class="container">
		<div class="logo" >
          <img src="<?php echo base_url();?>img/logo.png">
          <div class="alert alert-success" style="display: none;" ></div>
         <div class="alert alert-danger" style="display: none;" ></div>
        </div>
    	<div class="row">
			<div class="col-md-4 col-md-offset-4">
				<div class="panel panel-login">
					<div class="panel-heading">
						<div class="row">
							<div class="col-xs-6">
								<a href="#" class="active" id="login-form-link">Inicie Sesión</a>
							</div>
							<div class="col-xs-6">
								<a href="#" id="register-form-link">Regístrate</a>
							</div>
						</div>
						<hr>
					</div>
					<div class="panel-body">
						<div class="row">
							<div class="col-lg-12">
								<form id="login-form" action="" method="post" role="form" style="display: block;">
									<div class="form-group">
										<input type="text" name="usuario" id="usuario" tabindex="1" class="form-control" placeholder="&#128100; Usuario" required>
									</div>
									<div class="form-group">
										<input type="password" name="contraseña" id="contraseña" tabindex="2" class="form-control" placeholder="&#128272; Contraseña" required>
									</div>
									
									<div class="form-group">
										<div class="row">
											<div class="col-sm-6 col-sm-offset-3">
												<input type="submit" name="login-submit" id="login-submit" tabindex="4" class="form-control btn btn-login" value="Inicar">
											</div>
										</div>
									</div>
									
								</form>
								<form id="register-form" action="" method="post" style="display: none;">
									
									<div class="form-group">
										<input type="text" name="usuario" id="user" tabindex="1" class="form-control" placeholder="Nombre" required>
									</div>
									<div class="form-group">
										<input type="text" name="apellido" id="apellido" tabindex="1" class="form-control" placeholder="Apellido" required>
									</div>
									
									<div class="form-group">
										<input type="password" name="contraseña" id="password" tabindex="2" class="form-control" placeholder="Contraseña" required>
									</div>
									<div class="form-group">
										<select class="form-control" name="rol">
											<option> Seleccionar </option>
											<?php
						                      foreach ($roles as $key => $values){?>
						                        <option  id="idcm" value="<?php echo $values['IdRol']; ?>"><?php echo $values['Sistema'];?></option>
						                      }
						                     <?php  } ?>
										</select>
									</div>
									
									<div class="form-group">
										<div class="row">
											<div class="col-sm-6 col-sm-offset-3">
												<input type="submit" name="register-submit" id="register-submit" tabindex="4" class="form-control btn btn-register" value="Registrar">
											</div>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

</body>
</html>
