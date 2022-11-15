<?php
    $servidor = 'localhost';
    $cuenta = 'root';
    $password = '';
    $bd = 'clothesdb';

    $conexion = new mysqli($servidor, $cuenta, $password, $bd);

    if ($conexion -> connect_errno){
        die('No se pudo conectar');
    }

    $sql = "SELECT * FROM ventas";
    $consulta = $conexion -> query($sql);
    $datos = array();
    while($elemento = $consulta -> fetch_object()){
        $datos[] = $elemento;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="js/chart.min.js"></script>
    <link rel="stylesheet" href="css/data_style.css">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
    <title>Datos de ventas</title>
</head>
<body>
    <h1>Prendas vendidas por mes</h1>
    <div class="graphs">
    <?php
        if(isset($_POST['bars'])){
            require 'graphs/bars.php';
        }
        if(isset($_POST['doughnut'])){
            require 'graphs/pie.php';
        }
    ?>
        <form method="post">
            <input type="submit" value="Ver grafica de barras" name="bars">
            <input type="submit" value="Ver grafica de pastel" name="doughnut">
        </form>
        
    </div>
</body>
</html>