<?php declare(strict_types=1);

namespace Tests\Unit\Http;

use Tests\BaseTestCase;
use Frankapi\Http\Uri;

/**
 * @covers \Frankapi\Http\Uri
 */
final class HttpUriTest extends BaseTestCase
{

    /**
     * @covers \Frankapi\Http\Uri::hasScheme
     * @throws \ReflectionException
     */
    public function test_check_if_uri_has_scheme_returns_true_when_uri_has_http_scheme()
    {
        $uriValue = 'http//barrento.pt/controller/action';
        $uri = new Uri(uri: $uriValue);

        $this->assertTrue((bool)$this->invokeMethod(
            class: $uri,
            methodName: 'hasScheme',
            parameters: ['uri' => $uriValue]
        ));
    }

    /**
     * @covers \Frankapi\Http\Uri::hasScheme
     * @throws \ReflectionException
     */
    public function test_check_if_uri_has_scheme_returns_false_when_uri_has_no_scheme()
    {
        $uriValue = 'barrento.pt/controller/action';
        $uri = new Uri(uri: $uriValue);

        $this->assertFalse((bool)$this->invokeMethod(
            class: $uri,
            methodName: 'hasScheme',
            parameters: ['uri' => $uriValue]
        ));
    }

    /**
     * @covers \Frankapi\Http\Uri::normalizeUri
     * @return void
     * @throws \ReflectionException
     */
    public function test_normalize_uri_adds_two_slashes_to_uri_with_no_scheme()
    {
        $uriValue = 'barrento.pt/controller/action';
        $uri = new Uri(uri: $uriValue);

        $normalizedUriWithNoScheme = (string) $this->invokeMethod(
            class: $uri,
            methodName: 'normalizeUri',
            parameters: ['uri' => $uriValue]
        );

        $this->assertTrue(str_starts_with(haystack: $normalizedUriWithNoScheme, needle: '//' ));

    }

    /**
     * @covers \Frankapi\Http\Uri::getScheme
     * @return void
     */
    public function test_get_schema_with_a_uri_with_no_scheme_returns_a_empty_string()
    {
        $uri = new Uri('barrento.pt/controller/action');

        $this->assertEquals(
            expected: '',
            actual: $uri->getScheme()
        );

        $this->assertEquals(
            expected: 0,
            actual: strlen($uri->getScheme())
        );
    }

    /**
     * @covers \Frankapi\Http\Uri::getScheme
     * @return void
     */
    public function test_get_scheme_returns_the_URI_scheme()
    {
        $uri = new Uri('http://www.francisco.barrento.pt');

        $this->assertEquals(
            expected: 'http',
            actual: $uri->getScheme()
        );
    }

    /**
     * @covers \Frankapi\Http\Uri::getPort
     * @return void
     */
    public function test_get_port_returns_null_when_scheme_is_http_and_port_is_80()
    {
        $uri = new Uri(uri:
            'http://barrento.pt:80/controller/action'
        );

        $this->assertNull(
            actual: $uri->getPort()
        );
    }

    /**
     * @covers \Frankapi\Http\Uri::getPort
     * @return void
     */
    public function test_get_port_return_null_if_no_port_is_set_on_the_given_uri()
    {
        $uri = new Uri(uri:
            'http://barrento.pt/controller/action'
        );

        $this->assertNull(
            actual: $uri->getPort()
        );
    }

    /**
     * @covers \Frankapi\Http\Uri::getPort
     * @return void
     */
    public function test_get_port_returns_the_port_number_when_port_is_different_from_the_default_scheme_port()
    {
        $uri = new Uri(uri:
            'http://barrento.pt:8080/controller/action'
        );

        $this->assertEquals(
            expected: 8080,
            actual: $uri->getPort()
        );
    }


    /**
     * @covers \Frankapi\Http\Uri::getAuthority
     * @return void
     */
    public function test_get_authority_returns_the_uri_authority()
    {
        $uri = new Uri(uri:
            'https://fbarrento:password123@barrento.pt:8080/controller/action'
        );

        $this->assertEquals(
            expected: 'fbarrento:password123@barrento.pt:8080',
            actual: $uri->getAuthority()
        );
    }






}