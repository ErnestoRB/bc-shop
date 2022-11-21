<?php include "util/session.php" ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include "util/bootstrap.html" ?>

    <title>Inicio | Pumped Up KickShop</title>
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

        <div class="justify-content-center d-flex mx-0">

            <div class="justify-content-center row mx-0 col-10">

                <!-- carrusel -->
                <div id="carouselExampleIndicators" class="carousel slide my-5" data-bs-ride="true">
                    <div class="carousel-indicators">
                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                    </div>
                    <div class="carousel-inner">

                        <div class="carousel-item active">
                            <img src="/images/bannerPUKSes.jpg" class="d-block w-100" alt="banner tienda online">
                        </div>
                        <div class="carousel-item">
                            <img src="/images/bannerPUKS.jpg" class="d-block w-100" alt="banner tienda online">
                        </div>

                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
        </div>

        <div class="justify-content-center row mx-0 text-center">
            <h3>Products</h3>
        </div>
        <div class="justify-content-center row mx-0">
            <div class="col-10 flex-wrap d-flex">

                <!-- tarjetas -->
                <div class="col my-3 d-flex justify-content-center">
                    <div class="card" style="width: 12rem;">
                        <img src="assets/skirt.png" class="card-img-top border-bottom" alt="..." style="box-shadow: 0px 4px 20px 0px #d1d1d1;">
                        <div class="card-body text-center">
                            <div>
                                <label for="" class="text-muted">coral skirt</label>
                            </div>
                            <div>
                                <label for="" class="fw-bold">$19.99</label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col my-3 d-flex justify-content-center">
                    <div class="card" style="width: 12rem;">
                        <img src="..." class="card-img-top border-bottom" alt="..." style="box-shadow: inset 0px -4px 7px 0px #b7b7b7;">
                        <div class="card-body text-center">
                            <div>
                                <label for="" class="text-muted">coral skirt</label>
                            </div>
                            <div>
                                <label for="" class="fw-bold">$19.99</label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col my-3 d-flex justify-content-center">
                    <div class="card" style="width: 12rem;">
                        <img src="..." class="card-img-top border-bottom" alt="..." style="box-shadow: inset 0px -4px 7px 0px #b7b7b7;">
                        <div class="card-body text-center">
                            <div>
                                <label for="" class="text-muted">coral skirt</label>
                            </div>
                            <div>
                                <label for="" class="fw-bold">$19.99</label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col my-3 d-flex justify-content-center">
                    <div class="card" style="width: 12rem;">
                        <img src="..." class="card-img-top border-bottom" alt="..." style="box-shadow: inset 0px -4px 7px 0px #b7b7b7;">
                        <div class="card-body text-center">
                            <div>
                                <label for="" class="text-muted">coral skirt</label>
                            </div>
                            <div>
                                <label for="" class="fw-bold">$19.99</label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col my-3 d-flex justify-content-center">
                    <div class="card" style="width: 12rem;">
                        <img src="..." class="card-img-top border-bottom" alt="..." style="box-shadow: inset 0px -4px 7px 0px #b7b7b7;">
                        <div class="card-body text-center">
                            <div>
                                <label for="" class="text-muted">coral skirt</label>
                            </div>
                            <div>
                                <label for="" class="fw-bold">$19.99</label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col my-3 d-flex justify-content-center">
                    <div class="card" style="width: 12rem;">
                        <img src="..." class="card-img-top border-bottom" alt="..." style="box-shadow: inset 0px -4px 7px 0px #b7b7b7;">
                        <div class="card-body text-center">
                            <div>
                                <label for="" class="text-muted">coral skirt</label>
                            </div>
                            <div>
                                <label for="" class="fw-bold">$19.99</label>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>
        <div class="justify-content-center row mx-0">

        </div>
        <div class="justify-content-center row mx-0">

        </div>
    </main>
    <?php include "layout/footer.html" ?>
</body>

</html>