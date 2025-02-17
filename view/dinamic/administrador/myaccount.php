<!-- view myaccount -->
<link href="../assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<link href="../assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet"
    type="text/css" />
<link href="../assets/libs/datatables.net-select-bs4/css//select.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<link href="../assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet"
    type="text/css" />

<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Mi Cuenta</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);"><?php echo NAME_CLIENT; ?></a></li>
                            <li class="breadcrumb-item active">Mi Cuenta</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Mi Información Personal</h4>
                        <div class="profile-picture-section text-center mb-4">
                            <div style="display: flex; flex-direction: column; align-items: center;">
                                <img src="../assets/upload/usuario/" alt="Imagen de Perfil" id="profile-picture"
                                    style="width: 150px; height: 150px; border-radius: 50%; object-fit: cover; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                                <button type="button" class="btn btn-primary mt-3" data-bs-toggle="modal"
                                    data-bs-target="#modal_cambiar_imagen" style="margin-top: 20px;">Cambiar
                                    Imagen</button>
                            </div>
                        </div>

                        <form class="needs-validation" id="form_editar" method="POST" action="/mi-cuenta/actualizar">
                            <input type="hidden" name="id_usuario" id="id_usuario"
                                value="<?= $_SESSION['id_usuario']?>">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="nombre" class="form-label">Nombre </label>
                                        <input type="text" class="form-control" id="nombre" name="nombre"
                                            placeholder="Nombre" value="" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Correo Electrónico</label>
                                        <input type="email" class="form-control" id="email" name="email"
                                            placeholder="Correo Electrónico" value="" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="telefono" class="form-label">Teléfono</label>
                                        <input type="text" class="form-control" id="telefono" name="telefono"
                                            placeholder="Teléfono" value="" required>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary">Guardar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-12 mt-4">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Cambiar Contraseña</h4>
                        <form class="needs-validation" id="form_cambiar_contrasena" method="POST"
                            action="/mi-cuenta/cambiar-contrasena">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="password" class="form-label">Nueva Contraseña</label>
                                        <input type="password" class="form-control" id="password" name="password"
                                            placeholder="Nueva Contraseña" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="confirm_password" class="form-label">Confirmar Contraseña</label>
                                        <input type="password" class="form-control" id="confirm_password"
                                            name="confirm_password" placeholder="Confirmar Contraseña" required>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary">Cambiar Contraseña</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Modal para cambiar imagen de perfil -->
<div class="modal fade" id="modal_cambiar_imagen" tabindex="-1" aria-labelledby="cambiarImagenLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="cambiarImagenLabel">Cambiar Imagen de Perfil</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="form_cambiar_imagen" method="POST" action="/mi-cuenta/cambiar-imagen"
                enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="imagen_perfil" class="form-label">Seleccionar Imagen</label>
                        <input type="file" class="form-control" id="imagen_perfil" name="imagen_perfil" accept="image/*"
                            required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light waves-effect" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary waves-effect waves-light">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php 
$aditionals_js='
<!-- Required datatable js -->
<script src="../assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="../assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
<!-- Buttons examples -->
<script src="../assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
<script src="../assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>
<script src="../assets/libs/jszip/jszip.min.js"></script>
<script src="../assets/libs/pdfmake/build/pdfmake.min.js"></script>
<script src="../assets/libs/pdfmake/build/vfs_fonts.js"></script>
<script src="../assets/libs/datatables.net-buttons/js/buttons.html5.min.js"></script>
<script src="../assets/libs/datatables.net-buttons/js/buttons.print.min.js"></script>
<script src="../assets/libs/datatables.net-buttons/js/buttons.colVis.min.js"></script>
<script src="../assets/libs/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
<script src="../assets/libs/datatables.net-select/js/dataTables.select.min.js"></script>
<!-- Responsive examples -->
<script src="../assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
<script src="../assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>
<!-- Datatable init js -->
<script src="../assets/js/pages/datatables.init.js"></script>
<script src="../assets/libs/select2/js/select2.min.js"></script>
';
?>