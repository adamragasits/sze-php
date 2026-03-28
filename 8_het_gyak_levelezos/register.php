<?php
    include_once('config/db.php');
    include_once('config/restrict.php');
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Regisztráció</title>
</head>
<body>
    <h1>Regisztráció</h1>
    <form method='POST'>
        <input type="text" placeholder="Felhasználónév" name='username'>
        <input type="email" placeholder="Email" name='email'>
        <input type="password" placeholder="Jelszó" name='password'>
        <input type="password" placeholder="Jelszó mégegyszer" name='password_again'>
        <input type="submit" value="Regisztráció" name="submit_gomb">
    </form>
</body>
</html>

<?php
    if(isset($_POST['submit_gomb'])) {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $password_confirm = $_POST['password_again'];

        if (empty($username) || empty($email) || empty($password) || empty($password_confirm)) {
            echo 'Összes mező kitöltése kötelező!';
            exit;
        }

        if ($password !== $password_confirm) {
            echo 'A jelszavak nem egyeznek!';
            exit;
        }

        if (strlen($password) < 6) {
            echo 'A jelszó legalább 6 karakter hosszú legyen!';
            exit;
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo 'Nem érvényes email cím!';
            exit;
        }

        $check_query = "SELECT id FROM users_l WHERE username = ? OR email = ?";
        $check_stmt = mysqli_prepare($conn, $check_query);
        mysqli_stmt_bind_param($check_stmt, 'ss', $username, $email);
        mysqli_stmt_execute($check_stmt);
        $result = mysqli_stmt_get_result($check_stmt);

        if (mysqli_num_rows($result) > 0) {
            echo 'Ez a felhasználónév vagy email már foglalt!';
            mysqli_stmt_close($check_stmt);
            exit;
        }
        mysqli_stmt_close($check_stmt);

        $hashed_password = password_hash($password, PASSWORD_DEFAULT);


        $insert_query = "INSERT INTO users_l (username, email, password) VALUES (?, ?, ?)";
        $insert_stmt = mysqli_prepare($conn, $insert_query);
        mysqli_stmt_bind_param($insert_stmt, 'sss', $username, $email, $hashed_password);

        if (mysqli_stmt_execute($insert_stmt)) {
            echo "Sikeres regisztráció! Bejelentkezhetsz.";
        } else {
            echo "Hiba történt az adatbázisban.";
        }

        mysqli_stmt_close($insert_stmt);
    }
?>