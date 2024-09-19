<?php

class Conexion {

	private $hostname;
	private $username;
	private $password;
	private $database;
	
	function __construct() {

		$this->hostname = "localhost";
		$this->username = "root";
		//$this->password = "corei3";
		$this->password = "";
		//$this->password = "K3nw0rth2017+.";
		$this->database = "rutas_2";
	}

	function conn() {

		$conexion = mysqli_connect($this->hostname, $this->username, $this->password, $this->database) or die('No pudo crear una conexi&oacute;n a la Base de datos ');

		/*if ($conexion) {
			    echo "conexion exitosa!";
			} else {
			    echo "No hay conexion ";

		}*/

		return $conexion;
	}
}

?>