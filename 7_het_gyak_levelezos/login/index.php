<?php
  include_once __DIR__ . '/../config/db.php';
  include_once __DIR__ . '/../model/User.php';
  include_once __DIR__ . '/../config/redis.php';

  session_start();

  if(isset($_POST["login"])) {
    $email = $_POST["email"];
    $password = $_POST["password"];

    $sql = "SELECT id, password, username FROM users WHERE email = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);
    $userinfo = mysqli_fetch_all($result);
 
    if(count($userinfo) > 0) {
      $hashedData = hash_hmac('sha256', $password, 'titkos');
      if($hashedData == $userinfo[0][1]) {
        $user = new User(
          $userinfo[0][0],
          $email,
          $userinfo[0][2]
        );

        $redis->rpush("online_users", $email);

        $_SESSION["user"] = $user;

        echo "Sikeres bejelentkezés";
      } else {
        echo "Hibás e-mail cím vagy jelszó!";
      }
    } else {
      echo "Hibás e-mail cím vagy jelszó!";
    }
  }
?>

<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  <h1>Belépés</h1>
      <form method="POST">
        <input type="text" name="email" placeholder="Email cím">
        <input type="password" name="password" placeholder="Jelszó">
        <input type="submit" value="Regisztráció" name="login">
    </form>
</body>
</html>