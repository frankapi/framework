<?php

namespace Tests;

use PHPUnit\Framework\TestCase;

abstract class BaseTestCase extends TestCase
{

    /**
     * @param object $class
     * @param string $methodName
     * @param array $parameters
     * @return void|bool
     * @throws \ReflectionException
     */
    public function invokeMethod(object &$class, string $methodName, array $parameters = [])
    {
        $reflectionClass = new \ReflectionClass($class);
        if ($reflectionClass->hasMethod($methodName)) {
            $method = $reflectionClass->getMethod($methodName);
            return $method->invokeArgs($class, $parameters);
        }

        throw new \BadMethodCallException();


    }

}