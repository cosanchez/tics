

    $("#btndevolucion").hide();
filaDevolucion()
$('#Devolucion').click(function(){
    $('#cabeza').show();
    mostrarDevolucion()
    });


function check_excel_fc(){
        var pattern = /([12]\d{3}-(0[1-9]|1[0-2])-(0[1-9]|[12]\d|3[01]))/;
        var status = $("#fc").val();
        if (pattern.test(status) && status !== '') {
        $("#error_mensaje_fc").show();
        $("#error_mensaje_fc").html("Fecha Aceptada").css({"font-size": "15px", "color": "#34F458"});
        $("#fc").css("border-bottom","2px solid #34F458");
        return error_fc = false;
        } else {
        $("#error_mensaje_fc").html("La fecha es en formato YYYY-MM-DD").css({"font-size": "14px", "color": "red"});
        $("#error_mensaje_fc").show();
        $("#fc").css("border-bottom","2px solid #F90A0A");
        return error_fc = true;
        }
        }


function checkar_excel_desc(){
        var pattern = /^[a-zA-Z\s]*$/;
        var status = $("#descripcion").val();
        if (pattern.test(status) && status !== '') {
        $("#error_mensaje_cliente").show();
        $("#error_mensaje_cliente").html("Campo aceptado").css({"font-size": "15px", "color": "#34F458"});
        $("#descripcion").css("border-bottom","2px solid #34F458");
         return error_nombre = false;
        } else {
        $("#error_mensaje_cliente").html("No se permiten numeros ni acentos").css({"font-size": "14px", "color": "red"});
        $("#error_mensaje_cliente").show();
        $("#descripcion").css("border-bottom","2px solid #F90A0A");
        return error_nombre = true;
        }
      }


function checkar_excel_num(campo){
        var pattern = /^[0-9]{10}$/;
        var status = campo;
        if (pattern.test(status) && status !== '') {
            return "Correcto"
        }else{
            return "Incorrecto"
        }
      }


function checkar_excel_desc(campo){
        var pattern = /^[a-zA-ZñÑ\s]*$/;
        var status = campo;
        if (pattern.test(status) && status !== '') {
            return "Correcto"
        }else{
            return "Incorrecto"
        }
      }

