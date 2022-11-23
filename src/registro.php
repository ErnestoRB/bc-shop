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
  <div style="background:#373737;""class=" n1">
    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
      <button style="background:#373737" class="btn btn-primary me-md-2" type="button"><i class="bi bi-cart-fill"></i></button>
      <button style="background:#373737" class="btn btn-primary" type="button"><i class="bi bi-person"></i></button>
    </div>
  </div>
  <?php include "layout/navbar.php" ?>
  <main class="content">
    <h3>Create an acount</h3>
    <div>

      <form style="background:gray" class="form container">
        <div style="align-items: left;">
          <h6>Already have an account?</h6>
        </div>


        <div class="row">
          <label for="inputName" class="col form-label">First Name</label>
          <input type="text" class="col form-control" id="inputName">
        </div>
        <div class="row">
          <label for="inputLastName" class="form-label">Last Name</label>
          <input type="text" class="col form-control" id="inputLastName">
        </div>
        <div class="row">
          <label for="inputEmail4" class="form-label">Email</label>
          <input type="email" class="col form-control" id="inputEmail4">
        </div>
        <div class="row">
          <label for="inputPassword4" class="form-label">Password</label>
          <input type="password" class="col form-control" id="inputPassword4">


        </div>

        <div class="row">
          <label for="fecha" class="form-label">Birthdate</label>
          <input type="date" class="col form-control" id="fecha">
        </div>
        <div class="row">
          
            <div class="form-check ">
              <input class="col form-check-input" type="checkbox" value="" id="flexCheck1">
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
      </form>
    </div>
  </main>

  <?php include "layout/footer.html"; ?>
</body>

</html>