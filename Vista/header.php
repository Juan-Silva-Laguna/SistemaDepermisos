<?php
    session_start();
    if ($_SESSION['id'] === '' || $_SESSION['id'] === null) {
        header('Location: login.html');
    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema Permisos</title>
    <link rel="stylesheet" href="../Recursos/css/bootstrap.min.css">
</head>
<body>
    <!-- Navigation -->
    <input type="hidden" id="idUsuario" value="<?php echo $_SESSION['id']; ?>">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark static-top">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="../Recursos/img/milogo2.png" width="55" height="55">
            </a>
            <h3 class="navbar-brand"> Soluciones Tecnológicas</h3>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto" id="nav">
                    
                </ul>
            </div>
        </div>
    </nav>

    