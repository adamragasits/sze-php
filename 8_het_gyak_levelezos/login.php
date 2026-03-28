<?php
  include_once 'config/db.php';
  include_once 'config/restrict.php';
  include_once 'config/redis.php';
;?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bejelentkezés</title>
</head>
<body>
    <h1>Bejelentkezés</h1>
    <form method="POST">
        <input type="text" name="username" placeholder='Felhasználónév'>
        <input type="password" name="password" placeholder='Jelszó'>
        <input type="submit" value="Bejelentkezés" name="login_gomb">
    </form>
</body>
</html>

<?php

  if(isset($_POST['login_gomb'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = "SELECT id, password, email FROM users_l WHERE username = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);



    if(mysqli_num_rows($result) == 0) {
      echo "Hibás felhasználónév vagy jelszó!";
      exit;
    }

    $sqlData = mysqli_fetch_all($result);

    $passwordMatch = password_verify($password, $sqlData[0][1]);

    if(!$passwordMatch) {
      echo "Hibás felhasználónév vagy jelszó!";
      exit;
    }


    $_SESSION['valid'] = true;
    $_SESSION['username'] = $username;
    $_SESSION['email'] = $sqlData[0][2];
    $_SESSION['id'] = $sqlData[0][0];

    $redis->rpush('online_users', $username);

    header("Location: dashboard.php");

    mysqli_stmt_close($stmt);
  }
?>