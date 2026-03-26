<?php
  class User {
    public int $id;
    public string $email;
    public string $username;

    public function __construct(int $id, string $email, string $username) {
      $this->id = $id;
      $this->email = $email;
      $this->username = $username;
    }
  }
?>