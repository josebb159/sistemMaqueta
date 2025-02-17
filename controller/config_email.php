<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php'; // Cargar PHPMailer desde Composer


/**
 * Función para enviar un correo con PHPMailer.
 * 
 * @param array $config Configuración del servidor SMTP (host, usuario, contraseña, puerto, etc.).
 * @param string $destinatario Correo electrónico del destinatario.
 * @param string $asunto Asunto del correo.
 * @param string $contenido Contenido del correo en formato HTML.
 * 
 * @return bool Devuelve `true` si se envió correctamente, de lo contrario `false`.
 */


 //$n_configuracion  = new configuracion();
 


function enviarCorreo($config, $destinatario, $asunto, $contenido) {
    $mail = new PHPMailer(true);



    try {
        // Configuración del servidor SMTP
        $mail->isSMTP();
        $mail->Host = $config['host'];
        $mail->SMTPAuth = true;
        $mail->Username = $config['username'];
        $mail->Password = $config['password'];
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port = $config['port'];

        // Configuración del remitente y destinatario
        $mail->setFrom($config['from_email'], $config['from_name']);
        $mail->addAddress($destinatario);

        $mail->SMTPDebug = 0;

        // Contenido del correo
        $mail->isHTML(true);
        $mail->Subject = $asunto;
        $mail->Body = $contenido;

        // Enviar correo
        $mail->send();
        return true;
    } catch (Exception $e) {
        error_log("Error al enviar correo: " . $mail->ErrorInfo);
        return false;
    }
}

/**
 * Función para generar el contenido del correo en base al estado del producto.
 * 
 * @param string $estado Estado del producto ('vendido' o 'entregado').
 * @param array $datos Datos del producto (nombre, fecha de venta, fecha de entrega, etc.).
 * 
 * @return string Contenido HTML del correo.
 */
function generarTemplate($estado, $datos) {

    if ($estado === 'vendido') {
        $template = "
        <h1>Producto Vendido</h1>
        <p>¡Gracias por tu compra!</p>
        <p><strong>Productos:</strong> {$datos['nombre']}</p>
        <p><strong>Fecha de venta:</strong> {$datos['fecha_vendido']}</p>
        ";
    } elseif ($estado === 'entregado') {
        $template = "
        <h1>Producto Entregado</h1>
        <p>Tu producto ha sido entregado exitosamente.</p>
        <p><strong>Producto:</strong> {$datos['nombre']}</p>
        <p><strong>Fecha de venta:</strong> {$datos['fecha_vendido']}</p>
        <p><strong>Fecha de entrega:</strong> {$datos['fecha_entregado']}</p>
        ";
    } else {
        $template = "<p>Estado desconocido para el producto.</p>";
    }

    return $template;
}




