<!-- view logs -->
<link href="../assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<link href="../assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<link href="../assets/libs/datatables.net-select-bs4/css//select.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<link href="../assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />

<div class="page-content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-12">
				<div class="page-title-box d-sm-flex align-items-center justify-content-between">
					<h4 class="mb-sm-0">Lista de logs</h4>
					<div class="page-title-right">
						<ol class="breadcrumb m-0">
							<li class="breadcrumb-item"><a href="javascript: void(0);"><?php echo NAME_CLIENT; ?></a></li>
							<li class="breadcrumb-item active">Listado de logs</li>
						</ol>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-12">
				<div class="card">
					<div class="card-body">
						<h4 class="card-title">logs</h4>
						<table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
							<thead>
								<th>ID</th>
								<th>id</th>
								<th>query</th>
								<th>user</th>
								<th>Estado</th>
								<th>Opciones</th>
							<thead>
							<tbody id="datos">
							</tbody>
						</table>
						<button type="button"  class="btn btn-success waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#modal_agregar">Agregar logs</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


<div class="col-sm-6 col-md-4 col-xl-3">
	<div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title mt-0" id="myModalLabel">Modificar logs</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<form class="needs-validation" id="form_2">
					<input type="hidden" value="" id="id_logs">
					<div class="modal-body">
						<div class="row">
							<div class="col-md-6">
								<div class="mb-6">
									<label for="validationCustom01" class="form-label">id</label>
									<input type="text" class="form-control" id="id" placeholder="id" value="" required>
								</div>
							</div>
							<div class="col-md-6">
								<div class="mb-6">
									<label for="validationCustom01" class="form-label">query</label>
									<input type="text" class="form-control" id="query" placeholder="query" value="" required>
								</div>
							</div>
							<div class="col-md-6">
								<div class="mb-6">
									<label for="validationCustom01" class="form-label">user</label>
									<input type="text" class="form-control" id="user" placeholder="user" value="" required>
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
	<div id="modal_agregar" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title mt-0" id="myModalLabel">Agregar logs</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<form class="needs-validation" id="form_1">
					<div class="modal-body">
						<div class="row">
							<div class="col-md-6">
								<div class="mb-6">
									<label for="validationCustom01" class="form-label">id</label>
									<input type="text" class="form-control" id="idagg" placeholder="id" value="" required>
								</div>
							</div>
							<div class="col-md-6">
								<div class="mb-6">
									<label for="validationCustom01" class="form-label">query</label>
									<input type="text" class="form-control" id="queryagg" placeholder="query" value="" required>
								</div>
							</div>
							<div class="col-md-6">
								<div class="mb-6">
									<label for="validationCustom01" class="form-label">user</label>
									<input type="text" class="form-control" id="useragg" placeholder="user" value="" required>
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
';
?>
