<?php

  /*
    ARCHIVO: controlador-reservacion-insertar.php
    CREACIÓN: 17/10/2016
    MODIFICACIÓN: 17/10/2016
    DESCRIPCIÓN: Se encarga de procesar las peticiones y realizar cambios en
      el Modelo o en la Vista
  */

  #Se hace vínculo con el archivo del modelo
  require_once('modelo/modelo-reservacion.php');

  $nombre = "J";

  #Se genera un objeto del modelo
  $obj = new ModeloReservacion;
  echo $obj->insertarReservacion($nombre);
  //$obj->cerrar();

  //echo $personas;

  #Se llama a la vista
  //require_once("vista/vista-listado.html");

?>