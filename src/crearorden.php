<?php include_once "util/session.php" ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include_once "util/bootstrap.html" ?>

    <title>Crear Orden | Pumped Up KickShop</title>
</head>

<body>
    <main id="content">
        <div class="container" style="--bs-columns: 10; --bs-gap: 1rem;">

            <div class="row">
                <div class="col-8">
                    <div class="accordion" id="accordionExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingOne">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    Direcciones
                                </button>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <form class="row g-3">

                                        <div class="col-12">
                                            <label for="inputAddress" class="form-label">Address</label>
                                            <input type="text" class="form-control" id="inputAddress" placeholder="1234 Main St">
                                        </div>
                                        <div class="col-12">
                                            <label for="inputAddress2" class="form-label">Address 2</label>
                                            <input type="text" class="form-control" id="inputAddress2" placeholder="Apartment, studio, or floor">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="inputCity" class="form-label">City</label>
                                            <input type="text" class="form-control" id="inputCity">
                                        </div>
                                        <div class="col-md-4">
                                            <label for="inputState" class="form-label">State</label>
                                            <select id="inputState" class="form-select">
                                                <option selected>Choose...</option>
                                                <option>...</option>
                                            </select>
                                        </div>
                                        <div class="col-md-2">
                                            <label for="inputZip" class="form-label">Zip</label>
                                            <input type="text" class="form-control" id="inputZip">
                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingTwo">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    Tipo de Envio
                                </button>
                            </h2>
                            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <div class="container text-center">
                                        <div style="background-color:#ECECEC;" class="row">
                                            <div class="col">
                                                <div  class="form-check">
                                                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                                                    <label class="form-check-label" for="flexRadioDefault1">
                                                        PumpedUp KickShop
                                                    </label>
                                                </div>
                                            </div>
                                                <div class="col order-5">
                                                ¡Gratis!
                                                </div>
                                                <div class="col order-1">
                                                Recoger en Tienda
                                                </div>
                                        </div>
                                    </div>
                                    <div class="container text-center">
                                        <div style="background-color:#ECECEC;" class="row">
                                            <div class="col">
                                                <div  class="form-check">
                                                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                                                    <label class="form-check-label" for="flexRadioDefault1">
                                                    <i class="bi bi-truck">Envio Estandar</i>
                                                    </label>
                                                </div>
                                            </div>
                                                <div class="col order-5">
                                                $79 c/iva incl.
                                                </div>
                                                <div class="col order-1">
                                                Envio Estandar
                                                </div>
                                        </div>
                                    </div>
                                <br>
                                <h6>Si desea dejarnos un comentario acerca de su pedido, por favor escribalo a continuacion</h6>
                                <div class="form-floating">
                                    <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea"></textarea>
                                    <label for="floatingTextarea">Comments</label>
                                </div>
                                <br>
                                <button class="btn btn-primary" type="submit">CONTINUAR</button>
                            </div>

                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingThree">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    Pago
                                </button>
                            </h2>
                            <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault3">
                                        <label class="form-check-label" for="flexRadioDefault1">
                                            Pago Mediante Paypal <i class="bi bi-paypal"></i>
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault4">
                                        <label class="form-check-label" for="flexRadioDefault1">
                                            Pago en Banco <i class="bi bi-bank2"></i>
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault4">
                                        <label class="form-check-label" for="flexRadioDefault1">
                                            Pago en Oxxo
                                        </label>

                                    </div>
                                    <br>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                        <label class="form-check-label" for="flexCheckDefault">
                                            Estoy de acuerdo con los terminos del servicio y los acepto sin reservas
                                        </label>
                                    </div>
                                    <br>
                                    <button type="submit" style="align-items:left;" class="btn btn-secondary" disabled>COLOCAR COMPRA</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                </div>



                <div class="col-4">
                    <div class="card" style="width: 18rem;">
                        <div class="card-body">

                            <h6 class="card-subtitle mb-2 text-muted">1 Articulo</h6>
                            <a href="#" class="card-link">Card link</a>
                            <hr>
                            <div class="row">
                                <div class="col-8">
                                    Subtotal
                                </div>
                                <div class="col-4" style="text-align:left;">
                                    $123
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-8">
                                    Envio
                                </div>
                                <div class="col-4" style="text-align:left;">
                                    $79.00
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-8">
                                    Total (IVA Incluido)
                                    <br>
                                </div>
                                <div class="col-4" style="text-align:left;">
                                    $225
                                </div>

                                <br>
                                <div class="col-8">Impuestos Incluidos </div><br>
                                <a href="#" class="text-decoration-none">Tiene un codigo promocional?</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>



    </main>
</body>