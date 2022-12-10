<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include_once "util/bootstrap.html" ?>
    <title>Metodos de pago</title>
    <style>
    
        body {
            background: #373737;
            line-height: 1.618em;
        }
        .wrapper {
            max-width: 50rem;
            width: 100%;
            margin: 0 auto;
        }
        .tabs {
            position: relative;
            margin: 3rem 0;
            background: #1abc9c;
            height: 16rem;
        }
        .tabs::before,
        .tabs::after {
            content: "";
            display: table;
        }
        .tabs::after {
            clear: both;
        }
        .tab {
            float: left;
        }
        .tab-switch {
            display: none;
        }
        .tab-label {
            position: relative;
            display: block;
            line-height: 2.75em;
            height: 3em;
            padding: 0 1.618em;
            background: #1abc9c;
            border-right: 0.125rem solid #16a085;
            color: #fff;
            cursor: pointer;
            top: 0;
            transition: all 0.25s;
        }
        .tab-label:hover {
            top: -0.25rem;
            transition: top 0.25s;
        }
        .tab-content {
            position: absolute;
            z-index: 1;
            top: 2.75em;
            left: 0;
            padding: 1.618rem;
            background: #fff;
            color: #2c3e50;
            border-bottom: 0.25rem solid #bdc3c7;
            opacity: 0;
            transition: all 0.35s;
        }
        .tab-switch:checked + .tab-label {
            background: #fff;
            color: #2c3e50;
            border-bottom: 0;
            border-right: 0.125rem solid #fff;
            transition: all 0.35s;
            z-index: 1;
            top: -0.0625rem;
        }
        .tab-switch:checked + label + .tab-content {
            z-index: 2;
            opacity: 1;
            transition: all 0.35s;
        }
    </style>
</head>
<body>
    <?php include "layout/navbar.php" ?>
    <main id="content">
    <div class="wrapper">
        <div class="mt-4">
            <h3>Metodo de pago</h3>
        </div>
        <div class="tabs">
          <div class="tab">
            <input type="radio" name="css-tabs" id="tab-1" checked class="tab-switch">
            <label for="tab-1" class="tab-label">Tarjeta de Debito</label>
            <div class="tab-content">
                <div class="row gy-3">
                    <div class="col-md-6">
                        <label for="cc-name" class="form-label">Nombre en la tarjeta</label>
                        <input type="text" class="form-control" id="cc-name" placeholder="" required="">
                        <small class="text-muted">Nombre completo como se muestra en la tarjeta</small>
                    </div>
                    <div class="col-md-6">
                        <label for="cc-number" class="form-label">Número de tarjeta de crédito</label>
                        <input type="text" class="form-control" id="cc-number" placeholder="" required="">
                    </div>
                    <div class="col-md-3">
                        <label for="cc-expiration" class="form-label">Vencimiento</label>
                        <input type="text" class="form-control" id="cc-expiration" placeholder="" required="">
                    </div>
                    <div class="col-md-3">
                        <label for="cc-cvv" class="form-label">CVV</label>
                        <input type="text" class="form-control" id="cc-cvv" placeholder="" required="">
                    </div>
                </div>
            </div>
          </div>
          <div class="tab">
            <input type="radio" name="css-tabs" id="tab-2" class="tab-switch">
            <label for="tab-2" class="tab-label">Tarjeta de credito</label>
            <div class="tab-content">
                <div class="row gy-3">
                    <div class="col-md-6">
                        <label for="cc-name" class="form-label">Nombre en la tarjeta</label>
                        <input type="text" class="form-control" id="cc-name" placeholder="" required="">
                        <small class="text-muted">Nombre completo como se muestra en la tarjeta</small>
                    </div>
                    <div class="col-md-6">
                        <label for="cc-number" class="form-label">Número de tarjeta de crédito</label>
                        <input type="text" class="form-control" id="cc-number" placeholder="" required="">
                    </div>
                    <div class="col-md-3">
                        <label for="cc-expiration" class="form-label">Vencimiento</label>
                        <input type="text" class="form-control" id="cc-expiration" placeholder="" required="">
                      
                    </div>
                    <div class="col-md-3">
                        <label for="cc-cvv" class="form-label">CVV</label>
                        <input type="text" class="form-control" id="cc-cvv" placeholder="" required="">
                    </div>
                </div>
            </div>
          </div>
          <div class="tab">
            <input type="radio" name="css-tabs" id="tab-3" class="tab-switch">
            <label for="tab-3" class="tab-label">PayPal</label>
            <div class="tab-content">
                <div class="row gy-3">
                    <div class="col-md-6">
                        <label for="cc-name" class="form-label">Nombre en la tarjeta</label>
                        <input type="text" class="form-control" id="cc-name" placeholder="" required="">
                        <small class="text-muted">Nombre completo como se muestra en la tarjeta</small>
                    </div>
                    <div class="col-md-6">
                        <label for="cc-number" class="form-label">Número de tarjeta de crédito</label>
                        <input type="text" class="form-control" id="cc-number" placeholder="" required="">
                    </div>
                    <div class="col-md-3">
                        <label for="cc-expiration" class="form-label">Vencimiento</label>
                        <input type="text" class="form-control" id="cc-expiration" placeholder="" required="">
                    </div>
                    <div class="col-md-3">
                        <label for="cc-cvv" class="form-label">CVV</label>
                        <input type="password" class="form-control" id="cc-cvv" placeholder="" required="">
                    </div>
                </div>
            </div>
          </div>
        </div>
        <div class="d-flex justify-content-end py-3">
            <button type="button" class="btn btn-info text-white col-4 fw-bold">Pagar</button>
        </div>
    </div>
    </main>
    <?php include "layout/footer.html" ?>
</body>
</html>