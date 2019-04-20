
     $("#btnmarca").hide();
filaMarca()
$('#Marca').click(function(){
    $('#cabeza').show();
    mostrarMarca()
    });


 function checkar_excel_nom(campo){
        var pattern = /^[a-zA-ZñÑ\s]*$/;
        var status = campo;
        if (pattern.test(status) && status !== '') {
            return "Correcto"
        }else{
            return "Incorrecto"
        }
      }


function mostrarMarca(){
 $.ajax({
            type: 'ajax',
            url: '../Excel/mostrarMarca',
            async: false,
            dataType: 'json',
            success: function(data){

                var html = '';
                var nombres = '';
                var i;
                var rol = parseInt($("#rol").val());
                nombres+='<th id="tw">Nombre</th>';
                    if (rol==1) {
                        nombres+='</tr>';
                    }else{
                        nombres+='<th id="tw">Opciones</th>'+
                      '</tr>';
                    }
                      

                    $('#cabeza').html(nombres); 
                for(i=0; i<data.length; i++){

                if(checkar_excel_nom(data[i].Nombre)=="Correcto"){ 
                
                } else{
                         html +='<tr>'+
                                 '<td>'+data[i].Nombre+'</td>';
                                 if (rol==1) {
                                      html +='</tr>';
                                 }else{
                                     html +='<td>'+
                                    '<a href="javascript:;" class=" item-edit-Marca" data="'+data[i].id_marca+'"><img src="../../mysql/img/lapiz.png" width="40" height="40" class="d-inline-block align-top" title="Editar" alt="Imagen editar"></a>'+"&nbsp;&nbsp;&nbsp;"+
                                    '<a href="javascript:;" class=" item-delete-Marca" data="'+data[i].id_marca+'"><img src="../../mysql/img/eliminar.png" width="40" height="40" class="d-inline-block align-top" title="Eliminar" alt="Imagen elimimnar"></a>'+"&nbsp;&nbsp;&nbsp;"+
                                    
                                '</td>'+
                            '</tr>';
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
$('#resultado').on('click', '.item-edit-Marca', function(){
        var id_marca= $(this).attr('data');
        $('#myModalMarca').modal('show');
        $('#myModalMarca').find('.modal-title').text('Corregir Registro ');
        $('#myModalMarca').find('.modal-header').css('background-color', '#FE2E2E');
        $('#myFormMarca').attr('action', '../Excel/ActualizarMarca');

        $.ajax({
            type: 'ajax',
            method: 'get',
            url: '../Excel/EditarMarca',
            data: {id_marca: id_marca},
            async: false,
            dataType: 'json',
            success: function(data){
                
                
                $('input[name=Nombre]').val(data[0].Nombre);
                $('input[name=id_marca]').val(data[0].id_marca);
            
            },
            
        });
    });


//Editar el cliente utilizando modal y AJAX
    $('#btnSaveMarca').click(function(){
        var url = $('#myFormMarca').attr('action');
        var data = $('#myFormMarca').serialize();

        var id_marca =$('input[name=id_marca]');
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
                        $('#myModalMarca').modal('hide');
                      
                        if(response.type=='update'){
                            var type ="Actualizado"
                        }
                        $('.alert-success').html('Registro '+type+' Correctamente').fadeIn().delay(4000).fadeOut('slow');
                        filaMarca()
                        mostrarMarca()
                    }else{
                        $('.alert-danger').html('No se realizo ningun cambio').fadeIn().delay(4000).fadeOut('slow');
                        $('#myModalMarca').modal('hide');
                        
                    }
                },
                error: function(){
                    alert('No se pudo realizar los cambios');
                }
            });
       
    });
      //Eliminar registro de agenda
    $('#resultado').on('click', '.item-delete-Marca', function(){
        var id_marca = $(this).attr('data');
        $('#deleteModal').modal('show');
        //prevent previous handler - unbind()
        $('#btnDelete').unbind().click(function(){
            $.ajax({
                type: 'ajax',
                method: 'get',
                async: false,
                url: '../Excel/DeleteMarca',
                data:{id_marca:id_marca},
                dataType: 'json',
                success: function(response){
                    if(response.success){
                        //location.reload("#Tablas");
                        $('#deleteModal').modal('hide');
                        $('.alert-danger').html('Registro Eliminado Correctamente').fadeIn().delay(4000).fadeOut('slow');
                        filaMarca()
                        mostrarMarca()
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


function filaMarca(){
$.ajax({
        type: 'ajax',
        url: '../Excel/mostrarMarca',
        async: false,
        dataType: 'json',
        success: function(data){
            var html='';
            var reset='';
            var j=0;
           for (var i=0; i<data.length; i++) {
            if(checkar_excel_nom(data[i].Nombre)==("Correcto")){
                 var parametros = {
                "valor1" : data[i].id_marca,
                "valor2" : data[i].Nombre
            };
        $.ajax({
                data: parametros, //datos que se envian a traves de ajax
                url:   '../Excel/insertMarcaSQL/', //archivo que recibe la peticion
                type:  'post', //método de envio
        });
            }else{
                j=j+1;
            }
           }
           

             html+='<h5 style="color: red">'+'Marca'+' ' +'('+j+')'+'</h5>';  
            
      


             if (j!=0) {
                $("#btnmarca").show();
                $('#numeroMarca').html(html);


                
            }else{
                 $('#numeroMarca').html(reset);
                 $('#cabeza').html(reset);
                 $("#cabeza").hide();
                 $('#tabla').html(reset);
                 $("#btnmarca").hide();
               
            }



        },
        error: function(){
            alert('Could not get Data from Database');
        }
    });
}


