<?php

  /*
    ARCHIVO: modeloMayamed.php
    CREACIÓN: 17/10/16
    MODIFICACIÓN: 08/11/16
    DESCRIPCIÓN: Modelo principal del sitio, donde se procesa lo que el sitio necesita
  */

  #Se hace vínculo con el archivo de conexión
  require_once("../config/conexion.php");

  class ModeloMayamed extends Conexion {
  	/*Atributos*/
  	private $dbs;
  	private $mysqli;
    private $datos;

    /*Métodos*/
    #Método constructor
    public function __construct() {
    	$this->dbs = Conexion::getInstance();
    	$this->mysqli = $this->dbs->getConnection();
    }

    #Método para cerrar la conexión
    public function cerrar() {
    	$this->mysqli->close();
    }
    
    #Método para registrar reservaciones
    public function insertar($datos) {
      $this->datos = $datos;
      date_default_timezone_set("America/Mexico_City"); //Configuramos date() para México
      header('Content-Type: text/html; charset=UTF-8'); //Usamos UTF-8
      $fecha = date("d-m-Y"); //Obtención de la fecha actual.
      $hora = date("H:i");  //Obtención de la hora actual.
      $sql = "INSERT INTO t_reservacion VALUES (null,'$this->datos[0]','$this->datos[1]','$this->datos[2]','$this->datos[5]','$this->datos[3]','$this->datos[4]','$fecha','$hora')"; //Sentencia SQL para registrar la reservación
      $res = $this->mysqli->query($sql);
      if($res) { //Si el registro ha sido exitoso entonces se procede al envio de los correos.
        //Funciones para cambiar diagonal por guion intermedio
        $fecI = str_replace("/", "-", $this->datos[3]);
        $fecF = str_replace("/", "-", $this->datos[4]);
        //Funcion para sacar los dias que se hospedará el cliente
        $dias = (strtotime($fecI)-strtotime($fecF))/86400;
        $dias   = abs($dias); $dias = floor($dias);
        //Abrimos una sesión y obtenemos el precio de la habitación (viene de la funcion de pŕecios)
        session_start();
        switch ($this->datos[2]) {
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
        //Generación del costo total.
        $costoTotal = ($dias*$costoUnitario);
        //Generación del correo del cliete
        $to = $this->datos[1];
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
                              <h5>Entre los dias '.$this->datos[3].' y '.$this->datos[4].' te sentirás como en casa.</h5>
                            </td>
                          </tr>
                          <tr style="font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; margin: 0; padding: 0;">
                            <td class="content-block" style="font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 0 0 10px;" valign="top">
                              <table class="invoice" style="font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; text-align: left; width: 100% !important; margin: 40px auto; padding: 0;">
                                <tr style="font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; margin: 0; padding: 0;">
                                  <td style="font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 5px 0;" valign="top">
                                    <b>Cliente:</b> '.$this->datos[0].'<br style="font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; margin: 0; padding: 0;" />
                                    <b>Correo:</b> '.$this->datos[1].'<br style="font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; margin: 0; padding: 0;" />
                                    <b>Fecha:</b> '.$fecha.'<br style="font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; margin: 0; padding: 0;" />
                                    <b>Personas:</b> '.$this->datos[5].'
                                  </td>
                                </tr>
                                <tr style="font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; margin: 0; padding: 0;">
                                  <td style="font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 5px 0;" valign="top">
                                    <table class="invoice-items" cellpadding="0" cellspacing="0" style="font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; width: 100%; margin: 0; padding: 0;">
                                      <tr style="font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; margin: 0; padding: 0;">
                                        <td style="font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; border-top-width: 1px; border-top-color: #eee; border-top-style: solid; margin: 0; padding: 5px 0;" valign="top">Habitación '.$this->datos[2].'</td>
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
                                Forma de pago: Pago en efectivo al arribar al hotel.
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
        if(mail($to,$subject,$message,$headers)) { //Si se envia, entonces pasamos al correo del lic
          $to = CORREO_HOTEL; //Correo al cual llegará una copia de la reservación 
          $subject = utf8_decode("Nueva reservación, Hotel Mayamed");
          $message = '
            Se ha realizado una nueva reservación el día '.$fecha.' a las '.$hora.' horas<br>
            <b>Nombre:</b> '.$this->datos[0].'<br>
            <b>Correo:</b> '.$this->datos[1].'<br>
            <b>Tipo de habitación:</b> '.$this->datos[2].'<br>
            <b>Personas:</b> '.$this->datos[5].'<br>
            <b>Entrada:</b> '.$this->datos[3].'<br>
            <b>Salida:</b> '.$this->datos[4].'<br>
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
      $verano = array(SEM_VER_LUN1."-".$año, SEM_VER_MAR1."-".$año, SEM_VER_MIE1."-".$año, SEM_VER_JUE1."-".$año, SEM_VER_VIE1."-".$año, SEM_VER_SAB1."-".$año, SEM_VER_DOM1."-".$año, SEM_VER_LUN2."-".$año, SEM_VER_MAR2."-".$año, SEM_VER_MIE2."-".$año, SEM_VER_JUE2."-".$año, SEM_VER_VIE2."-".$año, SEM_VER_SAB2."-".$año, SEM_VER_DOM2."-".$año, SEM_VER_LUN3."-".$año, SEM_VER_MAR3."-".$año, SEM_VER_MIE3."-".$año, SEM_VER_JUE3."-".$año, SEM_VER_VIE3."-".$año, SEM_VER_SAB3."-".$año, SEM_VER_DOM3."-".$año, SEM_VER_LUN4."-".$año, SEM_VER_MAR4."-".$año, SEM_VER_MIE4."-".$año, SEM_VER_JUE4."-".$año, SEM_VER_VIE4."-".$año, SEM_VER_SAB4."-".$año, SEM_VER_DOM4."-".$año, SEM_VER_LUN5."-".$año, SEM_VER_MAR5."-".$año, SEM_VER_MIE5."-".$año, SEM_VER_JUE5."-".$año, SEM_VER_VIE5."-".$año, SEM_VER_SAB5."-".$año, SEM_VER_DOM5."-".$año, SEM_VER_LUN6."-".$año, SEM_VER_MAR6."-".$año, SEM_VER_MIE6."-".$año, SEM_VER_JUE6."-".$año, SEM_VER_VIE6."-".$año, SEM_VER_SAB6."-".$año, SEM_VER_DOM6."-".$año);

      list($semanaVeranoLun1, $semanaVeranoMar1, $semanaVeranoMie1, $semanaVeranoJue1, $semanaVeranoVie1,  $semanaVeranoSab1, $semanaVeranoDom1, $semanaVeranoLun2, $semanaVeranoMar2, $semanaVeranoMie2, $semanaVeranoJue2, $semanaVeranoVie2, $semanaVeranoSab2, $semanaVeranoDom2, $semanaVeranoLun3, $semanaVeranoMar3, $semanaVeranoMie3, $semanaVeranoJue3, $semanaVeranoVie3, $semanaVeranoSab3, $semanaVeranoDom3, $semanaVeranoLun4, $semanaVeranoMar4, $semanaVeranoMie4, $semanaVeranoJue4, $semanaVeranoVie4, $semanaVeranoSab4, $semanaVeranoDom4, $semanaVeranoLun5, $semanaVeranoMar5, $semanaVeranoMie5, $semanaVeranoJue5, $semanaVeranoVie5, $semanaVeranoSab5, $semanaVeranoDom5, $semanaVeranoLun6, $semanaVeranoMar6, $semanaVeranoMie6, $semanaVeranoJue6, $semanaVeranoVie6, $semanaVeranoSab6, $semanaVeranoDom6) = $verano;
      /*---*/

      /*SEMANA DE INVIERNO*/
      $invierno = array(SEM_INV_LUN1."-".$año, SEM_INV_MAR1."-".$año, SEM_INV_MIE1."-".$año, SEM_INV_JUE1."-".$año, SEM_INV_VIE1."-".$año, SEM_INV_SAB1."-".$año, SEM_INV_DOM1."-".$año, SEM_INV_LUN2."-".$año, SEM_INV_MAR2."-".$año, SEM_INV_MIE2."-".$año, SEM_INV_JUE2."-".$año, SEM_INV_VIE2."-".$año, SEM_INV_SAB2."-".$año, SEM_INV_DOM2."-".$año, SEM_INV_LUN3."-".$año, SEM_INV_MAR3."-".$año, SEM_INV_MIE3."-".$año, SEM_INV_JUE3."-".$año, SEM_INV_VIE3."-".$año, SEM_INV_SAB3."-".$año, SEM_INV_DOM3."-".$año, SEM_INV_LUN4."-".$año, SEM_INV_MAR4."-".$año, SEM_INV_MIE4."-".$año, SEM_INV_JUE4."-".$año, SEM_INV_VIE4."-".$año, SEM_INV_SAB4."-".$año, SEM_INV_DOM4."-".$año, SEM_INV_LUN5."-".$año, SEM_INV_MAR5."-".$año, SEM_INV_MIE5."-".$año, SEM_INV_JUE5."-".$año, SEM_INV_VIE5."-".$año, SEM_INV_SAB5."-".$año, SEM_INV_DOM5."-".$año, SEM_INV_LUN6."-".$año, SEM_INV_MAR6."-".$año, SEM_INV_MIE6."-".$año, SEM_INV_JUE6."-".$año, SEM_INV_VIE6."-".$año, SEM_INV_SAB6."-".$año, SEM_INV_DOM6."-".$año);

      list($semanaInviernoLun1, $semanaInviernoMar1, $semanaInviernoMie1, $semanaInviernoJue1, $semanaInviernoVie1, $semanaInviernoSab1, $semanaInviernoDom1, $semanaInviernoLun2, $semanaInviernoMar2, $semanaInviernoMie2, $semanaInviernoJue2, $semanaInviernoVie2, $semanaInviernoSab2, $semanaInviernoDom2, $semanaInviernoLun3, $semanaInviernoMar3, $semanaInviernoMie3, $semanaInviernoJue3, $semanaInviernoVie3, $semanaInviernoSab3, $semanaInviernoDom3, $semanaInviernoLun4, $semanaInviernoMar4, $semanaInviernoMie4, $semanaInviernoJue4, $semanaInviernoVie4, $semanaInviernoSab4, $semanaInviernoDom4, $semanaInviernoLun5, $semanaInviernoMar5, $semanaInviernoMie5, $semanaInviernoJue5, $semanaInviernoVie5, $semanaInviernoSab5, $semanaInviernoDom5, $semanaInviernoLun6, $semanaInviernoMar6, $semanaInviernoMie6, $semanaInviernoJue6, $semanaInviernoVie6, $semanaInviernoSab6, $semanaInviernoDom6) = $invierno;
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
        case $semanaVeranoLun1:
        case $semanaVeranoMar1:
        case $semanaVeranoMie1:
        case $semanaVeranoJue1:
        case $semanaVeranoVie1:
        case $semanaVeranoSab1:
        case $semanaVeranoDom1:
        case $semanaVeranoLun2:
        case $semanaVeranoMar2:
        case $semanaVeranoMie2:
        case $semanaVeranoJue2:
        case $semanaVeranoVie2:
        case $semanaVeranoSab2:
        case $semanaVeranoDom2:
        case $semanaVeranoLun3:
        case $semanaVeranoMar3:
        case $semanaVeranoMie3:
        case $semanaVeranoJue3:
        case $semanaVeranoVie3:
        case $semanaVeranoSab3:
        case $semanaVeranoDom3:
        case $semanaVeranoLun4:
        case $semanaVeranoMar4:
        case $semanaVeranoMie4:
        case $semanaVeranoJue3:
        case $semanaVeranoVie4:
        case $semanaVeranoSab4:
        case $semanaVeranoDom4:
        case $semanaVeranoLun5:
        case $semanaVeranoMar5:
        case $semanaVeranoMie5:
        case $semanaVeranoJue5:
        case $semanaVeranoVie5:
        case $semanaVeranoSab5:
        case $semanaVeranoDom5:
        case $semanaVeranoLun6:
        case $semanaVeranoMar6:
        case $semanaVeranoMie6:
        case $semanaVeranoJue6:
        case $semanaVeranoVie6:
        case $semanaVeranoSab6:
        case $semanaVeranoDom6:

        //Invierno
        case $semanaInviernoLun1:
        case $semanaInviernoMar1:
        case $semanaInviernoMie1:
        case $semanaInviernoJue1:
        case $semanaInviernoVie1:
        case $semanaInviernoSab1:
        case $semanaInviernoDom1:
        case $semanaInviernoLun2:
        case $semanaInviernoMar2:
        case $semanaInviernoMie2:
        case $semanaInviernoJue2: 
        case $semanaInviernoVie2:
        case $semanaInviernoSab2:
        case $semanaInviernoDom2:
        case $semanaInviernoLun3:
        case $semanaInviernoMar3:
        case $semanaInviernoMie3:
        case $semanaInviernoJue3:
        case $semanaInviernoVie3:
        case $semanaInviernoSab3:
        case $semanaInviernoDom3:
        case $semanaInviernoLun4:
        case $semanaInviernoMar4:
        case $semanaInviernoMie4:
        case $semanaInviernoJue4:
        case $semanaInviernoVie4:
        case $semanaInviernoSab4:
        case $semanaInviernoDom4:
        case $semanaInviernoLun5:
        case $semanaInviernoMar5:
        case $semanaInviernoMie5:
        case $semanaInviernoJue5:
        case $semanaInviernoVie5:
        case $semanaInviernoSab5:
        case $semanaInviernoDom5:
        case $semanaInviernoLun6:
        case $semanaInviernoMar6:
        case $semanaInviernoMie6:
        case $semanaInviernoJue6:
        case $semanaInviernoVie6:
        case $semanaInviernoSab6:
        case $semanaInviernoDom6:
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

    #Método para enviar correo por medio de contacto
    public function enviarCorreoContacto($datos) {
      $this->datos = $datos;
      $to = CORREO_CONTACTO; //Correo al cual llegará
      $subject = utf8_decode("Nuevo mensaje de contacto, Hotel Mayamed");
      $message = '
        Se ha recibido un nuevo mensaje de contacto<br>
        <b>Nombre:</b> '.$this->datos[0].'<br>
        <b>Correo:</b> '.$this->datos[1].'<br>
        <b>Asunto:</b> '.$this->datos[2].'<br>
        <b>Mensaje:</b> '.$this->datos[3].'<br>
      ';
      $headers = "MIME-Version: 1.0" . "\r\n";
      $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
      $headers .= "From: Hotel Mayamed <test@granteocalli.com.mx>";
      if(mail($to,$subject,$message,$headers)) {
        $respuesta = array("respuesta" => 'bien', "res" => 'Mensaje enviado!');
        echo json_encode($respuesta);
      } else {
        $respuesta = array("respuesta" => 'mal', "res" => 'Envio de segundo correo no posible');
        echo json_encode($respuesta);
      }
    }
  }

?>