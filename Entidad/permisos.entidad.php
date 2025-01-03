<?php
namespace entidadPermiso;
class Permiso{
    private $idPermiso;
    private $idRol;
    private $idFormulario;

    /**
     * Get the value of idPermiso
     */ 
    public function getIdPermiso()
    {
        return $this->idPermiso;
    }

    /**
     * Set the value of idPermiso
     *
     * @return  self
     */ 
    public function setIdPermiso($idPermiso)
    {
        $this->idPermiso = $idPermiso;

        return $this;
    }

    /**
     * Get the value of idRol
     */ 
    public function getIdRol()
    {
        return $this->idRol;
    }

    /**
     * Set the value of idRol
     *
     * @return  self
     */ 
    public function setIdRol($idRol)
    {
        $this->idRol = $idRol;

        return $this;
    }

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

}

?>