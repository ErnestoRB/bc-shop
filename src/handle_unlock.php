<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
require 'PHPMailer/src/Exception.php';

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
$connection = getConnection();
if ($connection->connect_errno) {
    header('Location: 500.php');
    exit(1);
}

$result = $connection->query(getUserInfo($user));

if ($result->num_rows < 1) {
    header('Location: 500.php');
    exit(1);
}

$user = $result->fetch_assoc();
$blocked = $user["bloqueo"];

if($blocked){
    $correo = $user["correo"];
    $nombre = $user["nombre"];

    $chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!#$%&/()=?@_-';
    $new_pass = substr(str_shuffle($chars), 0, 16);

    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.office365.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'bashcrashers_supp@outlook.com';
        $mail->Password = 'BashCrashersSupport@#';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;
        $mail->setFrom('bashcrashers_supp@outlook.com', 'Bash Crashers Support');
        $mail->addAddress($correo, $nombre);
        $mail->isHTML(true);
        $mail->Subject = 'Recuperacion de cuenta';
        $mail->Body = '<h1 style="color: blue;">Recuperacion de cuenta de PumpedUp KickShop</h1>
                        <p>Use esta clave generada para poder desbloquear su cuenta.</p><br>
                        <p style="color: red;">'.$new_pass.'</p><br>
                        <p>Recuerde insertar una nueva contraseña al ingresar la que le hemos brindado, esto por motivos de seguridad.</p><br>
                        <h5>Este correo no recibe respuestas.</h5>';
        $mail->send();
    } catch (Exception $exception) {
        echo "Algo salio mal: " . $mail->ErrorInfo;
    }
    $id = $user["idusuario"];
    $hash = hashPassword($new_pass);
    $update_pass = $connection -> query(updateUserPassword($id, $hash));
    header('Location: unlock_account.php');
}
else{
    header('Location: login.php');
    exit(1);
}