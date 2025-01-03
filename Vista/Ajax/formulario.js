$(document).ready(function(){   

    mostrar();
    $(document).on('click', '#btnGuardar', function (event) {
        event.preventDefault();
        if ($('#nombre').val() != '' || $('#ubicacion').val() != '') {
            const datos = {
                nombre: $('#nombre').val(), 
                ubicacion: $('#ubicacion').val(), 
                operacion: 'guardar'
            };
    
            $.post('../Controlador/formulario.controlador.php', datos, function (respuesta) {
                alert(respuesta);
                mostrar();
                limpiar();
                $('html, body').animate({scrollTop: 500}, 1000);
            })
        }else{
            alert("Verifique que todos los campos esten llenos");
        }
    });
    
    $(document).on('click', '.editaForm', function (event) {
        event.preventDefault();
        $.post('../Controlador/formulario.controlador.php', {id: $(this).attr('id'), operacion: 'mostrarEditar'}, function (respuesta) {
            console.log(respuesta);
            $.each(JSON.parse(respuesta), function(index, val) {
                $('#idForm').val(val.idFormulario); 
                $('#nombre').val(val.descripcion); 
                $('#ubicacion').val(val.ubicacion);                 

                $('html, body').animate({scrollTop: 0}, 1000);
                
            });  
        })
    });


    $(document).on('click', '#btnBuscar', function (event) {
        event.preventDefault();
            const datos = {
                nombre: $('#nombre').val(), 
                ubicacion: $('#ubicacion').val(), 
                operacion: 'buscar'
            };
    
            $.post('../Controlador/formulario.controlador.php', datos, function (respuesta) {
                var table = null;                 
                $.each(JSON.parse(respuesta), function(index, val) {
                    table += '<tr class="editaForm" id='+val.idFormulario+'>';
                    table += '<td>'+(index+1)+'</td>';
                    table += '<td>'+val.descripcion+'</td>';
                    table += '<td>'+val.ubicacion+'</td>';
                    table += '</tr>';
                });            
                $('#cuerpoTabla').html(table);
            })
            $('html, body').animate({scrollTop: 500}, 1000);
    });

    $(document).on('click', '#btnActualizar', function (event) {
        event.preventDefault();
        if ($('#idForm').val()!='') {
            const datos = {
                id: $('#idForm').val(),
                nombre: $('#nombre').val(), 
                ubicacion: $('#ubicacion').val(), 
                operacion: 'actualizar'
            };
    
            $.post('../Controlador/formulario.controlador.php', datos, function (respuesta) {
                alert(respuesta);
                mostrar();
                limpiar();
                $('html, body').animate({scrollTop: 500}, 1000);
            })            
        }
        else{
            alert("Por favor seleccione alguna fila de la tabla para eliminar");
        } 
    });

    $(document).on('click', '#btnEliminar', function (event) {
        event.preventDefault();
        if ($('#idForm').val()!='') {
            if (confirm('Esta seguro de eliminar esta pantalla?')) {
                $.post('../Controlador/formulario.controlador.php', {id: $('#idForm').val(), operacion: 'eliminar'}, function (respuesta) {
                    alert(respuesta);
                    mostrar();
                    limpiar();
                })
            }            
        }else{
            alert("Por favor seleccione alguna fila de la tabla para eliminar");
        } 
        limpiar();
    });    
      
    function mostrar(){
        $.post('../Controlador/formulario.controlador.php', {operacion: 'mostrar'}, function (respuesta) {
            console.log(respuesta);
            var table = null;                 
            $.each(JSON.parse(respuesta), function(index, val) {
                table += '<tr class="editaForm" id='+val.idFormulario+'>';
                table += '<td>'+(index+1)+'</td>';
                table += '<td>'+val.descripcion+'</td>';
                table += '<td>'+val.ubicacion+'</td>';
                table += '</tr>';
            });
            
            $('#cuerpoTabla').html(table);	
        })        
    }

    function limpiar() {
        $('#idForm').val(''); 
        $('#nombre').val(''); 
        $('#ubicacion').val(''); 
    }
      
});
