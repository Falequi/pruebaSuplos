<?php

class bienDTO {

    private $id;
    private $direccion;
    private $ciudad;
    private $telefono;
    private $codigo_postal;
    private $tipo;
    private $precio;
    private $idbien;

    function __construct(
        $id,
        $direccion, 
        $ciudad, 
        $telefono, 
        $codigo_postal, 
        $tipo, 
        $precio,
        $idbien
    ){
        $this->id           = $id;
        $this->direccion    = $direccion;
        $this->ciudad       = $ciudad;
        $this->telefono     = $telefono;
        $this->codigo_postal= $codigo_postal;
        $this->tipo         = $tipo;
        $this->precio       = $precio;
        $this->idbien       = $idbien;
        }

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * Get the value of direccion
     */ 
    public function getDireccion()
    {
        return $this->direccion;
    }

    /**
     * Set the value of direccion
     *
     * @return  self
     */ 
    public function setDireccion($direccion)
    {
        $this->direccion = $direccion;

        return $this;
    }

    /**
     * Get the value of ciudad
     */ 
    public function getCiudad()
    {
        return $this->ciudad;
    }

    /**
     * Set the value of ciudad
     *
     * @return  self
     */ 
    public function setCiudad($ciudad)
    {
        $this->ciudad = $ciudad;

        return $this;
    }

    /**
     * Get the value of telefono
     */ 
    public function getTelefono()
    {
        return $this->telefono;
    }

    /**
     * Set the value of telefono
     *
     * @return  self
     */ 
    public function setTelefono($telefono)
    {
        $this->telefono = $telefono;

        return $this;
    }

    /**
     * Get the value of codigo_postal
     */ 
    public function getCodigo_postal()
    {
        return $this->codigo_postal;
    }

    /**
     * Set the value of codigo_postal
     *
     * @return  self
     */ 
    public function setCodigo_postal($codigo_postal)
    {
        $this->codigo_postal = $codigo_postal;

        return $this;
    }

    /**
     * Get the value of tipo
     */ 
    public function getTipo()
    {
        return $this->tipo;
    }

    /**
     * Set the value of tipo
     *
     * @return  self
     */ 
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;

        return $this;
    }

    /**
     * Get the value of precio
     */ 
    public function getPrecio()
    {
        return $this->precio;
    }

    /**
     * Set the value of precio
     *
     * @return  self
     */ 
    public function setPrecio($precio)
    {
        $this->precio = $precio;

        return $this;
    }



    /**
     * Get the value of idbien
     */ 
    public function getIdbien()
    {
        return $this->idbien;
    }

    /**
     * Set the value of idbien
     *
     * @return  self
     */ 
    public function setIdbien($idbien)
    {
        $this->idbien = $idbien;

        return $this;
    }
}