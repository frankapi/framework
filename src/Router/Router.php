<?php

namespace Frankapi\Router;

class Router implements RouterInterface
{

    public array $routes = [];

    public array $objectRouters = [];

    public function __construct()
    {

    }


    /**
     * Register a route on the routes array
     *
     * @param string $method
     * @param string $path
     * @param array|callable|string $action
     * @return void
     */
    public function register(string $method, string $path, callable|array|string $action): Route
    {
        if (!array_key_exists(key: strtoupper($method), array: $this->routes)) {
            $this->routes = array_merge($this->routes, [strtoupper($method) => []]);
        }

        $this->routes[strtoupper($method)][$path] = $route = new Route($method, $path, [$action]);
        return $route;

    }

    public function get(string $path, callable|array|string $action): Route
    {
        return $this->register('GET', $path, $action);
    }

    public function post(string $path, callable|array|string $action): void
    {
        $this->register('POST', $path, $action);
    }

    public function put(string $path, callable|array|string $action): void
    {
        $this->register('PUT', $path, $action);
    }

    public function patch(string $path, callable|array|string $action): void
    {
        $this->register('PATCH', $path, $action);
    }

    public function delete(string $path, callable|array|string $action): void
    {
        $this->register('DELETE', $path, $action);
    }

    /**
     * @throws \Exception
     */
    public function matchRoute(string $method, string $path): Route
    {
        $routes = $this->routes[strtoupper($method)];

        foreach ($routes as $routePath => $route ) {
            $pattern = preg_replace(
                pattern: '/{+(.*?)}/i',
                replacement: '([A-Za-z0-9_-]*)',
                subject: $routePath
            );
            $pattern = '/^' .  str_replace(search: '/', replace: '\/', subject:  $pattern) . '$/';

            if (preg_match($pattern, $path, $path)) {
                preg_match_all(
                    pattern: '/{+(.*?)}/i',
                    subject: $routePath,
                    matches: $paramKeys
                );

                $parameters = [];

                foreach ($paramKeys[1] as $key => $value) {
                    $parameters[$value] = $path[$key +1];
                }

                return $this->routes[strtoupper($method)][$routePath];

            }

            throw new \Exception('Route Not Found');


        }


        return '';

    }
}