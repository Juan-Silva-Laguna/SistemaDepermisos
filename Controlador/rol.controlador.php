<?php
include_once("../entidad/rol.entidad.php");
include_once("../modelo/rol.modelo.php");

$RolE = new \entidadRol\Rol();
switch ($_POST['operacion']) {
    case 'guardar':
        $RolE->setRol($_POST['nombre']);
        $RolM = new \modeloRol\Rol($RolE);
        $mensaje = $RolM->guardar();
        break;
    case 'actualizar':
        $RolE->setIdRol($_POST['id']);
        $RolE->setRol($_POST['nombre']);
        $RolM = new \modeloRol\Rol($RolE);
        $mensaje = $RolM->actualizar();
        break;
    case 'buscar':
        $RolE->setRol($_POST['nombre']);
        $RolM = new \modeloRol\Rol($RolE);
        $mensaje = $RolM->buscar();
        break;
    case 'eliminar':
        $RolE->setIdRol($_POST['id']);
        $RolM = new \modeloRol\Rol($RolE);
        $mensaje = $RolM->eliminar();
        break;
    case 'mostrarPermisos':
        $RolE->setIdRol($_POST['id']);
        $RolM = new \modeloRol\Rol($RolE);
        $mensaje = $RolM->mostrarPermisos();
        break;
    case 'mostrar':
        $RolM = new \modeloRol\Rol($RolE);
        $mensaje = $RolM->mostrar();
        break;
    case 'mostrarEditar':
        $RolE->setIdRol($_POST['id']);
        $RolM = new \modeloRol\Rol($RolE);
        $mensaje = $RolM->mostrarEditar();
        break;
}

unset($RolE);
unset($RolM);

echo json_encode($mensaje);
?>