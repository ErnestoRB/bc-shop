<?php
include_once "util/session.php";
include_once "util/database/connection.php";
include_once "util/database/querys.php";
$articulos = array();
if (!isset($isError)) {
    $isError = false;
}
if (!isset($message)) {
    $message = '';
};
try {
    //code...
    $connection = getConnection();
    $result = $connection->query(getProducts());
    $articulos = $result->fetch_all(MYSQLI_ASSOC);
} catch (Exception $e) {
    $isError = true;
    $message = $e->getMessage();
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include_once "util/bootstrap.html" ?>
    <script src="js/alerta_eliminar.js"></script>
    <title>Panel de artículos</title>
    <title>Tienda</title>
</head>

<body>
    <div style="background:#373737;" class="n1">
        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            <button style="background:#373737" class="btn btn-primary me-md-2" type="button"><i class="bi bi-cart-fill"></i></button>
            <button style="background:#373737" class="btn btn-primary" type="button"><i class="bi bi-person"></i></button>
        </div>
    </div>
    <?php include "layout/navbar.php" ?>

    <main id="content">
        <div class="accordion" id="accordionExample">
            <div class="container">
                <div class="row">
                    <a href="registroArticulo.php" class="btn btn-primary">Registrar articulo</a>
                </div>
                <div class="row">
                    <?php
                    if (sizeof($articulos) == 0) {
                        echo '<div class="col text-center bg-danger text-white p-4 m-4">No hay articulos, aún. Registra algunos <a class="btn btn-info" href="registroArticulo.php">aquí</a></div>';
                    }

                    foreach ($articulos as $i => $articulo) {
                        echo '
                            <div class="card col-3" style="width: 18rem;">
                                <img height="256" height "256" src="/static/' . $articulo['imagen'] . '" class="img-product card-img-top" alt="imagen de ' . $articulo['nombre'] . '">
                                <div class="card-body">
                                    <h5 class="card-title">' . $articulo['nombre'] . '</h5>
                                    <p class="card-text">' . $articulo['descripcion'] . '</p>
                                    <p>Existencias: ' . $articulo['existencia'] . '</p>
                                    <p>$ ' . $articulo['precio'] . '</p>
                                    <a href="/registroArticulo.php?edit=' . $articulo['idProducto']  . '" class="btn btn-primary">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <button type="button" data-eliminar-producto="' . $articulo['idProducto'] . '" class="btn btn-danger"><i class="bi bi-trash-fill"></i></button>
                                </div>
                            </div>
                    ';
                    }
                    ?>


                </div>
            </div>
        </div>
    </main>
    <?php include "layout/footer.html" ?>
</body>

</html>