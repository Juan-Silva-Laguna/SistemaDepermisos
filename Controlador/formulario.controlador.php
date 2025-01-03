<?php 
include_once("../entidad/formulario.entidad.php");
include_once("../modelo/formulario.modelo.php");

$FormularioE = new \entidadFormulario\Formulario();
switch ($_POST['operacion']) {
    case 'guardar':
        $FormularioE->setDescripcion($_POST['nombre']);
        $FormularioE->setUbicacion($_POST['ubicacion']);
        $FormularioM = new \modeloFormulario\Formulario($FormularioE);
        $mensaje = $FormularioM->guardar();
        break;
    case 'actualizar':
        $FormularioE->setIdFormulario($_POST['id']);
        $FormularioE->setDescripcion($_POST['nombre']);
        $FormularioE->setUbicacion($_POST['ubicacion']);
        $FormularioM = new \modeloFormulario\Formulario($FormularioE);
        $mensaje = $FormularioM->actualizar();
        break;
    case 'buscar':
        $FormularioE->setDescripcion($_POST['nombre']);
        $FormularioE->setUbicacion($_POST['ubicacion']);
        $FormularioM = new \modeloFormulario\Formulario($FormularioE);
        $mensaje = $FormularioM->buscar();
        break;
    case 'eliminar':
        $FormularioE->setIdFormulario($_POST['id']);
        $FormularioM = new \modeloFormulario\Formulario($FormularioE);
        $mensaje = $FormularioM->eliminar();
        break;
    case 'mostrarPermisos':
        $FormularioE->setIdFormulario($_POST['id']);
        $FormularioM = new \modeloFormulario\Formulario($FormularioE);
        $mensaje = $FormularioM->mostrarPermisos();
        break;
    case 'mostrar':
        $FormularioM = new \modeloFormulario\Formulario($FormularioE);
        $mensaje = $FormularioM->mostrar();
        break;
    case 'mostrarEditar':
        $FormularioE->setIdFormulario($_POST['id']);
        $FormularioM = new \modeloFormulario\Formulario($FormularioE);
        $mensaje = $FormularioM->mostrarEditar();
        break;
}

unset($FormularioE);
unset($FormularioM);

echo json_encode($mensaje);
?>