<?php

function getConnection()
{
    return new mysqli($_ENV["DB_HOST"], $_ENV["DB_USER"], $_ENV["DB_PASSWORD"], $_ENV["DB_NAME"]);
}
function closeconection($cloesconection){
    return mysqli_close($cloesconection);
}
//hay que cerrar la bd en donde se abrió para mas seguridad
?>