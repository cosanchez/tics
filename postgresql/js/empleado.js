

  var nom_error=false;
  var apellidounoerror=false;
  var apellidodoserror=false;
  var telefonoerror=false;
  var cperror=false;
  $("#nom").focusout(function(){check_nombreE();});
  $("#1apellido").focusout(function(){check_unoapellidoE();});
  $("#2apellido").focusout(function(){check_dosapellidosE();});
  $("#tel").focusout(function(){check_telefonoE();});
  $("#cpe").focusout(function(){check_cpE();});

function check_nombreE(){
        var pattern = /^[a-zA-Z\s]*$/;
        var status = $("#nom").val();
        if (pattern.test(status) && status !== '') {
        $("#error_nombre_empleado").show();
        $("#error_nombre_empleado").html("Campo aceptado").css({"font-size": "12px", "color": "#34F458"});
        $("#nom").css("border-bottom","2px solid #34F458");

        return nom_error = false;

        } else {
        $("#error_nombre_empleado").html("Solo debe contener Letras").css({"font-size": "14px", "color": "red"});
        $("#error_nombre_empleado").show();
        $("#nom").css("border-bottom","2px solid #F90A0A");

         return nom_error = true;

        }
      }
function check_unoapellidoE(){
        var pattern = /^[a-zA-Z\s]*$/;
        var status = $("#1apellido").val();
        if (pattern.test(status) && status !== '') {
        $("#error_1apellido_empleado").show();
        $("#error_1apellido_empleado").html("Campo aceptado").css({"font-size": "12px", "color": "#34F458"});
        $("#1apellido").css("border-bottom","2px solid #34F458");
        return apellidounoerror = false;
        } else {
        $("#error_1apellido_empleado").html("Solo debe contener Letras").css({"font-size": "14px", "color": "red"});
        $("#error_1apellido_empleado").show();
        $("#1apellido").css("border-bottom","2px solid #F90A0A");
        return apellidounoerror = true;
        }
      }
function check_dosapellidosE(){
        var pattern = /^[a-zA-Z\s]*$/;
        var status = $("#2apellido").val();
        if (pattern.test(status) && status !== '') {
        $("#error_2apellido_empleado").show();
        $("#error_2apellido_empleado").html("Campo aceptado").css({"font-size": "12px", "color": "#34F458"});
        $("#2apellido").css("border-bottom","2px solid #34F458");
        return apellidounoerror = false;
        } else {
        $("#error_2apellido_empleado").html("Solo debe contener Letras").css({"font-size": "14px", "color": "red"});
        $("#error_2apellido_empleado").show();
        $("#2apellido").css("border-bottom","2px solid #F90A0A");
        return apellidounoerror = true;
        }
      }

function check_telefonoE(){
        var pattern = /^[0-9]*$/;
        var status = $("#tel").val();
        if (pattern.test(status) && status !== '') {
        $("#error_telefono_empleado").show();
        $("#error_telefono_empleado").html("Campo aceptado").css({"font-size": "12px", "color": "#34F458"});
        $("#tel").css("border-bottom","2px solid #34F458");
        return telefonoerror = false;
        } else {
        $("#error_telefono_empleado").html("Solo debe contener Numero maximo 10 digitos").css({"font-size": "14px", "color": "red"});
        $("#error_telefono_empleado").show();
        $("#tel").css("border-bottom","2px solid #F90A0A");
        return telefonoerror = true;
        }
      }
function check_cpE(){
        var pattern = /^[0-9]*$/;
        var status = $("#cpe").val();
        if (pattern.test(status) && status !== '') {
        $("#error_cp_empleado").show();
        $("#error_cp_empleado").html("Campo aceptado").css({"font-size": "12px", "color": "#34F458"});
        $("#cpe").css("border-bottom","2px solid #34F458");
        return cperror =false;
        } else {
        $("#error_cp_empleado").html("Solo debe contener Numeros maximo 5 Digitos").css({"font-size": "14px", "color": "red"});
        $("#error_cp_empleado").show();
        $("#cpe").css("border-bottom","2px solid #F90A0A");
        return cperror = true;
        }
      }
 function check_nom(campo){
        var pattern = /^[a-zA-ZáéíóúñÑ\s]*$/;
        var status = campo;
        if (pattern.test(status) && status !== '') {
            return "Correcto"
        }else{
            return "Incorrecto"
        }
      }


    function check_cpTabla(campo){
        var pattern = /^[0-9]{5}$/;
        var status = campo;
        if (pattern.test(status) && status !== '') {
            return "Correcto"
        }else{
            return "Incorrecto"
        }
      }

     function check_num(campo){
        var pattern = /^[0-9]{10}$/;
        var status = campo;
        if (pattern.test(status) && status !== '') {
            return "Correcto"
        }else{
            return "Incorrecto"
        }
      }


