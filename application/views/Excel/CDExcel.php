<?php

if ($this->session->userdata('nombre') == null) {
    redirect(base_url() . 'index.php/welcome/logout');
}
include 'plantilla/header.php';

?>
<div id="content-wrapper">
        <div class="container-fluid">
                 <div class="row">
              <div class="col-3">
                <label>Marca</label>
                <select class="form-control" id="marca"  name="marca" onchange="ProductosXMarcas()">
                  <option>Seleccionar</option>

                </select>
              </div>
              <div class="col-3">
                <label>Productos</label>
                <select class="form-control" id="productos"  name="productos">
                  <option>Seleccionar</option>
                </select>
              </div>
              <div class="col-3">
                <label>Temporadas</label>
                <select class="form-control" id="temporada" name="temporada" >
                  <option>Seleccionar</option>
                </select>
              </div>
              <div class="col-3">
                <label>Fechas</label>
                <select class="form-control" id="fechas" name=fechas">
                  <option value="0">Seleccionar</option>
                  <option value="1">Fechas</option>
                  <option value="2">Años</option>
                </select>
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
?>