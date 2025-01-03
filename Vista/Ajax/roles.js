$(document).ready(function(){   

    mostrar();
    $(document).on('click', '#btnGuardar', function (event) {
        event.preventDefault();
        if ($('#nombre').val() != ''|| $('#rol').val() != '' || $('#password').val() != '') {
            const datos = {
                nombre: $('#rol').val(), 
                operacion: 'guardar'
            };
    
            $.post('../Controlador/rol.controlador.php', datos, function (respuesta) {
                alert(respuesta);
                mostrar();
                limpiar();
                $('html, body').animate({scrollTop: 500}, 1000);
            })
        }else{
            alert("Verifique que todos los campos esten llenos");
        }
    });
    
    $(document).on('click', '.editaRol', function (event) {
        event.preventDefault();
        $.post('../Controlador/rol.controlador.php', {id: $(this).attr('id'), operacion: 'mostrarEditar'}, function (respuesta) {
            console.log(respuesta);
            $.each(JSON.parse(respuesta), function(index, val) {
                $('#idRol').val(val.idRol); 
                $('#rol').val(val.descripcion); 

                $('html, body').animate({scrollTop: 0}, 1000);
                
            });  
        })
    });


    $(document).on('click', '#btnBuscar', function (event) {
        event.preventDefault();
            const datos = {
                nombre: $('#rol').val(), 
                operacion: 'buscar'
            };
    
            $.post('../Controlador/rol.controlador.php', datos, function (respuesta) {
                var table = null;                 
                $.each(JSON.parse(respuesta), function(index, val) {
                    table += '<tr class="editaRol" id='+val.idRol+'>';
                    table += '<td>'+(index+1)+'</td>';
                    table += '<td>'+val.descripcion+'</td>';
                    table += '</tr>';
                });            
                $('#cuerpoTabla').html(table);
            })
            $('html, body').animate({scrollTop: 500}, 1000);
    });

    $(document).on('click', '#btnActualizar', function (event) {
        event.preventDefault();
        if ($('#idRol').val()!='') {
            const datos = {
                id: $('#idRol').val(),
                nombre: $('#rol').val(), 
                operacion: 'actualizar'
            };
    
            $.post('../Controlador/rol.controlador.php', datos, function (respuesta) {
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
        if ($('#idRol').val()!='') {
            if (confirm('Esta seguro de eliminar este rol?')) {
                $.post('../Controlador/rol.controlador.php', {id: $('#idRol').val(), operacion: 'eliminar'}, function (respuesta) {
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
        $.post('../Controlador/rol.controlador.php', {operacion: 'mostrar'}, function (respuesta) {
            console.log(respuesta);
            var table = null;                 
            $.each(JSON.parse(respuesta), function(index, val) {
                table += '<tr class="editaRol" id='+val.idRol+'>';
                table += '<td>'+(index+1)+'</td>';
                table += '<td>'+val.descripcion+'</td>';
                table += '</tr>';
            });
            
            $('#cuerpoTabla').html(table);	
        })        
    }

    function limpiar() {
        $('#idRol').val(''); 
        $('#rol').val(''); 
    }
      
});