NumeroEmpleados()

function NumeroEmpleados(){
    $.ajax({
        type: 'ajax',
        url: '../Posgrees/MostrarEmpleados',
        async: false,
        dataType: 'json',
        success: function(data){
            var html='';
            var reset='';
            var j=0;
            for (var i = 0; i < data.length; i++) {
                if(check_nom(data[i].nombre)=="Correcto" && check_nom(data[i].primerapellido)=="Correcto"
                && check_nom(data[i].segundoapellido)=="Correcto" && check_num(data[i].telefono)=="Correcto"
                && check_cpTabla(data[i].cp)=="Correcto"){
            var parametros = {
                "valor1" : data[i].idempleado,
                "valor2" : data[i].nombre,
                "valor3" : data[i].idturno,
                "valor4" : data[i].idespecialidad,
                "valor5" : data[i].primerapellido,
                "valor6" : data[i].segundoapellido,
                "valor7" : data[i].domicilio,
                "valor8" : data[i].correo,
                "valor9" : data[i].telefono,
                "valor10" : data[i].cp,
                "valor11" : data[i].sexo
            };
        $.ajax({
                data: parametros, //datos que se envian a traves de ajax
                url:   '../Posgrees/insertEmpleadoSQL/', //archivo que recibe la peticion
                type:  'post', //método de envio
        });
                }else{
                    j=j+1;
                }
            }
            html+='<h5 style="color: red">'+'Empleados'+' ' +'('+j+')'+'</h5>';
            
            if (j!=0) {
                $("#btnempleados").show();
                $('#numeroempleados').html(html);
                
                 
            }else{
                 $('#numeroempleados').html(reset);
                  var reset='';
                 $('#cabeza').html(reset);
                 $('#cabeza').hide();
                 $('#tabla').html(reset);
                 $("#btnempleados").hide();
            }
        },
        error: function(){
           // alert('no trae nada de la base ');
        }
    });
}


  $('#empleados').click(function(){
     $('#cabeza').show();
    MostrarEmpleados()

    });

