<?php include_once "util/session.php" ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include_once "util/bootstrap.html" ?>

    <title>Inicio | Pumped Up KickShop</title>
</head>

<body>
    <main id="content">
        <div class="container" style="--bs-columns: 10; --bs-gap: 1rem;">

            <div class="row">
                <div class="col-8">
                    <div class="accordion" id="accordion1">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headOne">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    Direcciones
                                </button>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <div class="form-floating mb-3">
                                        <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
                                        <label for="floatingInput">Address</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="accordion" id="accordion2">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headDos">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    Tipo de Envio
                                </button>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                                        <label class="form-check-label" for="flexRadioDefault1">
                                            Recoger en tienda
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2">
                                        <label class="form-check-label" for="flexRadioDefault1">
                                            Envio estandar
                                        </label>
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
                    </div>
                    <div class="accordion" id="accordion3">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headTres">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    Pago
                                </button>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault3">
                                        <label class="form-check-label" for="flexRadioDefault1">
                                            Pago por transferencia Bancaria
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault4">
                                        <label class="form-check-label" for="flexRadioDefault1">
                                            Pago contra entrega
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
                                <div class="col-8">Impuestos Incluidos </div>

                                <br>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </main>
</body>