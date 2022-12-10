<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;
    
    require 'PHPMailer/src/PHPMailer.php';
    require 'PHPMailer/src/SMTP.php';
    require 'PHPMailer/src/Exception.php';

    $correo = $_POST["correo"];
    $nombre = $_POST["nombre"];
    $comment = $_POST["comentario"];

    $mail = new PHPMailer(true);

    /*Correo para ver los comentarios
    comments_bc@outlook.com
    ProyectoFinalSW*/
    

    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.office365.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'no_reply_bc@outlook.com';
        $mail->Password = 'ProyectoFinalSW';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;
        $mail->setFrom('no_reply_bc@outlook.com', 'Bash Crashers Support');
        $mail->addAddress('comments_bc@outlook.com');
        $mail->addAddress('no_reply_bc@outlook.com');
        $mail->isHTML(true);
        $mail->Subject = $nombre . ' ha enviado un comentario';
        $mail->Body = "<h1>Comentario de ". $nombre ."</h1>
                        <h3>". $correo ."</h3>
                        <p>". $comment ."</p>";
        $mail->send();
    } catch (Exception $exception) {
        echo "Algo salio mal: " . $mail->ErrorInfo;
    }

    header('Location: contact_us.php?status=success');
    exit(1);
