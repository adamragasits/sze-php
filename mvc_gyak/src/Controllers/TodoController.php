<?php
    namespace App\Controllers;

    use App\Models\Todo;
    use App\View;

    class TodoController {
        public function __construct(private Todo $todos){}

        public function show(int $id): void {
            $todo = $this->todos->find($id);
            View::html("todo", ["todo" => $todo]);
        }
    }

?>
