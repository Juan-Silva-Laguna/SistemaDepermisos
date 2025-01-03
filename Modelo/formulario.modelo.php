<?php
namespace modeloFormulario;
use PDO;

include_once("../Entidad/formulario.entidad.php");
include_once("conexion.php");
class Formulario{
    private $idFormulario;
    private $descripcion;
    private $ubicacion;
    private $conexion;
    private $consulta;
    private $resultado;
    private $retorno;
    public function __construct(\entidadFormulario\Formulario $FormularioE)
    {
        $this->conexion = new \Conexion();
        $this->idFormulario=$FormularioE->getIdFormulario();  
        $this->descripcion=$FormularioE->getDescripcion();  
        $this->ubicacion=$FormularioE->getUbicacion();       
    }

    public function guardar()
    {
       $this->consulta="INSERT INTO formulario VALUES(NULL, '$this->descripcion', '$this->ubicacion')";
       $this->resultado=$this->conexion->con->prepare($this->consulta);
       $this->resultado->execute();
       if($this->resultado->rowCount()>=1){
            $this->retorno='Se guardo la pantalla';
        }
        else{
            $this->retorno='Error al guardar pantalla';
        }
       return $this->retorno;
    }

    public function mostrar()
    {
       $this->consulta="SELECT * FROM formulario";   
       $this->resultado=$this->conexion->con->prepare($this->consulta);
       $this->resultado->execute();
       return $this->resultado->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function mostrarEditar()
    {
       $this->consulta="SELECT * FROM formulario WHERE  idFormulario='$this->idFormulario'";   
       $this->resultado=$this->conexion->con->prepare($this->consulta);
       $this->resultado->execute();
       return $this->resultado->fetchAll(PDO::FETCH_ASSOC);
    }

    public function actualizar()
    { 
       $this->consulta="UPDATE formulario SET descripcion='$this->descripcion', ubicacion='$this->ubicacion' WHERE idFormulario='$this->idFormulario'";
       $this->resultado=$this->conexion->con->prepare($this->consulta);
       $this->resultado->execute();
       if($this->resultado->rowCount()>=1){
            $this->retorno='Se actualizo la pantalla';
        }
        else{
            $this->retorno='Error al actualizar pantalla';
        }
       return $this->retorno;
    }

    public function eliminar()
    { 
       $this->consulta="DELETE FROM formulario WHERE idFormulario='$this->idFormulario'";
       $this->resultado=$this->conexion->con->prepare($this->consulta);
       $this->resultado->execute();
       if($this->resultado->rowCount()>=1){
            $this->retorno='Se elimino el pantalla';
        }
        else{
            $this->retorno='Error al eliminar pantalla';
        }
       return $this->retorno;
    }

    public function buscar()
    {
       $this->consulta="SELECT * FROM formulario WHERE descripcion LIKE '%$this->descripcion%' AND ubicacion LIKE '%$this->ubicacion%'";   
       $this->resultado=$this->conexion->con->prepare($this->consulta);
       $this->resultado->execute();
       return $this->resultado->fetchAll(PDO::FETCH_ASSOC);
    }

}
?>