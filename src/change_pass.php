<?php 
    include "util/session.php";
    if(isset($_GET["user"])){
        $user = $_GET["user"];
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.2/dist/jquery.validate.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.2/dist/additional-methods.min.js"></script>
    <?php include "util/bootstrap.html" ?>
    <title>Document</title>
</head>
<body>
    <?php include "layout/navbar.php" ?>
    <form action="set_new_pass.php" method="post" id="sendPass">
        <p>Inserta nueva contraseña</p>
        <input type="password" name="new_pass" id="pass">
        <p>Vuelve a insertar nueva contraseña</p>
        <input type="password" name="new_pass_comp">
        <?php
            if(isset($_GET["user"])){
                echo '<input type="hidden" name="user" value="'.$user.'">';
            }
        ?>
        <input type="submit" value="Cambiar contraseña">  
    </form>
    <script type="text/javascript"> //validacion de doble contraseña
        $(document).ready(function(){
            $('#sendPass').validate({
                rules: {
                    new_pass: 'required',
                    new_pass_comp: {
                        required: true,
                        equalTo: '#pass'
                    }
                },
                messages: {
                    new_pass_comp: {
                        required: 'Campo requerido',
                        equalTo: 'Las contraseñas no coinciden'
                    }
                }
            });
        });
    </script>
    <?php include "layout/footer.html" ?>
</body>
</html>