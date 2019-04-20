<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>INICIO</title>

    <!-- Bootstrap core CSS-->
    <link href="<?php echo base_url() ?>css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template-->
    <link href="<?php echo base_url() ?>css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Custom styles for this template-->
    <link href="<?php echo base_url() ?>css/sb-admin.css" rel="stylesheet">
     <!--Mis Estilos-->
    <link rel="stylesheet" href="<?php echo base_url() ?>css/EstilosTabla.css">

  </head>

  <body id="page-top">

    <nav class="navbar navbar-expand navbar-dark bg-dark static-top  ">

      <a class="navbar-brand mr-1" href="#">ETL</a>

      <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
        <i class="fas fa-bars"></i>
      </button>

      <!-- Navbar Search -->
      <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">

      </form>

<span  style="color: white;">Usuario: <?php echo $this->session->userdata('nombre'); ?></span>
      <!-- Navbar -->
      <ul class="navbar-nav ml-auto ml-md-0">

        <li class="nav-item dropdown no-arrow">
          <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

            <i class="fas fa-user-circle fa-fw"></i>
          </a>
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">

            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">Salir</a>
          </div>
        </li>
      </ul>

    </nav>
    
    <div id="wrapper">

      <!-- Sidebar -->
      <ul class="sidebar navbar-nav">

        <?php if ($this->session->userdata('rol') == 1) {?>
        <li class="nav-item dropdown no-arrow mx-1">
          <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-chart-area"></i>
            <span>Listas Dinamicas</span>
          </a>
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="alertsDropdown" style="background-color: #212529; border: 0px">
            <a id="e" class="dropdown-item" href="<?php echo base_url() ?>index.php/Posgrees/LDEstetica" style="color: white">
              <i class="fas fa-cut"></i>
              <span>   Estetica</span>
            </a>
            <a  id="e" class="dropdown-item" href="<?php echo base_url() ?>index.php/Excel/LDExcel" style="color: white">
              <i class="fas fa-file-alt"></i>
              <span>   Inventario</span>
            </a>
            <a  id="e" class="dropdown-item" href="<?php echo base_url() ?>index.php/Mysql/LDSpa" style="color: white">
              <i class="fas fa-spa"></i>
              <span>   Spa</span>
            </a>
          </div>
          <style type="text/css">
            #e:hover {
              background-color: gray;
            }
          </style>
        </li>

        <li class="nav-item dropdown no-arrow mx-1">
          <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-cube"></i>
            <span>Cubos de datos</span>
          </a>
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="alertsDropdown" style="background-color: #212529; border: 0px">
            <a id="e" class="dropdown-item" href="<?php echo base_url() ?>index.php/Posgrees/CDEstetica" style="color: white">
              <i class="fas fa-cut"></i>
              <span>   Estetica</span>
            </a>
            <a  id="e" class="dropdown-item" href="<?php echo base_url() ?>index.php/Excel/CDExcel" style="color: white">
              <i class="fas fa-file-alt"></i>
              <span>   Inventario</span>
            </a>
            <a  id="e" class="dropdown-item" href="<?php echo base_url() ?>index.php/Mysql/CDSpa" style="color: white">
              <i class="fas fa-spa"></i>
              <span>   Spa</span>
            </a>
          </div>
        </li>
<?php }?>
        <?php
$id_usuario = $this->session->userdata('id_usuario');
$resultado  = $this->Login->ETL($id_usuario);

?>

         <?php if ($this->session->userdata('rol') == 1) {?>


          <?php if ($resultado['etl'] == 4) {?>


            <li  class="nav-item">
          <a  class="nav-link" href="<?php echo base_url() ?>index.php/welcome/Tablas"  >
            <i  class="fas fa-fw fa-table"></i>
            <span >Cargar ETL</span></a>
        </li>
      <?php }?>

        <?php if ($resultado['etl'] == 3) {?>

          <li class="nav-item">
          <a class="nav-link" href="<?php echo base_url() ?>index.php/welcome/Cerrar_etl">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Cerrar ETL</span></a>
        </li>
      <?php }?>
         <?php }?>

         <?php if ($resultado['etl'] == 0) {?>

           <li class="nav-item active" >
          <a class="nav-link" href="#" >
            <span class="btn btn-success" style="overflow: hidden;">ETL Cargado</span>
          </a>
        </li>
       <?php }?>


       <?php if ($resultado['etl'] == 1) {?>


         <li class="nav-item active" >
          <a class="nav-link" href="#" >
            <span class="btn btn-warning" style="overflow: hidden;">ETL en proceso</span>
          </a>
        </li>

       <?php }?>


         <?php if ($resultado['etl'] == 2) {?>

             <li class="nav-item active" >
          <a class="nav-link" href="#" >
            <span class="btn btn-danger" style="overflow: hidden;">ETL Cerrado</span>
          </a>
        </li>



       <?php }?>



      </ul>

