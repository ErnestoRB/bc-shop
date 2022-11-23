<?php

function GenerarCaptcha($cantidad)
{
    $captcha = null;
    //Arreglo para que genere caracteres
    //numericos y letras
    $carater = array(
        1, 2, 3, 4, 5, 6, 7, 8, 9, 0,
        'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j',
        'k', 'l', 'm', 'o', 'p', 'q', 'r', 's', 't', 'v',
        'w', 'x', 'y', 'z', 'A', 'B', 'C', 'D', 'F', 'G',
        'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'K',
        'R', 'S', 'T', 'V', 'W', 'X', 'Y', 'Z'
    );
    //Se realiza la generacion
    //de cantidad de caracters
    $posicion = 0;
    while ($posicion <= ($cantidad - 1)) {
        $radom = rand(0, count($carater) - 1);
        $captcha .= $carater[$radom];
        $posicion++;
    }
    return $captcha;
}

function validarCaptcha($inputName)
{
    if (!empty($_POST[$inputName])) {
        return md5($_POST[$inputName]) === $_COOKIE["captcha"];
    }
    return false;
}
