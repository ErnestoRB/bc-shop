<?php
include_once "util/session.php";
include_once "util/database/connection.php";
include_once "util/database/querys.php";

$connection = getConnection();
$psHistorial = $connection->prepare(getOrdenesFromUsuario());
$psHistorial->bind_param("i", $_SESSION["id"]);
$psHistorial->execute();
$ordenes = $psHistorial->get_result()->fetch_all(MYSQLI_ASSOC);

?>
<table class="table table-bordered" style="background-color:lightgray ;">
  <thead>
    <tr>
      <th class="font-monospace" scope="col">Referencia de pedido</th>
      <th class="font-monospace" scope="col">Fecha</th>
      <th class="font-monospace" scope="col">Envio</th>
      <th class="font-monospace" scope="col">Pago</th>
      <th class="font-monospace" scope="col">Factura</th>
      <th class="font-monospace" scope="col"></th>
    </tr>
  </thead>
  <tbody>
    <?php
    foreach ($ordenes as $orden) {
      echo '
        <tr>
        <td>#' . $orden['idVenta'] . '</td>
        <td>' . $orden['fecha'] . '</td>
        <td>' . $orden['envio'] . '</td>
        <td>' . $orden['pago'] . '</td>
        <td style="text-align:center ;">--</td>
        <td>
          <pre style="text-align:center;"><a href="orden.php?id=' . $orden['idVenta'] . '" class="btn btn-primary text-decoration-none">Detalles</a>
        </td>
    <tr>
        ';
    }
    ?>
  </tbody>
</table>