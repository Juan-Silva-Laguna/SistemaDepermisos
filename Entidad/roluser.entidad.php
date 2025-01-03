<?php
namespace entidadRolUser;
class RolUser{
    private $idRolUser;
    private $idRol;
    private $idUsuario;

    /**
     * Get the value of idRolUser
     */ 
    public function getIdRolUser()
    {
        return $this->idRolUser;
    }

    /**
     * Set the value of idRolUser
     *
     * @return  self
     */ 
    public function setIdRolUser($idRolUser)
    {
        $this->idRolUser = $idRolUser;

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
     * Get the value of idUsuario
     */ 
    public function getIdUsuario()
    {
        return $this->idUsuario;
    }

    /**
     * Set the value of idUsuario
     *
     * @return  self
     */ 
    public function setIdUsuario($idUsuario)
    {
        $this->idUsuario = $idUsuario;

        return $this;
    }

}

?>