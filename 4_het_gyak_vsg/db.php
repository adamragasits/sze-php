<?php
$servername = "adamragasits.hu";
$port = 43306;
$username = "HPKR9W";
$password = "HPKR9W";
$dbname = "HPKR9W";

// kapcsolódás
$conn = mysqli_connect($servername, $username, $password, $dbname, $port);

// checkoljuk létrejött-e a kapcsolat
if (!$conn) {
    die("Sikertelen kapcsolódás: " . mysqli_connect_error());
}

// karakterkódolás
mysqli_set_charset($conn, "utf8mb4");

// echo "Sikeres kapcsolat!";
?>