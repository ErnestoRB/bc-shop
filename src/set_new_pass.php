<?php
require "util/session.php";
require "util/database/connection.php";
require "util/database/querys.php";
require "util/hash/password.php";

if ($isLogged) {
    header('Location: panel.php');
    exit(1);
}

if ($_SERVER["REQUEST_METHOD"] !== 'POST') {
    header('Location: index.php');
    exit(1);
}

$user = $_POST["user"];
$password = $_POST["new_pass"];
$passwordComp = $_POST["new_pass_comp"];

if ($password !== $passwordComp) {
    header('Location: 500.php');
    exit(1);
}

$connection = getConnection();
if ($connection->connect_errno) {
    header('Location: 500.php');
    exit(1);
}

$result = $connection->prepare(getUserInfo());
$result->bind_param("s", $user);
$result->execute();
$UserInf = $result->get_result();

if ($UserInf->num_rows < 1) {
    header('Location: 500.php');
    exit(1);
}

$user = $UserInf->fetch_assoc();
$cuenta = $user["cuenta"];
$generated = (bool) $user["passgenerado"];
$id = $user["idusuario"];

if (!$generated) {
    header('Location: 500.php');
    exit(1);
}

$hash = hashPassword($password);

$update_pass = mysqli_prepare($connection, updateUserPassword());
mysqli_stmt_bind_param($update_pass, "si", $hash, $id);
$update_pass->execute();

$clear_tries = $connection->prepare(clearFailed($id));
$clear_tries->bind_param('i', $id);
$ok = $clear_tries->execute();
$unlock = $connection->prepare(releaseUserAccount());
$unlock->bind_param('i', $id);
$ok = $unlock->execute();

$unset_generated = $connection->prepare(unsetGeneratedPassword());
$unset_generated->bind_param('i', $id);
$ok = $unset_generated->execute();

if ($unlock) {
    header('Location: login.php');
    exit();
}
