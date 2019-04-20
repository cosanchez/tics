<?php 


if ($this->session->userdata('nombre')==null) {
redirect (base_url().'index.php/welcome/logout');
}
include 'plantilla/header.php';
 ?>
 <div id="content-wrapper">

        <div class="container-fluid">
          <h2 >Hola Excel</h2>


         <?php include 'Excel/leer.php'; ?> 
          	


          </div>
        </footer>
      </div>
 <?php 
include 'plantilla/footer.php';
 ?>