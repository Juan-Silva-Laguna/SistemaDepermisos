$(document).ready(function(){   

    mostrar();

    $.post('../Controlador/rol.controlador.php', {operacion: 'mostrar'}, function (respuesta) {
        let datos = JSON.parse(respuesta);
        datos.forEach(dato => {
            option = document.createElement("option");
            option.value = dato.descripcion;  
            option.setAttribute('data-index-number',dato.idRol);
            document.getElementById('roles').append(option); 
        });
    })

    $.post('../Controlador/usuarios.controlador.php', {operacion: 'mostrar'}, function (respuesta) {
        let datos = JSON.parse(respuesta);
        datos.forEach(dato => {
            option = document.createElement("option");
            option.value = dato.usuario;  
            option.setAttribute('data-index-number',dato.idUsuario);
            document.getElementById('usuarios').append(option); 
        });
    })

    $(document).on('click', '#btnGuardar', function (event) {
        event.preventDefault();
        if ($('#usuario').attr('data-index-number') != ''|| $('#roles').attr('data-index-number') != '') {
            const datos = {
                usuario: $('#usuarios [value="' + $('#usuario').val() + '"]').data('indexNumber'),
                roles: $('#roles [value="' + $('#rol').val() + '"]').data('indexNumber'),
                operacion: 'guardar'
            };
    
            $.post('../Controlador/roluser.controlador.php', datos, function (respuesta) {
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
        $.post('../Controlador/roluser.controlador.php', {id: $(this).attr('id'), operacion: 'mostrarEditar'}, function (respuesta) {
            console.log(respuesta);
            $.each(JSON.parse(respuesta), function(index, val) {
                $('#idRolUser').val(val.idUsuarioRol); 
                $('#usuario').val(val.usuario);
                $('#rol').val(val.rol);
                $('#roles').attr('data-index-number', val.idRol);
                $('#usuarios').attr('data-index-number', val.idUsuario);

                $('html, body').animate({scrollTop: 0}, 1000);
                
            });  
        })
    });


    $(document).on('click', '#btnBuscar', function (event) {
        event.preventDefault();        
            const datos = {
                usuario:  ($('#usuarios [value="' + $('#usuario').val() + '"]').data('indexNumber')==undefined ? '': $('#usuarios [value="' + $('#usuario').val() + '"]').data('indexNumber')),
                roles: ($('#roles [value="' + $('#rol').val() + '"]').data('indexNumber')==undefined ? '': $('#roles [value="' + $('#rol').val() + '"]').data('indexNumber')),
                operacion: 'buscar'
            };            
            $.post('../Controlador/roluser.controlador.php', datos, function (respuesta) {
                var table = null;                 
                $.each(JSON.parse(respuesta), function(index, val) {
                    table += '<tr class="editaUsuario" id='+val.idUsuarioRol+'>';
                    table += '<td>'+val.rol+'</td>';
                    table += '<td>'+val.usuario+'</td>';
                    table += '</tr>';
                });            
                $('#cuerpoTabla').html(table);
            })
            $('html, body').animate({scrollTop: 500}, 1000);
    });

    $(document).on('click', '#btnActualizar', function (event) {
        event.preventDefault();
        if ($('#idRolUser').val()!='') {
            const datos = {
                id: $('#idRolUser').val(),
                usuario: $('#usuarios [value="' + $('#usuario').val() + '"]').data('indexNumber'),
                roles: $('#roles [value="' + $('#rol').val() + '"]').data('indexNumber'),
                operacion: 'actualizar'
            };
    
            $.post('../Controlador/roluser.controlador.php', datos, function (respuesta) {
                alert(respuesta);
                mostrar();
                limpiar();
                $('html, body').animate({scrollTop: 500}, 1000);
            })            
        }
        else{
            alert("Por favor seleccione algun rol de la tabla para eliminar");
        } 
    });

    $(document).on('click', '#btnEliminar', function (event) {
        event.preventDefault();
        if ($('#idRolUser').val()!='') {
            if (confirm('Esta seguro de eliminar este rol de usuario?')) {
                $.post('../Controlador/roluser.controlador.php', {id: $('#idRolUser').val(), operacion: 'eliminar'}, function (respuesta) {
                    alert(respuesta);
                    mostrar();
                    limpiar();
                })
            }            
        }else{
            alert("Por favor seleccione algun rol de la tabla para eliminar");
        } 
        limpiar();
    });    
      
    function mostrar(){
        $.post('../Controlador/roluser.controlador.php', {operacion: 'mostrar'}, function (respuesta) {
            var table = null;                 
            $.each(JSON.parse(respuesta), function(index, val) {
                table += '<tr class="editaUsuario" id='+val.idUsuarioRol+'>';
                table += '<td>'+val.rol+'</td>';
                table += '<td>'+val.usuario+'</td>';
                table += '</tr>';
            });
            
            $('#cuerpoTabla').html(table);	
        })        
    }

    function limpiar() {
        $('#idRolUser').val(''); 
        $('#role').val(''); 
        $('#usuario').val(''); 
        $('#roles').attr('data-index-number', '');
        $('#usuarios').attr('data-index-number', '');
    }
      
      
});
