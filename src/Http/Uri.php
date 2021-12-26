<?php declare(strict_types=1);

namespace Frankapi\Http;

use JetBrains\PhpStorm\Pure;
use Psr\Http\Message\UriInterface;

class Uri implements UriInterface
{
    private const SCHEME_PORTS = [
        'http' => 80,
        'https' => 443
    ];

    private string $scheme;
    private string $host;
    private ?int $port;
    private string $user;
    private string $pass;
    private string $path;


    public function __construct(string $uri)
    {
        $uriParts = parse_url(
            $this->normalizeUri($uri)
        );

        $reflectedUri = new \ReflectionClass($this);
        foreach ($reflectedUri->getProperties(\ReflectionProperty::IS_PRIVATE) as $property) {
            $attribute = $property->name;
            if (array_key_exists(key: ($property->name), array: $uriParts)) {
                settype(var:$uriParts["{$attribute}"], type: $property->getType()->getName());
                $this->$attribute = $uriParts["${attribute}"];
            } else  {
               $tempAttributeValue = '';
               settype(var: $tempAttributeValue, type: $property->getType()->getName());
               $this->$attribute = $tempAttributeValue;
            }
        }

        $this->setPort($this->port);
    }


    /**
     * @param int|null $port
     * @return void
     */
    private function setPort(? int $port): void
    {
        if (array_key_exists(key: $this->scheme, array: self::SCHEME_PORTS) and self::SCHEME_PORTS[$this->scheme] === $port) {
            $this->port = null;
            return;
        }
        if (!$port) {
            $this->port = null;
            return;
        }
        $this->port = $port;
    }

    /**
     * Check if the given uri (String) has a scheme
     *
     * @param string $uri
     * @return bool
     */
    private function hasScheme(string $uri): bool
    {
        return str_starts_with(haystack: $uri, needle: 'http');
    }

    /**
     * Checks if the given uri (String) has scheme if not normalizes it
     * by adding two slashes to the beginning of the string if it doesn't have them.
     *
     * @param string $uri
     * @return string
     */
    #[Pure]
    private function normalizeUri(string $uri): string
    {
        if (!$this->hasScheme($uri)) {
            return str_starts_with(haystack: $uri, needle: '//') ? $uri : '//' . $uri;
        }
        return $uri;
    }

    /**
     * @return string
     */
    public function getScheme(): string
    {
        return $this->scheme;
    }

    /**
     * @return string
     */
    #[Pure]
    public function getAuthority(): string
    {
        $authority = $this->getHost();

        if ($this->getUserInfo()) {
            $authority = $this->getUserInfo() . '@' . $authority;
        }

        if ($this->getPort()) {
            $authority .= ':' . $this->getPort();
        }
        return $authority;

    }

    /**
     * @return string
     */
    public function getUserInfo(): string
    {
        $userInfo = '';
        if ($this->user) {
            $userInfo .= $this->user;
        }

        if ($this->pass) {
            $userInfo .= ':'.$this->pass;
        }
        return $userInfo;
    }

    /**
     * @return string
     */
    public function getHost(): string
    {
        return $this->host;
    }

    /**
     * @return int|null
     */
    public function getPort(): ?int
    {
        return $this->port;
    }

    /**
     * @return string
     */
    public function getPath(): string
    {
        // TODO: Implement getPath() method.
    }

    /**
     * @return string
     */
    public function getQuery(): string
    {
        // TODO: Implement getQuery() method.
    }

    /**
     * @return string
     */
    public function getFragment(): string
    {
        // TODO: Implement getFragment() method.
    }

    /**
     * @param $scheme
     * @return $this
     */
    public function withScheme($scheme): Uri
    {
        // TODO: Implement withScheme() method.
    }

    /**
     * @param $user
     * @param $password
     * @return $this
     */
    public function withUserInfo($user, $password = null): Uri
    {
        // TODO: Implement withUserInfo() method.
    }

    /**
     * @param $host
     * @return $this
     */
    public function withHost($host): Uri
    {
        // TODO: Implement withHost() method.
    }

    /**
     * @param $port
     * @return $this
     */
    public function withPort($port): Uri
    {
        // TODO: Implement withPort() method.
    }

    /**
     * @param $path
     * @return $this
     */
    public function withPath($path): Uri
    {
        // TODO: Implement withPath() method.
    }

    /**
     * @param $query
     * @return $this
     */
    public function withQuery($query): Uri
    {
        // TODO: Implement withQuery() method.
    }

    /**
     * @param $fragment
     * @return $this
     */
    public function withFragment($fragment): Uri
    {
        // TODO: Implement withFragment() method.
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        // TODO: Implement __toString() method.
    }
}
