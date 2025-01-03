<?php
namespace modeloRol;
use PDO;

include_once("../Entidad/rol.entidad.php");
include_once("conexion.php");
class Rol{
    private $idRol;
    private $rol;
    private $conexion;
    private $consulta;
    private $resultado;
    private $retorno;
    public function __construct(\entidadRol\Rol $RolE)
    {
        $this->conexion = new \Conexion();
        $this->idRol=$RolE->getIdRol();  
        $this->rol=$RolE->getRol();       
    }

    public function guardar()
    {
       $this->consulta="INSERT INTO rol VALUES(NULL, '$this->rol')";
       $this->resultado=$this->conexion->con->prepare($this->consulta);
       $this->resultado->execute();
       if($this->resultado->rowCount()>=1){
            $this->retorno='Se guardo el rol';
        }
        else{
            $this->retorno='Error al guardar rol';
        }
       return $this->retorno;
    }

    public function mostrar()
    {
       $this->consulta="SELECT * FROM rol";   
       $this->resultado=$this->conexion->con->prepare($this->consulta);
       $this->resultado->execute();
       return $this->resultado->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function mostrarEditar()
    {
       $this->consulta="SELECT * FROM rol WHERE  idRol='$this->idRol'";   
       $this->resultado=$this->conexion->con->prepare($this->consulta);
       $this->resultado->execute();
       return $this->resultado->fetchAll(PDO::FETCH_ASSOC);
    }

    public function actualizar()
    { 
       $this->consulta="UPDATE rol SET descripcion='$this->rol' WHERE idRol='$this->idRol'";
       $this->resultado=$this->conexion->con->prepare($this->consulta);
       $this->resultado->execute();
       if($this->resultado->rowCount()>=1){
            $this->retorno='Se actualizo el rol';
        }
        else{
            $this->retorno='Error al actualizar rol';
        }
       return $this->retorno;
    }

    public function eliminar()
    { 
       $this->consulta="DELETE FROM rol WHERE idRol='$this->idRol'";
       $this->resultado=$this->conexion->con->prepare($this->consulta);
       $this->resultado->execute();
       if($this->resultado->rowCount()>=1){
            $this->retorno='Se elimino el rol';
        }
        else{
            $this->retorno='Error al eliminar rol';
        }
       return $this->retorno;
    }

    public function buscar()
    {
       $this->consulta="SELECT * FROM rol WHERE descripcion LIKE '%$this->rol%'";   
       $this->resultado=$this->conexion->con->prepare($this->consulta);
       $this->resultado->execute();
       return $this->resultado->fetchAll(PDO::FETCH_ASSOC);
    }

}
?>