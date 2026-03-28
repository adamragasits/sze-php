<?php
    ob_start();
    session_start();

    $user = $_SESSION["username"] ?? null;
    $uri = $_SERVER["REQUEST_URI"];

    $availableAsGuest = [
      '/login.php',
      '/register.php',
    ];

    if(isset($user) && in_array($uri, $availableAsGuest) ) {
      header("Location: /dashboard.php");
    }

    if(!isset($user) && !in_array($uri, $availableAsGuest) ) {
      header("Location: /login.php");
    }
?>  