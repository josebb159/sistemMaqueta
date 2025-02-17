<!-- view configuracion -->
<link href="../assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<link href="../assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<link href="../assets/libs/datatables.net-select-bs4/css//select.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<link href="../assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<link href="../assets/libs/spectrum-colorpicker2/spectrum.min.css" rel="stylesheet" type="text/css">
<div class="page-content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-12">
				<div class="page-title-box d-sm-flex align-items-center justify-content-between">
					<h4 class="mb-sm-0">Lista de Configuración</h4>
					<div class="page-title-right">	
						<ol class="breadcrumb m-0">
							<li class="breadcrumb-item"><a href="javascript: void(0);"><?php echo NAME_CLIENT; ?></a></li>
							<li class="breadcrumb-item active">Listado de Configuración</li>
						</ol>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-12">
				<div class="card">
					<div class="card-body">
						<h4 class="card-title">Configuración</h4>
							<div class="modal-body">
							<div class="row">
								<div class="col-md-6">
									<div class="mb-6">
										<label for="validationCustom01" class="form-label">Nombre del Sistema</label>
										<input type="text" class="form-control" id="nombre" placeholder="Nombre" value="" required>
									</div>
								</div>
								<div class="col-md-6">
									<div class="mb-6">
										<label for="validationCustom01" class="form-label">Color del Sistema</label>
										<input type="text" class="form-control" id="color"
                                    value="#50a5f1">
									</div>
								</div>
							</div>
						</div>
						<button type="button"  class="btn btn-success waves-effect waves-light" onclick="registrar()">Guardar</button>
					</div>
				</div>
			</div>
		</div>


		<div class="row" style="display: none;">
			<div class="col-12">
				<div class="card">
					<div class="card-body">
						<h4 class="card-title">IA Configuración</h4>
							<div class="modal-body">
							<div class="row">
								<div class="col-md-6">
									<div class="mb-6">
										<label for="validationCustom01" class="form-label">Select IA</label>
										<sELEct class="form-control" id="select_ia">
											<option value="OpenIA">OpenIA</option>
											<option value="GPT">GTP</option>
										</sELEct>
									</div>
								</div>
								<div class="col-md-6">
									<div class="mb-6">
										<label for="validationCustom01" class="form-label">Token Access</label>
										<input type="text" class="form-control" id="token_access"
                                    value="">
									</div>
								</div>
							</div>
						</div>
						<button type="button"  class="btn btn-success waves-effect waves-light" onclick="registrar2()">Guardar</button>
					</div>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-12">
				<div class="card">
					<div class="card-body">
						<h4 class="card-title">Email Configuración</h4>
							<div class="modal-body">
							<div class="row">
								<div class="col-md-6">
									<div class="mb-6">
										<label for="validationCustom01" class="form-label">Correo</label>
										<input type="text" class="form-control" id="correo" placeholder="Correo" value="" required>
									</div>
								</div>
								<div class="col-md-6">
									<div class="mb-6">
										<label for="validationCustom01" class="form-label">Contraseña</label>
										<input type="text" class="form-control" id="contrasena"
                                    >
									</div>
								</div>
								<div class="col-md-6">
									<div class="mb-6">
										<label for="validationCustom01" class="form-label">Host SMTP</label>
										<input type="text" class="form-control" id="smtp"
                                    >
									</div>
								</div>
								<div class="col-md-6">
									<div class="mb-6">
										<label for="validationCustom01" class="form-label">Port</label>
										<input type="text" class="form-control" id="port"
                                   >
									</div>
								</div>
							</div>
						</div>
						<button type="button"  class="btn btn-success waves-effect waves-light" onclick="registrar3()">Guardar</button>
						<button type="button"  class="btn btn-success waves-effect waves-light" onclick="test()">test</button>
					</div>
				</div>
			</div>
		</div>



		<div class="row">
			<div class="col-12">
				<div class="card">
					<div class="card-body">
						<h4 class="card-title">Alerta bajo stock</h4>
							<div class="modal-body">
							<div class="row">
								<div class="col-md-6">
									<div class="mb-6">
										<label for="validationCustom01" class="form-label">Alerta stock naranja</label>
										<input type="number" min="1" class="form-control" id="stock_naranja" placeholder="" value="" required>
									</div>
								</div>
								<div class="col-md-6">
									<div class="mb-6">
										<label for="validationCustom01" class="form-label">Alerta stock rojo</label>
										<input type="number" min="1" class="form-control" id="stock_rojo" 
                                    >
									</div>
								</div>
								
								
							</div>
						</div>
						<button type="button"  class="btn btn-success waves-effect waves-light" onclick="registrar4()">Guardar</button>
					</div>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-12">
				<div class="card">
					<div class="card-body">
						<h4 class="card-title">Notificaciones a correo</h4>
							<div class="modal-body">
							<div class="row">
								<div class="col-md-6">
									<div class="mb-6">
										<label for="validationCustom01" class="form-label">Correo para notificacion de entrega</label>
										<input type="email"  class="form-control" id="correo_entrega" placeholder="" value="" required>
									</div>
								</div>
								<div class="col-md-6">
									<div class="mb-6">
										<label for="validationCustom01" class="form-label">Correo para notificacion de venta</label>
										<input type="email"  class="form-control" id="correo_venta" 
                                    >
									</div>
								</div>
								
								
							</div>
						</div>
						<button type="button"  class="btn btn-success waves-effect waves-light" onclick="registrar5()">Guardar</button>
					</div>
				</div>
			</div>
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
<script src="../assets/libs/spectrum-colorpicker2/spectrum.min.js"></script>
';
?>

