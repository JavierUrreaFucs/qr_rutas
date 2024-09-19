<?php

require_once("../model/conexion.php");

class Reportes_admin {

  private $con;
	private $conex;
	private $resultado;
	private $fecha;

	function __construct()
	{
		$this->con = new Conexion();
		$this->conex = $this->con->conn();
		$this->resultado = array();
		$this->fecha = date("Y-m-d H:i:s");
	}

  // Descargar reporte 1
  public function reporte_1($fechaInicio, $fechaFin, $tipo_usuario, $horarioFiltro) {
		// Verificar si se proporciona un horario
		if ((!empty($fechaInicio)) && (!empty($fechaFin)) && (!empty($tipo_usuario)) && (!empty($horarioFiltro))) {
      $fecha1 = date("Y-m-d", strtotime($fechaInicio));
      $fecha2 = date("Y-m-d", strtotime($fechaFin));

			$query = "SELECT * FROM reservas a INNER JOIN rutas b ON b.id_rutas = a.rutas_id_rutas WHERE (DATE(a.fecha_solicitud) BETWEEN ? AND ?) AND b.horario = ? AND a.tipo_login_nombre = ?";
			$stmt = $this->conex->prepare($query);
			$stmt->bind_param('ssss', $fecha1, $fecha2, $horarioFiltro, $tipo_usuario);
			$stmt->execute();

			$result = $stmt->get_result();

			// Verificar si la consulta fue exitosa
			if ($result && $result->num_rows > 0) {
				$reservas = $result->fetch_all(MYSQLI_ASSOC);
				$result->close();
				return $reservas;
			} else {
				// No se encontraron reservas con el horario y las fechas especificados
				return [];
			}
		} else if((!empty($fechaInicio)) && (!empty($fechaFin)) && (!empty($tipo_usuario))) {
			// Si no se proporciona un horario, realizar el filtrado por fechas y tipo de usuario
			$query = "SELECT * FROM reservas a INNER JOIN rutas b ON b.id_rutas = a.rutas_id_rutas WHERE (DATE(a.fecha_solicitud) BETWEEN ? AND ?) AND a.tipo_login_nombre = ?";
			$stmt = $this->conex->prepare($query);
			$stmt->bind_param('sss', $fechaInicio, $fechaFin, $tipo_usuario);
			$stmt->execute();

			$result = $stmt->get_result();

			// Verificar si la consulta fue exitosa
			if ($result && $result->num_rows > 0) {
				$reservas = $result->fetch_all(MYSQLI_ASSOC);
				$result->close();
				return $reservas;
			} else {
				// No se encontraron reservas con las fechas especificadas
				return [];
			}
		} else if((!empty($fechaInicio)) && (!empty($fechaFin)) && (!empty($horarioFiltro))) {
			// Si no se proporciona un tipo de usuario, realizar el filtrado solo por fechas y horario
			$query = "SELECT * FROM reservas a INNER JOIN rutas b ON b.id_rutas = a.rutas_id_rutas WHERE (DATE(a.fecha_solicitud) BETWEEN ? AND ?) AND a.horario_ruta = ?";
			$stmt = $this->conex->prepare($query);
			$stmt->bind_param('sss', $fechaInicio, $fechaFin, $horarioFiltro);
			$stmt->execute();

			$result = $stmt->get_result();

			// Verificar si la consulta fue exitosa
			if ($result && $result->num_rows > 0) {
				$reservas = $result->fetch_all(MYSQLI_ASSOC);
				$result->close();
				return $reservas;
			} else {
				// No se encontraron reservas con las fechas especificadas
				return [];
			}
		
		}	else {
      // Si no se proporciona un horario y un tipo de usuario, realizar el filtrado solo por fechas
			$query = "SELECT * FROM reservas a INNER JOIN rutas b ON b.id_rutas = a.rutas_id_rutas WHERE (DATE(a.fecha_solicitud) BETWEEN ? AND ?)";
			$stmt = $this->conex->prepare($query);
			$stmt->bind_param('ss', $fechaInicio, $fechaFin);
			$stmt->execute();

			$result = $stmt->get_result();

			// Verificar si la consulta fue exitosa
			if ($result && $result->num_rows > 0) {
				$reservas = $result->fetch_all(MYSQLI_ASSOC);
				$result->close();
				return $reservas;
			} else {
				// No se encontraron reservas con las fechas especificadas
				return [];
			}
    }
	}

}