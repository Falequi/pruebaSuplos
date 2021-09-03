<?php
/**
 * Contiene el control de las acciones basicas del sistema
 */
function ExecuteAction($action, $obj, $dao) {
    
    switch (trim($action)) {
        /* Transaction CRUD */

        case "save":
            $dao->Save($obj);
            break;

        case "search":
            $dao->Search($obj);
            break;

        case "delete":
            $dao->Delete($obj);
            break;

        case "update":
            $dao->Update($obj);
            break;

        case "list":
            $dao->ListAll($obj, false);
            break;

        /* END Transaction CRUD */

        default :
            echo 'No action found';
            break;
    }
}
    /**
 * Obtiene una variable por get o post, especificandole el nombre
 */
function getInfo($name) {
    return (isset($_REQUEST[$name]) ? $_REQUEST[$name] : "");
}

