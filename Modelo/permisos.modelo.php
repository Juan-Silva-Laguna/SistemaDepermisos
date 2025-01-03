<?php
namespace modeloPermiso;
use PDO;

include_once("../Entidad/permisos.entidad.php");
include_once("conexion.php");
class Permiso{
    private $idPermiso;
    private $idFormulario;
    private $idRol;
    private $conexion;
    private $consulta;
    private $resultado;
    private $retorno;
    public function __construct(\entidadPermiso\Permiso $PermisoE)
    {
        $this->conexion = new \Conexion();
        $this->idPermiso=$PermisoE->getIdPermiso();     
        $this->idFormulario=$PermisoE->getIdFormulario();     
        $this->idRol=$PermisoE->getIdRol();     
    }

    public function guardar()
    {
       $this->consulta="INSERT INTO formulario_rol VALUES(NULL, '$this->idFormulario' , '$this->idRol')";
       $this->resultado=$this->conexion->con->prepare($this->consulta);
       $this->resultado->execute();
       if($this->resultado->rowCount()>=1){
            $this->retorno='Se dio el Permiso a el rol';
        }
        else{
            $this->retorno='Error al dar Permiso';
        }
       return $this->retorno;
    }

    public function mostrar()
    { 
       $this->consulta="SELECT formulario.descripcion as pantalla, formulario.ubicacion, rol.descripcion as rol, formulario_rol.idFormularioRol FROM formulario
       INNER JOIN formulario_rol ON formulario_rol.idFormulario=formulario.idFormulario 
       INNER JOIN rol ON rol.idRol=formulario_rol.idRol";
       $this->resultado=$this->conexion->con->prepare($this->consulta);
       $this->resultado->execute();
       return $this->resultado->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function mostrarEditar()
    {
       $this->consulta="SELECT formulario.descripcion as pantalla, formulario.idFormulario, formulario.ubicacion, rol.descripcion as rol, rol.idRol, formulario_rol.idFormularioRol FROM formulario
       INNER JOIN formulario_rol ON formulario_rol.idFormulario=formulario.idFormulario 
       INNER JOIN rol ON rol.idRol=formulario_rol.idRol WHERE idFormularioRol='$this->idPermiso'";   
       $this->resultado=$this->conexion->con->prepare($this->consulta);
       $this->resultado->execute();
       return $this->resultado->fetchAll(PDO::FETCH_ASSOC);
    }

    public function actualizar()
    { 
       $this->consulta="UPDATE formulario_rol SET idRol='$this->idRol', idFormulario='$this->idFormulario' WHERE idFormularioRol='$this->idPermiso'";
       $this->resultado=$this->conexion->con->prepare($this->consulta);
       $this->resultado->execute();
       if($this->resultado->rowCount()>=1){
            $this->retorno='Se actualizo el Permiso';
        }
        else{
            $this->retorno='Error al actualizar Permiso';
        }
       return $this->retorno;
    }

    public function eliminar()
    { 
       $this->consulta="DELETE FROM formulario_rol WHERE idFormularioRol='$this->idPermiso'";
       $this->resultado=$this->conexion->con->prepare($this->consulta);
       $this->resultado->execute();
       if($this->resultado->rowCount()>=1){
            $this->retorno='Se elimino el Permiso';
        }
        else{
            $this->retorno='Error al eliminar Permiso';
        }
       return $this->retorno;
    }

    public function buscar()
    {
       $this->consulta="SELECT formulario.descripcion as pantalla, formulario.ubicacion, rol.descripcion as rol, formulario_rol.idFormularioRol FROM formulario
       INNER JOIN formulario_rol ON formulario_rol.idFormulario=formulario.idFormulario 
       INNER JOIN rol ON rol.idRol=formulario_rol.idRol WHERE rol.idRol LIKE '%$this->idRol%' AND formulario.idFormulario LIKE '%$this->idFormulario%'";   
       $this->resultado=$this->conexion->con->prepare($this->consulta);
       $this->resultado->execute();
       return $this->resultado->fetchAll(PDO::FETCH_ASSOC);
    }

}
?>