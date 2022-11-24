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
        <h1>Hola <?= $_SESSION["user"] ?></h1>
        <h2>Este es el panel de control</h2>
        <div class="btn-group">
            <a href="/registroArticulo.php" class="btn btn-primary">Registrar articulo</a>
            <a href="/articulosPanel.php" class="btn btn-primary">Articulos</a>
        </div>
    </main>
    <?php include "layout/footer.html" ?>
</body>
</html>