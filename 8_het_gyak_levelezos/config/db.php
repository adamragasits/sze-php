<?php
$servername = "adamragasits.hu";
$port = 43306;
$username = "HPKR9W";
$password = "HPKR9W";
$dbname = "HPKR9W";

$conn = mysqli_connect($servername, $username, $password, $dbname, $port);

if (!$conn) {
    die("Sikertelen kapcsolódás: " . mysqli_connect_error());
}

mysqli_set_charset($conn, "utf8mb4");

?>