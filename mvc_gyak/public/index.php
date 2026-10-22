<?php
    require __DIR__ . "/../vendor/autoload.php";

    use App\Models\Todo;
    use App\Controllers\TodoController;
    use App\Router;
    use App\Request;

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
    $router->post("/test", [$todoController, "create"]);

    $router->dispatch(Request::capture());
?>
