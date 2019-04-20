
$( document ).ready(function(){

$('#register-submit').click(function(){
    $('#register-form').attr('action', 'index.php/welcome/registrar');
        var url = $('#register-form').attr('action');
        var data = $('#register-form').serialize();

            $.ajax({
                type: 'ajax',
                method: 'post',
                url: url,
                data: data,
                async: false,
                dataType: 'json',
                success: function(response){
                    if(response.success){
                        $('#register-form')[0].reset();
                        if(response.type=='add'){
                            var type = 'agregado'
                        }
                        $('.alert-success').html('Usuario '+type+' Correctamente').fadeIn().delay(3000).fadeOut('slow');
                       
                    }else{

                       $('.alert-danger').html('Error al Registrar Verifique los Campos').fadeIn().delay(3000).fadeOut('slow');
                    }
                },
                error: function(){
                    $('.alert-danger').html('Ocurrido un Error').fadeIn().delay(3000).fadeOut('slow');
                }
            });
    });
    });