<?php

require_once __DIR__ . '/../util/session.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require __DIR__ . '/../PHPMailer/src/PHPMailer.php';
require __DIR__ . '/../PHPMailer/src/SMTP.php';
require __DIR__ . '/../PHPMailer/src/Exception.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
  echo json_encode(array("message" => "Sólo metodo POST"));
  exit();
}

$_POST = json_decode(file_get_contents('php://input'), true);

if (empty($_POST)) {
  http_response_code(400);
  echo json_encode(array("message" => "Manda JSON en el cuerpo de la petición"));
  exit();
}

if (!$isLogged) {
  http_response_code(401);
  echo json_encode(array("message" => "Necesitas iniciar sesión para comprar"));
  exit();
}

require_once __DIR__ . '/../util/database/connection.php';
require_once __DIR__ . '/../util/database/querys.php';

if (empty($_SESSION["orden"])) {
  http_response_code(400);
  echo json_encode(array("message" => "Solicitud no válida"));
  exit();
}
$idOferta = '';
if (isset($_SESSION["oferta"])) {
  $idOferta = $_SESSION["oferta"];
}
$connection = getConnection();
try {
  $connection->begin_transaction();
  $psVenta = $connection->prepare(registerSale()); // registrar una venta (tabla venta)
  $psVenta->bind_param("iis", $_SESSION["id"], $_POST["envio"], $_POST["pago"]);
  $psVenta->execute();
  $idVenta = $psVenta->insert_id;
  $psArticuloVenta = $connection->prepare(addProductToSale()); // agregar articulo a venta (tabla venta_producto)
  $psArticuloVentaConDescuento = $connection->prepare(addProductWithDiscountToSale()); // agregar articulo con descuento a venta (tabla venta_producto)
  $psDecreaseExistencia = $connection->prepare(decreaseExistencias());  // decrementar existencias (tabla producto)
  $idProducto = 0;
  $cantidad = 1;
  $articulosCarrito = $_SESSION["orden"]["articulos"];
  $psArticuloVenta->bind_param("iii", $idProducto, $idVenta, $cantidad);
  $psDecreaseExistencia->bind_param("ii", $cantidad, $idProducto);
  foreach ($articulosCarrito as $articulo) {
    $idProducto = $articulo["idProducto"];
    $cantidad = $articulo["cantidad"];
    if ($idProducto == $idOferta) {
      $psArticuloVentaConDescuento->bind_param("iiid", $idProducto, $idVenta, $cantidad, $articulo["precioOferta"]);
      $psArticuloVentaConDescuento->execute();
    } else {
      $psArticuloVenta->execute();
    }
    $psDecreaseExistencia->execute();
  }
  $psCupones = $connection->prepare(addCouponToSale());
  $idCupon = '';
  $psCupones->bind_param("is", $idVenta, $idCupon);
  $cuponesVenta = $_SESSION["orden"]["cupones"];
  foreach ($cuponesVenta as $codigo) {
    if (empty($codigo)) continue;
    $idCupon = $codigo;
    $psCupones->execute();
  }
  $connection->commit();
  unset($_SESSION["orden"]);

  $connection = getConnection();
  $psArticulos = $connection->prepare(getProductsFromVenta());
  $psArticulos->bind_param('i', $idVenta);
  $psArticulos->execute();
  $articulos = $psArticulos->get_result()->fetch_all(MYSQLI_ASSOC);

  $psDetalles = $connection->prepare(getDetallesFromVenta());
  $psDetalles->bind_param('i', $idVenta);
  $psDetalles->execute();
  $detalles = $psDetalles->get_result()->fetch_all(MYSQLI_ASSOC)[0];

  $psTotales = $connection->prepare(getTotalesFromVenta());
  $psTotales->bind_param('i', $idVenta);
  $psTotales->execute();
  $totales = $psTotales->get_result()->fetch_all(MYSQLI_ASSOC)[0];

  $correoHTML = '<table>';
  $correoHTML .= '
          <tr>
            <th>
              <b>Nombre</b>
            </th>
            <th>
              <b>Precio unitario</b>
            </th>
            <th>
              <b>Cantidad</b>
            </th>
            <th>
              <b>Total articulos</b>
            </th>
          </tr>
          ';
  foreach ($articulos as $articulo) {
    $correoHTML .= '
          <tr>
            <td>
              <p>' . $articulo['nombre'] . '</p>
            </td>
            <td>
              <p>$' . $articulo['precio'] . '</p>
            </td>
            <td>
              <p>' . $articulo['cantidad'] . '</p>
            </td>
            <td>
              <p>$' . $articulo['total'] . '</p>
            </td>
          </tr>
          ';
  }
  $correoHTML .= '
          <tr>
            <td colspan="3">
                <p>Subtotal</p>
            </td>
            <td>
              <p>$' . $totales['subtotal'] . '</p>
            </td>
          </tr>
          ';
  $correoHTML .= '
          <tr>
            <td colspan="3">
                <p>Descuento cupones</p>
            </td>
            <td>
              <p>-$' . $totales['descuento_cupones'] . '</p>
            </td>
          </tr>
          ';
  $correoHTML .= '
          <tr>
            <td colspan="3">
                <p>Subtotal con descuentos</p>
            </td>
            <td>
              <p>$' . $totales['subtotal_descuentos'] . '</p>
            </td>
          </tr>
          ';
  $correoHTML .= '
          <tr>
            <td colspan="3">
                <p>IVA</p>
            </td>
            <td>
              <p>$' . $totales['iva'] . '</p>
            </td>
          </tr>
          ';
  $correoHTML .= '
          <tr>
            <td colspan="3">
                <p>Costo envio</p>
            </td>
            <td>
              <p>$' . $totales['costo_envio'] . '</p>
            </td>
          </tr>
          ';
  $correoHTML .= '
          <tr>
            <td colspan="3">
                <p>Total</p>
            </td>
            <td>
              <b>$' . $totales['total'] . '</b>
            </td>
          </tr>
          ';
  $correoHTML .= '
          <hr>
          ';
  $correoHTML .= '
          <tr>
            <td colspan="3">
                <p>Pedido</p>
            </td>
            <td>
              <p>#' . $idVenta . '</p>
            </td>
          </tr>
          ';
  $correoHTML .= '
          <tr>
            <td colspan="3">
                <p>Metodo de pago</p>
            </td>
            <td>
              <p>' . $detalles['pago'] . '</p>
            </td>
          </tr>
          ';
  $correoHTML .= '
          <tr>
            <td colspan="3">
                <p>Tipo de envio</p>
            </td>
            <td>
              <p>' . $detalles['envio'] . '</p>
            </td>
          </tr>
          ';

  $correoHTML .= '</table>';
  $correo = $_SESSION["email"];

  $mail = new PHPMailer(true);

  try {
    $mail->isSMTP();
    $mail->Host = 'smtp.office365.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'no_reply_bc@outlook.com';
    $mail->Password = 'ProyectoFinalSW';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;
    $mail->setFrom('no_reply_bc@outlook.com', 'Bash Crashers Support');
    $mail->addAddress($correo);
    $mail->isHTML(true);
    $mail->Subject = 'Orden de productos';
    $mail->Body = $correoHTML;
    $mail->send();
  } catch (Exception $exception) {
    echo json_encode(array("message" => "Orden creada, no fue posible mandar correo", "link" => '/orden.php?id=' . $idVenta));
    exit();
  }
  echo json_encode(array("message" => "Orden creada, se envió la orden a su correo", "link" => '/orden.php?id=' . $idVenta));
} catch (\Throwable $th) {
  $connection->rollback();
  http_response_code(500);
  echo json_encode(array("message" => $th->getMessage()));
}
