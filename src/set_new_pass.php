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

    $connection = getConnection();
    if ($connection->connect_errno) {
        header('Location: 500.php');
        exit(1);
    }

    $result = $connection->query(getUserInfo($user));

    if ($result->num_rows < 1) {
        header('Location: 500.php');
        exit(1);
    }

    $user = $result->fetch_assoc();
    $cuenta = $user["cuenta"];
    $generated = $user["passgenerado"];
    $id = $user["idusuario"];

    if($generated != 1){
        header('Location: 500.php');
        exit(1);
    }

    $hash = hashPassword($password);

    $update_pass = $connection -> query(updateUserPassword($id, $hash));
    $clear_tries = $connection -> query(clearFailed($id));
    $unlock = $connection -> query(releaseUserAccount($id));
    $unset_generated = $connection -> query(unsetGeneratedPassword($id));

    if($unlock){
        header('Location: login.php'); 
        exit();
    }

?>