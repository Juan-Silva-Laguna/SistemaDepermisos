<?php
namespace modeloUsuarios;
use PDO;

include_once("../Entidad/usuarios.entidad.php");
include_once("conexion.php");
class Usuarios{
    private $user;
    private $pass;
    private $nombre;
    private $id;
    private $correo;
    private $celular;
    private $conexion;
    private $consulta;
    private $resultado;
    private $retorno;
    public function __construct(\entidadUsuarios\Usuarios $usuariosE)
    {
        $this->conexion = new \Conexion();
        $this->user=$usuariosE->getUser();  
        $this->pass=$usuariosE->getPass();   
        $this->nombre=$usuariosE->getNombre();    
        $this->id=$usuariosE->getId(); 
        $this->correo=$usuariosE->getCorreo();   
        $this->celular=$usuariosE->getCelular(); 
    }

    public function ingresar()
    {
       $this->consulta="SELECT * FROM usuario WHERE usuario='$this->user'";
       $this->resultado=$this->conexion->con->prepare($this->consulta);
       $this->resultado->execute();
       if($this->resultado->rowCount()>=1){
            
           foreach ($this->resultado->fetchAll(PDO::FETCH_ASSOC) as $dato) {
            if (password_verify($this->pass, $dato['clave']))  {
                session_start();
                $_SESSION['id'] = $dato['idUsuario'];
                $_SESSION['nombre'] = $dato['nombre'];
                $_SESSION['usuario'] = $dato['usuario'];
                $this->retorno=['1', 'Bienvenido(a) '.$_SESSION['nombre']];
            }
            else{
                $this->retorno=['0', 'Clave Incorrecta por favor intente nuevamente'];
            }
           }
            
       }
       else{
        $this->retorno=['0', 'Hay un error de autenticación por favor vuelva a intentarlo'];
       }
       return $this->retorno;
    }

    public function salir()
    {
       session_start();      
       $this->retorno='Hasta Pronto '.$_SESSION['nombre'];
       session_destroy();
       return $this->retorno;
    }


    public function mostrar()
    {
       $this->consulta="SELECT * FROM usuario";
       $this->resultado=$this->conexion->con->prepare($this->consulta);
       $this->resultado->execute();
       return $this->resultado->fetchAll(PDO::FETCH_ASSOC);
    }

    public function guardar()
    {
       $hash = password_hash($this->pass, PASSWORD_ARGON2I);
       $this->consulta="INSERT INTO usuario VALUES(NULL, '$this->nombre', '$this->correo', '$this->celular', '$this->user', '$hash')";
       $this->resultado=$this->conexion->con->prepare($this->consulta);
       $this->resultado->execute();
       if($this->resultado->rowCount()>=1){
            $this->retorno='Se registro nuevo usuario';
        }
        else{
            $this->retorno='Error al registrar este usuario';
        }
       return $this->retorno;
    }

    public function mostrarEditar()
    {
       $this->consulta="SELECT * FROM usuario WHERE idUsuario='$this->id'";   
       $this->resultado=$this->conexion->con->prepare($this->consulta);
       $this->resultado->execute();
       return $this->resultado->fetchAll(PDO::FETCH_ASSOC);
    }

    public function actualizar()
    { 
        if ($this->pass == 'Privada por seguridad') {
            $var = "";
        }else{
            $hash = password_hash($this->pass, PASSWORD_ARGON2I);
            $var = ", clave='$hash'";
        }
       $this->consulta="UPDATE usuario SET nombre='$this->nombre', correo='$this->correo', celular='$this->celular', usuario='$this->user' $var WHERE idUsuario='$this->id'";
       $this->resultado=$this->conexion->con->prepare($this->consulta);
       $this->resultado->execute();
       if($this->resultado->rowCount()>=1){
            $this->retorno='Se actualizaron datos del usuario';
        }
        else{
            $this->retorno='Error al actualizar datos';
        }
       return $this->retorno;
    }

    public function eliminar()
    { 
       $this->consulta="DELETE FROM usuario WHERE idUsuario='$this->id'";
       $this->resultado=$this->conexion->con->prepare($this->consulta);
       $this->resultado->execute();
       if($this->resultado->rowCount()>=1){
            $this->retorno='Se elimino el usuario';
        }
        else{
            $this->retorno='Error al eliminar usuario';
        }
       return $this->retorno;
    }

    public function mostrarPermisos()
    { 
       $this->consulta="SELECT formulario.* FROM formulario
       INNER JOIN formulario_rol ON formulario_rol.idFormulario=formulario.idFormulario 
       INNER JOIN rol ON rol.idRol=formulario_rol.idRol 
       INNER JOIN usuario_rol ON usuario_rol.idRol=rol.idRol
       INNER JOIN usuario ON usuario_rol.idUsuario=usuario.idUsuario WHERE usuario.idUsuario='$this->id'";
       $this->resultado=$this->conexion->con->prepare($this->consulta);
       $this->resultado->execute();
       return $this->resultado->fetchAll(PDO::FETCH_ASSOC);
    }

    

    public function buscar()
    {
       $this->consulta="SELECT * FROM usuario WHERE nombre LIKE '%$this->nombre%' AND correo LIKE '%$this->correo%'AND celular LIKE '%$this->celular%' AND usuario LIKE '%$this->user%'";   
       $this->resultado=$this->conexion->con->prepare($this->consulta);
       $this->resultado->execute();
       return $this->resultado->fetchAll(PDO::FETCH_ASSOC);
    }

}
?>