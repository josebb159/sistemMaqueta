<?php
include 'generalErrorController.php';
include '../model/subcategories.php';
include '../model/notificacion.php';

$n_notificacion = new notificacion();
session_start();
if(isset($_POST['id'])){
	$id =  $_POST['id'];
}

if(isset($_POST['id_categories'])){
	$id_categories =  $_POST['id_categories'];
}

if(isset($_POST['nombre'])){
	$nombre =  $_POST['nombre'];
	if (!preg_match('/^[a-zA-Z0-9\s]{0,100}$/', $nombre)) { die('error nombre');}
}

if(isset($_POST['description'])){
	$description =  $_POST['description'];
	if (!preg_match('/^[a-zA-Z0-9\s]{0,100}$/', $description)) { die('error description');}
}

if(isset($_POST['valor_min'])){
	$valor_min =  $_POST['valor_min'];
	if (!preg_match('/^[a-zA-Z0-9\s]{0,100}$/', $valor_min)) { die('error valor_min');}
}


if(isset($_POST['estado'])){
	$estado =  $_POST['estado'];
}

if(isset($_POST['op'])){
	$op =  $_POST['op'];
}

switch ($op) {
	case 'registrar':
		$n_subcategories  = new subcategories();
		$resultado = $n_subcategories -> registrar_subcategories($id_categories, $nombre, $description, $valor_min);
$n_notificacion -> registrar_notificacion('Registro subcategories', 'subcategories '.$nombre.' fue registrada', false, $_SESSION['id_usuario'], 'subcategories', 'nombre');
		echo 1;
	break;
	case 'buscar':
		$n_subcategories  = new subcategories();
		$resultado = $n_subcategories  -> buscar_subcategories();
		if($resultado==0){
			exit();
		}
		foreach ($resultado as $key) {
			if($key['estado']=='1'){
				$st = 'checked';
			}else{
				$st = '';
			}
		$key['id']=$key['id_subcategories'];
		?>
		<tr>
			<td><?= $key['id_subcategories']; ?></td>
			<td><?= $key['nombre']; ?></td>
			<td><?= $key['description']; ?></td>
			<td>$<?= $key['valor_min']; ?></td>
			<td><?php include '../view/static/bt_estado.php';  ?></td>
			<td>
				<div class="dropdown">
					<button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						Acciones
						<i class="mdi mdi-chevron-down"></i>
						</button>
						<div class="dropdown-menu" aria-labelledby="dropdownMenuButton1" style="margin: 0px;">
							<a class="dropdown-item" href="#"  data-bs-toggle="modal" data-bs-target="#myModal" onclick="cargar_datos(<?php echo "'".$key['id_subcategories']."','".$key['nombre']."','".$key['description']."','".$key['valor_min']."','".$key['id_categories']."'"; ?>)">Modificar</a>
							<a class="dropdown-item" href="#" onclick="eliminar(<?php echo $key['id_subcategories']; ?>)">Eliminar</a>
						</div>
					</div>
			</td>
		</tr>
		<?php
		}
	break;
	case 'cambiar_estado':
		$n_subcategories  = new subcategories();
		$resultado = $n_subcategories  -> cambiar_estado_subcategories($id, $estado);
$n_notificacion -> registrar_notificacion('Cambio status subcategories', 'subcategories '.$id.' fue cambiado de status', false, $_SESSION['id_usuario'], 'subcategories', $id);
		echo 1;
	break;
	case 'eliminar':
		$n_subcategories  = new subcategories();
		$resultado = $n_subcategories  -> eliminar_subcategories($id);
$n_notificacion -> registrar_notificacion('subcategories eliminada', 'subcategories '.$id.' fue eliminado', false, $_SESSION['id_usuario'], 'subcategories', $id);
		echo 1;
	break;
	case 'buscar_select':
		$n_subcategories  = new subcategories();
		$resultado = $n_subcategories  -> buscar_subcategories();
		foreach ($resultado as $key) {
		?>
			<option value="<?php echo $key['id']; ?>"><?php echo $key['descripcion']; ?></option>;
		<?php
		}
	break;
	case 'buscar_json':
		$n_subcategories  = new subcategories();
		$resultado = $n_subcategories  -> buscar_json_subcategories($id);
		echo $resultado;
	break;
	case 'modificar':
		$n_subcategories  = new subcategories();
		$resultado = $n_subcategories  -> modificar_subcategories($id,$id_categories,$nombre,$description,$valor_min);
$n_notificacion -> registrar_notificacion('modificado subcategories', 'subcategories '.$nombre.' fue modificado', false, $_SESSION['id_usuario'], 'subcategories', $id);
		echo 1;
	break;
	case 'test':
		$n_subcategories  = new subcategories();
		$resultado = $n_subcategories  -> test($id,$nombre,$description,$valor_min,$estado);
	break;
	default:
	break;
}