function mostrarDevolucion(){
 $.ajax({
            type: 'ajax',
            url: '../Excel/mostrarDevolucion',
            async: false,
            dataType: 'json',
            success: function(data){

                var html = '';
                var nombres = '';
                var i;
                var rol = parseInt($("#rol").val());
                nombres+='<th id="tw">Fecha</th>'+
                      '<th id="tw">Cantidad</th>'+
                      '<th id="tw">Descripcion</th>';
                      if (rol==1) {
                        nombres+='</tr>';
                      }else{
                        nombres+='<th id="tw">Opciones</th>'+
                      '</tr>';
                      }
                      

                      $('#cabeza').html(nombres); 
                for(i=0; i<data.length; i++){

                    if(checkar_excel_desc(data[i].descripcion)=="Correcto"){ 
                
                } else{
                         html +='<tr>'+

                                '<td>'+data[i].fecha+'</td>'+
                                '<td>'+data[i].cantidad+'</td>'+  
                                '<td>'+data[i].descripcion+'</td>';
                                if (rol==1) {
                                   html += '</tr>' ;
                                }else{
                                    html +='<td>'+
                                    '<a href="javascript:;" class=" item-edit-Devolucion" data="'+data[i].id_devoluciones+'"><img src="../../mysql/img/lapiz.png" width="40" height="40" class="d-inline-block align-top" title="Editar" alt="Imagen editar"></a>'+"&nbsp;&nbsp;&nbsp;"+
                                    '<a href="javascript:;" class=" item-delete-Devolucion" data="'+data[i].id_devoluciones+'"><img src="../../mysql/img/eliminar.png" width="40" height="40" class="d-inline-block align-top" title="Eliminar" alt="Imagen elimimnar"></a>'+"&nbsp;&nbsp;&nbsp;"+
                                    
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
$('#resultado').on('click', '.item-edit-Devolucion', function(){

        var id_devoluciones = $(this).attr('data');
        $('#myModalDevolucion').modal('show');
        $('#myModalDevolucion').find('.modal-title').text('Corregir Registro ');
        $('#myModalDevolucion').find('.modal-header').css('background-color', '#FE2E2E');
        $('#myFormDevolucion').attr('action', '../Excel/ActualizarDevolucion');

        $.ajax({
            type: 'ajax',
            method: 'get',
            url: '../Excel/EditarDevolucion',
            data: {id_devoluciones: id_devoluciones},
            async: false,
            dataType: 'json',
            success: function(data){
                
                $('input[name=fecha]').val(data[0].fecha);
                $('input[name=cantidad]').val(data[0].cantidad);
                $('input[name=descripcion]').val(data[0].descripcion);
                $('input[name=id_devoluciones]').val(data[0].id_devoluciones);
                $('input[name=id_productos]').val(data[0].id_productos);
                $('input[name=id_empleado]').val(data[0].id_empleado);
                
            
            },
            
            
        });
    });


//Editar el cliente utilizando modal y AJAX
    $('#btnSaveDevolucion').click(function(){
        var url = $('#myFormDevolucion').attr('action');
        var data = $('#myFormDevolucion').serialize();

        var id_devoluciones =$('input[name=id_devoluciones]');
       // var nombre =$('input[name=status]');
       
            $.ajax({
                type: 'ajax',
                method: 'post',
                url: url,
                data: data,
                async: false,
                dataType: 'json',
                success: function(response){
                    if(response.success){
                        $('#myModalDevolucion').modal('hide');
                      
                        if(response.type=='update'){
                            var type ="Actualizado"
                        }
                        $('.alert-success').html('Registro '+type+' Correctamente').fadeIn().delay(4000).fadeOut('slow');
                        filaDevolucion()
                        mostrarDevolucion()
                    }else{
                        $('.alert-danger').html('No se realizo ningun cambio').fadeIn().delay(4000).fadeOut('slow');
                        $('#myModalDevolucion').modal('hide');
                        
                    }
                },
                error: function(){
                    alert('No se pudo realizar los cambios');
                }
            });
       
    });
      //Eliminar registro de agenda
    $('#resultado').on('click', '.item-delete-Devolucion', function(){
        var id_devoluciones = $(this).attr('data');
        $('#deleteModal').modal('show');
        //prevent previous handler - unbind()
        $('#btnDelete').unbind().click(function(){
            $.ajax({
                type: 'ajax',
                method: 'get',
                async: false,
                url: '../Excel/DeleteDevolucion',
                data:{id_devoluciones:id_devoluciones},
                dataType: 'json',
                success: function(response){
                    if(response.success){
                        //location.reload("#Tablas");
                        $('#deleteModal').modal('hide');
                        $('.alert-danger').html('Registro Eliminado Correctamente').fadeIn().delay(4000).fadeOut('slow');
                        filaDevolucion()
                        mostrarDevolucion()
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

// numero de filas de Agenda




function filaDevolucion(){
$.ajax({
        type: 'ajax',
        url: '../Excel/mostrarDevolucion',
        async: false,
        dataType: 'json',
        success: function(data){
            var html='';
            var reset='';
            var j=0;
            for (var i=0; i<data.length; i++) {
            if(checkar_excel_desc(data[i].descripcion)==("Correcto")){
                var parametros = {
                "valor1" : data[i].id_devoluciones,    
                "valor2" : data[i].id_productos,
                "valor3" : data[i].id_empleado,
                "valor4" : data[i].fecha,
                "valor5" : data[i].cantidad,
                "valor6" : data[i].descripcion
                };
                 $.ajax({
                data: parametros, //datos que se envian a traves de ajax
                url:   '../Excel/insertDevolucionSQL/', //archivo que recibe la peticion
                type:  'post', //método de envio
        });

            }else{
                j=j+1;
            }
           }
           
           
            html+='<h5 style="color: red">'+'Devolucion'+' ' +'('+j+')'+'</h5>';  

         

             if (j!=0) {
                $("#btndevolucion").show();
                $('#numeroDevolucion').html(html);


                
            }else{
                 $('#numeroDevolucion').html(reset);
                 $('#cabeza').html(reset);
                 $('#cabeza').hide();
                 $('#tabla').html(reset);
                 $("#btndevolucion").hide();
               
            }



        },
        error: function(){
            alert('Could not get Data from Database');
        }
    });
}
