<?php include_once "util/session.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include_once "util/bootstrap.html" ?>
    <title>Sucribirse</title>
</head>
<body>
    <?php include "layout/navbar.php" ?>
    <main id="content">
        <form class="d-flex align-items-center justify-content-center mt-5" action="send_subscription.php" method="post">
            <div class="card col-8">
                <div class="card-body pt-4">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Corero electrónico</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="correo" required>
                        <small id="emailHelp" class="form-text text-muted">No compartiremos tu correo con nadie más</small>
                    </div>
                    <br>
                    <div class="form-group form-check">
                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                        <label class="form-check-label" for="exampleCheck1">Recibir noticias sobre nuevos productos</label>
                    </div>
                    <br>
                    <button type="submit" class="btn btn-primary">Suscribirse</button>
                </div>
                <?php
                    if(isset($_GET["status"])){
                        $status = $_GET["status"];
                        if($status == "success"){
                            echo '<div class="alert alert-success" role="alert">
                                Se ha enviado un mensaje a tu correo
                                </div>';
                        }  
                    }
                ?>
            </div>
        </form>
    </main>
    <?php include "layout/footer.html" ?>
</body>
</html>