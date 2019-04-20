
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-show-password/1.0.3/bootstrap-show-password.min.js"></script>
 <!--Modal agregar usuario-->

    <div id="myModalVentas" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header" >
                <img src="<?=base_url();?>mysql/img/ventas.png" width="70" height="70" class="d-inline-block align-top" >
                    <h4 class="modal-title" style="margin-top: 10px;"> </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span> </button>
                </div>
                <div class="modal-body">

                        <form id="myFormVentas" action="" method="post" >
                        <input type="hidden" name="id_venta" value="0">
                        <div class="row">
                            
                            <div class="col-md-4 mb-3">
                                    <label >Nombre Producto</label>
                                    
                                        <input type="text"  class="form-control"  id="producto" name="producto" placeholder="Ingrese nombre del producto" readonly >           
                                        <span class="error_form" id="error_mensaje_producto"></span>    
                                </div>

                                 <div class="col-md-4 mb-3">
                                    <label >Nombre del Empleado</label>
                                    <input type="text"   name="empleado" class="form-control" placeholder="Nombre Empleado" readonly >
                                    <span class="error_form" id="error_mensaje_dir"></span>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label >Nombre del Cliente</label>
                                    <input type="text"   name="cliente" class="form-control" placeholder="Nombre Cliente" readonly >
                                    <span class="error_form" id="error_mensaje_dir"></span>
                                </div>


                                


                        </div>

                        <div class="row">
                           
                            <div class="col-md-6 mb-3">
                                    <label >Cantidad</label>
                                    <input type="text"   name="cantidad" id="cantidad" class="form-control" placeholder="Ingrese una cantidad mayor a cero" >
                                    <span class="error_form" id="error_mensaje_cantidad"></span>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label >Fecha</label>
                                    
                                    <input type="text"  name="fecha" id="fech" class="form-control" placeholder="YYYY-MM-DD">
                                    <span class="error_form" id="error_mensaje_fecha"></span>

                                </div>
                            
                        </div>
                     

                        </form>
                </div>
                <div class="modal-footer" style="background-color:#ecf0f1;">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                    <button type="button" id="btnSaveVentas" class="btn btn-success" style="color:white;">Guardar Cambios</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal-dialog -->

