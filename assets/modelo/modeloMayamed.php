<?php

  /*
    ARCHIVO: modelo-reservacion.php
    CREACIÓN: 17/10/16
    MODIFICACIÓN: 17/10/16
    DESCRIPCIÓN: El Modelo representa la información con la que trabaja el sitio.
  */

  #Se hace vínculo con el archivo de conexión
  require_once("../config/conexion.php");

  class ModeloMayamed {
  	/*Atributos*/
  	private $dbs;
  	private $mysqli;
    private $personas;
    private $nombre;
    private $apellidos;

    /*Métodos*/
    #Método constructor
    public function __construct() {
    	$this->dbs = Conexion::getInstance();
    	$this->mysqli = $this->dbs->getConnection();
      $this->personas = array();
    }

    #Método para cerrar la conexión
    public function cerrar() {
    	$this->mysqli->close();
    }
    
    #Método para registrar reservaciones
    public function insertar($nombre,$apellido) {
      $sql = "INSERT INTO ejemplo VALUES ('$nombre','$apellido')";
      $res = $this->mysqli->query($sql);
      $respuesta = array("respuesta" => 'bien', "res" => 'Registro exitoso');
      echo json_encode($respuesta);
    }

    #Método para mostrar los precios de las habitaciones
    public function mostrarPrecios() {
      /*Configuración para México*/
      date_default_timezone_set("America/Mexico_City");
      /*Obtención de datos de fecha de HOY*/
      $dia = date("d-m-Y");
      $año = date("Y");
      /*SEMANA SANTA*/
      $semanaSanta = date("d-M-Y", easter_date($año));
      $semanaSantaDom1 = strtotime('-7 day',strtotime($semanaSanta));
      $semanaSantaDom1 = date('d-m-Y',$semanaSantaDom1);
      $semanaSantaLun  = strtotime('-6 day',strtotime($semanaSanta));
      $semanaSantaLun  = date('d-m-Y',$semanaSantaLun);
      $semanaSantaMar  = strtotime('-5 day',strtotime($semanaSanta));
      $semanaSantaMar  = date('d-m-Y',$semanaSantaMar);
      $semanaSantaMie  = strtotime('-4 day',strtotime($semanaSanta));
      $semanaSantaMie  = date('d-m-Y',$semanaSantaMie);
      $semanaSantaJue  = strtotime('-3 day',strtotime($semanaSanta));
      $semanaSantaJue  = date('d-m-Y',$semanaSantaJue);
      $semanaSantaVie  = strtotime('-2 day',strtotime($semanaSanta));
      $semanaSantaVie  = date('d-m-Y',$semanaSantaVie);
      $semanaSantaSab  = strtotime('-1 day',strtotime($semanaSanta));
      $semanaSantaSab  = date('d-m-Y',$semanaSantaSab);
      $semanaSantaDom2 = strtotime('-0 day',strtotime($semanaSanta));
      $semanaSantaDom2 = date('d-m-Y',$semanaSantaDom2);
      /*---*/
      /*SEMANA DE VERANO*/
    
      /*---*/
      /*SEMANA DE INVIERNO*/
      $semanaInviernoDom1 = SEM_INV_DOM1."-".$año;
      $semanaInviernoLun  = SEM_INV_LUN."-".$año;
      $semanaInviernoMar  = SEM_INV_MAR."-".$año;
      $semanaInviernoMie  = SEM_INV_MIE."-".$año;
      $semanaInviernoJue  = SEM_INV_JUE."-".$año;
      $semanaInviernoVie  = SEM_INV_VIE."-".$año;
      $semanaInviernoSab  = SEM_INV_SAB."-".$año;
      $semanaInviernoDom2 = SEM_INV_DOM2."-".$año;
      /*---*/
      switch ($dia) {
        //Semana santa
        case $semanaSantaDom1:
        case $semanaSantaLun:
        case $semanaSantaMar:
        case $semanaSantaMie:
        case $semanaSantaJue:
        case $semanaSantaVie:
        case $semanaSantaSab:
        case $semanaSantaDom2:
        //Verano

        //Invierno
        case $semanaInviernoDom1:
        case $semanaInviernoLun:
        case $semanaInviernoMar:
        case $semanaInviernoMie:
        case $semanaInviernoJue:
        case $semanaInviernoVie:
        case $semanaInviernoSab:
        case $semanaInviernoDom2:

          //Respuesta de temporada alta
          $respuesta = array("respuesta" => 'bien', "habSen" => A_A, "habDob" => B_A, "habTri" =>C_A);
          echo json_encode($respuesta);
          break;

        //Temporada baja  
        default:
          $respuesta = array("respuesta" => 'bien', "habSen" => A_B, "habDob" => B_B, "habTri" =>C_B);
          echo json_encode($respuesta);
          break;
      }
    }
  }

?>