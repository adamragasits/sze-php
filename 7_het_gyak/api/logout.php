<?php
    include_once '../components/redis.php';
    include '../model/User.php';

    session_start();
    session_destroy();

    session_regenerate_id(true);

    $user = $_SESSION["user"];
    $redis->lrem("online_users", 1, $user->username);
?>