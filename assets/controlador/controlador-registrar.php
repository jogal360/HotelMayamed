<?php

  /*
    ARCHIVO: controlador-registrar.php
    CREACIÓN: 17/10/2016
    MODIFICACIÓN: 17/10/2016
    DESCRIPCIÓN: Se encarga de procesar las peticiones y realizar cambios en
      el Modelo o en la Vista
  */

  if($_POST) {
    #Se hace vínculo con el archivo del modelo
    require_once('../modelo/modeloMayamed.php');

    #Se recuperan los datos
    $nom = $_POST['inputNombre'];
    $app = $_POST['inputCorreo'];

    #Se genera un objeto del modelo
    $objeto = new ModeloMayamed();
    $mensaje = $objeto->insertar($nom,$app);
    $objeto->cerrar();
  }
  
  

  

  

?>