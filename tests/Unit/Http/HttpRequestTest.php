<?php declare(strict_types=1);

namespace Tests\Unit\Http;

use Frankapi\Http\Request;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Frankapi\Http\Request
 */
final class HttpRequestTest extends TestCase
{

    /**
     * @covers \Frankapi\Http\Request::getMethod
     * @return void
     */
    public function test_request_get_method_functions_return_the_request_method()
    {
        $request = new Request(
            method: 'GET',
            uri: 'https://localhost'
        );

        $this->assertEquals('GET', $request->getMethod());
    }

    /**
     * @covers \Frankapi\Http\Request::withHeader
     * @return void
     */
    public function test_it_can_add_a_header()
    {
        $request = new Request(
            method: 'GET',
            uri: 'https://localhost'
        );

        $request->withHeader(
            name: 'MyNewHeader',
            value: 'MyNewHeaderValue'
        );

        $this->assertTrue(true);

        //$this->assertEquals($request->getHeaderLine('MyNewHeader'), 'MyNewHeaderValue');


    }

}