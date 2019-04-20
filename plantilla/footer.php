</div>

    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Alerta!</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">Esta a punto de cerrar la sessión confirme la acción</div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
            <a class="btn btn-primary" href="<?php echo base_url(); ?>index.php/welcome/logout">Cerrar Sessión</a>
          </div>
        </div>
      </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="<?php echo base_url() ?>js/jquery.min.js"></script>
    <script src="<?php echo base_url() ?>js/bootstrap.bundle.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="<?php echo base_url() ?>js/jquery.easing.min.js"></script>
    <!-- Custom scripts for all pages-->


    <script src="<?php echo base_url() ?>js/sb-admin.min.js"></script>




<script type="text/javascript">
 $("#btndevolucion").hide();
 $("#btnmarca").hide();
 $("#btnalmacen").hide();
 $("#btnempleados").hide();
 $("#btnclientes").hide();
 $("#btncompras").hide();
 $("#btnproveedores").hide();
 $("#btnventas").hide();
 $("#btnagenda").hide();
 $("#btnproductos").hide();
 $("#btncolores").hide();
 $("#btnturnos").hide();
 $("#btnespecialidad").hide();
 $("#btntemporada").hide();

</script>





    <!-- Libreria de la Graficas-->
    <script src="<?php echo base_url() ?>js/Chart.js"></script>
  </body>

</html>
