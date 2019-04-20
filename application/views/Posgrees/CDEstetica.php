<?php

if ($this->session->userdata('nombre') == null) {
    redirect(base_url() . 'index.php/welcome/logout');
}
include 'plantilla/header.php';

?>
<div id="content-wrapper">
        <div class="container-fluid">


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