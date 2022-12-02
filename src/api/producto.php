<?php
require_once __DIR__ . '/../util/database/connection.php';
require_once __DIR__ . '/../util/database/querys.php';
if (isset($_GET["id"])) {
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
    echo json_encode($results[0]);
    return;
}

http_response_code(400);
echo "";
