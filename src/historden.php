<?php include_once "util/session.php" ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php include_once "util/bootstrap.html" ?>

  <title>Historial | Pumped Up KickShop</title>
</head>

<body>
  <main id="content">
    <br>
    
    <div class="container text-start" tyle="background-color:white; border: 1px solid black;">
      <div class="row align-items-start" style="background-color:white;">
      <h6 class="fw-lighter">Aqui estan sus pedidos desde la creacion de su cuenta:</h6>
      <br>
      <br>
        <table class="table table-bordered" style="background-color:lightgray ;">
          <thead>
            <tr>
              <th class="font-monospace" scope="col">Referencia de pedido</th>
              <th class="font-monospace" scope="col">Fecha</th>
              <th class="font-monospace" scope="col">Precio Total</th>
              <th class="font-monospace" scope="col">Pago</th>
              <th class="font-monospace" scope="col">Estatus</th>
              <th class="font-monospace" scope="col">Factura</th>
              <th class="font-monospace" scope="col"></th>
            </tr>
          </thead>
          <tbody>

            <tr>
              <td >CLAVEPEDIDO</td>
              <td >26 MAR 2022</td>
              <td >$1299.00</td>
              <td >Forma_Pago</td>
              <td  style="background-color:goldenrod;">Validaciones</td>
              <td  style="text-align:center ;">--</td>
              <td><pre style="text-align:center;"><a href="orden.php" class="text-decoration-none">Detalles</a>
<a href="#" class="text-decoration-none">Reordenar</a></pre></td>
              
              
            
  
            <tr>
            <td rowspan="2">CLAVEPEDIDO</td>
              <td >26 MAR 2022</td>
              <td >$1299.00</td>
              <td >Forma_Pago</td>
              <td style="background-color:goldenrod;">Validaciones</td>
              <td  style="text-align:center ;">--</td>
              <td><pre style="text-align:center;"><a href="orden.php" class="text-decoration-none">Detalles</a>
<a href="#" class="text-decoration-none">Reordenar</a></pre></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>

  </main>
</body>