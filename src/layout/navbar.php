<?php require_once __DIR__ . '/../util/session.php';
require_once __DIR__ . '/../util/admin.php';
$esAdmin = esAdmin();
?>
<div style="background:#373737;" class=" n1">
  <div class="d-grid gap-2 d-flex justify-content-end">
    <button id="carrito" class="btn btn-dark me-md-2 border-1 border-white" type="button"><i class="bi bi-cart-fill"></i><span id="cartNumber" class="badge text-bg-primary">0</span></button>
    <?php if (!$isLogged) {
      echo '<a href="/login.php" class="btn btn-dark border-1 border-white" type="button"><i class="bi bi-person"></i> Iniciar sesión</a>';
    }
    ?>
  </div>
</div>
<nav class="navbar navbar-expand-lg bg-dark">

  <div class="container-fluid">
    <a class="bg-white p-2 navbar-brand text-white" href="/"><img src="images/logoColorShadow.png" width="40"></a>
    <button class="navbar-toggler  border-1 border-white" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <i class="bi bi-list text-white"></i>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">

        <?php if (!$isLogged) {
          echo '
          <li class="nav-item">
            <a style="color:aliceblue" class="nav-link" href="login.php">Iniciar sesión</a>
          </li>
          <li class="nav-item">
            <a style="color:aliceblue" class="nav-link active" aria-current="page" href="registro.php">Registro</a>
          </li>
          ';
        }
        ?>
        <li class="nav-item">
          <a style="color:aliceblue" class="nav-link" href="acerca.php">Acerca de Nosotros</a>
        </li>
        <li class="nav-item">
          <a style="color:aliceblue" class="nav-link" href="acerca.php#faq">Preguntas Frecuentes</a>
        </li>
        <li class="nav-item">
          <a style="color:aliceblue" class="nav-link" href="subscribe.php">Suscribirse</a>
        </li>
        <li class="nav-item">
          <a style="color:aliceblue" class="nav-link" href="contact_us.php">Contacto</a>
        </li>
        <li class="nav-item">
          <a style="color:aliceblue" class="nav-link bg-primary" href="articulos.php">Artículos</a>
        </li>
        <?php if ($esAdmin) {
          echo '
          <li class="nav-item dropdown">
          <a style="color:aliceblue" class="nav-link dropdown-toggle" href="articulos.php" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Administrar
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="/registroArticulo.php">Nuevo artículo </a></li>
            <li><a class="dropdown-item" href="/articulosPanel.php">Administrar articulos</a></li>
          </ul>

          ';
        }
        ?>
        <?php if ($isLogged) {
          echo '
          <li class="nav-item">
            <a class="nav-link text-primary"  href="panel.php">Panel</a>
          </li>
          <li class="nav-item">
            <a class="text-danger nav-link" href="logout.php">Salir</a>
          </li>
          ';
        }
        ?>

      </ul>

    </div>
  </div>
</nav>