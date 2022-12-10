<?php
include_once __DIR__ . "/../util/session.php";
include_once __DIR__ . "/../util/database/connection.php";
include_once __DIR__ . "/../util/admin.php";
include_once __DIR__ . "/../util/database/querys.php";
try {
    $isDelete = $_SERVER["REQUEST_METHOD"] === 'DELETE';
    if ($isDelete) {
        include_once "util/admin.php";
        if (!esAdmin())
            throw new Exception("No tienes permisos");
        $id = $_GET["id"];
        $connection = getConnection();
        $dltProduct = $connection->prepare(deleteProduct());
        $dltProduct->bind_param("i", $id);
        $dltProduct->execute();
        $exito = $connection->affected_rows > 0;
        if (!$exito) {
            throw new Exception("No se pudo eliminar");
        }
    } else {
        http_response_code(404);
    }
} catch (Exception $e) {
    http_response_code(400);
}
