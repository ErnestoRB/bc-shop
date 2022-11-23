<?php
require_once "util/session.php";
require_once "util/captcha.php";

echo validarCaptcha('valor')  ? "Captcha Correcta" : "Captcha Incorrecta";
