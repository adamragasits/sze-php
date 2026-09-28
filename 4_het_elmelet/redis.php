<?php
require 'vendor/autoload.php';

$redis = new Predis\Client([
    'scheme' => 'tcp',
    'host' => '89.116.229.207',
    'port' => 37201,
    'timeout' => 5.0,
    ], ['prefix' => 'sze:']);
try {
    $redis->connect();
} catch (Exception $e) {
     echo "Redis kapcsolódási hiba: " . $e->getMessage();
}
?>
