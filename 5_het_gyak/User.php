<?php
    class User {
        public string $username;
        public string $fullname;
        public string $email;
        public string $id;

        public function __construct(string $_username, string $_fullname, string $_email, string $_id)
        {
            $this->username = $_username;
            $this->fullname = $_fullname;
            $this->email = $_email;
            $this->id = $_id;
        }
    }
?>
