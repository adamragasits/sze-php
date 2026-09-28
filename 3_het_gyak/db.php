<?php

    $host = "localhost";
    $user = "root";
    $pass = "";
    $db = "webshop";

    try {
        $conn = mysqli_connect($host, $user, $pass, $db);
    }
    catch (Exception $e) {
        echo "Hiba a csatlakozásnál!";
    }

?>