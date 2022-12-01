<?php
include_once "util/session.php";
include_once "util/database/connection.php";
include_once "util/database/querys.php";
$isPost = $_SERVER["REQUEST_METHOD"] === 'POST';
try {
    if ($isPost) {
        if (!$isLogged)
            throw new Exception("No tienes permisos");
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
                throw new Exception("No se pudo guardar la imagen");
            }
        }
        $connection = getConnection();
        $connection->query(updateProduct());
        $exitoso = $connection->affected_rows > 0;
        if (!$exitoso) {
            throw new Exception("Registro no exitoso");
        }
        $message = "Actualización exitosa";
    }
} catch (Exception $e) {
    $message = $e->getMessage();
    $isError = true;
}
