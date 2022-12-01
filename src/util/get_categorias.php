<?php
include_once "util/database/connection.php";
include_once "util/database/querys.php";

$connection = getConnection();
$res = $connection->query(getCategories());
$categoriasArray = $res->fetch_all(MYSQLI_BOTH);
