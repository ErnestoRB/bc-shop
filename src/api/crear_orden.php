<?php

require_once __DIR__ . '/../util/session.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(array("message" => "Sólo metodo POST"));
    exit();
}

$_POST = json_decode(file_get_contents('php://input'), true);

if (empty($_POST)) {
    http_response_code(400);
    echo json_encode(array("message" => "Manda JSON en el cuerpo de la petición"));
    exit();
}

if (!$isLogged) {
    http_response_code(401);
    echo json_encode(array("message" => "Necesitas iniciar sesión para comprar"));
    exit();
}

require_once __DIR__ . '/../util/database/connection.php';
require_once __DIR__ . '/../util/database/querys.php';

if (empty($_SESSION["orden"])) {
    http_response_code(400);
    echo json_encode(array("message" => "Solicitud no válida"));
    exit();
}

$connection = getConnection();
try {
    $connection->begin_transaction();
    $psVenta = $connection->prepare(registerSale()); // registrar una venta (tabla venta)
    $psVenta->bind_param("iis", $_SESSION["id"], $_POST["envio"], $_POST["pago"]);
    $psVenta->execute();
    $idVenta = $psVenta->insert_id;
    $psArticuloVenta = $connection->prepare(addProductToSale()); // agregar articulo a venta (tabla venta_producto)
    $psDecreaseExistencia = $connection->prepare(decreaseExistencias());  // decrementar existencias (tabla producto)
    $idProducto = 0;
    $cantidad = 1;
    $articulosCarrito = $_SESSION["orden"]["articulos"];
    $psArticuloVenta->bind_param("iii", $idProducto, $idVenta, $cantidad);
    $psDecreaseExistencia->bind_param("ii", $cantidad, $idProducto);
    foreach ($articulosCarrito as $articulo) {
        $idProducto = $articulo["idProducto"];
        $cantidad = $articulo["cantidad"];
        $psArticuloVenta->execute();
        $psDecreaseExistencia->execute();
    }
    $psCupones = $connection->prepare(addCouponToSale());
    $idCupon = '';
    $psCupones->bind_param("is", $idVenta, $idCupon);
    $cuponesVenta = $_SESSION["orden"]["cupones"];
    foreach ($cuponesVenta as $codigo) {
        if (empty($codigo)) continue;
        $idCupon = $codigo;
        $psCupones->execute();
    }
    $connection->commit();
    echo json_encode(array("message" => "Orden creada", "link" => '/orden.php?id=' . $idVenta));
} catch (\Throwable $th) {
    $connection->rollback();
    http_response_code(500);
    echo json_encode(array("message" => $th->getMessage()));
}
