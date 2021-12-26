<?php declare(strict_types=1);

namespace Frankapi\Http;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\StreamInterface;
use Psr\Http\Message\UriInterface;

class Request implements RequestInterface
{
    use MessageTrait;
    use RequestTrait;

    public function __construct(
        public string $method,
        public string|UriInterface $uri,
        public array $headers = [],
        public string|StreamInterface|null $body = null,
        public string $version = '1.1'
    )
    {
    }


}