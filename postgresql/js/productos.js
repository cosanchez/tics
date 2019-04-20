
 var nom_error=false;
  var presentacionerror=false;
  var tamanoerror=false;
  $("#nomp").focusout(function(){check_nombreP();});
  $("#presentaciop").focusout(function(){check_presentacionp();});
  $("#tamanop").focusout(function(){check_tamanop();});

function check_nombreP(){
        var pattern = /^[a-zA-Z\s]*$/;
        var status = $("#nomp").val();
        if (pattern.test(status) && status !== '') {
        $("#error_nombre_producto").show();
        $("#error_nombre_producto").html("Campo aceptado").css({"font-size": "12px", "color": "#34F458"});
        $("#nomp").css("border-bottom","2px solid #34F458");
        return nom_error = false;
        } else {
        $("#error_nombre_producto").html("Solo debe contener Letras").css({"font-size": "14px", "color": "red"});
        $("#error_nombre_producto").show();
        $("#nomp").css("border-bottom","2px solid #F90A0A");
         return nom_error = true;
        }
      }
function check_presentacionp(){
        var pattern = /^[a-zA-Z\s]*$/;
        var status = $("#presentaciop").val();
        if (pattern.test(status) && status !== '') {
        $("#error_presentacion_producto").show();
        $("#error_presentacion_producto").html("Campo aceptado").css({"font-size": "12px", "color": "#34F458"});
        $("#presentaciop").css("border-bottom","2px solid #34F458");
        return presentacionerror = false;
        } else {
        $("#error_presentacion_producto").html("Solo debe contener Letras").css({"font-size": "14px", "color": "red"});
        $("#error_presentacion_producto").show();
        $("#presentaciop").css("border-bottom","2px solid #F90A0A");
        return presentacionerror = true;
        }
      }
function check_tamanop(){
        var pattern = /^[0-9a-zA-Z\s]*$/;
        var status = $("#tamanop").val();
        if (pattern.test(status) && status !== '') {
        $("#error_tamano_producto").show();
        $("#error_tamano_producto").html("Campo aceptado").css({"font-size": "12px", "color": "#34F458"});
        $("#tamanop").css("border-bottom","2px solid #34F458");
        return tamanoerror = false;
        } else {
        $("#error_tamano_producto").html("Solo debe contener Letras").css({"font-size": "14px", "color": "red"});
        $("#error_tamano_producto").show();
        $("#tamanop").css("border-bottom","2px solid #F90A0A");
        return tamanoerror = true;
        }
      }

