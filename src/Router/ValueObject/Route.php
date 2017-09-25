<?php

namespace ABRouter\Router\ValueObject;

class Route
{
    /** @var string */
    public $urlPattern;

    /** @var string */
    public $innerPath;

    /**
     * @param string $urlPattern
     * @param string $innerPath
     */
    public function __construct($urlPattern, $innerPath)
    {
        $this->urlPattern = $urlPattern;;
        $this->innerPath = $innerPath;
    }
}