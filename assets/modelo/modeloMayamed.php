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
    public function insertar($nom,$ema,$hab,$perso,$checkin,$checkout) {
      date_default_timezone_set("America/Mexico_City");
      $fecha = date("d-m-Y");
      $hora = date("h:i A");
      $sql = "INSERT INTO t_reservacion VALUES (null,'$nom','$ema','$hab','$perso','$checkin','$checkout','$fecha','$hora')";
      $res = $this->mysqli->query($sql);
      if($res) {
        $respuesta = array("respuesta" => 'bien', "res" => 'Registro exitoso');
        echo json_encode($respuesta);
      } else {
        $respuesta = array("respuesta" => 'mal', "res" => 'Registro no completado');
        echo json_encode($respuesta);
      }
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
      $verano = array(SEM_VER_VIE1."-".$año, SEM_VER_SAB1."-".$año, SEM_VER_DOM1."-".$año, SEM_VER_LUN1."-".$año, SEM_VER_MAR1."-".$año, SEM_VER_MIE1."-".$año, SEM_VER_JUE1."-".$año, SEM_VER_VIE2."-".$año, SEM_VER_SAB2."-".$año, SEM_VER_DOM2."-".$año, SEM_VER_LUN2."-".$año, SEM_VER_MAR2."-".$año, SEM_VER_MIE2."-".$año, SEM_VER_JUE2."-".$año, SEM_VER_VIE3."-".$año, SEM_VER_SAB3."-".$año, SEM_VER_DOM3."-".$año, SEM_VER_LUN3."-".$año, SEM_VER_MAR3."-".$año, SEM_VER_MIE3."-".$año, SEM_VER_JUE3."-".$año, SEM_VER_VIE4."-".$año, SEM_VER_SAB4."-".$año, SEM_VER_DOM4."-".$año, SEM_VER_LUN4."-".$año, SEM_VER_MAR4."-".$año, SEM_VER_MIE4."-".$año, SEM_VER_JUE4."-".$año, SEM_VER_VIE5."-".$año, SEM_VER_SAB5."-".$año, SEM_VER_DOM5."-".$año);
      list($semanaVeranoVie1, $semanaVeranoSab1, $semanaVeranoDom1, $semanaVeranoLun1, $semanaVeranoMar1, $semanaVeranoMie1, $semanaVeranoJue1, $semanaVeranoVie2, $semanaVeranoSab2, $semanaVeranoDom2, $semanaVeranoLun2, $semanaVeranoMar2, $semanaVeranoMie2, $semanaVeranoJue2, $semanaVeranoVie3, $semanaVeranoSab3, $semanaVeranoDom3, $semanaVeranoLun3, $semanaVeranoMar3, $semanaVeranoMie3, $semanaVeranoJue3, $semanaVeranoVie4, $semanaVeranoSab4, $semanaVeranoDom4, $semanaVeranoLun4, $semanaVeranoMar4, $semanaVeranoMie4, $semanaVeranoJue4, $semanaVeranoVie5, $semanaVeranoSab5, $semanaVeranoDom5) = $verano;
      /*---*/
      /*SEMANA DE INVIERNO*/
      $invierno = array(SEM_INV_JUE1."-".$año, SEM_INV_VIE1."-".$año, SEM_INV_SAB1."-".$año, SEM_INV_DOM1."-".$año, SEM_INV_LUN1."-".$año, SEM_INV_MAR1."-".$año, SEM_INV_MIE1."-".$año, SEM_INV_JUE2."-".$año, SEM_INV_VIE2."-".$año, SEM_INV_SAB2."-".$año, SEM_INV_DOM2."-".$año, SEM_INV_LUN2."-".$año, SEM_INV_MAR2."-".$año, SEM_INV_MIE2."-".$año, SEM_INV_JUE3."-".$año, SEM_INV_VIE3."-".$año, SEM_INV_SAB3."-".$año, SEM_INV_DOM3."-".$año, SEM_INV_LUN3."-".$año, SEM_INV_MAR3."-".$año, SEM_INV_MIE3."-".$año, SEM_INV_JUE4."-".$año, SEM_INV_VIE4."-".$año,SEM_INV_SAB4."-".$año, SEM_INV_DOM4."-".$año, SEM_INV_LUN4."-".$año, SEM_INV_MAR4."-".$año, SEM_INV_MIE4."-".$año, SEM_INV_JUE5."-".$año, SEM_INV_VIE5."-".$año,SEM_INV_SAB5."-".$año);
      list($semanaInviernoJue1,$semanaInviernoVie1,$semanaInviernoSab1,$semanaInviernoDom1,$semanaInviernoLun1,$semanaInviernoMar1,$semanaInviernoMie1,$semanaInviernoJue2,$semanaInviernoVie2,$semanaInviernoSab2,$semanaInviernoDom2,$semanaInviernoLun2,$semanaInviernoMar2,$semanaInviernoMie2,$semanaInviernoJue3,$semanaInviernoVie3,$semanaInviernoSab3,$semanaInviernoDom3,$semanaInviernoLun3,$semanaInviernoMar3,$semanaInviernoMie3,$semanaInviernoJue4,$semanaInviernoVie4,$semanaInviernoSab4,$semanaInviernoDom4,$semanaInviernoLun4,$semanaInviernoMar4,$semanaInviernoMie4,$semanaInviernoJue5,$semanaInviernoVie5,$semanaInviernoSab5) = $invierno;
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
        case $semanaVeranoVie1:
        case $semanaVeranoSab1:
        case $semanaVeranoDom1:
        case $semanaVeranoLun1:
        case $semanaVeranoMar1:
        case $semanaVeranoMie1:
        case $semanaVeranoJue1:
        case $semanaVeranoVie2:
        case $semanaVeranoSab2:
        case $semanaVeranoDom2:
        case $semanaVeranoLun2:
        case $semanaVeranoMar2:
        case $semanaVeranoMie2:
        case $semanaVeranoJue2:
        case $semanaVeranoVie3:
        case $semanaVeranoSab3:
        case $semanaVeranoDom3:
        case $semanaVeranoLun3:
        case $semanaVeranoMar3:
        case $semanaVeranoMie3:
        case $semanaVeranoJue3:
        case $semanaVeranoVie4:
        case $semanaVeranoSab4:
        case $semanaVeranoDom4:
        case $semanaVeranoLun4:
        case $semanaVeranoMar4:
        case $semanaVeranoMie4:
        case $semanaVeranoJue4:
        case $semanaVeranoVie5:
        case $semanaVeranoSab5:
        case $semanaVeranoDom5:

        //Invierno
        case $semanaInviernoJue1:
        case $semanaInviernoVie1:
        case $semanaInviernoSab1:
        case $semanaInviernoDom1:
        case $semanaInviernoLun1:
        case $semanaInviernoMar1:
        case $semanaInviernoMie1:
        case $semanaInviernoJue2: 
        case $semanaInviernoVie2:
        case $semanaInviernoSab2:
        case $semanaInviernoDom2:
        case $semanaInviernoLun2:
        case $semanaInviernoMar2:
        case $semanaInviernoMie2:
        case $semanaInviernoJue3:
        case $semanaInviernoVie3:
        case $semanaInviernoSab3:
        case $semanaInviernoDom3:
        case $semanaInviernoLun3:
        case $semanaInviernoMar3:
        case $semanaInviernoMie3:
        case $semanaInviernoJue4:
        case $semanaInviernoVie4:
        case $semanaInviernoSab4:
        case $semanaInviernoDom4:
        case $semanaInviernoLun4:
        case $semanaInviernoMar4:
        case $semanaInviernoMie4:
        case $semanaInviernoJue5:
        case $semanaInviernoVie5:
        case $semanaInviernoSab5:
          //Respuesta de temporada alta
          $respuesta = array("respuesta" => 'bien', "habSen" => A_A, "habDob" => B_A, "habTri" => C_A);
          echo json_encode($respuesta);
          break;

        //Temporada baja  
        default:
          $respuesta = array("respuesta" => 'bien', "habSen" => A_B, "habDob" => B_B, "habTri" => C_B);
          echo json_encode($respuesta);
          break;
      }
    }
  }

?>