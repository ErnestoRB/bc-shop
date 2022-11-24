<?php include_once "util/session.php";
require "handle_register.php";

if ($isLogged) {
  header('Location: panel.php');
  exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <link rel="stylesheet" href="/css/captcha.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php include_once "util/bootstrap.html" ?>
  <title>Registro</title>
  <script src="/js/jsCaptcha.js" defer></script>
</head>

<body>
  <div style="background:#373737;" class="n1">
    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
      <button style="background:#373737" class="btn btn-primary me-md-2" type="button"><i class="bi bi-cart-fill"></i></button>
      <button style="background:#373737" class="btn btn-primary" type="button"><i class="bi bi-person"></i></button>
    </div>
  </div>
  <?php include "layout/navbar.php" ?>
  <main id="content">
    <h3>Create an acount</h3>
    <div>
      <form action="<?= $_SERVER["PHP_SELF"] ?>" class="form bg-white" method="post">
        <div style="align-items: left;">
          <h6>Already have an account?</h6>
        </div>
        <?php include_once "util/handle_error.php" ?>
        <div class="col-md-6">
          <label for="inputLastName" class="form-label">Username</label>
          <input type="text" class="form-control" id="usuario" name="usuario">
        </div>
        <div class="col-md-6">
          <label for="inputEmail4" class="form-label">Email</label>
          <input type="email" class="form-control" id="email" name="email">
        </div>
        <div class="col-md-6">
          <label for="inputName" class="form-label">First Name</label>
          <input type="text" class="form-control" id="nombre" name="nombre">
        </div>
        <div class="col-md-6">
          <label for="inputLastName" class="form-label">Last Name</label>
          <input type="text" class="form-control" id="apellidos" name="apellidos">
        </div>

        <div class="col-md-6">
          <label for="inputPassword4" class="form-label">Password</label>
          <input type="password" class="form-control" id="pass" name="pass">
        </div>
        <div class="col-md-6">
          <label for="inputPassword4" class="form-label">Confirm Password</label>
          <input type="password" class="form-control" id="pass2" name="pass2">
        </div>
        <div class="col-md-6">
          <div class="captcha"><canvas id="captcha" height="62"></canvas></div>
          <button id="refreshCaptcha" class="btn btn-primary" type="button"><i class="bi bi-arrow-clockwise"></i></button>
        </div>
        <div class="col-md-6">
          <label for="code-captcha" class="form-label">Código captcha</label>
          <input type="text" class="form-control" name="code-captcha" id="valorCapt" required>
        </div>
        <div class="col-md-6">
          <label for="fecha" class="form-label">Birthdate</label>
          <input type="date" class="form-control" id="fecha">
        </div>
        <div class="col-md-6">
          <div class="col-2">
            <div class="form-check ">
              <input class="form-check-input" type="checkbox" value="" id="flexCheck1">
            </div>
            <div class="col-4">
              <label class="form-check-label" for="flexCheck1">Recive offers from our parthners</label>
            </div>
          </div>
          <div class="col-2">
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="" id="flexCheck2">
            </div>
            <label class="form-check-label" for="flexCheck2">Customer data privacy</label>
          </div>
          <div class="col-2">
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="" id="flexCheck3">
            </div>

            <label class="form-check-label" for="flexCheck3">Sign up for our newsletter</label>
          </div>
        </div>
        <button type="submit">Enviar</button>
      </form>
    </div>
  </main>

  <?php include "layout/footer.html"; ?>
</body>

</html>