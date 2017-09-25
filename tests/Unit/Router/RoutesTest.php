<?php
namespace ABRouterTest\Unit\Router;


use ABRouter\Router\Routes;
use ABRouterTest\BaseTestCase;

class RoutesTest extends BaseTestCase
{
    /** @var array */
    private $routes;

    public function setUp()
    {
        $this->routes = [
            'calc/([0-9]{1,3})' => 'calculator/test/$1',
            'calc' => 'calculator/calculate',
            'fake/([0-9a-zA-Z]{0,10})/(.{0,500})' => 'fake/dummy/$1/$2'
        ];
    }

    /**
     * @test
     */
    public function successfulGeneration()
    {
        $routes = new Routes($this->routes);

        $this->assertInstanceOf(Routes::class, $routes);
    }

    /**
     * @test
     *
     * @expectedException \ABRouter\Router\Exception\RouterException
     */
    public function NoRoutesFoundExceptionEmptyRoutes()
    {
        $routes = new Routes('');
    }

    /**
     * @test
     *
     * @expectedException \ABRouter\Router\Exception\RouterException
     */
    public function NoRoutesFoundExceptionRoutesIsNull()
    {
        $routesFile = null;

        $routes = new Routes($routesFile);
    }

    /**
     * @test
     *
     * @expectedException \ABRouter\Router\Exception\RouterException
     */
    public function NoRoutesFoundExceptionRoutesIsEmptyArray()
    {
        $routesFile = [];

        $routes = new Routes($routesFile);
    }

    /**
     * @test
     */
    public function RoutesAreInstanceOfArray()
    {
        $routes = new Routes($this->routes);

        $this->assertTrue(is_array($routes->getRoutesCollection()));
    }
}