<?php require_once "util/session.php";
require_once 'util/database/connection.php';
require_once 'util/get_categorias.php';


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include_once "util/bootstrap.html" ?>
    <script src="/js/articulos.js"></script>
    <script src="js/alerta_eliminar.js"></script>
    <title>Panel de artículos</title>
    <title>Tienda</title>
</head>

<body>

    <?php include "layout/navbar.php" ?>

    <main id="content">
        <div class="accordion" id="accordionExample">
            <div class="container">
                <h1>Artículos</h1>
                <div>
                    <form id="formCategorias">
                        <label for="categoria">Filtrar por categoria</label>
                        <select class="form-control" name="categoria" id="">
                            <?php
                            foreach ($categoriasArray as $categoria) {
                                echo '<option value="' . $categoria["idCategoria"] . '">' . $categoria["nombre"] . ' </option>';
                            }
                            ?>
                        </select>
                        <button class="btn btn-primary" type="submit">Buscar</button>
                    </form>

                </div>
                <div id="contenedorProductos" class="row">

                </div>
            </div>
        </div>
    </main>
    <?php include "layout/footer.html" ?>
</body>

</html>