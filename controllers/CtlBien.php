<?php

/* IMPORTS */
require '../config/CORS.php';
require '../DTO/BieneDTO.php';
require '../DAO/BienDAO.php';
require '../helpers/Action.php';



$data           = file_get_contents('../data-1.json');
$publicaciones  = json_decode($data, true);


/* RECEPCION DE DATOS */
$action       = getInfo('action');
$clave        = getInfo('clave');

$id             = getInfo('id');
$direccion      = $publicaciones[$clave]['Direccion'];
$ciudad         = $publicaciones[$clave]['Ciudad'];
$telefono       = $publicaciones[$clave]['Telefono'];
$codigo_postal  = $publicaciones[$clave]['Codigo_Postal'];
$tipo           = $publicaciones[$clave]['Tipo'];
$precio         = $publicaciones[$clave]['Precio'];
$idbien         = $publicaciones[$clave]['Id'];

// echo $direccion;

/* DEFINICION DE OBJETOS */
$obj = new BienDTO(
    $id,
    $direccion,
    $ciudad,
    $telefono,
    $codigo_postal,
    $tipo,
    $precio,
    $idbien
);

$dao = new BienDAO();

/* CONTROL DE ACCIONES */
ExecuteAction($action, $obj, $dao);