

$("#btnventas").hide();

         var error_producto = false;
         var error_cantidad = false;
         var error_fecha = false;
      $("#producto").focusout(function(){check_producto();});
      $("#cantidad").focusout(function(){check_cantidad();});
      $("#fech").focusout(function(){check_fecha();});

      function check_producto(){
        var pattern = /^[a-zA-Z\s]*$/;
        var status = $("#producto").val();
        if (pattern.test(status) && status !== '') {
        $("#error_mensaje_producto").show();
        $("#error_mensaje_producto").html("Campo aceptado").css({"font-size": "15px", "color": "#34F458"});
        $("#producto").css("border-bottom","2px solid #34F458");
        return error_producto = false;
        } else {
        $("#error_mensaje_producto").html("Solo se aceptan letras y sin acento").css({"font-size": "14px", "color": "red"});
        $("#error_mensaje_producto").show();
        $("#producto").css("border-bottom","2px solid #F90A0A");
        return error_producto = true;
        }
      }

       function check_cantidad(){
        var pattern = /[0-9]/;
        var status = $("#cantidad").val();
        if (pattern.test(status) && status > 0) {
        $("#error_mensaje_cantidad").show();
        $("#error_mensaje_cantidad").html("Campo aceptado").css({"font-size": "15px", "color": "#34F458"});
        $("#cantidad").css("border-bottom","2px solid #34F458");
        return error_cantidad = false;
        } else {
        $("#error_mensaje_cantidad").html("La cantidad tiene que ser mayor a cero").css({"font-size": "14px", "color": "red"});
        $("#error_mensaje_cantidad").show();
        $("#cantidad").css("border-bottom","2px solid #F90A0A");
        return error_cantidad = true;
        }
      }

      function check_fecha(){
        var pattern = /([12]\d{3}-(0[1-9]|1[0-2])-(0[1-9]|[12]\d|3[01]))/;
        var status = $("#fech").val();
        if (pattern.test(status) && status !== '') {
        $("#error_mensaje_fecha").show();
        $("#error_mensaje_fecha").html("Fecha Aceptada").css({"font-size": "15px", "color": "#34F458"});
        $("#fech").css("border-bottom","2px solid #34F458");
        return error_fecha = false;
        } else {
        $("#error_mensaje_fecha").html("La fecha es en formato YYYY-MM-DD").css({"font-size": "14px", "color": "red"});
        $("#error_mensaje_fecha").show();
        $("#fech").css("border-bottom","2px solid #F90A0A");
        return error_fecha = true;
        }
      }


      function ct(campo){
        
        var status = campo;
        if (status !== '' && status > 0) {
            return "Correcto"
        }else{
            return "Incorrecto"
        }
      }


function fec(campo){
         var pattern = /([12]\d{3}-(0[1-9]|1[0-2])-(0[1-9]|[12]\d|3[01]))/;
        var status = campo;
        if (pattern.test(status) && status !== '') {
            return "Correcto"
        }else{
            return "Incorrecto"
        }
      }

FilasVentas()

   $('#ventas').click(function(){

    MostrarVentas()

    });

   function MostrarVentas(){

    $.ajax({
        type: 'ajax',
        url: '../Mysql/MostrarVentas',
        async: false,
        dataType: 'json',
        success: function(data){

            var html = '';
            var nombres = '';
            var i;
            var tabla ='';
            var rol = $("#rol").val();
             parseInt(rol);

            tabla+='<h4 style="color: red; text-align: center;"><strong>Tabla Ventas</strong></h4>';
            $('#tabla').html(tabla); 


            nombres+='<th id="tw">Nombre Producto</th>'+
                  '<th id="tw">Nombre Empleado</th>'+
                  '<th id="tw">Nombre Cliente</th>'+
                  '<th id="tw">Cantidad</th>'+
                  '<th id="tw">Fecha</th>';
                  if (rol== 1) {
                    nombres+='</tr>';
                  }else{
                    nombres+='<th id="tw">opciones</th>'+
                    '</tr>';
                  }
                  

                  $('#cabeza').html(nombres); 


            for(i=0; i<data.length; i++){

                if(ct(data[i].cantidad)=="Correcto" 
                && fec(data[i].fecha)=="Correcto"){

               
                }else{

                
                     html +='<tr>'+
                     		'<td>'+data[i].nombre+'</td>'+
                     		'<td>'+data[i].nombre_E+' '+data[i].PrimerApellido_E+'</td>'+
                            '<td>'+data[i].Nombre+' '+data[i].PrimerApellido+'</td>'+
                            '<td>'+data[i].cantidad+'</td>'+
                            '<td>'+data[i].fecha+'</td>';
                            if (rol== 1) {
                                html +='</tr>' ;
                            }else{
                              html +='<td>'+
                             
                                '<a href="javascript:;" class=" item-edit-ventas" data="'+data[i].id_venta+'"><img src="../../mysql/img/lapiz.png" width="40" height="40" class="d-inline-block align-top" title="Editar" alt="Imagen editar"></a>'+"&nbsp;&nbsp;&nbsp;"+
                                '<a href="javascript:;" class=" item-delete-ventas" data="'+data[i].id_venta+'"><img src="../../mysql/img/eliminar.png" width="40" height="40" class="d-inline-block align-top" title="Eliminar" alt="Imagen elimimnar"></a>'+"&nbsp;&nbsp;&nbsp;"+
                                
                            '</td>'+
                        '</tr>' ;
                            }                           
                       
            }
        }
               
            $('#resultado').html(html);
        },
        error: function(){
            alert('Could not get Data from Database');
        }
    });
}


