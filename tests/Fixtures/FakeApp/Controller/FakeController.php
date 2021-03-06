<?php

namespace ABRouterTest\Fixtures\FakeApp\Controller;

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
     * @return string
     */
    public function dummyAction($param1, $param2)
    {
        $response = "FakeDummyController:dummyAction - param1='{$param1}'; param2='{$param2}'";

        return $response;
    }

    /**
     * Fake action for testing
     *
     * @return string
     */
    public function testAction()
    {
        return 'FakeController:testAction';
    }
}