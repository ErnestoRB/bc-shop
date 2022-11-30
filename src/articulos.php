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

    <?php include "layout/navbar.php" ?>

    <main id="content">
        <div class="accordion" id="accordionExample">
            <div class="container">
                <h1>Artículos</h1>
                <div class="row">
                    <?php
                    $numeroArticulos = sizeof($articulos);
                    if ($numeroArticulos == 0) {
                        echo '<div class="col text-center bg-danger text-white p-4 m-4">No hay articulos, aún.</div>';
                    } else {
                        $rand = rand(0, $numeroArticulos - 1);
                    }

                    foreach ($articulos as $i => $articulo) {
                        $esDeOferta = $i == $rand;
                        echo '
                            <div class="card col-3" style="width: 18rem;">
                                <img height="256" height "256" src="/static/' . $articulo['imagen'] . '" class="img-product card-img-top img efecto3" alt="imagen de ' . $articulo['nombre'] . '">
                                <div class="card-body">
                                    <h5 class="card-title">' . $articulo['nombre'] . ($esDeOferta ? '<span class="badge text-bg-danger">Oferta!</span>' : '') . '</h5>
                                    <p class="card-text">' . $articulo['descripcion'] . '</p>
                                    <p>Existencias: ' . $articulo['existencia'] . '</p>
                                    <p>
                                        <span class="' . ($esDeOferta ? 'text-decoration-line-through text-danger' : '') . '" >$ ' . $articulo['precio'] . '</span>
                                        <span>' . ($esDeOferta ? $articulo['precio'] * 0.9 : '') . '</span>
                                    </p>
                                    <form data-cart-form>
                                        <input type="hidden" name="id" value="' . $articulo["idProducto"] . '" />
                                        <input type="number" class="form-control" name="cantidad" step="" min="1" max="' . $articulo['existencia'] . '" value="' . $articulo["idProducto"] . '" />
                                        <button type="submit" class="btn btn-primary"><i class="bi bi-cart-plus-fill"></i></button>
                                    </form>
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