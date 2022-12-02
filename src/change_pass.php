<?php
require "util/session.php";
require "util/database/connection.php";
require "util/database/querys.php";
require "util/hash/password.php";

include "util/session.php";
if (isset($_GET["user"])) {
    $user = $_GET["user"];
    $connection = getConnection();
    $result = $connection->prepare(getUserInfo());
    $result->bind_param("S",$user);
    $result->execute();
    $UserInf = $result->get_result();

    if ($connection->connect_errno) {
        header('Location: 500.php');
        exit(1);
    }

    if ($result->num_rows < 1) {
        header('Location: 500.php');
        exit(1);
    }

    $user = $UserInf->fetch_assoc();
    $blocked = $user["bloqueo"];
    if($blocked != 1){
        header('Location: login.php');
        exit(1);
    }

    $user = $_GET["user"];
}
else{
    header('Location: login.php');
    exit(1);
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
    <main id="content">
        <div class="container">

            <form action="set_new_pass.php" method="post" id="sendPass">
                <h1>Cambiar contraseña generada</h1>
                <label for="new_pass">Inserta nueva contraseña</label>
                <input type="password" class="form-control" name="new_pass" id="pass">
                <label for="new_pass_comp">Vuelve a insertar nueva contraseña</label>
                <input type="password" class="form-control" name="new_pass_comp">
                <?php
                if (isset($_GET["user"])) {
                    echo '<input type="hidden" name="user" value="' . $user . '">';
                }
                ?>
                <input type="submit" class="btn btn-primary" value="Cambiar contraseña">
            </form>
        </div>
    </main>

    <script type="text/javascript">
        //validacion de doble contraseña
        $(document).ready(function() {
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