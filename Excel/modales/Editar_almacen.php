<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-show-password/1.0.3/bootstrap-show-password.min.js"></script>
 <!--Modal agregar usuario-->

    <div id="myModalAlmacen" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header" >
                <img src="<?=base_url();?>mysql/img/agenda.png" width="70" height="70" class="d-inline-block align-top" >
                    <h4 class="modal-title" style="margin-top: 10px;"> </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span> </button>
                </div>
                <div class="modal-body">

                        <form id="myFormAlmacen" action="" method="post" >

                        <input type="hidden" name="id_almacen" value="0">
                        <input type="hidden" name="id_productos" value="0">

                        
                        <div class="row">

                            <div class="col-md-6 mb-3">
                                    <label >Descripcion</label>

                                        <input type="text"  class="form-control"  name="descripcion" placeholder="Descripcion"   >
                                        <span class="error_form" id="error_mensaje_user"></span>
                                </div>

                                 <div class="col-md-6 mb-3">
                                    <label >Stock_Min</label>
                                    <input type="text"   name="stock_min" class="form-control" placeholder="Stock_Min"  >
                                    <span class="error_form" id="error_mensaje_dir"></span>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label >Stock_Max </label>
                                    <input type="text"   name="stock_max" class="form-control" placeholder="Stock_Max"  >
                                    <span class="error_form" id="error_mensaje_dir"></span>
                                </div>

                                 <div class="col-md-6 mb-3">
                                    <label >Nombre </label>
                                    <input type="text"   name="nombre" class="form-control" placeholder="Nombre"  >
                                    <span class="error_form" id="error_mensaje_dir"></span>
                                </div>
                        </div>

                        </form>
                </div>
                <div class="modal-footer" style="background-color:#ecf0f1;">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                    <button type="button" id="btnSaveAlmacen" class="btn btn-success" style="color:white;">Guardar Cambios</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal-dialog -->

