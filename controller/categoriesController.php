<?php
include 'generalErrorController.php';
include '../model/categories.php';
include '../model/notificacion.php';
include '../model/subcategories.php';

$n_notificacion = new notificacion();
session_start();
if(isset($_POST['id'])){
	$id =  $_POST['id'];
}

if(isset($_POST['nombre'])){
	$nombre =  $_POST['nombre'];
	if (!preg_match('/^[a-zA-Z0-9\s]{0,100}$/', $nombre)) { die('error nombre');}
}

if(isset($_POST['description'])){
	$description =  $_POST['description'];
	if (!preg_match('/^[a-zA-Z0-9\s]{0,100}$/', $description)) { die('error description');}
}


if(isset($_POST['estado'])){
	$estado =  $_POST['estado'];
}

if(isset($_POST['op'])){
	$op =  $_POST['op'];
}

switch ($op) {
	case 'registrar':
		$n_categories  = new categories();
		$resultado = $n_categories -> registrar_categories($nombre, $description);
$n_notificacion -> registrar_notificacion('Registro categories', 'categories '.$nombre.' fue registrada', false, $_SESSION['id_usuario'], 'categories', 'nombre');
		echo 1;
	break;
	case 'buscar':
		$n_categories  = new categories();
		$resultado = $n_categories  -> buscar_categories();

		if($resultado==0){
			exit();
		}
		foreach ($resultado as $key) {
			if($key['estado']=='1'){
				$st = 'checked';
			}else{
				$st = '';
			}


				$n_subcategories  = new subcategories();
				$resultado_subcategories = $n_subcategories  -> buscar_subcategories($key['id_categories']);
				$badge = '';
				if ($resultado_subcategories) {
					foreach ($resultado_subcategories as $subcat) {
						$badge.= '<span class="badge bg-primary me-1">' . htmlspecialchars($subcat['nombre']) . '</span>';
					}
				}

		$key['id']=$key['id_categories'];
		?>
		<tr>
			<td><?= $key['id_categories']; ?></td>
			<td><?= $key['nombre']; ?></td>
			<td><?= $key['description']; ?></td>
			<td><?= $badge; ?></td>
			<td><?php include '../view/static/bt_estado.php';  ?></td>
			<td>
				<div class="dropdown">
					<button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						Acciones
						<i class="mdi mdi-chevron-down"></i>
						</button>
						<div class="dropdown-menu" aria-labelledby="dropdownMenuButton1" style="margin: 0px;">
							<a class="dropdown-item" href="#"  data-bs-toggle="modal" data-bs-target="#myModal" onclick="cargar_datos(<?php echo "'".$key['id_categories']."','".$key['nombre']."','".$key['description']."'"; ?>)">Modificar</a>
							 <?php if($badge==''){ ?>
								<a class="dropdown-item" href="#" onclick="eliminar(<?php echo $key['id_categories']; ?>)">Eliminar</a>
							<?php } ?>
						</div>
					</div>
			</td>
		</tr>
		<?php
		}
	break;
	case 'cambiar_estado':
		$n_categories  = new categories();
		$resultado = $n_categories  -> cambiar_estado_categories($id, $estado);
$n_notificacion -> registrar_notificacion('Cambio status categories', 'categories '.$id.' fue cambiado de status', false, $_SESSION['id_usuario'], 'categories', $id);
		echo 1;
	break;
	case 'eliminar':
		$n_categories  = new categories();
		$resultado = $n_categories  -> eliminar_categories($id);
$n_notificacion -> registrar_notificacion('categories eliminada', 'categories '.$id.' fue eliminado', false, $_SESSION['id_usuario'], 'categories', $id);
		echo 1;
	break;
	case 'buscar_select':
		$n_categories  = new categories();
		$resultado = $n_categories  -> buscar_categories();
		foreach ($resultado as $key) {
		?>
			<option value="<?php echo $key['id']; ?>"><?php echo $key['descripcion']; ?></option>;
		<?php
		}
	break;
	case 'buscar_json':
		$n_categories  = new categories();
		$resultado = $n_categories  -> buscar_json_categories($id);
		echo $resultado;
	break;
	case 'modificar':
		$n_categories  = new categories();
		$resultado = $n_categories  -> modificar_categories($id,$nombre,$description);
$n_notificacion -> registrar_notificacion('modificado categories', 'categories '.$nombre.' fue modificado', false, $_SESSION['id_usuario'], 'categories', $id);
		echo 1;
	break;
	case 'test':
		$n_categories  = new categories();
		$resultado = $n_categories  -> test($id,$nombre,$description,$estado);
	break;
	default:
	break;
}
