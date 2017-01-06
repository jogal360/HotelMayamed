<?php

  /*
    ARCHIVO: controlador-contacto.php
    CREACIÓN: 07/11/2016
    MODIFICACIÓN: 07/11/2016
    DESCRIPCIÓN: Se encarga de procesar los datos hacia el modelo
  */

    #Se hace vínculo con el archivo del modelo
    require_once('../modelo/modeloMayamed.php');

    #Se recuperan los datos y se genera un array
    $datos = array();
    foreach ($_POST as $clave=>$valor) {
      $datos[] = $valor;
    }
    //echo $nombre = $datos[0];

    #Se genera un objeto del modelo y se ejecuta la funcion
    $objeto = new ModeloMayamed();
    $mensaje = $objeto->enviarCorreoContacto($datos);
    $objeto->cerrar();

?>