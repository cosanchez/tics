<?php 
$this->session->userdata('nombre');
if ($this->session->userdata('nombre')!=null) {
redirect (base_url().'index.php/welcome/home');
}
 ?>


<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
  
    <title>Login</title>

    <!-- Bootstrap core CSS -->

    <link href="<?php echo base_url();?>css/bootstrap.min.css" rel="stylesheet">

    <!--<link href="<?php echo base_url();?>css/login/bootstrap.min.css" rel="stylesheet">-->

    <!-- Custom styles for this template -->
    <link href="<?php echo base_url();?>css/signin.css" rel="stylesheet">

    
  </head>

  <body>

    <div class="container">

      <form class="form-signin" action="" method="POST">
      <div class="logo" >
          <img src="<?php echo base_url();?>img/logo.png">
        </div>
        <h2 class="form-signin-heading" style="text-align: center;">Inicie Sesión</h2>
        <label for="user" class="sr-only">Username</label>
        <input type="text" id="user" name="usuario" class="form-control" placeholder="&#128100; Usuario" required autofocus>
        <label for="password" class="sr-only">Password</label>
        <input type="password" id="password" name="contraseña" class="form-control" placeholder="&#128272; Contraseña" required>
        
        <button class="btn btn-lg btn-primary btn-block" type="submit">Entrar</button>
      </form>

    </div> <!-- /container -->
  </body>
</html>