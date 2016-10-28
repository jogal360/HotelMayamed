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
      header('Content-Type: text/html; charset=UTF-8');
      $fecha = date("d-m-Y");
      $hora = date("h:i A");
      $sql = "INSERT INTO t_reservacion VALUES (null,'$nom','$ema','$hab','$perso','$checkin','$checkout','$fecha','$hora')";
      $res = $this->mysqli->query($sql);
      if($res) {
        $fecI = str_replace("/", "-", $checkin);
        $fecF = str_replace("/", "-", $checkout);
        $dias = (strtotime($fecI)-strtotime($fecF))/86400;
        $dias   = abs($dias); $dias = floor($dias);
        session_start();
        switch ($hab) {
          case 'Sencilla':
            $costoUnitario = $_SESSION['sencilla'];
            break;
          case 'Doble':
            $costoUnitario = $_SESSION['doble'];
            break;
          case 'Triple':
            $costoUnitario = $_SESSION['triple'];
            break;
          default:
            $costoUnitario = "ERROR";
            break;
        }
        $costoTotal = ($dias*$costoUnitario);
        /*-----------*/
        $to = $ema;
        $subject = utf8_decode('Reservación registrada, Hotel Mayamed');
        $message = '
          <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
          <html xmlns="http://www.w3.org/1999/xhtml" xmlns="http://www.w3.org/1999/xhtml" style="font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; margin: 0; padding: 0;">
            <head>
              <meta name="viewport" content="width=device-width" />
              <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
            </head>
            <body style="font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; -webkit-font-smoothing: antialiased; -webkit-text-size-adjust: none; width: 100% !important; height: 100%; line-height: 1.6; background-color: #f6f6f6; margin: 0; padding: 0;" bgcolor="#f6f6f6">
              <table class="body-wrap" style="font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; width: 100%; background-color: #f6f6f6; margin: 0; padding: 0;" bgcolor="#f6f6f6">
              <tr style="font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; margin: 0; padding: 0;">
                <td style="font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 0;" valign="top"></td>
                <td class="container" width="600" style="font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; display: block !important; max-width: 600px !important; clear: both !important; width: 100% !important; margin: 0 auto; padding: 0;" valign="top">
                <div class="content" style="font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; max-width: 600px; display: block; margin: 0 auto; padding: 10px;">
                  <table class="main" width="100%" cellpadding="0" cellspacing="0" style="font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; border-radius: 3px; background-color: #fff; margin: 0; padding: 0; border: 1px solid #e9e9e9;" bgcolor="#fff">
                    <tr style="font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; margin: 0; padding: 0;">
                      <td class="content-wrap aligncenter" style="font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; text-align: center; margin: 0; padding: 20px;" align="center" valign="top">
                        <table width="100%" cellpadding="0" cellspacing="0" style="font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; margin: 0; padding: 0;">
                          <tr style="font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; margin: 0; padding: 0;">
                            <td class="content-block" style="font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 0 0 20px;" valign="top">
                              <img src="http://www.hotelmayamed.com.mx/logo.png" width="110" height="100" align="center">
                            </td>
                          </tr>
                          <tr style="font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; margin: 0; padding: 0;">
                            <td class="content-block" style="font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 0 0 20px;" valign="top">
                              <h2 style="font-family: "Helvetica Neue", Helvetica, Arial, "Lucida Grande", sans-serif; box-sizing: border-box; font-size: 18px !important; color: #000; line-height: 1.2; font-weight: 600 !important; margin: 20px 0 5px; padding: 0;">Tu reservación está registrada.</h2>
                              <h5>Entre los dias '.$checkin.' y '.$checkout.' te sentirás como en casa.</h5>
                            </td>
                          </tr>
                          <tr style="font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; margin: 0; padding: 0;">
                            <td class="content-block" style="font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 0 0 10px;" valign="top">
                              <table class="invoice" style="font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; text-align: left; width: 100% !important; margin: 40px auto; padding: 0;">
                                <tr style="font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; margin: 0; padding: 0;">
                                  <td style="font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 5px 0;" valign="top">
                                    <b>Cliente:</b> '.$nom.'<br style="font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; margin: 0; padding: 0;" />
                                    <b>Correo:</b> '.$ema.'<br style="font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; margin: 0; padding: 0;" />
                                    <b>Fecha:</b> '.$fecha.'<br style="font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; margin: 0; padding: 0;" />
                                    <b>Personas:</b> '.$perso.'
                                  </td>
                                </tr>
                                <tr style="font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; margin: 0; padding: 0;">
                                  <td style="font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 5px 0;" valign="top">
                                    <table class="invoice-items" cellpadding="0" cellspacing="0" style="font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; width: 100%; margin: 0; padding: 0;">
                                      <tr style="font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; margin: 0; padding: 0;">
                                        <td style="font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; border-top-width: 1px; border-top-color: #eee; border-top-style: solid; margin: 0; padding: 5px 0;" valign="top">Habitación '.$hab.'</td>
                                        <td class="alignright" style="font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; text-align: right; border-top-width: 1px; border-top-color: #eee; border-top-style: solid; margin: 0; padding: 5px 0;" align="right" valign="top">$ '.$costoUnitario.'</td>
                                      </tr>
                                      <tr style="font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; margin: 0; padding: 0;">
                                        <td style="font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; border-top-width: 1px; border-top-color: #eee; border-top-style: solid; margin: 0; padding: 5px 0;" valign="top">Cantidad de noches a pagar</td>
                                        <td class="alignright" style="font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; text-align: right; border-top-width: 1px; border-top-color: #eee; border-top-style: solid; margin: 0; padding: 5px 0;" align="right" valign="top">'.$dias.'</td>
                                      </tr>
                                      <tr class="total" style="font-family:"Helvetica Neu","Helvetic", Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; margin: 0; padding: 0;">
                                        <td class="alignright" width="80%" style="font-family:"Helvetica Neue" "Helvetica", Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; text-align: right; border-top-width: 2px; border-top-color: #333; border-top-style: solid; border-bottom-color: #333; border-bottom-width: 2px; border-bottom-style: solid; font-weight: 700; margin: 0; padding: 5px 0;" align="right" valign="top">Total:</td>
                                        <td class="alignright" style="font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; text-align: right; border-top-width: 2px; border-top-color: #333; border-top-style: solid; border-bottom-color: #333; border-bottom-width: 2px; border-bottom-style: solid; font-weight: 700; margin: 0; padding: 5px 0;" align="right" valign="top">$ '.$costoTotal.' MXN</td>
                                      </tr>
                                    </table>
                                  </td>
                                </tr>
                              </table>
                            </td>
                          </tr>
                          <tr style="font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; margin: 0; padding: 0;">
                            <td class="content-block" style="font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 0 0 20px;" valign="top">
                                Métodos y formas de pago
                            </td>
                          </tr>
                          <tr style="font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; margin: 0; padding: 0;">
                            <td class="content-block" style="font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 0 0 20px;" valign="top">
                                Hotel Mayamed, Avenida Juárez (s/n) esquina con calle 16 de Septiembre. Tecolutla, Veracruz. México
                            </td>
                          </tr>
                        </table>
                      </td>
                    </tr>
                  </table>
                  <div class="footer" style="font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; width: 100%; clear: both; color: #999; margin: 0; padding: 20px;">
                    <table width="100%" style="font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; margin: 0; padding: 0;">
                      <tr style="font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; margin: 0; padding: 0;">
                        <td class="aligncenter content-block" style="font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 12px; vertical-align: top; text-align: center; margin: 0; padding: 0 0 20px;" align="center" valign="top">¿Tienes alguna pregunta? Contáctanos a  <a href="mailto:hola@hotelmayamed.com.mx" style="font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 12px; color: #999; text-decoration: underline; margin: 0; padding: 0;">hola@hotelmayamed.com.mx</a></td>
                      </tr>
                    </table>
                  </div></div>
                </td>
                  <td style="font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 0;" valign="top"></td>
                </tr>
              </table>
            </body>
          </html>
        ';
        // Always set content-type when sending HTML email
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers .= "From: Hotel Mayamed <test@granteocalli.com.mx>";
        if(mail($to,$subject,$message,$headers)) {
          $to = "yeyden_13111992@hotmail.com"; //Correo al cual llegará una copia de la reservación 
          $subject = utf8_decode("Nueva reservación, Hotel Mayamed");
          $message = '
            Se ha realizado una nueva reservación<br>
            <b>Nombre:</b> '.$nom.'<br>
            <b>Correo:</b> '.$ema.'<br>
            <b>Tipo de habitación:</b> '.$hab.'<br>
            <b>Personas:</b> '.$perso.'<br>
            <b>Entrada:</b> '.$checkin.'<br>
            <b>Salida:</b> '.$checkout.'<br>
            <b>Dias:</b> '.$dias.'<br>
            <b>Monto a pagar:</b> $'.$costoTotal.'
          ';
          $headers = "MIME-Version: 1.0" . "\r\n";
          $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
          $headers .= "From: Hotel Mayamed <test@granteocalli.com.mx>";
          if(mail($to,$subject,$message,$headers)) {
            $respuesta = array("respuesta" => 'bien', "res" => 'Registro exitoso');
            echo json_encode($respuesta);
          } else {
            $respuesta = array("respuesta" => 'mal', "res" => 'Envio de segundo correo no posible');
            echo json_encode($respuesta);
          }
        } else {
          $respuesta = array("respuesta" => 'mal', "res" => 'Envio de segundo correo no posible');
          echo json_encode($respuesta);
        }
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
          session_start();
          $_SESSION['sencilla'] = A_A;
          $_SESSION['doble']    = B_A;
          $_SESSION['triple']   = C_A;
          $respuesta = array("respuesta" => 'bien', "habSen" => A_A, "habDob" => B_A, "habTri" => C_A);
          echo json_encode($respuesta);
          break;

        //Temporada baja  
        default:
          session_start();
          $_SESSION['sencilla'] = A_B;
          $_SESSION['doble']    = B_B;
          $_SESSION['triple']   = C_B;
          $respuesta = array("respuesta" => 'bien', "habSen" => A_B, "habDob" => B_B, "habTri" => C_B);
          echo json_encode($respuesta);
          break;
      }
    }
  }

?>