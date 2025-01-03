<?php
include_once("../entidad/registros.entidad.php");
include_once("../modelo/registros.modelo.php");

$RegistroE = new \entidadRegistro\Registro();
switch ($_POST['operacion']) {
    case 'guardar':
        $RegistroE->setProceso($_POST['proceso']);
        $RegistroE->setDescripcion($_POST['descripcion']);
        $RegistroE->setArchivo($_POST['archivo']);
        $RegistroE->setEstado($_POST['estado']);
        $RegistroM = new \modeloRegistro\Registro($RegistroE);
        $mensaje = $RegistroM->guardar();
        break;
    case 'actualizar':
        $RegistroE->setIdRegistro($_POST['id']);
        $RegistroE->setProceso($_POST['proceso']);
        $RegistroE->setDescripcion($_POST['descripcion']);
        $RegistroE->setArchivo($_POST['archivo']);
        $RegistroE->setEstado($_POST['estado']);
        $RegistroM = new \modeloRegistro\Registro($RegistroE);
        $mensaje = $RegistroM->actualizar();
        break;
    case 'buscar':
        $RegistroE->setFecha($_POST['fecha']);
        $RegistroE->setUsuario($_POST['usuario']);
        $RegistroE->setProceso($_POST['proceso']);
        $RegistroE->setDescripcion($_POST['descripcion']);        
        $RegistroE->setEstado($_POST['estado']);
        $RegistroM = new \modeloRegistro\Registro($RegistroE);
        $mensaje = $RegistroM->buscar();
        break;
    case 'eliminar':
        $RegistroE->setIdRegistro($_POST['id']);
        $RegistroM = new \modeloRegistro\Registro($RegistroE);
        $mensaje = $RegistroM->eliminar();
        break;
    case 'mostrar':
        $RegistroM = new \modeloRegistro\Registro($RegistroE);
        $mensaje = $RegistroM->mostrar();
        break;
    case 'mostrarEditar':
        $RegistroE->setIdRegistro($_POST['id']);
        $RegistroM = new \modeloRegistro\Registro($RegistroE);
        $mensaje = $RegistroM->mostrarEditar();
        break;
}

unset($RegistroE);
unset($RegistroM);

echo json_encode($mensaje);
?>