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
    <h1>Recuperacion de cuenta</h1>
    <form action="handle_unlock.php" method="post">
        <p>Usuario</p>
        <input type="text" name="usuario" id="">
        <input type="submit" value="Recuperar">
    </form>
    <?php include "layout/footer.html" ?>
</body>
</html>