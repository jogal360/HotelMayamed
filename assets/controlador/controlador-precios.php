<?php

  /*
    ARCHIVO: controlador-precios.php
    CREACIÓN: 17/10/2016
    MODIFICACIÓN: 31/10/2016
    DESCRIPCIÓN: Se encarga de procesar los precios de las habitaciones
  */

    #Se hace vínculo con el archivo del modelo
    require_once('../modelo/modeloMayamed.php');  

    #Se genera un objeto del modelo y se ejecuta la funcion
    $objeto = new ModeloMayamed();
    $objeto->mostrarPrecios();
  
?>