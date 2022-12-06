<?php

require_once __DIR__ . '/../util/session.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(array("message" => "Sólo metodo POST"));
    exit();
}

$_POST = json_decode(file_get_contents('php://input'), true);

if (empty($_POST)) {
    http_response_code(400);
    echo json_encode(array("message" => "Manda JSON en el cuerpo de la petición"));
    exit();
}

if (!$isLogged) {
    http_response_code(401);
    echo json_encode(array("message" => "Necesitas iniciar sesión para comprar"));
    exit();
}

$_SESSION["orden"] = $_POST;
echo json_encode(array("message" => "Pre-orden creada"));
