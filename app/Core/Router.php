<?php

namespace App\Core;

class Router
{
  private array $routes = [];

  public function get(string $path, $action)
  {
    $this->routes['GET'][$path] = $action;
  }

  public function post(string $path, $action)
  {
    $this->routes['POST'][$path] = $action;
  }

  // Match current request to registered route and execute
  public function dispatch()
  {
    $method = $_SERVER['REQUEST_METHOD'];
    $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

    $uri = rtrim($uri, '/');
    if (empty($uri)) {
      $uri = '/';
    }

    // Execute matching route or show 404
    foreach ($this->routes[$method] as $route => $action) {
      $pattern = preg_replace('/\{[a-zA-Z]+\}/', '([^/]+)', $route);
      $pattern = '#^' . $pattern . '$#';

      if (preg_match($pattern, $uri, $matches)) {
        array_shift($matches);

        if (is_callable($action)) {
          $action(...$matches);
        } elseif (is_array($action)) {
          [$controllerClass, $methodName] = $action;
          $controller = new $controllerClass();
          $controller->$methodName(...$matches);
        }
        return;
      }
    }
    // Route not found - show 404 page
    http_response_code(404);
    require_once '../app/Views/errors/404.php';
  }
}
