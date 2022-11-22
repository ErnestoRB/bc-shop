<?php

/**
 * @param campos Array con los nombres de las  variables que no deben ser vacias
 */
function validatePostArray($campos)
{
    foreach ($campos as $i => $valor) {
        if (empty($_POST[$valor])) {
            throw new Exception("Faltó llenar el campo: " . $valor);
        }
    }
}

/**
 * @param nombre Nombre del archivo
 * @return boolean True si no está  vacio
 */
function validateFile($nombre)
{
    return !empty($_FILES[$nombre]) && $_FILES[$nombre]["size"] != 0;
}
