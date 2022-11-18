<?php
include "util/database/connection.php";
include "util/database/querys.php";

$categoriasArray = array();
$connection = getConnection();
$res = $connection->query(getCategories());
while ($categoriasArray[] = $res->fetch_assoc()) {
}
