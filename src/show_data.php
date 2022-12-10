<?php
include_once "util/session.php";
include_once "util/admin.php";

require_once './util/database/connection.php';
require_once './util/database/querys.php';

if (!$isLogged) {
    header('Location: login.php');
    exit();
}

if(!esAdmin()){
    header('Location: index.php');
    exit();
}

$connection = getConnection();
if ($connection->connect_errno) {
    die('No se pudo conectar');
}

$byShipping = $connection->query(getNumeroVentasByEnvios());
$ship = array();
while ($elemento = $byShipping->fetch_object()) {
    $ship[] = $elemento;
}

$byCategory = $connection->query(getNumeroVentasByCategoria());
$category = array();
while ($elemento = $byCategory->fetch_object()) {
    $category[] = $elemento;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="js/chart.min.js"></script>
    <link rel="stylesheet" href="css/graphs.css">
    <?php include_once "util/bootstrap.html" ?>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
    <title>Datos de ventas</title>
</head>

<body>
    <?php include "layout/navbar.php" ?>
    <main id="content">
        <h1>Estadísticas de prendas</h1>
        <div class="graphs">
            <?php
            if (isset($_POST['bars'])) {
                require 'graphs/bars.php';
            }
            if (isset($_POST['doughnut'])) {
                require 'graphs/pie.php';
            }
            ?>
            <form method="post">
                <input class="btn btn-primary" type="submit" value="Ventas por envíos (Barras)" name="bars">
                <input class="btn btn-primary" type="submit" value="Ventas por categoría (Pastel)" name="doughnut">
            </form>
        </div>
    </main>
    <?php include "layout/footer.html" ?>
</body>

</html>