function MostrarEmpleados(){
    $.ajax( "../Posgrees/MostrarEmpleados" )
      .done(function(data) {
         var html = '';
                var nombres = '';
                var i;
                 var j;
                  var rol = parseInt($("#rol").val());
                   nombres+='<th id="tw">Nombre</th>'+
                      '<th id="tw">Primer Apellido</th>'+
                      '<th id="tw">Segundo Apellido</th>'+
                      '<th id="tw">Telefono</th>'+
                      '<th id="tw">Codigo Postal</th>';
                      if (rol==1) {
                        nombres+='</tr>';
                      }else{
                      nombres+='<th id="tw">opciones</th>'+
                      '</tr>';
                      }
                     
                      $('#cabeza').html(nombres); 
                     
    $.each(JSON.parse(data), function(i, element) {
      if(check_nom(element.nombre)=="Correcto" && check_nom(element.primerapellido)=="Correcto"
                && check_nom(element.segundoapellido)=="Correcto" && check_num(element.telefono)=="Correcto"
                && check_cpTabla(element.cp)=="Correcto"){
                }else{
                         html +='<tr>'+
                                '<td>'+element.nombre+'</td>'+
                                '<td>'+element.primerapellido+'</td>'+
                                '<td>'+element.segundoapellido+'</td>'+
                                '<td>'+element.telefono+'</td>'+
                                '<td>'+element.cp+'</td>';
                                if (rol==1) {
                                  html +='</tr>' ;
                                }else{
                                  html +='<td>'+
                                    '<a href="javascript:;" class=" item-edit-empleados" data="'+element.idempleado+'"><img src="../../mysql/img/lapiz.png" width="40" height="40" class="d-inline-block align-top" title="Editar" alt="Imagen editar"></a>'+"&nbsp;&nbsp;&nbsp;"+
                                    '<a href="javascript:;" class=" item-delete-empleados" data="'+element.idempleado+'"><img src="../../mysql/img/eliminar.png" width="40" height="40" class="d-inline-block align-top" title="Eliminar" alt="Imagen elimimnar"></a>'+"&nbsp;&nbsp;&nbsp;"+
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



//modal hardc
////

//Modal editar edit
  $('#resultado').on('click', '.item-edit-empleados', function()
    {
        var id = $(this).attr('data');
        $('#myModalEditarEmpleado').modal('show');
        $('#myModalEditarEmpleado').find('.modal-title').text('Corregir Registro ');
        $('#myModalEditarEmpleado').find('.modal-header').css('background-color', '#FE2E2E');
        $('#myModalEditarEmpleado #myFormEdit').attr('action', '../Posgrees/ActEmpleadoSQL');
        $.ajax({url:"../Posgrees/MostrarEmpleado",data:{idempleado:id} })
    .done(function(result) {
       var data=JSON.parse(result);
                $('input[name=nombre]').val(data.nombre);
                    check_nombreE()
                    if(nom_error===false){
                        $('input[name=nombre]').val(data.nombre).attr('readonly',true);
                    }else{
                        $('input[name=nombre]').val(data.nombre).attr('readonly',false);
                    }
                $('input[name=primerapellido]').val(data.primerapellido);
                    check_unoapellidoE()
                    if(apellidounoerror===false){
                        $('input[name=primerapellido]').val(data.primerapellido).attr('readonly',true);
                    }else{
                         $('input[name=primerapellido]').val(data.primerapellido).attr('readonly',false);
                    }
                $('input[name=segundoapellido]').val(data.segundoapellido);
                     check_dosapellidosE()
                    if(apellidodoserror===false){
                        $('input[name=segundoapellido]').val(data.segundoapellido).attr('readonly',true);
                    }else{
                         $('input[name=segundoapellido]').val(data.segundoapellido).attr('readonly',false);
                    }
                $('input[name=telefono]').val(data.telefono);
                    check_telefonoE()
                    if(telefonoerror===false){
                         $('input[name=telefono]').val(data.telefono).attr('readonly',true);
                    }else{
                        $('input[name=telefono]').val(data.telefono).attr('readonly',false);
                    }
                $('input[name=cp]').val(data.cp);
                    check_cpE()
                    if(cperror===false){
                        $('input[name=cp]').val(data.cp).attr('readonly',true);
                    }else{
                        $('input[name=cp]').val(data.cp).attr('readonly',false);
                    }
                $('input[name=id_empleado]').val(data.idempleado);
                $('input[name=id_turno]').val(data.idturno);
                $('input[name=id_especialidad]').val(data.idespecialidad);
                $('input[name=id_correo]').val(data.correo);
                $('input[name=id_domicilio]').val(data.domicilio);
                $('input[name=id_sexo]').val(data.sexo);
         //  check_nombreE()
         // check_unoapellidoE()
         // check_dosapellidosE()
         // check_telefonoE()
         // check_cpE()
    })
    .fail(function() {
      alert( "error" );
   });
});

      $('#myModalEditarEmpleado #btnSaveEdit').click(function(){
        var url = $('#myModalEditarEmpleado #myFormEdit').attr('action');
        var data = $('#myModalEditarEmpleado #myFormEdit').serialize();
         check_nombreE()
         check_unoapellidoE()
         check_dosapellidosE()
         check_telefonoE()
         check_cpE()
         
        if (nom_error === false && apellidounoerror===false && apellidounoerror===false 
          && telefonoerror===false && cperror===false){
            $.ajax({
                method: 'post',
                url: url,
                data: data,
                async: false,
                success: function(response){
                    if(response){
                        $('#myModalEditarEmpleado').modal('hide');
                      
                      if(response.type=='update'){
                            var type ="Actualizado"
                        }
                        $('.alert-success').html('Registro Correctamente').fadeIn().delay(4000).fadeOut('slow');
                        MostrarEmpleados()
                        NumeroEmpleados()
                    }else{
                        $('.alert-danger').html('No se realizo ningun cambio').fadeIn().delay(4000).fadeOut('slow');
                        $('#myModalEditarEmpleado').modal('hide');
                        
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

    //eliminar empleado//
    $('#resultado').on('click', '.item-delete-empleados', function(){
        var idempleado = $(this).attr('data');
        $('#deleteModal').modal('show');
        //prevent previous handler - unbind()
        $('#btnDelete').unbind().click(function(){
            $.ajax({
                type: 'ajax',
                method: 'get',
                async: false,
                url: '../Posgrees/EliminarEmpleado',
                data:{idempleado:idempleado},
                dataType: 'json',
                success: function(response){
                    if(response.success){
                        //location.reload("#Tablas");
                        $('#deleteModal').modal('hide');
                        $('.alert-danger').html('Registro Eliminado Correctamente').fadeIn().delay(1500).fadeOut('slow');
                    
                        NumeroEmpleados()
                        MostrarEmpleados()

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


