

  var error_nombre_temporada=false;
  $("#nomtemporada").focusout(function(){check_nombreTemporada();});
  


function check_nombreTemporada(){
        var pattern = /^[a-zA-ZZáéíóúñÑ\s]*$/;
        var status = $("#nomtemporada").val();
        if (pattern.test(status) && status !== '') {
        $("#error_nombre_temporada").show();
        $("#error_nombre_temporada").html("Campo aceptado").css({"font-size": "12px", "color": "#34F458"});
        $("#nomtemporada").css("border-bottom","2px solid #34F458");

        return error_nombre_temporada = false;

        } else {
        $("#error_nombre_temporada").html("Solo debe contener Letras").css({"font-size": "14px", "color": "red"});
        $("#error_nombre_temporada").show();
        $("#nomtemporada").css("border-bottom","2px solid #F90A0A");

         return error_nombre_temporada = true;

        }
      }

      function check_nomtemporada(campo){
        var pattern = /^[a-z´A-ZñÑ\s]*$/;
        var status = campo;
        if (pattern.test(status) && status !== '') {
            return "Correcto"
        }else{
            return "Incorrecto"
        }
      }


NumeroTemporada()

function NumeroTemporada(){
    $.ajax({
        type: 'ajax',
        url: '../Posgrees/MostrarTemporada',
        async: false,
        dataType: 'json',
        success: function(data){
            var html='';
            var reset='';
            var j=0;
            for (var i = 0; i < data.length; i++) {
                if(check_nomtemporada(data[i].nombre)=="Correcto"){
                var parametros = {
                "valor1" : data[i].idtemporada,
                "valor2" : data[i].nombre
            };
        $.ajax({
                data: parametros, //datos que se envian a traves de ajax
                url:   '../Posgrees/insertTemporadaSQL/', //archivo que recibe la peticion
                type:  'post', //método de envio
        });
                }else{
                    j=j+1;
                }
            }
            html+='<h5 style="color: red">'+'Temporada'+' ' +'('+j+')'+'</h5>';
            
            if (j!=0) {
                $("#btntemporada").show();
                $('#numerotemporada').html(html);
                
                 
            }else{
                 $('#numerotemporada').html(reset);
                  var reset='';
                 $('#cabeza').html(reset);
                 $('#cabeza').hide();
                 $('#tabla').html(reset);
                 $("#btntemporada").hide();
            }

        },
        error: function(){
            //alert('no trae nada de la base ');
        }
    });
}

 //mostrar especialidad
  $('#temporada').click(function(){
     $('#cabeza').show();
   MostrarTemporadas()
   });

function MostrarTemporadas(){
     $.ajax( "../Posgrees/MostrarTemporada" )
     .done(function(data) {
        var html = '';
                var nombres = '';
                var i;
                 var j;
                 var rol = parseInt($("#rol").val());
                   nombres+='<th id="tw">Temporada</th>';
                   if (rol==1) {
                    nombres+='</tr>';
                   }else{
                    nombres+='<th id="tw">opciones</th>'+
                      '</tr>';
                   }
                      
                      $('#cabeza').html(nombres); 
                     
    $.each(JSON.parse(data), function(i, element) {
      if(check_nomtemporada(element.nombre)=="Correcto"){

                }else{
                   html +='<tr>'+
                                '<td>'+element.nombre+'</td>';
                                if (rol==1) {
                                  html +='</tr>' ;
                                }else{
                                  html +='<td>'+
                                    '<a href="javascript:;" class="item-edit-temp" data="'+element.idtemporada+'"><img src="../../mysql/img/lapiz.png" width="40" height="40" class="d-inline-block align-top" title="Editar" alt="Imagen editar"></a>'+"&nbsp;&nbsp;&nbsp;"+
                                    '<a href="javascript:;" class="item-delete-temp" data="'+element.idtemporada+'"><img src="../../mysql/img/eliminar.png" width="40" height="40" class="d-inline-block align-top" title="Eliminar" alt="Imagen elimimnar"></a>'+"&nbsp;&nbsp;&nbsp;"+
                                '</td>'+
                            '</tr>' ;
                                }
                                
                }
    });
                $('#resultado').html(html);
      })
      .fail(function() {
        alert( "error" );
      });
}


// //Modal editar edit
   $('#resultado').on('click', '.item-edit-temp', function()
    {
        var id = $(this).attr('data');
        $('#myModalEditarTemporada').modal('show');
        $('#myModalEditarTemporada').find('.modal-title').text('Corregir Registro ');
        $('#myModalEditarTemporada').find('.modal-header').css('background-color', '#FE2E2E');
        $('#myModalEditarTemporada #myFormEdit').attr('action', '../Posgrees/ActualizarTemporadaSQL');
        $.ajax({url:"../Posgrees/MostrarTemp",data:{idtemporada:id} })
    .done(function(result) {
       var data=JSON.parse(result);
                $('input[name=nomtemporada]').val(data.nombre);
                 check_nombreTemporada()
                  if(error_nombre_temporada===false){
                      $('input[name=nomtemporada]').val(data.nombre).attr('readonly',true);
                  }else{
                      $('input[name=nomtemporada]').val(data.nombre).attr('readonly',false);
                  }
                  $('input[name=idtemporada]').val(data.idtemporada);
    })
    .fail(function() {
      alert( "error" );
   });
});


      $('#myModalEditarTemporada #btnSaveEditTemp').click(function(){
        var url = $('#myModalEditarTemporada #myFormEdit').attr('action');
        var data = $('#myModalEditarTemporada #myFormEdit').serialize();
   check_nomtemporada()
        if (error_nombre_temporada === false){
            $.ajax({
                method: 'post',
                url: url,
                data: data,
                async: false,
                success: function(response){
                    if(response){
                        $('#myModalEditarTemporada').modal('hide');
                      
                      if(response.type=='update'){
                            var type ="Actualizado"
                        }
                        $('.alert-success').html('Registro Correctamente').fadeIn().delay(1000).fadeOut('slow');
                        MostrarTemporadas()
                        NumeroTemporada()

                    }else{
                        $('.alert-danger').html('No se realizo ningun cambio').fadeIn().delay(1000).fadeOut('slow');
                        $('#myModalEditarTemporada').modal('hide');
                        
                    }
                },
                error: function(){
                    alert('No se pudo realizar los cambios');
                }
            });
    }else{
            alert("Verifique los campos");
        }
    });


    //eliminar ct_color//
    $('#resultado').on('click', '.item-delete-temp', function(){
        var idtemporada = $(this).attr('data');
        $('#deleteModal').modal('show');
        //prevent previous handler - unbind()
        $('#btnDelete').unbind().click(function(){
            $.ajax({
                type: 'ajax',
                method: 'get',
                async: false,
                url: '../Posgrees/EliminarTemporada',
                data:{idtemporada:idtemporada},
                dataType: 'json',
                success: function(response){
                    if(response.success){
                        //location.reload("#Tablas");
                        $('#deleteModal').modal('hide');
                        $('.alert-danger').html('Registro Eliminado Correctamente').fadeIn().delay(1500).fadeOut('slow');
                        //location.reload("#ct_colores");
                        MostrarTemporadas()
                        NumeroTemporada()

                       // alert(response);
                    }else{
                        alert('Error');
                    }
                },
                error: function(){
                    alert('Error al remover');
                }
            });
        });
    });


