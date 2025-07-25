<!-- view payments -->
<div class="page-content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-12">
				<div class="page-title-box d-sm-flex align-items-center justify-content-between">
					<h4 class="mb-sm-0">Lista de payments</h4>
					<div class="page-title-right">
						<ol class="breadcrumb m-0">
							<li class="breadcrumb-item"><a href="javascript: void(0);"><?php echo NAME_CLIENT; ?></a></li>
							<li class="breadcrumb-item active">Listado de payments</li>
						</ol>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-12">
				<div class="card">
					<div class="card-body">
						<h4 class="card-title">payments</h4>
						<table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
							<thead>
								<th>ID</th>
								<th>nombre</th>
								<th>descripcion</th>
								<th>Estado</th>
								<th>Opciones</th>
							<thead>
							<tbody id="datos">
							</tbody>
						</table>
						<button type="button"  class="btn btn-success waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#modal_agregar">Agregar payments</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


<?php
	$datas = [
			["type"=>"text","name"=>"nombre","id"=>"nombreagg","col"=>"6","required"=>"required", "action"=>"", "display"=>"block"],
			["type"=>"text","name"=>"descripcion","id"=>"descripcionagg","col"=>"6","required"=>"required", "action"=>"", "display"=>"block"],
	];

	$hiddesData = [];
	generate_modal("Agregar payments",$datas , 2, "modal_agregar", $hiddesData, "form_1", "new");

	$datas = [
			
			["type"=>"text","name"=>"nombre","id"=>"nombre","col"=>"6","required"=>"required", "action"=>"", "display"=>"block"],
			["type"=>"text","name"=>"descripcion","id"=>"descripcion","col"=>"6","required"=>"required", "action"=>"", "display"=>"block"],
	];

	$hiddesData = ["id_inventario"];
	generate_modal("Modificar payments",$datas , 2, "myModal", $hiddesData, "form_2", "edit");

?>
<?php 
$aditionals_js='
';
?>
