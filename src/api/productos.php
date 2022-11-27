<?php
require_once __DIR__ . '/../util/database/connection.php';
require_once __DIR__ . '/../util/database/querys.php';
// siempre retorna 5 productos. Usar AJAX
$conn = getConnection();
$result = $conn->query(getLatestProducts());
$products = $result->fetch_all(MYSQLI_ASSOC);

echo json_encode($products);
