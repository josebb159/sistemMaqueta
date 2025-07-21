<?php
include 'generalErrorController.php';
include '../model/servicios.php';
include '../model/notificacion.php';

$n_notificacion = new notificacion();
session_start();
if(isset($_POST['id'])){
	$id =  $_POST['id'];
}

if(isset($_POST['categorias_subcategorias'])){
	$categorias_subcategorias =  $_POST['categorias_subcategorias'];
	if (!preg_match('/^[a-zA-Z0-9\s]{0,100}$/', $categorias_subcategorias)) { die('error categorias_subcategorias');}
}

if(isset($_POST['detalle'])){
	$detalle =  $_POST['detalle'];
	if (!preg_match('/^[a-zA-Z0-9\s]{0,100}$/', $detalle)) { die('error detalle');}
}

if(isset($_POST['foto'])){
	$foto =  $_POST['foto'];
	if (!preg_match('/^[a-zA-Z0-9\s]{0,100}$/', $foto)) { die('error foto');}
}

if(isset($_POST['direccion'])){
	$direccion =  $_POST['direccion'];
	if (!preg_match('/^[a-zA-Z0-9\s]{0,100}$/', $direccion)) { die('error direccion');}
}

if(isset($_POST['solicitado_para'])){
	$solicitado_para =  $_POST['solicitado_para'];
	if (!preg_match('/^[a-zA-Z0-9\s]{0,100}$/', $solicitado_para)) { die('error solicitado_para');}
}

if(isset($_POST['oferta'])){
	$oferta =  $_POST['oferta'];
	if (!preg_match('/^[a-zA-Z0-9\s]{0,100}$/', $oferta)) { die('error oferta');}
}

if(isset($_POST['metodo_pago'])){
	$metodo_pago =  $_POST['metodo_pago'];
	if (!preg_match('/^[a-zA-Z0-9\s]{0,100}$/', $metodo_pago)) { die('error metodo_pago');}
}

if(isset($_POST['calificacion'])){
	$calificacion =  $_POST['calificacion'];
	if (!preg_match('/^[a-zA-Z0-9\s]{0,100}$/', $calificacion)) { die('error calificacion');}
}

if(isset($_POST['estado_servicio'])){
	$estado_servicio =  $_POST['estado_servicio'];
	if (!preg_match('/^[a-zA-Z0-9\s]{0,100}$/', $estado_servicio)) { die('error estado_servicio');}
}


if(isset($_POST['estado'])){
	$estado =  $_POST['estado'];
}

if(isset($_POST['op'])){
	$op =  $_POST['op'];
}

switch ($op) {
	case 'registrar':
		$n_servicios  = new servicios();
		$resultado = $n_servicios -> registrar_servicios($categorias_subcategorias, $detalle, $foto, $direccion, $solicitado_para, $oferta, $metodo_pago, $calificacion, $estado_servicio);
$n_notificacion -> registrar_notificacion('Registro servicios', 'servicios '.$categorias_subcategorias.' fue registrada', false, $_SESSION['id_usuario'], 'servicios', 'categorias_subcategorias');
		echo 1;
	break;
	case 'buscar':
		$n_servicios  = new servicios();
		$resultado = $n_servicios  -> buscar_servicios();
		if($resultado==0){
			exit();
		}
		foreach ($resultado as $key) {
			if($key['estado']=='1'){
				$st = 'checked';
			}else{
				$st = '';
			}
		$key['id']=$key['id_servicios'];
		?>
		<tr>
			<td><?= $key['id_servicios']; ?></td>
			<td><?= $key['categorias_subcategorias']; ?></td>
			<td><?= $key['detalle']; ?></td>
			<td><?= $key['foto']; ?></td>
			<td><?= $key['direccion']; ?></td>
			<td><?= $key['solicitado_para']; ?></td>
			<td><?= $key['oferta']; ?></td>
			<td><?= $key['metodo_pago']; ?></td>
			<td><?= $key['calificacion']; ?></td>
			<td><?= $key['estado_servicio']; ?></td>
			<td><?php include '../view/static/bt_estado.php';  ?></td>
			<td>
				<div class="dropdown">
					<button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						Acciones
						<i class="mdi mdi-chevron-down"></i>
						</button>
						<div class="dropdown-menu" aria-labelledby="dropdownMenuButton1" style="margin: 0px;">
							<a class="dropdown-item" href="#"  data-bs-toggle="modal" data-bs-target="#myModal" onclick="cargar_datos(<?php echo "'".$key['id_servicios']."','".$key['categorias_subcategorias']."','".$key['detalle']."','".$key['foto']."','".$key['direccion']."','".$key['solicitado_para']."','".$key['oferta']."','".$key['metodo_pago']."','".$key['calificacion']."','".$key['estado_servicio']."'"; ?>)">Modificar</a>
							<a class="dropdown-item" href="#" onclick="eliminar(<?php echo $key['id_servicios']; ?>)">Eliminar</a>
						</div>
					</div>
			</td>
		</tr>
		<?php
		}
	break;
	case 'cambiar_estado':
		$n_servicios  = new servicios();
		$resultado = $n_servicios  -> cambiar_estado_servicios($id, $estado);
$n_notificacion -> registrar_notificacion('Cambio status servicios', 'servicios '.$id.' fue cambiado de status', false, $_SESSION['id_usuario'], 'servicios', $id);
		echo 1;
	break;
	case 'eliminar':
		$n_servicios  = new servicios();
		$resultado = $n_servicios  -> eliminar_servicios($id);
$n_notificacion -> registrar_notificacion('servicios eliminada', 'servicios '.$id.' fue eliminado', false, $_SESSION['id_usuario'], 'servicios', $id);
		echo 1;
	break;
	case 'buscar_select':
		$n_servicios  = new servicios();
		$resultado = $n_servicios  -> buscar_servicios();
		foreach ($resultado as $key) {
		?>
			<option value="<?php echo $key['id']; ?>"><?php echo $key['descripcion']; ?></option>;
		<?php
		}
	break;
	case 'buscar_json':
		$n_servicios  = new servicios();
		$resultado = $n_servicios  -> buscar_json_servicios($id);
		echo $resultado;
	break;
	case 'modificar':
		$n_servicios  = new servicios();
		$resultado = $n_servicios  -> modificar_servicios($id,$categorias_subcategorias,$detalle,$foto,$direccion,$solicitado_para,$oferta,$metodo_pago,$calificacion,$estado_servicio);
$n_notificacion -> registrar_notificacion('modificado servicios', 'servicios '.$categorias_subcategorias.' fue modificado', false, $_SESSION['id_usuario'], 'servicios', $id);
		echo 1;
	break;
	case 'test':
		$n_servicios  = new servicios();
		$resultado = $n_servicios  -> test($id,$categorias_subcategorias,$detalle,$foto,$direccion,$solicitado_para,$oferta,$metodo_pago,$calificacion,$estado_servicio,$estado);
	break;
	default:
	break;
}
