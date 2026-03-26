<?php
  include_once __DIR__ . "/../config/db.php";

  if(isset($_POST["register"])) {
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $password_confirm = $_POST["password_confirm"];

    $errors = [];

    if(empty($username) || empty($email) || empty($password) || empty($password_confirm)) {
      $errors[] = "Minden mező kitöltése kötelező!";
    }
    if(strlen($username) < 8) {
      $errors[] = "A felhasználónév minimum 8 karakter hosszú kell, hogy legyen.";
    }
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $errors[] = "E-mail cím formátuma nem megfelelő";
    }
    if($password !== $password_confirm) {
        $errors[] = "A megadott jelszavak nem egyeznek";
    }

    if(!empty($errors)) {
      foreach($errors as $error) {
        echo $error;
        echo "<br>";
      }
    } else {
      $hashedData = hash_hmac('sha256', $password, 'titkos');

      $sql = "INSERT INTO users(email, username, password) VALUES(?,?,?)";
      $stmt = mysqli_prepare($conn, $sql);
      mysqli_stmt_bind_param($stmt, "sss", $email, $username, $hashedData);
      mysqli_stmt_execute($stmt);
      mysqli_stmt_close($stmt);
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
  <h1>Regisztráció</h1>
    <form method="POST">
        <input type="text" name="email" placeholder="Email cím">
        <input type="text" name="username" placeholder="Felhasználónév">
        <input type="password" name="password" placeholder="Jelszó">
        <input type="password" name="password_confirm" placeholder="Jelszó megerősítés">
        <input type="submit" value="Regisztráció" name="register">
    </form>
</body>
</html>