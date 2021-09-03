<?php

require_once 'Conection.php';
require_once 'Cleaner.php';

class Repository{
    private $con;
    private $objCon;
    private $clean;

    function Repository() {
        $this->clean = new Cleaner();
        $this->objCon = new Connection();
        $this->con = $this->objCon->connect();
    }

    function getObjCon() {
        return $this->objCon;
    }

    function setObjCon($objCon) {
        $this->objCon = $objCon;
    }
    
    public function buildQuery($nameFunction) {

        $query = "CALL " . $nameFunction . "()";
        // var_dump($query);
        return $query;
    }

    public function Execute($query) {
        try {
            /* Le asigno la consulta SQL a la conexion de la base de datos */
            $resultado = $this->objCon->getConnect()->prepare($query);
            /* Executo la consulta */
            $resultado->execute();
            /* Si obtuvo resultados, entonces paselos a un vector */
            if ($resultado->rowCount() > 0) {
                $vec = $resultado->fetchAll(PDO::FETCH_ASSOC);
            }

            echo $vec;

            // if (isset($vec)) {
            //     echo (json_encode(['code' => '1',
            //         'data' => json_encode($vec)]));
            //     //echo(json_encode($vec));
            // } else {
            //     echo '{"res" : "NotInfo","code":"0","data":"[]"}';
            // }
        } catch (PDOException $exception) {
            /* Se captura el error de ejecucion SQL */
            echo ' {
                "res" : "' . $exception . '"
            }';
        }
    }

    public function buildQuerySimply($nameFunction, $array) {
        $query = "SELECT " . $nameFunction . "(";

        for ($i = 0; $i < count($array); $i++) {
            (is_string($array[$i])) ? $query .= "'" . $this->cleanValue($array[$i]) . "'" : $query .= $array[$i]; //si es String pone comilla
            if ($i < count($array) - 1) { //si quedan mas parametros pone una ,
                $query .= ",";
            }
        }
        $query .= ");";
        return $query;
    }

    public function cleanValue($value) {
        return $this->clean->cleanValue($value);
    }

        /**
     * Ejecuta una consulta sql enfocada a escritura (save, delete, update)
     */
    public function ExecuteTransaction($query) {
        try {
            /* Le asigno la consulta SQL a la conexion de la base de datos */
            $resultado = $this->objCon->getConnect()->prepare($query);
            /* Executo la consulta */
            $resultado->execute();
            /* Si obtuvo resultados, entonces paselos a un vector */
            if ($resultado->rowCount() > 0) {
                $vec = $resultado->fetchAll(PDO::FETCH_NUM);
            }

            if ($vec[0][0] > 0) {
                echo(json_encode(['code' => '1', "msg" => 
                "Operacion exitosa"
                ]));
            } else {
                echo(json_encode(['code' => '2', "msg" => 
                "Error en la operacion, el registro esta asociado a otra informacion"]));
            }
        } catch (PDOException $exception) {
            echo(json_encode(['code' => '3', "msg" =>
            "Error en la operacion, el registro esta asociado a otra informacion",
                'development' => $exception->getMessage()]));
        }
    }

    public function ImpBienes($query) {
        try {
            /* Le asigno la consulta SQL a la conexion de la base de datos */
            $resultado = $this->objCon->getConnect()->prepare($query);
            /* Executo la consulta */
            $resultado->execute();
            /* Si obtuvo resultados, entonces paselos a un vector */
            if ($resultado->rowCount() > 0) {
                $vec = $resultado->fetchAll(PDO::FETCH_ASSOC);
            }

            foreach ($vec as $clave => $publicacion) {
                echo "<ul id='".$publicacion['id']."'>
                        <img src='./img/home.jpg' style='width: 20rem;'>
                        <li>Direccion:".$publicacion['direccion']."</li>
                        <li>Ciudad:".$publicacion['ciudad']."</li>
                        <li>Telefono:".$publicacion['telefono']."</li>
                        <li>Codigo Postal:".$publicacion['codigo_postal']."</li>
                        <li>Tipo:".$publicacion['tipo']."</li>
                        <li>Precio:".$publicacion['precio']."</li>
                        <a href='./controllers/CtlBien.php?action=".$action = "delete"."&idbien=".$publicacion['idbien']."'><button>Borrar</button></a>
                      </ul>
                      <hr>";
              }
        } catch (PDOException $exception) {
            /* Se captura el error de ejecucion SQL */
            echo ' {
                "res" : "' . $exception . '"
            }';
        }
    }
}



