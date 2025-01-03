<br><br>
    <footer class="navbar-dark bg-dark">
        <div class="text-center py-3">
            <p style="color: #fff;">© 2020 Todos los derechos reservados</p>
        </div>
    </footer>
    <script src="../Recursos/js/jquery-3.5.1.min.js"></script>
    <script src="../Recursos/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function(){ 
            
            $.post('../Controlador/usuarios.controlador.php', {operacion: 'mostrarPermisos', id: $('#idUsuario').val()}, function (respuesta) {
                let cont=0;
                var template = `
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Inicio</a>
                    </li>
                `;                 
                $.each(JSON.parse(respuesta), function(index, val) {
                    template += `
                        <li class="nav-item">
                            <a class="nav-link" href="${val.ubicacion}">${val.descripcion}</a>
                        </li>
                    `;                    
                    if ($(location).attr('pathname') == "/sistemaPermisos/Vista/"+val.ubicacion) {
                        cont++;
                    }
                });
                template += `
                    <li class="nav-item" id="salir">
                        <a class="nav-link" href="#">Cerrar Sesión</a>
                    </li>
                `;            
                $('#nav').html(template);
                if ($(location).attr('pathname') == "/sistemaPermisos/Vista/index.php") {
                    cont++;
                }
                
                if (cont != 1) {
                   window.location.href = 'index.php';
                }
            })  

            $(document).on('click', '#salir', function (event) {
            event.preventDefault();
            $.post('../Controlador/usuarios.controlador.php', {operacion: 'salir'}, function (respuesta) {
                alert(respuesta);
                window.location.href = "login.html";
            })
    });

            
        })
    </script>
</body>
</html>