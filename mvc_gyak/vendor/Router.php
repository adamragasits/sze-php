<?php
class Router
{
    private array $routes = [];

    public function get(string $p, callable $h): void    { $this->add('GET', $p, $h); }
    public function post(string $p, callable $h): void   { $this->add('POST', $p, $h); }
    public function put(string $p, callable $h): void    { $this->add('PUT', $p, $h); }
    public function delete(string $p, callable $h): void { $this->add('DELETE', $p, $h); }

    public function add(string $method, string $pattern, callable $handler): void
    {
        $regex = preg_replace('#\{\w+\}#', '(\d+)', $pattern);
        $this->routes[] = [$method, '#^' . $regex . '$#', $handler];
    }

    public function dispatch(string $method, string $path): void
    {
        $allowed = [];
        foreach ($this->routes as [$routeMethod, $regex, $handler]) {
            if (!preg_match($regex, $path, $params)) {
                continue;
            }

            if ($routeMethod !== $method) {
                $allowed[] = $routeMethod;
                continue;
            }

            $handler(...array_map('intval', array_slice($params, 1)));
            return;
        }
    }
}
