<?php
include_once("../entidad/roluser.entidad.php");
include_once("../modelo/roluser.modelo.php");

$RolUserE = new \entidadRolUser\RolUser();
switch ($_POST['operacion']) {
    case 'guardar':
        $RolUserE->setIdRol($_POST['roles']);
        $RolUserE->setIdUsuario($_POST['usuario']);
        $RolUserM = new \modeloRolUser\RolUser($RolUserE);
        $mensaje = $RolUserM->guardar();
        break;
    case 'actualizar':
        $RolUserE->setIdRolUser($_POST['id']);
        $RolUserE->setIdRol($_POST['roles']);
        $RolUserE->setIdUsuario($_POST['usuario']);
        $RolUserM = new \modeloRolUser\RolUser($RolUserE);
        $mensaje = $RolUserM->actualizar();
        break;
    case 'buscar':
        $RolUserE->setIdRol($_POST['roles']);
        $RolUserE->setIdUsuario($_POST['usuario']);
        $RolUserM = new \modeloRolUser\RolUser($RolUserE);
        $mensaje = $RolUserM->buscar();
        break;
    case 'eliminar':
        $RolUserE->setIdRolUser($_POST['id']);
        $RolUserM = new \modeloRolUser\RolUser($RolUserE);
        $mensaje = $RolUserM->eliminar();
        break;
    case 'mostrarRolUsers':
        $RolUserE->setIdRolUser($_POST['id']);
        $RolUserM = new \modeloRolUser\RolUser($RolUserE);
        $mensaje = $RolUserM->mostrarRolUsers();
        break;
    case 'mostrar':
        $RolUserM = new \modeloRolUser\RolUser($RolUserE);
        $mensaje = $RolUserM->mostrar();
        break;
    case 'mostrarEditar':
        $RolUserE->setIdRolUser($_POST['id']);
        $RolUserM = new \modeloRolUser\RolUser($RolUserE);
        $mensaje = $RolUserM->mostrarEditar();
        break;
}

unset($RolUserE);
unset($RolUserM);

echo json_encode($mensaje);
?>