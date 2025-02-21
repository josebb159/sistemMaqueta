<?php 
$debug = true;
include '../model/error.php';


// Habilita la visualización de errores para pruebas (desactiva en producción)
ini_set('display_errors', $debug);
ini_set('display_startup_errors', $debug);
error_reporting(E_ALL);

// Manejo de errores personalizados
set_error_handler(function ($errno, $errstr, $errfile, $errline) {
    throw new ErrorException($errstr, $errno, 0, $errfile, $errline);
});

// Manejo de excepciones no capturadas
set_exception_handler(function ($exception) {
    http_response_code(500);

      // Registro de error
      if (class_exists('error')) {
        $error_log = new error_log();
        $error_data = [
            'mensaje' => $exception->getMessage(),
            'archivo' => $exception->getFile(),
            'linea' => $exception->getLine(),
            'traza' => $exception->getTraceAsString()
        ];
        $error_log->registrar_error($error_data);
    }

    echo "
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #1a202c;
            color: #e2e8f0;
            margin: 0;
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .error-container {
            max-width: 600px;
            background-color: #2d3748;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.3);
        }
        h2 {
            color: #e53e3e;
            margin-bottom: 10px;
        }
        .error-details {
            font-size: 14px;
            line-height: 1.5;
            background: #4a5568;
            padding: 10px;
            border-radius: 5px;
            word-wrap: break-word;
        }
        .trace {
            background: #2d3748;
            padding: 10px;
            border-radius: 5px;
            margin-top: 10px;
            overflow-x: auto;
            font-size: 12px;
        }
    </style>

    <div class='error-container'>
        <h2>⚠️ Error en la Aplicación</h2>
        <p><strong>Mensaje:</strong> " . htmlspecialchars($exception->getMessage()) . "</p>
        <div class='error-details'>
            <p><strong>Archivo:</strong> " . htmlspecialchars($exception->getFile()) . "</p>
            <p><strong>Línea:</strong> " . $exception->getLine() . "</p>
        </div>
        <h3>📜 Stack Trace:</h3>
        <div class='trace'><pre>" . htmlspecialchars($exception->getTraceAsString()) . "</pre></div>
    </div>
    ";
    exit;
});