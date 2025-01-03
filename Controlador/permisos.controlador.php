<?php
include_once("../entidad/permisos.entidad.php");
include_once("../modelo/permisos.modelo.php");

$PermisoE = new \entidadPermiso\Permiso();
switch ($_POST['operacion']) {
    case 'guardar':
        $PermisoE->setIdRol($_POST['roles']);
        $PermisoE->setIdFormulario($_POST['pantalla']);
        $PermisoM = new \modeloPermiso\Permiso($PermisoE);
        $mensaje = $PermisoM->guardar();
        break;
    case 'actualizar':
        $PermisoE->setIdPermiso($_POST['id']);
        $PermisoE->setIdRol($_POST['roles']);
        $PermisoE->setIdFormulario($_POST['pantalla']);
        $PermisoM = new \modeloPermiso\Permiso($PermisoE);
        $mensaje = $PermisoM->actualizar();
        break;
    case 'buscar':
        $PermisoE->setIdRol($_POST['roles']);
        $PermisoE->setIdFormulario($_POST['pantalla']);
        $PermisoM = new \modeloPermiso\Permiso($PermisoE);
        $mensaje = $PermisoM->buscar();
        break;
    case 'eliminar':
        $PermisoE->setIdPermiso($_POST['id']);
        $PermisoM = new \modeloPermiso\Permiso($PermisoE);
        $mensaje = $PermisoM->eliminar();
        break;
    case 'mostrarPermisos':
        $PermisoE->setIdPermiso($_POST['id']);
        $PermisoM = new \modeloPermiso\Permiso($PermisoE);
        $mensaje = $PermisoM->mostrarPermisos();
        break;
    case 'mostrar':
        $PermisoM = new \modeloPermiso\Permiso($PermisoE);
        $mensaje = $PermisoM->mostrar();
        break;
    case 'mostrarEditar':
        $PermisoE->setIdPermiso($_POST['id']);
        $PermisoM = new \modeloPermiso\Permiso($PermisoE);
        $mensaje = $PermisoM->mostrarEditar();
        break;
}

unset($PermisoE);
unset($PermisoM);

echo json_encode($mensaje);
?>