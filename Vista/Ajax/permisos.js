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

    $.post('../Controlador/formulario.controlador.php', {operacion: 'mostrar'}, function (respuesta) {
        let datos = JSON.parse(respuesta);
        datos.forEach(dato => {
            option = document.createElement("option");
            option.value = dato.descripcion;  
            option.setAttribute('data-index-number',dato.idFormulario);
            document.getElementById('pantallas').append(option); 
        });
    })

    $(document).on('click', '#btnGuardar', function (event) {
        event.preventDefault();
        if ($('#pantalla').attr('data-index-number') != ''|| $('#roles').attr('data-index-number') != '') {
            const datos = {
                pantalla: $('#pantallas [value="' + $('#pantalla').val() + '"]').data('indexNumber'),
                roles: $('#roles [value="' + $('#rol').val() + '"]').data('indexNumber'),
                operacion: 'guardar'
            };
    
            $.post('../Controlador/permisos.controlador.php', datos, function (respuesta) {
                alert(respuesta);
                mostrar();
                limpiar();
                $('html, body').animate({scrollTop: 500}, 1000);
            })
        }else{
            alert("Verifique que todos los campos esten llenos");
        }
    });
    
    $(document).on('click', '.editaPermiso', function (event) {
        event.preventDefault();
        $.post('../Controlador/permisos.controlador.php', {id: $(this).attr('id'), operacion: 'mostrarEditar'}, function (respuesta) {
            console.log(respuesta);
            $.each(JSON.parse(respuesta), function(index, val) {
                $('#idPermiso').val(val.idFormularioRol); 
                $('#pantalla').val(val.pantalla);
                $('#rol').val(val.rol);
                $('#roles').attr('data-index-number', val.idRol);
                $('#pantallas').attr('data-index-number', val.idFormulario);

                $('html, body').animate({scrollTop: 0}, 1000);
                
            });  
        })
    });


    $(document).on('click', '#btnBuscar', function (event) {
        event.preventDefault();        
            const datos = {
                pantalla:  ($('#pantallas [value="' + $('#pantalla').val() + '"]').data('indexNumber')==undefined ? '': $('#pantallas [value="' + $('#pantalla').val() + '"]').data('indexNumber')),
                roles: ($('#roles [value="' + $('#rol').val() + '"]').data('indexNumber')==undefined ? '': $('#roles [value="' + $('#rol').val() + '"]').data('indexNumber')),
                operacion: 'buscar'
            };            
            $.post('../Controlador/permisos.controlador.php', datos, function (respuesta) {
                var table = null;                 
                $.each(JSON.parse(respuesta), function(index, val) {
                    table += '<tr class="editaPermiso" id='+val.idFormularioRol+'>';
                    table += '<td>'+val.rol+'</td>';
                    table += '<td>'+val.pantalla+'</td>';
                    table += '<td>'+val.ubicacion+'</td>';
                    table += '</tr>';
                });            
                $('#cuerpoTabla').html(table);
            })
            $('html, body').animate({scrollTop: 500}, 1000);
    });

    $(document).on('click', '#btnActualizar', function (event) {
        event.preventDefault();
        if ($('#idPermiso').val()!='') {
            const datos = {
                id: $('#idPermiso').val(),
                pantalla: $('#pantallas [value="' + $('#pantalla').val() + '"]').data('indexNumber'),
                roles: $('#roles [value="' + $('#rol').val() + '"]').data('indexNumber'),
                operacion: 'actualizar'
            };
    
            $.post('../Controlador/permisos.controlador.php', datos, function (respuesta) {
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
        if ($('#idPermiso').val()!='') {
            if (confirm('Esta seguro de eliminar este rol?')) {
                $.post('../Controlador/permisos.controlador.php', {id: $('#idPermiso').val(), operacion: 'eliminar'}, function (respuesta) {
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
        $.post('../Controlador/permisos.controlador.php', {operacion: 'mostrar'}, function (respuesta) {
            var table = null;                 
            $.each(JSON.parse(respuesta), function(index, val) {
                table += '<tr class="editaPermiso" id='+val.idFormularioRol+'>';
                table += '<td>'+val.rol+'</td>';
                table += '<td>'+val.pantalla+'</td>';
                table += '<td>'+val.ubicacion+'</td>';
                table += '</tr>';
            });
            
            $('#cuerpoTabla').html(table);	
        })        
    }

    function limpiar() {
        $('#idPermiso').val(''); 
        $('#roles').val(''); 
        $('#pantallas').val(''); 
        $('#roles').attr('data-index-number', '');
        $('#pantallas').attr('data-index-number', '');
    }
      
      
});
