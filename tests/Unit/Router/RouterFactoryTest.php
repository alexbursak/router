<?php
namespace ABRouterTest\Unit\Router;

use ABRouter\Router\Factory\RouterFactory;
use ABRouter\Router\Router;
use ABRouter\Router\Routes;
use ABRouterTest\BaseTestCase;

class RouterFactoryTest extends BaseTestCase
{
    /** @var string */
    public $url = 'calc';

    /**
     *
     * @var Routes
     */
    public $routesFileRaw;

    public function setUp()
    {
        $this->routesFileRaw = $this->getRoutesFilePath();
    }

    /**
     * @test
     */
    public function RouterBuild()
    {
        $router = RouterFactory::create($this->url, $this->routesFileRaw);
        $this->assertInstanceOf(Router::class, $router);
    }
}