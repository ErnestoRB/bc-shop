<?php
include_once "util/session.php";
include_once "util/database/connection.php";
include_once "util/database/querys.php";
if (!$isLogged) {
    header('Location: login.php');
    exit();
}
$isEdit = isset($_GET["edit"]);
include "handle_producto.php";
if (!isset($isError)) {
    $isError = false;
}
if (!isset($message)) {
    $message = '';
};
$connection = getConnection();
try {
    if ($isEdit) {
        $id = $_GET["edit"];
        $results = $connection->query(getProduct());
        $producto = $results->fetch_assoc();
        if (!$producto) {
            throw new Exception("No se pudo cargar el producto con id:  " . $id);
        }
        $message = "Cargado producto con id $id";
    }
} catch (Exception $e) {
    $isError = true;
    if (!isset($message)) {
        $message = '';
    };
}

$results = $connection->query(getCategories());
$categorias = array();
while ($categorias[] = $results->fetch_assoc());

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include_once "util/bootstrap.html" ?>
    <title>Panel de artículos</title>
</head>
<?php include "layout/navbar.php" ?>

<main id="content">
    <div class="container">

        <form class="form" action="<?= $_SERVER["PHP_SELF"] ?>" method="post" enctype="multipart/form-data">
            <h1><?php echo $isEdit ? "Actualizar producto" : "Registrar nuevo producto" ?></h1>
            <?php if ($isEdit) {
                echo '<input type="hidden" name="id" value="' . $id . '">';
            } ?>
            <?php include "util/handle_error.php" ?>
            <label for="nombre">Nombre</label>
            <input class="form-control" type="text" name="nombre" id="nombre" value="<?= !empty($producto["nombre"]) ? $producto["nombre"] : ''  ?>">
            <label for="categoria">Categoria</label>
            <select class="form-control" name="categoria" id="categoria">
                <?php
                foreach ($categorias as $i => $categoria) {
                    if (empty($categoria)) continue;
                    echo '
                        <option ' . (!empty($producto["idCategoria"]) ? 'selected' : '') . ' value="' . $categoria['idCategoria'] . '"> ' . $categoria["nombre"] . '</option>
                        ';
                }
                ?>
            </select>
            <label for="descripcion">Descripcion</label>
            <textarea class="form-control" name="descripcion" id="descripcion" cols="30" rows="10"><?= !empty($producto["descripcion"]) ? $producto["descripcion"] : ''  ?></textarea>
            <label for="cantidad">Cantidad</label>
            <input class="form-control" type="number" name="cantidad" id="cantidad" min="0" max="1000" value="<?= !empty($producto["existencia"]) ? $producto["existencia"] : '1'  ?>">
            <label for="precio">Precio</label>
            <input class="form-control" type="number" name="precio" id="precio" value="<?= !empty($producto["precio"]) ? $producto["precio"] : '0'  ?>">
            <label for="archivo"></label>
            <?php if (!empty($producto["imagen"])) {
                echo '
                <div class="border border-primary md:my-4 md:p-8 bg-white w-100 d-flex flex-wrap align-items-center justify-content-center">
                    <b class="text-center d-block w-100 ">Imagen subida</b>
                    <img class="img-thumbnail img-product" src="static/' . $producto["imagen"] . '" alt="" srcset="">
                </div>
            ';
            } ?>
            <div class="mb-3">
                <label for="imagen" class="form-label">Subir Imagen del producto</label>
                <input class="form-control form-control-sm" id="imagen" name="archivo" type="file" accept="image/png">
            </div>
            <button class="btn btn-primary" type="submit">Enviar</button>
        </form>
    </div>
</main>
<?php include "layout/footer.html" ?>
</body>

</html>