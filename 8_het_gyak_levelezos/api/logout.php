<?php
    include_once __DIR__ . '/../config/redis.php';

    session_start();
    session_destroy();

    $username = $_SESSION['username'];

    $redis->lpop('online_users', $username);

    session_regenerate_id(true);
?>