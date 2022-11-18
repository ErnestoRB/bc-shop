<?php
include "util/database/connection.php";
include "util/database/querys.php";
$isPost = $_SERVER["REQUEST_METHOD"] === 'POST';
if ($isPost) {
    $id = $_POST["id"];
    $connection = getConnection();
    $connection->query(deleteProduct($id));
    $exito = $connection->affected_rows > 0;
    if (!$exito) {
        exit(1);
    }
}
