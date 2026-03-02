<?php
    session_start();
    ob_start();

    include_once 'db.php';
    include_once 'kulcsok.php';

    if(isset($_POST['userinfoSubmit'])) {
        $username = $_POST['username'];
        $password = $_POST['pass'];

        $hashedPassword = hash_hmac('sha256', $password, $key);

        $stmt = mysqli_prepare($conn, "SELECT * FROM users WHERE username=?");
        mysqli_stmt_bind_param($stmt, "s", $username);
        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);
        $userinfo = mysqli_fetch_all($result);

        mysqli_stmt_close($stmt);

        // print_r($userinfo);
        // echo count($userinfo);

        if(count($userinfo) >= 1) {
            if($hashedPassword == $userinfo[0][2]) {
                echo 'Sikeres belépés!';
                $_SESSION["username"] = $username;
                $_SESSION["fullname"] = $userinfo[0][3];
                $_SESSION["booleanteszt"] = true;
                $_SESSION["tomb"] = ['egy', 'ketto', 'harom'];
            }
            else {
                echo 'Hibás felhasználónév / jelszó.';
            }
        }
        else {
            echo 'Hibás felhasználónév / jelszó.';
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VSG Projekt</title>
</head>
<body>
    <h1>VSG Bejelentkezés</h1>
    <form method='POST'>
        <input type='text' name='username' placeholder='Felhasználónév'></input>
        <input type='password' name='pass' placeholder='Jelszó'></input>
        <input type='submit' name='userinfoSubmit' value='Bejelentkezés'></input>
    </form>
</body>
</html>