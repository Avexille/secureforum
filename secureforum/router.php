<?php

$uri = parse_url($_SERVER['REQUEST_URI'])['path'];

$routes = [
    '/' => 'controllers/home.php',
    '/login' => 'controllers/login.php',
    '/logout' => 'controllers/logout.php',
    '/thread' => 'controllers/thread.php',
    '/home' => 'controllers/home.php',
    '/dashboard' => 'controllers/dashboard.php'
];

function routeToController($uri, $routes)
{
    if (array_key_exists($uri, $routes)) {
        require $routes[$uri];
    } else {
        abort();
    }
}

function abort($code = 404)
{
    http_response_code($code);

    require "views/{$code}.php";

    die();
}

routeToController($uri, $routes);
