<?php
    include 'redis.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <span id="welcome_user">
        Üdv,
        <?php echo $user->username; ?>
    </span>
    <span id="online_user_count">
        Online felhasználók száma:
        <?php echo $redis->llen("online_users"); ?>
    </span>
    <button id="logout">Kijelentkezés</button>
</body>
<script>
    document.getElementById("logout").addEventListener("click", function(){
        fetch("api/logout.php", {
            method: "POST"
        })
        .then(r => window.location.href = "login.php")
    })
</script>
</html>