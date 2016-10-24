<?php

  /*
    Archivo: config.php
    CREACIÓN: 17/10/2016
    MODIFICACIÓN: 20/10/2016
    DESCRIPCIÓN: Este archivo contiene las variables de conexión a la base de datos
  */

  # --- --- ¡¡¡ATENCIÓN!!! --- --- #
  /*
    El cambio de la información de este archivo
    provocará que el sitio no funcione de manera optima.
  */

  /*Datos de conexión*/
  DEFINE('SERVIDOR','localhost');
  DEFINE('USUARIO','root');
  DEFINE('PASSWORD','');
  DEFINE('BASE','hotelmayamed');

  /*PRECIOS DE HABITACIONES*/
  DEFINE('A_A','150'); //Habitación sencilla - Temp. Alta
  DEFINE('A_B','100'); //Habitación sencilla - Temp. Baja
  DEFINE('B_A','250'); //Habitación doble - Temp. Alta
  DEFINE('B_B','200'); //Habitación doble - Temp. Baja
  DEFINE('C_A','350'); //Habitación triple - Temp. Alta
  DEFINE('C_B','300'); //Habitación triple - Temp. Baja

  /*DIAS DE SEMANA DE VERANO*/

  /*DIAS DE SEMANA DE INVIERNO*/
  DEFINE('SEM_INV_DOM1','18-12');
  DEFINE('SEM_INV_LUN','19-12');
  DEFINE('SEM_INV_MAR','20-12');
  DEFINE('SEM_INV_MIE','21-12');
  DEFINE('SEM_INV_JUE','22-12');
  DEFINE('SEM_INV_VIE','23-12');
  DEFINE('SEM_INV_SAB','24-12');
  DEFINE('SEM_INV_DOM2','25-12');

?>