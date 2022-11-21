<?php
include "util/session.php";

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include "util/bootstrap.html" ?>
    <script src="js/alerta_eliminar.js"></script>
    <title>Panel de artículos</title>
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
                    <div class="card col-3" style="width: 18rem;">
                        <img src="..." class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Articulo</h5>
                            <p class="card-text">Descripcion</p>
                            <p>Existencias</p>
                            <p>$ precio</p>
                            <a href="#" class="btn btn-primary"><i class="bi bi-cart-plus-fill"></i></a>
                        </div>
                    </div>

                    <div class="card col-3" style="width: 18rem;">
                        <img src="..." class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Articulo</h5>
                            <p class="card-text">Descripcion</p>
                            <p>Existencias</p>
                            <p>$ precio</p>
                            <a href="#" class="btn btn-primary">
                                <i class="bi bi-pencil-square"></i>
                            </a>
                            <button type="button" data-eliminar-producto="id" class="btn btn-danger"><i class="bi bi-trash-fill"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <?php include "layout/footer.html" ?>
</body>

</html>