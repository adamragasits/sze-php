<?php
    namespace App;

    class View {
        public static function html(string $template, array $data = []): void {
            extract($data);
            require __DIR__ . "/../views/$template.php";
        }
    }
?>
