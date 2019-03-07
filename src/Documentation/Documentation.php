<?php

namespace SZonov\SlimRouteExport\Documentation;

use SZonov\SlimRouteExport\Helpers\RouteCollector;

/**
 * Class Documentation
 * @package PhSZonov\SlimRouteExport\Documentation
 *
 */
class Documentation extends RouteCollector
{
    public $name;
    public $basePath;

    public $routes = [];
    public $collections = [];

    protected function initialize()
    {
        $this->name = $this->info->title();
        $this->basePath = $this->info->basePath();
    }

    public function createCollection()
    {
        $collection = new Collection($this->info->groupName(), $this->info->groupDescription());
        $this->collections[] = $collection;
        return $collection;
    }

    /**
     * @param string $method
     * @param Collection $collection
     */
    public function createItem($method, $collection)
    {
        $route = $this->info->route();

        $endpoint = new Endpoint(
            $this->info->routeName($method),
            $this->info->routeDescription($method),
            $method,
            $route->getPattern(),
            $this->info->allowedRoles($method)
        );

        $collection->addEndpoint($endpoint);
    }
}
