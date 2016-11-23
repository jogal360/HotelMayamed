<?php

  /*
    ARCHIVO: config.php
    CREACIÓN: 17/10/2016
    MODIFICACIÓN: 20/10/2016
    DESCRIPCIÓN: Este archivo contiene las constantes de conexión a la base de datos, costos de habitación y dias de temporada alta.
  */

  # --- --- ¡¡¡ATENCIÓN!!! --- --- #
  /*
    El cambio de la información de este archivo
    provocará que el sitio no funcione de manera óptima.
  */

  #DATOS DE CONEXIÓN
    // 1 = Localhost
    // 2 = Servidor
    /*Este switch lo que hace es que en un solo cambio de dígito, se especifique en que entorno se
    está trabajando*/
    $station = "1";
    switch ($station) {
      case '1':
        //Local
        DEFINE('SERVIDOR','localhost');
        DEFINE('USUARIO','root');
        DEFINE('PASSWORD','1234');
        DEFINE('BASE','hotelmayamed');
        break;

      case '2':
        //Servidor
        DEFINE('SERVIDOR','mysql.hostinger.mx');
        DEFINE('USUARIO','u891522738_hm');
        DEFINE('PASSWORD','123456');
        DEFINE('BASE','u891522738_hm');
        break;
    }

  #PRECIOS DE HABITACIONES
    DEFINE('A_A','150'); //Habitación sencilla - Temp. Alta
    DEFINE('A_B','100'); //Habitación sencilla - Temp. Baja
    DEFINE('B_A','250'); //Habitación doble    - Temp. Alta
    DEFINE('B_B','200'); //Habitación doble    - Temp. Baja
    DEFINE('C_A','350'); //Habitación triple   - Temp. Alta
    DEFINE('C_B','300'); //Habitación triple   - Temp. Baja

  #DATOS DE CORREO
    /*
      La declaración de estos correos está en función de que sean utilizados en archivo del modelo.
    */
    DEFINE('CORREO_HOTEL','yeyden_13111992@hotmail.com');
    DEFINE('CORREO_CONTACTO', 'axelmontes92@gmail.com');

  #DECLARACIÓN DE DÍAS DE TEMPORADA ALTA
  # --- --- ¡¡¡ATENCIÓN!!! --- --- #
  /*
    El método de uso de las fechas están compuestas por la vista del calendario, comenzando en lunes. El funcionamiento esta basado en la posición del día 01 del mes en el calendario.
    Ejemplo: En julio de 2016, el mes comenzó el día viernes, por lo que empezaría a usarse la constante "SEM_VER_VIE1", y a partir de ahi se rellenaría el dia y mes hasta terminar con "SEM_VER_DOM5" porque este mes contempla solamente 5 semanas.

    Existen casos donde un mes contempla 6 semanas, por lo que está declarado en automático. El trabajo del programador es verificar las fechas de temporada alta y rellenarlas, dejando las otras constantes en blanco.
    Ejemplo: Julio de 2017 comienza en sábado por lo que se usaría "SEM_VER_SAB1" y el mes termina en lunes, por lo que al último se usaría "SEM_VER_LUN6". Este mes contempla 6 semanas.

    Las constantes que no se usarán, se deben dejar con un '-' lo cual no afecta el funcionamiento del algoritmo para mostrar precios dependiendo la fecha actual.
  */
  /*DIAS DE SEMANA DE VERANO*///Julio
  DEFINE('SEM_VER_LUN1','-');
  DEFINE('SEM_VER_MAR1','-');
  DEFINE('SEM_VER_MIE1','-');
  DEFINE('SEM_VER_JUE1','-');
  DEFINE('SEM_VER_VIE1','01-07');
  DEFINE('SEM_VER_SAB1','02-07');
  DEFINE('SEM_VER_DOM1','03-07');
  DEFINE('SEM_VER_LUN2','04-07');
  DEFINE('SEM_VER_MAR2','05-07');
  DEFINE('SEM_VER_MIE2','06-07');
  DEFINE('SEM_VER_JUE2','07-07');
  DEFINE('SEM_VER_VIE2','08-07');
  DEFINE('SEM_VER_SAB2','09-07');
  DEFINE('SEM_VER_DOM2','10-07');
  DEFINE('SEM_VER_LUN3','11-07');
  DEFINE('SEM_VER_MAR3','12-07');
  DEFINE('SEM_VER_MIE3','13-07');
  DEFINE('SEM_VER_JUE3','14-07');
  DEFINE('SEM_VER_VIE3','15-07');
  DEFINE('SEM_VER_SAB3','16-07');
  DEFINE('SEM_VER_DOM3','17-07');
  DEFINE('SEM_VER_LUN4','18-07');
  DEFINE('SEM_VER_MAR4','19-07');
  DEFINE('SEM_VER_MIE4','20-07');
  DEFINE('SEM_VER_JUE4','21-07');
  DEFINE('SEM_VER_VIE4','22-07');
  DEFINE('SEM_VER_SAB4','23-07');
  DEFINE('SEM_VER_DOM4','24-07');
  DEFINE('SEM_VER_LUN5','25-07');
  DEFINE('SEM_VER_MAR5','26-07');
  DEFINE('SEM_VER_MIE5','27-07');
  DEFINE('SEM_VER_JUE5','28-07');
  DEFINE('SEM_VER_VIE5','29-07');
  DEFINE('SEM_VER_SAB5','30-07');
  DEFINE('SEM_VER_DOM5','31-07');
  DEFINE('SEM_VER_LUN6','-');
  DEFINE('SEM_VER_MAR6','-');
  DEFINE('SEM_VER_MIE6','-');
  DEFINE('SEM_VER_JUE6','-');
  DEFINE('SEM_VER_VIE6','-');
  DEFINE('SEM_VER_SAB6','-');
  DEFINE('SEM_VER_DOM6','-');

  /*--- DIAS DE SEMANA DE INVIERNO ---*/
  DEFINE('SEM_INV_LUN1','-');
  DEFINE('SEM_INV_MAR1','-');
  DEFINE('SEM_INV_MIE1','-');
  DEFINE('SEM_INV_JUE1','01-12');
  DEFINE('SEM_INV_VIE1','02-12');
  DEFINE('SEM_INV_SAB1','03-12');
  DEFINE('SEM_INV_DOM1','04-12');
  DEFINE('SEM_INV_LUN2','05-12');
  DEFINE('SEM_INV_MAR2','06-12');
  DEFINE('SEM_INV_MIE2','07-12');
  DEFINE('SEM_INV_JUE2','08-12');
  DEFINE('SEM_INV_VIE2','09-12');
  DEFINE('SEM_INV_SAB2','10-12');
  DEFINE('SEM_INV_DOM2','11-12');
  DEFINE('SEM_INV_LUN3','12-12');
  DEFINE('SEM_INV_MAR3','13-12');
  DEFINE('SEM_INV_MIE3','14-12');
  DEFINE('SEM_INV_JUE3','15-12');
  DEFINE('SEM_INV_VIE3','16-12');
  DEFINE('SEM_INV_SAB3','17-12');
  DEFINE('SEM_INV_DOM3','18-12');
  DEFINE('SEM_INV_LUN4','19-12');
  DEFINE('SEM_INV_MAR4','20-12');
  DEFINE('SEM_INV_MIE4','21-12');
  DEFINE('SEM_INV_JUE4','22-12');
  DEFINE('SEM_INV_VIE4','23-12');
  DEFINE('SEM_INV_SAB4','24-12');
  DEFINE('SEM_INV_DOM4','25-12');
  DEFINE('SEM_INV_LUN5','26-12');
  DEFINE('SEM_INV_MAR5','27-12');
  DEFINE('SEM_INV_MIE5','28-12');
  DEFINE('SEM_INV_JUE5','29-12');
  DEFINE('SEM_INV_VIE5','30-12');
  DEFINE('SEM_INV_SAB5','31-12');
  DEFINE('SEM_INV_DOM5','-');
  DEFINE('SEM_INV_LUN6','-');
  DEFINE('SEM_INV_MAR6','-');
  DEFINE('SEM_INV_MIE6','-');
  DEFINE('SEM_INV_JUE6','-');
  DEFINE('SEM_INV_VIE6','-');
  DEFINE('SEM_INV_SAB6','-');
  DEFINE('SEM_INV_DOM6','-');

?>