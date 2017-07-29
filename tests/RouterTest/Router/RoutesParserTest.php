<?php
namespace ABRouterTest\RouterTest\Router;

use ABRouter\Router\RoutesParser;
use ABRouterTest\BaseTestCase;

/**
 * RoutesParserTest
 */
class RoutesParserTest extends BaseTestCase
{
    private $routesPath;

    public function setUp()
    {
        $this->routesPath = dirname(__FILE__) . '/routes.php';
    }

    /**
     * @test
     *
     * @expectedException \ABRouter\Router\Exception\RouterException
     */
    public function invalidRoutesPath()
    {
        $path = '/not/valid/path.php';
        $parser = new RoutesParser($path);
    }

    /**
     * @test
     */
    public function successfulCreation()
    {
        $parser = new RoutesParser($this->routesPath);

        $this->assertInternalType('array', $parser->getRoutesRaw());
    }

    /**
     * @test
     */
    public function parseRoutes()
    {
        $parser = new RoutesParser($this->routesPath);

        $routes = $parser->parseRoutes()->getRoutes();

        $expectedRoutes = [
            'calc/([0-9]{1,3})' => "calculator/test/$1",
            'calc' => "calculator/calculate",
            'fake/([a-zA-Z]{1,100})/([0-9a-zA-Z]{1,10})' => "fake/dummy/$1/$2"
        ];

        $this->assertEquals($expectedRoutes, $routes);
    }

    /**
     * @test
     */
    public function ParserHasMainParametersTypesAsConstants()
    {
        $routes = new \ReflectionClass(RoutesParser::class);
        $constants = $routes->getConstants();

        $this->assertArrayHasKey('INT', $constants);
        $this->assertInternalType('string', $constants['INT']);
        $this->assertNotEmpty($constants['INT']);

        $this->assertArrayHasKey('STR', $constants);
        $this->assertInternalType('string', $constants['STR']);
        $this->assertNotEmpty($constants['STR']);

        $this->assertArrayHasKey('MIX', $constants);
        $this->assertInternalType('string', $constants['MIX']);
        $this->assertNotEmpty($constants['MIX']);
    }

    /**
     * @test
     */
    public function ParserHasArrayOfMainTypes()
    {
        $routes = new \ReflectionClass(RoutesParser::class);
        $constants = $routes->getConstants();

        $this->assertArrayHasKey('PARAMETERS', $constants);
        $this->assertArrayHasKey('INT', $constants['PARAMETERS']);
        $this->assertArrayHasKey('STR', $constants['PARAMETERS']);
        $this->assertArrayHasKey('MIX', $constants['PARAMETERS']);
    }
}