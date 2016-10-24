<?php

  /*
    ARCHIVO: controlador-registrar.php
    CREACIÓN: 17/10/2016
    MODIFICACIÓN: 17/10/2016
    DESCRIPCIÓN: Se encarga de procesar las peticiones y realizar cambios en
      el Modelo o en la Vista
  */

  #Se hace vínculo con el archivo del modelo
  require_once('../modelo/modelo-reservacion.php');

  #Se recuperan los datos
  $nom = base64_decode($_POST['nom']);
  $app = base64_decode($_POST['app']);

  #Se genera un objeto del modelo
  $objeto = new ModeloReservacion();
  $mensaje = $objeto->insertar($nom,$app);
  $objeto->cerrar();

?>