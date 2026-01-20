<?php

namespace Youcode\WorkshopMvc\Core;

class Router
{
  protected $routes = [];
  protected string $currentURI;
  protected string $currentMethod;

  public function __construct() {
    $this->currentURI = str_replace("/Talent-HUB","",rtrim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), "/"));
    $this->currentMethod = $_SERVER['REQUEST_METHOD'] ?? 'GET';
  }
  public function addRouter(string $method, string $path, $action): void
  {
    $method = strtoupper($method);
    $this->routes[$method][$path] = $action;
  }
  public function dispatch(): void
  {
    if($this->currentURI === "")$this->currentURI = "/";
    if (isset($this->routes[$this->currentMethod][$this->currentURI])) {
      $action = $this->routes[$this->currentMethod][$this->currentURI];
      $this->execute($action);
      return;
    }
    $this->notFound();
  }
  protected function execute($action): void
  {
    if (is_array($action)) {
      [$controller, $method] = $action;
      if (!class_exists($controller)) {
        throw new \Exception("[!] Class Not Found.\n$controller");
      }
      $instance = new $controller;
      if (!method_exists($instance, $method)) {
        throw new \Exception("[!] Method Not Found.\n$method");
      }
      $instance->$method();
      return;
    }
    if (is_callable($action)) {
      $action();
      return;
    }
    throw new \Exception("[!] Invalid action $action");
  }
  protected function notFound(): void
  {
    http_response_code(404);
    echo "404 Page Not Found.";
  }
}
