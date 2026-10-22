<?php
    namespace App\Models;

    use mysqli;

    class Todo {
        public function __construct(private mysqli $db){}

        public function find(int $id): ?array
        {
            $stmt = $this->db->prepare("SELECT * FROM todo WHERE id = ?");
            $stmt->bind_param("i", $id);
            $stmt->execute();
            return $stmt->get_result()->fetch_assoc();
        }

        public function create(string $title): string
        {
            $stmt = $this->db->prepare("INSERT INTO todo(title) VALUES (?)");
            $stmt->bind_param("s", $title);
            $stmt->execute();
            return "Sikeres feltöltés!";
        }
    }
?>
