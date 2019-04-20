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
              <h1>Inventario</h1>
              <h3>Servicios Realizados por Empleado, sea por mes y/o año</h3><br>
            </div>
            <style type="text/css">
              label{
                font-weight: bold;
              }
            </style>
          </div>
            <div class="row">
                          <div class="col-3">
                <label>Empleados</label>
                <select class="form-control" id="empleados"  name="empleados" >
                  <option>Seleccionar</option>
               <?php foreach ($empleados as $key => $value) {?>
                    <option value= "<?php echo $value['IdEmpleado']; ?>"><?php echo $value['Nombre'] . " " . $value['PrimerApellido'] . " " . $value['SegundoApellido']; ?></option>
                 <?php }?>
                </select>
              </div>
              <div class="col-3">
                <label>Años</label>
                <select class="form-control" id="anos"  name="anos" >
                  <option>Seleccionar</option>
               <?php foreach ($anos as $key => $value) {?>
                    <option value= "<?php echo $value['ano']; ?>"><?php echo $value['ano']; ?></option>
                 <?php }?>
                </select>
              </div>
              <div class="col-3">
                <label>Meses</label>
                <select class="form-control" id="meses"  name="meses">
                  <option value="0">Seleccionar</option>
                  <option value="1">Enero</option>
                  <option value="2">Febreo</option>
                  <option value="3">Marzo</option>
                  <option value="4">Abril</option>
                  <option value="5">Mayo</option>
                  <option value="6">Junio</option>
                  <option value="7">Julio</option>
                  <option value="8">Agosto</option>
                  <option value="9">Septiembre</option>
                  <option value="10">Octubre</option>
                  <option value="11">Noviembre</option>
                  <option value="12">Diciembre</option>
                </select>
              </div>
            </div>
            <div class="row" style="padding-top: 50px">
              <div class="col-4">
                     <button class="btn btn-primary"  onclick="ProductosVendidosXTemporada()">Ejecutar</button>
              </div>
            </div>
          <div class="row" style="max-width: 100%; max-height: 100%; text-align: center" >
            <div class="col-md-2"></div>
            <div class="col-md-8 grafica" >
                <canvas id="speedChart"></canvas>
            </div>
            <div class="col-md-2"></div>
          </div>
        </div>
</div>

<script type="text/javascript">

  function serviciosxempleado(){
    var IdEmpleado= document.getElementById("empleado").value;
    var texto='';
    $.get("serviciosxempleado/"+IdEmpleado)
    .done(
       function(res){
        texto += " <option value='' disabled='' selected=''>Seleccione el Servicio</option>";
                $.each(JSON.parse(res), function(i, element) {
            texto=texto+"<option value='"+element.IdServicio+"'>"+element.Nombre+"</option>";
        });
          $("#servicios").html(texto);
       }
      )
  }

</script>


<script type="text/javascript">
   function ProductosVendidosXTemporada(){
    var empleado= document.getElementById("anos").value;
    var servicio= document.getElementById("meses").value;
   var tempo= document.getElementById("empleados").value;
    //var fecha= document.getElementById("fechas").value;
    //var temp= document.getElementById("temporada").value;
                    var cantidadesP = [];
                    var cantidadesDos = [];
                    var nombres = [];
              var parametros = {
                "valor1" : empleado,
                "valor2" : servicio,
                "valor3" : tempo,
            };
    $.get({
            data: parametros, //datos que se envian a traves de ajax
            url:   'SPE', //archivo que recibe la peticion
            type:  'post', //método de envio
    })
    .done(
      function(res){
        //alert("hola"+res["dia"]);
        $.each(JSON.parse(res), function(i, element) {
          //cantidades[i]=element.cantidadVendida;
          //fecha[i]=element.dia;
                        cantidadesP.push(element.cantidad);
                        cantidadesDos.push(element.cantidad*2);
                        nombres.push(element.Nombre);
        });
        if($.isEmptyObject(cantidadesP) ){
          alert("No se encontraron datos en tu consulta");
        }else{
                document.getElementById("speedChart").remove();
$(".grafica").append('<canvas id="speedChart"></canvas>');
var speedCanvas = document.getElementById("speedChart");

var dataSecond = {
  label: "Servicios Relaizados por Empleado",
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
  labels:nombres,
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
                  }
      )
  }
</script>




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