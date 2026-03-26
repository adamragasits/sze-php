<?php
  require '../vendor/autoload.php';

  $redis = new Predis\Client([
    'scheme' => 'tcp',
    'host' => 'adamragasits.hu',
    'port' => 39234,
    'timeout' => 5.0,
  ], [
    'prefix' => "RAGASITS:"
  ]);

  try {
    $redis->connect();
  } catch (Exception $e) {
    die("Nem sikerült csatlakozni a Redis szerverhez: " . $e->getMessage());
  }
?>