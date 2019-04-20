$( document ).ready(function(){

$('#register-submit').click(function(){
    $('#login-form').attr('action', 'index.php/welcome/validar');
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

                        $('#register-form')[0].reset();
                    }
                },
                error: function(){
                    alert('Ocurrio Un Error de Registro');
                }
            });
    });
    });