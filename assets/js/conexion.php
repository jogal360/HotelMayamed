<?php

  //Llamamos el archivo config.php
  include('config.php');

  class Conexion {
  	#Atributos
  	private $_connection;
  	private static $_instance; 
  	private $_host     = SERVIDOR;
  	private $_username = USUARIO;
  	private $_password = PASSWORD;
  	private $_database = BASE;

    #Método para generar instancia (Si no hay instancia, crea una; sino retorna la que ya existente).
  	public static function getInstance() {
      if(!self::$_instance) { 
        self::$_instance = new self();
      }
      return self::$_instance;
    }

    #Método constructor
    private function __construct() {
      $this->_connection = new mysqli($this->_host, $this->_username, 
        $this->_password, $this->_database);
      $this->_connection->query("SET NAMES 'utf8'");
  
      #Manejo de errores
      if(mysqli_connect_error()) {
        trigger_error("Fallo la conexión a mysql: " . mysql_connect_error(),
          E_USER_ERROR);
      }
    }

    #Método para evitar la clonación de la conexión
    private function __clone() { }

    #Método para obtener la conexión mysqli
    public function getConnection() {
      return $this->_connection;
    }
  }

  $db = Conexion::getInstance();
  $mysqli = $db->getConnection();
  $sql = "SELECT * FROM t_reservacion";
  $res = $mysqli->query($sql);
  while($fila = $res->fetch_assoc()) {
    echo $fila["nom"];
  }



?>