<?php
require_once __DIR__ . '/../util/session.php';
require_once __DIR__ . '/../util/database/connection.php';
require_once __DIR__ . '/../util/database/querys.php';
$idOferta = '';
if (isset($_SESSION["oferta"])) {
    $idOferta = $_SESSION["oferta"];
}
if (isset($_GET["id"])) {
    if (isset($_SESSION["oferta"])) {
        $idOferta = $_SESSION["oferta"];
    }
    $id = $_GET["id"];
    $conn = getConnection();
    $ps = $conn->prepare(getProduct());
    $ps->bind_param("i", $id);
    $ps->execute();
    $results = $ps->get_result()->fetch_all(MYSQLI_ASSOC);
    if (sizeof($results) === 0) {
        http_response_code(404);
        exit();
    }
    $articulo = &$results[0];
    if ($idOferta == $articulo["idProducto"]) {
        $articulo["oferta"] = true;
    }
    echo json_encode($results[0]);
    return;
}

http_response_code(400);
echo "";
