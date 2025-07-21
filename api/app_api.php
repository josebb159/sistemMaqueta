<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

$host = "localhost";
$user = "alquilav_ndb";
$password = "&^L1s,)Z_W56";
$dbname = "alquilav_ndb";


$mysqli = new mysqli($host, $user, $password, $dbname);

if ($mysqli->connect_error) {
    die(json_encode(['status' => 'error', 'message' => 'Error de conexión']));
}

$result = $mysqli->query("SELECT * FROM configuracion");

$config_general = $result->fetch_all(MYSQLI_ASSOC); // ✅ Devuelve un array de filas asociativas

$config = [];
foreach ($config_general as $row) {
    $config[$row['descripcion']] = $row['dato']; // ✅ Ahora sí accedes correctamente
}

$data = json_decode(file_get_contents("php://input"), true);
$action = $_GET['action'] ?? '';

switch ($action) {
    case 'register':
        register($mysqli, $data);
        break;
    case 'login':
        login($mysqli, $data);
        break;
    case 'login_domiciliario':
        login_domiciliario($mysqli, $data);
        break;
    case 'login_google':
        login_google($mysqli, $data);
        break;
    case 'rent_machine':
        rent_machine($mysqli, $data);
        break;
    case 'finish_rental':
        finish_rental($mysqli, $data);
        break;
    case 'get_user':
        get_user($mysqli, $data);
        break;
    case 'get_rental':
        get_rental($mysqli, $data);
        break;
    case 'get_rental_all':
        get_rental_all($mysqli, $data);
        break;
    case 'sum_rent_machine':
        sum_rent_machine($mysqli, $data);
        break;
    case 'available_machines':
        $resultado = available_machines($mysqli);
        log_api($mysqli, 'available_machines', $data, $resultado);
        break;
    case 'edit_user':
        edit_user($mysqli, $data);
        break;
    case 'accept_service':
        accept_service($mysqli, $data);
        break;
    case 'get_pending_deliveries':
        get_pending_deliveries($mysqli, $data);
        break;
    case 'get_delivery_service':
        get_delivery_service($mysqli, $data);
        break;
    case 'delivered':
        mark_delivered_or_collected($mysqli, $data, 'delivered');
        break;
    case 'collected':
        mark_delivered_or_collected($mysqli, $data, 'collected');
        break;
    case 'simulate_delivery':
        simulate_delivery($mysqli, $data);
        break;
    case  'simulate_collection':
        simulate_collection($mysqli, $data);
    case  'lavadoras_asignadas':
        lavadoras_asignadas($mysqli, $data);
        break;
    case  'update_ubicacion_domiciliario':
        update_ubicacion_domiciliario($mysqli, $data);
        break;
    case  'get_servicio_solicitud_domicialiario':
        get_servicio_solicitud_domicialiario($mysqli, $data);
        break;
     case  'get_detail_service':
        get_detail_service($mysqli, $data);
        break;
     case  'aceptar_servicio':
        aceptar_servicio($mysqli, $data);
        break;
    case  'servicio_pendiente':
        servicio_pendiente($mysqli, $data);
        break;
    case  'entregar_servicio':
        entregar_servicio($mysqli, $data);
        break;
    case  'get_rental_all_delivery':
        get_rental_all_delivery($mysqli, $data);
        break;
    case  'get_motivos':
        get_motivos($mysqli, $data);
    case  'cancelar_servicio':
        cancelar_servicio($mysqli, $data);
        break;
    case 'forgot_password':
        forgot_password($mysqli, $data);
        break;
    case 'get_ubication_domicialiario_from_deviery':
        get_ubication_domicialiario_from_deviery($mysqli, $data);
        break;
    case 'terminos_cliente':
        terminos_cliente($mysqli, $data);
        break;
    case 'terminos_delivery':
        terminos_delivery($mysqli, $data);
        break;
    case 'update_password':
        update_password($mysqli, $data);
    break;
    case 'pendiente_recoger':
        pendiente_recoger($mysqli, $data);
    break;
    case 'get_detail_service_finish':
        get_detail_service_finish($mysqli, $data);
    break;
    case 'recoger':
        recoger($mysqli, $data);
    break;
      case 'recaudado':
        recaudado($mysqli, $data);
    break;
    default:
        echo json_encode(['status' => 'error', 'message' => 'Acción no válida']);
        break;
}


function recaudado($mysqli, $data) {
     $user_id = $data['user_id'] ?? 0;
    // status_sevicio 1 = pendiente, 2 = en curso, 3 = por retirar, 4 = finalizado
    $result = $mysqli->query("SELECT monedero FROM usuarios where id = $user_id LIMIT 1");

    if ($usuario = $result->fetch_assoc()) {
        echo json_encode(['status' => 'ok', 'recaudado' => $usuario['monedero']]);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'No hay alquiler activo']);
    }
}

