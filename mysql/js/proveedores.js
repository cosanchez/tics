
 $("#btnproveedores").hide();
var error_proveedor = false
var error_direccionp = false;;
var error_telefonop = false;
var error_cpp = false;




      $("#provee").focusout(function(){check_proveedor();});
     //$("#direccionp").focusout(function(){check_direccionp();});
      $("#telefonop").focusout(function(){check_telefonop();});
       $("#cpp").focusout(function(){check_cpp();});


      function check_proveedor(){
        var pattern = /^[a-zA-Z\s]*$/;
        var status = $("#provee").val();
        if (pattern.test(status) && status !=='') {
        $("#error_mensaje_proveedor").show();
        $("#error_mensaje_proveedor").html("Campo aceptado").css({"font-size": "15px", "color": "#34F458"});
        $("#provee").css("border-bottom","2px solid #34F458");
        return error_proveedor = false;
        } else {
        $("#error_mensaje_proveedor").html("No debe contener numeros ni caracteres especiales").css({"font-size": "14px", "color": "red"});
        $("#error_mensaje_proveedor").show();
        $("#provee").css("border-bottom","2px solid #F90A0A");
        return error_proveedor = true;
        }
      }

/*
      function check_direccionp(){
        var pattern = /^[a-zA-Z\s][#0-9]*$/;
        var status = $("#direccionp").val();
        if (pattern.test(status) && status !=='') {
        $("#error_mensaje_direccionp").show();
        $("#error_mensaje_direccionp").html("Campo aceptado").css({"font-size": "15px", "color": "#34F458"});
        $("#direccionp").css("border-bottom","2px solid #34F458");
        } else {
        $("#error_mensaje_direccionp").html("Dirección no aceptada").css({"font-size": "14px", "color": "red"});
        $("#error_mensaje_direccionp").show();
        $("#direccionp").css("border-bottom","2px solid #F90A0A");
        error_direccionp = true;
        }
      }
*/
function check_telefonop(){
        var pattern = /^[0-9]{10}$/;
        var status = $("#telefonop").val();
        if (pattern.test(status) && status !=='') {
        $("#error_mensaje_telefonop").show();
        $("#error_mensaje_telefonop").html("Campo aceptado").css({"font-size": "15px", "color": "#34F458"});
        $("#telefonop").css("border-bottom","2px solid #34F458");
        return error_telefonop = false;
        } else {
        $("#error_mensaje_telefonop").html("Numero incorrecto").css({"font-size": "14px", "color": "red"});
        $("#error_mensaje_telefonop").show();
        $("#telefonop").css("border-bottom","2px solid #F90A0A");
        return error_telefonop = true;
        }
      }



function check_cpp(){
        var pattern = /^[0-9]{5}$/;
        var status = $("#cpp").val();
        if (pattern.test(status) && status !== '') {
        $("#error_mensaje_cpp").show();
        $("#error_mensaje_cpp").html("Campo aceptado").css({"font-size": "15px", "color": "#34F458"});
        $("#cpp").css("border-bottom","2px solid #34F458");
        return error_cpp = false;
        } else {
        $("#error_mensaje_cpp").html("Solo debe contener 5 Numeros").css({"font-size": "14px", "color": "red"});
        $("#error_mensaje_cpp").show();
        $("#cpp").css("border-bottom","2px solid #F90A0A");
        return error_cpp = true;
        }
      }




      function verifica_nom(campo){
        var pattern = /^[a-zA-ZñÑ\s]*$/;
        var status = campo;
        if (pattern.test(status) && status !== '') {
            return "Correcto"
        }else{
            return "Incorrecto"
        }
      }

      function verifica_tel(campo){
        var pattern = /^[0-9]{10}$/;
        var status = campo;
        if (pattern.test(status) && status !== '') {
            return "Correcto"
        }else{
            return "Incorrecto"
        }
      }

      function verifica_cp(campo){
         var pattern = /^[0-9]{5}$/;
        var status = campo;
        if (pattern.test(status) && status !== '') {
            return "Correcto"
        }else{
            return "Incorrecto"
        }
      }
FilasProveedores()

$('#proveedores').click(function(){

    Proveedores()

    });

