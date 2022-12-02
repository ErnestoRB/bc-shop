<?php
function esAdmin()
{
    if (session_status() !== PHP_SESSION_ACTIVE) return false;
    if (empty($_SESSION["esAdmin"])) return false;
    return (bool) $_SESSION["esAdmin"] == true;
}
