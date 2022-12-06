<?php
require_once __DIR__ . '/../util/database/connection.php';
require_once __DIR__ . '/../util/database/querys.php';
// siempre retorna 5 productos. Usar AJAX
$conn = getConnection();
if (!empty($_GET["categoria"])) {
    $categoria = $_GET["categoria"];
    if ($categoria == 'todos') {
        $ps = $conn->prepare(getProducts());
        $ps->execute();
        $data = $ps->get_result();
        echo json_encode($data->fetch_all(MYSQLI_ASSOC));
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
    echo json_encode($data->fetch_all(MYSQLI_ASSOC));
    exit();
}
$result = $conn->query(getLatestProducts());
$products = $result->fetch_all(MYSQLI_ASSOC);

echo json_encode($products);
