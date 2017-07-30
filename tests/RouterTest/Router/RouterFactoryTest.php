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

    /**
     * @var string
     */
    public $projectNamespace = 'ABRouterTest\RouterTest\Fixtures\FakeApp';

    public function setUp()
    {
        $this->routesFileRaw = dirname(__FILE__) . '/routes.php';
    }

    /**
     * @test
     */
    public function RouterBuild()
    {
        $router = RouterFactory::create($this->url, $this->routesFileRaw, $this->projectNamespace);
        $this->assertInstanceOf(Router::class, $router);
    }
}