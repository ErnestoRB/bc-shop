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
    <title>Panel de artículos</title>
</head>

<body>
    <?php include "layout/navbar.php" ?>
    <main id="content">
        <form action="add_producto.php" method="post">
            <label for="nombre">Nombre</label>
            <input type="text" name="nombre" id="nombre">
            <label for="categoria">Categoria</label>
            <select name="categoria" id="categoria">

            </select>
            <textarea name="descripcion" id="descripcion" cols="30" rows="10">  </textarea>
            <label for="cantidad">Cantidad</label>
            <input type="number" name="cantidad" id="cantidad">
            <label for="precio">Precio</label>
            <input type="number" name="precio" id="precio">
            <label for="archivo"></label>
            <input type="file" name="archivo" id="archivo" accept="image/png">
        </form>
    </main>
    <?php include "layout/footer.html" ?>
</body>

</html>