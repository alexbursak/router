<?php

namespace ABRouter\Router\Factory;


use ABRouter\Router\Router;
use ABRouter\Router\Routes;
use ABRouter\Router\RoutesParser;

/**
 * Class RouterFactory
 */
class RouterFactory
{
    /**
     * @param $calledUrl
     * @param $routesFilePath
     *
     * @return Router
     */
    public static function create($calledUrl, $routesFilePath)
    {
        $routesParser = new RoutesParser($routesFilePath);
        $routes = $routesParser->parseRoutes()->getRoutes();

        $routesCollection = new Routes($routes);

        $router = new Router($calledUrl, $routesCollection);

        return $router;
    }
}