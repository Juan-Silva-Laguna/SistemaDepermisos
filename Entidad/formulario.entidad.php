<?php
namespace entidadFormulario;
class Formulario{
    private $idFormulario;
    private $descripcion;
    private $ubicacion;

    /**
     * Get the value of idFormulario
     */ 
    public function getIdFormulario()
    {
        return $this->idFormulario;
    }

    /**
     * Set the value of idFormulario
     *
     * @return  self
     */ 
    public function setIdFormulario($idFormulario)
    {
        $this->idFormulario = $idFormulario;

        return $this;
    }

    /**
     * Get the value of descripcion
     */ 
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Set the value of descripcion
     *
     * @return  self
     */ 
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    /**
     * Get the value of ubicacion
     */ 
    public function getUbicacion()
    {
        return $this->ubicacion;
    }

    /**
     * Set the value of ubicacion
     *
     * @return  self
     */ 
    public function setUbicacion($ubicacion)
    {
        $this->ubicacion = $ubicacion;

        return $this;
    }

    

}

?>