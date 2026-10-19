<?php
    require __DIR__ . "/../vendor/autoload.php";

    use App\Models\Todo;

    $db = new mysqli(
        database: "AVR4GF",
        password: "AVR4GF",
        username: "AVR4GF",

        hostname: "89.116.229.207",
        port: 37200
    );
    $db->set_charset("utf8mb4");

    $todoModel = new Todo($db);
    print_r($todoModel->find(1));
?>
