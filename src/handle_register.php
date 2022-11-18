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
$connection = getConnection();
if ($connection->connect_errno) {
    header('Location: 500.php');
    exit(1);
}
$nombre = $_POST["nombre"];
$apellidos = $_POST["apellidos"];
$cuenta = $_POST["usuario"];
$email = $_POST["email"];
$pass = $_POST["pass"];
$hash = hashPassword($pass);
$ok = $connection->query(registerUser($nombre, $apellidos, $cuenta, $hash, $email));
if ($ok) {
    header('Location: login.php');
}
