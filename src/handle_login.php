<?php
require_once "util/session.php";
require_once "util/validation.php";
require_once "util/database/connection.php";
require_once "util/database/querys.php";
require_once "util/hash/password.php";
require_once "util/captcha.php";

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
        validatePostArray(array("email", "pass"));
        $isCaptchaValid = validarCaptcha("code-captcha");
        if (!$isCaptchaValid) {
            throw new Exception("El captcha no es correcto");
        }
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
        $ps = $connection->prepare(getUserInfoByEmail());
        $ps->bind_param("s", $email);
        $ps->execute();
        $result = $ps->get_result();
        if ($result->num_rows < 1) {
            throw new Exception("Credenciales inválidas");
        }
        $user = $result->fetch_assoc();
        $hash = $user["contraseña"];
        $id = $user["idusuario"];
        $generated = (bool) $user["passgenerado"];
        $blocked = (bool) $user["bloqueo"];
        $cuenta = $user["cuenta"];

        if ($user["fallidos"] >= 3 && !$generated) {
            $blockedQuery = $connection->prepare(blockUserAccount());
            $blockedQuery->bind_param('i', $id);
            $ok = $blockedQuery->execute();
        }
        if ($generated) {
            if (validatePassword($password, $hash)) {
                header('Location: change_pass.php?user=' . $cuenta);
                exit();
            } else { //la contraseña insertada no es correcta
                throw new Exception("Credenciales inválidas");
            }
        }
        if (validatePassword($password, $hash)) {
            $_SESSION["id"] = $user["idusuario"];
            $_SESSION["user"] = $user["cuenta"];
            $_SESSION["nombre"] = $user["nombre"];
            $_SESSION["apellidos"] = $user["apellidos"];
            $_SESSION["email"] = $user["correo"];
            $_SESSION["esAdmin"]  = $user["admin"];
            // generar producto de oferta
            $productos = $connection->query(getProductsId());
            $productos = $productos->fetch_all(MYSQLI_ASSOC);
            if (sizeof($productos) > 0) {
                $indexProductoOferta = rand(0, max(sizeof($productos) - 1, 0));
                $_SESSION["oferta"] = $productos[$indexProductoOferta]['idProducto'];
            }
            $cleared = $connection->prepare(clearFailed());
            $cleared->bind_param('i', $id);
            $ok = $cleared->execute();
            header('Location: panel.php');
        } else {
            if ($blocked) {
                header('Location: unlock_account.php');
            } else {
                $attempt = $connection->prepare(incrementFailed());
                $attempt->bind_param('i', $id);
                $ok = $attempt->execute();
                throw new Exception("Credenciales inválidas");
            }
        }
    }
} catch (Exception $e) {
    $isError = true;
    $message = $e->getMessage();
}
