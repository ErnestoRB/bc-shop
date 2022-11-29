<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;
    
    require 'PHPMailer/src/PHPMailer.php';
    require 'PHPMailer/src/SMTP.php';
    require 'PHPMailer/src/Exception.php';

    $correo = $_POST["correo"];

    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.office365.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'no_reply_bc@outlook.com';
        $mail->Password = 'ProyectoFinalSW';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;
        $mail->setFrom('no_reply_bc@outlook.com', 'Bash Crashers Support');
        $mail->addAddress($correo);
        $mail->isHTML(true);
        $mail->Subject = 'Recuperacion de cuenta';
        $mail->Body = "<h1 style='color: blue;'>PumpedUp KickShop agradece tu suscripcion</h1>
                        <h3>Aqui recibiras nustras futuras promociones y descuentos</h3>
                        <h4>No te pierdas ninguna noticia!</h6>
                        <hr>
                        <h2 style='color: orangered;'>Como agradecimiento, te hacemos llegar este cupon para un 10% de descuento en tu proxima compra</h2>
                        <div style='border: 1px solid #000; margin: auto; width: 30%; text-align: center; font-size: 3em;'>
                            NEWSHOES10
                        </div>
                        <h4>Envios mas rapidos que una bala!</h6>
                        <p style='font-weight: lighter;'>Este correro no recibe respuestas</p>";
        $mail->send();
    } catch (Exception $exception) {
        echo "Algo salio mal: " . $mail->ErrorInfo;
    }

    header('Location: subscribe.php?status=success');
    exit(1);
?>