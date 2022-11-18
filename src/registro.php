<?php include "util/session.php" ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include "util/bootstrap.html" ?>
    <title>Registro</title>
</head>

<body>
    <?php include "layout/navbar.php" ?>
    <main class="content">
    <h3>Create an acount</h3>
  <div>
    <form style="background:gray" class="form">
    <div class="col-md-6">
    <label for="inputName" class="form-label">First Name</label>
    <input type="text" class="form-control" id="inputName" >
  </div>
  <div class="col-md-6">
    <label for="inputLastName" class="form-label">Last Name</label>
    <input type="text" class="form-control" id="inputLastName" >
  </div>
    <div class="col-md-6">
    <label for="inputEmail4" class="form-label">Email</label>
    <input type="email" class="form-control" id="inputEmail4">
  </div>
  <div class="col-md-6">
    <label for="inputPassword4" class="form-label">Password</label>
    <input type="password" class="form-control" id="inputPassword4">
    <button type="button" class="btn btn-outline-dark">Show</button>
  </div>

  <div class="col-md-6">
    <label for="fecha" class="form-label">Birthdate</label>
    <input type="date" class="form-control" id="fecha">
  </div>
  <div class="col-md-6">
  <input class="form-check-input" type="checkbox" value="" id="flexCheck1">
  <label class="form-check-label" for="flexCheck1">
    Recive offers from our parthners
  </label>
  </div>
  <div class="col-md-6">
  <input class="form-check-input" type="checkbox" value="" id="flexCheck2">
  <label class="form-check-label" for="flexCheck2">
    Customer data privacy
  </label>
  </div>
  <div class="col-md-6">
  <input class="form-check-input" type="checkbox" value="" id="flexCheck3">
  <label class="form-check-label" for="flexCheck3">
    Sign up for our newsletter
  </label>
  </div>
    </form>
  </div>
    </main>
    
    <?php include "layout/footer.html"; ?>
</body>

</html>