<?php
  include_once __DIR__ . '/../restrict.php';
  include_once __DIR__ . '/../db.php';

  if(isset($_POST['submit'])) {
    $fullname = $_POST['fullname'];
    $birthdate = $_POST['birthdate'];
    $idNumber = $_POST['idNumber'];

    if(empty($fullname) || empty($birthdate) || empty($idNumber)) {
      echo "Minden mező kitöltése kötelező!";
      exit;
    }

    $sql = mysqli_prepare($conn, "SELECT * FROM applicants WHERE idNumber=? OR fullname=?");
    mysqli_stmt_bind_param($sql, "ss", $idNumber, $fullname);
    mysqli_stmt_execute($sql);
    $result = mysqli_stmt_get_result($sql);

    if($result->num_rows > 0) {
      echo "Ez a személy már regisztrált!";
      header("Location: .");
      exit;
    }

    $sql = mysqli_prepare($conn, "INSERT INTO applicants (fullname, birthdate, idNumber) VALUES (?, ?, ?)");
    mysqli_stmt_bind_param($sql, "ss", $fullname, $birthdate, $idNumber);
    if(mysqli_stmt_execute($sql)) {
      echo "Sikeres jelentkezés!";
      header("Location: ../dashboard/");
    }
    else {
      echo "Hiba történt!";
    }
  }

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  <h1>Személyregisztráció</h1>
    <form method="POST">
      <input type="text" name="fullname" placeholder="Teljes név"></input>
      <input type="date" name="birthdate" placeholder="Születési dátum"></input>
      <input type="text" name="idNumber" placeholder="Személyi szám"></input>
      <input type="submit" name="submit" value="Küldés"></input>
    </form>
</body>
</html>