<?php

require_once 'vendor/autoload.php';
session_start();

$env = Dotenv\Dotenv::createImmutable(__DIR__);
$env->load();

$dispatcher = FastRoute\simpleDispatcher(function (FastRoute\RouteCollector $r) {
    $r->addRoute('GET', '/', 'App\Controllers\NewsController@show');
    $r->addRoute('GET', '/news', 'App\Controllers\NewsController@show');
    $r->addRoute('GET', '/create', 'App\Controllers\NewsController@create');
    $r->addRoute('GET', '/forecast', 'App\Controllers\ForecastController@show');
    $r->addRoute('POST', '/forecast', 'App\Controllers\ForecastController@city');

});

$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];

if (false !== $pos = strpos($uri, '?')) {
    $uri = substr($uri, 0, $pos);
}
$uri = rawurldecode($uri);

$routeInfo = $dispatcher->dispatch($httpMethod, $uri);
switch ($routeInfo[0]) {
    case FastRoute\Dispatcher::NOT_FOUND:
        echo "Page not found";
        break;
    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        $allowedMethods = $routeInfo[1];
        echo "Method not allowed";
        break;
    case FastRoute\Dispatcher::FOUND:
        $handler = $routeInfo[1];
        $vars = $routeInfo[2];

        [$controller, $method] = explode("@", $handler);

        $container = new DI\Container();
        $container->set(\App\Repositories\NewsRepository::class, \DI\create(\App\Repositories\NewsAPIRepository::class));
        $container->set(\App\Repositories\ForecastRepository::class, \DI\create(\App\Repositories\ForecastAPIRepository::class));

        $response = ($container->get($controller)->$method());

        $loader = new \Twig\Loader\FilesystemLoader('app/Views');
        $twig = new \Twig\Environment($loader);



        if ($response instanceof \App\View) {
            $template = $twig->load($response->getPathToTemplate());
            echo $template->render($response->getData());
            exit;
        }

        break;
}