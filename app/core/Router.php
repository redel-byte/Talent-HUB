<?php

namespace App\Core;

class Router
{
    private array $routes = [];
    private array $params = [];

    public function addRouter(string $method, string $path, $handler): void
    {
        $this->routes[] = [
            'method' => strtoupper($method),
            'path' => $path,
            'handler' => $handler
        ];
    }

    public function dispatch(): void
    {
        $uri = str_replace("/Talent-HUB", "", rtrim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), "/"));
        $method = $_SERVER['REQUEST_METHOD'] ?? 'GET';
        
        if ($uri === "") $uri = "/";

        foreach ($this->routes as $route) {
            if ($route['method'] === $method && $route['path'] === $uri) {
                $this->executeHandler($route['handler']);
                return;
            }
        }

        // Handle 404
        http_response_code(404);
        require_once __DIR__ . '/../views/errors/404.php';
    }

    private function executeHandler($handler): void
    {
        if (is_callable($handler)) {
            call_user_func($handler);
            return;
        }

        if (is_array($handler) && count($handler) === 2) {
            [$controller, $method] = $handler;
            
            if (class_exists($controller)) {
                $controllerInstance = new $controller();
                
                if (method_exists($controllerInstance, $method)) {
                    $controllerInstance->$method();
                    return;
                }
            }
        }

        // Handle 500 if handler fails
        http_response_code(500);
        echo "Internal Server Error: Handler not found";
    }
}
