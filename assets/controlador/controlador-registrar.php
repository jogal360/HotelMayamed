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
    $datos = array();
    foreach ($_POST as $clave=>$valor) {
      $datos[] = $valor;
    }
    //var_dump($datos);

    #Se genera un objeto del modelo y se ejecuta la funcion
    $objeto = new ModeloMayamed();
    $mensaje = $objeto->insertar($datos);
    $objeto->cerrar();

?>