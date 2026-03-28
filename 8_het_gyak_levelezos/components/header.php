<?php
    include_once __DIR__ . '/../config/db.php';
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="components/header.css">
</head>
<script>
    function logoutHandler(){
        fetch("api/logout.php", {
            method: "POST"
        })
        .then(r => window.location.href = "login.php")
    };
</script>
<body>
    <div class='headerContainer'>
        <div class='welcomeText'>
            <?php
                $username = $_SESSION['username'];
                echo "Szia, $username";
            ?>
        </div>
        <a href="/online_users.php">Online felhasználók</a>
        <a href="/dashboard.php">Főoldal</a>
        <div class='logoutContainer'>
            <button class='logoutBtn' onClick="logoutHandler();">Kijelentkezés</button>
        </div>
    </div>
</body>
</html>