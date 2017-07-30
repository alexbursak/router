<?php
namespace ABRouterTest\RouterTest\Router;

use ABRouter\Router\Exception\RouterException;
use ABRouter\Router\Router;
use ABRouter\Router\Routes;
use ABRouter\Router\RoutesParser;
use ABRouterTest\BaseTestCase;
use ABRouterTest\RouterTest\Fixtures\FakeApp\Controller\FakeController;

/**
 * RouterTest
 */
class RouterTest extends BaseTestCase
{
    /**
     * @var string
     */
    public $url = 'calc';

    /**
     *
     * @var Routes
     */
    public $routes;

    /**
     * @var string
     */
    public $projectNamespace = 'ABRouterTest\RouterTest\Fixtures\FakeApp';

    public function setUp()
    {
        $routesParser = new RoutesParser(dirname(__FILE__) . '/routes.php');
        $routes = $routesParser->parseRoutes()->getRoutes();

        $this->routes = new Routes($routes);
    }

    /**
     * Test that Router created successfully
     *
     * @test
     */
    public function RouterBuild()
    {
        $urlCall = 'calc';

        $router = new Router($urlCall, $this->routes, $this->projectNamespace);
        $this->assertInstanceOf(Router::class, $router);
        $this->assertEquals('calc', $router->getUrl());
        $this->assertEquals($this->routes->getRoutesCollection(), $router->getRoutes());
        $this->assertEquals($this->projectNamespace, $router->getProjectNamespace());
    }

    /**
     * Test that Router successfully resolved
     *
     * @test
     */
    public function RouterSuccessfulResponse()
    {
        $router = new Router('fake/param/param2', $this->routes, $this->projectNamespace);
        $result = $router->run();

        $this->assertNotEmpty($result);
    }

    /**
     * Test Test for RouterException - routes file error
     *
     * @test
     *
     * @expectedException \ABRouter\Router\Exception\RouterException
     */
    public function RoutesFileException()
    {
        $urlCall = 'calc';
        $routes = new Routes('');

        $router = new Router($urlCall, $routes, $this->projectNamespace);
        $router->run();
    }

    /**
     * Test for RouterException - routes not found
     *
     * @test
     *
     * @expectedException \ABRouter\Router\Exception\RouterException
     */
    public function RouteNotFoundException()
    {
        $urlCall = 'calc/not/existing/url/';

        $router = new Router($urlCall, $this->routes, $this->projectNamespace);
        $router->run();
    }

    /**
     * Test for RouterException - project name error
     *
     * @test
     *
     * @expectedException \ABRouter\Router\Exception\RouterException
     */
    public function ProjectNameException()
    {
        $urlCall = 'calc';
        $projectName = '';

        $router = new Router($urlCall, $this->routes, $projectName);
        $router->run();
    }

    /**
     * @test
     */
    public function cleanUpUrlMethod()
    {
        $router = new Router('foo/bar?test=what&excluded=yes', $this->routes, $this->projectNamespace);

        $clearUrl = $this->invokeMethod($router, 'cleanUpUrl', ['foo/bar?test=what&excluded=yes']);

        $this->assertEquals('foo/bar', $clearUrl);
    }

    /**
     * @test
     */
    public function explodeRouteMethod()
    {
        $router = new Router($this->url, $this->routes, $this->projectNamespace);

        $internalRoute = 'calculator/calculate/param1/param2';

        $segments = $this->invokeMethod($router, 'explodeRoute', [$internalRoute]);

        $expected = [
            'controllerName' => 'CalculatorController',
            'actionName' => 'calculateAction',
            'parameters' => [
                'param1',
                'param2'
            ]
        ];

        $this->assertEquals($expected, $segments);
    }

    /**
     * @test
     */
    public function generateInternalRouteMethod()
    {
        $router = new Router('calculator/test/param1', $this->routes, $this->projectNamespace);

        $urlPattern = 'calc/([0-9a-zA-Z]+)';
        $innerPath = 'calculator/test/$1';

        $internalRoute = $this->invokeMethod($router, 'generateInternalRoute', [$urlPattern, $innerPath]);
        $expected = 'calculator/test/param1';

        $this->assertEquals($expected, $internalRoute);
        $this->assertEquals($expected, $router->getInternalRoute());
    }


    /**
     * Test Test for RouterException - routes file error
     *
     * @test
     *
     * @expectedException \ABRouter\Router\Exception\RouterException
     */
    public function generateControllerObjectMethodException()
    {
        $router = new Router('router/test', $this->routes, $this->projectNamespace);

        $this->invokeMethod($router, 'generateControllerObject', []);
    }

    /**
     * @test
     */
    public function generateControllerObjectMethod()
    {
        $router = new Router('router/test', $this->routes, $this->projectNamespace);
        $router->setControllerName('FakeController');

        $controllerObject = $this->invokeMethod($router, 'generateControllerObject', []);

        $this->assertInstanceOf(FakeController::class, $controllerObject);
    }

    /**
     * @test
     */
    public function setControllerNameMethod()
    {
        $router = new Router('router/test', $this->routes, $this->projectNamespace);
        $router->setControllerName('FakeController');

        $this->assertEquals($router->getControllerName(), 'FakeController');
    }

    /**
     * @test
     */
    public function setActionNameMethod()
    {
        $router = new Router('router/test', $this->routes, $this->projectNamespace);
        $router->setActionName('testAction');

        $this->assertEquals($router->getActionName(), 'testAction');
    }

    /**
     * @test
     */
    public function setParametersMethod()
    {
        $router = new Router('router/test', $this->routes, $this->projectNamespace);

        $parameters = [
            'param1',
            'param2'
        ];

        $router->setParameters($parameters);

        $this->assertEquals($router->getParameters(), $parameters);
    }
}