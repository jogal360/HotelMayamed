<?php

  /*
    ARCHIVO: conexion.php
    CREACIÓN: 17/10/16
    MODIFICACIÓN: 08/11/16
    DESCRIPCIÓN: Esta clase conecta con la base de datos
  */

  //Llamamos el archivo config.php
  include('config.php');

  class Conexion {
  	#Atributos
  	private $_connection;      //Variable de conexion
  	private static $_instance; //Variable de la instancia a usar
  	private $_host;            //Variable del servidor
  	private $_username;        //Variable del usuario
  	private $_password;        //Variable de la contraseña
  	private $_database;        //Variable de la base de datos

    #Método constructor
    private function __construct() {
      $this->_host = SERVIDOR;
      $this->_username = USUARIO;
      $this->_password = PASSWORD;
      $this->_database = BASE;
      $this->_connection = new mysqli($this->_host, $this->_username, 
        $this->_password, $this->_database);
      $this->_connection->query("SET NAMES 'utf8'");
  
      #Manejo de errores
      if(mysqli_connect_error()) {
        trigger_error("Fallo la conexión a mysql: " . mysql_connect_error(),
          E_USER_ERROR);
      }
    }

    #Método para generar instancia (Si no hay instancia, crea una; sino retorna la que ya existente).
    public static function getInstance() {
      if(!self::$_instance) { 
        self::$_instance = new self();
      }
      return self::$_instance;
    }

    #Método para evitar la clonación de la conexión (Patrón Singleton)
    private function __clone() { }

    #Método para obtener la conexión mysqli
    public function getConnection() {
      return $this->_connection;
    }
  }

  /*$db = Conexion::getInstance();
  $mysqli = $db->getConnection();*/


?>