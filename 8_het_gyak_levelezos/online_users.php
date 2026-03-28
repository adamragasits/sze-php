<?php
  include_once 'config/restrict.php';
  include_once 'components/header.php';
  include_once 'config/redis.php';

  $users = $redis->lrange('online_users', 0, -1);
?>

<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  <span>Online felhasználók száma: <?php echo count($users); ?></span>
  <?php
    foreach($users as $user) {
      echo "
      
      <span>$user</span>
      
      ";
    }
  ?>
</body>
</html>