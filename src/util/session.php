<?php
if (session_status() !== PHP_SESSION_ACTIVE) session_start();
$isLogged = isset($_SESSION["email"]);
