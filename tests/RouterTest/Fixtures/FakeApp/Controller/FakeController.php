<?php

namespace ABRouterTest\RouterTest\Fixtures\FakeApp\Controller;

/**
 * Fake controller for testing
 */
class FakeController
{

    /**
     * Fake action for testing
     *
     * @param string $param1
     * @param string $param2
     *
     * @return string $response
     */
    public function dummyAction($param1, $param2)
    {
        $response = "FakeDummyController:dummyAction - param1='{$param1}'; param2='{$param2}'";

        return $response;
    }
}