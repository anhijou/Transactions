<?php

declare(strict_types=1);

namespace Framework;

class Router
{
    private array $routes = [];
    private array $middleware = [];

    public function add(string $method, string $path, array $controller)
    {
        $path = $this->normalizePath($path);
        $this->routes[] = [
            'path' => $path,
            'method' => strtoupper($method),
            'controller' => $controller
        ];
    }
    public function normalizePath(string $path): string
    {
        $path = trim($path, "/");
        $path = "/{$path}/";

        $path = preg_replace("#[/]{2,}#", "/", $path);

        return $path;
    }

    public function dispatch(string $path, string $method, Container $container = null)
    {
        $path = $this->normalizePath($path);
        $method = strtoupper($method);

        foreach ($this->routes as $route) {
            if (!preg_match("#^{$route['path']}$#", $path) || $route['method'] !== $method) {
                continue;
            }

            [$class, $function] = $route['controller'];

            $ControllerInstence = $container ?
                $container->resolve($class) :
                new $class;
            $action = fn () => $ControllerInstence->{$function}();

            foreach ($this->middleware as $middleware) {
                $middlewareInsence = $container ? $container->resolve($middleware) : new $middleware;
                $action = fn () => $middlewareInsence->process($action);
            }

            $action();
            return;
        }
    }
    public function addMiddleware(string $middleware)
    {
        $this->middleware[] = $middleware;
    }
}
