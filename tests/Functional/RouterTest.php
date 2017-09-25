<?php
namespace ABRouterTest\Functional;

use ABRouterTest\BaseTestCase;

class RouterTest extends BaseTestCase
{
    /**
     * @test
     */
    public function Router()
    {
        $fileIndex = dirname(__FILE__) . './../Fixtures/FakeApp/index.php';
        $response = include $fileIndex;

        $this->assertRegExp('/FakeDummyController:dummyAction/', $response);
    }
}