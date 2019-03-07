<?php

namespace SZonov\SlimRouteExport\Helpers;

abstract class RouteCollector
{
    /**
     * @var InfoHelperInterface
     */
    protected $info;

    private $_map = [];

    /**
     * RouteCollector constructor.
     * @param InfoHelperInterface $info
     * @param \Slim\Route[] $routes
     */
    public function __construct(InfoHelperInterface $info, array $routes)
    {
        $this->info = $info;

        $this->initialize();

        $this->collect($routes);
    }

    protected function initialize() {}

    abstract protected function createCollection();

    abstract protected function createItem($method, $collection);

    /**
     * @param \Slim\Route[] $routes
     */
    protected function collect(array $routes)
    {
        foreach ($routes as $route)
        {
            $this->info->with($route);

            $group = $this->info->groupName();

            if (!isset($this->_map[$group]))
                $this->_map[$group] = $this->createCollection();

            foreach ($route->getMethods() as $method)
                $this->createItem($method, $this->_map[$group]);
        }
    }
}
