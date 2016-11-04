<?php

  /*
    ARCHIVO: controlador-registrar.php
    CREACIÓN: 17/10/2016
    MODIFICACIÓN: 17/10/2016
    DESCRIPCIÓN: Se encarga de procesar las peticiones y realizar cambios en
      el Modelo o en la Vista
  */

    #Se hace vínculo con el archivo del modelo
    require_once('../modelo/modeloMayamed.php');

    #Se recuperan los datos
    $nom      = $_POST['inputNombre'];
    $ema      = $_POST['inputCorreo'];
    $hab      = $_POST['inputTipoHab'];
    $checkin  = $_POST['checkin'];
    $checkout = $_POST['checkout'];
    $perso    = $_POST['personas'];

    #Se genera un objeto del modelo y se ejecuta la funcion
    $objeto = new ModeloMayamed();
    $mensaje = $objeto->insertar($nom,$ema,$hab,$perso,$checkin,$checkout);
    $objeto->cerrar();  

?>