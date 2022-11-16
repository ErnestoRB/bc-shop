<?php

function hashPassword($password)
{
    return password_hash($password, PASSWORD_BCRYPT);
}

function validatePassword($password, $hash)
{
    return password_verify($password, $hash);
}
