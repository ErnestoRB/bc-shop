<?php include_once "util/session.php"; ?>
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

<?php
include('layout/navbar.php');
if(isset($_GET['id'])){
?>
  <main id="content">
    <br>

    <div class="container text-start" tyle="background-color:white; border: 1px solid black;">
      <div class="row align-items-start" style="background-color:white;">
        <div class="col" style="background-color:white;">
          <h4><i class="bi bi-check-lg"></i> SU PEDIDO ESTA CONFIRMADO</h4>
          <p class="fw-lighter">Se ha enviado un correo a su coreo electronico:</p>
          <p class="fw-lighter"> El pedido PumpedUp KickShop esta completo.</p>
          <p class="fw-lighter">Ha elegido el pago:</p>
          <p class="fw-lighter">Le enviaremos su pedido en breve plazo.</p>
          <p class="fw-lighter">Para cualquier duda, porfavor contacte con nosotros <strong><a href="#" class="text-decoration-none">Atencion al Cliente</a></strong></p>
        </div>
      </div>
    </div>
    <br>
    <?php
    include('util/database/connection.php');
    include('util/database/querys.php');
    $id = $_GET['id'];
    $db = getConnection();
    
    $orden = $db->prepare(getProductsFromVenta());
    $orden->bind_param('i',$id);
    $orden->execute();
    $result = $orden->get_result()->fetch_all(MYSQLI_ASSOC);

    ?>
    <div class="container text-center" tyle="background-color:white; ">
      <div class="row align-items-start" style="background-color:white;">
                  <table class="table table-hover">
                <thead>
                    <th scope="col">#</th>
                    <th scope="col">ARTICULOS DEL PEDIDO</th>
                    <th scope="col">PRECIO UNITARIO</th>
                    <th scope="col">CANTIDAD</th>
                    <th scope="col">TOTAL</th>
                </thead>

                <tbody>
                <?php
                $i = 0;
                foreach($result as $resultado){
                ?>
                  <tr>
                    <td><?php echo $i++;   ?></td>
                    <!--numreo  -->
                    <!--<td><img width="100" src="data:image/png;base64,<?php //echo base64_encode($resultado['imagen']);    ?>"></td>-->
                    <td></td>
                    <!--imagen del producto -->
                    <td><?php echo $resultado['idVenta'];  ?></td>
                    <!--precio -->
                    <td><?php echo $resultado['precio'];  ?></td>
                    <!--cantidad-->
                    <td><?php echo $resultado['cantidad'];  ?></td>
                    <!--total  -->
                    <td><?php echo $resultado['total'];  ?></td>
                    <!--categoria  -->
                  </tr>
                <?php }
                ?>
                </tbody>

            </table>
        <hr>
        <div class="container text-center" tyle="background-color:white; ">
          <div class="row align-items-start" style="background-color:white;">
            <div class="col" style="background-color:white;">
              <p class="fw-light" style="text-align:left; font-size:13px">Subtotal</p>
              <p class="fw-light" style="text-align:left; font-size:13px">Gastos de envio y preparacion</p>
              <div style="grid-column: span 16; background-color:gainsboro; text-align:left">TOTAL (IVA INCLUIDO)</div>
              <p class="fw-light" style="text-align:left ; font-size:13px">IVA: <?php ?></p>
              <br>
              <h6 style="text-align:left ;">DETALLES DEL PEDIDO:</h6>
              <br>
              <p class="font-monospace" style="text-align:left ;">Referencia de Pedido: <?php ?></p>
              <p class="font-monospace" style="text-align:left ;">Metodo de Pago: <?php ?></p>
              <p class="font-monospace" style="text-align:left ;">Metodo de Envio: <?php ?></p>
              <p class="fst-italic" style="text-align:left ;">Envio estandar</p>

            </div>

            <div class="col" style="background-color:white;">
              <p class="fw-light" style="text-align:end ; font-size:13px">1<?php ?></p>
              <p class="fw-light" style="text-align:end ; font-size:13px">1<?php ?></p>
              <div style="grid-column: span 20; background-color:gainsboro; text-align:end">1<?php ?></div>
            </div>
          </div>
        </div>
  </main>
<?php
}else{?>
  <div class="error" style="text-align: center; background-color: #ff000095;">
    <h1>Uups</h1>
    <p>parece que hubo un error vuelve a intentarlo</p>
  </div>
  <script></script>
<?php 
}
include('layout/footer.html');

?>

</body>
