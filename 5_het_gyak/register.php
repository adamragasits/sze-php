<?php
    include_once('db.php');
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="index.css">
    <title>Regisztráció</title>
</head>
<body>
    <h1>Regisztráció</h1>
    <form method="POST">
        <input name="username" type="text" placeholder="Felhasználónév..."></input>
        <input name="fullname" type="text" placeholder="Teljes név..."></input>
        <input name="email" placeholder="Email cím..."></input>
        <input name="tel" placeholder="Telefonszám..."></input>
        <input name="password" type="password" placeholder="Jelszó..."></input>
        <input name="submit" type="submit" value="Regisztráció"></input>
    </form>
</body>
</html>

<?php
    if(isset($_POST["submit"])){
        $username = $_POST["username"];
        $fullname = $_POST["fullname"];
        $email = $_POST["email"];
        $tel = $_POST["tel"];
        $password = $_POST["password"];

        if(empty($username) || empty($fullname) || empty($email) || empty($tel) || empty($password)){
            echo "Töltsön ki minden mezőt!";
        }
        else {

            if(filter_var($email, FILTER_VALIDATE_EMAIL)){
                try {
                    $hash = password_hash($password, PASSWORD_BCRYPT);

                    $stmt = mysqli_prepare($conn, "INSERT INTO users(username, fullname, email, telephone, password) VALUES (?,?,?,?,?)");
                    mysqli_stmt_bind_param($stmt, "sssss", $username, $fullname, $email, $tel, $hash);
                    mysqli_stmt_execute($stmt);

                    echo "Sikeres regisztráció!";
                }
                catch (Exception $e){
                    echo "Hiba a regisztráció során!";
                }
            }
            else {
                echo "Adjon meg érvényes email címet!";
            }

        }
    }
?>
