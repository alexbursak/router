<?php

namespace ABRouter\Router\Exception;


class RouterException extends \Exception
{
    public function __construct($message = 'Router Error')
    {
        parent::__construct($message);
    }
}