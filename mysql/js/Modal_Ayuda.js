$( document ).ready(function(){

    $('#ayuda').click(function(){
        $('#myModal').modal('show');
        $('#myModal').find('.modal-title').text('Centro de Ayuda').css('color','white');
        $('#myModal').find('.modal-header').css('background-color', '#0066b2');
        
    });


});