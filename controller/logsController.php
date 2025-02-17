<?php
ini_set('session.save_path', realpath(dirname($_SERVER['DOCUMENT_ROOT']) . '/tmp'));
include '../model/logs.php';

if(isset($_POST['id'])){
	$id =  $_POST['id'];
}

if(isset($_POST['id'])){
	$id =  $_POST['id'];
	if (!preg_match('/^[a-zA-Z0-9\s]{0,100}$/', $id)) { die('error id');}
}

if(isset($_POST['query'])){
	$query =  $_POST['query'];
	if (!preg_match('/^[a-zA-Z0-9\s]{0,100}$/', $query)) { die('error query');}
}

if(isset($_POST['user'])){
	$user =  $_POST['user'];
	if (!preg_match('/^[a-zA-Z0-9\s]{0,100}$/', $user)) { die('error user');}
}


if(isset($_POST['estado'])){
	$estado =  $_POST['estado'];
}

if(isset($_POST['op'])){
	$op =  $_POST['op'];
}

switch ($op) {
	case 'registrar':
		$n_logs  = new logs();
		$resultado = $n_logs  -> registrar_logs('',$id,$query,$user,'');
		echo $resultado;
	break;
	case 'buscar':
		$n_logs  = new logs();
		$resultado = $n_logs  -> buscar_logs();
		if($resultado==0){
			exit();
		}
		foreach ($resultado as $key) {
			if($key['estado']=='1'){
				$st = 'checked';
			}else{
				$st = '';
			}
		$key['id']=$key['id_logs'];
		?>
		<tr>
			<td><?= $key['id_logs']; ?></td>
			<td><?= $key['id']; ?></td>
			<td><?= $key['query']; ?></td>
			<td><?= $key['user']; ?></td>
			<td><?php include '../view/static/bt_estado.php';  ?></td>
			<td>
				<div class="dropdown">
					<button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						Acciones
						<i class="mdi mdi-chevron-down"></i>
						</button>
						<div class="dropdown-menu" aria-labelledby="dropdownMenuButton1" style="margin: 0px;">
						<a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#myModal" onclick="cargar_datos('<?php echo $key['id_logs']; ?>', '<?php echo $key['id']; ?>', '<?php echo $key['query']; ?>', '<?php echo $key['user']; ?>')">Modificar</a>
						<a class="dropdown-item" href="#" onclick="eliminar(<?php echo $key['id_logs']; ?>)">Eliminar</a>
						</div>
					</div>
			</td>
		</tr>
		<?php
		}
	break;
	case 'cambiar_estado':
		$n_logs  = new logs();
		$resultado = $n_logs  -> cambiar_estado_logs($id, $estado);
		echo 1;
	break;
	case 'eliminar':
		$n_logs  = new logs();
		$resultado = $n_logs  -> eliminar_logs($id);
		echo 1;
	break;
	case 'buscar_select':
		$n_logs  = new logs();
		$resultado = $n_logs  -> buscar_logs();
		foreach ($resultado as $key) {
		?>
			<option value="<?php echo $key['id']; ?>"><?php echo $key['descripcion']; ?></option>;
		<?php
		}
	break;
	case 'buscar_json':
		$n_logs  = new logs();
		$resultado = $n_logs  -> buscar_json_logs($id);
		echo $resultado;
	break;
	case 'modificar':
		$n_logs  = new logs();
		$resultado = $n_logs  -> modificar_logs($id,$id,$query,$user);
		echo 1;
	break;
	case 'logs_mysql':
		$n_logs  = new logs();
		$resultado = $n_logs  -> logs_mysql($id,$id,$query,$user,$estado);
	break;
	default:
	break;
}
