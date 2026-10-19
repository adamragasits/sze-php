<?php
    require __DIR__ . "/../vendor/autoload.php";

    use App\Models\Todo;
    use App\Controllers\TodoController;
    use App\Router;

    $db = new mysqli(
        database: "AVR4GF",
        password: "AVR4GF",
        username: "AVR4GF",

        hostname: "89.116.229.207",
        port: 37200
    );
    $db->set_charset("utf8mb4");

    $router = new Router();
    $todoController = new TodoController(new Todo($db));

    $router->get("/todos/{id}", [$todoController, "show"]);

    $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $router->dispatch($_SERVER['REQUEST_METHOD'], $path);
?>
