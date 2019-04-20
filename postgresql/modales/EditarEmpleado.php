
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-show-password/1.0.3/bootstrap-show-password.min.js"></script>
 <!--Modal agregar usuario-->
    <div id="myModalEditarEmpleado" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header" >
                <img src="<?=base_url();?>mysql/img/user.png" width="70" height="70" class="d-inline-block align-top" >
                    <h4 class="modal-title" style="margin-top: 10px;"> </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span> </button>
                </div>
                <div class="modal-body">
                        <form id="myFormEdit" action="" method="post" >
                        <input type="hidden" name="id_empleado" value="0">
                        <input type="hidden" name="id_turno" value="0">
                        <input type="hidden" name="id_especialidad" value="0">
                        <input type="hidden" name="id_correo" value="0">
                        <input type="hidden" name="id_domicilio" value="0">
                        <input type="hidden" name="id_sexo" value="0">
                        <div class="row">

                            <div class="col-md-4 mb-3">
                                    <label >Nombres</label>

                                        <input type="text"  class="form-control" id="nom" name="nombre" placeholder="Nombre">
                                        <span class="error_form" id="error_nombre_empleado"></span>
                                </div>

                                 <div class="col-md-4 mb-3">
                                    <label >Primer Apellido</label>
                                    <input type="text" id="1apellido"  name="primerapellido" class="form-control" placeholder="Primer Apellido"  >
                                    <span class="error_form" id="error_1apellido_empleado"></span>
                                </div>


                                <div class="col-md-4 mb-3">
                                    <label >Segundo Apellido</label>
                                    <input type="text"  id="2apellido" name="segundoapellido" class="form-control"  placeholder="Segundo Apellido" >
                                    <span class="error_form" id="error_2apellido_empleado"></span>
                                </div>


                        </div>

                        <div class="row">

                            <div class="col-md-6 mb-3">
                                    <label >Telefono</label>
                                    <input type="text" id="tel"  name="telefono" class="form-control" placeholder="+5213121234567" >
                                    <span class="error_form" id="error_telefono_empleado"></span>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label >Codigo Postal</label>
                                    <input type="text" id="cpe"  name="cp" class="form-control" placeholder="12345" >
                                    <span class="error_form" id="error_cp_empleado"></span>
                                </div>

                        </div>


                        </form>
                </div>
                <div class="modal-footer" style="background-color:#ecf0f1;">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                    <button type="button"  id="btnSaveEdit" class="btn btn-success" style="color:white;">Guardar Cambios</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal-dialog -->