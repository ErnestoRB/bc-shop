<?php include "util/session.php" ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include "util/bootstrap.html" ?>
    <title>Login</title>
    <script src='https://www.google.com/recaptcha/api.js'></script>
</head>

<body>
    <?php include "layout/navbar.php" ?>
    <main id="content">
        
        <div class="d-flex align-items-center px-5 py-4">
            <h2>Login</h2>
        </div>
        <div class="d-flex align-items-center justify-content-center mt-5">
            <div class="card col-8">
            <div class="card-body pt-4">
                <div class="justify-content-center d-flex flex-wrap">
                    <div class="mb-3 col-xs-12 col-sm-10 col-md-6">
                        <label for="inputEmail" class="form-label fw-bold">Email</label>
                        <input type="email" class="form-control" id="inputEmail">
                    </div>
                </div>
                <div class="justify-content-center d-flex flex-wrap">
                    <div class="mb-3 col-xs-12 col-sm-10 col-md-6 ">
                        <label for="inputPassword" class="form-label fw-bold">Password</label>
                        <input type="password" class="form-control" id="inputPassword">
                    </div>
                </div>
                <div class="justify-content-center d-flex flex-wrap">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="rememberme">
                        <label class="form-check-label" for="rememberme">
                            Remember my password
                        </label>
                    </div>
                </div>
                <div class="justify-content-center d-flex py-3">
                    <div class="g-recaptcha" data-sitekey="llave del sitio"></div>
                </div>
                <div class="justify-content-center d-flex">
                    <a class="text-decoration-none text-info" href="">Forgot your password?</a>
                </div>
                <div class="justify-content-center d-flex mt-3">
                    <button type="button" class="btn btn-info text-white">Sign in</button>
                </div>
                <hr>
                <div class="justify-content-center d-flex">
                    <a class="text-decoration-none text-info" href="">No account ? Create one here</a>
                </div>
            </div>
            </div>
        </div>
    
    </main>
    <?php include "layout/footer.html" ?>
</body>

</html>