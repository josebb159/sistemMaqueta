<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php'; // Cargar PHPMailer desde Composer
if(isset($conect)){if($conect==1){}else{include 'db.php';$conect =1;}}else{include 'db.php';$conect =1;}
class Correo {
    private $mail;
    private $config;
    public $conexion;

    public function __construct() {
        $this->conexion = new Conexion();
        $this->config = $this->cargarConfiguracion();
        $this->mail = new PHPMailer(true);
        $this->configurarServidor();
    }

    private function cargarConfiguracion() {
        $sql = "SELECT descripcion, dato FROM configuracion WHERE estado = 1";
        $reg = $this->conexion->prepare($sql);
        $reg->execute();
        $consulta = $reg->fetchAll(PDO::FETCH_ASSOC);
        
        if (!$consulta) {
            error_log("Error: No se pudo obtener la configuración.");
            return [];
        }

        $config = [];
        foreach ($consulta as $fila) {
            $config[$fila['descripcion']] = $fila['dato'];
        }

        return [
            'host' => $config['smtp'] ?? 'smtp.default.com',
            'username' => $config['correo'] ?? 'default@email.com',
            'password' => $config['contrasena'] ?? '',
            'port' => $config['port'] ?? 587,
            'from_email' => $config['correo'] ?? 'default@email.com',
            'from_name' => 'Sistema de Notificaciones'
        ];
    }


    private function configurarServidor() {
        try {
            $this->mail->isSMTP();
            $this->mail->Host = $this->config['host'];
            $this->mail->SMTPAuth = true;
            $this->mail->Username = $this->config['username'];
            $this->mail->Password = $this->config['password'];
            $this->mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $this->mail->Port = $this->config['port'];
            $this->mail->setFrom($this->config['from_email'], $this->config['from_name']);
            $this->mail->SMTPDebug = 0;
        } catch (Exception $e) {
            error_log("Error en configuración SMTP: " . $e->getMessage());
        }
    }


    public function enviarCorreo($destinatario, $asunto, $contenido) {
        try {
            $this->mail->clearAddresses(); 
            $this->mail->addAddress($destinatario);
            $this->mail->isHTML(true);
            $this->mail->Subject = $asunto;
            $this->mail->Body = $contenido;

            $this->mail->send();
            return true;
        } catch (Exception $e) {
            error_log("Error al enviar correo: " . $this->mail->ErrorInfo);
            return false;
        }
    }

    public static function generarTemplate($tipo, $datos) {
        $ruta = __DIR__ . "/maqueta_email/" . $tipo . ".php";
        
        if (file_exists($ruta)) {
            ob_start();
            include $ruta;
            return ob_get_clean();
        } else {
            return "<p>Plantilla no encontrada.</p>";
        }
    }
}