<?php
include_once "util/session.php";
include_once "util/database/connection.php";
include_once "util/database/querys.php";

if (!isset($message)) {
    $message = '';
};
if (!isset($isError)) {
    $isError = false;
}
try {
    $isPost = $_SERVER["REQUEST_METHOD"] === 'POST';
    if ($isPost) {
        if (!$isLogged)
            throw new Exception("No tienes permisos");
        $id = $_POST["id"];
        $connection = getConnection();
        $connection->query(deleteProduct($id));
        $exito = $connection->affected_rows > 0;
        if (!$exito) {
            throw new Exception("No se pudo eliminar");
        }
        $message = "Producto eliminado";
    }
} catch (Exception $e) {
    $message = $e->getMessage();
    $isError = true;
}
