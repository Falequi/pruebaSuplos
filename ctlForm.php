<?php
    $error = 'faltan_valores';
   
        if(!empty($_POST['ciudad']) || !empty($_POST['tipo']) || !empty($_POST['precio'])){
        
        $error      = "Ok";
        
        $ciudad     = $_POST['ciudad'];
        $tipo       = $_POST['tipo'];
        $precio     = $_POST['precio'];
        
        header("location: index.php?ciudad=$ciudad&tipo=$tipo&precio=$precio"); 
        
    }else{
        $error = 'faltan_valores';
        header("location: index.php?error=$error"); 
    }      
?>