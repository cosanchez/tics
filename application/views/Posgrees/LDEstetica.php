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
              <h1>Estetica</h1>
              <h3>Cantidad Vendida de Productos por Año o Fecha de Venta</h3><br>
            </div>
            <style type="text/css">
              label{
                font-weight: bold;
              }
            </style>
          </div>
            <div class="row">
              <div class="col-3">
                <label>Marca</label>
                <select class="form-control" id="marca"  name="marca" onchange="ProductosXMarcas()">
                  <option>Seleccionar</option>
                  <?php foreach ($marcas as $key => $value) {?>
                    <option value= "<?php echo $value['IdMarca']; ?>"><?php echo $value['Nombre']; ?></option>
                 <?php }?>
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
                    <?php foreach ($temporadas as $key => $value) {?>
                      <option value= "<?php echo $value['IdTemporada']; ?>"><?php echo $value['Nombre']; ?></option>
                 <?php }?>
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
            <div class="row" style="padding-top: 50px">
              <div class="col-4">
                     <button class="btn btn-primary"  onclick="ProductosVendidosXTemporada()">Ejecutar</button>
              </div>
            </div>
          <div class="row" style="max-width: 100%; max-height: 600px; text-align: center" >
            <div class="col-md-2"></div>
            <div class="col-md-8 grafica" >
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
  function ProductosXMarcas()  {
       var idmarca = document.getElementById("marca").value;
$.get('ProductosXMarca/'+idmarca)
  .done(
        function(res) {
          var texto = "";
          texto += " <option value='' disabled='' selected=''>Seleccionar</option>";
          for (var i = res.length - 1; i >= 0; i--) {
            var obj = res[i];
            texto +="<option value='"+obj['IdProducto']+"'>"+obj['Nombre']+' '+obj['Tamaño']+"</option>";
          }
          $("#productos").html(texto);
        }

      )
  }

var contador=0;
  function ProductosVendidosXTemporada(){
    var idproducto= document.getElementById("productos").value;
    var tempo= document.getElementById("temporada").value;
    var fecha= document.getElementById("fechas").value;
    //var temp= document.getElementById("temporada").value;
                    var cantidadesP = [];
                    var fechasM = [];
              var parametros = {
                "valor1" : idproducto,
                "valor2" : tempo,
                "valor3" : fecha,
            };
    $.get({
            data: parametros, //datos que se envian a traves de ajax
            url:   'PVXT', //archivo que recibe la peticion
            type:  'post', //método de envio
    })
    .done(function(res){
        //alert("hola"+res["dia"]);
        $.each(JSON.parse(res), function(i, element) {
          //cantidades[i]=element.cantidadVendida;
          //fecha[i]=element.dia;
                        cantidadesP.push(element.cantidadVendida);
                        fechasM.push(element.Fecha);
        });

document.getElementById("speedChart").remove();
$(".grafica").append('<canvas id="speedChart"></canvas>');
var speedCanvas = document.getElementById("speedChart");

var dataSecond = {
  label: "Cantidad Vendida de Productos Fecha o Años",
  data: cantidadesP,
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
  labels:fechasM ,
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
  }
</script>
<?php
include 'plantilla/footer.php';
?>
<script type="text/javascript">
// var speedCanvas = document.getElementById("speedChart");
// var dataSecond = {
//   label: "Cantidad Vendida de Productos Fecha o Años",
//   data: [],
//   // Set More Options
// };

// var speedData = {
//   labels:[] ,
//   datasets: [dataSecond]
// };
// var lineChart = new Chart(speedCanvas, {
//   type: 'bar',
//   data: speedData
// });
</script>
