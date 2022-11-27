<?php
include_once "util/database/connection.php";
include_once "util/database/querys.php";

$categoriasArray = array();
$connection = getConnection();
$res = $connection->query(getCategories());
while ($categoriasArray[] = $res->fetch_assoc()) {
}
