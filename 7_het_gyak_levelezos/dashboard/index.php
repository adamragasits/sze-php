<?php
  include_once __DIR__ . "/../config/redis.php";
?>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  <span>Online felhasználók: <?php echo $redis->llen("online_users"); ?></span>
  <a href="/logout">Kilépés</a>
</body>
</html>