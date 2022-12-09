<?php include_once "util/session.php" ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include_once "util/bootstrap.html" ?>
    <script src="/js/tarjetas.js"></script>
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
        <div id="contprod" class="d-flex flex-wrap">
            <!--Contenedor para ajax-->
            <div class="flex-wrap d-flex">







            </div>
        </div>
        <div class="justify-content-center row mx-0">
        </div>
        <div class="justify-content-center row mx-0">

        </div>
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
                            <img src="/images/cupon1.jpg" class="d-block w-100" alt="">
                        </div>
                        <div class="carousel-item">
                            <img src="/images/cupon2.jpg" class="d-block w-100" alt="">
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


    </main>
    <?php include "layout/footer.html" ?>
</body>

</html>