<?php include_once "util/session.php";
include_once "util/database/connection.php";
include_once "util/database/querys.php";
$id = '';
if (!empty($_GET['id'])) {
  $id = $_GET['id'];
}
if (empty($id)) {
  exit();
}

$connection = getConnection();
$psArticulos = $connection->prepare(getProductsFromVenta());
$psArticulos->bind_param('i', $id);
$psArticulos->execute();
$articulos = $psArticulos->get_result()->fetch_all(MYSQLI_ASSOC);

$psDetalles = $connection->prepare(getDetallesFromVenta());
$psDetalles->bind_param('i', $id);
$psDetalles->execute();
$detalles = $psDetalles->get_result()->fetch_all(MYSQLI_ASSOC)[0];

$psTotales = $connection->prepare(getTotalesFromVenta());
$psTotales->bind_param('i', $id);
$psTotales->execute();
$totales = $psTotales->get_result()->fetch_all(MYSQLI_ASSOC)[0];
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php include_once "util/bootstrap.html" ?>

  <title>Orden | Pumped Up KickShop</title>
</head>

<body>
  <main id="content">
    <br>

    <div class="container text-start" tyle="background-color:white; border: 1px solid black;">
      <div class="row align-items-start" style="background-color:white;">
        <div class="col" style="background-color:white;">
          <h4><i class="bi bi-check-lg"></i> SU PEDIDO ESTA CONFIRMADO</h4>
          <p class="fw-lighter">Se ha enviado un correo a su coreo electronico:</p>
          <p class="fw-lighter"> El pedido PumpedUp KickShop esta completo.</p>
          <p class="fw-lighter">Una nota ha sido enviada a su correo.</p>
          <p class="fw-lighter">Le enviaremos su pedido en breve plazo.</p>
          <p class="fw-lighter">Para cualquier duda, porfavor contacte con nosotros <strong><a href="/contact_us.php" class="text-decoration-none">Atencion al Cliente</a></strong></p>
        </div>
      </div>
    </div>
    <br>
    <div class="container text-center" tyle="background-color:white; ">
      <div class="row align-items-start" style="background-color:white;">
        <div class="row">
          <div class="col-3" style="background-color:white;">
            <p>ARTICULOS DE PEDIDO</p>
          </div>
          <div class="col-3">
            <p>PRECIO UNITARIO</p>
          </div>
          <div class="col-3">
            <p>CANTIDAD</p>
          </div>
          <div class="col-3">
            <p>Total de Articulos</p>
          </div>
        </div>

        <?php
        foreach ($articulos as $articulo) {
          echo '
          <div class="row">
            <div class="col-3" style="background-color:white;">
              <img src="/static/' . $articulo['imagen'] . '" class="rounded img-product-sm ">
              <div>' . $articulo['nombre'] . '</div>
            </div>
            <div class="col-3">
              <p>$' . $articulo['precio'] . '</p>
            </div>
            <div class="col-3">
              <p>' . $articulo['cantidad'] . '</p>
            </div>
            <div class="col-3">
              <p>$' . $articulo['total'] . '</p>
            </div>
          </div>
          ';
        }
        ?>

        <hr>
        <div class="container text-center" tyle="background-color:white; ">
          <div class="row align-items-start" style="background-color:white;">
            <div class="col" style="background-color:white;">

              <p class="fw-light" style="text-align:left; font-size:13px">Subtotal</p>
              <p class="fw-light" style="text-align:left; font-size:13px">Descuento por cupones</p>
              <p class="fw-light" style="text-align:left; font-size:13px">Subtotal despues de descuento</p>
              <p class="fw-light" style="text-align:left ; font-size:13px">IVA:</p>
              <p class="fw-light" style="text-align:left; font-size:13px">Gastos de envio y preparacion</p>
              <div style="grid-column: span 16; background-color:gainsboro; text-align:left">TOTAL (IVA INCLUIDO)</div>
              <br>
              <h6 style="text-align:left ;">DETALLES DEL PEDIDO:</h6>
              <br>
              <p class="font-monospace" style="text-align:left ;">Referencia de Pedido: #<?= $id ?></p>
              <p class="font-monospace" style="text-align:left ;">Metodo de Pago: <?= $detalles['pago'] ?></p>
              <p class="font-monospace" style="text-align:left ;">Metodo de Envio: <?= $detalles['envio'] ?></p>
            </div>

            <div class="col" style="background-color:white;">
              <p class="fw-light" style="text-align:end ; font-size:13px">$<?= $totales['subtotal'] ?></p>
              <p class="fw-light" style="text-align:end ; font-size:13px">-$<?= $totales['descuento_cupones'] ?></p>
              <p class="fw-light" style="text-align:end ; font-size:13px">$<?= $totales['subtotal_descuentos'] ?></p>
              <p class="fw-light" style="text-align:end ; font-size:13px">$<?= $totales['iva'] ?></p>
              <p class="fw-light" style="text-align:end ; font-size:13px">$<?= $totales['costo_envio'] ?></p>
              <div style="grid-column: span 20; background-color:gainsboro; text-align:end">$<?= $totales['total'] ?></div>
            </div>

          </div>
        </div>
      </div>
    </div>



  </main>
</body>