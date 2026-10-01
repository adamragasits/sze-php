<?php
    session_start();
    include_once('db.php');
    include_once('User.php');

    if(isset($_POST["submit"])){
        $username = $_POST["username"];
        $password = $_POST["password"];

        if(empty($username) || empty($password)){
            echo "Töltsön ki minden mezőt!";
        }
        else {

            $stmt = mysqli_prepare($conn, "SELECT * FROM users WHERE username=?");
            mysqli_stmt_bind_param($stmt, "s", $username);
            mysqli_stmt_execute($stmt);

            $result = mysqli_stmt_get_result($stmt);

            $results = mysqli_fetch_all($result);

            if(count($results) == 1){

                $hashed_pass = $results[0][5];

                if(password_verify($password, $hashed_pass)){
                    $user = new User(
                        $results[0][1],
                        $results[0][2],
                        $results[0][3],
                        $results[0][0]
                    );

                    session_regenerate_id(true);
                    $_SESSION["user"] = $user;

                    header("Location: home.php");
                }
                else{
                    echo "Hibás felhasználónév / jelszó!";
                }

            }
            else {
                echo "Hibás felhasználónév / jelszó!";
            }

        }
    }
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="index.css">
    <title>Bejelentkezés</title>
</head>
<body>
    <h1>Bejelentkezés</h1>
    <form method="POST">
        <input name="username" type="text" placeholder="Felhasználónév..."></input>
        <input name="password" type="password" placeholder="Jelszó..."></input>
        <input name="submit" type="submit" value="Bejelentkezés"></input>
    </form>
</body>
</html>
