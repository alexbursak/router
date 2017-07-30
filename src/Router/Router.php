<?php

namespace ABRouter\Router;

use ABRouter\Router\Exception\RouterException;

class Router implements RouterInterface
{
    /**
     * @var array
     */
    private $routes;

    /**
     * @var string
     */
    private $url;

    /**
     * @var
     */
    private $internalRoute;

    /**
     * @var string
     */
    private $projectNamespace;

    /**
     * @var string
     */
    private $controllerName;

    /**
     * @var string
     */
    private $actionName;

    /**
     * @var array
     */
    private $parameters;

    public function __construct($url, RoutesInterface $routes, $projectNamespace)
    {
        $this->url = $this->cleanUpUrl($url);
        $this->routes = $routes->getRoutesCollection();
        $this->projectNamespace = $projectNamespace;
    }

    /**
     * Main method that runs Router
     *
     * @throws RouterException
     *
     * @return bool
     */
    public function run()
    {
        if (empty($this->projectNamespace)) {
            throw new RouterException('Project Name Exception');
        }

        $this->findRoute();

        return $this->execute($this->generateControllerObject());
    }

    /**
     * Going though all routes and finds first matching route
     *
     * @throws RouterException
     *
     * @return bool
     */
    private function findRoute()
    {
        foreach ($this->routes as $key => $route) {

            // consider using 'continie' guiadian
            if (preg_match("~^$route->urlPattern$~", $this->url)) {
                $internalRoute = $this->generateInternalRoute($route->urlPattern, $route->innerPath);
                $routeSegments = $this->explodeRoute($internalRoute);

                $this->setControllerName($routeSegments['controllerName']);
                $this->setActionName($routeSegments['actionName']);
                $this->setParameters($routeSegments['parameters']);

                return true;
            }
        }

        throw new RouterException('Route Not Found');
    }


    /**
     * If Url matches a pattern it replaces inner path parameters' pace holders by url parameters
     *
     * @example:
     * url - 'calc/param1'
     * pattern - 'calc/([0-9a-zA-Z]+)'
     * inner path - 'calculator/calculate/$1' - '$1' is a placeholder that will be replaced by url parameter 'param1'
     *
     * internal route - 'calculator/calculate/param1'
     *
     * @param $urlPattern
     * @param $innerPath
     *
     * @return string
     */
    private function generateInternalRoute($urlPattern, $innerPath)
    {
        $this->internalRoute = preg_replace("~$urlPattern~", $innerPath, $this->url);

        return $this->internalRoute;
    }

    /**
     * Calls Controller's action and passing parameters for the action if any
     *
     * @param $controllerObject
     *
     * @return mixed
     */
    private function execute($controllerObject)
    {
        return call_user_func_array([$controllerObject, $this->actionName], $this->parameters);
    }

    /**
     * Separates url from GET parameters passed and returns url part only
     *
     * @param $url
     *
     * @return mixed
     */
    private function cleanUpUrl($url)
    {
        // RegExp instead
        $url = explode('?', $url);
        $cleanUrl = array_shift($url);

        return $cleanUrl;
    }

    /**
     * Explode internal route in to array and generates valid Controller and Action names
     *
     * @example:
     * internal route - 'calculator/calculate/param1/param2'
     * will return:
     * [
     *   controllerName => 'CalculatorController',
     *   actionName     => 'calculateAction',
     *   parameters     => [
     *                       0 => 'param1',
     *                       1 => 'param2'
     *                     ]
     * ]
     *
     * @param string $route
     *
     * @return array $routeSegments
     */
    private function explodeRoute($route)
    {
        $routeSegmentsRaw = explode('/', $route);

        $routeSegments['controllerName'] = ucfirst($routeSegmentsRaw[0]) . 'Controller';
        $routeSegments['actionName'] = $routeSegmentsRaw[1] . 'Action';
        $routeSegments['parameters'] = array_slice($routeSegmentsRaw, 2);

        return $routeSegments;
    }

    /**
     * Generates object of Controller
     *
     * @throws RouterException
     *
     * @return object
     */
    private function generateControllerObject()
    {
        $controllerObjectPath = '\\' . $this->projectNamespace . '\Controller\\' . $this->controllerName;

        if (!class_exists($controllerObjectPath)) {
            throw new RouterException("Controller '{$controllerObjectPath}' Not Found");
        }

        return new $controllerObjectPath();
    }

    /**
     * @param string $controllerName
     *
     * @return $this
     */
    public function setControllerName($controllerName)
    {
        $this->controllerName = $controllerName;

        return $this;
    }

    /**
     * @return string
     */
    public function getControllerName()
    {
        return $this->controllerName;
    }

    /**
     * @param string $actionName
     *
     * @return $this
     */
    public function setActionName($actionName)
    {
        $this->actionName = $actionName;

        return $this;
    }

    /**
     * @return string
     */
    public function getActionName()
    {
        return $this->actionName;
    }

    /**
     * @param array $parameters
     *
     * @return $this
     */
    public function setParameters(array $parameters)
    {
        $this->parameters = $parameters;

        return $this;
    }

    /**
     * @return array
     */
    public function getParameters()
    {
        return $this->parameters;
    }

    /**
     * @return array
     */
    public function getRoutes()
    {
        return $this->routes;
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @return string
     */
    public function getProjectNamespace()
    {
        return $this->projectNamespace;
    }

    /**
     * @return string
     */
    public function getInternalRoute()
    {
        return $this->internalRoute;
    }
}