
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-show-password/1.0.3/bootstrap-show-password.min.js"></script>
 <!--Modal agregar usuario-->

    <div id="myModalProveedores" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header" >
                <img src="<?=base_url();?>mysql/img/proveedor.png" width="70" height="70" class="d-inline-block align-top" >
                    <h4 class="modal-title" style="margin-top: 10px;"> </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span> </button>
                </div>
                <div class="modal-body">

                        <form id="myFormProveedores" action="" method="post" >
                        <input type="hidden" name="id_proveedor" value="0">
                        <div class="row">
                            
                            <div class="col-md-6 mb-3">
                                    <label >Nombre Proveedor</label>
                                    
                                        <input type="text"  class="form-control" id="provee" name="proveedor" placeholder="Nombre Proveedor">           
                                        <span class="error_form" id="error_mensaje_proveedor"></span>    
                                </div>

                                 <div class="col-md-6 mb-3">
                                    <label >Dirección</label>
                                    <input type="text" id="direccionp"  name="direccion" class="form-control" placeholder="direccion" readonly >
                                    <span class="error_form" id="error_mensaje_direccionp"></span>
                                </div>


                                


                        </div>

                        <div class="row">
                           
                            <div class="col-md-6 mb-3">
                                    <label >Telefono</label>
                                    <input type="text" id="telefonop"  name="telefono" class="form-control" placeholder="+5213121234503"  >
                                    <span class="error_form" id="error_mensaje_telefonop"></span>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label >Codigo Postal</label>
                                    
                                    <input type="text" id="cpp" name="cp" class="form-control" placeholder="codigo postal" >
                                    <span class="error_form" id="error_mensaje_cpp"></span>

                                </div>
                            
                        </div>
                     

                        </form>
                </div>
                <div class="modal-footer" style="background-color:#ecf0f1;">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                    <button type="button" id="btnSaveProveedores" class="btn btn-success" style="color:white;">Guardar Cambios</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal-dialog -->

