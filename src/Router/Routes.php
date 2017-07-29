<?php

namespace ABRouter\Router;

use ABRouter\ArrayCollection\ArrayCollection;
use ABRouter\Router\Exception\RouterException;
use ABRouter\Router\Type\RouteType;

/**
 * Class Routes
 */
class Routes implements RoutesInterface
{
    /**
     * @var array
     */
    private $routesRaw;

    /**
     * @var ArrayCollection
     */
    private $routesCollection;

    public function __construct($routes)
    {
        $this->routesCollection = new ArrayCollection();

        if(empty($routes) || ! is_array($routes)){
            throw new RouterException('No routes has been set');
        }
        $this->routesRaw = $routes;

        $this->setupRoutes();
    }

    /**
     * Hydrates $routesCollection with RouteType object which are getting build from $routesRaw(simple array)
     */
    private function setupRoutes()
    {
        foreach ($this->routesRaw as $urlPattern => $innerPath) {
            $route = new RouteType($urlPattern, $innerPath);
            $this->routesCollection->addElement($route);
        }
    }

    /**
     * @return array
     */
    public function getRoutesCollection()
    {
        return $this->routesCollection->getElements();
    }
}