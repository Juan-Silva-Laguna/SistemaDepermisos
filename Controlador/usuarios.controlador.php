<?php
include_once("../entidad/usuarios.entidad.php");
include_once("../modelo/usuarios.modelo.php");

$UsuariosE = new \entidadUsuarios\Usuarios();
switch ($_POST['operacion']) {
    case 'ingresar':
        $UsuariosE->setUser($_POST['user']);
        $UsuariosE->setPass($_POST['pass']);
        $UsuariosM = new \modeloUsuarios\Usuarios($UsuariosE);
        $mensaje = $UsuariosM->ingresar();
        break;
    case 'salir':
        $UsuariosM = new \modeloUsuarios\Usuarios($UsuariosE);
        $mensaje = $UsuariosM->salir();
        break;
    case 'guardar':
        $UsuariosE->setNombre($_POST['nombre']);
        $UsuariosE->setUser($_POST['usuario']);
        $UsuariosE->setPass($_POST['password']);
        $UsuariosE->setCorreo($_POST['correo']);
        $UsuariosE->setCelular($_POST['celular']);
        $UsuariosM = new \modeloUsuarios\Usuarios($UsuariosE);
        $mensaje = $UsuariosM->guardar();
        break;
    case 'actualizar':
        $UsuariosE->setId($_POST['id']);
        $UsuariosE->setNombre($_POST['nombre']);
        $UsuariosE->setUser($_POST['usuario']);
        $UsuariosE->setPass($_POST['password']);
        $UsuariosE->setCorreo($_POST['correo']);
        $UsuariosE->setCelular($_POST['celular']);
        $UsuariosM = new \modeloUsuarios\Usuarios($UsuariosE);
        $mensaje = $UsuariosM->actualizar();
        break;
    case 'buscar':
        $UsuariosE->setNombre($_POST['nombre']);
        $UsuariosE->setUser($_POST['usuario']);
        $UsuariosE->setCorreo($_POST['correo']);
        $UsuariosE->setCelular($_POST['celular']);
        $UsuariosM = new \modeloUsuarios\Usuarios($UsuariosE);
        $mensaje = $UsuariosM->buscar();
        break;
    case 'eliminar':
        $UsuariosE->setId($_POST['id']);
        $UsuariosM = new \modeloUsuarios\Usuarios($UsuariosE);
        $mensaje = $UsuariosM->eliminar();
        break;
    case 'mostrarPermisos':
        $UsuariosE->setId($_POST['id']);
        $UsuariosM = new \modeloUsuarios\Usuarios($UsuariosE);
        $mensaje = $UsuariosM->mostrarPermisos();
        break;
    case 'mostrar':
        $UsuariosM = new \modeloUsuarios\Usuarios($UsuariosE);
        $mensaje = $UsuariosM->mostrar();
        break;
    case 'mostrarEditar':
        $UsuariosE->setId($_POST['id']);
        $UsuariosM = new \modeloUsuarios\Usuarios($UsuariosE);
        $mensaje = $UsuariosM->mostrarEditar();
        break;
}

unset($UsuariosE);
unset($UsuariosM);

echo json_encode($mensaje);
?>