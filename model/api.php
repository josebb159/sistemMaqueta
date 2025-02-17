<?php
require "../framework/phpmailer/index.php";
if(isset($conect)){if($conect==1){}else{include 'db.php';$conect =1;}}else{include 'db.php';$conect =1;}
class api {

	public function login($data) {
		$conexion = new Conexion();

		// Consulta para obtener el usuario y la contraseña encriptada
		$sql = "SELECT * FROM usuarios WHERE email = :email AND estado = 1";
		$reg = $conexion->prepare($sql);
		$reg->bindParam(':email', $data['email']); // Nota: Cambié 'email' para ajustarlo al JSON
		$reg->execute();
		$emailValue = $data['email']; // Captura el valor que se está vinculando

	
		$consulta = $reg->fetch(PDO::FETCH_ASSOC);
	
		if ($consulta) {
			// Verifica la contraseña usando password_verify
			if (password_verify($data['password'], $consulta['contrasena'])) {
				$result = ["user" => $consulta];
	
				$responseBody = '{"status_code": 200, "message": "OK"}';
				$data = array_merge(json_decode($responseBody, true), $result);
				$_SESSION['id_usuario'] = $consulta['id'];
				echo json_encode($data);
			} else {
				// Contraseña incorrecta
				http_response_code(401);
				echo json_encode(["status_code" => 401, "message" => "Credenciales inválidas."]);
			}
		} else {
			// Usuario no encontrado
			http_response_code(404);
			echo json_encode(["status_code" => 404, "message" => "Usuario no encontrado."]);
		}
	}


	public function Buscar_producto_codigo_barra($data) {
		$conexion = new Conexion();
	
		// Consulta para obtener los productos
		$sql = "
		SELECT envio.id_envio, envio.direccion, envio.descripcion, producto.nombre, salida_producto.cantidad, producto.imagen 
		FROM envio 
		JOIN envioxproducto ON envioxproducto.id_envio = envio.id_envio 
		JOIN salida_producto ON salida_producto.id_salida_producto = envioxproducto.id_salida_producto 
		JOIN producto ON producto.id_producto = salida_producto.id_producto 
		WHERE envio.codigo_barra = :barcode and envio.estado = 10";
		
		$reg = $conexion->prepare($sql);
		$reg->bindParam(':barcode', $data['barcode']);
		$reg->execute();
	
		$productos = $reg->fetchAll(PDO::FETCH_ASSOC);  // Cambié fetch() por fetchAll()
	
		if ($productos) {
			// Devuelves una lista de productos
			$result = ["products" => $productos];  // Cambié 'product' a 'products' para reflejar varios productos
	
			$responseBody = '{"status_code": 200, "message": "OK"}';
			$data = array_merge(json_decode($responseBody, true), $result);
	
			echo json_encode($data);
		} else {
			// Error si no se encuentran productos
			http_response_code(404);
			echo json_encode(["status_code" => 404, "message" => "Productos no encontrados."]);
		}
	}


	public function ActualizarUsuarioEnvio($idEnvio, $idUsuario) {
		$conexion = new Conexion();
	
		// Consulta de actualización
		$sqlUpdate = "UPDATE envio SET id_usuario = :id_usuario , estado = 15 WHERE id_envio = :id_envio";
	
		$updateStmt = $conexion->prepare($sqlUpdate);
		$updateStmt->bindParam(':id_usuario', $idUsuario, PDO::PARAM_INT);
		$updateStmt->bindParam(':id_envio', $idEnvio, PDO::PARAM_INT);
	
		// Ejecutar la consulta
		if ($updateStmt->execute()) {
			return json_encode(["status_code" => 200, "message" => "Usuario actualizado exitosamente."]);
		} else {
			return json_encode(["status_code" => 500, "message" => "Error al actualizar el usuario."]);
		}
	}


	public function confirm_delivery($idEnvio) {
		$conexion = new Conexion();
	
		// Consulta de actualización
		$sqlUpdate = "UPDATE envio SET estado = 16 WHERE id_envio = :id_envio";
	
		$updateStmt = $conexion->prepare($sqlUpdate);
	
		$updateStmt->bindParam(':id_envio', $idEnvio, PDO::PARAM_INT);
	
		// Ejecutar la consulta
		if ($updateStmt->execute()) {
			return json_encode(["status_code" => 200, "message" => "Usuario actualizado exitosamente."]);
		} else {
			return json_encode(["status_code" => 500, "message" => "Error al actualizar el usuario."]);
		}
	}

	public function get_order_details($id_envio) {
		$conexion = new Conexion();
		$id_envio = $id_envio ?? null;

		if ($id_envio) {
			$sql = "
			SELECT p.nombre AS producto, p.descripcion, sp.cantidad
			FROM salida_producto sp
			JOIN producto p ON sp.id_producto = p.id_producto
			JOIN envioxproducto ep ON sp.id_salida_producto = ep.id_salida_producto
			WHERE ep.id_envio = :id_envio";
	
			$stmt = $conexion->prepare($sql);
			$stmt->bindParam(':id_envio', $id_envio);
			$stmt->execute();
			$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
	
			if ($products) {
				return json_encode([
					"status_code" => 200,
					"message" => "Productos encontrados.",
					"products" => $products
				]);
			} else {
				return json_encode([
					"status_code" => 404,
					"message" => "No se encontraron productos para este pedido."
				]);
			}
		} else {
			return json_encode([
				"status_code" => 400,
				"message" => "ID de envío no proporcionado."
			]);
		}
	}

	public function Obtener_ordenes_aceptadas($id_usuario) {
		$conexion = new Conexion();
	
		$sql = "
		SELECT id_envio, direccion, descripcion, estado
		FROM envio
		WHERE estado = 15 and id_usuario = $id_usuario
		";
		
	
		$reg = $conexion->prepare($sql);
		$reg->execute();
	
		$ordenes = $reg->fetchAll(PDO::FETCH_ASSOC);
	
		if ($ordenes) {
			return json_encode([
				"status_code" => 200,
				"orders" => $ordenes,
			]);
		} else {
			return json_encode([
				"status_code" => 404,
				"message" => "No se encontraron órdenes aceptadas.",
			]);
		}
	}

	public function myOrden($id_usuario) {
		$conexion = new Conexion();
	
		$sql = "
		SELECT id_envio, direccion, descripcion, estado
		FROM envio
		WHERE estado = 16 and id_usuario = $id_usuario
		";
		
	
		$reg = $conexion->prepare($sql);
		$reg->execute();
	
		$ordenes = $reg->fetchAll(PDO::FETCH_ASSOC);
	
		if ($ordenes) {
			return json_encode([
				"status_code" => 200,
				"orders" => $ordenes,
			]);
		} else {
			return json_encode([
				"status_code" => 404,
				"message" => "No se encontraron órdenes aceptadas.",
			]);
		}
	}


	
}
?>
