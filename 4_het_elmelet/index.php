<?php
    include_once 'redis.php';

    $redis->setex("TesztKulcs", 30, "Ragasits Ádám");
    $redis->set("TesztKulcs2", "Ragasits Ádám");

    echo $redis->ttl("TesztKulcs");
    echo "<br/>";
    echo $redis->ttl("TesztKulcs2");
    echo "<br/>";
    echo $redis->ttl("TesztKulcs3");

    $redis->expire("TesztKulcs", 600);

    echo "<br/>";
    echo $redis->ttl("TesztKulcs");
?>
