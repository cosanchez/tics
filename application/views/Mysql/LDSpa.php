<?php

if ($this->session->userdata('nombre') == null) {
    redirect(base_url() . 'index.php/welcome/logout');
}
include 'plantilla/header2.php';

?>
<div id="content-wrapper">
        <div class="container-fluid">
                    <div class="row">
            <div class="col-12" style="text-align: center">
              <h1>SPA</h1>
              <h3>Servicios que generan mayor utilidad por año y temporada  </h3><br>
            </div>
            <style type="text/css">
              label{
                font-weight: bold;
              }
            </style>
          </div>
            <div class="row">
              <div class="col-3">
                <label>Años</label>
                <select class="form-control" id="anos"  name="anos">
                  <option>Seleccionar</option>
                    <?php foreach ($anos as $key => $value) {?>
                    <option value= "<?php echo $value['ano']; ?>"><?php echo $value['ano']; ?></option>
                 <?php }?>
                </select>
              </div>
              <div class="col-3">
                <label>Temporadas</label>
                <select class="form-control" id="temporada"  name="temporada">
                  <option value="0">Seleccionar</option>
                  <option value="1">Primavera</option>
                  <option value="2">Verano</option>
                  <option value="3">Otoño</option>
                  <option value="4">Invierno</option>
                  <option value="5">Sin Temporada</option>
                </select>
              </div>
            </div>
            <div class="row" style="padding-top: 50px">
              <div class="col-4">
                     <button class="btn btn-primary"  onclick="ProductosVendidosXTemporada()">Ejecutar</button>
              </div>
            </div>
          <div class="row" style="max-width: 100%; max-height: 100%; text-align: center" >
            <div class="col-md-6 grafica2">
              <canvas id="speedChart2"></canvas>
            </div>
            <div class="col-md-6 grafica">
                <canvas id="speedChart"></canvas>
            </div>
            <div class="col-md-2"></div>
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

      <script type="text/javascript">
function ProductosVendidosXTemporada(){
    var fecha= document.getElementById("anos").value;
    var temp= document.getElementById("temporada").value;
                    var costos = [];
                    var servicios=[];
                    var ante=[];
                    var compa=0;
              var parametros = {
                "valor2": temp,
                "valor3" : fecha,
            };
    $.get({
            data: parametros, //datos que se envian a traves de ajax
            url:   'CVXA', //archivo que recibe la peticion
            type:  'post', //método de envio
    })
    .done(
      function(res){
        $.each(JSON.parse(res), function(i, element) {
                        costos.push(element.total);
                        servicios.push(element.Nombre);
        });
        document.getElementById("speedChart").remove();
$(".grafica").append('<canvas id="speedChart"></canvas>');
var speedCanvas = document.getElementById("speedChart");
var dataSecond = {
  label: "Ganancia Por servicio",
  data: costos,
  lineTension: 0.3,
    fill: false,
    borderColor: 'blue',
    backgroundColor: 'transparent',
    pointBorderColor: 'green',
    pointBackgroundColor: 'lightgreen',
    pointRadius: 5,
    pointHoverRadius: 15,
    pointHitRadius: 30,
    pointBorderWidth: 2,
    pointStyle: 'rect'
  // Set More Options
};


var speedData = {
  labels:servicios,
  datasets: [dataSecond]
};
var lineChart= new Chart(speedCanvas, {
  type: 'line',
  data: speedData,
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero:true
                }
            }]
        }
    }
});
//
                    }
      )
    anterior()

  }

function anterior(){
  var fecha= document.getElementById("anos").value;
    var temp= document.getElementById("temporada").value;
                    var costos = [];
                    var servicios=[];
              var parametros = {
                "valor2": temp,
                "valor3" : fecha,
            };
  $.get({
            data: parametros, //datos que se envian a traves de ajax
            url:   'CVXAnterior', //archivo que recibe la peticion
            type:  'post', //método de envio
    })
    .done(
      function(res){
        $.each(JSON.parse(res), function(i, element) {
                        costos.push(element.total);
                        servicios.push(element.Nombre);
        });
          document.getElementById("speedChart2").remove();
$(".grafica2").append('<canvas id="speedChart2"></canvas>');
var speedCanvas2 = document.getElementById("speedChart2");
        var dataSecond2 = {
  label: "Ganancia Por servicio Año anterior",
  data: costos,
  lineTension: 0.3,
    fill: false,
    borderColor: 'red',
    backgroundColor: 'transparent',
    pointBorderColor: 'red',
    pointBackgroundColor: 'lightgreen',
    pointRadius: 5,
    pointHoverRadius: 15,
    pointHitRadius: 30,
    pointBorderWidth: 2,
    pointStyle: 'rect'
  // Set More Options
};
var speedData = {
  labels:servicios,
  datasets: [dataSecond2]
};
var lineChart= new Chart(speedCanvas2, {
  type: 'line',
  data: speedData,
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero:true
                }
            }]
        }
    }
});
      }
        )
}


function anterior2(){
  var fecha= document.getElementById("anos").value;
    var temp= document.getElementById("temporada").value;
                    var costos = [];
                    var servicios2=[];
              var parametros = {
                "valor2": temp,
                "valor3" : fecha,
            };
  $.get({
            data: parametros, //datos que se envian a traves de ajax
            url:   'CVXAnterior', //archivo que recibe la peticion
            type:  'post', //método de envio
    })
    .done(
      function(res){
        $.each(JSON.parse(res), function(i, element) {
                        costos.push(element.total);
                        servicios2.push(element.Nombre);
        });
      }
        )
return servicios2;
}


</script>
<?php
include 'plantilla/footer.php';
?>