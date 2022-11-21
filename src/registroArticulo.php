<?php
include "util/session.php";

$isEdit = isset($_GET["edit"]);
if ($isEdit) {
    $id = $_GET["edit"];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include "util/bootstrap.html" ?>
    <title>Panel de artículos</title>
</head>
<div style="background:#373737;""class=" n1">
    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
        <button style="background:#373737" class="btn btn-primary me-md-2" type="button"><i class="bi bi-cart-fill"></i></button>
        <button style="background:#373737" class="btn btn-primary" type="button"><i class="bi bi-person"></i></button>
    </div>
</div>
<?php include "layout/navbar.php" ?>

<main id="content">
    <div class="container">

        <form class="form" action="add_producto.php" method="post">
            <h1><?php echo $isEdit ? "Actualizar producto" : "Registrar nuevo producto" ?></h1>
            <label for="nombre">Nombre</label>
            <input class="form-control" type="text" name="nombre" id="nombre">
            <label for="categoria">Categoria</label>
            <select class="form-control" name="categoria" id="categoria">

            </select>
            <label for="descripcion">Descripcion</label>
            <textarea class="form-control" name="descripcion" id="descripcion" cols="30" rows="10">  </textarea>
            <label for="cantidad">Cantidad</label>
            <input class="form-control" type="number" name="cantidad" id="cantidad" min="0" max="1000" value="1">
            <label for="precio">Precio</label>
            <input class="form-control" type="number" name="precio" id="precio">
            <label for="archivo"></label>
            <div class="mb-3">
                <label for="imagen" class="form-label">Imagen del producto</label>
                <input class="form-control form-control-sm" id="imagen" type="file" accept="image/png">
            </div>
            <button class="btn btn-primary" type="submit">Enviar</button>
        </form>
    </div>
</main>
<?php include "layout/footer.html" ?>
</body>

</html>