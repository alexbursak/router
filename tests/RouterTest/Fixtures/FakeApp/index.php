<?php
require_once dirname(__FILE__) . './../../../../vendor/autoload.php';

$url = 'fake/alex/qwe123';
$routes = dirname(__FILE__) . '/../../Router/routes.php';

try {
    $router = \ABRouter\Router\Factory\RouterFactory::create($url, $routes);

    // return statement here used only for testing purposes
    // in production '$router->run()' will be enough
    return $router->run();
}catch(\ABRouter\Router\Exception\RouterException $e){
    echo PHP_EOL . $e->getMessage() . PHP_EOL;
}