<?php
  include __DIR__ . '/../model/User.php';
  include __DIR__ . '/../config/redis.php';

  session_start();
  session_destroy();

  $user = $_SESSION["user"];
  $redis->lrem("online_users", 1, $user->email);
?>