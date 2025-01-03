<?php
namespace modeloRolUser;
use PDO;

include_once("../Entidad/roluser.entidad.php");
include_once("conexion.php");
class RolUser{
    private $idRolUser;
    private $idUsuario;
    private $idRol;
    private $conexion;
    private $consulta;
    private $resultado;
    private $retorno;
    public function __construct(\entidadRolUser\RolUser $RolUserE)
    {
        $this->conexion = new \Conexion();
        $this->idRolUser=$RolUserE->getIdRolUser();     
        $this->idUsuario=$RolUserE->getIdUsuario();     
        $this->idRol=$RolUserE->getIdRol();     
    }

    public function guardar()
    {
       $this->consulta="INSERT INTO usuario_rol VALUES(NULL, '$this->idUsuario' , '$this->idRol')";
       $this->resultado=$this->conexion->con->prepare($this->consulta);
       $this->resultado->execute();
       if($this->resultado->rowCount()>=1){
            $this->retorno='Se dio un rol a el usuario';
        }
        else{
            $this->retorno='Error al otorgar rol';
        }
       return $this->retorno;
    }

    public function mostrar()
    { 
       $this->consulta="SELECT usuario.usuario, usuario.idUsuario, rol.descripcion as rol, usuario_rol.idUsuarioRol FROM usuario
       INNER JOIN usuario_rol ON usuario_rol.idUsuario=usuario.idUsuario 
       INNER JOIN rol ON rol.idRol=usuario_rol.idRol";
       $this->resultado=$this->conexion->con->prepare($this->consulta);
       $this->resultado->execute();
       return $this->resultado->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function mostrarEditar()
    {
       $this->consulta="SELECT usuario.usuario, usuario.idUsuario, rol.descripcion as rol, rol.idRol, usuario_rol.idUsuarioRol FROM usuario
       INNER JOIN usuario_rol ON usuario_rol.idUsuario=usuario.idUsuario 
       INNER JOIN rol ON rol.idRol=usuario_rol.idRol WHERE idUsuarioRol='$this->idRolUser'";   
       $this->resultado=$this->conexion->con->prepare($this->consulta);
       $this->resultado->execute();
       return $this->resultado->fetchAll(PDO::FETCH_ASSOC);
    }

    public function actualizar()
    { 
       $this->consulta="UPDATE usuario_rol SET idRol='$this->idRol', idUsuario='$this->idUsuario' WHERE idUsuarioRol='$this->idRolUser'";
       $this->resultado=$this->conexion->con->prepare($this->consulta);
       $this->resultado->execute();
       if($this->resultado->rowCount()>=1){
            $this->retorno='Se actualizo el rol de usuario';
        }
        else{
            $this->retorno='Error al actualizar rol de usuario';
        }
       return $this->retorno;
    }

    public function eliminar()
    { 
       $this->consulta="DELETE FROM usuario_rol WHERE idUsuarioRol='$this->idRolUser'";
       $this->resultado=$this->conexion->con->prepare($this->consulta);
       $this->resultado->execute();
       if($this->resultado->rowCount()>=1){
            $this->retorno='Se elimino el rol de usuario';
        }
        else{
            $this->retorno='Error al eliminar rol de usuario';
        }
       return $this->retorno;
    }

    public function buscar()
    {
       $this->consulta="SELECT usuario.usuario, usuario.idUsuario, rol.descripcion as rol, usuario_rol.idUsuarioRol FROM usuario
       INNER JOIN usuario_rol ON usuario_rol.idUsuario=usuario.idUsuario 
       INNER JOIN rol ON rol.idRol=usuario_rol.idRol WHERE rol.idRol LIKE '%$this->idRol%' AND usuario.idUsuario LIKE '%$this->idUsuario%'";   
       $this->resultado=$this->conexion->con->prepare($this->consulta);
       $this->resultado->execute();
       return $this->resultado->fetchAll(PDO::FETCH_ASSOC);
    }

}
?>