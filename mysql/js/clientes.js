


$("#btnclientes").hide();
       var error_telefono = false;
       var error_cp = false;
       var error_nombre = false;
       var error_primerapellido = false;
        var error_segundoapellido = false;

      $("#nombre").focusout(function(){check_nombre();});
       $("#primerapellido").focusout(function(){check_primerapellido();});
        $("#segundoapellido").focusout(function(){check_segundoapellido();});
           $("#telefono").focusout(function(){revisar_telefono();})
      $("#cp").focusout(function(){check_cp();});



      function revisar_telefono(){
        var pattern = /^[0-9]{10}$/;
        var status = $("#telefono").val();
        if (pattern.test(status) && status !== '') {
        $("#error_mensaje_telefono").show();
        $("#error_mensaje_telefono").html("Campo aceptado").css({"font-size": "15px", "color": "#34F458"});
        $("#telefono").css("border-bottom","2px solid #34F458");
        return error_telefono = false;
        } else {
        $("#error_mensaje_telefono").html("Solo debe contener 10 Numeros").css({"font-size": "14px", "color": "red"});
        $("#error_mensaje_telefono").show();
        $("#telefono").css("border-bottom","2px solid #F90A0A");

        return error_telefono = true;
        
         
         
        }
      }

      function check_nombre(){
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
      function check_primerapellido(){
        var pattern = /^[a-zA-Z\s]*$/;
        var status = $("#primerapellido").val();
        if (pattern.test(status) && status !== '') {
        $("#error_mensaje_primerapellido").show();
        $("#error_mensaje_primerapellido").html("Campo aceptado").css({"font-size": "15px", "color": "#34F458"});
        $("#primerapellido").css("border-bottom","2px solid #34F458");
         return error_primerapellido = false;
        } else {
        $("#error_mensaje_primerapellido").html("No se permiten numeros ni acentos").css({"font-size": "14px", "color": "red"});
        $("#error_mensaje_primerapellido").show();
        $("#primerapellido").css("border-bottom","2px solid #F90A0A");
        return error_primerapellido = true;
        }
      }
      function check_segundoapellido(){
        var pattern = /^[a-zA-Z\s]*$/;
        var status = $("#segundoapellido").val();
        if (pattern.test(status) && status !== '') {
        $("#error_mensaje_segundoapellido").show();
        $("#error_mensaje_segundoapellido").html("Campo aceptado").css({"font-size": "15px", "color": "#34F458"});
        $("#segundoapellido").css("border-bottom","2px solid #34F458");
         return error_segundoapellido = false;
        } else {
        $("#error_mensaje_segundoapellido").html("No se permiten numeros ni acentos").css({"font-size": "14px", "color": "red"});
        $("#error_mensaje_segundoapellido").show();
        $("#segundoapellido").css("border-bottom","2px solid #F90A0A");
        return error_segundoapellido = true;
        }
      }


      function check_cp(){
        var pattern = /^[0-9]{5}$/;
        var status = $("#cp").val();
        if (pattern.test(status) && status !== '') {
        $("#error_mensaje_cp").show();
        $("#error_mensaje_cp").html("Campo aceptado").css({"font-size": "15px", "color": "#34F458"});
        $("#cp").css("border-bottom","2px solid #34F458");
         return error_cp = false;
        } else {
        $("#error_mensaje_cp").html("Solo debe contener 5 Numeros").css({"font-size": "14px", "color": "red"});
        $("#error_mensaje_cp").show();
        $("#cp").css("border-bottom","2px solid #F90A0A");
        return error_cp = true;
        }
      }

     function checkar_nom(campo){
        var pattern = /^[a-zA-ZñÑ\s]*$/;
        var status = campo;
        if (pattern.test(status) && status !== '') {
            return "Correcto"
        }else{
            return "Incorrecto"
        }
      }


function checkar_ap1(campo){
        var pattern = /^[a-zA-ZñÑ\s]*$/;
        var status = campo;
        if (pattern.test(status) && status !== '') {
            return "Correcto"
        }else{
            return "Incorrecto"
        }
      }
      function checkar_ap2(campo){
        var pattern = /^[a-zA-ZñÑ\s]*$/;
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



NumeroClientes()


   $('#clientes').click(function(){

    MostrarClientes()

    });

   $('#delete').click(function(){

alert("perros");

    });
function MostrarClientes(){

    $.ajax({
        type: 'ajax',
        url: '../Mysql/MostrarClientes',
        async: false,
        dataType: 'json',
        success: function(data){

            var html = '';
            var nombres = '';
            var i;
            var tabla ='';
             var rol = $("#rol").val();
             parseInt(rol);
            if ( rol== 1) {
                 tabla+='<div class=" row row-strippet" ><div class="col-9"><h4 style="color: red; text-align: center;"><strong>Tabla Clientes</strong></h4></div></div>';
            }else{
                 tabla+='<div class=" row row-strippet" ><div class="col-9"><h4 style="color: red; text-align: center;"><strong>Tabla Clientes</strong></h4></div><div class="col-md-2"><button onclick="deleteclientes()" style="margin-bottom:10px;" class="btn btn-danger">Eliminar Registros</button></div></div>';
            }
           

            $('#tabla').html(tabla); 

            nombres+='<th id="tw">Nombre</th>'+
                  '<th id="tw">Primer Apellido</th>'+
                  '<th id="tw">Segundo Apellido</th>'+
                  '<th id="tw">Telefono</th>'+
                  '<th id="tw">Codigo Postal</th>';
                  if (rol== 1) {
                    html +='</tr>';
                  }else{
                   nombres+= '<th id="tw">opciones</th>'+
                  '</tr>';
                  }
                  
                  

                  $('#cabeza').html(nombres); 


            for(i=0; i<data.length; i++){


                if(checkar_nom(data[i].Nombre)=="Correcto" 
                && checkar_ap1(data[i].PrimerApellido)=="Correcto"
                && checkar_ap2(data[i].SegundoApellido)=="Correcto" 
                && check_num(data[i].Telefono)=="Correcto"
                && check_cpTabla(data[i].Cp)=="Correcto"){

 
       
                }else{
                   
                     html +='<tr>'+
                            '<td>'+data[i].Nombre+'</td>'+
                            '<td>'+data[i].PrimerApellido+'</td>'+
                            '<td>'+data[i].SegundoApellido+'</td>'+
                            '<td>'+data[i].Telefono+'</td>'+
                            '<td>'+data[i].Cp+'</td>';
                            if (rol== 1) {
                                html +='</tr>' ;
                            }else{
                               html +='<td>'+
                                '<a href="javascript:;" class=" item-edit" data="'+data[i].id_cliente+'"><img src="../../mysql/img/lapiz.png" width="40" height="40" class="d-inline-block align-top" title="Editar" alt="Imagen editar"></a>'+"&nbsp;&nbsp;&nbsp;"+
                                '<a href="javascript:;" class=" item-delete" data="'+data[i].id_cliente+'"><img src="../../mysql/img/eliminar.png" width="40" height="40" class="d-inline-block align-top" title="Eliminar" alt="Imagen elimimnar"></a>'+"&nbsp;&nbsp;&nbsp;"+
                                
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
    $('#resultado').on('click', '.item-edit', function()
    {
        var id_cliente = $(this).attr('data');
        $('#myModalEditar').modal('show');
        $('#myModalEditar').find('.modal-title').text('Corregir Registro ');
        $('#myModalEditar').find('.modal-header').css('background-color', '#FE2E2E');
        $('#myFormEdit').attr('action', '../Mysql/ActualizarCliente');
        $.ajax({
            type: 'ajax',
            method: 'get',
            url: '../Mysql/Editarcliente',
            data: {id_cliente: id_cliente},
            async: false,
            dataType: 'json',
            success: function(data){

                 $('input[name=telefono]').val(data.Telefono);
                 revisar_telefono()
               if (error_telefono===false) {
                 $('input[name=telefono]').val(data.Telefono).attr('readonly',true);
                }else{
                 $('input[name=telefono]').val(data.Telefono).attr('readonly',false);
                }
           


                $('input[name=nombre]').val(data.Nombre);
                 check_nombre()
               if (error_nombre===false) {
                    $('input[name=nombre]').val(data.Nombre).attr('readonly',true);
                }else{
                   $('input[name=nombre]').val(data.Nombre).attr('readonly',false); 
                }

           
               
                $('input[name=primerapellido]').val(data.PrimerApellido);
                check_primerapellido()
                if (error_primerapellido===false) {
                      $('input[name=primerapellido]').val(data.PrimerApellido).attr('readonly',true);
                }else{
                     $('input[name=primerapellido]').val(data.PrimerApellido).attr('readonly',false);
                }



                $('input[name=segundoapellido]').val(data.SegundoApellido);
                check_segundoapellido()
                if (error_segundoapellido===false) {
                     $('input[name=segundoapellido]').val(data.SegundoApellido).attr('readonly',true);
                }else{
                    $('input[name=segundoapellido]').val(data.SegundoApellido).attr('readonly',false);
                }


               
                $('input[name=cp]').val(data.Cp);
                check_cp()
                if (error_cp===false) {
                    $('input[name=cp]').val(data.Cp).attr('readonly',true);
                }else{
                     $('input[name=cp]').val(data.Cp).attr('readonly',false);
                }



                $('input[name=id_cliente]').val(data.id_cliente);

         
            
            },
            error: function(){
                alert('No se puede editar, el dato');
            }
        });
    });

//Editar el cliente utilizando modal y AJAX
    $('#btnSaveEdit').click(function(){

        var url = $('#myFormEdit').attr('action');
        var data = $('#myFormEdit').serialize();
   
          check_nombre()
          check_primerapellido()
          check_segundoapellido()
          revisar_telefono()
          check_cp()

          
       if (error_telefono === false && error_cp===false  && error_nombre===false && error_primerapellido===false && error_segundoapellido===false )
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
                        $('#myModalEditar').modal('hide');
                      
                        if(response.type=='update'){
                            var type ="Actualizado"
                        }
                        $('.alert-success').html('Registro '+type+' Correctamente').fadeIn().delay(4000).fadeOut('slow');
                        
                        MostrarClientes()
                        NumeroClientes()
                    }else{
                        $('.alert-danger').html('No se realizo ningun cambio').fadeIn().delay(4000).fadeOut('slow');
                        $('#myModalEditar').modal('hide');
                        
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



    //Eliminar cliente
    $('#resultado').on('click', '.item-delete', function(){
        var id_cliente = $(this).attr('data');
        $('#deleteModal').modal('show');
        //prevent previous handler - unbind()
        $('#btnDelete').unbind().click(function(){
            $.ajax({
                type: 'ajax',
                method: 'get',
                async: false,
                url: '../Mysql/DeleteCliente',
                data:{id_cliente:id_cliente},
                dataType: 'json',
                success: function(response){
                    if(response.success){
                        //location.reload("#Tablas");
                        $('#deleteModal').modal('hide');
                        $('.alert-danger').html('Registro Eliminado Correctamente').fadeIn().delay(4000).fadeOut('slow');
                        
                        MostrarClientes()
                        NumeroClientes()
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



// numero de filas de los clientes 

function NumeroClientes(){

        $.ajax({
        type: 'ajax',
        url: '../Mysql/MostrarClientes',
        async: false,
        dataType: 'json',
        success: function(data){
            var i;
             var html='';
            var reset='';
        

           
             var contador=0;
            for(i=0; i<data.length; i++){


                if(checkar_nom(data[i].Nombre)=="Correcto" 
                && checkar_ap1(data[i].PrimerApellido)=="Correcto"
                && checkar_ap2(data[i].SegundoApellido)=="Correcto" 
                && check_num(data[i].Telefono)=="Correcto"
                && check_cpTabla(data[i].Cp)=="Correcto"){



             var parametros = {
                "id_cliente" : data[i].id_cliente,
                "Nombre" : data[i].Nombre,
                "PrimerApellido" : data[i].PrimerApellido,
                "SegundoApellido" : data[i].SegundoApellido,
                "Direccion" : data[i].Direccion,
                "Correo" : data[i].Correo,
                "Telefono" : data[i].Telefono,
                "Cp" : data[i].Cp,
                "sexo" : data[i].sexo
            };


        $.ajax({
                data: parametros, //datos que se envian a traves de ajax
                url:   '../Mysql/SQLClientes/', //archivo que recibe la peticion
                type:  'post', //método de envio
             });
                }else{
                   
                
                    contador = contador+1;
                   

                }
            }


             html+='<h5 style="color: red">'+'Clientes'+' ' +'('+contador+')'+'</h5>';
             
          
          
            if (contador!=0) {
                $("#btnclientes").show();
                $('#numeroclientes').html(html);
                 
            }else{
                 $('#numeroclientes').html(reset);
                 $('#cabeza').html(reset);
                 $('#tabla').html(reset);
                 $("#btnclientes").hide();
            }
        },
       
    });
}

/////////////////////////////////
//Elinima Registros de clientes///
   function deleteclientes(){   

    $('#deleteall').modal('show');

   $('#btnDeleteall').unbind().click(function(){
      $('#deleteall').modal('hide');
    $.ajax({
        type: 'ajax',
        url: '../Mysql/MostrarClientes',
        async: false,
        dataType: 'json',
        success: function(data){
            var i;
            for(i=0; i<data.length; i++){
                if(checkar_nom(data[i].Nombre)=="Correcto" 
                && checkar_ap1(data[i].PrimerApellido)=="Correcto"
                && checkar_ap2(data[i].SegundoApellido)=="Correcto" 
                && check_num(data[i].Telefono)=="Correcto"
                && check_cpTabla(data[i].Cp)=="Correcto"){
                }else{

                  
                    var id = {
                "id_cliente" : data[i].id_cliente
                    };

                      $.ajax({
                             data:id , 
                             url:   '../Mysql/deleteclientes/', 
                             type:  'post', 

                         });

                }

                     
            }
                            var reset="";
                             $('#cabeza').html(reset);
                             $('#tabla').html(reset);
                             $('#resultado').html(reset);
                             $('#numeroclientes').html(reset);
                             $('#btnclientes').html(reset);

                              FilasCompras()
                              FilasVentas()
                              FilasAgenda()
                              FilasProveedores()
                             
                       
        },
    
    });
});
    }









