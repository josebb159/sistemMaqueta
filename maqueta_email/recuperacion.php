<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperación de Cuenta</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 20px auto;
            background: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        h1 {
            color: #333;
        }
        p {
            font-size: 16px;
            color: #666;
            line-height: 1.5;
        }
        .btn {
            display: inline-block;
            background: #28a745;
            color: #ffffff;
            text-decoration: none;
            font-size: 16px;
            padding: 12px 20px;
            border-radius: 5px;
            margin-top: 20px;
            font-weight: bold;
        }
        .btn:hover {
            background: #218838;
        }
        .footer {
            font-size: 14px;
            color: #999;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Recuperación de Cuenta</h1>
        <p>Has solicitado restablecer tu contraseña.</p>
        <p><strong>Usuario:</strong> <?= htmlspecialchars($datos['usuario']) ?></p>
        <p><strong>Correo Electrónico:</strong> <?= htmlspecialchars($datos['email']) ?></p>
        <p>Para restablecer tu contraseña, haz clic en el siguiente botón:</p>
        <a href="<?= htmlspecialchars($datos['link_recuperacion']) ?>" class="btn">Restablecer contraseña</a>
        <p class="footer">Si no solicitaste este cambio, ignora este mensaje.</p>
    </div>
</body>
</html>
