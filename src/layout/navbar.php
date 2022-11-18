<?php require __DIR__ . '/../util/session.php'; ?>
<nav class="navbar navbar-expand-lg bg-dark">

    <div class="container-fluid">
        <a class="navbar-brand text-white" href="#">BashCrashers shop</a> 
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="registro.php">Registro</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Login</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Articulos 
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#">A1</a></li>
            <li><a class="dropdown-item" href="#">A2</a></li>
            <li><a class="dropdown-item" href="#">A3</a></li>
          </ul>
        </li>
        
      </ul>
      <form class="d-flex" role="search">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form>
    </div>
        
    
      
    
        
    </div>

</nav>