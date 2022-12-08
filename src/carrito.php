<?php include_once "util/session.php" ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include_once "util/bootstrap.html" ?>
    <script src="/js/validarCarrito.js"></script>
    <title>Carrito</title>
</head>

<body style="background-color: rgb(240, 240, 240); height: 100%;">
    <?php include "layout/navbar.php" ?>
    <div class="row px-0 mx-0 justify-content-around pt-3">
        <div class="px-2 col-md-8 col-sm-12">
            <div class="card my-2 border-0" style="box-sizing: border-box;">
                <div class="card-header bg-white">
                    <h4>Carrito</h4>
                </div>
                <div id="card-body" class="card-body">
                </div>
            </div>
        </div>
        <div class="px-2 col-md-4 col-lg-3">
            <div id="summary" class="card h-100 border-0 p-3 my-2">
            </div>
        </div>

    </div>
</body>

</html>