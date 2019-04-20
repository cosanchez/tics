
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-show-password/1.0.3/bootstrap-show-password.min.js"></script>
 <!--Modal agregar usuario-->

    <div id="myModalCompras" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header" >
                <img src="<?=base_url();?>mysql/img/compras.png" width="70" height="70" class="d-inline-block align-top" >
                    <h4 class="modal-title" style="margin-top: 10px;"> </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span> </button>
                </div>
                <div class="modal-body">

                        <form id="myFormCompras" action="" method="post" >
                        <input type="hidden" name="id_compras" value="0">
                        <div class="row">
                            
                            <div class="col-md-6 mb-3">
                                    <label ># Pedido</label>
                                    
                                        <input type="text"  class="form-control"  name="pedido" readonly>           
                                        <span class="error_form" id="error_mensaje_user"></span>    
                                </div>

                                 <div class="col-md-6 mb-3">
                                    <label >Pedido por:</label>
                                    <input type="text"   name="nombre_empleado" class="form-control" placeholder="Primer Apellido" readonly >
                                    <span class="error_form" id="error_mensaje_dir"></span>
                                </div>


                                


                        </div>

                        <div class="row">
                           
                            <div class="col-md-6 mb-3">
                                    <label >Monto</label>
                                    <input type="text" id="monto"  name="monto" class="form-control" placeholder="&#x1F4B2;"  >
                                    <span class="error_form" id="error_mensaje_monto"></span>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label >Fecha</label>
                                    
                                    <input type="text"  id="status" name="status" class="form-control" placeholder="cancelado, pendiente, realizado?" readonly>
                                    <span class="error_form" id="error_mensaje_status"></span>
                                    
                                </div>
                            
                        </div>
                     

                        </form>
                </div>
                <div class="modal-footer" style="background-color:#ecf0f1;">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                    <button type="button" id="btnSaveCompras" class="btn btn-success" style="color:white;">Guardar Cambios</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal-dialog -->

