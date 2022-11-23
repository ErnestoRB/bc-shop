<?php include_once "util/session.php";
if (!$isLogged) {
    header('Location: /');
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
    <div style="background:#373737;" class="n1">
        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            <button style="background:#373737" class="btn btn-primary me-md-2" type="button"><i class="bi bi-cart-fill"></i></button>
            <button style="background:#373737" class="btn btn-primary" type="button"><i class="bi bi-person"></i></button>
        </div>
    </div>
    <?php include "layout/navbar.php" ?>
    <main id="content">
        <h1>Hola <?= $_SESSION["user"] ?></h1>
        <h2>Este es el panel de control</h2>
    </main>
    <?php include "layout/footer.html" ?>
</body>

</html>