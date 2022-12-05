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
                            <a href="#" class="btn btn-primary"><i class="bi bi-cart-plus-fill"></i></a>
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
                        <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <img src="https://static.nike.com/a/images/t_prod_ss/w_960,c_limit,f_auto/b805a450-6459-4b24-b4d2-8092c7fd8082/fecha-de-lanzamiento-del-air-jordan-1-stealth-555088-037.jpg" class="d-block w-100" alt="...">
                                </div>
                                <div class="carousel-item">
                                    <img src="https://static.nike.com/a/images/t_PDP_1280_v1/f_auto,q_auto:eco/1e463dee-799d-4fba-9b32-0f7e0bb9d5f5/calzado-air-jordan-1-low-kT68wc.png" class="d-block w-100" alt="...">
                                </div>
                                <div class="carousel-item">
                                    <img src="..." class="d-block w-100" alt="...">
                                </div>
                            </div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>
                        <div class="card-body text-center">
                            <div>
                                <label for="" class="text-muted">coral skirt</label>
                            </div>
                            <div>
                                <label for="" class="fw-bold">$19.9999</label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col my-3 d-flex justify-content-center">
                    <div class="card" style="width: 12rem;">
                        <img src="..." class="card-img-top border-bottom" alt="..." style="box-shadow: inset 0px -4px 7px 0px #b7b7b7;">
                        <div class="card-body text-center">
                            <div>
                                <label for="" class="text-muted">coral asdasdskirt</label>
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