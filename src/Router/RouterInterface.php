<?php

namespace Frankapi\Router;

interface RouterInterface
{

    /**
     * Register a route on the routes array
     *
     * @param string $method
     * @param string $path
     * @param string|array|callable $action
     * @return Route
     */
    public function register(string $method, string $path, string|array|callable $action): Route;

    public function get(string $path, string|array|callable $action): Route;

    public function post(string $path, string|array|callable $action): void;

    public function put(string $path, string|array|callable $action): void;

    public function patch(string $path, string|array|callable $action): void;

    public function delete(string $path, string|array|callable $action): void;


}