//Modal editar edit
    $('#resultado').on('click', '.item-edit-ventas', function()
    {
        var id_venta = $(this).attr('data');
        $('#myModalVentas').modal('show');
        $('#myModalVentas').find('.modal-title').text('Corregir Registro ');
        $('#myModalVentas').find('.modal-header').css('background-color', '#FE2E2E');
        $('#myFormVentas').attr('action', '../Mysql/ActualizarVentas');
        $.ajax({
            type: 'ajax',
            method: 'get',
            url: '../Mysql/EditarVentas',
            data: {id_venta: id_venta},
            async: false,
            dataType: 'json',
            success: function(data){
                

            
                $('input[name=producto]').val(data.nombre);
                $('input[name=empleado]').val(data.nombre_E+' '+data.PrimerApellido_E);
                $('input[name=cliente]').val(data.Nombre+' '+data.PrimerApellido);

                $('input[name=cantidad]').val(data.cantidad);
                check_cantidad()
              
                if (error_cantidad===false) {
                      $('input[name=cantidad]').val(data.cantidad).attr('readonly',true);
                }else{
                     $('input[name=cantidad]').val(data.cantidad).attr('readonly',false);
                }
                $('input[name=fecha]').val(data.fecha);
                check_fecha()

                if (error_fecha===false) {
                      $('input[name=fecha]').val(data.fecha).attr('readonly',true);
                }else{
                     $('input[name=fecha]').val(data.fecha).attr('readonly',false);
                }

                $('input[name=id_venta]').val(data.id_venta);
                
                 
            
            },
            error: function(){
                alert('No se puede editar, el dato');
            }
        });
    });


    //Editar el cliente utilizando modal y AJAX
    $('#btnSaveVentas').click(function(){
        var url = $('#myFormVentas').attr('action');
        var data = $('#myFormVentas').serialize();

   
         // check_producto()
          check_cantidad()
          check_fecha()
        
        if (error_cantidad === false && error_fecha === false)
        {

    
            $.ajax({
                type: 'ajax',
                method: 'post',
                url: url,
                data: data,
                async: false,
                dataType: 'json',
                success: function(response){
                    if(response.success){
                        $('#myModalVentas').modal('hide');
                      
                        if(response.type=='update'){
                            var type ="Actualizado"
                        }
                        $('.alert-success').html('Registro '+type+' Correctamente').fadeIn().delay(4000).fadeOut('slow');
                        MostrarVentas()
                        FilasVentas()
                    }else{
                        $('.alert-danger').html('No se realizo ningun cambio').fadeIn().delay(4000).fadeOut('slow');
                        $('#myModalVentas').modal('hide');
                        
                    }
                },
                error: function(){
                    alert('No se pudo realizar los cambios');
                }
            });
        
       }else{
            alert("La fecha no es correcta!!");
        }
        
    });

   //Eliminar registro de agenda
    $('#resultado').on('click', '.item-delete-ventas', function(){
        var id_ventas = $(this).attr('data');
        $('#deleteModal').modal('show');
        //prevent previous handler - unbind()
        $('#btnDelete').unbind().click(function(){
            $.ajax({
                type: 'ajax',
                method: 'get',
                async: false,
                url: '../Mysql/DeleteVentas',
                data:{id_ventas:id_ventas},
                dataType: 'json',
                success: function(response){
                    if(response.success){
                        //location.reload("#Tablas");
                        $('#deleteModal').modal('hide');
                        $('.alert-danger').html('Registro Eliminado Correctamente').fadeIn().delay(4000).fadeOut('slow');
                       MostrarVentas()
                        FilasVentas()
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


function FilasVentas(){

 $.ajax({
        type: 'ajax',
        url: '../Mysql/MostrarVentas',
        async: false,
        dataType: 'json',
        success: function(data){
            var i;
             var html='';
            var reset='';

           
             var contador=0;
            for(i=0; i<data.length; i++){
                
                  if(ct(data[i].cantidad)=="Correcto" 
                && fec(data[i].fecha)=="Correcto"){

                     var parametros = {
                "id_venta" : data[i].id_venta,
                "id_producto" : data[i].id_producto,
                "id_empleado" : data[i].id_empleado,
                "id_cliente" : data[i].id_cliente,
                "cantidad" : data[i].cantidad,
                "hora" : data[i].hora,
                "fecha" : data[i].fecha,
                "id_forma_pago" : data[i].id_forma_pago
            };


        $.ajax({
                data: parametros, //datos que se envian a traves de ajax
                url:   '../Mysql/SQLVentas/', //archivo que recibe la peticion
                type:  'post', //método de envio
             });
    


                }else{
                   
                
                    contador = contador+1;
                   

                }
            }


              html+='<h5 style="color: red">'+'Ventas'+' ' +'('+contador+')'+'</h5>';
    
            if (contador!=0) {
                $("#btnventas").show();
                $('#numeroventas').html(html);


                
            }else{
                 $('#numeroventas').html(reset);
                 $('#cabeza').html(reset);
                 $('#tabla').html(reset);
                 $("#btnventas").hide();
            }
        },
       
    });



}

