<?php
include "util/session.php";
include "util/database/connection.php";
include "util/database/querys.php";
$isPost = $_SERVER["REQUEST_METHOD"] === 'POST';

if ($isPost) {
    $id = $_POST["id"];
    $nombre = $_POST["nombre"];
    $categoria = $_POST["categoria"];
    $descripcion = $_POST["descripcion"];
    $cantidad = $_POST["cantidad"];
    $precio = $_POST["precio"];
    if ($isset($_FILES["archivo"])) {
        $file = $_FILES["archivo"];
        if ($file["type"] !== 'image/png') {
            echo "No se aceptan imagenes que no sean PNG";
            exit(1);
        }
        $filename = md5($nombre . date('c'));
        $stored = move_uploaded_file($file["tmp_name"], __DIR__ . '/static/' . $filename);
        if (!$stored) {
            echo "No se pudo guardar la imagen";
            exit(1);
        }
    }
    $connection = getConnection();
    $connection->query(updateProduct($id, $nombre, $categoria, $descripcion, $cantidad, $precio, $filename));
    $exitoso = $connection->affected_rows > 0;
    if (!$exitoso) {
        echo "Registro no exitoso";
        exit(1);
    }
}
