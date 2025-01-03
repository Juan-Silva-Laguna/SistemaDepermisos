$(document).ready(function(){   

    $(document).on('click', '#ingresar', function (event) {
        event.preventDefault();
        const datos = {
            user: $('#user').val(),
            pass: $('#pass').val(), 
            operacion: 'ingresar'
        };
        $.post('../Controlador/usuarios.controlador.php', datos, function (respuesta) {
            let datos = JSON.parse(respuesta);
            if (datos[0] == 1) {
                alert(datos[1]);
                window.location.href = "index.php";
            }else{
                alert(datos[1]);
            } 
        })
      });
      
    

});
