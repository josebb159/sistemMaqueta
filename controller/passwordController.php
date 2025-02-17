<?php
ini_set('session.save_path', realpath(dirname($_SERVER['DOCUMENT_ROOT']) . '/tmp'));
require_once '../framework/phpmailer/para_pruebas.php';
include '../model/myaccount.php';
function randomPassword($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[random_int(0, $charactersLength - 1)];
    }
    return $randomString;
}
if ($_POST['op'] == 'password_recovery') {
    $email = $_POST['email'];
    $myaccount = new myaccount();
    $account = $myaccount->obtener_datos_correo($email);
    // Asume valores para $guia y $nombre ya que no se proporcionan en el ejemplo
    $nombre = $account['nombre']; // Debes definir este valor
    $new_password = randomPassword();
    $myaccount->cambiar_contrasena($account['id'], $new_password);
    try {
        emails($email, $new_password, $nombre);
        echo "Message has been sent"; // Respuesta de éxito
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}"; // Manejo de errores
    }
}