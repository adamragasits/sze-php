<?php
    include_once __DIR__ . '/../db.php';
    include_once __DIR__ . '/../kulcsok.php';

    if(isset($_POST['userinfoSubmit'])) {
        try{
            $username = $_POST['username'];
            $password = $_POST['pass'];
            $fullname = $_POST['fullname'];
            $email = $_POST['email'];

            $hashedData = hash_hmac('sha256', $password, $key);
            
            $stmt = mysqli_prepare($conn, "SELECT * FROM users WHERE username=? OR email=?");
            mysqli_stmt_bind_param($stmt, "ss", $username, $email);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            $userinfo = mysqli_fetch_all($result);
            mysqli_stmt_close($stmt);

            if(count($userinfo) >= 1){
                echo "Létezik már ilyen felhasználó! (felhasználónév vagy email foglalt)";
                exit;
            }

            $stmt = mysqli_prepare($conn, "INSERT INTO users(username, password, email, fullname) VALUES (?, ?, ?, ?)");
            mysqli_stmt_bind_param($stmt, "ssss", $username, $hashedData, $fullname, $email);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);

            echo "Sikeres regisztráció!";
            // print_r($userinfo);
            // echo count($userinfo);
        }
        catch (Exception $e){
            echo "Hiba történt a regisztráció során.";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VSG Regisztráció</title>
</head>
<body>
    <h1>VSG Regisztráció</h1>
    <form method='POST'>
        <input type='text' name='username' placeholder='Felhasználónév'></input>
        <input type='password' name='pass' placeholder='Jelszó'></input>
        <input type='text' name='fullname' placeholder='Teljes név'></input>
        <input type='email' name='email' placeholder='Email'></input>
        <input type='submit' name='userinfoSubmit' value='Bejelentkezés'></input>
    </form>
</body>
</html>