<?php

namespace ABRouter\Router\Exception;


class RouterException extends \Exception
{
    public function errorMessage() {
        $errorMsg = 'Router error';

        return empty($this->getMessage()) ? $errorMsg : $this->getMessage();
    }
}