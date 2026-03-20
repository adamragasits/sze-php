<?php
    include_once 'model/User.php';
    session_start();

    $user = $_SESSION["user"];

    if($_SERVER["REQUEST_METHOD"] == "GET" && !isset($user)) {
        header("Location: login.php");
    }
?>  