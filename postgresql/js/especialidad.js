

  var error_nombre_especialidad=false;
  $("#nomespecialidad").focusout(function(){check_nombreEspecialidad();});
  


function check_nombreEspecialidad(){
        var pattern = /^[a-zA-ZZáéíóúñÑ\s]*$/;
        var status = $("#nomespecialidad").val();
        if (pattern.test(status) && status !== '') {
        $("#error_nombre_especialidad").show();
        $("#error_nombre_especialidad").html("Campo aceptado").css({"font-size": "12px", "color": "#34F458"});
        $("#nomespecialidad").css("border-bottom","2px solid #34F458");

        return error_nombre_especialidad = false;

        } else {
        $("#error_nombre_especialidad").html("Solo debe contener Letras").css({"font-size": "14px", "color": "red"});
        $("#error_nombre_especialidad").show();
        $("#nomespecialidad").css("border-bottom","2px solid #F90A0A");

         return error_nombre_especialidad = true;

        }
      }

      function check_nomespecialidad(campo){
        var pattern = /^[a-z´A-ZñÑ\s]*$/;
        var status = campo;
        if (pattern.test(status) && status !== '') {
            return "Correcto"
        }else{
            return "Incorrecto"
        }
      }


NumeroEspecialidad()

function NumeroEspecialidad(){
    $.ajax({
        type: 'ajax',
        url: '../Posgrees/MostrarEspecialidad',
        async: false,
        dataType: 'json',
        success: function(data){
            var html='';
            var reset='';
            var j=0;
            for (var i = 0; i < data.length; i++) {
                if(check_nomespecialidad(data[i].nombre)=="Correcto"){
                   var parametros = {
                "valor1" : data[i].idespecialidad,
                "valor2" : data[i].nombre
            };
        $.ajax({
                data: parametros, //datos que se envian a traves de ajax
                url:   '../Posgrees/insertEspecialidadSQL/', //archivo que recibe la peticion
                type:  'post', //método de envio
        });
                }else{
                    j=j+1;
                }
            }
            html+='<h5 style="color: red">'+'Especialidades Empleado'+' ' +'('+j+')'+'</h5>';
            
            if (j!=0) {
                $("#btnespecialidad").show();
                $('#numeroespecialidad').html(html);

                 
            }else{
                 $('#numeroespecialidad').html(reset);
                  var reset='';
                 $('#cabeza').html(reset);
                 $('#cabeza').hide();
                 $('#tabla').html(reset);
                 $("#btnespecialidad").hide();
            }



           
        },
        error: function(){
            //alert('no trae nada de la base ');
        }
    });
}

 //mostrar especialidad
  $('#especialidad').click(function(){
    $('#cabeza').show();
   MostrarEspecialidades()
   });

function MostrarEspecialidades(){
     $.ajax( "../Posgrees/MostrarEspecialidad" )
     .done(function(data) {
        var html = '';
                var nombres = '';
                var i;
                 var j;
                 var rol = parseInt($("#rol").val());
                   nombres+='<th id="tw">Especialidad</th>';
                   if (rol==1) {
                    nombres+='</tr>';
                   }else{
                     nombres+='<th id="tw">opciones</th>'+
                      '</tr>';
                   }
                     
                      $('#cabeza').html(nombres); 
                     
    $.each(JSON.parse(data), function(i, element) {
      if(check_nomespecialidad(element.nombre)=="Correcto"){

                }else{
                   html +='<tr>'+
                                '<td>'+element.nombre+'</td>';
                                if (rol==1) {
                                  html +='</tr>' ;
                                }else{
                                   html +='<td>'+
                                    '<a href="javascript:;" class=" item-edit-esp" data="'+element.idespecialidad+'"><img src="../../mysql/img/lapiz.png" width="40" height="40" class="d-inline-block align-top" title="Editar" alt="Imagen editar"></a>'+"&nbsp;&nbsp;&nbsp;"+
                                    '<a href="javascript:;" class=" item-delete-esp" data="'+element.idespecialidad+'"><img src="../../mysql/img/eliminar.png" width="40" height="40" class="d-inline-block align-top" title="Eliminar" alt="Imagen elimimnar"></a>'+"&nbsp;&nbsp;&nbsp;"+
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
   $('#resultado').on('click', '.item-edit-esp', function()
    {
        var id = $(this).attr('data');
        $('#myModalEditarEspecialidad').modal('show');
        $('#myModalEditarEspecialidad').find('.modal-title').text('Corregir Registro ');
        $('#myModalEditarEspecialidad').find('.modal-header').css('background-color', '#FE2E2E');
        $('#myModalEditarEspecialidad #myFormEdit').attr('action', '../Posgrees/ActualizarEspecialidad');
        $.ajax({url:"../Posgrees/MostrarEsp",data:{idespecialidad:id} })
    .done(function(result) {
       var data=JSON.parse(result);
                $('input[name=nomespecialidad]').val(data.nombre);
                check_nombreEspecialidad()
                if(error_nombre_especialidad===false){
                     $('input[name=nomespecialidad]').val(data.nombre).attr('readonly',true);
                }else{
                    $('input[name=nomespecialidad]').val(data.nombre).attr('readonly',false);
                }
                $('input[name=idespecialidad]').val(data.idespecialidad);
       //check_nombreEspecialidad()
    })
    .fail(function() {
      alert( "error" );
   });
});


      $('#myModalEditarEspecialidad #btnSaveEditEsp').click(function(){
        var url = $('#myModalEditarEspecialidad #myFormEdit').attr('action');
        var data = $('#myModalEditarEspecialidad #myFormEdit').serialize();
       //check_nombreC()
       check_nomespecialidad()
        if (error_nombre_especialidad === false){
            $.ajax({
                method: 'post',
                url: url,
                data: data,
                async: false,
                success: function(response){
                    if(response){
                        $('#myModalEditarEspecialidad').modal('hide');
                      
                      if(response.type=='update'){
                            var type ="Actualizado"
                        }
                        $('.alert-success').html('Registro Correctamente').fadeIn().delay(1000).fadeOut('slow');
                        MostrarEspecialidades()
                        NumeroEspecialidad()

                    }else{
                        $('.alert-danger').html('No se realizo ningun cambio').fadeIn().delay(1000).fadeOut('slow');
                        $('#myModalEditarEspecialidad').modal('hide');
                        
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
    $('#resultado').on('click', '.item-delete-esp', function(){
        var idespecialidad = $(this).attr('data');
        $('#deleteModal').modal('show');
        //prevent previous handler - unbind()
        $('#btnDelete').unbind().click(function(){
            $.ajax({
                type: 'ajax',
                method: 'get',
                async: false,
                url: '../Posgrees/EliminarESP',
                data:{idespecialidad:idespecialidad},
                dataType: 'json',
                success: function(response){
                    if(response.success){
                        //location.reload("#Tablas");
                        $('#deleteModal').modal('hide');
                        $('.alert-danger').html('Registro Eliminado Correctamente').fadeIn().delay(1500).fadeOut('slow');
                        //location.reload("#ct_colores");
                             MostrarEspecialidades()
                        NumeroEspecialidad()

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



