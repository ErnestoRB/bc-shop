<?php
require_once "util/session.php";
require_once "util/validation.php";
require_once "util/database/connection.php";
require_once "util/database/querys.php";
require_once "util/hash/password.php";

if ($isLogged) {
    header('Location: panel.php');
    exit(1);
}
if (!isset($message)) {
    $message = '';
};
if (!isset($isError)) {
    $isError = false;
}
try {
    if ($_SERVER["REQUEST_METHOD"] === 'POST') {
        $connection = getConnection();
        if ($connection->connect_errno) {
            header('Location: 500.php');
            exit(1);
        }

        $campos = array("nombre", "apellidos", "usuario", "email", "pass", "pass2");
        validatePostArray($campos);
        if (!$isError) {
            $nombre = $_POST["nombre"];
            $apellidos = $_POST["apellidos"];
            $cuenta = $_POST["usuario"];
            $email = $_POST["email"];
            $pass = $_POST["pass"];
            $confirmPass = $_POST["pass2"];
            $passMatch = $pass == $confirmPass;
            if (!$passMatch) {
                throw new Exception("Las contraseñas no son iguales");
            }
            if (!$isError) {
                $hash = hashPassword($pass);
                $ok = $connection->query(registerUser($nombre, $apellidos, $cuenta, $hash, $email));
                if ($ok) {
                    $message = "Registrado con éxito";
                }
            }
        }
    }
} catch (Exception $error) {
    $isError = true;
    $message = $error->getMessage();
}
