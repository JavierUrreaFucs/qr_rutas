<?php

require_once("../model/conexion.php");
require_once("phpmailer/Exception.php");
require_once("phpmailer/PHPMailer.php");
require_once("phpmailer/SMTP.php");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class CorreoManager {

  private $con;
  public function __construct() {
    $this->con = new Conexion();
  }
  // Generar Reserva
  public function enviarCorreoReserva($nombre, $correo, $horario, $destino, $reservaPago) {

		$hora = "";

		if ($horario == 1) {
			$hora = "11:20 a.m";
		} else if ($horario == 2) {
			$hora = "12:30 p.m";
		} else if ($horario == 3) {
			$hora = "12:00 m";
		} else {
			$hora = "1:00 p.m";
		}

    try {
      $mail = new PHPMailer(true);
      $mail->SMTPDebug = 0; // Habilita la salida de depuración detallada 
      $mail->isSMTP(); // Configure el remitente para usar SMTP 
      $mail->Host = 'smtp.gmail.com'; // Especifique los servidores SMTP principales y de respaldo 
      $mail->SMTPAuth = true; // Habilitar autenticación SMTP
      $mail->Username = 'jhurrea@fucsalud.edu.co'; // SMTP username
      $mail->Password = 'oddj ugog ocax rfdz'; // Habilitar autenticación SMTP    
      $mail->SMTPSecure = 'tls'; // Habilita el cifrado TLS, `ssl` también aceptado 
      $mail->Port = 587; // Puerto TCP para conectarse        
      $mail->setFrom('jhurrea@fucsalud.edu.co');
      $mail->addAddress($correo);
      $mail->isHTML(true); // Establecer el formato de correo electrónico en HTML 
      $mail->CharSet = 'UTF-8';
      $mail->Subject = 'Nueva Reserva Ruta FUCS';
      $fecha = date('d-m-Y');
      $body = '<p>Cordial saludo '.$nombre.'</p><p>Gracias por utilizar el aplicativo de rutas FUCS para su movilización. Le confirmamos que hemos reservado un cupo de asiento para en el siguiente Horario:</p><ul><li>Destino: '.$destino.'</li><li>Fecha: '.$fecha.'</li><li>Hora de salida: '.$hora.'</li><li>Estado: '.$reservaPago.'</li></ul><p>Por favor, Recuerde llegar con al menos 15 minutos de anticipación al momento del abordaje.</p><p>Esperamos que disfrutes de tu viaje.</p><br><p>Cordialmente,</p><br><p>[nombre y firma del remitente]</p><br><p><strong>¡Por favor, NO responder este mensaje!</strong></p>';
      $mail->Body = $body;
      $mail->send();
      // Cerrar la conexión a la base de datos si es necesario
      // $this->con->close();
      return true;
    } catch (Exception $e) {
      // Registrar el error en un archivo de registro o notificar al administrador
      error_log("Error al enviar el correo: ".$e->getMessage(), 0);
      return false;
    }
  }
}

?>
