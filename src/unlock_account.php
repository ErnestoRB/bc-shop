<?php include "util/session.php" ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include "util/bootstrap.html" ?>
    <title>Document</title>
</head>

<body>
    <?php include "layout/navbar.php" ?>
    <main id="content">
        <div class="container">
            <h1>Recuperacion de cuenta</h1>
            <form action="handle_unlock.php" method="post">
                <p>Nombre de usuario de la cuenta</p>
                <input type="text" name="usuario" id="">
                <input type="submit" class="btn btn-primary" value="Recuperar">
            </form>
        </div>
    </main>
    <?php include "layout/footer.html" ?>
</body>

</html>