<?php

class bienesGuardados{

    private $repository;

    function __construct()
    {
        require_once './config/Repository.php';
        $this->repository = new Repository();
    }

    public function ListAll(){
        $query = $this->repository->buildQuery("listbienes");
        $this->repository->ImpBienes($query);
    }

    public function Delete(BienDTO $obj) {
        $query = $this->repository->buildQuerySimply("deletebien", array((int) $obj->getIdbien()));
        $this->repository->ExecuteTransaction($query);
    }

}

