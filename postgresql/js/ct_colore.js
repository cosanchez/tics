

  var error_nombre_Color=false;
  var error_codigo_color=false;
  $("#nomctc").focusout(function(){check_nombreC();});
  $("#ccolor").focusout(function(){check_codigoC();});


function check_nombreC(){
        var pattern = /^[a-zA-Záéíóú\s]*$/;
        var status = $("#nomctc").val();
        if (pattern.test(status) && status !== '') {
        $("#error_nombre_Color").show();
        $("#error_nombre_Color").html("Campo aceptado").css({"font-size": "12px", "color": "#34F458"});
        $("#nomctc").css("border-bottom","2px solid #34F458");

        return error_nombre_Color = false;

        } else {
        $("#error_nombre_Color").html("Solo debe contener Letras").css({"font-size": "14px", "color": "red"});
        $("#error_nombre_Color").show();
        $("#nomctc").css("border-bottom","2px solid #F90A0A");

         return error_nombre_Color = true;

        }
      }
function check_codigoC(){
        var pattern = /^[a-z.0-9#]*$/;
        var status = $("#ccolor").val();
        if (pattern.test(status) && status !== '') {
        $("#error_codigo_color").show();
        $("#error_codigo_color").html("Campo aceptado").css({"font-size": "12px", "color": "#34F458"});
        $("#ccolor").css("border-bottom","2px solid #34F458");
        return error_codigo_color = false;
        } else {
        $("#error_codigo_color").html("Solo debe contener Letras numero y #").css({"font-size": "14px", "color": "red"});
        $("#error_codigo_color").show();
        $("#ccolor").css("border-bottom","2px solid #F90A0A");
        return error_codigo_color = true;
        }
      }

      function check_nomct(campo){
        var pattern = /^[a-zA-ZáéíóúñÑ\s]*$/;
        var status = campo;
        if (pattern.test(status) && status !== '') {
            return "Correcto"
        }else{
            return "Incorrecto"
        }
      }


NumeroCTColores()

function NumeroCTColores(){
    $.ajax({
        type: 'ajax',
        url: '../Posgrees/MostrarCtColores',
        async: false,
        dataType: 'json',
        success: function(data){
            var html='';
            var reset='';
            var j=0;
            for (var i = 0; i < data.length; i++) {
                if(check_nomct(data[i].nombre)=="Correcto" &&
                 check_codigocolor(data[i].codigocolor)=="Correcto"){
              var parametros = {
                "valor1" : data[i].idcolor,
                "valor2" : data[i].codigocolor,
                "valor3" : data[i].nombre
            };
        $.ajax({
                data: parametros, //datos que se envian a traves de ajax
                url:   '../Posgrees/insertCTColorSQL/', //archivo que recibe la peticion
                type:  'post', //método de envio
        });
                }else{
                    j=j+1;
                }
            }
            html+='<h5 style="color: red">'+'CTColores'+' ' +'('+j+')'+'</h5>';
            
            if (j!=0) {
                $("#btncolores").show();
                $('#numeroctcolores').html(html);
                 
                 
            }else{
                 $('#numeroctcolores').html(reset);
                  var reset='';
                 $('#cabeza').html(reset);
                 $('#cabeza').hide();
                 $('#tabla').html(reset);
                 $("#btncolores").hide();
            }
        
        },
        error: function(){
          //  alert('no trae nada de la base ');
        }
    });
}

//mostrar ct_Colore
 $('#ct_colores').click(function(){
  $('#cabeza').show();
    MostrarCtColores()

    });

      function check_codigocolor(campo){
        var pattern = /^[0-9a-z.#%]*$/;
        var status = campo;
        if (pattern.test(status) && status !== '') {
            return "Correcto"
        }else{
            return "Incorrecto"
        }
      }

     function check_nomct(campo){
        var pattern = /^[a-zA-ZáéíóúñÑ\s]*$/;
        var status = campo;
        if (pattern.test(status) && status !== '') {
            return "Correcto"
        }else{
            return "Incorrecto"
        }
      }

function MostrarCtColores(){
    $.ajax( "../Posgrees/MostrarCtColores" )
      .done(function(data) {
         var html = '';
                var nombres = '';
                var i;
                 var j;
                  var rol = parseInt($("#rol").val());
                   nombres+='<th id="tw">Nombre</th>'+
                      '<th id="tw">Codigo Color</th>';
                      if (rol==1) {
                        nombres+='</tr>';
                      }else{
                      nombres+='<th id="tw">opciones</th>'+
                      '</tr>';
                      }
                      
                      $('#cabeza').html(nombres); 
    $.each(JSON.parse(data), function(i, element) {
      if(check_nomct(element.nombre)=="Correcto" && check_codigocolor(element.codigocolor)=="Correcto"){
                }else{
                   html +='<tr>'+
                                '<td>'+element.nombre+'</td>'+
                                '<td>'+element.codigocolor+'</td>';
                                if (rol==1) {
                                   html +='</tr>' ;
                                }else{
                                   html +='<td>'+
                                    '<a href="javascript:;" class=" item-edit-ctcolor" data="'+element.idcolor+'"><img src="../../mysql/img/lapiz.png" width="40" height="40" class="d-inline-block align-top" title="Editar" alt="Imagen editar"></a>'+"&nbsp;&nbsp;&nbsp;"+
                                    '<a href="javascript:;" class=" item-delete-ctcolor" data="'+element.idcolor+'"><img src="../../mysql/img/eliminar.png" width="40" height="40" class="d-inline-block align-top" title="Eliminar" alt="Imagen elimimnar"></a>'+"&nbsp;&nbsp;&nbsp;"+
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


//Modal editar edit
  $('#resultado').on('click', '.item-edit-ctcolor', function()
    {
        var id = $(this).attr('data');
        $('#myModalEditarCTColores').modal('show');
        $('#myModalEditarCTColores').find('.modal-title').text('Corregir Registro ');
        $('#myModalEditarCTColores').find('.modal-header').css('background-color', '#FE2E2E');
        $('#myModalEditarCTColores #myFormEdit').attr('action', '../Posgrees/ActualizarCTColor');
        $.ajax({url:"../Posgrees/MostrarCTColor",data:{idcolor:id} })
    .done(function(result) {
       var data=JSON.parse(result);
                $('input[name=nombrectc]').val(data.nombre);
                  check_nombreC()
                  if(error_nombre_Color===false){
                      $('input[name=nombrectc]').val(data.nombre).attr('readonly',true);
                  }else{
                      $('input[name=nombrectc]').val(data.nombre).attr('readonly',false);
                  }
                $('input[name=codigocolor]').val(data.codigocolor);
                    check_codigoC()
                    if(error_codigo_color===false){
                        $('input[name=codigocolor]').val(data.codigocolor).attr('readonly',true);
                    }else{
                        $('input[name=codigocolor]').val(data.codigocolor).attr('readonly',false);
                    }
                $('input[name=idcolor]').val(data.idcolor);
       // check_nombreC()
       // check_codigoC()
    })
    .fail(function() {
      alert( "error" );
   });
});


      $('#myModalEditarCTColores #btnSaveEditColor').click(function(){
        var url = $('#myModalEditarCTColores #myFormEdit').attr('action');
        var data = $('#myModalEditarCTColores #myFormEdit').serialize();
       check_nombreC()
       check_codigoC()
        if (error_nombre_Color === false && error_codigo_color === false){
            $.ajax({
                method: 'post',
                url: url,
                data: data,
                async: false,
                success: function(response){
                    if(response){
                        $('#myModalEditarCTColores').modal('hide');
                      
                      if(response.type=='update'){
                            var type ="Actualizado"
                        }
                        $('.alert-success').html('Registro Correctamente').fadeIn().delay(1000).fadeOut('slow');
                        MostrarCtColores()
                        NumeroCTColores()

                    }else{
                        $('.alert-danger').html('No se realizo ningun cambio').fadeIn().delay(1000).fadeOut('slow');
                        $('#myModalEditarCTColores').modal('hide');
                        
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
    $('#resultado').on('click', '.item-delete-ctcolor', function(){
        var idcolor = $(this).attr('data');
        $('#deleteModal').modal('show');
        //prevent previous handler - unbind()
        $('#btnDelete').unbind().click(function(){
            $.ajax({
                type: 'ajax',
                method: 'get',
                async: false,
                url: '../Posgrees/EliminarCTColor',
                data:{idcolor:idcolor},
                dataType: 'json',
                success: function(response){
                    if(response.success){
                        //location.reload("#Tablas");
                        $('#deleteModal').modal('hide');
                        $('.alert-danger').html('Registro Eliminado Correctamente').fadeIn().delay(1500).fadeOut('slow');
                        //location.reload("#ct_colores");
                             MostrarCtColores()
                        NumeroCTColores()

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



