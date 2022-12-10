<?php include_once "util/session.php";
include "handle_login.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <script src="/js/jquery.min.js"></script>
    <link rel="stylesheet" href="/css/captcha.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include_once "util/bootstrap.html" ?>
    <title>Login</title>
    <script src="/js/jsCaptcha.js" defer></script>
</head>

<body>

    <?php include "layout/navbar.php" ?>
    <main id="content">
        <div class="d-flex align-items-center px-5 py-4">
            <h2>Login</h2>
        </div>
        <form class="d-flex align-items-center justify-content-center mt-5" action="<?= $_SERVER["PHP_SELF"]; ?>" method="post">
            <div class="card col-8">
                <div class="card-body pt-4">
                    <?php include_once "util/handle_error.php" ?>

                    <div class="justify-content-center d-flex flex-wrap">
                        <div class="mb-3 col-xs-12 col-sm-10 col-md-6">
                            <label for="inputEmail" class="form-label fw-bold">Email</label>
                            <input type="email" class="form-control" name="email" id="inputEmail" required value="<?= !empty($_COOKIE["email"]) ? $_COOKIE["email"] : '' ?>">
                        </div>
                    </div>
                    <div class="justify-content-center d-flex flex-wrap">
                        <div class="mb-3 col-xs-12 col-sm-10 col-md-6 ">
                            <label for="inputPassword" class="form-label fw-bold">Contraseña</label>
                            <input type="password" class="form-control" name="pass" id="inputPassword" required value="<?= !empty($_COOKIE["pass"]) ? $_COOKIE["pass"] : '' ?>">
                        </div>
                    </div>

                    <div class="justify-content-center d-flex flex-wrap">
                        <div class="mb-3 col-xs-12 col-sm-10 col-md-6 justify-content-center d-flex flex-wrap">
                            <div class="captcha"><canvas id="captcha" height="62" width="150"></canvas></div>
                            <button id="refreshCaptcha" class="btn btn-primary" type="button"><i class="bi bi-arrow-clockwise"></i></button>
                        </div>
                    </div>
                    <div class="justify-content-center d-flex flex-wrap">
                        <div class="mb-3 col-xs-12 col-sm-10 col-md-6">
                            <label for="code-captcha" class="form-label">Código captcha</label>
                            <input type="text" class="form-control" name="code-captcha" id="valorCapt" required>
                        </div>
                    </div>
                    <div class="justify-content-center d-flex flex-wrap">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="si" name="recordar" id="rememberme">
                            <label class="form-check-label" for="rememberme">
                                Recordar contraseña
                            </label>
                        </div>
                    </div>
                    <div class="justify-content-center d-flex">
                        <a class="text-decoration-none text-info" href="unlock_account.php">Olvidaste tu cuenta?</a>
                    </div>
                    <div class="justify-content-center d-flex mt-3">
                        <button type="submit" class="btn btn-info text-white">Iniciar sesión</button>
                    </div>
                    <hr>
                    <div class="justify-content-center d-flex">
                        <a class="text-decoration-none text-info" href="/registro.php">No tienes cuenta? Crea una aquí</a>
                    </div>
                </div>
            </div>
        </form>
    </main>
    <?php include "layout/footer.html" ?>
</body>

</html>