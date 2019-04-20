<?php

if ($this->session->userdata('nombre') == null) {
    redirect(base_url() . 'index.php/welcome/logout');
}
include 'plantilla/header.php';

?>

<div id="content-wrapper">

        <div class="container-fluid">
<input type="hidden" name="rol" id="rol" value="<?php echo $this->session->userdata('rol') ?>">
           <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="#">SISTEMA</a>
            </li>
            <?php if ($this->session->userdata('rol') == 4) {?>
               <li class="breadcrumb-item active">SPA</li>
                <?php }?>

                <?php if ($this->session->userdata('rol') == 3) {?>
               <li class="breadcrumb-item active">INVENTARIOS</li>
                <?php }?>

                 <?php if ($this->session->userdata('rol') == 2) {?>
               <li class="breadcrumb-item active">ESTÉTICA</li>
                <?php }?>

                <?php if ($this->session->userdata('rol') == 1) {?>
               <li class="breadcrumb-item active">ADMINISTRADOR</li>
                <?php }?>


          </ol>
        <div class="row">

          <div class="col-md-3">
            <div class="row">

              <div class="col-md-12" >
                <h4 style="color: red; text-align: center;"><strong>Tablas con errores</strong></h4>
              </div>
             <?php
switch ($this->session->userdata('rol')) {
    case 1: ?>
                 <div class="col-md-12" style="max-height: 500px; overflow: auto; ">
                    <hr>
                     <h5 style="text-align: center; color: orange;">SISTEMA ESTÉTICA</h5>
                    <hr>
                   <div  id="numeroempleados" style="text-align: center;"></div>
               <div id="btnempleados" style="text-align: center;">
                   <button id="empleados" class="btn btn-success">Revisar</button>
                </div>
                    <div id="numeroPrductos" style="text-align: center;"></div>
                    <div id="btnproductos" style="text-align: center;">
                   <button id="productos" class="btn btn-success">Revisar</button>
                </div>

                    <div id="numeroctcolores" style="text-align: center;"></div>
                    <div id="btncolores" style="text-align: center;">
                   <button id="ct_colores" class="btn btn-success">Revisar</button>
                </div>

                     <div id="numeroturnos" style="text-align: center;"></div>
                     <div id="btnturnos" style="text-align: center;">
                   <button id="turnos" class="btn btn-success">Revisar</button>
                </div>

                    <div id="numeroespecialidad" style="text-align: center;"></div>
                    <div id="btnespecialidad" style="text-align: center;">
                   <button id="especialidad" class="btn btn-success">Revisar</button>
                </div>

                    <div id="numerotemporada" style="text-align: center;"></div>
                    <div id="btntemporada" style="text-align: center;">
                   <button id="temporada" class="btn btn-success">Revisar</button>
                </div>

                    <hr>
                     <h5 style="text-align: center; color: orange;">SISTEMA INVENTARIOS</h5>
                    <hr>
                     <div  id="numeroDevolucion" style="text-align: center;"></div>
                      <div id="btndevolucion" style="text-align: center;">
                      <button id="Devolucion" class="btn btn-success">Revisar</button>
                      </div>

                      <div id="numeroMarca"  style="text-align: center;"></div>
                      <div id="btnmarca" style="text-align: center;">
                      <button id="Marca" class="btn btn-success">Revisar</button>
                      </div>

                       <div id="numeroAlmacen"  style="text-align: center;"></div>
                       <div id="btnalmacen" style="text-align: center;">
                      <button id="Almacen" class="btn btn-success">Revisar</button>
                      </div>

                    <hr>
                     <h5 style="text-align: center; color: orange;">SISTEMA SPA</h5>
                    <hr>
                    <div  id="numeroclientes" style="text-align: center;"></div>
               <div id="btnclientes" style="text-align: center;">
                   <button id="clientes" class="btn btn-success">Revisar</button>
                </div>

                      <!-- VENTAS-->
              <div  id="numeroventas" style="text-align: center;"></div>
              <div id="btnventas" style="text-align: center;">
                 <button  id="ventas" class="btn btn-success">Revisar</button>
              </div>


               <!-- AGENDA-->
              <div  id="numeroagenda" style="text-align: center;"></div>
              <div id="btnagenda" style="text-align: center;">
                 <button  id="agenda" class="btn btn-success">Revisar</button>
              </div>


               <!-- COMPRAS-->
              <div  id="numerocompras" style="text-align: center;"></div>
              <div id="btncompras" style="text-align: center;">
                <button  id="compras" class="btn btn-success">Revisar</button>
              </div>

              <!-- PROVEEDORES-->
            <div  id="numeroproveedores" style="text-align: center;"></div>
            <div id="btnproveedores" style="text-align: center;" >
              <button  id="proveedores" class="btn btn-success">Revisar</button>
            </div>
                </div>
                  <?php
break;
    case 2: ?>
                    <div class="col-md-12" style="max-height: 500px; overflow: auto; ">
                  <div  id="numeroempleados" style="text-align: center;"></div>
               <div id="btnempleados" style="text-align: center;">
                   <button id="empleados" class="btn btn-success">Revisar</button>
                </div>
                    <div id="numeroPrductos" style="text-align: center;"></div>
                    <div id="btnproductos" style="text-align: center;">
                   <button id="productos" class="btn btn-success">Revisar</button>
                </div>

                    <div id="numeroctcolores" style="text-align: center;"></div>
                    <div id="btncolores" style="text-align: center;">
                   <button id="ct_colores" class="btn btn-success">Revisar</button>
                </div>

                     <div id="numeroturnos" style="text-align: center;"></div>
                     <div id="btnturnos" style="text-align: center;">
                   <button id="turnos" class="btn btn-success">Revisar</button>
                </div>

                    <div id="numeroespecialidad" style="text-align: center;"></div>
                    <div id="btnespecialidad" style="text-align: center;">
                   <button id="especialidad" class="btn btn-success">Revisar</button>
                </div>

                    <div id="numerotemporada" style="text-align: center;"></div>
                    <div id="btntemporada" style="text-align: center;">
                   <button id="temporada" class="btn btn-success">Revisar</button>
                </div>
                    </div>
                    <?php
break;
    case 3: ?>
                  <div class="col-md-12">

                  <div  id="numeroDevolucion" style="text-align: center;"></div>
                      <div id="btndevolucion" style="text-align: center;">
                      <button id="Devolucion" class="btn btn-success">Revisar</button>
                      </div>

                      <div id="numeroMarca"  style="text-align: center;"></div>
                      <div id="btnmarca" style="text-align: center;">
                      <button id="Marca" class="btn btn-success">Revisar</button>
                      </div>

                       <div id="numeroAlmacen"  style="text-align: center;"></div>
                       <div id="btnalmacen" style="text-align: center;">
                      <button id="Almacen" class="btn btn-success">Revisar</button>
                      </div>
                      
                  </div>
                     <?php
break;
    case 4: ?>



              <div class="col-md-12" style="max-height: 500px; overflow: auto;">
                     <!-- CLENTES-->
              <div  id="numeroclientes" style="text-align: center;"></div>
               <div id="btnclientes" style="text-align: center;">
                   <button id="clientes" class="btn btn-success">Revisar</button>
                </div>

                      <!-- VENTAS-->
              <div  id="numeroventas" style="text-align: center;"></div>
              <div id="btnventas" style="text-align: center;">
                 <button  id="ventas" class="btn btn-success">Revisar</button>
              </div>


               <!-- AGENDA-->
              <div  id="numeroagenda" style="text-align: center;"></div>
              <div id="btnagenda" style="text-align: center;">
                 <button  id="agenda" class="btn btn-success">Revisar</button>
              </div>


               <!-- COMPRAS-->
              <div  id="numerocompras" style="text-align: center;"></div>
              <div id="btncompras" style="text-align: center;">
                <button  id="compras" class="btn btn-success">Revisar</button>
              </div>

              <!-- PROVEEDORES-->
            <div  id="numeroproveedores" style="text-align: center;"></div>
            <div id="btnproveedores" style="text-align: center;" >
              <button  id="proveedores" class="btn btn-success">Revisar</button>
            </div>
        </div>


                  <?php
break;
    default:

        break;
}
?>
            </div>
          </div>
