
<!-- Responsive datatable examples -->
<link href="../assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />

<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Lista de usuarios</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);"><?php echo NAME_CLIENT; ?></a></li>
                            <li class="breadcrumb-item active">Listado de usuarios</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        <h4 class="card-title">Usuario</h4>
                   
                        </p>

                        <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nombre</th>
                                    <th>Rol</th>
                                    <th>Usuario</th>
                                    <th>Fecha Registro</th>
                                    <th>Estado</th>
                                    <th>Opciones</th>
                                </tr>
                            </thead>


                            <tbody id="datos">


                            </tbody>
                        </table>


                        <button type="button" class="btn btn-success waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#modal_agregar">Agregar usuario</button>

                    </div>
                </div>
            </div> <!-- end col -->
        </div> <!-- end row -->

        <!-- end row-->





    </div> <!-- container-fluid -->
</div>
<!-- End Page-content -->




<div class="col-sm-6 col-md-4 col-xl-3">
	<div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title mt-0" id="myModalLabel">Modificar Usuario</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<form class="needs-validation" id="form_2">
					<input type="hidden" value="" id="id">
                    <input type="hidden" value="" id="id_proveedor">
					<div class="modal-body">
						<div class="row">
							<div class="col-md-6">
								<div class="mb-6">
									<label for="validationCustom01" class="form-label">Nombre</label>
									<input type="text" class="form-control" maxlength="25" id="nombre" placeholder="nombre" value="" required>
								</div>
							</div>
							
							<div class="col-md-6">
								<div class="mb-6">
									<label for="validationCustom01" class="form-label">Teléfono</label>
									<input type="text" class="form-control" id="telefono" placeholder="Teléfono" value="" required 
       pattern="\d{3}-\d{4}-\d{3}" title="El formato debe ser 000-0000-000">    
								</div>
							</div>
							
							
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-light waves-effect" data-bs-dismiss="modal">Cerrar</button>
						<button type="submit" class="btn btn-primary waves-effect waves-light" >Guardar</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<div class="col-sm-6 col-md-4 col-xl-3">


    <!-- sample modal content -->
    <div id="modal_agregar" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0" id="myModalLabel">Agregar Usuario</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form class="needs-validation" id="form_1">
                    <div class="modal-body">

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-6">

                                    <label for="validationCustom01" class="form-label">Nombre del usuario</label>
                                    <input type="text" class="form-control" maxlength="25" id="nombreagg" placeholder="Nombre del usuario" value="" required>

                                </div>
                            </div>
                           
                        </div>
                        <div class="row">

                            <div class="col-md-6">
                                <div class="mb-6">
                                    <label for="validationCustom02" class="form-label">Correo</label>
                                    <input type="text" class="form-control" maxlength="25" id="usuarioagg" placeholder="correo" value="" required>

                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-6">
                                    <label for="validationCustom02" class="form-label">Contraseña</label>
                                    <input type="text" class="form-control" maxlength="25" id="contrasenaagg" placeholder="contrasena" value="" required>

                                </div>
                            </div>
                        </div>

                        <div class="row">


                        </div>

                                                          <div class="row">
                                                              <div class="col-md-12">
                                                                  <div class="mb-12">
                                                                      <label for="validationCustom02" class="form-label">Rol</label>
                                                                     
                                                                      <select name="" class="form-control" id="rols" onchange="isUserSucursal(this.value)">


                                                                      </select>
                                                              
                                                                  </div>
                                                              </div>
                                                            
                                                          </div>

                                                          <div class="row" id="sucursales" style="display:none">
                                                              <div class="col-md-12">
                                                                  <div class="mb-12">
                                                                      <label for="validationCustom02" class="form-label">Sucursal</label>
                                                                     
                                                                      <select name="" class="form-control" id="sucursal">

                                    </select>

                                </div>
                            </div>

                        </div>






                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light waves-effect" data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary waves-effect waves-light">Agregar</button>
                    </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
</div>



<?php
$aditionals_js = '

';

?>