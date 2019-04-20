
$("#btncompras").hide();
      var error_monto = false;
      $("#monto").focusout(function(){check_monto();});

      function check_monto(){
        var pattern = /[0-9]/;
        var status = $("#monto").val();
      if (pattern.test(status) && status !== '' && status > 0 && status < 100000) {
        $("#error_mensaje_monto").show();
        $("#error_mensaje_monto").html("Campo aceptado").css({"font-size": "15px", "color": "#34F458"});
        $("#monto").css("border-bottom","2px solid #34F458");
        return error_monto = false;
        } else {
        $("#error_mensaje_monto").html("El monto debe ser mayor a cero ").css({"font-size": "14px", "color": "red"});
        $("#error_mensaje_monto").show();
        $("#monto").css("border-bottom","2px solid #F90A0A");
        return error_monto = true;
        }
      }


FilasCompras()

 $('#compras').click(function(){

    Compras()

    });


function Compras(){

    $.ajax({
        type: 'ajax',
        url: '../Mysql/MostrarCompras',
        async: false,
        dataType: 'json',
        success: function(data){

            var html = '';
            var nombres = '';
            var i;
            var tabla ='';
            var rol = $("#rol").val();
             parseInt(rol);

            tabla+='<h4 style="color: red; text-align: center;"><strong>Tabla Compras</strong></h4>';
            $('#tabla').html(tabla); 



            nombres+='<th id="tw"># Compra</th>'+
                 '<th id="tw">#Pedido:</th>'+
                  '<th id="tw">Comprado por:</th>'+
                  '<th id="tw">Monto</th>'+
                  '<th id="tw">Fecha</th>';
                  if (rol==1) {
                      nombres+='</tr>';
                  }else{
                     nombres+='<th id="tw">opciones</th>'+
                  '</tr>';
                  }
                  

                  $('#cabeza').html(nombres); 


            for(i=0; i<data.length; i++){
              
                 if(data[i].monto > 0 ){

               
                }else{
                     html +='<tr>'+
                            '<td>'+data[i].id_compras+'</td>'+
                            '<td>'+data[i].id_pedido+'</td>'+
                            '<td>'+data[i].nombre_E+' '+data[i].PrimerApellido_E+'</td>'+
                            '<td>'+'$'+' '+data[i].monto+'</td>'+
                            '<td>'+data[i].fecha+'</td>';
                            if (rol==1) {
                                html +='</tr>' ;
                            }else{
                                html +='<td>'+
                             
                                '<a href="javascript:;" class=" item-edit-compras" data="'+data[i].id_compras+'"><img src="../../mysql/img/lapiz.png" width="40" height="40" class="d-inline-block align-top" title="Editar" alt="Imagen editar"></a>'+"&nbsp;&nbsp;&nbsp;"+
                                '<a href="javascript:;" class=" item-delete-compras" data="'+data[i].id_compras+'"><img src="../../mysql/img/eliminar.png" width="40" height="40" class="d-inline-block align-top" title="Eliminar" alt="Imagen elimimnar"></a>'+"&nbsp;&nbsp;&nbsp;"+
                                
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



//Modal editar compras
    $('#resultado').on('click', '.item-edit-compras', function()
    {
        var id_compras = $(this).attr('data');
        $('#myModalCompras').modal('show');
        $('#myModalCompras').find('.modal-title').text('Corregir Registro ');
        $('#myModalCompras').find('.modal-header').css('background-color', '#FE2E2E');
        $('#myFormCompras').attr('action', '../Mysql/ActualizarCompras');
        $.ajax({
            type: 'ajax',
            method: 'get',
            url: '../Mysql/EditarCompras',
            data: {id_compras: id_compras},
            async: false,
            dataType: 'json',
            success: function(data){
                

            
                $('input[name=pedido]').val(data.id_compras);
                $('input[name=nombre_empleado]').val(data.nombre_E+'  '+data.PrimerApellido_E);
                $('input[name=monto]').val(data.monto);
                $('input[name=status]').val(data.fecha);
                $('input[name=id_compras]').val(data.id_compras);

                check_monto()
            
            },
            error: function(){
                alert('No se puede editar, el dato');
            }
        });
    });

//Editar el modal compras utilizando  AJAX
    $('#btnSaveCompras').click(function(){
        var url = $('#myFormCompras').attr('action');
        var data = $('#myFormCompras').serialize();

          check_monto()
        
        if (error_monto === false)
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
                        $('#myModalCompras').modal('hide');
                      
                        if(response.type=='update'){
                            var type ="Actualizado"
                        }
                        $('.alert-success').html('Registro '+type+' Correctamente').fadeIn().delay(4000).fadeOut('slow');
                        Compras()
                        FilasCompras()
                    }else{
                        $('.alert-danger').html('No se realizo ningun cambio').fadeIn().delay(4000).fadeOut('slow');
                        $('#myModalCompras').modal('hide');
                        
                    }
                },
                error: function(){
                    alert('No se pudo realizar los cambios');
                }
            });
       }else{
            alert("Monto Incorrecto");
        }
       
        
    });


      //Eliminar registro de agenda
    $('#resultado').on('click', '.item-delete-compras', function(){
        var id_compras = $(this).attr('data');
        $('#deleteModal').modal('show');
        //prevent previous handler - unbind()
        $('#btnDelete').unbind().click(function(){
            $.ajax({
                type: 'ajax',
                method: 'get',
                async: false,
                url: '../Mysql/DeleteCompras',
                data:{id_compras:id_compras},
                dataType: 'json',
                success: function(response){
                    if(response.success){
                        //location.reload("#Tablas");
                        $('#deleteModal').modal('hide');
                        $('.alert-danger').html('Registro Eliminado Correctamente').fadeIn().delay(4000).fadeOut('slow');
                        Compras()
                        FilasCompras()
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

function FilasCompras(){



         $.ajax({
        type: 'ajax',
        url: '../Mysql/MostrarCompras',
        async: false,
        dataType: 'json',
        success: function(data){
            var i;
             var html='';
            var reset='';

           
             var contador=0;
            for(i=0; i<data.length; i++){

                if(data[i].monto > 0){
            var parametros = {
                "id_compras" : data[i].id_compras,
                "id_pedido" : data[i].id_pedido,
                "monto" : data[i].monto, 
                "fecha" : data[i].fecha
            };


        $.ajax({
                data: parametros, //datos que se envian a traves de ajax
                url:   '../Mysql/SQLCompras/', //archivo que recibe la peticion
                type:  'post', //método de envio
             });
                
        

                }else{
                   
                
                    contador = contador+1;
                   

                }
            }


       html+='<h5 style="color: red">'+'Compras'+' ' +'('+contador+')'+'</h5>';
          
          
            if (contador!=0) {
                $("#btncompras").show();
                $('#numerocompras').html(html);


                
            }else{
                 $('#numerocompras').html(reset);
                 $('#cabeza').html(reset);
                 $('#tabla').html(reset);
                 $("#btncompras").hide();
            }
        },
       
    });
}


