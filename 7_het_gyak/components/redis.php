<?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    require __DIR__ . '/../vendor/autoload.php';

    $redis = new Predis\Client([
        'scheme'   => 'tcp',
        'host'     => 'adamragasits.hu',
        'port'     => 39234,
        'timeout'  => 5.0,
    ],['prefix'   => 'HPKR9W:']);

    $redis->connect();
?>