function recoger($mysqli, $data) {
    $user_id = $data['user_id'] ?? 0;
    $id_alquiler = $data['id_alquiler'] ?? null;
    $total = $data['total'] ?? null;


    if (!$user_id || $id_alquiler === null ) {
        echo json_encode(['status' => 'error', 'message' => 'Datos incompletos']);
        return;
    }

    $stmt = $mysqli->prepare("UPDATE alquileres SET status_servicio = 4   WHERE id = ?");
    $stmt->bind_param("i",  $id_alquiler);


    $result = $mysqli->query("SELECT alquileres FROM lavadora_id WHERE id = $id_alquiler");
   
    $row = $result->fetch_assoc();
    $lavadora_id = $row['lavadora_id'];

      $stmt = $mysqli->prepare("UPDATE lavadoras SET lavadoras = 'disponible'   WHERE id = ?");
    $stmt->bind_param("i",  $lavadora_id);



    $stmt = $mysqli->prepare("UPDATE usuarios SET monedero = monedero + ?   WHERE id = ?");
    $stmt->bind_param("ii", $total,  $user_id);

    if ($stmt->execute()) {
        echo json_encode(['status' => 'ok', 'message' => 'Servicio aceptado']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Error al aceptar']);
    }

    $stmt->close();
}

function get_detail_service_finish($mysqli, $data) {
    $id_alquiler = $data['id_alquiler'] ?? 0;
    $user_id = $data['user_id'] ?? 0;
    

    if (!$id_alquiler) {
        echo json_encode(['status' => 'error', 'message' => 'ID de alquiler no proporcionado']);
        return;
    }

   
    $sql = "
        SELECT 
            alquileres.latitud AS lat_client,
            alquileres.longitud AS long_client,
            u_delivery.latitud AS lat_delivery,
            u_delivery.longitud AS long_delivery,
            u_cliente.nombre AS nombre,
            u_cliente.direccion AS direccion,
            u_cliente.telefono AS telefono,
            lavadoras.*,
            alquileres.conductor_id,
            precios_lavado.precio,
            alquileres.fecha_inicio,
            alquileres.fecha_fin
        FROM alquileres
        JOIN usuarios AS u_cliente ON alquileres.user_id = u_cliente.id
        LEFT JOIN usuarios AS u_delivery ON $user_id = u_delivery.id
        JOIN lavadoras ON alquileres.lavadora_id = lavadoras.id
        JOIN precios_lavado on precios_lavado.id_negocio = alquileres.negocio_id and lavadoras.type = precios_lavado.tipo_lavadora
        WHERE alquileres.id = $id_alquiler
          AND alquileres.status = 'finalizado'
        LIMIT 1
    ";

    $result = $mysqli->query($sql);

    if (!$result || $result->num_rows === 0) {
        echo json_encode(['status' => 'error', 'message' => 'No se encontró servicio activo']);
        return;
    }

    $data = $result->fetch_assoc();

    echo json_encode([
        'status' => 'ok',
        'servicio' => $data
    ]);
}

function pendiente_recoger($mysqli, $data) {
    $user_id = $data['user_id'] ?? 0;

    if (!$user_id) {
        echo json_encode(['status' => 'error', 'message' => 'ID de usuario no proporcionado']);
        return;
    }

    // Obtener el ID del negocio asignado al conductor
    $result = $mysqli->query("SELECT conductor_negocio FROM usuarios WHERE id = $user_id");
    if (!$result || $result->num_rows === 0) {
        echo json_encode(['status' => 'error', 'message' => 'Usuario no encontrado']);
        return;
    }

    $row = $result->fetch_assoc();
    $conductor_negocio = $row['conductor_negocio'];

    // Buscar si tiene un servicio activo con status_servicio = 1
    $query = $mysqli->query("SELECT * FROM alquileres WHERE negocio_id = $conductor_negocio AND conductor_id = $user_id AND status_servicio = 3 AND status = 'finalizado' LIMIT 1");

    if ($query && $query->num_rows > 0) {
        $servicio = $query->fetch_assoc();

        echo json_encode([
            'status' => 'ok',
            'servicio' => $servicio
        ]);
    } else {
        echo json_encode(['status' => 'ok', 'servicio' => null]);
    }
}
function update_password($mysqli, $data) {
    $contrasena = $data['password'] ?? '';
    $id = $data['id'] ?? 0;

    if (empty($contrasena) || empty($id)) {
        echo json_encode(['status' => 'error', 'message' => 'Faltan datos']);
        return;
    }

    $hash = password_hash($contrasena, PASSWORD_DEFAULT);

    $stmt = $mysqli->prepare("UPDATE usuarios SET contrasena = ? WHERE id = ?");
    $stmt->bind_param("si", $hash, $id);

    if ($stmt->execute()) {
        echo json_encode(['status' => 'ok', 'message' => 'Contraseña actualizada']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'No se pudo actualizar la contraseña']);
    }

    $stmt->close();
}


/**
 * Fetches and returns delivery terms and usage terms from the database.
 *
 * Queries the 'terminos_condiciones' table to retrieve 'terminos_delivery' 
 * and 'terminos_uso_delivery'. Outputs a JSON response with the terms if found, 
 * otherwise returns an error message.
 *
 * @param mysqli $mysqli The MySQLi connection object.
 * @param array $data The data array, not used in this function.
 */

function terminos_delivery($mysqli, $data) {
 
    // status_sevicio 1 = pendiente, 2 = en curso, 3 = por retirar, 4 = finalizado
    $result = $mysqli->query("SELECT terminos_delivery, terminos_uso_delivery FROM terminos_condiciones ");

    if ($terminos = $result->fetch_assoc()) {
        echo json_encode(['status' => 'ok', 'terminos' => $terminos]);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'No hay alquiler activo']);
    }
}

function terminos_cliente($mysqli, $data) {
 
    // status_sevicio 1 = pendiente, 2 = en curso, 3 = por retirar, 4 = finalizado
    $result = $mysqli->query("SELECT terminos, terminos_uso FROM terminos_condiciones ");

    if ($terminos = $result->fetch_assoc()) {
        echo json_encode(['status' => 'ok', 'terminos' => $terminos]);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'No hay alquiler activo']);
    }
}


