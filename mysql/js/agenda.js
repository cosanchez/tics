


        $("#btnagenda").hide();
         var error_status = false;
         var error_sv = false;
         var error_fc=false;
      $("#state").focusout(function(){check_stt();});
      $("#sv").focusout(function(){check_sv();});
      $("#fc").focusout(function(){check_fc();});

      function check_fc(){
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



      function check_stt(){

        var st = $("#state").val();
        if (st === 'pendiente' || st==='cancelado' || st==='realizado') {
        $("#error_mensaje_status").show();
        $("#error_mensaje_status").html("Campo aceptado").css({"font-size": "12px", "color": "#34F458"});
        $("#state").css("border-bottom","2px solid #34F458");
        return error_status = false;
        } else {
        $("#error_mensaje_status").html("Solo debe contener 9 caracteres").css({"font-size": "14px", "color": "red"});
        $("#error_mensaje_status").show();
        $("#state").css("border-bottom","2px solid #F90A0A");
        return error_status = true;
        }
      }

function check_sv(){
        var pattern = /^[a-zA-ZñÑ\s]*$/;
        var status = $("#sv").val();
        if (pattern.test(status) && status !== '') {
        
        $("#error_mensaje_servicio").show();
        $("#error_mensaje_servicio").html("Campo aceptado").css({"font-size": "12px", "color": "#34F458"});
        $("#sv").css("border-bottom","2px solid #34F458");
        return error_sv = false;

        } else {
        $("#error_mensaje_servicio").html("Solo se aceptan letras").css({"font-size": "14px", "color": "red"});
        $("#error_mensaje_servicio").show();
        $("#sv").css("border-bottom","2px solid #F90A0A");
        return error_sv = true;
    
        }
      }

     

FilasAgenda()


   $('#agenda').click(function(){

    Agenda()

    });


 

 
   



function Agenda(){

  


    $.ajax({
        type: 'ajax',
        url: '../Mysql/MostrarAgenda',
        async: false,
        dataType: 'json',
        success: function(data){
            var valor = parseInt($("#rol").val());
            var html = '';
            var nombres = '';
            var i;
            var tabla ='';

            tabla+='<h4 style="color: red; text-align: center;"><strong>Tabla Agenda</strong></h4>';
            $('#tabla').html(tabla); 

            if (valor==1) {
                 nombres+='<th id="tw">Nombre Cliente</th>'+
                  '<th id="tw">Nombre Empleado</th>'+
                  '<th id="tw">Servicio</th>'+
                  '<th id="tw">Status</th>'+
                   '<th id="tw">Fecha</th>'+
                  '<th id="tw"></th>'+
                  '</tr>';

                  $('#cabeza').html(nombres); 
            }else{
               nombres+='<th id="tw">Nombre Cliente</th>'+
                  '<th id="tw">Nombre Empleado</th>'+
                  '<th id="tw">Servicio</th>'+
                  '<th id="tw">Status</th>'+
                   '<th id="tw">Fecha</th>'+
                  '<th id="tw">opciones</th>'+
                  '</tr>';

                  $('#cabeza').html(nombres);   
            }
           


            for(i=0; i<data.length; i++){

                 if(data[i].Status=="realizado" || data[i].Status=='pendiente' || data[i].Status=='cancelado'){
                 
                 

                
        
                }else{
                     

                     if (valor==1) {
                         html +='<tr>'+
                            '<td>'+data[i].Nombre+' '+data[i].PrimerApellido+'</td>'+
                            '<td>'+data[i].nombre_E+' '+data[i].PrimerApellido_E+'</td>'+
                            '<td>'+data[i].nombre+'</td>'+
                            '<td>'+data[i].Status+'</td>'+ 
                            '<td>'+data[i].Fecha+'</td>'+                            
                            '<td>'+
                        '</tr>' ;
                     }else{
                    html +='<tr>'+
                            '<td>'+data[i].Nombre+' '+data[i].PrimerApellido+'</td>'+
                            '<td>'+data[i].nombre_E+' '+data[i].PrimerApellido_E+'</td>'+
                            '<td>'+data[i].nombre+'</td>'+
                            '<td>'+data[i].Status+'</td>'+ 
                            '<td>'+data[i].Fecha+'</td>'+                            
                            '<td>'+
                            
                                '<a href="javascript:;" class=" item-edit-agenda" data="'+data[i].id_Agenda+'"><img src="../../mysql/img/lapiz.png" width="40" height="40" class="d-inline-block align-top" title="Editar" alt="Imagen editar"></a>'+"&nbsp;&nbsp;&nbsp;"+
                                '<a href="javascript:;" class=" item-delete-agenda" data="'+data[i].id_Agenda+'"><img src="../../mysql/img/eliminar.png" width="40" height="40" class="d-inline-block align-top" title="Eliminar" alt="Imagen elimimnar"></a>'+"&nbsp;&nbsp;&nbsp;"+
                                
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
    $('#resultado').on('click', '.item-edit-agenda', function()
    {
        var id_agenda = $(this).attr('data');
        $('#myModalAgenda').modal('show');
        $('#myModalAgenda').find('.modal-title').text('Corregir Registro ');
        $('#myModalAgenda').find('.modal-header').css('background-color', '#FE2E2E');
        $('#myFormAgenda').attr('action', '../Mysql/ActualizarAgenda');
        $.ajax({
            type: 'ajax',
            method: 'get',
            url: '../Mysql/EditarAgenda',
            data: {id_agenda: id_agenda},
            async: false,
            dataType: 'json',
            success: function(data){
                

            
                $('input[name=nombre_cliente]').val(data.Nombre+' ' +data.PrimerApellido);
                $('input[name=nombre_empleado]').val(data.nombre_E+' '+data.PrimerApellido_E);
                $('input[name=servicio]').val(data.nombre);
                check_sv()
                if (error_sv===false) {
                      $('input[name=servicio]').val(data.nombre).attr('readonly',true);
                }else{
                     $('input[name=servicio]').val(data.nombre).attr('readonly',false);
                }

                $('input[name=status]').val(data.Status);
                check_stt()
                if (error_status===false) {
                      $('input[name=status]').val(data.Status).attr('readonly',true);
                }else{
                     $('input[name=status]').val(data.Status).attr('readonly',false);
                }
                $('input[name=fc]').val(data.Fecha);
                check_fc()
                if (error_fc===false) {
                      $('input[name=fc]').val(data.Fecha).attr('readonly',true);
                }else{
                     $('input[name=fc]').val(data.Fecha).attr('readonly',false);
                }
                $('input[name=id_agenda]').val(data.id_agenda);
                $('input[name=id_servicio]').val(data.id_servicio);
                
             
                
            
            },
            error: function(){
                alert('No se puede editar, el dato');
            }
        });
    });


//Editar el cliente utilizando modal y AJAX
    $('#btnSaveAgenda').click(function(){
        var url = $('#myFormAgenda').attr('action');
        var data = $('#myFormAgenda').serialize();

          check_stt()
         check_sv()
          check_fc()

    
        if (error_status === false && error_sv === false && error_fc===false)
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
                        $('#myModalAgenda').modal('hide');
                      
                        if(response.type=='update'){
                            var type ="Actualizado"
                        }
                        $('.alert-success').html('Registro '+type+' Correctamente').fadeIn().delay(4000).fadeOut('slow');
                        Agenda()
                        FilasAgenda()
                    }else{
                        $('.alert-danger').html('No se realizo ningun cambio').fadeIn().delay(4000).fadeOut('slow');
                        $('#myModalAgenda').modal('hide');
                        
                    }
                },
                error: function(){
                    alert('No se pudo realizar los cambios');
                }
            });
        }else{
            alert("Campos Incorrectos");
        }
       
        
    });


      //Eliminar registro de agenda
    $('#resultado').on('click', '.item-delete-agenda', function(){
        var id_agenda = $(this).attr('data');
        $('#deleteModal').modal('show');
        //prevent previous handler - unbind()
        $('#btnDelete').unbind().click(function(){
            $.ajax({
                type: 'ajax',
                method: 'get',
                async: false,
                url: '../Mysql/DeleteAgenda',
                data:{id_agenda:id_agenda},
                dataType: 'json',
                success: function(response){
                    if(response.success){
                        //location.reload("#Tablas");
                        $('#deleteModal').modal('hide');
                        $('.alert-danger').html('Registro Eliminado Correctamente').fadeIn().delay(4000).fadeOut('slow');
                        Agenda()
                        FilasAgenda()
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

function FilasAgenda(){



        $.ajax({
        type: 'ajax',
        url: '../Mysql/MostrarAgenda',
        async: false,
        dataType: 'json',
        success: function(data){
            var i;
             var html='';
            var reset='';

           
             var contador=0;
            for(i=0; i<data.length; i++){

                if(data[i].Status=="realizado" || data[i].Status=='pendiente' || data[i].Status=='cancelado'){


            var parametros = {
                "id_Agenda" : data[i].id_Agenda,
                "id_cliente" : data[i].id_cliente,
                "id_empleado" : data[i].id_empleado,
                "id_servicio" : data[i].id_servicio,
                "Status" : data[i].Status,
                "Hora" : data[i].Hora,
                "Fecha" : data[i].Fecha
            };


        $.ajax({
                data: parametros, //datos que se envian a traves de ajax
                url:   '../Mysql/SQLAgenda/', //archivo que recibe la peticion
                type:  'post', //método de envio
             });
                }else{
                   
                
                    contador = contador+1;
                     

                }
            }


             html+='<h5 style="color: red">'+'Agenda'+' ' +'('+contador+')'+'</h5>';
          
          
            if (contador!=0) {
                $("#btnagenda").show();
                $('#numeroagenda').html(html);


                
            }else{
                 $('#numeroagenda').html(reset);
                 $('#cabeza').html(reset);
                 $('#tabla').html(reset);
                 $("#btnagenda").hide();
               
            }
        },
       
    });


}