<div class="col-md-9">
            <div class="row">
              <div class="col-md-12" id="tabla">

              </div>

              <div class="col-md-12" style="max-height: 500px; overflow: auto;">
            <div class="alert alert-success" style="display: none;" ></div>
                <div class="alert alert-danger" style="display: none;" ></div>
            <table id="tabla"   class="table table-striped" style="margin-top: -5px; border: 1px solid #ccc;  height: 100px; overflow: auto;">
                        <thead id="cabeza" style="background-color: #FF0033; box-shadow: 2px 2px 5px #999; ">

                          </thead>
                        <tbody id="resultado" >

                        </tbody>

                    </table>

          </div>

            </div>


          </div>
        </div>


          </div>


        </div>

        <footer class="sticky-footer">
          <div class="container my-auto">
            <div class="copyright text-center my-auto">
              <span>Inteligencia Organizacional Basada en Tic's</span>
            </div>
          </div>
        </footer>
      </div>


 <?php
include 'plantilla/footer.php';
include 'mysql/modales/Editar_Agenda.php';
include 'mysql/modales/Editar_Cliente.php';
include 'mysql/modales/Editar_Compras.php';
include 'mysql/modales/Editar_Proveedores.php';
include 'mysql/modales/Editar_Ventas.php';
include 'mysql/modales/Eliminar.php';
include 'mysql/modales/EliminarTabla.php';
include 'postgresql/modales/EditarEmpleado.php';
include 'postgresql/modales/EditarProducto.php';
include 'postgresql/modales/EditarCTcolor.php';
include 'postgresql/modales/EditarTurnos.php';
include 'postgresql/modales/EditarEspecialidad.php';
include 'postgresql/modales/EditarTemporada.php';
include 'postgresql/modales/Eliminar.php';
include 'Excel/modales/Editar_devolucion.php';
include 'Excel/modales/Editar_Marcas.php';
include 'Excel/modales/Editar_almacen.php';
?>

<!--Charly-->
<script type="text/javascript" src="<?php echo base_url(); ?>postgresql/js/empleado.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>postgresql/js/productos.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>postgresql/js/ct_colore.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>postgresql/js/turnos.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>postgresql/js/especialidad.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>postgresql/js/temporadas.js"></script>

<!--Tintos-->
    <script type="text/javascript" src="<?php echo base_url(); ?>Excel/js/devoluciones.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>Excel/js/Marcas.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>Excel/js/almacen.js"></script>

<!--Rorro-->
    <script type="text/javascript" src="<?php echo base_url(); ?>mysql/js/agenda.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>mysql/js/clientes.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>mysql/js/compras.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>mysql/js/proveedores.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>mysql/js/ventas.js"></script>




