
      $("#btnalmacen").hide();
    filAlmacen()
$('#Almacen').click(function(){
    $('#cabeza').show();
    mostrarAlmacen()
    });



function checkar_excel_nom(){
        var pattern = /^[a-zA-Z\s]*$/;
        var status = $("#nombre").val();
        if (pattern.test(status) && status !== '') {
        $("#error_mensaje_cliente").show();
        $("#error_mensaje_cliente").html("Campo aceptado").css({"font-size": "15px", "color": "#34F458"});
        $("#nombre").css("border-bottom","2px solid #34F458");
         return error_nombre = false;
        } else {
        $("#error_mensaje_cliente").html("No se permiten numeros ni acentos").css({"font-size": "14px", "color": "red"});
        $("#error_mensaje_cliente").show();
        $("#nombre").css("border-bottom","2px solid #F90A0A");
        return error_nombre = true;
        }
      }



function checkar_excel_nom(campo){
        var pattern = /^[a-zA-ZñÑ\s]*$/;
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

function mostrarAlmacen(){
 $.ajax({

            type: 'ajax',
            url: '../Excel/mostrarAlmacen',
            async: false,
            dataType: 'json',
            success: function(data){

                var html = '';
                var nombres = '';
                var i;
                 var rol = parseInt($("#rol").val());

                nombres+='<th id="tw">Descripcion</th>'+
                      '<th id="tw">Stock_Min</th>'+
                      '<th id="tw">Stock_Max</th>'+
                      '<th id="tw">Nombre</th>';
                      if (rol==1) {
                         nombres+='</tr>';
                      }else{
                          nombres+='<th id="tw">Opciones</th>'+
                      '</tr>';
                      }
                     

                      $('#cabeza').html(nombres); 
                for(i=0; i<data.length; i++){
                    if(checkar_excel_nom(data[i].nombre)=="Correcto"
                    && checkar_excel_desc(data[i].descripcion)=="Correcto"){ 
                
                } else{
                         html +='<tr>'+
                                '<td>'+data[i].descripcion+'</td>'+
                                '<td>'+data[i].stock_min+'</td>'+  
                                '<td>'+data[i].stock_max+'</td>'+  
                                '<td>'+data[i].nombre+'</td>';
                                if (rol==1) {
                                    html +='</tr>' ; 
                                }else{
                                    html +='<td>'+
                                    '<a href="javascript:;" class=" item-edit-Almacen" data="'+data[i].id_almacen+'"><img src="../../mysql/img/lapiz.png" width="40" height="40" class="d-inline-block align-top" title="Editar" alt="Imagen editar"></a>'+"&nbsp;&nbsp;&nbsp;"+
                                    '<a href="javascript:;" class=" item-delete-Almacen" data="'+data[i].id_almacen+'"><img src="../../mysql/img/eliminar.png" width="40" height="40" class="d-inline-block align-top" title="Eliminar" alt="Imagen elimimnar"></a>'+"&nbsp;&nbsp;&nbsp;"+
                                    
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
$('#resultado').on('click', '.item-edit-Almacen', function(){
        var id_almacen = $(this).attr('data');
        $('#myModalAlmacen').modal('show');
        $('#myModalAlmacen').find('.modal-title').text('Corregir Registro ');
        $('#myModalAlmacen').find('.modal-header').css('background-color', '#FE2E2E');
        $('#myFormAlmacen').attr('action', '../Excel/UpdateAlmacen');

        $.ajax({
            type: 'ajax',
            method: 'get',
            url: '../Excel/EditarAlmacen',
            data: {id_almacen: id_almacen},
            async: false,
            dataType: 'json',
            success: function(data){

                
                $('input[name=descripcion]').val(data[0].descripcion);
                $('input[name=stock_min]').val(data[0].stock_min);
                $('input[name=stock_max]').val(data[0].stock_max);
                $('input[name=nombre]').val(data[0].nombre);
                $('input[name=id_almacen]').val(data[0].id_almacen);
                $('input[name=id_productos]').val(data[0].id_productos);
            
            },
            
            
        });
    });


//Editar el cliente utilizando modal y AJAX
    $('#btnSaveAlmacen').click(function(){
        var url = $('#myFormAlmacen').attr('action');
        var data = $('#myFormAlmacen').serialize();

        var id_almacen =$('input[name=id_almacen]');
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
                        $('#myModalAlmacen').modal('hide');
                      
                        if(response.type=='true'){
                            var type ="Actualizado"
                        }
                        $('.alert-success').html('Registro '+type+' Correctamente').fadeIn().delay(4000).fadeOut('slow');
                        filAlmacen()
                        mostrarAlmacen()
                    }else{
                        $('.alert-danger').html('No se realizo ningun cambio').fadeIn().delay(4000).fadeOut('slow');
                        $('#myModalAlmacen').modal('hide');
                        
                    }
                },
                error: function(){
                    alert('No se pudo realizar los cambios');
                }
            });
       
    });
      //Eliminar registro de agenda
    $('#resultado').on('click', '.item-delete-Almacen', function(){
        var id_almacen = $(this).attr('data');
        $('#deleteModal').modal('show');
        //prevent previous handler - unbind()
        $('#btnDelete').unbind().click(function(){
            $.ajax({
                type: 'ajax',
                method: 'get',
                async: false,
                url: '../Excel/DeleteAlmacen',
                data:{id_almacen:id_almacen},
                dataType: 'json',
                success: function(response){
                    if(response.success){
                        //location.reload("#Tablas");
                        $('#deleteModal').modal('hide');
                        $('.alert-danger').html('Registro Eliminado Correctamente').fadeIn().delay(4000).fadeOut('slow');
                       mostrarAlmacen()
                       filAlmacen()
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




function filAlmacen(){
$.ajax({
        type: 'ajax',
        url: '../Excel/mostrarAlmacen',
        async: false,
        dataType: 'json',
        success: function(data){
            var html='';
            var reset='';
           var j=0;
           for (var i=0; i<data.length; i++) {
            if(checkar_excel_nom(data[i].nombre)=="Correcto" && 
               checkar_excel_desc(data[i].descripcion)==("Correcto")){
                     var parametros = {
                "valor1" : data[i].id_almacen,
                "valor2" : data[i].id_productos,
                "valor3" : data[i].descripcion,
                "valor4" : data[i].stock_min,
                "valor5" : data[i].stock_max,
                "valor6" : data[i].nombre
                };
                 $.ajax({
                data: parametros, //datos que se envian a traves de ajax
                url:   '../Excel/insertAlmacenSQL/', //archivo que recibe la peticion
                type:  'post', //método de envio
        });

            }else{
                j=j+1;
            }    
           }
        
               html+='<h5 style="color: red">'+'Almacen'+' ' +'('+j+')'+'</h5>';  
            
       

            if (j!=0) {
                $("#btnalmacen").show();
                $('#numeroAlmacen').html(html);


                
            }else{
                 $('#numeroAlmacen').html(reset);
                 $('#cabeza').html(reset);
                 $('#tabla').html(reset);
                 $("#btnalmacen").hide();
               
            }




        },
        error: function(){
            alert('Could not get Data from Database');
        }
    });
}

