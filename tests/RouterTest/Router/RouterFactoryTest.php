<?php
namespace ABRouterTest\RouterTest\Router;

use ABRouter\Router\Factory\RouterFactory;
use ABRouter\Router\Router;
use ABRouter\Router\Routes;
use ABRouter\Router\RoutesParser;
use ABRouterTest\BaseTestCase;
use ABRouterTest\RouterTest\Fixtures\FakeApp\Controller\FakeController;

class RouterFactoryTest extends BaseTestCase
{
    /**
     * @var string
     */
    public $url = 'calc';

    /**
     *
     * @var Routes
     */
    public $routesFileRaw;

    public function setUp()
    {
        $this->routesFileRaw = dirname(__FILE__) . '/routes.php';
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