<?php
include_once "util/session.php";
include_once "util/validation.php";
include_once "util/database/connection.php";
include_once "util/database/querys.php";
$isPost = $_SERVER["REQUEST_METHOD"] === 'POST';

if (!isset($isError)) {
    $isError = false;
}
if (!isset($message)) {
    $message = '';
};
$isEditInput = isset($_POST["id"]);
try {
    if ($isPost) {
        if (!$isLogged)
            throw new Exception("No tienes permisos");
        $nombre = $_POST["nombre"];
        $categoria = $_POST["categoria"];
        $descripcion = $_POST["descripcion"];
        $cantidad = $_POST["cantidad"];
        $precio = $_POST["precio"];
        $campos = array("nombre", "categoria", "descripcion", "cantidad", "precio");
        validatePostArray($campos);
        $archivoVacio = !validateFile("archivo");
        if (!$isEditInput && $archivoVacio) {
            throw new Exception("Para registrar siempre tienes que subir una imagen del producto");
        }
        if (!$archivoVacio) {
            $file = $_FILES["archivo"];
            if (!preg_match("/image/", $file["type"])) {
                throw new Exception("No se aceptan archivos que no sean imagenes");
            }
            $filename = md5($nombre . date('c'));
            $stored = move_uploaded_file($file["tmp_name"], __DIR__ . '/static/' . $filename);
            if (!$stored) {
                throw new Exception("No se pudo guardar la imagen");
            }
        }
        $connection = getConnection();
        if ($isEditInput) {
            $id = $_POST['id'];
            if ($archivoVacio) {
                $connection->query(updateProduct($id, $nombre, $categoria, $descripcion, $cantidad, $precio));
            } else {
                $connection->query(updateProductWithImage($id, $nombre, $categoria, $descripcion, $cantidad, $precio, $filename));
            }
            $exitoso = $connection->affected_rows > 0;
            if (!$exitoso) {
                throw new Exception("Actualizar el producto falló");
            }
            $message = "Actualización correcta exitoso";
        } else {
            $connection->query(addProduct($nombre, $categoria, $descripcion, $cantidad, $precio, $filename));
            $exitoso = $connection->affected_rows > 0;
            if (!$exitoso) {
                throw new Exception("Crear el registro falló");
            }
            $message = "Registro exitoso";
        }
    }
} catch (Exception $e) {
    $isError = true;
    $message = $e->getMessage();
}
