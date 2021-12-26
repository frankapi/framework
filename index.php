<?php

use Frankapi\Http\Request;

echo "Hello Mundo!";

include_once(dirname(__FILE__). '/vendor/autoload.php');


$router = new \Frankapi\Router\Router();

$router->register('GET', '/hello-world/{id}', fn(int $id) => "olá Mundo!");

$router->get('/users/{id}', function (int $id) {
    return $id;
});

$router->post('/users', function () {
    return $id;
});

$router->put('/users/{id}', function (int $id) {
    return $id;
});

$router->delete('/users/{id}', function (int $id) {
    return $id;
});

$router->patch('/users/{id}', function (int $id) {
    return $id;
});

$router->get('/users', \Frankapi\UsersController::class . '@index' );

$router->get('/users', [
    \Frankapi\UsersController::class,
    'index'
])->name('Get Users');

$route = new \Frankapi\Router\Route(
    method: 'POST',
    path: '/users',
    action: [
        function() {
            return ["hello" => "Mundo!"];
        }
    ]);

//var_dump($route);

//var_dump($router->routes);


function make_regex_uri($uri)
{
    $reg_escape = '[.\\+*?[^\\]${}=!|]';
    $expression = preg_replace('#'.$reg_escape.'#', '\\\\$0', $uri);
    return '#^'.$expression.'$#uD';
}

var_dump(make_regex_uri('/users/[0-9]/assign-role'));
//^(?i)/users/[A-Za-z0-9_-]*/hello
var_dump(
    preg_match(
        '/^\/users\/([A-Za-z0-9_-]*)\/assign\/([A-Za-z0-9_-]*)$/',
    '/users/this-is-the-slug/assign/3432432',
        $hello
    )
);

var_dump(
    $pattern = preg_replace(
        pattern: '/{+(.*?)}/',
        replacement: '([A-Za-z0-9_-]*)',
        subject: '/users/{slug}/assign/{id}'
    )
);

$pattern = '/^' .  str_replace(search: '/', replace: '\/', subject:  $pattern) . '$/';

var_dump(
    preg_match(
        $pattern,
        '/users/this-is-the-slug/assign/3432432',
        $hello
    )
);

var_dump($pattern);

var_dump(
    preg_match_all(
        '/{+(.*?)}/',
        '/users/{user}/hello/{task}/goodsf',
        $hello2
    )
);
var_dump($hello2);
var_dump($hello);

echo "<code>";
    var_dump($_SERVER);
echo "</code>";

$version = explode('/', $_SERVER["SERVER_PROTOCOL"])[1];
$uri = explode('?', $_SERVER["REQUEST_URI"])[0];


function normalizeHeader(string $header): string
{
    $header = str_replace(
            search: "HTTP_",
            replace: "",
            subject: $header
    );

    $header = str_replace(
        search: "_",
        replace: "-",
        subject: $header
    );



    return strtolower($header);
}

function getHeaders(): array
{
    $unNormalizedHeaders =  array_filter($_SERVER, function($key){
            return str_contains(haystack:$key, needle:'HTTP');      
        }, ARRAY_FILTER_USE_KEY);


    $normalizedHeaders = [];

    foreach($unNormalizedHeaders as $key => $value) {
        if (str_contains(haystack:$key, needle:'HTTP')) {
            $normalizedHeaders[normalizeHeader($key)] = $value;
        }
    }

    ksort($normalizedHeaders);

    return $normalizedHeaders;
}


$resquest = new Request(
    method: $_SERVER["REQUEST_METHOD"],
    uri: $uri,
    version: $version,
    headers: getHeaders()
);

var_dump($resquest);

echo "<br />";

$uri = isset($_SERVER['HTTPS']) ? 'https://' : 'http://';

$uri = $uri . $_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"];

var_dump($uri);;

$uri = new \Frankapi\Http\Uri($uri);

var_dump($uri);

var_dump($uri->getAuthority());

var_dump($uri->getPort());

var_dump($uri->getScheme());
