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
  <style>
    @font-face {
      font-family: 'NeoPrint M319';
      src: url('/fonts/NeoPrintM319.otf');
    }
  </style>
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
          <label for="inputName" class="form-label">First Name</label>
          <input type="text" class="form-control" id="nombre" name="nombre">
        </div>
        <div class="col-md-6">
          <label for="inputLastName" class="form-label">Last Name</label>
          <input type="text" class="form-control" id="apellidos" name="apellidos">
        </div>
        <div class="col-md-6">
          <label for="inputEmail4" class="form-label">Email</label>
          <input type="email" class="form-control" id="email" name="email">
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
          <div class="captcha"><canvas id="capatcha" height="62"></canvas></div>
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
        
        <button type="submit">Enviar</button>
      </form>
    </div>
  </main>
  

  <?php include "layout/footer.html"; ?>
</body>

</html>