<?php

    namespace App\Controllers;

    use App\Models\Todo;
    use App\Request;
use App\View;

    class TodoController {
        public function __construct(private Todo $todos){}

        public function show(int $id): void {
            $todo = $this->todos->find($id);
            View::html("todo", ["todo" => $todo]);
        }

        public function create(Request $request) {
            echo $request->body();
        }
    }

?>
