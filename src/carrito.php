<?php include_once "util/session.php" ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include_once "util/bootstrap.html" ?>
    <title>Carrito</title>
</head>

<body style="background-color: rgb(240, 240, 240); height: 100%;" >
    <div class="row px-0 mx-0 justify-content-around pt-5">
        <div class="px-2 col-md-8 col-sm-12">
            <div class="card my-2 border-0" style="box-sizing: border-box;">
                <div class="card-header bg-white">
                  <h4>Carrito</h4>
                </div>
                <div class="card-body">
                <div class="row px-0 mx-0">
                    <div class="col-sm-3 col-6">
                        <img src="./images/banner.jpg" class="card-img-top" alt="...">
                    </div>
                    <div class="col-sm-4 ps-2 col-6 py-2">
                        <div> <b>Tenis negro y balnco</b></div>
                        <div><label class="text-secondary text-decoration-line-through"> $1,760</label> <label class="badge bg-danger ms-3">-2%</label></div>
                        <div class="fw-semibold text-danger">$1700</div>
                    </div>
                    <div class="col-sm-2 ps-2 col-6 py-2">
                        <input type="number" value="1" style="width: 60px;">
                    </div>
                    <div class="col-sm-3 col-6 p-2 d-flex justify-content-between">
                        <div> <b>$1,705.20</b></div>
                        <div>
                            <i class="bi bi-trash"></i>
                        </div>
                    </div>
                </div>
                </div>
            </div>
        </div>
        <div class="px-2 col-md-4 col-lg-3">
            <div class="card h-100 border-0 p-3 my-2">
                <div class="d-flex justify-content-between">
                    <div>
                        <span>1 articulo</span>
                    </div>
                    <div>
                        <b>$1,705</b>
                    </div>
                </div>
                <div class="d-flex justify-content-between">
                    <div>
                        <span>Envio</span>
                    </div>
                    <div>
                        <b>$60</b>
                    </div>
                </div>
                <hr>
                <div class="d-flex justify-content-between">
                    <div>
                        <b>Total (IVA incluido)</b>
                    </div>
                    <div>
                        <b>$1,705</b>
                    </div>
                </div>
                <small class="mt-4">
                    Impuestos incluidos: <small class="fw-bold">$243.52</small>
                </small>
                <div class="d-flex justify-content-center mt-2">
                    <a class="text-decoration-none" href=""> Tienes un codigo de promocion?</a>
                </div>
                <div class="mt-4">
                    <button class="btn btn-primary w-100"> IR A LA CAJA</button>
                </div>
              </div>
        </div>
        
    </div>
</body>

</html>