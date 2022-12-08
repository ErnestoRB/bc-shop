<?php
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(array("message" => "Sólo metodo POST"));
    exit();
}

require_once __DIR__ . '/../util/database/connection.php';
require_once __DIR__ . '/../util/database/querys.php';

$_POST = json_decode(file_get_contents('php://input'), true);

if (empty($_POST)) {
    http_response_code(400);
    echo json_encode(array("message" => "Manda JSON en el cuerpo de la petición"));
    exit();
}
$id = 0;
$cantidad = 1;
$conn = getConnection();
$ps = $conn->prepare(getProductCantidad());
$ps->bind_param("ii", $cantidad, $id);
$results = array();
foreach ($_POST as $i => $producto) {
    $id = $producto["id"];
    $cantidad = $producto["cantidad"];
    $ps->execute();
    $articulo = $ps->get_result()->fetch_assoc();
    if ($articulo["cantidad"] > $articulo["existencia"]) {
        $articulo["cantidad"] = $articulo["existencia"];
    }
    $results[] = $articulo;
}

echo json_encode(array("message" => "OK", "carrito" => $results));