function get_ubication_domicialiario_from_deviery($mysqli, $data) {
    $user_id = $data['user_id'] ?? 0;

    $result = $mysqli->query("
        SELECT 
            alquileres.latitud AS latitud_servicio, 
            alquileres.longitud AS longitud_servicio, 
            usuarios.latitud AS latitud_delivery, 
            usuarios.longitud AS longitud_delivery 
        FROM usuarios, alquileres 
        WHERE alquileres.conductor_id = usuarios.id 
          AND alquileres.status_servicio = 1 
          AND alquileres.user_id = $user_id
    ");

    if ($result && $row = $result->fetch_assoc()) {
        echo json_encode([
            'status' => 'ok',
            'ubication' => [
                'servicio' => [
                    'latitud' => $row['latitud_servicio'],
                    'longitud' => $row['longitud_servicio']
                ],
                'domiciliario' => [
                    'latitud' => $row['latitud_delivery'],
                    'longitud' => $row['longitud_delivery']
                ]
            ]
        ]);
    } else {
        echo json_encode([
            'status' => 'error',
            'message' => 'No se encontraron ubicaciones'
        ]);
    }
}

function forgot_password($mysqli, $data) {
    $email = $data['email'] ?? null;

    if (!$email) {
        echo json_encode(['status' => 'error', 'message' => 'Correo electrónico requerido']);
        return;
    }

    // Verificar si el usuario existe
    $stmt = $mysqli->prepare("SELECT * FROM usuarios WHERE correo = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        // Generar un token aleatorio de 10 caracteres
        $token = substr(str_shuffle(str_repeat(
            $x = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ',
            ceil(10 / strlen($x))
        )), 1, 10);

        // Guardar el token en la base de datos
        $stmt1 = $mysqli->prepare("UPDATE usuarios SET tocken_recovery = ? WHERE id = ?");
        $stmt1->bind_param("si", $token, $user['id']);
        $stmt1->execute();
        $stmt1->close(); // <- Asegúrate de cerrar el statement

        // Enviar el correo
        require 'mailRecovery.php';
        $resultado = enviarCorreoRecuperacion($email, $token);

        echo json_encode(['status' => 'ok', 'message' => 'Correo enviado con éxito']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Correo electrónico no registrado']);
    }

    $stmt->close(); // <- Cerrar también este statement al final
}

function cancelar_servicio($mysqli, $data) {
    $user_id = $data['user_id'] ?? 0;
    $id_alquiler = $data['id_alquiler'] ?? null;
    $id_motivo = $data['motivo'] ?? null;

    if (!$user_id || $id_alquiler === null) {
        echo json_encode(['status' => 'error', 'message' => 'Datos incompletos']);
        return;
    }

    // Hora actual del servidor
    $fecha_actual = date('Y-m-d H:i:s');

    // Actualizar la tabla alquileres
    $stmt1 = $mysqli->prepare("UPDATE alquileres SET motivo = ?, status_servicio = 5 WHERE id = ?");
    $stmt1->bind_param("ii", $id_motivo, $id_alquiler);
    
    if (!$stmt1->execute()) {
        echo json_encode(['status' => 'error', 'message' => 'Error al actualizar alquiler']);
        $stmt1->close();
        return;
    }
    $stmt1->close();

    // Obtener lavadora_id
    $result = $mysqli->query("SELECT lavadora_id FROM alquileres WHERE id = $id_alquiler");
    if (!$result || $result->num_rows == 0) {
        echo json_encode(['status' => 'error', 'message' => 'Lavadora no encontrada']);
        return;
    }
    $row = $result->fetch_assoc();
    $lavadora_id = $row['lavadora_id'];

    // Actualizar la lavadora como alquilada
    $stmt2 = $mysqli->prepare("UPDATE lavadoras SET status = 'disponible' WHERE id = ?");
    $stmt2->bind_param("i", $lavadora_id);
    
    if ($stmt2->execute()) {
        echo json_encode(['status' => 'ok', 'message' => 'Servicio entregado']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Error al actualizar lavadora']);
    }

    $stmt2->close();
}


function get_motivos($mysqli, $data) {

    $result = $mysqli->query("SELECT * FROM Motivos ");

    $motivos = [];
    while ($motivo = $result->fetch_assoc()) {
        $motivos[] = $motivo;  
    }

    if (count($motivos) > 0) {
        echo json_encode(['status' => 'ok', 'motivos' => $motivos]);  
    } else {
        echo json_encode(['status' => 'error', 'message' => 'No hay alquileres finalizados']);
    }
}



function get_rental_all_delivery($mysqli, $data) {
    $userId = intval($data['user_id'] ?? 0);

    $result = $mysqli->query("SELECT * FROM alquileres WHERE conductor_id = $userId ");

    $rentals = [];
    while ($rental = $result->fetch_assoc()) {
        $rentals[] = $rental;  // Añade cada alquiler a la lista de rentals
    }

    if (count($rentals) > 0) {
        echo json_encode(['status' => 'ok', 'rentals' => $rentals]);  // Devuelve la lista de alquileres
    } else {
        echo json_encode(['status' => 'error', 'message' => 'No hay alquileres finalizados']);
    }
}


function entregar_servicio($mysqli, $data) {
    $user_id = $data['user_id'] ?? 0;
    $id_alquiler = $data['id_alquiler'] ?? null;

    if (!$user_id || $id_alquiler === null) {
        echo json_encode(['status' => 'error', 'message' => 'Datos incompletos']);
        return;
    }

    // Hora actual del servidor
    $fecha_actual = date('Y-m-d H:i:s');

    // Actualizar la tabla alquileres
    $stmt1 = $mysqli->prepare("UPDATE alquileres SET start_time = ?, status_servicio = 2 WHERE id = ?");
    $stmt1->bind_param("si", $fecha_actual, $id_alquiler);
    
    if (!$stmt1->execute()) {
        echo json_encode(['status' => 'error', 'message' => 'Error al actualizar alquiler']);
        $stmt1->close();
        return;
    }


    // Obtener lavadora_id
    $result = $mysqli->query("SELECT lavadora_id FROM alquileres WHERE id = $id_alquiler");
    if (!$result || $result->num_rows == 0) {
        echo json_encode(['status' => 'error', 'message' => 'Lavadora no encontrada']);
        return;
    }
    $row = $result->fetch_assoc();
    $lavadora_id = $row['lavadora_id'];

    // Actualizar la lavadora como alquilada
    $stmt2 = $mysqli->prepare("UPDATE lavadoras SET status = 'alquilada' WHERE id = ?");
    $stmt2->bind_param("i", $lavadora_id);
    
    if ($stmt2->execute()) {
        echo json_encode(['status' => 'ok', 'message' => 'Servicio entregado']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Error al actualizar lavadora']);
    }

   
}


function servicio_pendiente($mysqli, $data) {
    $user_id = $data['user_id'] ?? 0;

    if (!$user_id) {
        echo json_encode(['status' => 'error', 'message' => 'ID de usuario no proporcionado']);
        return;
    }

    // Obtener el ID del negocio asignado al conductor
    $result = $mysqli->query("SELECT conductor_negocio FROM usuarios WHERE id = $user_id");
    if (!$result || $result->num_rows === 0) {
        echo json_encode(['status' => 'error', 'message' => 'Usuario no encontrado']);
        return;
    }

    $row = $result->fetch_assoc();
    $conductor_negocio = $row['conductor_negocio'];

    // Buscar si tiene un servicio activo con status_servicio = 1
    $query = $mysqli->query("SELECT * FROM alquileres WHERE negocio_id = $conductor_negocio AND conductor_id = $user_id AND status_servicio = 1 AND status = 'activo' LIMIT 1");

    if ($query && $query->num_rows > 0) {
        $servicio = $query->fetch_assoc();

        echo json_encode([
            'status' => 'ok',
            'servicio' => $servicio
        ]);
    } else {
        echo json_encode(['status' => 'ok', 'servicio' => null]);
    }
}

function aceptar_servicio($mysqli, $data) {
    $user_id = $data['user_id'] ?? 0;
    $id_alquiler = $data['id_alquiler'] ?? null;


    if (!$user_id || $id_alquiler === null ) {
        echo json_encode(['status' => 'error', 'message' => 'Datos incompletos']);
        return;
    }

    // Hora actual del servidor
    $fecha_actual = date('Y-m-d H:i:s');

    $stmt = $mysqli->prepare("UPDATE alquileres SET conductor_id = ?, fecha_aceptado = ?  WHERE id = ?");
    $stmt->bind_param("isi", $user_id, $fecha_actual, $id_alquiler);

    if ($stmt->execute()) {
        echo json_encode(['status' => 'ok', 'message' => 'Servicio aceptado']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Error al aceptar']);
    }

    $stmt->close();
}

function get_servicio_solicitud_domicialiario($mysqli, $data) {
    $user_id = $data['user_id'] ?? 0;

    if (!$user_id) {
        echo json_encode(['status' => 'error', 'message' => 'ID de usuario no proporcionado']);
        return;
    }

    // Obtener el ID del negocio asignado al conductor
    $result = $mysqli->query("SELECT conductor_negocio FROM usuarios WHERE id = $user_id");
    if (!$result || $result->num_rows === 0) {
        echo json_encode(['status' => 'error', 'message' => 'Usuario no encontrado']);
        return;
    }

    $row = $result->fetch_assoc();
    $conductor_negocio = $row['conductor_negocio'];

    // Buscar si tiene un servicio activo con status_servicio = 1
    $query = $mysqli->query("SELECT * FROM alquileres WHERE negocio_id = $conductor_negocio AND conductor_id = 0 AND status_servicio = 1 AND status = 'activo' LIMIT 1");

    if ($query && $query->num_rows > 0) {
        $servicio = $query->fetch_assoc();

        echo json_encode([
            'status' => 'ok',
            'servicio' => $servicio
        ]);
    } else {
        echo json_encode(['status' => 'ok', 'servicio' => null]);
    }
}

function get_detail_service($mysqli, $data) {
    $id_alquiler = $data['id_alquiler'] ?? 0;
    $user_id = $data['user_id'] ?? 0;
    

    if (!$id_alquiler) {
        echo json_encode(['status' => 'error', 'message' => 'ID de alquiler no proporcionado']);
        return;
    }

    // Consulta para obtener el detalle del servicio asignado al conductor
    $sql = "
        SELECT 
            alquileres.latitud AS lat_client,
            alquileres.longitud AS long_client,
            u_delivery.latitud AS lat_delivery,
            u_delivery.longitud AS long_delivery,
            u_cliente.nombre AS nombre,
            u_cliente.direccion AS direccion,
            u_cliente.telefono AS telefono,
            lavadoras.*,
            alquileres.conductor_id
        FROM alquileres
        JOIN usuarios AS u_cliente ON alquileres.user_id = u_cliente.id
        LEFT JOIN usuarios AS u_delivery ON $user_id = u_delivery.id
        JOIN lavadoras ON alquileres.lavadora_id = lavadoras.id
        WHERE alquileres.id = $id_alquiler
          AND alquileres.status = 'activo'
        LIMIT 1
    ";

    $result = $mysqli->query($sql);

    if (!$result || $result->num_rows === 0) {
        echo json_encode(['status' => 'error', 'message' => 'No se encontró servicio activo']);
        return;
    }

    $data = $result->fetch_assoc();

    echo json_encode([
        'status' => 'ok',
        'servicio' => $data
    ]);
}

function update_ubicacion_domiciliario($mysqli, $data) {
    $user_id = $data['user_id'] ?? 0;
    $latitud = $data['latitud'] ?? null;
    $longitud = $data['longitud'] ?? null;

    if (!$user_id || $latitud === null || $longitud === null) {
        echo json_encode(['status' => 'error', 'message' => 'Datos incompletos']);
        return;
    }

    // Hora actual del servidor
    $fecha_actual = date('Y-m-d H:i:s');

    $stmt = $mysqli->prepare("UPDATE usuarios SET latitud = ?, longitud = ?, ultima_actualizacion_ubicacion = ? WHERE id = ?");
    $stmt->bind_param("sssi", $latitud, $longitud, $fecha_actual, $user_id);

    if ($stmt->execute()) {
        echo json_encode(['status' => 'ok', 'message' => 'Ubicación actualizada correctamente']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Error al actualizar ubicación']);
    }

    $stmt->close();
}
function register($mysqli, $data) {

    $nombre = $mysqli->real_escape_string($data['nombre'] ?? '');
    $apellido = $mysqli->real_escape_string($data['apellido'] ?? '');
    $telefono = $mysqli->real_escape_string($data['telefono'] ?? '');
    $direccion = $mysqli->real_escape_string($data['direccion'] ?? '');
    $correo = $mysqli->real_escape_string($data['correo'] ?? '');
    $usuario = $mysqli->real_escape_string($data['usuario'] ?? '');
    $contrasena = $mysqli->real_escape_string($data['password'] ?? '');
    $google_token = $mysqli->real_escape_string($data['google_token'] ?? '');

    if ($correo == '') {
        header('Content-Type: application/json');
        echo json_encode(['status' => 'error', 'message' => 'Correo requerido']);
        return;
    }

    if ($google_token == '') {
        if ($usuario == '' || $contrasena == '') {
            header('Content-Type: application/json');
            echo json_encode(['status' => 'error', 'message' => 'Usuario y contraseña requeridos']);
            return;
        }
        $contrasena = password_hash($contrasena, PASSWORD_DEFAULT);
    }

    $query = "INSERT INTO usuarios (nombre, apellido, telefono, direccion, correo, usuario, contrasena, google_token)
              VALUES ('$nombre', '$apellido', '$telefono', '$direccion', '$correo', '$usuario', '$contrasena', '$google_token')";

    if ($mysqli->query($query)) {
        header('Content-Type: application/json');
        echo json_encode(['status' => 'ok', 'user_id' => $mysqli->insert_id]);
    } else {
        header('Content-Type: application/json');
        echo json_encode(['status' => 'error', 'message' => 'Error al registrar usuario']);
    }
}

function login($mysqli, $data) {
    $usuario = $mysqli->real_escape_string($data['correo'] ?? '');
    $contrasena = $mysqli->real_escape_string($data['contrasena'] ?? '');

    if ($usuario == '' || $contrasena == '') {
        echo json_encode(['status' => 'error', 'message' => 'Datos requeridos']);
        return;
    }

    $result = $mysqli->query("SELECT * FROM usuarios WHERE correo = '$usuario' LIMIT 1");

    if ($user = $result->fetch_assoc()) {
        if (password_verify($contrasena, $user['contrasena'])) {
            echo json_encode(['status' => 'ok', 'user' => $user]);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Contraseña incorrecta']);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Usuario no encontrado']);
    }
}

function mark_delivered_or_collected($mysqli, $data, $type) {
    $service_id = (int)($data['service_id'] ?? 0);

    if ($service_id <= 0) {
        echo json_encode(['status' => 'error', 'message' => 'ID de servicio inválido']);
        return;
    }

    // Define el nuevo estado según el tipo de acción
    $new_status = $type === 'delivered' ? 2 : ($type === 'collected' ? 4 : null);

    if ($new_status === null) {
        echo json_encode(['status' => 'error', 'message' => 'Tipo de acción inválido']);
        return;
    }

    $stmt = $mysqli->prepare("UPDATE alquileres SET status_servicio = ? WHERE id = ?");
    $stmt->bind_param("ii", $new_status, $service_id);

    if ($stmt->execute()) {
        echo json_encode(['status' => 'ok']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Error al actualizar estado']);
    }

    $stmt->close();
}


function get_pending_deliveries($mysqli, $data) {
 
    // status_sevicio 1 = pendiente, 2 = en curso, 3 = por retirar, 4 = finalizado
    $result = $mysqli->query("SELECT * FROM alquileres WHERE status_servicio in (1,3) AND conductor_id = 0 LIMIT 1");

    if ($rental = $result->fetch_assoc()) {
        echo json_encode(['status' => 'ok', 'rental' => $rental]);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'No hay alquiler activo']);
    }
}

function get_delivery_service($mysqli, $data) {
    $delivery_id = $mysqli->real_escape_string($data['delivery_id'] ?? '');
    // status_sevicio 1 = pendiente, 2 = en curso, 3 = por retirar, 4 = finalizado
    $result = $mysqli->query("SELECT * FROM alquileres WHERE status_servicio in (1,3) AND conductor_id = $delivery_id LIMIT 1");

    if ($rental = $result->fetch_assoc()) {
        echo json_encode(['status' => 'ok', 'rental' => $rental]);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'No hay alquiler activo']);
    }
}

function accept_service($mysqli, $data) {

    $delivery_id = $mysqli->real_escape_string($data['delivery_id'] ?? '');
    $service_id = $mysqli->real_escape_string($data['service_id'] ?? '');

 
    $query = "UPDATE alquileres SET conductor_id = $delivery_id WHERE id = $service_id";

    if ($mysqli->query($query)) {
        echo json_encode(['status' => 'ok']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Error al aceptar servicio']);
    }
}

function login_domiciliario($mysqli, $data) {
    $usuario = $mysqli->real_escape_string($data['correo'] ?? '');
    $contrasena = $mysqli->real_escape_string($data['contrasena'] ?? '');

    if ($usuario == '' || $contrasena == '') {
        echo json_encode(['status' => 'error', 'message' => 'Datos requeridos']);
        return;
    }

    $result = $mysqli->query("SELECT * FROM usuarios WHERE correo = '$usuario' and id_rol=3 LIMIT 1");

    if ($user = $result->fetch_assoc()) {
        if (password_verify($contrasena, $user['contrasena'])) {
            echo json_encode(['status' => 'ok', 'user' => $user]);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Contraseña incorrecta']);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Usuario no encontrado']);
    }
}

function login_google($mysqli, $data) {
    $correo = $mysqli->real_escape_string($data['correo'] ?? '');

    if ($correo == '') {
        echo json_encode(['status' => 'error', 'message' => 'Correo requerido']);
        return;
    }

    $result = $mysqli->query("SELECT * FROM usuarios WHERE correo = '$correo' and status=1 LIMIT 1");

    if ($user = $result->fetch_assoc()) {
        echo json_encode(['status' => 'ok', 'user' => $user]);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Usuario no registrado']);
    }
}

function rent_machine($mysqli, $data) {
    global $km, $global_tarifa;
    $userId = intval($data['user_id'] ?? 0);
    $tiempo = intval($data['tiempo'] ?? 0);


    if ($userId == 0 || $tiempo == 0) {
        echo json_encode(['status' => 'error', 'message' => 'Datos incompletos']);
        return;
    }
    $latitud = floatval($data['latitud'] ?? 0);
    $longitud = floatval($data['longitud'] ?? 0);


    // debe existir id_lavadora
    if(!isset($data['id_lavadora'])) {
        $negocios = [];
        $result = $mysqli->query("SELECT id, latitud, longitud FROM negocios");
        while ($row = $result->fetch_assoc()) {
            $distancia = calcularDistancia($latitud, $longitud, $row['latitud'], $row['longitud']);
            if ($distancia <= $km) {
                $row['distancia_km'] = $distancia;
                $negocios[] = $row;
            }
        }
        
        if (!empty($negocios)) {
            $ids_negocios = array_column($negocios, 'id');
            $ids_sql = implode(',', array_map('intval', $ids_negocios)); // sanitizar IDs
        
            $result = $mysqli->query("SELECT * FROM lavadoras WHERE status = 'disponible' AND negocio_id IN ($ids_sql) LIMIT 1");
           
            if ($lavadora = $result->fetch_assoc()) {
             
            } else {
                echo json_encode(["mensaje" => "No hay lavadoras disponibles en negocios cercanos"]);
                die();
            }
        } else {
            echo json_encode(["mensaje" => "No hay negocios dentro de $km km"]);
            die();
        }
    }else{
        $result = $mysqli->query("SELECT * FROM lavadoras WHERE status = 'disponible' AND id = {$data['id_lavadora']} LIMIT 1");
        
    }
 
    if ($lavadora = $result->fetch_assoc() || isset($data['id_lavadora'])) {
        
        if(isset($data['id_lavadora'])){
            $result = $mysqli->query("SELECT * FROM lavadoras WHERE status = 'disponible' AND id =".$data['id_lavadora']);
     
            $lavadora = $result->fetch_assoc();
        }

        $lavadoraId = $lavadora['id'];
        $negocio = $lavadora['negocio_id'];
        $metodo = $data['payment_method'];


        $result = $mysqli->query("SELECT * FROM config WHERE id_negocio = $negocio LIMIT 1");
        $config = $result->fetch_assoc();
        $tarifa =  $global_tarifa;
        if ($config) {
            $tarifa = $config['tarifa'];
        }

        $mysqli->query("UPDATE lavadoras SET status = 'alquilada' WHERE id = $lavadoraId");
        $mensaje = "Se registro nuevo alquiler";
        $notify = "INSERT INTO notificaciones (mensaje, negocio)
                  VALUES ('$mensaje', $negocio)";
        $mysqli->query($notify);
        $query = "INSERT INTO alquileres (user_id, lavadora_id, tiempo_alquiler, status, fecha_inicio, latitud, longitud, valor_servicio, negocio_id, metodo_pago)
                  VALUES ($userId, $lavadoraId, $tiempo, 'activo', NOW(), '$latitud', '$longitud', $tarifa, $negocio, '$metodo')";

        if ($mysqli->query($query)) {
            echo json_encode(['status' => 'ok', 'lavadora_id' => $lavadoraId]);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Error al realizar alquiler']);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'No hay lavadoras disponibles']);
    }
}

function sum_rent_machine($mysqli, $data) {
    $userId = intval($data['user_id'] ?? 0);

        $mysqli->query("UPDATE alquileres SET tiempo_alquiler = tiempo_alquiler+1 WHERE user_id = $userId AND status = 'activo' LIMIT 1");
       
}

function finish_rental($mysqli, $data) {
    $rentalId = intval($data['rental_id'] ?? 0);

    if ($rentalId == 0) {
        echo json_encode(['status' => 'error', 'message' => 'ID de alquiler requerido']);
        return;
    }

    $result = $mysqli->query("SELECT lavadora_id FROM alquileres WHERE id = $rentalId AND status = 'activo' LIMIT 1");

    if ($rental = $result->fetch_assoc()) {
        $lavadoraId = $rental['lavadora_id'];

        $mysqli->query("UPDATE lavadoras SET status = 'disponible' WHERE id = $lavadoraId");
        $mysqli->query("UPDATE alquileres SET status = 'finalizado', status_servicio = 3, fecha_fin = NOW() WHERE id = $rentalId");

        echo json_encode(['status' => 'ok']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Alquiler no encontrado o ya finalizado']);
    }
}

function get_user($mysqli, $data) {
    $userId = intval($data['id'] ?? 0);

    $result = $mysqli->query("SELECT * FROM usuarios WHERE id = $userId LIMIT 1");

    if ($user = $result->fetch_assoc()) {
        echo json_encode(['status' => 'ok', 'user' => $user]);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Usuario no encontrado']);
    }
}

function get_rental($mysqli, $data) {
    $userId = intval($data['user_id'] ?? 0);

    $result = $mysqli->query("SELECT * FROM alquileres WHERE user_id = $userId AND status_servicio in (1,2,3) LIMIT 1");

    if ($rental = $result->fetch_assoc()) {
        echo json_encode(['status' => 'ok', 'rental' => $rental]);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'No hay alquiler activo']);
    }
}

function get_rental_all($mysqli, $data) {
    $userId = intval($data['user_id'] ?? 0);

    $result = $mysqli->query("SELECT * FROM alquileres WHERE user_id = $userId AND status = 'finalizado'");

    $rentals = [];
    while ($rental = $result->fetch_assoc()) {
        $rentals[] = $rental;  // Añade cada alquiler a la lista de rentals
    }

    if (count($rentals) > 0) {
        echo json_encode(['status' => 'ok', 'rentals' => $rentals]);  // Devuelve la lista de alquileres
    } else {
        echo json_encode(['status' => 'error', 'message' => 'No hay alquileres finalizados']);
    }
}


function lavadoras_asignadas($mysqli, $data) {
    $userId = intval($data['user_id'] ?? 0);

    $result = $mysqli->query("SELECT lavadoras.*, precios_lavado.precio from lavadoras, precios_lavado where lavadoras.negocio_id = precios_lavado.id_negocio and lavadoras.type = precios_lavado.tipo_lavadora and tipo_servicio='normal' and $userId = lavadoras.id_domiciliario");

    $asings = [];
    while ($asing = $result->fetch_assoc()) {
        $asings[] = $asing;  // Añade cada alquiler a la lista de rentals
    }

    if (count($asings) > 0) {
        echo json_encode(['status' => 'ok', 'asignadas' => $asings]);  // Devuelve la lista de alquileres
    } else {
        echo json_encode(['status' => 'error', 'message' => 'No hay lavadoras asignadas']);
    }
}


function edit_user($mysqli, $data) {
    $userId = intval($data['id'] ?? 0);
    $nombre = $mysqli->real_escape_string($data['nombre'] ?? '');
    $apellido = $mysqli->real_escape_string($data['apellido'] ?? '');
    $telefono = $mysqli->real_escape_string($data['telefono'] ?? '');
    $direccion = $mysqli->real_escape_string($data['direccion'] ?? '');

    if ($userId == 0) {
        echo json_encode(['status' => 'error', 'message' => 'ID de usuario requerido']);
        return;
    }

    $query = "UPDATE usuarios SET nombre = '$nombre', apellido = '$apellido', telefono = '$telefono', direccion = '$direccion' WHERE id = $userId";

    if ($mysqli->query($query)) {
        echo json_encode(['status' => 'ok']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Error al editar usuario']);
    }
}


function available_machines($mysqli) {
    global $km, $global_tarifa;
    $latitud = floatval($data['latitud'] ?? 0);
    $longitud = floatval($data['longitud'] ?? 0);

    if ($latitud == 0 || $longitud == 0) {
        echo json_encode(['status' => 'error', 'message' => 'Datos incompletos']);
        return;
    }

   $tipos_lavadora = [
    'Manual doble tina sin bomba',
    'Manual doble tina con bomba',
    'Automática de 18 libras',
    'Automática de 24 libras'
];

$response = [];

$tipos_lavadora = [
    'Manual doble tina sin bomba',
    'Manual doble tina con bomba',
    'Automática de 18 libras',
    'Automática de 24 libras'
];

$response = ['status' => 'ok', 'data' => []];

foreach ($tipos_lavadora as $tipo) {
    // Buscar lavadoras disponibles de ese tipo
    $query = "SELECT lavadoras.*, usuarios.latitud, usuarios.longitud FROM lavadoras
    JOIN usuarios ON lavadoras.id_domiciliario = usuarios.id
     WHERE status = 'disponible' AND type = '$tipo'";
    $result = $mysqli->query($query);
    $disponibles = $result->num_rows;

    $lavadora = $result->fetch_assoc(); // Tomamos la primera lavadora como ejemplo

    if ($lavadora) {
        $id_negocio = $lavadora['negocio_id'];
        $id_lavadora = $lavadora['id'];

        // Obtener todas las tarifas para este tipo de lavadora y negocio
        $tarifas_query = "SELECT tipo_servicio, precio FROM precios_lavado 
                          WHERE tipo_lavadora = '$tipo' AND id_negocio = $id_negocio";
        $tarifas_result = $mysqli->query($tarifas_query);

        $tarifas = [
            'normal' => 0,
            '24horas' => 0,
            'nocturno' => 0
        ];
        $is_in_range = estaDentroDelRango($latitud, $longitud, $lavadora['latitud'], $lavadora['longitud'], $km);
        if ($is_in_range) {
            $tarifas['normal'] = $global_tarifa;
     
        while ($row = $tarifas_result->fetch_assoc()) {
            $tipo_servicio = $row['tipo_servicio'];
            $tarifas[$tipo_servicio] = (float)$row['precio'];
        }

        $response['data'][] = [
            'type' => $tipo,
            'disponibles' => $disponibles,
            'id_lavadora' => (int)$id_lavadora,
            'tarifas' => $tarifas
        ];
    }else{

  $response['data'][] = [
            'type' => $tipo,
            'disponibles' => 0,
            'id_lavadora' => 0,
            'tarifas' => [
                'normal' => 0,
                '24horas' => 0,
                'nocturno' => 0
            ]
        ];

    }
    } else {
        $response['data'][] = [
            'type' => $tipo,
            'disponibles' => 0,
            'id_lavadora' => 0,
            'tarifas' => [
                'normal' => 0,
                '24horas' => 0,
                'nocturno' => 0
            ]
        ];
    }
}

header('Content-Type: application/json');
echo json_encode($response);
return $response;
}

function estaDentroDelRango($lat1, $lon1, $lat2, $lon2, $km_maximo) {
    $radioTierra = 6371; // Radio de la Tierra en kilómetros
    echo "lat1: $lat1, lon1: $lon1, lat2: $lat2, lon2: $lon2, km_maximo: $km_maximo";
    // Convertir grados a radianes
    $lat1 = deg2rad($lat1);
    $lon1 = deg2rad($lon1);
    $lat2 = deg2rad($lat2);
    $lon2 = deg2rad($lon2);

    // Fórmula de Haversine
    $difLat = $lat2 - $lat1;
    $difLon = $lon2 - $lon1;

    $a = sin($difLat / 2) * sin($difLat / 2) +
         cos($lat1) * cos($lat2) *
         sin($difLon / 2) * sin($difLon / 2);

    $c = 2 * atan2(sqrt($a), sqrt(1 - $a));
    $distancia = $radioTierra * $c;

    // Retorna true si está dentro del rango
    return $distancia <= $km_maximo;
}



function get_ubication_domicialiario($mysqli, $data) {
    $user_id = $data['user_id'] ?? 0;
    $result = $mysqli->query("SELECT latitud, longitud FROM usuarios WHERE id = $user_id");
    $row = $result->fetch_assoc();
    echo json_encode(['status' => 'ok', "ubication" => [ 'latitud' => $row['latitud'], 'longitud' => $row['longitud']]]);
}

function calcularDistancia($lat1, $lon1, $lat2, $lon2) {
    $radioTierra = 6371; // Radio de la tierra en km

    $dLat = deg2rad($lat2 - $lat1);
    $dLon = deg2rad($lon2 - $lon1);

    $a = sin($dLat / 2) * sin($dLat / 2) +
         cos(deg2rad($lat1)) * cos(deg2rad($lat2)) *
         sin($dLon / 2) * sin($dLon / 2);

    $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

    return $radioTierra * $c;
}


function simulate_collection($mysqli, $data) {
    $userId = intval($data['user_id'] ?? 0);

    $temporalUserDelivery = 25;

    if ($userId == 0) {
        echo json_encode(['status' => 'error', 'message' => 'ID de usuario requerido']);
        return;
    }
    // actualizo el servicio y la fecha de inicio del servicio a la fecha actual
    $query = "UPDATE alquileres SET  status_servicio = 4 WHERE user_id = $userId ";


    if ($mysqli->query($query)) {
        echo json_encode(['status' => 'ok']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Error al editar usuario']);
    }
}



function simulate_delivery($mysqli, $data) {
    $userId = intval($data['user_id'] ?? 0);

    $temporalUserDelivery = 25;

    if ($userId == 0) {
        echo json_encode(['status' => 'error', 'message' => 'ID de usuario requerido']);
        return;
    }
    // actualizo el servicio y la fecha de inicio del servicio a la fecha actual
    $query = "UPDATE alquileres SET start_time = NOW(), conductor_id = $temporalUserDelivery, status_servicio = 2 WHERE user_id = $userId ";


    if ($mysqli->query($query)) {
        echo json_encode(['status' => 'ok']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Error al editar usuario']);
    }
}

function log_api($mysqli, $accion, $entrada, $salida) {
    $stmt = $mysqli->prepare("INSERT INTO api_logs (accion, entrada, salida) VALUES (?, ?, ?)");
    $entrada_json = json_encode($entrada);
    $salida_json = json_encode($salida);
    $stmt->bind_param("sss", $accion, $entrada_json, $salida_json);
    $stmt->execute();
    $stmt->close();
}


?>