function Proveedores(){

    $.ajax({
        type: 'ajax',
        url: '../Mysql/MostrarProveedores',
        async: false,
        dataType: 'json',
        success: function(data){

            var html = '';
            var nombres = '';
            var i;
            var tabla ='';
            var rol = $("#rol").val();
             parseInt(rol);

            tabla+='<h4 style="color: red; text-align: center;"><strong>Tabla Proveedores</strong></h4>';
            $('#tabla').html(tabla); 

            nombres+='<th id="tw">Nombre Proveedor</th>'+
                  '<th id="tw">Dirección</th>'+
                  '<th id="tw">Telefono</th>'+
                  '<th id="tw">Codigo Postal</th>';
                  if (rol== 1) {
                      nombres+='</tr>';
                  }else{
                 nombres+='<th id="tw">opciones</th>'+
                  '</tr>';
                  }
                  

                  $('#cabeza').html(nombres); 


            for(i=0; i<data.length; i++){


                 if(verifica_nom(data[i].nombre)=="Correcto" 
                && verifica_tel(data[i].telefono)=="Correcto"
                && verifica_cp(data[i].cp)=="Correcto"){


       
                }else{

                
                     html +='<tr>'+
                            '<td>'+data[i].nombre+'</td>'+
                            '<td>'+data[i].direccion+'</td>'+
                            '<td>'+data[i].telefono+'</td>'+
                            '<td>'+data[i].cp+'</td>';
                            if (rol==1) {
                                    html += '</tr>' ;
                            }else{
                                html +='<td>'+
                             
                                '<a href="javascript:;" class=" item-edit-proveedores" data="'+data[i].id_proveedor+'"><img src="../../mysql/img/lapiz.png" width="40" height="40" class="d-inline-block align-top" title="Editar" alt="Imagen editar"></a>'+"&nbsp;&nbsp;&nbsp;"+
                                '<a href="javascript:;" class=" item-delete-proveedores" data="'+data[i].id_proveedor+'"><img src="../../mysql/img/eliminar.png" width="40" height="40" class="d-inline-block align-top" title="Eliminar" alt="Imagen elimimnar"></a>'+"&nbsp;&nbsp;&nbsp;"+
                                
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
    $('#resultado').on('click', '.item-edit-proveedores', function()
    {
    	
        var id_proveedor = $(this).attr('data');
        $('#myModalProveedores').modal('show');
        $('#myModalProveedores').find('.modal-title').text('Corregir Registro ');
        $('#myModalProveedores').find('.modal-header').css('background-color', '#FE2E2E');
        $('#myFormProveedores').attr('action', '../Mysql/ActualizarProveedores');
        
        $.ajax({
            type: 'ajax',
            method: 'get',
            url: '../Mysql/EditarProveedor',
            data: {id_proveedor: id_proveedor},
            async: false,
            dataType: 'json',
            success: function(data){
                

            
                $('input[name=proveedor]').val(data.nombre);
                 check_proveedor()

                 if (error_proveedor===false) {
                    $('input[name=proveedor]').val(data.nombre).attr('readonly',true);
                }else{
                   $('input[name=proveedor]').val(data.nombre).attr('readonly',false); 
                }

                $('input[name=direccion]').val(data.direccion);
                $('input[name=telefono]').val(data.telefono);
                  check_telefonop()
                  if (error_telefonop===false) {
                    $('input[name=telefono]').val(data.telefono).attr('readonly',true);
                }else{
                   $('input[name=telefono]').val(data.telefono).attr('readonly',false); 
                }
                $('input[name=cp]').val(data.cp);
                    check_cpp()

                    if (error_cpp===false) {
                    $('input[name=cp]').val(data.cp).attr('readonly',true);
                }else{
                   $('input[name=cp]').val(data.cp).attr('readonly',false); 
                }



                $('input[name=id_proveedor]').val(data.id_proveedor);

         // check_direccionp()
      
      
            
            },
            error: function(){
                alert('No se puede editar, el dato');
            }
        });

       
    });



    //Editar el cliente utilizando modal y AJAX
    $('#btnSaveProveedores').click(function(){
       
        var url = $('#myFormProveedores').attr('action');
        var data = $('#myFormProveedores').serialize();
          check_proveedor()
         // check_direccionp()
          check_telefonop()
          check_cpp()
        
        if (error_proveedor === false && error_telefonop === false && error_cpp === false)
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
                        $('#myModalProveedores').modal('hide');
                      
                        if(response.type=='update'){
                            var type ="Actualizado"
                        }
                        $('.alert-success').html('Registro '+type+' Correctamente').fadeIn().delay(4000).fadeOut('slow');
                        Proveedores()
                        FilasProveedores()
                    }else{
                        $('.alert-danger').html('No se realizo ningun cambio').fadeIn().delay(4000).fadeOut('slow');
                        $('#myModalProveedores').modal('hide');
                        
                    }
                },
                error: function(){
                    alert('No se pudo realizar los cambios');
                }
            });
        }else{
            alert("Campo Incorrecto");
        }
       
        
    });

   //Eliminar registro de agenda
    $('#resultado').on('click', '.item-delete-proveedores', function(){
        var id_proveedor = $(this).attr('data');
        $('#deleteModal').modal('show');
        //prevent previous handler - unbind()
        $('#btnDelete').unbind().click(function(){
            $.ajax({
                type: 'ajax',
                method: 'get',
                async: false,
                url: '../Mysql/DeleteProveedores',
                data:{id_proveedor:id_proveedor},
                dataType: 'json',
                success: function(response){
                    if(response.success){
                        //location.reload("#Tablas");
                        $('#deleteModal').modal('hide');
                        $('.alert-danger').html('Registro Eliminado Correctamente').fadeIn().delay(4000).fadeOut('slow');
                        Proveedores()
                        FilasProveedores()
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

function FilasProveedores(){

         $.ajax({
        type: 'ajax',
        url: '../Mysql/MostrarProveedores',
        async: false,
        dataType: 'json',
        success: function(data){
            var i;
             var html='';
            var reset='';

           
             var contador=0;
            for(i=0; i<data.length; i++){

                if(verifica_nom(data[i].nombre)=="Correcto" 
                && verifica_tel(data[i].telefono)=="Correcto"
                && verifica_cp(data[i].cp)=="Correcto"){

                        
                var parametros = {
                "id_proveedor" : data[i].id_proveedor,
                "nombre" : data[i].nombre,
                "direccion" : data[i].direccion, 
                "telefono" : data[i].telefono,
                "cp" : data[i].cp
                    };


        $.ajax({
                data: parametros, //datos que se envian a traves de ajax
                url:   '../Mysql/SQLProveedor/', //archivo que recibe la peticion
                type:  'post', //método de envio
             });
                
                }else{
                   
                
                    contador = contador+1;
                   

                }
            }


        html+='<h5 style="color: red">'+'Proveedores'+' ' +'('+contador+')'+'</h5>';
          
          
          
            if (contador!=0) {
                 $("#btnproveedores").show();
                $('#numeroproveedores').html(html);


                
            }else{
                 $('#numeroproveedores').html(reset);
                 $('#cabeza').html(reset);
                 $('#tabla').html(reset);
                  $("#btnproveedores").hide();
            }
        },
       
    });
}


