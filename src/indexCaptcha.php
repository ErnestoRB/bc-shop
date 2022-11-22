<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Captcha</title>
    <style>
        @font-face {
            font-family: 'NeoPrint M319';
            src: url('fonts/NeoPrintM319.otf');
        }
    </style>
</head>

<body>

    <div class="contiene">
        <div>

            <div class="captcha"><canvas id="capatcha" height="62"></canvas></div>
            <button class="btncapt"><i class="fa-solid fa-arrows-rotate"></i></button>
            <form action="" method="post" name="FormEntrar">
                <input type="text" name="code-captcha" id="valorCapt" required>
                <button class="btn btn-lg btn-primary btn-block btn-signin" id="IngresoLog" type="button">Entrar</button>
            </form>
        </div>
    </div>

</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://kit.fontawesome.com/f196c94689.js" crossorigin="anonymous"></script>
<script src="js/jsCaptcha.js"></script>

</html>