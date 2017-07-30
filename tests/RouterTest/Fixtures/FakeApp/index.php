<?php
require_once dirname(__FILE__) . './../../../../vendor/autoload.php';

$url = 'fake/alex/qwe123';
$routes = dirname(__FILE__) . '/../../Router/routes.php';
$projectName = 'ABRouterTest\RouterTest\Fixtures\FakeApp';


$router = \ABRouter\Router\Factory\RouterFactory::create($url, $routes, $projectName);
// return statement here used only for testing purposes
// in production '$router->run()' will be enough
return $router->run();