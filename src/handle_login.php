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
        if($user["fallidos"] >= 3){
            $blocked = $connection -> query(blockUserAccount($id));
        }
        if ($result->num_rows < 1) {
            throw new Exception("Credenciales inválidas");
        }
        $user = $result->fetch_assoc();
        $hash = $user["contraseña"];
        $id = $user["idusuario"];
        $generated = $user["passgenerado"];
        $blocked = false;
        $cuenta = $user["cuenta"];

        if($generated == 1){
            if(validatePassword($password, $hash)){
                header('Location: change_pass.php?user='.$cuenta); 
                exit();
            }
            else{
                header('Location: login.php'); //la contraseña insertada no es correcta
                exit();
            }
        }
        if (validatePassword($password, $hash)) {
            $_SESSION["user"] = $user["cuenta"];
            $_SESSION["nombre"] = $user["nombre"];
            $_SESSION["apellidos"] = $user["apellidos"];
            $_SESSION["email"] = $user["correo"];
            $cleared = $connection -> query(clearFailed($id));
            header('Location: panel.php');
        } else {
            if($blocked){
                header('Location: unlock_account.php');
            }
            else{
                $attempt = $connection -> query(incrementFailed($id));
                throw new Exception("Credenciales inválidas");
            }
        }
    }
} catch (Exception $e) {
    $isError = true;
    $message = $e->getMessage();
}
