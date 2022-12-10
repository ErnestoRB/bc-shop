<?php
require_once __DIR__ . '/../util/session.php';
require_once __DIR__ . '/../util/database/connection.php';
require_once __DIR__ . '/../util/database/querys.php';
// siempre retorna 5 productos. Usar AJAX
$idOferta = '';
if (isset($_SESSION["oferta"])) {
    $idOferta = $_SESSION["oferta"];
}
$conn = getConnection();
if (!empty($_GET["categoria"])) {
    $categoria = $_GET["categoria"];
    if ($categoria == 'todos') {
        $ps = $conn->prepare(getProducts());
        $ps->execute();
        $data = $ps->get_result();
        $results = $data->fetch_all(MYSQLI_ASSOC);
        foreach ($results as &$articulo) {
            if ($articulo['idProducto'] == $idOferta) {
                $articulo['oferta'] = true;
            }
        }
        unset($articulo);
        echo json_encode($results);
        exit();
    }
    $ps = $conn->prepare(getProductsByCategory());
    $ps->bind_param("i", $categoria);
    $ps->execute();
    $data = $ps->get_result();
    if (!$data) {
        http_response_code(404);
        exit();
    }
    $results = $data->fetch_all(MYSQLI_ASSOC);
    foreach ($results as &$articulo) {
        if ($articulo['idProducto'] == $idOferta) {
            $articulo['oferta'] = true;
        }
    }
    unset($articulo);
    echo json_encode($results);
    exit();
}
$result = $conn->query(getLatestProducts());
$products = $result->fetch_all(MYSQLI_ASSOC);
foreach ($products as &$articulo) {
    if ($articulo['idProducto'] == $idOferta) {
        $articulo['oferta'] = true;
    }
}
unset($articulo);
echo json_encode($products);
