<?php

require_once __DIR__ . '/../util/session.php';

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
    $correoHTML += '
          <tr>
            <td>
              <p>Precio unitario</p>
            </td>
            <td>
              <p>Cantidad</p>
            </td>
            <td>
              <p>Total articulos</p>
            </td>
          </tr>
          ';
    foreach ($articulos as $articulo) {
        $correoHTML += '
          <tr>
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
    $correoHTML += '
          <tr>
            <td colspan="2">
                <p>Subtotal</p>
            </td>
            <td>
              <p>$' . $totales['subtotal'] . '</p>
            </td>
          </tr>
          ';
    $correoHTML += '
          <tr>
            <td colspan="2">
                <p>Descuento cupones</p>
            </td>
            <td>
              <p>-$' . $totales['descuento_cupones'] . '</p>
            </td>
          </tr>
          ';
    $correoHTML += '
          <tr>
            <td colspan="2">
                <p>Subtotal con descuentos</p>
            </td>
            <td>
              <p>$' . $totales['subtotal_descuentos'] . '</p>
            </td>
          </tr>
          ';
    $correoHTML += '
          <tr>
            <td colspan="2">
                <p>IVA</p>
            </td>
            <td>
              <p>$' . $totales['iva'] . '</p>
            </td>
          </tr>
          ';
    $correoHTML += '
          <tr>
            <td colspan="2">
                <p>Costo envio</p>
            </td>
            <td>
              <p>$' . $totales['costo_envio'] . '</p>
            </td>
          </tr>
          ';
    $correoHTML += '
          <tr>
            <td colspan="2">
                <p>Total</p>
            </td>
            <td>
              <p>$' . $totales['total'] . '</p>
            </td>
          </tr>
          ';
    $correoHTML += '
          <hr>
          ';
    $correoHTML += '
          <tr>
            <td colspan="2">
                <p>Pedido</p>
            </td>
            <td>
              <p>#' . $idVenta . '</p>
            </td>
          </tr>
          ';
    $correoHTML += '
          <tr>
            <td colspan="2">
                <p>Metodo de pago</p>
            </td>
            <td>
              <p>$' . $detalles['pago'] . '</p>
            </td>
          </tr>
          ';
    $correoHTML += '
          <tr>
            <td colspan="2">
                <p>Tipo de envio</p>
            </td>
            <td>
              <p>$' . $detalles['envio'] . '</p>
            </td>
          </tr>
          ';

    $correoHTML += '</table>';

    // mandar correo
    echo json_encode(array("message" => "Orden creada", "link" => '/orden.php?id=' . $idVenta));
} catch (\Throwable $th) {
    $connection->rollback();
    http_response_code(500);
    echo json_encode(array("message" => $th->getMessage()));
}
