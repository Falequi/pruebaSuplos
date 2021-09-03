<?php

class BienDAO {
    
    private $repository;

    function __construct() {
        require_once '../config/Repository.php';
        $this->repository = new Repository();
    }
    
    public function Save(BienDTO $obj) {
        $query = $this->repository->buildQuerySimply("savebien", array(
               (int) $obj->getId(),
            (string) $obj->getDireccion(),
            (string) $obj->getCiudad(),
            (string) $obj->getTelefono(),
            (string) $obj->getCodigo_postal(),
            (string) $obj->getTipo(),
            (string) $obj->getPrecio(),
            (string) $obj->getIdbien()
    ));
        echo $query;        
        $this->repository->ExecuteTransaction($query);
    }

    public function ListAll(){
        $query = $this->repository->buildQuery("listbienes");
        $this->repository->Execute($query);
    }

}