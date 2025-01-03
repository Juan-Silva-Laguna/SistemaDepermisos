$(document).ready(function(){   

    mostrar();
    $(document).on('click', '#btnGuardar', function (event) {
        event.preventDefault();
        if ($('#nombre').val() != ''|| $('#usuario').val() != '' || $('#password').val() != '') {
            const datos = {
                nombre: $('#nombre').val(), 
                correo: $('#correo').val(),
                celular: $('#celular').val(), 
                usuario: $('#usuario').val(),
                password: $('#password').val(),
                operacion: 'guardar'
            };
    
            $.post('../Controlador/usuarios.controlador.php', datos, function (respuesta) {
                alert(respuesta);
                mostrar();
                limpiar();
                $('html, body').animate({scrollTop: 500}, 1000);
            })
        }else{
            alert("Verifique que todos los campos esten llenos");
        }
    });
    
    $(document).on('click', '.editaUsuario', function (event) {
        event.preventDefault();
        $.post('../Controlador/usuarios.controlador.php', {id: $(this).attr('id'), operacion: 'mostrarEditar'}, function (respuesta) {
            console.log(respuesta);
            $.each(JSON.parse(respuesta), function(index, val) {
                $('#idUser').val(val.idUsuario); 
                $('#nombre').val(val.nombre); 
                $('#usuario').val(val.usuario); 
                $('#correo').val(val.correo);
                $('#celular').val(val.celular);
                $('#password').val('Privada por seguridad');

                $('html, body').animate({scrollTop: 0}, 1000);
                
            });  
        })
    });


    $(document).on('click', '#btnBuscar', function (event) {
        event.preventDefault();
            const datos = {
                nombre: $('#nombre').val(), 
                correo: $('#correo').val(),
                celular: $('#celular').val(), 
                usuario: $('#usuario').val(),
                operacion: 'buscar'
            };
    
            $.post('../Controlador/usuarios.controlador.php', datos, function (respuesta) {
                var table = null;                 
                $.each(JSON.parse(respuesta), function(index, val) {
                    table += '<tr class="editaUsuario" id='+val.idUsuario+'>';
                    table += '<td>'+val.nombre+'</td>';
                    table += '<td>'+val.usuario+'</td>';
                    table += '<td>'+val.celular+'</td>';
                    table += '<td>'+val.correo+'</td>';
                    table += '</tr>';
                });            
                $('#cuerpoTabla').html(table);
            })
            $('html, body').animate({scrollTop: 500}, 1000);
    });

    $(document).on('click', '#btnActualizar', function (event) {
        event.preventDefault();
        if ($('#idUser').val()!='') {
            const datos = {
                id: $('#idUser').val(),
                nombre: $('#nombre').val(), 
                correo: $('#correo').val(),
                celular: $('#celular').val(), 
                usuario: $('#usuario').val(),
                password: $('#password').val(),
                operacion: 'actualizar'
            };
    
            $.post('../Controlador/usuarios.controlador.php', datos, function (respuesta) {
                alert(respuesta);
                mostrar();
                limpiar();
                $('html, body').animate({scrollTop: 500}, 1000);
            })            
        }
        else{
            alert("Por favor seleccione algun usuario de la tabla para eliminar");
        } 
    });

    $(document).on('click', '#btnEliminar', function (event) {
        event.preventDefault();
        if ($('#idUser').val()!='') {
            if (confirm('Esta seguro de eliminar este usuario?')) {
                $.post('../Controlador/usuarios.controlador.php', {id: $('#idUser').val(), operacion: 'eliminar'}, function (respuesta) {
                    alert(respuesta);
                })
            }            
        }else{
            alert("Por favor seleccione algun usuario de la tabla para eliminar");
        } 
        limpiar();
    });    
      
    function mostrar(){
        $.post('../Controlador/usuarios.controlador.php', {operacion: 'mostrar'}, function (respuesta) {
            var table = null;                 
            $.each(JSON.parse(respuesta), function(index, val) {
                table += '<tr class="editaUsuario" id='+val.idUsuario+'>';
                table += '<td>'+val.nombre+'</td>';
                table += '<td>'+val.usuario+'</td>';
                table += '<td>'+val.celular+'</td>';
                table += '<td>'+val.correo+'</td>';
                table += '</tr>';
            });
            
            $('#cuerpoTabla').html(table);	
        })        
    }

    function limpiar() {
        $('#idUser').val(''); 
        $('#nombre').val(''); 
        $('#correo').val('');
        $('#celular').val(''); 
        $('#usuario').val('');
        $('#password').val('');
    }
      
});
