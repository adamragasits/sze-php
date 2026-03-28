<?php 
  require_once __DIR__ . '/../vendor/autoload.php';

  $redis = new Predis\Client([
    'scheme' => 'tcp',
    'host' => 'adamragasits.hu',
    'port' => 39234,
    'timeout' => 5.0
   ], [
    'prefix' => 'RAGASITS:'
   ]);

   $redis->connect();
?>