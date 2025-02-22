<!DOCTYPE html>
<html lang="es">
<head>
    <?php
    $index = true;

    // Incluir un archivo
    include 'view/config_view/info_pag.php';
    include 'model/usuario.php';

    if (!isset($_GET['token']) || empty($_GET['token'])) {
        echo "<script>alert('Token inválido.')</script>";
        echo "<script>location.href='index.php';</script>";
        exit;
    }

    $usuario = new usuario();
    $resultado = $usuario->recuperar_contrasenia_token($_GET['token']);

    if (!$resultado) {
        echo "<script>alert('Error al recuperar data.')</script>";
        echo "<script>location.href='index.php';</script>";
        exit;
    }

    $id_usuario = htmlspecialchars($resultado[0]['id']);
    ?>
    
    <meta charset="utf-8">
    <title><?php echo NAME_CLIENT; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description">
    <meta content="Themesdesign" name="author">
    
    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico">

    <!-- Bootstrap Css -->
    <link href="assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css">
    <!-- Icons Css -->
    <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css">
    <!-- App Css -->
    <link href="assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css">

</head>
<body class="auth-body-bg">
    <div>
        <div class="container-fluid p-0">
            <div class="row g-0">
                <div class="col-lg-4">
                    <div class="auth-page-content p-4 d-flex align-items-center min-vh-100">
                        <div class="w-100">
                            <div class="row justify-content-center">
                                <div class="col-lg-9">
                                    <div>
                                        <div class="text-center">
                                            <div>
                                                <a href="index.php" class="logo"><img src="assets/images/logo.png" height="60" alt="logo"></a>
                                            </div>

                                            <h4 class="font-size-18 mt-4">Restaurar contraseña</h4>
                                        </div>

                                        <div class="p-2 mt-5">
                                            <div class="alert alert-success mb-4" role="alert">
                                                Ingresa tu nueva contraseña.
                                            </div>
                                            
                                                <input type="hidden" name="id_usuario" value="<?= $id_usuario ?>">

                                                <div class="auth-form-group-custom mb-4">
                                                    <i class="ri-lock-2-line auti-custom-input-icon"></i>
                                                    <label for="password">Nueva contraseña</label>
                                                    <input type="hidden" id="id" name="id" value="<?= $id_usuario ?>">
                                                    <input type="password" class="form-control" id="password" name="password" placeholder="Ingresa tu nueva contraseña" required>
                                                </div>

                                                <div class="auth-form-group-custom mb-4">
                                                    <i class="ri-lock-2-line auti-custom-input-icon"></i>
                                                    <label for="password_confirm">Confirmar contraseña</label>
                                                    <input type="password" class="form-control" id="password_confirm" name="password_confirm" placeholder="Confirma tu contraseña" required>
                                                </div>

                                                <div class="mt-4 text-center">
                                                    <button class="btn btn-primary w-md waves-effect waves-light" onclick="resetear_contrasenia()">Restaurar</button>
                                                </div>
                                            
                                        </div>

                                        <div class="mt-5 text-center">
                                            <p>© <script>document.write(new Date().getFullYear())</script> Fits Tools, desarrollado por SP producciones</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-8">
                    <div class="auth-bg">
                        <div class="bg-overlay"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- JAVASCRIPT -->
    <script src="assets/libs/jquery/jquery.min.js"></script>
    <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/libs/metismenu/metisMenu.min.js"></script>
    <script src="assets/libs/simplebar/simplebar.min.js"></script>
    <script src="assets/libs/node-waves/waves.min.js"></script>
    <script src="assets/js/app.js"></script>
    <script src="assets/js/functions/index/index.js"></script>
</body>
</html>