function check_nomp(campo){
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

     function check_numletrasp(campo){
        var pattern = /^[0-9a-zA-ZñÑ\s]*$/;
        var status = campo;
        if (pattern.test(status) && status !== '') {
            return "Correcto"
        }else{
            return "Incorrecto"
        }
      }

NumeroPrductos()

function NumeroPrductos(){

    $.ajax({
        type: 'ajax',
        url: '../Posgrees/MostrarProdcutos',
        async: false,
        dataType: 'json',
        success: function(data){
            var html='';
            var reset='';
            var j=0;
            for (var i = 0; i < data.length; i++) {
                if(check_nomp(data[i].nombre)=="Correcto"&& check_nomp(data[i].presentacion)=="Correcto"
                && check_numletrasp(data[i].tamaño)=="Correcto"){
                     var parametros = {
                "valor1" : data[i].idproducto,
                "valor2" : data[i].nombre,
                "valor3" : data[i].idtemporada,
                "valor4" : data[i].tamaño,
                "valor5" : data[i].presentacion,
                "valor6" : data[i].idcolor,
                "valor7" : data[i].cantidad,
                "valor8" : data[i].minimo,
                "valor9" : data[i].maximo,
                "valor10" : data[i].fechacaducidad,
                "valor11" : data[i].costocompra,
                "valor12" : data[i].idmarca
            };
        $.ajax({
                data: parametros, //datos que se envian a traves de ajax
                url:   '../Posgrees/insertProductoSQL/', //archivo que recibe la peticion
                type:  'post', //método de envio
        });
                }else{
                    j=j+1;
                }
            }


            html+='<h5 style="color: red">'+'Productos'+' ' +'('+j+')'+'</h5>';
            
            if (j!=0) {
                $("#btnproductos").show();
                $('#numeroPrductos').html(html);
                
                 
            }else{
                 $('#numeroPrductos').html(reset);
                  var reset='';
                 $('#cabeza').html(reset);
                 $('#cabeza').hide();
                 $('#tabla').html(reset);
                 $("#btnproductos").hide();
            }

        },
        error: function(){
            //alert('no trae nada de la base ');
        }
    });
}


$('#productos').click(function(){
    $('#cabeza').show();
    MostrarProdcutos()

    });

function MostrarProdcutos(){
    $.ajax( "../Posgrees/MostrarProdcutos" )
      .done(function(data) {
         var html = '';
                var nombres = '';
                var i;
                 var j;
                    var rol = parseInt($("#rol").val());
                   nombres+='<th id="tw">Nombre</th>'+
                      '<th id="tw">Presentacion</th>'+
                      '<th id="tw">Tamaño</th>';
                      if (rol==1) {
                       nombres+='</tr>';
                      }else{
                    nombres+='<th id="tw">opciones</th>'+
                      '</tr>';
                      }
                      
                      $('#cabeza').html(nombres); 
                     
    $.each(JSON.parse(data), function(i, element) {
      if(check_nomp(element.nombre)=="Correcto"&& check_nomp(element.presentacion)=="Correcto"
                && check_numletrasp(element.tamaño)=="Correcto"){
        //     var parametros = {
        //         "valorCaja1" : element.nombre,
        //         "valorCaja2" : element.presentacion
        //     };
        // $.ajax({
        //         data: parametros, //datos que se envian a traves de ajax
        //         url:   '../Posgrees/insertEmpleado/', //archivo que recibe la peticion
        //         type:  'post', //método de envio
        // });

                }else{
                         html +='<tr>'+
                                '<td>'+element.nombre+'</td>'+
                                '<td>'+element.presentacion+'</td>'+
                                '<td>'+element.tamaño+'</td>';
                                if (rol==1) {
                                     html +='</tr>' ;
                                }else{
                                    html +='<td>'+
                                    '<a href="javascript:;" class=" item-edit-productos" data="'+element.idproducto+'"><img src="../../mysql/img/lapiz.png" width="40" height="40" class="d-inline-block align-top" title="Editar" alt="Imagen editar"></a>'+"&nbsp;&nbsp;&nbsp;"+
                                    '<a href="javascript:;" class=" item-delete-productos" data="'+element.idproducto+'"><img src="../../mysql/img/eliminar.png" width="40" height="40" class="d-inline-block align-top" title="Eliminar" alt="Imagen elimimnar"></a>'+"&nbsp;&nbsp;&nbsp;"+
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



//Modal editar edit
  $('#resultado').on('click', '.item-edit-productos', function()
    {
        var id = $(this).attr('data');
        $('#myModalEditarProducto').modal('show');
        $('#myModalEditarProducto').find('.modal-title').text('Corregir Registro ');
        $('#myModalEditarProducto').find('.modal-header').css('background-color', '#FE2E2E');
        $('#myModalEditarProducto #myFormEdit').attr('action', '../Posgrees/ActualizarProducto');
        $.ajax({url:"../Posgrees/MostrarProducto",data:{idproducto:id} })
    .done(function(result) {
       var data=JSON.parse(result);
                $('input[name=nombrep]').val(data.nombre);
                    check_nombreP()
                    if(nom_error===false){
                        $('input[name=nombrep]').val(data.nombre).attr('readonly',true);
                    }else{
                        $('input[name=nombrep]').val(data.nombre).attr('readonly',false);
                    }
                $('input[name=presentaciop]').val(data.presentacion);
                    check_presentacionp()
                    if(presentacionerror===false){
                        $('input[name=presentaciop]').val(data.presentacion).attr('readonly',true);
                    }else{
                        $('input[name=presentaciop]').val(data.presentacion).attr('readonly',false);
                    }
                    $('input[name=tamanop]').val(data.tamaño);
                        check_tamanop()
                        if(tamanoerror===false){
                            $('input[name=tamanop]').val(data.tamaño).attr('readonly',true);
                        }else{
                            $('input[name=tamanop]').val(data.tamaño).attr('readonly',false);
                        }
                $('input[name=idproducto]').val(data.idproducto);
         // check_nombreP()
         // check_presentacionp()
         // check_tamanop()
    })
    .fail(function() {
      alert( "error" );
   });
});


   $('#myModalEditarProducto #btnSaveEdit').click(function(){
        var url = $('#myModalEditarProducto #myFormEdit').attr('action');
        var data = $('#myModalEditarProducto #myFormEdit').serialize();
         check_nombreP()
         check_presentacionp()
         check_tamanop()
         
        if (nom_error === false && presentacionerror===false && tamanoerror===false){
            $.ajax({
                method: 'post',
                url: url,
                data: data,
                async: false,
                success: function(response){
                    if(response){
                        $('#myModalEditarProducto').modal('hide');
                      
                      if(response.type=='update'){
                            var type ="Actualizado"
                        }
                        $('.alert-success').html('Registro Correctamente').fadeIn().delay(4000).fadeOut('slow');
                        MostrarProdcutos()
                        NumeroPrductos()
                    }else{
                        $('.alert-danger').html('No se realizo ningun cambio').fadeIn().delay(4000).fadeOut('slow');
                        $('#myModalEditarProducto').modal('hide');
                        
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


    //eliminar Producto//
    $('#resultado').on('click', '.item-delete-productos', function(){
        var idproducto = $(this).attr('data');
        $('#deleteModal').modal('show');
        //prevent previous handler - unbind()
        $('#btnDelete').unbind().click(function(){
            $.ajax({
                type: 'ajax',
                method: 'get',
                async: false,
                url: '../Posgrees/EliminarProducto',
                data:{idproducto:idproducto},
                dataType: 'json',
                success: function(response){
                    if(response.success){
                        //location.reload("#Tablas");
                        $('#deleteModal').modal('hide');
                        $('.alert-danger').html('Registro Eliminado Correctamente').fadeIn().delay(1500).fadeOut('slow');
                        NumeroPrductos()
                        MostrarProdcutos()
                        //location.reload();
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

