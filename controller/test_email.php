<?php
require '../vendor/autoload.php'; // Cargar PHPMailer desde Composer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Configuración inicial
define('SMTP_HOST', $_POST['smtp']);
define('SMTP_PORT', $_POST['port']); // Cambiar a 587 si se usa STARTTLS
define('SMTP_USERNAME', $_POST['correo']);
define('SMTP_PASSWORD', $_POST['contrasena']);
define('FROM_EMAIL', $_POST['correo']);
define('FROM_NAME', 'GEC');
define('TO_EMAIL', 'desarrollojose123@gmail.com');

define('EMAIL_SUBJECT', 'Confirmación de Compra - Producto Vendido');
define('EMAIL_BODY', '<h1>Gracias por tu compra</h1><p>Este es el detalle del producto vendido.</p>');

function enviarCorreoPrueba() {
    $mail = new PHPMailer(true);

    try {
        // Configuración del servidor SMTP
        $mail->isSMTP();
        $mail->Host = SMTP_HOST;
        $mail->SMTPAuth = true;
        $mail->Username = SMTP_USERNAME;
        $mail->Password = SMTP_PASSWORD;
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; // Cambiar a ENCRYPTION_STARTTLS si usas 587
        $mail->Port = SMTP_PORT;

        // Mostrar depuración detallada (opcional)
        $mail->SMTPDebug = 0; // Cambia a 2 si necesitas ver detalles de depuración
        $mail->Debugoutput = 'html';

        // Configuración del remitente y destinatario
        $mail->setFrom(FROM_EMAIL, FROM_NAME);
        $mail->addAddress(TO_EMAIL);

        // Contenido del correo
        $mail->isHTML(true);
        $mail->Subject = EMAIL_SUBJECT;
        $mail->Body = EMAIL_BODY;

        // Enviar correo
        if ($mail->send()) {
            return 1; // Retorna 1 si todo salió bien
        } else {
            return 0; // Retorna 0 si hubo algún problema
        }
    } catch (Exception $e) {
        return 0; // Retorna 0 si ocurre un error
    }
}

// Llamar a la función y mostrar el resultado
$resultado = enviarCorreoPrueba();
echo $resultado; // 1 para éxito, 0 para fallo
