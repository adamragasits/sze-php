<?php
namespace App;

class Request
{
    public function __construct(
        private string $method,
        private string $path,
        private string $body
    ) {}

    public static function capture(): self
    {
        return new self(
            $_SERVER['REQUEST_METHOD'],
            parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH),
            file_get_contents('php://input')
        );
    }

    public function method(): string { return $this->method; }
    public function path(): string   { return $this->path; }
    public function body(): string   { return $this->body; }
}
