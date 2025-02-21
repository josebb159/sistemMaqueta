<h1>Recuperación de Cuenta</h1>
<p>Has solicitado restablecer tu contraseña.</p>
<p><strong>Usuario:</strong> <?= $datos['usuario'] ?></p>
<p><strong>Correo Electrónico:</strong> <?= $datos['email'] ?></p>
<p>Para restablecer tu contraseña, haz clic en el siguiente enlace:</p>
<p><a href="<?= $datos['link_recuperacion'] ?>">Restablecer contraseña</a></p>
<p>Si no solicitaste este cambio, ignora este mensaje.</p>