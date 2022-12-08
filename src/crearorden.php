<?php include_once "util/session.php";
if (!$isLogged) {
    header('Location: login.php');
    exit();
}

if (empty($_SESSION["orden"])) {
    header('Location: carrito.php');
    exit();
}

require_once './util/database/connection.php';
require_once './util/database/querys.php';

$orden = $_SESSION["orden"]["articulos"];
$cupones = array();

$connection = getConnection();
$envios = $connection->query(getEnvios());
$envios = $envios->fetch_all(MYSQLI_ASSOC);
$ps = $connection->prepare(getCuponByCodigo());
$nombreCupon = '';
$ps->bind_param("s", $nombreCupon);


$subtotalAntesDescuento = $subtotal = array_reduce($orden, function ($carry, $element) {

    return $carry + $element["precio"];
}, 0);

$porcentajeDescuento = 0;
foreach ($_SESSION["orden"]["cupones"] as $nombreCupon) {
    $ps->execute();
    $registro = $ps->get_result()->fetch_assoc();
    if ($registro) {
        $minimo = $registro["minim"];
        $maximo = $registro["maximo"];
        $aplicable = true;
        if ((!empty($maximo) && $subtotal > $maximo) || (!empty($minimo) && $subtotal < $minimo)) {
            $aplicable = false;
        }
        if ($aplicable) {
            $cupones[] = $registro;
            $porcentajeDescuento += ($registro['porcentaje'] / 100);
        }
    }
}
$descuentoSubtotal = $subtotal * $porcentajeDescuento;
$subtotal -= $descuentoSubtotal;
$iva = $subtotal * 0.16;
$total = $subtotal + $iva;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include_once "util/bootstrap.html" ?>
    <script>
        const subtotal = <?= $total ?>
    </script>
    <script src="/js/crearOrden.js"></script>
    <title>Crear Orden | Pumped Up KickShop</title>
</head>

<body>
    <?php include "layout/navbar.php" ?>
    <main id="content">
        <div class="container" style="--bs-columns: 10; --bs-gap: 1rem;">

            <div class="row">
                <form id="orden-form" class="col-8">
                    <div class="accordion" id="accordionExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingTwo">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    Tipo de Envio
                                </button>
                            </h2>
                            <div id="collapseTwo" class="accordion-collapse collapse show" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <div class="container text-center">
                                        <div style="background-color:#ECECEC;" class="row">
                                            <?php
                                            foreach ($envios as $envio) {
                                                echo '
                                                    <div class="row">
                                                    <div class="col">
                                                        <div class="form-check">
                                                            <input data-costo="' . $envio["costo"] . '" class="form-check-input" type="radio" name="envio" value="' . $envio["id"] . '" id="flexRadioDefault1">
                                                            <label class="form-check-label" for="flexRadioDefault1">
                                                                ' . $envio["nombre"] . '
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col order-5">
                                                        $' . $envio["costo"] . '
                                                    </div>
                                                    </div>
                                                    ';
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <br>
                                    <!-- <h6>Si desea dejarnos un comentario acerca de su pedido, por favor escribalo a continuacion</h6>
                                    <div class="form-floating">
                                        <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea"></textarea>
                                        <label for="floatingTextarea">Comments</label>
                                    </div> -->
                                    <br>
                                    <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree">CONTINUAR</button>
                                </div>

                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingThree">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                        Pago
                                    </button>
                                </h2>
                                <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="pago" id="flexRadioDefault3" value="Paypal">
                                            <label class="form-check-label" for="flexRadioDefault1">
                                                Pago Mediante Paypal <i class="bi bi-paypal"></i>
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="pago" id="flexRadioDefault4" value="Banco">
                                            <label class="form-check-label" for="flexRadioDefault1">
                                                Pago en Banco <i class="bi bi-bank2"></i>
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="pago" id="flexRadioDefault4" value="Oxxo">
                                            <label class="form-check-label" for="flexRadioDefault1">
                                                Pago en Oxxo
                                            </label>

                                        </div>
                                        <br>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="flexCheckDefault" value="acepto" name="politicas">
                                            <label class="form-check-label" for="flexCheckDefault">
                                                Estoy de acuerdo con los terminos del servicio y los acepto sin reservas
                                            </label>
                                        </div>
                                        <br>
                                        <button type="submit" style="align-items:left;" class="btn btn-primary">Crear orden</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                </form>
            </div>



            <div class="col-4">
                <div class="card" style="width: 18rem;">
                    <div class="card-body">

                        <h6 class="card-subtitle mb-2 text-muted"><?= sizeof($orden) ?> Articulo(s)</h6>
                        <?php
                        foreach ($orden as $articulo) {
                            echo "<li><b>" . $articulo['nombre'] . " (" . $articulo["cantidad"] . ") </b> - $" . $articulo['precio'] . "</li>";
                        }
                        ?>
                        <hr>
                        <div class="row">
                            <div class="col">
                                Subtotal
                            </div>
                            <div class="col" style="text-align:left;">
                                $<?= $subtotalAntesDescuento ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                Cupones (<?= sizeof($cupones) ?>)
                            </div>
                            <div class="col d-flex flex-column" style="text-align:left;">
                                <?php
                                foreach ($cupones as $cupon) {
                                    echo "<div><b>" . $cupon['codigo'] . "</b><span class='badge bg-danger'>-" .  $cupon["porcentaje"] . "%</span>" . "</div>";
                                }
                                ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <b>Subtotal (con cupones aplicados)</b>
                            </div>
                            <div class="col" style="text-align:left;">
                                $<?= $subtotal
                                    ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                Envio
                            </div>
                            <div id="costoEnvio" class="col" style="text-align:left;">
                                A seleccionar
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col">
                                <b>Total (IVA Incluido)</b>
                                <br>
                            </div>
                            <div id="total" class="col" style="text-align:left;">
                                $<?= $total ?>
                            </div>

                            <br>
                            <div class="col text-muted">Impuestos Incluidos </div><br>
                            <div class="col text-muted">$<?= $iva ?></div><br>
                        </div>
                    </div>
                </div>
            </div>
        </div>



    </main>
    <?php include "layout/footer.html" ?>
</body>