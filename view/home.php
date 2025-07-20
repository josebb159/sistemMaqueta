<?php
ini_set('session.save_path', realpath(dirname($_SERVER['DOCUMENT_ROOT']) . '/tmp'));
session_start();
include "static/seguridad_sesion.php";
include "../model/notificacion.php";
$n_notificacion = new notificacion();
$list_notificacion = $n_notificacion->buscar_notificaciones();
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <?php
    //seguridad
    include 'static/seguridad_sesion.php';

    // datos por defecto de la pagina
    include 'config_view/info_pag.php';
    ?>
    <?php

    // agrega todo los metaas
    include 'static/requerimientos_meta.php';
    ?>

    <title><?php echo NAME_CLIENT ?></title>

    <?php
    // agrega todo el css a la pagina  
    include 'static/requerimientos_css.php';
    include 'static/dinamic_modal.php';
    ?>

</head>

<body data-sidebar="dark">

    <!-- Begin page -->
    <div id="layout-wrapper">

        <header id="page-topbar">
            <div class="navbar-header">
                <div class="d-flex">
                    <!-- LOGO -->
                    <div class="navbar-brand-box">
                        <a href="home.php?" class="logo logo-dark">
                            <span class="logo-sm">
                                <img src="../assets/images/logo-sm-dark.png" alt="logo-sm-dark" height="22">
                            </span>
                            <span class="logo-lg">
                                <img src="../assets/images/logo-dark.png" alt="logo-dark" height="20">
                            </span>
                        </a>

                        <a href="home.php?" class="logo logo-light">
                            <span class="logo-sm">
                                <img src="../assets/images/logo.png" alt="logo-sm-light" height="20">
                            </span>
                            <span class="logo-lg">
                                <img src="../assets/images/logo4.png" alt="logo-light" height="40">
                            </span>
                        </a>
                    </div>

                    <button type="button" class="btn btn-sm px-3 font-size-24 header-item waves-effect" id="vertical-menu-btn">
                        <i class="ri-menu-2-line align-middle"></i>
                    </button>

                    <!-- App Search-->
                    <form class="app-search d-none d-lg-block">
                        <div class="position-relative">
                            <input type="hidden" name="view" value="buscar_producto">
                            <input type="text" class="form-control" name="nombre_prodcuto" placeholder="Search...">
                            <span class="ri-search-line"></span>
                        </div>
                    </form>
                    <!-- mega menu-->

                    <!-- mega menu-->

                </div>

                <div class="d-flex">

                    <div class="dropdown d-inline-block d-lg-none ms-2">
                        <button type="button" class="btn header-item noti-icon waves-effect" id="page-header-search-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="ri-search-line"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0" aria-labelledby="page-header-search-dropdown">

                            <form class="p-3">
                                <div class="mb-3 m-0">
                                    <div class="input-group">

                                        <input type="text" class="form-control" placeholder="Search ...">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="submit"><i class="ri-search-line"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!--<div class="dropdown d-none d-lg-inline-block ms-1">
                        <button type="button" class="btn header-item noti-icon waves-effect" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="ri-apps-2-line"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                            <div class="px-lg-2">
                                <div class="row g-0">
                                    <div class="col">
                                        <a class="dropdown-icon-item" href="#">
                                            <img src="../assets/images/brands/github.png" alt="Github">
                                            <span>GitHub</span>
                                        </a>
                                    </div>
                                    <div class="col">
                                        <a class="dropdown-icon-item" href="#">
                                            <img src="../assets/images/brands/bitbucket.png" alt="bitbucket">
                                            <span>Bitbucket</span>
                                        </a>
                                    </div>
                                    <div class="col">
                                        <a class="dropdown-icon-item" href="#">
                                            <img src="../assets/images/brands/dribbble.png" alt="dribbble">
                                            <span>Dribbble</span>
                                        </a>
                                    </div>
                                </div>

                                <div class="row g-0">
                                    <div class="col">
                                        <a class="dropdown-icon-item" href="#">
                                            <img src="../assets/images/brands/dropbox.png" alt="dropbox">
                                            <span>Dropbox</span>
                                        </a>
                                    </div>
                                    <div class="col">
                                        <a class="dropdown-icon-item" href="#">
                                            <img src="../assets/images/brands/mail_chimp.png" alt="mail_chimp">
                                            <span>Mail Chimp</span>
                                        </a>
                                    </div>
                                    <div class="col">
                                        <a class="dropdown-icon-item" href="#">
                                            <img src="../assets/images/brands/slack.png" alt="slack">
                                            <span>Slack</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> -->

                    <div class="dropdown d-none d-lg-inline-block ms-1">
                        <button type="button" class="btn header-item noti-icon waves-effect" data-toggle="fullscreen">
                            <i class="ri-fullscreen-line"></i>
                        </button>
                    </div>

                    <div class="dropdown d-inline-block">
                        <button type="button" class="btn header-item noti-icon waves-effect" id="page-header-notifications-dropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="ri-notification-3-line"></i>
                            <span class="noti-dot"></span>
                        </button>
                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0" aria-labelledby="page-header-notifications-dropdown">
                            <div class="p-3">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <h6 class="m-0"> Notifications </h6>
                                    </div>
                                    <div class="col-auto">
                                        <a href="home.php?view=notificaciones" class="small"> Ver todo</a>
                                    </div>
                                </div>
                            </div>
                            <div data-simplebar style="max-height: 230px;">

                                <?php if ($list_notificacion) {
                                    foreach ($list_notificacion as $key) {

                                ?>
                                        <a href="" class="text-reset notification-item">
                                            <div class="d-flex">
                                                <div class="avatar-xs me-3">
                                                    <span class="avatar-title bg-success rounded-circle font-size-16">
                                                        <i class="ri-checkbox-circle-line"></i>
                                                    </span>
                                                </div>
                                                <div class="flex-1">
                                                    <h6 class="mt-0 mb-1"><?= $key['nombre'] ?></h6>
                                                    <div class="font-size-12 text-muted">
                                                        <p class="mb-1"><?= $key['descripcion'] ?></p>
                                                        <p class="mb-0"><i class="mdi mdi-clock-outline"></i><?= $key['fecha_registro'] ?></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>

                                <?php }
                                } else {
                                    echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; No hay notificaciones";
                                } ?>
                                <div class="p-2 border-top">
                                    <div class="d-grid">
                                        <a class="btn btn-sm btn-link font-size-14 text-center" href="home.php?view=notificaciones">
                                            <i class="mdi mdi-arrow-right-circle me-1"></i> View More..
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="dropdown d-inline-block user-dropdown">
                            <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img class="rounded-circle header-profile-user" src="../assets/upload/usuario/<?= $_SESSION['img'] ?>" alt="Header Avatar">

                                <span class="d-none d-xl-inline-block ms-1"><?php echo $_SESSION['nombre']; ?></span>
                                <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>

                            </button>
                            <div class="dropdown-menu dropdown-menu-end">
                                <!-- item-->
                                <a class="dropdown-item" href="home.php?view=myaccount"><i class="ri-user-line align-middle me-1"></i> Configuración del Perfil</a>
                                <!--<a class="dropdown-item" href="#"><i class="ri-wallet-2-line align-middle me-1"></i> My
                                Wallet</a>-->
                                <!--<a class="dropdown-item d-block" href="#"><span class="badge bg-success float-end mt-1">11</span><i class="ri-settings-2-line align-middle me-1"></i> Settings</a>-->
                                <!--<a class="dropdown-item" href="#"><i class="ri-lock-unlock-line align-middle me-1"></i> Lock
                                screen</a>-->
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item text-danger" href="home.php?view=logout"><i class="ri-shut-down-line align-middle me-1 text-danger"></i> Salir</a>
                            </div>
                        </div>


                    </div>
                </div>
        </header>

        <!-- ========== Left Sidebar Start ========== -->
        <div class="vertical-menu">

            <div data-simplebar class="h-100">

                <?php include 'static/dinamic_menu.php'; ?>
                <!-- menuuu -->
            </div>
        </div>
        <!-- Left Sidebar End -->
        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content" id="miniaresult">

            <?php include 'dinamic_view_controller.php';

            ?>

        </div>
        <!-- end main content-->

        <footer class="footer">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <script>
                            document.write(new Date().getFullYear())
                        </script> © <?php echo NAME_CLIENT ?> .
                    </div>
                    <div class="col-sm-6">
                        <div class="text-sm-end d-none d-sm-block">
                            Creado por Sproducciones
                        </div>
                    </div>
                </div>
            </div>
        </footer>

    </div>
    <!-- END layout-wrapper -->

    <!-- Right Sidebar -->

    <!-- /Right-bar -->

    <!-- Right bar overlay-->
    <div class="rightbar-overlay"></div>

    <?php
    // agrega el javascript
    include 'static/requerimientos_js.php';

    //dependencias javascript
    include 'static/dinamic_depentencias_js.php';
    ?>

</body>

</html>