<?php include_once "util/session.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include_once "util/bootstrap.html" ?>
    <title>Contacto</title>
</head>
<body>
    <?php include "layout/navbar.php" ?>
    <main id="content">
        <form class="d-flex align-items-center justify-content-center mt-5" action="handle_comments.php" method="post">
            <div class="card col-8">
                <div class="card-body pt-4">
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Nombre</label>
                        <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Ej. Juan Pérez" name="nombre" required>
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Corero electrónico</label>
                        <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="Ej. ejemplo@algo.com" name="correo" required>
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">Déjanos tu comentario</label>
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="5" style="resize: none;" name="comentario" required></textarea>
                    </div>
                    <br>
                    <button type="submit" class="btn btn-primary">Enviar</button>
                </div>
                <?php
                    if(isset($_GET["status"])){
                        $status = $_GET["status"];
                        if($status == "success"){
                            echo '<div class="alert alert-success" role="alert">
                                ¡Gracias por tus comentarios!
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