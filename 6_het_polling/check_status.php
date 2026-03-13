<?php
header('Content-Type: application/json');

$conn = mysqli_connect("adamragasits.hu", "HPKR9W", "HPKR9W", "HPKR9W", 43306);
mysqli_set_charset($conn, "utf8mb4");

$sql = "SELECT value FROM valueset WHERE title='darabszam' LIMIT 1";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

echo json_encode([
    "szam" => $row['value'],
    "ido" => date('H:i:s')
]);

mysqli_close($conn);
?>