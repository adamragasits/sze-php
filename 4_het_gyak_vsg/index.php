<?php
  session_start();
  ob_start();

  if(isset($_SESSION["valid"])) {
    header("Location: dashboard");
  } else {
    header("Location: login");
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
  
</body>
</html>