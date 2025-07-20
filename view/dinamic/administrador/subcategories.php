<!-- view subcategories -->
<div class="page-content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-12">
				<div class="page-title-box d-sm-flex align-items-center justify-content-between">
					<h4 class="mb-sm-0">Lista de subcategorias</h4>
					<div class="page-title-right">
						<ol class="breadcrumb m-0">
							<li class="breadcrumb-item"><a href="javascript: void(0);"><?php echo NAME_CLIENT; ?></a></li>
							<li class="breadcrumb-item active">Listado de subcategorias</li>
						</ol>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-12">
				<div class="card">
					<div class="card-body">
						<h4 class="card-title">subcategorias</h4>
						<table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
							<thead>
								<th>ID</th>
								<th>Nombre</th>
								<th>Descripción</th>
								<th>Valor minimo ($ pesos)</th>
								<th>Estado</th>
								<th>Opciones</th>
							<thead>
							<tbody id="datos">
							</tbody>
						</table>
						<button type="button"  class="btn btn-success waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#modal_agregar">Agregar subcategorias</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


<?php
	$datas = [
			["type"=>"text","name"=>"Nombre","id"=>"nombreagg","col"=>"6","required"=>"required", "action"=>"", "display"=>"block"],
			["type"=>"text","name"=>"Descripción","id"=>"descriptionagg","col"=>"6","required"=>"required", "action"=>"", "display"=>"block"],
			["type"=>"number","name"=>"Valor minimo","id"=>"valor_minagg","col"=>"6","required"=>"required", "action"=>"", "display"=>"block"],

			["type"=>"select_foraneal", "class"=>"categories","db"=>"0", "cam_foraneal"=>"nombre", "name"=>"Categoria","id"=>"id_categoriesagg","col"=>"6","required"=>"required", "action"=>"", "display"=>"block"],
	];

	$hiddesData = [];
	generate_modal("Agregar subcategorias",$datas , 2, "modal_agregar", $hiddesData, "form_1", "new");

	$datas = [
			["type"=>"text","name"=>"Nombre","id"=>"nombre","col"=>"6","required"=>"required", "action"=>"", "display"=>"block"],
			["type"=>"text","name"=>"Descripción","id"=>"description","col"=>"6","required"=>"required", "action"=>"", "display"=>"block"],
			["type"=>"text","name"=>"Valor minimo","id"=>"valor_min","col"=>"6","required"=>"required", "action"=>"", "display"=>"block"],

				["type"=>"select_foraneal", "class"=>"categories", "db"=>"1", "cam_foraneal"=>"nombre", "name"=>"Categoria","id"=>"id_categories","col"=>"6","required"=>"required", "action"=>"", "display"=>"block"],
	];

	$hiddesData = ["id_inventario"];
	generate_modal("Modificar subcategorias",$datas , 2, "myModal", $hiddesData, "form_2", "edit");

?>
<?php 
$aditionals_js='
';
?>
