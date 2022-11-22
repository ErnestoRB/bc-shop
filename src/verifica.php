<?php
session_start();

//Verificamos la entrada de variable global
if (!empty($_POST['valor'])) {
    
    if( md5($_POST['valor']) === $_COOKIE["captcha"]) {
        echo "Captcha Correcta";
    } else {
        echo "Captcha Incorrecta";
    }
}
?>