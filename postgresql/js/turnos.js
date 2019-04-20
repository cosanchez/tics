

  var error_nombre_turno=false;
  $("#nomturno").focusout(function(){check_nombreTurno();});
  


function check_nombreTurno(){
        var pattern = /^[a-zA-ZZáéíóúñÑ\s]*$/;
        var status = $("#nomturno").val();
        if (pattern.test(status) && status !== '') {
        $("#error_nombre_turno").show();
        $("#error_nombre_turno").html("Campo aceptado").css({"font-size": "12px", "color": "#34F458"});
        $("#nomturno").css("border-bottom","2px solid #34F458");

        return error_nombre_turno = false;

        } else {
        $("#error_nombre_turno").html("Solo debe contener Letras").css({"font-size": "14px", "color": "red"});
        $("#error_nombre_turno").show();
        $("#nomturno").css("border-bottom","2px solid #F90A0A");

         return error_nombre_turno = true;

        }
      }

      function check_nomturno(campo){
        var pattern = /^[a-z´A-ZñÑ\s]*$/;
        var status = campo;
        if (pattern.test(status) && status !== '') {
            return "Correcto"
        }else{
            return "Incorrecto"
        }
      }


NumeroTurnos()

function NumeroTurnos(){
    $.ajax({
        type: 'ajax',
        url: '../Posgrees/MostrarTurnos',
        async: false,
        dataType: 'json',
        success: function(data){
            var html='';
            var reset='';
            var j=0;
            for (var i = 0; i < data.length; i++) {
                if(check_nomturno(data[i].nombre)=="Correcto"){
                                     var parametros = {
                "valor1" : data[i].idturno,
                "valor2" : data[i].nombre
            };
        $.ajax({
                data: parametros, //datos que se envian a traves de ajax
                url:   '../Posgrees/insertTurnoSQL/', //archivo que recibe la peticion
                type:  'post', //método de envio
        });
                }else{
                    j=j+1;
                }
            }
            html+='<h5 style="color: red">'+'Turnos'+' ' +'('+j+')'+'</h5>';
            
            if (j!=0) {
                $("#btnturnos").show();
                $('#numeroturnos').html(html);
                
                 
            }else{
                 $('#numeroturnos').html(reset);
                  var reset='';
                 $('#cabeza').html(reset);
                 $('#cabeza').hide();
                 $('#tabla').html(reset);
                 $("#btnturnos").hide();
            }
            
        },
        error: function(){
           // alert('no trae nada de la base ');
        }
    });
}

 //mostrar ct_Colore
  $('#turnos').click(function(){
     $('#cabeza').show();
   MostrarTurnos()
   });

function MostrarTurnos(){
     $.ajax( "../Posgrees/MostrarTurnos" )
     .done(function(data) {
        var html = '';
                var nombres = '';
                var i;
                 var j;
                 var rol = parseInt($("#rol").val());

                   nombres+='<th id="tw">Turno</th>';
                   if (rol==1) {
                    nombres+='</tr>';
                   }else{
                    nombres+='<th id="tw">opciones</th>'+
                      '</tr>';
                   }
                      
                      $('#cabeza').html(nombres); 
                     
    $.each(JSON.parse(data), function(i, element) {
      if(check_nomturno(element.nombre)=="Correcto"){

                }else{
                   html +='<tr>'+
                                '<td>'+element.nombre+'</td>';
                                if (rol==1) {
                                   html +='</tr>' ;
                                }else{
                                  html +='<td>'+
                                    '<a href="javascript:;" class=" item-edit-turno" data="'+element.idturno+'"><img src="../../mysql/img/lapiz.png" width="40" height="40" class="d-inline-block align-top" title="Editar" alt="Imagen editar"></a>'+"&nbsp;&nbsp;&nbsp;"+
                                    '<a href="javascript:;" class=" item-delete-turno" data="'+element.idturno+'"><img src="../../mysql/img/eliminar.png" width="40" height="40" class="d-inline-block align-top" title="Eliminar" alt="Imagen elimimnar"></a>'+"&nbsp;&nbsp;&nbsp;"+
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
   $('#resultado').on('click', '.item-edit-turno', function()
    {
        var id = $(this).attr('data');
        $('#myModalEditarTurnos').modal('show');
        $('#myModalEditarTurnos').find('.modal-title').text('Corregir Registro ');
        $('#myModalEditarTurnos').find('.modal-header').css('background-color', '#FE2E2E');
        $('#myModalEditarTurnos #myFormEdit').attr('action', '../Posgrees/ActualizarTurnoSQL');
        $.ajax({url:"../Posgrees/MostrarTurno",data:{idturno:id} })
    .done(function(result) {
       var data=JSON.parse(result);
                $('input[name=nombreturno]').val(data.nombre);
                $('input[name=idturno]').val(data.idturno);
       check_nombreTurno()
    })
    .fail(function() {
      alert( "error" );
   });
});


      $('#myModalEditarTurnos #btnSaveEditTurno').click(function(){
        var url = $('#myModalEditarTurnos #myFormEdit').attr('action');
        var data = $('#myModalEditarTurnos #myFormEdit').serialize();
check_nombreTurno()
        if (error_nombre_turno === false){
            $.ajax({
                method: 'post',
                url: url,
                data: data,
                async: false,
                success: function(response){
                    if(response){
                        $('#myModalEditarTurnos').modal('hide');
                      
                      if(response.type=='update'){
                            var type ="Actualizado"
                        }
                        $('.alert-success').html('Registro Correctamente').fadeIn().delay(1000).fadeOut('slow');
                        MostrarTurnos()
                        NumeroTurnos()

                    }else{
                        $('.alert-danger').html('No se realizo ningun cambio').fadeIn().delay(1000).fadeOut('slow');
                        $('#myModalEditarTurnos').modal('hide');
                        
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
    $('#resultado').on('click', '.item-delete-turno', function(){
        var idturno = $(this).attr('data');
        $('#deleteModal').modal('show');
        //prevent previous handler - unbind()
        $('#btnDelete').unbind().click(function(){
            $.ajax({
                type: 'ajax',
                method: 'get',
                async: false,
                url: '../Posgrees/EliminarTurno',
                data:{idturno:idturno},
                dataType: 'json',
                success: function(response){
                    if(response.success){
                        //location.reload("#Tablas");
                        $('#deleteModal').modal('hide');
                        $('.alert-danger').html('Registro Eliminado Correctamente').fadeIn().delay(1500).fadeOut('slow');
                        //location.reload("#ct_colores");
                             MostrarTurnos()
                        NumeroTurnos()

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



