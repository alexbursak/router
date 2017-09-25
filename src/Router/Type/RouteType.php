<?php

namespace ABRouter\Router\Type;

/**
 * Class RouteType
 */
class RouteType
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