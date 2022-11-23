<?php
require_once "util/session.php";
session_unset();
session_destroy();
header("Location: index.php");
