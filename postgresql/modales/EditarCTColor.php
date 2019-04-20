
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-show-password/1.0.3/bootstrap-show-password.min.js"></script>
 <!--Modal agregar usuario-->
    <div id="myModalEditarCTColores" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header" >
                <img src="<?=base_url();?>mysql/img/user.png" width="70" height="70" class="d-inline-block align-top" >
                    <h4 class="modal-title" style="margin-top: 10px;"> </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span> </button>
                </div>
                <div class="modal-body">
                        <form id="myFormEdit" action="" method="post" >
                        <input type="hidden" name="idcolor" value="0">
                        <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label >Nombre</label>
                                        <input type="text"  class="form-control" id="nomctc" name="nombrectc" placeholder="Nombre">           
                                        <span class="error_form" id="error_nombre_Color"></span>    
                                </div>
                                 <div class="col-md-4 mb-3">
                                    <label >Codigo Color</label>
                                    <input type="text" id="ccolor"  name="codigocolor" class="form-control" placeholder="Codigo del Color"  >
                                    <span class="error_form" id="error_codigo_color"></span>
                                </div>
                        </div>
                         </form>
                </div>
                <div class="modal-footer" style="background-color:#ecf0f1;">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                    <button type="button" id="btnSaveEditColor" class="btn btn-success" style="color:white;">Guardar Cambios</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal-dialog -->