<?php 


if ($this->session->userdata('nombre')==null) {
redirect (base_url().'index.php/welcome/logout');
}
include 'plantilla/header.php';
 ?>
 <div id="content-wrapper">

        <div class="container-fluid">
          <div class="row">
       
            <div class="col-md-6">


              <div class="row">
                <div class="col-md-7 col-xs-12" >
                  <img  class="img-responsive" style="margin-top: 150px; margin-bottom:150px;  width: 100%;" src="<?php echo base_url()?>mysql/img/etl3.png">
                </div>
                <div class="col-md-5 col-xs-12" >
                  <a href="<?php echo base_url()?>index.php/welcome/CHECK" style="margin-top: 225px; margin-bottom:150px; float: right;" class="btn btn-primary btn-lg btn-block">Empezar ETL</a>
                </div>
              </div>

              
          </div>


          <div class="col-md-5">

            <div class="mensaje">
              <h3 style="color: green; text-align: center;"><strong>Bienvenido, <?php echo $this->session->userdata('nombre'); ?></strong></h3>
            </div>
            <br>
             <div class="ETL">
              <h4>¿Qué es un ETL?</h4>
              <p style="text-align: justify;">Un proceso ETL (Extraer-Transformar-Cargar en inglés) básico busca información relevante de una fuente de datos, que se encarga de detectar, corregir y estandarizar los registros que poseen errores; y finalmente los envia a un almacende datos para realizar consultasde Inteligencia de Negocios (BI).</p>
             
            </div>
            <br>
             <div class="make">
             <h4>¿Qué debo hacer?</h4>
              <p style="text-align: justify;">El proceso ETL consiste en la detección de errores, los cuales podran ser corregidos para posteriomente ser enviados a un almacen de datos denominado <strong>DataWereHouse</strong>, con la finalidad de mantener la integridad de los registros de cada una de las fuentes de datos tratadas.</p>
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









    