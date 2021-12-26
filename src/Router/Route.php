<?php

namespace Frankapi\Router;

class Route
{

    public string $name = '';

    public function __construct(
        public string $method,
        public string $path,
        public string|array $action
    ) {}

    public function name(string $name): void
    {
        $this->name = $name;
    }


}