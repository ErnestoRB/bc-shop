<?php
require_once "util/session.php";
require_once "util/database/connection.php";
require_once "util/database/querys.php";
require_once "util/hash/password.php";

if ($isLogged) {
    header('Location: panel.php');
    exit(1);
}

if (!isset($isError)) {
    $isError = false;
}
if (!isset($message)) {
    $message = '';
};
try {
    if ($_SERVER["REQUEST_METHOD"] === 'POST') {
        $email = $_POST["email"];
        $password = $_POST["pass"];
        $recordar = empty($_POST["recordar"]) ? false : $_POST["recordar"];
        if ($recordar) {
            setcookie("email", $email, time() + 60 * 60);
            setcookie("pass", $password, time() + 60 * 60);
        } else {
            setcookie("email", '', time() - 60);
            setcookie("pass", '', time() - 60);
        }
        $connection = getConnection();
        if ($connection->connect_errno) {
            throw new Exception("Error del servidor");
        }
        $result = $connection->query(getUserInfoByEmail($email));
        // comprobar que fallidos < 3
        if ($result->num_rows < 1) {
            throw new Exception("Credenciales inválidas");
        }
        $user = $result->fetch_assoc();
        $hash = $user["contraseña"];
        if (validatePassword($password, $hash)) {
            $_SESSION["user"] = $user["cuenta"];
            $_SESSION["nombre"] = $user["nombre"];
            $_SESSION["apellidos"] = $user["apellidos"];
            $_SESSION["email"] = $user["correo"];
            header('Location: panel.php');
        } else {
            // consulta de incrementar fallos
        }
    }
} catch (Exception $e) {
    $isError = true;
    $message = $e->getMessage();
}
