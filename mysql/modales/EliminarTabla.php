<div id="deleteall" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
	<div class="modal-content">
	  <div class="modal-header" style="background-color:#ff4c4c;">
      <img src="<?=base_url();?>mysql/img/delete.png" width="70" height="70" class="d-inline-block align-top" >
		
        <h4 class="modal-title" style="color:white; margin-top: 10px;">Eliminar Registros</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"></span></button>

	  </div>
	  <div class="modal-body">
			<b style="color: red;">Estas apunto de eliminar  todos los registros de la tabla, desea continuar?<b>
            
	  </div>
	  <div class="modal-footer" style="background-color:#ecf0f1;">
		<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
		<button type="button" id="btnDeleteall" class="btn btn-danger">Eliminar</button>
	  </div>
	</div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->