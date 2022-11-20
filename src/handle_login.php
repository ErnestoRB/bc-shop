<?php
require "util/session.php";
require "util/database/connection.php";
require "util/database/querys.php";
require "util/hash/password.php";

if ($isLogged) {
    header('Location: panel.php');
    exit(1);
}

if ($_SERVER["REQUEST_METHOD"] !== 'POST') {
    header('Location: index.php');
    exit(1);
}

$user = $_POST["usuario"];
$password = $_POST["pass"];
$connection = getConnection();
if ($connection->connect_errno) {
    header('Location: 500.php');
    exit(1);
}

$result = $connection->query(getUserInfo($user));

if ($result->num_rows < 1) {
    header('Location: 500.php'); // no se encontró al usuario
    exit(1);
}

$user = $result->fetch_assoc();
$hash = $user["contraseña"];
$id = $user["idusuario"];
$locked = $user["bloqueo"];

if($user["fallidos"] >= 2){
    $blocked = $connection -> query(blockUserAccount($id));
}

if (validatePassword($password, $hash)) {
    $_SESSION["usuario"] = $user["cuenta"];
    $_SESSION["nombre"] = $user["nombre"];
    $_SESSION["apellidos"] = $user["apellidos"];
    $_SESSION["email"] = $user["correo"];
    $cleared = $connection -> query(clearFailed($id));
    header('Location: panel.php');
    exit();
} else {
    if($locked == 1){
        header('Location: unlock_account.php');
    }
    else{
        $attempt = $connection -> query(incrementFailed($id));
        header('Location: login.php'); // no es contraseña valida
    }
}
