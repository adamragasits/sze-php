<?php

    $host = "89.116.229.207";
    $user = "fwdomu";
    $pass = "fwdomu";
    $port = 37200;
    $db = "php";

    try {
        $conn = mysqli_connect($host, $user, $pass, $db, $port);
    }
    catch (Exception $e) {
        echo "Hiba a csatlakozásnál!";
    }

?>
