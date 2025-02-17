<?php
session_start();
include '../model/api.php';
include '../model/notificacion.php';


// Decodifica los datos JSON
$jsonData = json_decode(file_get_contents('php://input'), true);

if ($jsonData === null) {
    http_response_code(400);
    echo json_encode(["status_code" => 400, "message" => "Datos JSON inválidos."]);
    exit;
}

// Log de los datos
logPostData($jsonData);

if ($jsonData['data'] === 'login') {
    $n_api = new api();
    $response = $n_api->login([
        'email' => $jsonData['username'],
        'password' => $jsonData['password']
    ]);
    echo $response;
    exit;
}

if ($jsonData['data'] === 'get_products_barcode') {
    $n_api = new api();
    $response = $n_api->Buscar_producto_codigo_barra([
        'barcode' => $jsonData['barcode'],
    ]);
    echo $response;
    exit;
}


if ($jsonData['data'] === 'accept_shipment') {
    $n_api = new api();
    $n_notificacion = new notificacion();
    $response = $n_api->ActualizarUsuarioEnvio($jsonData['shipment_id'], $jsonData['user_id']);
    $n_notificacion -> registrar_notificacion("Envio aceptado" , "El envio ".$jsonData['shipment_id']." fue aceptado", false, $_SESSION['id_usuario'], "envos", $jsonData['shipment_id']);
    echo $response;
    exit;
}


if ($jsonData['data'] === 'get_accepted_orders') {
    $n_api = new api();
    $response = $n_api->Obtener_ordenes_aceptadas($jsonData['id_usuario']);
    echo $response;
    exit;
}

if ($jsonData['data'] === 'myOrden') {
    $n_api = new api();
    $response = $n_api->myOrden($jsonData['id_usuario']);
    echo $response;
    exit;
}

if ($jsonData['data'] === 'get_order_details') {
    $n_api = new api();
    $response = $n_api->get_order_details($jsonData['id_envio']);
    echo $response;
    exit;
}


if ($jsonData['data'] === 'confirm_delivery') {
    $n_api = new api();
    $n_notificacion = new notificacion();
    $response = $n_api->confirm_delivery($jsonData['id_envio']);
    $n_notificacion -> registrar_notificacion("Envio entregado" , "El envio ".$jsonData['id_envio']." fue entregado", false, $_SESSION['id_usuario'], "envos", $jsonData['id_envio']);
    echo $response;
    exit;
}


if ($jsonData['data'] === 'get_order_details') {
    $id_envio = $jsonData['id_envio'] ?? null;

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
            echo json_encode([
                "status_code" => 200,
                "message" => "Productos encontrados.",
                "products" => $products
            ]);
        } else {
            echo json_encode([
                "status_code" => 404,
                "message" => "No se encontraron productos para este pedido."
            ]);
        }
    } else {
        echo json_encode([
            "status_code" => 400,
            "message" => "ID de envío no proporcionado."
        ]);
    }
    exit;
}

http_response_code(404);
echo json_encode(["status_code" => 404, "message" => "Operación no reconocida."]);
exit;

// Función para registrar logs 
function logPostData($postData) {
    //$connection = new mysqli("localhost", "root", "", "gec");
    $connection = new mysqli("localhost", "u387285426_gec", ":~D^df0Q", "u387285426_gec");

    if ($connection->connect_error) {
        die("Conexión fallida: " . $connection->connect_error);
    }

    $postData = $connection->real_escape_string(json_encode($postData));
    $currentDate = date('Y-m-d H:i:s');
    $query = "INSERT INTO logs_api (post_data, fecha_registro) VALUES ('$postData', '$currentDate')";
    $connection->query($query);
    $connection->close();
}
?>