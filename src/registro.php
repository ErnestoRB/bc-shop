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
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>

<body>

  <?php include "layout/navbar.php" ?>
  <main id="content">
    <h3>Create an acount</h3>
    <div>
      <form action="<?= $_SERVER["PHP_SELF"] ?>" class="form bg-white" method="post">
        <div class="justify-content-left d-flex">

          <a class="text-decoration-none text-info" href="login.php">Already have account? Log in instead!</a>
        </div>
        <?php include_once "util/handle_error.php" ?>
        <div class="col-md-6">
          <label for="usuario" class="form-label">Username</label>
          <input type="text" class="form-control" id="nombre" name="usuario" required>
        </div>
        <div class="col-md-6">
          <label for="nombre" class="form-label">First Name</label>
          <input type="text" class="form-control" id="nombre" name="nombre" required>
        </div>
        <div class="col-md-6">
          <label for="apellidos" class="form-label">Last Name</label>
          <input type="text" class="form-control" id="apellidos" name="apellidos" required>
        </div>
        <div class="col-md-6">
          <label for="email" class="form-label">Email</label>
          <input type="email" class="form-control" id="email" name="email" required>
        </div>

        <div class="col-md-6">
          <label for="pass" class="form-label">Password</label>
          <input type="password" class="form-control" id="pass" name="pass" required>
        </div>
        <div class="col-md-6">
          <label for="pass2" class="form-label">Confirm Password</label>
          <input type="password" class="form-control" id="pass2" name="pass2" required>
        </div>
        <div class="col-md-6">
          <div class="captcha"><canvas id="captcha" height="62"></canvas></div>
          <button id="refreshCaptcha" class="btn btn-primary" type="button"><i class="bi bi-arrow-clockwise"></i></button>
        </div>
        <div class="col-md-6">
          <label for="code-captcha" class="form-label">Código captcha</label>
          <input type="text" class="form-control" name="code-captcha" id="valorCapt" required>
        </div>
        <button type="submit">Enviar</button>
      </form>
    </div>
  </main>


  <?php include "layout/footer.html"; ?>
</body>

</html>