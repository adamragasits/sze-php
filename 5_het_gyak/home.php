<?php
    include_once("User.php");
    include_once("redis.php");
    session_start();

    if(isset($_POST["submit"])) {
        $username = $_SESSION["user"]->username;

        $redis->rpush("varolista", $username);
    }
?>

<html>
    <head>
        <meta http-equiv="refresh" content="5">
    </head>

    <h1>Üdv, <?php echo $_SESSION["user"]->fullname; ?>!</h1>

    <p>Várólista: <?php echo $redis->llen("varolista"); ?> fő</p>

    <?php
        $items = $redis->lrange('varolista', 0, -1);

        foreach($items as $index => $item) {
            echo $item;
        }
    ?>

    <form method="POST">
        <button type="submit" name="submit">Várólistára jelentkezés</button>
    </form>
</html>
