<?php include_once "util/session.php";
if (!$isLogged) {
    header('Location: index.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include_once "util/bootstrap.html" ?>

    <title>Inicio | Pumped Up KickShop</title>
</head>

<body>

    <?php include "layout/navbar.php" ?>
    <main id="content">
        <div class="container bg-white p-2 p-md-4">
            <h1>Hola "<?= $_SESSION["user"] ?>"</h1>
            <p>Este es el panel de control. </p>
            <hr>
            <h4>Historial de pedidos</h4>
            <?php include_once "historden.php" ?>
            <?php if ($esAdmin) {
                echo '
                <hr>
                <h4>Acciones de administrador</h4>
                <div class="btn-group">
                    <a href="/registroArticulo.php" class="btn btn-primary">Registrar articulo</a>
                    <a href="/articulosPanel.php" class="btn btn-primary">Articulos</a>
                    <a href="/show_data.php" class="btn btn-primary">Estadísticas de venta</a>
                </div>
                ';
            }
            ?>

        </div>
    </main>
    <?php include "layout/footer.html" ?>
</body>

</html>