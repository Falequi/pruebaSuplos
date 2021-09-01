<?php 
  $data           = file_get_contents('data-1.json');
  $publicaciones  = json_decode($data, true);

  if (isset($_GET['error'])) {
    $error = $_GET['error'];
    if($error == 'faltan_valores'){
        echo '<strong style="color:red">introduce todos los datos en todos los campos del formulario</strong>';
    }
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
  <link type="text/css" rel="stylesheet" href="css/customColors.css"  media="screen,projection"/>
  <link type="text/css" rel="stylesheet" href="css/ion.rangeSlider.css"  media="screen,projection"/>
  <link type="text/css" rel="stylesheet" href="css/ion.rangeSlider.skinFlat.css"  media="screen,projection"/>
  <link type="text/css" rel="stylesheet" href="css/index.css"  media="screen,projection"/>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Formulario</title>
</head>

<body>
  <video src="img/video.mp4" id="vidFondo"></video>

  <div class="contenedor">
    <div class="card rowTitulo">
      <h1>Bienes Intelcost</h1>
    </div>
    <div class="colFiltros">
      <form action="./ctlForm.php" method="post" id="formulario">
        <div class="filtrosContenido">
          <div class="tituloFiltros">
            <h5>Filtros</h5>
          </div>
          <div class="filtroCiudad input-field">
            <p><label for="selectCiudad">Ciudad:</label><br></p>
            <select name="ciudad" id="selectCiudad">
            <option value="" selected>Elige una ciudad</option>
              <?php
                function city($city){
                  return $city['Ciudad'];
                }
                $cities = array_unique(array_map("city",$publicaciones));
                foreach ($cities as $publicacion) {
                  echo "<option value='".$publicacion."'>
                  ".$publicacion."</option>";
                }
              ?>
            </select>
          </div>
          <div class="filtroTipo input-field">
            <p><label for="selecTipo">Tipo:</label></p>
            <br>
            <select name="tipo" id="selectTipo">
              <option value="">Elige un tipo</option>
              <?php
                function type($type){
                  return $type['Tipo'];
                }
                $types = array_unique(array_map("type",$publicaciones));
                foreach ($types as $publicacion) {
                  echo "<option value=".$publicacion.">
                  ".$publicacion."</option>";
                }
              ?>
            </select>
          </div>
          <div class="filtroPrecio">
            <label for="rangoPrecio">Precio:</label>
            <input type="text" id="rangoPrecio" name="precio" value="" />
          </div>
          <div class="botonField">
            <input type="submit" class="btn white" value="Buscar" id="submitButton">
          </div>
        </div>
      </form>
    </div>
    <div id="tabs" style="width: 75%;">
      <ul>
        <li><a href="#tabs-1">Bienes disponibles</a></li>
        <li><a href="#tabs-2">Mis bienes</a></li>
        <li><a href="#tabs-3">Reportes</a></li>
      </ul>
      <div id="tabs-1">
        <div class="colContenido" id="divResultadosBusqueda">
          <div class="tituloContenido card" style="justify-content: center;">
            <h5>Resultados de la búsqueda:</h5>  
              <?php
                if(
                  isset($_GET['ciudad']) || 
                  isset($_GET['tipo']) || 
                  isset($_GET['precio'])
                  ){

                  $array = $publicaciones;

                  if(!empty($_GET['ciudad']))
                    $array = 
                    array_filter($array, function($x){
                      return $x['Ciudad'] ==  $_GET['ciudad'];
                    });

                  if(!empty($_GET['tipo']))
                    $array = 
                      array_filter($array, function($x){
                      return $x['Tipo'] ==  $_GET['tipo'];
                    });
                    
                  if(!empty($_GET['precio'])){

                    function filtro($inmueble){
                      
                      $precioMin = 
                        (int)substr($_GET['precio'],0,strpos($_GET['precio'],';')); 
                      $precioMax = 
                        (int)substr($_GET['precio'],strpos($_GET['precio'],';')+1); 
    
                      $precioInmueble = 
                        (int)str_replace(array('$',','),"",$inmueble['Precio']);
                        
                      return 
                        $precioInmueble >= $precioMin && 
                        $precioInmueble <= $precioMax;
                    }
                      $array = 
                      array_filter($array,"filtro");
                  } 
                  // print_r($array);
                  foreach ($array as $arrays) {
                    echo "<ul id='".$arrays['Id']."'>
                            <img src='./img/home.jpg' style='width: 20rem;'>;
                            <li>Direccion: "    .$arrays['Direccion']."</li>
                            <li>Ciudad: "       .$arrays['Ciudad']."</li>
                            <li>Telefono: "     .$arrays['Telefono']."</li>
                            <li>Codigo Postal: ".$arrays['Codigo_Postal']."</li>
                            <li>Tipo: "         .$arrays['Tipo']."</li>
                            <li>Precio: "       .$arrays['Precio']."</li>
                            <a href='#'><button>Guardar</button></a>
                          </ul>
                          <hr>";
                  }
                }else{
                  foreach ($publicaciones as $publicacion) {
                    echo "<ul id='".$publicacion['Id']."'>
                            <img src='./img/home.jpg' style='width: 20rem;'>;
                            <li>Direccion: "    .$publicacion['Direccion']."</li>
                            <li>Ciudad: "       .$publicacion['Ciudad']."</li>
                            <li>Telefono: "     .$publicacion['Telefono']."</li>
                            <li>Codigo Postal: ".$publicacion['Codigo_Postal']."</li>
                            <li>Tipo: "         .$publicacion['Tipo']."</li>
                            <li>Precio: "       .$publicacion['Precio']."</li>
                            <a href='#'><button>Guardar</button></a>
                          </ul>
                          <hr>";
                  }
                } 
              ?>
          </div>
        </div>
      </div>
      
      <div id="tabs-2" >
        <div class="colContenido" id="divBienesGuardados">
          <div class="tituloContenido card" style="justify-content: center;">
            <h5>Bienes guardados:</h5>
            
            <div class="divider"></div>
          </div>
        </div>
      </div>
      <div id="tabs-3" >
        <div class="colContenido" id="divReportes">
          <div class="tituloContenido card" style="justify-content: center;">
            <h5>Reposrtes:</h5>
            
            <div class="divider"></div>
          </div>
        </div>
      </div>
    </div>


    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    
    <script type="text/javascript" src="js/ion.rangeSlider.min.js"></script>
    <script type="text/javascript" src="js/materialize.min.js"></script>
    <script type="text/javascript" src="js/index.js"></script>
    <script type="text/javascript" src="js/buscador.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script type="text/javascript">
      $( document ).ready(function() {
          $( "#tabs" ).tabs();
      });
    </script>
  </body>
  </html>
