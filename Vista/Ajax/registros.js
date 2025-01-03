$(document).ready(function(){   
    llenarSelect();
    mostrar();


    
    $(document).on('click', '.editaProducto', function (event) {
        event.preventDefault();
        if ($('#usuarioLogueado').val() ) {
            
        }

        $.post('../Controlador/registros.controlador.php', {id: $(this).attr('id'), operacion: 'mostrarEditar'}, function (respuesta) {
            console.log(respuesta);
            $.each(JSON.parse(respuesta), function(index, val) {
                $('#idRegistro').val(val.idRegistro); 
                $('#proceso').val(val.proceso); 
                $('#archivohidden').val(val.archivo);
                $('#estado').val(val.estado); 
                $('#descripcion').val(val.descripcion);
                $('#fecha').val(val.fecha);
                $('#usuarios').val(val.usuario);
                $('#usuarios').attr('disabled', true);
                $('#fecha').attr('disabled', true);

                $('html, body').animate({scrollTop: 0}, 1000);
                
            });  
            
            
        })
    });

    $(document).on('click', '#btnBuscar', function (event) {
        event.preventDefault();
            const datos = {
                proceso: $('#proceso').val(), 
                archivo: $('#archivohidden').val(),
                estado: $('#estado').val(), 
                descripcion: $('#descripcion').val(),
                fecha: $('#fecha').val(), 
                usuario: $('#usuarios').val(),
                operacion: 'buscar'
            };
    
            $.post('../Controlador/registros.controlador.php', datos, function (respuesta) {
                var table = null;                 
                $.each(JSON.parse(respuesta), function(index, val) {
                    table += '<tr class="'+(val.estado == 0 ? 'table-warning':'')+'">';
                    table += '<td class="editaProducto" id='+val.idRegistro+'>'+val.proceso+'</td>';
                    table += '<td class="editaProducto" id='+val.idRegistro+'>'+val.descripcion+'</td>';
                    table += '<td class="editaProducto" id='+val.idRegistro+'>'+val.fecha+'</td>';
                    table += '<td class="editaProducto" id='+val.idRegistro+'>'+val.usuario+'</td>';
                    table += '<td class="editaProducto" id='+val.idRegistro+'>'+(val.estado == 1 ? 'Activo':'Inactivo')+'</td>';
                    table += '<td><a href="../Archivos/'+val.archivo+'"  target="_blank"><img src="../Recursos/img/descarga.png" width="30" height="30"></a> </td>';
                    table += '</tr>';
                });            
                $('#cuerpoTabla').html(table);
            })
            $('html, body').animate({scrollTop: 500}, 1000);
    });

    $(document).on('click', '#btnGuardar', function (event) {
        event.preventDefault();
        if ($('#proceso').val() != ''|| $('#archivohidden').val() != '' || $('#descripcion').val() != '') {
            const datos = {
                proceso: $('#proceso').val(), 
                archivo: $('#archivohidden').val(),
                estado: $('#estado').val(), 
                descripcion: $('#descripcion').val(),
                operacion: 'guardar'
            };
    
            $.post('../Controlador/registros.controlador.php', datos, function (respuesta) {
                alert(respuesta);
                mostrar();
                limpiar();
                $('html, body').animate({scrollTop: 500}, 1000);
            })
        }else{
            alert("Verifique que todos los campos esten llenos");
        }
    });

    $(document).on('click', '#btnActualizar', function (event) {
        event.preventDefault();
        if ($('#idRegistro').val()!='') {
            if ($('#usuarioLogueado').val()==$('#usuarios').val()) {
                if ($('#archivohidden').val() != '') {
                    const datos = {
                        id: $('#idRegistro').val(),
                        proceso: $('#proceso').val(), 
                        archivo: $('#archivohidden').val(),
                        estado: $('#estado').val(), 
                        descripcion: $('#descripcion').val(),
                        operacion: 'actualizar'
                    };
            
                    $.post('../Controlador/registros.controlador.php', datos, function (respuesta) {
                        alert(respuesta);
                        mostrar();
                        limpiar();
                        $('html, body').animate({scrollTop: 500}, 1000);
                    })
                }
                else{
                    alert("Debe seleccionar un archivo");
                }
            }else{
                alert("Solo si guardaste el registro puedes editarlo,\nlastimosamente este registro lo guardo otro usuario.");
                limpiar();
            }
        }else{
            alert("Por favor seleccione algun registro de la tabla para actualizar");
        } 
    });

    $(document).on('click', '#limpiar', function (event) {
        event.preventDefault();
        limpiar();
    });

    $(document).on('click', '#btnEliminar', function (event) {
        event.preventDefault();

        if ($('#idRegistro').val()!='') {
            if ($('#usuarioLogueado').val()==$('#usuarios').val()) {
                if (confirm('Esta seguro de eliminar este regitro?')) {
                    $.post('../Controlador/eliminarArchivo.php', {archivo: $('#archivohidden').val()})
                    $.post('../Controlador/registros.controlador.php', {id: $('#idRegistro').val(), operacion: 'eliminar'}, function (respuesta) {
                        alert(respuesta);
                        mostrar();
                        $('html, body').animate({scrollTop: 500}, 1000);
                    })
                }                
            }else{
                alert("Solo si guardaste el registro puedes eliminarlo,\nlastimosamente este registro lo guardo otro usuario.");
            }
        }else{
            alert("Por favor seleccione algun registro de la tabla para eliminar");
        } 
        limpiar();
    });

    $(document).on('change', '#archivo', function (e) {
        e.preventDefault();
        if ($('#archivohidden').val() != '') {
            $.post('../Controlador/eliminarArchivo.php', {archivo: $('#archivohidden').val()})
        }
            let inputFileImage = document.getElementById("archivo");
            let file = inputFileImage.files[0];
            let data = new FormData();
            data.append('archivo',file);
            $.ajax({
                url:"../Controlador/almacenarArchivos.php",
                type:'POST',
                contentType:false,
                data:data,
                processData:false,
                cache:false
            })
            .done(function(respuesta){
                switch (respuesta) {
                    case "1":
                        alert('Error: Solo se permiten archivos .pdf y de 200 kb como máximo');
                        $("#archivo").val('');
                        $("#archivohidden").val('');
                        break;
                    case "2":
                        alert('Error: Por favor cambie el nombre del archivo para subirlo');
                        $("#archivo").val('');
                        $("#archivohidden").val('');
                    break;
                    case "3":
                        alert('Ocurrió algún error al subir el fichero. Intente de nuevo');
                        $("#archivo").val('');
                        $("#archivohidden").val('');
                        break;   
                    default:
                        alert('Se ha cargado con exitos el archivo');
                        $("#archivohidden").val(respuesta);
                        break;
                }
                    
            })
    });

    $(document).on('click', '#salir', function (event) {
        event.preventDefault();
        $.post('../Controlador/usuarios.controlador.php', {operacion: 'salir'}, function (respuesta) {
            alert(respuesta);
            window.location.href = "login.html";
        })
    });

      
    function mostrar(){
        $.post('../Controlador/registros.controlador.php', {operacion: 'mostrar'}, function (respuesta) {
            var table = null;                 
            $.each(JSON.parse(respuesta), function(index, val) {
                table += '<tr class="'+(val.estado == 0 ? 'table-warning':'')+'">';
                table += '<td class="editaProducto" id='+val.idRegistro+'>'+val.proceso+'</td>';
                table += '<td class="editaProducto" id='+val.idRegistro+'>'+val.descripcion+'</td>';
                table += '<td class="editaProducto" id='+val.idRegistro+'>'+val.fecha+'</td>';
                table += '<td class="editaProducto" id='+val.idRegistro+'>'+val.usuario+'</td>';
                table += '<td class="editaProducto" id='+val.idRegistro+'>'+(val.estado == 1 ? 'Activo':'Inactivo')+'</td>';
                table += '<td><a href="../Archivos/'+val.archivo+'"  target="_blank"><img src="../Recursos/img/descarga.png" width="30" height="30"></a> </td>';
                table += '</tr>';
            });            
            $('#cuerpoTabla').html(table);	
        })        
    }

    function llenarSelect(){
        $.post('../Controlador/usuarios.controlador.php', {operacion: 'mostrar'}, function (respuesta) {
            var option = '<option value="">Todos</option>';                 
            $.each(JSON.parse(respuesta), function(index, val) {
                option += '<option value="'+val.usuario+'">'+val.usuario+'</option>';
            });
            $('#usuarios').html(option);	
        })         
    }

    function limpiar() {
        $('#idRegistro').val(''); 
        $('#proceso').val(''); 
        $('#archivohidden').val('');
        $('#archivo').val('');
        $('#estado').val(''); 
        $('#descripcion').val('');
        $('#fecha').val('');
        $('#usuarios').val('');
        $('#usuarios').attr('disabled', false);
        $('#fecha').attr('disabled', false);
    }
});
